<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('work_gallery_photos', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('work_gallery_post_id')->constrained('work_gallery_posts')->cascadeOnDelete();
            $table->string('image_path', 255);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('work_gallery_photos');
    }
};

