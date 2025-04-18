
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar with Centered Search Icon</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        .input-group {
            position: relative;
            display: flex;
            align-items: center;
            margin: auto; /* Center the input group */
        }

        .input-group .form-control {
            padding-left: 2.5rem; /* Adjust this value as needed */
        }

        .input-group .input-group-text {
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 2.5rem; /* Adjust this value as needed */
            display: flex;
            align-items: center;
            justify-content: center;
            border: none;
            background: transparent;
            pointer-events: none; /* Make the icon unclickable */
        }

        .input-group .input-group-text i {
            font-size: 1rem; /* Adjust icon size as needed */
            color: #aaa; /* Adjust icon color as needed */
        }

        .navbar-nav.ml-auto {
            display: flex;
            align-items: center;
        }

        .initials-circle {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #007bff;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            font-weight: bold;
            text-transform: uppercase;
            margin-left: 10px; /* Add some space between the initials and the logout link */
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg" color-on-scroll="500">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"> {{ $navName }} </a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-bar burger-lines"></span>
                <span class="navbar-toggler-bar burger-lines"></span>
                <span class="navbar-toggler-bar burger-lines"></span>
            </button>
            <div class="collapse navbar-collapse" id="navigation">
                <!-- Left side of the navbar -->
                <ul class="navbar-nav mr-auto">
                </ul>

                <!-- Center search bar -->
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <form class="form-inline">
                            <div class="input-group">
                                <input class="form-control" type="search" placeholder="Search" aria-label="Search">
                                <span class="input-group-text"><i class="nc-icon nc-zoom-split"></i></span>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="submit">Search</button>
                                </div>
                            </div>
                        </form>
                    </li>
                </ul>

                <!-- Right side of the navbar -->
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <div class="initials-circle">
                            {{ strtoupper(substr(explode(' ', Auth::user()->name)[0], 0, 1)) . strtoupper(substr(explode(' ', Auth::user()->name)[1] ?? '', 0, 1)) }}
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('profile.edit') }}">
                            <span class="no-icon">{{ __('Account') }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: inline;">
                            @csrf
                            <a class="nav-link text-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Log out') }}</a>
                        </form>
                    </li>
                    
                </ul>
            </div>
        </div>
    </nav>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
