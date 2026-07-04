<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Listings — Smart Rent</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"/>
<style>
* { margin:0; padding:0; box-sizing:border-box; font-family:'Segoe UI',Arial,sans-serif; }
body { display:flex; height:100vh; overflow:hidden; background:#f4f6f9; }

/* SIDEBAR */
.sidebar { width:220px; min-width:220px; background:#2d2926; display:flex; flex-direction:column; height:100vh; position:fixed; left:0; top:0; }
.sidebar-logo { padding:20px; border-bottom:1px solid rgba(255,255,255,0.1); color:#fff; font-size:16px; font-weight:600; display:flex; align-items:center; gap:8px; }
.sidebar-user { padding:16px 20px; border-bottom:1px solid rgba(255,255,255,0.1); display:flex; align-items:center; gap:10px; }
.s-avatar { width:36px; height:36px; border-radius:50%; background:#c8a882; display:flex; align-items:center; justify-content:center; font-size:13px; font-weight:600; color:#2d2926; flex-shrink:0; }
.s-user-info p { color:#fff; font-size:13px; font-weight:500; margin:0; }
.s-user-info span { color:rgba(255,255,255,0.45); font-size:11px; }
.sidebar-nav { padding:12px 0; flex:1; overflow-y:auto; }
.nav-item { display:flex; align-items:center; gap:10px; padding:11px 20px; color:rgba(255,255,255,0.65); font-size:13px; text-decoration:none; transition:0.2s; }
.nav-item:hover { background:rgba(255,255,255,0.08); color:#fff; }
.nav-item.active { background:rgba(255,255,255,0.12); color:#fff; border-left:3px solid #c8a882; }
.nav-item i { font-size:16px; width:18px; text-align:center; }
.nav-divider { height:1px; background:rgba(255,255,255,0.1); margin:8px 20px; }
.nav-item.danger { color:rgba(220,80,80,0.8); }
.nav-item.danger:hover { color:#ff6b6b; background:rgba(220,80,80,0.08); }

/* MAIN */
.main { margin-left:220px; flex:1; display:flex; flex-direction:column; height:100vh; overflow:hidden; }
.topbar { background:#fff; border-bottom:1px solid #eee; padding:13px 28px; display:flex; align-items:center; justify-content:space-between; flex-shrink:0; }
.topbar-title { font-size:16px; font-weight:600; color:#1a1a2e; }
.back-home { display:flex; align-items:center; gap:6px; font-size:13px; color:#666; background:#f5f5f5; border:1px solid #e0e0e0; padding:7px 16px; border-radius:20px; text-decoration:none; transition:0.2s; font-weight:500; }
.back-home:hover { background:#eee; color:#333; }
.content { flex:1; overflow-y:auto; padding:28px; }

/* ALERTS */
.alert-success { background:#f0fff4; border:1px solid #b2dfdb; color:#1b5e20; border-radius:10px; padding:12px 18px; margin-bottom:20px; font-size:13px; display:flex; align-items:center; gap:8px; }
.alert-error { background:#fff0f0; border:1px solid #ffcdd2; color:#c0392b; border-radius:10px; padding:12px 18px; margin-bottom:20px; font-size:13px; }

/* FILTER BAR */
.filter-bar { background:#fff; border-radius:12px; padding:16px 20px; border:1px solid #eee; margin-bottom:20px; display:flex; align-items:center; gap:12px; flex-wrap:wrap; }
.filter-btn { padding:7px 18px; border-radius:20px; border:1.5px solid #e0e0e0; background:#fff; font-size:12px; font-weight:600; color:#666; cursor:pointer; transition:0.2s; }
.filter-btn:hover, .filter-btn.active { background:#2d2926; color:#fff; border-color:#2d2926; }
.filter-count { background:#f5ede0; color:#8a5c30; padding:2px 8px; border-radius:10px; font-size:11px; font-weight:600; margin-left:4px; }

/* LISTING CARD */
.listing-card { background:#fff; border:1px solid #eee; border-radius:14px; padding:18px; display:flex; align-items:center; gap:16px; margin-bottom:14px; transition:0.2s; }
.listing-card:hover { box-shadow:0 4px 16px rgba(0,0,0,0.07); }
.listing-thumb { width:100px; height:80px; border-radius:10px; overflow:hidden; flex-shrink:0; background:#f0ebe4; display:flex; align-items:center; justify-content:center; }
.listing-thumb img { width:100%; height:100%; object-fit:cover; }
.listing-thumb i { font-size:28px; color:#b09070; }
.listing-info { flex:1; }
.listing-info h4 { font-size:15px; font-weight:600; color:#1a1a2e; margin:0 0 4px; }
.listing-info .loc { font-size:12px; color:#888; margin:0 0 8px; display:flex; align-items:center; gap:4px; }
.badges { display:flex; gap:6px; align-items:center; }
.badge { font-size:11px; padding:3px 10px; border-radius:20px; font-weight:500; }
.badge-type   { background:#f0f0f0; color:#555; text-transform:capitalize; }
.badge-active { background:#e8f5e9; color:#2e7d32; }
.badge-inactive { background:#fff3e0; color:#e65100; }

/* PRICE */
.listing-price { font-size:17px; font-weight:700; color:#1a1a2e; white-space:nowrap; }
.listing-price span { font-size:11px; color:#888; font-weight:400; display:block; text-align:right; }

/* ACTION BUTTONS */
.action-btns { display:flex; flex-direction:column; gap:8px; align-items:flex-end; }
.btn-edit { display:flex; align-items:center; gap:5px; background:#f5ede0; color:#8a5c30; padding:7px 14px; border-radius:20px; font-size:12px; font-weight:600; text-decoration:none; transition:0.2s; border:none; cursor:pointer; }
.btn-edit:hover { background:#e8d5b7; }
.btn-toggle { display:flex; align-items:center; gap:5px; padding:7px 14px; border-radius:20px; font-size:12px; font-weight:600; border:none; cursor:pointer; transition:0.2s; }
.btn-toggle.deactivate { background:#fff3e0; color:#e65100; }
.btn-toggle.activate   { background:#e8f5e9; color:#2e7d32; }
.btn-toggle:hover { opacity:0.8; }
.btn-delete { display:flex; align-items:center; gap:5px; background:#fff0f0; color:#c0392b; padding:7px 14px; border-radius:20px; font-size:12px; font-weight:600; border:none; cursor:pointer; transition:0.2s; }
.btn-delete:hover { background:#ffcdd2; }

/* EMPTY */
.empty-state { text-align:center; padding:60px 20px; background:#fff; border-radius:14px; border:1px solid #eee; }
.empty-state i { font-size:52px; color:#ddd; display:block; margin-bottom:16px; }
.empty-state h3 { font-size:16px; color:#888; margin-bottom:8px; }
.empty-state p  { font-size:13px; color:#aaa; margin-bottom:20px; }
.add-btn { display:inline-flex; align-items:center; gap:6px; background:#2d2926; color:#fff; padding:10px 22px; border-radius:8px; font-size:13px; font-weight:500; text-decoration:none; transition:0.2s; }
.add-btn:hover { background:#1a1a1a; }

/* DELETE CONFIRM MODAL */
.del-overlay { display:none; position:fixed; inset:0; background:rgba(0,0,0,0.5); z-index:9999; justify-content:center; align-items:center; }
.del-overlay.active { display:flex; }
.del-box { background:#fff; border-radius:16px; padding:36px 32px 28px; width:380px; text-align:center; box-shadow:0 16px 50px rgba(0,0,0,0.2); }
.del-icon { width:64px; height:64px; border-radius:50%; background:#fff0f0; display:flex; align-items:center; justify-content:center; margin:0 auto 16px; font-size:28px; color:#dc3545; }
.del-box h3 { font-size:20px; font-weight:700; color:#1a1a2e; margin-bottom:8px; }
.del-box p  { font-size:13px; color:#888; margin-bottom:24px; }
.del-btns   { display:flex; gap:12px; }
.btn-cancel-del { flex:1; padding:11px; border:1.5px solid #ddd; border-radius:30px; background:#fff; color:#555; font-size:14px; font-weight:600; cursor:pointer; }
.btn-confirm-del { flex:1; padding:11px; border:none; border-radius:30px; background:#dc3545; color:#fff; font-size:14px; font-weight:600; cursor:pointer; }
.btn-confirm-del:hover { background:#b02a37; }

/* LOGOUT MODAL */
.logout-overlay { display:none; position:fixed; inset:0; background:rgba(0,0,0,0.55); z-index:99999; justify-content:center; align-items:center; }
.logout-overlay.active { display:flex; }
.logout-box { background:#fff; border-radius:16px; padding:36px 32px 28px; width:360px; text-align:center; box-shadow:0 16px 50px rgba(0,0,0,0.25); }
.logout-icon { width:60px; height:60px; border-radius:50%; background:#fff0f0; display:flex; align-items:center; justify-content:center; margin:0 auto 16px; font-size:26px; color:#dc3545; }
.logout-box h3 { font-size:20px; font-weight:700; color:#2b2d42; margin-bottom:8px; }
.logout-box p  { font-size:13px; color:#888; margin-bottom:24px; }
.logout-btns   { display:flex; gap:12px; }
.btn-cancel-lo { flex:1; padding:11px; border:1.5px solid #ddd; border-radius:30px; background:#fff; color:#555; font-size:14px; font-weight:600; cursor:pointer; }
.btn-logout-confirm { flex:1; padding:11px; border:none; border-radius:30px; background:#dc3545; color:#fff; font-size:14px; font-weight:600; cursor:pointer; }
.btn-logout-confirm:hover { background:#b02a37; }

.nav-badge {
    background: #dc3545;
    color: #fff;
    font-size: 10px;
    font-weight: 700;
    padding: 2px 6px;
    border-radius: 10px;
    margin-left: auto;
}
</style>
</head>
<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <div class="sidebar-logo"><i class="fa-solid fa-house-chimney"></i> Smart Rent</div>
    <div class="sidebar-user">
        <div class="s-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 2)) }}</div>
        <div class="s-user-info">
            <p>{{ Auth::user()->name }}</p>
            <span>{{ ucfirst(Auth::user()->role) }}</span>
        </div>
    </div>
    <nav class="sidebar-nav">
        <a href="{{ route('dashboard') }}" class="nav-item"><i class="fa-solid fa-gauge"></i> Dashboard</a>
        <a href="{{ route('my.listings') }}" class="nav-item active"><i class="fa-solid fa-building"></i> My Listings</a>
        <a href="{{ route('property.create') }}" class="nav-item"><i class="fa-solid fa-circle-plus"></i> Add Property</a>
        <div class="nav-divider"></div>
                <a href="{{ route('notifications') }}" class="nav-item">
            <i class="fa-solid fa-bell"></i> Notifications
            @if(isset($unreadNotifications) && $unreadNotifications > 0)
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
        <div class="topbar-title">My Listings</div>
        <a href="{{ route('home') }}" class="back-home"><i class="fa-solid fa-house"></i> Back to Home</a>
    </div>

    <div class="content">

        @if(session('success'))
        <div class="alert-success"><i class="fa-solid fa-circle-check"></i> {{ session('success') }}</div>
        @endif
        @if(session('error'))
        <div class="alert-error"><i class="fa-solid fa-circle-exclamation"></i> {{ session('error') }}</div>
        @endif

        <!-- FILTER BAR -->
        <div class="filter-bar">
            <span style="font-size:13px; font-weight:600; color:#555;">Filter:</span>
            <button class="filter-btn active" onclick="filterListings('all', this)">
                All <span class="filter-count">{{ $properties->count() }}</span>
            </button>
            <button class="filter-btn" onclick="filterListings('active', this)">
                Active <span class="filter-count">{{ $properties->where('status','active')->count() }}</span>
            </button>
            <button class="filter-btn" onclick="filterListings('inactive', this)">
                Inactive <span class="filter-count">{{ $properties->where('status','inactive')->count() }}</span>
            </button>
            <div style="margin-left:auto;">
                <a href="{{ route('property.create') }}" class="add-btn">
                    <i class="fa-solid fa-plus"></i> Add Property
                </a>
            </div>
        </div>

        <!-- LISTINGS -->
        @forelse($properties as $property)
        <div class="listing-card" data-status="{{ $property->status }}">

            <div class="listing-thumb">
                @if($property->image)
                    <img src="{{ asset('storage/'.$property->image) }}" alt="{{ $property->title }}">
                @else
                    <i class="fa-solid fa-building"></i>
                @endif
            </div>

            <div class="listing-info">
                <h4>{{ $property->title }}</h4>
                <p class="loc"><i class="fa-solid fa-location-dot"></i> {{ $property->location }}, {{ $property->city }}</p>
                <div class="badges">
                    <span class="badge badge-type">{{ $property->type }}</span>
                    <span class="badge {{ $property->status == 'active' ? 'badge-active' : 'badge-inactive' }}">
                        {{ ucfirst($property->status) }}
                    </span>
                    <span style="font-size:11px; color:#888; margin-left:4px;">
                        <i class="fa-solid fa-bed"></i> {{ $property->bedrooms }}
                        &nbsp;<i class="fa-solid fa-bath"></i> {{ $property->bathrooms }}
                    </span>
                </div>
            </div>

            <div class="listing-price">
                ₨ {{ number_format($property->price) }}
                <span>per month</span>
            </div>

            <div class="action-btns">
                <!-- EDIT -->
                <a href="{{ route('property.edit', $property->id) }}" class="btn-edit">
                    <i class="fa-solid fa-pen-to-square"></i> Edit
                </a>

                <!-- TOGGLE STATUS -->
                <form action="{{ route('property.toggle', $property->id) }}" method="POST">
                    @csrf @method('PATCH')
                    <button type="submit" class="btn-toggle {{ $property->status == 'active' ? 'deactivate' : 'activate' }}">
                        @if($property->status == 'active')
                            <i class="fa-solid fa-toggle-off"></i> Deactivate
                        @else
                            <i class="fa-solid fa-toggle-on"></i> Activate
                        @endif
                    </button>
                </form>

                <!-- DELETE -->
                <button class="btn-delete" onclick="openDeleteModal({{ $property->id }}, '{{ $property->title }}')">
                    <i class="fa-solid fa-trash"></i> Delete
                </button>
            </div>

        </div>
        @empty
        <div class="empty-state">
            <i class="fa-solid fa-building-circle-xmark"></i>
            <h3>No listings yet</h3>
            <p>You haven't added any properties. Start listing now!</p>
            <a href="{{ route('property.create') }}" class="add-btn">
                <i class="fa-solid fa-plus"></i> Add Your First Property
            </a>
        </div>
        @endforelse

    </div>
</div>

<!-- DELETE CONFIRM MODAL -->
<div class="del-overlay" id="deleteModal">
    <div class="del-box">
        <div class="del-icon"><i class="fa-solid fa-trash"></i></div>
        <h3>Delete Listing?</h3>
        <p id="deleteMsg">Are you sure you want to delete this property? This action cannot be undone.</p>
        <div class="del-btns">
            <button class="btn-cancel-del" onclick="closeDeleteModal()"><i class="fa-solid fa-xmark"></i> Cancel</button>
            <form id="deleteForm" method="POST">
                @csrf @method('DELETE')
                <button type="submit" class="btn-confirm-del"><i class="fa-solid fa-trash"></i> Delete</button>
            </form>
        </div>
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
            <button class="btn-logout-confirm" onclick="document.getElementById('logout-form').submit();"><i class="fa-solid fa-right-from-bracket"></i> Logout</button>
        </div>
    </div>
</div>

<script>
// Filter
function filterListings(status, btn) {
    document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    document.querySelectorAll('.listing-card').forEach(card => {
        if (status === 'all' || card.dataset.status === status) {
            card.style.display = 'flex';
        } else {
            card.style.display = 'none';
        }
    });
}

// Delete Modal
function openDeleteModal(id, title) {
    document.getElementById('deleteMsg').textContent = 'Are you sure you want to delete "' + title + '"? This action cannot be undone.';
    document.getElementById('deleteForm').action = '/property/' + id;
    document.getElementById('deleteModal').classList.add('active');
}
function closeDeleteModal() {
    document.getElementById('deleteModal').classList.remove('active');
}

// Logout
function openLogoutConfirm() {
    document.getElementById('logoutConfirm').classList.add('active');
}
function closeLogoutConfirm() {
    document.getElementById('logoutConfirm').classList.remove('active');
}

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') { closeDeleteModal(); closeLogoutConfirm(); }
});
</script>
</body>
</html>