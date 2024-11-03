<x-layout>
    <x-slot:heading>
        Requirements
    </x-slot:heading>
    <main class="container mx-auto mt-8">
        <div class="bg-light-green p-8 rounded-lg mb-4">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-semibold font-poppins mb-4">Requirements</h1>
                    <h2 class="text-xs3 mb-3 font-poppins">FOR INCOMING FRESHMEN</h2>
                </div>
                <a href="{{ route('freshmen-reqs') }}">
                    <button class="bg-black text-white px-4 py-2 rounded-md font-poppins">Upload</button>
                </a>
            </div>
        </div>

        <div class="bg-light-green p-8 rounded-lg mb-4">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-semibold font-poppins mb-4">Requirements</h1>
                    <h2 class="text-xs3 mb-3 font-poppins">FOR TRANSFEREES</h2>
                </div>
                <a href="{{ route('transferee-reqs') }}">
                    <button class="bg-black text-white px-4 py-2 rounded-md font-poppins">Upload</button>
                </a>
            </div>
        </div>
    </main>
</body>
</html>
</x-layout>