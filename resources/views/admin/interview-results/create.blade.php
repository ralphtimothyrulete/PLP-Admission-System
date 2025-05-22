@extends('components.master')

@section('body')
<a href="{{ route('interview-results.index') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Back to List</a>
<div class="container mx-auto mt-8">
    <div class="bg-white shadow-md rounded-lg p-6">
        <h2 class="text-3xl font-bold text-green-600 mb-2 font-poppins">Create Interview Result</h2>
        <form action="{{ route('interview-results.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 font-bold">Student ID:</label>
                <input type="text" name="student_id" class="w-full p-2 border rounded border-black" required>
                @error('student_id')
                    <span class="text-red-600">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-bold">Name:</label>
                <input type="text" name="name" class="w-full p-2 border rounded border-black" required>
                @error('name')
                    <span class="text-red-600">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-bold">Result:</label>
                <input type="text" name="result" class="w-full p-2 border rounded border-black" required>
                @error('result')
                    <span class="text-red-600">{{ $message }}</span>
                @enderror
            <div class="text-right">
            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded mt-4">Create</button>
        </form>
    </div>
</div>
@endsection