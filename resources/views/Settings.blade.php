<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings — Smart Rent</title>
    
    <!-- FontAwesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"/>
    
    <!-- External CSS Linked -->
    <link rel="stylesheet" href="{{ asset('css/settings.css') }}">
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

        <a href="{{ route('profile') }}" class="nav-item ">
            <i class="fa-solid fa-user"></i>
            Profile
        </a>

        <a href="{{ route('settings') }}" class="nav-item active">
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
<!-- MAIN CONTENT -->
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