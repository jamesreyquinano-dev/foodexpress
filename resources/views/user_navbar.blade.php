<div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 260px; height: 100vh; position: fixed; top: 0; left: 0; z-index: 1000;">
    <div class="mb-4 pt-2">
        <span class="fs-4 fw-bold text-primary"> AdminPanel</span>
    </div>
    <hr class="text-secondary">
    
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item mb-2">
            <a href="{{ route('dashboard') }}" class="nav-link text-white {{ Request::routeIs('dashboard') ? 'active fw-bold' : 'opacity-75' }} px-3">
                <span class="me-2"></span> Dashboard
            </a>
        </li>
        <li class="nav-item mb-2">
            <a href="{{ route('user') }}" class="nav-link text-white {{ Request::routeIs('user') ? 'active fw-bold' : 'opacity-75' }} px-3">
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
    
    <div class="d-grid mb-2">
        <a href="/logout" class="btn btn-danger btn-sm py-2 fw-semibold">
            <span></span> Logout
        </a>
    </div>
</div>