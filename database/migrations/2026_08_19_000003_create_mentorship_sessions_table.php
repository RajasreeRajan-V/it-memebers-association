<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mentorship_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mentorship_id')->constrained('mentorships')->cascadeOnDelete();
            $table->foreignId('mentor_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('student_id')->constrained('users')->cascadeOnDelete();

            $table->string('topic');
            $table->date('session_date');
            $table->time('start_time');
            $table->unsignedSmallInteger('duration_minutes')->default(60);

            $table->dateTime('starts_at');
            $table->dateTime('ends_at');

            $table->enum('meeting_type', ['online', 'offline'])->default('online');
            $table->string('meeting_link')->nullable();
            $table->text('agenda')->nullable();

            // scheduled -> confirmed -> in_progress -> completed | cancelled | rescheduled
            $table->enum('status', [
                'scheduled',
                'confirmed',
                'in_progress',
                'completed',
                'cancelled',
                'rescheduled',
            ])->default('scheduled');

            $table->text('mentor_notes')->nullable();
            $table->text('student_notes')->nullable();
            $table->text('homework')->nullable();
            $table->text('resources')->nullable();

            $table->timestamps();

            $table->index(['mentor_id', 'starts_at']);
            $table->index(['student_id', 'starts_at']);
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mentorship_sessions');
    }
};
