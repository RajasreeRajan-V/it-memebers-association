<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('legal_requests', function (Blueprint $table) {
            $table->dropForeign(['lawyer_id']);
            $table->dropColumn('lawyer_id');

            $table->foreignId('assigned_admin_id')
                ->nullable()
                ->after('employee_id')
                ->constrained('admins')
                ->nullOnDelete();
        });

        Schema::table('legal_request_timelines', function (Blueprint $table) {
            $table->dropForeign(['created_by']);
            $table->string('created_by_type')->default('employee')->after('legal_request_id');
        });

        Schema::table('legal_request_documents', function (Blueprint $table) {
            $table->dropForeign(['uploaded_by']);
            $table->string('uploaded_by_type')->default('employee')->after('legal_request_id');
        });

        Schema::table('legal_request_messages', function (Blueprint $table) {
            $table->dropForeign(['sender_id']);
            $table->string('sender_type')->default('employee')->after('legal_request_id');
        });
    }

    public function down(): void
    {
        Schema::table('legal_request_messages', function (Blueprint $table) {
            $table->dropColumn('sender_type');
            $table->foreign('sender_id')->references('id')->on('users')->cascadeOnDelete();
        });

        Schema::table('legal_request_documents', function (Blueprint $table) {
            $table->dropColumn('uploaded_by_type');
            $table->foreign('uploaded_by')->references('id')->on('users')->cascadeOnDelete();
        });

        Schema::table('legal_request_timelines', function (Blueprint $table) {
            $table->dropColumn('created_by_type');
            $table->foreign('created_by')->references('id')->on('users')->nullOnDelete();
        });

        Schema::table('legal_requests', function (Blueprint $table) {
            $table->dropForeign(['assigned_admin_id']);
            $table->dropColumn('assigned_admin_id');
            $table->foreignId('lawyer_id')->nullable()->after('employee_id')->constrained('users')->nullOnDelete();
        });
    }
};