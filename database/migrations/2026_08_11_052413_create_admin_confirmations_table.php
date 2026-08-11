<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('admin_confirmations', function (Blueprint $table) {
            $table->id();

            // What's being confirmed — a MentorshipRequest (mentee accept) or a ResumeReview (final submit)
            $table->morphs('confirmable'); // confirmable_type, confirmable_id

            // 'mentee_request' | 'resume_review' — lets the admin queue group/label items without joining
            $table->string('action');

            $table->foreignId('requested_by')->constrained('users')->cascadeOnDelete(); // the mentor
            $table->string('status')->default('pending'); // pending | approved | rejected

            // Admin who acted, and their note (shown to the mentor, e.g. rejection reason)
            $table->unsignedBigInteger('admin_id')->nullable();
            $table->text('admin_notes')->nullable();
            $table->timestamp('confirmed_at')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('admin_confirmations');
    }
};