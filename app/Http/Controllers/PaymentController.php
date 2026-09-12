<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Payment;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Payment Page
    |--------------------------------------------------------------------------
    */

    public function create($bookingId)
    {
        $booking = Booking::with([
            'property',
            'property.user'
        ])
        ->where('id', $bookingId)
        ->where('user_id', Auth::id())
        ->firstOrFail();

        /*
        |--------------------------------------------------------------------------
        | Booking Status Check
        |--------------------------------------------------------------------------
        */

        if ($booking->status !== 'approved') {
            return redirect()
                ->route('my.bookings')
                ->with(
                    'error',
                    'Payment is not available for this booking.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | Prevent Duplicate Payment
        |--------------------------------------------------------------------------
        */

        if ($booking->payment) {
            return redirect()
                ->route('my.bookings')
                ->with(
                    'error',
                    'Payment has already been submitted.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | Calculate Advance Payment
        |--------------------------------------------------------------------------
        |
        | 10% of the TOTAL rent for the booking duration
        | (monthly price ÷ 30 × number of days), not just
        | 10% of the flat monthly price.
        |
        */

        $days = $booking->check_in->diffInDays($booking->check_out);

        $totalRent = ($booking->property->price / 30) * $days;

        $amount = round(
            ($totalRent * 10) / 100,
            2
        );

        $owner = $booking->property->user;

        return view(
            'payment',
            compact(
                'booking',
                'owner',
                'amount',
                'days'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Submit Payment
    |--------------------------------------------------------------------------
    */

    public function store(Request $request, int$bookingId)
    {
        /*
        |--------------------------------------------------------------------------
        | Find Booking
        |--------------------------------------------------------------------------
        */

        $booking = Booking::with([
            'property',
            'property.user'
        ])
        ->where('id', $bookingId)
        ->where('user_id', Auth::id())
        ->firstOrFail();


        /*
        |--------------------------------------------------------------------------
        | Booking Status Check
        |--------------------------------------------------------------------------
        */

        if ($booking->status !== 'approved') {
            return redirect()
                ->route('my.bookings')
                ->with(
                    'error',
                    'Payment cannot be submitted for this booking.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Prevent Duplicate Payment
        |--------------------------------------------------------------------------
        */

        if ($booking->payment) {
            return redirect()
                ->route('my.bookings')
                ->with(
                    'error',
                    'Payment has already been submitted.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Validate Payment Data
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([

            'payment_method' => [
                'required',
                'in:jazzcash,easypaisa,bank_transfer'
            ],

            'transaction_id' => [
                'required',
                'string',
                'max:100'
            ],

            'payment_proof' => [
                'required',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048'
            ],

        ], [

            'payment_method.required' =>
                'Please select a payment method.',

            'transaction_id.required' =>
                'Please enter the transaction ID.',

            'payment_proof.required' =>
                'Please upload your payment screenshot.',

            'payment_proof.image' =>
                'The payment proof must be an image.',

            'payment_proof.mimes' =>
                'Payment proof must be JPG, JPEG, PNG or WEBP.',

            'payment_proof.max' =>
                'Payment proof must not be larger than 2MB.',

        ]);


        /*
        |--------------------------------------------------------------------------
        | Calculate Amount Server-Side
        |--------------------------------------------------------------------------
        |
        | Never trust amount coming from frontend.
        | Same duration-based formula as create() above.
        |
        */

        $days = $booking->check_in->diffInDays($booking->check_out);

        $totalRent = ($booking->property->price / 30) * $days;

        $amount = round(
            ($totalRent * 10) / 100,
            2
        );


        /*
        |--------------------------------------------------------------------------
        | Upload Payment Screenshot
        |--------------------------------------------------------------------------
        */

        $paymentProofPath = $request
            ->file('payment_proof')
            ->store(
                'payment_proofs',
                'public'
            );


        /*
        |--------------------------------------------------------------------------
        | Create Payment + Update Booking
        |--------------------------------------------------------------------------
        */

        DB::transaction(function () use (
            $booking,
            $validated,
            $amount,
            $paymentProofPath
        ) {

            /*
            | Create Payment
            */

            $payment = Payment::create([

                'booking_id' => $booking->id,

                'user_id' => Auth::id(),

                'amount' => $amount,

                'payment_method' =>
                    $validated['payment_method'],

                'transaction_id' =>
                    $validated['transaction_id'],

                'payment_proof' =>
                    $paymentProofPath,

                'status' => 'submitted',

            ]);


            /*
            | Update Booking Status
            */

            $booking->update([
                'status' => 'payment_submitted'
            ]);


            /*
            |--------------------------------------------------------------------------
            | Notify Property Owner
            |--------------------------------------------------------------------------
            */

            Notification::create([

                'user_id' =>
                    $booking->property->user_id,

                'title' =>
                    'Payment Submitted',

                'message' =>
                    'Payment has been submitted for your property "' .
                    $booking->property->title .
                    '". Please verify the payment.',

                'type' => 'info',

                'icon' => 'fa-money-check-dollar',

            ]);

        });


        /*
        |--------------------------------------------------------------------------
        | Redirect
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('my.bookings')
            ->with(
                'success',
                'Payment submitted successfully. Your payment is now under verification.'
            );
    }
    /*
|--------------------------------------------------------------------------
| Verify Payment
|--------------------------------------------------------------------------
*/

public function verify($paymentId)
{
    $payment = Payment::with([
        'booking',
        'booking.property'
    ])->findOrFail($paymentId);


    /*
    |--------------------------------------------------------------------------
    | Only Property Owner Can Verify
    |--------------------------------------------------------------------------
    */

   if (
    Auth::user()->role !== 'admin' &&
    $payment->booking->property->user_id != Auth::id()
) {
    abort(403);
}

    /*
    |--------------------------------------------------------------------------
    | Payment Status Check
    |--------------------------------------------------------------------------
    */

    if ($payment->status !== 'submitted') {

        return back()->with(
            'error',
            'This payment has already been processed.'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Verify Payment
    |--------------------------------------------------------------------------
    */

    DB::transaction(function () use ($payment) {

        $payment->update([

            'status' => 'verified',

            'verified_by' => Auth::id(),

            'verified_at' => now(),

        ]);


        /*
        |--------------------------------------------------------------------------
        | Confirm Booking
        |--------------------------------------------------------------------------
        */

        $payment->booking->update([

            'status' => 'confirmed'

        ]);


        /*
        |--------------------------------------------------------------------------
        | Notify Renter
        |--------------------------------------------------------------------------
        */

        Notification::create([

            'user_id' =>
                $payment->booking->user_id,

            'title' =>
                'Payment Verified',

            'message' =>
                'Your payment for "' .
                $payment->booking->property->title .
                '" has been verified. Your booking is now confirmed.',

            'type' => 'success',

            'icon' => 'fa-circle-check',

        ]);

    });


    return back()->with(
        'success',
        'Payment verified successfully. Booking is now confirmed.'
    );
}


/*
|--------------------------------------------------------------------------
| Reject Payment
|--------------------------------------------------------------------------
*/

public function reject(Request $request, $paymentId)
{
    $payment = Payment::with([
        'booking',
        'booking.property'
    ])->findOrFail($paymentId);


    /*
    |--------------------------------------------------------------------------
    | Only Property Owner Can Reject
    |--------------------------------------------------------------------------
    */

   if (
    Auth::user()->role !== 'admin' &&
    $payment->booking->property->user_id != Auth::id()
)
 {
    abort(403);
}

    /*
    |--------------------------------------------------------------------------
    | Payment Status Check
    |--------------------------------------------------------------------------
    */

    if ($payment->status !== 'submitted') {

        return back()->with(
            'error',
            'This payment has already been processed.'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Validate Rejection Reason
    |--------------------------------------------------------------------------
    */

    $request->validate([

        'rejection_reason' => [
            'required',
            'string',
            'max:500'
        ],

    ]);


    /*
    |--------------------------------------------------------------------------
    | Reject Payment
    |--------------------------------------------------------------------------
    */

    DB::transaction(function () use (
        $payment,
        $request
    ) {

        $payment->update([

            'status' => 'rejected',

            'rejection_reason' =>
                $request->rejection_reason,

            'verified_by' =>
                Auth::id(),

            'verified_at' =>
                now(),

        ]);


        /*
        |--------------------------------------------------------------------------
        | Booking Back To Approved
        |--------------------------------------------------------------------------
        |
        | Renter can submit payment again.
        |
        */

        $payment->booking->update([

            'status' => 'approved'

        ]);


        /*
        |--------------------------------------------------------------------------
        | Notify Renter
        |--------------------------------------------------------------------------
        */

        Notification::create([

            'user_id' =>
                $payment->booking->user_id,

            'title' =>
                'Payment Rejected',

            'message' =>
                'Your payment for "' .
                $payment->booking->property->title .
                '" was rejected. Reason: ' .
                $request->rejection_reason,

            'type' => 'error',

            'icon' => 'fa-circle-xmark',

        ]);

    });


    return back()->with(
        'success',
        'Payment rejected. The renter has been notified.'
    );
}
/*
|--------------------------------------------------------------------------
| Payment History
|--------------------------------------------------------------------------
*/

public function history()
{
    $payments = Payment::with([
        'booking',
        'booking.property'
    ])
    ->where('user_id', Auth::id())
    ->latest()
    ->get();

    return view(
        'payment-history',
        compact('payments')
    );
}
/*
|--------------------------------------------------------------------------
| Owner Payment History
|--------------------------------------------------------------------------
*/

public function ownerHistory()
{
    $payments = Payment::with([
        'booking',
        'booking.property',
        'booking.user'
    ])
    ->whereHas('booking.property', function ($query) {
        $query->where('user_id', Auth::id());
    })
    ->latest()
    ->get();

    return view(
        'owner-payment-history',
        compact('payments')
    );
}
}