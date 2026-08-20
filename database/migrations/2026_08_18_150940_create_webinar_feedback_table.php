<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('webinar_feedback', function (Blueprint $table) {
            $table->id();
            $table->foreignId('webinar_id')->constrained()->cascadeOnDelete();
            $table->foreignId('student_id')->constrained('users')->cascadeOnDelete();
            $table->unsignedTinyInteger('rating'); // 1–5
            $table->text('review')->nullable();
            $table->timestamps();

            $table->unique(['webinar_id', 'student_id']); // one review per student per webinar
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('webinar_feedback');
    }
};