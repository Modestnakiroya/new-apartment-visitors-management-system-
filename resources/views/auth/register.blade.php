@extends('layouts.app', ['activePage' => 'register', 'title' => 'Register'])

@section('content')
<div class="full-page section-image" data-image="{{ asset('image/snap3.jpg') }}">
    <div class="content pt-5">
        <div class="container mt-5">
            <div class="col-md-6 col-sm-8 ml-auto mr-auto">
                <form class="form" method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="card card-register">
                        <div class="card-header text-center">
                            <h3 class="header">{{ __('Registration') }}</h3>
                            <p class="text-muted">Create your account to access the system</p>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name" class="col-form-label">{{ __('Full Name') }}</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="{{ __('Enter your full name') }}" value="{{ old('name') }}" required autofocus>
                            </div>
                            <div class="form-group">
                                <label for="email" class="col-form-label">{{ __('E-Mail Address') }}</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email" value="{{ old('email') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="phone" class="col-form-label">{{ __('Phone Number') }}</label>
                                <input type="text" name="phone" id="phone" class="form-control" placeholder="Enter your phone number" value="{{ old('phone') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="id_number" class="col-form-label">{{ __('ID Number') }}</label>
                                <input type="text" name="id_number" id="id_number" class="form-control" placeholder="Enter your ID number" value="{{ old('id_number') }}" required>
                            </div>
                            <input type="hidden" name="role" value="askari">
                            <div class="form-group">
                                <label for="password" class="col-form-label">{{ __('Password') }}</label>
                                <input type="password" name="password" id="password" class="form-control" placeholder="Choose a strong password" required>
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation" class="col-form-label">{{ __('Confirm Password') }}</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Confirm your password" required>
                            </div>
                            <div class="form-group">
                                <div class="form-check">
                                    <label class="form-check-label d-flex align-items-center">
                                        <input class="form-check-input" name="agree" type="checkbox" required>
                                        <span class="form-check-sign"></span>
                                        <b>{{ __('I agree to the terms and conditions of service') }}</b>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-lg btn-block">{{ __('Register') }}</button>
                            </div>
                            <div class="text-center mt-3">
                                <a class="btn btn-link" href="{{ route('login') }}">
                                    {{ __('Already registered? Login here') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col mt-3">
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger alert-dismissible fade show">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close"> ×</a>
                        {{ $error }}
                    </div>
                @endforeach
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
        
        // Redirect to login page after successful registration
        @if(session('registered'))
            window.location.href = "{{ route('login') }}";
        @endif
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
        position: relative; /* For pseudo-element positioning */
    }
    .full-page::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.2); /* Lighter overlay for less opacity */
        z-index: 1;
    }
    .full-page .content {
        position: relative;
        z-index: 2; /* Ensure form content is above overlay */
    }
    .card-register {
        border: none;
        border-radius: 10px;
        box-shadow: 0 15px 35px rgba(50,50,93,.1),0 5px 15px rgba(0,0,0,.07);
    }
    .custom-transparent {
        opacity: 0.6; /* Kept for reference, not used */
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
        padding: 12px 20px;
        text-transform: uppercase;
        transition: all 0.3s ease;
    }
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 7px 14px rgba(50,50,93,.1), 0 3px 6px rgba(0,0,0,.08);
    }
    .btn-link {
        color: #3498db;
    }
    .form-check-label {
        color: #555;
    }
    .alert {
        border-radius: 10px;
    }
</style>
@endpush