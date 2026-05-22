<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

#[Fillable(['key', 'value', 'group'])]
class Setting extends Model
{
    /**
     * In-memory cache for the current request (avoids repeated Cache::get).
     */
    protected static array $memoryCache = [];

    /**
     * Whether the memory cache has been populated.
     */
    protected static bool $memoryCacheLoaded = false;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'value' => 'string',
        ];
    }

    /**
     * Get a setting value by key.
     * Uses request-level memory cache + Cache store for performance.
     */
    public static function get(string $key, ?string $default = null): ?string
    {
        // Load all settings into memory cache on first call
        if (!static::$memoryCacheLoaded) {
            static::$memoryCache = Cache::remember('settings_all', 3600, function () {
                return static::all()->pluck('value', 'key')->toArray();
            });
            static::$memoryCacheLoaded = true;
        }

        return static::$memoryCache[$key] ?? $default;
    }

    /**
     * Set a setting value by key.
     */
    public static function set(string $key, ?string $value = null, string $group = 'general'): static
    {
        $setting = static::updateOrCreate(
            ['key' => $key],
            ['value' => $value, 'group' => $group]
        );

        // Update caches
        static::$memoryCache[$key] = $value;
        Cache::forget('settings_all');

        return $setting;
    }

    /**
     * Get all settings grouped by their group.
     */
    public static function grouped(): \Illuminate\Support\Collection
    {
        return static::all()->groupBy('group');
    }

    /**
     * Clear the setting caches (call after bulk updates).
     */
    public static function clearCache(): void
    {
        static::$memoryCache = [];
        static::$memoryCacheLoaded = false;
        Cache::forget('settings_all');
    }
}
