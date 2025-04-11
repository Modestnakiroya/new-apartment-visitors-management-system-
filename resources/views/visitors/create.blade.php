@extends('layouts.app')

@section('title', 'Check-in Visitor - Apartment Visitor Management')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Check-in New Visitor</h1>
        <a href="{{ route('visitors.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to Visitors
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('visitors.store') }}" method="POST">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Visitor Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}" required>
                        @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="resident_id" class="form-label">Resident to Visit</label>
                    <select class="form-select @error('resident_id') is-invalid @enderror" id="resident_id" name="resident_id" required>
                        <option value="">Select a resident...</option>
                        @foreach($residents as $resident)
                        <option value="{{ $resident->id }}" {{ old('resident_id') == $resident->id ? 'selected' : '' }}>
                            {{ $resident->name }} - {{ $resident->apartment->getFullNumberAttribute() }}
                        </option>
                        @endforeach
                    </select>
                    @error('resident_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="visit_type" class="form-label">Visit Type</label>
                    <select class="form-control @error('visit_type') is-invalid @enderror"
                        id="visit_type" name="visit_type" required>
                        <option value="">Select Visit Type</option>
                        <option value="guest">Guest</option>
                        <option value="delivery">Delivery</option>
                        <option value="service">Service</option>
                    </select>
                    @error('visit_type')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="reason" class="form-label">Reason for Visit</label>
                    <textarea class="form-control @error('reason') is-invalid @enderror" id="reason" name="reason" rows="3" required>{{ old('reason') }}</textarea>
                    @error('reason')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="entry_time" class="form-label">Entry Time</label>
                        <input type="datetime-local" class="form-control @error('entry_time') is-invalid @enderror" id="entry_time" name="entry_time" value="{{ old('entry_time', now()->format('Y-m-d\TH:i')) }}" required>
                        @error('entry_time')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="expected_exit_time" class="form-label">Expected Exit Time</label>
                        <input type="datetime-local" class="form-control @error('expected_exit_time') is-invalid @enderror" id="expected_exit_time" name="expected_exit_time" value="{{ old('expected_exit_time', now()->addHours(2)->format('Y-m-d\TH:i')) }}" required>
                        @error('expected_exit_time')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Check-in Visitor</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
