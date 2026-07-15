<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('internships', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employer_id')->constrained('users')->onDelete('cascade');
            $table->string('title');
            $table->enum('internship_type', ['paid', 'unpaid', 'stipend']);
            $table->enum('work_mode', ['onsite', 'hybrid', 'remote']);
            $table->string('duration');
            $table->string('stipend')->nullable();
            $table->string('qualification')->nullable();
            $table->json('skills')->nullable();
            $table->string('country')->nullable();
            $table->string('state');
            $table->string('district');
            $table->string('city');
            $table->text('description');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->integer('positions')->default(1);
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('internships');
    }
};