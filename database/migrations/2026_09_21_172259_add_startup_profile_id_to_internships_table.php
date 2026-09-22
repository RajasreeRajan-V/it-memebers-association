<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('internships', function (Blueprint $table) {
            $table->foreignId('startup_profile_id')
                ->nullable()
                ->after('employer_id')
                ->constrained('startup_profiles')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('internships', function (Blueprint $table) {
            $table->dropForeign(['startup_profile_id']);
            $table->dropColumn('startup_profile_id');
        });
    }
};