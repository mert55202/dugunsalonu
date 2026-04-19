<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('content_items', function (Blueprint $table): void {
            $table->id();
            $table->string('page', 64);
            $table->string('field', 128);
            $table->longText('value')->nullable();
            $table->timestamps();
            $table->unique(['page', 'field']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('content_items');
    }
};
