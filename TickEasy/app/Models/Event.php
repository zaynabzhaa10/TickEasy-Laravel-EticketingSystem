<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Event extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'date_time',
        'location',
        'image',
        'organizer_id',
        'ticket_price',
        'ticket_quota',
    ];

    protected $dates = [
        'date_time',
    ];

    public function getDateTimeAttribute($value)
    {
        return Carbon::parse($value);
    }

    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'favorites', 'event_id', 'user_id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    // Relasi ke model User sebagai organizer
    public function organizer()
    {
        return $this->belongsTo(User::class, 'organizer_id');
    }

    public function favorites()
    {
        return $this->belongsToMany(User::class, 'favorites', 'event_id', 'user_id');
    }
}
