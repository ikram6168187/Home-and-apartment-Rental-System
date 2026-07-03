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
.main { margin-left:220px; flex:1; display:flex; flex-direction:column; height:100vh; overflow:hidden; }
.topbar { background:#fff; border-bottom:1px solid #eee; padding:13px 28px; display:flex; align-items:center; justify-content:space-between; flex-shrink:0; }
.topbar-title { font-size:16px; font-weight:600; color:#1a1a2e; }
.back-home { display:flex; align-items:center; gap:6px; font-size:13px; color:#666; background:#f5f5f5; border:1px solid #e0e0e0; padding:7px 16px; border-radius:20px; text-decoration:none; transition:0.2s; font-weight:500; }
.content { flex:1; overflow-y:auto; padding:28px; max-width:700px; }
.alert-success { background:#f0fff4; border:1px solid #b2dfdb; color:#1b5e20; border-radius:10px; padding:12px 18px; margin-bottom:20px; font-size:13px; display:flex; align-items:center; gap:8px; }
.alert-error   { background:#fff0f0; border:1px solid #ffcdd2; color:#c0392b; border-radius:10px; padding:12px 18px; margin-bottom:20px; font-size:13px; }
.form-card { background:#fff; border-radius:16px; padding:28px; border:1px solid #eee; margin-bottom:20px; }
.card-title { font-size:15px; font-weight:700; color:#1a1a2e; margin-bottom:18px; padding-bottom:10px; border-bottom:2px solid #f0f0f0; display:flex; align-items:center; gap:8px; }
.card-title i { color:rgb(51,47,46); }
.fgroup { margin-bottom:16px; }
.fgroup label { display:block; font-size:12px; font-weight:600; color:#555; margin-bottom:5px; }
.fgroup input { width:100%; padding:11px 14px; border:1.5px solid #e0e0e0; border-radius:10px; font-size:14px; color:#333; outline:none; transition:0.2s; background:#fafafa; }
.fgroup input:focus { border-color:rgb(51,47,46); background:#fff; box-shadow:0 0 0 3px rgba(51,47,46,0.08); }
.error-msg { color:#dc3545; font-size:11px; margin-top:3px; display:block; }
.save-btn { width:100%; padding:13px; background:rgb(51,47,46); color:#fff; border:none; border-radius:10px; font-size:15px; font-weight:600; cursor:pointer; transition:0.2s; display:flex; align-items:center; justify-content:center; gap:8px; }
.save-btn:hover { background:#1a1a1a; transform:translateY(-1px); }

/* DANGER ZONE */
.danger-card { background:#fff; border-radius:16px; padding:28px; border:1.5px solid #ffcdd2; margin-bottom:20px; }
.danger-title { font-size:15px; font-weight:700; color:#c0392b; margin-bottom:8px; display:flex; align-items:center; gap:8px; }
.danger-card p { font-size:13px; color:#888; margin-bottom:16px; line-height:1.6; }
.btn-danger { padding:11px 24px; background:#fff0f0; color:#c0392b; border:1.5px solid #ffcdd2; border-radius:10px; font-size:14px; font-weight:600; cursor:pointer; transition:0.2s; display:flex; align-items:center; gap:6px; }
.btn-danger:hover { background:#dc3545; color:#fff; border-color:#dc3545; }

/* MODALS */
.overlay { display:none; position:fixed; inset:0; background:rgba(0,0,0,0.55); z-index:9999; justify-content:center; align-items:center; }
.overlay.active { display:flex; }
.modal-box { background:#fff; border-radius:16px; padding:36px 32px 28px; width:380px; text-align:center; box-shadow:0 16px 50px rgba(0,0,0,0.25); }
.modal-icon { width:64px; height:64px; border-radius:50%; display:flex; align-items:center; justify-content:center; margin:0 auto 16px; font-size:28px; }
.modal-icon.red { background:#fff0f0; color:#dc3545; }
.modal-icon.brown { background:#f5ede0; color:rgb(51,47,46); }
.modal-box h3 { font-size:20px; font-weight:700; color:#1a1a2e; margin-bottom:8px; }
.modal-box p  { font-size:13px; color:#888; margin-bottom:20px; }
.modal-input { width:100%; padding:10px 14px; border:1.5px solid #e0e0e0; border-radius:10px; font-size:14px; margin-bottom:16px; outline:none; }
.modal-input:focus { border-color:#dc3545; }
.modal-btns { display:flex; gap:12px; }
.btn-cancel-m { flex:1; padding:11px; border:1.5px solid #ddd; border-radius:30px; background:#fff; color:#555; font-size:14px; font-weight:600; cursor:pointer; }
.btn-confirm-red { flex:1; padding:11px; border:none; border-radius:30px; background:#dc3545; color:#fff; font-size:14px; font-weight:600; cursor:pointer; }
.btn-confirm-red:hover { background:#b02a37; }
</style>
</head>
<body>

<div class="sidebar">
    <div class="sidebar-logo"><i class="fa-solid fa-house-chimney"></i> Smart Rent</div>
    <div class="sidebar-user">
       <div class="s-avatar">
    @if(Auth::user()->profile_picture)
        <img src="{{ asset('storage/'.Auth::user()->profile_picture) }}"
             style="width:100%; height:100%; object-fit:cover; border-radius:50%;">
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
        <a href="{{ route('profile') }}" class="nav-item"><i class="fa-solid fa-user"></i> Profile</a>
        <a href="{{ route('settings') }}" class="nav-item active"><i class="fa-solid fa-gear"></i> Settings</a>
        <div class="nav-divider"></div>
        <form action="{{ route('logout') }}" method="POST" id="logout-form" style="display:none;">@csrf</form>
        <a href="#" class="nav-item danger" onclick="event.preventDefault(); document.getElementById('logoutModal').classList.add('active');"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
    </nav>
</div>

<div class="main">
    <div class="topbar">
        <div class="topbar-title">Settings</div>
        <a href="{{ route('home') }}" class="back-home"><i class="fa-solid fa-house"></i> Back to Home</a>
    </div>

    <div class="content">

        @if(session('success'))
        <div class="alert-success"><i class="fa-solid fa-circle-check"></i> {{ session('success') }}</div>
        @endif
        @if($errors->any())
        <div class="alert-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $errors->first() }}</div>
        @endif

        <!-- CHANGE PASSWORD -->
        <div class="form-card">
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
                    <input type="password" name="password" placeholder="Enter new password (min 6 chars)" required>
                    @error('password') <span class="error-msg">{{ $message }}</span> @enderror
                </div>
                <div class="fgroup">
                    <label>Confirm New Password *</label>
                    <input type="password" name="password_confirmation" placeholder="Confirm new password" required>
                </div>
                <button type="submit" class="save-btn">
                    <i class="fa-solid fa-lock"></i> Update Password
                </button>
            </form>
        </div>

        <!-- DANGER ZONE -->
        <div class="danger-card">
            <div class="danger-title"><i class="fa-solid fa-triangle-exclamation"></i> Danger Zone</div>
            <p>Once you delete your account, all your data including listings will be permanently removed. This action cannot be undone.</p>
            <button class="btn-danger" onclick="document.getElementById('deleteAccountModal').classList.add('active')">
                <i class="fa-solid fa-user-xmark"></i> Delete My Account
            </button>
        </div>

    </div>
</div>

<!-- DELETE ACCOUNT MODAL -->
<div class="overlay" id="deleteAccountModal">
    <div class="modal-box">
        <div class="modal-icon red"><i class="fa-solid fa-user-xmark"></i></div>
        <h3>Delete Account?</h3>
        <p>Type <strong>DELETE</strong> to confirm. This will permanently remove all your data and listings.</p>
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
            <button class="btn-confirm-red" onclick="document.getElementById('logout-form').submit()">Logout</button>
        </div>
    </div>
</div>

<script>
function confirmDeleteAccount() {
    var input = document.getElementById('deleteConfirmInput').value;
    if (input === 'DELETE') {
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