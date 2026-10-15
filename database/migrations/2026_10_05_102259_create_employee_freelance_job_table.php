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
        Schema::create('employee_freelance_job', function (Blueprint $table) {
            $table->id();

            // Freelance job / project
            $table->foreignId('project_id')
                ->constrained('projects')
                ->cascadeOnDelete();

            // Employee who applied
            $table->foreignId('employee_id')
                ->constrained('employee_registrations')
                ->cascadeOnDelete();

            $table->text('cover_letter');

            $table->string('resume_path')->nullable();
            $table->string('portfolio_path')->nullable();
            $table->string('github')->nullable();
            $table->string('linkedin')->nullable();

            $table->enum('availability', [
                'full_time',
                'part_time',
                'flexible'
            ]);

            $table->string('status')->default('pending');

            $table->timestamps();

            // One employee can apply only once to the same project
            $table->unique(['project_id', 'employee_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_freelance_job');
    }
};