<x-layout>
    <div class="max-w-[1200px] mx-auto px-4 py-8">

        <!-- Page Header -->
        <div class="text-center mb-8 border-b border-border-light pb-4">
            <h1 class="font-serif text-4xl md:text-5xl text-dark-text mb-2">All News</h1>
            <p class="text-light-text text-lg max-w-3xl mx-auto">
                Browse through our collection of articles and reports.
            </p>
        </div>

        @if($posts->count() === 0)
        <div class="text-center py-24">
            <i class="far fa-newspaper text-7xl text-prothomalo-light-text mb-8"></i>
            <p class="text-center text-prothomalo-muted text-2xl font-semibold">No articles found.</p>
            <p class="text-center text-prothomalo-light-text mt-2">Stay tuned for our latest publications.</p>
        </div>
        @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($posts as $post)
            <article class="group bg-card-background rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow duration-300">
                <a href="/post/{{ $post->slug }}" class="block">
                    <div class="relative overflow-hidden aspect-video">
                        <img src="{{ $post->image ? asset('storage/' . $post->image) : 'https://placehold.co/800x450/f1f1f1/333333?text=Post' }}"
                            alt="{{ $post->title }}"
                            class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-500">
                    </div>
                </a>
                <div class="p-4">
                    @if($post->category)
                    <a href="/blog?category={{ $post->category->slug }}"
                        class="text-xs font-semibold text-primary-red hover:underline uppercase tracking-wide mb-1 inline-block">{{ $post->category->name }}</a>
                    @endif
                    <h3 class="font-serif text-xl text-dark-text mb-2 leading-tight">
                        <a href="/post/{{ $post->slug }}"
                            class="hover:text-primary-red transition-colors duration-300 line-clamp-3">{{ $post->title }}</a>
                    </h3>
                    <p class="text-sm text-light-text leading-normal mb-3 line-clamp-3">
                        {{ Str::limit(strip_tags($post->body), 150) }}
                    </p>
                    <div class="flex justify-between items-center text-xs text-light-text">
                        <span>{{ $post->created_at->format('M d, Y') }}</span>
                        <a href="/post/{{ $post->slug }}"
                            class="text-primary-red hover:underline">Read More →</a>
                    </div>
                </div>
            </article>
            @endforeach
        </div>
        @endif

        <!-- Pagination -->
        <div class="mt-8">
            {{ $posts->links('vendor.pagination.custom') }}
        </div>
    </div>
</x-layout>