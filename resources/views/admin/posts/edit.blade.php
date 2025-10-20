@extends('admin.layouts.app')

@section('title', 'Edit Post')

@section('content')
<div class="container mx-auto px-4 pt-2 max-w-3xl">
    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="p-6 md:p-8">
            <h1 class="text-3xl font-bold text-center mb-8 text-gray-800">Edit Post</h1>
            <form method="POST" action="{{ route('admin.posts.update', $post) }}" enctype="multipart/form-data"
                class="space-y-6">
                @csrf
                @method('PATCH')

                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                    <div class="mt-1">
                        <input type="text" id="title" name="title" value="{{ $post->title }}" required
                            class="w-full px-4 py-3 bg-gray-100 border-2 border-gray-200 rounded-lg text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                </div>

                <div>
                    <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>
                    <div class="mt-1">
                        <select id="category_id" name="category_id" required
                            class="w-full px-4 py-3 bg-gray-100 border-2 border-gray-200 rounded-lg text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ $post->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div>
                    <label for="body" class="block text-sm font-medium text-gray-700">Content</label>
                    <div class="mt-1">
                        <textarea id="body" name="body" rows="10" required
                            class="w-full px-4 py-3 bg-gray-100 border-2 border-gray-200 rounded-lg text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ $post->body }}</textarea>
                    </div>
                </div>

                <div>
                    <label for="image" class="block text-sm font-medium text-gray-700">Featured Image</label>
                    <div class="mt-1">
                        <x-dnd-file-upload name="image"
                            existingImage="{{ $post->image ? asset('storage/' . $post->image) : '' }}" />
                    </div>
                </div>

                <div class="flex justify-end space-x-4">
                    <a href="{{ route('admin.posts.index') }}"
                        class="px-6 py-3 border-2 border-gray-300 rounded-lg text-gray-700 hover:bg-gray-100 transition-colors duration-300">Cancel</a>
                    <button type="submit"
                        class="px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition-colors duration-300">Update
                        Post</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection