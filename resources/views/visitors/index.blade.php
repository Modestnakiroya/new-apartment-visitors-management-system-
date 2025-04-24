@extends('layouts.app')

@section('title', 'Manage Visitors - Apartment Visitor Management')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Visitors</h1>
        <a href="{{ route('visitors.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> New Visitor
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            @if($visitors->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Resident</th>
                            <th>Apartment</th>
                            <th>Entry Time</th>
                            <th>Exit Time</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($visitors as $visitor)
                        <tr>
                            <td>{{ $visitor->name }}</td>
                            <td>{{ $visitor->phone }}</td>
                            <td>{{ $visitor->resident->name }}</td>
                            <td>{{ $visitor->resident->apartment->getFullNumberAttribute() }}</td>
                            <td>{{ $visitor->entry_time->format('M d, Y g:i A') }}</td>
                            <td>{{ $visitor->actual_exit_time ? $visitor->actual_exit_time->format('M d, Y g:i A') : '-' }}</td>
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
            <div class="d-flex justify-content-center mt-3">
                {{ $visitors->links() }}
            </div>
            @else
            <div class="alert alert-info mb-0">
                No visitors found.
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
