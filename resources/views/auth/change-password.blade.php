<x-layout>
    <x-slot:heading>
        Change Password
    </x-slot:heading>
    <hr />
    <form action="{{ route('change-password') }}" method="POST" enctype="multipart/form-data">
        @csrf

        @if (session('status'))
            <div class="text-green-600 text-center mb-4">
                {{ session('status') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="text-red-600 text-center mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="mb-4">
            <label class="label">
                <span class="text-base label-text font-bold font-poppins label-text-consistent">Current Password</span>
            </label>
            <input name="current_password" type="password" placeholder="Current Password" class="w-full input input-bordered font-poppins" required>
        </div>
        <div class="mb-4">
            <label class="label">
                <span class="text-base label-text font-bold font-poppins label-text-consistent">New Password</span>
            </label>
            <input name="new_password" type="password" placeholder="New Password" class="w-full input input-bordered font-poppins" required>
        </div>
        <div class="mb-4">
            <label class="label">
                <span class="text-base label-text font-bold font-poppins label-text-consistent">Confirm New Password</span>
            </label>
            <input name="new_password_confirmation" type="password" placeholder="Confirm New Password" class="w-full input input-bordered font-poppins" required>
        </div>
        <div class="mt-6">
            <button type="submit" class="btn btn-block btn-consistent font-poppins button-hover">Save Changes</button>
        </div>
    </form>
</x-layout>