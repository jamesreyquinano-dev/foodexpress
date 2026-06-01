<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management Accounts</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; overflow-x: hidden; }
        .sidebar-panel { width: 260px; height: 100vh; position: fixed; top: 0; left: 0; background-color: #212529; z-index: 1000; padding: 1.5rem; }
        .main-content-area { margin-left: 260px; padding: 2.5rem; min-height: 100vh; }
    </style>
</head>
<body>

    <div class="sidebar-panel d-flex flex-column text-white">
        <div class="mb-4 pt-2">
            <span class="fs-4 fw-bold text-primary"> AdminPanel</span>
        </div>
        <hr class="text-secondary">
        
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item mb-2">
                <a href="{{ route('dashboard') }}" class="nav-link text-white opacity-75 px-3">
                    <span class="me-2"></span> Dashboard
                </a>
            </li>
            <li class="nav-item mb-2">
                <a href="{{ route('user') }}" class="nav-link text-white active fw-bold px-3">
                    <span class="me-2"></span> Users List
                </a>
            </li>
            <li class="nav-item mb-2">
                <a href="{{ route('profile') }}" class="nav-link text-white opacity-75 px-3">
                    <span class="me-2"></span> Users Profile
                </a>
            </li>
        </ul>
        
        <hr class="text-secondary">
        <div class="d-grid">
            <a href="/logout" class="btn btn-danger btn-sm py-2 fw-semibold"> Logout</a>
        </div>
    </div>

    <div class="main-content-area">
        <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
            <div>
                <h3 class="fw-bold text-dark mb-1">User Management Accounts</h3>
                <p class="text-muted small mb-0">Review, update, or remove registered user accounts from the system database.</p>
            </div>
            <span class="badge bg-primary px-3 py-2 fw-semibold shadow-sm"> Total Registered: {{ count($user) }}</span>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
                 {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card shadow-sm border-0 p-4 bg-white">
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle border-light mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th style="width: 80px;">ID</th>
                            <th>Fullname</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th style="width: 180px; text-align: center;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($user as $users)
                        <tr>
                            <td>{{ $users->id }}</td>
                            <td class="fw-bold text-secondary">{{ $users->name }}</td>
                            <td><code class="text-dark bg-light px-2 py-1 rounded">{{ $users->email }}</code></td>
                            <td>
                                @if(strtolower($users->role ?? '') == 'admin')
                                    <span class="badge bg-primary text-white border px-2 py-1"> Admin</span>
                                @else
                                    <span class="badge bg-light text-dark border px-2 py-1"> User</span>
                                @endif
                            </td>
                            <td>
                                @if(strtolower($users->status ?? '') == 'inactive')
                                    <span class="badge bg-danger bg-opacity-10 text-danger border border-danger-subtle px-2 py-1">Inactive</span>
                                @else
                                    <span class="badge bg-success bg-opacity-10 text-success border border-success-subtle px-2 py-1">Active</span>
                                @endif
                            </td>
                            <td style="text-align: center;">
                                <button type="button" class="btn btn-primary btn-sm px-3 me-1 shadow-sm fw-semibold" 
                                        data-bs-toggle="modal" data-bs-target="#editModal{{ $users->id }}">
                                    Edit
                                </button>
                                <button type="button" class="btn btn-danger btn-sm px-3 shadow-sm fw-semibold" 
                                        data-bs-toggle="modal" data-bs-target="#deleteModal{{ $users->id }}">
                                    Delete
                                </button>
                            </td>
                        </tr>

                        <div class="modal fade" id="editModal{{ $users->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content border-0 shadow-lg">
                                    <div class="modal-header bg-dark text-white">
                                        <h5 class="modal-title fw-bold"> Update User Account</h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="/user/update/{{ $users->id }}" method="POST">
                                        @csrf
                                        <div class="modal-body p-4">
                                            <div class="mb-3">
                                                <label class="form-label fw-semibold text-muted small">Full Name</label>
                                                <input type="text" name="name" class="form-control" value="{{ $users->name }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label fw-semibold text-muted small">Email Address</label>
                                                <input type="email" name="email" class="form-control" value="{{ $users->email }}" required>
                                            </div>
                                            <div class="mb-3">
                                               <label class="form-label fw-semibold text-muted small">System Access Role</label>
                                                    <select name="role" class="form-select">
                                                    <option value="user" {{ (strtolower($users->role ?? '') == 'user') ? 'selected' : '' }}>User</option>
                                                    <option value="admin" {{ (strtolower($users->role ?? '') == 'admin') ? 'selected' : '' }}>Admin</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                               <label class="form-label fw-semibold text-muted small">Account Operations Status</label>
                                                   <select name="status" class="form-select">
                                                    <option value="active" {{ (strtolower($users->status ?? '') == 'active') ? 'selected' : '' }}>Active</option>
                                                    <option value="inactive" {{ (strtolower($users->status ?? '') == 'inactive') ? 'selected' : '' }}>Inactive</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer bg-light">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-primary fw-semibold px-4">Save Changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="deleteModal{{ $users->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content border-0 shadow">
                                    <div class="modal-header bg-danger text-white">
                                        <h5 class="modal-title fw-bold"> Confirm Deletion</h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body p-4 text-center">
                                        <p class="mb-1">Are you sure you want to delete this account record for</p>
                                        <h5 class="fw-bold text-dark mb-3">"{{ $users->name }}"?</h5>
                                        <p class="text-danger small mb-0"> Warning: This action cannot be undone.</p>
                                    </div>
                                    <div class="modal-footer bg-light">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <a href="/user/delete/{{ $users->id }}" class="btn btn-danger px-4 fw-semibold">Delete</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>