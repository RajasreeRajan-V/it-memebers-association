<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('internship_applications', function (Blueprint $table) {
            $table->id();

            $table->foreignId('internship_id')
                ->constrained('internships')
                ->cascadeOnDelete();

            $table->foreignId('student_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->string('resume')->nullable();
            $table->text('cover_letter')->nullable();

            // No "shortlisted" state — only: applied, selected, rejected, completed
            $table->string('status')->default('applied');

            $table->timestamp('applied_at')->nullable();
            $table->timestamp('selected_at')->nullable();
            $table->timestamp('rejected_at')->nullable();
            $table->timestamp('completed_at')->nullable();

            // Filled in when the employer marks the internship completed
            $table->string('performance')->nullable();
            $table->text('comments')->nullable();

            $table->timestamps();

            $table->unique(['internship_id', 'student_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('internship_applications');
    }
};
