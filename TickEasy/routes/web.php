<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrganizerController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\BookingController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\UserController;


Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Halaman Register Organizer
Route::get('/register-organizer', [RegisteredUserController::class, 'createOrganizer'])->name('register.organizer');

// Form Register Organizer
Route::post('/register-organizer', [RegisteredUserController::class, 'storeOrganizer']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Dashboard untuk Admin
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/users', [AdminController::class, 'manageUsers'])->name('admin.users.index');
    Route::get('/admin/events', [AdminController::class, 'manageEvents'])->name('admin.events.index');
    Route::get('/admin/reports', [AdminController::class, 'manageReports'])->name('admin.reports');

    #manageUsers
    Route::get('/users', [AdminController::class, 'manageUsers'])->name('admin.users.index');
    Route::get('/users/create', [AdminController::class, 'createUser'])->name('admin.users.create');
    Route::post('/users', [AdminController::class, 'storeUser'])->name('admin.users.store');
    Route::get('/users/{user}/edit', [AdminController::class, 'editUser'])->name('admin.users.edit');
    Route::put('/users/{user}', [AdminController::class, 'updateUser'])->name('admin.users.update');
    Route::delete('/users/{user}', [AdminController::class, 'destroyUser'])->name('admin.users.destroy');
    Route::get('/users/{user}', [AdminController::class, 'showUser'])->name('admin.users.show');

    #manageEvents
    Route::get('/events', [EventController::class, 'listEvents'])->name('admin.events.index');
    Route::get('/events/create', [EventController::class, 'createEvent'])->name('admin.events.create');
    Route::post('/events', [EventController::class, 'storeEvent'])->name('admin.events.store');
    Route::get('/events/{id}/edit', [EventController::class, 'editEvent'])->name('admin.events.edit');
    Route::put('/events/{id}', [EventController::class, 'updateEvent'])->name('admin.events.update');
    Route::delete('/events/{id}', [EventController::class, 'deleteEvent'])->name('admin.events.delete');

    // Dashboard untuk Event Organizer
    Route::get('/organizer/dashboard', [OrganizerController::class, 'index'])->name('organizer.dashboard');

    // Dashboard untuk Registered User
    Route::get('/user/dashboard', [UserController::class, 'index'])->name('user.dashboard');
    // Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard');

    Route::get('/organizer/dashboard', [OrganizerController::class, 'index'])->name('organizer.dashboard');
    Route::get('/organizer/events/create', [OrganizerController::class, 'create'])->name('organizer.events.create');
    Route::post('/organizer/events', [OrganizerController::class, 'store'])->name('organizer.events.store');
    Route::get('/organizer/events/{id}/edit', [OrganizerController::class, 'edit'])->name('organizer.events.edit');
    Route::put('/organizer/events/{id}', [OrganizerController::class, 'update'])->name('organizer.events.update');
    Route::delete('/organizer/events/{id}', [OrganizerController::class, 'destroy'])->name('organizer.events.destroy');
    Route::get('/organizer/events/{id}/bookings', [OrganizerController::class, 'viewBookings'])->name('organizer.events.bookings');
    
    // Rute untuk manajemen event oleh organizer
    Route::get('/organizer/events', [OrganizerController::class, 'index'])->name('organizer.events.index');
    Route::get('/organizer/events/create', [OrganizerController::class, 'create'])->name('organizer.events.create');
    Route::post('/organizer/events', [OrganizerController::class, 'store'])->name('organizer.events.store');
    Route::get('/organizer/events/{id}/edit', [OrganizerController::class, 'edit'])->name('organizer.events.edit');
    Route::put('/organizer/events/{id}', [OrganizerController::class, 'update'])->name('organizer.events.update');
    Route::delete('/organizer/events/{id}', [OrganizerController::class, 'destroy'])->name('organizer.events.destroy');
});

Route::middleware(['auth'])->group(function () {
    // Rute untuk manajemen event oleh admin
    Route::get('/admin/events', [AdminController::class, 'manageEvents'])->name('admin.events.index');
    Route::get('/admin/events/create', [AdminController::class, 'createEvent'])->name('admin.events.create');
    Route::post('/admin/events', [AdminController::class, 'storeEvent'])->name('admin.events.store');
    Route::get('/admin/events/{id}/edit', [AdminController::class, 'editEvent'])->name('admin.events.edit');
    Route::put('/admin/events/{id}', [AdminController::class, 'updateEvent'])->name('admin.events.update');
    Route::delete('/admin/events/{id}', [AdminController::class, 'destroyEvent'])->name('admin.events.destroy');

    // Rute untuk manajemen event oleh organizer
    Route::get('/organizer/events', [OrganizerController::class, 'index'])->name('organizer.events.index');
    Route::get('/organizer/events/create', [OrganizerController::class, 'create'])->name('organizer.events.create');
    Route::post('/organizer/events', [OrganizerController::class, 'store'])->name('organizer.events.store');
    Route::get('/organizer/events/{id}/edit', [OrganizerController::class, 'edit'])->name('organizer.events.edit');
    Route::put('/organizer/events/{id}', [OrganizerController::class, 'update'])->name('organizer.events.update');
    Route::delete('/organizer/events/{id}', [OrganizerController::class, 'destroy'])->name('organizer.events.destroy');
    Route::get('/organizer/events/{id}', [OrganizerController::class, 'show'])->name('organizer.events.show');
    Route::get('/organizer/events/{id}/bookings', [OrganizerController::class, 'viewBookings'])->name('organizer.events.bookings');
});

Route::middleware(['auth', 'role:admin,organizer'])->prefix('admin')->name('admin.')->group(function () {
    // Melihat pemesanan tiket untuk setiap acara
    Route::get('events/{eventId}/bookings', [TicketController::class, 'viewBookings'])->name('events.bookings');

    // Menyetujui atau membatalkan pemesanan tiket
    Route::post('bookings/{bookingId}/approve', [TicketController::class, 'approveBooking'])->name('bookings.approve');
    Route::post('bookings/{bookingId}/cancel', [TicketController::class, 'cancelBooking'])->name('bookings.cancel');
    
    // Melihat laporan penjualan tiket
    Route::get('reports/ticket-sales', [TicketController::class, 'generateReports'])->name('reports.ticket_sales');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/events/create', [AdminController::class, 'createEvent'])->name('admin.events.create');
    Route::post('/admin/events/store', [AdminController::class, 'storeEvent'])->name('admin.events.store');
    #guest
    Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.update.password');
});

Route::get('/events/search', [EventController::class, 'search'])->name('events.search');
Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');
Route::middleware('auth')->post('/events/{event}/favorite', [EventController::class, 'favorite'])->name('events.favorite');

Route::middleware(['auth'])->group(function () {
    Route::get('/organizer/events/{event}/edit', [EventController::class, 'edit'])->name('organizer.events.edit');
    Route::get('/organizer/events/{event}/bookings', [BookingController::class, 'index'])->name('organizer.events.bookings');
    Route::get('/events/{event}/book', [BookingController::class, 'create'])->name('events.book');
    Route::post('/events/{event}/book', [BookingController::class, 'store'])->name('events.book.store');
    Route::get('/organizer/events', [EventController::class, 'index'])->name('organizer.events.index');
    Route::get('/organizer/bookings', [BookingController::class, 'index'])->name('organizer.bookings.index');
    Route::get('/organizer/events', [EventController::class, 'index'])->name('organizer.events.index');
    
    // Tambahkan rute baru di sini
    Route::get('/user/events/{eventId}/book', [BookingController::class, 'create'])->name('user.bookTickets');
    Route::post('/user/events/{eventId}/book', [BookingController::class, 'storeBooking']);
    Route::get('/user/bookings/history', [BookingController::class, 'bookingHistory'])->name('user.bookingHistory');
    Route::post('/user/booking/{bookingId}/cancel', [BookingController::class, 'cancelBooking'])->name('user.cancelBooking');
});

Route::middleware('auth')->group(function () {
    Route::get('/user/events/{eventId}/book', [BookingController::class, 'create'])->name('user.bookTickets');
    Route::post('/user/events/{eventId}/book', [BookingController::class, 'storeBooking']);
    Route::get('/user/booking-history', [BookingController::class, 'bookingHistory'])->name('user.bookingHistory');
    Route::post('/user/booking/{bookingId}/update-status', [BookingController::class, 'updateStatus'])->name('user.updateBookingStatus');
    Route::post('/user/booking/{bookingId}/delete', [BookingController::class, 'deleteBooking'])->name('user.deleteBooking');
    Route::post('/user/booking/{bookingId}/cancel', [BookingController::class, 'cancelBooking'])->name('user.cancelBooking');
});

Route::middleware('auth')->group(function () {
    Route::get('/user/booking-history', [BookingController::class, 'bookingHistory'])->name('user.bookingHistory');
    Route::post('/admin/bookings/{bookingId}/approve', [BookingController::class, 'approveBooking'])->name('admin.bookings.approve');
    Route::post('/admin/bookings/{bookingId}/cancel', [BookingController::class, 'cancelBooking'])->name('admin.bookings.cancel');
    Route::get('/admin/bookings', [BookingController::class, 'index'])->name('admin.bookings.index');
    Route::delete('/admin/bookings/{bookingId}/delete', [BookingController::class, 'deleteBooking'])->name('admin.bookings.delete');
});

Route::middleware('auth')->group(function () {
    Route::get('/organizer/bookings', [BookingController::class, 'index'])->name('organizer.bookings.index');
    Route::post('/organizer/bookings/{bookingId}/approve', [BookingController::class, 'approveBooking'])->name('organizer.bookings.approve');
    Route::post('/organizer/bookings/{bookingId}/cancel', [BookingController::class, 'cancelBooking'])->name('organizer.bookings.cancel');
    Route::delete('/organizer/bookings/{bookingId}/delete', [BookingController::class, 'deleteBooking'])->name('organizer.bookings.delete');
});

Route::middleware('auth')->group(function () {
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.update.password');
    
    // Rute lainnya...
});

Route::middleware('auth')->group(function () {
    Route::get('/user/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
    Route::get('/user/bookings/history', [UserController::class, 'bookingHistory'])->name('user.bookings.history');
    Route::get('/user/favorite', [UserController::class, 'favorites'])->name('user.favorite');
    
});

Route::middleware('auth')->group(function () {
    Route::post('/events/{event}/favorite', [EventController::class, 'favorite'])->name('events.favorite');
    Route::delete('/user/favorite/{event}', [UserController::class, 'removeFavorite'])->name('favorite.remove');
});

require __DIR__ . '/auth.php';
