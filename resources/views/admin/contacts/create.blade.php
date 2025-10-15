@extends('admin.layouts.app')

@section('title', 'Create New Contact')

@section('content')
<div class="container mx-auto px-4 pt-2 max-w-3xl">
    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="p-6 md:p-8">
            <h1 class="text-3xl font-bold text-center mb-8 text-gray-800">Create a New Contact</h1>
            <form method="POST" action="{{ route('admin.contacts.store') }}" class="space-y-6">
                @csrf
                @include('admin.contacts._form')
            </form>
        </div>
    </div>
</div>
@endsection