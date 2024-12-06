<!-- resources/views/admin/events/edit.blade.php -->
@extends('layouts.master')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-semibold">Edit Event</h1>
        <form action="{{ route('admin.events.update', $event->id) }}" method="POST" enctype="multipart/form-data" class="mt-6 space-y-6">
            @csrf
            @method('PUT')
            <!-- Event Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Event Name</label>
                <input type="text" id="name" name="name" value="{{ old('name', $event->name) }}" 
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" 
                    required>
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea id="description" name="description" rows="4" 
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" 
                    required>{{ old('description', $event->description) }}</textarea>
            </div>

            <!-- Event Date -->
            <div>
                <label for="date_time" class="block text-sm font-medium text-gray-700">Event Date</label>
                <input type="datetime-local" id="date_time" name="date_time" value="{{ old('date_time', \Carbon\Carbon::parse($event->date_time)->format('Y-m-d\TH:i')) }}" 
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" 
                    required>
            </div>

            <!-- Location -->
            <div>
                <label for="location" class="block text-sm font-medium text-gray-700">Location</label>
                <input type="text" id="location" name="location" value="{{ old('location', $event->location) }}" 
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" 
                    required>
            </div>

            <!-- Ticket Price -->
            <div>
                <label for="ticket_price" class="block text-sm font-medium text-gray-700">Ticket Price</label>
                <input type="number" id="ticket_price" name="ticket_price" value="{{ old('ticket_price', $event->ticket_price) }}" 
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" 
                    required>
            </div>

            <!-- Ticket Quota -->
            <div>
                <label for="ticket_quota" class="block text-sm font-medium text-gray-700">Ticket Quota</label>
                <input type="number" id="ticket_quota" name="ticket_quota" value="{{ old('ticket_quota', $event->ticket_quota) }}" 
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" 
                    required>
            </div>

            <!-- Poster -->
            <div>
                <label for="image" class="block text-sm font-medium text-gray-700">Poster</label>
                <input type="file" id="image" name="image" 
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                @if ($event->image)
                    <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->name }}" class="w-full h-48 object-cover rounded-md mt-4">
                @endif
            </div>

            <div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2">Update Event</button>
            </div>
        </form>
    </div>
@endsection