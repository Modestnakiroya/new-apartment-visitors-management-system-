@extends('layouts.app', ['activePage' => 'user', 'title' => 'User Profile', 'navName' => 'User Profile', 'activeButton' => 'laravel'])

@section('content')
<style>
    body {
        background: linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab);
        background-size: 400% 400%;
        animation: gradient 15s ease infinite;
        height: 100vh;
    }

    @keyframes gradient {
        0% {
            background-position: 0% 50%;
        }
        50% {
            background-position: 100% 50%;
        }
        100% {
            background-position: 0% 50%;
        }
    }

    .content {
        background-color: rgba(255, 255, 255, 0.9);
        border-radius: 20px;
        padding: 30px;
        margin-top: 30px;
    }

    .profile-sidebar {
        background: linear-gradient(rgba(52, 152, 219, 0.7), rgba(142, 68, 173, 0.7)),
                    url('{{ auth()->user()->background_picture ? asset("storage/" . auth()->user()->background_picture) : asset("light-bootstrap/img/default-background.jpg") }}') no-repeat center center;
        background-size: cover;
        border-radius: 20px;
        padding: 30px;
        color: white;
        text-align: center;
        height: 100%;
        position: relative;
        overflow: hidden;
    }

    .profile-sidebar::before {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        background: inherit;
        filter: blur(5px);
        z-index: -1;
    }

    .profile-image {
        width: 180px;
        height: 180px;
        border-radius: 50%;
        border: 8px solid rgba(255, 255, 255, 0.5);
        box-shadow: 0 2px 20px rgba(0,0,0,0.2);
        object-fit: cover;
        margin-bottom: 20px;
    }

    .card {
        border: none;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        border-radius: 15px;
        overflow: hidden;
        margin-bottom: 30px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(0,0,0,0.2);
    }

    .card-header {
        background-color: #f8f9fa;
        border-bottom: none;
        padding: 25px;
    }

    .form-control {
        border-radius: 20px;
        padding: 12px 20px;
        border: 1px solid #e0e0e0;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: #3498db;
        box-shadow: 0 0 10px rgba(52, 152, 219, 0.1);
    }

    .btn-save {
        background: linear-gradient(45deg, #3498db, #8e44ad);
        border: none;
        border-radius: 25px;
        padding: 12px 35px;
        color: white;
        font-weight: bold;
        transition: all 0.3s ease;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .btn-save:hover {
        transform: translateY(-3px);
        box-shadow: 0 7px 20px rgba(0,0,0,0.2);
    }

    .icon-input {
        position: relative;
        margin-bottom: 25px;
    }

    .icon-input i {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #3498db;
        font-size: 1.2em;
    }

    .icon-input input, .icon-input textarea {
        padding-left: 45px;
    }

    .btn-file {
        position: relative;
        overflow: hidden;
        background-color: #f8f9fa;
        border: 2px dashed #3498db;
        color: #3498db;
        transition: all 0.3s ease;
    }

    .btn-file:hover {
        background-color: #e8f4fd;
    }

    .btn-file input[type=file] {
        position: absolute;
        top: 0;
        right: 0;
        min-width: 100%;
        min-height: 100%;
        font-size: 100px;
        text-align: right;
        filter: alpha(opacity=0);
        opacity: 0;
        outline: none;
        background: white;
        cursor: inherit;
        display: block;
    }
</style>

<div class="content">
    <div class="container">
        <div class="row">
            <!-- Left side with forms -->
            <div class="col-md-8">
                <!-- Profile Update Form -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="mb-0">{{ __('Edit Profile') }}</h3>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('profile.update') }}" autocomplete="off" enctype="multipart/form-data">
                            @csrf
                            @method('patch')

                            @include('alerts.success')
                            @include('alerts.error_self_update', ['key' => 'not_allow_profile'])

                            <div class="icon-input">
                                <i class="fa fa-user"></i>
                                <input type="text" name="name" id="input-name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" value="{{ old('name', auth()->user()->name) }}" required autofocus>
                                @include('alerts.feedback', ['field' => 'name'])
                            </div>

                            <div class="icon-input">
                                <i class="fa fa-envelope"></i>
                                <input type="email" name="email" id="input-email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}" value="{{ old('email', auth()->user()->email) }}" required>
                                @include('alerts.feedback', ['field' => 'email'])
                            </div>

                            <div class="icon-input">
                                <i class="fa fa-pencil"></i>
                                <textarea name="description" id="input-description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" placeholder="{{ __('Description') }}" rows="3" required>{{ old('description', auth()->user()->description) }}</textarea>
                                @include('alerts.feedback', ['field' => 'description'])
                            </div>

                            <div class="form-group">
                                <span class="btn btn-outline-primary btn-file btn-block">
                                    <i class="fa fa-upload mr-2"></i>{{ __('Upload Profile Picture') }}
                                    <input type="file" name="profile_picture" id="input-profile-picture">
                                </span>
                                @include('alerts.feedback', ['field' => 'profile_picture'])
                            </div>

                            <div class="form-group">
                                <span class="btn btn-outline-primary btn-file btn-block">
                                    <i class="fa fa-image mr-2"></i>{{ __('Upload Background Picture') }}
                                    <input type="file" name="background_picture" id="input-background-picture">
                                </span>
                                @include('alerts.feedback', ['field' => 'background_picture'])
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-save mt-4">{{ __('Save Changes') }}</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Password Change Form -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="mb-0">{{ __('Change Password') }}</h3>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('profile.password') }}">
                            @csrf
                            @method('patch')

                            @include('alerts.success', ['key' => 'password_status'])
                            @include('alerts.error_self_update', ['key' => 'not_allow_password'])

                            <div class="icon-input">
                                <i class="fa fa-lock"></i>
                                <input type="password" name="old_password" id="input-current-password" class="form-control{{ $errors->has('old_password') ? ' is-invalid' : '' }}" placeholder="{{ __('Current Password') }}" required>
                                @include('alerts.feedback', ['field' => 'old_password'])
                            </div>

                            <div class="icon-input">
                                <i class="fa fa-key"></i>
                                <input type="password" name="password" id="input-password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('New Password') }}" required>
                                @include('alerts.feedback', ['field' => 'password'])
                            </div>

                            <div class="icon-input">
                                <i class="fa fa-check"></i>
                                <input type="password" name="password_confirmation" id="input-password-confirmation" class="form-control" placeholder="{{ __('Confirm New Password') }}" required>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-save mt-4">{{ __('Change Password') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Right side with profile picture and background -->
            <div class="col-md-4">
                <div class="profile-sidebar">
                    <img src="{{ auth()->user()->profile_picture ? asset('storage/' . auth()->user()->profile_picture) : asset('light-bootstrap/img/faces/face-3.jpg') }}" alt="Profile Picture" class="profile-image">
                    <h2>{{ auth()->user()->name }}</h2>
                    <p>{{ auth()->user()->email }}</p>
                    <p class="mt-3">{{ auth()->user()->description }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection