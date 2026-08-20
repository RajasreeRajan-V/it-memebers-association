<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mentorship_requests', function (Blueprint $table) {
            $table->id();

            // Student and Mentor are users
            $table->foreignId('student_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('mentor_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->text('goal');
            $table->string('current_skills')->nullable();
            $table->string('career_goal');

            $table->enum('frequency', [
                'weekly',
                'biweekly',
                'monthly'
            ])->default('weekly');

            $table->json('preferred_days')->nullable();
            $table->string('preferred_time')->nullable();
            $table->text('message')->nullable();

            // PENDING -> ACCEPTED -> ADMIN_VERIFICATION -> ACTIVE
            // PENDING -> REJECTED
            // ACCEPTED -> ADMIN_REJECTED
            $table->enum('status', [
                'pending',
                'accepted',
                'rejected',
                'admin_verification',
                'admin_rejected',
                'active',
                'cancelled',
            ])->default('pending');

            $table->timestamp('accepted_at')->nullable();
            $table->timestamp('admin_verified_at')->nullable();

            // Admin is stored in admins table
            $table->foreignId('admin_id')
                ->nullable()
                ->constrained('admins')
                ->nullOnDelete();

            $table->timestamps();

            $table->index(['mentor_id', 'status']);
            $table->index(['student_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mentorship_requests');
    }
};