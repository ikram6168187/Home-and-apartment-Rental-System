<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages — Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"/>
<style>
.filter-bar { display:flex; gap:8px; margin-bottom:20px; align-items:center; }
.filter-btn { padding:7px 18px; border-radius:20px; border:1.5px solid #e0e0e0; background:#fff; font-size:12px; font-weight:600; color:#666; cursor:pointer; transition:0.2s; }
.filter-btn.active,.filter-btn:hover { background:#1a1209; color:#fff; border-color:#1a1209; }
.search-input { flex:1; padding:10px 16px; border:1.5px solid #e0e0e0; border-radius:10px; font-size:14px; outline:none; }
.msg-card { background:#fff; border:1px solid #eee; border-radius:14px; padding:20px; margin-bottom:12px; transition:0.2s; }
.msg-card:hover { box-shadow:0 4px 16px rgba(0,0,0,0.07); }
.msg-card.unread { border-left:3px solid #1a1209; background:#fafaf8; }
.msg-top { display:flex; align-items:flex-start; gap:14px; margin-bottom:12px; }
.msg-avatar { width:42px; height:42px; border-radius:50%; background:linear-gradient(135deg,#1a1209,#8a6040); display:flex; align-items:center; justify-content:center; font-size:15px; font-weight:700; color:#fff; flex-shrink:0; }
.msg-info { flex:1; }
.msg-name { font-size:14px; font-weight:700; color:#1a1209; margin:0 0 2px; }
.msg-email { font-size:12px; color:#888; margin:0; }
.msg-right { text-align:right; }
.msg-time { font-size:11px; color:#aaa; margin-bottom:6px; }
.unread-dot { width:8px; height:8px; border-radius:50%; background:#1a1209; display:inline-block; }
.subject-badge { background:#f5ede0; color:#8a5c30; padding:4px 12px; border-radius:20px; font-size:12px; font-weight:600; margin-bottom:10px; display:inline-block; }
.msg-body { font-size:13px; color:#555; line-height:1.7; background:#f8f8f8; border-radius:10px; padding:12px 16px; border-left:3px solid #e0d8d0; }
.msg-footer { display:flex; align-items:center; justify-content:space-between; margin-top:12px; }
.msg-contact { font-size:12px; color:#888; display:flex; align-items:center; gap:16px; }
.msg-contact span { display:flex; align-items:center; gap:5px; }
.msg-contact i { color:#8a7060; }
.btn-del { background:#fff0f0; color:#c0392b; border:1px solid #ffcdd2; padding:6px 16px; border-radius:20px; font-size:12px; font-weight:600; cursor:pointer; transition:0.2s; display:flex; align-items:center; gap:5px; }
.btn-del:hover { background:#dc3545; color:#fff; border-color:#dc3545; }
.empty-state { text-align:center; padding:60px; background:#fff; border-radius:14px; border:1px solid #eee; }
.empty-state i { font-size:52px; color:#ddd; display:block; margin-bottom:16px; }
.empty-state h3 { font-size:16px; color:#888; }

/* DELETE MODAL */
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
        <div class="topbar-title">
            Messages
            @php $unread = $messages->where('is_read', false)->count(); @endphp
            @if($unread > 0)
                <span style="background:#dc3545; color:#fff; font-size:11px; padding:2px 8px; border-radius:10px; margin-left:8px; font-weight:500;">
                    {{ $unread }} unread
                </span>
            @endif
        </div>
        <div class="topbar-right">
            <span class="admin-access-badge"><i class="fa-solid fa-shield-halved"></i> Admin Access</span>
        </div>
    </div>

    <div class="content">

        @if(session('success'))
        <div class="alert-success"><i class="fa-solid fa-circle-check"></i> {{ session('success') }}</div>
        @endif

        <!-- FILTER -->
        <div class="filter-bar">
            <button class="filter-btn active" onclick="filterMsgs('all', this)">All ({{ $messages->count() }})</button>
            <button class="filter-btn" onclick="filterMsgs('unread', this)">Unread ({{ $unread }})</button>
            <input type="text" class="search-input" placeholder="Search messages..." onkeyup="searchMsgs(this.value)">
        </div>

        <!-- MESSAGES -->
        @forelse($messages as $message)
        <div class="msg-card {{ !$message->is_read ? 'unread' : '' }}" data-read="{{ $message->is_read ? 'read' : 'unread' }}">

            <div class="msg-top">
                <div class="msg-avatar">
                    {{ strtoupper(substr($message->first_name, 0, 1)) }}
                </div>
                <div class="msg-info">
                    <p class="msg-name">{{ $message->first_name }} {{ $message->last_name }}</p>
                    <p class="msg-email">{{ $message->email }}</p>
                </div>
                <div class="msg-right">
                    <div class="msg-time">{{ $message->created_at->diffForHumans() }}</div>
                    @if(!$message->is_read)
                        <span class="unread-dot"></span>
                    @endif
                </div>
            </div>

            <span class="subject-badge"><i class="fa-solid fa-tag" style="font-size:10px;"></i> {{ $message->subject }}</span>

            <div class="msg-body">
                {{ $message->message }}
            </div>

            <div class="msg-footer">
                <div class="msg-contact">
                    <span><i class="fa-solid fa-envelope"></i> {{ $message->email }}</span>
                </div>
                <button class="btn-del" onclick="openDeleteModal({{ $message->id }}, '{{ $message->first_name }}')">
                    <i class="fa-solid fa-trash"></i> Delete
                </button>
                <form id="del-msg-{{ $message->id }}" action="{{ route('admin.messages.delete', $message->id) }}" method="POST" style="display:none;">
                    @csrf @method('DELETE')
                </form>
            </div>

        </div>
        @empty
        <div class="empty-state">
            <i class="fa-solid fa-envelope-open"></i>
            <h3>No messages yet</h3>
            <p style="font-size:13px; color:#aaa; margin-top:8px;">Contact form submissions will appear here.</p>
        </div>
        @endforelse

    </div>
</div>

<!-- DELETE MODAL -->
<div class="del-overlay" id="deleteModal">
    <div class="del-box">
        <div class="del-icon"><i class="fa-solid fa-trash"></i></div>
        <h3>Delete Message?</h3>
        <p id="delMsg">This message will be permanently removed.</p>
        <div class="del-btns">
            <button class="btn-cancel-d" onclick="closeDeleteModal()">Cancel</button>
            <button class="btn-confirm-d" id="delBtn"><i class="fa-solid fa-trash"></i> Delete</button>
        </div>
    </div>
</div>

<script>
function filterMsgs(type, btn) {
    document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    document.querySelectorAll('.msg-card').forEach(card => {
        if (type === 'all') card.style.display = 'block';
        else card.style.display = card.dataset.read === type ? 'block' : 'none';
    });
}
function searchMsgs(val) {
    val = val.toLowerCase();
    document.querySelectorAll('.msg-card').forEach(card => {
        card.style.display = card.textContent.toLowerCase().includes(val) ? 'block' : 'none';
    });
}
function openDeleteModal(id, name) {
    document.getElementById('delMsg').textContent = 'Delete message from "' + name + '"? This cannot be undone.';
    document.getElementById('delBtn').onclick = function() {
        document.getElementById('del-msg-' + id).submit();
    };
    document.getElementById('deleteModal').classList.add('active');
}
function closeDeleteModal() {
    document.getElementById('deleteModal').classList.remove('active');
}
document.addEventListener('keydown', function(e) { if(e.key==='Escape') closeDeleteModal(); });
</script>
</body>
</html>
