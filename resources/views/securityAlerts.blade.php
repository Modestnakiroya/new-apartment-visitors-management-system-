{{-- resources/views/security/alerts.blade.php --}}
@extends('layouts.app',['activePage' => 'Security Alerts', 'title' => 'Security Alerts', 'navName' => 'Security Alerts', 'activeButton' => 'laravel'])

@section('title', 'Security Alerts')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <h4>Security Alerts Dashboard</h4>
                        <div>
                            <a href="#" class="btn btn-primary btn-sm me-2">Mark All as Read</a>
                            <a href="#" class="btn btn-outline-secondary btn-sm">Export Logs</a>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <!-- Top Alert Summary Cards -->
                    <div class="row mx-4 mt-4">
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                                Unauthorized Access Attempts</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                @if(isset($unauthorizedCount))
                                                    {{ $unauthorizedCount }}
                                                @else
                                                    <span class="text-muted">No data</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-exclamation-triangle fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Access Denied Logs</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                @if(isset($deniedCount))
                                                    {{ $deniedCount }}
                                                @else
                                                    <span class="text-muted">No data</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-ban fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                Watch List Notifications</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                @if(isset($watchlistCount))
                                                    {{ $watchlistCount }}
                                                @else
                                                    <span class="text-muted">No data</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user-shield fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Alerts Filter -->
                    <div class="mx-4 mb-4">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Filter Alerts</h6>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('securityAlerts') }}" method="GET" class="row g-3">
                                    <div class="col-md-3">
                                        <label for="alertType" class="form-label">Alert Type</label>
                                        <select class="form-select" id="alertType" name="type">
                                            <option value="">All Types</option>
                                            <option value="unauthorized">Unauthorized Access</option>
                                            <option value="denied">Access Denied</option>
                                            <option value="watchlist">Watch List</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="dateFrom" class="form-label">Date From</label>
                                        <input type="date" class="form-control" id="dateFrom" name="date_from">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="dateTo" class="form-label">Date To</label>
                                        <input type="date" class="form-control" id="dateTo" name="date_to">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="severity" class="form-label">Severity</label>
                                        <select class="form-select" id="severity" name="severity">
                                            <option value="">All</option>
                                            <option value="low">Low</option>
                                            <option value="medium">Medium</option>
                                            <option value="high">High</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12 mt-3">
                                        <button type="submit" class="btn btn-primary">Apply Filters</button>
                                        <button type="reset" class="btn btn-outline-secondary">Reset</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Tabs for Different Alert Types -->
                    <div class="mx-4">
                        <ul class="nav nav-tabs" id="alertTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="unauthorized-tab" data-bs-toggle="tab" data-bs-target="#unauthorized" type="button" role="tab" aria-controls="unauthorized" aria-selected="true">Unauthorized Access</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="denied-tab" data-bs-toggle="tab" data-bs-target="#denied" type="button" role="tab" aria-controls="denied" aria-selected="false">Access Denied</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="watchlist-tab" data-bs-toggle="tab" data-bs-target="#watchlist" type="button" role="tab" aria-controls="watchlist" aria-selected="false">Watch List</button>
                            </li>
                        </ul>
                    </div>

                    <div class="tab-content" id="alertTabsContent">
                        <!-- Unauthorized Access Tab -->
                        <div class="tab-pane fade show active" id="unauthorized" role="tabpanel" aria-labelledby="unauthorized-tab">
                            <div class="table-responsive p-4">
                                @if(isset($unauthorizedAccess) && count($unauthorizedAccess) > 0)
                                    <table class="table align-items-center mb-0">
                                        <thead>
                                            <tr>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date/Time</th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Location</th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Attempted By</th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Severity</th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status</th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($unauthorizedAccess ?? [] as $alert)
                                                <tr>
                                                    <td>{{ $alert->created_at ?? 'N/A' }}</td>
                                                    <td>{{ $alert->location ?? 'N/A' }}</td>
                                                    <td>{{ $alert->attempted_by ?? 'Unknown' }}</td>
                                                    <td>
                                                        @if(isset($alert->severity))
                                                            @if($alert->severity == 'high')
                                                                <span class="badge bg-danger">High</span>
                                                            @elseif($alert->severity == 'medium')
                                                                <span class="badge bg-warning">Medium</span>
                                                            @else
                                                                <span class="badge bg-info">Low</span>
                                                            @endif
                                                        @else
                                                            <span class="badge bg-secondary">Unknown</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if(isset($alert->status))
                                                            @if($alert->status == 'resolved')
                                                                <span class="badge bg-success">Resolved</span>
                                                            @elseif($alert->status == 'in_progress')
                                                                <span class="badge bg-warning">In Progress</span>
                                                            @else
                                                                <span class="badge bg-danger">New</span>
                                                            @endif
                                                        @else
                                                            <span class="badge bg-secondary">Unknown</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-sm btn-info">View Details</button>
                                                        <button class="btn btn-sm btn-success">Mark Resolved</button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <div class="alert alert-info text-center" role="alert">
                                        <i class="fas fa-info-circle me-2"></i> No unauthorized access attempts found.
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Access Denied Tab -->
                        <div class="tab-pane fade" id="denied" role="tabpanel" aria-labelledby="denied-tab">
                            <div class="table-responsive p-4">
                                @if(isset($accessDenied) && count($accessDenied) > 0)
                                    <table class="table align-items-center mb-0">
                                        <thead>
                                            <tr>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date/Time</th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Location</th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Visitor Name</th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Reason</th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Denied By</th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($accessDenied ?? [] as $log)
                                                <tr>
                                                    <td>{{ $log->created_at ?? 'N/A' }}</td>
                                                    <td>{{ $log->location ?? 'N/A' }}</td>
                                                    <td>{{ $log->visitor_name ?? 'Unknown' }}</td>
                                                    <td>{{ $log->reason ?? 'No reason provided' }}</td>
                                                    <td>{{ $log->denied_by ?? 'System' }}</td>
                                                    <td>
                                                        <button class="btn btn-sm btn-info">View Details</button>
                                                        <button class="btn btn-sm btn-warning">Review</button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <div class="alert alert-info text-center" role="alert">
                                        <i class="fas fa-info-circle me-2"></i> No access denied logs found.
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Watch List Tab -->
                        <div class="tab-pane fade" id="watchlist" role="tabpanel" aria-labelledby="watchlist-tab">
                            <div class="table-responsive p-4">
                                @if(isset($watchlistNotifications) && count($watchlistNotifications) > 0)
                                    <table class="table align-items-center mb-0">
                                        <thead>
                                            <tr>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Alert Time</th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Person Name</th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Watch Reason</th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Location</th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status</th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($watchlistNotifications ?? [] as $notification)
                                                <tr>
                                                    <td>{{ $notification->alert_time ?? 'N/A' }}</td>
                                                    <td>{{ $notification->person_name ?? 'Unknown' }}</td>
                                                    <td>{{ $notification->watch_reason ?? 'N/A' }}</td>
                                                    <td>{{ $notification->location ?? 'N/A' }}</td>
                                                    <td>
                                                        @if(isset($notification->status))
                                                            @if($notification->status == 'resolved')
                                                                <span class="badge bg-success">Resolved</span>
                                                            @elseif($notification->status == 'in_progress')
                                                                <span class="badge bg-warning">In Progress</span>
                                                            @else
                                                                <span class="badge bg-danger">Active</span>
                                                            @endif
                                                        @else
                                                            <span class="badge bg-secondary">Unknown</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-sm btn-info">View Details</button>
                                                        <button class="btn btn-sm btn-danger">Alert Security</button>
                                                        <button class="btn btn-sm btn-success">Mark Resolved</button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <div class="alert alert-info text-center" role="alert">
                                        <i class="fas fa-info-circle me-2"></i> No watch list notifications found.
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript for handling alert actions -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle mark as resolved buttons
    const resolveButtons = document.querySelectorAll('.btn-success');
    resolveButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            // In a real implementation, this would send an AJAX request
            // For now, just show a confirmation
            alert('Alert marked as resolved');
        });
    });

    // Error handling for potential data loading issues
    function checkAndHandleErrors() {
        const errorContainers = document.querySelectorAll('.tab-pane');
        errorContainers.forEach(container => {
            // Check if content is being displayed properly
            if (container.innerHTML.trim() === '') {
                container.innerHTML = '<div class="alert alert-warning m-4" role="alert">' +
                    '<i class="fas fa-exclamation-triangle me-2"></i> There was an error loading this content. Please try refreshing the page.' +
                    '</div>';
            }
        });
    }
    
    // Call error handling function after slight delay to ensure DOM is fully loaded
    setTimeout(checkAndHandleErrors, 500);
});
</script>
@endsection