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
        Schema::create('employer_registrations', function (Blueprint $table) {
            $table->id();

            // Foreign key to users table
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->string('company_name');
            $table->string('gst_number')->nullable();
            $table->string('pan_number')->nullable();
            $table->text('company_address');
            $table->string('company_size')->nullable();
            $table->string('industry')->nullable();
            $table->string('website')->nullable();
            $table->string('company_logo')->nullable();
            $table->string('company_documents')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employer_registrations');
    }
};