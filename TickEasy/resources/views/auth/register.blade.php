<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register - {{ config('app.name') }}</title>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased">
    <div class="flex flex-wrap items-center justify-center min-h-screen bg-gray-100">
        <div class="container mx-auto px-4">
            <div class="flex flex-wrap justify-center gap-6">
                <!-- Bagian Form Register User -->
                <div class="w-[600px] p-8 bg-white shadow-lg rounded-lg">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- Name -->
                        <div>
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                                :value="old('name')" required autofocus autocomplete="name" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Email Address -->
                        <div class="mt-4">
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                                :value="old('email')" required autocomplete="username" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Password -->
                        <div class="mt-4">
                            <x-input-label for="password" :value="__('Password')" />
                            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password"
                                required autocomplete="new-password" />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <!-- Confirm Password -->
                        <div class="mt-4">
                            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                                name="password_confirmation" required autocomplete="new-password" />
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>

                        <!-- Submit Button -->
                        <div class="flex items-center justify-end mt-4">
                            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                href="{{ route('login') }}">
                                {{ __('Already registered?') }}
                            </a>

                            <<x-primary-button class="ms-3 bg-pink-600 hover:bg-pink-700 text-white">
                                {{ __('Log in') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>

                <!-- Bagian Informasi Event Organizer -->
                <div class="w-80 p-6 bg-blue-50 flex flex-col justify-center items-center shadow-lg rounded-lg">
                    <a href="/">
                        <img src="{{ asset('images/TickEasy.png') }}" width="150px" height="150px" alt="">
                    </a>
                    <h2 class="text-lg font-bold text-pink-500 mb-4">Let's Join Us!</h2>
                    <p class="text-center text-purple-700 mb-6">Create Your Event, Create Happiness!</p>
                    <a href="{{ route('register.organizer') }}"
                        class="bg-pink-500 text-white py-2 px-4 rounded hover:bg-pink-600 transition duration-300">
                        Register As Organizer
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
