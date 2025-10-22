<div class="overflow-x-auto hide-scrollbar">
    <nav class="flex items-center space-x-6 whitespace-nowrap">
        <a href="/"
            class="text-prothomalo-dark-gray hover:text-prothomalo-red transition-colors duration-200 font-semibold text-base">Home</a>
        <a href="/blog"
            class="text-prothomalo-dark-gray hover:text-prothomalo-red transition-colors duration-200 font-semibold text-base">All News</a>
        @foreach($categories as $category)
            <a href="/blog?category={{ $category->slug }}"
                class="text-prothomalo-dark-gray hover:text-prothomalo-red transition-colors duration-200 font-semibold text-base">{{ $category->name }}</a>
        @endforeach
        <a href="/about"
            class="text-prothomalo-dark-gray hover:text-prothomalo-red transition-colors duration-200 font-semibold text-base">About</a>
        <a href="/contact"
            class="text-prothomalo-dark-gray hover:text-prothomalo-red transition-colors duration-200 font-semibold text-base">Contact</a>
    </nav>
</div>