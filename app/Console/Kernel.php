<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        Commands\UpdateKegiatanStatus::class,
    ];

    protected function schedule(Schedule $schedule)
    {
        $schedule->command('kegiatan:update-status')->hourly();
    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');
        require base_path('routes/console.php');
    }

    protected $routeMiddleware = [
    // ... middleware lainnya
    'role' => \App\Http\Middleware\CheckRole::class,
    ];
    
}