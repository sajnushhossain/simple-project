@extends('admin.layouts.app')

@section('title', 'Manage Posts')

@section('content')
<div class="container mx-auto px-4 pt-2">
    <div class="flex justify-between items-center mb-8">
        <a href="{{ route('admin.posts.create') }}"
            class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition-colors duration-300">
            <i class="h-5 w-5 mr-2" data-feather="plus"></i>
            Create New Post
        </a>

        <div class="flex items-center space-x-4">
            <form action="{{ route('admin.posts.index') }}" method="GET" class="flex items-center">
                <input type="text" name="search" placeholder="Search..." value="{{ request('search') }}"
                    class="bg-gray-100 border-2 border-gray-200 rounded-lg px-4 py-2 w-64 focus:outline-none focus:border-blue-500">
                <input type="hidden" name="sort" value="{{ request('sort') }}">
                <!-- <button type="submit" class="bg-blue-600 text-white font-semibold rounded-lg px-4 py-2 ml-2">Search</button> -->
            </form>

            <div class="relative">
                <button id="sortButton"
                    class="inline-flex items-center px-6 py-3 bg-gray-200 text-gray-700 font-semibold rounded-lg hover:bg-gray-300 transition-colors duration-300">
                    Sort By <i class="h-5 w-5 ml-2" data-feather="chevron-down"></i>
                </button>
                <div id="sortDropdown" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-10 hidden">
                    <a href="{{ route('admin.posts.index', ['sort' => 'desc', 'search' => request('search')]) }}"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Newest First</a>
                    <a href="{{ route('admin.posts.index', ['sort' => 'asc', 'search' => request('search')]) }}"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Oldest First</a>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="p-6">
            <div class="overflow-x-auto">
                <table class="w-full table-auto">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="text-left py-3 px-4 font-semibold text-gray-600 uppercase">Title</th>
                            <th class="text-left py-3 px-4 font-semibold text-gray-600 uppercase">
                                <a
                                    href="{{ route('admin.posts.index', ['sort' => $sort === 'asc' ? 'desc' : 'asc', 'search' => request('search')]) }}">
                                    Created At
                                </a>
                            </th>
                            <th class="text-center py-3 px-4 font-semibold text-gray-600 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($posts as $post)
                        <tr class="hover:bg-gray-50 transition-colors duration-200">
                            <td class="py-4 px-4 text-gray-800">{{ Str::limit($post->title, 60) }}</td>
                            <td class="py-4 px-4 text-gray-500">{{ $post->created_at->format('M j, Y') }}</td>
                            <td class="py-4 px-4 text-center">
                                <a href="{{ route('admin.posts.edit', $post) }}"
                                    class="text-blue-600 hover:text-blue-800 mr-4 font-semibold">Edit</a>
                                <form method="POST" action="{{ route('admin.posts.destroy', $post) }}"
                                    class="inline-block" ;">
                                    <!-- onsubmit="return confirm('Are you sure you want to delete this post?') -->
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="text-red-600 hover:text-red-800 font-semibold">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center py-10 text-gray-500">
                                No posts found. Get started by creating one!
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-8">
                {{ $posts->appends(request()->only('search', 'sort'))->links('vendor.pagination.custom') }}
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.getElementById('sortButton').addEventListener('click', function() {
    document.getElementById('sortDropdown').classList.toggle('hidden');
});

// Close the dropdown if the user clicks outside of it
window.addEventListener('click', function(event) {
    if (!event.target.matches('#sortButton') && !event.target.closest('#sortDropdown')) {
        var dropdown = document.getElementById('sortDropdown');
        if (!dropdown.classList.contains('hidden')) {
            dropdown.classList.add('hidden');
        }
    }
});
</script>
@endpush