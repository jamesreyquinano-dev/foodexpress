@extends('layouts.main')

@section('content')

<div class="container mt-5 min-vh-100">
    <div class="row justify-content-center">
        <div class="card p-4 shadow border-0 col-11 col-md-5">
            <p class="fs-5 text-center mt-2 fw-bold">Log in Here!</p>

            <form action="/login" method="POST">
                @csrf
                <div class="form-floating mb-2">
                    <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                    <label for="floatingInput">Email address</label>
                </div>
                <div class="form-floating">
                    <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
                    <label for="floatingPassword">Password</label>
                </div>
                <div class="form-check mt-2">
                    <input class="form-check-input" type="checkbox" value="" id="checkDefault">
                    <label class="form-check-label" for="checkDefault">
                        Remember email address
                    </label>
                </div>
                
                <div class="d-grid mt-4">
                    <button class="btn btn-primary fw-bold" type="submit">Login</button>
                </div>
                
                <div class="text-center mt-3">
                    <a class="text-decoration-none" href="#">Forgot password?</a>
                </div>
                <hr>
                <p class="text-center">Don't have an account yet? <a href="{{ route('register') }}" class="text-decoration-none">Register here.</a></p>
            </form>
        </div>
    </div>
</div>

@endsection