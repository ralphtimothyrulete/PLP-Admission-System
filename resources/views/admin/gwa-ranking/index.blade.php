@extends('components.master')

@section('body')
<h3 class="text-3xl font-bold text-black mb-5">GWA Ranking</h3>
<div class="flex justify-between items-center mb-4">
    <!-- Left: Create New GWA Ranking -->
    <div>
        <a href="{{ route('gwa-ranking.create') }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">Create New GWA Ranking</a>
    </div>
    <!-- Right: Filter Programs -->
    <div>
        <form action="{{ route('gwa-ranking.index') }}" method="GET" class="flex items-center">
            <select name="program" class="w-60 p-2 border rounded" onchange="this.form.submit()">
                <option value="">All Programs</option>
                @foreach($programs as $programOption)
                    <option value="{{ $programOption }}" {{ $program == $programOption ? 'selected' : '' }}>
                        {{ $programOption }}
                    </option>
                @endforeach
            </select>
        </form>
    </div>
</div>
<!-- Search Bar -->
<div class="flex justify-end mb-1">
    <form action="{{ route('gwa-ranking.index') }}" method="GET" class="flex items-center">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name or grade" class="w-60 p-2 border rounded">
        <button type="submit" class="ml-2 bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
            <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M21 21L15 15M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </button>
    </form>
</div>
<div class="flex flex-col mt-8">
    <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
        <div class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
            <table class="min-w-full">
                <thead>
                    <tr>
                        <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Rank</th>
                        <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Student ID</th>
                        <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Residency</th>
                        <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">GWA</th>
                        <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Strand</th>
                        <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @foreach($applications as $application)
                    <tr>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                            <div class="text-sm leading-5 font-bold text-gray-900">{{ $application->rank }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                            <div class="text-sm leading-5 font-bold text-gray-900">{{ $application->id }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                            <div class="text-sm leading-5 font-medium text-gray-900">{{ $application->student_id }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                            <div class="text-sm leading-5 text-gray-900">{{ $application->student->first_name }} {{ $application->student->last_name }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                            <div class="text-sm leading-5 text-gray-900">{{ $application->student->residency_status }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                            <div class="px-1 inline-flex text-xs leading-5 font-bold rounded-full bg-green-100 text-green-800">{{ $application->overall_grade }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                            <div class="text-sm leading-5 text-gray-900">{{ $application->student->strand }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap text-left border-b border-gray-200 text-sm leading-5 font-medium">
                            <form action="{{ route('gwa-ranking.destroy', $application->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900 ml-1">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="mt-4">
        {{ $applications->appends(['search' => request('search'), 'program' => $program])->links() }}
    </div>
</div>
@endsection