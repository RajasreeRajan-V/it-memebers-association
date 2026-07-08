<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentDashboardController extends Controller
{
    public function index()
    {
        if (Auth::user()->role !== 'student') {
            abort(403, 'Unauthorized');
        }

        return view('students.dashboard');
    }
}
