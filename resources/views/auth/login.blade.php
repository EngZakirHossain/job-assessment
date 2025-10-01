@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center min-vh-100 pt-20 pb-10">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card mx-xxl-8 shadow-none">
            <div class="card-body p-8">
            <h3 class="fw-medium text-center">Welcome To Fashion Step Group</h3>
            <p class="mb-8 text-muted text-center">Login to Explore the details</p>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-4">
                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>
                <div class="mb-4">
                <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                <div class="position-relative">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                </div>
                <div class="my-6">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="rememberMe">
                    <label class="form-check-label" for="rememberMe">Remember me</label>
                    </div>
                </div>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary w-100 mb-4">Sign In</button>
                    <button type="button" id="demoLogin" class="btn btn-outline-secondary ms-2">
                        Use Default Admin
                    </button>
                </div>
            </form>
            </div>
        </div>
        <p class="position-relative text-center fs-13 mb-0">©
            <script>document.write(new Date().getFullYear())</script> Developed By Zakir Hossain
        </p>
        </div>
    </div>
</div>
<script>
    document.getElementById('demoLogin').addEventListener('click', function() {
        document.getElementById('email').value = "admin@gmail.com";
        document.getElementById('password').value = "123456";
    });
</script>
@endsection
