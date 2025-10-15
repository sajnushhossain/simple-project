<div>
    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
    <div class="mt-1">
        <input type="text" id="name" name="name" value="{{ old('name', $category->name ?? '') }}" required
            class="w-full px-4 py-3 bg-gray-100 border-2 border-gray-200 rounded-lg text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
    </div>
</div>

<div>
    <label for="slug" class="block text-sm font-medium text-gray-700">Slug</label>
    <div class="mt-1">
        <input type="text" id="slug" name="slug" value="{{ old('slug', $category->slug ?? '') }}" required
            class="w-full px-4 py-3 bg-gray-100 border-2 border-gray-200 rounded-lg text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
    </div>
</div>

<div class="flex justify-end space-x-4">
    <a href="{{ route('admin.categories.index') }}"
        class="px-6 py-3 border-2 border-gray-300 rounded-lg text-gray-700 hover:bg-gray-100 transition-colors duration-300">Cancel</a>
    <button type="submit"
        class="px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition-colors duration-300">{{ $submitButtonText ?? 'Create' }}</button>
</div>