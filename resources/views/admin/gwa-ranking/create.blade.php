
@extends('components.master')

@section('body')
<a href="{{ route('gwa-ranking.index') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Back to List</a>
<div class="container mx-auto mt-8">
    <div class="bg-white shadow-md rounded-lg p-6">
        <h2 class="text-3xl font-bold text-green-600 mb-2 font-poppins">Create GWA Ranking</h2>
        <form action="{{ route('gwa-ranking.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 font-bold">Student:</label>
                <select name="student_id" class="w-full p-2 border rounded border-black" required>
                    <option value="" disabled selected>Select Student</option>
                    @foreach($students as $student)
                        <option value="{{ $student->id }}">{{ $student->first_name }} {{ $student->last_name }}</option>
                    @endforeach
                </select>
                @error('student_id')
                    <span class="text-red-600">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-bold">Science Grade:</label>
                <input type="number" name="science_grade" class="w-full p-2 border rounded border-black" required min="0" max="99">
                @error('science_grade')
                    <span class="text-red-600">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-bold">Mathematics Grade:</label>
                <input type="number" name="mathematics_grade" class="w-full p-2 border rounded border-black" required min="0" max="99">
                @error('mathematics_grade')
                    <span class="text-red-600">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-bold">English Grade:</label>
                <input type="number" name="english_grade" class="w-full p-2 border rounded border-black" required min="0" max="99">
                @error('english_grade')
                    <span class="text-red-600">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-bold">Overall Grade:</label>
                <input type="number" name="overall_grade" class="w-full p-2 border rounded border-black" required min="0" max="99">
                @error('overall_grade')
                    <span class="text-red-600">{{ $message }}</span>
                @enderror
            </div>
            <div class="text-right">
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded mt-4">Create</button>
            </div>
        </form>
    </div>
</div>
@endsection