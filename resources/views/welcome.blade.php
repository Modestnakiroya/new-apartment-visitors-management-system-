<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Westview Living</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        @font-face {
            font-family: 'Poppins';
            src: url('{{ asset('light-bootstrap/fonts/Poppins-Medium.ttf') }}') format('truetype');
            font-weight: 500;
            font-style: normal;
        }
        body, html {
            height: 100%;
            margin: 0;
            font-family: 'Poppins', sans-serif;
            font-weight: 500;
            overflow-x: hidden;
        }
        .navbar {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            background-color: transparent;
            padding: 10px 20px;
            z-index: 1000;
        }
        .navbar-brand {
            display: flex;
            align-items: center;
            color: #ffffff;
            font-weight: 500;
            font-size: 1.5rem;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
        }
        .navbar-brand img {
            width: 50px;
            height: auto;
            margin-right: 10px;
        }
        .navbar-nav .nav-link {
            color: #ffffff !important;
            font-weight: 500;
            padding: 8px 20px;
            border: 2px solid #ffffff;
            border-radius: 25px;
            margin: 0 10px;
            background: transparent;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .navbar-nav .nav-link:hover {
            transform: scale(1.1);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }
        .banner {
            position: relative;
            height: 100vh;
            width: 100%;
            overflow: hidden;
        }
        .banner .slider {
            position: absolute;
            top: 0;
            left: 0;
            width: 300%;
            height: 100%;
            display: flex;
            transition: transform 1s ease-in-out;
        }
        .banner .slide {
            width: 33.33%;
            height: 100%;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
        .banner-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.4);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .banner-content {
            text-align: center;
            color: white;
            z-index: 2;
        }
        .banner-content h1 {
            font-size: 3rem;
            font-weight: 500;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            margin-bottom: 20px;
        }
        .banner-content p {
            font-size: 1.2rem;
            margin-bottom: 30px;
        }
        .btn-start {
            font-size: 1.2rem;
            padding: 10px 30px;
            border: 2px solid #ffffff;
            background: transparent;
            color: white;
            border-radius: 25px;
            transition: all 0.3s ease;
        }
        .btn-start:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg">
        <a class="navbar-brand" href="#">
            <img src="{{ asset('image/logo-app.jpeg') }}" alt="Apartment Logo">
            Westview Living
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="{{ route('guest') }}">Guest</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
            </ul>
        </div>
    </nav>

    <div class="banner">
        <div class="slider" id="bannerSlider">
            <div class="slide" style="background-image: url('{{ asset('image/snap1.jpg') }}');"></div>
            <div class="slide" style="background-image: url('{{ asset('image/snap2.jpg') }}');"></div>
            <div class="slide" style="background-image: url('{{ asset('image/snap3.jpg') }}');"></div>
        </div>
        <div class="banner-overlay">
            <div class="banner-content">
                <h2>{{ __('Westview Living') }}</h2>
                <p>It's A Lifestyle</p>
                <a href="{{ route('register') }}" class="btn btn-start">Register as Guest</a>
            </div>
        </div>
    </div>

    @push('js')
    <script>
        $(document).ready(function() {
            // Initialize cards
            setTimeout(function() {
                $('.card').removeClass('card-hidden');
            }, 700);

            // Image slider functionality
            let currentSlide = 0;
            const totalSlides = 3;
            const slider = $('#bannerSlider');

            function slideImages() {
                currentSlide = (currentSlide + 1) % totalSlides;
                slider.css('transform', `translateX(-${currentSlide * 33.33}%)`);
            }

            // Start the slider
            setInterval(slideImages, 7000); // Slide every 10 seconds
        });
    </script>
    @endpush

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>