<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pemesanan extends Model
{
    use HasFactory;

    protected $table = 'pemesanan';
    protected $primaryKey = 'id_pemesanan';
    public $timestamps = true;

     protected $fillable = [
        'user_id',
        'nama',
        'id_studio',
        'harga',
        'total_harga',
        'jam',
        'jam_akhir',
        'durasi',
        'session_count',
        'sesi_durasi',
        'tanggal',
        'no_hp',
        'jumlah_orang',
    ];

    public function sessions()
    {
        return $this->hasMany(BookingSession::class, 'booking_id');
    }

    public function calculatePrice()
{
    $studio = $this->studio;
    $basePrice = $studio->harga;
    $additionalFee = max(0, ($this->jumlah_orang - 1)) * 5000;
    $totalPrice = ($basePrice + $additionalFee) * $this->session_count;
    
    $this->harga = $totalPrice;
    $this->durasi = $this->session_count * $this->sesi_durasi;
    $this->jam_akhir = Carbon::parse($this->jam)->addMinutes($this->durasi)->format('H:i:s');
}

    public function studio()
    {
        return $this->belongsTo(Studio::class, 'id_studio', 'id_studio');
    }

    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class, 'id_pemesanan', 'id_pemesanan');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

     public function verifikasiPembayaran()
    {
        return $this->hasOne(VerifikasiPembayaran::class, 'id_pemesanan', 'id_pemesanan');
    }

    public function getStatusAttribute()
    {
        return $this->verifikasiPembayaran ? $this->verifikasiPembayaran->status_pembayaran : null;
    }

    public static function getBookedSlotsForDate($studioId, $date)
{
    return self::where('id_studio', $studioId)
        ->where('tanggal', $date)
        ->where(function($query) {
            $query->where('status', 'dikonfirmasi')
                ->orWhere('status', 'lunas')
                ->orWhere(function($q) {
                    $gracePeriod = now()->subMinutes(15);
                    $q->where('status', 'pending')
                      ->where('created_at', '>', $gracePeriod);
                });
        })
        ->select('jam', 'status', 'created_at')
        ->get()
        ->map(function($item) {
            $time = explode(':', $item->jam);
            $item->jam = sprintf("%02d:%02d", $time[0], $time[1] ?? 0);
            return $item;
        });
}

    public function reviews()
{
    return $this->hasMany(Review::class, 'booking_id', 'id_pemesanan');
}
}