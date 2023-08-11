<?php

namespace App\Jobs;

use App\Models\News;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class GenerateNews implements ShouldQueue
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
        Log::info('GenerateNews');
        if (config('wahana.workplace') == 'server')
        {
            //server
            $indexFile = '/var/www/wahanatatar.com/news/index.php';
            $assetFolder = '/var/www/wahanatatar.com/assets/img/news/';
            $sliderPath = '/var/www/wahanatatar.com/assets/img/news/slider/';
            $singlePath = '/var/www/wahanatatar.com/news/';
            $sidebarPage = '/var/www/wahanatatar.com/news/sidebar.php';
        } else 
        {
            // local
            $indexFile = '/Users/rickysutanto/Development/Laravel/wahanatatar3/news/index.php';
            $assetFolder = '/Users/rickysutanto/Development/Laravel/wahanatatar3/assets/img/news/';
            $sliderPath = '/Users/rickysutanto/Development/Laravel/wahanatatar3/assets/img/news/slider/';
            $singlePath = '/Users/rickysutanto/Development/Laravel/wahanatatar3/news/';
            $sidebarPage = '/Users/rickysutanto/Development/Laravel/wahanatatar3/news/sidebar.php';
        }
        
        $news = News::where('is_show', 1)->where('deleted_at',null)->orderBy('updated_at', 'desc')->get();
        $pages = $news->chunk(6);


        // index
        $index = View::make('news.index')->with('pages', $pages)->render();
        Storage::put('news/index.php', $index);
        if (File::exists($indexFile)) {
            File::delete($indexFile);
        }
        $fname = Storage::path('news/index.php');
        if (copy($fname, $indexFile)) {
            Log::info("File " . $fname ." copy successfully.");
        } else {
            Log::info("Failed to copy news/index.php.");
        }

        //sidebar
        $side = News::getLatestNews();
        $sidebar = View::make('news.sidebar')->with('news', $side)->render();
        Storage::put('news/sidebar.php', $sidebar);
        if (File::exists($sidebarPage)) {
            File::delete($sidebarPage);
        }
        $fname = Storage::path('news/sidebar.php');
        if (copy($fname, $sidebarPage)) {
            Log::info("File " . $fname ." copy successfully.");
        } else {
            Log::info("Failed to copy news/sidebar.php.");
        }


        // pages & page
        foreach ($pages as $index => $page)
        {
            $pageFile = View::make('news.page')->with('page', $page)->render();
            Storage::put('news/page_'. ($index+1) .'.php', $pageFile);
            $fullPage = $singlePath . 'page_' . ($index+1) .'.php';
            if (File::exists($fullPage)) {
                File::delete($fullPage);
            }
            $fname = Storage::path('news/page_'. ($index+1) .'.php');
            if (copy($fname, $fullPage)) {
                Log::info("File " . $fname ." copy successfully.");
            } else {
                Log::info("Failed to copy news/page_". ($index+1) .".php.");
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
                $slugPageFile = View::make('news.slug')->with('item', $item)->render();
                Storage::put('news/'.Str::slug($item->title).'.php', $slugPageFile);
                $fullSlugPage = $singlePath . Str::slug($item->title) .'.php';
                if (File::exists($fullSlugPage)) {
                    File::delete($fullSlugPage);
                }
                $fname = Storage::path('news/'.Str::slug($item->title).'.php');
                if (copy($fname, $fullSlugPage)) {
                    Log::info("File " . $fname ." copy successfully.");
                } else {
                    Log::info("Failed to copy news/". Str::slug($item->title) .".php.");
                }


            }

        }


        
    }
}
