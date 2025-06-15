<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi.
     */
    public function up(): void
    {
        Schema::table('pembayaran', function (Blueprint $table) {
            // Menambahkan kolom 'status' sebagai string (VARCHAR) dengan panjang default 20.
            // Anda bisa mengatur panjang default ini sesuai kebutuhan awal Anda.
            // Jika Anda ingin mengizinkan nilai NULL, tambahkan ->nullable();
            $table->string('status', 20)->after('tgl_pembayaran'); // Menempatkan setelah 'tgl_pembayaran'
        });
    }

    /**
     * Balikkan migrasi.
     */
    public function down(): void
    {
        Schema::table('pembayaran', function (Blueprint $table) {
            // Menghapus kolom 'status' jika migrasi di-rollback.
            $table->dropColumn('status');
        });
    }
};