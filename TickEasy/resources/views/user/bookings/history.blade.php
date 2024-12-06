@extends('layouts.master')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-semibold">Booking History</h1>
        <table class="min-w-full bg-white border border-gray-300 mt-4">
            <thead>
                <tr>
                    <th class="px-4 py-2 border-b">Event Name</th>
                    <th class="px-4 py-2 border-b">Date</th>
                    <th class="px-4 py-2 border-b">Tickets</th>
                    <th class="px-4 py-2 border-b">Status</th>
                    <th class="px-4 py-2 border-b">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bookings as $booking)
                    <tr>
                        <td class="px-4 py-2 border-b">{{ $booking->event->name }}</td>
                        <td class="px-4 py-2 border-b">{{ \Carbon\Carbon::parse($booking->event->date_time)->format('Y-m-d H:i') }}</td>
                        <td class="px-4 py-2 border-b">{{ $booking->tickets }}</td>
                        <td class="px-4 py-2 border-b">{{ $booking->status }}</td>
                        <td class="px-4 py-2 border-b">
                            <form action="{{ route('user.cancelBooking', $booking->id) }}" method="POST" class="inline-block">
                                @csrf
                                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700" {{ $booking->status == 'approved' ? 'disabled' : '' }}>Cancel</button>
                            </form>
                            <form action="{{ route('user.deleteBooking', $booking->id) }}" method="POST" class="inline-block">
                                @csrf
                                <button type="submit" class="bg-gray-600 text-white px-4 py-2 rounded-md hover:bg-gray-700">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
