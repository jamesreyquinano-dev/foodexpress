
@extends('layouts.main')

@section('content')

<div class="container mt-3 min-vh-100">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow border-0">
                <div class="card-body p-4">
                    <h3 class="text-center mb-4 fw-bold">Register Here!</h3>

                    <form action="/register" method="POST">
                        @csrf 

                        <div class="mb-3">
                            <label class="form-label">Full Name</label>
                            <input type="text" name="fullname" class="form-control" required placeholder="">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" required placeholder="example@email.com">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Confirm Password</label>
                            <input type="password" name="confirmpassword" class="form-control" required placeholder="password" >
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Gender</label>
                            <select class="form-select" name="gender" required>
                                <option value="">Choose...</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>

                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-success fw-bold">
                                Register
                            </button>
                        </div>
                        <p class="text-center mt-2">Already have an account?<a class="text-decoration-none" href="{{ route('login') }}">login here</a></p>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection