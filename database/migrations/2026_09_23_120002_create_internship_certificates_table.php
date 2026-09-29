<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('internship_certificates', function (Blueprint $table) {
            $table->id();

            $table->foreignId('internship_application_id')
                ->unique()
                ->constrained('internship_applications')
                ->cascadeOnDelete();

            $table->string('certificate_number')->unique();
            $table->date('issued_date');
            $table->string('verification_token')->unique();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('internship_certificates');
    }
};
