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
        Schema::create('internship_modules', function (Blueprint $table) {
            $table->id();

            $table->foreignId('internship_id')
                ->constrained('internships')
                ->cascadeOnDelete();

            $table->string('title');

            $table->text('description')
                ->nullable();

            // Learning outcomes stored as newline-separated bullet points
            $table->text('learning_outcomes')
                ->nullable();

            $table->string('duration')
                ->nullable();

            $table->unsignedInteger('sort_order')
                ->default(0);

            $table->string('status')
                ->default('active');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('internship_modules');
    }
};