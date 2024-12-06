@extends('layouts.master')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-semibold">Create Event</h1>
        <form action="{{ route('organizer.events.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Event Name</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" 
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" 
                    required>
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea id="description" name="description" rows="4" 
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" 
                    required>{{ old('description') }}</textarea>
            </div>

            <div>
                <label for="date_time" class="block text-sm font-medium text-gray-700">Date and Time</label>
                <input type="datetime-local" id="date_time" name="date_time" value="{{ old('date_time') }}" 
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" 
                    required>
            </div>

            <div>
                <label for="location" class="block text-sm font-medium text-gray-700">Location</label>
                <input type="text" id="location" name="location" value="{{ old('location') }}" 
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" 
                    required>
            </div>

            <div>
                <label for="ticket_price" class="block text-sm font-medium text-gray-700">Ticket Price</label>
                <input type="number" id="ticket_price" name="ticket_price" value="{{ old('ticket_price') }}" 
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" 
                    required>
            </div>

            <div>
                <label for="ticket_quota" class="block text-sm font-medium text-gray-700">Ticket Quota</label>
                <input type="number" id="ticket_quota" name="ticket_quota" value="{{ old('ticket_quota') }}" 
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" 
                    required>
            </div>

            <div>
                <label for="image" class="block text-sm font-medium text-gray-700">Event Image</label>
                <input type="file" id="image" name="image" 
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg shadow hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Create Event
                </button>
            </div>
        </form>
    </div>
@endsection
