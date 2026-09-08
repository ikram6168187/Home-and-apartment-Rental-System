<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Rent - Admin Sidebar</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <!-- Bootstrap (Optional) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Tumhara CSS -->
    <link rel="stylesheet" href="{{ asset('css/admin_sidebar.css') }}">

    {{-- Individual admin pages (blogs, users, etc.) push their own CSS here --}}
    @stack('styles')
</head>

<body>

    <!-- SIDEBAR -->
<div class="sidebar">
    <div class="sidebar-logo">
        <div class="logo-icon">SR</div>
        <div class="logo-text">
            <h3>Smart Rent</h3>
            <span>Admin Panel</span>
        </div>
    </div>
    <div class="sidebar-user">
        <div class="s-avatar">AD</div>
        <div class="s-user-info">
            <p>Admin</p>
            <span class="admin-badge"><i class="fa-solid fa-shield-halved icon-xs"></i> Super Admin</span>
        </div>
    </div>
    <nav class="sidebar-nav">
        <div class="nav-section">Overview</div>
        <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="fa-solid fa-gauge"></i> Dashboard
        </a>
        <div class="nav-section">Manage</div>
        <a href="{{ route('admin.users') }}" class="nav-item {{ request()->routeIs('admin.users') ? 'active' : '' }}">
            <i class="fa-solid fa-users"></i> Users
        </a>
        <a href="{{ route('admin.properties') }}" class="nav-item {{ request()->routeIs('admin.properties') ? 'active' : '' }}">
            <i class="fa-solid fa-building"></i> Properties
        </a>
        <a href="{{ route('admin.bookings') }}" class="nav-item {{ request()->routeIs('admin.bookings') ? 'active' : '' }}">
            <i class="fa-solid fa-calendar-check"></i> Bookings
            @if(isset($pendingBookings) && $pendingBookings > 0)
                <span class="nav-badge">{{ $pendingBookings }}</span>
            @endif
        </a>
        <a href="{{ route('admin.messages') }}" class="nav-item {{ request()->routeIs('admin.messages') ? 'active' : '' }}">
            <i class="fa-solid fa-envelope"></i> Messages
            @if(isset($unreadMessages) && $unreadMessages > 0)
                <span class="nav-badge">{{ $unreadMessages }}</span>
            @endif
        </a>
        @php
    $pendingServiceRequestsCount = \App\Models\ServiceRequest::where('status', 'pending')->count();
@endphp

<a href="{{ route('admin.service-requests') }}"
   class="nav-item {{ request()->routeIs('admin.service-requests') ? 'active' : '' }}">

    <i class="fa-solid fa-screwdriver-wrench"></i>
    Service Requests

    @if($pendingServiceRequestsCount > 0)
        <span class="nav-badge">
            {{ $pendingServiceRequestsCount }}
        </span>
    @endif

        </a>
        <a href="{{ route('admin.blogs') }}" 
        class="nav-item {{ request()->routeIs('admin.blogs*') ? 'active' : '' }}">
            
            <i class="fa-solid fa-blog"></i> Blogs

        </a>
      

        <div class="nav-divider"></div>
        <form action="{{ route('logout') }}" method="POST" id="logout-form" class="hidden-form">@csrf</form>
        <a href="#" class="nav-item danger" onclick="event.preventDefault(); openLogoutConfirm();">
            <i class="fa-solid fa-right-from-bracket"></i> Logout
        </a>
    </nav>
</div>

<!-- LOGOUT MODAL -->
<div class="logout-overlay" id="logoutConfirm">
    <div class="logout-box">
        <div class="logout-icon"><i class="fa-solid fa-right-from-bracket"></i></div>
        <h3>Logout?</h3>
        <p>Are you sure you want to log out of the admin panel?</p>
        <div class="logout-btns">
            <button class="btn-cancel-lo" onclick="closeLogoutConfirm()">Cancel</button>
            <button class="btn-logout-co" onclick="document.getElementById('logout-form').submit()">Logout</button>
        </div>
    </div>
</div>

       <script>
function openLogoutConfirm()  { document.getElementById('logoutConfirm').classList.add('active'); }
function closeLogoutConfirm() { document.getElementById('logoutConfirm').classList.remove('active'); }
document.addEventListener('keydown', function(e) { if(e.key==='Escape') closeLogoutConfirm(); });
</script>


</body>
</html>