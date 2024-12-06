<!-- resources/views/admin/users/show.blade.php -->
@extends('layouts.master')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-semibold">User Details</h1>
        <div class="mt-4">
            <p><strong>ID:</strong> {{ $user->id }}</p>
            <p><strong>Name:</strong> {{ $user->name }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Role:</strong> {{ $user->role }}</p>
        </div>
        <div class="mt-4">
            <a href="{{ route('admin.users.edit', $user->id) }}" class="text-blue-600 hover:underline">Edit</a>
            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline-block">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-600 hover:underline">Delete</button>
            </form>
        </div>
    </div>
@endsection