<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mentor_mentees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mentor_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('student_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('assigned_by')->nullable()->constrained('admins')->nullOnDelete();
            $table->enum('status', ['active', 'completed', 'paused'])->default('active');
            $table->text('admin_notes')->nullable();
            $table->timestamp('assigned_at')->nullable();
            $table->timestamps();

            $table->unique(['mentor_id', 'student_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mentor_mentees');
    }
};
