<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up(): void
    {
        Schema::table('employee_freelance_job', function (Blueprint $table) {
            $table->string('signed_contract_path')->nullable()->after('contract_sent_at');
            $table->timestamp('contract_signed_at')->nullable()->after('signed_contract_path');
            $table->timestamp('contract_cancelled_at')->nullable()->after('contract_signed_at');
            $table->string('contract_cancel_reason')->nullable()->after('contract_cancelled_at');
        });
    }

    public function down(): void
    {
        Schema::table('employee_freelance_job', function (Blueprint $table) {
            $table->dropColumn([
                'signed_contract_path',
                'contract_signed_at',
                'contract_cancelled_at',
                'contract_cancel_reason',
            ]);
        });
    }
};
