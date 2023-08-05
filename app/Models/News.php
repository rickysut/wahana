<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use MoonShine\Models\MoonshineUser;

class News extends Model
{
    use HasFactory;

    protected $table = 'news';

    protected $fillable = [
        'user_id',
        'title',
        'subtitle',
        'front_image',
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

    public function user()
    {
        return $this->belongsTo(MoonshineUser::class, 'user_id', 'id');
    }

    // Function to get the 10 latest news articles
    public static function getLatestNews()
    {
        return self::orderBy('created_at', 'desc')
                   ->take(10)
                   ->get();
    }
}
