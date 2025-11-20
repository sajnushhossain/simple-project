@extends('admin.layouts.app')

@section('title', 'Manage Advertisements')

@section('content')
<div class="container mx-auto px-4 pt-2">
    <div class="flex flex-col md:flex-row justify-between items-stretch md:items-center mb-8 space-y-4 md:space-y-0">
        <a href="{{ route('admin.advertisements.create') }}"
           class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 text-white text-base font-semibold rounded-lg hover:bg-blue-700 transition-colors duration-300">
            <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
            </svg>
            Create New Advertisement
        </a>
    </div>

    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="p-6">
            <div class="overflow-x-auto">
                <table class="w-full table-auto">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="text-left py-3 px-4 font-semibold text-gray-600 uppercase">Title</th>
                            <th class="text-left py-3 px-4 font-semibold text-gray-600 uppercase">Positions</th>
                            <th class="text-left py-3 px-4 font-semibold text-gray-600 uppercase">Status</th>
                            <th class="text-left py-3 px-4 font-semibold text-gray-600 uppercase">Created At</th>
                            <th class="text-center py-3 px-4 font-semibold text-gray-600 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($advertisements as $ad)
                        <tr class="hover:bg-gray-50 transition-colors duration-200">
                            <td class="py-4 px-4 text-gray-800">{{ Str::limit($ad->title, 60) }}</td>
                            <td class="py-4 px-4 text-gray-500">
                                @foreach($ad->positions as $position)
                                    <span class="bg-gray-200 text-gray-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full">{{ $position->name }}</span>
                                @endforeach
                            </td>
                            <td class="py-4 px-4 text-gray-500">
                                @if ($ad->is_active)
                                    <span class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full">Active</span>
                                @else
                                    <span class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full">Inactive</span>
                                @endif
                            </td>
                            <td class="py-4 px-4 text-gray-500">{{ $ad->created_at->format('M j, Y') }}</td>
                            <td class="py-4 px-4 text-center">
                                <a href="{{ route('admin.advertisements.edit', $ad) }}"
                                    class="text-blue-600 hover:text-blue-800 mr-4 font-semibold cursor-pointer">Edit</a>
                                <form method="POST" action="{{ route('admin.advertisements.destroy', $ad) }}"
                                    class="inline-block" onsubmit="return confirm('Are you sure you want to delete this advertisement?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="text-red-600 hover:text-red-800 font-semibold cursor-pointer">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-10 text-gray-500">
                                No advertisements found. Get started by creating one!
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-8">
                {{ $advertisements->links('vendor.pagination.custom') }}
            </div>
        </div>
    </div>
</div>
@endsection
