<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('webinar_resources', function (Blueprint $table) {
            $table->id();
            $table->foreignId('webinar_id')->constrained()->cascadeOnDelete();
            $table->string('type'); // recording | pdf | ppt | code | other
            $table->string('title');
            $table->string('url')->nullable();       // external link (e.g. recording link)
            $table->string('file_path')->nullable();  // uploaded file (storage disk path)
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('webinar_resources');
    }
};