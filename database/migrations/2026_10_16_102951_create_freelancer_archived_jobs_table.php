
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('freelancer_archived_jobs', function (Blueprint $table) {
            $table->id();

            $table->foreignId('freelancer_id')
                ->constrained('freelancer_registrations')
                ->cascadeOnDelete();

            $table->foreignId('project_id')
                ->constrained('projects')
                ->cascadeOnDelete();

            $table->timestamps();

            $table->unique(['freelancer_id', 'project_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('freelancer_archived_jobs');
    }
};
