<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Cache;


class Category extends Model
{
    use HasFactory;

    protected static function booted()
    {
        static::saved(fn () => Cache::forget('footer_settings'));
        static::deleted(fn () => Cache::forget('footer_settings'));
    }

    protected $fillable = [
        'name',
        'slug',
        'description',
        'image_url',
        'image_path',
        'is_active',
        'sort_order',
    ];

    public function getImageUrlAttribute($value)
    {
        if ($this->image_path) {
            return \Illuminate\Support\Facades\Storage::url($this->image_path);
        }
        return $value;
    }

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function services(): HasMany
    {
        return $this->hasMany(Service::class);
    }

    public function portfolioItems(): HasMany
    {
        return $this->hasMany(PortfolioItem::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }
}
