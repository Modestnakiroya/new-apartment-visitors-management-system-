@extends('layouts.app', ['activePage' => 'analytics', 'title' => 'Apartment Visitor Management System', 'navName' => 'analytics', 'activeButton' => 'laravel'])

@section('content')
<style>
    body {
        background-image: url('image/back.jpg'); 
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        font-family: 'Roboto', sans-serif;
        color: #333;
    }
     .content {
        min-height: 100vh;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    }
    .chart-container {
        position: relative;
        height: 300px;
        width: 100%;
    }
    .card {
        margin-bottom: 20px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
        overflow: hidden;
        transition: transform 0.3s ease-in-out;
    }
    .card:hover {
        transform: translateY(-5px);
    }
    .card-header {
        background-color: #4e73df;
        border-bottom: 1px solid #e3e6f0;
        padding: 15px;
    }
    .card-title {
        margin-bottom: 0;
        color: #ffffff;
        font-weight: 600;
    }
    .card-body {
        padding: 20px;
    }
    ul, ol {
        padding-left: 20px;
        margin-bottom: 0;
    }
    li {
        margin-bottom: 5px;
    }
    .dashboard-title {
        text-align: center;
        color: #4e73df;
        margin-bottom: 30px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 2px;
    }
</style>
<div class="content">
    <div class="container-fluid">
        <h2 class="dashboard-title">Visitor Management Analytics</h2>
        
        < class="row">
            <!-- Frequent Visitors -->
<div class="col-md-6">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Most Frequent Visitors This Month</h4>
        </div>
        <div class="card-body">
            <ol>
                @forelse ($mostFrequentVisitors as $visitor)
                    <li>{{ $visitor->visitor->name }} ({{ $visitor->visit_count }} visits)</li>
                @empty
                    <li>No visits recorded this month.</li>
                @endforelse
            </ol>
        </div>
    </div>
</div>



<!-- Apartments with Most Visitors -->
<div class="col-md-6">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Apartments with Most Visitors</h4>
        </div>
        <div class="card-body">
            <ul>
                @forelse ($apartmentsWithMostVisitors as $apartmentNumber => $count)
                    <li>Apt {{ $apartmentNumber }} ({{ $count }} visitors)</li>
                @empty
                    <li>No visitor data available for this month.</li>
                @endforelse
            </ul>
        </div>
    </div>
</div>

        
        <div class="row">
            <!-- Visitor Purpose -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Common Visit Purposes</h4>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas id="purposeChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Visit Duration -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Average Visit Duration by Day</h4>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas id="durationChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Visitors by Hour -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Visitors by Hour of Day</h4>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas id="hourlyChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Monthly Visitor Trends -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Monthly Visitor Trends</h4>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas id="monthlyChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script type="text/javascript">
    // Add the color palette here
    var colorPalette = [
        'rgb(255, 99, 132)', 'rgb(54, 162, 235)', 'rgb(255, 206, 86)', 
        'rgb(75, 192, 192)', 'rgb(153, 102, 255)', 'rgb(255, 159, 64)',
        'rgb(199, 199, 199)', 'rgb(83, 102, 255)', 'rgb(40, 159, 183)',
        'rgb(210, 105, 30)', 'rgb(128, 0, 128)', 'rgb(0, 128, 0)'
    ];

    $(document).ready(function() {
        // Chart for visit purposes
        var ctxPurpose = document.getElementById('purposeChart').getContext('2d');
        var purposeChart = new Chart(ctxPurpose, {
            type: 'doughnut',
            data: {
                labels: ['Family Visit', 'Delivery', 'Maintenance', 'Friend Visit', 'Other'],
                datasets: [{
                    data: [35, 25, 15, 20, 5],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.8)',
                        'rgba(54, 162, 235, 0.8)',
                        'rgba(255, 206, 86, 0.8)',
                        'rgba(75, 192, 192, 0.8)',
                        'rgba(153, 102, 255, 0.8)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            font: {
                                size: 14
                            }
                        }
                    },
                    title: {
                        display: true,
                        text: 'Visit Purposes Distribution',
                        font: {
                            size: 18
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                var label = context.label || '';
                                var value = context.parsed || 0;
                                var total = context.dataset.data.reduce((a, b) => a + b, 0);
                                var percentage = Math.round((value / total) * 100);
                                return `${label}: ${percentage}% (${value})`;
                            }
                        }
                    }
                },
                cutout: '50%'
            }
        });

        // Chart for visit duration by day
        var ctxDuration = document.getElementById('durationChart').getContext('2d');
        var durationChart = new Chart(ctxDuration, {
            type: 'bar',
            data: {
                labels: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
                datasets: [{
                    label: 'Average Visit Duration (minutes)',
                    data: [45, 38, 52, 48, 65, 95, 85],
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Duration (minutes)'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Day of Week'
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    },
                    title: {
                        display: true,
                        text: 'Average Visit Duration by Day'
                    }
                }
            }
        });
        
        // Chart for visitors by hour
        var ctxHourly = document.getElementById('hourlyChart').getContext('2d');
        var hourlyData = [2, 1, 0, 0, 0, 3, 5, 9, 12, 14, 10, 18, 22, 15, 13, 17, 23, 28, 24, 18, 12, 8, 5, 3];
        var hourlyChart = new Chart(ctxHourly, {
            type: 'line',
            data: {
                labels: ['12am', '1am', '2am', '3am', '4am', '5am', '6am', '7am', '8am', '9am', '10am', '11am', 
                         '12pm', '1pm', '2pm', '3pm', '4pm', '5pm', '6pm', '7pm', '8pm', '9pm', '10pm', '11pm'],
                datasets: [{
                    label: 'Visitor Count',
                    data: hourlyData,
                    fill: true,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Number of Visitors'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Hour of Day'
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    },
                    title: {
                        display: true,
                        text: 'Visitors by Hour of Day'
                    }
                }
            }
        });
        
        // Chart for monthly visitor trends
        var ctxMonthly = document.getElementById('monthlyChart').getContext('2d');
        var monthlyChart = new Chart(ctxMonthly, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Regular Visitors',
                    data: [120, 135, 150, 145, 160, 175, 165, 180, 155, 140, 150, 170],
                    borderColor: 'rgba(255, 99, 132, 1)',
                    backgroundColor: 'rgba(255, 99, 132, 0.1)',
                    fill: true,
                    tension: 0.4
                },
                {
                    label: 'One-time Visitors',
                    data: [85, 90, 75, 80, 95, 110, 115, 125, 95, 85, 90, 100],
                    borderColor: 'rgba(54, 162, 235, 1)',
                    backgroundColor: 'rgba(54, 162, 235, 0.1)',
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Number of Visitors'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Month'
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    },
                    title: {
                        display: true,
                        text: 'Monthly Visitor Trends'
                    }
                }
            }
        });
    });
</script>
@endpush