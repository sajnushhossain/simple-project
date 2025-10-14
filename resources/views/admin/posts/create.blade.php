<x-layout>
    <div class="container mx-auto px-4 pt-10 max-w-3xl">
        <div class="bg-white shadow-lg rounded-lg overflow-hidden border border-gray-200">
            <div class="p-6 md:p-8">
                <h1 class="text-3xl font-bold text-center mb-8 text-gray-900">Create a New Post</h1>
                <form method="POST" action="{{ route('admin.posts.store') }}" enctype="multipart/form-data"
                    class="space-y-6">
                    @csrf
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                        <div class="mt-1">
                            <input type="text" id="title" name="title" required
                                class="w-full px-4 py-3 bg-white border-2 border-gray-300 rounded-lg text-gray-900 focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary">
                        </div>
                    </div>
                    <div>
                        <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>
                        <div class="mt-1">
                            <select id="category_id" name="category_id" required
                                class="w-full px-4 py-3 bg-white border-2 border-gray-300 rounded-lg text-gray-900 focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary">
                                <option value="" disabled selected>Select a category</option>
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div>
                        <label for="body" class="block text-sm font-medium text-gray-700">Content</label>
                        <div class="mt-1">
                            <textarea id="body" name="body" rows="10" required
                                class="w-full px-4 py-3 bg-white border-2 border-gray-300 rounded-lg text-gray-900 focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary"></textarea>
                        </div>
                    </div>
                    <div>
                        <!-- <label for="slug" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Slug</label>
                        <div class="mt-1">
                            <input type="text" id="slug" name="slug" 
                                   class="w-full px-4 py-3 bg-gray-100 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div> -->
                    </div>
                    <div>
                        <label for="image" class="block text-sm font-medium text-gray-700">Featured Image</label>
                        <div class="mt-1">
                            <input class="w-full px-3 py-2 border-2 rounded-lg bg-white border-gray-300 text-gray-900"
                                type="file" id="image" name="image">
                        </div>
                    </div>
                    <div class="flex justify-end space-x-4">
                        <a href="{{ route('admin.posts.index') }}"
                            class="px-6 py-3 border-2 border-gray-300 rounded-lg text-gray-700 hover:bg-gray-100 transition-colors duration-300">Cancel</a>
                        <button type="submit"
                            class="px-6 py-3 bg-primary text-white font-semibold rounded-lg hover:bg-primary-700 transition-colors duration-300">Publish
                            Post</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout>