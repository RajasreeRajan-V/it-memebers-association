<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // NOTE: table is named "job_posts" (not "jobs") because Laravel's
        // default database queue driver already uses a table called "jobs".
        Schema::create('job_posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employer_id')->constrained('users')->cascadeOnDelete();

            $table->string('title');
            $table->enum('employment_type', ['full-time', 'part-time', 'contract', 'freelance']);
            $table->string('experience')->nullable();
            $table->string('salary')->nullable();
            $table->json('skills')->nullable();

            $table->string('state')->nullable();
            $table->string('district')->nullable();
            $table->string('city')->nullable();

            $table->enum('work_mode', ['onsite', 'hybrid', 'remote']);
            $table->string('qualification')->nullable();
            $table->text('description');

            $table->enum('status', ['pending', 'approved', 'rejected', 'closed'])->default('pending');
            $table->text('rejection_reason')->nullable();
            $table->timestamp('expires_at')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('job_posts');
    }
};