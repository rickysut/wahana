<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Event extends Model
{
    use HasFactory;

    protected $table = 'events';

    protected $fillable = [
        'kind',
        'title',
        'subtitle',
        'information',
        'speaker_name',
        'speaker_title',
        'speaker_img',
        'front_image',
        'event_date',
        'location',
        'slider',
        'detail',
        'is_show',
    ];

    protected function slider(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => json_decode($value, true),
            set: fn ($value) => json_encode($value),
        );
    } 

    

    // Function to get the 10 latest news articles
    public static function getLatestEvents()
    {
        return self::orderBy('created_at', 'desc')
                   ->take(10)
                   ->get();
    }
}
