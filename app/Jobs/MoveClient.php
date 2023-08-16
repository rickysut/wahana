<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\File;

class MoveClient implements ShouldQueue
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
        $images =  Storage::files('client');
        if (config('wahana.workplace') == 'server')
        {
            $destinationFolderPath = '/var/www/wahanatatar.com/assets/client';
        } else 
        {
            $destinationFolderPath = '/Users/rickysutanto/Development/Laravel/wahanatatar3/assets/client';
        }
        
        if (File::exists($destinationFolderPath)) {
            File::cleanDirectory($destinationFolderPath);
        }


        foreach ($images as $image) { 
            $fname = Storage::disk('local')->path($image);
            //Log::info($fname);
            $destinationFilePath = $destinationFolderPath . '/'. basename($image);
            //Log::info($destinationFilePath);
            if (copy($fname, $destinationFilePath)) {
                Log::info("File " .  basename($image) ." moved successfully.");
            } else {
                Log::info("Failed to move the file.");
            }
        }
    }
}
