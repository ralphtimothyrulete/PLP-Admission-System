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
    <title>Request a password reset email</title>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="w-full max-w-md bg-white rounded-lg shadow-md p-8">
        <div class="mb-4 text-center">
            <img src="/storage/logo.png" alt="Logo" class="w-24 mx-auto mb-4">
        </div>
        <h1 class="text-3xl font-poppins text-center text-gray-800">Request Password Email</h1>

        @if (session('status'))
            <flashMsg msg="{{ session ('status') }}" />
        @endif
        
        <form action="{{ route('password.request') }}" method="POST" class="space-y-4">
            @csrf

            <div class="font-poppins">
                <label for="email" class="block text-gray-700 text-sm font-bold mb-2 mt-4">Email Address</label>
                <input type="text" id="email" name="email" placeholder="Email"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                       value="{{ old('email') }}"
                    class="input @error('email') ring-red-500 @enderror">

                @error('email')
                    <p class="text-red-500 text-xs font-poppins">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-4 font-poppins">
                <button type="submit" class="w-full bg-green-600 hover:bg-green-800 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Request Password Reset</button>
            </div>
        </form>
    </div>
</body>
</html>
