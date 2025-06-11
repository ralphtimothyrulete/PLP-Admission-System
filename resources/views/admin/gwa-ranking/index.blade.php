@extends('components.master')

@section('body')
<h3 class="text-3xl font-bold text-black mb-5">GWA Ranking</h3>
<div class="flex justify-between items-start mb-4">
    <div>
        <a href="{{ route('gwa-ranking.create') }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">Create New GWA Ranking</a>
        <div class="mt-5">
            <button onclick="document.getElementById('filterModal').classList.remove('hidden')" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Filter & Export CSV</button>
        </div>
    </div>
    <div class="flex flex-col items-end">
        <form action="{{ route('gwa-ranking.index') }}" method="GET" class="mb-2">
            <select name="program" class="w-60 p-2 border rounded" onchange="this.form.submit()">
                <option value="">All Strands</option>
                @foreach($programs as $programOption)
                    <option value="{{ $programOption }}" {{ $program == $programOption ? 'selected' : '' }}>
                        {{ $programOption }}
                    </option>
                @endforeach
            </select>
        </form>
        <form action="{{ route('gwa-ranking.index') }}" method="GET" class="flex items-center">
            <input type="hidden" name="program" value="{{ $program }}">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name or grade" class="w-60 p-2 border rounded">
            <button type="submit" class="ml-2 bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
                <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M21 21L15 15M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
        </form>
    </div>
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
                            <button onclick="confirmDelete('{{ $application->id }}')" class="text-red-600 hover:text-red-900 ml-1">Delete</button>
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

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="fixed z-10 inset-0 overflow-y-auto hidden">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                        <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </div>
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Delete GWA Ranking</h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500">Are you sure you want to delete this GWA Ranking? This action cannot be undone.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">Delete</button>
                </form>
                <button onclick="closeModal()" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm">Cancel</button>
            </div>
        </div>
    </div>
</div>

<!-- Filter Modal -->
<div id="filterModal" class="fixed z-20 inset-0 overflow-y-auto hidden">
    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-2xl p-6">
            <h2 class="text-xl font-bold mb-4">Filter Data & Export CSV</h2>
            <form action="{{ route('gwa-ranking.export') }}" method="GET">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <h3 class="font-semibold mb-2">Student</h3>
                        <label><input type="checkbox" name="fields[]" value="student.last_name"> Last Name</label><br>
                        <label><input type="checkbox" name="fields[]" value="student.first_name"> First Name</label><br>
                        <label><input type="checkbox" name="fields[]" value="student.residency_status"> Residency Status</label><br>
                        <label><input type="checkbox" name="fields[]" value="student.strand"> Strand</label><br>
                    </div>
                    <div>
                        <h3 class="font-semibold mb-2">Application</h3>
                        <label><input type="checkbox" name="fields[]" value="application.overall_grade"> GWA</label><br>
                        <label><input type="checkbox" name="fields[]" value="application.science_grade"> Science Grade</label><br>
                        <label><input type="checkbox" name="fields[]" value="application.mathematics_grade"> Mathematics Grade</label><br>
                        <label><input type="checkbox" name="fields[]" value="application.english_grade"> English Grade</label><br>
                        <label><input type="checkbox" name="fields[]" value="application.status"> Status</label><br>
                    </div>
                </div>
                <div class="mt-4">
                    <label class="block font-semibold mb-1">Filter by Strand:</label>
                    <select name="program" class="border rounded p-2 w-full">
                        <option value="">-- Any --</option>
                        @foreach($programs as $programOption)
                            <option value="{{ $programOption }}">{{ $programOption }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mt-4">
                    <label class="block font-semibold mb-1">Filter by Status:</label>
                    <select name="status" class="border rounded p-2 w-full">
                        <option value="">-- Any --</option>
                        <option value="Done">Done</option>
                        <option value="Pending">Pending</option>
                    </select>
                </div>
                <div class="mt-6 flex justify-end">
                    <button type="button" onclick="document.getElementById('filterModal').classList.add('hidden')" class="mr-2 px-4 py-2 rounded bg-gray-300">Cancel</button>
                    <button type="submit" class="px-4 py-2 rounded bg-green-600 text-white">Export CSV</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    function confirmDelete(id) {
        document.getElementById('deleteForm').action = '/gwa-ranking/' + id;
        document.getElementById('deleteModal').classList.remove('hidden');
    }
    function closeModal() {
        document.getElementById('deleteModal').classList.add('hidden');
    }
</script>
@endsection