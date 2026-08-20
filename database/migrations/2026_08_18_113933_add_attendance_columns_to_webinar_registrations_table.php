<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('webinar_registrations', function (Blueprint $table) {
            $table->string('attendance_status')->default('registered')->after('status');
            // values: registered | joined | attended | absent
            $table->timestamp('joined_at')->nullable()->after('attendance_status');
            $table->timestamp('left_at')->nullable()->after('joined_at');
        });
    }

    public function down(): void
    {
        Schema::table('webinar_registrations', function (Blueprint $table) {
            $table->dropColumn(['attendance_status', 'joined_at', 'left_at']);
        });
    }
};