@extends('layouts.app', ['activePage' => 'resident-form', 'title' => 'Add Resident', 'navName' => 'Add Resident', 'activeButton' => 'laravel'])

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4 custom-font text-white">Add New Resident</h1>
        
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- Resident Form -->
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"><i class="fas fa-user-plus mr-2"></i>Resident Information</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('resident.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name"><i class="fas fa-user mr-2"></i>Full Name</label>
                                <input type="text" name="name" class="form-control" id="name" required>
                            </div>
                            <div class="form-group">
                                <label for="apartment_number"><i class="fas fa-building mr-2"></i>Apartment Number</label>
                                <input type="text" name="apartment_number" class="form-control" id="apartment_number" required>
                            </div>
                            <div class="form-group">
                                <label for="phone"><i class="fas fa-phone mr-2"></i>Phone Number</label>
                                <input type="tel" name="phone" class="form-control" id="phone" required>
                            </div>
                            <div class="form-group">
                                <label for="email"><i class="fas fa-envelope mr-2"></i>Email Address</label>
                                <input type="email" name="email" class="form-control" id="email" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">
                                <i class="fas fa-save mr-2"></i>Add Resident
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CSS Styles -->
    <style>
        body {
            background-image: url('image/apartment-bg.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            font-family: 'Arial', sans-serif;
        }
        .custom-font {
            font-family: 'Segoe UI', sans-serif;
            font-size: 2.5rem;
            text-align: center;
        }
        .card {
            background-color: rgba(248, 249, 250, 0.9);
            margin-bottom: 20px;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }
        .card-title {
            font-size: 1.25rem;
            color: #333;
            font-weight: bold;
        }
        .card-header {
            background-color: rgba(0, 123, 255, 0.1);
            border-bottom: 1px solid rgba(0, 123, 255, 0.2);
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0069d9;
            border-color: #0062cc;
        }
    </style>

    <!-- JavaScript Includes -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
@endsection

@push('css')
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
@endpush