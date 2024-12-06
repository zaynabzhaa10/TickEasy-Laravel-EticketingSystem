@extends('layouts.master')

@section('content')
    <h1 class="text-3xl font-semibold">Create New Event</h1>
    <form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Event Name</label>
            <input type="text" name="name" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg" required>
        </div>

        <div>
            <label for="organizer_id" class="block text-sm font-medium text-gray-700">Organizer</label>
            <select name="organizer_id" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg" required>
                <option value="">Select Organizer</option>
                @foreach($organizers as $organizer)
                    <option value="{{ $organizer->id }}">{{ $organizer->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
            <textarea name="description" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg" required></textarea>
        </div>

        <div>
            <label for="date_time" class="block text-sm font-medium text-gray-700">Event Date and Time</label>
            <input type="datetime-local" name="date_time" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg" required>
        </div>

        <div>
            <label for="location" class="block text-sm font-medium text-gray-700">Location</label>
            <input type="text" name="location" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg" required>
        </div>

        <div>
            <label for="ticket_price" class="block text-sm font-medium text-gray-700">Ticket Price</label>
            <input type="number" name="ticket_price" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg" required>
        </div>

        <div>
            <label for="ticket_quota" class="block text-sm font-medium text-gray-700">Ticket Quota</label>
            <input type="number" name="ticket_quota" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg" required>
        </div>

        <div>
            <label for="image" class="block text-sm font-medium text-gray-700">Poster</label>
            <input type="file" name="image" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg" required>
        </div>

        <div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2">Add Event</button>
        </div>
    </form>
@endsection
