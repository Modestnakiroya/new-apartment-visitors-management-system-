@extends('layouts.guest', ['activePage' => 'guest', 'title' => 'Visitor Check-in', 'navName' => 'Visitor Check-in', 'activeButton' => 'laravel'])

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
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
            font-size: 2.5rem;zz
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
        .list-group-item {
            background-color: rgba(255, 255, 255, 0.8);
            border: none;
            margin-bottom: 5px;
            border-radius: 5px;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0069d9;
            border-color: #0062cc;
        }
        .steps {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
        }
        .step {
            flex: 1;
            text-align: center;
            padding: 10px;
            background-color: rgba(240, 240, 240, 0.8);
            border-radius: 5px;
            margin: 0 5px;
        }
        .step.active {
            background-color: #007bff;
            color: white;
        }
        .qr-code {
            text-align: center;
            margin-top: 20px;
        }
        #visitorPass {
            display: none;
        }
    </style>
</head>
<body>
<div class="overlay" style="padding-top: 0;">
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-color: rgba(0, 0, 0, 0.8);">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <i class="fas fa-building mr-2"></i> WestView Living
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Navigation items -->
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                        <!-- Show login only when not authenticated -->
                        @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">
                                <i class="fas fa-sign-in-alt mr-1"></i> Login
                            </a>
                        </li>
                        @else

                        <!-- Logout for authenticated users -->
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}" id="logout-form">
                                @csrf
                                <button type="button" class="nav-link btn btn-link"
                                    onclick="confirmLogout()"
                                    style="display: inline; padding: 0; border: none; background: none;">
                                    <i class="fas fa-sign-out-alt mr-1"></i> Logout
                                </button>
                            </form>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <div class="container mt-5">
        <h1 class="text-center mb-4 custom-font text-white">Apartment Visitor Check-in</h1>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- Check-in Form -->
                <div class="card" id="checkInForm">
                    <div class="card-header">
                        <h4 class="card-title"><i class="fas fa-clipboard-list mr-2"></i>Visitor Information</h4>
                    </div>
                    <div class="card-body">
                        <div class="steps">
                            <div class="step active">
                                <i class="fas fa-user"></i>
                                <div>Visitor Info</div>
                            </div>
                            <div class="step">
                                <i class="fas fa-home"></i>
                                <div>Resident Info</div>
                            </div>
                            <div class="step">
                                <i class="fas fa-check-circle"></i>
                                <div>Confirmation</div>
                            </div>
                        </div>

                        <form id="visitorForm">
                            <div class="form-group">
                                <label for="visitorName"><i class="fas fa-user mr-2"></i>Full Name</label>
                                <input type="text" name ="name" class="form-control" id="visitorName" required>
                            </div>
                            <div class="form-group">
                                <label for="visitorPhone"><i class="fas fa-phone mr-2"></i>Phone Number</label>
                                <input type="tel" name ="phone" class="form-control" id="visitorPhone" required>
                            </div>
                            <div class="form-group">
                                <label for="visitorEmail"><i class="fas fa-envelope mr-2"></i>Email Address</label>
                                <input type="email" name ="email" class="form-control" id="visitorEmail">
                            </div>
                            <div class="form-group">
                                <label for="visitorID"><i class="fas fa-id-card mr-2"></i>ID Number (Optional)</label>
                                <input type="text" name="id_number" class="form-control" id="visitorID">
                            </div>
                            <div class="form-group">
                                <label for="visitPurpose"><i class="fas fa-clipboard mr-2"></i>Purpose of Visit</label>
                                <select class="form-control" name="purpose" id="visitPurpose" required>
                                    <option value="">-- Select Purpose --</option>
                                    <option value="Social">Social Visit</option>
                                    <option value="Delivery">Package Delivery</option>
                                    <option value="Maintenance">Maintenance</option>
                                    <option value="Business">Business Meeting</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                            <div class="form-group" name="purpose" id="otherPurposeGroup" style="display: none;">
                                <label for="otherPurpose">Please Specify:</label>
                                <input type="text" class="form-control" id="otherPurpose">
                            </div>

                            <button type="button" class="btn btn-primary btn-block" onclick="showResidentForm()">Next <i class="fas fa-arrow-right ml-2"></i></button>
                        </form>
                    </div>
                </div>

                <!-- Resident Information Form -->
                <div class="card" id="residentForm" style="display: none;">
                    <div class="card-header">
                        <h4 class="card-title"><i class="fas fa-home mr-2"></i>Resident Information</h4>
                    </div>
                    <div class="card-body">
                        <div class="steps">
                            <div class="step">
                                <i class="fas fa-user"></i>
                                <div>Visitor Info</div>
                            </div>
                            <div class="step active">
                                <i class="fas fa-home"></i>
                                <div>Resident Info</div>
                            </div>
                            <div class="step">
                                <i class="fas fa-check-circle"></i>
                                <div>Confirmation</div>
                            </div>
                        </div>

                        <form id="residentInfoForm">
                            <div class="form-group">
                                <label for="residentName"><i class="fas fa-user mr-2"></i>Resident Name</label>
                                <input type="text" class="form-control" id="residentName" required>
                            </div>
                            <div class="form-group">
                                <label for="apartmentNumber"><i class="fas fa-building mr-2"></i>Apartment Number</label>
                                <input type="text" class="form-control" id="apartmentNumber" required>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="visitDate"><i class="fas fa-calendar mr-2"></i>Visit Date</label>
                                    <input type="date" class="form-control" id="visitDate" value="{{ date('Y-m-d') }}" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="visitTime"><i class="fas fa-clock mr-2"></i>Expected Arrival Time</label>
                                    <input type="time" class="form-control" id="visitTime" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="isPreRegistered">
                                    <label class="form-check-label" for="isPreRegistered">
                                        I am pre-registered by the resident
                                    </label>
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="button" class="btn btn-secondary mr-2" onclick="showVisitorForm()"><i class="fas fa-arrow-left mr-2"></i> Back</button>
                                <button type="button" class="btn btn-primary" onclick="showConfirmation()">Next <i class="fas fa-arrow-right ml-2"></i></button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Confirmation -->
                <div class="card" id="confirmationCard" style="display: none;">
                    <div class="card-header">
                        <h4 class="card-title"><i class="fas fa-check-circle mr-2"></i>Confirmation</h4>
                    </div>
                    <div class="card-body">
                        <div class="steps">
                            <div class="step">
                                <i class="fas fa-user"></i>
                                <div>Visitor Info</div>
                            </div>
                            <div class="step">
                                <i class="fas fa-home"></i>
                                <div>Resident Info</div>
                            </div>
                            <div class="step active">
                                <i class="fas fa-check-circle"></i>
                                <div>Confirmation</div>
                            </div>
                        </div>

                        <div class="alert alert-info">
                            <h5><i class="fas fa-info-circle mr-2"></i>Please review your information</h5>
                            <p>Check that all details are correct before submitting.</p>
                        </div>

                        <div class="card mb-3">
                            <div class="card-header bg-light">
                                <h5 class="mb-0">Visitor Details</h5>
                            </div>
                            <div class="card-body">
                                <p><strong>Name:</strong> <span id="confirmName"></span></p>
                                <p><strong>Phone:</strong> <span id="confirmPhone"></span></p>
                                <p><strong>Purpose:</strong> <span id="confirmPurpose"></span></p>
                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="card-header bg-light">
                                <h5 class="mb-0">Visit Details</h5>
                            </div>
                            <div class="card-body">
                                <p><strong>Resident:</strong> <span id="confirmResident"></span></p>
                                <p><strong>Apartment:</strong> <span id="confirmApartment"></span></p>
                                <p><strong>Date & Time:</strong> <span id="confirmDateTime"></span></p>
                            </div>
                        </div>

                        <div class="text-center">
                            <button type="button" class="btn btn-secondary mr-2" onclick="showResidentForm()"><i class="fas fa-arrow-left mr-2"></i> Back</button>
                            <button type="button" class="btn btn-success" onclick="submitVisit()"><i class="fas fa-check-circle mr-2"></i> Confirm Visit</button>
                        </div>
                    </div>
                </div>

                <!-- Visitor Pass -->
                <div class="card" id="visitorPass" style="display: none;">
                    <div class="card-header bg-success text-white">
                        <h4 class="card-title"><i class="fas fa-ticket-alt mr-2"></i>Visitor Pass Generated</h4>
                    </div>
                    <div class="card-body text-center">
                        <div class="alert alert-success">
                            <h5><i class="fas fa-check-circle mr-2"></i>Check-in Successful!</h5>
                            <p>Your visit has been registered. Please show this pass to security upon arrival.</p>
                        </div>

                        <div class="card mb-3 border-success">
                            <div class="card-header bg-success text-white">
                                <h5 class="mb-0">VISITOR PASS</h5>
                            </div>
                            <div class="card-body">
                                <h4 id="passVisitorName"></h4>
                                <p class="mb-1">Visiting: <span id="passResidentName"></span></p>
                                <p class="mb-1">Apartment: <span id="passApartmentNumber"></span></p>
                                <p class="mb-1">Date & Time: <span id="passDateTime"></span></p>
                                <p>Purpose: <span id="passPurpose"></span></p>

                                <div class="qr-code mt-3">
                                    <img src="/api/placeholder/150/150" alt="QR Code" class="img-fluid">
                                    <p class="mt-2">Pass ID: <span id="passId"></span></p>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4">
                            <button type="button" class="btn btn-outline-primary mr-2" onclick="printPass()">
                                <i class="fas fa-print mr-2"></i> Print Pass
                            </button>
                            <button type="button" class="btn btn-outline-success">
                                <i class="fas fa-envelope mr-2"></i> Email Pass
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <!-- Building Information -->
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"><i class="fas fa-building mr-2"></i>Building Information</h4>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <i class="fas fa-clock mr-2"></i> Visiting Hours
                                <p class="mb-0 mt-1">8:00 AM - 10:00 PM</p>
                            </li>
                            <li class="list-group-item">
                                <i class="fas fa-phone mr-2"></i> Security Desk
                                <p class="mb-0 mt-1">(555) 123-4567</p>
                            </li>
                            <li class="list-group-item">
                                <i class="fas fa-car mr-2"></i> Parking
                                <p class="mb-0 mt-1">Available in Visitor Area B</p>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- FAQ -->
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"><i class="fas fa-question-circle mr-2"></i>Visitor FAQ</h4>
                    </div>
                    <div class="card-body">
                        <div class="accordion" id="faqAccordion">
                            <div class="card mb-2">
                                <div class="card-header p-1" id="headingOne">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link text-left w-100" type="button" data-toggle="collapse" data-target="#collapseOne">
                                            ID Requirements
                                        </button>
                                    </h5>
                                </div>
                                <div id="collapseOne" class="collapse" data-parent="#faqAccordion">
                                    <div class="card-body">
                                        All visitors must present a valid government-issued ID to security upon arrival.
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-2">
                                <div class="card-header p-1" id="headingTwo">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link text-left w-100" type="button" data-toggle="collapse" data-target="#collapseTwo">
                                            Parking Rules
                                        </button>
                                    </h5>
                                </div>
                                <div id="collapseTwo" class="collapse" data-parent="#faqAccordion">
                                    <div class="card-body">
                                        Visitor parking is available in Area B. Please display your visitor pass on your dashboard.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script>
        // Show the correct purpose input based on selection
        document.getElementById('visitPurpose').addEventListener('change', function() {
            const otherPurposeGroup = document.getElementById('otherPurposeGroup');
            if (this.value === 'Other') {
                otherPurposeGroup.style.display = 'block';
            } else {
                otherPurposeGroup.style.display = 'none';
            }
        });

        // Navigation functions
        function showVisitorForm() {
            document.getElementById('checkInForm').style.display = 'block';
            document.getElementById('residentForm').style.display = 'none';
        }

        function showResidentForm() {
            // Validate visitor form
            const visitorName = document.getElementById('visitorName').value;
            const visitorPhone = document.getElementById('visitorPhone').value;
            const visitPurpose = document.getElementById('visitPurpose').value;

            if (visitorName && visitorPhone && visitPurpose) {
                document.getElementById('checkInForm').style.display = 'none';
                document.getElementById('residentForm').style.display = 'block';
                document.getElementById('confirmationCard').style.display = 'none';
            } else {
                alert('Please fill in all required fields');
            }
        }

        function showConfirmation() {
            // Validate resident form
            const residentName = document.getElementById('residentName').value;
            const apartmentNumber = document.getElementById('apartmentNumber').value;
            const visitDate = document.getElementById('visitDate').value;
            const visitTime = document.getElementById('visitTime').value;

            if (residentName && apartmentNumber && visitDate && visitTime) {
                document.getElementById('residentForm').style.display = 'none';
                document.getElementById('confirmationCard').style.display = 'block';

                // Fill confirmation details
                document.getElementById('confirmName').textContent = document.getElementById('visitorName').value;
                document.getElementById('confirmPhone').textContent = document.getElementById('visitorPhone').value;

                let purpose = document.getElementById('visitPurpose').value;
                if (purpose === 'Other') {
                    purpose += ': ' + document.getElementById('otherPurpose').value;
                }
                document.getElementById('confirmPurpose').textContent = purpose;

                document.getElementById('confirmResident').textContent = residentName;
                document.getElementById('confirmApartment').textContent = apartmentNumber;

                const formattedDate = new Date(visitDate + 'T' + visitTime).toLocaleString();
                document.getElementById('confirmDateTime').textContent = formattedDate;
            } else {
                alert('Please fill in all required fields');
            }
        }

        function submitVisit() {

            // Fill pass details
            document.getElementById('passVisitorName').textContent = document.getElementById('visitorName').value;
            document.getElementById('passResidentName').textContent = document.getElementById('residentName').value;
            document.getElementById('passApartmentNumber').textContent = document.getElementById('apartmentNumber').value;

            let purpose = document.getElementById('visitPurpose').value;
            if (purpose === 'Other') {
                purpose += ': ' + document.getElementById('otherPurpose').value;
            }
            document.getElementById('passPurpose').textContent = purpose;

            const visitDate = document.getElementById('visitDate').value;
            const visitTime = document.getElementById('visitTime').value;
            const formattedDate = new Date(visitDate + 'T' + visitTime).toLocaleString();
            document.getElementById('passDateTime').textContent = formattedDate;

            // Generate random pass ID
            document.getElementById('passId').textContent = 'VP-' + Math.floor(100000 + Math.random() * 900000);

            // Hide confirmation and show pass
            document.getElementById('confirmationCard').style.display = 'none';
            document.getElementById('visitorPass').style.display = 'block';
        }

        function confirmLogout() {
            if (confirm('Are you sure you want to logout?')) {
                document.getElementById('logout-form').submit();
            }
        }

        function printPass() {
            window.print();
        }
    </script>
</body>
</html>
