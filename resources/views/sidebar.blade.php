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
        <a href="{{ route('dashboard') }}" class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="fa-solid fa-gauge"></i> Dashboard
        </a>
        <a href="{{ route('my.listings') }}" class="nav-item {{ request()->routeIs('my.listings') ? 'active' : '' }}">
            <i class="fa-solid fa-building"></i> My Listings
        </a>
        <a href="{{ route('property.create') }}" class="nav-item {{ request()->routeIs('property.create') ? 'active' : '' }}">
            <i class="fa-solid fa-circle-plus"></i> Add Property
        </a>
        <a href="{{ route('booking.requests') }}" class="nav-item {{ request()->routeIs('booking.requests') ? 'active' : '' }}">
            <i class="fa-solid fa-calendar-check"></i> Booking Requests
            @if(isset($pendingBookings) && $pendingBookings > 0)
                <span class="nav-badge">{{ $pendingBookings }}</span>
            @endif
        </a>
        <a href="{{ route('my.bookings') }}" class="nav-item {{ request()->routeIs('my.bookings') ? 'active' : '' }}">
            <i class="fa-solid fa-calendar-days"></i> My Bookings
        </a>
        <a href="{{ route('notifications') }}" class="nav-item {{ request()->routeIs('notifications') ? 'active' : '' }}">
            <i class="fa-solid fa-bell"></i> Notifications
            @if(isset($unreadNotifications) && $unreadNotifications > 0)
                <span class="nav-badge">{{ $unreadNotifications }}</span>
            @endif
        </a>

        <div class="nav-divider"></div>
        <a href="{{ route('profile') }}" class="nav-item {{ request()->routeIs('profile') ? 'active' : '' }}">
            <i class="fa-solid fa-user"></i> Profile
        </a>
        <a href="{{ route('settings') }}" class="nav-item {{ request()->routeIs('settings') ? 'active' : '' }}">
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