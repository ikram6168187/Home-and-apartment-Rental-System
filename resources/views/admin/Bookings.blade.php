@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin_bookings.css') }}">
@endpush

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
                <p><i class="fa-solid fa-location-dot icon-loc"></i>
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
                <div class="b-time">{{ $booking->created_at->diffForHumans() }}</div>
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