@extends('components.master')

@section('body')
<main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
    <div class="container px-6 py-8 mx-auto">
        <h3 class="text-3xl font-bold text-black">Analytics ({{ session('year', date('Y')) }})</h3>

        <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="bg-white p-4 rounded-lg shadow-md  ">
                <h4 class="text-xl font-semibold text-gray-800">Total Applications</h4>
                <p class="mt-1">{{ $totalApplications }}</p>
            </div>
            <div class="bg-white p-4 rounded-lg shadow-md">
                <h4 class="text-xl font-semibold text-gray-800">Gender Distribution</h4>
                <p class="mt-1">Male: {{ $maleCount }}</p>
                <p class="mt-1">Female: {{ $femaleCount }}</p>
            </div>
            <div class="bg-white p-4 rounded-lg shadow-md ">
                <h4 class="text-xl font-semibold text-gray-800">Pasigueños</h4>
                <p class="mt-1">{{ $pasiguenosCount }}</p>
            </div>
            <div class="bg-white p-4 rounded-lg shadow-md ">
                <h4 class="text-xl font-semibold text-gray-800">Non-Pasigueños</h4>
                <p class="mt-1">{{ $nonPasiguenosCount }}</p>
            </div>
            <div class="bg-white p-4 rounded-lg shadow-md">
                <h4 class="text-xl font-semibold text-gray-800">Religion Distribution</h4>
                @foreach($religionDistribution as $religion)
                    <p class="mt-1">{{ $religion->religion }}: {{ $religion->total }}</p>
                @endforeach
            </div>
            <div class="bg-white p-4 rounded-lg shadow-md">
                <h4 class="text-xl font-semibold text-gray-800">First Choice Programs</h4>
                @foreach($firstChoicePrograms as $program)
                    <p class="mt-1">{{ $program->first_choice }}: {{ $program->total }}</p>
                @endforeach
            </div>
            <div class="bg-white p-4 rounded-lg shadow-md ">
                <h4 class="text-xl font-semibold text-gray-800">Average Grades</h4>
                <p class="mt-1">Science: {{ $averageGrades->avg_science }}</p>
                <p class="mt-1">Math: {{ $averageGrades->avg_math }}</p>
                <p class="mt-1">English: {{ $averageGrades->avg_english }}</p>
                <p class="mt-1">Overall: {{ $averageGrades->avg_overall }}</p>
            </div>
            <div class="bg-white p-4 rounded-lg shadow-md ">
                <h4 class="text-xl font-semibold text-gray-800">Income Distribution</h4>
                @foreach($incomeDistribution as $income)
                    <p class="mt-1">{{ $income->salary }}: {{ $income->total }}</p>
                @endforeach
            </div>
            <div class="bg-white p-4 rounded-lg shadow-md">
                <h4 class="text-xl font-semibold text-gray-800">Strand Distribution</h4>
                @foreach($strandDistribution as $strand)
                    <p class="mt-1">{{ $strand->strand }}: {{ $strand->total }}</p>
                @endforeach
            </div>
            <div class="bg-white p-4 rounded-lg shadow-md">
                <h4 class="text-xl font-semibold text-gray-800">Applicants by School Type</h4>
                @foreach($schoolTypeDistribution as $schoolType)
                    <p class="mt-1">{{ $schoolType->school_type }}: {{ $schoolType->total }}</p>
                @endforeach
            </div>
            <div class="bg-white p-4 rounded-lg shadow-md">
                <h4 class="text-xl font-semibold text-gray-800">Sports Participation</h4>
                @foreach($sportsParticipation as $sport)
                    <p class="mt-1">{{ $sport->sports }}: {{ $sport->total }}</p>
                @endforeach
            </div>
            <div class="bg-white p-4 rounded-lg shadow-md">
                <h4 class="text-xl font-semibold text-gray-800">Talent Distribution</h4>
                @foreach($talentsDistribution as $talent)
                    <p class="mt-1">{{ $talent->talents }}: {{ $talent->total }}</p>
                @endforeach
            </div>
            <div class="bg-white p-4 rounded-lg shadow-md">
                <h4 class="text-xl font-semibold text-gray-800">Residency by Barangay</h4>
                @foreach($residencyByBarangay as $barangay)
                    <p class="mt-1">{{ $barangay->barangay }}: {{ $barangay->total }}</p>
                @endforeach
            </div>
            <div class="bg-white p-4 rounded-lg shadow-md">
                <h4 class="text-xl font-semibold text-gray-800">Choice Frequency</h4>
                @foreach($choiceFrequency as $choice)
                    <p class="mt-1">{{ $choice->choice }}: {{ $choice->total }}</p>
                @endforeach
            </div>
        </div>
    </div>
</main>
@endsection