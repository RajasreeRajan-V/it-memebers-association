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
        Schema::create('investor_registrations', function (Blueprint $table) {
            $table->id();

            
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->string('organization');
            $table->string('investment_range');
            $table->string('preferred_sectors');
            $table->string('investment_stage');
            $table->string('linkedin')->nullable();
            $table->string('website')->nullable();
            $table->text('bio')->nullable();
            $table->string('verification_document')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('investor_registrations');
    }
};