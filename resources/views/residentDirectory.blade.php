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
                                <p class="card-category">View all residents registered in the system</p>
                            </div>
                            <div class="col-md-4 text-right">
                                @if(auth()->user() && auth()->user()->can('create', App\Models\Resident::class))
                                <a href="{{ route('resident.create') }}" class="btn btn-white btn-round">
                                    <i class="material-icons">person_add</i> Add New Resident
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Residents List -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Registered Residents</h4>
                        <p class="card-category">
                        </p>
                    </div>
                    <div class="card-body">
                        @if($residents->count() > 0)
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="text-primary">
                                        <tr>
                                            <th>Name</th>
                                            <th>Apartment Number</th>
                                            <th class="text-right">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($residents as $resident)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar mr-3 bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width:40px;height:40px;">
                                                        {{ substr($resident->name, 0, 1) }}
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-0">
                                                            {{ $resident->name }}
                                                        </h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                @if($resident->apartment)
                                                    {{ $resident->apartment->number }}
                                                @else
                                                    <span class="text-muted">Not assigned</span>
                                                @endif
                                            </td>
                                            <td class="text-right">
                                                <a href="{{ route('residentDirectory', $resident->id) }}" class="btn btn-info btn-sm">
                                                    <i class="material-icons">visibility</i>
                                                </a>
                                                @if(auth()->user() && auth()->user()->can('update', $resident))
                                                <a href="{{ route('residentDirectory', $resident->id) }}" class="btn btn-warning btn-sm">
                                                    <i class="material-icons">edit</i>
                                                </a>
                                                @endif
                                                <a href="{{ route('residentDirectory', ['resident' => $resident->id]) }}" class="btn btn-success btn-sm">
                                                    <i class="material-icons">person_add</i>
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            
                        @else
                            <div class="text-center py-5">
                                <i class="material-icons text-muted" style="font-size: 5rem;">people_outline</i>
                                <h4 class="mt-3">No Residents Found</h4>
                                <p class="text-muted">No residents are registered in the system.</p>
                                @if(auth()->user() && auth()->user()->can('create', App\Models\Resident::class))
                                <a href="{{ route('resident.create') }}" class="btn btn-outline-primary">
                                    <i class="material-icons">person_add</i> Add New Resident
                                </a>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
                <!-- Register New Resident Button -->
        <div class="row">
            <div class="col-md-12 text-right mb-3">
                <a href="{{ route('resident.create') }}" class="btn btn-primary btn-round">
                    <i class="material-icons"></i> Register New Resident
                </a>
            </div>
        </div>
            </div>
        </div>
    </div>
</div>

@push('js')
<script>
    $(document).ready(function() {
        // Initialize any plugins or components
        if (typeof $.material !== 'undefined') {
            $.material.init();
        }
    });
</script>
@endpush
@endsection