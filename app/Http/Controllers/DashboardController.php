<?php

namespace App\Http\Controllers;

use App\Models\JobPost;
use App\Models\Internship;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

use Illuminate\Support\Facades\Storage;
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

        $recentPostings = collect();

        if ($user->role === 'employer') {

            $jobs = JobPost::where('employer_id', $user->id)
                ->get()
                ->map(function ($job) {
                    $job->posting_type = 'job';
                    return $job;
                });

            $internships = Internship::where('employer_id', $user->id)
                ->get()
                ->map(function ($internship) {
                    $internship->posting_type = 'internship';
                    return $internship;
                });

            $projects = Project::where('employer_id', $user->id)
                ->get()
                ->map(function ($project) {
                    $project->posting_type = 'project';
                    return $project;
                });

            $allPostings = $jobs
                ->merge($internships)
                ->merge($projects)
                ->sortByDesc('created_at')
                ->values();

            $currentPage = LengthAwarePaginator::resolveCurrentPage();

            $perPage = 3;

            $recentPostings = new LengthAwarePaginator(
                $allPostings->slice(
                    ($currentPage - 1) * $perPage,
                    $perPage
                )->values(),
                $allPostings->count(),
                $perPage,
                $currentPage,
                [
                    'path' => request()->url(),
                    'query' => request()->query(),
                ]
            );
        }

        return view('dashboard-layouts.index', [
            'role' => $user->role,
            'stats' => $stats,
            'recentPostings' => $recentPostings,
        ]);
    }

    private function studentStats($user)
    {
        return ['message' => 'Welcome student!'];
    }

    private function employeeStats($user)
    {
        return ['message' => 'Welcome employee!'];
    }

    private function employerStats($user)
    {
        return ['message' => 'Welcome employer!'];
    }

    private function freelancerStats($user)
    {
        return ['message' => 'Welcome freelancer!'];
    }

    private function investorStats($user)
    {
        return ['message' => 'Welcome investor!'];
    }

    private function mentorStats($user)
    {
        return ['message' => 'Welcome mentor!'];
    }

    private function adminStats($user)
    {
        return ['message' => 'Welcome admin!'];
    }
    
}