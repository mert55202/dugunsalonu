<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('portfolios', function (Blueprint $table): void {
            $table->string('slug')->nullable()->unique()->after('title');
            $table->string('client_name')->nullable()->after('couple_name');
            $table->string('project_date')->nullable()->after('client_name');
        });
    }

    public function down(): void
    {
        Schema::table('portfolios', function (Blueprint $table): void {
            $table->dropColumn(['slug', 'client_name', 'project_date']);
        });
    }
};
