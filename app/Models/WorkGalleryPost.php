<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkGalleryPost extends Model
{
    protected $fillable = [
        'title',
        'description',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function photos()
    {
        return $this->hasMany(WorkGalleryPhoto::class, 'work_gallery_post_id')
            ->orderBy('sort_order')
            ->orderBy('id');
    }
}

