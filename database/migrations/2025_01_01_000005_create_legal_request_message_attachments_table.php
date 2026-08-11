<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('legal_request_message_attachments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('legal_request_message_id');

            $table->foreign('legal_request_message_id', 'lrma_message_id_fk')
                ->references('id')->on('legal_request_messages')
                ->cascadeOnDelete();

            $table->string('file_name');
            $table->string('file_path');
            $table->string('file_type')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('legal_request_message_attachments');
    }
};