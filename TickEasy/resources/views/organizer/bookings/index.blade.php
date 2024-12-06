<!-- resources/views/organizer/bookings/index.blade.php -->
@extends('layouts.master')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-semibold">Booking Management</h1>
        <table class="min-w-full bg-white border border-gray-300 mt-4">
            <thead>
                <tr>
                    <th class="px-4 py-2 border-b">User</th>
                    <th class="px-4 py-2 border-b">Event</th>
                    <th class="px-4 py-2 border-b">Ticket Quantity</th>
                    <th class="px-4 py-2 border-b">Status</th>
                    <th class="px-4 py-2 border-b">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bookings as $booking)
                    <tr>
                        <td class="px-4 py-2 border-b">{{ $booking->user->name }}</td>
                        <td class="px-4 py-2 border-b">{{ $booking->event->name }}</td>
                        <td class="px-4 py-2 border-b">{{ $booking->tickets }}</td>
                        <td class="px-4 py-2 border-b">{{ $booking->status }}</td>
                        <td class="px-4 py-2 border-b">
                            <form action="{{ route('organizer.bookings.approve', $booking->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-700 {{ in_array($booking->status, ['approved', 'cancelled']) ? 'disabled-button' : '' }}" {{ in_array($booking->status, ['approved', 'cancelled']) ? 'disabled' : '' }}>Approve</button>
                            </form>
                            <form action="{{ route('organizer.bookings.cancel', $booking->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-700 {{ in_array($booking->status, ['approved', 'cancelled']) ? 'disabled-button' : '' }}" {{ in_array($booking->status, ['approved', 'cancelled']) ? 'disabled' : '' }}>Cancel</button>
                            </form>
                            <form action="{{ route('organizer.bookings.delete', $booking->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-700">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <style>
        .disabled-button {
            pointer-events: none;
            opacity: 0.6;
        }
    </style>
@endsection