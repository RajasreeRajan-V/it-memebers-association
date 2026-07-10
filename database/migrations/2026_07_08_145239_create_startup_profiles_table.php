<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('startup_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employer_id')->unique()->constrained('users')->cascadeOnDelete();
            // unique() -> one startup profile per employer

            $table->string('startup_name');
            $table->string('logo_path')->nullable();
            $table->string('team_size')->nullable();

            $table->string('state')->nullable();
            $table->string('district')->nullable();
            $table->string('city')->nullable();

            $table->string('website')->nullable();
            $table->string('industry')->nullable();
            $table->string('founder_name');
            $table->string('funding_required')->nullable();
            $table->text('business_description');

            $table->string('contact_email');
            $table->string('phone_number');

            $table->string('pitch_summary_path')->nullable();

            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('rejection_reason')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('startup_profiles');
    }
};