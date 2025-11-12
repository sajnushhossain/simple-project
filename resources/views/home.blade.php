<x-layout>
    <div class="font-sans">
        @if($posts->isEmpty())
        <div class="container mx-auto px-4 py-20 text-center">
            <div class="max-w-md mx-auto">
                <i class="fas fa-newspaper text-6xl text-gray-300 mb-4"></i>
                <h2 class="text-3xl font-bold mb-4 text-gray-900">No Posts Yet</h2>
                <p class="text-gray-600">Check back later for the latest news and updates.</p>
            </div>
        </div>
        @else
        @php
        $featured = $posts->shift();
        $belowFeatured = $posts->splice(0, 2);
        $rightGrid = $posts->splice(0, 8);
        $threeColumn = $posts->splice(0, 3);
        $moreNews = $posts->splice(0, 11);
        @endphp

        <!-- Main Content Container -->
        <div class="max-w-screen-xl mx-auto px-4 py-4">

            <!-- Top Section: Featured Story (Left) + 2x2 Grid (Right) -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">

                <!-- Left: Featured Story -->
                <div class="lg:col-span-2">
                    <article class="bg-card-background p-4 rounded-lg shadow-sm">
                        <a href="/post/{{ $featured->slug }}" class="block group">
                            <div class="relative overflow-hidden mb-4 aspect-video">
                                <img src="{{ $featured->image ? asset('storage/' . $featured->image) : 'https://images.unsplash.com/photo-1742805382149-3c2f0cd0f300?crop=entropy&cs=srgb&fm=jpg&q=85&w=900' }}"
                                    alt="{{ $featured->title }}"
                                    class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105"
                                    width="900" height="400">
                            </div>
                            <h1
                                class="font-serif text-3xl md:text-4xl text-dark-text mb-2 group-hover:text-primary-red transition-colors leading-tight">
                                {{ $featured->title }}
                            </h1>
                            <p class="text-light-text text-base leading-relaxed mb-3">
                                {{ Str::limit(strip_tags($featured->body), 200) }}
                            </p>
                            <div class="text-sm text-light-text">
                                {{ $featured->created_at->diffForHumans() }}
                            </div>
                        </a>
                    </article>

                    <!-- Two Stories Below Featured -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
                        @foreach($belowFeatured as $post)
                        <article class="bg-card-background p-4 rounded-lg shadow-sm">
                            <a href="/post/{{ $post->slug }}" class="block group">
                                <div class="relative overflow-hidden mb-3 aspect-video">
                                    <img src="{{ $post->image ? asset('storage/' . $post->image) : 'https://images.unsplash.com/photo-1615914143778-1a1a6e50c5dd?crop=entropy&cs=srgb&fm=jpg&q=85&w=500' }}"
                                        alt="{{ $post->title }}"
                                        class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105"
                                        width="500" height="281">
                                </div>
                                <h3
                                    class="font-serif text-xl text-dark-text mb-2 group-hover:text-primary-red transition-colors leading-tight">
                                    {{ $post->title }}
                                </h3>
                                <p class="text-sm text-light-text mb-2 line-clamp-2">
                                    {{ Str::limit(strip_tags($post->body), 100) }}
                                </p>
                                <div class="text-xs text-light-text">
                                    {{ $post->created_at->diffForHumans() }}
                                </div>
                            </a>
                        </article>
                        @endforeach
                    </div>
                </div>

                <!-- Right: 2x2 Thumbnail Grid -->
                <div class="lg:col-span-1">
                    <div class="grid grid-cols-2 gap-4">
                        @foreach($rightGrid as $post)
                        <article class="bg-card-background p-3 rounded-lg shadow-sm">
                            <a href="/post/{{ $post->slug }}" class="block group">
                                <div class="relative overflow-hidden mb-2 aspect-square">
                                    <img src="{{ $post->image ? asset('storage/' . $post->image) : 'https://images.unsplash.com/photo-1553047503-9596d9494389?crop=entropy&cs=srgb&fm=jpg&q=85&w=300' }}"
                                        alt="{{ $post->title }}"
                                        class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105"
                                        width="300" height="300">
                                </div>
                                <h4
                                    class="font-serif text-base text-dark-text leading-tight mb-1 group-hover:text-primary-red transition-colors line-clamp-3">
                                    {{ $post->title }}
                                </h4>
                                <div class="text-xs text-light-text">
                                    {{ $post->created_at->diffForHumans() }}
                                </div>
                            </a>
                        </article>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Three Column Section -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8 pt-8">
                @foreach($threeColumn as $post)
                <article class="bg-card-background p-4 rounded-lg shadow-sm">
                    <a href="/post/{{ $post->slug }}" class="block group">
                        <div class="relative overflow-hidden mb-3 aspect-video">
                            <img src="{{ $post->image ? asset('storage/' . $post->image) : 'https://images.unsplash.com/photo-1760174083916-ea7d00664d58?crop=entropy&cs=srgb&fm=jpg&q=85&w=500' }}"
                                alt="{{ $post->title }}"
                                class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105"
                                width="500" height="281">
                        </div>
                        <h3
                            class="font-serif text-xl text-dark-text mb-2 group-hover:text-primary-red transition-colors leading-tight">
                            {{ $post->title }}
                        </h3>
                        <p class="text-sm text-light-text mb-2 line-clamp-2">
                            {{ Str::limit(strip_tags($post->body), 100) }}
                        </p>
                        <div class="text-xs text-light-text">
                            {{ $post->created_at->diffForHumans() }}
                        </div>
                    </a>
                </article>
                @endforeach
            </div>

            <!-- Category Sections -->
            @include('components.newspaper-layout', ['categories' => $categories->take(3)])

            <!-- More News Grid -->
            @if($moreNews->count() > 0)
            <section class="mb-8 border-t border-border-light pt-8">
                <h2 class="font-serif text-3xl text-dark-text mb-6 leading-tight">More News</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    @foreach($moreNews as $index => $post)
                    <article
                        class="bg-card-background p-4 rounded-lg shadow-sm {{ $index === 0 ? 'lg:col-span-2' : '' }}">
                        <a href="/post/{{ $post->slug }}" class="block group">
                            <div class="relative overflow-hidden mb-3 aspect-video">
                                <img src="{{ $post->image ? asset('storage/' . $post->image) : 'https://images.unsplash.com/photo-1551292083-5d458a10336d?crop=entropy&cs=srgb&fm=jpg&q=85&w=400' }}"
                                    alt="{{ $post->title }}"
                                    class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105"
                                    width="400" height="225">
                            </div>
                            <h4
                                class="font-serif text-xl text-dark-text leading-tight mb-2 group-hover:text-primary-red transition-colors line-clamp-3">
                                {{ $post->title }}
                            </h4>
                            <p class="text-light-text text-base leading-relaxed mb-3">
                                {{ Str::limit(strip_tags($featured->body), 100) }}
                            </p>
                            <div class="text-xs text-light-text">
                                {{ $post->created_at->diffForHumans() }}
                            </div>
                        </a>
                    </article>
                    @endforeach
                </div>
            </section>
            @endif

            <!-- Compact News List -->
            @if($posts->count() > 0)
            <!-- <section class="mb-8 border-t border-border-light pt-8">
                <h2 class="font-serif text-3xl text-dark-text mb-6 leading-tight">Latest Updates</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-6">
                    @foreach($posts->take(12) as $post)
                    <article class="flex gap-4 pb-6 border-b border-border-light last:border-b-0">
                        <div class="flex-shrink-0 w-28 h-28">
                            <a href="/post/{{ $post->slug }}">
                                <img src="{{ $post->image ? asset('storage/' . $post->image) : 'https://images.unsplash.com/photo-1758998427861-13d773010612?crop=entropy&cs=srgb&fm=jpg&q=85&w=200' }}"
                                    alt="{{ $post->title }}" class="w-full h-full object-cover" width="112"
                                    height="112">
                            </a>
                        </div>
                        <div class="flex-1 min-w-0">
                            <a href="/post/{{ $post->slug }}" class="block group">
                                <h4
                                    class="font-serif text-lg text-dark-text mb-1 group-hover:text-primary-red transition-colors line-clamp-3 leading-tight">
                                    {{ $post->title }}
                                </h4>
                                <div class="text-xs text-light-text">
                                    {{ $post->created_at->diffForHumans() }}
                                </div>
                            </a>
                        </div>
                    </article>
                    @endforeach
                </div>
            </section> -->
            @endif
        </div>
        @endif
    </div>
</x-layout>