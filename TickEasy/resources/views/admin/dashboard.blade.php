@extends('layouts.master')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Admin Dashboard</h1>
        <p class="text-gray-600">Manage Users, Events, and View Reports</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-8">
        <!-- Total Users -->
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-xl font-semibold text-gray-800">Total Users</h2>
            <p class="text-gray-600 text-2xl">{{ $totalUsers }}</p>
        </div>

        <!-- Total Events -->
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-xl font-semibold text-gray-800">Total Events</h2>
            <p class="text-gray-600 text-2xl">{{ $totalEvents }}</p>
        </div>

        <!-- Manage Users Button -->
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-xl font-semibold text-gray-800">Manage Users</h2>
            <a href="{{ route('admin.users.index') }}" class="mt-4 inline-block text-purple-600 hover:underline">Manage Users</a>
        </div>

        <!-- Manage Events Button -->
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-xl font-semibold text-gray-800">Manage Events</h2>
            <a href="{{ route('admin.events.index') }}" class="mt-4 inline-block text-purple-600 hover:underline">Manage Events</a>
        </div>

        <!-- Reports Button -->
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-xl font-semibold text-gray-800">View Reports</h2>
            <a href="{{ route('admin.reports') }}" class="mt-4 inline-block text-purple-600 hover:underline">View Reports</a>
        </div>

        <!-- Booking Management Button -->
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-xl font-semibold text-gray-800">Booking Management</h2>
            <a href="{{ route('admin.bookings.index') }}" class="mt-4 inline-block text-purple-600 hover:underline">Manage Bookings</a>
        </div>
    </div>
</div>
@endsection
