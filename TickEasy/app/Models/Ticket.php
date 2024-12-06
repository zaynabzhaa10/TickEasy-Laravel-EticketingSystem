<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'price',
        'status',  // Misalnya 'available', 'sold', 'reserved'
        'quantity',
    ];

    // Relasi ke acara terkait dengan tiket
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    // Relasi ke pemesanan yang menggunakan tiket ini
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}

