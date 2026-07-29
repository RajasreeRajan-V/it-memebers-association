<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('job_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('job_post_id')->constrained()->onDelete('cascade');
            $table->string('status')->default('applied'); // applied, shortlisted, rejected, hired
            $table->timestamps();

            $table->unique(['user_id', 'job_post_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('job_applications');
    }
};