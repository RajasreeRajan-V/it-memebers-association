<?php

namespace App\Http\Controllers\Mentor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MentorDashboardController extends Controller
{
    public function index()
    {
        if (Auth::user()->role !== 'mentor') {
            abort(403, 'Unauthorized');
        }

        return view('mentors.dashboard');
    }
}
