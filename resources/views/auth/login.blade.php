<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    @vite('resources/css/app.css')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script> 
    <title>Login Page</title>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="w-full max-w-4xl bg-white rounded-lg shadow-md flex flex-col md:flex-row overflow-hidden animate-fade-in mx-4">
        <!-- Left Panel -->
        <div class="w-full md:w-1/2 bg-light-green text-white p-8 flex flex-col justify-center items-center">
            <img src="/storage/app/public/logo.png" alt="Logo" class="w-24 mb-4">
            <p class="text-lg text-black font-semibold font-poppins">Student Admission Portal</p>
        </div>
        <!-- Right Panel -->
        <div class="w-full md:w-1/2 p-8">
            <h1 class="text-3xl font-poppins text-center text-gray-800 mb-4">Login</h1>
            <form action="{{ route('login.action') }}" method="POST" class="space-y-4" x-data="formSubmit" @submit.prevent="submit">
                @csrf
                @if ($errors->any())
                <div role="alert" class="alert alert-warning">
                    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <div class="mb-4 font-poppins">
                    <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email Address</label>
                    <input type="email" id="email" name="email" placeholder="Email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>
                <div class="mb-4 font-poppins">
                    <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                    <div class="relative">
                        <input type="password" id="password" name="password" placeholder="Enter Password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        <span class="absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer" onclick="togglePasswordVisibility('password')">
                          <i class="fas fa-eye"></i>
                        </span>
                    </div>
                </div>
                <div class="mb-4 font-poppins">
                    <button id="signInButton" type="submit" x-ref="btn" class="w-full bg-green-600 hover:bg-green-800 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Sign In</button>
                </div>
                <div class="flex items-center justify-between">
                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input name="remember" id="remember" aria-describedby="remember" type="checkbox" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-primary-600 dark:ring-offset-gray-800">
                        </div>
                            <div class="ml-2 text-sm">
                                <label for="remember" class="text-gray-700 font-poppins">Remember me</label>
                            </div>
                    </div>
                        <a href="{{ route('password.request') }}" class=" font-bold text-green-600 hover:underline green-800 font-poppins">Forgot password?</a>
                </div>
                <div class="flex items-center w-full my-4 font-poppins">
                    <hr class="w-full" />
                    <p class="px-3 ">OR</p>
                    <hr class="w-full" />
                </div>
                <div class="text-center font-poppins">
                    <span></span>
                    <span>Don't have an account?</span>
                    <a href="{{ route('register') }}" class="text-green-600 font-bold hover:underline green-800">Register</a>
                </div>
            </form>
        </div>
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