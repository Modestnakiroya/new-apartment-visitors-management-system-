@extends('layouts/app', ['activePage' => 'login', 'title' => 'Login'])

@section('content')
<div class="full-page section-image" data-image="{{ asset('image/snap3.jpg') }}">
    <div class="content pt-5">
        <div class="container mt-5">    
            <div class="col-md-4 col-sm-6 ml-auto mr-auto">
                <form class="form" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="card card-login">
                        <div class="card-header text-center">
                            <h3 class="header">{{ __('Login') }}</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="email" class="col-md-12 col-form-label">{{ __('E-Mail Address') }}</label>
                                <div class="col-md-12">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', 'admin@lightbp.com') }}" required autocomplete="email" autofocus>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password" class="col-md-12 col-form-label">{{ __('Password') }}</label>
                                <div class="col-md-12">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password', 'secret') }}" required autocomplete="current-password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-check">
                                    <label class="form-check-label d-flex align-items-center">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember">
                                        <span class="form-check-sign"></span>
                                        {{ __('Remember me') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-lg btn-block">{{ __('Login') }}</button>
                            </div>
                            <div class="d-flex justify-content-between mt-3">
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot password?') }}
                                </a>
                                <a class="btn btn-link" href="{{ route('register') }}">
                                    {{ __('Create account') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    $(document).ready(function() {
        demo.checkFullPageBackgroundImage();

        gsap.from('.card', {duration: 1, y: 50, opacity: 0, ease: 'power3.out'});

        $('.form-control').on('focus', function() {
            $(this).parent().addClass('input-group-focus');
        }).on('blur', function() {
            $(this).parent().removeClass('input-group-focus');
        });
    });
</script>
@endpush

@push('css')
<style>
    .full-page {
        min-height: 100vh;
        display: flex;
        align-items: center;
        background-size: cover;
        background-position: center;
    }
    .card-login {
        border: none;
        border-radius: 10px;
        box-shadow: 0 15px 35px rgba(50,50,93,.1),0 5px 15px rgba(0,0,0,.07);
    }
    .card-header {
        background-color: transparent;
        border-bottom: none;
        padding: 30px 0 15px;
    }
    .form-control {
        border-radius: 25px;
        padding: 10px 20px;
    }
    .btn-primary {
        border-radius: 25px;
        padding: 10px 20px;
        font-weight: bold;
        text-transform: uppercase;
        transition: all 0.3s ease;
    }
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 7px 14px rgba(50,50,93,.1), 0 3px 6px rgba(0,0,0,.08);
    }
    .btn-link {
        color: #3498db;
        font-weight: 600;
    }
    .form-check-label {
        color: #555;
    }
</style>
@endpush