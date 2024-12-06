@extends('layouts.master')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-semibold">User Dashboard</h1>
        <p class="text-xl mt-2">Welcome, {{ Auth::user()->name }}</p>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-8">
            <!-- Booking History Button -->
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h2 class="text-xl font-semibold text-gray-800">Booking History</h2>
                <a href="{{ route('user.bookings.history') }}" class="mt-4 inline-block text-purple-600 hover:underline">View Booking History</a>
            </div>

            <!-- Favorite Events Button -->
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h2 class="text-xl font-semibold text-gray-800">Favorite Events</h2>
                <a href="{{ route('user.favorite') }}" class="mt-4 inline-block text-purple-600 hover:underline">View Favorite Events</a>
            </div>
        </div>
    </div>
@endsection