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
use Illuminate\Support\Facades\File;
use App\Models\Contact;
use Illuminate\Support\Facades\View;

class GenerateWhatsapp implements ShouldQueue
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
        Log::info('GenerateContact');
        if (config('wahana.workplace') == 'server')
        {
            $waFile = '/var/www/wahanatatar.com/partials/whatsapp-button.php';
        } else 
        {
            $waFile = '/Users/rickysutanto/Development/Laravel/wahanatatar3/partials/whatsapp-button.php';
        }
        
        $contact = Contact::where('active', 1)->first();
        if ($contact){
            $button = View::make('partials.whatsapp')->with('number', $contact->number)->render();
        

            Storage::put('partials/whatsapp_button.php', $button);
            if (File::exists($waFile)) {
                File::delete($waFile);
            }
            $fname = Storage::path('partials/whatsapp_button.php');
            if (copy($fname, $waFile)) {
                Log::info("File " . $fname ." copy successfully.");
            } else {
                Log::info("Failed to copy events/index.php.");
            }
        }
        
    }
}
