<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $stats = match ($user->role) {
            'student'    => $this->studentStats($user),
            'employee'   => $this->employeeStats($user),
            'employer'   => $this->employerStats($user),
            'freelancer' => $this->freelancerStats($user),
            'investor'   => $this->investorStats($user),
            'mentor'     => $this->mentorStats($user),
            'admin'      => $this->adminStats($user),
            default      => [],
        };

        return view('dashboard-layouts.index', [
            'role'  => $user->role,
            'stats' => $stats,
        ]);
    }

    private function studentStats($user)    { return ['message' => 'Welcome student!']; }
    private function employeeStats($user)   { return ['message' => 'Welcome employee!']; }
    private function employerStats($user)   { return ['message' => 'Welcome employer!']; }
    private function freelancerStats($user) { return ['message' => 'Welcome freelancer!']; }
    private function investorStats($user)   { return ['message' => 'Welcome investor!']; }
    private function mentorStats($user)     { return ['message' => 'Welcome mentor!']; }
    private function adminStats($user)      { return ['message' => 'Welcome admin!']; }
}