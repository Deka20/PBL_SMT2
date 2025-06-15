<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Foundation\Console\ClosureCommand;

Artisan::command('inspire', function () {
    /** @var ClosureCommand $this */
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('some:command', function () {
    if (! app(AdminMiddleware::class)->handle(request(), fn () => true)) {
        $this->error('Akses ditolak.');
        return;
    }

    $this->info('This command is authorized.');
});
