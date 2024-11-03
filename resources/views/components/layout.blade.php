<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  @vite('resources/css/app.css')
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <title>{{ $heading ?? 'Home' }}</title>

  <!-- Include Pusher and Laravel Echo -->
  <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/laravel-echo/1.11.1/echo.iife.min.js"></script>

  <script>
    // Configure Pusher and Echo
    Pusher.logToConsole = true;
    const pusher = new Pusher('{{ env("PUSHER_APP_KEY") }}', {
      cluster: '{{ env("PUSHER_APP_CLUSTER") }}',
      encrypted: true,
    });

    const echo = new Echo({
      broadcaster: 'pusher',
      key: '{{ env("PUSHER_APP_KEY") }}',
      cluster: '{{ env("PUSHER_APP_CLUSTER") }}',
      forceTLS: true
    });

    // Listen for real-time notifications
    echo.private('notifications')
      .listen('AdmissionUpdateEvent', (data) => {
        alert(data.message); // You can customize this to show a better notification
        let notificationArea = document.getElementById('notifications');
        notificationArea.innerHTML += `<div class="notification bg-white p-2 border rounded shadow">${data.message}</div>`;
      });
  </script>
</head>

<body class="h-full">
<div id="notifications" class="absolute top-0 right-0 p-4 z-50"></div>
  <div class="min-h-full">
    <nav class="bg-white shadow-md">
      <div class="mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
          <div class="flex-shrink-0">
            <img class="h-12 w-12" src="{{ URL('storage/logo.png') }}" alt="Logo">
          </div>
          <div class="flex items-center">
            <div class="hidden md:block">
              <div class="flex items-baseline space-x-8">
                <x-nav-link href="/" :active="request()->is('/')">Home</x-nav-link>
                <x-nav-link href="/admission" :active="request()->is('admission')">Admission</x-nav-link>
                <x-nav-link href="/admission-req" :active="request()->is('admission-req')">Requirements</x-nav-link>
              </div>
            </div>
          </div>
          <!-- User Profile and Notifications -->
          <div class="hidden md:flex items-center space-x-4">
            <!-- Notification Icon -->
            <button type="button" class="relative rounded-full bg-black p-1 text-gray-400 hover:text-green-700 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800">
              <span class="sr-only">View notifications</span>
              <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
              </svg>
            </button>
            <!-- Profile Menu -->
            <div class="dropdown dropdown-end">
              <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
                <div class="w-10 rounded-full">
                  <img alt="Avatar" src="{{ URL('storage/user.png') }}" />
                </div>
              </div>
              <ul tabindex="0" class="menu menu-sm dropdown-content bg-base-100 rounded-box z-[1] mt-3 w-52 p-2 shadow">
                <li><a href="{{ route('profile') }}">Profile</a></li>
                <li><a href="#">Settings</a></li>
                <li><a href="{{ route('logout') }}">Logout</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </nav>

    <!-- Mobile menu -->
    <div class="-mr-2 flex md:hidden">
      <button type="button" class="relative inline-flex items-center justify-center rounded-md bg-gray-800 p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800" aria-controls="mobile-menu" aria-expanded="false">
        <span class="sr-only">Open main menu</span>
        <svg class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
          <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
        </svg>
      </button>
    </div>

    <!-- Mobile Menu for small screens -->
    <div class="md:hidden" id="mobile-menu">
      <div class="space-y-1 px-2 pb-3 pt-2 sm:px-3">
        <a href="/" class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Home</a>
        <a href="/admission" class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Admission</a>
        <a href="/academics" class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Academics</a>
      </div>
    </div>

    <!-- Main Content Area -->
    <header class="bg-white shadow">
      <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold tracking-tight text-gray-900">{{ $heading ?? '' }}</h1> <!-- Heading from child template -->
      </div>
    </header>

    <main>
      <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        {{ $slot }}
      </div>
    </main>
  </div>
</body>
</html>
