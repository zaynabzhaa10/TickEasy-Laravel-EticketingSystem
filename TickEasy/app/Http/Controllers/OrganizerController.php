<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Booking;

class OrganizerController extends Controller
{
    public function index()
    {
        $organizerId = Auth::id();
        $events = Event::where('organizer_id', $organizerId)->get();
        $totalEvents = $events->count();
        $totalRevenue = Booking::whereHas('event', function ($query) use ($organizerId) {
            $query->where('organizer_id', $organizerId);
        })->sum('amount_paid');

        return view('organizer.dashboard', compact('events', 'totalEvents', 'totalRevenue'));
    }

    public function manageEvents()
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            $events = Auth::user()->events;
            return view('organizer.events.index', compact('events'));
        }

        // Redirect to login if not authenticated
        return redirect()->route('login')->withErrors(['message' => 'You must be logged in to view events.']);
    }

    public function viewBookings($id)
    {
        $event = Event::findOrFail($id);
        $bookings = Booking::where('event_id', $id)->get();
        return view('organizer.events.bookings', compact('event', 'bookings'));
    }

    public function create()
    {
        return view('organizer.events.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'date_time' => 'required|date_format:Y-m-d\TH:i',
            'location' => 'required|string|max:255',
            'ticket_price' => 'required|numeric',
            'ticket_quota' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Simpan gambar ke direktori 'public/images'
        $imagePath = $request->file('image')->store('images', 'public');

        Event::create([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'date_time' => \Carbon\Carbon::createFromFormat('Y-m-d\TH:i', $validatedData['date_time'])->format('Y-m-d H:i'),
            'location' => $validatedData['location'],
            'ticket_price' => $validatedData['ticket_price'],
            'ticket_quota' => $validatedData['ticket_quota'],
            'organizer_id' => Auth::id(), // Ambil ID pengguna yang sedang login
            'image' => $imagePath,
        ]);

        return redirect()->route('organizer.events.index')->with('success', 'Event created successfully.');
    }

    public function edit($id)
    {
        $event = Event::findOrFail($id);

        return view('organizer.events.edit', compact('event'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'date_time' => 'required|date_format:Y-m-d\TH:i',
            'location' => 'required|string|max:255',
            'ticket_price' => 'required|numeric',
            'ticket_quota' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $event = Event::findOrFail($id);

        if ($request->hasFile('image')) {
            // Hapus gambar lama dari storage
            Storage::disk('public')->delete($event->image);

            // Simpan gambar baru ke direktori 'public/images'
            $imagePath = $request->file('image')->store('images', 'public');
            $event->image = $imagePath;
        }

        $event->update([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'date_time' => \Carbon\Carbon::createFromFormat('Y-m-d\TH:i', $validatedData['date_time'])->format('Y-m-d H:i'),
            'location' => $validatedData['location'],
            'ticket_price' => $validatedData['ticket_price'],
            'ticket_quota' => $validatedData['ticket_quota'],
            'organizer_id' => Auth::id(), // Ambil ID pengguna yang sedang login
        ]);

        return redirect()->route('organizer.events.index')->with('success', 'Event updated successfully.');
    }

    public function destroy($id)
    {
        $event = Event::findOrFail($id);

        // Hapus gambar dari storage
        Storage::disk('public')->delete($event->image);

        // Hapus event dari database
        $event->delete();

        return redirect()->route('organizer.events.index')->with('success', 'Event deleted successfully.');
    }

    public function show($id)
    {
        $event = Event::findOrFail($id);
        return view('organizer.events.show', compact('event'));
    }
}
