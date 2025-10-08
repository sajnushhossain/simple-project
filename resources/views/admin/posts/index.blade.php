<x-layout>
    <div class="container" style="padding-top: 40px;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 40px;">
            <h1 style="font-size: 48px;">Admin Posts</h1>
            <a href="{{ route('admin.posts.create') }}" class="btn btn-primary">Create Post</a>
        </div>

        <div class="card">
            <div class="card-body">
                <h2 class="card-title">Existing Posts</h2>
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="background-color: #f8f9fa;">
                            <th style="text-align: left; padding: 20px; border-bottom: 1px solid #eee;">Title</th>
                            <th style="text-align: left; padding: 20px; border-bottom: 1px solid #eee;">Created At</th>
                            <th style="text-align: left; padding: 20px; border-bottom: 1px solid #eee;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        @foreach ($posts as $post)
                            <tr>
                                <td style="padding: 20px; border-bottom: 1px solid #eee;">{{ $post->title }}</td>
                                <td style="padding: 20px; border-bottom: 1px solid #eee;">{{ $post->created_at->format('F j, Y') }}</td>
                                <td style="padding: 20px; border-bottom: 1px solid #eee;">
                                    <a href="{{ route('admin.posts.edit', $post) }}" class="btn btn-primary" style="margin-right: 10px; text-decoration: none;">Edit</a>
                                    <form method="POST" action="{{ route('admin.posts.destroy', $post) }}" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layout>
