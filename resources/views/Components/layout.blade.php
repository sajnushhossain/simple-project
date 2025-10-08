<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Blog</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            font-family: sans-serif;
            background-color: #f0f8ff;
            color: #333;
            margin: 0;
        }
        .login-page {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-size: cover;
            background-position: center;
        }
        .login-card {
            background-color: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            border-radius: 10px;
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
            padding: 40px;
            width: 400px;
            text-align: center;
        }
        .login-card h1 {
            color: #2fa4e7;
            font-size: 36px;
            margin-bottom: 20px;
        }
        .login-card form {
            margin-top: 20px;
        }
        .login-card input[type="email"],
        .login-card input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .login-card button[type="submit"] {
            background-color: #2fa4e7;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .login-card button[type="submit"]:hover {
            background-color: #2683b9;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        .navbar {
            background-color: #fff;
            padding: 20px 0;
            border-bottom: 1px solid #eee;
        }
        .navbar .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .navbar-brand {
            font-size: 24px;
            font-weight: bold;
            color: #2fa4e7;
            text-decoration: none;
        }
        .nav-links a {
            color: #333;
            text-decoration: none;
            margin-left: 20px;
        }
        .nav-links a:hover {
            color: #2fa4e7;
        }
        .nav-link-button {
            background: none;
            border: none;
            color: #333;
            cursor: pointer;
            text-decoration: none;
            margin-left: 20px;
            font-size: 16px;
        }
        .nav-link-button:hover {
            color: #2fa4e7;
        }
        .hero {
            background-color: #2fa4e7;
            color: #fff;
            padding: 80px 0;
            text-align: center;
        }
        .hero h1 {
            font-size: 48px;
            margin-bottom: 20px;
        }
        .hero p {
            font-size: 20px;
        }
        .btn {
            display: inline-block;
            background-color: #2fa4e7;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            margin-top: 20px;
        }
        .btn-primary {
             background-color: #2fa4e7;
             border-color: #2fa4e7;
        }
        .btn-danger {
            background-color: #c71c22;
            border-color: #c71c22;
        }
        .btn-hero {
            background-color: #fff;
            color: #2fa4e7;
            padding: 15px 30px;
            border-radius: 50px;
            text-decoration: none;
            margin-top: 20px;
            font-weight: bold;
            transition: background-color 0.2s, color 0.2s;
        }
        .btn-hero:hover {
            background-color: #eee;
            color: #2683b9;
        }
        .footer {
            background-color: #333;
            color: #fff;
            padding: 40px 0;
            text-align: center;
            margin-top: 40px;
        }
        .social-links a {
            color: #fff;
            text-decoration: none;
            margin: 0 10px;
            font-size: 24px;
            display: inline-block;
            width: 50px;
            height: 50px;
            line-height: 50px;
            border-radius: 50%;
            background-color: #444;
            transition: background-color 0.2s;
        }
        .social-links a:hover {
            background-color: #2fa4e7;
        }
        .card {
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            margin-bottom: 20px;
            overflow: hidden;
        }
        .card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        .card-body {
            padding: 20px;
            height: auto;
            overflow: auto;
        }
        .card-title {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }
        .featured-posts {
            background-color: #f8f9fa;
            padding: 80px 0;
        }
        table tr:hover {
            background-color: #f8f9fa;
        }
    </style>
</head>
<body class="{{ request()->is('login') ? 'login-page' : '' }}">
    @if(!request()->is('login'))
    <nav class="navbar">
        <div class="container">
            <a class="navbar-brand" href="/">Simple Blog</a>
            <div class="nav-links">
                <a href="/">Home</a>
                <a href="/blog">Blog</a>
                @auth
                    <a href="/admin/posts">Admin</a>
                    <form method="POST" action="/logout" style="display: inline;">
                        @csrf
                        <button type="submit" class="nav-link-button">Logout</button>
                    </form>
                @else
                    <a href="/login">Login</a>
                @endauth
            </div>
        </div>
    </nav>
    @endif

    <main>
        {{ $slot }}
    </main>

    @if(!request()->is('login'))
    <footer class="footer">
        <div class="container">
            <p>&copy; 2025 Simple Blog. All rights reserved.</p>
            <div class="social-links">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-linkedin-in"></i></a>
            </div>
        </div>
    </footer>
    @endif
</body>
</html>