<?php
namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TicketController extends Controller
{
    use AuthorizesRequests;
    // Melihat daftar pemesanan tiket untuk setiap acara
    public function viewBookings($eventId)
    {
        // Ambil event berdasarkan ID
        $event = Event::findOrFail($eventId);
        
        // Pastikan organizer hanya bisa melihat pemesanan acara yang mereka buat
        if (Gate::denies('view', $event)) {
            abort(403);
        }

        // Ambil pemesanan tiket untuk event ini
        $bookings = Booking::where('event_id', $eventId)->get();
        return view('admin.bookings.index', compact('event', 'bookings'));
    }

    // Menyetujui pemesanan tiket
    public function approveBooking($bookingId)
    {
        $booking = Booking::findOrFail($bookingId);
        $this->authorize('approve', $booking); // Pastikan hanya admin atau organizer yang bisa approve

        $booking->status = 'approved'; // Update status tiket
        $booking->save();

        return redirect()->route('admin.events.bookings', $booking->event_id)->with('success', 'Booking approved successfully!');
    }

    // Membatalkan pemesanan tiket
    public function cancelBooking($bookingId)
    {
        $booking = Booking::findOrFail($bookingId);
        $this->authorize('cancel', $booking); // Pastikan hanya admin atau organizer yang bisa cancel

        $booking->status = 'canceled'; // Update status tiket
        $booking->save();

        return redirect()->route('admin.events.bookings', $booking->event_id)->with('success', 'Booking canceled successfully!');
    }

    // Melihat laporan penjualan tiket
    public function generateReports()
    {
        // Ambil semua event dan hitung penjualannya
        $events = Event::all();
        $salesData = [];

        foreach ($events as $event) {
            $totalTicketsSold = Booking::where('event_id', $event->id)->where('status', 'approved')->count();
            $totalRevenue = $totalTicketsSold * $event->ticket_price;
            $salesData[] = [
                'event' => $event,
                'total_tickets_sold' => $totalTicketsSold,
                'total_revenue' => $totalRevenue
            ];
        }

        return view('admin.reports.ticket_sales', compact('salesData'));
    }
}
