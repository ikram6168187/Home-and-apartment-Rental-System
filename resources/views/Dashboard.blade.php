<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard — Smart Rent</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"/>
<style>
* { margin:0; padding:0; box-sizing:border-box; font-family:'Segoe UI', Arial, sans-serif; }
body { display:flex; height:100vh; overflow:hidden; background:#f4f6f9; }

/* SIDEBAR */
.sidebar {
    width: 220px;
    min-width: 220px;
    background: #2d2926;
    display: flex;
    flex-direction: column;
    height: 100vh;
    position: fixed;
    left: 0; top: 0;
}
.sidebar-logo {
    padding: 20px;
    border-bottom: 1px solid rgba(255,255,255,0.1);
    color: #fff;
    font-size: 16px;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 8px;
}
.sidebar-user {
    padding: 16px 20px;
    border-bottom: 1px solid rgba(255,255,255,0.1);
    display: flex;
    align-items: center;
    gap: 10px;
}
.s-avatar {
    width: 36px; height: 36px;
    border-radius: 50%;
    background: #c8a882;
    display: flex; align-items: center; justify-content: center;
    font-size: 13px; font-weight: 600;
    color: #2d2926;
    flex-shrink: 0;
}
.s-user-info p  { color: #fff; font-size: 13px; font-weight: 500; margin:0; }
.s-user-info span { color: rgba(255,255,255,0.45); font-size: 11px; }

.sidebar-nav { padding: 12px 0; flex: 1; overflow-y: auto; }
.nav-item {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 11px 20px;
    color: rgba(255,255,255,0.65);
    font-size: 13px;
    text-decoration: none;
    transition: 0.2s;
    cursor: pointer;
}
.nav-item:hover { background: rgba(255,255,255,0.08); color: #fff; }
.nav-item.active {
    background: rgba(255,255,255,0.12);
    color: #fff;
    border-left: 3px solid #c8a882;
}
.nav-item i { font-size: 16px; width: 18px; text-align: center; }
.nav-divider { height: 1px; background: rgba(255,255,255,0.1); margin: 8px 20px; }
.nav-item.danger { color: rgba(220,80,80,0.8); }
.nav-item.danger:hover { color: #ff6b6b; background: rgba(220,80,80,0.08); }

/* MAIN */
.main {
    margin-left: 220px;
    flex: 1;
    display: flex;
    flex-direction: column;
    height: 100vh;
    overflow: hidden;
}

/* TOPBAR */
.topbar {
    background: #fff;
    border-bottom: 1px solid #eee;
    padding: 13px 28px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-shrink: 0;
}
.topbar-title { font-size: 16px; font-weight: 600; color: #1a1a2e; }
.topbar-right { display: flex; align-items: center; gap: 12px; }
.back-home {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 13px;
    color: #666;
    background: #f5f5f5;
    border: 1px solid #e0e0e0;
    padding: 7px 16px;
    border-radius: 20px;
    text-decoration: none;
    transition: 0.2s;
    font-weight: 500;
}
.back-home:hover { background: #eee; color: #333; }

/* CONTENT */
.content {
    flex: 1;
    overflow-y: auto;
    padding: 28px;
}

/* ALERTS */
.alert-success {
    background: #f0fff4;
    border: 1px solid #b2dfdb;
    color: #1b5e20;
    border-radius: 10px;
    padding: 12px 18px;
    margin-bottom: 20px;
    font-size: 13px;
}

/* STAT CARDS */
.stat-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 16px;
    margin-bottom: 28px;
}
.stat-card {
    background: #fff;
    border-radius: 12px;
    padding: 20px;
    border: 1px solid #eee;
    display: flex;
    align-items: center;
    gap: 16px;
}
.stat-icon {
    width: 48px; height: 48px;
    border-radius: 12px;
    display: flex; align-items: center; justify-content: center;
    font-size: 22px;
    flex-shrink: 0;
}
.stat-icon.brown  { background: #f5efe8; color: #8a6040; }
.stat-icon.green  { background: #e8f5e9; color: #2e7d32; }
.stat-icon.blue   { background: #e3f2fd; color: #1565c0; }
.stat-text p   { font-size: 12px; color: #888; margin: 0 0 4px; }
.stat-text h3  { font-size: 26px; font-weight: 700; color: #1a1a2e; margin: 0; }

/* SECTION HEADER */
.section-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 16px;
}
.section-header h2 { font-size: 15px; font-weight: 600; color: #1a1a2e; }
.add-btn {
    display: flex;
    align-items: center;
    gap: 6px;
    background: #2d2926;
    color: #fff;
    border: none;
    padding: 9px 18px;
    border-radius: 8px;
    font-size: 13px;
    font-weight: 500;
    cursor: pointer;
    text-decoration: none;
    transition: 0.2s;
}
.add-btn:hover { background: #1a1a1a; }

/* LISTING CARDS */
.listing-card {
    background: #fff;
    border: 1px solid #eee;
    border-radius: 12px;
    padding: 16px;
    display: flex;
    align-items: center;
    gap: 14px;
    margin-bottom: 12px;
    transition: 0.2s;
}
.listing-card:hover { box-shadow: 0 4px 16px rgba(0,0,0,0.07); }
.listing-thumb {
    width: 80px; height: 64px;
    border-radius: 8px;
    overflow: hidden;
    flex-shrink: 0;
    background: #f0ebe4;
    display: flex; align-items: center; justify-content: center;
}
.listing-thumb img { width:100%; height:100%; object-fit:cover; }
.listing-thumb i { font-size: 26px; color: #b09070; }
.listing-info { flex: 1; }
.listing-info h4 { font-size: 14px; font-weight: 600; color: #1a1a2e; margin: 0 0 4px; }
.listing-info p  { font-size: 12px; color: #888; margin: 0 0 8px; }
.badges { display: flex; gap: 6px; }
.badge {
    font-size: 11px;
    padding: 3px 10px;
    border-radius: 20px;
    font-weight: 500;
}
.badge-rent   { background: #e1f5ee; color: #0f6e56; }
.badge-active { background: #eaf3de; color: #3b6d11; }
.badge-inactive { background: #fff3e0; color: #e65100; }
.listing-right { text-align: right; }
.listing-price { font-size: 16px; font-weight: 700; color: #1a1a2e; }
.listing-price span { font-size: 11px; color: #888; font-weight: 400; display: block; }

/* EMPTY STATE */
.empty-state {
    text-align: center;
    padding: 60px 20px;
    background: #fff;
    border-radius: 12px;
    border: 1px solid #eee;
}
.empty-state i   { font-size: 48px; color: #ddd; margin-bottom: 16px; display: block; }
.empty-state h3  { font-size: 16px; color: #888; margin-bottom: 8px; }
.empty-state p   { font-size: 13px; color: #aaa; margin-bottom: 20px; }

/* LOGOUT MODAL */
.logout-overlay {
    display: none;
    position: fixed; inset: 0;
    background: rgba(0,0,0,0.5);
    z-index: 9999;
    justify-content: center;
    align-items: center;
}
.logout-overlay.active { display: flex; }
.logout-box {
    background: #fff;
    border-radius: 16px;
    padding: 36px 32px 28px;
    width: 360px;
    text-align: center;
    box-shadow: 0 16px 50px rgba(0,0,0,0.2);
}
.logout-icon {
    width: 60px; height: 60px;
    border-radius: 50%;
    background: #fff0f0;
    display: flex; align-items: center; justify-content: center;
    margin: 0 auto 16px;
    font-size: 26px; color: #dc3545;
}
.logout-box h3 { font-size: 20px; font-weight: 700; color: #1a1a2e; margin-bottom: 8px; }
.logout-box p  { font-size: 13px; color: #888; margin-bottom: 24px; }
.logout-btns   { display: flex; gap: 12px; }
.btn-cancel {
    flex: 1; padding: 11px;
    border: 1px solid #ddd; border-radius: 30px;
    background: #fff; color: #555;
    font-size: 14px; font-weight: 600;
    cursor: pointer;
}
.btn-cancel:hover { background: #f5f5f5; }
.btn-logout-confirm {
    flex: 1; padding: 11px;
    border: none; border-radius: 30px;
    background: #dc3545; color: #fff;
    font-size: 14px; font-weight: 600;
    cursor: pointer;
}
.btn-logout-confirm:hover { background: #b02a37; }
</style>
</head>
<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <div class="sidebar-logo">
        <i class="fa-solid fa-house-chimney"></i> Smart Rent
    </div>
    <div class="sidebar-user">
        <div class="s-avatar">
            {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
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