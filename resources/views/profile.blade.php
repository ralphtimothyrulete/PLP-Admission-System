<x-layout>
    <x-slot:heading>
        Profile
    </x-slot:heading>
    <hr />
    <form method="POST" enctype="multipart/form-data" action="">
        <div class="mb-4">
            <label class="label">
                <span class="text-base label-text font-bold font-poppins label-text-consistent">Student ID</span>
            </label>
            <input name="name" type="text" value="{{ auth()->user()->id }}" class="w-full input input-bordered font-poppins" readonly />
        </div>
        <div class="mb-4">
            <label class="label">
                <span class="text-base label-text font-bold font-poppins label-text-consistent">Name</span>
            </label>
            <input name="name" type="text" value="{{ auth()->user()->name }}" class="w-full input input-bordered font-poppins" readonly />
        </div>
        <div class="mb-4">
            <label class="label">
                <span class="text-base label-text font-bold font-poppins label-text-consistent">Email</span>
            </label>
            <input name="email" type="text" value="{{ auth()->user()->email }}" class="w-full input input-bordered font-poppins" readonly />
        </div>
    </form>
</x-layout>