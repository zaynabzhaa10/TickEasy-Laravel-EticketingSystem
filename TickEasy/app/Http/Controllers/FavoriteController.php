<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Event;
use App\Models\User;

class FavoriteController extends Controller
{
    // Menambahkan acara ke favorit
    public function addToFavorites($eventId)
    {
        $user = Auth::user();
        if ($user instanceof \App\Models\User) {
            $user->favoriteEvents()->attach($eventId);
            return redirect()->back()->with('success', 'Event added to favorites!');
        }

        return redirect()->back()->with('error', 'User not authenticated.');
    }

    // Menghapus acara dari favorit
    public function removeFromFavorites($eventId)
    {
        $user = Auth::user();
        if ($user instanceof \App\Models\User) {
            $user->favoriteEvents()->detach($eventId);
            return redirect()->back()->with('success', 'Event removed from favorites!');
        }

        return redirect()->back()->with('error', 'User not authenticated.');
    }
}
