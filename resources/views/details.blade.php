@extends('layouts.app', [
    'activePage' => 'details',
    'title' => 'Dashboard Details',
    'navName' => 'Dashboard Details',
    'activeButton' => 'laravel'
])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- Current Visitors -->
                <div class="col-md-12">
                    <div class="card strpied-tabled-with-hover">
                        <div class="card-header">
                            <h4 class="card-title">Current Visitors</h4>
                            <p class="card-category">Visitors who are currently checked in</p>
                        </div>
                        <div class="card-body table-full-width table-responsive">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Check-In</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($currentVisitors as $visitor)
                                        <tr>
                                            <td>{{ $visitor->name }}</td>
                                            <td>{{ $visitor->check_in }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Expected Visitors -->
                <div class="col-md-12">
                    <div class="card strpied-tabled-with-hover">
                        <div class="card-header">
                            <h4 class="card-title">Expected Visitors</h4>
                            <p class="card-category">Visitors expected to arrive today</p>
                        </div>
                        <div class="card-body table-full-width table-responsive">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Expected Arrival</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($expectedVisitors as $visitor)
                                        <tr>
                                            <td>{{ $visitor->name }}</td>
                                            <td>{{ $visitor->expected_arrival }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Today's Visitors -->
                <div class="col-md-12">
                    <div class="card strpied-tabled-with-hover">
                        <div class="card-header">
                            <h4 class="card-title">Today's Visitors</h4>
                            <p class="card-category">Visitors who checked in today</p>
                        </div>
                        <div class="card-body table-full-width table-responsive">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Check-In</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($todaysVisitors as $visitor)
                                        <tr>
                                            <td>{{ $visitor->name }}</td>
                                            <td>{{ $visitor->check_in }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Pending Approvals -->
                <div class="col-md-12">
                    <div class="card strpied-tabled-with-hover">
                        <div class="card-header">
                            <h4 class="card-title">Pending Approvals</h4>
                            <p class="card-category">Visitor approvals awaiting action</p>
                        </div>
                        <div class="card-body table-full-width table-responsive">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pendingApprovals as $pending)
                                        <tr>
                                            <td>{{ $pending->visitor->name }}</td>
                                            <td>{{ $pending->status }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Overstayed Visitors -->
                <div class="col-md-12">
                    <div class="card strpied-tabled-with-hover">
                        <div class="card-header">
                            <h4 class="card-title">Overstayed Visitors</h4>
                            <p class="card-category">Visitors who have overstayed their allowed time</p>
                        </div>
                        <div class="card-body table-full-width table-responsive">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Check-In</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($overstayedVisitors as $visitor)
                                        <tr>
                                            <td>{{ $visitor->name }}</td>
                                            <td>{{ $visitor->check_in }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Security Alerts -->
                <div class="col-md-12">
                    <div class="card strpied-tabled-with-hover">
                        <div class="card-header">
                            <h4 class="card-title">Security Alerts</h4>
                            <p class="card-category">Active security alerts</p>
                        </div>
                        <div class="card-body table-full-width table-responsive">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>Description</th>
                                        <th>Resolved</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($securityAlerts as $alert)
                                        <tr>
                                            <td>{{ $alert->description }}</td>
                                            <td>{{ $alert->resolved ? 'Yes' : 'No' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        .main-panel {
            width: calc(100% - 260px);
            margin-left: 260px;
        }

        .content {
            padding: 20px;
            margin-left: 0;
        }

        /* Ensure tables inside cards are styled correctly */
        .card {
            margin-bottom: 20px;
        }

        .card-header {
            padding: 15px;
        }

        .card-title {
            margin-bottom: 5px;
            font-size: 1.3em;
        }

        .card-category {
            color: #999;
            font-size: 0.9em;
        }

        .table {
            margin-bottom: 0;
        }
    </style>
@endsection