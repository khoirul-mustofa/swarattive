<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;


class SiteSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'value',
        'type',
        'group',
    ];

    protected $casts = [
        'value' => 'array',
    ];

    public function scopeByGroup($query, $group)
    {
        return $query->where('group', $group);
    }

    public static function getValue($key, $default = null)
    {
        return Cache::remember("site_setting_{$key}", now()->addHours(24), function () use ($key, $default) {
            $setting = static::where('key', $key)->first();

            return $setting ? $setting->value : $default;
        });
    }


    public static function setValue($key, $value, $type = 'text', $group = 'general')
    {
        $setting = static::updateOrCreate(
            ['key' => $key],
            [
                'value' => is_array($value) ? $value : $value,
                'type' => $type,
                'group' => $group,
            ]
        );

        Cache::forget("site_setting_{$key}");

        return $setting;
    }

}
