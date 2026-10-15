<?php

namespace App\Console\Commands;

use App\Services\ContractExpiryService;
use Illuminate\Console\Command;

class CancelExpiredContracts extends Command
{
    protected $signature = 'contracts:cancel-expired';

    protected $description = 'Cancel contracts not signed and returned within 7 days';

    public function handle(): int
    {
        $count = app(ContractExpiryService::class)->cancelExpired();

        $this->info("Cancelled {$count} expired contract(s).");

        return self::SUCCESS;
    }
}