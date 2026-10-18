<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('freelancer_bids', function (Blueprint $table) {
            $table->string('contract_document')
                ->nullable()
                ->after('comments');

            $table->timestamp('contract_sent_at')
                ->nullable()
                ->after('contract_document');

            $table->string('signed_contract_document')
                ->nullable()
                ->after('contract_sent_at');

            $table->timestamp('signed_contract_received_at')
                ->nullable()
                ->after('signed_contract_document');
        });
    }

    public function down(): void
    {
        Schema::table('freelancer_bids', function (Blueprint $table) {
            $table->dropColumn([
                'signed_contract_received_at',
                'signed_contract_document',
                'contract_sent_at',
                'contract_document',
            ]);
        });
    }
};