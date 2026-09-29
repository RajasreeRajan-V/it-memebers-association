<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\JobPost;
use App\Models\StartupProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    /**
     * =========================================================
     * JOB INDEX
     * =========================================================
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

                $query->where(
                    'title',
                    'like',
                    '%' . $search . '%'
                );
            })

            /*
            |--------------------------------------------------------------------------
            | Location
            |--------------------------------------------------------------------------
            */
            ->when($request->filled('location'), function ($query) use ($request) {

                $location = trim($request->location);

                $query->where(function ($q) use ($location) {

                    $q->where(
                        'country',
                        'like',
                        '%' . $location . '%'
                    )
                    ->orWhere(
                        'state',
                        'like',
                        '%' . $location . '%'
                    )
                    ->orWhere(
                        'district',
                        'like',
                        '%' . $location . '%'
                    )
                    ->orWhere(
                        'city',
                        'like',
                        '%' . $location . '%'
                    );
                });
            })

            /*
            |--------------------------------------------------------------------------
            | Employment Type
            |--------------------------------------------------------------------------
            */
            ->when($request->filled('employment_type'), function ($query) use ($request) {

                $employmentType = strtolower(
                    trim($request->employment_type)
                );

                $employmentType = str_replace(
                    '_',
                    '-',
                    $employmentType
                );

                $employmentType = match ($employmentType) {

                    'full time',
                    'fulltime',
                    'full-time' => 'full-time',

                    'part time',
                    'parttime',
                    'part-time' => 'part-time',

                    'contract' => 'contract',

                    'internship' => 'internship',

                    'freelance' => 'freelance',

                    default => $employmentType,
                };

                $query->where(
                    'employment_type',
                    $employmentType
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
                            ->orWhere(
                                'experience',
                                'like',
                                '%fresher%'
                            )
                            ->orWhere(
                                'experience',
                                'like',
                                '%0 year%'
                            )
                            ->orWhere(
                                'experience',
                                'like',
                                '%0-year%'
                            );
                    });

                } elseif ($experience === '0-1') {

                    $query->where(function ($q) {

                        $q->where(
                            'experience',
                            'like',
                            '%0-1%'
                        )
                        ->orWhere(
                            'experience',
                            'like',
                            '%0 to 1%'
                        )
                        ->orWhere(
                            'experience',
                            'like',
                            '%0 - 1%'
                        )
                        ->orWhere(
                            'experience',
                            'like',
                            '%0 year%'
                        );
                    });

                } elseif ($experience === '1-3') {

                    $query->where(function ($q) {

                        $q->where(
                            'experience',
                            'like',
                            '%1-3%'
                        )
                        ->orWhere(
                            'experience',
                            'like',
                            '%1 to 3%'
                        )
                        ->orWhere(
                            'experience',
                            'like',
                            '%1 - 3%'
                        );
                    });

                } elseif ($experience === '3-5') {

                    $query->where(function ($q) {

                        $q->where(
                            'experience',
                            'like',
                            '%3-5%'
                        )
                        ->orWhere(
                            'experience',
                            'like',
                            '%3 to 5%'
                        )
                        ->orWhere(
                            'experience',
                            'like',
                            '%3 - 5%'
                        );
                    });

                } elseif ($experience === '5+') {

                    $query->where(function ($q) {

                        $q->where(
                            'experience',
                            'like',
                            '%5+%'
                        )
                        ->orWhere(
                            'experience',
                            'like',
                            '%5 year%'
                        )
                        ->orWhere(
                            'experience',
                            'like',
                            '%6 year%'
                        )
                        ->orWhere(
                            'experience',
                            'like',
                            '%7 year%'
                        )
                        ->orWhere(
                            'experience',
                            'like',
                            '%8 year%'
                        )
                        ->orWhere(
                            'experience',
                            'like',
                            '%9 year%'
                        )
                        ->orWhere(
                            'experience',
                            'like',
                            '%10 year%'
                        )
                        ->orWhere(
                            'experience',
                            'like',
                            '%11 year%'
                        )
                        ->orWhere(
                            'experience',
                            'like',
                            '%12 year%'
                        )
                        ->orWhere(
                            'experience',
                            'like',
                            '%13 year%'
                        )
                        ->orWhere(
                            'experience',
                            'like',
                            '%14 year%'
                        )
                        ->orWhere(
                            'experience',
                            'like',
                            '%15 year%'
                        );
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

                    $query->where(
                        'is_active',
                        true
                    )
                    ->where(
                        'status',
                        '!=',
                        'closed'
                    );

                } elseif ($request->status === 'inactive') {

                    $query->where(
                        'is_active',
                        false
                    )
                    ->where(
                        'status',
                        '!=',
                        'closed'
                    );

                } elseif ($request->status === 'closed') {

                    $query->where(
                        'status',
                        'closed'
                    );
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

            ->latest()

            ->paginate(2)

            ->withQueryString();

        return view(
            'employers.jobs.index',
            compact('jobs')
        );
    }


    /**
     * =========================================================
     * CREATE JOB
     * =========================================================
     */
    public function create()
    {
        $startupProfiles = StartupProfile::where(
            'employer_id',
            Auth::id()
        )
        ->orderBy('startup_name')
        ->get();

        return view(
            'employers.jobs.create',
            compact('startupProfiles')
        );
    }


    /**
     * =========================================================
     * STORE JOB
     * =========================================================
     */
    public function store(Request $request)
    {
        $data = $this->validateJob($request);

        $data['employer_id'] = Auth::id();

        $data['is_active'] = true;

        /*
        |--------------------------------------------------------------------------
        | Verify Startup Profile Ownership
        |--------------------------------------------------------------------------
        */

        if (!empty($data['startup_profile_id'])) {

            $startupExists = StartupProfile::where(
                'id',
                $data['startup_profile_id']
            )
            ->where(
                'employer_id',
                Auth::id()
            )
            ->exists();

            if (!$startupExists) {

                abort(
                    403,
                    'You do not have access to this startup profile.'
                );
            }
        }

        JobPost::create($data);

        return redirect()
            ->route('employer.jobs.index')
            ->with(
                'success',
                'Job posted successfully.'
            );
    }


    /**
     * =========================================================
     * SHOW JOB
     * =========================================================
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
     * =========================================================
     * EDIT JOB
     * =========================================================
     */
    public function edit(JobPost $job)
    {
        $this->authorizeOwner($job);

        $startupProfiles = StartupProfile::where(
            'employer_id',
            Auth::id()
        )
        ->orderBy('startup_name')
        ->get();

        return view(
            'employers.jobs.edit',
            compact(
                'job',
                'startupProfiles'
            )
        );
    }


    /**
     * =========================================================
     * UPDATE JOB
     * =========================================================
     */
    public function update(
        Request $request,
        JobPost $job
    ) {
        $this->authorizeOwner($job);

        $data = $this->validateJob($request);

        /*
        |--------------------------------------------------------------------------
        | Verify Startup Profile Ownership
        |--------------------------------------------------------------------------
        */

        if (!empty($data['startup_profile_id'])) {

            $startupExists = StartupProfile::where(
                'id',
                $data['startup_profile_id']
            )
            ->where(
                'employer_id',
                Auth::id()
            )
            ->exists();

            if (!$startupExists) {

                abort(
                    403,
                    'You do not have access to this startup profile.'
                );
            }
        }

        $job->update($data);

        return redirect()
            ->route('employer.jobs.index')
            ->with(
                'success',
                'Job updated successfully.'
            );
    }


    /**
     * =========================================================
     * DUPLICATE JOB
     * =========================================================
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
            ->with(
                'success',
                'Job duplicated successfully.'
            );
    }


    /**
     * =========================================================
     * TOGGLE ACTIVE / INACTIVE
     * =========================================================
     */
    public function toggleActive(JobPost $job)
    {
        $this->authorizeOwner($job);

        $job->update([
            'is_active' => !$job->is_active,
        ]);

        return back()->with(
            'success',
            $job->is_active
                ? 'Job marked as active.'
                : 'Job marked as inactive.'
        );
    }


    /**
     * =========================================================
     * CLOSE JOB
     * =========================================================
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
            ->with(
                'success',
                'Job closed successfully.'
            );
    }


    /**
     * =========================================================
     * REOPEN JOB
     * =========================================================
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
            ->with(
                'success',
                'Job reopened successfully.'
            );
    }


    /**
     * =========================================================
     * DELETE JOB
     * =========================================================
     */
    public function destroy(JobPost $job)
    {
        $this->authorizeOwner($job);

        $job->delete();

        return redirect()
            ->route('employer.jobs.index')
            ->with(
                'success',
                'Job deleted successfully.'
            );
    }


    /**
     * =========================================================
     * VALIDATE JOB
     * =========================================================
     */
    private function validateJob(Request $request): array
    {
        /*
        |--------------------------------------------------------------------------
        | NORMALIZE EMPLOYMENT TYPE
        |--------------------------------------------------------------------------
        |
        | The frontend may send:
        |
        | full_time
        | full-time
        | Full Time
        | full time
        | fulltime
        |
        | We convert everything to:
        |
        | full-time
        |
        |--------------------------------------------------------------------------
        */

        $employmentType = $request->input(
            'employment_type'
        );

        if ($employmentType !== null) {

            $employmentType = strtolower(
                trim($employmentType)
            );

            /*
            | Convert underscore to hyphen
            */
            $employmentType = str_replace(
                '_',
                '-',
                $employmentType
            );

            /*
            | Convert multiple spaces to one space
            */
            $employmentType = preg_replace(
                '/\s+/',
                ' ',
                $employmentType
            );

            /*
            | Normalize all accepted values
            */
            $employmentType = match ($employmentType) {

                'full-time',
                'full time',
                'fulltime' => 'full-time',

                'part-time',
                'part time',
                'parttime' => 'part-time',

                'contract' => 'contract',

                'internship',
                'intern' => 'internship',

                'freelance',
                'freelancer' => 'freelance',

                default => $employmentType,
            };

            /*
            | Put normalized value back into request
            */
            $request->merge([
                'employment_type' => $employmentType,
            ]);
        }


        /*
        |--------------------------------------------------------------------------
        | NORMALIZE WORK MODE
        |--------------------------------------------------------------------------
        */

        $workMode = $request->input(
            'work_mode'
        );

        if ($workMode !== null) {

            $workMode = strtolower(
                trim($workMode)
            );

            $workMode = str_replace(
                '_',
                '-',
                $workMode
            );

            $workMode = preg_replace(
                '/\s+/',
                ' ',
                $workMode
            );

            $workMode = match ($workMode) {

                'remote' => 'remote',

                'hybrid' => 'hybrid',

                'onsite',
                'on-site',
                'on site' => 'onsite',

                default => $workMode,
            };

            $request->merge([
                'work_mode' => $workMode,
            ]);
        }


        /*
        |--------------------------------------------------------------------------
        | VALIDATION
        |--------------------------------------------------------------------------
        */

        return $request->validate([

            /*
            |--------------------------------------------------------------------------
            | Job Title
            |--------------------------------------------------------------------------
            */
            'title' => [
                'required',
                'string',
                'max:255',
                'regex:/^[A-Za-z0-9\s\-&().,]+$/',
            ],


            /*
            |--------------------------------------------------------------------------
            | Employment Type
            |--------------------------------------------------------------------------
            */
            'employment_type' => [
                'required',
                'in:full-time,part-time,contract,internship,freelance',
            ],


            /*
            |--------------------------------------------------------------------------
            | Work Mode
            |--------------------------------------------------------------------------
            */
            'work_mode' => [
                'required',
                'in:onsite,hybrid,remote',
            ],


            /*
            |--------------------------------------------------------------------------
            | Experience
            |--------------------------------------------------------------------------
            */
            'experience' => [
                'nullable',
                'string',
                'max:100',
                'regex:/^[A-Za-z0-9\s\-+.,]+$/',
            ],


            /*
            |--------------------------------------------------------------------------
            | Salary
            |--------------------------------------------------------------------------
            */
            'salary' => [
                'nullable',
                'string',
                'max:100',
                'regex:/^[A-Za-z0-9\s₹$€£+\-.,\/]+$/',
            ],


            /*
            |--------------------------------------------------------------------------
            | Qualification
            |--------------------------------------------------------------------------
            */
            'qualification' => [
                'nullable',
                'string',
                'max:255',
                'regex:/^[A-Za-z0-9\s\-&().,]+$/',
            ],


            /*
            |--------------------------------------------------------------------------
            | Skills
            |--------------------------------------------------------------------------
            */
            'skills' => [
                'nullable',
                'string',
                'max:500',
                'regex:/^[A-Za-z0-9\s\-+&().,#\/]+$/',
            ],


            /*
            |--------------------------------------------------------------------------
            | Country
            |--------------------------------------------------------------------------
            */
            'country' => [
                'nullable',
                'string',
                'max:100',
                'regex:/^[A-Za-z\s]+$/',
            ],


            /*
            |--------------------------------------------------------------------------
            | State
            |--------------------------------------------------------------------------
            */
            'state' => [
                'nullable',
                'string',
                'max:100',
                'regex:/^[A-Za-z\s]+$/',
            ],


            /*
            |--------------------------------------------------------------------------
            | District
            |--------------------------------------------------------------------------
            */
            'district' => [
                'nullable',
                'string',
                'max:100',
                'regex:/^[A-Za-z\s]+$/',
            ],


            /*
            |--------------------------------------------------------------------------
            | City
            |--------------------------------------------------------------------------
            */
            'city' => [
                'nullable',
                'string',
                'max:100',
                'regex:/^[A-Za-z\s]+$/',
            ],


            /*
            |--------------------------------------------------------------------------
            | Description
            |--------------------------------------------------------------------------
            */
            'description' => [
                'required',
                'string',
                'max:5000',
            ],


            /*
            |--------------------------------------------------------------------------
            | Startup Profile
            |--------------------------------------------------------------------------
            */
            'startup_profile_id' => [
                'nullable',
                'integer',
                'exists:startup_profiles,id',
            ],

        ], [

            /*
            |--------------------------------------------------------------------------
            | Custom Error Messages
            |--------------------------------------------------------------------------
            */

            'title.required' =>
                'Please enter a job title.',

            'title.regex' =>
                'The job title contains invalid characters.',


            'employment_type.required' =>
                'Please select an employment type.',

            'employment_type.in' =>
                'Please select a valid employment type.',


            'work_mode.required' =>
                'Please select a work mode.',

            'work_mode.in' =>
                'Please select a valid work mode.',


            'experience.regex' =>
                'The experience contains invalid characters.',


            'salary.regex' =>
                'The salary contains invalid characters.',


            'qualification.regex' =>
                'The qualification contains invalid characters.',


            'skills.regex' =>
                'The skills contain invalid characters.',


            'country.regex' =>
                'The country contains invalid characters.',


            'state.regex' =>
                'The state contains invalid characters.',


            'district.regex' =>
                'The district contains invalid characters.',


            'city.regex' =>
                'The city contains invalid characters.',

        ]);
    }


    /**
     * =========================================================
     * AUTHORIZE JOB OWNER
     * =========================================================
     */
    private function authorizeOwner(JobPost $job): void
    {
        abort_if(
            (int) $job->employer_id !== (int) Auth::id(),
            403,
            'You do not have access to this job.'
        );
    }
}