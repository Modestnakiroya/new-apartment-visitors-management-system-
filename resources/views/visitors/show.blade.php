@extends('layouts.app')

@section('title', 'Visitor Details - Apartment Visitor Management')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Visitor Details</h1>
        <div>
            @if($visitor->isActive())
            <form action="{{ route('visitors.checkout', $visitor->id) }}" method="POST" class="d-inline">
                @csrf
                @method('PUT')
                <button type="submit" class="btn btn-success" onclick="return confirm('Confirm visitor checkout?')">
                    <i class="fas fa-sign-out-alt"></i> Checkout Visitor
                </button>
            </form>
            @endif
            <a href="{{ route('visitors.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Visitors
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Visitor Information</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Name:</strong>
                        </div>
                        <div class="col-md-8">
                            {{ $visitor->name }}
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Phone:</strong>
                        </div>
                        <div class="col-md-8">
                            {{ $visitor->phone }}
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Status:</strong>
                        </div>
                        <div class="col-md-8">
                            @if($visitor->isActive())
                            <span class="badge bg-success">Active</span>
                            @else
                            <span class="badge bg-secondary">Checked Out</span>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Entry Time:</strong>
                        </div>
                        <div class="col-md-8">
                            {{ $visitor->entry_time->format('M d, Y g:i A') }}
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Expected Exit:</strong>
                        </div>
                        <div class="col-md-8">
                            {{ $visitor->expected_exit_time->format('M d, Y g:i A') }}
                        </div>
                    </div>
                    @if($visitor->actual_exit_time)
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Actual Exit:</strong>
                        </div>
                        <div class="col-md-8">
                            {{ $visitor->actual_exit_time->format('M d, Y g:i A') }}
                        </div>
                    </div>
                    @endif
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Reason for Visit:</strong>
                        </div>
                        <div class="col-md-8">
                            {{ $visitor->reason }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0">Resident Information</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Name:</strong>
                        </div>
                        <div class="col-md-8">
                            {{ $visitor->resident->name }}
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Phone:</strong>
                        </div>
                        <div class="col-md-8">
                            {{ $visitor->resident->phone }}
                        </div>
                    </div>
                    @if($visitor->resident->email)
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Email:</strong>
                        </div>
                        <div class="col-md-8">
                            {{ $visitor->resident->email }}
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <div class="card">
                <div class="card-header bg-warning text-white">
                    <h5 class="mb-0">Apartment Information</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Floor:</strong>
                        </div>
                        <div class="col-md-8">
                            {{ $visitor->resident->apartment->floor }}
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Number:</strong>
                        </div>
                        <div class="col-md-8">
                            {{ $visitor->resident->apartment->number }}
                        </div>
                    </div>
                    @if($visitor->resident->apartment->description)
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Description:</strong>
                        </div>
                        <div class="col-md-8">
                            {{ $visitor->resident->apartment->description }}
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
