<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('trainings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mentor_id')->constrained('users')->cascadeOnDelete();

            // 1. Basic Information
            $table->string('title');
            $table->string('short_description');
            $table->longText('full_description');
            $table->string('category');
            $table->string('technology');
            $table->enum('level', ['beginner', 'intermediate', 'advanced'])->default('beginner');
            $table->enum('training_type', ['recorded', 'live', 'hybrid'])->default('recorded');
            $table->string('thumbnail')->nullable();

            // 2. Training Details
            $table->string('duration')->nullable();
            $table->unsignedInteger('total_sessions')->nullable();
            $table->string('session_duration')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->unsignedInteger('max_participants')->nullable();
            $table->string('language')->nullable();

            // 7. Live Training Details
            $table->string('platform')->nullable();
            $table->string('meeting_link')->nullable();
            $table->string('schedule')->nullable();

            // 9. Certificate
            $table->boolean('certificate_enabled')->default(false);

            // Workflow
            $table->enum('status', [
                'draft',
                'pending_approval',
                'approved',
                'rejected',
                'published',
            ])->default('draft');

            $table->text('rejection_reason')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('submitted_at')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->timestamp('published_at')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('trainings');
    }
};
