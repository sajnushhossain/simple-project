<x-layout :posts="$relatedPosts">
    <div class="container mx-auto px-4 pt-10">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
            <!-- Main Post Content -->
            <main class="lg:col-span-2">
                <article class="bg-surface-2 rounded-xl overflow-hidden shadow-2xl">
                    <!-- Featured Image -->
                    <div class="relative">
                        <img class="w-full h-[500px] object-cover" 
                             src="{{ $post->image ? asset('storage/' . $post->image) : 'https://placehold.co/1200x600/1e293b/94a3b8?text=Article+Image' }}" 
                             alt="{{ $post->title }}">
                        <div class="absolute inset-0 bg-gradient-to-t from-surface-2 via-transparent to-transparent"></div>
                    </div>

                    <!-- Content -->
                    <div class="p-8 md:p-12">
                        <!-- Category Badge -->
                        @if($post->category)
                        <span class="inline-block bg-primary text-white text-sm font-bold px-4 py-2 rounded-full mb-4">
                            <i class="fas fa-tag mr-1"></i>{{ $post->category->name }}
                        </span>
                        @endif

                        <!-- Title -->
                        <h1 class="text-4xl md:text-5xl font-bold mb-6 text-gray-900 leading-tight">
                            {{ $post->title }}
                        </h1>

                        <!-- Meta Information -->
                        <div class="flex flex-wrap items-center gap-6 text-muted mb-8 pb-8 border-b border-border">
                            <div class="flex items-center">
                                <i class="far fa-calendar-alt mr-2 text-primary"></i>
                                <span>{{ $post->created_at->format('F j, Y') }}</span>
                            </div>
                            <div class="flex items-center">
                                <i class="far fa-clock mr-2 text-primary"></i>
                                <span>{{ $post->created_at->diffForHumans() }}</span>
                            </div>
                            @if ($post->author)
                            <div class="flex items-center">
                                <i class="far fa-user mr-2 text-primary"></i>
                                <span>By <a href="#" class="text-primary hover:underline font-semibold">{{ $post->author->name }}</a></span>
                            </div>
                            @endif
                        </div>

                        <!-- Post Body -->
                        <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
                            {!! nl2br(e($post->body)) !!}
                        </div>

                        <!-- Share & Back Button -->
                        <div class="mt-12 pt-8 border-t border-border flex flex-wrap items-center justify-between gap-4">
                            <a href="/blog" class="inline-flex items-center px-6 py-3 bg-primary text-white font-semibold rounded-full hover:bg-primary-700 transition-all duration-300 shadow-lg hover:shadow-xl">
                                <i class="fas fa-arrow-left mr-2"></i>
                                Back to Blog
                            </a>
                            
                            <!-- Share Buttons -->
                            <div class="flex items-center gap-3">
                                <span class="text-muted font-semibold">Share:</span>
                                <a href="#" class="w-10 h-10 rounded-full bg-surface flex items-center justify-center hover:bg-primary hover:text-white transition-all duration-300">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="#" class="w-10 h-10 rounded-full bg-surface flex items-center justify-center hover:bg-primary hover:text-white transition-all duration-300">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="#" class="w-10 h-10 rounded-full bg-surface flex items-center justify-center hover:bg-primary hover:text-white transition-all duration-300">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                                <a href="#" class="w-10 h-10 rounded-full bg-surface flex items-center justify-center hover:bg-primary hover:text-white transition-all duration-300">
                                    <i class="fas fa-link"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </article>
            </main>

            <!-- Sidebar for Related Posts -->
            <aside class="lg:col-span-1">
                <div class="bg-surface-2 rounded-xl p-6 shadow-lg sticky top-24">
                    <div class="flex items-center mb-6">
                        <i class="fas fa-newspaper text-primary text-2xl mr-3"></i>
                        <h3 class="text-2xl font-bold text-gray-900">Related Stories</h3>
                    </div>
                    <div class="space-y-6">
                        @forelse($relatedPosts as $related)
                            <div class="group">
                                <a href="/post/{{ $related->slug }}" class="flex gap-4">
                                    <div class="flex-shrink-0 overflow-hidden rounded-lg">
                                        <img src="{{ $related->image ? asset('storage/' . $related->image) : 'https://placehold.co/100x70/1e293b/94a3b8?text=+' }}" 
                                             alt="{{ $related->title }}" 
                                             class="w-28 h-20 object-cover transition-transform duration-300 group-hover:scale-110">
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="text-base font-bold text-gray-900 group-hover:text-primary transition-colors duration-300 line-clamp-2 mb-2">
                                            {{ Str::limit($related->title, 70) }}
                                        </h4>
                                        <div class="flex items-center text-xs text-muted">
                                            <i class="far fa-clock mr-1"></i>
                                            {{ $related->created_at->diffForHumans() }}
                                        </div>
                                    </div>
                                </a>
                            </div>
                            @if(!$loop->last)
                            <div class="border-b border-border"></div>
                            @endif
                        @empty
                            <p class="text-muted text-center py-4">No related stories available.</p>
                        @endforelse
                    </div>
                    
                    <!-- View All Button -->
                    <div class="mt-6 pt-6 border-t border-border">
                        <a href="/blog" class="block text-center px-4 py-3 bg-primary text-white font-semibold rounded-lg hover:bg-primary-700 transition-colors duration-300">
                            View All Articles
                            <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</x-layout>