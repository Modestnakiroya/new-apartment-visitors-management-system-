@extends('layouts.app', ['activePage' => 'login', 'title' => 'Pearl Apartments - Login', 'navbarClass' => 'd-none'])

@section('content')
<div class=""  margin-top: 0;">
    <div class="overlay" style="padding-top: 0;">

        <!-- Login Form -->
        <div class="container" style="padding-top: 5rem;">
            <div class="row justify-content-center">
                <div class="col-md-5">
                    <div class="card shadow-lg">
                        <div class="card-header bg-primary text-white text-center py-3">
                            <h4 class="mb-0"><i class="fas fa-sign-in-alt mr-2"></i>Login</h4>
                        </div>
                        <div class="card-body px-4 py-4">
                            @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                            @endif

                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="mb-4">
                                    <label for="email" class="form-label fw-bold">EMAIL ADDRESS</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        id="email" name="email" value="{{ old('email') }}" required
                                        style="height: 45px; border-radius: 4px;">
                                    @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="password" class="form-label fw-bold">PASSWORD</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        id="password" name="password" required
                                        style="height: 45px; border-radius: 4px;">
                                    @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-4 form-check">
                                    <input type="checkbox" class="form-check-input" id="remember" name="remember">
                                    <label class="form-check-label" for="remember">Remember Me</label>
                                </div>

                                <button type="submit" class="btn btn-primary w-100 py-2"
                                    style="font-size: 1.1rem; border-radius: 4px;">
                                    Login
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
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

    .navbar {
        padding: 0.5rem 0;
    }

    .card {
        border: none;
        border-radius: 8px;
    }

    .form-control:focus {
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        border-color: #86b7fe;
    }

    .nav-link {
        padding: 0.5rem 1rem;
        border-radius: 4px;
    }

    .nav-link.active {
        background-color: rgba(255, 255, 255, 0.1);
    }
</style>
@endsection
