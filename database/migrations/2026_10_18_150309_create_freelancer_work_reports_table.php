<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('freelancer_work_reports', function (Blueprint $table) {
            $table->id();

            $table->foreignId('freelancer_bid_id')
                ->constrained('freelancer_bids')
                ->cascadeOnDelete();

            $table->date('report_date');
            $table->string('title');
            $table->text('work_description');
            $table->unsignedTinyInteger('progress_percentage')->default(0);
            $table->text('challenges')->nullable();
            $table->text('next_steps')->nullable();
            $table->string('attachment_path')->nullable();

            $table->timestamps();

            // One report per project per reporting date.
            $table->unique(
                ['freelancer_bid_id', 'report_date'],
                'freelancer_work_reports_bid_date_unique'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('freelancer_work_reports');
    }
};