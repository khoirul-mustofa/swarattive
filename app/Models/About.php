<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Enums\PageStatusEnum;

class About extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'page_banner_image_url',
        'page_banner_image_path',
        'story_title',
        'story_content',
        'story_image_url',
        'story_image_path',
        'bts_title',
        'bts_subtitle',
        'bts_items',
    ];

    public function getPageBannerImageUrlAttribute($value)
    {
        if ($this->page_banner_image_path) {
            return \Illuminate\Support\Facades\Storage::url($this->page_banner_image_path);
        }
        return $value;
    }

    public function getStoryImageUrlAttribute($value)
    {
        if ($this->story_image_path) {
            return \Illuminate\Support\Facades\Storage::url($this->story_image_path);
        }
        return $value;
    }

    public function getBtsItemsAttribute($value)
    {
        $items = is_array($value) ? $value : json_decode($value, true);
        if (!$items) return [];

        return collect($items)->map(function ($item) {
            if (isset($item['image_url']) && !str_starts_with($item['image_url'], 'http')) {
                $item['image_url'] = \Illuminate\Support\Facades\Storage::url($item['image_url']);
            }
            return $item;
        })->toArray();
    }

    protected $casts = [
        'status' => PageStatusEnum::class,
        'bts_items' => 'array',
    ];
}
