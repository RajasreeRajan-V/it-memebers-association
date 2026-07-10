<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('internships', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employer_id')->constrained('users')->cascadeOnDelete();

            $table->string('title');
            $table->enum('internship_type', ['full-time', 'part-time', 'remote', 'hybrid', 'on-site']);

            $table->string('country')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();

            $table->text('description');
            $table->string('duration');
            $table->string('stipend')->nullable();

            $table->enum('status', ['pending', 'approved', 'rejected', 'closed'])->default('pending');
            $table->text('rejection_reason')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('internships');
    }
};