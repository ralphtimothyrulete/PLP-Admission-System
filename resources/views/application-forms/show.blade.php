
@extends('components.master')

@section('body')
<a href="{{ route('application-forms.index') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Back to List</a>
<div class="container mx-auto mt-8">
    <div class="bg-white shadow-md rounded-lg p-6">
        <h2 class="text-2xl font-bold mb-4 text-green-600 font-poppins">Application Details</h2>
        
        <!-- Grid Layout for Student and School Details -->
        <div class="grid grid-cols-2 gap-20">
            <!-- Student Details -->
            <div>
                <h3 class="text-xl font-semibold mt-2 text-white bg-green-600 p-2 rounded-t-lg font-poppins">Student Details</h3>
                <div class="bg-gray-100 p-4 rounded-b-lg">
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold">User ID:</label>
                        <div class="text-gray-900">{{ $application->student->user_id }}</div>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold">Name:</label>
                        <div class="text-gray-900">{{ $application->student->last_name }}, {{ $application->student->first_name }} {{ $application->student->middle_name }} {{ $application->student->suffix }}</div>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold">Age:</label>
                        <div class="text-gray-900">{{ $application->student->age }}</div>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold">Sex:</label>
                        <div class="text-gray-900">{{ $application->student->sex }}</div>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold">Contact Number:</label>
                        <div class="text-gray-900">{{ $application->student->contact_number }}</div>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold">Email:</label>
                        <div class="text-gray-900">{{ $application->student->email }}</div>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold">Address:</label>
                        <div class="text-gray-900">{{ $application->student->address }}</div>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold">Religion:</label>
                        <div class="text-gray-900">{{ $application->student->religion }}</div>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold">Sports:</label>
                        <div class="text-gray-900">{{ $application->student->sports }}</div>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold">Residency Status:</label>
                        <div class="text-gray-900">{{ $application->student->residency_status }}</div>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold">District:</label>
                        <div class="text-gray-900">{{ $application->student->district }}</div>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold">Barangay:</label>
                        <div class="text-gray-900">{{ $application->student->barangay }}</div>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold">Non-Pasig Resident:</label>
                        <div class="text-gray-900">{{ $application->student->non_pasig_resident }}</div>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold">Talents:</label>
                        <div class="text-gray-900">{{ $application->student->talents }}</div>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold">Strand:</label>
                        <div class="text-gray-900">{{ $application->student->strand }}</div>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold">Salary:</label>
                        <div class="text-gray-900">{{ $application->student->salary }}</div>
                    </div>
                </div>
            </div>

            <!-- School Details -->
            <div>
                <h3 class="text-xl font-semibold mt-2 text-white bg-green-600 p-2 rounded-t-lg font-poppins">School Details</h3>
                <div class="bg-gray-100 p-4 rounded-b-lg">
                    @foreach($application->student->schools as $school)
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold">School Type:</label>
                        <div class="text-gray-900">{{ $school->school_type }}</div>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold">Public School:</label>
                        <div class="text-gray-900">{{ $school->public_school }}</div>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold">Other School:</label>
                        <div class="text-gray-900">{{ $school->other_school }}</div>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold">Private School:</label>
                        <div class="text-gray-900">{{ $school->private_school }}</div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Grid Layout for Parent/Guardian and Application Details -->
        <div class="grid grid-cols-2 gap-20 mt-8">
            <!-- Parent/Guardian Details -->
            <div>
                <h3 class="text-xl font-semibold text-white bg-green-600 p-2 rounded-t-lg font-poppins">Parent/Guardian Details</h3>
                <div class="bg-gray-100 p-4 rounded-b-lg">
                    @foreach($application->student->parentsGuardians as $parentGuardian)
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold">Type:</label>
                        <div class="text-gray-900">{{ $parentGuardian->type }}</div>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold">Name:</label>
                        <div class="text-gray-900">{{ $parentGuardian->last_name }}, {{ $parentGuardian->first_name }} {{ $parentGuardian->middle_name }} {{ $parentGuardian->suffix }}</div>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold">Age:</label>
                        <div class="text-gray-900">{{ $parentGuardian->age }}</div>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold">Contact Number:</label>
                        <div class="text-gray-900">{{ $parentGuardian->contact_number }}</div>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold">Email:</label>
                        <div class="text-gray-900">{{ $parentGuardian->email }}</div>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold">Address:</label>
                        <div class="text-gray-900">{{ $parentGuardian->address }}</div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Application Details -->
            <div>
                <h3 class="text-xl font-semibold text-white bg-green-600 p-2 rounded-t-lg font-poppins">Application Details</h3>
                <div class="bg-gray-100 p-4 rounded-b-lg">
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold">Science Grade:</label>
                        <div class="text-gray-900">{{ $application->science_grade }}</div>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold">Mathematics Grade:</label>
                        <div class="text-gray-900">{{ $application->mathematics_grade }}</div>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold">English Grade:</label>
                        <div class="text-gray-900">{{ $application->english_grade }}</div>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold">Overall Grade:</label>
                        <div class="text-gray-900">{{ $application->overall_grade }}</div>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold">First Choice:</label>
                        <div class="text-gray-900">{{ $application->first_choice }}</div>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold">Second Choice:</label>
                        <div class="text-gray-900">{{ $application->second_choice }}</div>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold">Third Choice:</label>
                        <div class="text-gray-900">{{ $application->third_choice }}</div>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold">Status:</label>
                        <div class="text-gray-900">{{ $application->status }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection