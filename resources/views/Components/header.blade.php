<header class="bg-white shadow-sm relative z-50">
    <!-- Top Bar -->
    <div class="bg-white border-b border-gray-200 py-2 text-sm hidden lg:block">
        <div class="container mx-auto px-4 flex justify-between items-center">
            <span class="text-black">{{ date('l, F j, Y') }}</span>
            <div class="flex items-center space-x-4">
                <a href="#" class="text-black hover:text-red-600 text-lg"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="text-black hover:text-red-600 text-lg"><i class="fab fa-twitter"></i></a>
                <a href="#" class="text-black hover:text-red-600 text-lg"><i class="fab fa-instagram"></i></a>
                <a href="#" class="text-black hover:text-red-600 text-lg"><i class="fab fa-youtube"></i></a>
                <span class="text-black mx-2 hidden md:inline-block">|</span>
                <a href="/about" class="text-black hover:text-red-600 font-semibold hidden md:inline-block">About</a>
                <a href="/contact" class="text-black hover:text-red-600 font-semibold hidden md:inline-block">Contact</a>
                </a>
                <span class="text-black mx-2 hidden md:inline-block">|</span>
                @guest
                <a href="/login" class="text-black hover:text-red-600 font-semibold hidden md:inline-block">Login</a>
                <a href="/register" class="text-black hover:text-red-600 font-semibold hidden md:inline-block">Signup</a>
                @else
                <div class="relative">
                    <button class="text-black hover:text-red-600 font-semibold hidden md:inline-block cursor-pointer" onclick="toggleDropdown()">
                        <img src="{{ Auth::user()->getAvatarUrl() }}" alt="Avatar" class="w-8 h-8 rounded-full mr-2 inline-block" referrerpolicy="no-referrer">
                        {{ Auth::user()->name }}
                    </button>
                    <div id="dropdown" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-2 z-20 hidden" style="width: 210px !important;">
                        <div class="px-4 py-2 text-sm text-gray-700">
                            <p class="font-semibold">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
                            @if(Auth::user()->role === 'admin')
                                <a href="{{ route('admin.dashboard') }}" class="">Dashboard</a>
                            @elseif(Auth::user()->role === 'moderator')
                                <a href="{{ route('admin.posts.index') }}" class="">Dashboard</a>
                            @endif
                        </div>
                        <form method="POST" action="/logout">
                            @csrf
                            <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-black-700 hover:bg-red-600 cursor-pointer">Logout</button>
                        </form>
                    </div>
                </div>
                @endguest
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
                <a href="/post/{{ $post->slug }}" class="text-black hover:text-red-600 font-semibold hidden lg:inline-block">{{ Str::limit($post->title, 40)}}</a>
            @endforeach
            <div class="hidden lg:block">
                <form id="desktop-search-form" action="/search" method="GET" class="flex items-center border border-gray-300 rounded-full px-2 py-1">
                    <input type="search" name="query" id="search-input" class="flex-grow bg-transparent focus:outline-none text-black placeholder-gray-500" placeholder="Search...">
                    <button type="submit" class="text-black hover:text-gray-600 ml-2">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>
            <div class="lg:hidden flex items-center space-x-4">
                <button id="mobile-search-icon" class="text-black hover:text-gray-600 text-2xl">
                    <i class="fas fa-search"></i>
                </button>
                <button id="hamburger-menu" class="text-black hover:text-gray-600 text-2xl cursor-pointer">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Navigation Drawer -->
    <div id="mobile-nav" class="fixed inset-0 bg-white z-50 invisible opacity-0 transition-opacity duration-300 ease-in-out lg:hidden">
        <div class="flex flex-col h-full">
            <div class="p-4 border-b border-gray-200 flex justify-between items-center">
                <a href="/" class="flex-shrink-0">
                    <img src="{{ asset('images/simple_news.png') }}" alt="Prothomalo" class="h-10">
                </a>
                <button id="close-mobile-nav" class="text-black hover:text-red-600 text-2xl cursor-pointer">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="flex-grow p-4 overflow-y-auto">
                <form id="mobile-search-form" action="/search" method="GET" class="flex items-center border border-gray-300 rounded-full px-4 py-2 mb-6">
                    <input type="search" name="query" placeholder="Search..." class="flex-grow bg-transparent focus:outline-none text-black">
                    <button type="submit" class="text-black hover:text-red-600 ml-2 cursor-pointer">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
                <ul class="space-y-4 text-center">
                    <li><a href="/" class="block text-black text-xl font-semibold hover:text-red-600">Home</a></li>
                    <li><a href="/contact" class="block text-black text-xl font-semibold hover:text-red-600">Contact</a></li>
                    <li><a href="/about" class="block text-black text-xl font-semibold hover:text-red-600">About</a></li>
                </ul>
            </div>
            <div class="p-4 border-t border-gray-200">
                <div class="flex justify-center space-x-6 mb-4">
                    <a href="#" class="text-red-600 hover:text-red-700 text-2xl"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="text-red-600 hover:text-red-700 text-2xl"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-red-600 hover:text-red-700 text-2xl"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="text-red-600 hover:text-red-700 text-2xl"><i class="fab fa-youtube"></i></a>
                </div>
                <div class="text-center">
                    @guest
                    <a href="/login" class="text-black text-lg font-semibold hover:text-red-600">Login</a>
                    <a href="/register" class="text-black text-lg font-semibold hover:text-red-600">Signup</a>
                    @else
                    <div class="relative">
                        <img src="{{ Auth::user()->getAvatarUrl() }}" alt="Avatar" class="w-8 h-8 rounded-full mr-2 inline-block" referrerpolicy="no-referrer">
                        <span class="text-black font-semibold">{{ Auth::user()->name }}</span>
                        <form method="POST" action="/logout" class="inline">
                            @csrf
                            <button type="submit" class="text-black text-lg font-semibold hover:text-red-600 ml-4">Logout</button>
                        </form>
                    </div>
                    @endguest
                </div>
            </div>
        </div>
    </div>
</header>
<script>
    function toggleDropdown() {
        document.getElementById('dropdown').classList.toggle('hidden');
    }
</script>