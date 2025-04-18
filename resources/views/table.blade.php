@extends('layouts.app', ['activePage' => 'tables', 'title' => 'Light Bootstrap Dashboard Laravel by Creative Tim & UPDIVISION', 'navName' => 'Tables', 'activeButton' => 'laravel'])

@section('content')
<style>
    body {
        background-color: #f0f8ff;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='100' height='100' viewBox='0 0 100 100'%3E%3Cg fill-rule='evenodd'%3E%3Cg fill='%239C92AC' fill-opacity='0.1'%3E%3Cpath opacity='.5' d='M96 95h4v1h-4v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9zm-1 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-9-10h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm9-10v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-9-10h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm9-10v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-9-10h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm9-10v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-9-10h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9z'/%3E%3Cpath d='M6 5V0H5v5H0v1h5v94h1V6h94V5H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    }
    .content {
        padding: 30px 15px;
    }
    .card {
        border-radius: 15px;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        margin-bottom: 30px;
        background-color: white;
        transition: transform 0.3s ease-in-out;
    }
    .card:hover {
        transform: translateY(-5px);
    }
    .card-header {
        background: linear-gradient(45deg, #3498db, #2980b9);
        color: white;
        padding: 20px;
        border-radius: 15px 15px 0 0;
    }
    .card-title {
        margin: 0;
        font-size: 1.6em;
        font-weight: 600;
    }
    .table-responsive {
        padding: 20px;
    }
    .table {
        border-collapse: separate;
        border-spacing: 0;
        width: 100%;
    }
    .table thead th {
        background-color: #f8f9fa;
        border-top: none;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.9em;
        padding: 15px;
        border-bottom: 2px solid #e9ecef;
    }
    .table tbody td {
        padding: 15px;
        vertical-align: middle;
        border-bottom: 1px solid #e9ecef;
    }
    .table-hover tbody tr:hover {
        background-color: #e3f2fd;
    }
    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #f1f8ff;
    }
    .math-icon {
        font-size: 24px;
        margin-right: 10px;
    }
</style>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"><span class="math-icon">∑</span>PUPIL TABLE</h4>
                    </div>
                    <div class="card-body table-full-width table-responsive">
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>Username</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email Address</th>
                                    <th>Date of Birth</th>
                                    <th>School Registration Number</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pupils as $pupil)
                                    <tr>
                                        <td>{{ $pupil->username }}</td>
                                        <td>{{ $pupil->firstName }}</td>
                                        <td>{{ $pupil->lastName }}</td>
                                        <td>{{ $pupil->emailAddress }}</td>
                                        <td>{{ $pupil->dateOfBirth }}</td>
                                        <td>{{ $pupil->school_registration_number }}</td>
                                    </tr>
                                @endforeach 
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"><span class="math-icon">π</span>REPRESENTATIVE TABLE</h4>
                    </div>
                    <div class="card-body table-full-width table-responsive">
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>Representative ID</th>
                                    <th>username</th>
                                    <th>Email Address</th>
                                    <th>School Registration Number</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($representatives as $representative)
                                <tr>
                                    <td>{{ $representative->representativeId }}</td>
                                    <td>{{ $representative->username }}</td>
                                    <td>{{ $representative->emailAddress }}</td>
                                    <td>{{ $representative->school_registration_number }}</td>
                                </tr>
                                @endforeach 
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"><span class="math-icon">∞</span>SCHOOLS TABLE</h4>
                    </div>
                    <div class="card-body table-full-width table-responsive">
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>School Registration Number</th>
                                    <th>Name</th>
                                    <th>District</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($schools as $school)
                                <tr>
                                    <td>{{ $school->school_registration_number}}</td>
                                    <td>{{ $school->name }}</td>
                                    <td>{{ $school->district }}</td>
                                </tr>
                                @endforeach 
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"><span class="math-icon">△</span>CHALLENGE TABLE</h4>
                    </div>
                    <div class="card-body table-full-width table-responsive">
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>Challenge No</th>
                                    <th>Opening Date</th>
                                    <th>Closing Date</th>
                                    <th>Duration</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($challenges as $challenge)
                                <tr>
                                    <td>{{ $challenge->challengeNo}}</td>
                                    <td>{{ $challenge->openingDate }}</td>
                                    <td>{{ $challenge->closingDate }}</td>
                                    <td>{{ $challenge->duration }}</td>
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