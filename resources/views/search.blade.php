<x-layout>
    <div class="container mx-auto px-4 pt-10">
        <div class="bg-white rounded-lg shadow-md p-6 mb-8">
            <form id="search-form" action="/search" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="md:col-span-2">
                    <label for="query" class="sr-only">Search by title</label>
                    <input type="text" id="query" name="query" value="{{ $query ?? '' }}"
                        placeholder="Search by title..." class="form-input w-full">
                </div>
                <div>
                    <label for="category" class="sr-only">Category</label>
                    <select id="category" name="category" class="form-select w-full">
                        <option value="">All Categories</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->slug }}" @if(request('category')===$category->slug) selected
                            @endif>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="date" class="sr-only">Date</label>
                    <input type="text" id="date" name="date" class="form-input w-full datepicker"
                        placeholder="Select a date" value="{{ request('date') }}">
                </div>
            </form>
        </div>
        <!-- Advertisement Section-->
        <x-ad-unit position="content-middle" />
        @if(isset($posts))
        @if($posts->count() === 0)
        <div class="text-center py-16">
            <div class="inline-flex items-center justify-center w-24 h-24 rounded-full bg-primary-lightest mb-6">
                <i class="fas fa-sad-tear text-primary text-5xl"></i>
            </div>
            <h2 class="text-3xl font-bold text-gray-900 mb-4">No Articles Found</h2>
            <p class="text-muted text-lg mb-8 max-w-md mx-auto">
                It seems we can't find any articles based on your search. Please try again with different keywords.
            </p>
            <a href="/blog" class="btn-primary inline-flex items-center">
                <i class="fas fa-newspaper mr-2"></i>
                Explore Our Blog
            </a>
        </div>
        @else
        <div class="mb-8">
            <p class="text-lg text-muted">
                Showing <span class="font-bold text-primary">{{ $posts->firstItem() }}-{{ $posts->lastItem() }}</span>
                of <span class="font-bold text-primary">{{ $posts->total() }}</span> results.
            </p>
        </div>
        <!-- Search Results List -->
        <div class="space-y-8 mb-12">
            @foreach ($posts as $post)
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
                <div class="md:flex">
                    <div class="md:w-1/3">
                        <a href="/post/{{ $post->slug }}" class="block h-full">
                            <img src="{{ $post->image ? asset('storage/' . $post->image) : 'https://placehold.co/750x500/1e293b/94a3b8?text=Article' }}"
                                alt="{{ $post->title }}" class="w-full h-full object-cover">
                        </a>
                    </div>
                    <div class="p-6 md:w-2/3">
                        @if($post->category)
                        <a href="/blog?category={{ $post->category->slug }}"
                            class="text-primary font-semibold text-sm hover:underline">{{ $post->category->name }}</a>
                        @endif
                        <a href="/post/{{ $post->slug }}"
                            class="block text-2xl font-bold text-gray-900 hover:text-primary transition-colors duration-300 mt-2 mb-3">
                            {{ $post->title }}
                        </a>
                        <p class="text-muted text-base leading-relaxed mb-4">
                            {{ Str::limit(strip_tags($post->body), 200) }}
                        </p>
                        <div class="flex items-center text-sm text-muted">
                            <span class="flex items-center">
                                @if($post->user)
                                <i class="far fa-user-circle mr-2"></i> {{ $post->user->name }}
                                @endif
                            </span>
                            <span class="mx-3">|</span>
                            <span class="flex items-center">
                                <i class="far fa-clock mr-2"></i>{{ $post->created_at->format('F j, Y') }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-12">
            {{ $posts->appends(request()->query())->links('vendor.pagination.custom') }}
        </div>
        @endif
        @endif
    </div>

    @push('scripts')
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        flatpickr(".datepicker", {
            dateFormat: "Y-m-d",
            onChange: function() {
                document.getElementById('search-form').submit();
            }
        });

        const searchForm = document.getElementById('search-form');
        const queryInput = document.getElementById('query');
        const categorySelect = document.getElementById('category');

        let debounceTimer;
        queryInput.addEventListener('input', function() {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(function() {
                searchForm.submit();
            }, 500); // Adjust the delay as needed (in milliseconds)
        });

        categorySelect.addEventListener('change', function() {
            searchForm.submit();
        });
    });
    </script>
    @endpush
</x-layout>