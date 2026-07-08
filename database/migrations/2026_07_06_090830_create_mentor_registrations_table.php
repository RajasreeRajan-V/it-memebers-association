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
        Schema::create('mentor_registrations', function (Blueprint $table) {
            $table->id();

            // Foreign key to users table
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->string('company');
            $table->string('designation');
            $table->string('expertise');
            $table->integer('years_of_experience');
            $table->string('availability')->nullable();
            $table->string('linkedin')->nullable();
            $table->text('bio')->nullable();
            $table->string('resume')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mentor_registrations');
    }
};