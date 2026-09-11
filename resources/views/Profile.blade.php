<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile — Smart Rent</title>
    <!-- External FontAwesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"/>
    
    <!-- External CSS File Link -->
 <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    
     <link rel="stylesheet" href="{{ asset('css/profile.css') }}"> 
</head>
<body>

<!-- SIDEBAR -->
<div class="sidebar">

    <div class="sidebar-logo">
        <i class="fa-solid fa-house-chimney"></i> Smart Rent
    </div>

    <div class="sidebar-user">
        <div class="s-avatar">
            @if(Auth::user()->profile_picture)
                <img src="{{ asset('storage/'.Auth::user()->profile_picture) }}"
                     alt="Profile Picture">
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

        <a href="{{ route('dashboard') }}" class="nav-item">
            <i class="fa-solid fa-gauge"></i>
            Dashboard
        </a>

        <a href="{{ route('my.listings') }}" class="nav-item ">
    <i class="fa-solid fa-building"></i>
    My Listings
</a>

<a href="{{ route('property.create') }}" class="nav-item">
    <i class="fa-solid fa-circle-plus"></i>
    Add Property
</a>
        <a href="{{ route('booking.requests') }}" class="nav-item ">
            <i class="fa-solid fa-calendar-check"></i>
            Booking Requests

            @if(isset($pendingBookings) && $pendingBookings > 0)
                <span class="nav-badge">{{ $pendingBookings }}</span>
            @endif
        </a>

        <a href="{{ route('my.bookings') }}" class="nav-item">
            <i class="fa-solid fa-calendar-days"></i>
            My Bookings
        </a>

        <a href="{{ route('notifications') }}" class="nav-item">
            <i class="fa-solid fa-bell"></i>
            Notifications

            @if(isset($unreadNotifications) && $unreadNotifications > 0)
                <span class="nav-badge">{{ $unreadNotifications }}</span>
            @endif
        </a>

        <div class="nav-divider"></div>

        <a href="{{ route('profile') }}" class="nav-item active">
            <i class="fa-solid fa-user"></i>
            Profile
        </a>

        <a href="{{ route('settings') }}" class="nav-item">
            <i class="fa-solid fa-gear"></i>
            Settings
        </a>

        <div class="nav-divider"></div>

        <form action="{{ route('logout') }}"
              method="POST"
              id="logout-form"
              style="display:none;">
            @csrf
        </form>

        <a href="#"
           class="nav-item danger"
           onclick="event.preventDefault(); openLogoutConfirm();">

            <i class="fa-solid fa-right-from-bracket"></i>
            Logout
        </a>

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

        <!-- PAYMENT SETTINGS -->
        <div class="form-card">

            <div class="card-title">
                <i class="fa-solid fa-money-bill-transfer"></i>
                Payment Settings
            </div>

            <p style="margin:-10px 0 20px; color:#888; font-size:13px;">
                Add your payment details so renters can pay you after you approve their booking.
            </p>

            @if(session('payment_success'))
                <div class="alert-success">
                    <i class="fa-solid fa-circle-check"></i>
                    {{ session('payment_success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert-error">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    <ul style="margin:5px 0 0 20px;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('settings.payment') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="grid2">

                    <!-- JazzCash -->
                    <div class="fgroup">
                        <label><i class="fa-solid fa-mobile-screen-button"></i> JazzCash Number</label>
                        <input
                            type="text"
                            name="jazzcash_number"
                            value="{{ old('jazzcash_number', auth()->user()->jazzcash_number) }}"
                            placeholder="03XXXXXXXXX"
                        >
                        <span class="hint-msg">Enter the JazzCash number where renters can send payment.</span>
                    </div>

                    <!-- EasyPaisa -->
                    <div class="fgroup">
                        <label><i class="fa-solid fa-mobile-screen-button"></i> EasyPaisa Number</label>
                        <input
                            type="text"
                            name="easypaisa_number"
                            value="{{ old('easypaisa_number', auth()->user()->easypaisa_number) }}"
                            placeholder="03XXXXXXXXX"
                        >
                        <span class="hint-msg">Enter your EasyPaisa account/mobile number.</span>
                    </div>

                    <!-- Bank Name -->
                    <div class="fgroup">
                        <label><i class="fa-solid fa-building-columns"></i> Bank Name</label>
                        <input
                            type="text"
                            name="bank_name"
                            value="{{ old('bank_name', auth()->user()->bank_name) }}"
                            placeholder="e.g. HBL, Meezan Bank, UBL"
                        >
                    </div>

                    <!-- Account Title -->
                    <div class="fgroup">
                        <label><i class="fa-solid fa-user"></i> Bank Account Title</label>
                        <input
                            type="text"
                            name="bank_account_title"
                            value="{{ old('bank_account_title', auth()->user()->bank_account_title) }}"
                            placeholder="Account holder name"
                        >
                    </div>

                    <!-- Account Number -->
                    <div class="fgroup" style="grid-column: 1 / -1;">
                        <label><i class="fa-solid fa-credit-card"></i> Bank Account Number</label>
                        <input
                            type="text"
                            name="bank_account_number"
                            value="{{ old('bank_account_number', auth()->user()->bank_account_number) }}"
                            placeholder="Enter bank account number"
                        >
                    </div>

                </div>

                <button type="submit" class="save-btn" style="margin-top:10px;">
                    <i class="fa-solid fa-floppy-disk"></i> Save Payment Details
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