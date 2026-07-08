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
        Schema::create('employee_registrations', function (Blueprint $table) {
            $table->id();

            // Foreign key to users table
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->string('company_name');
            $table->string('designation');
            $table->integer('experience_years');
            $table->decimal('current_ctc', 10, 2)->nullable();
            $table->decimal('expected_ctc', 10, 2)->nullable();
            $table->text('skills')->nullable();
            $table->string('resume')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('experience_proof')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_registrations');
    }
};