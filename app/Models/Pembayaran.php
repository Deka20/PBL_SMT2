<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayaran';

    protected $primaryKey = 'id_pembayaran';
    public $timestamps = false;

    protected $fillable = [
    'user_id',
    'id_pemesanan',
    'bukti_pembayaran',
    'tgl_pembayaran',
];

    // Jika Anda memiliki relasi, definisikan di sini
    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class, 'id_pemesanan', 'id_pemesanan');
    }

    public function verifikasiPembayaran()
    {
        return $this->hasOne(VerifikasiPembayaran::class, 'id_pembayaran', 'id');
    }

    // Accessor untuk status (jika masih diperlukan)
    public function getStatusAttribute()
    {
        return $this->verifikasiPembayaran ? $this->verifikasiPembayaran->status_pembayaran : null;
    }

     public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}