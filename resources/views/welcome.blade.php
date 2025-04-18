<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MATH CHALLENGE 2024</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: 'Orbitron', sans-serif;
            overflow-x: hidden;
        }
        .full-page {
            background: linear-gradient(45deg, #6a11cb 0%, #2575fc 100%);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }
        .content {
            text-align: center;
            z-index: 2;
        }
        .custom-font {
            font-size: 3rem;
            font-weight: 700;
            color: #ffffff;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
            margin-bottom: 30px;
        }
        .logo {
            width: 200px;
            height: auto;
            margin-top: 20px;
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }
        .math-symbols {
            position: absolute;
            font-size: 24px;
            color: rgba(255,255,255,0.5);
            animation: float 6s infinite;
        }
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0px); }
        }
        .btn-start {
            font-size: 1.2rem;
            padding: 10px 30px;
            margin-top: 30px;
            background-color: #ff6b6b;
            border: none;
            color: white;
            transition: all 0.3s ease;
        }
        .btn-start:hover {
            background-color: #ee5253;
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        }
        /* Updated styles for navigation visibility */
        .navbar {
            background-color: rgba(255,255,255,0.8);
            padding: 10px 0;
        }
        .navbar-brand {
            color: #000000;
            font-weight: 700;
            font-size: 1.2rem;
        }
        .navbar-nav .nav-link {
            color: #000000 !important;
            font-weight: 600;
            background-color: rgba(255,255,255,0.5);
            padding: 5px 15px;
            border-radius: 20px;
            margin: 0 5px;
        }
        .navbar-nav .nav-link:hover {
            background-color: rgba(0,0,0,0.1);
        }
        /* Updated style for the title */
        .challenge-title {
            position: fixed;
            top: 20px;
            left: 20px;
            color: #000000;
            font-size: 1.2rem;
            font-weight: 700;
            z-index: 1000;
            background-color: rgba(255,255,255,0.7);
            padding: 5px 10px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    @extends('layouts/app', ['activePage' => 'welcome', 'title' => 'MATH CHALLENGE 2024'])

    @section('content')
    <div class="challenge-title">MATH CHALLENGE 2024</div>
    <div class="full-page">
        <div class="content">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10 col-md-10 text-center">
                        <h1 class="custom-font">{{ __('Welcome to the Mathematics Challenge 2024') }}</h1>
                        <img src="{{ asset('image/love.jpeg') }}" alt="Math Challenge Logo" class="logo">
                        <p class="text-white mt-4">Are you ready to push your mathematical limits?</p>
                        <button class="btn btn-start">Start Challenge</button>
                    </div>
                </div>
            </div>
        </div>
        <div id="mathSymbols"></div>
    </div>
    @endsection

    @push('js')
    <script>
        $(document).ready(function() {
            demo.checkFullPageBackgroundImage();

            setTimeout(function() {
                $('.card').removeClass('card-hidden');
            }, 700);

            const symbols = ['∑', 'π', '∞', '√', '∫', '≠', '≈', '∏', '∅', '∀'];
            const container = document.getElementById('mathSymbols');

            for (let i = 0; i < 50; i++) {
                let symbol = document.createElement('div');
                symbol.textContent = symbols[Math.floor(Math.random() * symbols.length)];
                symbol.classList.add('math-symbols');
                symbol.style.left = `${Math.random() * 100}vw`;
                symbol.style.top = `${Math.random() * 100}vh`;
                symbol.style.animationDelay = `${Math.random() * 5}s`;
                container.appendChild(symbol);
            }
        });
    </script>
    @endpush

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>