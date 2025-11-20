@extends('admin.layouts.app')

@section('title', 'Edit Advertisement')

@section('content')
<div class="container mx-auto px-4 pt-2">
    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="p-6">
            <h1 class="text-2xl font-semibold text-gray-800 mb-6">Edit Advertisement</h1>
            <form action="{{ route('admin.advertisements.update', $advertisement) }}" method="POST" enctype="multipart/form-data">
                @method('PATCH')
                @include('admin.advertisements._form', ['advertisement' => $advertisement, 'submitButtonText' => 'Update Advertisement'])
            </form>
        </div>
    </div>
</div>
@endsection
