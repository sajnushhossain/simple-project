@extends('admin.layouts.app')

@section('title', 'Manage Posts')

@section('content')
<div class="container mx-auto px-4 pt-2">
    <div class="flex justify-between items-center mb-8">
        <!-- <h1 class="text-3xl font-bold text-gray-800">Manage Posts</h1> -->
        <a href="{{ route('admin.posts.create') }}"
            class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition-colors duration-300">
            <i class="h-5 w-5 mr-2" data-feather="plus"></i>
            Create New Post
        </a>
    </div>

    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="p-6">
            <div class="flex justify-between items-center mb-6">
                <form action="{{ route('admin.posts.index') }}" method="GET">
                    <input type="text" name="search" placeholder="Search..."
                        class="bg-gray-100 border-2 border-gray-200 rounded-lg px-4 py-2 w-64 focus:outline-none focus:border-blue-500">
                </form>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full table-auto">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="text-left py-3 px-4 font-semibold text-gray-600 uppercase">Title</th>
                            <th class="text-left py-3 px-4 font-semibold text-gray-600 uppercase">Created At</th>
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
                                    class="inline-block"
                                    onsubmit="return confirm('Are you sure you want to delete this post?');">
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
                {{ $posts->appends(request()->only('search'))->links('vendor.pagination.tailwind') }}
            </div>
        </div>
    </div>
</div>
@endsection