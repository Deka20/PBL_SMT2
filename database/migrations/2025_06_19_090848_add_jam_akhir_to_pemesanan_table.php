<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('pemesanan', function (Blueprint $table) {
        $table->time('jam_akhir')->nullable()->after('jam');
        $table->integer('durasi')->default(1)->after('jam_akhir');
    });
}

public function down()
{
    Schema::table('pemesanan', function (Blueprint $table) {
        $table->dropColumn(['jam_akhir', 'durasi']);
    });
}
};
