<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PortfolioItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'description',
        'image_url',
        'image_path',
        'gallery_images',
        'gallery_image_paths',
        'tags',
        'is_featured',
        'is_active',
        'shoot_date',
        'client_name',
    ];

    public function getImageUrlAttribute($value)
    {
        if ($this->image_path) {
            return \Illuminate\Support\Facades\Storage::url($this->image_path);
        }
        return $value;
    }

    public function getGalleryImagesAttribute($value)
    {
        if ($this->gallery_image_paths) {
            return collect($this->gallery_image_paths)->map(fn($path) => \Illuminate\Support\Facades\Storage::url($path))->toArray();
        }
        return is_array($value) ? $value : json_decode($value, true);
    }

    protected $casts = [
        'gallery_images' => 'array',
        'gallery_image_paths' => 'array',
        'tags' => 'array',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'shoot_date' => 'date',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeByCategory($query, $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }

    public function getFormattedDateAttribute()
    {
        return $this->shoot_date->format('F d, Y');
    }
}
