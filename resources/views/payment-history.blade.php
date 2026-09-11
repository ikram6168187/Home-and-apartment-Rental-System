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

    <style>

        /* =========================================
           BACK TO DASHBOARD BUTTON
        ========================================= */

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 15px;
            flex-wrap: wrap;
        }

        .page-header-text h1 {
            margin: 0 0 6px 0;
        }

        .back-dashboard-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;

            padding: 10px 18px;

            background: #f3f4f6;
            color: #111827;

            border-radius: 8px;

            text-decoration: none;

            font-size: 14px;
            font-weight: 600;

            white-space: nowrap;

            transition: background-color .2s ease, transform .2s ease;
        }

        .back-dashboard-btn:hover {
            background: #e5e7eb;
            transform: translateY(-1px);
        }

        @media (max-width: 600px) {

            .page-header {
                flex-direction: column;
                align-items: flex-start;
            }

        }

    </style>

</head>


<body>

<div class="container">


    <!-- HEADER -->

    <div class="page-header">

        <div class="page-header-text">

            <h1>
                Payment History
            </h1>

            <p>
                View all your submitted payment records.
            </p>

        </div>

        <a href="{{ route('dashboard') }}" class="back-dashboard-btn">

            <i class="fa-solid fa-arrow-left"></i>

            Back to Dashboard

        </a>

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