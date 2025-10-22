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
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Cormorant:wght@400;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    @stack('styles')
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
</head>

<body class="bg-white text-prothomalo-dark-gray font-sans antialiased {{ request()->is('login') ? 'bg-white' : '' }}">
    @if(!request()->is('login'))
    <x-header />
    <x-category-subheader />
    @endif

    @if(session()->has('message'))
        @php
            $message = session('message');
            $type = $message['type'] ?? 'info';
            $text = $message['text'] ?? '';

            $toastClasses = [
                'success' => 'text-white bg-green-500 dark:bg-green-700 dark:text-green-200',
                'error' => 'text-red-500 bg-red-100 dark:bg-red-800 dark:text-red-200',
                'warning' => 'text-yellow-500 bg-yellow-100 dark:bg-yellow-800 dark:text-yellow-200',
                'info' => 'text-blue-500 bg-blue-100 dark:bg-blue-800 dark:text-blue-200',
            ];

            // container/background classes for the whole toast (icon area above only handled by $toastClasses)
            $containerClasses = [
                'success' => 'text-white bg-green-500 dark:bg-green-700',
                'error' => 'text-gray-700 bg-red-100 dark:bg-red-800',
                'warning' => 'text-gray-700 bg-yellow-100 dark:bg-yellow-800',
                'info' => 'text-gray-700 bg-blue-100 dark:bg-blue-800',
            ];

            $iconPaths = [
                'success' => 'M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z',
                'error' => 'M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM10 15a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm0-4a1 1 0 0 1-1-1V6a1 1 0 0 1 2 0v4a1 1 0 0 1-1 1Z',
                'warning' => 'M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM10 15a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm0-4a1 1 0 0 1-1-1V6a1 1 0 0 1 2 0v4a1 1 0 0 1-1 1Z',
                'info' => 'M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z',
            ];

            $buttonClasses = [
                'success' => 'bg-green-500 text-white hover:bg-green-600 focus:ring-green-400 dark:bg-green-700 dark:hover:bg-green-600',
                'error' => 'bg-red-100 text-red-500 hover:bg-red-200 focus:ring-red-400 dark:bg-red-800 dark:text-red-200 dark:hover:bg-red-700',
                'warning' => 'bg-yellow-100 text-yellow-500 hover:bg-yellow-200 focus:ring-yellow-400 dark:bg-yellow-800 dark:text-yellow-200 dark:hover:bg-yellow-700',
                'info' => 'bg-blue-100 text-blue-500 hover:bg-blue-200 focus:ring-blue-400 dark:bg-blue-800 dark:text-blue-200 dark:hover:bg-blue-700',
            ];
        @endphp

        <div id="toast-message"
            class="fixed top-5 right-5 flex items-center w-full max-w-xs p-4 mb-4 rounded-lg shadow-lg z-50 {{ $containerClasses[$type] ?? '' }}"
            role="alert">
            <div
                class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 {{ $toastClasses[$type] ?? '' }} rounded-lg">
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                    viewBox="0 0 20 20">
                    <path d="{{ $iconPaths[$type] }}" />
                </svg>
                <span class="sr-only">{{ $type }} icon</span>
            </div>
            <div class="ms-3 text-sm font-normal">{{ $text }}</div>
            <button type="button"
                class="ms-auto -mx-1.5 -my-1.5 rounded-lg focus:ring-2 p-1.5 inline-flex items-center justify-center h-8 w-8 {{ $buttonClasses[$type] ?? '' }}"
                data-dismiss-target="#toast-message" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
            </button>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const toast = document.getElementById('toast-message');
                const closeButton = document.querySelector('[data-dismiss-target="#toast-message"]');

                if (toast) {
                    setTimeout(() => {
                        toast.style.transition = 'opacity 0.5s ease-in-out';
                        toast.style.opacity = '0';
                        setTimeout(() => {
                            toast.remove();
                        }, 500);
                    }, 5000);
                }

                if (closeButton) {
                    closeButton.addEventListener('click', function() {
                        toast.style.transition = 'opacity 0.5s ease-in-out';
                        toast.style.opacity = '0';
                        setTimeout(() => {
                            toast.remove();
                        }, 500);
                    });
                }
            });
        </script>
    @endif

    <div class="container mx-auto px-4 py-4 md:py-8 max-w-[1200px]">
        {{ $slot }}
    </div>

    @if(!request()->is('login'))
    <footer class="bg-prothomalo-dark-gray text-white py-8 mt-8">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="col-span-full md:col-span-1">
                    <a href="/">
                        <img src="{{ asset('images/simple_news.png') }}" alt="Prothomalo" class="h-10 mb-4">
                    </a>
                    <p class="text-sm text-light-text">Simple News is the largest Bengali newspaper from Dhaka, Bangladesh. It is the most popular Bengali newspaper in the world.</p>
                </div>
                <div>
                    <h3 class="text-lg font-bold mb-4">Categories</h3>
                    <ul class="space-y-2 text-prothomalo-light-text">
                        @foreach($categories->take(5) as $category)
                        <li><a href="/blog?category={{ $category->slug }}" class="hover:text-prothomalo-red">{{ $category->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-bold mb-4">Company</h3>
                    <ul class="space-y-2 text-prothomalo-light-text">
                        <li><a href="#" class="hover:text-prothomalo-red">About Us</a></li>
                        <li><a href="#" class="hover:text-prothomalo-red">Contact Us</a></li>
                        <li><a href="#" class="hover:text-prothomalo-red">Privacy Policy</a></li>
                        <li><a href="#" class="hover:text-prothomalo-red">Terms of Service</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-bold mb-4">Follow Us</h3>
                    <div class="flex space-x-4 text-prothomalo-light-text">
                        <a href="#" class="hover:text-prothomalo-red text-xl"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="hover:text-prothomalo-red text-xl"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="hover:text-prothomalo-red text-xl"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="hover:text-prothomalo-red text-xl"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
            <div class="mt-8 border-t border-prothomalo-border pt-8 flex flex-col md:flex-row justify-between items-center text-center md:text-left">
                <p class="text-sm text-prothomalo-light-text">&copy; {{ date('Y') }} Simple News. All rights reserved.</p>
                <p class="text-sm text-prothomalo-light-text">Developed by <a href="https://www.sajnush.info" class="text-prothomalo-red hover:underline">Sajnush</a></p>
            </div>
        </div>
    </footer>
    @endif

    @vite('resources/js/app.js')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    @stack('scripts')
</body>

</html>
