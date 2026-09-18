<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\JobPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    /**
     * Display employer's jobs with search and filters.
     */
    public function index(Request $request)
    {
        $employerId = Auth::id();

        $jobs = JobPost::where('employer_id', $employerId)

            /*
            |--------------------------------------------------------------------------
            | Search Job Title
            |--------------------------------------------------------------------------
            */
            ->when($request->filled('search'), function ($query) use ($request) {

                $search = trim($request->search);

                $query->where('title', 'like', '%' . $search . '%');
            })

            /*
            |--------------------------------------------------------------------------
            | Location
            |--------------------------------------------------------------------------
            */
            ->when($request->filled('location'), function ($query) use ($request) {

                $location = trim($request->location);

                $query->where(function ($q) use ($location) {

                    $q->where('country', 'like', '%' . $location . '%')
                        ->orWhere('state', 'like', '%' . $location . '%')
                        ->orWhere('district', 'like', '%' . $location . '%')
                        ->orWhere('city', 'like', '%' . $location . '%');
                });
            })

            /*
            |--------------------------------------------------------------------------
            | Job Type
            |--------------------------------------------------------------------------
            */
            ->when($request->filled('employment_type'), function ($query) use ($request) {

                $query->where(
                    'employment_type',
                    $request->employment_type
                );
            })

            /*
            |--------------------------------------------------------------------------
            | Experience
            |--------------------------------------------------------------------------
            */
            ->when($request->filled('experience'), function ($query) use ($request) {

                $experience = $request->experience;

                if ($experience === 'fresher') {

                    $query->where(function ($q) {

                        $q->whereNull('experience')
                            ->orWhere('experience', '')
                            ->orWhere('experience', 'like', '%fresher%')
                            ->orWhere('experience', 'like', '%0 year%')
                            ->orWhere('experience', 'like', '%0-year%');
                    });

                } elseif ($experience === '0-1') {

                    $query->where(function ($q) {

                        $q->where('experience', 'like', '%0-1%')
                            ->orWhere('experience', 'like', '%0 to 1%')
                            ->orWhere('experience', 'like', '%0 - 1%')
                            ->orWhere('experience', 'like', '%0 year%');
                    });

                } elseif ($experience === '1-3') {

                    $query->where(function ($q) {

                        $q->where('experience', 'like', '%1-3%')
                            ->orWhere('experience', 'like', '%1 to 3%')
                            ->orWhere('experience', 'like', '%1 - 3%');
                    });

                } elseif ($experience === '3-5') {

                    $query->where(function ($q) {

                        $q->where('experience', 'like', '%3-5%')
                            ->orWhere('experience', 'like', '%3 to 5%')
                            ->orWhere('experience', 'like', '%3 - 5%');
                    });

                } elseif ($experience === '5+') {

                    $query->where(function ($q) {

                        $q->where('experience', 'like', '%5+%')
                            ->orWhere('experience', 'like', '%5 year%')
                            ->orWhere('experience', 'like', '%6 year%')
                            ->orWhere('experience', 'like', '%7 year%')
                            ->orWhere('experience', 'like', '%8 year%')
                            ->orWhere('experience', 'like', '%9 year%')
                            ->orWhere('experience', 'like', '%10 year%')
                            ->orWhere('experience', 'like', '%11 year%')
                            ->orWhere('experience', 'like', '%12 year%')
                            ->orWhere('experience', 'like', '%13 year%')
                            ->orWhere('experience', 'like', '%14 year%')
                            ->orWhere('experience', 'like', '%15 year%');
                    });
                }
            })

            /*
            |--------------------------------------------------------------------------
            | Status
            |--------------------------------------------------------------------------
            */
            ->when($request->filled('status'), function ($query) use ($request) {

                if ($request->status === 'active') {

                    $query->where('is_active', true)
                        ->where('status', '!=', 'closed');

                } elseif ($request->status === 'inactive') {

                    $query->where('is_active', false)
                        ->where('status', '!=', 'closed');

                } elseif ($request->status === 'closed') {

                    $query->where('status', 'closed');
                }
            })

            /*
            |--------------------------------------------------------------------------
            | Date Posted
            |--------------------------------------------------------------------------
            */
            ->when($request->filled('date_posted'), function ($query) use ($request) {

                switch ($request->date_posted) {

                    case 'today':

                        $query->whereDate(
                            'created_at',
                            now()->toDateString()
                        );

                        break;

                    case '7_days':

                        $query->where(
                            'created_at',
                            '>=',
                            now()->subDays(7)
                        );

                        break;

                    case '30_days':

                        $query->where(
                            'created_at',
                            '>=',
                            now()->subDays(30)
                        );

                        break;

                    case '90_days':

                        $query->where(
                            'created_at',
                            '>=',
                            now()->subDays(90)
                        );

                        break;
                }
            })

            /*
            |--------------------------------------------------------------------------
            | Latest Jobs First
            |--------------------------------------------------------------------------
            */
            ->latest()

            /*
            |--------------------------------------------------------------------------
            | Pagination
            |--------------------------------------------------------------------------
            */
            ->paginate(2)

            ->withQueryString();

        return view(
            'employers.jobs.index',
            compact('jobs')
        );
    }


    /**
     * Show create job page.
     */
    public function create()
    {
        return view('employers.jobs.create');
    }


    /**
     * Store a new job.
     */
    public function store(Request $request)
    {
        $data = $this->validateJob($request);

        $data['employer_id'] = Auth::id();
        $data['is_active'] = true;

        JobPost::create($data);

        return redirect()
            ->route('employer.jobs.index')
            ->with('success', 'Job posted successfully.');
    }


    /**
     * Display a single job.
     */
    public function show(JobPost $job)
    {
        $this->authorizeOwner($job);

        return view(
            'employers.jobs.show',
            compact('job')
        );
    }


    /**
     * Show edit job page.
     */
    public function edit(JobPost $job)
    {
        $this->authorizeOwner($job);

        return view(
            'employers.jobs.edit',
            compact('job')
        );
    }


    /**
     * Update an existing job.
     */
    public function update(Request $request, JobPost $job)
    {
        $this->authorizeOwner($job);

        $data = $this->validateJob($request);

        $job->update($data);

        return redirect()
            ->route('employer.jobs.index')
            ->with('success', 'Job updated successfully.');
    }


    /**
     * Duplicate an existing job.
     */
    public function duplicate(JobPost $job)
    {
        $this->authorizeOwner($job);

        $duplicate = $job->replicate();

        $duplicate->employer_id = Auth::id();

        $duplicate->title = $job->title . ' - Copy';

        if ($duplicate->isFillable('status')) {
            $duplicate->status = 'pending';
        }

        if ($duplicate->isFillable('rejection_reason')) {
            $duplicate->rejection_reason = null;
        }

        $duplicate->is_active = true;

        if ($duplicate->isFillable('expires_at')) {
            $duplicate->expires_at = $job->expires_at;
        }

        $duplicate->save();

        return redirect()
            ->route('employer.jobs.index')
            ->with('success', 'Job duplicated successfully.');
    }


    /**
     * Toggle active/inactive status.
     */
    public function toggleActive(JobPost $job)
    {
        $this->authorizeOwner($job);

        $job->update([
            'is_active' => ! $job->is_active,
        ]);

        return back()->with(
            'success',
            $job->is_active
                ? 'Job marked as active.'
                : 'Job marked as inactive.'
        );
    }


    /**
     * Close a job.
     */
    public function close(JobPost $job)
    {
        $this->authorizeOwner($job);

        $job->update([
            'is_active' => false,
            'status' => 'closed',
        ]);

        return redirect()
            ->route('employer.jobs.index')
            ->with('success', 'Job closed successfully.');
    }


    /**
     * Reopen a closed job.
     */
    public function reopen(JobPost $job)
    {
        $this->authorizeOwner($job);

        $job->update([
            'is_active' => true,
            'status' => 'pending',
        ]);

        return redirect()
            ->route('employer.jobs.index')
            ->with('success', 'Job reopened successfully.');
    }


    /**
     * Delete a job.
     */
    public function destroy(JobPost $job)
    {
        $this->authorizeOwner($job);

        $job->delete();

        return redirect()
            ->route('employer.jobs.index')
            ->with('success', 'Job deleted successfully.');
    }


    /**
     * Validate job data.
     */
    private function validateJob(Request $request): array
    {
        $isRemote = $request->work_mode === 'remote';

        return $request->validate([

            'title' => [
                'required',
                'string',
                'max:255',
                'regex:/^[A-Za-z0-9\s\-&().,]+$/',
            ],

            'employment_type' => [
                'required',
                'in:full-time,part-time,contract,freelance',
            ],

            'work_mode' => [
                'required',
                'in:onsite,hybrid,remote',
            ],

            'experience' => [
                'nullable',
                'string',
                'max:100',
                'regex:/^[A-Za-z0-9\s-]+$/',
            ],

            'salary' => [
                'nullable',
                'string',
                'max:100',
                'regex:/^[0-9₹$,.\/\-\s]+$/',
            ],

            'qualification' => [
                'nullable',
                'string',
                'max:255',
                'regex:/^[A-Za-z0-9\s,.\-()&]+$/',
            ],

            'skills' => [
                'nullable',
                'string',
                'max:500',
                'regex:/^[A-Za-z0-9\s,.\-+#\/&()]+$/',
            ],

            'country' => [
                'nullable',
                'string',
                'max:100',
                'regex:/^[A-Za-z\s]+$/',
            ],

            'state' => [
                $isRemote ? 'nullable' : 'required',
                'string',
                'max:100',
                'regex:/^[A-Za-z\s]+$/',
            ],

            'district' => [
                $isRemote ? 'nullable' : 'required',
                'string',
                'max:100',
                'regex:/^[A-Za-z\s]+$/',
            ],

            'city' => [
                $isRemote ? 'nullable' : 'required',
                'string',
                'max:100',
                'regex:/^[A-Za-z\s]+$/',
            ],

            'description' => [
                'required',
                'string',
                'max:5000',
            ],

        ], [

            'title.regex' =>
                'Title can only contain letters, numbers, and & ( ) . , -.',

            'experience.regex' =>
                'Experience can only contain letters, numbers, and -.',

            'salary.regex' =>
                'Salary can only contain numbers and ₹ $ , . - / (no letters).',

            'qualification.regex' =>
                'Qualification can only contain letters, numbers, and , . - ( ) &.',

            'skills.regex' =>
                'Skills can only contain letters, numbers, and , . - + # / & ( ).',

            'country.regex' =>
                'Country can only contain letters.',

            'state.required' =>
                'State is required for Hybrid and On-site jobs.',

            'state.regex' =>
                'State can only contain letters.',

            'district.required' =>
                'District is required for Hybrid and On-site jobs.',

            'district.regex' =>
                'District can only contain letters.',

            'city.required' =>
                'City is required for Hybrid and On-site jobs.',

            'city.regex' =>
                'City can only contain letters.',
        ]);
    }


    /**
     * Make sure the job belongs to the logged-in employer.
     */
    private function authorizeOwner(JobPost $job): void
    {
        abort_if(
            $job->employer_id !== Auth::id(),
            403,
            'You do not have access to this job.'
        );
    }
}