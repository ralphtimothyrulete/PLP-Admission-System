<x-layout>
    <x-slot:heading>
        Home
    </x-slot:heading>
    <div class="hero bg-base-100 min-h-screen">
        <div class="hero-content text-center font-poppins animate-fade-in">
            <div class="max-w-md">
                <h1 class="text-5xl font-bold animate-slide-in animation-delay-100">Hello there, {{ auth()->user()->name }}!</h1>
                <p class="py-6 animate-fade-in animation-delay-200">
                    Welcome to the PLP Admission Website. This is a simple system that allows you to apply for admission to the Pamantasan ng Lungsod ng Pasig.
                    Click the <b> Get Started </b> to begin your application.
                </p>
                @if(Carbon\Carbon::now()->between(Carbon\Carbon::createFromDate(Carbon\Carbon::now()->year - 1, 12, 1), Carbon\Carbon::createFromDate(Carbon\Carbon::now()->year, 6, 31)))
                    <a class="btn btn-primary-consistent text-gray-100 font-bold animate-pulse animation-delay-300" onclick="this.innerHTML='Loading...'" href="{{ route('admission.index') }}">Get Started</a>
                @else
                    <p class="text-red-600" aria-live="polite">Admissions are currently closed.</p>
                @endif
            </div>
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
</x-layout>