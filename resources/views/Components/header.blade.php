@props(['headerPosts'])
<header class="bg-surface border-b border-border header-shadow sticky top-0 z-50">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center py-4">
            <!-- Logo -->
            <a class="text-3xl font-bold text-primary hover:text-primary-700 transition-colors duration-300" href="/">
                <i class="fas fa-newspaper mr-2"></i>Simple News
            </a>

            <!-- Desktop Navigation -->
            <div class="hidden md:flex items-center space-x-8">
                <x-navigation />
            </div>

            <!-- Header Actions -->
            <div class="flex items-center space-x-4">
                <!-- Search Icon & Form -->
                <div class="relative">
                    <button id="search-icon" class="text-text hover:text-primary transition-colors duration-200 text-lg" aria-label="Search">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                    <form id="search-form" action="/search" method="GET" class="hidden absolute right-0 top-full mt-2 search-transition shadow-lg">
                        <input type="text" name="query" placeholder="Search news..." 
                               class="bg-white border-2 border-primary/30 rounded-lg px-4 py-2 text-text placeholder-muted focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary w-64" 
                               required>
                    </form>
                </div>

                <!-- Auth Links -->
                @auth
                    <a class="hidden md:flex items-center text-text hover:text-primary transition-colors duration-200" href="/admin/posts">
                        <i class="fa-regular fa-user mr-1"></i> Admin
                    </a>
                    <form method="POST" action="/logout" class="inline">
                        @csrf
                        <button type="submit" class="hidden md:flex items-center text-text hover:text-primary transition-colors duration-200">
                            <i class="fa-solid fa-arrow-right-from-bracket mr-1"></i> Logout
                        </button>
                    </form>
                @else
                    <a class="hidden md:flex items-center text-text hover:text-primary transition-colors duration-200" href="/login">
                        <i class="fa-regular fa-user mr-1"></i> Login
                    </a>
                @endauth

                <!-- Theme Toggle (Hidden for light theme) -->
                <!-- <button id="theme-toggle" class="text-text hover:text-primary transition-colors duration-200 text-lg" aria-label="Toggle theme">
                    <i class="fa-solid fa-moon"></i>
                </button> -->

                <!-- Mobile Menu Button -->
                <button class="md:hidden text-text hover:text-primary text-2xl" id="hamburger-menu" aria-label="Toggle menu">
                    <i class="fa-solid fa-bars"></i>
                </button>
            </div>
        </div>
    </div>
</header>

<!-- Mobile Menu -->
<div id="mobile-nav" class="hidden md:hidden fixed top-0 left-0 w-full h-screen bg-white z-50 mobile-menu-enter shadow-2xl">
    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-2xl font-bold text-primary">Menu</h2>
            <button id="close-mobile-nav" class="text-text hover:text-primary text-3xl" aria-label="Close menu">
                <i class="fa-solid fa-times"></i>
            </button>
        </div>
        <div class="flex flex-col space-y-6">
            <x-navigation />
            
            <!-- Mobile Auth Links -->
            <div class="border-t border-border pt-6 mt-6 space-y-4">
                @auth
                    <a class="flex items-center text-text hover:text-primary text-lg" href="/admin/posts">
                        <i class="fa-regular fa-user mr-2"></i> Admin Dashboard
                    </a>
                    <form method="POST" action="/logout">
                        @csrf
                        <button type="submit" class="flex items-center text-text hover:text-primary text-lg">
                            <i class="fa-solid fa-arrow-right-from-bracket mr-2"></i> Logout
                        </button>
                    </form>
                @else
                    <a class="flex items-center text-text hover:text-primary text-lg" href="/login">
                        <i class="fa-regular fa-user mr-2"></i> Login
                    </a>
                @endauth
            </div>
        </div>
    </div>
</div>