<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $table = 'news';

    protected $fillable = [
        'title',
        'event_date',
        'description',
        'place',
        'location',
        'available_seat',
        'speaker',
        'big_image',
        'small_image',
        'exerpt',
    ];
}
