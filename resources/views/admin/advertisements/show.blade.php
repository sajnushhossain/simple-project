@extends('admin.layouts.app')

@section('title', 'Advertisement Details')

@section('content')
<div class="container mx-auto px-4 pt-2 max-w-3xl">
    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="p-6 md:p-8">
            <h1 class="text-3xl font-bold text-center mb-8 text-gray-800">Advertisement Details</h1>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Title:</label>
                    <p class="mt-1 text-lg text-gray-900">{{ $advertisement->title }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Target URL:</label>
                    <p class="mt-1 text-lg text-gray-900">{{ $advertisement->target_url }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Position:</label>
                    <p class="mt-1 text-lg text-gray-900">{{ \Illuminate\Support\Str::title(str_replace('-', ' ', $advertisement->position)) }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Status:</label>
                    <p class="mt-1 text-lg text-gray-900">
                        @if ($advertisement->is_active)
                            <span class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full">Active</span>
                        @else
                            <span class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full">Inactive</span>
                        @endif
                    </p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Image:</label>
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $advertisement->image_path) }}" alt="{{ $advertisement->title }}" class="w-full h-auto rounded-lg">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Created At:</label>
                    <p class="mt-1 text-lg text-gray-900">{{ $advertisement->created_at->format('M d, Y H:i A') }}</p>
                </div>
            </div>
            <div class="mt-8 flex justify-end">
                <a href="{{ route('admin.advertisements.index') }}"
                    class="w-full sm:w-auto px-6 py-3 border-2 border-gray-300 rounded-lg text-gray-700 text-center hover:bg-gray-100 transition-colors duration-300">Back to Advertisements</a>
            </div>
        </div>
    </div>
</div>
@endsection
