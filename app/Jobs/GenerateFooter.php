<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Event;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class GenerateFooter implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Log::info('Generatefooter');
        if (config('wahana.workplace') == 'server')
        {
            //server
            $footFile = '/var/www/wahana/partials/foot_event.php';
            
        } else 
        {
            // local
            $footFile = '/Users/rickysutanto/Development/Laravel/wahanatatar3/partials/foot_event.php';
        }
        
        $page = Event::getLatestThree();
        $footer = View::make('partials.foot_event')->with('page', $page)->render();
        Storage::put('partials/foot_event.php', $footer);
        if (File::exists($footFile)) {
            File::delete($footFile);
        }
        $fname = Storage::path('partials/foot_event.php');
        if (copy($fname, $footFile)) {
            Log::info("File " . $fname ." copy successfully.");
        } else {
            Log::info("Failed to copy events/sidebar.php.");
        }
    }
}
