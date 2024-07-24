<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Spatie\ScheduleMonitor\Models\MonitoredScheduledTaskLogItem;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('app:generate-slugs')->everyMinute();
        $schedule->command('app:sitemap:generate')->everyMinute();
        $schedule->command('app:import-jobs')->everyFiveMinutes();
        $schedule->command('model:prune', ['--model' => MonitoredScheduledTaskLogItem::class])->daily();
        $schedule->command('app:job-expiry')->daily();
        $schedule->command('app:video-notice')->daily();
        $schedule->command('app:fetch:jobalerts daily')->daily();
        $schedule->command('app:fetch:jobalerts weekly')->weekly();
        $schedule->command('app:fetch:jobalerts monthly')->monthly();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
