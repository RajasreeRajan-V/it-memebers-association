<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeDashboardController extends Controller
{
    public function index()
    {
        if (Auth::user()->role !== 'employee') {
            abort(403, 'Unauthorized');
        }

        return view('employees.dashboard');
    }
}
