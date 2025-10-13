<x-layout :posts="$posts">
    <div class="container mx-auto px-4 pt-10">
        @if($posts->isEmpty())
            <div class="text-center py-20">
                <h2 class="text-3xl font-bold mb-4 text-gray-900">No Posts Yet</h2>
                <p class="text-gray-600">Check back later for the latest news.</p>
            </div>
        @else
            @php
                $lead = $posts->first();
                $topStories = $posts->slice(1, 2);
                $latestLeft = $posts->slice(3, 5);
                $trending = $posts->slice(8, 4);
                $more = $posts->slice(12);
            @endphp

            <!-- Hero Section -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-12">
                <div class="lg:col-span-2">
                    @if($lead)
                        <div class="relative img-zoom-container rounded-xl overflow-hidden shadow-2xl group">
                            <a href="/post/{{ $lead->slug }}" class="block">
                                <img src="{{ $lead->image ? asset('storage/' . $lead->image) : 'https://placehold.co/1200x600/1e293b/94a3b8?text=Featured+Story' }}" 
                                     alt="{{ $lead->title }}" 
                                     class="w-full h-[500px] object-cover img-zoom">
                                <div class="absolute inset-0 gradient-overlay"></div>
                                <div class="absolute bottom-0 left-0 right-0 p-8">
                                    <span class="inline-block bg-primary text-white text-xs font-bold px-3 py-1 rounded-full mb-3">FEATURED</span>
                                    <h2 class="text-4xl md:text-5xl font-bold text-white drop-shadow-lg mb-3 group-hover:text-primary transition-colors duration-300">
                                        {{ $lead->title }}
                                    </h2>
                                    <p class="text-gray-100 text-lg drop-shadow-md">{{ Str::limit(strip_tags($lead->body), 150) }}</p>
                                    <div class="flex items-center mt-4 text-gray-300 text-sm">
                                        <i class="far fa-clock mr-2"></i>
                                        <span>{{ $lead->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endif
                </div>
                <div class="space-y-4">
                    @foreach($topStories as $post)
                        <div class="post-card group">
                            <a href="/post/{{ $post->slug }}" class="block">
                                <div class="relative overflow-hidden">
                                    <img src="{{ $post->image ? asset('storage/' . $post->image) : 'https://placehold.co/750x450/1e293b/94a3b8?text=Story' }}" 
                                         alt="{{ $post->title }}" 
                                         class="w-full h-48 object-cover transition-transform duration-500 group-hover:scale-110">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                                </div>
                                <div class="p-5">
                                    <h3 class="text-lg font-bold text-gray-900 group-hover:text-primary transition-colors duration-300">
                                        {{ $post->title }}
                                    </h3>
                                    <p class="text-muted text-sm mt-2">
                                        <i class="far fa-clock mr-1"></i>{{ $post->created_at->diffForHumans() }}
                                    </p>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Latest News -->
            <div class="mb-12">
                <div class="flex items-center mb-6">
                    <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-0">Latest News</h2>
                    <div class="flex-1 h-1 bg-gradient-to-r from-primary to-transparent ml-4 rounded"></div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($latestLeft as $post)
                        <div class="post-card group">
                            <a href="/post/{{ $post->slug }}" class="block">
                                <div class="relative overflow-hidden">
                                    <img src="{{ $post->image ? asset('storage/' . $post->image) : 'https://placehold.co/750x450/1e293b/94a3b8?text=News' }}" 
                                         alt="{{ $post->title }}" 
                                         class="w-full h-56 object-cover transition-transform duration-500 group-hover:scale-110">
                                    <div class="absolute top-4 left-4">
                                        <span class="bg-primary/90 text-white text-xs font-bold px-3 py-1 rounded-full backdrop-blur-sm">
                                            {{ $post->category->name ?? 'News' }}
                                        </span>
                                    </div>
                                </div>
                                <div class="p-5">
                                    <h3 class="text-xl font-bold text-gray-900 group-hover:text-primary transition-colors duration-300 mb-3">
                                        {{ $post->title }}
                                    </h3>
                                    <p class="text-muted text-sm leading-relaxed mb-3">
                                        {{ Str::limit(strip_tags($post->body), 100) }}
                                    </p>
                                    <div class="flex items-center justify-between text-sm">
                                        <span class="text-muted">
                                            <i class="far fa-clock mr-1"></i>{{ $post->created_at->diffForHumans() }}
                                        </span>
                                        <span class="text-primary font-semibold group-hover:underline">
                                            Read more <i class="fas fa-arrow-right ml-1"></i>
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Trending -->
            <div class="mb-12">
                <div class="flex items-center mb-6">
                    <i class="fas fa-fire text-primary text-3xl mr-3"></i>
                    <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-0">Trending Now</h2>
                    <div class="flex-1 h-1 bg-gradient-to-r from-primary to-transparent ml-4 rounded"></div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($trending as $post)
                        <div class="post-card group">
                            <a href="/post/{{ $post->slug }}" class="block">
                                <div class="relative overflow-hidden">
                                    <img src="{{ $post->image ? asset('storage/' . $post->image) : 'https://placehold.co/750x450/1e293b/94a3b8?text=Trending' }}" 
                                         alt="{{ $post->title }}" 
                                         class="w-full h-44 object-cover transition-transform duration-500 group-hover:scale-110">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent"></div>
                                </div>
                                <div class="p-4">
                                    <h3 class="text-base font-bold text-gray-900 group-hover:text-primary transition-colors duration-300 line-clamp-2">
                                        {{ $post->title }}
                                    </h3>
                                    <p class="text-muted text-xs mt-2">
                                        <i class="far fa-clock mr-1"></i>{{ $post->created_at->diffForHumans() }}
                                    </p>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- More to Read -->
            <div class="more-news mt-16">
                <div class="flex items-center justify-center mb-8">
                    <div class="flex-1 h-1 bg-gradient-to-r from-transparent to-primary rounded"></div>
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 px-6">More to Read</h2>
                    <div class="flex-1 h-1 bg-gradient-to-l from-transparent to-primary rounded"></div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    @foreach($more as $post)
                        <div class="post-card group">
                            <a href="/post/{{ $post->slug }}" class="block">
                                <div class="relative overflow-hidden">
                                    <img src="{{ $post->image ? asset('storage/' . $post->image) : 'https://placehold.co/750x450/1e293b/94a3b8?text=Article' }}" 
                                         alt="{{ $post->title }}" 
                                         class="w-full h-48 object-cover transition-transform duration-500 group-hover:scale-110">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                </div>
                            </a>
                            <div class="p-5">
                                <a href="/post/{{ $post->slug }}" class="text-lg font-bold text-gray-900 hover:text-primary transition duration-300 line-clamp-2 block mb-3">
                                    {{ $post->title }}
                                </a>
                                <p class="text-muted text-sm leading-relaxed mb-4 line-clamp-3">
                                    {{ Str::limit(strip_tags($post->body), 100) }}
                                </p>
                                <a href="/post/{{ $post->slug }}" class="inline-flex items-center text-primary font-semibold hover:underline group-hover:gap-2 transition-all duration-300">
                                    Read More 
                                    <i class="fas fa-arrow-right ml-1 group-hover:ml-2 transition-all duration-300"></i>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="text-center mt-12">
                    <a href="/blog" class="inline-flex items-center btn-primary text-lg shadow-lg hover:shadow-xl">
                        <i class="fas fa-newspaper mr-2"></i>
                        View All News
                        <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
        @endif
    </div>
</x-layout>