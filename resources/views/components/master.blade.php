<!DOCTYPE html>
<html lang="{{ $page->language ?? 'en' }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="referrer" content="always">
        <link rel="canonical" href="">
        <meta name="description" content="">
        <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2" defer></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <title></title>
        @vite('resources/css/app.css')
        <link rel="stylesheet" href="{{ ('css/app.css') }}">
        <script src="{{ ('js/main.js') }}"></script>
    </head>
    <body>
        <div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-200 font-poppins">
            @include('components.sidebar')
            
            <div class="flex-1 flex flex-col overflow-hidden">
                @include('components.header')

                <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
                    <div class="container mx-auto px-6 py-8">
                        @yield('body')
                    </div>
                </main>
            </div>
        </div>

    @if(session('status'))
        <script>
            toastr.success("{{ session('status') }}");
        </script>
    @endif

    @if($errors->any())
        @foreach($errors->all() as $error)
            <script>
                toastr.error("{{ $error }}");
            </script>
        @endforeach
    @endif
    </body>
</html>