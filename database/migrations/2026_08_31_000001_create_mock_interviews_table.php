<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mock_interviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('mentor_id')->constrained('users')->cascadeOnDelete();

            $table->string('topic')->nullable();          // e.g. "Frontend Dev Interview"
            $table->text('student_notes')->nullable();     // what student wants to focus on

            $table->dateTime('requested_at')->nullable();  // student's preferred time
            $table->dateTime('scheduled_at')->nullable();  // confirmed time (set by mentor)
            $table->string('meeting_link')->nullable();

            $table->enum('status', [
                'pending',      // requested by student, waiting on mentor
                'scheduled',    // mentor confirmed date/time + link
                'completed',    // interview happened
                'cancelled',    // either side cancelled
            ])->default('pending');

            $table->text('mentor_feedback')->nullable();
            $table->unsignedTinyInteger('mentor_rating')->nullable(); // mentor rates student, 1-5

            $table->text('student_feedback')->nullable();
            $table->unsignedTinyInteger('student_rating')->nullable(); // student rates mentor, 1-5

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mock_interviews');
    }
};
