
@extends('components.master')

@section('body')
<a href="{{ route('application-forms.index') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Back to List</a>
<div class="container mx-auto mt-8">
    <div class="bg-white shadow-md rounded-lg p-6">
        <h2 class="text-2xl font-bold mb-4 text-green-600 font-poppins">Edit Application</h2>
        
        <form action="{{ route('application-forms.update', $application->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <!-- Student Details Section -->
            <div class="mb-6">
                <h2 class="text-xl font-semibold text-white bg-green-600 p-2 rounded-t-lg font-poppins">Student Details</h2>
                <div class="bg-gray-100 p-4 rounded-b-lg font-poppins">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block mb-2 font-bold">Student:</label>
                            <select name="student_id" class="select p-2 border rounded w-full">
                                @foreach($students as $student)
                                    <option value="{{ $student->id }}" {{ $student->id == $application->student_id ? 'selected' : '' }}>{{ $student->first_name }} {{ $student->last_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block mb-2 font-bold">Age:</label>
                            <input type="number" name="student[age]" value="{{ $application->student->age }}" class="w-full p-2 border rounded" min="0" max="99">
                        </div>
                        <div>
                            <label class="block mb-2 font-bold">Sex:</label>
                            <input type="text" name="student[sex]" value="{{ $application->student->sex }}" class="w-full p-2 border rounded">
                        </div>
                        <div>
                            <label class="block mb-2 font-bold">Contact Number:</label>
                            <input type="text" name="student[contact_number]" value="{{ $application->student->contact_number }}" class="w-full p-2 border rounded">
                        </div>
                        <div>
                            <label class="block mb-2 font-bold">Email:</label>
                            <input type="email" name="student[email]" value="{{ $application->student->email }}" class="w-full p-2 border rounded">
                        </div>
                        <div>
                            <label class="block mb-2 font-bold">Address:</label>
                            <input type="text" name="student[address]" value="{{ $application->student->address }}" class="w-full p-2 border rounded">
                        </div>
                        <div>
                            <label class="block mb-2 font-bold">Religion:</label>
                            <input type="text" name="student[religion]" value="{{ $application->student->religion }}" class="w-full p-2 border rounded">
                        </div>
                        <div>
                            <label class="block mb-2 font-bold">Sports:</label>
                            <input type="text" name="student[sports]" value="{{ $application->student->sports }}" class="w-full p-2 border rounded">
                        </div>
                        <div>
                            <label class="block mb-2 font-bold">Residency Status:</label>
                            <input type="text" name="student[residency_status]" value="{{ $application->student->residency_status }}" class="w-full p-2 border rounded">
                        </div>
                        <div>
                            <label class="block mb-2 font-bold">District:</label>
                            <input type="text" name="student[district]" value="{{ $application->student->district }}" class="w-full p-2 border rounded">
                        </div>
                        <div>
                            <label class="block mb-2 font-bold">Barangay:</label>
                            <input type="text" name="student[barangay]" value="{{ $application->student->barangay }}" class="w-full p-2 border rounded">
                        </div>
                        <div>
                            <label class="block mb-2 font-bold">Non-Pasig Resident:</label>
                            <input type="text" name="student[non_pasig_resident]" value="{{ $application->student->non_pasig_resident }}" class="w-full p-2 border rounded">
                        </div>
                        <div>
                            <label class="block mb-2 font-bold">Talents:</label>
                            <input type="text" name="student[talents]" value="{{ $application->student->talents }}" class="w-full p-2 border rounded">
                        </div>
                        <div>
                            <label class="block mb-2 font-bold">Strand:</label>
                            <input type="text" name="student[strand]" value="{{ $application->student->strand }}" class="w-full p-2 border rounded">
                        </div>
                        <div>
                            <label class="block mb-2 font-bold">Salary:</label>
                            <input type="text" name="student[salary]" value="{{ $application->student->salary }}" class="w-full p-2 border rounded">
                        </div>
                    </div>
                </div>
            </div>

            <!-- School Details Section -->
            <div class="mb-6">
                <h2 class="text-xl font-semibold text-white bg-green-600 p-2 rounded-t-lg font-poppins">School Details</h2>
                <div class="bg-gray-100 p-4 rounded-b-lg font-poppins">
                    @foreach($application->student->schools as $school)
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block mb-2 font-bold">School Type:</label>
                            <input type="text" name="schools[{{ $school->id }}][school_type]" value="{{ $school->school_type }}" class="w-full p-2 border rounded">
                        </div>
                        <div>
                            <label class="block mb-2 font-bold">Public School:</label>
                            <input type="text" name="schools[{{ $school->id }}][public_school]" value="{{ $school->public_school }}" class="w-full p-2 border rounded">
                        </div>
                        <div>
                            <label class="block mb-2 font-bold">Other School:</label>
                            <input type="text" name="schools[{{ $school->id }}][other_school]" value="{{ $school->other_school }}" class="w-full p-2 border rounded">
                        </div>
                        <div>
                            <label class="block mb-2 font-bold">Private School:</label>
                            <input type="text" name="schools[{{ $school->id }}][private_school]" value="{{ $school->private_school }}" class="w-full p-2 border rounded">
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Parent/Guardian Details Section -->
            <div class="mb-6">
                <h2 class="text-xl font-semibold text-white bg-green-600 p-2 rounded-t-lg font-poppins">Parent/Guardian Details</h2>
                <div class="bg-gray-100 p-4 rounded-b-lg font-poppins">
                    @foreach($application->student->parentsGuardians as $parentGuardian)
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block mb-2 font-bold">Type:</label>
                            <input type="text" name="parents_guardians[{{ $parentGuardian->id }}][type]" value="{{ $parentGuardian->type }}" class="w-full p-2 border rounded">
                        </div>
                        <div>
                            <label class="block mb-2 font-bold">Last Name:</label>
                            <input type="text" name="parents_guardians[{{ $parentGuardian->id }}][last_name]" value="{{ $parentGuardian->last_name }}" class="w-full p-2 border rounded">
                        </div>
                        <div>
                            <label class="block mb-2 font-bold">First Name:</label>
                            <input type="text" name="parents_guardians[{{ $parentGuardian->id }}][first_name]" value="{{ $parentGuardian->first_name }}" class="w-full p-2 border rounded">
                        </div>
                        <div>
                            <label class="block mb-2 font-bold">Middle Name:</label>
                            <input type="text" name="parents_guardians[{{ $parentGuardian->id }}][middle_name]" value="{{ $parentGuardian->middle_name }}" class="w-full p-2 border rounded">
                        </div>
                        <div>
                            <label class="block mb-2 font-bold">Suffix:</label>
                            <input type="text" name="parents_guardians[{{ $parentGuardian->id }}][suffix]" value="{{ $parentGuardian->suffix }}" class="w-full p-2 border rounded">
                        </div>
                        <div>
                            <label class="block mb-2 font-bold">Age:</label>
                            <input type="number" name="parents_guardians[{{ $parentGuardian->id }}][age]" value="{{ $parentGuardian->age }}" class="w-full p-2 border rounded" min="0" max="99">
                        </div>
                        <div>
                            <label class="block mb-2 font-bold">Contact Number:</label>
                            <input type="text" name="parents_guardians[{{ $parentGuardian->id }}][contact_number]" value="{{ $parentGuardian->contact_number }}" class="w-full p-2 border rounded">
                        </div>
                        <div>
                            <label class="block mb-2 font-bold">Email:</label>
                            <input type="email" name="parents_guardians[{{ $parentGuardian->id }}][email]" value="{{ $parentGuardian->email }}" class="w-full p-2 border rounded">
                        </div>
                        <div>
                            <label class="block mb-2 font-bold">Address:</label>
                            <input type="text" name="parents_guardians[{{ $parentGuardian->id }}][address]" value="{{ $parentGuardian->address }}" class="w-full p-2 border rounded">
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Application Details Section -->
            <div class="mb-6">
                <h2 class="text-xl font-semibold text-white bg-green-600 p-2 rounded-t-lg font-poppins">Application Details</h2>
                <div class="bg-gray-100 p-4 rounded-b-lg font-poppins">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block mb-2 font-bold">Science Grade:</label>
                            <input type="number" name="application[science_grade]" value="{{ $application->science_grade }}" class="w-full p-2 border rounded" min="0" max="99">
                        </div>
                        <div>
                            <label class="block mb-2 font-bold">Mathematics Grade:</label>
                            <input type="number" name="application[mathematics_grade]" value="{{ $application->mathematics_grade }}" class="w-full p-2 border rounded" min="0" max="99">
                        </div>
                        <div>
                            <label class="block mb-2 font-bold">English Grade:</label>
                            <input type="number" name="application[english_grade]" value="{{ $application->english_grade }}" class="w-full p-2 border rounded" min="0" max="99">
                        </div>
                        <div>
                            <label class="block mb-2 font-bold">Overall Grade:</label>
                            <input type="number" name="application[overall_grade]" value="{{ $application->overall_grade }}" class="w-full p-2 border rounded" min="0" max="99">
                        </div>
                        <div>
                            <label class="block mb-2 font-bold">First Choice:</label>
                            <input type="text" name="application[first_choice]" value="{{ $application->first_choice }}" class="w-full p-2 border rounded">
                        </div>
                        <div>
                            <label class="block mb-2 font-bold">Second Choice:</label>
                            <input type="text" name="application[second_choice]" value="{{ $application->second_choice }}" class="w-full p-2 border rounded">
                        </div>
                        <div>
                            <label class="block mb-2 font-bold">Third Choice:</label>
                            <input type="text" name="application[third_choice]" value="{{ $application->third_choice }}" class="w-full p-2 border rounded">
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-right">
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded font-poppins mt-5">Update</button>
            </div>
        </form>
    </div>
</div>
@endsection