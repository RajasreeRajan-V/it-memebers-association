<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            // pending  -> just submitted by employee, awaiting admin review
            // approved -> visible on the employee articles index page
            // rejected -> hidden from index, employee notified by email
            $table->string('status', 20)->default('pending')->after('published_at');
            $table->text('rejection_reason')->nullable()->after('status');
            $table->timestamp('reviewed_at')->nullable()->after('rejection_reason');
        });
    }

    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn(['status', 'rejection_reason', 'reviewed_at']);
        });
    }
};