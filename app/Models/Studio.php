<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Studio extends Model
{
    use HasFactory;

    protected $table = 'studio_foto';
    protected $primaryKey = 'id_studio';

    public $timestamps = false;
    
    protected $fillable = [
        'jenis_studio',
        'nama_studio',
        'harga',
        'kapasitas',
        'gambar',
        'dibuat_pada',
        'diubah_pada'
    ];

    protected $casts = [
        'harga' => 'decimal:2',
        'dibuat_pada' => 'datetime',
        'diubah_pada' => 'datetime'
    ];

    public function getGambarUrlAttribute()
{
    return $this->gambar ? asset('storage/'.$this->gambar) : null;
}

public function reviews()
    {
        return $this->hasMany(Review::class, 'id_studio', 'id_studio');
    }
}
