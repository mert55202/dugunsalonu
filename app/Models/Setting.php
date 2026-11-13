<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'site_title',
        'hero_title',
        'hero_subtitle',
        'phone',
        'email',
        'address',
        'seo_title',
        'seo_description',
        'seo_keywords',
        'og_image',
    ];
}
