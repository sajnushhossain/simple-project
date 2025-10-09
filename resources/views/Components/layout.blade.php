<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Blog</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="icon" type="image/png" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.8/js/bootstrap.min.js">
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
            <div class="social-links" >
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


<!--   -->