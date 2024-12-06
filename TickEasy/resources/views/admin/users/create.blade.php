<!-- resources/views/admin/users/create.blade.php -->
@extends('layouts.master')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-semibold">Add User</h1>
        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf
            <div class="mt-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" name="name" id="name" class="mt-1 block w-full">
            </div>
            <div class="mt-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" class="mt-1 block w-full">
            </div>
            <div class="mt-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password" id="password" class="mt-1 block w-full">
            </div>
            <div class="mt-4">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="mt-1 block w-full">
            </div>
            <div class="mt-4">
                <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
                <select name="role" id="role" class="mt-1 block w-full">
                    
                    <option value="organizer">Organizer</option>
                    <option value="user">User</option>
                </select>
            </div>
            <div class="mt-4">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2">Add User</button>
            </div>
        </form>
    </div>
@endsection