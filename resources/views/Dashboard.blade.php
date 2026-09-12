<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard — Smart Rent</title>
    <!-- FontAwesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"/>
    <!-- External CSS Link -->
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
</head>
</head>
<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <div class="sidebar-logo">
        <i class="fa-solid fa-house-chimney"></i> Smart Rent
    </div>
    <div class="sidebar-user">
        <div class="s-avatar">
            @if(Auth::user()->profile_picture)
                <img src="{{ asset('storage/'.Auth::user()->profile_picture) }}" alt="Profile Picture">
            @else
                {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
            @endif
        </div>
        <div class="s-user-info">
            <p>{{ Auth::user()->name }}</p>
            <span>Property Owner</span>
        </div>
    </div>
    <nav class="sidebar-nav">
        <a href="{{ route('dashboard') }}" class="nav-item active">
            <i class="fa-solid fa-gauge"></i> Dashboard
        </a>
        <a href="{{ route('my.listings') }}" class="nav-item">
            <i class="fa-solid fa-building"></i> My Listings
        </a>
        <a href="{{ route('property.create') }}" class="nav-item">
            <i class="fa-solid fa-circle-plus"></i> Add Property
        </a>
        <a href="{{ route('booking.requests') }}" class="nav-item">
            <i class="fa-solid fa-calendar-check"></i> Booking Requests
            @if(isset($pendingBookings) && $pendingBookings > 0)
                <span class="nav-badge">{{ $pendingBookings }}</span>
            @endif
        </a>
        <a href="{{ route('my.bookings') }}" class="nav-item">
            <i class="fa-solid fa-calendar-days"></i> My Bookings
        </a>
        <a href="{{ route('notifications') }}" class="nav-item">
            <i class="fa-solid fa-bell"></i> Notifications
            @if(isset($unreadNotifications) && $unreadNotifications > 0)
                <span class="nav-badge">{{ $unreadNotifications }}</span>
            @endif
        </a>
        
        <div class="nav-divider"></div>
        <a href="{{ route('profile') }}" class="nav-item">
            <i class="fa-solid fa-user"></i> Profile
        </a>
        <a href="{{ route('settings') }}" class="nav-item">
            <i class="fa-solid fa-gear"></i> Settings
        </a>
        <div class="nav-divider"></div>
        <form action="{{ route('logout') }}" method="POST" id="logout-form" style="display:none;">
            @csrf
        </form>
        <a href="#" class="nav-item danger" onclick="event.preventDefault(); openLogoutConfirm();">
            <i class="fa-solid fa-right-from-bracket"></i> Logout
        </a>
    </nav>
</div>

<!-- MAIN -->
<div class="main">

    <!-- TOPBAR -->
    <div class="topbar">
        <div class="topbar-title">Dashboard</div>
        <div class="topbar-right">
            <a href="{{ route('home') }}" class="back-home">
                <i class="fa-solid fa-house"></i> Back to Home
            </a>
        </div>
    </div>

    <!-- CONTENT -->
    <div class="content">

        @if(session('success'))
        <div class="alert-success">
            <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
        </div>
        @endif

        <!-- STAT CARDS -->
        <div class="stat-grid">
            <div class="stat-card">
                <div class="stat-icon brown"><i class="fa-solid fa-building"></i></div>
                <div class="stat-text">
                    <p>Total Listings</p>
                    <h3>{{ $total }}</h3>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon green"><i class="fa-solid fa-circle-check"></i></div>
                <div class="stat-text">
                    <p>Active</p>
                    <h3>{{ $active }}</h3>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon blue"><i class="fa-solid fa-eye"></i></div>
                <div class="stat-text">
                    <p>Total Views</p>
                    <h3>0</h3>
                </div>
            </div>
        </div>

        <!-- RECENT LISTINGS -->
        <div class="section-header">
            <h2>Recent Listings</h2>
            <a href="{{ route('property.create') }}" class="add-btn">
                <i class="fa-solid fa-plus"></i> Add Property
            </a>
        </div>

        @forelse($recent as $property)
        <div class="listing-card">
            <div class="listing-thumb">
                @if($property->image)
                    <img src="{{ asset('storage/' . $property->image) }}" alt="{{ $property->title }}">
                @else
                    <i class="fa-solid fa-building"></i>
                @endif
            </div>
            <div class="listing-info">
                <h4>{{ $property->title }}</h4>
                <p><i class="fa-solid fa-location-dot"></i> {{ $property->location }}, {{ $property->city }}</p>
                <div class="badges">
                    <span class="badge badge-rent">For Rent</span>
                    <span class="badge {{ $property->status == 'active' ? 'badge-active' : 'badge-inactive' }}">
                        {{ ucfirst($property->status) }}
                    </span>
                </div>
            </div>
            <div class="listing-right">
                <div class="listing-price">
                    ₨ {{ number_format($property->price) }}
                    <span>per month</span>
                </div>
                <a href="{{ route('property.edit', $property->id) }}" class="btn-edit">
                    <i class="fa-solid fa-pen-to-square"></i> Edit
                </a>
            </div>
        </div>
        @empty
        <div class="empty-state">
            <i class="fa-solid fa-building-circle-xmark"></i>
            <h3>No listings yet</h3>
            <p>You haven't added any properties. Start by adding your first listing.</p>
            <a href="{{ route('property.create') }}" class="add-btn" style="display:inline-flex;">
                <i class="fa-solid fa-plus"></i> Add Your First Property
            </a>
        </div>
        @endforelse

    </div>
</div>

<!-- LOGOUT CONFIRM MODAL -->
<div class="logout-overlay" id="logoutConfirm">
    <div class="logout-box">
        <div class="logout-icon">
            <i class="fa-solid fa-right-from-bracket"></i>
        </div>
        <h3>Logout?</h3>
        <p>Are you sure you want to log out of your Smart Rent account?</p>
        <div class="logout-btns">
            <button class="btn-cancel" onclick="closeLogoutConfirm()">
                <i class="fa-solid fa-xmark"></i> Cancel
            </button>
            <button class="btn-logout-confirm" onclick="document.getElementById('logout-form').submit();">
                <i class="fa-solid fa-right-from-bracket"></i> Logout
            </button>
        </div>
    </div>
</div>

<script>
function openLogoutConfirm() {
    document.getElementById('logoutConfirm').classList.add('active');
}
function closeLogoutConfirm() {
    document.getElementById('logoutConfirm').classList.remove('active');
}
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closeLogoutConfirm();
});
</script>

</body>
</html>