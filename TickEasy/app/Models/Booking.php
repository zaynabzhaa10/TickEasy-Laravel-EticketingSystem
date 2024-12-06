<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'event_id',
        'tickets',
        'status',
        'amount_paid',
    ];

    // Relasi ke pengguna yang memesan tiket
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke acara yang dipesan
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}

