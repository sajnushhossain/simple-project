<x-layout :posts="$posts">
    <div class="container mx-auto px-4 pt-10">
        <!-- Page Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 leading-tight mb-4">Latest News</h1>
            <p class="text-muted text-lg max-w-2xl mx-auto">
                Stay updated with the latest stories, breaking news, and trending topics from around the world.
            </p>
        </div>

        @if($posts->count() === 0)
            <div class="text-center py-20">
                <i class="fas fa-newspaper text-6xl text-muted mb-6"></i>
                <p class="text-center text-muted text-xl">No posts available at the moment.</p>
                <p class="text-center text-muted">Check back later for the latest news.</p>
            </div>
        @else
            @php
                $lead = $posts->first();
                $rest = $posts->slice(1);
            @endphp

            <!-- Featured Post -->
            <div class="mb-16">
                <div class="relative img-zoom-container rounded-xl overflow-hidden shadow-2xl group">
                    <a href="/post/{{ $lead->slug }}" class="block">
                        <img src="{{ $lead->image ? asset('storage/' . $lead->image) : 'https://placehold.co/1200x600/1e293b/94a3b8?text=Featured+Article' }}" 
                             alt="{{ $lead->title }}" 
                             class="w-full h-[600px] object-cover img-zoom">
                        <div class="absolute inset-0 gradient-overlay"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-10">
                            <span class="inline-block bg-primary text-white text-sm font-bold px-4 py-2 rounded-full mb-4">
                                <i class="fas fa-star mr-1"></i>FEATURED ARTICLE
                            </span>
                            <h2 class="text-5xl md:text-6xl font-bold text-white drop-shadow-lg mb-4 group-hover:text-primary transition-colors duration-300">
                                {{ $lead->title }}
                            </h2>
                            <p class="text-gray-100 text-xl drop-shadow-md mb-4 max-w-3xl">
                                {{ Str::limit(strip_tags($lead->body), 200) }}
                            </p>
                            <div class="flex items-center gap-6 text-gray-300">
                                <span class="flex items-center">
                                    <i class="far fa-clock mr-2"></i>
                                    {{ $lead->created_at->diffForHumans() }}
                                </span>
                                @if($lead->category)
                                <span class="flex items-center">
                                    <i class="fas fa-tag mr-2"></i>
                                    {{ $lead->category->name }}
                                </span>
                                @endif
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <!-- All Posts Grid -->
            <div class="mb-12">
                <div class="flex items-center mb-8">
                    <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-0">All Articles</h2>
                    <div class="flex-1 h-1 bg-gradient-to-r from-primary to-transparent ml-4 rounded"></div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($rest as $post)
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
                            <div class="p-6">
                                <a href="/post/{{ $post->slug }}" class="text-xl font-bold text-gray-900 hover:text-primary transition-colors duration-300 block mb-3">
                                    {{ $post->title }}
                                </a>
                                <p class="text-muted text-base leading-relaxed mb-4">
                                    {{ Str::limit(strip_tags($post->body), 120) }}
                                </p>
                                <div class="flex items-center justify-between">
                                    <span class="text-muted text-sm">
                                        <i class="far fa-clock mr-1"></i>{{ $post->created_at->diffForHumans() }}
                                    </span>
                                    <a href="/post/{{ $post->slug }}" class="text-primary font-semibold hover:underline inline-flex items-center group">
                                        Read More
                                        <i class="fas fa-arrow-right ml-1 group-hover:ml-2 transition-all duration-300"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                @endforeach
                </div>
            </div>

            <!-- Pagination -->
            <div class="mt-12">
                {{ $posts->links('vendor.pagination.tailwind') }}
            </div>
        @endif
    </div>
</x-layout>