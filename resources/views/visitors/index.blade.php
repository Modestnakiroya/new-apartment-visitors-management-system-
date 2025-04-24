@extends('layouts.app')

@section('title', 'Manage Visitors - Apartment Visitor Management')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="text-primary fw-bold">
            <i class="fas fa-users me-2"></i>Visitor Management
        </h1>
        <a href="{{ route('visitors.create') }}" class="btn btn-primary px-4 py-2">
            <i class="fas fa-plus me-2"></i> New Visitor
        </a>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('visitors.search') }}" method="GET" class="row g-3">
                <div class="col-md-10">
                    <input type="text" class="form-control" name="query" placeholder="Search by visitor or resident name..." value="{{ $query ?? '' }}">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-search"></i> Search
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-header bg-light py-3 d-flex justify-content-between align-items-center">
            <h5 class="mb-0 text-secondary">
                <i class="fas fa-list me-2"></i>Visitor Records
            </h5>
            <span class="badge bg-primary rounded-pill px-3 py-2">
                {{ $visitors->total() }} Total Visitors
            </span>
        </div>
        <div class="card-body p-0">
            @if($visitors->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="px-4 py-3">Name</th>
                            <th class="py-3">Phone</th>
                            <th class="py-3">Resident</th>
                            <th class="py-3">Apartment</th>
                            <th class="py-3">Entry Time</th>
                            <th class="py-3">Exit Time</th>
                            <th class="py-3">Status</th>
                            <th class="px-4 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($visitors as $visitor)
                        <tr class="{{ $visitor->isActive() ? 'table-row-active' : '' }}">
                            <td class="px-4 py-3 fw-semibold">{{ $visitor->name }}</td>
                            <td class="py-3">{{ $visitor->phone }}</td>
                            <td class="py-3">{{ $visitor->resident->name }}</td>
                            <td class="py-3">
                                <span class="badge bg-light text-dark px-3 py-2 rounded-pill">
                                    {{ $visitor->resident->apartment->getFullNumberAttribute() }}
                                </span>
                            </td>
                            <td class="py-3">
                                <span class="text-nowrap">
                                    <i class="far fa-calendar-check text-success me-1"></i>
                                    {{ $visitor->entry_time->format('M d, Y') }}
                                </span>
                                <br>
                                <small class="text-muted">
                                    {{ $visitor->entry_time->format('g:i A') }}
                                </small>
                            </td>
                            <td class="py-3">
                                @if($visitor->actual_exit_time)
                                <span class="text-nowrap">
                                    <i class="far fa-calendar-times text-danger me-1"></i>
                                    {{ $visitor->actual_exit_time->format('M d, Y') }}
                                </span>
                                <br>
                                <small class="text-muted">
                                    {{ $visitor->actual_exit_time->format('g:i A') }}
                                </small>
                                @else
                                <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td class="py-3">
                                @if($visitor->isActive())
                                <span class="badge bg-success px-3 py-2">
                                    <i class="fas fa-circle me-1 small"></i>Active
                                </span>
                                @else
                                <span class="badge bg-secondary px-3 py-2">
                                    <i class="fas fa-check-circle me-1 small"></i>Checked Out
                                </span>
                                @endif
                            </td>
                            <td class="px-4 py-3">
                                <div class="d-flex gap-2">
                                    <a href="{{ route('visitors.show', $visitor->id) }}" class="btn btn-sm btn-outline-info px-3">
                                        <i class="fas fa-eye me-1"></i> View
                                    </a>
                                    @if($visitor->isActive())
                                    <form action="{{ route('visitors.checkout', $visitor->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-sm btn-success px-3" onclick="return confirm('Confirm visitor checkout?')">
                                            <i class="fas fa-sign-out-alt me-1"></i> Checkout
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center pt-4 pb-3">
                {{ $visitors->links() }}
            </div>
            @else
            <div class="alert alert-info rounded-0 mb-0 text-center py-4">
                <i class="fas fa-info-circle me-2 fa-lg"></i>
                <span class="fw-semibold">No visitors found matching your criteria.</span>
            </div>
            @endif
        </div>
    </div>
</div>

<style>
    .table-row-active {
        border-left: 4px solid #198754;
    }
    .pagination {
        margin-bottom: 0;
    }
    .btn-outline-info:hover {
        color: white;
    }
    .badge {
        font-weight: 500;
        letter-spacing: 0.3px;
    }
    .table thead th {
        font-weight: 600;
        border-bottom-width: 1px;
    }
</style>
@endsection