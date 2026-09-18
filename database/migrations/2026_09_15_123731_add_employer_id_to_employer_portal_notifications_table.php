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
        if (!Schema::hasColumn('employer_portal_notifications', 'employer_id')) {
            Schema::table('employer_portal_notifications', function (Blueprint $table) {
                $table->foreignId('employer_id')
                    ->after('id')
                    ->constrained('users')
                    ->cascadeOnDelete();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('employer_portal_notifications', 'employer_id')) {
            Schema::table('employer_portal_notifications', function (Blueprint $table) {
                // Drop foreign key if it exists
                $table->dropForeign(['employer_id']);

                // Drop employer_id column
                $table->dropColumn('employer_id');
            });
        }
    }
};

