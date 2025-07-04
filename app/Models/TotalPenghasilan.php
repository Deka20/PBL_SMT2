<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class TotalPenghasilan extends Model
{
    use HasFactory;

    protected $table = 'total_penghasilan';
    protected $primaryKey = 'id_total_penghasilan';
    public $incrementing = true;
    protected $keyType = 'int';

    public $timestamps = true;

    protected $fillable = [
    'id_pemesanan',
    'id_studio',
    'user_id',
    'nama_studio',
    'jenis_studio',
    'tanggal_pemesanan',
    'jam_pemesanan',
    'jumlah_orang',
    'harga_dasar',
    'biaya_tambahan',
    'total_harga',
    'status_pemesanan',
    'bulan',
    'tahun',
    'periode'
];

    protected $casts = [
        'id_pemesanan' => 'integer',
        'id_studio' => 'integer',
        'user_id' => 'integer',
        'total_penghasilan' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class, 'id_pemesanan', 'id_pemesanan');
    }

    public function studio()
    {
        return $this->belongsTo(Studio::class, 'id_studio', 'id_studio');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function scopeByPeriode($query, $periode)
    {
        return $query->where('periode', $periode);
    }
}