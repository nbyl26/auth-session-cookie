<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Register - Auth App</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <div class="container">
        <h2>Register</h2>

        @if($errors->any())
            <div class="message">{{ $errors->first() }}</div>
        @endif

        <form id="registerForm" method="POST" action="/register" onsubmit="return validateRegister()">
            @csrf
            <input type="text" id="name" name="name" placeholder="Nama Lengkap">
            <input type="email" id="email" name="email" placeholder="Email">
            <input type="password" id="password" name="password" placeholder="Password">
            <button type="submit">Register</button>
        </form>

        <div class="link">
            <a href="/login">Sudah punya akun? Login di sini</a>
        </div>
    </div>

    <script>
        function validateRegister() {
            const name = document.getElementById('name');
            const email = document.getElementById('email');
            const pass = document.getElementById('password');

            if (name.value.length < 3) {
                alert("Nama harus lebih dari 3 karakter.");
                return false;
            }
            if (email.value === '' || pass.value.length < 6) {
                alert("Email harus valid dan password minimal 6 karakter.");
                return false;
            }
            return true;
        }
    </script>
</body>

</html>