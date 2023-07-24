<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Solution;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use function PHPUnit\Framework\fileExists;

class GenerateSolution implements ShouldQueue
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
        $destinationFile = '/var/www/wahanatatar.com/sections/solutions.php';
        $assetFolder = '/var/www/wahanatatar.com/assets/img/';
        // $destinationFile = '/Users/rickysutanto/Development/Laravel/wahanatatar/sections/solutions.php';
        // $assetFolder = '/Users/rickysutanto/Development/Laravel/wahanatatar/assets/img/';
        $solutions = Solution::all();
        
        //make: sections/solutions.php
        $html = View::make('sections.solutions')->with('solutions', $solutions)->render();
        // Log::info($html);
        Storage::put('sections/solutions.php', $html);

        if (File::exists($destinationFile)) {
            File::delete($destinationFile);
        }
        $fname = Storage::path('sections/solutions.php');
        if (copy($fname, $destinationFile)) {
            Log::info("File " . $fname ." copy successfully.");
        } else {
            Log::info("Failed to copy solutions.php.");
        }

        foreach($solutions as $item){
            $fImg = Storage::path($item->image);
            if (copy($fImg, $assetFolder . basename($fImg))) {
                Log::info("File " . $fImg ." copy successfully.");
            } else {
                Log::info("Failed to copy ".$fImg);
            }
        }

    }
}
