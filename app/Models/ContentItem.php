<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Cache;

class ContentItem extends Model
{
    protected $fillable = ['page', 'field', 'value'];

    private static array $cache = [];
    private static array $pageCache = [];
    private const CACHE_PAGE_PREFIX = 'contentitem.page.';

    public static function flushCache(): void
    {
        self::$cache = [];
        self::$pageCache = [];
        // Temel amaç bu uygulamanın sadece kendi iç cache'ini temizlemek.
        // Cache driver'ı `file`/`array` olduğunda flush maliyeti düşüktür.
        Cache::flush();
    }

    public static function text(string $page, string $field, string $default = ''): string
    {
        $key = $page.'.'.$field;
        if (! array_key_exists($key, self::$cache)) {
            try {
                if (! array_key_exists($page, self::$pageCache)) {
                    $cacheKey = self::CACHE_PAGE_PREFIX.$page;
                    $map = Cache::get($cacheKey);
                    if (!is_array($map)) {
                        $map = static::query()
                            ->where('page', $page)
                            ->pluck('value', 'field')
                            ->all();
                        Cache::forever($cacheKey, $map);
                    }

                    self::$pageCache[$page] = $map;
                }

                self::$cache[$key] = self::$pageCache[$page][$field] ?? null;
            } catch (QueryException) {
                self::$pageCache[$page] = [];
                self::$cache[$key] = null;
            }
        }
        $v = self::$cache[$key];

        return ($v === null || $v === '') ? $default : (string) $v;
    }

    public static function media(string $page, string $field, string $defaultRelativePath): string
    {
        $v = static::text($page, $field, '');
        $path = $v !== '' ? $v : $defaultRelativePath;
        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }

        return asset($path);
    }
}
