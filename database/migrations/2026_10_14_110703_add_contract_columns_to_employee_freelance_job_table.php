<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('employee_freelance_job', function (Blueprint $table) {
            $table->string('contract_path')->nullable()->after('status');
            $table->timestamp('contract_sent_at')->nullable()->after('contract_path');
        });
    }

    public function down(): void
    {
        Schema::table('employee_freelance_job', function (Blueprint $table) {
            $table->dropColumn(['contract_path', 'contract_sent_at']);
        });
    }
};