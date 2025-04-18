<!-- resources/views/residents/directory.blade.php -->
@extends('layouts.app', ['activePage' => 'resident-directory', 'title' => 'Resident Directory', 'navName' => 'Resident Directory', 'activeButton' => 'laravel'])

@section('content')
<div class="content">
    <div class="container-fluid">
        <!-- Header Section -->
        <div class="row">
            <div class="col-md-12">
                <div class="card card-stats">
                    <div class="card-header card-header-primary">
                        <div class="row">
                            <div class="col-md-8">
                                <h4 class="card-title">Resident Directory</h4>
                                <p class="card-category">View and manage all residents in your property</p>
                            </div>
                            <div class="col-md-4 text-right">
                                @if(auth()->user() && auth()->user()->can('create', App\Models\Resident::class))
                                <a href="{{ route('residents.create') }}" class="btn btn-white btn-round">
                                    <i class="material-icons">person_add</i> Add New Resident
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Search and Filter Section -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-tabs card-header-info">
                        <h4 class="card-title">Search & Filter</h4>
                        <p class="card-category">Find residents by name, building, or floor</p>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('residentDirectory') }}" method="GET">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Search Residents</label>
                                        <input type="text" name="search" class="form-control" 
                                               value="{{ request('search') }}" 
                                               placeholder="Name, Email, Phone...">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Building</label>
                                        <select name="building" class="form-control">
                                            <option value="">All Buildings</option>
                                            @if(isset($buildings) && count($buildings) > 0)
                                                @foreach($buildings as $building)
                                                    <option value="{{ $building->id }}" 
                                                            {{ request('building') == $building->id ? 'selected' : '' }}>
                                                        {{ $building->name }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Floor</label>
                                        <select name="floor" class="form-control">
                                            <option value="">All Floors</option>
                                            @if(isset($floors) && count($floors) > 0)
                                                @foreach($floors as $floor)
                                                    <option value="{{ $floor }}" 
                                                            {{ request('floor') == $floor ? 'selected' : '' }}>
                                                        {{ $floor }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="text-right">
                                        <button type="submit" class="btn btn-info btn-round">
                                            <i class="material-icons">search</i> Search
                                        </button>
                                        <a href="{{ route('residentDirectory') }}" class="btn btn-outline-secondary btn-round">
                                            <i class="material-icons">clear</i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Residents List -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Residents</h4>
                        <p class="card-category">
                            {{ isset($residents) ? $residents->count() : 0 }} residents found
                        </p>
                    </div>
                    <div class="card-body">
                        @if(isset($residents) && count($residents) > 0)
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="text-primary">
                                        <tr>
                                            <th>Resident</th>
                                            <th>Unit Info</th>
                                            <th>Contact Information</th>
                                            <th>Status</th>
                                            <th class="text-right">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($residents as $resident)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    @if(isset($resident->profile_photo) && $resident->profile_photo)
                                                        <div class="avatar mr-3">
                                                            <img src="{{ asset('storage/' . $resident->profile_photo) }}" 
                                                                 alt="{{ $resident->full_name ?? $resident->first_name . ' ' . $resident->last_name }}" 
                                                                 class="rounded-circle" width="40">
                                                        </div>
                                                    @else
                                                        <div class="avatar mr-3 bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width:40px;height:40px;">
                                                            {{ substr($resident->first_name ?? 'A', 0, 1) }}{{ substr($resident->last_name ?? 'R', 0, 1) }}
                                                        </div>
                                                    @endif
                                                    <div>
                                                        <h6 class="mb-0">
                                                            {{ isset($resident->full_name) ? $resident->full_name : 
                                                               (isset($resident->first_name) && isset($resident->last_name) ? 
                                                                $resident->first_name . ' ' . $resident->last_name : 'Resident Name') }}
                                                        </h6>
                                                        <small class="text-muted">
                                                            Since: {{ isset($resident->move_in_date) ? $resident->move_in_date->format('M d, Y') : 'Unknown' }}
                                                        </small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                @if(isset($resident->apartment) && $resident->apartment)
                                                    <p class="mb-1"><strong>Building:</strong> {{ $resident->apartment->building->name ?? 'N/A' }}</p>
                                                    <p class="mb-1"><strong>Unit:</strong> {{ $resident->apartment->unit_number ?? 'N/A' }}</p>
                                                    <p class="mb-0"><strong>Floor:</strong> {{ $resident->apartment->floor ?? 'N/A' }}</p>
                                                @else
                                                    <p class="text-muted">Unit information not available</p>
                                                @endif
                                            </td>
                                            <td>
                                                <p class="mb-1">
                                                    <i class="material-icons text-primary" style="font-size:1rem;">email</i>
                                                    @if(auth()->user() && auth()->user()->can('view-emails', $resident))
                                                        <a href="mailto:{{ $resident->email ?? '#' }}">{{ $resident->email ?? 'Email protected' }}</a>
                                                    @else
                                                        <span class="text-muted">*****@*****.com</span>
                                                    @endif
                                                </p>
                                                <p class="mb-1">
                                                    <i class="material-icons text-primary" style="font-size:1rem;">phone</i>
                                                    @if(auth()->user() && auth()->user()->can('view-phone', $resident))
                                                        <a href="tel:{{ $resident->phone ?? '#' }}">{{ $resident->phone ?? 'Phone protected' }}</a>
                                                    @else
                                                        <span class="text-muted">(***)***-****</span>
                                                    @endif
                                                </p>
                                                @if(isset($resident->emergency_contact) && $resident->emergency_contact)
                                                <p class="mb-0">
                                                    <i class="material-icons text-danger" style="font-size:1rem;">warning</i>
                                                    <span>{{ $resident->emergency_contact }}</span>
                                                </p>
                                                @endif
                                            </td>
                                            <td>
                                                @if(isset($resident->is_active) && $resident->is_active)
                                                    <span class="badge badge-success">Active</span>
                                                @else
                                                    <span class="badge badge-danger">Inactive</span>
                                                @endif
                                            </td>
                                            <td class="text-right">
                                                <a href="{{ route('residents.show', $resident->id ?? 1) }}" class="btn btn-info btn-sm">
                                                    <i class="material-icons">visibility</i>
                                                </a>
                                                @if(auth()->user() && auth()->user()->can('update', $resident))
                                                <a href="{{ route('residents.edit', $resident->id ?? 1) }}" class="btn btn-warning btn-sm">
                                                    <i class="material-icons">edit</i>
                                                </a>
                                                @endif
                                                <a href="{{ route('visitors.create', ['resident' => $resident->id ?? 1]) }}" class="btn btn-success btn-sm">
                                                    <i class="material-icons">person_add</i>
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            
                            <!-- Pagination -->
                            @if(method_exists($residents, 'links'))
                            <div class="d-flex justify-content-center mt-4">
                                {{ $residents->appends(request()->query())->links() }}
                            </div>
                            @endif
                        @else
                            <div class="text-center py-5">
                                <i class="material-icons text-muted" style="font-size: 5rem;">people_outline</i>
                                <h4 class="mt-3">No Residents Found</h4>
                                <p class="text-muted">No residents match your search criteria or no resident data is available.</p>
                                <a href="{{ route('residentDirectory') }}" class="btn btn-outline-primary">
                                    <i class="material-icons">refresh</i> Clear Filters
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')
<script>
    $(document).ready(function() {
        // Handle building selection change
        $('#building').on('change', function() {
            // Optional: Submit the form automatically when building changes
            // $(this).closest('form').submit();
        });
        
        // Initialize any plugins or components
        if (typeof $.material !== 'undefined') {
            $.material.init();
        }
    });
</script>
@endpush
@endsection