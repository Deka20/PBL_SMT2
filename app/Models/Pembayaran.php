<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayaran'; // Pastikan nama tabel benar

    protected $primaryKey = 'id_pembayaran'; // Sesuaikan jika primary key Anda berbeda
    public $timestamps = false; // Jika Anda tidak menggunakan timestamps

    protected $fillable = [
        'id_pemesanan',
        'bukti_pembayaran',
        'tgl_pembayaran',
        'status',
    ];

    // Jika Anda memiliki relasi, definisikan di sini
    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class, 'id_pemesanan', 'id_pemesanan');
    }
}