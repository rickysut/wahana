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
use Illuminate\Support\Str;

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
        Log::info('GenerateSolution');
        //server
        $destinationFile = '/var/www/wahanatatar.com/sections/solutions.php';
        $assetFolder = '/var/www/wahanatatar.com/assets/img/solutions/';
        $solutionIndex = '/var/www/wahanatatar.com/solutions/indexblog.php';
        $singlePath = '/var/www/wahanatatar.com/solutions/';
        $bannerPath = '/var/www/wahanatatar.com/assets/img/solutions/banner/';
        //local
        // $destinationFile = '/Users/rickysutanto/Development/Laravel/wahanatatar3/sections/solutions.php';
        // $assetFolder = '/Users/rickysutanto/Development/Laravel/wahanatatar3/assets/img/solutions/';
        // $solutionIndex = '/Users/rickysutanto/Development/Laravel/wahanatatar3/solutions/indexblog.php';
        // $singlePath = '/Users/rickysutanto/Development/Laravel/wahanatatar3/solutions/';
        // $bannerPath = '/Users/rickysutanto/Development/Laravel/wahanatatar3/assets/img/solutions/banner/';

        $solutions = Solution::all();
        
        //make: sections/solutions.php
        $html = View::make('sections.solutions')->with('solutions', $solutions)->render();
        $index = View::make('solutions.indexblog')->with('solutions', $solutions)->render();
        
        // Log::info($html);
        Storage::put('sections/solutions.php', $html);
        Storage::put('sections/indexblog.php', $index);

        if (File::exists($destinationFile)) {
            File::delete($destinationFile);
        }
        if (File::exists($solutionIndex)) {
            File::delete($solutionIndex);
        }
        $fname = Storage::path('sections/solutions.php');
        if (copy($fname, $destinationFile)) {
            Log::info("File " . $fname ." copy successfully.");
        } else {
            Log::info("Failed to copy solutions.php.");
        }

        $fname = Storage::path('sections/indexblog.php');
        if (copy($fname, $solutionIndex)) {
            Log::info("File " . $solutionIndex ." copy successfully.");
        } else {
            Log::info("Failed to copy solutions/indexblog.php.");
        }

        foreach($solutions as $item){
            if ($item->image)
            {
                $fImg = Storage::disk('public')->path($item->image);
                if (copy($fImg, $assetFolder . basename($fImg))) {
                    Log::info("File " . $assetFolder . basename($fImg) ." copy successfully.");
                } else {
                    Log::info("Failed to copy ".$fImg);
                }
            }

            if ($item->banner)
            {
                $fImg = Storage::disk('public')->path($item->banner);
                if (copy($fImg, $bannerPath . basename($fImg))) {
                    Log::info("File " . $bannerPath . basename($fImg) ." copy successfully.");
                } else {
                    Log::info("Failed to copy ".$fImg);
                }
            }

            $quote = Str::between($item->slogan, '"', '"');
            $person = Str::after($item->slogan, $quote.'"');
            
            $single = View::make('solutions.singlesolution')->with('solutions', $item)
            ->with('quote', $quote)
            ->with('person', $person)
            ->render();
            $fBanner = $singlePath . Str::slug($item->title) . '.php';
            if (Storage::exists('solutions/single/'. Str::slug($item->title) . '.php')){
                Storage::delete('solutions/single/'. Str::slug($item->title) . '.php');
            }
            Storage::put('solutions/single/'. Str::slug($item->title) . '.php', $single);
            $fBnn = Storage::path('solutions/single/'. Str::slug($item->title) . '.php');
            if (copy($fBnn, $fBanner)) {
                Log::info("File " . $fBnn ." copy successfully.");
            } else {
                Log::info("Failed to copy ".$fBnn);
            }
        }

    }
}
