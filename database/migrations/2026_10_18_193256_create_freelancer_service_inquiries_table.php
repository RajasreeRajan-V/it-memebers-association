
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('freelancer_service_inquiries', function (Blueprint $table) {
            $table->id();

            $table->foreignId('service_id')
                ->constrained('freelancer_services')
                ->cascadeOnDelete();

            // Employer who sends the inquiry
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->text('message');

            $table->timestamps();

            $table->index(['service_id', 'user_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('freelancer_service_inquiries');
    }
};
