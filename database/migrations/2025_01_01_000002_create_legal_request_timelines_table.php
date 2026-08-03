<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('legal_request_timelines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('legal_request_id')->constrained()->cascadeOnDelete();

            $table->string('title'); // Request Submitted, Assigned to Lawyer, Admin Note, Documents Uploaded, Lawyer Note, Legal Advice, Resolved
            $table->text('description')->nullable();

            $table->enum('status', ['completed', 'in_progress', 'pending'])->default('pending');

            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->unsignedInteger('sort_order')->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('legal_request_timelines');
    }
};
