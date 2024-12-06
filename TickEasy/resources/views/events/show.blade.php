<!-- resources/views/events/show.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="images/TickEasy.png">
    <title>{{ $event->name }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased bg-gray-100">
    <div class="flex justify-center items-center min-h-screen">
        <div class="bg-white shadow-lg rounded-lg w-full max-w-4xl p-6">
            <div class="flex flex-col md:flex-row">
                <div class="md:w-1/2 space-y-4">
                    <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->name }}" class="rounded-md mx-auto">
                </div>
                <div class="md:w-1/2 mt-6 md:mt-0 md:pl-6">
                    <h1 class="text-3xl font-semibold text-center md:text-left text-purple-800" style="font-size: 36px">{{ $event->name }}</h1>
                    <p class="text-gray-600">{{ $event->description }}</p>
                    <p class="text-gray-600"><strong>Date and Time:</strong> {{ \Carbon\Carbon::parse($event->date_time)->format('Y-m-d H:i') }}</p>
                    <p class="text-gray-600"><strong>Location:</strong> {{ $event->location }}</p>
                    <p class="text-gray-600"><strong>Ticket Price:</strong> ${{ number_format($event->ticket_price, 2) }}</p>
                    <p class="text-gray-600"><strong>Ticket Quota:</strong> {{ $event->ticket_quota }}</p>
                    <p class="text-gray-600"><strong>Organizer:</strong> {{ $event->organizer->name }}</p>

                    <div class="mt-6 text-align">
                        @auth
                            <form action="{{ route('user.bookTickets', $event->id) }}" method="GET" class="inline-block">
                                <button type="submit" class="bg-pink-600 text-white px-4 py-2 rounded-md hover:bg-pink-700">Book Now</button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="bg-pink-600 text-white px-4 py-2 rounded-md hover:bg-pink-700 inline-block">Book Now</a>
                        @endauth
                        <a href="{{ route('welcome') }}" class="bg-purple-600 text-white px-4 py-2 rounded-md hover:bg-purple-700 inline-block ml-2">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
