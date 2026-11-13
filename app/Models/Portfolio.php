<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Portfolio extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'couple_name',
        'client_name',
        'project_date',
        'description',
        'image_path',
        'video_url',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected static function booted(): void
    {
        static::saving(function (Portfolio $portfolio): void {
            if (filled($portfolio->slug)) {
                return;
            }
            $base = Str::slug($portfolio->title ?: 'portfolio');
            if (!filled($base)) {
                $base = 'portfolio';
            }
            $slug = $base;
            $n = 1;
            while (static::query()
                ->where('slug', $slug)
                ->when($portfolio->exists, fn ($q) => $q->where('id', '!=', $portfolio->id))
                ->exists()) {
                $slug = $base.'-'.$n++;
            }
            $portfolio->slug = $slug;
        });
    }
}
