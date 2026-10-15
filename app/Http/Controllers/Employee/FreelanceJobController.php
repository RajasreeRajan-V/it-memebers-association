<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\EmployeeRegistration;
use App\Models\EmployeeFreelanceJob;
use App\Models\EmployeeFreelanceSavedJob;
use App\Models\EmployeeFreelanceArchivedJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class FreelanceJobController extends Controller
{
    /**
     * Display all employee jobs.
     */
    public function index(Request $request)
    {
        return $this->renderJobs($request, 'all');
    }

    /**
     * Display saved employee jobs.
     */

    /**
     * Display jobs applied for by the logged-in employee.
     */
    public function applied(Request $request)
    {
        return $this->renderJobs($request, 'applied');
    }

    public function hired(Request $request)
    {
        return $this->renderJobs($request, 'hired');
    }

    public function saved(Request $request)
    {
        $user = Auth::user();

        abort_unless($user, 403, 'Unauthorized');

        // Get IDs of jobs saved by the logged-in user.
        $savedProjectIds = DB::table('employee_freelance_saved_jobs')
            ->where('user_id', $user->id)
            ->pluck('project_id')
            ->map(fn($id) => (int) $id)
            ->all();

        // Get archived job IDs.
        $archivedProjectIds = DB::table('employee_freelance_archived_jobs')
            ->where('user_id', $user->id)
            ->pluck('project_id')
            ->map(fn($id) => (int) $id)
            ->all();

        // Find the employee registration.
        $employee = DB::table('employee_registrations')
            ->where('user_id', $user->id)
            ->first();

        $employeeId = $employee->id ?? null;

        // Get already-applied project IDs.
        $appliedProjectIds = $employeeId
            ? DB::table('employee_freelance_job')
                ->where('employee_id', $employeeId)
                ->pluck('project_id')
                ->map(fn($id) => (int) $id)
                ->all()
            : [];

        // Load only saved jobs that are visible to employees and are active.
        $projects = Project::with([
            'employer.employerRegistration',
        ])
            ->withCount([
                'applications',
                'freelancerBids',
            ])
            ->whereRaw('LOWER(TRIM(visibility)) = ?', ['employee'])
            ->whereIn('id', $savedProjectIds)
            ->whereNotIn('id', $archivedProjectIds)
            ->whereRaw(
                'LOWER(TRIM(status)) IN (?, ?)',
                ['approved', 'active']
            )
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('employees.freelance-jobs.index', [
            'projects' => $projects,
            'savedProjectIds' => $savedProjectIds,
            'archivedProjectIds' => $archivedProjectIds,
            'appliedProjectIds' => $appliedProjectIds,
            'employee' => $employee ?? $user,
            'view' => 'saved',
            'jobsRoute' => route('employee.freelance-jobs.saved'),
        ]);
    }

    /**
     * Display archived employee jobs.
     */
    public function archived(Request $request)
    {
        return $this->renderJobs($request, 'archived');
    }
    /**
     * Display proposals submitted by the logged-in employee.
     */
    public function proposals(Request $request)
    {
        return $this->renderJobs($request, 'proposals');
    }
    public function inProgress(Request $request)
    {
        return $this->renderJobs($request, 'in-progress');
    }
    /**
     * Render jobs for All / Saved / Archived pages.
     */

    private function renderJobs(Request $request, string $view)
    {
        $user = Auth::user();

        if (!$user) {
            abort(403, 'Unauthorized');
        }

        /*
        |--------------------------------------------------------------------------
        | Employee Profile
        |--------------------------------------------------------------------------
        */

        $employee = EmployeeRegistration::where(
            'user_id',
            $user->id
        )->first();

        /*
        |--------------------------------------------------------------------------
        | Saved Project IDs
        |--------------------------------------------------------------------------
        */

        $savedProjectIds = EmployeeFreelanceSavedJob::where(
            'user_id',
            $user->id
        )
            ->pluck('project_id')
            ->map(fn($id) => (int) $id)
            ->toArray();

        /*
        |--------------------------------------------------------------------------
        | Archived Project IDs
        |--------------------------------------------------------------------------
        */

        $archivedProjectIds = EmployeeFreelanceArchivedJob::where(
            'user_id',
            $user->id
        )
            ->pluck('project_id')
            ->map(fn($id) => (int) $id)
            ->toArray();

        /*
        |--------------------------------------------------------------------------
        | Already Applied Project IDs
        |--------------------------------------------------------------------------
        */

        // Load applications submitted by this employee.
        $applicationsByProjectId = collect();
        $appliedProjectIds = [];
        $inProgressProjectIds = [];

        if ($employee) {
            $employeeApplications = EmployeeFreelanceJob::where(
                'employee_id',
                $employee->id
            )
                ->orderByDesc('created_at')
                ->get()
                ->unique('project_id');

            $applicationsByProjectId = $employeeApplications->keyBy(
                fn($application) => (int) $application->project_id
            );

            $appliedProjectIds = $employeeApplications
                ->pluck('project_id')
                ->map(fn($id) => (int) $id)
                ->values()
                ->toArray();


            $inProgressApplications = $employeeApplications->filter(
                function ($application) {
                    $status = strtolower(trim(
                        (string) ($application->status ?? '')
                    ));

                    $status = str_replace([' ', '-'], '_', $status);

                    return in_array($status, [
                        'accepted',
                        'approved',
                        'hired',
                        'in_progress',
                        'inprogress',
                        'ongoing',
                        'started',
                    ], true);
                }
            );


            $inProgressProjectIds = $inProgressApplications
                ->pluck('project_id')
                ->map(fn($id) => (int) $id)
                ->values()
                ->toArray();

            if ($view === 'in-progress') {
                $applicationsByProjectId = $inProgressApplications->keyBy(
                    fn($application) => (int) $application->project_id
                );
            }
        }

        $hiredApplications = $employeeApplications->filter(function ($application) {
            $status = str_replace([' ', '-'], '_', strtolower(trim((string) ($application->status ?? ''))));

            return !empty($application->contract_path)
                || in_array($status, ['hired', 'accepted', 'approved'], true);
        });

        $hiredProjectIds = $hiredApplications
            ->pluck('project_id')
            ->map(fn($id) => (int) $id)
            ->values()
            ->toArray();

        if ($view === 'hired') {
            $applicationsByProjectId = $hiredApplications->keyBy(
                fn($application) => (int) $application->project_id
            );
        }
        /*
        |--------------------------------------------------------------------------
        | Base Projects Query
        |--------------------------------------------------------------------------
        */

        $query = Project::query()
            ->with(['employer.employerRegistration'])
            ->withCount(['applications', 'freelancerBids']);

        if (!in_array($view, ['applied', 'in-progress'], true)) {
            $query->whereRaw(
                'LOWER(TRIM(visibility)) = ?',
                ['employee']
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Page Scope
        |--------------------------------------------------------------------------
        */



        if ($view === 'saved') {

            if (empty($savedProjectIds)) {
                $query->whereRaw('1 = 0');
            } else {
                $query->whereIn('id', $savedProjectIds);
            }

            $query->whereIn('status', ['approved', 'active']);

        } elseif ($view === 'applied') {

            // Display only projects applied for by this employee.
            // Do not filter by project status: older or closed jobs
            // should remain visible in the application history.
            if (empty($appliedProjectIds)) {
                $query->whereRaw('1 = 0');
            } else {
                $query->whereIn('id', $appliedProjectIds);
            }

        } elseif ($view === 'in-progress') {

            if (empty($inProgressProjectIds)) {
                $query->whereRaw('1 = 0');
            } else {
                $query->whereIn('id', $inProgressProjectIds);
            }
        } elseif ($view === 'archived') {

            if (empty($archivedProjectIds)) {
                $query->whereRaw('1 = 0');
            } else {
                $query->whereIn('id', $archivedProjectIds);
            }
        

        } elseif ($view === 'hired') {

            if (empty($hiredProjectIds)) {
                $query->whereRaw('1 = 0');
            } else {
                $query->whereIn('id', $hiredProjectIds);
            }

        } elseif ($view === 'proposals') {

            // Show only projects for which this employee submitted a proposal.
            if (empty($appliedProjectIds)) {
                $query->whereRaw('1 = 0');
            } else {
                $query->whereIn('id', $appliedProjectIds);
            }

        } else {

            // All available employee jobs.
            $query->whereIn('status', ['active', 'approved']);

            if (!empty($archivedProjectIds)) {
                $query->whereNotIn('id', $archivedProjectIds);
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Search
        |--------------------------------------------------------------------------
        */

        $query->when(
            $request->filled('q'),
            function ($q) use ($request) {

                $search = trim($request->q);

                $q->where(function ($query) use ($search) {

                    $query->where(
                        'title',
                        'like',
                        "%{$search}%"
                    )
                        ->orWhere(
                            'description',
                            'like',
                            "%{$search}%"
                        )
                        ->orWhere(
                            'category',
                            'like',
                            "%{$search}%"
                        )
                        ->orWhere(
                            'skills',
                            'like',
                            "%{$search}%"
                        )

                        ->orWhereHas(
                            'employer',
                            function ($employerQuery) use ($search) {

                                $employerQuery->where(
                                    'name',
                                    'like',
                                    "%{$search}%"
                                );
                            }
                        )

                        ->orWhereHas(
                            'employer.employerRegistration',
                            function ($registrationQuery) use ($search) {

                                $registrationQuery->where(
                                    'company_name',
                                    'like',
                                    "%{$search}%"
                                );
                            }
                        );
                });
            }
        );

        /*
        |--------------------------------------------------------------------------
        | Location
        |--------------------------------------------------------------------------
        */

        $query->when(
            $request->filled('location'),
            function ($q) use ($request) {

                $location = trim($request->location);

                $q->where(function ($query) use ($location) {

                    $query->where(
                        'city',
                        'like',
                        "%{$location}%"
                    )
                        ->orWhere(
                            'state',
                            'like',
                            "%{$location}%"
                        )
                        ->orWhere(
                            'country',
                            'like',
                            "%{$location}%"
                        )
                        ->orWhere(
                            'district',
                            'like',
                            "%{$location}%"
                        );
                });
            }
        );

        /*
        |--------------------------------------------------------------------------
        | Project Type
        |--------------------------------------------------------------------------
        */

        $query->when(
            $request->filled('project_type'),
            function ($q) use ($request) {

                $q->where(
                    'project_type',
                    $request->project_type
                );
            }
        );

        /*
        |--------------------------------------------------------------------------
        | Work Mode
        |--------------------------------------------------------------------------
        */

        $query->when(
            $request->filled('work_mode'),
            function ($q) use ($request) {

                $q->where(
                    'work_mode',
                    $request->work_mode
                );
            }
        );

        /*
        |--------------------------------------------------------------------------
        | Budget Parsing
        |--------------------------------------------------------------------------
        |
        | Supports values such as:
        |
        | ₹50,000
        | ₹50,000 - ₹1,00,000
        | ₹50000–₹100000
        | 50000 - 100000
        |
        */

        $budgetFirst = "CAST(
            REPLACE(
                REGEXP_SUBSTR(
                    COALESCE(budget, ''),
                    '[0-9][0-9,.]*',
                    1,
                    1
                ),
                ',',
                ''
            )
            AS DECIMAL(15,2)
        )";

        $budgetSecond = "CAST(
            REPLACE(
                REGEXP_SUBSTR(
                    COALESCE(budget, ''),
                    '[0-9][0-9,.]*',
                    1,
                    2
                ),
                ',',
                ''
            )
            AS DECIMAL(15,2)
        )";

        $budgetLow = $budgetFirst;

        $budgetHigh = "COALESCE(
            {$budgetSecond},
            {$budgetFirst}
        )";

        /*
        |--------------------------------------------------------------------------
        | Minimum Budget
        |--------------------------------------------------------------------------
        |
        | Example:
        | Min = 75000
        |
        | ₹50,000 - ₹1,00,000 => matches
        |
        */

        $query->when(
            $request->filled('min_budget'),
            function ($q) use ($request, $budgetHigh) {

                $q->whereRaw(
                    "{$budgetHigh} >= ?",
                    [
                        (float) $request->min_budget
                    ]
                );
            }
        );

        /*
        |--------------------------------------------------------------------------
        | Maximum Budget
        |--------------------------------------------------------------------------
        |
        | Example:
        | Max = 75000
        |
        | ₹50,000 - ₹1,00,000 => matches
        |
        */

        $query->when(
            $request->filled('max_budget'),
            function ($q) use ($request, $budgetLow) {

                $q->whereRaw(
                    "{$budgetLow} <= ?",
                    [
                        (float) $request->max_budget
                    ]
                );
            }
        );

        /*
        |--------------------------------------------------------------------------
        | Duration
        |--------------------------------------------------------------------------
        */

        $query->when(
            $request->filled('duration'),
            function ($q) use ($request) {

                switch ($request->duration) {

                    /*
                    |--------------------------------------------------------------------------
                    | Less Than 1 Week
                    |--------------------------------------------------------------------------
                    */

                    case 'less_than_1_week':

                        $q->whereRaw(
                            "LOWER(COALESCE(duration, '')) REGEXP ?",
                            [
                                '(^|[^0-9])([1-6])[[:space:]]*days?'
                            ]
                        );

                        break;

                    /*
                    |--------------------------------------------------------------------------
                    | 1 - 4 Weeks
                    |--------------------------------------------------------------------------
                    */

                    case '1_4_weeks':

                        $q->whereRaw(
                            "LOWER(COALESCE(duration, '')) REGEXP ?",
                            [
                                '(^|[^0-9])([1-4])[[:space:]]*weeks?'
                            ]
                        );

                        break;

                    /*
                    |--------------------------------------------------------------------------
                    | 1 - 3 Months
                    |--------------------------------------------------------------------------
                    */

                    case '1_3_months':

                        $q->whereRaw(
                            "LOWER(COALESCE(duration, '')) REGEXP ?",
                            [
                                '(^|[^0-9])([1-3])[[:space:]]*months?'
                            ]
                        );

                        break;

                    /*
                    |--------------------------------------------------------------------------
                    | 3 - 6 Months
                    |--------------------------------------------------------------------------
                    */

                    case '3_6_months':

                        $q->whereRaw(
                            "LOWER(COALESCE(duration, '')) REGEXP ?",
                            [
                                '(^|[^0-9])([3-6])[[:space:]]*months?'
                            ]
                        );

                        break;

                    /*
                    |--------------------------------------------------------------------------
                    | More Than 6 Months
                    |--------------------------------------------------------------------------
                    */

                    case 'more_than_6_months':

                        $q->whereRaw(
                            "LOWER(COALESCE(duration, '')) REGEXP ?",
                            [
                                '(^|[^0-9])([7-9]|[1-9][0-9]+)[[:space:]]*months?'
                                . '|(^|[^a-z0-9])year[s]?'
                            ]
                        );

                        break;
                }
            }
        );

        /*
        |--------------------------------------------------------------------------
        | Sorting
        |--------------------------------------------------------------------------
        */

        switch ($request->get('sort', 'newest')) {

            case 'oldest':

                $query->oldest(
                    'created_at'
                );

                break;

            case 'budget_high':

                $query->orderByRaw(
                    "{$budgetHigh} DESC"
                );

                break;

            case 'budget_low':

                $query->orderByRaw(
                    "{$budgetLow} ASC"
                );

                break;

            default:

                $query->latest(
                    'created_at'
                );

                break;
        }

        /*
        |--------------------------------------------------------------------------
        | Pagination
        |--------------------------------------------------------------------------
        */

        $projects = $query
            ->paginate(10)
            ->withQueryString();

        /*
        |--------------------------------------------------------------------------
        | Page Title
        |--------------------------------------------------------------------------
        */

        $pageTitle = match ($view) {
            'applied' => 'Applied Jobs',
            'saved' => 'Saved Jobs',
            'archived' => 'Archived Jobs',
            'in-progress' => 'In Progress',
            'proposals' => 'My Proposals',
            'hired' => 'Hired',
            default => 'JOBS FOR YOU',
        };

        /*
        |--------------------------------------------------------------------------
        | Page Description
        |--------------------------------------------------------------------------
        */

        $pageDescription = match ($view) {

            'applied' => 'View your submitted applications and their current status.',

            'saved' =>
                'Jobs you have saved to review or apply later.',

            'archived' =>
                'Jobs you have archived for future reference.',

            'in-progress' => 'View projects that are currently in progress.',

            'hired' => 'Projects where you have been hired, along with your contracts.',

            default =>
                'Explore opportunities from vetted employers and take the next step in your career.',
        };

        /*
        |--------------------------------------------------------------------------
        | Current Page Route
        |--------------------------------------------------------------------------
        |
        | The search/filter form will stay on the current page.
        |
        */

        $jobsRoute = match ($view) {
            'applied' => route('employee.freelance-job.applied'),
            'saved' => route('employee.freelance-jobs.saved'),
            'archived' => route('employee.freelance-jobs.archived'),
            'in-progress' => route('employee.freelance-job.in-progress'),
            'proposals' => route('employee.freelance-job.proposals'),
            'hired' => route('employee.freelance-job.hired'),
            default => route('employee.freelance-jobs.index'),
        };

        /*
        |--------------------------------------------------------------------------
        | Return View
        |--------------------------------------------------------------------------
        */

        return view(
            'employees.freelance-jobs.index',
            compact(
                'projects',
                'employee',
                'appliedProjectIds',
                'applicationsByProjectId',
                'savedProjectIds',
                'archivedProjectIds',
                'pageTitle',
                'pageDescription',
                'jobsRoute',
                'view'
            )
        );
    }

    /**
     * Save / Unsave a job.
     */
    public function toggleSaved(Project $project)
    {
        $user = Auth::user();

        if (!$user) {
            abort(403, 'Unauthorized');
        }

        abort_unless(
            $project->visibility === 'employee',
            404
        );

        $saved = EmployeeFreelanceSavedJob::where(
            'user_id',
            $user->id
        )
            ->where(
                'project_id',
                $project->id
            )
            ->first();

        if ($saved) {

            $saved->delete();

            return back()->with(
                'success',
                'Job removed from saved jobs.'
            );
        }

        EmployeeFreelanceSavedJob::create([
            'user_id' => $user->id,
            'project_id' => $project->id,
        ]);

        return back()->with(
            'success',
            'Job added to saved jobs.'
        );
    }

    /**
     * Archive a job.
     */
    public function archive(Project $project)
    {
        $user = Auth::user();

        if (!$user) {
            abort(403, 'Unauthorized');
        }

        abort_unless(
            $project->visibility === 'employee',
            404
        );

        EmployeeFreelanceArchivedJob::firstOrCreate([
            'user_id' => $user->id,
            'project_id' => $project->id,
        ]);

        return back()->with(
            'success',
            'Job archived successfully.'
        );
    }

    /**
     * Restore an archived job.
     */
    public function unarchive(Project $project)
    {
        $user = Auth::user();

        if (!$user) {
            abort(403, 'Unauthorized');
        }

        EmployeeFreelanceArchivedJob::where(
            'user_id',
            $user->id
        )
            ->where(
                'project_id',
                $project->id
            )
            ->delete();

        return back()->with(
            'success',
            'Job restored successfully.'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Resource Methods
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
 public function myJobs(Request $request)
{
    $user = auth()->user();
    abort_unless($user, 403);

    $employee = EmployeeRegistration::where('user_id', $user->id)->first();
    $employeeId = $employee?->id;

    // Status groups (normalised), so "contract sent" jobs count as hired
    $groups = [
        'pending'     => ['pending', 'applied', 'under_review', 'review'],
        'shortlisted' => ['shortlisted'],
        'hired'       => ['hired', 'accepted', 'approved', 'in_progress', 'ongoing', 'started'],
        'rejected'    => ['rejected', 'declined', 'not_selected'],
    ];

    $base = EmployeeFreelanceJob::where('employee_id', $employeeId ?? 0);

    $normalized = "REPLACE(REPLACE(LOWER(TRIM(COALESCE(status, ''))), ' ', '_'), '-', '_')";

    $applyGroup = function ($q, string $key) use ($groups, $normalized) {
        $in = $groups[$key];
        $placeholders = implode(',', array_fill(0, count($in), '?'));

        $q->where(function ($w) use ($key, $in, $placeholders, $normalized) {
            $w->whereRaw("{$normalized} IN ({$placeholders})", $in);

            if ($key === 'hired') {
                $w->orWhereNotNull('contract_path');
            }
        });

        // Don't count a contract-bearing row as pending/etc.
        if ($key !== 'hired') {
            $q->whereNull('contract_path');
        }
    };

    $counts = ['all' => (clone $base)->count()];
    foreach (array_keys($groups) as $key) {
        $counts[$key] = (clone $base)->tap(fn ($q) => $applyGroup($q, $key))->count();
    }

    $status = $request->get('status', 'all');

    $query = EmployeeFreelanceJob::with(['project.employer.employerRegistration'])
        ->where('employee_id', $employeeId ?? 0)
        ->whereHas('project'); // skip applications whose project was deleted

    if ($status !== 'all' && isset($groups[$status])) {
        $applyGroup($query, $status);
    }

    if ($search = trim((string) $request->get('q'))) {
        $query->whereHas('project', function ($p) use ($search) {
            $p->where('title', 'like', "%{$search}%")
              ->orWhereHas('employer', fn ($e) => $e->where('name', 'like', "%{$search}%"))
              ->orWhereHas('employer.employerRegistration',
                  fn ($r) => $r->where('company_name', 'like', "%{$search}%"));
        });
    }

    $request->get('sort') === 'oldest' ? $query->oldest() : $query->latest();

    $applications = $query->paginate(10)->withQueryString();

    return view('employees.freelance-jobs.my-job', compact('applications', 'counts'));
}
public function uploadSignedContract(Request $request, EmployeeFreelanceJob $application)
{
    $employee = EmployeeRegistration::where('user_id', auth()->id())->firstOrFail();

    // Only the owner of this application may upload, and only after a contract was sent
    abort_unless($application->employee_id === $employee->id, 403);
    abort_if(empty($application->contract_path), 403);

    $request->validate([
        'signed_contract' => ['required', 'file', 'mimes:pdf,doc,docx,jpg,jpeg,png', 'max:5120'],
    ]);

    if ($application->signed_contract_path) {
        Storage::disk('public')->delete($application->signed_contract_path);
    }

    $path = $request->file('signed_contract')->store('signed-contracts', 'public');

    $application->update([
        'signed_contract_path'        => $path,
        'signed_contract_uploaded_at' => now(),
    ]);

    return back()->with('success', 'Signed contract uploaded successfully.');
}
}