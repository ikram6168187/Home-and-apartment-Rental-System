
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users — Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"/>
<style>
.search-box { display:flex; gap:12px; margin-bottom:20px; }
.search-box input { flex:1; padding:10px 16px; border:1.5px solid #e0e0e0; border-radius:10px; font-size:14px; outline:none; }
.search-box input:focus { border-color:#1a1209; }
.table-card { background:#fff; border-radius:14px; border:1px solid #eee; overflow:hidden; }
.table-head { padding:16px 20px; border-bottom:1px solid #f0f0f0; display:flex; align-items:center; justify-content:space-between; }
.table-head h3 { font-size:15px; font-weight:700; color:#1a1209; margin:0; }
.total-badge { background:#f5ede0; color:#8a5c30; padding:4px 12px; border-radius:20px; font-size:12px; font-weight:600; }
table { width:100%; border-collapse:collapse; }
thead th { font-size:11px; font-weight:700; color:#aaa; text-transform:uppercase; letter-spacing:0.5px; padding:12px 16px; text-align:left; background:#fafafa; border-bottom:1px solid #f0f0f0; }
tbody td { font-size:13px; color:#333; padding:14px 16px; border-bottom:1px solid #f8f8f8; }
tbody tr:last-child td { border-bottom:none; }
tbody tr:hover { background:#fafafa; }
.user-cell { display:flex; align-items:center; gap:10px; }
.user-av { width:36px; height:36px; border-radius:50%; background:linear-gradient(135deg,#2d2926,#8a6040); display:flex; align-items:center; justify-content:center; font-size:12px; font-weight:700; color:#fff; flex-shrink:0; overflow:hidden; }
.user-av img { width:100%; height:100%; object-fit:cover; }
.user-name { font-size:13px; font-weight:600; color:#1a1209; margin:0 0 2px; }
.user-email { font-size:11px; color:#888; }
.prop-count { background:#f5ede0; color:#8a5c30; padding:3px 10px; border-radius:20px; font-size:11px; font-weight:600; }
.joined-date { font-size:12px; color:#888; }
.btn-delete { background:#fff0f0; color:#c0392b; border:1px solid #ffcdd2; padding:6px 14px; border-radius:20px; font-size:12px; font-weight:600; cursor:pointer; transition:0.2s; display:flex; align-items:center; gap:5px; }
.btn-delete:hover { background:#dc3545; color:#fff; border-color:#dc3545; }

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

.role-admin{
    display:inline-block;
    background:#ffe5e5;
    color:#dc3545;
    padding:5px 12px;
    border-radius:20px;
    font-size:11px;
    font-weight:600;
}

.role-user{
    display:inline-block;
    background:#e8f5e9;
    color:#2e7d32;
    padding:5px 12px;
    border-radius:20px;
    font-size:11px;
    font-weight:600;
}

</style>
</head>
<body>

@include('admin.admin_sidebar')

<div class="main">
    <div class="topbar">
        <div class="topbar-title">Users Management</div>
        <div class="topbar-right">
            <span class="admin-access-badge">
                <i class="fa-solid fa-shield-halved"></i> Admin Access
            </span>
        </div>
    </div>

    <div class="content">

        @if(session('success'))
        <div class="alert-success"><i class="fa-solid fa-circle-check"></i> {{ session('success') }}</div>
        @endif

        <!-- SEARCH -->
        <div class="search-box">
            <input type="text" id="userSearch" placeholder="Search by name or email..." onkeyup="searchUsers()">
        </div>

        <div class="table-card">
            <div class="table-head">
                <h3>All Users</h3>
                <span class="total-badge">{{ $users->count() }} Total</span>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>User</th>
                        <th>Properties</th>
                        <th>Joined</th>
                           <th>Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="usersTable">
                    @foreach($users as $index => $user)
                    <tr>
                        <td style="color:#aaa; font-size:12px;">{{ $index + 1 }}</td>
                        <td>
                            <div class="user-cell">
                                <div class="user-av">
                                    @if($user->profile_picture)
                                        <img src="{{ asset('storage/'.$user->profile_picture) }}" alt="">
                                    @else
                                        {{ strtoupper(substr($user->name, 0, 2)) }}
                                    @endif
                                </div>
                                <div>
                                    <p class="user-name">{{ $user->name }}</p>
                                    <p class="user-email">{{ $user->email }}</p>
                                </div>
                            </div>
                        </td>
                        <td>
    @if($user->role == 'admin')
        <span class="role-admin">Admin</span>
    @else
        <span class="role-user">User</span>
    @endif
</td>
                        <td><span class="prop-count">{{ $user->properties_count }} listings</span></td>
                        <td><span class="joined-date">{{ $user->created_at->format('d M Y') }}</span></td>
                        <td>
                            <button class="btn-delete" onclick="openDeleteModal({{ $user->id }}, '{{ $user->name }}')">
                                <i class="fa-solid fa-trash"></i> Delete
                            </button>
                            <form id="delete-form-{{ $user->id }}" action="{{ route('admin.users.delete', $user->id) }}" method="POST" style="display:none;">
                                @csrf @method('DELETE')
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>

<!-- DELETE MODAL -->
<div class="del-overlay" id="deleteModal">
    <div class="del-box">
        <div class="del-icon"><i class="fa-solid fa-user-xmark"></i></div>
        <h3>Delete User?</h3>
        <p id="delMsg">All their listings and data will be permanently removed.</p>
        <div class="del-btns">
            <button class="btn-cancel-d" onclick="closeDeleteModal()">Cancel</button>
            <button class="btn-confirm-d" id="delConfirmBtn"><i class="fa-solid fa-trash"></i> Delete</button>
        </div>
    </div>
</div> 


<script>
function openDeleteModal(id, name) {
    document.getElementById('delMsg').textContent = 'Delete "' + name + '"? All their listings will be removed.';
    document.getElementById('delConfirmBtn').onclick = function() {
        document.getElementById('delete-form-' + id).submit();
    };
    document.getElementById('deleteModal').classList.add('active');
}
function closeDeleteModal() {
    document.getElementById('deleteModal').classList.remove('active');
}
function searchUsers() {
    var val = document.getElementById('userSearch').value.toLowerCase();
    document.querySelectorAll('#usersTable tr').forEach(function(row) {
        row.style.display = row.textContent.toLowerCase().includes(val) ? '' : 'none';
    });
}
document.addEventListener('keydown', function(e) { if(e.key==='Escape') closeDeleteModal(); });
</script>
</body>
</html>
