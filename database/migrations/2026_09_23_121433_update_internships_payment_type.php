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
        Schema::table('internships', function (Blueprint $table) {

            /*
            |--------------------------------------------------------------------------
            | Internship Type
            |--------------------------------------------------------------------------
            |
            | paid   = Paid internship
            | unpaid = Unpaid internship
            |
            */

            $table->string('internship_type')
                ->default('unpaid')
                ->change();


            /*
            |--------------------------------------------------------------------------
            | Monthly Stipend
            |--------------------------------------------------------------------------
            |
            | Only required for paid internships.
            |
            */

            $table->string('stipend')
                ->nullable()
                ->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('internships', function (Blueprint $table) {

            $table->string('internship_type')
                ->nullable()
                ->change();

            $table->string('stipend')
                ->nullable()
                ->change();
        });
    }
};