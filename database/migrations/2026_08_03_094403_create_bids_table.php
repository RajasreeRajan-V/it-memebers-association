<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('freelancer_bids', function (Blueprint $table) {
            $table->id();

            $table->foreignId('project_id')
                ->constrained('projects')
                ->cascadeOnDelete();

            $table->foreignId('freelancer_id')
                ->constrained('freelancer_registrations')
                ->cascadeOnDelete();

            $table->foreignId('employer_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->string('bid_amount');

            $table->string('estimated_days');

            $table->text('cover_letter');

            $table->enum('status', [
                'pending',
                'shortlisted',
                'interview',
                'accepted',
                'rejected',
                'withdrawn'
            ])->default('pending');

            $table->timestamps();

            $table->unique(['project_id', 'freelancer_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('freelancer_bids');
    }
};
