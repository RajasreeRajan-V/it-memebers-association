<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('freelancer_services', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->string('title', 90);
            $table->string('category');
            $table->text('description');
            $table->string('skills');
            $table->string('price');
            $table->unsignedSmallInteger('delivery_days');
            $table->string('portfolio_url')->nullable();
            $table->string('portfolio_image')->nullable();
            $table->string('revision_policy');

            // Admin review workflow
            $table->enum('status', ['pending', 'approved', 'rejected'])
                ->default('pending')
                ->index();

            $table->string('rejection_reason', 500)->nullable();

            // Plain column (no FK): admins may live in a separate table
            $table->unsignedBigInteger('reviewed_by')->nullable();
            $table->timestamp('reviewed_at')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('freelancer_services');
    }
};