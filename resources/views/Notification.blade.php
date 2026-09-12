<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications — Smart Rent</title>
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"/>
    <!-- External CSS -->
    <link rel="stylesheet" href="{{ asset('css/notification.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
</head>
<body>

<!-- SIDEBAR -->
@include('sidebar')

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