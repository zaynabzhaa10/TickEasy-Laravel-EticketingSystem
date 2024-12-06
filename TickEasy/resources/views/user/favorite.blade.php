@extends('layouts.master')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-semibold">Favorite Events</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-4">
            @foreach ($favorites as $event)
                <div class="bg-white shadow-lg rounded-lg p-4">
                    <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->name }}" class="w-full h-48 object-cover rounded-md">
                    <h3 class="text-xl font-semibold mt-4">{{ $event->name }}</h3>
                    <p class="text-gray-600">{{ Str::limit($event->description, 100) }}</p>
                    <div class="mt-4 flex items-center space-x-2">
                        <!-- Tombol View Details -->
                        <form action="{{ route('events.show', $event->id) }}" method="GET">
                            @csrf
                            <button type="submit" class="px-4 py-2 bg-pink-600 text-white rounded-lg hover:bg-pink-700">
                                View Details
                            </button>
                        </form>

                        <!-- Ikon Recycle Bin untuk Remove Favorite -->
                        <form action="{{ route('favorite.remove', $event->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="flex items-center">
                                <img src="{{ asset('images/recycle-bin.png') }}" alt="Remove from Favorites" class="w-6 h-6 ml-2">
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
