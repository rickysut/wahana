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
        $destinationFolderPath = '/Users/rickysutanto/Development/LARAVEL/wahanatatar/assets/client/';
        // natcasesort($images);
        foreach ($images as $image) { 
            $fname = Storage::disk('local')->path($image);
            Log::info($fname);
            $destinationFilePath = $destinationFolderPath . basename($image);
            Log::info($destinationFilePath);
            if (copy($fname, $destinationFilePath)) {
                Log::info("File " . $image ." moved successfully.");
            } else {
                Log::info("Failed to move the file.");
            }
        }
    }
}
