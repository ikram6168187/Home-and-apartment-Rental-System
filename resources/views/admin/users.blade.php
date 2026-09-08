<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Users — Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"/>
    <link rel="stylesheet" href="{{ asset('css/admin_users.css') }}">
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
    <select
        class="role-select {{ $user->role == 'admin' ? 'role-admin-bg' : 'role-user-bg' }}"
        data-user-id="{{ $user->id }}"
        onchange="updateRole(this)">
        <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
        <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
    </select>
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

// ROLE UPDATE (AJAX -> Laravel -> MySQL)
function updateRole(selectEl) {
    var userId = selectEl.dataset.userId;
    var newRole = selectEl.value;
    var previousRole = newRole === 'admin' ? 'user' : 'admin';

    selectEl.disabled = true;

    fetch(`/admin/users/${userId}/role`, {
        method: 'PATCH',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ role: newRole })
    })
    .then(function(res) {
        if (!res.ok) throw new Error('Request failed');
        return res.json();
    })
    .then(function(data) {
        if (data.success) {
            selectEl.classList.remove('role-admin-bg', 'role-user-bg');
            selectEl.classList.add(newRole === 'admin' ? 'role-admin-bg' : 'role-user-bg');
        } else {
            selectEl.value = previousRole;
            alert('Role update failed. Please try again.');
        }
    })
    .catch(function() {
        selectEl.value = previousRole;
        alert('Something went wrong. Role could not be updated.');
    })
    .finally(function() {
        selectEl.disabled = false;
    });
}
</script>
</body>
</html>