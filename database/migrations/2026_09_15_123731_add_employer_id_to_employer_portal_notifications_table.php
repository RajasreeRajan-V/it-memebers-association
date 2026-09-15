<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('employer_portal_notifications', function (Blueprint $table) {
            $table->foreignId('employer_id')
                ->after('id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->index(['employer_id', 'is_read']);
        });
    }

    public function down(): void
    {
        Schema::table('employer_portal_notifications', function (Blueprint $table) {
            $table->dropForeign(['employer_id']);
            $table->dropIndex(['employer_id', 'is_read']);
            $table->dropColumn('employer_id');
        });
    }
};