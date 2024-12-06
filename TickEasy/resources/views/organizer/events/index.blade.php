<!-- resources/views/organizer/events/index.blade.php -->
@extends('layouts.master')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-semibold">Manage Events</h1>
        <div class="mt-6">
            <a href="{{ route('organizer.events.create') }}" class="bg-pink-600 text-white py-2 px-4 rounded-md">Create New Event</a>
        </div>

        <div class="mt-6">
            <h2 class="text-2xl font-semibold">Your Events</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-4">
                @foreach ($events as $event)
                    <div class="bg-white shadow-lg rounded-lg p-4">
                        <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->name }}" class="w-full h-48 object-cover rounded-md">
                        <h3 class="text-xl font-semibold mt-4">
                            <a href="{{ route('organizer.events.show', $event->id) }}" class="text-blue-600 hover:underline">{{ $event->name }}</a>
                        </h3>
                        <p class="text-gray-600">{{ Str::limit($event->description, 100) }}</p>
                        <div class="mt-4 flex space-x-2">
                            <a href="{{ route('organizer.events.edit', $event->id) }}" class="inline-block">
                                <button class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-700">Edit</button>
                            </a>
                            <form action="{{ route('organizer.events.destroy', $event->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-700">Delete</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection