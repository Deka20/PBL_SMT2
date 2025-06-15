<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    use HasFactory;

    protected $table = 'pemesanan';
    protected $primaryKey = 'id_pemesanan';
    public $timestamps = false;

    protected $fillable = [
        'nama',
        'no_hp',
        'id_studio',
        'tanggal',
        'jam',
        'harga',
        'jumlah_orang',
        'status'
    ];

    public function studio()
    {
        return $this->belongsTo(Studio::class, 'id_studio', 'id_studio');
    }

    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class, 'id_pemesanan', 'id_pemesanan');
    }
}