@extends('admin.layouts.app')

@section('title', 'Create Advertisement')

@section('content')
<div class="container mx-auto px-4 pt-2">
    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="p-6">
            <h1 class="text-2xl font-semibold text-gray-800 mb-6">Create New Advertisement</h1>
            <form action="{{ route('admin.advertisements.store') }}" method="POST" enctype="multipart/form-data">
                @include('admin.advertisements._form', ['submitButtonText' => 'Create Advertisement'])
            </form>
        </div>
    </div>
</div>
@endsection
