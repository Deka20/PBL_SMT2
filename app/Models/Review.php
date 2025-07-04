<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
    'id',
    'user_id',
    'studio_id',
    'booking_id',
    'rating',
    'review',
    'review_date',
    'created_at',
    'updated_at'
    ];
    protected $table = 'ulasan';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $casts = [
        'review_date' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'rating' => 'integer',
        'user_id' => 'integer',
        'studio_id' => 'integer',
        'booking_id' => 'integer',
        'review' => 'string',
        'id' => 'integer',
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
