<x-layout :posts="$posts">
    <div class="container mx-auto px-4 py-8">
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
             <div class="text-center mb-12 border-b-2 border-gray-400 pb-8">
                <h1 class="text-6xl md:text-8xl font-black text-gray-900 tracking-tighter leading-none mb-2">The Simple News</h1>
                <p class="text-gray-600 text-lg max-w-3xl mx-auto">
                    Your Trusted Source for In-depth Reporting and Analysis
                </p>
            </div>
            <div class="newspaper-layout">
                <div class="lead-story mb-8">
                    <a href="/post/{{ $lead->slug }}" class="block mb-8">
                        <img class="w-full h-auto object-cover rounded-lg shadow-lg mb-4" src="{{ $lead->image ? asset('storage/' . $lead->image) : 'https://placehold.co/1200x600/1e293b/94a3b8?text=Lead+Story' }}" alt="{{ $lead->title }}">
                        <h1 class="text-4xl md:text-6xl font-bold text-gray-900 hover:text-sky-600 transition duration-300">{{ $lead->title }}</h1>
                        <p class="text-gray-600 mt-4 text-xl">{{ Str::limit(strip_tags($lead->body), 300) }}</p>
                    </a>
                    <hr class="my-8">
                </div>

                @foreach($subLeads as $post)
                    <div class="mb-6 pb-6 border-b">
                        <a href="/post/{{ $post->slug }}">
                            <img class="w-full h-48 object-cover rounded-lg mb-3" src="{{ $post->image ? asset('storage/' . $post->image) : 'https://placehold.co/400x250/1e293b/94a3b8?text=Sub+Lead' }}" alt="{{ $post->title }}">
                            <h3 class="text-2xl font-semibold text-gray-800 hover:text-sky-600 transition duration-300">{{ $post->title }}</h3>
                            <p class="text-gray-600 mt-2">{{ Str::limit(strip_tags($post->body), 150) }}</p>
                        </a>
                    </div>
                @endforeach

                @foreach($topStories as $post)
                    <div class="border-b py-4">
                        <a href="/post/{{ $post->slug }}">
                            <h3 class="text-xl font-semibold text-gray-800 hover:text-sky-600 transition duration-300">{{ $post->title }}</h3>
                            <p class="text-gray-600 mt-2">{{ Str::limit(strip_tags($post->body), 100) }}</p>
                        </a>
                    </div>
                @endforeach
            </div>

            {{-- More News Section --}}
            <section class="my-12">
                <h2 class="section-title">More News</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    @foreach($moreNews as $post)
                        <div>
                            <a href="/post/{{ $post->slug }}">
                                <img class="w-full h-48 object-cover rounded-lg shadow-md" src="{{ $post->image ? asset('storage/' . $post->image) : 'https://placehold.co/300x200/1e293b/94a3b8?text=News' }}" alt="{{ $post->title }}">
                                <h3 class="text-lg font-semibold mt-3 text-gray-800 hover:text-sky-600 transition duration-300">{{ $post->title }}</h3>
                            </a>
                        </div>
                    @endforeach
                </div>
            </section>

            {{-- Categorized News --}}
            @foreach($categories as $category)
                @if($category->posts->count() > 0)
                    <section class="my-12">
                        <h2 class="section-title">{{ $category->name }}</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                            @foreach($category->posts->take(4) as $post)
                                <div>
                                    <a href="/post/{{ $post->slug }}">
                                        <img class="w-full h-48 object-cover rounded-lg shadow-md" src="{{ $post->image ? asset('storage/' . $post->image) : 'https://placehold.co/300x200/1e293b/94a3b8?text=News' }}" alt="{{ $post->title }}">
                                        <h3 class="text-lg font-semibold mt-3 text-gray-800 hover:text-sky-600 transition duration-300">{{ $post->title }}</h3>
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