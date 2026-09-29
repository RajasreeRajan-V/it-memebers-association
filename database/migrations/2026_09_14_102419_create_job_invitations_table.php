<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('job_invitations', function (Blueprint $table) {
            $table->id();

            // Employer who sent the invitation
            $table->foreignId('employer_id')
                ->constrained('users')
                ->cascadeOnDelete();

            // Employee / Student who receives the invitation
            $table->foreignId('candidate_id')
                ->constrained('users')
                ->cascadeOnDelete();

            // Job for which the candidate is invited
            $table->foreignId('job_id')
                ->constrained('job_posts')
                ->cascadeOnDelete();

            // Unique token for the invitation link
            $table->string('token', 100)->unique();

            // Invitation email
            $table->string('email');

            // pending / accepted / expired
            $table->string('status')->default('pending');

            // When invitation email was sent
            $table->timestamp('sent_at')->nullable();

            // When candidate opened invitation
            $table->timestamp('opened_at')->nullable();

            // When candidate applied
            $table->timestamp('applied_at')->nullable();

            $table->timestamps();

            // Prevent same employer inviting same candidate for same job twice
            $table->unique(
                ['employer_id', 'candidate_id', 'job_id'],
                'unique_job_invitation'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('job_invitations');
    }
};