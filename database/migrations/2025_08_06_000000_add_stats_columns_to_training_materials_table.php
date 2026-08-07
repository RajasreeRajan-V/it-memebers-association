<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('training_materials', function (Blueprint $table) {
            $table->unsignedInteger('views_count')->default(0)->after('file_path');
            $table->unsignedInteger('downloads_count')->default(0)->after('views_count');
            $table->unsignedInteger('rating_count')->default(0)->after('downloads_count');
            $table->decimal('rating_avg', 3, 2)->default(0)->after('rating_count');
        });
    }

    public function down(): void
    {
        Schema::table('training_materials', function (Blueprint $table) {
            $table->dropColumn(['views_count', 'downloads_count', 'rating_count', 'rating_avg']);
        });
    }
};
