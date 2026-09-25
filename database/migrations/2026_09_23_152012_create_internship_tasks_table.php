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
        Schema::create('internship_tasks', function (Blueprint $table) {
            $table->id();

            $table->foreignId('module_id')
                ->constrained('internship_modules')
                ->cascadeOnDelete();

            $table->string('title');

            $table->text('description')
                ->nullable();

            $table->text('instructions')
                ->nullable();

            // github_link | file_upload | text
            $table->string('submission_type')
                ->default('text');

            $table->unsignedInteger('sort_order')
                ->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('internship_tasks');
    }
};