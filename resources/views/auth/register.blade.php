<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Sign Up Page</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="w-full p-8 max-w-md bg-white rounded-lg shadow-md ">
      <div class="mb-4 text-center">
        <img src="{{ URL('storage/logo.png') }}" alt="Logo" class="w-24 mx-auto mb-4">
      </div>
      <h1 class="text-3xl font-poppins text-center text-gray-800">Register</h1>
      <form action="{{ route('register.save') }}" method="POST" class="space-y-4">
        @csrf
        <div class="mb-4">
          <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name</label>
          <input name="name" type="text" placeholder="Enter Name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
          @error('name')
            <span class="text-red-600">{{ $message }}</span>
          @enderror
        </div>
        <div class="mb-4">
          <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email Address</label>
          <input name="email" type="email" placeholder="email@gmail.com" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
          @error('email')
            <span class="text-red-600">{{ $message }}</span>
          @enderror
        </div>
        <div class="mb-4">
          <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
          <input name="password" type="password" placeholder="******" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
          @error('password')
            <span class="text-red-600">{{ $message }}</span>
          @enderror
        </div>
        <div class="mb-4">
          <label for="confirm_password" class="block text-gray-700 text-sm font-bold mb-2">Confirm Password</label>
          <input name="password_confirmation" type="password" placeholder="******" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
          @error('password_confirmation')
            <span class="text-red-600">{{ $message }}</span>
          @enderror
        </div>
        <div class="mb-4">
          <button type="submit" class="w-full bg-green-600 hover:bg-green-800 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Create Account</button>
          <p class="text-right font-poppins text-gray-700 dark:text-gray-400 mt-2">Already have an account?
            <a href="{{ route('login') }}" class="font-bold text-green-600 hover:underline green-800">Login</a>
          </p>
    </div>

      <div class="flex items-center w-full my-4 ">
        <hr class="w-full" />
        <p class="px-4">OR</p>
        <hr class="w-full" />
      </div>

      <div class="my-6 space-y-2">
                <button aria-label="Login with Google" type="button" class="bg-white text-gray-700 font-bold py-2 px-4 rounded border border-gray-300 shadow-md focus:outline-none focus:shadow-outline flex items-center justify-center w-full ">
                    <img src="{{ URL('storage/google.png') }}" alt="Google" class="w-5 h-5 mr-2">
                    <p>Sign up with Google</p>
                </button>
            </div>
      </div>
    </form>
  </div>
</body>
</html>