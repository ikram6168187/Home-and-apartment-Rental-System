<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Payments | Smart Rent</title>

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    >

    <link rel="stylesheet" href="{{ asset('css/admin_payments.css') }}">

</head>


<body>

    {{-- ADMIN SIDEBAR --}}
    @include('admin.admin_sidebar')


    <div class="main">

        {{-- TOPBAR --}}
        <div class="topbar">

            <div class="topbar-title">
                Payments
            </div>

            <div class="topbar-right">
                <span class="admin-access-badge">
                    <i class="fa-solid fa-shield-halved"></i>
                    Admin Access
                </span>
            </div>

        </div>


        <div class="content">


            <!-- =====================================================
                 ALERTS
                 ===================================================== -->

            @if(session('success'))

                <div class="alert-success">

                    <i class="fa-solid fa-circle-check"></i>

                    {{ session('success') }}

                </div>

            @endif


            @if(session('error'))

                <div class="alert-error">

                    <i class="fa-solid fa-circle-xmark"></i>

                    {{ session('error') }}

                </div>

            @endif


            <!-- =====================================================
                 STATS
                 ===================================================== -->

            <div class="stats-grid">


                <div class="stat-card">

                    <div class="stat-icon">

                        <i class="fa-solid fa-money-bill"></i>

                    </div>

                    <div>

                        <h3>
                            {{ $totalPayments }}
                        </h3>

                        <p>
                            Total Payments
                        </p>

                    </div>

                </div>


                <div class="stat-card">

                    <div class="stat-icon">

                        <i class="fa-solid fa-clock"></i>

                    </div>

                    <div>

                        <h3>
                            {{ $submittedPayments }}
                        </h3>

                        <p>
                            Pending Verification
                        </p>

                    </div>

                </div>


                <div class="stat-card">

                    <div class="stat-icon">

                        <i class="fa-solid fa-circle-check"></i>

                    </div>

                    <div>

                        <h3>
                            {{ $verifiedPayments }}
                        </h3>

                        <p>
                            Verified
                        </p>

                    </div>

                </div>


                <div class="stat-card">

                    <div class="stat-icon">

                        <i class="fa-solid fa-circle-xmark"></i>

                    </div>

                    <div>

                        <h3>
                            {{ $rejectedPayments }}
                        </h3>

                        <p>
                            Rejected
                        </p>

                    </div>

                </div>


                <div class="stat-card">

                    <div class="stat-icon">

                        <i class="fa-solid fa-wallet"></i>

                    </div>

                    <div>

                        <h3>
                            Rs. {{ number_format($totalAmount, 0) }}
                        </h3>

                        <p>
                            Verified Amount
                        </p>

                    </div>

                </div>

            </div>


            <!-- =====================================================
                 PAYMENT TABLE
                 ===================================================== -->

            <div class="table-card">


                <div class="table-header">

                    <h2>
                        Payment Records
                    </h2>

                    <span>
                        {{ $totalPayments }} payment(s)
                    </span>

                </div>


                <div class="table-wrapper">

                    <table>

                        <thead>

                            <tr>

                                <th>
                                    Renter
                                </th>

                                <th>
                                    Property
                                </th>

                                <th>
                                    Amount
                                </th>

                                <th>
                                    Method
                                </th>

                                <th>
                                    Transaction ID
                                </th>

                                <th>
                                    Proof
                                </th>

                                <th>
                                    Status
                                </th>

                                <th>
                                    Action
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @forelse($payments as $payment)

                                <tr>


                                    <!-- RENTER -->

                                    <td>

                                        <strong>
                                            {{ $payment->user->name ?? 'N/A' }}
                                        </strong>

                                    </td>


                                    <!-- PROPERTY -->

                                    <td>

                                        <div class="property-info">

                                            <strong>
                                                {{ $payment->booking->property->title ?? 'N/A' }}
                                            </strong>

                                            <small>
                                                Booking #{{ $payment->booking_id }}
                                            </small>

                                        </div>

                                    </td>


                                    <!-- AMOUNT -->

                                    <td>

                                        <strong>
                                            Rs.
                                            {{ number_format($payment->amount, 2) }}
                                        </strong>

                                    </td>


                                    <!-- METHOD -->

                                    <td>

                                        <span class="method">

                                            @if($payment->payment_method == 'jazzcash')

                                                <i class="fa-solid fa-mobile-screen"></i>
                                                JazzCash

                                            @elseif($payment->payment_method == 'easypaisa')

                                                <i class="fa-solid fa-mobile-screen"></i>
                                                EasyPaisa

                                            @else

                                                <i class="fa-solid fa-building-columns"></i>
                                                Bank Transfer

                                            @endif

                                        </span>

                                    </td>


                                    <!-- TRANSACTION -->

                                    <td>

                                        {{ $payment->transaction_id }}

                                    </td>


                                    <!-- PROOF -->

                                    <td>

                                        @if($payment->payment_proof)

                                            <a
                                                href="{{ asset('storage/' . $payment->payment_proof) }}"
                                                target="_blank"
                                            >

                                                <img
                                                    src="{{ asset('storage/' . $payment->payment_proof) }}"
                                                    alt="Payment Proof"
                                                    class="proof-image"
                                                >

                                            </a>

                                        @else

                                            <span class="no-action">
                                                No proof
                                            </span>

                                        @endif

                                    </td>


                                    <!-- STATUS -->

                                    <td>

                                        @if($payment->status == 'submitted')

                                            <span class="status status-submitted">

                                                <i class="fa-solid fa-clock"></i>

                                                Submitted

                                            </span>

                                        @elseif($payment->status == 'verified')

                                            <span class="status status-verified">

                                                <i class="fa-solid fa-circle-check"></i>

                                                Verified

                                            </span>

                                        @else

                                            <span class="status status-rejected">

                                                <i class="fa-solid fa-circle-xmark"></i>

                                                Rejected

                                            </span>

                                        @endif

                                    </td>


                                    <!-- ACTION -->

                                    <td>

                                        @if($payment->status == 'submitted')

                                            <div class="actions">

                                                <!-- VERIFY -->

                                                <form
                                                    action="{{ route('payment.verify', $payment->id) }}"
                                                    method="POST"
                                                >

                                                    @csrf
                                                    @method('PATCH')

                                                    <button
                                                        type="submit"
                                                        class="btn btn-verify"
                                                        onclick="return confirm('Verify this payment?')"
                                                    >

                                                        <i class="fa-solid fa-check"></i>

                                                        Verify

                                                    </button>

                                                </form>


                                                <!-- REJECT -->

                                                <button
                                                    type="button"
                                                    class="btn btn-reject"
                                                    onclick="toggleReject({{ $payment->id }})"
                                                >

                                                    <i class="fa-solid fa-xmark"></i>

                                                    Reject

                                                </button>

                                            </div>


                                            <form
                                                action="{{ route('payment.reject', $payment->id) }}"
                                                method="POST"
                                                id="reject-form-{{ $payment->id }}"
                                                class="reject-form"
                                            >

                                                @csrf
                                                @method('PATCH')

                                                <input
                                                    type="text"
                                                    name="rejection_reason"
                                                    placeholder="Rejection reason"
                                                    required
                                                >

                                                <button
                                                    type="submit"
                                                    class="btn btn-reject"
                                                >

                                                    Submit Rejection

                                                </button>

                                            </form>

                                        @else

                                            <span class="no-action">
                                                Processed
                                            </span>

                                        @endif

                                    </td>


                                </tr>

                            @empty

                                <tr>

                                    <td
                                        colspan="8"
                                        style="text-align:center; padding:50px;"
                                    >

                                        <i
                                            class="fa-solid fa-money-bill-wave"
                                            style="font-size:35px; color:#bbb; margin-bottom:12px;"
                                        ></i>

                                        <p style="color:#888;">
                                            No payment records found.
                                        </p>

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>


    <script>

    function toggleReject(paymentId)
    {
        const form =
            document.getElementById(
                'reject-form-' + paymentId
            );

        if (form.style.display === 'block') {

            form.style.display = 'none';

        } else {

            form.style.display = 'block';

        }
    }

    </script>

</body>

</html>