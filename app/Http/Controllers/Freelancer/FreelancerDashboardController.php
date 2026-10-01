<?php

namespace App\Http\Controllers\Freelancer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Project;
use App\Models\FreelancerBid;
use Illuminate\Support\Facades\DB;
use App\Services\ProfileService;
use App\Models\FreelancerSavedJob;

class FreelancerDashboardController extends Controller
{
    public function index()
    {
        if (Auth::user()->role !== 'freelancer') {
            abort(403, 'Unauthorized');
        }

        return view('freelancers.dashboard');
    }

    function about()
    {
        if (Auth::user()->role !== 'freelancer') {
            abort(403, 'Unauthorized');
        }

        return view('freelancer.about');
    }

    public function job(Request $request)
    {
        if (Auth::user()->role !== 'freelancer') {
            abort(403, 'Unauthorized');
        }

        $projects = Project::query()
            ->with('employer.employerRegistration')

            // Only show projects intended for freelancers
            ->where('visibility', 'freelancer')

            // Only show approved projects
            ->where('status', 'approved')

            ->withCount('applications')

            // Search
            ->when($request->filled('q'), function ($query) use ($request) {
                $query->where(function ($q) use ($request) {
                    $q->where('title', 'like', '%' . $request->q . '%')
                        ->orWhere('description', 'like', '%' . $request->q . '%')
                        ->orWhere('skills', 'like', '%' . $request->q . '%');
                });
            })

            // Location
            ->when($request->filled('location'), function ($query) use ($request) {
                $query->where(function ($q) use ($request) {
                    $q->where('city', 'like', '%' . $request->location . '%')
                        ->orWhere('district', 'like', '%' . $request->location . '%')
                        ->orWhere('state', 'like', '%' . $request->location . '%')
                        ->orWhere('country', 'like', '%' . $request->location . '%');
                });
            })

            // Project Type
            ->when($request->filled('project_type'), function ($query) use ($request) {
                $query->where('project_type', $request->project_type);
            })

            // Work Mode
            ->when($request->filled('work_mode'), function ($query) use ($request) {
                $query->where('work_mode', $request->work_mode);
            })

            // Minimum Budget
            ->when($request->filled('min_budget'), function ($query) use ($request) {
                $query->whereRaw("
                CAST(
                    REGEXP_REPLACE(
                        SUBSTRING_INDEX(REPLACE(budget,'₹',''), '-', 1),
                        '[^0-9]',
                        ''
                    ) AS UNSIGNED
                ) >= ?
            ", [$request->min_budget]);
            })

            // Maximum Budget
            ->when($request->filled('max_budget'), function ($query) use ($request) {
                $query->whereRaw("
                CAST(
                    REGEXP_REPLACE(
                        SUBSTRING_INDEX(REPLACE(budget,'₹',''), '-', -1),
                        '[^0-9]',
                        ''
                    ) AS UNSIGNED
                ) <= ?
            ", [$request->max_budget]);
            })

            // Duration
            ->when($request->filled('duration'), function ($query) use ($request) {

                $durationInDaysSql = "
                CAST(REGEXP_REPLACE(duration, '[^0-9]', '') AS UNSIGNED) *
                CASE
                    WHEN duration REGEXP 'year' THEN 365
                    WHEN duration REGEXP 'month' THEN 30
                    WHEN duration REGEXP 'week' THEN 7
                    ELSE 1
                END
            ";

                switch ($request->duration) {
                    case 'less_than_1_week':
                        $query->whereRaw("$durationInDaysSql <= 7");
                        break;

                    case '1_4_weeks':
                        $query->whereRaw("$durationInDaysSql BETWEEN 8 AND 28");
                        break;

                    case '1_3_months':
                        $query->whereRaw("$durationInDaysSql BETWEEN 29 AND 90");
                        break;

                    case '3_6_months':
                        $query->whereRaw("$durationInDaysSql BETWEEN 91 AND 180");
                        break;

                    case 'more_than_6_months':
                        $query->whereRaw("$durationInDaysSql > 180");
                        break;
                }
            })

            // Sorting
            ->when($request->sort, function ($query) use ($request) {

                switch ($request->sort) {
                    case 'oldest':
                        $query->oldest();
                        break;

                    case 'budget_high':
                        $query->orderByDesc('budget');
                        break;

                    case 'budget_low':
                        $query->orderBy('budget');
                        break;

                    default:
                        $query->latest();
                        break;
                }

            }, function ($query) {
                $query->latest();
            })

            ->paginate(20)
            ->withQueryString();

        $freelancer = Auth::user()->freelancerProfile;

        $existingBids = collect();
        $biddedProjectIds = [];

        if ($freelancer) {
            $existingBids = FreelancerBid::where('freelancer_id', $freelancer->id)
                ->get()
                ->keyBy('project_id');

            $biddedProjectIds = $existingBids->keys()->toArray();
        }

        $savedProjectIds = FreelancerSavedJob::where('user_id', Auth::id())
            ->pluck('project_id')
            ->toArray();

        return view('freelancer.job.index', compact(
            'projects',
            'freelancer',
            'existingBids',
            'biddedProjectIds',
            'savedProjectIds'
        ));
    }
    public function uploadResume(Request $request)
    {
        $request->validate([
            'resume' => 'required|mimes:pdf,doc,docx|max:2048',
        ]);

        $user = Auth::user();

        $path = $request->file('resume')->store('resumes', 'public');

        $user->freelancerProfile()->update([
            'resume' => $path,
        ]);

        return back()->with('success', 'Resume uploaded successfully.');
    }
}
