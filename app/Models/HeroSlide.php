<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeroSlide extends Model
{
    protected $fillable = [
        'image_path',
        'image_url',
        'title',
        'description',
        'button_text',
        'button_url',
        'order',
        'is_active',
    ];

    public function getImageUrlAttribute($value)
    {
        if ($this->image_path) {
            return \Illuminate\Support\Facades\Storage::url($this->image_path);
        }
        return $value;
    }

    protected static function booted()
    {
        static::saved(function () {
            \Illuminate\Support\Facades\Cache::forget('home_hero_slides');
        });

        static::deleted(function () {
            \Illuminate\Support\Facades\Cache::forget('home_hero_slides');
        });
    }
}
