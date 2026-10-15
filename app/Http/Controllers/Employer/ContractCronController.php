<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ContractExpiryService;

class ContractCronController extends Controller
{
    public function __invoke(Request $request, ContractExpiryService $service)
    {
        $expected = (string) config('services.contract_cron_token');
        $given = (string) ($request->header('X-Cron-Token') ?? $request->query('token', ''));

        abort_if($expected === '' || !hash_equals($expected, $given), 403);

        return response()->json(['cancelled' => $service->cancelExpired()]);
    }
}
