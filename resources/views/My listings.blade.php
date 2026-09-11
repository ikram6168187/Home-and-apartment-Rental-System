<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Listings — Smart Rent</title>

    <!-- External Fonts & CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"/>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/my_listing.css') }}">

</head>
<body>

<!-- SIDEBAR -->

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

        <a href="{{ route('my.listings') }}" class="nav-item active">
    <i class="fa-solid fa-building"></i>
    My Listings
</a>

<a href="{{ route('property.create') }}" class="nav-item">
    <i class="fa-solid fa-circle-plus"></i>
    Add Property
</a>
        <a href="{{ route('booking.requests') }}" class="nav-item">
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

        <a href="{{ route('profile') }}" class="nav-item">
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