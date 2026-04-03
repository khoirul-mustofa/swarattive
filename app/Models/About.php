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
        'story_title',
        'story_content',
        'story_image_url',
        'bts_title',
        'bts_subtitle',
        'bts_items',
    ];

    protected $casts = [
        'status' => PageStatusEnum::class,
        'bts_items' => 'array',
    ];
}
