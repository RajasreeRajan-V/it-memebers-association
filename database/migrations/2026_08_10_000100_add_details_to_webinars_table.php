<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('webinars', function (Blueprint $table) {
            $table->string('category')->nullable()->after('type');
            $table->string('platform')->nullable()->after('category');
            $table->string('duration')->nullable()->after('platform');
            $table->unsignedInteger('capacity')->nullable()->after('duration');
            $table->json('learning_outcomes')->nullable()->after('description');
            $table->text('hands_on_activities')->nullable()->after('learning_outcomes');
            $table->text('materials_required')->nullable()->after('hands_on_activities');
        });
    }

    public function down(): void
    {
        Schema::table('webinars', function (Blueprint $table) {
            $table->dropColumn([
                'category', 'platform', 'duration', 'capacity',
                'learning_outcomes', 'hands_on_activities', 'materials_required',
            ]);
        });
    }
};
