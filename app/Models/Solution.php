<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solution extends Model
{
    use HasFactory;

    protected $table = 'solutions';

    protected $fillable = [
        'title',
        'subtitle',
        'image',
        'icon',
        'slogan',
        'detail',
    ];
}
