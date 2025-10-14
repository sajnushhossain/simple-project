<x-layout :posts="$posts">
    <div class="container mx-auto px-4 py-8">

        <!-- Page Header -->
        <div class="text-center mb-12 border-b-2 border-border pb-8">
            <h1 class="text-6xl md:text-8xl font-black text-text tracking-tighter leading-none mb-2 newspaper-title">All News</h1>
            <p class="text-muted text-lg max-w-3xl mx-auto">
                Browse through our collection of articles and reports.
            </p>
        </div>

        @if($posts->count() === 0)
            <div class="text-center py-24">
                <i class="far fa-newspaper text-7xl text-light-text mb-8"></i>
                <p class="text-center text-muted text-2xl font-semibold">No articles found.</p>
                <p class="text-center text-light-text mt-2">Stay tuned for our latest publications.</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                @foreach ($posts as $post)
                    <div class="group bg-card p-6 rounded-lg shadow-md hover:shadow-xl transition-shadow duration-300 border border-border flex flex-col">
                        <a href="/post/{{ $post->slug }}" class="block mb-3">
                            <div class="h-64 rounded-md overflow-hidden shadow-md">
                                <img src="{{ $post->image ? asset('storage/' . $post->image) : 'https://placehold.co/800x600/9ca3af/f1f5f9?text=Post' }}" 
                                        alt="{{ $post->title }}" 
                                        class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-500">
                            </div>
                        </a>
                        @if($post->category)
                        <a href="/blog?category={{ $post->category->slug }}" class="text-xs font-semibold text-primary hover:underline uppercase tracking-wider">{{ $post->category->name }}</a>
                        @endif
                        <h3 class="text-2xl font-bold text-text mt-2 mb-3">
                            <a href="/post/{{ $post->slug }}" class="hover:text-primary transition-colors duration-300">{{ $post->title }}</a>
                        </h3>
                        <p class="text-muted leading-relaxed mb-4">
                            {{ Str::limit(strip_tags($post->body), 150) }}
                        </p>
                        <div class="flex justify-between items-center mt-auto pt-4 border-t border-border/50">
                            <span class="text-sm text-light-text">{{ $post->created_at->format('M d, Y') }}</span>
                            <a href="/post/{{ $post->slug }}" class="inline-flex items-center text-sm font-semibold text-primary transition-all duration-300 ease-in-out group-hover:bg-primary group-hover:text-white group-hover:px-3 group-hover:py-1 group-hover:rounded-full">
                                Read More <i class="fas fa-arrow-right ml-1.5 transition-transform duration-300 group-hover:translate-x-1"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

            <!-- Pagination -->
            <div class="mt-20">
                {{ $posts->links() }}
            </div>
    </div>
</x-layout>
