<!-- resources/views/events/book.blade.php -->
@extends('layouts.master')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white shadow-lg rounded-lg p-6">
            <h1 class="text-3xl font-semibold">Book Tickets for {{ $event->name }}</h1>
            <form action="{{ route('user.bookTickets', $event->id) }}" method="POST" class="mt-6 space-y-6">
                @csrf
                <div>
                    <label for="ticket_quantity" class="block text-sm font-medium text-gray-700">Number of Tickets</label>
                    <input type="number" name="ticket_quantity" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg" required>
                </div>
                <div>
                    <button type="submit" class="bg-pink-600 text-white px-4 py-2 rounded-md hover:bg-pink-700">Book Now</button>
                </div>
            </form>
        </div>
    </div>
@endsection