@extends('layouts.app')

@section('title', 'Add New Apartment')

@section('content')
<div class="container-fluid py-4">
    <div class="row align-items-center mb-4">
        <div class="col-lg-6">
            <h1 class="fw-bold text-primary mb-0">Add New Apartment</h1>
        </div>
        <div class="col-lg-6 text-lg-end mt-3 mt-lg-0">
            <a href="{{ route('apartments.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i> Back to Apartments
            </a>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-header bg-light py-3">
            <h5 class="card-title mb-0">Apartment Details</h5>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('apartments.store') }}" method="POST">
                @csrf
                <div class="row g-4">
                    <!-- Building Name -->
                    <div class="col-md-6">
                        <label for="building_name" class="form-label fw-medium">Building Name</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="fas fa-building"></i></span>
                            <input type="text" class="form-control @error('building_name') is-invalid @enderror"
                                id="building_name" name="building_name" value="{{ old('building_name') }}" 
                                placeholder="Enter building name" required>
                            @error('building_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Apartment Number -->
                    <div class="col-md-6">
                        <label for="apartment_number" class="form-label fw-medium">Apartment Number</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="fas fa-door-closed"></i></span>
                            <input type="text" class="form-control @error('apartment_number') is-invalid @enderror"
                                id="apartment_number" name="apartment_number" value="{{ old('apartment_number') }}" 
                                placeholder="Enter apartment number" required>
                            @error('apartment_number')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Floor -->
                    <div class="col-md-6 col-lg-3">
                        <label for="floor" class="form-label fw-medium">Floor</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="fas fa-level-up-alt"></i></span>
                            <input type="number" class="form-control @error('floor') is-invalid @enderror"
                                id="floor" name="floor" value="{{ old('floor') }}" min="1" 
                                placeholder="Floor number" required>
                            @error('floor')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Number of Rooms -->
                    <div class="col-md-6 col-lg-3">
                        <label for="number_of_rooms" class="form-label fw-medium">Number of Rooms</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="fas fa-bed"></i></span>
                            <input type="number" class="form-control @error('number_of_rooms') is-invalid @enderror"
                                id="number_of_rooms" name="number_of_rooms" value="{{ old('number_of_rooms', 1) }}"
                                min="1" placeholder="Room count" required>
                            @error('number_of_rooms')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="col-12">
                        <label for="description" class="form-label fw-medium">Description</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="fas fa-align-left"></i></span>
                            <textarea class="form-control @error('description') is-invalid @enderror"
                                id="description" name="description" rows="4" 
                                placeholder="Enter apartment details, features, and amenities">{{ old('description') }}</textarea>
                            @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-text">Provide details about the apartment's condition, features, and amenities.</div>
                    </div>

                    <div class="col-12 mt-4 text-end">
                        <button type="reset" class="btn btn-light me-2">
                            <i class="fas fa-undo me-1"></i> Reset
                        </button>
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fas fa-save me-2"></i> Save Apartment
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection