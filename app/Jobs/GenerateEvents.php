<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;


class GenerateEvents implements ShouldQueue
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
        Log::info('GenerateEvents');
        if (config('wahana.workplace') == 'server')
        {
            //server
            $indexFile = '/var/www/wahanatatar.com/events/index.php';
            $assetFolder = '/var/www/wahanatatar.com/assets/img/events/';
            $sliderPath = '/var/www/wahanatatar.com/assets/img/events/slider/';
            $singlePath = '/var/www/wahanatatar.com/events/';
            $sidebarPage = '/var/www/wahanatatar.com/events/sidebar.php';
        } else 
        {
            // local
            $indexFile = '/Users/rickysutanto/Development/Laravel/wahanatatar3/events/index.php';
            $assetFolder = '/Users/rickysutanto/Development/Laravel/wahanatatar3/assets/img/events/';
            $sliderPath = '/Users/rickysutanto/Development/Laravel/wahanatatar3/assets/img/events/slider/';
            $singlePath = '/Users/rickysutanto/Development/Laravel/wahanatatar3/events/';
            $sidebarPage = '/Users/rickysutanto/Development/Laravel/wahanatatar3/events/sidebar.php';
        }
        
        $look = Event::where('event_date', '>=', now())->orderBy('event_date', 'asc')->first();

        $events = Event::where('is_show', 1)->where('deleted_at',null)->orderBy('event_date', 'asc')->get();
        $pages = $events->chunk(6);

        $targetPage = null;
        if ($look){
            foreach ($pages as $pageIndex => $page) {
                foreach ($page as $event) {
                    if ($event->id)
                    {
                        if ($event->id == $look->id) {
                            $targetPage = $pageIndex + 1; // Page index is 0-based, page number is 1-based
                            break 2; // Break out of both loops
                        }
                    }
                }
            }
        } else $targetPage = 1;


        // index
        $index = View::make('events.index')->with('pages', $pages)->with('pageindex', $targetPage)->render();
        Storage::put('events/index.php', $index);
        if (File::exists($indexFile)) {
            File::delete($indexFile);
        }
        $fname = Storage::path('events/index.php');
        if (copy($fname, $indexFile)) {
            Log::info("File " . $fname ." copy successfully.");
        } else {
            Log::info("Failed to copy events/index.php.");
        }

        //sidebar
        $side = Event::getLatestEvents();
        $sidebar = View::make('events.sidebar')->with('events', $side)->render();
        Storage::put('events/sidebar.php', $sidebar);
        if (File::exists($sidebarPage)) {
            File::delete($sidebarPage);
        }
        $fname = Storage::path('events/sidebar.php');
        if (copy($fname, $sidebarPage)) {
            Log::info("File " . $fname ." copy successfully.");
        } else {
            Log::info("Failed to copy events/sidebar.php.");
        }

        // pages & page
        foreach ($pages as $index => $page)
        {
            
            
            $pageFile = View::make('events.page')->with('page', $page)->render();
            Storage::put('events/page_'. ($index+1) .'.php', $pageFile);
            $fullPage = $singlePath . 'page_' . ($index+1) .'.php';
            if (File::exists($fullPage)) {
                File::delete($fullPage);
            }
            $fname = Storage::path('events/page_'. ($index+1) .'.php');
            if (copy($fname, $fullPage)) {
                Log::info("File " . $fname ." copy successfully.");
            } else {
                Log::info("Failed to copy events/page_". ($index+1) .".php.");
            }

            foreach ($page as $item)
            {
                
                if ($item->front_image)
                {
                    $fImg = Storage::disk('public')->path($item->front_image);
                    if (copy($fImg, $assetFolder . basename($fImg))) {
                        Log::info("File " . $assetFolder . basename($fImg) ." copy successfully.");
                    } else {
                        Log::info("Failed to copy ".$fImg);
                    }
                }

                if ($item->speaker_img)
                {
                    $fImg = Storage::disk('public')->path($item->speaker_img);
                    if (copy($fImg, $assetFolder . basename($fImg))) {
                        Log::info("File " . $assetFolder . basename($fImg) ." copy successfully.");
                    } else {
                        Log::info("Failed to copy ".$fImg);
                    }
                }

                if ($item->slider)
                {
                    // Log::debug(($item->slider));
                    foreach ($item->slider as $img)
                    {
                        $fImg = Storage::disk('public')->path($img);
                        if (copy($fImg, $sliderPath . basename($fImg))) {
                            Log::info("File " . $sliderPath . basename($fImg) ." copy successfully.");
                        } else {
                            Log::info("Failed to copy ".$fImg);
                        }
                    }
                }

                //slug page
                $slugPageFile = View::make('events.slug')->with('item', $item)->render();
                Storage::put('events/'.Str::slug($item->title).'.php', $slugPageFile);
                $fullSlugPage = $singlePath . Str::slug($item->title) .'.php';
                if (File::exists($fullSlugPage)) {
                    File::delete($fullSlugPage);
                }
                $fname = Storage::path('events/'.Str::slug($item->title).'.php');
                if (copy($fname, $fullSlugPage)) {
                    Log::info("File " . $fname ." copy successfully.");
                } else {
                    Log::info("Failed to copy events/". Str::slug($item->title) .".php.");
                }


            }

        }
    }
}
