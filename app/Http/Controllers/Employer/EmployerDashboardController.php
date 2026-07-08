<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class EmployerDashboardController extends Controller
{
   public function index()
    {
        if (Auth::user()->role !== 'employer') {
            abort(403, 'Unauthorized');
        }

        return view('employers.dashboard');
    }
}
