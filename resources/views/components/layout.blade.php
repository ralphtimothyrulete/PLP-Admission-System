<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  @vite('resources/css/app.css')
  <link rel="stylesheet" href="{{ ('css/app.css') }}">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet"/>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  <title>{{ $heading ?? 'Home' }}</title>
</head>

<body class="h-full">
<div id="notifications" class="absolute top-0 right-0 p-4 z-50"></div>
  <div class="min-h-full pb-16 md:pb-0">
    <nav class="bg-white shadow-md">
      <div class="mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
          <div class="flex-shrink-0">
            <img class="h-12 w-12" src="{{ URL('storage/logo.png') }}" alt="Logo">
          </div>
          <div class="hidden md:flex items-center">
            <div class="flex items-baseline space-x-8">
              <x-nav-link href="/" :active="request()->is('/')">Home</x-nav-link>
              <x-nav-link href="/admission" :active="request()->is('admission')">Admission</x-nav-link>
              <x-nav-link href="/admission-req" :active="request()->is('admission-req')">Requirements</x-nav-link>
            </div>
          </div>
          <!-- User Profile and Notifications -->
          <div class="flex items-center space-x-4">
            <!-- Profile Menu -->
            <div class="dropdown dropdown-end">
              <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
                <div class="w-10 rounded-full">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                    <path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512l388.6 0c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304l-91.4 0z" src="{{ URL('storage/app/public/user.png') }}" /> 
                  </svg>
                </div>
              </div>
              <ul tabindex="0" class="menu menu-sm dropdown-content bg-base-100 rounded-box z-[1] mt-3 w-52 p-2 shadow">
                <li><a href="{{ route('profile') }}">Profile</a></li>
                <li><a href="{{ route('change-password.form') }}">Change Password</a></li>
                <li><a href="{{ route('logout') }}">Logout</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </nav>

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

    <footer class="footer footer-center bg-light-green text-primary-content rounded p-10 font-poppins animate-fade-in">
    <nav>
        <h6 class="footer-title text-black transition-colors duration-300 hover:text-green-700">Socials</h6>
        <div class="grid grid-flow-col gap-4">
          <a href="https://www.facebook.com/pamantasannglungsodngpasig" class="social-icon group transition-transform duration-300 hover:scale-110 hover:animate-glow">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="fill-gray">
              <path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"></path>
            </svg>
          </a>
          <a href="https://www.youtube.com/@pamantasannglungsodngpasig81" class="social-icon group transition-transform duration-300 hover:scale-110 hover:animate-glow">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="fill-gray">
              <path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"></path>
            </svg>
          </a>
        </div>
      </nav>
      <aside>
        <p class="text-gray-800 transition-colors duration-300 hover:text-green-700">Pamantasan ng Lungsod ng Pasig</p>
        <p class="text-gray-800 transition-colors duration-300 hover:text-green-700">Copyright © 2025 All right reserved</p>
      </aside>
    </footer>
  </div>

  <!-- Sticky Bottom Navigation Bar -->
  <nav class="fixed bottom-0 left-0 right-0 bg-white shadow-md md:hidden">
    <div class="flex justify-around items-center py-2">
      <x-nav-link href="/" :active="request()->is('/')">
        <i class="fas fa-home text-xl"></i>
        <span class="text-sm">Home</span>
      </x-nav-link>
      <x-nav-link href="/admission" :active="request()->is('admission')">
        <i class="fas fa-graduation-cap text-xl"></i>
        <span class="text-sm">Admission</span>
      </x-nav-link>
      <x-nav-link href="/admission-req" :active="request()->is('admission-req')">
        <i class="fas fa-list text-xl"></i>
        <span class="text-sm">Requirements</span>
      </x-nav-link>
  </nav>

  <script>
    // Set form: x-data="formSubmit" @submit.prevent="submit" and button: x-ref="btn"
    document.addEventListener('alpine:init', () => {
      Alpine.data('formSubmit', () => ({
        submit() {
          this.$refs.btn.disabled = true;
          this.$refs.btn.classList.remove('bg-indigo-600', 'hover:bg-indigo-700');
          this.$refs.btn.classList.add('bg-indigo-400');
          this.$refs.btn.innerHTML = `<span class="absolute left-2 top-1/2 -translate-y-1/2 transform"><i class="fa-solid fa-spinner animate-spin"></i></span>Please wait...`;
          this.$el.submit();
        }
      }));
    });
  </script>
</body>
</html>