<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function dashboard()
    {
        return view('user.dashboard');
    }

    public function bookingHistory()
    {
        $bookings = Booking::where('user_id', Auth::id())->with('event')->get();
        return view('user.bookings.history', compact('bookings'));
    }

    public function favorites()
    {
        $user = Auth::user(); // Get the authenticated user
        $favorites = $user->favoriteEvents; // Get all favorite events

        return view('user.favorite', compact('favorites'));
    }

    public function removeFavorite(Event $event)
    {
        $user = Auth::user(); // Ambil pengguna yang sedang login

        // Hapus event dari daftar favorit pengguna
        $user->favoriteEvents()->detach($event->id);

        return redirect()->route('user.favorite')->with('success', 'Event removed from favorites');
    }
}
