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
            $table->foreignId('mentor_mentee_id')->constrained('mentor_mentees')->cascadeOnDelete();
            $table->foreignId('mentor_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('student_id')->constrained('users')->cascadeOnDelete();
            $table->dateTime('scheduled_at');
            $table->enum('mode', ['online', 'offline'])->default('online');
            $table->string('meeting_link')->nullable();
            $table->enum('status', ['scheduled', 'conducted', 'cancelled'])->default('scheduled');
            $table->text('session_notes')->nullable();
            $table->timestamp('conducted_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mentorship_sessions');
    }
};
