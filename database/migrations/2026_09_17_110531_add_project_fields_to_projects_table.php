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
        /*
        |--------------------------------------------------------------------------
        | Add category
        |--------------------------------------------------------------------------
        */
        if (!Schema::hasColumn('projects', 'category')) {
            Schema::table('projects', function (Blueprint $table) {
                $table->string('category')
                    ->nullable()
                    ->after('title');
            });
        }

        /*
        |--------------------------------------------------------------------------
        | Add experience_level
        |--------------------------------------------------------------------------
        */
        if (!Schema::hasColumn('projects', 'experience_level')) {
            Schema::table('projects', function (Blueprint $table) {
                $table->string('experience_level')
                    ->nullable()
                    ->after('duration');
            });
        }

        /*
        |--------------------------------------------------------------------------
        | Add people_required
        |--------------------------------------------------------------------------
        */
        if (!Schema::hasColumn('projects', 'people_required')) {
            Schema::table('projects', function (Blueprint $table) {
                $table->unsignedInteger('people_required')
                    ->default(1)
                    ->after('experience_level');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Remove people_required
        |--------------------------------------------------------------------------
        */
        if (Schema::hasColumn('projects', 'people_required')) {
            Schema::table('projects', function (Blueprint $table) {
                $table->dropColumn('people_required');
            });
        }

        /*
        |--------------------------------------------------------------------------
        | Remove experience_level
        |--------------------------------------------------------------------------
        */
        if (Schema::hasColumn('projects', 'experience_level')) {
            Schema::table('projects', function (Blueprint $table) {
                $table->dropColumn('experience_level');
            });
        }

        /*
        |--------------------------------------------------------------------------
        | Remove category
        |--------------------------------------------------------------------------
        */
        if (Schema::hasColumn('projects', 'category')) {
            Schema::table('projects', function (Blueprint $table) {
                $table->dropColumn('category');
            });
        }
    }
};

