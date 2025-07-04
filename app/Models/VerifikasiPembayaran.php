<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerifikasiPembayaran extends Model
{
    use HasFactory;

    protected $table = 'verifikasi_pembayaran';
    protected $primaryKey = 'id_verifikasi';

    protected $fillable = [
        'id_pembayaran',
        'id_pemesanan',
        'status_pembayaran',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Status yang tersedia
    const STATUS_PENDING = 'pending';
    const STATUS_DIKONFIRMASI = 'dikonfirmasi';
    const STATUS_DITOLAK = 'ditolak';
    const STATUS_KADALUARSA = 'kadaluarsa';

    // Mapping status lama ke baru
    public static function mapOldStatus($oldStatus)
    {
        $mapping = [
            'dikonfirmasi' => self::STATUS_DIKONFIRMASI,
            'lunas' => self::STATUS_DIKONFIRMASI,
            'menunggu_verifikasi' => self::STATUS_PENDING,
            'ditolak' => self::STATUS_DITOLAK,
            'kadaluarsa' => self::STATUS_KADALUARSA,
        ];

        return $mapping[$oldStatus] ?? self::STATUS_PENDING;
    }

    public static function getStatuses()
    {
        return [
            self::STATUS_PENDING => 'Menunggu Verifikasi',
            self::STATUS_DIKONFIRMASI => 'Terverifikasi',
            self::STATUS_DITOLAK => 'Ditolak',
            self::STATUS_KADALUARSA => 'Kadaluarsa',
        ];
    }

    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class, 'id_pemesanan', 'id_pemesanan');
    }

    public function pembayaran()
    {
        return $this->belongsTo(Pembayaran::class, 'id_pembayaran', 'id');
    }
}