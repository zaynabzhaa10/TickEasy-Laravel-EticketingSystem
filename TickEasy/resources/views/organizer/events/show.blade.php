<!-- resources/views/organizer/events/show.blade.php -->
@extends('layouts.master')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white shadow-lg rounded-lg p-6">
            <h1 class="text-3xl font-semibold">{{ $event->name }}</h1>
            <p class="mt-4">{{ $event->description }}</p>
            <p class="mt-4"><strong>Date and Time:</strong> {{ $event->date_time->format('Y-m-d H:i') }}</p>
            <p class="mt-4"><strong>Location:</strong> {{ $event->location }}</p>
            <p class="mt-4"><strong>Ticket Price:</strong> ${{ number_format($event->ticket_price, 2) }}</p>
            <p class="mt-4"><strong>Ticket Quota:</strong> {{ $event->ticket_quota }}</p>


            @if (Auth::check() && Auth::user()->id === $event->organizer_id)
                <h2 class="text-2xl font-semibold mt-8">Bookings</h2>
                <table class="min-w-full bg-white border border-gray-300 mt-4">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 border-b">User</th>
                            <th class="px-4 py-2 border-b">Tickets</th>
                            <th class="px-4 py-2 border-b">Status</th>
                            <th class="px-4 py-2 border-b">Amount Paid</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($event->bookings as $booking)
                            <tr>
                                <td class="px-4 py-2 border-b">{{ $booking->user->name }}</td>
                                <td class="px-4 py-2 border-b">{{ $booking->tickets }}</td>
                                <td class="px-4 py-2 border-b">{{ $booking->status }}</td>
                                <td class="px-4 py-2 border-b">${{ number_format($booking->amount_paid, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection