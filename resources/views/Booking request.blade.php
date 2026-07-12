<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Requests — Smart Rent</title>
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
.nav-item { display:flex; align-items:center; gap:10px; padding:11px 20px; color:rgba(255,255,255,0.65); font-size:13px; text-decoration:none; transition:0.2s; }
.nav-item:hover { background:rgba(255,255,255,0.08); color:#fff; }
.nav-item.active { background:rgba(255,255,255,0.12); color:#fff; border-left:3px solid #c8a882; }
.nav-item i { font-size:16px; width:18px; text-align:center; }
.nav-divider { height:1px; background:rgba(255,255,255,0.1); margin:8px 20px; }
.nav-item.danger { color:rgba(220,80,80,0.8); }
.nav-badge { background:#dc3545; color:#fff; font-size:10px; font-weight:700; padding:2px 6px; border-radius:10px; margin-left:auto; }

.main { margin-left:220px; flex:1; display:flex; flex-direction:column; height:100vh; overflow:hidden; }
.topbar { background:#fff; border-bottom:1px solid #eee; padding:13px 28px; display:flex; align-items:center; justify-content:space-between; flex-shrink:0; }
.topbar-title { font-size:16px; font-weight:600; color:#1a1a2e; }
.back-home { display:flex; align-items:center; gap:6px; font-size:13px; color:#666; background:#f5f5f5; border:1px solid #e0e0e0; padding:7px 16px; border-radius:20px; text-decoration:none; font-weight:500; }
.content { flex:1; overflow-y:auto; padding:28px; }

.alert-success { background:#f0fff4; border:1px solid #b2dfdb; color:#1b5e20; border-radius:10px; padding:12px 18px; margin-bottom:20px; font-size:13px; display:flex; align-items:center; gap:8px; }

/* STAT CARDS */
.stat-row { display:grid; grid-template-columns:repeat(3,1fr); gap:14px; margin-bottom:24px; }
.stat-card { background:#fff; border-radius:12px; padding:16px 20px; border:1px solid #eee; display:flex; align-items:center; gap:14px; }
.stat-icon { width:42px; height:42px; border-radius:12px; display:flex; align-items:center; justify-content:center; font-size:18px; flex-shrink:0; }
.stat-icon.orange { background:#fff3e0; color:#e65100; }
.stat-icon.green  { background:#e8f5e9; color:#2e7d32; }
.stat-icon.red    { background:#fff0f0; color:#c0392b; }
.stat-info h3 { font-size:22px; font-weight:700; color:#1a1a2e; margin:0 0 2px; }
.stat-info p  { font-size:12px; color:#888; margin:0; }

/* FILTER */
.filter-bar { display:flex; gap:8px; margin-bottom:20px; flex-wrap:wrap; }
.filter-btn { padding:7px 18px; border-radius:20px; border:1.5px solid #e0e0e0; background:#fff; font-size:12px; font-weight:600; color:#666; cursor:pointer; transition:0.2s; }
.filter-btn.active, .filter-btn:hover { background:#2d2926; color:#fff; border-color:#2d2926; }

/* BOOKING CARD */
.booking-card { background:#fff; border:1px solid #eee; border-radius:14px; padding:20px; margin-bottom:14px; transition:0.2s; }
.booking-card:hover { box-shadow:0 4px 16px rgba(0,0,0,0.07); }
.booking-top { display:flex; align-items:flex-start; gap:16px; margin-bottom:14px; }
.booking-thumb { width:80px; height:64px; border-radius:10px; overflow:hidden; flex-shrink:0; background:#f0ebe4; display:flex; align-items:center; justify-content:center; font-size:24px; color:#b09070; }
.booking-thumb img { width:100%; height:100%; object-fit:cover; }
.booking-info { flex:1; }
.booking-info h4 { font-size:15px; font-weight:700; color:#1a1a2e; margin:0 0 4px; }
.booking-info .loc { font-size:12px; color:#888; margin:0 0 8px; display:flex; align-items:center; gap:4px; }
.booking-meta { display:flex; gap:16px; flex-wrap:wrap; }
.meta-item { display:flex; align-items:center; gap:5px; font-size:12px; color:#666; }
.meta-item i { color:#8a7060; }
.booking-right { text-align:right; }
.booking-price { font-size:16px; font-weight:700; color:#1a1a2e; }
.booking-price span { font-size:11px; color:#888; font-weight:400; display:block; }

/* RENTER INFO */
.renter-row { display:flex; align-items:center; gap:12px; padding:12px 0; border-top:1px solid #f5f5f5; }
.renter-avatar { width:36px; height:36px; border-radius:50%; background:#2d2926; display:flex; align-items:center; justify-content:center; font-size:12px; font-weight:600; color:#fff; flex-shrink:0; overflow:hidden; }
.renter-avatar img { width:100%; height:100%; object-fit:cover; }
.renter-info { flex:1; }
.renter-info h5 { font-size:13px; font-weight:600; color:#1a1a2e; margin:0 0 2px; }
.renter-info p  { font-size:12px; color:#888; margin:0; }
.message-box { background:#f8f8f8; border-radius:8px; padding:10px 14px; font-size:13px; color:#555; font-style:italic; margin-top:8px; border-left:3px solid #e0d8d0; }

/* BADGES */
.badge { font-size:11px; padding:4px 12px; border-radius:20px; font-weight:600; }
.badge-pending   { background:#fff3e0; color:#e65100; }
.badge-confirmed { background:#e8f5e9; color:#2e7d32; }
.badge-cancelled { background:#fff0f0; color:#c0392b; }

/* ACTION BUTTONS */
.action-btns { display:flex; gap:8px; margin-top:12px; }
.btn-confirm { display:flex; align-items:center; gap:5px; background:#e8f5e9; color:#2e7d32; border:1px solid #c8e6c9; padding:8px 18px; border-radius:20px; font-size:12px; font-weight:600; cursor:pointer; transition:0.2s; }
.btn-confirm:hover { background:#2e7d32; color:#fff; }
.btn-cancel  { display:flex; align-items:center; gap:5px; background:#fff0f0; color:#c0392b; border:1px solid #ffcdd2; padding:8px 18px; border-radius:20px; font-size:12px; font-weight:600; cursor:pointer; transition:0.2s; }
.btn-cancel:hover { background:#c0392b; color:#fff; }
.btn-confirmed-label { display:flex; align-items:center; gap:5px; background:#e8f5e9; color:#2e7d32; padding:8px 18px; border-radius:20px; font-size:12px; font-weight:600; }
.btn-cancelled-label { display:flex; align-items:center; gap:5px; background:#f5f5f5; color:#999; padding:8px 18px; border-radius:20px; font-size:12px; font-weight:600; }

/* EMPTY */
.empty-state { text-align:center; padding:60px 20px; background:#fff; border-radius:14px; border:1px solid #eee; }
.empty-state i { font-size:52px; color:#ddd; display:block; margin-bottom:16px; }
.empty-state h3 { font-size:16px; color:#888; margin-bottom:8px; }
.empty-state p  { font-size:13px; color:#aaa; }

/* LOGOUT */
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
        <a href="{{ route('booking.requests') }}" class="nav-item active">
            <i class="fa-solid fa-calendar-check"></i> Booking Requests
            @if($pending > 0)
                <span class="nav-badge">{{ $pending }}</span>
            @endif
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
<div class="main">
    <div class="topbar">
        <div class="topbar-title">Booking Requests</div>
        <a href="{{ route('home') }}" class="back-home"><i class="fa-solid fa-house"></i> Back to Home</a>
    </div>

    <div class="content">

        @if(session('success'))
        <div class="alert-success"><i class="fa-solid fa-circle-check"></i> {{ session('success') }}</div>
        @endif

        <!-- STATS -->
        <div class="stat-row">
            <div class="stat-card">
                <div class="stat-icon orange"><i class="fa-solid fa-clock"></i></div>
                <div class="stat-info"><h3>{{ $pending }}</h3><p>Pending Requests</p></div>
            </div>
            <div class="stat-card">
                <div class="stat-icon green"><i class="fa-solid fa-circle-check"></i></div>
                <div class="stat-info"><h3>{{ $confirmed }}</h3><p>Confirmed</p></div>
            </div>
            <div class="stat-card">
                <div class="stat-icon red"><i class="fa-solid fa-circle-xmark"></i></div>
                <div class="stat-info"><h3>{{ $cancelled }}</h3><p>Cancelled</p></div>
            </div>
        </div>

        <!-- FILTER -->
        <div class="filter-bar">
            <button class="filter-btn active" onclick="filterBookings('all', this)">All ({{ $bookings->count() }})</button>
            <button class="filter-btn" onclick="filterBookings('pending', this)">Pending ({{ $pending }})</button>
            <button class="filter-btn" onclick="filterBookings('confirmed', this)">Confirmed ({{ $confirmed }})</button>
            <button class="filter-btn" onclick="filterBookings('cancelled', this)">Cancelled ({{ $cancelled }})</button>
        </div>

        <!-- BOOKINGS LIST -->
        @forelse($bookings as $booking)
        <div class="booking-card" data-status="{{ $booking->status }}">

            <div class="booking-top">
                <div class="booking-thumb">
                    @if($booking->property->image)
                        <img src="{{ asset('storage/'.$booking->property->image) }}" alt="">
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

            <!-- RENTER INFO -->
            <div class="renter-row">
                <div class="renter-avatar">
                    @if($booking->user->profile_picture)
                        <img src="{{ asset('storage/'.$booking->user->profile_picture) }}" alt="">
                    @else
                        {{ strtoupper(substr($booking->user->name, 0, 2)) }}
                    @endif
                </div>
                <div class="renter-info">
                    <h5>{{ $booking->user->name }}</h5>
                    <p>{{ $booking->user->email }}
                        @if($booking->user->phone) · {{ $booking->user->phone }} @endif
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

            <!-- ACTION BUTTONS -->
            @if($booking->status == 'pending')
            <div class="action-btns">
                <form action="{{ route('booking.confirm', $booking->id) }}" method="POST">
                    @csrf @method('PATCH')
                    <button type="submit" class="btn-confirm">
                        <i class="fa-solid fa-circle-check"></i> Confirm Booking
                    </button>
                </form>
                <form action="{{ route('booking.cancel', $booking->id) }}" method="POST">
                    @csrf @method('PATCH')
                    <button type="submit" class="btn-cancel">
                        <i class="fa-solid fa-circle-xmark"></i> Cancel
                    </button>
                </form>
            </div>
            @elseif($booking->status == 'confirmed')
            <div class="action-btns">
                <span class="btn-confirmed-label"><i class="fa-solid fa-circle-check"></i> Booking Confirmed</span>
            </div>
            @else
            <div class="action-btns">
                <span class="btn-cancelled-label"><i class="fa-solid fa-ban"></i> Booking Cancelled</span>
            </div>
            @endif

        </div>
        @empty
        <div class="empty-state">
            <i class="fa-solid fa-calendar-xmark"></i>
            <h3>No booking requests yet</h3>
            <p>When someone books your property, requests will appear here.</p>
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
function openLogoutConfirm()  { document.getElementById('logoutConfirm').classList.add('active'); }
function closeLogoutConfirm() { document.getElementById('logoutConfirm').classList.remove('active'); }
document.addEventListener('keydown', e => { if(e.key==='Escape') closeLogoutConfirm(); });
</script>
</body>
</html>
