<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Destination;

class Banner extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'banners';

    protected $fillable = [
        'image',
        'title',
        'subtitle',
        'destination_id'
    ];

    public function destination()
    {
        return $this->belongsTo(Destination::class, 'destination_id');
    }
}                                                               
