<nav class="bg-prothomalo-red border-b border-prothomalo-border py-2 sticky top-0 z-40 px-4 overflow-x-auto hide-scrollbar">
    <div class="flex space-x-4">
        @foreach($categories as $category)
            <a href="/blog?category={{ $category->slug }}" class="text-white font-semibold hover:text-prothomalo-dark-gray whitespace-nowrap">{{ $category->name }}</a>
        @endforeach
    </div>
</nav>
