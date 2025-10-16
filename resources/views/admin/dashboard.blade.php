@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container mx-auto px-4 pt-2">
    <!-- <h1 class="text-3xl font-bold text-gray-800 mb-8">Dashboard</h1> -->

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white shadow-lg rounded-lg p-6">
            <h2 class="text-lg font-semibold text-gray-600 mb-2">Total Posts</h2>
            <p class="text-4xl font-bold text-gray-800">{{ $postsCount }}</p>
        </div>
        <div class="bg-white shadow-lg rounded-lg p-6">
            <h2 class="text-lg font-semibold text-gray-600 mb-2">Total Categories</h2>
            <p class="text-4xl font-bold text-gray-800">{{ $categoriesCount }}</p>
        </div>
        <div class="bg-white shadow-lg rounded-lg p-6">
            <h2 class="text-lg font-semibold text-gray-600 mb-2">Total Message</h2>
            <p class="text-4xl font-bold text-gray-800">{{ $contactsCount }}</p>
        </div>
    </div>
</div>
@endsection