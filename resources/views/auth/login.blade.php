@extends('layouts.app')

@section('title', 'Login - Apartment Visitor Management')

@section('content')


<div class="full-page-background" style="background-image: url('https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80'); margin-top: 0;">

<div class="row justify-content-center pt-4 " style="padding-top: 80px;">
    <div class="col-md-6 " style="padding-top: 80px;">
        <div class="card " >
            <div class="card-header bg-primary text-white ">
                <h4 class="mb-0">Login</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="remember" name="remember">
                        <label class="form-check-label" for="remember">Remember Me</label>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Login</button>
                </form>
            </div>
        </div>
    </div>
</div>
<style>
     body {
        margin: 0;
        padding: 0;
    }

    .full-page-background {
        min-height: 100vh;
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
    }

    .overlay {
        background-color: rgba(0, 0, 0, 0.6);
        min-height: 100vh;
    }
</style>
@endsection
