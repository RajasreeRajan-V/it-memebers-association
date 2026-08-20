<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('training_registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('training_program_id')->constrained()->cascadeOnDelete();
            $table->foreignId('student_id')->constrained('users')->cascadeOnDelete();
            $table->string('status')->default('enrolled'); // enrolled | in_progress | completed
            $table->unsignedTinyInteger('progress_percent')->default(0);
            $table->timestamp('enrolled_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();

            $table->unique(['training_program_id', 'student_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('training_registrations');
    }
};