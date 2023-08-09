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
use Illuminate\Support\Str; 

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
            $configfile = '/var/www/wahanatatar.com/config/phonenumber.php';
        } else 
        {
            $waFile = '/Users/rickysutanto/Development/Laravel/wahanatatar3/partials/whatsapp-button.php';
            $configfile = '/Users/rickysutanto/Development/Laravel/wahanatatar3/config/phonenumber.php';
        }
        
        $contact = Contact::where('active', 1)->first();
        if ($contact){
            $number = Str::replace(' ', '', trim($contact->number));
            $wano = $number;	
            if (($number[0]=="+")){
                $wano = '62' . substr($number,1);
            }
            if (($number[0]=="0")){
                $wano = '62' . substr($number,1);
            }
            if (($number[0]=="+")){
                $wano = substr($number,1);	
            }  
            

            $button = View::make('partials.whatsapp')->with('number', $wano)->render();
            Storage::put('partials/whatsapp_button.php', $button);
            if (File::exists($waFile)) {
                File::delete($waFile);
            }
            $fname = Storage::path('partials/whatsapp_button.php');
            if (copy($fname, $waFile)) {
                Log::info("File " . $fname ." copy successfully.");
            } else {
                Log::error("Failed to copy partials/whatsapp_button.php.");
            }

            $wano2 = '0' . substr($wano,2);
            $format = chunk_split($wano2, 4, ' ');
            $config = View::make('config.phonenumber')->with('number', $format)->render();
            Storage::put('config/phonenumber.php', $config);
            if (File::exists($configfile)) {
                File::delete($configfile);
            }
            $fname = Storage::path('config/phonenumber.php');
            if (copy($fname, $configfile)) {
                Log::info("File " . $fname ." copy successfully.");
            } else {
                Log::error("Failed to copy config/phonenumber.php.");
            }
        }
        
    }
}
