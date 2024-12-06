<?php
// App\Http\Controllers\WelcomeController.php
namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');
        if ($query) {
            $events = Event::where('name', 'LIKE', "%{$query}%")
                ->orWhere('description', 'LIKE', "%{$query}%")
                ->orWhere('location', 'LIKE', "%{$query}%")
                ->get();
        } else {
            $events = Event::all();
        }

        // mengambiltop 3 event dengan penjualan tiket terbanyak
        $topEvents = Event::withCount('bookings')
            ->orderBy('bookings_count', 'desc')
            ->take(3)
            ->get();

        return view('welcome', compact('events', 'query', 'topEvents'));
    }
}