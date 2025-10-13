<nav class="flex flex-col md:flex-row items-start md:items-center space-y-4 md:space-y-0 md:space-x-8">
    <a href="/blog" class="text-text hover:text-primary transition-colors duration-200 font-medium {{ request()->is('blog') ? 'text-primary font-bold' : '' }}">Blog</a>
    @foreach($categories as $category)
        <a href="/blog?category={{ $category->slug }}" class="text-text hover:text-primary transition-colors duration-200 font-medium {{ request()->query('category') == $category->slug ? 'text-primary font-bold' : '' }}">{{ $category->name }}</a>
    @endforeach
</nav>
