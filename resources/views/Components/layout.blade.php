@props(['posts'])
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple News</title>
    <meta name="theme-color" content="#0ea5e9">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    @vite('resources/css/app.css')
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
</head>
<body class="bg-bg text-text font-sans antialiased {{ request()->is('login') ? 'bg-white' : '' }}">
    @if(!request()->is('login'))
        <x-header :header-posts="$posts->take(3)" />
    @endif

    <main class="container mx-auto px-4 py-8">
        {{ $slot }}
    </main>

    @if(!request()->is('login'))
    <footer class="bg-surface mt-16 py-12 border-t border-border">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                <!-- Brand Section -->
                <div class="md:col-span-1">
                    <a href="/" class="text-2xl font-bold text-white hover:text-primary transition-colors duration-300 inline-flex items-center mb-4">
                        <i class="fas fa-newspaper mr-2"></i>Simple News
                    </a>
                    <p class="text-muted text-sm leading-relaxed">
                        Your trusted source for breaking news, in-depth analysis, and compelling stories from around the world.
                    </p>
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="text-white font-bold mb-4 text-lg">Quick Links</h3>
                    <ul class="space-y-2">
                        <li><a href="/" class="text-muted hover:text-primary transition-colors duration-200">Home</a></li>
                        <li><a href="/blog" class="text-muted hover:text-primary transition-colors duration-200">Blog</a></li>
                        <li><a href="#" class="text-muted hover:text-primary transition-colors duration-200">About Us</a></li>
                        <li><a href="#" class="text-muted hover:text-primary transition-colors duration-200">Contact</a></li>
                    </ul>
                </div>

                <!-- Categories -->
                <div>
                    <h3 class="text-white font-bold mb-4 text-lg">Categories</h3>
                    <ul class="space-y-2">
                        @foreach($posts->take(4) as $post)
                            @if($post->category)
                            <li><a href="/blog?category={{ $post->category->slug }}" class="text-muted hover:text-primary transition-colors duration-200">{{ $post->category->name }}</a></li>
                            @endif
                        @endforeach
                    </ul>
                </div>

                <!-- Newsletter -->
                <div>
                    <h3 class="text-white font-bold mb-4 text-lg">Stay Connected</h3>
                    <p class="text-muted text-sm mb-4">Subscribe to our newsletter for the latest updates.</p>
                    <form class="flex gap-2 mb-4">
                        <input type="email" placeholder="Your email" class="flex-1 bg-bg border border-border rounded-lg px-3 py-2 text-text text-sm focus:outline-none focus:ring-2 focus:ring-primary" required>
                        <button type="submit" class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-primary-700 transition-colors duration-300">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </form>
                    <div class="flex gap-3">
                        <a href="#" class="w-9 h-9 rounded-full bg-bg border border-border flex items-center justify-center text-muted hover:text-white hover:bg-primary hover:border-primary transition-all duration-300">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="w-9 h-9 rounded-full bg-bg border border-border flex items-center justify-center text-muted hover:text-white hover:bg-primary hover:border-primary transition-all duration-300">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="w-9 h-9 rounded-full bg-bg border border-border flex items-center justify-center text-muted hover:text-white hover:bg-primary hover:border-primary transition-all duration-300">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="w-9 h-9 rounded-full bg-bg border border-border flex items-center justify-center text-muted hover:text-white hover:bg-primary hover:border-primary transition-all duration-300">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Bottom Bar -->
            <div class="border-t border-border pt-6 mt-6">
                <div class="flex flex-col md:flex-row justify-between items-center gap-4 text-muted text-sm">
                    <p>&copy; {{ date('Y') }} Simple News. All rights reserved.</p>
                    <div class="flex gap-6">
                        <a href="#" class="hover:text-primary transition-colors duration-200">Privacy Policy</a>
                        <a href="#" class="hover:text-primary transition-colors duration-200">Terms of Service</a>
                        <a href="#" class="hover:text-primary transition-colors duration-200">Cookie Policy</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    @endif

    @vite('resources/js/app.js')
</body>
</html>