<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkGalleryPhoto extends Model
{
    protected $fillable = [
        'work_gallery_post_id',
        'image_path',
        'sort_order',
    ];

    public function post()
    {
        return $this->belongsTo(WorkGalleryPost::class, 'work_gallery_post_id');
    }
}

