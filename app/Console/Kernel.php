<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        'App\Console\Commands\CheckTopMount',
        'App\Console\Commands\CheckNotifikasi'
    ];

    protected function schedule(Schedule $schedule)
    {
        $schedule->command('check:notifikasi')->dailyAt('01:00')->timezone('Asia/Jakarta');
        $schedule->command('check:topmount')->dailyAt('01:00')->timezone('Asia/Jakarta');
        
    }

   
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
