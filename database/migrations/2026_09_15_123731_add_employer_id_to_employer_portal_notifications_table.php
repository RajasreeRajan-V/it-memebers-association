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
        if (!Schema::hasColumn('employer_portal_notifications', 'is_read')) {
            Schema::table('employer_portal_notifications', function (Blueprint $table) {
                $table->boolean('is_read')
                    ->default(false)
                    ->after('employer_id');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('employer_portal_notifications', 'is_read')) {
            Schema::table('employer_portal_notifications', function (Blueprint $table) {
                $table->dropColumn('is_read');
            });
        }
    }
};