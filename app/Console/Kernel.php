<?php

namespace App\Console;

use App\Jobs\GenerateSolution;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Jobs\MoveClient;

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
        $schedule->job(new MoveClient)->everyMinute()->withoutOverlapping()->after(
            function () {}
        );

        $schedule->job(new GenerateSolution)->everyMinute()->withoutOverlapping()->after(
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
