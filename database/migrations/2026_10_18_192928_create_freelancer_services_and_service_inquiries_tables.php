
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('freelancer_services', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->string('title', 90);
            $table->string('category');
            $table->text('description');
            $table->string('skills');
            $table->string('price');
            $table->unsignedSmallInteger('delivery_days');
            $table->string('portfolio_url')->nullable();
            $table->string('portfolio_image')->nullable();
            $table->string('revision_policy');

            $table->enum('status', ['active', 'inactive'])
                ->default('active')
                ->index();

            $table->timestamps();
        });

        Schema::create('service_inquiries', function (Blueprint $table) {
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
        Schema::dropIfExists('service_inquiries');
        Schema::dropIfExists('freelancer_services');
    }
};
