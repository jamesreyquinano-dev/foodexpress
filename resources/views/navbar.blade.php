<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow">
    <div class="container">
        <a class="navbar-brand fw-bold text-success" href="{{ url('/') }}">🍕 FoodExpress</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center"> 
                <li class="nav-item">
                    <a class="nav-link btn btn-outline-success text-white mb-2 mb-lg-0 me-lg-1" href="{{ url('/') }}#home">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-outline-success text-white mb-2 mb-lg-0 me-lg-1" href="{{ url('/') }}#about">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-outline-success text-white mb-2 mb-lg-0 me-lg-1" href="{{ url('/') }}#menu">Menu</a>
                </li>

                @guest
                    <li class="nav-item ms-lg-3">
                        <a class="nav-link btn btn-outline-success text-white mb-2 mb-lg-0 me-lg-1" href="{{ url('/login') }}">Login</a>
                    </li>
                    <li class="nav-item ms-lg-2">
                        <a class="nav-link btn btn-success text-white mb-2 mb-lg-0 me-lg-1" href="{{ url('/register') }}">Register</a>
                    </li>
                @endguest

                @auth
            

                <li class="nav-item ms-lg-2">
                    <a class="nav-link text-white btn btn-outline-success position-relative px-3" href="{{ route('cart.view') }}">
                        🛒 Cart
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            {{ count(session('cart', [])) }}
                        </span>
                    </a>
                </li>
            </ul>
            <li class="nav-item dropdown ms-lg-3 mb-2 mb-lg-0 me-lg-2">
                        <a class="nav-link dropdown-toggle btn btn-outline-success text-white px-3" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                             {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end bg-dark border-success" aria-labelledby="navbarDropdown">
                            @if(Auth::user()->role === 'admin')
                                <li><a class="dropdown-item text-white hover-success" href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li><hr class="dropdown-divider border-success"></li>
                            @endif
                            
                            <li><a class="dropdown-item text-white" href="{{ route('profile') }}">My Profile</a></li>
                            <li><hr class="dropdown-divider border-success"></li>
                            <li><a class="dropdown-item text-danger fw-bold" href="{{ route('logout') }}"> Logout</a></li>
                        </ul>
                    </li>
                @endauth
        </div>
    </div>
</nav>

<style>
    .dropdown-item:hover {
        background-color: #198754 !important;
        color: white !important;
    }
</style>