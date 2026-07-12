<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings — Smart Rent</title>
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
.nav-item.danger:hover { color:#ff6b6b; background:rgba(220,80,80,0.08); }
.nav-badge { background:#dc3545; color:#fff; font-size:10px; font-weight:700; padding:2px 6px; border-radius:10px; margin-left:auto; }

.main { margin-left:220px; flex:1; display:flex; flex-direction:column; height:100vh; overflow:hidden; }
.topbar { background:#fff; border-bottom:1px solid #eee; padding:13px 28px; display:flex; align-items:center; justify-content:space-between; flex-shrink:0; }
.topbar-title { font-size:16px; font-weight:600; color:#1a1a2e; }
.back-home { display:flex; align-items:center; gap:6px; font-size:13px; color:#666; background:#f5f5f5; border:1px solid #e0e0e0; padding:7px 16px; border-radius:20px; text-decoration:none; font-weight:500; transition:0.2s; }
.back-home:hover { background:#eee; }

.content { flex:1; overflow-y:auto; padding:24px 28px; display:flex; gap:20px; }
.left-col  { flex:1; display:flex; flex-direction:column; gap:16px; }
.right-col { width:240px; display:flex; flex-direction:column; gap:16px; }

/* ALERTS */
.alert-success { background:#f0fff4; border:1px solid #b2dfdb; color:#1b5e20; border-radius:10px; padding:12px 18px; margin-bottom:4px; font-size:13px; display:flex; align-items:center; gap:8px; }
.alert-error   { background:#fff0f0; border:1px solid #ffcdd2; color:#c0392b; border-radius:10px; padding:12px 18px; margin-bottom:4px; font-size:13px; display:flex; align-items:center; gap:8px; }

/* CARDS */
.card { background:#fff; border-radius:14px; padding:22px; border:1px solid #eee; }
.card-title { font-size:14px; font-weight:700; color:#1a1a2e; margin-bottom:18px; padding-bottom:12px; border-bottom:1.5px solid #f0f0f0; display:flex; align-items:center; gap:8px; }
.card-title i { color:rgb(51,47,46); font-size:15px; }

/* FORM */
.fgroup { margin-bottom:14px; }
.fgroup label { display:block; font-size:12px; font-weight:600; color:#555; margin-bottom:5px; }
.fgroup input { width:100%; padding:11px 14px; border:1.5px solid #e0e0e0; border-radius:10px; font-size:14px; color:#333; outline:none; transition:0.2s; background:#fafafa; font-family:'Segoe UI',Arial,sans-serif; }
.fgroup input:focus { border-color:rgb(51,47,46); background:#fff; box-shadow:0 0 0 3px rgba(51,47,46,0.08); }
.error-msg { color:#dc3545; font-size:11px; margin-top:3px; display:block; }
.save-btn { width:100%; padding:13px; background:rgb(51,47,46); color:#fff; border:none; border-radius:10px; font-size:15px; font-weight:600; cursor:pointer; transition:0.2s; display:flex; align-items:center; justify-content:center; gap:8px; }
.save-btn:hover { background:#1a1a1a; transform:translateY(-1px); }

/* SECTION LABEL */
.section-label { font-size:11px; font-weight:700; color:#aaa; text-transform:uppercase; letter-spacing:0.6px; margin:14px 0 10px; }

/* TOGGLE */
.pref-row { display:flex; align-items:center; justify-content:space-between; padding:11px 0; border-bottom:1px solid #f5f5f5; }
.pref-row:last-child { border-bottom:none; padding-bottom:0; }
.pref-info p    { font-size:13px; font-weight:600; color:#1a1a2e; margin:0 0 2px; }
.pref-info span { font-size:11px; color:#888; }
.toggle-wrap { position:relative; }
.toggle-input { display:none; }
.toggle-label {
    display:block; width:40px; height:22px;
    border-radius:11px; background:#ddd;
    cursor:pointer; transition:0.3s; position:relative;
}
.toggle-label::after {
    content:''; position:absolute;
    width:16px; height:16px; border-radius:50%;
    background:#fff; top:3px; left:3px; transition:0.3s;
    box-shadow:0 1px 3px rgba(0,0,0,0.2);
}
.toggle-input:checked + .toggle-label { background:rgb(51,47,46); }
.toggle-input:checked + .toggle-label::after { left:21px; }

/* ACCOUNT INFO */
.info-row { display:flex; justify-content:space-between; align-items:center; padding:9px 0; border-bottom:1px solid #f5f5f5; font-size:13px; }
.info-row:last-child { border-bottom:none; }
.info-row .label { color:#888; font-size:12px; }
.info-row .value { color:#1a1a2e; font-weight:600; font-size:12px; }
.badge-active { background:#e8f5e9; color:#2e7d32; padding:3px 10px; border-radius:20px; font-size:11px; font-weight:600; }
.badge-role   { background:#f5ede0; color:#8a5c30; padding:3px 10px; border-radius:20px; font-size:11px; font-weight:600; }
.badge-yes    { background:#e3f2fd; color:#1565c0; padding:3px 10px; border-radius:20px; font-size:11px; font-weight:600; }

/* LISTING SUMMARY */
.summary-row { display:flex; justify-content:space-between; align-items:center; padding:9px 0; border-bottom:1px solid #f5f5f5; }
.summary-row:last-child { border-bottom:none; }
.summary-left { display:flex; align-items:center; gap:8px; font-size:13px; color:#555; }
.summary-icon { width:28px; height:28px; border-radius:8px; display:flex; align-items:center; justify-content:center; font-size:12px; }
.summary-count { font-size:16px; font-weight:700; color:#1a1a2e; }

/* DANGER */
.danger-card { background:#fff; border-radius:14px; padding:22px; border:1.5px solid #ffcdd2; }
.danger-title { font-size:14px; font-weight:700; color:#c0392b; margin-bottom:8px; display:flex; align-items:center; gap:8px; }
.danger-card p { font-size:13px; color:#888; margin-bottom:16px; line-height:1.6; }
.btn-danger { padding:11px 22px; background:#fff0f0; color:#c0392b; border:1.5px solid #ffcdd2; border-radius:10px; font-size:14px; font-weight:600; cursor:pointer; display:flex; align-items:center; gap:6px; transition:0.2s; }
.btn-danger:hover { background:#dc3545; color:#fff; border-color:#dc3545; }

/* MODALS */
.overlay { display:none; position:fixed; inset:0; background:rgba(0,0,0,0.55); z-index:9999; justify-content:center; align-items:center; }
.overlay.active { display:flex; }
.modal-box { background:#fff; border-radius:16px; padding:36px 32px 28px; width:380px; text-align:center; box-shadow:0 16px 50px rgba(0,0,0,0.25); }
.modal-icon { width:64px; height:64px; border-radius:50%; display:flex; align-items:center; justify-content:center; margin:0 auto 16px; font-size:28px; }
.modal-icon.red { background:#fff0f0; color:#dc3545; }
.modal-box h3 { font-size:20px; font-weight:700; color:#1a1a2e; margin-bottom:8px; }
.modal-box p  { font-size:13px; color:#888; margin-bottom:16px; }
.modal-input { width:100%; padding:10px 14px; border:1.5px solid #e0e0e0; border-radius:10px; font-size:14px; margin-bottom:16px; outline:none; font-family:'Segoe UI',Arial,sans-serif; }
.modal-input:focus { border-color:#dc3545; }
.modal-btns { display:flex; gap:12px; }
.btn-cancel-m   { flex:1; padding:11px; border:1.5px solid #ddd; border-radius:30px; background:#fff; color:#555; font-size:14px; font-weight:600; cursor:pointer; }
.btn-confirm-red { flex:1; padding:11px; border:none; border-radius:30px; background:#dc3545; color:#fff; font-size:14px; font-weight:600; cursor:pointer; }
.btn-confirm-red:hover { background:#b02a37; }
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
        <a href="{{ route('booking.requests') }}" class="nav-item">
    <i class="fa-solid fa-calendar-check"></i> Booking Requests
</a>  
        
        <div class="nav-divider"></div>
        <a href="{{ route('notifications') }}" class="nav-item">
            <i class="fa-solid fa-bell"></i> Notifications
            @if(isset($unreadNotifications) && $unreadNotifications > 0)
                <span class="nav-badge">{{ $unreadNotifications }}</span>
            @endif
        </a>
        <a href="{{ route('profile') }}" class="nav-item"><i class="fa-solid fa-user"></i> Profile</a>
        <a href="{{ route('settings') }}" class="nav-item active"><i class="fa-solid fa-gear"></i> Settings</a>
        <div class="nav-divider"></div>
        <form action="{{ route('logout') }}" method="POST" id="logout-form" style="display:none;">@csrf</form>
        <a href="#" class="nav-item danger" onclick="event.preventDefault(); document.getElementById('logoutModal').classList.add('active');"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
    </nav>
</div>

<!-- MAIN -->
<div class="main">
    <div class="topbar">
        <div class="topbar-title">Settings</div>
        <a href="{{ route('home') }}" class="back-home"><i class="fa-solid fa-house"></i> Back to Home</a>
    </div>

    <div class="content">
        <div class="left-col">

            @if(session('success'))
            <div class="alert-success"><i class="fa-solid fa-circle-check"></i> {{ session('success') }}</div>
            @endif
            @if($errors->any())
            <div class="alert-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $errors->first() }}</div>
            @endif

            <!-- CHANGE PASSWORD -->
            <div class="card">
                <div class="card-title"><i class="fa-solid fa-lock"></i> Change Password</div>
                <form method="POST" action="{{ route('settings.password') }}">
                    @csrf @method('PUT')
                    <div class="fgroup">
                        <label>Current Password *</label>
                        <input type="password" name="current_password" placeholder="Enter current password" required>
                        @error('current_password') <span class="error-msg">{{ $message }}</span> @enderror
                    </div>
                    <div class="fgroup">
                        <label>New Password *</label>
                        <input type="password" name="password" placeholder="Min 6 characters" required>
                        @error('password') <span class="error-msg">{{ $message }}</span> @enderror
                    </div>
                    <div class="fgroup">
                        <label>Confirm New Password *</label>
                        <input type="password" name="password_confirmation" placeholder="Repeat new password" required>
                    </div>
                    <button type="submit" class="save-btn">
                        <i class="fa-solid fa-lock"></i> Update Password
                    </button>
                </form>
            </div>

            <!-- PREFERENCES -->
            <div class="card">
                <div class="card-title"><i class="fa-solid fa-sliders"></i> Preferences</div>

                <div class="section-label">Notifications</div>

                <div class="pref-row">
                    <div class="pref-info">
                        <p>Email Notifications</p>
                        <span>Receive listing updates via email</span>
                    </div>
                    <div class="toggle-wrap">
                        <input type="checkbox" class="toggle-input" id="email_notif" checked>
                        <label class="toggle-label" for="email_notif"></label>
                    </div>
                </div>

                <div class="pref-row">
                    <div class="pref-info">
                        <p>Booking Alerts</p>
                        <span>Notify when someone requests a booking</span>
                    </div>
                    <div class="toggle-wrap">
                        <input type="checkbox" class="toggle-input" id="booking_alerts" checked>
                        <label class="toggle-label" for="booking_alerts"></label>
                    </div>
                </div>

                <div class="section-label">Privacy</div>

                <div class="pref-row">
                    <div class="pref-info">
                        <p>Show Contact on Listings</p>
                        <span>Display your phone number publicly</span>
                    </div>
                    <div class="toggle-wrap">
                        <input type="checkbox" class="toggle-input" id="show_contact">
                        <label class="toggle-label" for="show_contact"></label>
                    </div>
                </div>

                <div class="pref-row">
                    <div class="pref-info">
                        <p>Public Profile</p>
                        <span>Let others view your profile</span>
                    </div>
                    <div class="toggle-wrap">
                        <input type="checkbox" class="toggle-input" id="public_profile" checked>
                        <label class="toggle-label" for="public_profile"></label>
                    </div>
                </div>

                <div class="section-label">Listings</div>

                <div class="pref-row">
                    <div class="pref-info">
                        <p>Listing Expiry Reminder</p>
                        <span>Alert me before my listing expires</span>
                    </div>
                    <div class="toggle-wrap">
                        <input type="checkbox" class="toggle-input" id="expiry_reminder">
                        <label class="toggle-label" for="expiry_reminder"></label>
                    </div>
                </div>

            </div>

            <!-- DANGER ZONE -->
            <div class="danger-card">
                <div class="danger-title"><i class="fa-solid fa-triangle-exclamation"></i> Danger Zone</div>
                <p>Once you delete your account, all your listings and data will be permanently removed. This action cannot be undone.</p>
                <button class="btn-danger" onclick="document.getElementById('deleteAccountModal').classList.add('active')">
                    <i class="fa-solid fa-user-xmark"></i> Delete My Account
                </button>
            </div>

        </div>

        <div class="right-col">

            <!-- ACCOUNT INFO -->
            <div class="card">
                <div class="card-title"><i class="fa-solid fa-circle-info"></i> Account Info</div>
                <div class="info-row">
                    <span class="label">Status</span>
                    <span class="badge-active">Active</span>
                </div>
                <div class="info-row">
                    <span class="label">Role</span>
                    <span class="badge-role">{{ ucfirst(Auth::user()->role) }}</span>
                </div>
                <div class="info-row">
                    <span class="label">Member Since</span>
                    <span class="value">{{ \Carbon\Carbon::parse(Auth::user()->created_at)->format('M Y') }}</span>
                </div>
                <div class="info-row">
                    <span class="label">Total Listings</span>
                    <span class="value">{{ $totalListings }}</span>
                </div>
                <div class="info-row">
                    <span class="label">Active Listings</span>
                    <span class="value">{{ $activeListings }}</span>
                </div>
                <div class="info-row">
                    <span class="label">Email Verified</span>
                    <span class="badge-yes">Yes</span>
                </div>
            </div>

            <!-- LISTING SUMMARY -->
            <div class="card">
                <div class="card-title"><i class="fa-solid fa-chart-bar"></i> Listing Summary</div>

                <div class="summary-row">
                    <div class="summary-left">
                        <div class="summary-icon" style="background:#f5ede0; color:#8a5c30;"><i class="fa-solid fa-house"></i></div>
                        Houses
                    </div>
                    <span class="summary-count">{{ $listingSummary['house'] }}</span>
                </div>
                <div class="summary-row">
                    <div class="summary-left">
                        <div class="summary-icon" style="background:#e3f2fd; color:#1565c0;"><i class="fa-solid fa-building"></i></div>
                        Apartments
                    </div>
                    <span class="summary-count">{{ $listingSummary['apartment'] }}</span>
                </div>
                <div class="summary-row">
                    <div class="summary-left">
                        <div class="summary-icon" style="background:#e8f5e9; color:#2e7d32;"><i class="fa-solid fa-door-open"></i></div>
                        Rooms
                    </div>
                    <span class="summary-count">{{ $listingSummary['room'] }}</span>
                </div>
                <div class="summary-row">
                    <div class="summary-left">
                        <div class="summary-icon" style="background:#fff3e0; color:#e65100;"><i class="fa-solid fa-store"></i></div>
                        Shops
                    </div>
                    <span class="summary-count">{{ $listingSummary['shop'] }}</span>
                </div>
                <div class="summary-row">
                    <div class="summary-left">
                        <div class="summary-icon" style="background:#f3e5f5; color:#6a1b9a;"><i class="fa-solid fa-briefcase"></i></div>
                        Offices
                    </div>
                    <span class="summary-count">{{ $listingSummary['office'] }}</span>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- DELETE ACCOUNT MODAL -->
<div class="overlay" id="deleteAccountModal">
    <div class="modal-box">
        <div class="modal-icon red"><i class="fa-solid fa-user-xmark"></i></div>
        <h3>Delete Account?</h3>
        <p>Type <strong>DELETE</strong> to confirm. All your data and listings will be permanently removed.</p>
        <input type="text" id="deleteConfirmInput" class="modal-input" placeholder="Type DELETE to confirm">
        <div class="modal-btns">
            <button class="btn-cancel-m" onclick="document.getElementById('deleteAccountModal').classList.remove('active')">Cancel</button>
            <form method="POST" action="{{ route('settings.delete') }}" id="deleteAccountForm">
                @csrf @method('DELETE')
                <button type="button" class="btn-confirm-red" onclick="confirmDeleteAccount()">
                    <i class="fa-solid fa-trash"></i> Delete
                </button>
            </form>
        </div>
    </div>
</div>

<!-- LOGOUT MODAL -->
<div class="overlay" id="logoutModal">
    <div class="modal-box">
        <div class="modal-icon red"><i class="fa-solid fa-right-from-bracket"></i></div>
        <h3>Logout?</h3>
        <p>Are you sure you want to log out of your Smart Rent account?</p>
        <div class="modal-btns">
            <button class="btn-cancel-m" onclick="document.getElementById('logoutModal').classList.remove('active')">Cancel</button>
            <button class="btn-confirm-red" onclick="document.getElementById('logout-form').submit()">
                <i class="fa-solid fa-right-from-bracket"></i> Logout
            </button>
        </div>
    </div>
</div>

<script>
function confirmDeleteAccount() {
    if (document.getElementById('deleteConfirmInput').value === 'DELETE') {
        document.getElementById('deleteAccountForm').submit();
    } else {
        alert('Please type DELETE to confirm.');
    }
}
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        document.querySelectorAll('.overlay').forEach(o => o.classList.remove('active'));
    }
});
</script>
</body>
</html>