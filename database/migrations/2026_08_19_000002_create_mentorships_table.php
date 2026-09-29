<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mentorships', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mentorship_request_id')->nullable()->constrained('mentorship_requests')->nullOnDelete();
            $table->foreignId('student_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('mentor_id')->constrained('users')->cascadeOnDelete();

            $table->string('career_goal')->nullable();

            // active -> completed | cancelled
            $table->enum('status', ['active', 'completed', 'cancelled'])->default('active');

            $table->unsignedTinyInteger('progress_percent')->default(0);

            $table->enum('completion_reason', [
                'goals_completed',
                'student_requested',
                'mentor_requested',
                'other',
            ])->nullable();
            $table->text('completion_notes')->nullable();

            $table->timestamp('started_at')->nullable();
            $table->timestamp('completed_at')->nullable();

            $table->timestamps();

            $table->index(['mentor_id', 'status']);
            $table->index(['student_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mentorships');
    }
};
