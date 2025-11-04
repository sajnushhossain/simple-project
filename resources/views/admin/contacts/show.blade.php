@extends('admin.layouts.app')

@section('title', 'Contact Details')

@section('content')
<div class="container mx-auto px-4 pt-2 max-w-3xl">
    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="p-6 md:p-8">
            <h1 class="text-3xl font-bold text-center mb-8 text-gray-800">Contact Details</h1>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Name:</label>
                    <p class="mt-1 text-lg text-gray-900">{{ $contact->name }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Email:</label>
                    <p class="mt-1 text-lg text-gray-900">{{ $contact->email }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Subject:</label>
                    <p class="mt-1 text-lg text-gray-900">{{ $contact->subject }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Message:</label>
                    <p class="mt-1 text-lg text-gray-900">{{ $contact->message }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Received At:</label>
                    <p class="mt-1 text-lg text-gray-900">{{ $contact->created_at->format('M d, Y H:i A') }}</p>
                </div>
            </div>
            <div class="mt-8 flex justify-end">
                <a href="{{ route('admin.contacts.index') }}"
                    class="w-full sm:w-auto px-6 py-3 border-2 border-gray-300 rounded-lg text-gray-700 text-center hover:bg-gray-100 transition-colors duration-300">Back to Contacts</a>
            </div>
        </div>
    </div>
</div>
@endsection