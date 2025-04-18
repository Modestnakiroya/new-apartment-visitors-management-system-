@extends('layouts.app', ['activePage' => 'visitor-management', 'title' => 'Visitor Management', 'navName' => 'Visitors', 'activeButton' => 'laravel'])

@section('content')
<style>
    .visitor-management-background {
        background-color: #f0f8ff;
        background-image: 
            radial-gradient(#ffffff 15%, transparent 16%),
            radial-gradient(#ffffff 15%, transparent 16%);
        background-size: 60px 60px;
        background-position: 0 0, 30px 30px;
    }

    .section-card {
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        border: 1px solid rgba(255,255,255,0.3);
        margin-bottom: 25px;
    }

    .section-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.2);
    }

    .section-header {
        padding: 20px;
        background: linear-gradient(135deg, #4b6cb7, #182848);
        color: white;
    }
    
    .section-body {
        padding: 20px;
        background: white;
    }

    .tabs-container {
        display: flex;
        border-bottom: 1px solid #e5e7eb;
        margin-bottom: 20px;
    }

    .tab {
        padding: 12px 24px;
        cursor: pointer;
        font-weight: 600;
        border-bottom: 3px solid transparent;
        transition: all 0.3s ease;
    }

    .tab.active {
        border-bottom: 3px solid #4b6cb7;
        color: #4b6cb7;
    }

    .tab-content {
        display: none;
    }

    .tab-content.active {
        display: block;
    }

    .search-bar {
        display: flex;
        margin-bottom: 20px;
    }

    .search-input {
        flex-grow: 1;
        padding: 10px 15px;
        border: 1px solid #e5e7eb;
        border-radius: 8px 0 0 8px;
        outline: none;
    }

    .search-button {
        background: #4b6cb7;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 0 8px 8px 0;
        cursor: pointer;
    }

    .filter-controls {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-bottom: 20px;
    }

    .filter-select {
        padding: 8px 12px;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        background: white;
        min-width: 150px;
    }

    .visitor-table {
        width: 100%;
        border-collapse: collapse;
    }

    .visitor-table th, .visitor-table td {
        padding: 12px 15px;
        text-align: left;
        border-bottom: 1px solid #e5e7eb;
    }

    .visitor-table thead th {
        background-color: #f9fafb;
        font-weight: 600;
    }

    .visitor-table tbody tr:hover {
        background-color: #f9fafb;
    }

    .visitor-status {
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
    }

    .status-active {
        background-color: #d1fae5;
        color: #065f46;
    }

    .status-scheduled {
        background-color: #e0e7ff;
        color: #3730a3;
    }

    .status-completed {
        background-color: #f3f4f6;
        color: #6b7280;
    }

    .status-pending {
        background-color: #fef3c7;
        color: #92400e;
    }

    .action-button {
        padding: 5px 10px;
        border-radius: 5px;
        font-size: 0.85rem;
        cursor: pointer;
        margin-right: 5px;
        border: none;
    }

    .view-button {
        background-color: #e0e7ff;
        color: #3730a3;
    }

    .edit-button {
        background-color: #fef3c7;
        color: #92400e;
    }

    .delete-button {
        background-color: #fee2e2;
        color: #991b1b;
    }

    .pagination {
        display: flex;
        justify-content: center;
        margin-top: 20px;
        gap: 5px;
    }

    .page-item {
        padding: 8px 15px;
        border: 1px solid #e5e7eb;
        border-radius: 5px;
        cursor: pointer;
    }

    .page-item.active {
        background-color: #4b6cb7;
        color: white;
        border-color: #4b6cb7;
    }

    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.5);
        
    }

    .modal-content {
    background-color: white;
    margin: 50px auto;
    padding: 30px;
    border-radius: 15px;
    width: 80%;
    max-width: 800px;
    max-height: 80vh; /* limit height to 80% of the viewport */
    overflow-y: auto; /* enable vertical scrolling */
    box-shadow: 0 15px 30px rgba(0,0,0,0.2);
    position: relative;
}


    .close-modal {
        position: absolute;
        right: 20px;
        top: 20px;
        font-size: 24px;
        cursor: pointer;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
    }

    .form-input {
        width: 100%;
        padding: 10px 15px;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        outline: none;
    }

    .form-select {
        width: 100%;
        padding: 10px 15px;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        background: white;
    }

    .form-textarea {
        width: 100%;
        padding: 10px 15px;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        resize: vertical;
        min-height: 100px;
    }

    .form-row {
        display: flex;
        gap: 15px;
    }

    .form-col {
        flex: 1;
    }

    .submit-button {
        background: linear-gradient(135deg, #4b6cb7, #182848);
        color: white;
        border: none;
        padding: 12px 25px;
        border-radius: 8px;
        cursor: pointer;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .submit-button:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .visitor-stats {
        display: flex;
        gap: 15px;
        margin-bottom: 20px;
    }

    .stat-card {
        flex: 1;
        padding: 15px;
        border-radius: 10px;
        background: white;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        text-align: center;
    }

    .stat-value {
        font-size: 2rem;
        font-weight: 700;
        color: #4b6cb7;
    }

    .stat-label {
        font-size: 0.9rem;
        color: #6b7280;
    }

    .visitor-detail-row {
        display: flex;
        border-bottom: 1px solid #e5e7eb;
        padding: 12px 0;
    }

    .detail-label {
        width: 35%;
        font-weight: 600;
        color: #374151;
    }

    .detail-value {
        width: 65%;
        color: #6b7280;
    }

    .visitor-activity {
        margin-top: 20px;
    }

    .activity-item {
        display: flex;
        padding: 12px 0;
        border-bottom: 1px solid #e5e7eb;
    }

    .activity-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: #e0e7ff;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 15px;
    }

    .activity-content {
        flex-grow: 1;
    }

    .activity-title {
        font-weight: 600;
        margin-bottom: 3px;
    }

    .activity-time {
        font-size: 0.85rem;
        color: #6b7280;
    }

    .calendar-container {
        background: white;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    }

    .calendar-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
    }

    .calendar-month {
        font-size: 1.2rem;
        font-weight: 600;
    }

    .calendar-nav {
        display: flex;
        gap: 10px;
    }

    .calendar-nav-button {
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        border: 1px solid #e5e7eb;
        background: white;
        cursor: pointer;
    }

    .calendar-weekdays {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        text-align: center;
        font-weight: 600;
        margin-bottom: 10px;
    }

    .calendar-days {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 5px;
    }

    .calendar-day {
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        cursor: pointer;
    }

    .calendar-day:hover {
        background-color: #f3f4f6;
    }

    .calendar-day.today {
        background-color: #4b6cb7;
        color: white;
    }

    .calendar-day.has-events {
        position: relative;
    }

    .calendar-day.has-events::after {
        content: '';
        position: absolute;
        bottom: 5px;
        width: 5px;
        height: 5px;
        border-radius: 50%;
        background-color: #4b6cb7;
    }

    .event-list {
        margin-top: 20px;
    }

    .event-item {
        padding: 12px 15px;
        border-radius: 8px;
        margin-bottom: 10px;
        border-left: 4px solid #4b6cb7;
        background-color: #f9fafb;
    }

    .event-title {
        font-weight: 600;
        margin-bottom: 5px;
    }

    .event-time {
        font-size: 0.85rem;
        color: #6b7280;
    }

    .badge {
        display: inline-block;
        padding: 3px 8px;
        border-radius: 12px;
        font-size: 0.75rem;
        font-weight: 600;
        margin-left: 5px;
    }

    .badge-primary {
        background-color: #e0e7ff;
        color: #3730a3;
    }

    .badge-danger {
        background-color: #fee2e2;
        color: #991b1b;
    }

    .badge-success {
        background-color: #d1fae5;
        color: #065f46;
    }

    .badge-warning {
        background-color: #fef3c7;
        color: #92400e;
    }
</style>

<div class="visitor-management-background">
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="section-card">
            <div class="section-header">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h2><i class="fas fa-users mr-2"></i> Visitor Management</h2>
                        <p class="mb-0">Register, track, and manage all visitors to your apartment complex</p>
                    </div>
                    <div class="col-md-6 text-md-right">
                        <button class="btn btn-light" onclick="openModal('registerVisitorModal')">
                            <i class="fas fa-user-plus mr-2"></i> Register New Visitor
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="visitor-stats">
            <div class="stat-card">
                <div class="stat-value">{{ $currentVisitorsCount }}</div>
                <div class="stat-label">CURRENT VISITORS</div>
            </div>
            <div class="stat-card">
                <div class="stat-value">{{$expectedTodayCount}}</div>
                <div class="stat-label">EXPECTED TODAY</div>
            </div>
            <div class="stat-card">
                <div class="stat-value">{{$totalTodayCount}}</div>
                <div class="stat-label">TOTAL TODAY</div>
            </div>
            <div class="stat-card">
                <div class="stat-value">{{$totalMonthCount}}</div>
                <div class="stat-label">THIS MONTH</div>
            </div>
        </div>

        <!-- Main Content Area -->
        <div class="section-card">
            <div class="section-body">
                <div class="tabs-container">
                    <div class="tab active" data-tab="current">Current Visitors</div>
                    <div class="tab" data-tab="scheduled">Scheduled Visits</div>
                    <div class="tab" data-tab="history">Visitor History</div>
                    <div class="tab" data-tab="calendar">Visit Calendar</div>
                </div>

                <!-- Current Visitors Tab -->
                <div class="tab-content active" id="current-tab">
                    <div class="search-bar">
                        <input type="text" class="search-input" placeholder="Search by name, unit, or phone number...">
                        <button class="search-button"><i class="fas fa-search"></i></button>
                    </div>

                    <div class="filter-controls">
                        <select class="filter-select">
                            <option value="">All Units</option>
                            <option value="101">Unit 101</option>
                            <option value="102">Unit 102</option>
                            <option value="103">Unit 103</option>
                            <!-- More options -->
                        </select>
                        <select class="filter-select">
                            <option value="">All Status</option>
                            <option value="active">Active</option>
                            <option value="pending">Pending</option>
                            <option value="overstayed">Overstayed</option>
                        </select>
                        <select class="filter-select">
                            <option value="">Sort By</option>
                            <option value="time-asc">Check-in Time (Earliest)</option>
                            <option value="time-desc">Check-in Time (Latest)</option>
                            <option value="name">Visitor Name</option>
                            <option value="unit">Unit Number</option>
                        </select>
                    </div>

                    <table class="visitor-table">
                        <thead>
                            <tr>
                                <th>Visitor Name</th>
                                <th>Visiting Unit</th>
                                <th>Check-in Time</th>
                                <th>Expected Checkout</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($currentVisits as $visit)
                                <tr>
                                    <td>{{ $visit->visitor->name }}</td>
                                    <td>{{ $visit->resident->apartment->number ?? 'N/A' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($visit->check_in_time)->format('M d, h:i A') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($visit->expected_checkout_time)->format('M d, h:i A') }}</td>
                                    <td>
                                        <span class="visitor-status status-{{ strtolower($visit->status) }}">
                                            {{ ucfirst($visit->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <button class="action-button view-button" onclick="openModal('viewVisitorDetailsModal')"><i class="fas fa-eye"></i></button>
                                        <button class="action-button edit-button"><i class="fas fa-edit"></i></button>
                                        <button class="action-button delete-button"><i class="fas fa-times"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                        
                            @if ($currentVisits->isEmpty())
                                <tr>
                                    <td colspan="6" style="text-align: center;">No active visitors found.</td>
                                </tr>
                            @endif
                        </tbody>
                        
                    </table>

                    <div class="pagination">
                        <div class="page-item"><i class="fas fa-chevron-left"></i></div>
                        <div class="page-item active">1</div>
                        <div class="page-item">2</div>
                        <div class="page-item">3</div>
                        <div class="page-item"><i class="fas fa-chevron-right"></i></div>
                    </div>
                </div>

                <!-- Scheduled Visits Tab -->
                <tbody>
                    @foreach ($scheduledVisits as $visit)
                        <tr>
                            <td>{{ $visit->visitor->name }}</td>
                            <td>{{ $visit->resident->apartment->number ?? 'N/A' }}</td>
                            <td>{{ \Carbon\Carbon::parse($visit->visit_date)->format('M d, Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($visit->expected_arrival_time)->format('h:i A') }}</td>
                            <td>
                                @php
                                    $start = \Carbon\Carbon::parse($visit->expected_arrival_time);
                                    $end = \Carbon\Carbon::parse($visit->expected_checkout_time);
                                    $duration = $start->diff($end);
                                @endphp
                                {{ $duration->h > 0 ? $duration->h . ' hour' . ($duration->h > 1 ? 's' : '') : '' }}
                                {{ $duration->i > 0 ? $duration->i . ' min' . ($duration->i > 1 ? 's' : '') : '' }}
                            </td>
                            <td><span class="visitor-status status-{{ strtolower($visit->status) }}">{{ ucfirst($visit->status) }}</span></td>
                            <td>
                                <button class="action-button view-button"><i class="fas fa-eye"></i></button>
                                <button class="action-button edit-button"><i class="fas fa-edit"></i></button>
                                <button class="action-button delete-button"><i class="fas fa-times"></i></button>
                            </td>
                        </tr>
                    @endforeach
                
                    @if ($scheduledVisits->isEmpty())
                        <tr>
                            <td colspan="7" style="text-align: center;">No scheduled visits found.</td>
                        </tr>
                    @endif
                </tbody>
                
                <!-- Visitor History Tab -->
                <div class="tab-content" id="history-tab">
                    <div class="search-bar">
                        <input type="text" class="search-input" placeholder="Search visitor history...">
                        <button class="search-button"><i class="fas fa-search"></i></button>
                    </div>

                    <div class="filter-controls">
                        <select class="filter-select">
                            <option value="">All Units</option>
                            <option value="101">Unit 101</option>
                            <option value="102">Unit 102</option>
                            <!-- More options -->
                        </select>
                        <select class="filter-select">
                            <option value="">Date Range</option>
                            <option value="today">Today</option>
                            <option value="yesterday">Yesterday</option>
                            <option value="week">This Week</option>
                            <option value="month">This Month</option>
                            <option value="custom">Custom Range</option>
                        </select>
                        <select class="filter-select">
                            <option value="">Visit Status</option>
                            <option value="completed">Completed</option>
                            <option value="no-show">No Show</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                    </div>

                    <table class="visitor-table">
                        <thead>
                            <tr>
                                <th>Visitor Name</th>
                                <th>Visited Unit</th>
                                <th>Check-in Date</th>
                                <th>Check-in Time</th>
                                <th>Checkout Time</th>
                                <th>Duration</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($completedVisits as $visit)
                                <tr>
                                    <td>{{ $visit->visitor->name }}</td>
                                    <td>{{ $visit->resident->apartment->number ?? 'N/A' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($visit->visit_date)->format('F d, Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($visit->expected_arrival_time)->format('h:i A') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($visit->expected_checkout_time)->format('h:i A') }}</td>
                                    <td>
                                        @php
                                            $start = \Carbon\Carbon::parse($visit->expected_arrival_time);
                                            $end = \Carbon\Carbon::parse($visit->expected_checkout_time);
                                            $duration = $start->diff($end);
                                        @endphp
                                        {{ $duration->h }}h {{ $duration->i }}m
                                    </td>
                                    <td><span class="visitor-status status-completed">Completed</span></td>
                                    <td>
                                        <button class="action-button view-button"><i class="fas fa-eye"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                        
                            @if ($completedVisits->isEmpty())
                                <tr>
                                    <td colspan="8" style="text-align: center;">No completed visits yet.</td>
                                </tr>
                            @endif
                        </tbody>
                        
                    </table>

                    <div class="pagination">
                        <div class="page-item"><i class="fas fa-chevron-left"></i></div>
                        <div class="page-item active">1</div>
                        <div class="page-item">2</div>
                        <div class="page-item">3</div>
                        <div class="page-item"><i class="fas fa-chevron-right"></i></div>
                    </div>
                </div>

                <!-- Visit Calendar Tab -->
                <div class="tab-content" id="calendar-tab">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="calendar-container">
                                <div class="calendar-header">
                                    <div class="calendar-month">April 2025</div>
                                    <div class="calendar-nav">
                                        <button class="calendar-nav-button"><i class="fas fa-chevron-left"></i></button>
                                        <button class="calendar-nav-button"><i class="fas fa-chevron-right"></i></button>
                                    </div>
                                </div>
                                <div class="calendar-weekdays">
                                    <div>Sun</div>
                                    <div>Mon</div>
                                    <div>Tue</div>
                                    <div>Wed</div>
                                    <div>Thu</div>
                                    <div>Fri</div>
                                    <div>Sat</div>
                                </div>
                                <div class="calendar-days">
                                    <div class="calendar-day">30</div>
                                    <div class="calendar-day">31</div>
                                    <div class="calendar-day">1</div>
                                    <div class="calendar-day">2</div>
                                    <div class="calendar-day">3</div>
                                    <div class="calendar-day">4</div>
                                    <div class="calendar-day">5</div>
                                    <div class="calendar-day">6</div>
                                    <div class="calendar-day">7</div>
                                    <div class="calendar-day">8</div>
                                    <div class="calendar-day">9</div>
                                    <div class="calendar-day">10</div>
                                    <div class="calendar-day">11</div>
                                    <div class="calendar-day">12</div>
                                    <div class="calendar-day today has-events">13</div>
                                    <div class="calendar-day has-events">14</div>
                                    <div class="calendar-day has-events">15</div>
                                    <div class="calendar-day">16</div>
                                    <div class="calendar-day has-events">17</div>
                                    <div class="calendar-day">18</div>
                                    <div class="calendar-day">19</div>
                                    <div class="calendar-day">20</div>
                                    <div class="calendar-day has-events">21</div>
                                    <div class="calendar-day">22</div>
                                    <div class="calendar-day">23</div>
                                    <div class="calendar-day">24</div>
                                    <div class="calendar-day has-events">25</div>
                                    <div class="calendar-day">26</div>
                                    <div class="calendar-day">27</div>
                                    <div class="calendar-day">28</div>
                                    <div class="calendar-day">29</div>
                                    <div class="calendar-day">30</div>
                                    <div class="calendar-day">1</div>
                                    <div class="calendar-day">2</div>
                                    <div class="calendar-day">3</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            

                            <div class="event-list">
    @php
        $groupedVisits = $scheduledVisits->groupBy(function ($visit) {
            return \Carbon\Carbon::parse($visit->visit_date)->format('F d, Y');
        });
    @endphp

    @forelse ($groupedVisits as $date => $visits)
        <h4>{{ $date }}</h4>
        @foreach ($visits as $visit)
            <div class="event-item">
                <div class="event-title">
                    {{ $visit->visitor->name }}
                    <span class="badge badge-primary">Unit {{ $visit->resident->apartment->number ?? 'N/A' }}</span>
                </div>
                <div class="event-time">
                    {{ \Carbon\Carbon::parse($visit->expected_arrival_time)->format('g:i A') }} -
                    {{ \Carbon\Carbon::parse($visit->expected_checkout_time)->format('g:i A') }}
                </div>
            </div>
        @endforeach
    @empty
        <p>No scheduled visits.</p>
    @endforelse

    <button class="btn btn-primary mt-3 w-100">
        <i class="fas fa-plus mr-2"></i> Schedule New Visit
    </button>
</div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Register New Visitor Modal -->
<div class="modal" id="registerVisitorModal">
    <div class="modal-content">
        <span class="close-modal" onclick="closeModal('registerVisitorModal')">&times;</span>
        <h2 class="mb-4"><i class="fas fa-user-plus mr-2"></i> Register New Visitor</h2>
        {{-- Success Message --}}
        @if(session('success'))
         <div class="alert alert-success">
            {{ session('success') }}
         </div>
        @endif
        <form action="{{ route('visitor.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-row">
                <div class="form-col">
                    <div class="form-group">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="full_name" class="form-input" placeholder="Enter full name" required>
                    </div>
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-col">
                    <div class="form-group">
                        <label class="form-label">Phone Number</label>
                        <input type="tel" name="phone_number" class="form-input" placeholder="Enter phone number" required>
                    </div>
                </div>
                <div class="form-col">
                    <div class="form-group">
                        <label class="form-label">Email Address</label>
                        <input type="email" name="email" class="form-input" placeholder="Enter email address">
                    </div>
                </div>
            </div>
            
            <div class="form-row">
                <select name="resident_id" class="form-select" required>
                    <option value="">Select Unit</option>
                    <option value="1">Unit 101</option>
                    <option value="2">Unit 102</option>
                    <option value="3">Unit 103</option>
                    <!-- Make sure these IDs actually exist in your residents table -->
                </select>
                <div class="form-col">
                    <div class="form-group">
                        <label class="form-label">Purpose of Visit</label>
                        <select name="purpose" class="form-select" required>
                            <option value="Personal">Personal</option>
                            <option value="Delivery">Delivery</option>
                            <option value="Maintenance">Maintenance</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-col">
                    <div class="form-group">
                        <label class="form-label">ID Type</label>
                        <select name="id_type" class="form-select" required>
                            <option value="driver_license">Driver's License</option>
                            <option value="id_card">ID Card</option>
                            <option value="passport">Passport</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                </div>
                <div class="form-col">
                    <div class="form-group">
                        <label class="form-label">ID Number</label>
                        <input type="text" name="id_number" class="form-input" placeholder="Enter ID number" required>
                    </div>
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-col">
                    <div class="form-group">
                        <label class="form-label">Visit Date</label>
                        <input type="date" name="visit_date" class="form-input" required>
                    </div>
                </div>
                <div class="form-col">
                    <div class="form-group">
                        <label class="form-label">Expected Arrival Time</label>
                        <input type="time" name="expected_arrival_time" class="form-input" required>
                    </div>
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-col">
                    <div class="form-group">
                        <label class="form-label">Expected Departure Time</label>
                        <input type="time" name="expected_departure_time" class="form-input" required>
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <label class="form-label">Vehicle Information (if applicable)</label>
                <div class="form-row">
                    <div class="form-col">
                        <input type="text" name="vehicle_license_plate" class="form-input" placeholder="License Plate">
                    </div>
                    <div class="form-col">
                        <input type="text" name="vehicle_model" class="form-input" placeholder="Vehicle Model">
                    </div>
                </div>
                <div class="form-row mt-2">
                    <div class="form-col">
                        <input type="text" name="vehicle_color" class="form-input" placeholder="Vehicle Color">
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <label class="form-label">Notes</label>
                <textarea name="notes" class="form-textarea" placeholder="Any additional information..."></textarea>
            </div>
            
            <div class="form-group">
                <label class="form-label">Upload Photo ID</label>
                <input type="file" name="photo_id" class="form-input">
            </div>
            
            <button type="submit" class="submit-button mt-4">
                <i class="fas fa-save mr-2"></i> Register Visitor
            </button>
        </form>
    </div>
</div>

    <!-- View Visitor Details Modal -->
    <div class="modal" id="viewVisitorDetailsModal">
        <div class="modal-content">
            <span class="close-modal" onclick="closeModal('viewVisitorDetailsModal')">&times;</span>
            <h2 class="mb-4"><i class="fas fa-user mr-2"></i> Visitor Details</h2>
            
            <div class="row">
                <div class="col-md-4">
                    <div style="width: 150px; height: 150px; border-radius: 8px; background-color: #e0e7ff; display: flex; align-items: center; justify-content: center; margin-bottom: 15px;">
                        <i class="fas fa-user" style="font-size: 3rem; color: #4b6cb7;"></i>
                    </div>
                    <h4>John Smith</h4>
                    <p class="mb-1"><i class="fas fa-phone mr-2"></i> (555) 123-4567</p>
                    <p class="mb-1"><i class="fas fa-envelope mr-2"></i> john.smith@example.com</p>
                    <p class="mb-3"><i class="fas fa-id-card mr-2"></i> ID: DL12345678</p>
                    
                    <div class="mt-4">
                        <h5>Quick Actions</h5>
                        <button class="btn btn-success btn-sm mb-2 w-100">
                            <i class="fas fa-check-circle mr-2"></i> Check Out
                        </button>
                        <button class="btn btn-primary btn-sm mb-2 w-100">
                            <i class="fas fa-edit mr-2"></i> Edit Details
                        </button>
                        <button class="btn btn-danger btn-sm mb-2 w-100">
                            <i class="fas fa-ban mr-2"></i> Block Visitor
                        </button>
                    </div>
                </div>
                <div class="col-md-8">
                    <h5>Visit Information</h5>
                    
                    <div class="visitor-detail-row">
                        <div class="detail-label">Status</div>
                        <div class="detail-value">
                            <span class="visitor-status status-active">Active</span>
                        </div>
                    </div>
                    
                    <div class="visitor-detail-row">
                        <div class="detail-label">Visiting Unit</div>
                        <div class="detail-value">301</div>
                    </div>
                    
                    <div class="visitor-detail-row">
                        <div class="detail-label">Resident Name</div>
                        <div class="detail-value">Alex Johnson</div>
                    </div>
                    
                    <div class="visitor-detail-row">
                        <div class="detail-label">Visit Type</div>
                        <div class="detail-value">Personal</div>
                    </div>
                    
                    <div class="visitor-detail-row">
                        <div class="detail-label">Check-in Time</div>
                        <div class="detail-value">Today, 10:30 AM</div>
                    </div>
                    
                    <div class="visitor-detail-row">
                        <div class="detail-label">Expected Checkout</div>
                        <div class="detail-value">Today, 5:00 PM</div>
                    </div>
                    
                    <div class="visitor-detail-row">
                        <div class="detail-label">Vehicle Info</div>
                        <div class="detail-value">Toyota Camry, Plate: ABC123</div>
                    </div>
                    
                    <div class="visitor-detail-row">
                        <div class="detail-label">Notes</div>
                        <div class="detail-value">Visiting for dinner. Approved by building manager.</div>
                    </div>
                    
                    <div class="visitor-activity">
                        <h5>Activity Log</h5>
                        
                        <div class="activity-item">
                            <div class="activity-icon">
                                <i class="fas fa-sign-in-alt"></i>
                            </div>
                            <div class="activity-content">
                                <div class="activity-title">Check-in at Main Entrance</div>
                                <div class="activity-time">Today, 10:30 AM</div>
                            </div>
                        </div>
                        
                        <div class="activity-item">
                            <div class="activity-icon">
                                <i class="fas fa-key"></i>
                            </div>
                            <div class="activity-content">
                                <div class="activity-title">Access Card Issued</div>
                                <div class="activity-time">Today, 10:32 AM</div>
                            </div>
                        </div>
                        
                        <div class="activity-item">
                            <div class="activity-icon">
                                <i class="fas fa-elevator"></i>
                            </div>
                            <div class="activity-content">
                                <div class="activity-title">Elevator Access to 3rd Floor</div>
                                <div class="activity-time">Today, 10:35 AM</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')
<script src="https://kit.fontawesome.com/your-fontawesome-kit.js" crossorigin="anonymous"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Tab switching functionality
        const tabs = document.querySelectorAll('.tab');
        const tabContents = document.querySelectorAll('.tab-content');
        
        tabs.forEach(tab => {
            tab.addEventListener('click', function() {
                const tabId = this.dataset.tab;
                
                // Remove active class from all tabs and contents
                tabs.forEach(t => t.classList.remove('active'));
                tabContents.forEach(c => c.classList.remove('active'));
                
                // Add active class to current tab and content
                this.classList.add('active');
                document.getElementById(tabId + '-tab').classList.add('active');
            });
        });
        
        // Animations for page elements
        if (typeof gsap !== 'undefined') {
            gsap.from('.section-card', {
                duration: 0.8,
                y: 30,
                opacity: 0,
                stagger: 0.1,
                ease: 'power3.out'
            });
            
            gsap.from('.visitor-stats .stat-card', {
                duration: 0.5,
                scale: 0.9,
                opacity: 0,
                stagger: 0.1,
                ease: 'back.out'
            });
        }
    });
    
    // Modal functions
    function openModal(modalId) {
        document.getElementById(modalId).style.display = 'block';
    }
    
    function closeModal(modalId) {
        document.getElementById(modalId).style.display = 'none';
    }
    
    // Close modal when clicking outside of it
    window.onclick = function(event) {
        if (event.target.classList.contains('modal')) {
            event.target.style.display = 'none';
        }
    }
</script>
@endpush