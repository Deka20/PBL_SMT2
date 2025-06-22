<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    use HasFactory;

     protected $table = 'portofolio'; // Nama tabel yang sesuai

    // Define which attributes are mass assignable
    protected $fillable = [
        'image_path',
    ];
}