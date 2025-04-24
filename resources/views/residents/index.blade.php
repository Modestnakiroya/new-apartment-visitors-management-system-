@extends('layouts.app')

@section('title', 'Manage Residents')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="text-primary fw-bold">
            <i class="fas fa-user-friends me-2"></i>Resident Management
        </h1>
        <a href="{{ route('residents.create') }}" class="btn btn-primary px-4 py-2">
            <i class="fas fa-user-plus me-2"></i> Add New Resident
        </a>
    </div>

    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-header bg-light py-3 d-flex justify-content-between align-items-center">
            <h5 class="mb-0 text-secondary">
                <i class="fas fa-list me-2"></i>Resident Directory
            </h5>
            <span class="badge bg-primary rounded-pill px-3 py-2">
                {{ $residents->total() }} Total Residents
            </span>
        </div>
        <div class="card-body p-0">
            @if($residents->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="px-4 py-3">Name</th>
                            <th class="py-3">Phone</th>
                            <th class="py-3">Email</th>
                            <th class="py-3">Apartment</th>
                            <th class="px-4 py-3 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($residents as $resident)
                        <tr>
                            <td class="px-4 py-3 fw-semibold">{{ $resident->name }}</td>
                            <td class="py-3">
                                <i class="fas fa-phone-alt text-muted me-1 small"></i>
                                {{ $resident->phone }}
                            </td>
                            <td class="py-3">
                                @if($resident->email)
                                    <i class="fas fa-envelope text-muted me-1 small"></i>
                                    {{ $resident->email }}
                                @else
                                    <span class="text-muted">N/A</span>
                                @endif
                            </td>
                            <td class="py-3">
                                @if($resident->apartment)
                                    <span class="badge bg-light text-dark px-3 py-2 rounded-pill">
                                        <i class="fas fa-home me-1 small"></i>
                                        {{ $resident->apartment->getFullNumberAttribute() }}
                                    </span>
                                @else
                                    <span class="badge bg-secondary px-3 py-2 rounded-pill">
                                        Not Assigned
                                    </span>
                                @endif
                            </td>
                            <td class="px-4 py-3">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('residents.edit', $resident->id) }}" class="btn btn-outline-warning px-3">
                                        <i class="fas fa-edit me-1"></i> Edit
                                    </a>
                                    <form action="{{ route('residents.destroy', $resident->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger px-3" 
                                            onclick="return confirm('Are you sure you want to delete this resident?')">
                                            <i class="fas fa-trash me-1"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center py-4">
                {{ $residents->links() }}
            </div>
            @else
            <div class="alert alert-info rounded-0 mb-0 text-center py-4">
                <i class="fas fa-info-circle me-2 fa-lg"></i>
                <span class="fw-semibold">No residents found in the system.</span>
            </div>
            @endif
        </div>
    </div>
</div>

<style>
    .table thead th {
        font-weight: 600;
        border-bottom-width: 1px;
    }
    .pagination {
        margin-bottom: 0;
    }
    .btn-outline-warning:hover {
        color: #212529;
    }
    .btn-outline-danger:hover {
        color: white;
    }
    .badge {
        font-weight: 500;
        letter-spacing: 0.3px;
    }
</style>
@endsection