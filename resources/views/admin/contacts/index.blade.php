

@extends('admin.layouts.app')

@section('title', 'Manage Contacts')

@section('content')
<div class="container mx-auto px-4 pt-2">
    <div class="flex justify-end items-center mb-8">
        <div class="flex items-center space-x-4">
            <form action="{{ route('admin.contacts.index') }}" method="GET" class="flex items-center">
                <input type="text" name="search" placeholder="Search by Name..." value="{{ request('search') }}"
                    class="bg-gray-100 border-2 border-gray-200 rounded-lg px-4 py-2 w-64 focus:outline-none focus:border-blue-500">
                <input type="hidden" name="sort_by" value="{{ request('sort_by') }}">
                <input type="hidden" name="sort_order" value="{{ request('sort_order') }}">
            </form>

            <div class="relative">
                <button id="sortButton"
                    class="inline-flex items-center px-6 py-3 bg-gray-200 text-gray-700 font-semibold rounded-lg hover:bg-gray-300 transition-colors duration-300">
                    Sort By <i class="h-5 w-5 ml-2" data-feather="chevron-down"></i>
                </button>
                <div id="sortDropdown"
                    class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-10 hidden">
                    <a href="{{ route('admin.contacts.index', ['sort_by' => 'name', 'sort_order' => 'asc', 'search' => request('search')]) }}"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Name (A-Z)</a>
                    <a href="{{ route('admin.contacts.index', ['sort_by' => 'name', 'sort_order' => 'desc', 'search' => request('search')]) }}"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Name (Z-A)</a>
                    <a href="{{ route('admin.contacts.index', ['sort_by' => 'email', 'sort_order' => 'asc', 'search' => request('search')]) }}"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Email (A-Z)</a>
                    <a href="{{ route('admin.contacts.index', ['sort_by' => 'email', 'sort_order' => 'desc', 'search' => request('search')]) }}"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Email (Z-A)</a>
                    <a href="{{ route('admin.contacts.index', ['sort_by' => 'subject', 'sort_order' => 'asc', 'search' => request('search')]) }}"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Subject (A-Z)</a>
                    <a href="{{ route('admin.contacts.index', ['sort_by' => 'subject', 'sort_order' => 'desc', 'search' => request('search')]) }}"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Subject (Z-A)</a>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="p-6">
            <div class="overflow-x-auto">
                <table class="w-full table-auto">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="text-left py-3 px-4 font-semibold text-gray-600 uppercase">
                                <a href="{{ route('admin.contacts.index', ['sort_by' => 'name', 'sort_order' => $sortBy === 'name' && $sortOrder === 'asc' ? 'desc' : 'asc']) }}">
                                    Name
                                </a>
                            </th>
                            <th class="text-left py-3 px-4 font-semibold text-gray-600 uppercase">
                                <a href="{{ route('admin.contacts.index', ['sort_by' => 'email', 'sort_order' => $sortBy === 'email' && $sortOrder === 'asc' ? 'desc' : 'asc']) }}">
                                    Email
                                </a>
                            </th>
                            <th class="text-left py-3 px-4 font-semibold text-gray-600 uppercase">
                                <a href="{{ route('admin.contacts.index', ['sort_by' => 'subject', 'sort_order' => $sortBy === 'subject' && $sortOrder === 'asc' ? 'desc' : 'asc']) }}">
                                    Subject
                                </a>
                            </th>
                            <th class="text-center py-3 px-4 font-semibold text-gray-600 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($contacts as $contact)
                        <tr class="hover:bg-gray-50 transition-colors duration-200">
                            <td class="py-4 px-4 text-gray-800">{{ $contact->name }}</td>
                            <td class="py-4 px-4 text-gray-500">{{ $contact->email }}</td>
                            <td class="py-4 px-4 text-gray-500">{{ $contact->subject }}</td>
                            <td class="py-4 px-4 text-center">
                                <a href="{{ route('admin.contacts.edit', $contact) }}"
                                    class="text-blue-600 hover:text-blue-800 mr-4 font-semibold">View</a>
                                <form method="POST" action="{{ route('admin.contacts.destroy', $contact) }}"
                                    class="inline-block"
                                    ;">
                                    <!-- onsubmit="return confirm('Are you sure you want to delete this contact?') -->
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="text-red-600 hover:text-red-800 font-semibold">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-10 text-gray-500">
                                No contacts found. Get started by creating one!
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-8">
                {{ $contacts->appends(request()->only('sort_by', 'sort_order'))->links('vendor.pagination.tailwind') }}
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.getElementById('sortButton').addEventListener('click', function() {
        document.getElementById('sortDropdown').classList.toggle('hidden');
    });

    // Close the dropdown if the user clicks outside of it
    window.addEventListener('click', function(event) {
        if (!event.target.matches('#sortButton') && !event.target.closest('#sortDropdown')) {
            var dropdown = document.getElementById('sortDropdown');
            if (!dropdown.classList.contains('hidden')) {
                dropdown.classList.add('hidden');
            }
        }
    });
</script>
@endpush