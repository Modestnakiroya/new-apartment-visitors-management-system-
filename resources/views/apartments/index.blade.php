@extends('layouts.app')

@section('title', 'Apartment Management')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Apartment Management</h1>
        <a href="{{ route('apartments.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add New Apartment
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            @if($apartments->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Apartment</th>
                            <th>Floor</th>
                            <th>Number</th>
                            <th>Residents</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($apartments as $apartment)
                        <tr>
                            <td>{{ $apartment->getFullNumberAttribute() }}</td>
                            <td>{{ $apartment->floor }}</td>
                            <td>{{ $apartment->number }}</td>
                            <td>{{ $apartment->residents_count }}</td>
                            <td>{{ $apartment->description ?? 'N/A' }}</td>
                            <td>
                                <a href="{{ route('apartments.edit', $apartment->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                @if($apartment->residents_count == 0)
                                <form action="{{ route('apartments.destroy', $apartment->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this apartment?')">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center mt-3">
                {{ $apartments->links() }}
            </div>
            @else
            <div class="alert alert-info mb-0">
                No apartments found.
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
