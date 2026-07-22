<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employer_id')->constrained('users')->cascadeOnDelete();
            $table->string('posting_type'); // job, internship, project
            $table->unsignedBigInteger('posting_id');
            $table->string('applicant_name');
            $table->string('applicant_email');
            $table->string('applicant_phone')->nullable();
            $table->string('resume_path')->nullable();
            $table->enum('status', ['applied', 'shortlisted', 'interview', 'hired', 'rejected'])->default('applied');
            $table->timestamps();

            $table->index(['posting_type', 'posting_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};