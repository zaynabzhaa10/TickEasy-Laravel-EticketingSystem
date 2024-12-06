@extends('layouts.master')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-semibold">Organizer Dashboard</h1>
        <p class="mt-4">Manage your events and view your bookings here.</p>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-8">
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h2 class="text-xl font-semibold text-gray-800">Total Events</h2>
                <p class="text-gray-600 text-2xl">{{ $totalEvents }}</p>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h2 class="text-xl font-semibold text-gray-800">Total Revenue</h2>
                <p class="text-gray-600 text-2xl">Rp {{ number_format($totalRevenue, 2) }}</p>
            </div>

            <!-- Manage Events Button -->
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h2 class="text-xl font-semibold text-gray-800">Manage Events</h2>
                <a href="{{ route('organizer.events.index') }}" class="mt-4 inline-block text-purple-600 hover:underline">Manage Events</a>
            </div>

            <!-- Booking Management Button -->
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h2 class="text-xl font-semibold text-gray-800">Booking Management</h2>
                <a href="{{ route('organizer.bookings.index') }}" class="mt-4 inline-block text-purple-600 hover:underline">Manage Bookings</a>
            </div>
        </div>
    </div>
@endsection
