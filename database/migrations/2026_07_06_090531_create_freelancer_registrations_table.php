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
        Schema::create('freelancer_registrations', function (Blueprint $table) {
            $table->id();

            
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->string('specialization');
            $table->integer('experience');
            $table->decimal('hourly_rate', 10, 2)->nullable();
            $table->string('portfolio_link')->nullable();
            $table->text('skills')->nullable();
            $table->string('github')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('availability')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('freelancer_registrations');
    }
};