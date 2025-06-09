<div x-data="{ sidebarOpen: true, dropdownOpen: true }">
    <button @click="sidebarOpen = !sidebarOpen" class="p-2 text-white bg-gray-900 lg:hidden">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
        </svg>
    </button>
    
    <div :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'" class="fixed inset-y-0 left-0 z-30 w-64 overflow-y-auto transition duration-300 transform bg-gray-900 lg:translate-x-0 lg:static lg:inset-0">
        <div class="flex items-center justify-center mt-8">
            <div class="flex items-center">
                <img class="text-h-20 w-14" src="{{ URL('storage/logo.png') }}" alt="Logo">
                <span class="mx-2 text-2xl font-semibold text-white">SSO Admin</span>
            </div>
        </div>  

        <div class="px-6 py-4">
    <form action="{{ route('admin.setSchoolYear') }}" method="POST">
        @csrf
        <label for="year" class="block text-gray-100 font-bold mb-2">School Year</label>
        <select name="year" id="year" class="w-full p-2 rounded bg-gray-800 text-gray-100" onchange="this.form.submit()">
            @foreach(range(date('Y'), 2026) as $year)
                <option value="{{ $year }}" {{ session('year') == $year ? 'selected' : '' }}>{{ $year }}</option>
            @endforeach
        </select>
    </form>
</div>

        <nav class="mt-3">
            <a class="flex items-center px-6 py-2 mt-4 text-gray-100 {{ request()->routeIs('admin.dashboard') ? 'bg-gray-700 bg-opacity-25' : 'hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100' }}" href="{{ route('admin.dashboard') }}">
                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z" />
                </svg>
                <span class="mx-3">Dashboard</span>
            </a>

            <a class="flex items-center px-6 py-2 mt-4 text-gray-100 {{ request()->routeIs('analytics.index') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100' }}" href="{{ route('analytics.index') }}">
                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 14v6m-3-3h6M6 10h2a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2zm10 0h2a2 2 0 002-2V6a2 2 0 00-2-2h-2a2 2 0 00-2 2v2a2 2 0 002 2zM6 20h2a2 2 0 002-2v-2a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2z" />
                </svg>
                <span class="mx-3">Analytics</span>
            </a>

            <div class="relative">
                <a @click="dropdownOpen = !dropdownOpen" class="flex items-center px-6 py-2 mt-4 text-gray-100 {{ request()->routeIs('application-forms.index') || request()->routeIs('requirements.index') || request()->routeIs('entrance-exam-results.index') || request()->routeIs('interview-results.index') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100' }} cursor-pointer">
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                    <span class="mx-3">Application Status</span>
                    <svg class="w-4 h-4 ml-auto" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </a>

                <ul x-show="dropdownOpen" x-cloak class="py-2 space-y-2 text-gray-500">
                    <li>
                        <a href="{{ route('application-forms.index') }}" class="flex items-center w-full p-2 text-base font-normal {{ request()->routeIs('application-forms.index') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700' }} pl-11">Application Forms</a>
                    </li>
                    <li>
                        <a href="{{ route('requirements.index') }}" class="flex items-center w-full p-2 text-base font-normal {{ request()->routeIs('requirements.index') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700' }} pl-11">Requirements</a>
                    </li>
                    <li>
                        <a href="{{ route('entrance-exam-results.index') }}" class="flex items-center w-full p-2 text-base font-normal {{ request()->routeIs('entrance-exam-results.index') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700' }} pl-11">Entrance Exam Result</a>
                    </li>
                    <li>
                        <a href="{{ route('interview-results.index') }}" class="flex items-center w-full p-2 text-base font-normal {{ request()->routeIs('interview-results.index') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700' }} pl-11">Interview Result</a>
                    </li>
                    <li>
                        <a href="{{ route('enrollment-slot.index') }}" class="flex items-center w-full p-2 text-base font-normal {{ request()->routeIs('enrollment-slot.index') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700' }} pl-11">Enrollment Slot</a>
                    </li>
                </ul>
            </div>

            <a class="flex items-center px-6 py-2 mt-4 text-gray-100 {{ request()->routeIs('gwa-ranking.index') ? 'bg-gray-700 bg-opacity-25 text-gray-100' : 'hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100' }}" href="{{ route('gwa-ranking.index') }}">
                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
                <span class="mx-3">GWA Ranking</span>
            </a>
        </nav>
    </div>
</div>