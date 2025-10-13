<x-layout :posts="[]">
    <div class="container mx-auto px-4 pt-10">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-4xl font-bold text-gray-900">Admin Dashboard</h1>
            <a href="{{ route('admin.posts.create') }}" class="inline-flex items-center px-6 py-3 bg-primary text-white font-semibold rounded-full hover:bg-primary-700 transition-colors duration-300">
                <i class="fas fa-plus mr-2"></i>
                Create New Post
            </a>
        </div>

        <div class="bg-surface-2 shadow-lg rounded-lg overflow-hidden">
            <div class="p-6 md:p-8">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-900">Manage Posts</h2>
                    <form action="{{ route('admin.posts.index') }}" method="GET">
                        <input type="text" name="search" placeholder="Search..." class="bg-bg border border-border rounded-lg px-4 py-2 w-64">
                    </form>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full table-auto">
                        <thead class="bg-surface">
                            <tr>
                                <th class="text-left py-3 px-4 font-semibold text-muted uppercase">Title</th>
                                <th class="text-left py-3 px-4 font-semibold text-muted uppercase">Created At</th>
                                <th class="text-center py-3 px-4 font-semibold text-muted uppercase">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-border">
                            @forelse ($posts as $post)
                                <tr class="hover:bg-surface transition-colors duration-200">
                                    <td class="py-4 px-4 text-text">{{ Str::limit($post->title, 60) }}</td>
                                    <td class="py-4 px-4 text-muted">{{ $post->created_at->format('M j, Y') }}</td>
                                    <td class="py-4 px-4 text-center">
                                        <a href="{{ route('admin.posts.edit', $post) }}" class="text-primary hover:text-primary-700 mr-4 font-semibold">Edit</a>
                                        <form method="POST" action="{{ route('admin.posts.destroy', $post) }}" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this post?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-danger hover:text-red-700 font-semibold">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center py-10 text-muted">
                                        No posts found. Get started by creating one!
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mt-8">
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
    </div>
</x-layout>