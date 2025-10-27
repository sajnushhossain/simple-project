@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container mx-auto px-4 pt-2">

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white shadow-lg rounded-lg p-6 flex items-center">
            <div class="mr-4">
                <svg class="h-12 w-12 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                </svg>
            </div>
            <div>
                <h2 class="text-lg font-semibold text-gray-600 mb-1">Total Posts</h2>
                <p class="text-4xl font-bold text-gray-800">{{ $postsCount }}</p>
            </div>
        </div>
        <div class="bg-white shadow-lg rounded-lg p-6 flex items-center">
            <div class="mr-4">
                <svg class="h-12 w-12 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
            </div>
            <div>
                <h2 class="text-lg font-semibold text-gray-600 mb-1">Total Categories</h2>
                <p class="text-4xl font-bold text-gray-800">{{ $categoriesCount }}</p>
            </div>
        </div>
        <div class="bg-white shadow-lg rounded-lg p-6 flex items-center">
            <div class="mr-4">
                <svg class="h-12 w-12 text-yellow-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
            </div>
            <div>
                <h2 class="text-lg font-semibold text-gray-600 mb-1">Total Message</h2>
                <p class="text-4xl font-bold text-gray-800">{{ $contactsCount }}</p>
            </div>
        </div>
        <div class="bg-white shadow-lg rounded-lg p-6 flex items-center">
            <div class="mr-4">
                <svg class="h-12 w-12 text-red-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                </svg>
            </div>
            <div>
                <h2 class="text-lg font-semibold text-gray-600 mb-1">Total Subscribers</h2>
                <p class="text-4xl font-bold text-gray-800">{{ $subscriptionsCount }}</p>
            </div>
        </div>
    </div>
</div>
@endsection