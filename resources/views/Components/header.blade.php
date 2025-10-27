<header class="bg-white shadow-sm relative z-50">
    <!-- Top Bar -->
    <div class="border-b border-prothomalo-border py-2 text-sm hidden lg:block">
        <div class="container mx-auto px-4 flex justify-between items-center">
            <span class="text-prothomalo-light-text">{{ date('l, F j, Y') }}</span>
            <div class="flex items-center space-x-4">
                <a href="#" class="text-prothomalo-light-text hover:text-prothomalo-red text-lg"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="text-prothomalo-light-text hover:text-prothomalo-red text-lg"><i class="fab fa-twitter"></i></a>
                <a href="#" class="text-prothomalo-light-text hover:text-prothomalo-red text-lg"><i class="fab fa-instagram"></i></a>
                <a href="#" class="text-prothomalo-light-text hover:text-prothomalo-red text-lg"><i class="fab fa-youtube"></i></a>
                <!-- <a href="#" class="text-prothomalo-light-text hover:text-prothomalo-red text-lg hidden md:inline-block"><i class="fab fa-linkedin-in"></i></a> -->
                <!-- <a href="#" class="text-prothomalo-light-text hover:text-prothomalo-red text-lg hidden md:inline-block"><i class="fab fa-pinterest"></i></a> -->
                <span class="text-prothomalo-light-text mx-2 hidden md:inline-block">|</span>
                <a href="/about" class="text-prothomalo-dark-gray hover:text-prothomalo-red font-semibold hidden md:inline-block">About</a>
                <a href="/contact" class="text-prothomalo-dark-gray hover:text-prothomalo-red font-semibold hidden md:inline-block">Contact</a>
                <span class="text-prothomalo-light-text mx-2 hidden md:inline-block">|</span>
                <a href="/login" class="text-prothomalo-dark-gray hover:text-prothomalo-red font-semibold hidden md:inline-block">Login</a>
            </div>
        </div>
    </div>

    <!-- Middle Bar (Logo, Search, Hamburger) -->
    <div class="container mx-auto px-4 py-0 flex items-center justify-between">
        <!-- Left side: Logo & Hamburger (mobile) -->
        <div class="flex-1 flex items-center justify-start space-x-4">
            <a href="/" class="flex-shrink-0">
                <img src="{{ asset('images/simple_news.png') }}" alt="Simple News" class="h-20 md:h-24">
            </a>
        </div>

        <!-- Right side: Latest Posts & Search. -->
        <div class="flex-1 flex items-center justify-end space-x-4">
            
            @foreach($headerPosts as $post)
                <a href="/post/{{ $post->slug }}" class="text-prothomalo-dark-gray hover:text-prothomalo-red font-semibold hidden lg:inline-block">{{ $post->title }}</a>
            @endforeach
            <div class="hidden lg:block">
                <form id="desktop-search-form" action="/search" method="GET" class="flex items-center border border-prothomalo-border rounded-full px-2 py-1">
                    <input type="search" name="query" id="search-input"
                           class="flex-grow bg-transparent focus:outline-none text-prothomalo-dark-gray"
                           placeholder="Search...">
                    <button type="submit" class="text-prothomalo-dark-gray hover:text-prothomalo-red ml-2">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>
            <div class="lg:hidden flex items-center space-x-4">
                <button id="mobile-search-icon" class="text-prothomalo-dark-gray hover:text-prothomalo-red text-2xl">
                    <!-- <i class="fas fa-search"></i> -->
                </button>
                <button id="hamburger-menu" class="text-prothomalo-dark-gray hover:text-prothomalo-red text-2xl cursor-pointer">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </div>
    </div>



    <!-- Mobile Navigation Drawer -->
    <div id="mobile-nav" class="fixed inset-0 bg-white z-50 invisible opacity-0 transition-opacity duration-300 ease-in-out lg:hidden">
        <div class="flex flex-col h-full">
            <div class="p-4 border-b border-prothomalo-border flex justify-between items-center">
                <a href="/" class="flex-shrink-0">
                    <img src="{{ asset('images/simple_news.png') }}" alt="Prothomalo" class="h-10">
                </a>
                <button id="close-mobile-nav" class="text-prothomalo-dark-gray hover:text-prothomalo-red text-2xl cursor-pointer">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="flex-grow p-4 overflow-y-auto">
                <form id="mobile-search-form" action="/search" method="GET" class="flex items-center border border-prothomalo-border rounded-full px-4 py-2 mb-6">
                    <input type="search" name="query" placeholder="Search..." class="flex-grow bg-transparent focus:outline-none text-prothomalo-dark-gray">
                    <button type="submit" class="text-prothomalo-dark-gray hover:text-prothomalo-red ml-2 cursor-pointer">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
                <ul class="space-y-4 text-center">
                    <li><a href="/" class="block text-prothomalo-dark-gray text-xl font-semibold hover:text-prothomalo-red">Home</a></li>
                    <li><a href="/contact" class="block text-prothomalo-dark-gray text-xl font-semibold hover:text-prothomalo-red">Contact</a></li>
                    <li><a href="/about" class="block text-prothomalo-dark-gray text-xl font-semibold hover:text-prothomalo-red">About</a></li>
                </ul>
            </div>
            <div class="p-4 border-t border-prothomalo-border">
                <div class="flex justify-center space-x-6 mb-4">
                    <a href="#" class="text-prothomalo-light-text hover:text-prothomalo-red text-2xl"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="text-prothomalo-light-text hover:text-prothomalo-red text-2xl"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-prothomalo-light-text hover:text-prothomalo-red text-2xl"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="text-prothomalo-light-text hover:text-prothomalo-red text-2xl"><i class="fab fa-youtube"></i></a>
                </div>
                <div class="text-center">
                    <a href="/login" class="text-prothomalo-dark-gray text-lg font-semibold hover:text-prothomalo-red">Login</a>
                </div>
            </div>
        </div>
    </div>
</header>