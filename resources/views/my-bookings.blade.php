<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Bookings — Smart Rent</title>
    <!-- FontAwesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"/>
    <!-- External CSS Linked -->
    <link rel="stylesheet" href="{{ asset('css/my_bookings.css') }}">
</head>
<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <div class="sidebar-logo"><i class="fa-solid fa-house-chimney"></i> Smart Rent</div>
    <div class="sidebar-user">
        <div class="s-avatar">
            @if(Auth::user()->profile_picture)
                <img src="{{ asset('storage/'.Auth::user()->profile_picture) }}" alt="User Profile">
            @else
                {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
            @endif
        </div>
        <div class="s-user-info">
            <p>{{ Auth::user()->name }}</p>
            <span>{{ ucfirst(Auth::user()->role) }}</span>
        </div>
    </div>
    <nav class="sidebar-nav">
        <a href="{{ route('dashboard') }}" class="nav-item"><i class="fa-solid fa-gauge"></i> Dashboard</a>
        <a href="{{ route('my.listings') }}" class="nav-item"><i class="fa-solid fa-building"></i> My Listings</a>
        <a href="{{ route('property.create') }}" class="nav-item"><i class="fa-solid fa-circle-plus"></i> Add Property</a>
        <a href="{{ route('booking.requests') }}" class="nav-item"><i class="fa-solid fa-calendar-check"></i> Booking Requests</a>

        <a href="{{ route('my.bookings') }}" class="nav-item active">
            <i class="fa-solid fa-calendar-days"></i> My Bookings
        </a>

        <div class="nav-divider"></div>
        <a href="{{ route('notifications') }}" class="nav-item">
            <i class="fa-solid fa-bell"></i> Notifications
            @if($unreadNotifications > 0)
                <span class="nav-badge">{{ $unreadNotifications }}</span>
            @endif
        </a>
        <a href="{{ route('profile') }}" class="nav-item"><i class="fa-solid fa-user"></i> Profile</a>
        <a href="{{ route('settings') }}" class="nav-item"><i class="fa-solid fa-gear"></i> Settings</a>
        <div class="nav-divider"></div>
        <form action="{{ route('logout') }}" method="POST" id="logout-form" style="display:none;">@csrf</form>
        <a href="#" class="nav-item danger" onclick="event.preventDefault(); openLogoutConfirm();"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
    </nav>
</div>

<!-- MAIN -->
<div class="topbar">

    <div class="topbar-title">
        My Bookings
    </div>

    <div style="display:flex; align-items:center; gap:10px;">

        <a
            href="{{ route('payment.history') }}"
            class="payment-history-btn"
        >

            <i class="fa-solid fa-clock-rotate-left"></i>

            Payment History

        </a>


        <a
            href="{{ route('home') }}"
            class="back-home"
        >

            <i class="fa-solid fa-house"></i>

            Back to Home

        </a>

    </div>

</div>

    <div class="content">

        @if(session('success'))
        <div class="alert-success"><i class="fa-solid fa-circle-check"></i> {{ session('success') }}</div>
        @endif

        <!-- STATS -->
        <div class="stat-row">

            <div class="stat-card">
                <div class="stat-icon orange">
                    <i class="fa-solid fa-clock"></i>
                </div>

                <div class="stat-info">
                    <h3>{{ $pending }}</h3>
                    <p>Pending</p>
                </div>
            </div>


            <div class="stat-card">
                <div class="stat-icon blue">
                    <i class="fa-solid fa-wallet"></i>
                </div>

                <div class="stat-info">
                    <h3>{{ $approved }}</h3>
                    <p>Payment Required</p>
                </div>
            </div>


            <div class="stat-card">
                <div class="stat-icon yellow">
                    <i class="fa-solid fa-hourglass-half"></i>
                </div>

                <div class="stat-info">
                    <h3>{{ $paymentSubmitted }}</h3>
                    <p>Payment Verification</p>
                </div>
            </div>


            <div class="stat-card">
                <div class="stat-icon green">
                    <i class="fa-solid fa-circle-check"></i>
                </div>

                <div class="stat-info">
                    <h3>{{ $confirmed }}</h3>
                    <p>Confirmed</p>
                </div>
            </div>


            <div class="stat-card">
                <div class="stat-icon red">
                    <i class="fa-solid fa-circle-xmark"></i>
                </div>

                <div class="stat-info">
                    <h3>{{ $cancelled }}</h3>
                    <p>Cancelled</p>
                </div>
            </div>

        </div>

        <!-- FILTER -->
        <div class="filter-bar">

            <button class="filter-btn active"
                    onclick="filterBookings('all', this)">
                All ({{ $bookings->count() }})
            </button>

            <button class="filter-btn"
                    onclick="filterBookings('pending', this)">
                Pending ({{ $pending }})
            </button>

            <button class="filter-btn"
                    onclick="filterBookings('approved', this)">
                Payment Required ({{ $approved }})
            </button>

            <button class="filter-btn"
                    onclick="filterBookings('payment_submitted', this)">
                Payment Verification ({{ $paymentSubmitted }})
            </button>

            <button class="filter-btn"
                    onclick="filterBookings('confirmed', this)">
                Confirmed ({{ $confirmed }})
            </button>

            <button class="filter-btn"
                    onclick="filterBookings('cancelled', this)">
                Cancelled ({{ $cancelled }})
            </button>

        </div>

        <!-- BOOKINGS LIST -->
        @forelse($bookings as $booking)
        <div class="booking-card" data-status="{{ $booking->status }}">

            <div class="booking-top">
                <div class="booking-thumb">
                    @if($booking->property->image)
                        <img src="{{ asset('storage/'.$booking->property->image) }}" alt="Property Image">
                    @else
                        <i class="fa-solid fa-building"></i>
                    @endif
                </div>

                <div class="booking-info">
                    <h4>{{ $booking->property->title }}</h4>
                    <p class="loc"><i class="fa-solid fa-location-dot"></i> {{ $booking->property->location }}, {{ $booking->property->city }}</p>
                    <div class="booking-meta">
                        <div class="meta-item"><i class="fa-solid fa-calendar"></i> {{ $booking->check_in->format('d M Y') }} → {{ $booking->check_out->format('d M Y') }}</div>
                        <div class="meta-item"><i class="fa-solid fa-moon"></i> {{ $booking->check_in->diffInDays($booking->check_out) }} nights</div>
                        <div class="meta-item"><i class="fa-solid fa-users"></i> {{ $booking->guests }} guests</div>
                    </div>
                </div>

                <div class="booking-right">
                    <div class="booking-price">
                        ₨ {{ number_format($booking->property->price) }}
                        <span>per month</span>
                    </div>
                    <span class="badge badge-{{ $booking->status }}" style="display:inline-block; margin-top:8px;">
                        {{ ucfirst($booking->status) }}
                    </span>
                </div>
            </div>

            <!-- OWNER INFO -->
            <div class="renter-row">
                <div class="renter-avatar">
                    @if($booking->property->user->profile_picture)
                        <img src="{{ asset('storage/'.$booking->property->user->profile_picture) }}" alt="Owner Profile">
                    @else
                        {{ strtoupper(substr($booking->property->user->name, 0, 2)) }}
                    @endif
                </div>
                <div class="renter-info">
                    <h5>{{ $booking->property->user->name }} <span style="font-weight:400; color:#aaa;">(Owner)</span></h5>
                    <p>{{ $booking->property->user->email }}
                        @if($booking->property->user->phone) · {{ $booking->property->user->phone }} @endif
                    </p>
                </div>
                <div style="font-size:11px; color:#aaa;">
                    Requested {{ $booking->created_at->diffForHumans() }}
                </div>
            </div>

            @if($booking->message)
            <div class="message-box">
                <i class="fa-regular fa-comment" style="color:#aaa;"></i>
                "{{ $booking->message }}"
            </div>
            @endif

            <!-- STATUS / PAYMENT ACTIONS -->
            @if($booking->status == 'pending')

                <div class="action-btns">

                    <span class="btn-pending-label">
                        <i class="fa-solid fa-clock"></i>
                        Waiting for owner's response
                    </span>

                </div>

            @elseif($booking->status == 'approved')

                <div class="action-btns">

                    <a
                        href="{{ route('payment.create', $booking->id) }}"
                        class="btn-payment"
                    >

                        <i class="fa-solid fa-credit-card"></i>

                        @if(
                            $booking->payment
                            && $booking->payment->status == 'rejected'
                        )

                            Make Payment Again

                        @else

                            Make Payment

                        @endif

                    </a>


                    @if(
                        $booking->payment
                        && $booking->payment->status == 'rejected'
                    )

                        <span class="btn-rejected-label">

                            <i class="fa-solid fa-circle-xmark"></i>

                            Previous Payment Rejected

                        </span>

                    @else

                        <span class="btn-approved-label">

                            <i class="fa-solid fa-circle-check"></i>

                            Booking Approved

                        </span>

                    @endif

                </div>

            @elseif($booking->status == 'payment_submitted')

                <div class="action-btns">

                    <span class="btn-payment-label">
                        <i class="fa-solid fa-hourglass-half"></i>
                        Payment Submitted — Under Verification
                    </span>

                </div>

            @elseif($booking->status == 'confirmed')

                <div class="action-btns">

                    <span class="btn-confirmed-label">
                        <i class="fa-solid fa-circle-check"></i>
                        Booking Confirmed
                    </span>

                </div>

            @elseif($booking->status == 'cancelled')

                <div class="action-btns">

                    <span class="btn-cancelled-label">
                        <i class="fa-solid fa-ban"></i>
                        Booking Cancelled
                    </span>

                </div>

            @endif
        </div>
        @empty
        <div class="empty-state">
            <i class="fa-solid fa-calendar-xmark"></i>
            <h3>No bookings yet</h3>
            <p>Bookings you make on properties will appear here.</p>
        </div>
        @endforelse

    </div>

<!-- LOGOUT MODAL -->
<div class="logout-overlay" id="logoutConfirm">
    <div class="logout-box">
        <div class="logout-icon"><i class="fa-solid fa-right-from-bracket"></i></div>
        <h3>Logout?</h3>
        <p>Are you sure you want to log out of your Smart Rent account?</p>
        <div class="logout-btns">
            <button class="btn-cancel-lo" onclick="closeLogoutConfirm()">Cancel</button>
            <button class="btn-logout-co" onclick="document.getElementById('logout-form').submit()">Logout</button>
        </div>
    </div>
</div>
<script>
function filterBookings(status, btn) {
    document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    document.querySelectorAll('.booking-card').forEach(card => {
        card.style.display = (status === 'all' || card.dataset.status === status) ? 'block' : 'none';
    });
}

function openLogoutConfirm() { 
    document.getElementById('logoutConfirm').classList.add('active'); 
}

function closeLogoutConfirm() { 
    document.getElementById('logoutConfirm').classList.remove('active'); 
}

document.addEventListener('keydown', e => { 
    if (e.key === 'Escape') closeLogoutConfirm(); 
});
</script>
</body>
</html>