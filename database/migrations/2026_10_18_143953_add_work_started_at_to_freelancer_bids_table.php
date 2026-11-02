<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('freelancer_bids', function (Blueprint $table) {
            $table->date('work_started_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('freelancer_bids', function (Blueprint $table) {
            $table->dropColumn('work_started_at');
        });
    }
};