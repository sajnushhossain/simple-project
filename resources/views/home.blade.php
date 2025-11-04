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
        $rightGrid = $posts->splice(0, 4);
        $belowFeatured = $posts->splice(0, 2);
        $threeColumn = $posts->splice(0, 3);
        $moreNews = $posts->splice(0, 6);
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
                                    width="900" height="506">
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
                    <div class="grid grid-cols-2 gap-4 mb-8">
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

                    <!-- Compact List Below Grid -->
                    <div class="mt-4 space-y-4 border-t border-border-light pt-6">
                        <!-- <h3 class="font-serif text-xl text-dark-text mb-4">Latest from the Grid</h3> -->
                        @foreach($moreNews->take(5) as $post)
                        <article class="border-b border-border-light pb-4 last:border-b-0">
                            <a href="/post/{{ $post->slug }}" class="block group">
                                <h5
                                    class="font-serif text-base text-dark-text leading-tight mb-1 group-hover:text-primary-red transition-colors line-clamp-2">
                                    {{ $post->title }}
                                </h5>
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
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8 border-t border-border-light pt-8">
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
            @foreach($categories->take(4) as $category)
            @if($category->posts->isNotEmpty())
            <section class="mb-8 border-t border-border-light pt-8">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="font-serif text-3xl text-dark-text leading-tight">
                        {{ $category->name }}
                    </h2>
                    <a href="/blog?category={{ $category->slug }}"
                        class="text-base text-primary-red hover:underline font-semibold">
                        View All →
                    </a>
                </div>

                <!-- First Post: Large with Image -->
                @php
                $firstPost = $category->posts->first();
                $remainingPosts = $category->posts->slice(1, 2);
                @endphp

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <div class="lg:col-span-2">
                        <article class="bg-card-background p-3 rounded-lg shadow-sm">
                            <a href="/post/{{ $firstPost->slug }}" class="block group">
                                <div class="relative overflow-hidden mb-4 aspect-video">
                                    <img src="{{ $firstPost->image ? asset('storage/' . $firstPost->image) : 'https://images.unsplash.com/photo-1758691737246-95bf8f09a997?crop=entropy&cs=srgb&fm=jpg&q=85&w=600' }}"
                                        alt="{{ $firstPost->title }}"
                                        class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105"
                                        width="600" height="337">
                                </div>
                                <h3
                                    class="font-serif text-l text-dark-text mb-2 group-hover:text-primary-red transition-colors leading-tight">
                                    {{ $firstPost->title }}
                                </h3>
                                <p class="text-base text-light-text mb-3 line-clamp-3">
                                    {{ Str::limit(strip_tags($firstPost->body), 150) }}
                                </p>
                                <div class="text-sm text-light-text">
                                    {{ $firstPost->created_at->diffForHumans() }}
                                </div>
                            </a>
                        </article>
                    </div>

                    <div class="lg:col-span-1 space-y-6">
                        @foreach($remainingPosts as $post)
                        <article class="flex gap-4 pb-6 border-b border-border-light last:border-b-0">
                            <div class="flex-shrink-0 w-20 h-20">
                                <a href="/post/{{ $post->slug }}">
                                    <img src="{{ $post->image ? asset('storage/' . $post->image) : 'https://images.unsplash.com/photo-1745104172230-42630f9b75d4?crop=entropy&cs=srgb&fm=jpg&q=85&w=200' }}"
                                        alt="{{ $post->title }}" class="w-full h-full object-cover" width="80"
                                        height="80">
                                </a>
                            </div>
                            <div class="flex-1 min-w-0">
                                <a href="/post/{{ $post->slug }}" class="block group">
                                    <h4
                                        class="font-serif text-base text-dark-text mb-1 group-hover:text-primary-red transition-colors line-clamp-3 leading-tight">
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
                </div>
            </section>
            @endif
            @endforeach

            <!-- More News Grid -->
            @if($moreNews->count() > 4)
            <section class="mb-8 border-t border-border-light pt-8">
                <h2 class="font-serif text-3xl text-dark-text mb-6 leading-tight">More News</h2>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    @foreach($moreNews->slice(4) as $post)
                    <article class="bg-card-background p-4 rounded-lg shadow-sm">
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
            <section class="mb-8 border-t border-border-light pt-8">
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
            </section>
            @endif
        </div>
        @endif
    </div>
</x-layout>