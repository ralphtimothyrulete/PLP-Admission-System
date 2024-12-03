<x-layout>
    <x-slot:heading>
        Profile
    </x-slot:heading>
<hr />
<form method="POST" enctype="multipart/form-data" action="">
<div>
        <label class="label">
            <span class="text-base label-text font-bold font-poppins">ID</span>
        </label>
        <input name="name" type="text" value="{{ auth()->user()->id }}" class="w-full input input-bordered font-poppins" />
    </div>
    <div>
        <label class="label">
            <span class="text-base label-text font-bold font-poppins">Name</span>
        </label>
        <input name="name" type="text" value="{{ auth()->user()->name }}" class="w-full input input-bordered font-poppins" />
    </div>
    <div>
        <label class="label">
            <span class="text-base label-text font-bold font-poppins">Email</span>
        </label>
        <input name="email" type="text" value="{{ auth()->user()->email }}" class="w-full input input-bordered font-poppins" />
    </div>
    <div class="mt-6">
        <button type="submit" class="btn btn-block bg-green-600 hover:bg-green-700 font-poppins text-white">Save Profile</button>
    </div>
</form>
</x-layout>