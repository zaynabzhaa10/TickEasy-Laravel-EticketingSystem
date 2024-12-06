@extends('layouts.master')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-semibold">Bookings for Event: {{ $event->name }}</h1>
        <p class="mt-4">Below are the ticket bookings for the event.</p>

        <div class="mt-6">
            <table class="min-w-full table-auto border-collapse">
                <thead>
                    <tr>
                        <th class="px-6 py-2 text-left border-b">Booking ID</th>
                        <th class="px-6 py-2 text-left border-b">User</th>
                        <th class="px-6 py-2 text-left border-b">Status</th>
                        <th class="px-6 py-2 text-left border-b">Booking Date</th>
                        <th class="px-6 py-2 text-left border-b">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bookings as $booking)
                        <tr>
                            <td class="px-6 py-2 border-b">{{ $booking->id }}</td>
                            <td class="px-6 py-2 border-b">{{ $booking->user->name }}</td>
                            <td class="px-6 py-2 border-b">{{ $booking->status }}</td>
                            <td class="px-6 py-2 border-b">{{ $booking->created_at->format('F d, Y') }}</td>
                            <td class="px-6 py-2 border-b">
                                <form action="{{ route('organizer.events.updateBookingStatus', $booking->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="text-blue-600 hover:underline">Approve</button>
                                    <button type="submit" class="text-red-600 hover:underline ml-2">Reject</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
