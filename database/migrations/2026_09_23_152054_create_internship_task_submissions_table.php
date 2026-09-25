<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('internship_task_submissions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('task_id')
                ->constrained('internship_tasks')
                ->cascadeOnDelete();

            $table->foreignId('student_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->text('submission_text')
                ->nullable();

            $table->string('submission_url')
                ->nullable();

            $table->string('file_path')
                ->nullable();

            // submitted | completed | changes_requested
            $table->string('status')
                ->default('submitted');

            $table->text('employer_feedback')
                ->nullable();

            $table->timestamp('submitted_at')
                ->nullable();

            $table->timestamp('reviewed_at')
                ->nullable();

            $table->timestamps();

            // One submission per student per task.
            // Resubmissions update the existing record.
            $table->unique(['task_id', 'student_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('internship_task_submissions');
    }
};