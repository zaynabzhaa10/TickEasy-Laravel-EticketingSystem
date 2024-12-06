@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="w-full max-w-xs mx-4 bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold mb-4">Register as Event Organizer</h2>
        <form method="POST" action="{{ route('register.organizer') }}">
            @csrf

            <!-- Input Nama -->
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Company Name</label>
                <input id="name" type="text" name="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required autofocus>
            </div>

            <!-- Input Email -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Company Email</label>
                <input id="email" type="email" name="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
            </div>

            <!-- Input Password -->
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input id="password" type="password" name="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
            </div>

            <!-- Input Konfirmasi Password -->
            <div class="mb-6">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
            </div>

            <!-- Input Tersembunyi untuk Role -->
            <input type="hidden" name="role" value="organizer">

            <!-- Tombol Register -->
            <button type="submit" class="w-full bg-pink-500 text-dark py-2 px-4 rounded hover:bg-pink-600">
                Register
            </button>

            <!-- Link to Login -->
            <div class="text-center mt-4">
                <span class="text-sm text-gray-600">Already have an account?</span>
                <a href="{{ route('login') }}" class="text-sm text-pink-500 hover:text-pink-700 font-semibold">
                    Login here
                </a>
            </div>
        </form>
    </div>
</div>
@endsection