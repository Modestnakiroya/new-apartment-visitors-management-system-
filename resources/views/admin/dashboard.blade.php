@extends('layouts.app')

@section('title', 'Admin Dashboard - Apartment Visitor Management')

@section('content')
<div class="container-fluid">
    <h1 class="mb-4">Admin Dashboard</h1>

    <div class="row">
        <div class="col-md-3 mb-4">
            <div class="card bg-primary text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase">Total Visitors</h6>
                            <h2 class="mb-0">{{ $stats['totalVisitors'] }}</h2>
                        </div>
                        <i class="fas fa-users fa-3x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card bg-success text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase">Active Visitors</h6>
                            <h2 class="mb-0">{{ $stats['activeVisitors'] }}</h2>
                        </div>
                        <i class="fas fa-user-clock fa-3x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card bg-info text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase">Total Residents</h6>
                            <h2 class="mb-0">{{ $stats['totalResidents'] }}</h2>
                        </div>
                        <i class="fas fa-user-friends fa-3x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card bg-warning text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase">Total Apartments</h6>
                            <h2 class="mb-0">{{ $stats['totalApartments'] }}</h2>
                        </div>
                        <i class="fas fa-building fa-3x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 mb-4">
            <div class="card">
                <div class="card-header bg-light">
                    <h5 class="mb-0">Visitor Traffic (Last 7 Days)</h5>
                </div>
                <div class="card-body">
                    <canvas id="visitorChart" height="250"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-header bg-light">
                    <h5 class="mb-0">Most Visited Floors</h5>
                </div>
                <div class="card-body">
                    <canvas id="floorChart" height="250"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Visitor Traffic Chart
    const visitorData = {!! json_encode($analytics['visitorsByDay']) !!};
    const labels = visitorData.map(item => item.date);
    const counts = visitorData.map(item => item.count);

    const visitorCtx = document.getElementById('visitorChart').getContext('2d');
    new Chart(visitorCtx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Number of Visitors',
                data: counts,
                backgroundColor: 'rgba(13, 110, 253, 0.2)',
                borderColor: 'rgba(13, 110, 253, 1)',
                borderWidth: 2,
                tension: 0.1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0
                    }
                }
            }
        }
    });

    // Floor Chart
    const floorData = {!! json_encode($analytics['popularFloors']) !!};
    const floorLabels = floorData.map(item => `Floor ${item.floor}`);
    const floorCounts = floorData.map(item => item.visits);

    const floorCtx = document.getElementById('floorChart').getContext('2d');
    new Chart(floorCtx, {
        type: 'doughnut',
        data: {
            labels: floorLabels,
            datasets: [{
                data: floorCounts,
                backgroundColor: [
                    'rgba(13, 110, 253, 0.7)',
                    'rgba(25, 135, 84, 0.7)',
                    'rgba(13, 202, 240, 0.7)',
                    'rgba(255, 193, 7, 0.7)',
                    'rgba(220, 53, 69, 0.7)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });
</script>
@endsection
