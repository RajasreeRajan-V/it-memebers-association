<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('webinar_registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('webinar_id')->constrained()->cascadeOnDelete();
            $table->foreignId('student_id')->constrained('users')->cascadeOnDelete();

            // pending   = event is full, student is waitlisted
            // approved  = confirmed seat
            // attended  = marked present after the event
            // completed = event finished, attendance recorded
            // cancelled = student cancelled their own registration
            $table->enum('status', ['pending', 'approved', 'attended', 'completed', 'cancelled'])
                ->default('approved');

            $table->timestamp('registered_at')->useCurrent();
            $table->timestamps();

            // A student can only register once per webinar
            $table->unique(['webinar_id', 'student_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('webinar_registrations');
    }
};
