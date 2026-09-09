<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Make Payment — Smart Rent</title>

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('css/payment.css') }}">

</head>

<body>

<div class="page">

    <div class="payment-wrapper">

        <a href="{{ route('my.bookings') }}"
           class="back-btn">

            <i class="fa-solid fa-arrow-left"></i>
            Back to My Bookings

        </a>

        <div class="page-title">

            <h1>
                <i class="fa-solid fa-money-bill-transfer"></i>
                Make Payment
            </h1>

            <p>
                Complete your advance payment to confirm your booking.
            </p>

        </div>


        <div class="payment-grid">


            <!-- BOOKING DETAILS -->

            <div class="card">

                <h2>
                    <i class="fa-solid fa-calendar-check"></i>
                    Booking Details
                </h2>


                <div class="property-box">

                    @if($booking->property->image)

                        <img
                            src="{{ asset('storage/'.$booking->property->image) }}"
                            alt="{{ $booking->property->title }}">

                    @else

                        <div style="
                            width:110px;
                            height:85px;
                            border-radius:10px;
                            background:#eee;
                            display:flex;
                            align-items:center;
                            justify-content:center;
                        ">

                            <i class="fa-solid fa-house"
                               style="font-size:30px;color:#999;"></i>

                        </div>

                    @endif


                    <div class="property-info">

                        <h3>
                            {{ $booking->property->title }}
                        </h3>

                        <p>
                            <i class="fa-solid fa-location-dot"></i>
                            {{ $booking->property->location }},
                            {{ $booking->property->city }}
                        </p>

                    </div>

                </div>


                <div class="booking-info">

                    <div class="info-row">

                        <span>Check-in</span>

                        <strong>
                            {{ $booking->check_in->format('d M Y') }}
                        </strong>

                    </div>


                    <div class="info-row">

                        <span>Check-out</span>

                        <strong>
                            {{ $booking->check_out->format('d M Y') }}
                        </strong>

                    </div>


                    <div class="info-row">

                        <span>Guests</span>

                        <strong>
                            {{ $booking->guests }}
                        </strong>

                    </div>


                    <div class="info-row">

                        <span>Monthly Rent</span>

                        <strong>
                            ₨ {{ number_format($booking->property->price) }}
                        </strong>

                    </div>

                </div>


                <div class="amount-box">

                    <small>
                        Required Advance Payment (10%)
                    </small>

                    <h1>
                        ₨ {{ number_format($amount, 2) }}
                    </h1>

                </div>

            </div>


            <!-- PAYMENT DETAILS -->

            <div class="card">

                <h2>
                    <i class="fa-solid fa-wallet"></i>
                    Owner Payment Details
                </h2>


                <div class="owner-details">

                    <p style="margin-bottom:15px;color:#777;">
                        Send the exact amount to any one of the
                        following payment accounts.
                    </p>


                    @if($owner->jazzcash_number)

                        <div class="payment-method">

                            <h3>
                                <i class="fa-solid fa-mobile-screen-button"></i>
                                JazzCash
                            </h3>

                            <p>
                                {{ $owner->jazzcash_number }}
                            </p>

                        </div>

                    @endif


                    @if($owner->easypaisa_number)

                        <div class="payment-method">

                            <h3>
                                <i class="fa-solid fa-mobile-screen-button"></i>
                                EasyPaisa
                            </h3>

                            <p>
                                {{ $owner->easypaisa_number }}
                            </p>

                        </div>

                    @endif


                    @if(
                        $owner->bank_name ||
                        $owner->bank_account_title ||
                        $owner->bank_account_number
                    )

                        <div class="payment-method">

                            <h3>
                                <i class="fa-solid fa-building-columns"></i>
                                Bank Transfer
                            </h3>

                            @if($owner->bank_name)

                                <p>
                                    <strong>Bank:</strong>
                                    {{ $owner->bank_name }}
                                </p>

                            @endif

                            @if($owner->bank_account_title)

                                <p>
                                    <strong>Account Title:</strong>
                                    {{ $owner->bank_account_title }}
                                </p>

                            @endif

                            @if($owner->bank_account_number)

                                <p>
                                    <strong>Account Number:</strong>
                                    {{ $owner->bank_account_number }}
                                </p>

                            @endif

                        </div>

                    @endif


                    @if(
                        !$owner->jazzcash_number &&
                        !$owner->easypaisa_number &&
                        !$owner->bank_account_number
                    )

                        <div class="notice">

                            <i class="fa-solid fa-circle-exclamation"></i>

                            The property owner has not added payment
                            details yet. Please contact the owner.

                        </div>

                    @endif

<!-- =========================================================
     PAYMENT SUBMISSION FORM
     ========================================================= -->

<div class="payment-submit-card">

    <div class="payment-submit-header">

        <div>
            <h2>
                <i class="fa-solid fa-file-invoice-dollar"></i>
                Submit Payment
            </h2>

            <p>
                After transferring the advance amount,
                submit your transaction details below.
            </p>
        </div>

    </div>


    <!-- Validation Errors -->

    @if ($errors->any())

        <div class="alert alert-danger">

            <strong>
                Please fix the following errors:
            </strong>

            <ul class="mb-0 mt-2">

                @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    <!-- Payment Form -->

    <form
        action="{{ route('payment.store', $booking->id) }}"
        method="POST"
        enctype="multipart/form-data"
    >

        @csrf


        <!-- Payment Method -->

        <div class="form-group">

            <label for="payment_method">
                Payment Method
            </label>

            <select
                name="payment_method"
                id="payment_method"
                class="form-control"
                required
            >

                <option value="">
                    Select Payment Method
                </option>

                @if($owner->jazzcash_number)

                    <option
                        value="jazzcash"
                        {{ old('payment_method') == 'jazzcash' ? 'selected' : '' }}
                    >
                        JazzCash
                    </option>

                @endif


                @if($owner->easypaisa_number)

                    <option
                        value="easypaisa"
                        {{ old('payment_method') == 'easypaisa' ? 'selected' : '' }}
                    >
                        EasyPaisa
                    </option>

                @endif


                @if(
                    $owner->bank_name ||
                    $owner->bank_account_number
                )

                    <option
                        value="bank_transfer"
                        {{ old('payment_method') == 'bank_transfer' ? 'selected' : '' }}
                    >
                        Bank Transfer
                    </option>

                @endif

            </select>

        </div>


        <!-- Transaction ID -->

        <div class="form-group">

            <label for="transaction_id">

                Transaction ID

            </label>

            <input
                type="text"
                name="transaction_id"
                id="transaction_id"
                class="form-control"
                value="{{ old('transaction_id') }}"
                placeholder="Enter your transaction ID"
                required
            >

            <small>
                Enter the transaction ID received after payment.
            </small>

        </div>


        <!-- Payment Screenshot -->

        <div class="form-group">

            <label for="payment_proof">

                Payment Screenshot

            </label>

            <input
                type="file"
                name="payment_proof"
                id="payment_proof"
                class="form-control"
                accept=".jpg,.jpeg,.png,.webp"
                required
            >

            <small>
                Upload a clear screenshot of your payment receipt.
                Maximum size: 2MB.
            </small>

        </div>


        <!-- Amount -->

        <div class="payment-amount-box">

            <span>
                Advance Payment
            </span>

            <strong>
                Rs. {{ number_format($amount, 2) }}
            </strong>

        </div>


        <!-- Submit -->

        <button
            type="submit"
            class="submit-payment-btn"
        >

            <i class="fa-solid fa-paper-plane"></i>

            Submit Payment

        </button>

    </form>

</div>
                    <div class="notice">

                        <strong>Important:</strong>

                        After transferring the payment, you will need
                        to enter your transaction ID and upload the
                        payment screenshot.

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

</body>

</html>