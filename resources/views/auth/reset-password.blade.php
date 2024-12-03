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
    <title>Sign Up Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="w-full p-8 max-w-md bg-white rounded-lg shadow-md ">
      <div class="mb-4 text-center">
        <img src="{{ URL('storage/logo.png') }}" alt="Logo" class="w-24 mx-auto mb-4">
      </div>
      <h1 class="text-3xl font-poppins text-center text-gray-800">Reset Password</h1>
      <form action="{{ route('password.update') }}" method="POST" class="space-y-4">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">

        <div class="font-poppins">
          <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email Address</label>
          <input name="email" type="email" placeholder="email@gmail.com" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
          @error('email')
            <span class="text-red-600">{{ $message }}</span>
          @enderror
        </div>

        <div class="mb-4 font-poppins">
          <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
          <input name="password" type="password" placeholder="******" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
          @error('password')
            <span class="text-red-600">{{ $message }}</span>
          @enderror
        </div>

        <div class="mb-4 font-poppins">
          <label for="confirm_password" class="block text-gray-700 text-sm font-bold mb-2">Confirm Password</label>
          <input name="password_confirmation" type="password" placeholder="******" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
          @error('password_confirmation')
            <span class="text-red-600">{{ $message }}</span>
          @enderror
        </div>
        
        <div class="mb-4 font-poppins">
          <button type="submit" class="w-full bg-green-600 hover:bg-green-800 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Reset Password</button>
        </div>
    </form>
  </div>
</body>
</html>