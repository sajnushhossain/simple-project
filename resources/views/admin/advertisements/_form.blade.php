@csrf
<div class="space-y-6">
    <div>
        <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
        <div class="mt-1">
            <input type="text" id="title" name="title" value="{{ old('title', $advertisement->title ?? '') }}" required
                class="w-full px-4 py-3 bg-gray-100 border-2 border-gray-200 rounded-lg text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
        </div>
        @error('title')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="target_url" class="block text-sm font-medium text-gray-700">Target URL</label>
        <div class="mt-1">
            <input type="url" id="target_url" name="target_url" value="{{ old('target_url', $advertisement->target_url ?? '') }}"
                class="w-full px-4 py-3 bg-gray-100 border-2 border-gray-200 rounded-lg text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
        </div>
        @error('target_url')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Positions</label>
        <div class="mt-2 space-y-2">
            @foreach($positions as $position)
                <div class="flex items-center">
                    <input type="checkbox" id="position_{{ $position->id }}" name="positions[]" value="{{ $position->id }}"
                        @if(is_array(old('positions')) && in_array($position->id, old('positions')))
                            checked
                        @elseif(isset($advertisement) && $advertisement->positions->contains($position->id))
                            checked
                        @endif
                        class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                    <label for="position_{{ $position->id }}" class="ml-2 block text-sm text-gray-900">{{ $position->name }}</label>
                </div>
            @endforeach
        </div>
        @error('positions')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="image" class="block text-sm font-medium text-gray-700">Image</label>
        <div class="mt-1">
            <input type="file" id="image" name="image" class="w-full px-4 py-3 bg-gray-100 border-2 border-gray-200 rounded-lg text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
        </div>
        @if (isset($advertisement) && $advertisement->image_path)
            <div class="mt-4">
                <img src="{{ asset('storage/' . $advertisement->image_path) }}" alt="{{ $advertisement->title }}" class="w-48 h-auto">
            </div>
        @endif
        @error('image')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="flex items-center">
        <input type="checkbox" id="is_active" name="is_active" value="1" @checked(old('is_active', $advertisement->is_active ?? true))
            class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
        <label for="is_active" class="ml-2 block text-sm text-gray-900">Active</label>
    </div>
</div>

<div class="flex flex-col-reverse sm:flex-row justify-end sm:space-y-0 sm:space-x-4 mt-6">
    <a href="{{ route('admin.advertisements.index') }}"
        class="w-full sm:w-auto px-6 py-3 mb-0 border-2 border-gray-300 rounded-lg text-gray-700 text-center hover:bg-gray-100 transition-colors duration-300 cursor-pointer">Cancel</a>
    <button type="submit"
        class="w-full sm:w-auto px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition-colors duration-300 cursor-pointer">
        {{ $submitButtonText ?? 'Create' }}</button>
</div>
