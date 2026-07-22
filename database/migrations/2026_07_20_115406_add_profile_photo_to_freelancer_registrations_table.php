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
         Schema::table('freelancer_registrations', function (Blueprint $table) {
            $table->string('profile_photo')->nullable()->after('linkedin');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         Schema::table('freelancer_registrations', function (Blueprint $table) {
            $table->dropColumn('profile_photo');
        });
    }
};
