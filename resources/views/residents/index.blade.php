@extends('layouts.app')

@section('title', 'Manage Residents')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Residents</h1>
        <a href="{{ route('residents.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add New Resident
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            @if($residents->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Apartment</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($residents as $resident)
                        <tr>
                            <td>{{ $resident->name }}</td>
                            <td>{{ $resident->phone }}</td>
                            <td>{{ $resident->email ?? 'N/A' }}</td>
                            <td>
                                @if($resident->apartment)
                                {{ $resident->apartment->getFullNumberAttribute() }}
                                @else
                                Not Assigned
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('residents.edit', $resident->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('residents.destroy', $resident->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this resident?')">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center mt-3">
                {{ $residents->links() }}
            </div>
            @else
            <div class="alert alert-info mb-0">
                No residents found.
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
