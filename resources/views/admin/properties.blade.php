@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin_properties.css') }}">
@endpush

@include('admin.admin_sidebar')

<div class="main">
    <div class="topbar">
        <div class="topbar-title">Properties Management</div>
        <div class="topbar-right">
            <span class="admin-access-badge"><i class="fa-solid fa-shield-halved"></i> Admin Access</span>
        </div>
    </div>

    <div class="content">

        @if(session('success'))
        <div class="alert-success"><i class="fa-solid fa-circle-check"></i> {{ session('success') }}</div>
        @endif

        <div class="filter-bar">
            <button class="filter-btn active" onclick="filterProps('all', this)">All ({{ $properties->count() }})</button>
            <button class="filter-btn" onclick="filterProps('active', this)">Active ({{ $properties->where('status','active')->count() }})</button>
            <button class="filter-btn" onclick="filterProps('inactive', this)">Inactive ({{ $properties->where('status','inactive')->count() }})</button>
            <input type="text" class="search-input" id="propSearch" placeholder="Search properties..." onkeyup="searchProps()">
        </div>

        <div class="prop-grid" id="propGrid">
            @foreach($properties as $property)
            <div class="prop-card" data-status="{{ $property->status }}" data-title="{{ strtolower($property->title) }}" data-city="{{ strtolower($property->city) }}">

                <div class="prop-img">
                    @if($property->image)
                        <img src="{{ asset('storage/'.$property->image) }}" alt="">
                    @else
                        <i class="fa-solid fa-building"></i>
                    @endif
                    <span class="type-badge">{{ ucfirst($property->type) }}</span>
                    <span class="status-badge-card {{ $property->status == 'active' ? 's-active' : 's-inactive' }}">
                        {{ ucfirst($property->status) }}
                    </span>
                </div>

                <div class="prop-body">
                    <h4 class="prop-title">{{ $property->title }}</h4>
                    <p class="prop-loc"><i class="fa-solid fa-location-dot icon-loc"></i> {{ $property->location }}, {{ $property->city }}</p>
                    <p class="prop-owner"><i class="fa-solid fa-user"></i> {{ $property->user->name ?? 'Unknown' }}</p>
                    <p class="prop-price">₨ {{ number_format($property->price) }} <span>/month</span></p>

                    <div class="prop-actions">
                        <form action="{{ route('admin.properties.toggle', $property->id) }}" method="POST">
                            @csrf @method('PATCH')
                            <button type="submit" class="{{ $property->status == 'active' ? 'btn-toggle-active' : 'btn-toggle-inactive' }}">
                                @if($property->status == 'active')
                                    <i class="fa-solid fa-toggle-off"></i> Deactivate
                                @else
                                    <i class="fa-solid fa-toggle-on"></i> Activate
                                @endif
                            </button>
                        </form>

                        <button class="btn-del" onclick="openDeleteModal({{ $property->id }}, '{{ $property->title }}')">
                            <i class="fa-solid fa-trash"></i> Delete
                        </button>
                        <form id="del-prop-{{ $property->id }}" action="{{ route('admin.properties.delete', $property->id) }}" method="POST" class="hidden-form">
                            @csrf @method('DELETE')
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

    </div>
</div>

<div class="del-overlay" id="deleteModal">
    <div class="del-box">
        <div class="del-icon"><i class="fa-solid fa-building-circle-xmark"></i></div>
        <h3>Delete Property?</h3>
        <p id="delMsg">This property will be permanently removed.</p>
        <div class="del-btns">
            <button class="btn-cancel-d" onclick="closeDeleteModal()">Cancel</button>
            <button class="btn-confirm-d" id="delBtn"><i class="fa-solid fa-trash"></i> Delete</button>
        </div>
    </div>
</div>

<script>
function filterProps(status, btn) {
    document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    document.querySelectorAll('.prop-card').forEach(card => {
        card.style.display = (status === 'all' || card.dataset.status === status) ? 'block' : 'none';
    });
}
function searchProps() {
    var val = document.getElementById('propSearch').value.toLowerCase();
    document.querySelectorAll('.prop-card').forEach(card => {
        card.style.display = (card.dataset.title.includes(val) || card.dataset.city.includes(val)) ? 'block' : 'none';
    });
}
function openDeleteModal(id, title) {
    document.getElementById('delMsg').textContent = 'Delete "' + title + '"? This cannot be undone.';
    document.getElementById('delBtn').onclick = function() { document.getElementById('del-prop-' + id).submit(); };
    document.getElementById('deleteModal').classList.add('active');
}
function closeDeleteModal() { document.getElementById('deleteModal').classList.remove('active'); }
document.addEventListener('keydown', function(e) { if(e.key==='Escape') closeDeleteModal(); });
</script>