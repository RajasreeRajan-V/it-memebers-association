<?php

namespace App\Http\Middleware;

use App\Services\ContractExpiryService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SweepExpiredContracts
{
    public function handle(Request $request, Closure $next)
    {
        return $next($request);
    }

    /**
     * Runs after the response has been sent, so the visitor doesn't wait.
     */
    public function terminate(Request $request, $response): void
    {
        // Only one sweep every 10 minutes, across all visitors.
        if (!Cache::add('contracts:sweep-lock', 1, now()->addMinutes(10))) {
            return;
        }

        try {
            app(ContractExpiryService::class)->cancelExpired();
        } catch (\Throwable $e) {
            report($e);
        }
    }
}