<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // Expire overdue licenses daily at midnight
        $schedule->command('licenses:check-expiry')->dailyAt('00:05');

        // Prune old activity logs (keep 90 days)
        $schedule->command('activitylog:clean --days=90')->weekly();

        // Clear expired password reset tokens
        $schedule->command('auth:clear-resets')->daily();

        // Retry failed queue jobs
        $schedule->command('queue:retry all')->dailyAt('06:00');

        // Prune failed jobs older than 7 days
        $schedule->command('queue:prune-failed --hours=168')->daily();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
