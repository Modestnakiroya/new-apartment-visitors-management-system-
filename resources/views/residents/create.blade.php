@extends('layouts.app')

@section('title', 'Add New Resident')

@section('content')
<div class="container-fluid py-4">
    <div class="row mb-4 align-items-center">
        <div class="col-md-6">
            <h1 class="fw-bold text-primary mb-0">Add New Resident</h1>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('residents.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-1"></i> Back to Residents
            </a>
        </div>
    </div>

    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-header bg-light py-3">
            <h5 class="card-title mb-0"><i class="fas fa-user-plus me-2"></i>Resident Information</h5>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('residents.store') }}" method="POST">
                @csrf

                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="user_id" class="form-label fw-medium">User Account</label>
                            <select class="form-select @error('user_id') is-invalid @enderror"
                                id="user_id" name="user_id" required>
                                <option value="">Select User</option>
                                @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                                @endforeach
                            </select>
                            @error('user_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name" class="form-label fw-medium">Full Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                id="name" name="name" value="{{ old('name') }}" required placeholder="Enter resident's full name">
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="phone" class="form-label fw-medium">Phone Number</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                    id="phone" name="phone" value="{{ old('phone') }}" required placeholder="Enter phone number">
                            </div>
                            @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email" class="form-label fw-medium">Email Address <span class="text-muted">(Optional)</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" value="{{ old('email') }}" placeholder="Enter email address">
                            </div>
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group">
                            <label for="apartment_id" class="form-label fw-medium">Apartment</label>
                            <select class="form-select @error('apartment_id') is-invalid @enderror"
                                id="apartment_id" name="apartment_id" required>
                                <option value="">Select Apartment</option>
                                @foreach($apartments as $apartment)
                                <option value="{{ $apartment->id }}" {{ old('apartment_id') == $apartment->id ? 'selected' : '' }}>
                                    {{ $apartment->building_name }} - Floor {{ $apartment->floor }}, Unit {{ $apartment->apartment_number }}
                                </option>
                                @endforeach
                            </select>
                            @error('apartment_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12 mt-4 text-end">
                        <button type="reset" class="btn btn-light me-2">
                            <i class="fas fa-undo me-1"></i> Reset
                        </button>
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fas fa-save me-1"></i> Save Resident
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection