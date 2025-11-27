@extends('admin.layouts.app')

@section('title', 'Create New Post')

@section('content')
<div class="container mx-auto px-4 pt-2 max-w-3xl">
    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="p-6 md:p-8">
            <h1 class="text-3xl font-bold text-center mb-8 text-gray-800">Create a New Post</h1>
            <form method="POST" action="{{ route('admin.posts.store') }}" enctype="multipart/form-data"
                class="space-y-6">
                @csrf
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                    <div class="mt-1">
                        <input type="text" id="title" name="title" required
                            class="w-full px-4 py-3 bg-gray-100 border-2 border-gray-200 rounded-lg text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('title') border-red-500 @enderror">
                        @error('title')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div>
                    <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>
                    <div class="mt-1">
                        <select id="category_id" name="category_id" required
                            class="w-full px-4 py-3 bg-gray-100 border-2 border-gray-200 rounded-lg text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('category_id') border-red-500 @enderror">
                            <option value="" disabled selected>Select a category</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div>
                    <label for="body" class="block text-sm font-medium text-gray-700">Content</label>
                    <div class="mt-1">
                        <textarea id="body" name="body" rows="10" required
                            class="w-full px-4 py-3 bg-gray-100 border-2 border-gray-200 rounded-lg text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('body') border-red-500 @enderror"></textarea>
                        @error('body')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div>
                    <label for="image" class="block text-sm font-medium text-gray-700">Featured Image</label>
                    <div class="mt-1">
                        <x-dnd-file-upload name="image" />
                    </div>
                </div>
                <div class="flex flex-col-reverse sm:flex-row justify-end sm:space-y-0 sm:space-x-4 mt-6">
                    <a href="{{ route('admin.posts.index') }}"
                        class="w-full sm:w-auto px-6 py-3 border-2 border-gray-300 rounded-lg text-gray-700 text-center hover:bg-gray-100 transition-colors duration-300">Cancel</a>
                    <button type="submit"
                        class="w-full sm:w-auto px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition-colors duration-300 cursor-pointer">Publish
                        Post</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
