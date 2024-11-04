<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
        /* Menyusun halaman agar tombol berada di tengah */
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
        }
        
        /* Styling untuk tombol login */
        .login-button {
            padding: 15px 30px;
            font-size: 18px;
            color: #fff;
            background-color: #5c68e2;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        /* Efek hover pada tombol */
        .login-button:hover {
            background-color: #4953c4;
        }
    </style>
</head>
<body>
    <!-- Tombol Login -->
    <button class="login-button" onclick="window.location.href='auth/login'">Login</button>
</body>
</html>
