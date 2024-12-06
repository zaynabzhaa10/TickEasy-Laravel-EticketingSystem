<?php 
namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BookingController extends Controller
{
    // Method untuk menampilkan halaman booking
    public function create($eventId)
    {
        $event = Event::findOrFail($eventId);
        return view('events.book', compact('event'));
    }

    // Method untuk menyimpan booking tiket
    public function storeBooking(Request $request, $eventId)
    {
        $event = Event::findOrFail($eventId);
        
        // Validasi input
        $request->validate([
            'ticket_quantity' => 'required|integer|min:1|max:' . $event->ticket_quota,
        ]);

        // Mengecek apakah tiket masih tersedia
        if ($event->ticket_quota < $request->ticket_quantity) {
            return back()->with('error', 'Not enough tickets available.');
        }

        // Mengurangi jumlah tiket yang tersedia
        $event->ticket_quota -= $request->ticket_quantity;
        $event->save();

        // Menghitung jumlah yang harus dibayar (50% dari total harga tiket)
        $amountPaid = $request->ticket_quantity * $event->ticket_price * 0.5;

        // Menyimpan booking
        $booking = new Booking();
        $booking->user_id = Auth::id();
        $booking->event_id = $event->id;
        $booking->tickets = $request->ticket_quantity;
        $booking->status = 'pending'; // Menggunakan nilai enum yang sesuai
        $booking->amount_paid = $amountPaid;
        $booking->save();

        return redirect()->route('user.bookingHistory')->with('success', 'Booking successful! 50% payment made.');
    }

    // Method untuk menampilkan riwayat booking
    public function bookingHistory()
    {
        $bookings = Booking::where('user_id', Auth::id())->get();
        return view('user.bookings.history', compact('bookings'));
    }

    // Method untuk menyetujui booking
    public function approveBooking($bookingId)
    {
        $booking = Booking::findOrFail($bookingId);

        // Memeriksa apakah pengguna adalah admin atau organizer
        if (Auth::user()->role == 'admin' || Auth::user()->role == 'organizer') {
            $booking->status = 'approved';
            $booking->save();

            return back()->with('success', 'Booking approved successfully.');
        }

        return back()->with('error', 'You do not have permission to approve this booking.');
    }

    // Method untuk membatalkan booking
    public function cancelBooking($bookingId)
    {
        $booking = Booking::findOrFail($bookingId);

        // Memeriksa apakah pengguna adalah admin atau organizer
        if (Auth::user()->role == 'admin' || Auth::user()->role == 'organizer') {
            if ($booking->status == 'pending') {
                $event = Event::findOrFail($booking->event_id);
                $booking->status = 'cancelled';
                $booking->save();

                // Mengembalikan tiket yang dibatalkan ke event
                $event->ticket_quota += $booking->tickets;
                $event->save();

                return back()->with('success', 'Booking cancelled successfully.');
            }

            return back()->with('error', 'Cannot cancel booking.');
        }

        return back()->with('error', 'You do not have permission to cancel this booking.');
    }

    // Method untuk mengubah status booking
    public function updateStatus(Request $request, $bookingId)
    {
        $booking = Booking::findOrFail($bookingId);
        $status = $request->input('status');

        if (!in_array($status, ['approved', 'cancelled'])) {
            return back()->with('error', 'Invalid status.');
        }

        // Mengecek apakah booking masih bisa dibatalkan
        if ($status == 'cancelled') {
            $event = Event::findOrFail($booking->event_id);
            $cancellationDeadline = $event->date_time->subHours(24); // Misalnya, batas waktu pembatalan adalah 24 jam sebelum acara
            if (Carbon::now()->greaterThan($cancellationDeadline)) {
                return back()->with('error', 'Cannot cancel booking after the cancellation deadline.');
            }

            // Mengembalikan tiket yang dibatalkan ke event
            $event->ticket_quota += $booking->tickets;
            $event->save();

            // Mengembalikan 50% dari jumlah yang sudah dibayar
            $refundAmount = $booking->amount_paid * 0.5;
            // Logika pengembalian dana (misalnya, menambahkan saldo pengguna)
            // User::find($booking->user_id)->increment('balance', $refundAmount);
        }

        if ($status == 'approved') {
            // Menghitung sisa pembayaran (50% dari total harga tiket)
            $remainingAmount = $booking->tickets * $booking->event->ticket_price * 0.5;
            $booking->amount_paid += $remainingAmount;
        }

        $booking->status = $status;
        $booking->save();

        return back()->with('success', 'Booking status updated successfully.');
    }

    // Method untuk menghapus booking
    public function deleteBooking($bookingId)
    {
        $booking = Booking::findOrFail($bookingId);

        // Memeriksa apakah pengguna adalah admin atau organizer
        if (Auth::user()->role == 'admin' || Auth::user()->role == 'organizer') {
            $booking->delete();

            return back()->with('success', 'Booking deleted successfully.');
        }

        return back()->with('error', 'You do not have permission to delete this booking.');
    }

    // Method untuk menampilkan halaman booking management
    public function index()
    {
        $organizerId = Auth::id();
        $bookings = Booking::whereHas('event', function ($query) use ($organizerId) {
            $query->where('organizer_id', $organizerId);
        })->with('user', 'event')->get();

        return view('organizer.bookings.index', compact('bookings'));
    }
}
