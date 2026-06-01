<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; overflow-x: hidden; }
        .profile-container { max-width: 650px; margin-top: 3rem; margin-bottom: 3rem; }
        .profile-avatar { width: 120px; height: 120px; object-fit: cover; border-radius: 50%; border: 3px solid #198754; }
    </style>
</head>
<body>

    @include('navbar')

    <div class="container profile-container">
        <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
            <div>
                <h3 class="fw-bold text-dark mb-1">Account Profile Settings</h3>
                <p class="text-muted small mb-0">View or update your personal account information and security credentials.</p>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
                 {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card shadow-sm border-0 p-4 bg-white">
            
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="text-center mb-4">
                    @if(auth()->user()->profile_image)
                        <img src="{{ asset('storage/' . auth()->user()->profile_image) }}" alt="Profile Image" class="profile-avatar mb-3">
                    @else
                        <img src="https://cdn-icons-png.flaticon.com/512/3177/3177440.png" alt="Default Avatar" class="profile-avatar mb-3">
                    @endif
                    
                    <div class="mx-auto" style="max-width: 350px;">
                        <label class="form-label fw-semibold text-muted small d-block">Upload Profile Picture</label>
                        <input type="file" name="profile_image" class="form-control form-control-sm">
                    </div>
                </div>

                <h5 class="mb-3 fw-bold text-secondary">Account Details</h5>
                
                <div class="mb-3">
                    <label class="form-label fw-semibold text-muted small">Full Name</label>
                    <input type="text" name="name" class="form-control" value="{{ auth()->user()->name }}" required>
                </div>
                
                <div class="mb-3">
                    <label class="form-label fw-semibold text-muted small">Email Address</label>
                    <input type="email" name="email" class="form-control" value="{{ auth()->user()->email }}" required>
                </div>

                <hr class="my-4 text-light">
                <h5 class="mb-3 fw-bold text-secondary">Security Update</h5>

                <div class="mb-3">
                    <label class="form-label fw-semibold text-muted small">New Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Enter new password if changing">
                </div>

                <div class="mt-4 pt-2">
                    <button type="submit" class="btn btn-success fw-semibold px-4 py-2 shadow-sm">Save Changes</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>