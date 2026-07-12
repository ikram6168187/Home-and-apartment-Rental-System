<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Property;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    // Property detail page + booking form
    public function show($id)
    {
        $property = Property::where('id', $id)
                            ->where('status', 'active')
                            ->firstOrFail();

        // Check already booked dates
        $bookedDates = Booking::where('property_id', $id)
                              ->where('status', '!=', 'cancelled')
                              ->get(['check_in', 'check_out']);

        $unreadNotifications = 0;
        if (Auth::check()) {
            $unreadNotifications = Notification::where('user_id', Auth::id())
                                    ->where('is_read', false)->count();
        }

        return view('Property detail', compact('property', 'bookedDates', 'unreadNotifications'));
    }

    // Booking submit
    public function store(Request $request, $id)
    {
        // Login check
        if (!Auth::check()) {
            return redirect()->route('home')->with('show_login', true);
        }

        $property = Property::findOrFail($id);

        $request->validate([
            'check_in'  => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
            'guests'    => 'required|integer|min:1|max:20',
            'message'   => 'nullable|string|max:500',
        ], [
            'check_in.after_or_equal'  => 'Check-in date must be today or later.',
            'check_out.after'          => 'Check-out must be after check-in.',
            'guests.min'               => 'At least 1 guest required.',
        ]);

        // Check availability — overlap check
        $overlap = Booking::where('property_id', $id)
                          ->where('status', '!=', 'cancelled')
                          ->where(function ($query) use ($request) {
                              $query->whereBetween('check_in',  [$request->check_in, $request->check_out])
                                    ->orWhereBetween('check_out', [$request->check_in, $request->check_out])
                                    ->orWhere(function ($q) use ($request) {
                                        $q->where('check_in',  '<=', $request->check_in)
                                          ->where('check_out', '>=', $request->check_out);
                                    });
                          })->exists();

        if ($overlap) {
            return back()->withErrors([
                'check_in' => 'This property is not available for selected dates. Please choose different dates.'
            ])->withInput();
        }

        // Booking save karo
        $booking = Booking::create([
            'property_id' => $id,
            'user_id'     => Auth::id(),
            'check_in'    => $request->check_in,
            'check_out'   => $request->check_out,
            'guests'      => $request->guests,
            'message'     => $request->message,
            'status'      => 'pending',
        ]);

        // User ko notification
        Notification::create([
            'user_id' => Auth::id(),
            'title'   => 'Booking Request Sent',
            'message' => 'Your booking request for "' . $property->title . '" has been sent to the owner.',
            'type'    => 'info',
            'icon'    => 'fa-calendar-check',
        ]);

        // Owner ko notification
        Notification::create([
            'user_id' => $property->user_id,
            'title'   => 'New Booking Request!',
            'message' => Auth::user()->name . ' requested to book "' . $property->title . '" from ' .
                         \Carbon\Carbon::parse($request->check_in)->format('d M') . ' to ' .
                         \Carbon\Carbon::parse($request->check_out)->format('d M Y') . '.',
            'type'    => 'success',
            'icon'    => 'fa-calendar-check',
        ]);

        return redirect()->route('property.show', $id)
                         ->with('success', 'Booking request sent successfully! The owner will confirm soon.');
    }

    // Owner — Booking Requests page
    public function requests()
    {
        $bookings = Booking::whereHas('property', function ($q) {
                        $q->where('user_id', Auth::id());
                    })
                    ->with(['property', 'user'])
                    ->latest()
                    ->get();

        $unreadNotifications = Notification::where('user_id', Auth::id())
                                ->where('is_read', false)->count();

        $pending   = $bookings->where('status', 'pending')->count();
        $confirmed = $bookings->where('status', 'confirmed')->count();
        $cancelled = $bookings->where('status', 'cancelled')->count();

        return view('booking request', compact(
            'bookings', 'unreadNotifications',
            'pending', 'confirmed', 'cancelled'
        ));
    }

    // Owner — Accept booking
    public function confirm($id)
    {
        $booking = Booking::findOrFail($id);

        // Sirf apni property ki booking confirm karo
        if ($booking->property->user_id != Auth::id()) {
            abort(403);
        }

        $booking->update(['status' => 'confirmed']);

        // User ko notification
        Notification::create([
            'user_id' => $booking->user_id,
            'title'   => 'Booking Confirmed! 🎉',
            'message' => 'Your booking for "' . $booking->property->title . '" from ' .
                         $booking->check_in->format('d M') . ' to ' .
                         $booking->check_out->format('d M Y') . ' has been confirmed.',
            'type'    => 'success',
            'icon'    => 'fa-circle-check',
        ]);

        return redirect()->route('booking.requests')
                         ->with('success', 'Booking confirmed successfully!');
    }

    // Owner — Reject booking
    public function cancel($id)
    {
        $booking = Booking::findOrFail($id);

        if ($booking->property->user_id != Auth::id()) {
            abort(403);
        }

        $booking->update(['status' => 'cancelled']);

        // User ko notification
        Notification::create([
            'user_id' => $booking->user_id,
            'title'   => 'Booking Cancelled',
            'message' => 'Your booking request for "' . $booking->property->title . '" has been cancelled by the owner.',
            'type'    => 'danger',
            'icon'    => 'fa-circle-xmark',
        ]);

        return redirect()->route('booking.requests')
                         ->with('success', 'Booking cancelled.');
    }

    // User — My Bookings
    public function myBookings()
    {
        $bookings = Booking::where('user_id', Auth::id())
                           ->with('property')
                           ->latest()
                           ->get();

        $unreadNotifications = Notification::where('user_id', Auth::id())
                                ->where('is_read', false)->count();

        return view('my-bookings', compact('bookings', 'unreadNotifications'));
    }
}
