<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
    'id', // Tambahkan ini
    'user_id', // Tambahkan ini
    'studio_id', // Tambahkan ini
    'booking_id', // Tambahkan ini 
    'rating', // Tambahkan ini
    'review', // Tambahkan ini
    'review_date', // Tambahkan ini
    'created_at', // Tambahkan ini
    'updated_at' // Tambahkan ini
    ];
    protected $table = 'ulasan'; // Nama tabel yang sesuai
    protected $primaryKey = 'id'; // Primary key tabel
    public $timestamps = true; // Aktifkan timestamps jika tabel memiliki kolom created_at dan updated_at
    protected $casts = [
        'review_date' => 'datetime', // Cast review_date ke tipe datetime
        'created_at' => 'datetime', // Cast created_at ke tipe datetime
        'updated_at' => 'datetime', // Cast updated_at ke tipe datetime
        'rating' => 'integer', // Cast rating ke tipe integer
        'user_id' => 'integer', // Cast user_id ke tipe integer
        'studio_id' => 'integer', // Cast id_studio ke tipe integer
        'booking_id' => 'integer', // Cast booking_id ke tipe integer
        'review' => 'string', // Cast review ke tipe string
        'id' => 'integer', // Cast id ke tipe integer   
];

public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function studio()
    {
        return $this->belongsTo(Studio::class, 'studio_id', 'id_studio');
    }
}
