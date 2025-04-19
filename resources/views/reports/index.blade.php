@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Reports') }}</div>

                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <h3>Available Reports</h3>
                            <div class="list-group">
                                <a href="{{ route('reports.summary') }}" class="list-group-item list-group-item-action">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1">Summary Report</h5>
                                        <button class="btn btn-sm btn-primary">Generate</button>
                                    </div>
                                    <p class="mb-1">A comprehensive summary of visitors, residents, and apartments.</p>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="card bg-primary text-white mb-4">
                                <div class="card-body">
                                    <h5>Total Visitors</h5>
                                    <h2 class="display-4">{{ $totalVisitors }}</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-success text-white mb-4">
                                <div class="card-body">
                                    <h5>Active Visitors</h5>
                                    <h2 class="display-4">{{ $activeVisitors }}</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-info text-white mb-4">
                                <div class="card-body">
                                    <h5>Total Residents</h5>
                                    <h2 class="display-4">{{ $totalResidents }}</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-warning text-dark mb-4">
                                <div class="card-body">
                                    <h5>Total Apartments</h5>
                                    <h2 class="display-4">{{ $totalApartments }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
