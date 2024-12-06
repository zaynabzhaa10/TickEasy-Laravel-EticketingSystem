<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Event;
use App\Models\Booking;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    public function index()
    {
        // Ambil data statistik untuk ditampilkan di dashboard admin
        $totalUsers = User::count();
        $totalEvents = Event::count();
        $totalBookings = Booking::count();

        return view('admin.dashboard', compact('totalUsers', 'totalEvents', 'totalBookings'));
    }

    public function manageUsers()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function manageEvents()
    {
        $events = Event::all();
        return view('admin.events.index', compact('events'));
    }

    public function createEvent()
    {
        $organizers = User::where('role', 'organizer')->get();

        return view('admin.events.create', compact('organizers'));
    }

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

    public function editEvent($id)
    {
        $event = Event::findOrFail($id);
        return view('admin.events.edit', compact('event'));
    }

    public function updateEvent(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'date_time' => 'required|date_format:Y-m-d\TH:i',
            'location' => 'required|string|max:255',
            'ticket_price' => 'required|numeric',
            'ticket_quota' => 'required|numeric',
            'organizer_id' => 'required|exists:users,id',
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
            'organizer_id' => $validatedData['organizer_id'],
        ]);

        return redirect()->route('admin.events.index')->with('success', 'Event updated successfully.');
    }

    public function destroyEvent($id)
    {
        $event = Event::findOrFail($id);

        // Hapus gambar dari storage
        Storage::disk('public')->delete($event->image);

        // Hapus event dari database
        $event->delete();

        return redirect()->route('admin.events.index')->with('success', 'Event deleted successfully.');
    }

    public function manageReports()
    {
        $salesData = Event::with('bookings')
            ->get()
            ->map(function ($event) {
                $totalTicketsSold = $event->bookings->sum('tickets');
                $totalRevenue = $event->bookings->sum(function ($booking) use ($event) {
                    return $booking->tickets * $event->ticket_price;
                });

                return [
                    'event' => $event,
                    'total_tickets_sold' => $totalTicketsSold,
                    'total_revenue' => $totalRevenue,
                ];
            });

        return view('admin.reports.index', compact('salesData'));
    }

    public function editUser($userId)
    {
        $user = User::findOrFail($userId);
        return view('admin.users.edit', compact('user'));
    }

    public function destroyUser($userId)
    {
        $user = User::findOrFail($userId); 
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.'); 
    }

    public function updateUser(Request $request, $userId)
    {
        $user = User::findOrFail($userId);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|string|in:event_organizer,user',
        ]);

        $user->update([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => $validatedData['password'] ? bcrypt($validatedData['password']) : $user->password,
            'role' => $validatedData['role'],
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    public function showUser($userId)
    {
        $user = User::findOrFail($userId);
        return view('admin.users.show', compact('user'));
    }

    public function createUser()
    {
        return view('admin.users.create');
    }

    public function storeUser(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string|in:organizer,user',
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        // Tetapkan peran pengguna
        $role = Role::findByName($validatedData['role']);
        $user->assignRole($role);

        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }
}
