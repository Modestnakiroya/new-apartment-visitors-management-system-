@extends('layouts.app')

@section('title', 'Check-in Visitor - Apartment Visitor Management')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="text-primary fw-bold">
            <i class="fas fa-clipboard-list me-2"></i>Check-in New Visitor
        </h1>
        <a href="{{ route('visitors.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-1"></i> Back to Visitors
        </a>
    </div>

    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-header bg-light py-3">
            <h5 class="mb-0 text-secondary">
                <i class="fas fa-user-plus me-2"></i>Visitor Information
            </h5>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('visitors.store') }}" method="POST">
                @csrf
                <div class="row g-4 mb-4">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name" class="form-label fw-semibold">
                                <i class="fas fa-user me-1 text-muted"></i> Visitor Name
                            </label>
                            <input type="text" class="form-control form-control-lg @error('name') is-invalid @enderror" 
                                id="name" name="name" value="{{ old('name') }}" placeholder="Enter full name" required>
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="phone" class="form-label fw-semibold">
                                <i class="fas fa-phone me-1 text-muted"></i> Phone Number
                            </label>
                            <input type="text" class="form-control form-control-lg @error('phone') is-invalid @enderror" 
                                id="phone" name="phone" value="{{ old('phone') }}" placeholder="Enter phone number" required>
                            @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row g-4 mb-4">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="resident_id" class="form-label fw-semibold">
                                <i class="fas fa-home me-1 text-muted"></i> Resident to Visit
                            </label>
                            <select class="form-select form-select-lg @error('resident_id') is-invalid @enderror" 
                                id="resident_id" name="resident_id" required>
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
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="visit_type" class="form-label fw-semibold">
                                <i class="fas fa-tag me-1 text-muted"></i> Visit Type
                            </label>
                            <select class="form-select form-select-lg @error('visit_type') is-invalid @enderror"
                                id="visit_type" name="visit_type" required>
                                <option value="">Select Visit Type</option>
                                <option value="guest" {{ old('visit_type') == 'guest' ? 'selected' : '' }}>Guest</option>
                                <option value="delivery" {{ old('visit_type') == 'delivery' ? 'selected' : '' }}>Delivery</option>
                                <option value="service" {{ old('visit_type') == 'service' ? 'selected' : '' }}>Service</option>
                            </select>
                            @error('visit_type')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="reason" class="form-label fw-semibold">
                        <i class="fas fa-comment me-1 text-muted"></i> Reason for Visit
                    </label>
                    <textarea class="form-control @error('reason') is-invalid @enderror" 
                        id="reason" name="reason" rows="3" placeholder="Describe the purpose of this visit" required>{{ old('reason') }}</textarea>
                    @error('reason')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row g-4 mb-4">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="entry_time" class="form-label fw-semibold">
                                <i class="fas fa-sign-in-alt me-1 text-muted"></i> Entry Time
                            </label>
                            <input type="datetime-local" class="form-control form-control-lg @error('entry_time') is-invalid @enderror" 
                                id="entry_time" name="entry_time" value="{{ old('entry_time', now()->format('Y-m-d\TH:i')) }}" required>
                            @error('entry_time')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="expected_exit_time" class="form-label fw-semibold">
                                <i class="fas fa-sign-out-alt me-1 text-muted"></i> Expected Exit Time
                            </label>
                            <input type="datetime-local" class="form-control form-control-lg @error('expected_exit_time') is-invalid @enderror" 
                                id="expected_exit_time" name="expected_exit_time" value="{{ old('expected_exit_time', now()->addHours(2)->format('Y-m-d\TH:i')) }}" required>
                            @error('expected_exit_time')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="d-grid gap-2 mt-4">
                    <button type="submit" class="btn btn-primary btn-lg py-3">
                        <i class="fas fa-check-circle me-2"></i> Complete Check-in
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Optional: Add any JavaScript enhancements here if needed
    $(document).ready(function() {
        // Example: Add nice focus effect
        $('.form-control, .form-select').on('focus', function() {
            $(this).parent().addClass('focused');
        }).on('blur', function() {
            $(this).parent().removeClass('focused');
        });
    });
</script>
@endpush

<style>
    /* Optional: Add custom styles */
    .form-control:focus, .form-select:focus {
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.15);
        border-color: #86b7fe;
    }
    .focused label {
        color: #0d6efd;
    }
</style>
@endsection