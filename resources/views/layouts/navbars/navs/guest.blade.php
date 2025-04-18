<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MATH CHALLENGE</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        .navbar-brand {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            text-align: center;
            font-size: 2rem;
            color: #ffffff;
            margin-right: auto;
        }

        .navbar-logo {
            width: 150px;
            height: auto;
            margin-top: 10px;
            align-self: flex-start;
        }

        .navbar {
            padding: 15px 0;
        }

        .navbar-wrapper {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute">
        <div class="container">
            <div class="navbar-wrapper">
                <a class="navbar-brand" href="#pablo">
                    {{ __('Maths') }}
                </a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-bar burger-lines"></span>
                    <span class="navbar-toggler-bar burger-lines"></span>
                    <span class="navbar-toggler-bar burger-lines"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse justify-content-end" id="navbar">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="{{ route('guest') }}" class="nav-link">
                            <i class="nc-icon nc-world"></i> {{ __('Guest') }}
                        </a>
                    </li>
                    <li class="nav-item @if($activePage == 'register') active @endif">
                        <a href="{{ route('register') }}" class="nav-link">
                            <i class="nc-icon nc-badge"></i> {{ __('Register') }}
                        </a>
                    </li>
                    <li class="nav-item @if($activePage == 'login') active @endif">
                        <a href="{{ route('login') }}" class="nav-link">
                            <i class="nc-icon nc-mobile"></i> {{ __('Login') }}
                        </a>
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
