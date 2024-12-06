@extends('layouts.master')

@section('title', 'Manage Events')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-semibold">Manage Events</h1>
        @if (session('success'))
            <div class="bg-green-500 text-white p-4 mb-4">
                {{ session('success') }}
            </div>
        @endif
        <div class="mb-4">
            <br>
            <a href="{{ route('admin.events.create') }}" class="bg-pink-500 text-white px-4 py-2">Create Event</a>
        </div>
        
        <table class="min-w-full bg-white border border-gray-300">
            <thead>
                <tr>
                    <th class="px-4 py-2 border-b">Event Name</th>
                    <th class="px-4 py-2 border-b">Organizer</th>
                    <th class="px-4 py-2 border-b">Location</th>
                    <th class="px-4 py-2 border-b">Date</th>
                    <th class="px-4 py-2 border-b">Ticket Price</th>
                    <th class="px-4 py-2 border-b">Ticket Quota</th>
                    <th class="px-4 py-2 border-b">Poster</th>
                    <th class="px-4 py-2 border-b">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($events as $event)
                    <tr>
                        <td class="px-4 py-2 border-b">{{ $event->name }}</td>
                        <td class="px-4 py-2 border-b">{{ $event->organizer->name }}</td>
                        <td class="px-4 py-2 border-b">{{ $event->location }}</td>
                        <td class="px-4 py-2 border-b">{{ \Carbon\Carbon::parse($event->date_time)->format('Y-m-d H:i') }}</td>
                        <td class="px-4 py-2 border-b">{{ $event->ticket_price }}</td>
                        <td class="px-4 py-2 border-b">{{ $event->ticket_quota }}</td>
                        <td class="px-4 py-2 border-b">
                            <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->name }}" class="w-16 h-16 object-cover">
                        </td>
                        <td class="px-4 py-2 border-b">
                            <a href="{{ route('admin.events.edit', $event->id) }}" class="text-blue-600 hover:underline">Edit</a> | 
                            <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
