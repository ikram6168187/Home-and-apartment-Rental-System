<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications — Smart Rent</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"/>
<style>
* { margin:0; padding:0; box-sizing:border-box; font-family:'Segoe UI',Arial,sans-serif; }
body { display:flex; height:100vh; overflow:hidden; background:#f4f6f9; }

.sidebar { width:220px; min-width:220px; background:#2d2926; display:flex; flex-direction:column; height:100vh; position:fixed; left:0; top:0; }
.sidebar-logo { padding:20px; border-bottom:1px solid rgba(255,255,255,0.1); color:#fff; font-size:16px; font-weight:600; display:flex; align-items:center; gap:8px; }
.sidebar-user { padding:16px 20px; border-bottom:1px solid rgba(255,255,255,0.1); display:flex; align-items:center; gap:10px; }
.s-avatar { width:36px; height:36px; border-radius:50%; background:#c8a882; display:flex; align-items:center; justify-content:center; font-size:13px; font-weight:600; color:#2d2926; flex-shrink:0; overflow:hidden; }
.s-avatar img { width:100%; height:100%; object-fit:cover; }
.s-user-info p { color:#fff; font-size:13px; font-weight:500; margin:0; }
.s-user-info span { color:rgba(255,255,255,0.45); font-size:11px; }
.sidebar-nav { padding:12px 0; flex:1; overflow-y:auto; }
.nav-item { display:flex; align-items:center; gap:10px; padding:11px 20px; color:rgba(255,255,255,0.65); font-size:13px; text-decoration:none; transition:0.2s; position:relative; }
.nav-item:hover { background:rgba(255,255,255,0.08); color:#fff; }
.nav-item.active { background:rgba(255,255,255,0.12); color:#fff; border-left:3px solid #c8a882; }
.nav-item i { font-size:16px; width:18px; text-align:center; }
.nav-divider { height:1px; background:rgba(255,255,255,0.1); margin:8px 20px; }
.nav-item.danger { color:rgba(220,80,80,0.8); }
.nav-item.danger:hover { color:#ff6b6b; background:rgba(220,80,80,0.08); }
.nav-badge { background:#dc3545; color:#fff; font-size:10px; font-weight:700; padding:2px 6px; border-radius:10px; margin-left:auto; }

.main { margin-left:220px; flex:1; display:flex; flex-direction:column; height:100vh; overflow:hidden; }
.topbar { background:#fff; border-bottom:1px solid #eee; padding:13px 28px; display:flex; align-items:center; justify-content:space-between; flex-shrink:0; }
.topbar-title { font-size:16px; font-weight:600; color:#1a1a2e; }
.topbar-right { display:flex; align-items:center; gap:12px; }
.back-home { display:flex; align-items:center; gap:6px; font-size:13px; color:#666; background:#f5f5f5; border:1px solid #e0e0e0; padding:7px 16px; border-radius:20px; text-decoration:none; transition:0.2s; font-weight:500; }
.clear-all-btn { display:flex; align-items:center; gap:6px; font-size:13px; color:#c0392b; background:#fff0f0; border:1px solid #ffcdd2; padding:7px 16px; border-radius:20px; text-decoration:none; cursor:pointer; font-weight:500; transition:0.2s; }
.clear-all-btn:hover { background:#dc3545; color:#fff; border-color:#dc3545; }
.content { flex:1; overflow-y:auto; padding:28px; }

.alert-success { background:#f0fff4; border:1px solid #b2dfdb; color:#1b5e20; border-radius:10px; padding:12px 18px; margin-bottom:20px; font-size:13px; display:flex; align-items:center; gap:8px; }

/* FILTER TABS */
.filter-tabs { display:flex; gap:8px; margin-bottom:20px; }
.tab-btn { padding:7px 18px; border-radius:20px; border:1.5px solid #e0e0e0; background:#fff; font-size:12px; font-weight:600; color:#666; cursor:pointer; transition:0.2s; }
.tab-btn.active { background:#2d2926; color:#fff; border-color:#2d2926; }
.tab-count { background:rgba(255,255,255,0.2); padding:1px 7px; border-radius:10px; font-size:11px; margin-left:4px; }
.tab-btn:not(.active) .tab-count { background:#f0f0f0; color:#888; }

/* NOTIFICATION CARDS */
.notif-card {
    background:#fff; border:1px solid #eee;
    border-radius:14px; padding:16px 18px;
    display:flex; align-items:flex-start;
    gap:14px; margin-bottom:12px;
    transition:0.2s; position:relative;
}
.notif-card:hover { box-shadow:0 4px 16px rgba(0,0,0,0.07); }
.notif-card.unread { border-left:3px solid #2d2926; background:#fafaf8; }

.notif-icon {
    width:42px; height:42px; border-radius:12px;
    display:flex; align-items:center; justify-content:center;
    font-size:18px; flex-shrink:0;
}
.notif-icon.success { background:#e8f5e9; color:#2e7d32; }
.notif-icon.info    { background:#e3f2fd; color:#1565c0; }
.notif-icon.warning { background:#fff3e0; color:#e65100; }
.notif-icon.danger  { background:#fff0f0; color:#c0392b; }

.notif-body { flex:1; }
.notif-body h4 { font-size:14px; font-weight:600; color:#1a1a2e; margin:0 0 4px; }
.notif-body p  { font-size:13px; color:#666; margin:0 0 6px; line-height:1.5; }
.notif-time { font-size:11px; color:#aaa; display:flex; align-items:center; gap:4px; }

.notif-actions { display:flex; flex-direction:column; align-items:flex-end; gap:8px; flex-shrink:0; }
.unread-dot { width:8px; height:8px; border-radius:50%; background:#2d2926; }
.delete-btn {
    background:none; border:none; cursor:pointer;
    color:#ccc; font-size:14px; transition:0.2s;
    padding:4px;
}
.delete-btn:hover { color:#dc3545; }

/* EMPTY STATE */
.empty-state { text-align:center; padding:80px 20px; background:#fff; border-radius:14px; border:1px solid #eee; }
.empty-state i { font-size:56px; color:#ddd; display:block; margin-bottom:16px; }
.empty-state h3 { font-size:16px; color:#888; margin-bottom:8px; }
.empty-state p  { font-size:13px; color:#aaa; }

/* LOGOUT MODAL */
.logout-overlay { display:none; position:fixed; inset:0; background:rgba(0,0,0,0.55); z-index:99999; justify-content:center; align-items:center; }
.logout-overlay.active { display:flex; }
.logout-box { background:#fff; border-radius:16px; padding:36px 32px 28px; width:360px; text-align:center; box-shadow:0 16px 50px rgba(0,0,0,0.25); }
.logout-icon { width:60px; height:60px; border-radius:50%; background:#fff0f0; display:flex; align-items:center; justify-content:center; margin:0 auto 16px; font-size:26px; color:#dc3545; }
.logout-box h3 { font-size:20px; font-weight:700; color:#2b2d42; margin-bottom:8px; }
.logout-box p  { font-size:13px; color:#888; margin-bottom:24px; }
.logout-btns   { display:flex; gap:12px; }
.btn-cancel-lo { flex:1; padding:11px; border:1.5px solid #ddd; border-radius:30px; background:#fff; color:#555; font-size:14px; font-weight:600; cursor:pointer; }
.btn-logout-co { flex:1; padding:11px; border:none; border-radius:30px; background:#dc3545; color:#fff; font-size:14px; font-weight:600; cursor:pointer; }
</style>
</head>
<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <div class="sidebar-logo"><i class="fa-solid fa-house-chimney"></i> Smart Rent</div>
    <div class="sidebar-user">
        <div class="s-avatar">
            @if(Auth::user()->profile_picture)
                <img src="{{ asset('storage/'.Auth::user()->profile_picture) }}" alt="">
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
        <div class="nav-divider"></div>
        <a href="{{ route('notifications') }}" class="nav-item active">
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
<div class="main">
    <div class="topbar">
        <div class="topbar-title">
            Notifications
            @if($unreadNotifications > 0)
                <span style="background:#dc3545; color:#fff; font-size:11px; padding:2px 8px; border-radius:10px; margin-left:8px; font-weight:500;">
                    {{ $unreadNotifications }} unread
                </span>
            @endif
        </div>
        <div class="topbar-right">
            @if($notifications->count() > 0)
            <form action="{{ route('notifications.clear') }}" method="POST">
                @csrf @method('DELETE')
                <button type="submit" class="clear-all-btn">
                    <i class="fa-solid fa-trash"></i> Clear All
                </button>
            </form>
            @endif
            <a href="{{ route('home') }}" class="back-home"><i class="fa-solid fa-house"></i> Back to Home</a>
        </div>
    </div>

    <div class="content">

        @if(session('success'))
        <div class="alert-success"><i class="fa-solid fa-circle-check"></i> {{ session('success') }}</div>
        @endif

        <!-- FILTER TABS -->
        <div class="filter-tabs">
            <button class="tab-btn active" onclick="filterNotifs('all', this)">
                All <span class="tab-count">{{ $notifications->count() }}</span>
            </button>
            <button class="tab-btn" onclick="filterNotifs('unread', this)">
                Unread <span class="tab-count">{{ $notifications->where('is_read', false)->count() }}</span>
            </button>
            <button class="tab-btn" onclick="filterNotifs('success', this)">
                Success
            </button>
            <button class="tab-btn" onclick="filterNotifs('warning', this)">
                Alerts
            </button>
        </div>

        <!-- NOTIFICATIONS LIST -->
        @forelse($notifications as $notif)
        <div class="notif-card {{ !$notif->is_read ? 'unread' : '' }}" data-type="{{ $notif->type }}">

            <div class="notif-icon {{ $notif->type }}">
                <i class="fa-solid {{ $notif->icon }}"></i>
            </div>

            <div class="notif-body">
                <h4>{{ $notif->title }}</h4>
                <p>{{ $notif->message }}</p>
                <div class="notif-time">
                    <i class="fa-regular fa-clock"></i>
                    {{ $notif->created_at->diffForHumans() }}
                </div>
            </div>

            <div class="notif-actions">
                @if(!$notif->is_read)
                    <div class="unread-dot"></div>
                @endif
                <form action="{{ route('notifications.destroy', $notif->id) }}" method="POST">
                    @csrf @method('DELETE')
                    <button type="submit" class="delete-btn" title="Remove">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </form>
            </div>

        </div>
        @empty
        <div class="empty-state">
            <i class="fa-solid fa-bell-slash"></i>
            <h3>No notifications yet</h3>
            <p>You're all caught up! Activity on your listings will appear here.</p>
        </div>
        @endforelse

    </div>
</div>

<!-- LOGOUT MODAL -->
<div class="logout-overlay" id="logoutConfirm">
    <div class="logout-box">
        <div class="logout-icon"><i class="fa-solid fa-right-from-bracket"></i></div>
        <h3>Logout?</h3>
        <p>Are you sure you want to log out of your Smart Rent account?</p>
        <div class="logout-btns">
            <button class="btn-cancel-lo" onclick="closeLogoutConfirm()"><i class="fa-solid fa-xmark"></i> Cancel</button>
            <button class="btn-logout-co" onclick="document.getElementById('logout-form').submit()"><i class="fa-solid fa-right-from-bracket"></i> Logout</button>
        </div>
    </div>
</div>

<script>
function filterNotifs(type, btn) {
    document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    document.querySelectorAll('.notif-card').forEach(card => {
        if (type === 'all') {
            card.style.display = 'flex';
        } else if (type === 'unread') {
            card.style.display = card.classList.contains('unread') ? 'flex' : 'none';
        } else {
            card.style.display = card.dataset.type === type ? 'flex' : 'none';
        }
    });
}
function openLogoutConfirm()  { document.getElementById('logoutConfirm').classList.add('active'); }
function closeLogoutConfirm() { document.getElementById('logoutConfirm').classList.remove('active'); }
document.addEventListener('keydown', function(e) { if(e.key==='Escape') closeLogoutConfirm(); });
</script>
</body>
</html>