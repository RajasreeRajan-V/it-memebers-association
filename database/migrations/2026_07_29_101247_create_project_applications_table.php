<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('project_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->text('cover_note');
            $table->string('proposed_rate');
            $table->string('estimated_timeline');
            $table->enum('status', ['pending', 'shortlisted', 'accepted', 'rejected', 'withdrawn'])
                ->default('pending');
            $table->timestamps();

            // An employee can only submit one proposal per project.
            $table->unique(['project_id', 'user_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('project_applications');
    }
};