<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeroSlide extends Model
{
    protected $fillable = [
        'image',
        'title',
        'description',
        'button_text',
        'button_url',
        'order',
        'is_active',
    ];
}
