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
         Schema::table('employer_registrations', function (Blueprint $table) {
            $table->renameColumn('company_logo', 'profile_photo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employer_registrations', function (Blueprint $table) {
            $table->renameColumn('profile_photo', 'company_logo');
        });
    }
};
