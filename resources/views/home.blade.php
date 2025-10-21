<x-layout>
    @push('head')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400..700;1,400..700&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap"
        rel="stylesheet">
    @endpush

    <div class="container mx-auto px-4">
        @if($posts->isEmpty())
        <div class="text-center py-20">
            <h2 class="text-3xl font-bold mb-4 text-gray-900">No Posts Yet</h2>
            <p class="text-gray-600">Check back later for the latest news.</p>
        </div>
        @else
        @php
        $lead = $posts->shift();
        $subLeads = $posts->splice(0, 2);
        $topStories = $posts->splice(0, 6);
        $moreNews = $posts->splice(0, 4);
        @endphp



        <!-- header -->
        <div class="text-center mb-12 border-b-2 border-border pb-8">
            <h1 class="text-5xl sm:text-6xl md:text-8xl font-black text-text tracking-tighter leading-none mb-2 newspaper-title">The
                Simple News</h1>
            <p class="text-muted text-lg max-w-3xl mx-auto">
                Your Trusted Source for In-depth Reporting and Analysis
            </p>
        </div>

        <div class="newspaper-layout">
            <div class="lead-story mb-8">
                <a href="/post/{{ $lead->slug }}" class="block mb-8">
                    <img class="w-full h-auto object-cover rounded-lg shadow-lg mb-4"
                        src="{{ $lead->image ? asset('storage/' . $lead->image) : 'https://placehold.co/1200x600/1e293b/94a3b8?text=Lead+Story' }}"
                        alt="{{ $lead->title }}">
                    <h1 class="text-3xl sm:text-4xl md:text-6xl font-bold text-text hover:text-primary transition duration-300">
                        {{ $lead->title }}</h1>
                    <p class="text-muted mt-4 text-xl">{{ Str::limit(strip_tags($lead->body), 300) }}</p>
                </a>
                <hr class="my-8">
            </div>

            @foreach($subLeads as $post)
            <div class="mb-6 pb-6 border-b border-border">
                <a href="/post/{{ $post->slug }}">
                    <div class="h-48 sm:h-64 rounded-md overflow-hidden shadow-md mb-4">
                        <img class="w-full h-full object-cover"
                            src="{{ $post->image ? asset('storage/' . $post->image) : 'https://placehold.co/400x250/1e293b/94a3b8?text=Sub+Lead' }}"
                            alt="{{ $post->title }}">
                    </div>
                    <h3 class="text-2xl font-semibold text-text hover:text-primary transition duration-300">
                        {{ $post->title }}</h3>
                    <p class="text-muted mt-2">{{ Str::limit(strip_tags($post->body), 150) }}</p>
                </a>
            </div>
            @endforeach

            @foreach($topStories as $post)
            <div class="border-b border-border py-4">
                <a href="/post/{{ $post->slug }}">
                    <h3 class="text-xl font-semibold text-text hover:text-primary transition duration-300">
                        {{ $post->title }}</h3>
                    <p class="text-muted mt-2">{{ Str::limit(strip_tags($post->body), 100) }}</p>
                </a>
            </div>
            @endforeach
        </div>

        {{-- More News Section --}}
        <section class="my-12 pt-8 border-t border-border">
            <h2 class="section-title">More News</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($moreNews as $post)
                <div
                    class="group bg-card p-4 rounded-lg shadow-md hover:shadow-xl transition-shadow duration-300 border border-border">
                    <a href="/post/{{ $post->slug }}" class="block">
                        <div class="h-64 rounded-md overflow-hidden shadow-md mb-4">
                            <img class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-500"
                                src="{{ $post->image ? asset('storage/' . $post->image) : 'https://placehold.co/300x200/1e293b/94a3b8?text=News' }}"
                                alt="{{ $post->title }}">
                        </div>
                        <h3
                            class="text-lg font-semibold text-text group-hover:text-primary transition-colors duration-300">
                            {{ $post->title }}</h3>
                    </a>
                </div>
                @endforeach
            </div>
        </section>



        {{-- Categorized News --}}
        @foreach($categories as $category)
        @if($category->posts->isNotEmpty())
        <section class="my-12 pt-8 border-t border-border">
            <h2 class="section-title">{{ $category->name }}</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($category->posts as $post)
                <div
                    class="group bg-card p-4 rounded-lg shadow-md hover:shadow-xl transition-shadow duration-300 border border-border">
                    <a href="/post/{{ $post->slug }}" class="block">
                        <div class="h-64 rounded-md overflow-hidden shadow-md mb-4">
                            <img class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-500"
                                src="{{ $post->image ? asset('storage/' . $post->image) : 'https://placehold.co/300x200/1e293b/94a3b8?text=News' }}"
                                alt="{{ $post->title }}">
                        </div>
                        <h3
                            class="text-lg font-semibold text-text group-hover:text-primary transition-colors duration-300">
                            {{ $post->title }}</h3>
                    </a>
                </div>
                @endforeach
            </div>
        </section>
        @endif
        @endforeach
        @endif
    </div>
</x-layout>