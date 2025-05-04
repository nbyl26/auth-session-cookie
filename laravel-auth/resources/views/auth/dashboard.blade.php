<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(to right, #4facfe, #00f2fe);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .dashboard-container {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
            max-width: 520px;
            width: 90%;
            text-align: center;
            animation: fadeIn 0.5s ease-in-out;
        }

        h2 {
            font-size: 28px;
            color: #003f8a;
            margin-bottom: 15px;
        }

        .welcome-text {
            font-size: 18px;
            color: #555;
            margin-bottom: 10px;
        }

        .last-login {
            font-size: 15px;
            color: #006994;
            font-style: italic;
            margin-bottom: 25px;
        }

        form button {
            padding: 12px 25px;
            background-color: #0077b6;
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
        }

        form button:hover {
            background-color: #005f8f;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>
    <div class="dashboard-container">
        <h2>Selamat Datang, {{ $name }}</h2>
        <p class="welcome-text">WELCOME BRO!</p>

        @php
            $lastLogin = cookie('last_login');

            function isValidDateTime($date)
            {
                try {
                    return $date && \Carbon\Carbon::parse($date);
                } catch (\Exception $e) {
                    return false;
                }
            }
        @endphp

        @if (isValidDateTime($lastLogin))
            <p class="last-login">
                Login terakhir Anda:
                <strong>{{ \Carbon\Carbon::parse($lastLogin)->translatedFormat('d F Y, H:i') }} WIB</strong>
            </p>
        @else
            <p class="last-login"> HIDUP J*K**I!!!!</p>
        @endif


        <form method="POST" action="/logout">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </div>
</body>

</html>