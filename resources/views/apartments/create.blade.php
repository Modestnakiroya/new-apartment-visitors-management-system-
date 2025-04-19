@extends('layouts.app')

@section('title', 'Add New Apartment')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-6">
            <h1>Add New Apartment</h1>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('apartments.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Apartments
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('apartments.store') }}" method="POST">
                @csrf
                <div class="row g-3">
                    <!-- Building Name -->
                    <div class="col-md-6">
                        <label for="building_name" class="form-label">Building Name</label>
                        <input type="text" class="form-control @error('building_name') is-invalid @enderror"
                            id="building_name" name="building_name" value="{{ old('building_name') }}" required>
                        @error('building_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Apartment Number -->
                    <div class="col-md-6">
                        <label for="apartment_number" class="form-label">Apartment Number</label>
                        <input type="text" class="form-control @error('apartment_number') is-invalid @enderror"
                            id="apartment_number" name="apartment_number" value="{{ old('apartment_number') }}" required>
                        @error('apartment_number')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Floor -->
                    <div class="col-md-4">
                        <label for="floor" class="form-label">Floor</label>
                        <input type="number" class="form-control @error('floor') is-invalid @enderror"
                            id="floor" name="floor" value="{{ old('floor') }}" min="1" required>
                        @error('floor')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Number of Rooms -->
                    <div class="col-md-4">
                        <label for="number_of_rooms" class="form-label">Number of Rooms</label>
                        <input type="number" class="form-control @error('number_of_rooms') is-invalid @enderror"
                            id="number_of_rooms" name="number_of_rooms" value="{{ old('number_of_rooms', 1) }}"
                            min="1" required>
                        @error('number_of_rooms')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="col-12">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror"
                            id="description" name="description" rows="3">{{ old('description') }}</textarea>
                        @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 mt-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Save Apartment
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
