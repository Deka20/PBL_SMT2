<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingSession extends Model
{
    use HasFactory;

    protected $table = 'booking_sessions';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'booking_id',
        'studio_id',
        'session_date',
        'start_time',
        'end_time',
        'duration',
        'price',
        'additional_fee',
        'people_count'
    ];

    public function booking()
    {
        return $this->belongsTo(Pemesanan::class, 'booking_id');
    }

    public function studio()
    {
        return $this->belongsTo(Studio::class, 'studio_id', 'id_studio');
    }
}