<?php

namespace App\Http\Controllers\Investor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvestorDashboardController extends Controller
{
     public function index()
    {
        if (Auth::user()->role !== 'investor') {
            abort(403, 'Unauthorized');
        }

        return view('investors.dashboard');
    }
}
