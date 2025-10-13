<x-layout :posts="$posts">
    <div class="container mx-auto px-4 pt-10">
        <!-- Search Header -->
        <div class="text-center mb-12">
            <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-primary/10 mb-4">
                <i class="fas fa-search text-primary text-3xl"></i>
            </div>
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                Search Results
            </h1>
            <p class="text-xl text-muted">
                Found <span class="text-primary font-bold">{{ $posts->total() }}</span> result{{ $posts->total() !== 1 ? 's' : '' }} for 
                <span class="text-gray-900 font-semibold">"{{ $query }}"</span>
            </p>
        </div>

        @if($posts->count() === 0)
            <div class="text-center py-20">
                <div class="inline-flex items-center justify-center w-32 h-32 rounded-full bg-surface-2 mb-6">
                    <i class="fas fa-search text-muted text-6xl"></i>
                </div>
                <h2 class="text-3xl font-bold text-gray-900 mb-4">No Results Found</h2>
                <p class="text-muted text-lg mb-8 max-w-md mx-auto">
                    We couldn't find any articles matching "{{ $query }}". Try different keywords or browse our latest articles.
                </p>
                <a href="/blog" class="btn-primary inline-flex items-center">
                    <i class="fas fa-newspaper mr-2"></i>
                    Browse All Articles
                </a>
            </div>
        @else
            <!-- Search Results Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                @foreach ($posts as $post)
                    <div class="post-card group">
                        <a href="/post/{{ $post->slug }}" class="block">
                            <div class="relative overflow-hidden">
                                <img src="{{ $post->image ? asset('storage/' . $post->image) : 'https://placehold.co/750x300/1e293b/94a3b8?text=Article' }}" 
                                     alt="{{ $post->title }}" 
                                     class="w-full h-56 object-cover transition-transform duration-500 group-hover:scale-110">
                                @if($post->category)
                                <div class="absolute top-4 left-4">
                                    <span class="bg-primary/90 text-white text-xs font-bold px-3 py-1 rounded-full backdrop-blur-sm">
                                        {{ $post->category->name }}
                                    </span>
                                </div>
                                @endif
                            </div>
                        </a>
                        <div class="p-5">
                                                            <a href="/post/{{ $post->slug }}" class="text-xl font-bold text-gray-900 hover:text-primary transition-colors duration-300 block mb-3">
                                {{ $post->title }}
                            </a>
                            <p class="text-muted text-sm leading-relaxed mb-4">
                                {{ Str::limit(strip_tags($post->body), 130) }}
                            </p>
                            <div class="flex items-center justify-between">
                                <span class="text-muted text-sm">
                                    <i class="far fa-clock mr-1"></i>{{ $post->created_at->diffForHumans() }}
                                </span>
                                <span class="text-primary font-semibold group-hover:underline inline-flex items-center">
                                    Read More
                                    <i class="fas fa-arrow-right ml-1 group-hover:ml-2 transition-all duration-300"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-12">
                {{ $posts->appends(['query' => $query])->links('vendor.pagination.tailwind') }}
            </div>
        @endif
    </div>
</x-layout>