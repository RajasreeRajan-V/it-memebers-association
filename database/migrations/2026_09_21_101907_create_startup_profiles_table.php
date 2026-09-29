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
        Schema::create('startup_profiles', function (Blueprint $table) {

            // Primary Key
            $table->id();

            // Employer
            $table->foreignId('employer_id')
                ->constrained('users')
                ->cascadeOnDelete();

            // =====================================================
            // STARTUP INFORMATION
            // =====================================================

            $table->string('startup_name');

            $table->string('slug')->unique();

            $table->string('tagline')->nullable();

            $table->string('category')->nullable();

            $table->string('industry')->nullable();

            $table->string('startup_type')->nullable();

            $table->year('founded_year')->nullable();

            $table->string('startup_stage')->nullable();

            $table->unsignedInteger('team_size')->nullable();

            $table->string('location')->nullable();

            $table->string('website')->nullable();

            // =====================================================
            // BRANDING
            // =====================================================

            $table->string('logo')->nullable();

            $table->string('cover_image')->nullable();

            // =====================================================
            // DESCRIPTION
            // =====================================================

            $table->text('short_description')->nullable();

            $table->longText('about')->nullable();

            $table->longText('mission')->nullable();

            $table->longText('vision')->nullable();

            // =====================================================
            // PRODUCTS & TECHNOLOGIES
            // =====================================================

            $table->longText('products_services')->nullable();

            $table->longText('technologies')->nullable();

            // =====================================================
            // LOOKING FOR
            // Example:
            // ["employee", "investor", "mentor"]
            // =====================================================

            $table->longText('looking_for')->nullable();

            // =====================================================
            // OPPORTUNITIES
            // Example:
            // ["jobs", "internships", "investment"]
            // =====================================================

            $table->longText('opportunities')->nullable();

            // =====================================================
            // CONTACT
            // =====================================================

            $table->string('startup_email')->nullable();

            $table->string('startup_phone')->nullable();

            $table->string('linkedin')->nullable();

            // =====================================================
            // FUNDING
            // =====================================================

            $table->string('funding_stage')->nullable();

            $table->boolean('currently_raising')->default(false);

            $table->decimal('funding_requirement', 15, 2)->nullable();

            // =====================================================
            // ADMIN / SYSTEM
            // =====================================================

            $table->string('status')->default('draft');

            $table->text('rejection_reason')->nullable();

            // =====================================================
            // TIMESTAMPS
            // =====================================================

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('startup_profiles');
    }
};