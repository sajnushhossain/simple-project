<nav class="bg-primary border-b border-prothomalo-border py-2 sticky top-0 z-40 px-4 overflow-x-auto hide-scrollbar" style="background-color: #f60808ff; !important;">
    <div class="flex space-x-4">
        @foreach($categories as $category)
            <a href="/blog?category={{ $category->slug }}" class="text-white font-semibold hover:text-gray-200 whitespace-nowrap">{{ $category->name }}</a>
        @endforeach
    </div>
</nav>
