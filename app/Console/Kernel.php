<?php

namespace App\Console;

use App\Jobs\GenerateEvents;
use App\Jobs\GenerateFooter;
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
        $schedule->job(new GenerateFooter)->daily()->withoutOverlapping()->after(
            function () {}
        );

        $schedule->job(new GenerateEvents)->daily()->withoutOverlapping()->after(
            function () {}
        );
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
