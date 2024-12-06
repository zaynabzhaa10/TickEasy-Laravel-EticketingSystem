@extends('layouts.master')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-semibold">User Management</h1>
        @if (session('success'))
            <div class="bg-green-500 text-white p-4 mb-4">
                {{ session('success') }}
            </div>
        @endif
        <div class="mb-4">
            <br>
            <a href="{{ route('admin.users.create') }}" class="bg-pink-500 text-white px-4 py-2">Add User</a>
        </div>
        <table class="min-w-full table-auto mt-4">
            <thead>
                <tr>
                    <th class="px-6 py-2 text-left">ID</th>
                    <th class="px-6 py-2 text-left">Name</th>
                    <th class="px-6 py-2 text-left">Email</th>
                    <th class="px-6 py-2 text-left">Role</th>
                    <th class="px-6 py-2 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td class="px-6 py-2">{{ $user->id }}</td>
                        <td class="px-6 py-2">{{ $user->name }}</td>
                        <td class="px-6 py-2">{{ $user->email }}</td>
                        <td class="px-6 py-2">{{ $user->role }}</td>
                        <td class="px-6 py-2">
                            <a href="{{ route('admin.users.edit', $user->id) }}" class="inline-block">
                                <button class="bg-pink-500 text-white px-4 py-2 rounded-md hover:bg-pink-700">Edit</button>
                            </a>
                            @if ($user->role !== 'admin')
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-700">Delete</button>
                                </form>
                            @else
                                <button class="bg-gray-500 text-white px-4 py-2 rounded-md cursor-not-allowed" disabled>Delete</button>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection