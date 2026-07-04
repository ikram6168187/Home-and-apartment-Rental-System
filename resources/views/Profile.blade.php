
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile — Smart Rent</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"/>
<style>
* { margin:0; padding:0; box-sizing:border-box; font-family:'Segoe UI',Arial,sans-serif; }
body { display:flex; height:100vh; overflow:hidden; background:#f4f6f9; }

/* SIDEBAR */
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

/* MAIN */
.main { margin-left:220px; flex:1; display:flex; flex-direction:column; height:100vh; overflow:hidden; }
.topbar { background:#fff; border-bottom:1px solid #eee; padding:13px 28px; display:flex; align-items:center; justify-content:space-between; flex-shrink:0; }
.topbar-title { font-size:16px; font-weight:600; color:#1a1a2e; }
.back-home { display:flex; align-items:center; gap:6px; font-size:13px; color:#666; background:#f5f5f5; border:1px solid #e0e0e0; padding:7px 16px; border-radius:20px; text-decoration:none; transition:0.2s; font-weight:500; }
.back-home:hover { background:#eee; color:#333; }
.content { flex:1; overflow-y:auto; padding:28px; }

/* ALERTS */
.alert-success { background:#f0fff4; border:1px solid #b2dfdb; color:#1b5e20; border-radius:10px; padding:12px 18px; margin-bottom:20px; font-size:13px; display:flex; align-items:center; gap:8px; }
.alert-error   { background:#fff0f0; border:1px solid #ffcdd2; color:#c0392b; border-radius:10px; padding:12px 18px; margin-bottom:20px; font-size:13px; display:flex; align-items:center; gap:8px; }

/* PROFILE HEADER CARD */
.profile-header {
    background: linear-gradient(135deg, #2d2926 0%, #5c4a3a 100%);
    border-radius: 16px;
    padding: 28px;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 24px;
    position: relative;
    overflow: hidden;
}
.profile-header::before {
    content:''; position:absolute;
    width:200px; height:200px; border-radius:50%;
    background:rgba(255,255,255,0.04);
    top:-60px; right:-40px;
}
.profile-pic-wrap { position:relative; flex-shrink:0; }
.profile-pic {
    width:90px; height:90px; border-radius:50%;
    border:3px solid rgba(255,255,255,0.3);
    overflow:hidden; background:#c8a882;
    display:flex; align-items:center; justify-content:center;
    font-size:32px; font-weight:700; color:#2d2926;
}
.profile-pic img { width:100%; height:100%; object-fit:cover; }
.profile-info h2 { color:#fff; font-size:20px; font-weight:700; margin-bottom:4px; }
.profile-info p  { color:rgba(255,255,255,0.65); font-size:13px; margin-bottom:10px; }
.profile-badges  { display:flex; gap:8px; flex-wrap:wrap; }
.p-badge {
    display:inline-flex; align-items:center; gap:5px;
    background:rgba(255,255,255,0.12);
    color:rgba(255,255,255,0.85);
    padding:4px 12px; border-radius:20px;
    font-size:11px; font-weight:600;
    border:1px solid rgba(255,255,255,0.15);
}

/* STATS */
.stats-row { display:grid; grid-template-columns:repeat(3,1fr); gap:14px; margin-bottom:20px; }
.stat-mini { background:#fff; border-radius:12px; padding:16px 20px; border:1px solid #eee; display:flex; align-items:center; gap:14px; }
.stat-icon-sm { width:40px; height:40px; border-radius:10px; display:flex; align-items:center; justify-content:center; font-size:18px; flex-shrink:0; }
.stat-icon-sm.brown { background:#f5ede0; color:#8a5c30; }
.stat-icon-sm.green { background:#e8f5e9; color:#2e7d32; }
.stat-icon-sm.blue  { background:#e3f2fd; color:#1565c0; }
.stat-mini h3 { font-size:20px; font-weight:700; color:#1a1a2e; margin:0 0 2px; }
.stat-mini p  { font-size:12px; color:#888; margin:0; }

/* FORM */
.form-card { background:#fff; border-radius:16px; padding:28px; border:1px solid #eee; margin-bottom:20px; }
.card-title { font-size:15px; font-weight:700; color:#1a1a2e; margin-bottom:20px; padding-bottom:12px; border-bottom:2px solid #f0f0f0; display:flex; align-items:center; gap:8px; }
.card-title i { color:rgb(51,47,46); font-size:16px; }
.grid2 { display:grid; grid-template-columns:1fr 1fr; gap:16px; }
.fgroup { margin-bottom:16px; }
.fgroup label { display:block; font-size:12px; font-weight:600; color:#555; margin-bottom:5px; }
.fgroup input,
.fgroup select,
.fgroup textarea {
    width:100%; padding:11px 14px;
    border:1.5px solid #e0e0e0; border-radius:10px;
    font-size:14px; color:#333; outline:none;
    transition:0.2s; background:#fafafa;
    font-family:'Segoe UI',Arial,sans-serif;
}
.fgroup input:focus,
.fgroup select:focus,
.fgroup textarea:focus {
    border-color:rgb(51,47,46);
    background:#fff;
    box-shadow:0 0 0 3px rgba(51,47,46,0.08);
}
.fgroup input:disabled { background:#f0f0f0; color:#999; cursor:not-allowed; }
.fgroup textarea { resize:vertical; min-height:80px; }
.input-prefix {
    display:flex; align-items:center;
    border:1.5px solid #e0e0e0; border-radius:10px;
    overflow:hidden; background:#fafafa;
    transition:0.2s;
}
.input-prefix:focus-within { border-color:rgb(51,47,46); background:#fff; box-shadow:0 0 0 3px rgba(51,47,46,0.08); }
.prefix-label { padding:0 12px; background:#f0f0f0; color:#666; font-size:13px; font-weight:600; border-right:1.5px solid #e0e0e0; height:44px; display:flex; align-items:center; white-space:nowrap; }
.input-prefix input { border:none; outline:none; background:transparent; padding:11px 14px; font-size:14px; color:#333; width:100%; }
.error-msg { color:#dc3545; font-size:11px; margin-top:3px; display:block; }
.hint-msg   { color:#888; font-size:11px; margin-top:3px; display:block; }

/* PICTURE UPLOAD */
.pic-upload-wrap { display:flex; align-items:center; gap:16px; }
.pic-preview {
    width:70px; height:70px; border-radius:50%;
    border:2px solid #eee; overflow:hidden;
    background:#f0ebe4; display:flex;
    align-items:center; justify-content:center;
    flex-shrink:0; font-size:24px; color:#b09070;
}
.pic-preview img { width:100%; height:100%; object-fit:cover; }
.pic-upload-btn {
    display:flex; align-items:center; gap:6px;
    background:#f5ede0; color:#8a5c30;
    padding:9px 18px; border-radius:20px;
    font-size:13px; font-weight:600;
    cursor:pointer; transition:0.2s;
    border:none;
}
.pic-upload-btn:hover { background:#e8d5b7; }
.pic-input { display:none; }

/* SAVE BTN */
.save-btn {
    width:100%; padding:13px; background:rgb(51,47,46);
    color:#fff; border:none; border-radius:10px;
    font-size:15px; font-weight:600; cursor:pointer;
    transition:0.2s; display:flex;
    align-items:center; justify-content:center; gap:8px;
    margin-top:4px;
}
.save-btn:hover { background:#1a1a1a; transform:translateY(-1px); }

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

@media(max-width:768px) {
    .grid2 { grid-template-columns:1fr; }
    .stats-row { grid-template-columns:1fr 1fr; }
    .profile-header { flex-direction:column; text-align:center; }
}

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
                <a href="{{ route('notifications') }}" class="nav-item">
            <i class="fa-solid fa-bell"></i> Notifications
            @if(isset($unreadNotifications) && $unreadNotifications > 0)
                <span class="nav-badge">{{ $unreadNotifications }}</span>
            @endif
        </a>
        <a href="{{ route('profile') }}" class="nav-item active"><i class="fa-solid fa-user"></i> Profile</a>
        <a href="{{ route('settings') }}" class="nav-item"><i class="fa-solid fa-gear"></i> Settings</a>
        <div class="nav-divider"></div>
        <form action="{{ route('logout') }}" method="POST" id="logout-form" style="display:none;">@csrf</form>
        <a href="#" class="nav-item danger" onclick="event.preventDefault(); openLogoutConfirm();"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
    </nav>
</div>

<!-- MAIN -->
<div class="main">
    <div class="topbar">
        <div class="topbar-title">My Profile</div>
        <a href="{{ route('home') }}" class="back-home"><i class="fa-solid fa-house"></i> Back to Home</a>
    </div>

    <div class="content">

        @if(session('success'))
        <div class="alert-success"><i class="fa-solid fa-circle-check"></i> {{ session('success') }}</div>
        @endif
        @if($errors->any())
        <div class="alert-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $errors->first() }}</div>
        @endif

        <!-- PROFILE HEADER -->
        <div class="profile-header">
            <div class="profile-pic-wrap">
                <div class="profile-pic">
                    @if(Auth::user()->profile_picture)
                        <img src="{{ asset('storage/'.Auth::user()->profile_picture) }}" alt="">
                    @else
                        {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                    @endif
                </div>
            </div>
            <div class="profile-info">
                <h2>{{ Auth::user()->name }}</h2>
                <p>{{ Auth::user()->email }}</p>
                <div class="profile-badges">
                    <span class="p-badge"><i class="fa-solid fa-shield-halved"></i> {{ ucfirst(Auth::user()->role) }}</span>
                    @if(Auth::user()->city)
                    <span class="p-badge"><i class="fa-solid fa-location-dot"></i> {{ Auth::user()->city }}</span>
                    @endif
                    @if(Auth::user()->phone)
                    <span class="p-badge"><i class="fa-solid fa-phone"></i> {{ Auth::user()->phone }}</span>
                    @endif
                    <span class="p-badge"><i class="fa-solid fa-calendar"></i> Joined {{ \Carbon\Carbon::parse(Auth::user()->created_at)->format('M Y') }}</span>
                </div>
            </div>
        </div>

        <!-- STATS -->
        <div class="stats-row">
            <div class="stat-mini">
                <div class="stat-icon-sm brown"><i class="fa-solid fa-building"></i></div>
                <div><h3>{{ $totalListings }}</h3><p>Total Listings</p></div>
            </div>
            <div class="stat-mini">
                <div class="stat-icon-sm green"><i class="fa-solid fa-circle-check"></i></div>
                <div><h3>{{ $activeListings }}</h3><p>Active Listings</p></div>
            </div>
            <div class="stat-mini">
                <div class="stat-icon-sm blue"><i class="fa-solid fa-calendar-days"></i></div>
                <div>
                    <h3>{{ \Carbon\Carbon::parse(Auth::user()->created_at)->diffInDays(now()) }}</h3>
                    <p>Days on Platform</p>
                </div>
            </div>
        </div>

        <!-- FORM -->
        <div class="form-card">
            <div class="card-title"><i class="fa-solid fa-user-pen"></i> Update Profile</div>

            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                @csrf @method('PUT')

                <!-- PROFILE PICTURE -->
                <div class="fgroup" style="margin-bottom:20px;">
                    <label>Profile Picture</label>
                    <div class="pic-upload-wrap">
                        <div class="pic-preview" id="picPreview">
                            @if(Auth::user()->profile_picture)
                                <img src="{{ asset('storage/'.Auth::user()->profile_picture) }}" id="picImg" alt="">
                            @else
                                <i class="fa-solid fa-user" id="picIcon"></i>
                            @endif
                        </div>
                        <div>
                            <button type="button" class="pic-upload-btn" onclick="document.getElementById('picInput').click()">
                                <i class="fa-solid fa-camera"></i> Change Photo
                            </button>
                            <input type="file" name="profile_picture" id="picInput" class="pic-input" accept="image/*" onchange="previewPic(event)">
                            <span class="hint-msg">JPG, PNG, WEBP — Max 2MB</span>
                        </div>
                    </div>
                </div>

                <div class="grid2">
                    <!-- NAME -->
                    <div class="fgroup">
                        <label>Full Name *</label>
                        <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}" required placeholder="Your full name">
                        @error('name') <span class="error-msg">{{ $message }}</span> @enderror
                    </div>

                    <!-- EMAIL -->
                    <div class="fgroup">
                        <label>Email Address</label>
                        <input type="email" value="{{ Auth::user()->email }}" disabled>
                        <span class="hint-msg"><i class="fa-solid fa-lock" style="font-size:10px;"></i> Email cannot be changed</span>
                    </div>

                    <!-- PHONE -->
                    <div class="fgroup">
                        <label>Phone Number</label>
                        <div class="input-prefix">
                            <span class="prefix-label"><i class="fa-solid fa-phone"></i> &nbsp;+92</span>
                            <input type="text" name="phone" value="{{ old('phone', ltrim(Auth::user()->phone ?? '', '+92')) }}" placeholder="3XX XXXXXXX">
                        </div>
                        @error('phone') <span class="error-msg">{{ $message }}</span> @enderror
                    </div>

                    <!-- WHATSAPP -->
                    <div class="fgroup">
                        <label>WhatsApp Number</label>
                        <div class="input-prefix">
                            <span class="prefix-label" style="color:#25D366;"><i class="fa-brands fa-whatsapp"></i> &nbsp;+92</span>
                            <input type="text" name="whatsapp" value="{{ old('whatsapp', ltrim(Auth::user()->whatsapp ?? '', '+92')) }}" placeholder="3XX XXXXXXX">
                        </div>
                        @error('whatsapp') <span class="error-msg">{{ $message }}</span> @enderror
                    </div>

                    <!-- CITY -->
                    <div class="fgroup">
                        <label>City</label>
                        <select name="city">
                            <option value="">Select City</option>
                            @foreach(['Lahore','Karachi','Islamabad','Rawalpindi','Gujranwala','Faisalabad','Peshawar','Quetta','Multan','Sialkot','Hyderabad','Bahawalpur'] as $city)
                                <option value="{{ $city }}" {{ old('city', Auth::user()->city) == $city ? 'selected' : '' }}>{{ $city }}</option>
                            @endforeach
                        </select>
                        @error('city') <span class="error-msg">{{ $message }}</span> @enderror
                    </div>

                    <!-- ADDRESS -->
                    <div class="fgroup">
                        <label>Address</label>
                        <input type="text" name="address" value="{{ old('address', Auth::user()->address) }}" placeholder="Street, Area, City">
                        @error('address') <span class="error-msg">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- BIO -->
                <div class="fgroup">
                    <label>Bio <span style="color:#aaa; font-weight:400;">(Optional)</span></label>
                    <textarea name="bio" placeholder="Tell us a little about yourself...">{{ old('bio', Auth::user()->bio) }}</textarea>
                    @error('bio') <span class="error-msg">{{ $message }}</span> @enderror
                </div>

                <button type="submit" class="save-btn">
                    <i class="fa-solid fa-floppy-disk"></i> Save Changes
                </button>

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
            <button class="btn-logout-co" onclick="document.getElementById('logout-form').submit()"><i class="fa-solid fa-right-from-bracket"></i> Logout</button>
        </div>
    </div>
</div>

<script>
function previewPic(event) {
    var file = event.target.files[0];
    if (!file) return;
    var reader = new FileReader();
    reader.onload = function(e) {
        var preview = document.getElementById('picPreview');
        preview.innerHTML = '<img src="' + e.target.result + '" style="width:100%;height:100%;object-fit:cover;">';
    };
    reader.readAsDataURL(file);
}
function openLogoutConfirm()  { document.getElementById('logoutConfirm').classList.add('active'); document.body.style.overflow='hidden'; }
function closeLogoutConfirm() { document.getElementById('logoutConfirm').classList.remove('active'); document.body.style.overflow=''; }
document.addEventListener('keydown', function(e) { if(e.key==='Escape') closeLogoutConfirm(); });
</script>
</body>
</html>
