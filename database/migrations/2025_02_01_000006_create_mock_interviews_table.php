<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mock_interviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('mentor_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('assigned_by')->nullable()->constrained('admins')->nullOnDelete();
            $table->dateTime('scheduled_at')->nullable();
            $table->enum('mode', ['online', 'offline'])->default('online');
            $table->string('meeting_link')->nullable();
            $table->enum('status', ['assigned', 'scheduled', 'conducted', 'cancelled'])->default('assigned');
            $table->unsignedTinyInteger('technical_rating')->nullable();
            $table->unsignedTinyInteger('communication_rating')->nullable();
            $table->unsignedTinyInteger('confidence_rating')->nullable();
            $table->unsignedTinyInteger('overall_rating')->nullable();
            $table->text('feedback')->nullable();
            $table->timestamp('conducted_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mock_interviews');
    }
};
