@extends('layouts.app', ['activePage' => 'user', 'title' => 'Light Bootstrap Dashboard Laravel by Creative Tim & UPDIVISION', 'navName' => 'User Profile', 'activeButton' => 'laravel'])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="section-image" style="background-image: linear-gradient(rgba(255,255,255,0.8), rgba(255,255,255,0.8)), url('/assets/img/profile-bg.jpg'); background-size: cover; padding: 30px 0;">
            <div class="row justify-content-center">
                <div class="card col-md-8 shadow">
                    <div class="card-header bg-gradient-primary text-white">
                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <h3 class="mb-0 font-weight-bold">{{ __('Edit Profile') }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <form method="post" action="{{ route('profile.update') }}" autocomplete="off"
                            enctype="multipart/form-data">
                            @csrf
                            @method('patch')

                            <h6 class="heading-small text-primary font-weight-bold mb-4">
                                <i class="fa fa-user-circle mr-2"></i>{{ __('User information') }}
                            </h6>

                            @include('alerts.success')
                            @include('alerts.error_self_update', ['key' => 'not_allow_profile'])

                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label font-weight-bold" for="input-name">
                                        <i class="fa fa-user mr-2 text-primary"></i>{{ __('Name') }}
                                    </label>
                                    <input type="text" name="name" id="input-name" 
                                        class="form-control form-control-lg{{ $errors->has('name') ? ' is-invalid' : '' }} border-primary" 
                                        placeholder="{{ __('Name') }}" 
                                        value="{{ old('name', auth()->user()->name) }}" required autofocus>

                                    @include('alerts.feedback', ['field' => 'name'])
                                </div>
                                <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                    <label class="form-control-label font-weight-bold" for="input-email">
                                        <i class="fa fa-envelope mr-2 text-primary"></i>{{ __('Email') }}
                                    </label>
                                    <input type="email" name="email" id="input-email" 
                                        class="form-control form-control-lg{{ $errors->has('email') ? ' is-invalid' : '' }} border-primary" 
                                        placeholder="{{ __('Email') }}" 
                                        value="{{ old('email', auth()->user()->email) }}" required>

                                    @include('alerts.feedback', ['field' => 'email'])
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary btn-lg px-5 mt-4">
                                        <i class="fa fa-save mr-2"></i>{{ __('Save') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                        
                        <hr class="my-5" style="border-top: 2px solid #eee;" />
                        
                        <form method="post" action="{{ route('profile.change-password') }}">
                            @csrf
                            @method('patch')

                            <h6 class="heading-small text-primary font-weight-bold mb-4">
                                <i class="fa fa-lock mr-2"></i>{{ __('Password') }}
                            </h6>

                            @include('alerts.success', ['key' => 'password_status'])
                            @include('alerts.error_self_update', ['key' => 'not_allow_password'])

                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('old_password') ? ' has-danger' : '' }}">
                                    <label class="form-control-label font-weight-bold" for="input-current-password">
                                        <i class="fa fa-key mr-2 text-primary"></i>{{ __('Current Password') }}
                                    </label>
                                    <input type="password" name="old_password" id="input-current-password" 
                                        class="form-control form-control-lg{{ $errors->has('old_password') ? ' is-invalid' : '' }} border-primary" 
                                        placeholder="{{ __('Current Password') }}" value="" required>

                                    @include('alerts.feedback', ['field' => 'old_password'])
                                </div>
                                <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                    <label class="form-control-label font-weight-bold" for="input-password">
                                        <i class="fa fa-lock mr-2 text-primary"></i>{{ __('New Password') }}
                                    </label>
                                    <input type="password" name="password" id="input-password" 
                                        class="form-control form-control-lg{{ $errors->has('password') ? ' is-invalid' : '' }} border-primary" 
                                        placeholder="{{ __('New Password') }}" value="" required>

                                    @include('alerts.feedback', ['field' => 'password'])
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label font-weight-bold" for="input-password-confirmation">
                                        <i class="fa fa-check-circle mr-2 text-primary"></i>{{ __('Confirm New Password') }}
                                    </label>
                                    <input type="password" name="password_confirmation" id="input-password-confirmation" 
                                        class="form-control form-control-lg border-primary" 
                                        placeholder="{{ __('Confirm New Password') }}" value="" required>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary btn-lg px-5 mt-4">
                                        <i class="fa fa-refresh mr-2"></i>{{ __('Change password') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection