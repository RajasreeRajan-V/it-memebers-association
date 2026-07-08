<?php

namespace App\Http\Controllers\Freelancer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FreelancerDashboardController extends Controller
{
    public function index()
    {
        if (Auth::user()->role !== 'freelancer') {
            abort(403, 'Unauthorized');
        }

        return view('freelancers.dashboard');
    }
}
