

@extends('admin.layouts.app')

@section('title', 'Manage Contacts')

@section('content')
<div class="container mx-auto px-4 pt-2">
    <div class="flex justify-between items-center mb-8">
        <!-- <h1 class="text-3xl font-bold text-gray-800">Manage Contacts</h1> -->
        <!-- <a href="{{ route('admin.contacts.create') }}"
            class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition-colors duration-300">
            <i class="h-5 w-5 mr-2" data-feather="plus"></i>
            Create New Contact
        </a> -->
    </div>

    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="p-6">
            <div class="overflow-x-auto">
                <table class="w-full table-auto">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="text-left py-3 px-4 font-semibold text-gray-600 uppercase">Name</th>
                            <th class="text-left py-3 px-4 font-semibold text-gray-600 uppercase">Email</th>
                            <th class="text-left py-3 px-4 font-semibold text-gray-600 uppercase">Subject</th>
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
                                    onsubmit="return confirm('Are you sure you want to delete this contact?');">
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
        </div>
    </div>
</div>
@endsection