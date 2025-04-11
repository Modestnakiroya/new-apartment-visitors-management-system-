@extends('layouts.app')

@section('content')
    <h1>Edit Apartment</h1>
    <form action="{{ route('apartments.update', $apartment->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="floor">Floor:</label>
            <input type="number" id="floor" name="floor" value="{{ $apartment->floor }}" required>
        </div>
        <div>
            <label for="number">Number:</label>
            <input type="text" id="number" name="number" value="{{ $apartment->number }}" required>
        </div>
        <div>
            <label for="description">Description:</label>
            <textarea id="description" name="description">{{ $apartment->description }}</textarea>
        </div>
        <button type="submit">Update Apartment</button>
    </form>
@endsection
