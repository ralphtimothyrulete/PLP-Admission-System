<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  @vite('resources/css/app.css')
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script> 
  <title>Sign Up Page</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="w-full p-8 max-w-md bg-white rounded-lg shadow-md animate-fade-in mx-4">
      <div class="mb-4 text-center">
        <img src="{{ URL('storage/app/public/logo.png') }}" alt="Logo" class="w-24 mx-auto mb-4">
      </div>
       
      <h1 class="text-3xl font-poppins text-center text-gray-800">Register</h1>

      @if (session('status'))
        <flashMsg msg="{{ session ('status') }}" />
      @endif

      @if (session('error'))
        <div class="text-red-600 text-center mb-4">
            {{ session('error') }}
        </div>
      @endif

      <form action="{{ route('register.save') }}" method="POST" class="space-y-4"
        x-data="formSubmit" @submit.prevent="submit">
        @csrf
        <div class="mb-4 font-poppins">
          <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name</label>
          <input name="name" type="text" placeholder="Enter Name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
          @error('name')
            <span class="text-red-600">{{ $message }}</span>
          @enderror
        </div>
        <div class="mb-4 font-poppins">
          <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email Address</label>
          <input name="email" type="email" placeholder="email@gmail.com" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
          @error('email')
            <span class="text-red-600">{{ $message }}</span>
          @enderror
        </div>
        <div class="mb-4 font-poppins">
          <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
          <div class="relative">
            <input name="password" type="password" placeholder="******" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            <span class="absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer" onclick="togglePasswordVisibility('password')">
              <i class="fas fa-eye"></i>
            </span>
          </div>
          @error('password')
            <span class="text-red-600">{{ $message }}</span>
          @enderror
        </div>
        <div class="mb-4 font-poppins">
          <label for="confirm_password" class="block text-gray-700 text-sm font-bold mb-2">Confirm Password</label>
          <div class="relative">
            <input name="password_confirmation" type="password" placeholder="******" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            <span class="absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer" onclick="togglePasswordVisibility('password_confirmation')">
              <i class="fas fa-eye"></i>
            </span>
          </div>
          @error('password_confirmation')
            <span class="text-red-600">{{ $message }}</span>
          @enderror
        </div>
        <input type="hidden" name="role" value="user">
        <div class="mb-4 font-poppins">
          <button type="submit" x-ref="btn" class="w-full bg-green-600 hover:bg-green-800 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Create Account</button>
        </div>

      <div class="flex items-center w-full my-4 font-poppins">
        <hr class="w-full" />
        <p class="px-4 text-black">OR</p>
        <hr class="w-full" />
      </div>

      <div class="mb-4 font-poppins">
          <p class="text-center font-poppins text-gray-900 dark:text-gray-400 mt-2">Already have an account?
            <a href="{{ route('login') }}" class="font-bold text-green-600 hover:underline green-800">Login</a>
          </p>
        </div>
    </form>
  </div>

  <script>
      document.addEventListener('alpine:init', () => {
        Alpine.data('formSubmit', () => ({
            submit() {
                // Disable button to prevent multiple submissions
                this.$refs.btn.disabled = true;
                this.$refs.btn.classList.remove('bg-green-600', 'hover:bg-green-800');
                this.$refs.btn.classList.add('bg-green-400');

                // Use a template literal for the spinner and text
                this.$refs.btn.innerHTML = `
                    <i class="fas fa-spinner fa-spin mr-2"></i>
                    Please wait...
                `;

                // Submit the form
                this.$el.submit();
            }
        }));
    });

    function togglePasswordVisibility(id) {
      const input = document.querySelector(`input[name="${id}"]`);
      const icon = input.nextElementSibling.querySelector('i');
      if (input.type === 'password') {
        input.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
      } else {
        input.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
      }
    }
  </script>
</body>
</html>