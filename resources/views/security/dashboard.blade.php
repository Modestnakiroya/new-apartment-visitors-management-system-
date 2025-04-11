@extends('layouts.app')

@section('title', 'Security Dashboard - Apartment Visitor Management')

@section('content')
<div class="container-fluid">
    <h1 class="mb-4">Security Dashboard</h1>
    
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Active Visitors</h5>
                    <a href="{{ route('visitors.create') }}" class="btn btn-sm btn-light">
                        <i class="fas fa-plus"></i> Check-in New Visitor
                    </a>
                </div>
                <div class="card-body">
                    @if($activeVisitors->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Resident</th>
                                        <th>Apartment</th>
                                        <th>Entry Time</th>
                                        <th>Expected Exit</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($activeVisitors as $visitor)
                                        <tr>
                                            <td>{{ $visitor->name }}</td>
                                            <td>{{ $visitor->resident->name }}</td>
                                            <td>{{ $visitor->resident->apartment->getFullNumberAttribute() }}</td>
                                            <td>{{ $visitor->entry_time->format('M d, Y g:i A') }}</td>
                                            <td>{{ $visitor->expected_exit_time->format('M d, Y g:i A') }}</td>
                                            <td>
                                                <form action="{{ route('visitors.checkout', $visitor->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('Confirm visitor checkout?')">
                                                        <i class="fas fa-sign-out-alt"></i> Checkout
                                                    </button>
                                                </form>
                                                <a href="{{ route('visitors.show', $visitor->id) }}" class="btn btn-sm btn-info">
                                                    <i class="fas fa-eye"></i> View
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="alert alert-info mb-0">
                            No active visitors at the moment.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-light">
                    <h5 class="mb-0">Recent Visitors</h5>
                </div>
                <div class="card-body">
                    @if($recentVisitors->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Resident</th>
                                        <th>Apartment</th>
                                        <th>Entry Time</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentVisitors as $visitor)
                                        <tr>
                                            <td>{{ $visitor->name }}</td>
                                            <td>{{ $visitor->resident->name }}</td>
                                            <td>{{ $visitor->resident->apartment->getFullNumberAttribute() }}</td>
                                            <td>{{ $visitor->entry_time->format('M d, Y g:i A') }}</td>
                                            <td>
                                                @if($visitor->isActive())
                                                    <span class="badge bg-success">Active</span>
                                                @else
                                                    <span class="badge bg-secondary">Checked Out</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($visitor->isActive())
                                                    <form action="{{ route('visitors.checkout', $visitor->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('Confirm visitor checkout?')">
                                                            <i class="fas fa-sign-out-alt"></i> Checkout
                                                        </button>
                                                    </form>
                                                @endif
                                                <a href="{{ route('visitors.show', $visitor->id) }}" class="btn btn-sm btn-info">
                                                    <i class="fas fa-eye"></i> View
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="alert alert-info mb-0">
                            No recent visitors.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
