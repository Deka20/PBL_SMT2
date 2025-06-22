<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class TotalPenghasilan extends Model
{
    use HasFactory;

    protected $table = 'total_penghasilan';
    // Correct primary key name as per your database schema
    protected $primaryKey = 'id_total_penghasilan';
    // Eloquent handles 'id' by default if it's the primary key, but your table uses 'id_total_penghasilan'
    public $incrementing = true; // id_total_penghasilan is auto-incrementing
    protected $keyType = 'int'; // Or 'string' if it were a UUID

    public $timestamps = true; // created_at and updated_at exist in your table

    // ONLY include columns that actually exist in your 'total_penghasilan' table
    protected $fillable = [
    'id_pemesanan',
    'id_studio',
    'user_id',
    'nama_studio',
    'jenis_studio',
    'tanggal_pemesanan', // Pastikan ini ada
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

    // Adjust casts to match the actual columns and types
    protected $casts = [
        'id_pemesanan' => 'integer', // bigint unsigned typically maps to integer for Eloquent unless very large
        'id_studio' => 'integer',
        'user_id' => 'integer',
        'total_penghasilan' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    // Relasi ke tabel pemesanan
    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class, 'id_pemesanan', 'id_pemesanan');
    }

    // Relasi ke tabel studio_foto
    public function studio()
    {
        return $this->belongsTo(Studio::class, 'id_studio', 'id_studio');
    }

    // Relasi ke tabel users
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    // --- Remove Accessors/Scopes/Methods for columns that don't exist in the DB ---
    // Remove getFormattedTotalHargaAttribute, getFormattedHargaDasarAttribute, getFormattedBiayaTambahanAttribute
    // Remove getFormattedTanggalPemesananAttribute, getNamaBulanAttribute
    // Remove scopeByBulanTahun, scopeByStatus, scopeSelesai
    // Remove updateStatus method
    // Remove getTotalPenghasilanByPeriode, getPenghasilanByStudio, getTrendPenghasilanBulanan (unless you rewrite them to ONLY use the columns in total_penghasilan table)

    // Example of a re-written scope for filtering by periode (this is already in your model and is fine)
    public function scopeByPeriode($query, $periode)
    {
        return $query->where('periode', $periode);
    }
}