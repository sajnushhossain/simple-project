@extends('admin.layouts.app')

@section('title', 'Edit Category')

@section('content')
<div class="container mx-auto px-4 pt-2 max-w-3xl">
    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="p-6 md:p-8">
            <h1 class="text-3xl font-bold text-center mb-8 text-gray-800">Edit Category</h1>
            <form method="POST" action="{{ route('admin.categories.update', $category) }}" class="space-y-6">
                @csrf
                @method('PATCH')
                @include('admin.categories._form', ['submitButtonText' => 'Update'])
            </form>
        </div>
    </div>
</div>
@endsection