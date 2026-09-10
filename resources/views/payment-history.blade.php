<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Payment History | Smart Rent
    </title>

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    >

    <link rel="stylesheet" href="{{ asset('css/payment-history.css') }}">

</head>


<body>

<div class="container">


    <!-- HEADER -->

    <div class="page-header">

        <h1>
            Payment History
        </h1>

        <p>
            View all your submitted payment records.
        </p>

    </div>


    <!-- PAYMENTS -->

    @forelse($payments as $payment)

        <div class="payment-card">


            <div class="payment-top">

                <div>

                    <div class="property-name">

                        {{ $payment->booking->property->title ?? 'Property' }}

                    </div>

                    <div class="booking-number">

                        Booking #{{ $payment->booking_id }}

                    </div>

                </div>


                @if($payment->status == 'submitted')

                    <span class="status submitted">

                        <i class="fa-solid fa-clock"></i>

                        Under Verification

                    </span>

                @elseif($payment->status == 'verified')

                    <span class="status verified">

                        <i class="fa-solid fa-circle-check"></i>

                        Verified

                    </span>

                @else

                    <span class="status rejected">

                        <i class="fa-solid fa-circle-xmark"></i>

                        Rejected

                    </span>

                @endif

            </div>


            <div class="details">


                <!-- Amount -->

                <div class="detail">

                    <span>
                        Amount
                    </span>

                    <strong>

                        Rs.
                        {{ number_format($payment->amount, 2) }}

                    </strong>

                </div>


                <!-- Method -->

                <div class="detail">

                    <span>
                        Payment Method
                    </span>

                    <strong>

                        @if($payment->payment_method == 'jazzcash')

                            JazzCash

                        @elseif($payment->payment_method == 'easypaisa')

                            EasyPaisa

                        @else

                            Bank Transfer

                        @endif

                    </strong>

                </div>


                <!-- Transaction -->

                <div class="detail">

                    <span>
                        Transaction ID
                    </span>

                    <strong>
                        {{ $payment->transaction_id }}
                    </strong>

                </div>


                <!-- Date -->

                <div class="detail">

                    <span>
                        Submitted
                    </span>

                    <strong>

                        {{ $payment->created_at->format('d M Y, h:i A') }}

                    </strong>

                </div>

            </div>


            <!-- SCREENSHOT -->

            @if($payment->payment_proof)

                <div class="proof">

                    <a
                        href="{{ asset('storage/' . $payment->payment_proof) }}"
                        target="_blank"
                    >

                        <i class="fa-solid fa-image"></i>

                        View Payment Screenshot

                    </a>

                </div>

            @endif


            <!-- REJECTION -->

            @if(
                $payment->status == 'rejected'
                && $payment->rejection_reason
            )

                <div class="reason">

                    <strong>

                        <i class="fa-solid fa-triangle-exclamation"></i>

                        Rejection Reason

                    </strong>

                    {{ $payment->rejection_reason }}

                </div>

            @endif


        </div>

    @empty

        <div class="empty">

            <i class="fa-solid fa-receipt"></i>

            <p>
                You don't have any payment records yet.
            </p>

        </div>

    @endforelse


</div>

</body>

</html>