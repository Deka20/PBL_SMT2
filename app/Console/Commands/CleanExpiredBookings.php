<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Pemesanan;
use Carbon\Carbon;

class CleanExpiredBookings extends Command
{
    protected $signature = 'bookings:clean';
    protected $description = 'Clean up expired pending bookings';

    public function handle()
    {
        $expired = Pemesanan::where('status', 'pending')
            ->where('created_at', '<', Carbon::now()->subMinutes(15))
            ->update(['status' => 'dibatalkan']);

        $this->info("Cleaned up {$expired} expired bookings.");
        return 0;
    }
}