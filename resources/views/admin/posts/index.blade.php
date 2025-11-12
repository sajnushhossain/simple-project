@extends('admin.layouts.app')

@section('title', 'Manage Posts')

@section('content')
<div class="container mx-auto px-4 pt-2">
    <div class="flex flex-col md:flex-row justify-between items-stretch md:items-center mb-8 space-y-4 md:space-y-0">
        <a href="{{ route('admin.posts.create') }}"
           class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 text-white text-base font-semibold rounded-lg hover:bg-blue-700 transition-colors duration-300">
            <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
            </svg>
            Create New Post
        </a>

        <div class="flex flex-col md:flex-row items-stretch md:items-center space-y-4 md:space-y-0 md:space-x-4">
            <div class="relative w-full md:w-auto">
                <button id="sortButton"
                        class="inline-flex items-center justify-center w-full px-6 py-2 bg-gray-100 text-gray-700 text-base font-semibold rounded-lg hover:bg-gray-200 transition-colors duration-300 cursor-pointer">
                    Sort By
                    <i id="sortIcon" class="fa-solid fa-angle-down ml-2 transition-transform duration-300"></i>
                </button>
                <div id="sortDropdown" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-10 hidden">
                    <a href="{{ route('admin.posts.index', ['sort' => 'desc']) }}"
                       class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Newest First</a>
                    <a href="{{ route('admin.posts.index', ['sort' => 'asc']) }}"
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
                                    href="{{ route('admin.posts.index', ['sort' => $sort === 'asc' ? 'desc' : 'asc']) }}">
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
                                    class="text-blue-600 hover:text-blue-800 mr-4 font-semibold cursor-pointer">Edit</a>
                                <form method="POST" action="{{ route('admin.posts.destroy', $post) }}"
                                    class="inline-block" ;">
                                    <!-- onsubmit="return confirm('Are you sure you want to delete this post?');" -->
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="text-red-600 hover:text-red-800 font-semibold cursor-pointer">Delete</button>
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
                {{ $posts->appends(request()->only('sort'))->links('vendor.pagination.custom') }}
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.getElementById('sortButton').addEventListener('click', function() {
        document.getElementById('sortDropdown').classList.toggle('hidden');
        document.getElementById('sortIcon').classList.toggle('rotate-180');
    });

    // Close the dropdown if the user clicks outside of it
    window.addEventListener('click', function(event) {
        if (!event.target.matches('#sortButton') && !event.target.closest('#sortDropdown')) {
            var dropdown = document.getElementById('sortDropdown');
            var icon = document.getElementById('sortIcon');
            if (!dropdown.classList.contains('hidden')) {
                dropdown.classList.add('hidden');
                icon.classList.remove('rotate-180');
            }
        }
    });
</script>
@endpush