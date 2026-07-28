<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookings — Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"/>
<style>
.stat-row { display:grid; grid-template-columns:repeat(3,1fr); gap:14px; margin-bottom:20px; }
.stat-card { background:#fff; border-radius:12px; padding:16px 20px; border:1px solid #eee; display:flex; align-items:center; gap:14px; }
.stat-icon { width:42px; height:42px; border-radius:12px; display:flex; align-items:center; justify-content:center; font-size:18px; flex-shrink:0; }
.stat-icon.orange { background:#fff3e0; color:#e65100; }
.stat-icon.green  { background:#e8f5e9; color:#2e7d32; }
.stat-icon.red    { background:#fff0f0; color:#c0392b; }
.stat-info h3 { font-size:22px; font-weight:700; color:#1a1209; margin:0 0 2px; }
.stat-info p  { font-size:12px; color:#888; margin:0; }
.filter-bar { display:flex; gap:8px; margin-bottom:20px; flex-wrap:wrap; align-items:center; }
.filter-btn { padding:7px 18px; border-radius:20px; border:1.5px solid #e0e0e0; background:#fff; font-size:12px; font-weight:600; color:#666; cursor:pointer; transition:0.2s; }
.filter-btn.active,.filter-btn:hover { background:#1a1209; color:#fff; border-color:#1a1209; }
.search-input { flex:1; padding:10px 16px; border:1.5px solid #e0e0e0; border-radius:10px; font-size:14px; outline:none; min-width:200px; }
.booking-card { background:#fff; border:1px solid #eee; border-radius:14px; padding:18px 20px; margin-bottom:12px; display:flex; align-items:center; gap:16px; transition:0.2s; }
.booking-card:hover { box-shadow:0 4px 16px rgba(0,0,0,0.07); }
.b-thumb { width:70px; height:56px; border-radius:10px; overflow:hidden; flex-shrink:0; background:#f0ebe4; display:flex; align-items:center; justify-content:center; font-size:22px; color:#c8a882; }
.b-thumb img { width:100%; height:100%; object-fit:cover; }
.b-info { flex:1; }
.b-info h4 { font-size:14px; font-weight:700; color:#1a1209; margin:0 0 4px; }
.b-info p  { font-size:12px; color:#888; margin:0 0 6px; }
.b-meta { display:flex; gap:14px; flex-wrap:wrap; }
.meta-item { display:flex; align-items:center; gap:4px; font-size:12px; color:#666; }
.meta-item i { color:#8a7060; font-size:12px; }
.b-right { text-align:right; flex-shrink:0; }
.b-price { font-size:15px; font-weight:700; color:#1a1209; margin-bottom:6px; }
.b-price span { font-size:11px; color:#888; font-weight:400; }
.badge { font-size:11px; padding:4px 12px; border-radius:20px; font-weight:600; }
.badge-pending   { background:#fff3e0; color:#e65100; }
.badge-confirmed { background:#e8f5e9; color:#2e7d32; }
.badge-cancelled { background:#fff0f0; color:#c0392b; }
.empty-state { text-align:center; padding:60px; background:#fff; border-radius:14px; border:1px solid #eee; }
.empty-state i { font-size:52px; color:#ddd; display:block; margin-bottom:16px; }
.empty-state h3 { font-size:16px; color:#888; }
</style>
</head>
<body>

@include('admin.admin_sidebar')

<div class="main">
    <div class="topbar">
        <div class="topbar-title">Bookings Management</div>
        <div class="topbar-right">
            <span class="admin-access-badge"><i class="fa-solid fa-shield-halved"></i> Admin Access</span>
        </div>
    </div>

    <div class="content">

        @if(session('success'))
        <div class="alert-success"><i class="fa-solid fa-circle-check"></i> {{ session('success') }}</div>
        @endif

        <!-- STATS -->
        <div class="stat-row">
            <div class="stat-card">
                <div class="stat-icon orange"><i class="fa-solid fa-clock"></i></div>
                <div class="stat-info"><h3>{{ $pending }}</h3><p>Pending</p></div>
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
            <input type="text" class="search-input" placeholder="Search bookings..." onkeyup="searchBookings(this.value)">
        </div>

        <!-- BOOKINGS -->
        @forelse($bookings as $booking)
        <div class="booking-card" data-status="{{ $booking->status }}">

            <div class="b-thumb">
                @if($booking->property && $booking->property->image)
                    <img src="{{ asset('storage/'.$booking->property->image) }}" alt="">
                @else
                    <i class="fa-solid fa-building"></i>
                @endif
            </div>

            <div class="b-info">
                <h4>{{ $booking->property->title ?? 'N/A' }}</h4>
                <p><i class="fa-solid fa-location-dot" style="color:#8a7060; font-size:11px;"></i>
                    {{ $booking->property->location ?? '' }}, {{ $booking->property->city ?? '' }}
                </p>
                <div class="b-meta">
                    <div class="meta-item"><i class="fa-solid fa-user"></i> {{ $booking->user->name ?? 'N/A' }}</div>
                    <div class="meta-item"><i class="fa-solid fa-calendar"></i> {{ $booking->check_in->format('d M Y') }} → {{ $booking->check_out->format('d M Y') }}</div>
                    <div class="meta-item"><i class="fa-solid fa-moon"></i> {{ $booking->check_in->diffInDays($booking->check_out) }} nights</div>
                    <div class="meta-item"><i class="fa-solid fa-users"></i> {{ $booking->guests }} guests</div>
                </div>
            </div>

            <div class="b-right">
                <div class="b-price">₨ {{ number_format($booking->property->price ?? 0) }}<span>/mo</span></div>
                <span class="badge badge-{{ $booking->status }}">{{ ucfirst($booking->status) }}</span>
                <div style="font-size:11px; color:#aaa; margin-top:6px;">{{ $booking->created_at->diffForHumans() }}</div>
            </div>

        </div>
        @empty
        <div class="empty-state">
            <i class="fa-solid fa-calendar-xmark"></i>
            <h3>No bookings yet</h3>
        </div>
        @endforelse

    </div>
</div>

<script>
function filterBookings(status, btn) {
    document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    document.querySelectorAll('.booking-card').forEach(card => {
        card.style.display = (status === 'all' || card.dataset.status === status) ? 'flex' : 'none';
    });
}
function searchBookings(val) {
    val = val.toLowerCase();
    document.querySelectorAll('.booking-card').forEach(card => {
        card.style.display = card.textContent.toLowerCase().includes(val) ? 'flex' : 'none';
    });
}
</script>
</body>
</html>
