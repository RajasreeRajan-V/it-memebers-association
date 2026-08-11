<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('resume_reviews', function (Blueprint $table) {
            $table->id();

            // Who
            $table->foreignId('student_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('mentor_id')->nullable()->constrained('users')->nullOnDelete();

            // Submitted resume file
            $table->string('resume_path');
            $table->string('resume_original_name')->nullable();

            // Student's request details (from "Get Expert Feedback" form)
            $table->string('review_type');                 // e.g. General Review, ATS Optimization, Skills Review
            $table->text('goal')->nullable();               // "What is your goal?"
            $table->json('feedback_focus')->nullable();     // checkboxes: ["Skills Review", "Experience", ...]
            $table->string('preferred_completion_time')->nullable(); // e.g. "Within 5 days"
            $table->text('additional_instructions')->nullable();

            // Status lifecycle
            $table->enum('status', ['pending', 'assigned', 'in_review', 'completed'])
                ->default('pending');

            // Mentor's review output (rating categories from the review screen)
            $table->unsignedTinyInteger('overall_rating')->nullable();   // 1-5
            $table->unsignedTinyInteger('resume_quality')->nullable();   // 1-5
            $table->unsignedTinyInteger('relevance')->nullable();        // 1-5
            $table->unsignedTinyInteger('presentation')->nullable();     // 1-5
            $table->text('strengths')->nullable();            // "Strengths (What's Good)"
            $table->text('areas_to_improve')->nullable();     // "Areas to Improve"
            $table->text('additional_comments')->nullable();  // "Additional Comments (Optional)"

            $table->timestamp('reviewed_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('resume_reviews');
    }
};
