@extends('components.master')

@section('body')
<a href="{{ route('enrollment-slot.index') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Back to List</a>
<div class="container mx-auto mt-8">
    <div class="bg-white shadow-md rounded-lg p-6">
        <h2 class="text-3xl font-bold text-green-600 mb-2 font-poppins">Create Enrollment Slot</h2>
        <form action="{{ route('enrollment-slot.store') }}" method="POST">
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
                <label class="block text-gray-700 font-bold">Slot Status:</label>
                <input type="text" name="slot_status" class="w-full p-2 border rounded border-black" required>
                @error('slot_status')
                    <span class="text-red-600">{{ $message }}</span>
                @enderror
            <div class="text-right">
            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded mt-4">Create</button>
        </form>
    </div>
</div>
@endsection