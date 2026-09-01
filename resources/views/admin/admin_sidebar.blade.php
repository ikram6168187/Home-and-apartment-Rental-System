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
    <style>
        
* { margin:0; padding:0; box-sizing:border-box; font-family:'Segoe UI',Arial,sans-serif; }
body { display:flex; height:100vh; overflow:hidden; background:#f0ece8; }

.sidebar { width:220px; min-width:220px; background:#0f0e0d; display:flex; flex-direction:column; height:100vh; position:fixed; left:0; top:0; }
.sidebar-logo { padding:18px 16px; border-bottom:1px solid rgba(255,255,255,0.06); display:flex; align-items:center; gap:10px; }
.logo-icon { width:34px; height:34px; border-radius:10px; background:linear-gradient(135deg,#c8a882,#8a6040); display:flex; align-items:center; justify-content:center; font-size:14px; font-weight:700; color:#fff; flex-shrink:0; }
.logo-text h3 { font-size:14px; font-weight:700; color:#fff; margin:0; }
.logo-text span { font-size:10px; color:rgba(255,255,255,0.35); }
.sidebar-user { padding:14px 16px; border-bottom:1px solid rgba(255,255,255,0.06); display:flex; align-items:center; gap:10px; }
.s-avatar { width:34px; height:34px; border-radius:50%; background:linear-gradient(135deg,#c8a882,#8a6040); display:flex; align-items:center; justify-content:center; font-size:12px; font-weight:700; color:#fff; flex-shrink:0; }
.s-user-info p { color:#fff; font-size:12px; font-weight:600; margin:0 0 3px; }
.admin-badge { background:rgba(200,168,130,0.15); color:#c8a882; padding:2px 8px; border-radius:10px; font-size:10px; font-weight:600; border:1px solid rgba(200,168,130,0.25); }
.sidebar-nav { padding:10px 0; flex:1; overflow-y:auto; }
.nav-section { font-size:9px; font-weight:700; color:rgba(255,255,255,0.25); text-transform:uppercase; letter-spacing:1px; padding:10px 16px 4px; }
.nav-item { display:flex; align-items:center; gap:9px; padding:9px 12px; margin:2px 8px; border-radius:8px; color:rgba(255,255,255,0.5); font-size:13px; text-decoration:none; transition:0.2s; }
.nav-item:hover { background:rgba(255,255,255,0.06); color:#fff; }
.nav-item.active { background:rgba(200,168,130,0.12); color:#c8a882; border:1px solid rgba(200,168,130,0.2); }
.nav-item i { font-size:16px; width:18px; text-align:center; }
.nav-divider { height:1px; background:rgba(255,255,255,0.06); margin:6px 16px; }
.nav-item.danger { color:rgba(220,80,80,0.7); }
.nav-item.danger:hover { color:#ff6b6b; background:rgba(220,80,80,0.08); }
.nav-badge { background:#dc3545; color:#fff; font-size:10px; font-weight:700; padding:2px 6px; border-radius:10px; margin-left:auto; }

.main { margin-left:220px; flex:1; display:flex; flex-direction:column; height:100vh; overflow:hidden; }
.topbar { background:#fff; border-bottom:1px solid #eee; padding:13px 28px; display:flex; align-items:center; justify-content:space-between; flex-shrink:0; }
.topbar-title { font-size:16px; font-weight:700; color:#1a1209; }
.topbar-right { display:flex; align-items:center; gap:12px; }
.admin-access-badge { background:#fff3e0; color:#e65100; padding:6px 14px; border-radius:20px; font-size:12px; font-weight:600; border:1px solid #ffe0b2; display:flex; align-items:center; gap:5px; }
.content { flex:1; overflow-y:auto; padding:24px 28px; }

/* ALERTS */
.alert-success { background:#f0fff4; border:1px solid #b2dfdb; color:#1b5e20; border-radius:10px; padding:12px 18px; margin-bottom:20px; font-size:13px; display:flex; align-items:center; gap:8px; }
.alert-error   { background:#fff0f0; border:1px solid #ffcdd2; color:#c0392b; border-radius:10px; padding:12px 18px; margin-bottom:20px; font-size:13px; }

/* LOGOUT MODAL */
.logout-overlay { display:none; position:fixed; inset:0; background:rgba(0,0,0,0.55); z-index:99999; justify-content:center; align-items:center; }
.logout-overlay.active { display:flex; }
.logout-box { background:#fff; border-radius:16px; padding:36px 32px 28px; width:360px; text-align:center; box-shadow:0 16px 50px rgba(0,0,0,0.25); }
.logout-icon { width:60px; height:60px; border-radius:50%; background:#fff0f0; display:flex; align-items:center; justify-content:center; margin:0 auto 16px; font-size:26px; color:#dc3545; }
.logout-box h3 { font-size:20px; font-weight:700; color:#1a1209; margin-bottom:8px; }
.logout-box p  { font-size:13px; color:#888; margin-bottom:24px; }
.logout-btns   { display:flex; gap:12px; }
.btn-cancel-lo { flex:1; padding:11px; border:1.5px solid #ddd; border-radius:30px; background:#fff; color:#555; font-size:14px; font-weight:600; cursor:pointer; }
.btn-logout-co { flex:1; padding:11px; border:none; border-radius:30px; background:#dc3545; color:#fff; font-size:14px; font-weight:600; cursor:pointer; }

    </style>
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
            <span class="admin-badge"><i class="fa-solid fa-shield-halved" style="font-size:9px;"></i> Super Admin</span>
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
        <form action="{{ route('logout') }}" method="POST" id="logout-form" style="display:none;">@csrf</form>
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