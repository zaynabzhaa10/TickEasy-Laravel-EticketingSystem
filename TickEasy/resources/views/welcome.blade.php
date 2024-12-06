<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="images/TickEasy.png">
    <title>TickEasy</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @font-face {
            font-family: 'Berlin Sans FB Demi';
            src: url('/fonts/BRLNSDB.TTF') format('truetype');
        }
    </style>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />
</head>

<body class="antialiased">
    <!-- Navbar -->
    <nav class="bg-white shadow-lg fixed w-full z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="/" class="text-xl font-bold text-gray-800">
                        <img src="{{ asset('images/TickEasy.png') }}" height="90px" width="90px" alt="TickEasy">
                    </a>
                    <h1 style="font-family: 'Berlin Sans FB Demi', sans-serif; font-size: 25px; color: #ff00bf">
                        <b>TickEasy</b>
                    </h1>
                </div>

                <!-- Navigation Links -->
                <div class="flex items-center justify-between w-full">
                    <!-- Menu Utama -->
                    <div class="flex-1"></div> <!-- Spacer kiri -->
                    <div class="flex items-center space-x-8">
                        <div class="flex space-x-8">
                            <a href="#home" class="text-purple-600 hover:text-pink-900"><b>Home</b></a>
                            <a href="#about" class="text-purple-600 hover:text-pink-900"><b>About</b></a>
                            <a href="#events" class="text-purple-600 hover:text-pink-900"><b>Events</b></a>
                            <a href="#more-info" class="text-purple-600 hover:text-pink-900"><b>More Info</b></a>
                        </div>
                    </div>
                    <div class="flex-1 flex justify-end"> <!-- Spacer kanan dengan auth links -->
                        <!-- Auth Links -->
                        <div class="flex items-center space-x-8">
                            @if (Route::has('login'))
                                @auth
                                    @if (Auth::user()->role == 'admin')
                                        <a href="{{ route('admin.dashboard') }}"
                                            class="bg-pink-600 text-white px-4 py-2 rounded-md hover:bg-pink-700">Dashboard</a>
                                    @elseif (Auth::user()->role == 'user')
                                        <a href="{{ route('user.dashboard') }}"
                                            class="bg-pink-600 text-white px-4 py-2 rounded-md hover:bg-pink-700">Dashboard</a>
                                    @elseif (Auth::user()->role == 'organizer')
                                        <a href="{{ route('organizer.dashboard') }}"
                                            class="bg-pink-600 text-white px-4 py-2 rounded-md hover:bg-pink-700">Dashboard</a>
                                    @endif
                                @else
                                    <a href="{{ route('login') }}"
                                        class="px-4 py-2 border bg-pink-500 text-white rounded-lg hover:bg-pink-600 hover:text-white-900 transition duration-150 ease-in-out">Login</a>
                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}"
                                            class="px-4 py-2 bg-purple-500 text-white rounded-lg hover:bg-purple-600 transition duration-150 ease-in-out">Register</a>
                                    @endif
                                @endauth
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="pt-20"> <!-- pt-20 untuk memberikan ruang di bawah navbar yang fixed -->
        <div class="max-w-100 mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div id="default-carousel" class="relative w-full" data-carousel="slide">
                <!-- Carousel wrapper -->
                <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
                    <!-- Item 1 -->
                    <div class="hidden duration-700 ease-in-out active" data-carousel-item="active">
                        <img src="{{ asset('images/carousel--2.png') }}"
                            class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                            alt="Gambar 1">
                    </div>
                    <!-- Item 2 -->
                    <div class="hidden duration-700 ease-in-out" data-carousel-item>
                        <img src="{{ asset('images/carousel--1.png') }}"
                            class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                            alt="Gambar 2">
                    </div>
                    <!-- Item 3 -->
                    <div class="hidden duration-700 ease-in-out" data-carousel-item>
                        <img src="{{ asset('images/carousel--3.png') }}"
                            class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                            alt="Gambar 3">
                    </div>
                </div>
                <!-- Slider indicators -->
                <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
                    <button type="button" class="w-3 h-3 rounded-full bg-white/30 dark:bg-gray-800/30"
                        aria-current="true" aria-label="Slide 1" data-carousel-slide-to="0"></button>
                    <button type="button" class="w-3 h-3 rounded-full bg-white/30 dark:bg-gray-800/30"
                        aria-current="false" aria-label="Slide 2" data-carousel-slide-to="1"></button>
                    <button type="button" class="w-3 h-3 rounded-full bg-white/30 dark:bg-gray-800/30"
                        aria-current="false" aria-label="Slide 3" data-carousel-slide-to="2"></button>
                </div>
                <!-- Slider controls -->
                <button type="button"
                    class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                    data-carousel-prev>
                    <span
                        class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                        <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 1 1 5l4 4" />
                        </svg>
                        <span class="sr-only">Previous</span>
                    </span>
                </button>
                <button type="button"
                    class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                    data-carousel-next>
                    <span
                        class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                        <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="m1 9 4-4-4-4" />
                        </svg>
                        <span class="sr-only">Next</span>
                    </span>
                </button>
            </div>
        </div>
    </section>

    <!-- Top 3 Events Section -->
    <section id="top-events" class="py-8">
        <div class="container mx-auto px-4">
            <h2 class="text-2xl font-semibold text-center text-purple-700" style="font-size: 40px">Top 3 Events</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-4">
                @foreach ($topEvents as $event)
                    <div class="bg-white shadow-lg rounded-lg p-4">
                        <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->name }}"
                            class="w-full h-48 object-cover rounded-md">
                        <h3 class="text-xl font-semibold mt-4 text-center">
                            <a href="{{ route('events.show', $event->id) }}"
                                class="text-dark-600 hover:underline">{{ $event->name }}</a>
                        </h3>
                        <p class="text-gray-600 text-center">{{ Str::limit($event->description, 100) }}</p>
                        <div class="mt-4 text-center">
                            @auth
                                @if (Auth::user()->role == 'organizer')
                                    <a href="{{ route('organizer.events.edit', $event->id) }}"
                                        class="bg-purple-600 text-white px-4 py-2 rounded-md hover:bg-purple-700">Edit
                                        Event</a>
                                    <a href="{{ route('organizer.events.bookings', $event->id) }}"
                                        class="bg-pink-600 text-white px-4 py-2 rounded-md hover:bg-pink-700">View
                                        Bookings</a>
                                @elseif (Auth::user()->role == 'user')
                                <div class="flex items-center justify-center space-x-2">
                                    <a href="{{ route('events.book', $event->id) }}"
                                       class="bg-pink-600 text-white px-4 py-2 rounded-md hover:bg-pink-700">Book Now</a>
                                
                                    <!-- Favorite Button -->
                                    <form action="{{ route('events.favorite', $event->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        <button type="submit" class="text-gray-600 hover:text-red-600 p-2">
                                            <img src="{{ asset('images/heart.png') }}" style="height: 30px" alt="fav">
                                        </button>
                                    </form>
                                </div>
                                
                                @endif
                            @endauth
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Sections lainnya -->
    <section id="about">
        <!-- Isi dengan konten about -->
    </section>

    <section id="events">
        <div class="container mx-auto px-4 py-8">
            <div class="mt-6 text-center">
                <h2 class="text-2xl font-semibold text-purple-700" style="font-size: 40px">All Events</h2>
                <br>
                <br>
                <!-- Form Pencarian -->
                <div class="flex justify-center mb-6">
                    <form action="{{ route('welcome') }}" method="GET" class="flex items-center space-x-2">
                        <input type="text" name="query" placeholder="Search events" class="px-4 py-2 border rounded-lg" value="{{ request('query') }}">
                        <button type="submit" class="bg-pink-600 text-white px-4 py-2 rounded-md hover:bg-pink-700">Search</button>
                    </form>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-4">
                    @foreach ($events as $event)
                        <div class="bg-white shadow-lg rounded-lg p-4">
                            <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->name }}"
                                class="w-full h-48 object-cover rounded-md">
                            <h3 class="text-xl font-semibold mt-4 text-center">
                                <a href="{{ route('events.show', $event->id) }}"
                                    class="text-dark-600 hover:underline">{{ $event->name }}</a>
                            </h3>
                            <p class="text-gray-600 text-center">{{ Str::limit($event->description, 100) }}</p>
                            <div class="mt-4 text-center">
                                @auth
                                    @if (Auth::user()->role == 'organizer')
                                        <a href="{{ route('organizer.events.edit', $event->id) }}"
                                            class="bg-purple-600 text-white px-4 py-2 rounded-md hover:bg-purple-700">Edit
                                            Event</a>
                                        <a href="{{ route('organizer.events.bookings', $event->id) }}"
                                            class="bg-pink-600 text-white px-4 py-2 rounded-md hover:bg-pink-700">View
                                            Bookings</a>
                                    @elseif (Auth::user()->role == 'user')
                                        <div class="flex items-center justify-center space-x-2">
                                            <a href="{{ route('events.book', $event->id) }}"
                                                class="bg-pink-600 text-white px-4 py-2 rounded-md hover:bg-pink-700">Book
                                                Now</a>
                                            <!-- Favorite Button -->
                                            @if (Auth::user()->favorites->contains($event->id))
                                                <form action="{{ route('events.favorite', $event->id) }}" method="POST" class="inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-800 p-2 ">
                                                        <img src="{{ asset('images/heart.png') }}" style="height: 30px" alt="fav">
                                                    </button>
                                                </form>
                                            @else
                                                <form action="{{ route('events.favorite', $event->id) }}" method="POST" class="inline-block">
                                                    @csrf
                                                    <button type="submit" class="text-gray-600 hover:text-red-600 p-2">
                                                        <img src="{{ asset('images/heart.png') }}" style="height: 30px"  alt="fav">
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    @endif
                                @else
                                    <a href="{{ route('login') }}"
                                        class="bg-pink-600 text-white px-4 py-2 rounded-md hover:bg-pink-700">
                                        Book Now
                                    </a>
                                @endauth
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section id="more-info">
        <!-- Isi dengan konten contact -->
    </section>

    <!-- Footer -->
    <footer class="bg-pink-600 text-white p-4">
        <div class="container mx-auto text-center">
            &copy; {{ date('Y') }} Zainab Muchsinin. All rights reserved.
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
</body>

</html>
