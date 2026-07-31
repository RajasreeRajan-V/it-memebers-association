<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            if (! Schema::hasColumn('articles', 'read_minutes')) {
                $table->unsignedInteger('read_minutes')->default(5)->after('category_slug');
            }

            // While we're here, make sure the rest of the columns the
            // Article model relies on actually exist too — this avoids
            // hitting the exact same "Unknown column" error again on the
            // very next field.
            if (! Schema::hasColumn('articles', 'views_count')) {
                $table->unsignedInteger('views_count')->default(0)->after('read_minutes');
            }
            if (! Schema::hasColumn('articles', 'likes_count')) {
                $table->unsignedInteger('likes_count')->default(0)->after('views_count');
            }
            if (! Schema::hasColumn('articles', 'comments_count')) {
                $table->unsignedInteger('comments_count')->default(0)->after('likes_count');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn(['read_minutes', 'views_count', 'likes_count', 'comments_count']);
        });
    }
};