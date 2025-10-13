<nav class="flex flex-col md:flex-row items-start md:items-center space-y-4 md:space-y-0 md:space-x-8">
    <a href="/" class="text-text hover:text-primary transition-colors duration-200 font-medium {{ request()->is('/') ? 'text-primary font-bold' : '' }}">Home</a>
    <a href="/blog" class="text-text hover:text-primary transition-colors duration-200 font-medium {{ request()->is('blog') ? 'text-primary font-bold' : '' }}">Blog</a>
    <div class="relative" x-data="{ open: false }">
        <button @click="open = !open" class="text-text hover:text-primary transition-colors duration-200 font-medium flex items-center">
            Categories <i class="fa-solid fa-chevron-down ml-2 text-xs"></i>
        </button>
        <div x-show="open" @click.away="open = false" class="absolute top-full left-0 mt-2 bg-white shadow-lg rounded-lg p-4 z-50">
            @foreach ($categories as $category)
                <a href="/blog?category={{ $category->slug }}" class="block text-text hover:text-primary transition-colors duration-200 font-medium py-2">{{ $category->name }}</a>
            @endforeach
        </div>
    </div>
    <a href="/about" class="text-text hover:text-primary transition-colors duration-200 font-medium {{ request()->is('about') ? 'text-primary font-bold' : '' }}">About</a>
    <a href="#" class="text-text hover:text-primary transition-colors duration-200 font-medium">Contact</a>
</nav>