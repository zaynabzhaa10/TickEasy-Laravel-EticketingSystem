<!-- resources/views/profile/show.blade.php -->
@extends('layouts.master')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white shadow-lg rounded-lg p-6">
            <h1 class="text-3xl font-semibold">Hai, {{ Auth::user()->name }}</h1>
            <p class="mt-4 text-gray-600">Selamat datang di halaman profil Anda.</p>
            <div class="mt-6">
                <a href="{{ route('profile.edit') }}" class="bg-pink-600 text-white px-4 py-2 rounded-md hover:bg-pink-700">Edit Profile</a>
            </div>
        </div>
    </div>
@endsection