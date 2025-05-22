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

        @if (session('message'))
            <x-flashMsg msg="{{ session('message') }}" />
        @endif
        
        <h1 class="text-3xl font-poppins text-center text-gray-800">Please verify the email we've sent you</h1>

        <form action="{{ route('verification.send') }}" method="POST" class="space-y-4">
            @csrf

            <div class="font-poppins">
                <p class="mb-4 text-black">Didn't get the email?</p>
            </div>

            <div class="mb-4 font-poppins">
                <button type="submit" class="w-full bg-green-600 hover:bg-green-800 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Send the email verification again</button>
            </div>
        </form>
    </div>
</body>
</html>
