<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('legal_requests', function (Blueprint $table) {
            $table->id();
            $table->string('request_number')->unique(); // e.g. LR-2025-095

            $table->foreignId('employee_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('lawyer_id')->nullable()->constrained('users')->nullOnDelete();

            $table->string('category'); // Salary Not Paid, PF & Benefits, Employment Issue, Contract Review...
            $table->string('issue_title');
            $table->text('description')->nullable();

            $table->enum('priority', ['low', 'medium', 'high'])->default('medium');

            $table->enum('status', [
                'submitted',
                'under_review',
                'assigned',
                'in_progress',
                'resolved',
                'closed',
            ])->default('submitted');

            $table->timestamp('resolved_at')->nullable();
            $table->timestamps();

            $table->index(['employee_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('legal_requests');
    }
};
