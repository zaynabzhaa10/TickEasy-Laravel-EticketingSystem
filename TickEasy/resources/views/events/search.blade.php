<!-- resources/views/events/search.blade.php -->
@extends('layouts.master')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-semibold">Search Results for "{{ $query }}"</h1>

        @if ($events->isEmpty())
            <p class="mt-4">No events found.</p>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-4">
                @foreach ($events as $event)
                    <div class="bg-white shadow-lg rounded-lg p-4">
                        <h3 class="text-xl font-semibold">
                            <a href="{{ route('events.show', $event->id) }}" class="text-blue-600 hover:underline">{{ $event->name }}</a>
                        </h3>
                        <p class="text-gray-600">{{ Str::limit($event->description, 100) }}</p>
                        <p class="text-gray-600"><strong>Date:</strong> {{ $event->date_time->format('Y-m-d H:i') }}</p>
                        <p class="text-gray-600"><strong>Location:</strong> {{ $event->location }}</p>
                        <p class="text-gray-600"><strong>Price:</strong> ${{ number_format($event->ticket_price, 2) }}</p>
                        <p class="text-gray-600"><strong>Quota:</strong> {{ $event->ticket_quota }}</p>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection