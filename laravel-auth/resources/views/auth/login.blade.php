<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login - Auth App</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <div class="container">
        <h2>Login</h2>

        @if(session('success'))
            <div class="message" style="color: green">{{ session('success') }}</div>
        @endif

        @if($errors->any())
            <div class="message">{{ $errors->first() }}</div>
        @endif

        <form id="loginForm" method="POST" action="/login" onsubmit="return validateLogin()">
            @csrf
            <input type="email" id="email" name="email" placeholder="Email">
            <input type="password" id="password" name="password" placeholder="Password">
            <button type="submit">Login</button>
        </form>

        <div class="link">
            <a href="/register">Belum punya akun? Daftar di sini</a>
        </div>
    </div>

    <script>
        function validateLogin() {
            const email = document.getElementById('email');
            const pass = document.getElementById('password');

            if (email.value === '' || pass.value === '') {
                alert("Email dan Password wajib diisi.");
                return false;
            }
            return true;
        }
    </script>
</body>

</html>