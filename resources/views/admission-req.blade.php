<x-layout>
    <x-slot:heading>
        Requirements
    </x-slot:heading>
    <main class="container mx-auto mt-8 px-4 sm:px-6 lg:px-8">
        @if(isset($error))
            <div id="errorModal" class="modal-show fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center font-poppins p-4 sm:p-6 lg:p-8">
                <div class="bg-white p-6 rounded-lg shadow-lg text-center w-full sm:w-auto card-appear">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-16 h-16 mx-auto">
                        <path fill="red" d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zm0-384c13.3 0 24 10.7 24 24l0 112c0 13.3-10.7 24-24 24s-24-10.7-24-24l0-112c0-13.3 10.7-24 24-24zM224 352a32 32 0 1 1 64 0 32 32 0 1 1 -64 0z"/>
                    </svg>
                    <h2 class="text-3xl font-bold mb-2">Error</h2>
                    <p class="text-gray-700 mb-4">{{ $error }}</p>
                    <button onclick="closeModal()" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded w-full sm:w-auto button-hover">Close</button>
                </div>
            </div>
        @endif

        <div class="bg-light-green p-8 rounded-lg mb-4">
            <div class="flex flex-col sm:flex-row justify-between items-center">
                <div>
                    <h1 class="text-2xl font-semibold font-poppins mb-4 text-consistent">Requirements</h1>
                    <h2 class="text-xs3 mb-3 font-poppins text-consistent">FOR INCOMING FRESHMEN</h2>
                </div>
                <a href="{{ route('freshmen-reqs') }}">
                    <button class="button-Hover bg-black text-white px-4 py-2 rounded-md font-poppins w-full sm:w-auto transition-all">Upload</button>
                </a>
            </div>
        </div>

        <div class="bg-light-green p-8 rounded-lg mb-4">
            <div class="flex flex-col sm:flex-row justify-between items-center">
                <div>
                    <h1 class="text-2xl font-semibold font-poppins mb-4 text-consistent">Requirements</h1>
                    <h2 class="text-xs3 mb-3 font-poppins text-consistent">FOR TRANSFEREES</h2>
                </div>
                <a href="{{ route('transferee-reqs') }}">
                    <button class="button-Hover bg-black text-white px-4 py-2 rounded-md font-poppins w-full sm:w-auto transition-all">Upload</button>
                </a>
            </div>
        </div>
    </main>
</x-layout>

<script>
    function closeModal() {
    const modal = document.getElementById('errorModal');
    if (modal) {
        modal.style.animation = 'smoothFade 0.5s ease-out reverse';
        setTimeout(() => { modal.style.display = 'none'; }, 500); // Match animation duration
    }
}
</script>
