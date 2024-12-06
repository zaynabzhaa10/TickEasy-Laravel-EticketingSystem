@extends('layouts.master')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white shadow-lg rounded-lg p-6">
            <h1 class="text-3xl font-semibold">Edit Profile</h1>
            <form action="{{ route('profile.update') }}" method="POST" class="mt-6 space-y-6">
                @csrf
                @method('PUT')
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" name="name" value="{{ Auth::user()->name }}" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg" required>
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" value="{{ Auth::user()->email }}" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg" required>
                </div>
                <div>
                    <button type="submit" class="bg-pink-600 text-white px-4 py-2 rounded-md hover:bg-pink-700">Update Profile</button>
                </div>
            </form>
        </div>

        <div class="bg-white shadow-lg rounded-lg p-6 mt-8">
            <h1 class="text-3xl font-semibold">Change Password</h1>
            <form action="{{ route('profile.update.password') }}" method="POST" class="mt-6 space-y-6">
                @csrf
                @method('PUT')
                <div>
                    <label for="current_password" class="block text-sm font-medium text-gray-700">Current Password</label>
                    <input type="password" name="current_password" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg" required>
                </div>
                <div>
                    <label for="new_password" class="block text-sm font-medium text-gray-700">New Password</label>
                    <input type="password" name="new_password" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg" required>
                </div>
                <div>
                    <label for="new_password_confirmation" class="block text-sm font-medium text-gray-700">Confirm New Password</label>
                    <input type="password" name="new_password_confirmation" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg" required>
                </div>
                <div>
                    <button type="submit" class="bg-pink-600 text-white px-4 py-2 rounded-md hover:bg-pink-700">Change Password</button>
                </div>
            </form>
        </div>
    </div>
@endsection
