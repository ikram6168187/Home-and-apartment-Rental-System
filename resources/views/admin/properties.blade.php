
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Properties — Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"/>
<style>
.filter-bar { display:flex; gap:10px; margin-bottom:20px; flex-wrap:wrap; }
.filter-btn { padding:7px 18px; border-radius:20px; border:1.5px solid #e0e0e0; background:#fff; font-size:12px; font-weight:600; color:#666; cursor:pointer; transition:0.2s; }
.filter-btn.active, .filter-btn:hover { background:#1a1209; color:#fff; border-color:#1a1209; }
.search-input { flex:1; padding:10px 16px; border:1.5px solid #e0e0e0; border-radius:10px; font-size:14px; outline:none; min-width:200px; }
.search-input:focus { border-color:#1a1209; }
.prop-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(300px,1fr)); gap:16px; }
.prop-card { background:#fff; border-radius:14px; overflow:hidden; border:1px solid #eee; transition:0.2s; }
.prop-card:hover { box-shadow:0 4px 16px rgba(0,0,0,0.08); }
.prop-img { height:160px; overflow:hidden; position:relative; background:#f0ebe4; display:flex; align-items:center; justify-content:center; }
.prop-img img { width:100%; height:100%; object-fit:cover; }
.prop-img i { font-size:40px; color:#c8a882; }
.type-badge { position:absolute; top:10px; left:10px; background:#1a1209; color:#fff; padding:3px 10px; border-radius:20px; font-size:10px; font-weight:600; text-transform:capitalize; }
.status-badge-card { position:absolute; top:10px; right:10px; padding:3px 10px; border-radius:20px; font-size:10px; font-weight:600; }
.s-active { background:#e8f5e9; color:#2e7d32; }
.s-inactive { background:#fff3e0; color:#e65100; }
.prop-body { padding:14px; }
.prop-title { font-size:14px; font-weight:700; color:#1a1209; margin:0 0 4px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }
.prop-loc { font-size:12px; color:#888; margin:0 0 8px; display:flex; align-items:center; gap:4px; }
.prop-owner { font-size:11px; color:#888; margin:0 0 10px; display:flex; align-items:center; gap:5px; }
.prop-owner i { color:#c8a882; }
.prop-price { font-size:16px; font-weight:800; color:#1a1209; margin-bottom:12px; }
.prop-price span { font-size:11px; color:#888; font-weight:400; }
.prop-actions { display:flex; gap:8px; }
.btn-toggle-active { background:#fff3e0; color:#e65100; border:1px solid #ffe0b2; padding:6px 12px; border-radius:20px; font-size:11px; font-weight:600; cursor:pointer; transition:0.2s; }
.btn-toggle-active:hover { background:#e65100; color:#fff; border-color:#e65100; }
.btn-toggle-inactive { background:#e8f5e9; color:#2e7d32; border:1px solid #c8e6c9; padding:6px 12px; border-radius:20px; font-size:11px; font-weight:600; cursor:pointer; transition:0.2s; }
.btn-toggle-inactive:hover { background:#2e7d32; color:#fff; border-color:#2e7d32; }
.btn-del { background:#fff0f0; color:#c0392b; border:1px solid #ffcdd2; padding:6px 12px; border-radius:20px; font-size:11px; font-weight:600; cursor:pointer; transition:0.2s; margin-left:auto; }
.btn-del:hover { background:#dc3545; color:#fff; border-color:#dc3545; }

.del-overlay { display:none; position:fixed; inset:0; background:rgba(0,0,0,0.5); z-index:9999; justify-content:center; align-items:center; }
.del-overlay.active { display:flex; }
.del-box { background:#fff; border-radius:16px; padding:36px 32px 28px; width:380px; text-align:center; box-shadow:0 16px 50px rgba(0,0,0,0.2); }
.del-icon { width:64px; height:64px; border-radius:50%; background:#fff0f0; display:flex; align-items:center; justify-content:center; margin:0 auto 16px; font-size:28px; color:#dc3545; }
.del-box h3 { font-size:20px; font-weight:700; color:#1a1209; margin-bottom:8px; }
.del-box p  { font-size:13px; color:#888; margin-bottom:24px; }
.del-btns   { display:flex; gap:12px; }
.btn-cancel-d { flex:1; padding:11px; border:1.5px solid #ddd; border-radius:30px; background:#fff; color:#555; font-size:14px; font-weight:600; cursor:pointer; }
.btn-confirm-d { flex:1; padding:11px; border:none; border-radius:30px; background:#dc3545; color:#fff; font-size:14px; font-weight:600; cursor:pointer; }
</style>
</head>
<body>

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
                    <p class="prop-loc"><i class="fa-solid fa-location-dot" style="color:#8a7060;"></i> {{ $property->location }}, {{ $property->city }}</p>
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
                        <form id="del-prop-{{ $property->id }}" action="{{ route('admin.properties.delete', $property->id) }}" method="POST" style="display:none;">
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
</body>
</html>
