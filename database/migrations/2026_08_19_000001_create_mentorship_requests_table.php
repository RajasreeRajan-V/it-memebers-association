<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mentorship_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('mentor_id')->constrained('users')->cascadeOnDelete();

            $table->text('goal');
            $table->string('current_skills')->nullable();
            $table->string('career_goal');
            $table->enum('frequency', ['weekly', 'biweekly', 'monthly']);
            $table->json('preferred_days')->nullable();
            $table->string('preferred_time')->nullable();
            $table->text('message')->nullable();

            // pending -> accepted -> (mentorship created) | rejected | time_suggested | cancelled
            $table->enum('status', [
                'pending',
                'accepted',
                'rejected',
                'time_suggested',
                'cancelled',
            ])->default('pending');

            // Used when mentor proposes a different date/time ("Suggest New Time")
            $table->date('suggested_date')->nullable();
            $table->string('suggested_time')->nullable();
            $table->text('suggestion_note')->nullable();

            $table->timestamp('accepted_at')->nullable();
            $table->foreignId('admin_id')->nullable()->constrained('admins')->nullOnDelete();
            $table->timestamp('admin_verified_at')->nullable();

            $table->timestamps();

            $table->index(['mentor_id', 'status']);
            $table->index(['student_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mentorship_requests');
    }
};
