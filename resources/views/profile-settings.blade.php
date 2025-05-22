@extends('components.master')

@section('body')
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold mb-4">Profile Settings</h1>
        <hr class="mb-4" />

        <!-- Update Name and Email -->
        <form method="POST" action="{{ route('profile-settings.update') }}" class="mb-6">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="label">
                    <span class="text-base label-text font-bold font-poppins label-text-consistent">Name</span>
                </label>
                <input name="name" type="text" value="{{ auth()->user()->name }}" class="w-full input input-bordered font-poppins" />
                @error('name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label class="label">
                    <span class="text-base label-text font-bold font-poppins label-text-consistent">Email</span>
                </label>
                <input name="email" type="email" value="{{ auth()->user()->email }}" class="w-full input input-bordered font-poppins" />
                @error('email')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-consistent w-full button-hover">Update Profile</button>
        </form>

        <!-- Change Password -->
        <form method="POST" action="{{ route('profile-settings.change-password') }}">
            @csrf
            <div class="mb-4">
                <label class="label">
                    <span class="text-base label-text font-bold font-poppins label-text-consistent">Current Password</span>
                </label>
                <input name="current_password" type="password" class="w-full input input-bordered font-poppins" />
                @error('current_password')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label class="label">
                    <span class="text-base label-text font-bold font-poppins label-text-consistent">New Password</span>
                </label>
                <input name="new_password" type="password" class="w-full input input-bordered font-poppins" />
                @error('new_password')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label class="label">
                    <span class="text-base label-text font-bold font-poppins label-text-consistent">Confirm New Password</span>
                </label>
                <input name="new_password_confirmation" type="password" class="w-full input input-bordered font-poppins" />
            </div>
            <button type="submit" class="btn btn-consistent w-full button-hover">Change Password</button>
        </form>
    </div>
@endsection