@extends('layouts.app', ['activePage' => 'upload', 'title' => 'Light Bootstrap Dashboard Laravel by Creative Tim & UPDIVISION', 'navName' => 'upload', 'activeButton' => 'laravel'])

@section('content')
<style>
    body {
        background-image: url('data:image/svg+xml,%3Csvg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100"%3E%3Cg fill-rule="evenodd"%3E%3Cg fill="%239C92AC" fill-opacity="0.4"%3E%3Cpath opacity=".5" d="M96 95h4v1h-4v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9zm-1 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-9-10h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm9-10v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-9-10h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm9-10v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-9-10h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm9-10v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-9-10h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9z"/%3E%3Cpath d="M6 5V0H5v5H0v1h5v94h1V6h94V5H6z"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');
        background-color: #f0f4f8;
        min-height: 100vh;
        font-family: 'Poppins', sans-serif;
    }
    .content {
        padding: 30px 15px;
    }
    .card {
        border-radius: 15px;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        margin-bottom: 30px;
        background-color: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    }
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
    }
    .card-header {
        background: linear-gradient(90deg, #3498db 0%, #2c3e50 100%);
        color: white;
        padding: 20px;
        border-radius: 15px 15px 0 0;
    }
    .card-title {
        margin: 0;
        font-size: 1.5rem;
        font-weight: 600;
    }
    .card-body {
        padding: 30px;
    }
    .form-group {
        margin-bottom: 25px;
    }
    .form-control {
        border-radius: 8px;
        border: 2px solid #d1d3e2;
        padding: 12px 15px;
        transition: all 0.3s ease-in-out;
        background-color: rgba(255, 255, 255, 0.8);
    }
    .form-control:focus {
        border-color: #3498db;
        box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
        background-color: #ffffff;
    }
    .btn-primary {
        background: linear-gradient(90deg, #3498db 0%, #2c3e50 100%);
        border: none;
        padding: 12px 25px;
        font-weight: 600;
        border-radius: 8px;
        transition: all 0.3s ease-in-out;
    }
    .btn-primary:hover {
        background: linear-gradient(90deg, #2c3e50 0%, #3498db 100%);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }
    .alert-success {
        background-color: #d4edda;
        border-color: #c3e6cb;
        color: #155724;
        padding: 15px;
        border-radius: 8px;
        margin-bottom: 20px;
    }
    label {
        font-weight: 600;
        margin-bottom: 8px;
        color: #4a4a4a;
    }
    .math-icon {
        font-size: 2rem;
        margin-right: 10px;
        vertical-align: middle;
    }
</style>

<div class="content">
    <div class="container-fluid">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        
        <div class="row">
            <!-- Challenge Upload -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"><i class="math-icon">∑</i> Mathematics Challenge Upload</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('upload.files') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="challengeNo">Challenge Number</label>
                                        <input type="text" class="form-control" id="challengeNo" name="challengeNo" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="file1">Question File</label>
                                        <input type="file" class="form-control" id="file1" name="file1" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="file2">Answer File</label>
                                        <input type="file" class="form-control" id="file2" name="file2" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="openingDate">Opening Date</label>
                                        <input type="datetime-local" class="form-control" id="openingDate" name="openingDate" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="closingDate">Closing Date</label>
                                        <input type="datetime-local" class="form-control" id="closingDate" name="closingDate" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="duration">Duration (in hours)</label>
                                        <input type="number" class="form-control" id="duration" name="duration" required>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Upload Challenge</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <!-- School Upload -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"><i class="math-icon">🏫</i> School Upload</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('upload.school') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="form-group">
                                <label for="district">District</label>
                                <input type="text" class="form-control" id="district" name="district" required>
                            </div>
                            <div class="form-group">
                                <label for="school_registration_number">School Registration Number</label>
                                <input type="text" class="form-control" id="school_registration_number" name="school_registration_number" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Upload School</button>
                        </form>
                    </div>
                </div>
            </div>
            
            <!-- Representative Upload -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"><i class="math-icon">👤</i> Representative Upload</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('upload.representative') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="repName">Username</label>
                                <input type="text" class="form-control" id="repName" name="username" required>
                            </div>
                            <div class="form-group">
                                <label for="emailAddress">Email Address</label>
                                <input type="email" class="form-control" id="emailAddress" name="emailAddress" required>
                            </div>
                            <div class="form-group">
                                <label for="repSchoolRegNo">School Registration Number</label>
                                <input type="text" class="form-control" id="repSchoolRegNo" name="school_registration_number" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Upload Representative</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection