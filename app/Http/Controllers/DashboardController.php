<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
     public function index(Request $request)
    {
        $user = $request->user();

        // Fetch whatever data is relevant to this role
        $data = match ($user->role) {
            'student'    => ['stats' => $this->studentStats($user)],
            'employee'   => ['stats' => $this->employeeStats($user)],
            'employer'   => ['stats' => $this->employerStats($user)],
            'freelancer' => ['stats' => $this->freelancerStats($user)],
            'investor'   => ['stats' => $this->investorStats($user)],
            'mentor'     => ['stats' => $this->mentorStats($user)],
            'admin'      => ['stats' => $this->adminStats($user)],
            default      => ['stats' => []],
        };

        return view('dashboard', $data + ['role' => $user->role]);
    }

    private function studentStats($user)    { return []; /* your query */ }
    private function employeeStats($user)   { return []; }
    private function employerStats($user)   { return []; }
    private function freelancerStats($user) { return []; }
    private function investorStats($user)   { return []; }
    private function mentorStats($user)     { return []; }
    private function adminStats($user)      { return []; }
}
