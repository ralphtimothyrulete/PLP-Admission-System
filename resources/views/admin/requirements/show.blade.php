
@extends('components.master')

@section('body')
<a href="{{ route('requirements.index') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Back to List</a>
    <div class="container mx-auto mt-8">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-3xl font-bold text-green-600 mb-1 font-poppins">Image Details</h2>
            <div class="grid grid-cols-1 lg:grid-cols-1 gap-6">
                <!-- Image Details Section -->
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h2 class="text-xl font-semibold text-white bg-green-600 p-2 rounded-t-lg font-poppins">Details</h2>
                    <ul class="space-y-4 mt-4 font-poppins text-black">
                        <li class="border border-green-500 rounded-lg p-4">
                            <label class="block text-gray-700 font-bold">ID:</label>
                            <div class="text-gray-900">{{ $image->id }}</div>
                        </li>
                        <li class="border border-green-500 rounded-lg p-4">
                            <label class="block text-gray-700 font-bold">Student ID:</label>
                            <div class="text-gray-900">{{ $image->student_id }}</div>
                        </li>
                        <li class="border border-green-500 rounded-lg p-4">
                            <label class="block text-gray-700 font-bold">Source:</label>
                            <div class="text-gray-900">{{ $image->source }}</div>
                        </li>
                        <li class="border border-green-500 rounded-lg p-4">
                            <label class="block text-gray-700 font-bold">Name:</label>
                            <div class="text-gray-900">{{ $image->name }}</div>
                        </li>
                        <li class="border border-green-500 rounded-lg p-4">
                            <label class="block text-gray-700 font-bold">Path:</label>
                            <div class="text-gray-900">{{ $image->path }}</div>
                        </li>
                    </ul>
                </div>

                <!-- Uploaded Images Section -->
                <div class="bg-white p-6 rounded-lg shadow-lg font-poppins">
                    <h2 class="text-xl font-semibold text-gray-700 mb-2">Uploaded Images:</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($studentImages as $studentImage)
                            <div class="border border-gray-300 p-2 rounded">
                                <img src="{{ Storage::url($studentImage->path) }}" alt="{{ $studentImage->name }}" class="w-full h-auto">
                                <div class="text-center mt-2">{{ $studentImage->name }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection