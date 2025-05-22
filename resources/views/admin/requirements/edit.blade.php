
@extends('components.master')

@section('body')
<a href="{{ route('requirements.index') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Back to List</a>
    <div class="container mx-auto mt-8">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-2xl font-bold mb-4 text-green-600 font-poppins">Edit Image</h2>
            <form action="{{ route('requirements.update', $image->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold">Name:</label>
                    <input type="text" name="name" value="{{ $image->name }}" class="w-full p-2 border rounded border-black">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold">Source:</label>
                    <input type="text" name="source" value="{{ $image->source }}" class="w-full p-2 border rounded border-black">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold">Upload New Image:</label>
                    <input type="file" name="new_image" class="w-full p-2 border rounded border-black">
                    @if ($errors->has('new_image'))
                        <span class="text-red-600">{{ $errors->first('new_image') }}</span>
                    @endif
                <div class="text-right">
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded font-poppins mt-5">Update</button>
            </form>
        </div>
    </div>
@endsection