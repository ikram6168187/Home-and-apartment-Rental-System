@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin_messages.css') }}">
@endpush

@include('admin.admin_sidebar')

<div class="main">
    <div class="topbar">
        <div class="topbar-title">
            Messages
            @php $unread = $messages->where('is_read', false)->count(); @endphp
            @if($unread > 0)
                <span class="unread-count-badge">
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

            <span class="subject-badge"><i class="fa-solid fa-tag icon-xs"></i> {{ $message->subject }}</span>

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
                <form id="del-msg-{{ $message->id }}" action="{{ route('admin.messages.delete', $message->id) }}" method="POST" class="hidden-form">
                    @csrf @method('DELETE')
                </form>
            </div>

        </div>
        @empty
        <div class="empty-state">
            <i class="fa-solid fa-envelope-open"></i>
            <h3>No messages yet</h3>
            <p class="empty-state-sub">Contact form submissions will appear here.</p>
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