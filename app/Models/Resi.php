<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resi extends Model
{
    use HasFactory;

    protected $table = 'resi';
    protected $primaryKey = 'id_resi';
    public $timestamps = true;

    protected $fillable = [
        'id_pemesanan',
        'detail_sewa',
        'nama_studio',
        'jenis_studio',
        'total_harga',
        'status'
    ];

    protected $casts = [
        'total_harga' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class, 'id_pemesanan', 'id_pemesanan');
    }

    public function getFormattedTotalHargaAttribute()
    {
        return 'Rp ' . number_format($this->total_harga, 0, ',', '.');
    }

    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public function scopeByDate($query, $date)
    {
        return $query->whereHas('pemesanan', function($q) use ($date) {
            $q->whereDate('tanggal', $date);
        });
    }

    public function updateStatus($status)
    {
        $this->status = $status;
        $this->save();
        
        return $this;
    }
}