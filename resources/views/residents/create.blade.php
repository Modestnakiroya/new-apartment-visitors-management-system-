@extends('layouts.app')

@section('title', 'Add New Resident')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-6">
            <h1>Add New Resident</h1>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('residents.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Residents
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('residents.store') }}" method="POST">
                @csrf

                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="user_id" class="form-label">User</label>
                        <select class="form-control @error('user_id') is-invalid @enderror"
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

                    <div class="col-md-6">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                            id="name" name="name" value="{{ old('name') }}" required>
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input type="text" class="form-control @error('phone') is-invalid @enderror"
                            id="phone" name="phone" value="{{ old('phone') }}" required>
                        @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="email" class="form-label">Email (Optional)</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                            id="email" name="email" value="{{ old('email') }}">
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="apartment_id" class="form-label">Apartment</label>
                        <select class="form-control @error('apartment_id') is-invalid @enderror"
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

                    <div class="col-12 mt-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Save Resident
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
