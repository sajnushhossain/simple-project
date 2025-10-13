<x-layout :posts="$posts">
    <div class="bg-[#f8f5f0] font-serif text-[#333]">
        <div class="container mx-auto px-4 py-12">

            <!-- Page Header -->
            <div class="text-center mb-12 border-b-2 border-gray-400 pb-8">
                <h1 class="text-6xl md:text-8xl font-black text-gray-400 tracking-tighter leading-none mb-2">All News</h1>
                
            </div>

            @if($posts->count() === 0)
                <div class="text-center py-24">
                    <i class="far fa-newspaper text-7xl text-gray-300 mb-8"></i>
                    <p class="text-center text-gray-500 text-2xl font-semibold">No articles found.</p>
                    <p class="text-center text-gray-400 mt-2">Stay tuned for our latest publications.</p>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                    @foreach ($posts as $post)
                        <div class="group bg-white p-6 rounded-lg shadow-md hover:shadow-xl transition-shadow duration-300">
                            <a href="/post/{{ $post->slug }}" class="block mb-3">
                                <div class="aspect-w-4 aspect-h-3">
                                    <img src="{{ $post->image ? asset('storage/' . $post->image) : 'https://placehold.co/800x600/9ca3af/f1f5f9?text=Post' }}" 
                                            alt="{{ $post->title }}" 
                                            class="w-full h-full object-cover rounded-md shadow-md transform group-hover:scale-105 transition-transform duration-500">
                                </div>
                            </a>
                            @if($post->category)
                            <a href="#" class="text-xs font-semibold text-red-700 hover:underline uppercase tracking-wider">{{ $post->category->name }}</a>
                            @endif
                            <h3 class="text-2xl font-bold text-gray-900 mt-2 mb-3">
                                <a href="/post/{{ $post->slug }}" class="hover:text-red-700 transition-colors duration-300">{{ $post->title }}</a>
                            </h3>
                            <p class="text-gray-600 leading-relaxed mb-4">
                                {{ Str::limit(strip_tags($post->body), 150) }}
                            </p>
                            <div class="text-sm text-gray-500">
                                <span>{{ $post->created_at->format('M d, Y') }}</span>
                                <span class="mx-2">&bull;</span>
                                <a href="/post/{{ $post->slug }}" class="text-red-700 hover:underline font-semibold">Read More</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

                <!-- Pagination -->
                <div class="mt-20">
                    {{ $posts->links('vendor.pagination.tailwind') }}
                </div>
        </div>
    </div>
</x-layout>
