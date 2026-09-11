<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Received Payments | Smart Rent</title>

    <!-- Font Awesome -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">

    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f5f3f1;
            color: #222;
        }

        /* =========================================
           TOPBAR
        ========================================= */

        .topbar {
            width: 95%;
            margin: 15px auto 0;
            padding: 18px 22px;

            background: rgb(51, 47, 46);

            border-radius: 18px;

            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .topbar-title {
            color: #fff;
            font-size: 18px;
            font-weight: 700;
        }

        .topbar-title i {
            margin-right: 8px;
        }

        .back-home {
            display: inline-flex;
            align-items: center;
            gap: 7px;

            padding: 9px 14px;

            background: #fff;
            color: #222;

            text-decoration: none;

            border-radius: 8px;

            font-size: 13px;
            font-weight: 600;

            transition: .2s;
        }

        .back-home:hover {
            transform: translateY(-1px);
            opacity: .9;
        }


        /* =========================================
           PAGE
        ========================================= */

        .page-container {
            width: 95%;
            margin: 25px auto 50px;
        }


        /* =========================================
           PAGE HEADER
        ========================================= */

        .page-header {
            margin-bottom: 20px;
        }

        .page-header h1 {
            font-size: 25px;
            margin-bottom: 6px;
        }

        .page-header p {
            color: #777;
            font-size: 13px;
        }


        /* =========================================
           SUMMARY
        ========================================= */

        .summary-card {
            background: #fff;

            border-radius: 12px;

            padding: 18px 20px;

            margin-bottom: 20px;

            border: 1px solid #e8e5e2;

            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .summary-left {
            display: flex;
            align-items: center;
            gap: 13px;
        }

        .summary-icon {
            width: 42px;
            height: 42px;

            border-radius: 10px;

            background: #f0ebe5;

            display: flex;
            align-items: center;
            justify-content: center;

            color: #51453d;
            font-size: 18px;
        }

        .summary-text span {
            display: block;

            font-size: 11px;
            color: #888;

            margin-bottom: 3px;
        }

        .summary-text strong {
            font-size: 18px;
        }


        /* =========================================
           PAYMENT CARD
        ========================================= */

        .payments-list {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .payment-card {
            background: #fff;

            border: 1px solid #e7e4e1;

            border-radius: 14px;

            padding: 20px;

            transition: .2s;
        }

        .payment-card:hover {
            box-shadow: 0 5px 18px rgba(0, 0, 0, .05);
        }


        /* =========================================
           PAYMENT HEADER
        ========================================= */

        .payment-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;

            padding-bottom: 16px;

            border-bottom: 1px solid #eee;
        }

        .property-info h3 {
            font-size: 16px;
            margin-bottom: 5px;
        }

        .property-info h3 i {
            margin-right: 7px;
            color: #6d5b4f;
        }

        .property-info p {
            color: #888;
            font-size: 12px;
        }


        /* =========================================
           STATUS
        ========================================= */

        .payment-status {
            display: inline-flex;
            align-items: center;
            gap: 6px;

            padding: 7px 11px;

            border-radius: 20px;

            font-size: 11px;
            font-weight: 600;
        }

        .payment-status.submitted {
            background: #fff4d6;
            color: #a66b00;
        }

        .payment-status.verified {
            background: #e7f6ed;
            color: #198754;
        }

        .payment-status.rejected {
            background: #fdebed;
            color: #dc3545;
        }


        /* =========================================
           PAYMENT DETAILS
        ========================================= */

        .payment-details {
            display: grid;

            grid-template-columns:
                repeat(4, 1fr);

            gap: 12px;

            margin-top: 16px;
        }

        .detail-box {
            background: #fafafa;

            border: 1px solid #eee;

            border-radius: 9px;

            padding: 12px;
        }

        .detail-box span {
            display: block;

            font-size: 10px;

            color: #888;

            margin-bottom: 5px;

            text-transform: uppercase;
        }

        .detail-box strong {
            display: block;

            font-size: 13px;

            color: #222;

            word-break: break-word;
        }

        .amount {
            color: #198754 !important;
        }


        /* =========================================
           RENTER
        ========================================= */

        .renter-info {
            margin-top: 15px;

            padding: 12px 14px;

            background: #f8f6f4;

            border-radius: 9px;

            font-size: 12px;

            color: #555;
        }

        .renter-info i {
            margin-right: 6px;
            color: #6d5b4f;
        }

        .renter-info strong {
            color: #222;
        }


        /* =========================================
           PROOF + REJECTION
        ========================================= */

        .payment-footer {
            margin-top: 15px;

            display: flex;

            justify-content: space-between;

            align-items: center;

            gap: 15px;

            flex-wrap: wrap;
        }

        .proof-link {
            display: inline-flex;

            align-items: center;

            gap: 7px;

            color: #2563eb;

            text-decoration: none;

            font-size: 12px;

            font-weight: 600;
        }

        .proof-link:hover {
            text-decoration: underline;
        }

        .payment-date {
            color: #888;

            font-size: 11px;
        }


        /* =========================================
           REJECTION REASON
        ========================================= */

        .rejection-box {
            margin-top: 14px;

            padding: 12px 14px;

            background: #fff1f2;

            border: 1px solid #f4c2c7;

            border-radius: 8px;
        }

        .rejection-box strong {
            display: block;

            color: #dc3545;

            font-size: 12px;

            margin-bottom: 5px;
        }

        .rejection-box p {
            color: #555;

            font-size: 12px;

            line-height: 1.5;
        }


        /* =========================================
           EMPTY STATE
        ========================================= */

        .empty-state {
            background: #fff;

            border: 1px solid #e7e4e1;

            border-radius: 14px;

            padding: 60px 20px;

            text-align: center;
        }

        .empty-icon {
            width: 60px;
            height: 60px;

            margin: 0 auto 15px;

            border-radius: 50%;

            background: #f0ebe5;

            display: flex;
            align-items: center;
            justify-content: center;

            color: #6d5b4f;

            font-size: 23px;
        }

        .empty-state h3 {
            font-size: 16px;

            margin-bottom: 7px;
        }

        .empty-state p {
            color: #888;

            font-size: 12px;
        }


        /* =========================================
           RESPONSIVE
        ========================================= */

        @media (max-width: 900px) {

            .payment-details {
                grid-template-columns:
                    repeat(2, 1fr);
            }

        }

        @media (max-width: 600px) {

            .topbar {
                flex-direction: column;

                align-items: flex-start;

                gap: 12px;
            }

            .payment-header {
                flex-direction: column;

                gap: 12px;
            }

            .payment-details {
                grid-template-columns: 1fr;
            }

            .summary-card {
                align-items: flex-start;
            }

            .page-container {
                width: 92%;
            }

        }

    </style>

</head>


<body>

    


    <!-- =========================================
         TOPBAR
    ========================================== -->

    <div class="topbar">

        <div class="topbar-title">

            <i class="fa-solid fa-money-check-dollar"></i>

            Received Payments

        </div>


        <a href="{{ route('dashboard') }}"
           class="back-home">

            <i class="fa-solid fa-gauge"></i>

            Back to Dashboard

        </a>

    </div>



    <!-- =========================================
         PAGE CONTAINER
    ========================================== -->

    <div class="page-container">


        <!-- PAGE HEADER -->

        <div class="page-header">

            <h1>Payment History</h1>

            <p>
                View advance payments received for your properties.
            </p>

        </div>



        <!-- =====================================
             SUMMARY
        ====================================== -->

        <div class="summary-card">

            <div class="summary-left">

                <div class="summary-icon">

                    <i class="fa-solid fa-wallet"></i>

                </div>


                <div class="summary-text">

                    <span>
                        Total Payments Received
                    </span>

                    <strong>
                        {{ $payments->count() }}
                    </strong>

                </div>

            </div>


            <div class="summary-text"
                 style="text-align:right;">

                <span>
                    Verified Amount
                </span>

                <strong>

                    Rs.
                    {{ number_format(
                        $payments
                            ->where('status', 'verified')
                            ->sum('amount'),
                        2
                    ) }}

                </strong>

            </div>

        </div>



        <!-- =====================================
             PAYMENTS
        ====================================== -->

        @if($payments->count() > 0)


            <div class="payments-list">


                @foreach($payments as $payment)


                    <div class="payment-card">


                        <!-- PAYMENT HEADER -->

                        <div class="payment-header">


                            <div class="property-info">

                                <h3>

                                    <i class="fa-solid fa-house"></i>

                                    {{ $payment->booking->property->title }}

                                </h3>


                                <p>

                                    Booking ID:
                                    #{{ $payment->booking->id }}

                                </p>

                            </div>



                            <!-- STATUS -->

                            @if($payment->status == 'verified')

                                <span class="payment-status verified">

                                    <i class="fa-solid fa-circle-check"></i>

                                    Verified

                                </span>


                            @elseif($payment->status == 'submitted')

                                <span class="payment-status submitted">

                                    <i class="fa-solid fa-clock"></i>

                                    Under Verification

                                </span>


                            @elseif($payment->status == 'rejected')

                                <span class="payment-status rejected">

                                    <i class="fa-solid fa-circle-xmark"></i>

                                    Rejected

                                </span>

                            @endif


                        </div>



                        <!-- PAYMENT DETAILS -->

                        <div class="payment-details">


                            <!-- RENTER -->

                            <div class="detail-box">

                                <span>
                                    Renter
                                </span>

                                <strong>

                                    {{ $payment->booking->user->name ?? 'N/A' }}

                                </strong>

                            </div>


                            <!-- AMOUNT -->

                            <div class="detail-box">

                                <span>
                                    Advance Amount
                                </span>

                                <strong class="amount">

                                    Rs.
                                    {{ number_format(
                                        $payment->amount,
                                        2
                                    ) }}

                                </strong>

                            </div>


                            <!-- PAYMENT METHOD -->

                            <div class="detail-box">

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


                            <!-- TRANSACTION ID -->

                            <div class="detail-box">

                                <span>
                                    Transaction ID
                                </span>

                                <strong>

                                    {{ $payment->transaction_id }}

                                </strong>

                            </div>


                        </div>



                        <!-- PAYMENT FOOTER -->

                        <div class="payment-footer">


                            @if($payment->payment_proof)

                                <a
                                    href="{{ asset(
                                        'storage/' .
                                        $payment->payment_proof
                                    ) }}"
                                    target="_blank"
                                    class="proof-link"
                                >

                                    <i class="fa-solid fa-image"></i>

                                    View Payment Screenshot

                                </a>

                            @endif


                            <div class="payment-date">

                                <i class="fa-regular fa-calendar"></i>

                                Submitted:

                                {{ $payment->created_at->format('d M Y, h:i A') }}

                            </div>


                        </div>



                        <!-- REJECTION REASON -->

                        @if(
                            $payment->status == 'rejected'
                            && $payment->rejection_reason
                        )

                            <div class="rejection-box">

                                <strong>

                                    <i class="fa-solid fa-triangle-exclamation"></i>

                                    Rejection Reason

                                </strong>

                                <p>

                                    {{ $payment->rejection_reason }}

                                </p>

                            </div>

                        @endif


                    </div>


                @endforeach


            </div>


        @else


            <!-- =================================
                 EMPTY STATE
            ================================== -->

            <div class="empty-state">

                <div class="empty-icon">

                    <i class="fa-solid fa-money-check-dollar"></i>

                </div>


                <h3>
                    No Payments Received Yet
                </h3>


                <p>
                    When renters make advance payments
                    for your properties, they will appear here.
                </p>

            </div>


        @endif


    </div>


</body>

</html>