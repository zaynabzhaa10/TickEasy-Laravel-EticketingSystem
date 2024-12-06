<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
Use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    // Menampilkan daftar seluruh acara
    public function listEvents()
    {
        // Muat relasi organizer
        $events = Event::with('organizer')->get();
        return view('admin.events.index', compact('events')); // Kembalikan view dengan data acara
    }

    // Menampilkan form untuk menambah acara baru
    public function createEvent()
    {
        // Ambil semua pengguna dengan peran 'event_organizer'
        $organizers = User::where('role', 'organizer')->get();
        return view('admin.events.create', compact('organizers'));
    }

    // Proses menyimpan acara baru
    public function storeEvent(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'date_time' => 'required|date_format:Y-m-d\TH:i',
            'location' => 'required|string|max:255',
            'ticket_price' => 'required|numeric',
            'ticket_quota' => 'required|numeric',
            'organizer_id' => 'required|exists:users,id',
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
            'organizer_id' => $validatedData['organizer_id'],
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.events.index')->with('success', 'Event created successfully.');
    }

    // Menampilkan form untuk mengedit acara
    public function editEvent($id)
    {
        $event = Event::findOrFail($id);
        return view('admin.events.edit', compact('event'));
    }

    // Proses memperbarui acara
    public function updateEvent(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'event_date' => 'required|date',
            'location' => 'required|string|max:255',
            'ticket_price' => 'required|numeric',
            'ticket_quota' => 'required|integer',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:5000',
        ]);

        $event = Event::findOrFail($id);

        // Hanya boleh mengedit event yang dibuat oleh admin atau organizer yang bersangkutan
        if (Auth::id() != $event->created_by && Auth::user()->role != 'admin') {
            return redirect()->route('admin.events.index')->with('error', 'You are not authorized to edit this event.');
        }

        $imagePath = $request->file('image') ? $request->file('image')->store('images/events', 'public') : $event->image;

        $event->update([
            'name' => $request->name,
            'description' => $request->description,
            'event_date' => $request->event_date,
            'location' => $request->location,
            'ticket_price' => $request->ticket_price,
            'ticket_quota' => $request->ticket_quota,
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.events.index')->with('success', 'Event updated successfully!');
    }

    // Menghapus event
    public function deleteEvent($id)
    {
        $event = Event::findOrFail($id);

        // Cek apakah admin atau organizer yang bersangkutan
        if (Auth::id() != $event->created_by && Auth::user()->role != 'admin') {
            return redirect()->route('admin.events.index')->with('error', 'You are not authorized to delete this event.');
        }

        $event->delete();

        return redirect()->route('admin.events.index')->with('success', 'Event deleted successfully!');
    }

    public function showEvent(Event $event)
    {
        return view('events.show', compact('event'));
    }

    public function index()
    {
        $organizerId = Auth::id();
        $events = Event::where('organizer_id', $organizerId)->get();
        return view('organizer.events.index', compact('events'));
    }

    // Method untuk menampilkan hasil pencarian event
    public function search(Request $request)
    {
        $query = $request->input('query');
        $events = Event::where('name', 'LIKE', "%$query%")->get();

        return view('events.search', compact('events', 'query'));
    }

    // Method untuk menampilkan halaman detail acara
    public function show($eventId)
    {
        $event = Event::findOrFail($eventId);
        return view('events.show', compact('event'));
    }

    // Method untuk menambahkan event ke favorit
    public function favorite($eventId)
    {
        $event = Event::findOrFail($eventId);
        $user = Auth::user();

        if (!$user->favorites->contains($event->id)) {
            $user->favorites()->attach($event->id);
        }

        return back()->with('success', 'Event added to favorites.');
    }

}
