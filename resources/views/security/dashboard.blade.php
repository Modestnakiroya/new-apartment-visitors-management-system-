@extends('layouts.app')

@section('title', 'Security Dashboard - Apartment Visitor Management')

@section('content')
<div class="container-fluid py-4" style="background-image: url('/lightbootstrap/img/banner3.jpeg'); background-size: cover; background-position: center; background-attachment: fixed; position: relative; min-height: 100vh;">
    <!-- Removed the white overlay that was making the background appear white -->
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold text-primary"><i class="fas fa-shield-alt me-2"></i>Askari Dashboard</h1>
        <div class="d-flex">
            <a href="{{ route('visitors.create') }}" class="btn btn-primary rounded-pill shadow-sm">
                <i class="fas fa-plus me-2"></i> Check-in New Visitor
            </a>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card border-0 shadow-sm" style="background-color: rgba(255, 255, 255, 0.85); backdrop-filter: blur(5px);">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="fas fa-user-check me-2"></i>Active Visitors</h5>
                </div>
                <div class="card-body">
                    @if($activeVisitors->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Name</th>
                                        <th>Resident</th>
                                        <th>Apartment</th>
                                        <th>Entry Time</th>
                                        <th>Expected Exit</th>
                                        <th class="text-end">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($activeVisitors as $visitor)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar bg-light text-primary rounded-circle me-3 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px">
                                                        <i class="fas fa-user"></i>
                                                    </div>
                                                    <span class="fw-medium">{{ $visitor->name }}</span>
                                                </div>
                                            </td>
                                            <td>{{ $visitor->resident->name }}</td>
                                            <td><span class="badge bg-light text-dark">{{ $visitor->resident->apartment->getFullNumberAttribute() }}</span></td>
                                            <td><i class="far fa-clock text-muted me-1"></i> {{ $visitor->entry_time->format('M d, Y g:i A') }}</td>
                                            <td><i class="far fa-calendar-alt text-muted me-1"></i> {{ $visitor->expected_exit_time->format('M d, Y g:i A') }}</td>
                                            <td class="text-end">
                                                <form action="{{ route('visitors.checkout', $visitor->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="btn btn-sm btn-outline-success rounded-pill" onclick="return confirm('Confirm visitor checkout?')">
                                                        <i class="fas fa-sign-out-alt me-1"></i> Checkout
                                                    </button>
                                                </form>
                                                <a href="{{ route('visitors.show', $visitor->id) }}" class="btn btn-sm btn-outline-info rounded-pill ms-1">
                                                    <i class="fas fa-eye me-1"></i> View
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="alert alert-info d-flex align-items-center mb-0">
                            <i class="fas fa-info-circle me-2 fs-4"></i>
                            <span>No active visitors at the moment.</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow-sm" style="background-color: rgba(255, 255, 255, 0.85); backdrop-filter: blur(5px);">
                <div class="card-header bg-light d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 text-dark"><i class="fas fa-history me-2"></i>Recent Visitors</h5>
                </div>
                <div class="card-body">
                    @if($recentVisitors->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Name</th>
                                        <th>Resident</th>
                                        <th>Apartment</th>
                                        <th>Entry Time</th>
                                        <th>Status</th>
                                        <th class="text-end">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentVisitors as $visitor)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar bg-light text-secondary rounded-circle me-3 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px">
                                                        <i class="fas fa-user"></i>
                                                    </div>
                                                    <span class="fw-medium">{{ $visitor->name }}</span>
                                                </div>
                                            </td>
                                            <td>{{ $visitor->resident->name }}</td>
                                            <td><span class="badge bg-light text-dark">{{ $visitor->resident->apartment->getFullNumberAttribute() }}</span></td>
                                            <td><i class="far fa-clock text-muted me-1"></i> {{ $visitor->entry_time->format('M d, Y g:i A') }}</td>
                                            <td>
                                                @if($visitor->isActive())
                                                    <span class="badge bg-success rounded-pill px-3"><i class="fas fa-circle me-1 small"></i>Active</span>
                                                @else
                                                    <span class="badge bg-secondary rounded-pill px-3"><i class="fas fa-circle me-1 small"></i>Checked Out</span>
                                                @endif
                                            </td>
                                            <td class="text-end">
                                                @if($visitor->isActive())
                                                    <form action="{{ route('visitors.checkout', $visitor->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" class="btn btn-sm btn-outline-success rounded-pill" onclick="return confirm('Confirm visitor checkout?')">
                                                            <i class="fas fa-sign-out-alt me-1"></i> Checkout
                                                        </button>
                                                    </form>
                                                @endif
                                                <a href="{{ route('visitors.show', $visitor->id) }}" class="btn btn-sm btn-outline-info rounded-pill ms-1">
                                                    <i class="fas fa-eye me-1"></i> View
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="alert alert-info d-flex align-items-center mb-0">
                            <i class="fas fa-info-circle me-2 fs-4"></i>
                            <span>No recent visitors.</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection