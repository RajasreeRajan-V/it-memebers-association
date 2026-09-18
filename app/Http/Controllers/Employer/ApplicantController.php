<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\Interview;
use App\Models\JobApplication;
use App\Models\JobPost;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ApplicantController extends Controller
{
    /**
     * =========================================================
     * APPLICANTS INDEX
     * =========================================================
     */
    public function index(Request $request)
    {
        $employerId = Auth::id();

        $tab = $request->get('tab', 'all');

        /*
        |--------------------------------------------------------------------------
        | Employer Jobs
        |--------------------------------------------------------------------------
        */

        $jobs = JobPost::where('employer_id', $employerId)
            ->latest()
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Applicants
        |--------------------------------------------------------------------------
        */

        $applications = JobApplication::query()
            ->whereHas('jobPost', function ($query) use ($employerId) {
                $query->where('employer_id', $employerId);
            })
            ->with([
                'user.employeeRegistration',
                'jobPost',
                'interview',
            ]);

        /*
        |--------------------------------------------------------------------------
        | Status Filter
        |--------------------------------------------------------------------------
        */

        switch ($tab) {

            case 'new':

                $applications->where(
                    'status',
                    JobApplication::STATUS_APPLIED
                );

                break;

            case 'shortlisted':

                $applications
                    ->where(
                        'status',
                        JobApplication::STATUS_IN_PROGRESS
                    )
                    ->where(
                        'sub_status',
                        JobApplication::SUB_SHORTLISTED
                    );

                break;

            case 'interview':

                $applications->where(
                    'status',
                    JobApplication::STATUS_INTERVIEW
                );

                break;

            case 'selected':

                $applications->where(
                    'status',
                    JobApplication::STATUS_HIRED
                );

                break;

            case 'rejected':

                $applications->where(
                    'status',
                    JobApplication::STATUS_REJECTED
                );

                break;

            case 'all':
            default:

                break;
        }

        /*
        |--------------------------------------------------------------------------
        | Job Filter
        |--------------------------------------------------------------------------
        */

        if ($request->filled('job')) {

            $applications->where(
                'job_post_id',
                $request->job
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Pagination
        |--------------------------------------------------------------------------
        */

        $applications = $applications
            ->latest()
            ->paginate(3)
            ->withQueryString();

        /*
        |--------------------------------------------------------------------------
        | Counts
        |--------------------------------------------------------------------------
        */

        $baseQuery = JobApplication::query()
            ->whereHas('jobPost', function ($query) use ($employerId) {
                $query->where('employer_id', $employerId);
            });

        $counts = [

            'all' => (clone $baseQuery)->count(),

            'new' => (clone $baseQuery)
                ->where(
                    'status',
                    JobApplication::STATUS_APPLIED
                )
                ->count(),

            'shortlisted' => (clone $baseQuery)
                ->where(
                    'status',
                    JobApplication::STATUS_IN_PROGRESS
                )
                ->where(
                    'sub_status',
                    JobApplication::SUB_SHORTLISTED
                )
                ->count(),

            'interview' => (clone $baseQuery)
                ->where(
                    'status',
                    JobApplication::STATUS_INTERVIEW
                )
                ->count(),

            'selected' => (clone $baseQuery)
                ->where(
                    'status',
                    JobApplication::STATUS_HIRED
                )
                ->count(),

            'rejected' => (clone $baseQuery)
                ->where(
                    'status',
                    JobApplication::STATUS_REJECTED
                )
                ->count(),
        ];

        return view(
            'employers.applicants.index',
            compact(
                'applications',
                'jobs',
                'counts',
                'tab'
            )
        );
    }


    /**
     * =========================================================
     * SERVE EMPLOYEE PROFILE PHOTO
     * =========================================================
     */
    public function photo(User $applicant)
    {
        /*
        |--------------------------------------------------------------------------
        | Security
        |--------------------------------------------------------------------------
        | Applicant must have applied to a job belonging to the
        | currently logged-in employer.
        */

        $applicationExists = JobApplication::query()
            ->where('user_id', $applicant->id)
            ->whereHas('jobPost', function ($query) {
                $query->where('employer_id', Auth::id());
            })
            ->exists();

        if (!$applicationExists) {
            abort(404);
        }

        /*
        |--------------------------------------------------------------------------
        | Employee Profile
        |--------------------------------------------------------------------------
        */

        $profile = $applicant->employeeRegistration;

        if (!$profile || empty($profile->profile_photo)) {
            abort(404);
        }

        /*
        |--------------------------------------------------------------------------
        | Get Stored Path
        |--------------------------------------------------------------------------
        */

        $path = trim($profile->profile_photo);

        $path = str_replace('\\', '/', $path);

        $path = ltrim($path, '/');

        /*
        |--------------------------------------------------------------------------
        | Remove Possible Prefixes
        |--------------------------------------------------------------------------
        */

        if (str_starts_with($path, 'storage/')) {
            $path = substr($path, strlen('storage/'));
        }

        if (str_starts_with($path, 'public/')) {
            $path = substr($path, strlen('public/'));
        }

        /*
        |--------------------------------------------------------------------------
        | Laravel Public Disk
        |--------------------------------------------------------------------------
        */

        $disk = Storage::disk('public');

        if ($disk->exists($path)) {

            $fullPath = $disk->path($path);

            if (is_file($fullPath)) {

                return response()->file(
                    $fullPath,
                    [
                        'Content-Type' => $this->getImageMimeType($fullPath),
                        'Cache-Control' => 'public, max-age=86400',
                    ]
                );
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Fallback: storage/app/public
        |--------------------------------------------------------------------------
        */

        $storagePath = storage_path(
            'app/public/' . $path
        );

        if (is_file($storagePath)) {

            return response()->file(
                $storagePath,
                [
                    'Content-Type' => $this->getImageMimeType($storagePath),
                    'Cache-Control' => 'public, max-age=86400',
                ]
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Fallback: public/
        |--------------------------------------------------------------------------
        */

        $publicPath = public_path($path);

        if (is_file($publicPath)) {

            return response()->file(
                $publicPath,
                [
                    'Content-Type' => $this->getImageMimeType($publicPath),
                    'Cache-Control' => 'public, max-age=86400',
                ]
            );
        }

        /*
        |--------------------------------------------------------------------------
        | File Not Found
        |--------------------------------------------------------------------------
        */

        abort(404);
    }


    /**
     * =========================================================
     * GET IMAGE MIME TYPE
     * =========================================================
     */
    private function getImageMimeType(string $path): string
    {
        $mime = mime_content_type($path);

        if ($mime) {
            return $mime;
        }

        return 'image/png';
    }


    /**
     * =========================================================
     * APPLICANT DETAILS - JSON FOR POPUP
     * =========================================================
     */
    public function details(User $applicant)
    {
        $employerId = Auth::id();

        /*
        |--------------------------------------------------------------------------
        | Get Application
        |--------------------------------------------------------------------------
        */

        $application = JobApplication::query()
            ->where(
                'user_id',
                $applicant->id
            )
            ->whereHas(
                'jobPost',
                function ($query) use ($employerId) {

                    $query->where(
                        'employer_id',
                        $employerId
                    );
                }
            )
            ->with([
                'jobPost',
                'interview',
                'user.employeeRegistration',
            ])
            ->latest()
            ->first();

        if (!$application) {

            return response()->json([
                'status' => false,
                'status_code' => 404,
                'message' => 'Applicant not found.',
                'data' => [],
            ], 404);
        }

        /*
        |--------------------------------------------------------------------------
        | Profile
        |--------------------------------------------------------------------------
        */

        $profile = $applicant->employeeRegistration;

        /*
        |--------------------------------------------------------------------------
        | Profile Photo URL
        |--------------------------------------------------------------------------
        */

        $profilePhoto = '';

        if (
            $profile &&
            !empty($profile->profile_photo)
        ) {

            $profilePhoto = route(
                'employer.applicants.photo',
                [
                    'applicant' => $applicant->id,
                ]
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Resume
        |--------------------------------------------------------------------------
        */

        $resume = '';

        if (
            $profile &&
            !empty($profile->resume)
        ) {

            $resumePath = trim(
                $profile->resume
            );

            $resumePath = str_replace(
                '\\',
                '/',
                $resumePath
            );

            $resumePath = ltrim(
                $resumePath,
                '/'
            );

            if (
                str_starts_with(
                    $resumePath,
                    'storage/'
                )
            ) {

                $resumePath = substr(
                    $resumePath,
                    strlen('storage/')
                );
            }

            if (
                Storage::disk('public')->exists(
                    $resumePath
                )
            ) {

                $resume = asset(
                    'storage/' . $resumePath
                );
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Skills
        |--------------------------------------------------------------------------
        */

        $skills = $profile?->skills ?? [];

        if (is_string($skills)) {

            $decodedSkills = json_decode(
                $skills,
                true
            );

            if (
                json_last_error() === JSON_ERROR_NONE &&
                is_array($decodedSkills)
            ) {

                $skills = $decodedSkills;

            } else {

                $skills = array_filter(
                    array_map(
                        'trim',
                        preg_split(
                            '/[,|]/',
                            $skills
                        )
                    )
                );
            }
        }

        if (!is_array($skills)) {

            $skills = [];
        }

        /*
        |--------------------------------------------------------------------------
        | Experience
        |--------------------------------------------------------------------------
        */

        $experience = '';

        if (
            $profile &&
            $profile->experience_years !== null &&
            $profile->experience_years !== ''
        ) {

            $experience =
                $profile->experience_years;
        }

        /*
        |--------------------------------------------------------------------------
        | Interview
        |--------------------------------------------------------------------------
        */

        $interviewData = null;

        if ($application->interview) {

            $interview =
                $application->interview;

            $interviewData = [

                'id' =>
                    $interview->id,

                'scheduled_at' =>
                    $interview->scheduled_at
                        ? $interview->scheduled_at
                            ->format(
                                'd M Y, h:i A'
                            )
                        : '',

                'mode' =>
                    $interview->mode ?? '',

                'location' =>
                    $interview->location ?? '',

                'status' =>
                    $interview->status ?? '',
            ];
        }

        /*
        |--------------------------------------------------------------------------
        | JSON Response
        |--------------------------------------------------------------------------
        */

        return response()->json([

            'status' => true,

            'status_code' => 200,

            'message' =>
                'Applicant details retrieved successfully.',

            'data' => [

                'id' =>
                    $applicant->id,

                'application_id' =>
                    $application->id,

                'name' =>
                    $applicant->name ?? '',

                'email' =>
                    $applicant->email ?? '',

                'phone' =>
                    $applicant->phone ?? '',

                'profile_photo' =>
                    $profilePhoto,

                'designation' =>
                    $profile?->designation ?? '',

                'experience' =>
                    $experience,

                'location' =>
                    '',

                'about' =>
                    '',

                'skills' =>
                    array_values($skills),

                'education' =>
                    '',

                'projects' =>
                    '',

                'certifications' =>
                    '',

                'linkedin' =>
                    $profile?->linkedin ?? '',

                'resume' =>
                    $resume,

                'job' =>
                    $application->jobPost?->title ?? '',

                'job_id' =>
                    $application->jobPost?->id ?? '',

                'applied' =>
                    $application->created_at
                        ? $application->created_at
                            ->format('d M Y')
                        : '',

                'status' =>
                    $application->status ?? '',

                'sub_status' =>
                    $application->sub_status ?? '',

                'interview' =>
                    $interviewData,
            ],
        ]);
    }


    /**
     * =========================================================
     * SHOW APPLICANT PAGE
     * =========================================================
     */
    public function show(User $applicant)
    {
        $employerId = Auth::id();

        /*
        |--------------------------------------------------------------------------
        | Profile
        |--------------------------------------------------------------------------
        */

        $profile =
            $applicant->employeeRegistration;

        /*
        |--------------------------------------------------------------------------
        | Applications
        |--------------------------------------------------------------------------
        */

        $applications =
            JobApplication::query()
                ->where(
                    'user_id',
                    $applicant->id
                )
                ->whereHas(
                    'jobPost',
                    function ($query) use ($employerId) {

                        $query->where(
                            'employer_id',
                            $employerId
                        );
                    }
                )
                ->with([
                    'jobPost',
                    'interview',
                ])
                ->latest()
                ->get();

        if ($applications->isEmpty()) {

            abort(404);
        }

        return view(
            'employers.applicants.show',
            compact(
                'applicant',
                'profile',
                'applications'
            )
        );
    }


    /**
     * =========================================================
     * UPDATE STATUS
     * =========================================================
     */
    public function updateStatus(
        Request $request,
        JobApplication $application
    ) {

        $this->authorizeOwner(
            $application
        );

        $validated = $request->validate([

            'status' => [
                'required',
                'in:applied,in_progress,interview,hired,rejected,archived',
            ],

            'sub_status' => [
                'nullable',
                'in:resume_reviewed,under_review,shortlisted,hr_review,technical_review',
            ],

        ]);

        /*
        |--------------------------------------------------------------------------
        | Move Application
        |--------------------------------------------------------------------------
        */

        $application->moveTo(
            $validated['status'],
            $validated['sub_status'] ?? null
        );

        return back()->with(
            'success',
            'Applicant status updated successfully.'
        );
    }


    /**
     * =========================================================
     * SCHEDULE INTERVIEW
     * =========================================================
     */
    public function scheduleInterview(
        Request $request,
        JobApplication $application
    ) {

        /*
        |--------------------------------------------------------------------------
        | Security
        |--------------------------------------------------------------------------
        */

        $this->authorizeOwner(
            $application
        );

        /*
        |--------------------------------------------------------------------------
        | Validate
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([

            'scheduled_at' => [
                'required',
                'date',
            ],

            'mode' => [
                'required',
                'in:online,in_person,phone',
            ],

            'location' => [
                'nullable',
                'string',
                'max:1000',
            ],

        ]);

        /*
        |--------------------------------------------------------------------------
        | Create / Update Interview
        |--------------------------------------------------------------------------
        |
        | IMPORTANT:
        | The interviews table uses application_id.
        | It does NOT use job_application_id.
        |
        */

        Interview::updateOrCreate(

            [
                'application_id' => $application->id,
            ],

            [

                'employer_id' => Auth::id(),

                'scheduled_at' =>
                    $validated['scheduled_at'],

                'mode' =>
                    $validated['mode'],

                'location' =>
                    $validated['location'] ?? null,

                'status' =>
                    Interview::STATUS_SCHEDULED,
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | Update Application Status
        |--------------------------------------------------------------------------
        */

        $application->moveTo(
            JobApplication::STATUS_INTERVIEW
        );

        /*
        |--------------------------------------------------------------------------
        | Success
        |--------------------------------------------------------------------------
        */

        return back()->with(
            'success',
            'Interview scheduled successfully.'
        );
    }


    /**
     * =========================================================
     * CANCEL INTERVIEW
     * =========================================================
     */
    public function cancelInterview(
        JobApplication $application
    ) {

        /*
        |--------------------------------------------------------------------------
        | Security
        |--------------------------------------------------------------------------
        */

        $this->authorizeOwner(
            $application
        );

        /*
        |--------------------------------------------------------------------------
        | Cancel Interview
        |--------------------------------------------------------------------------
        */

        $interview =
            $application->interview;

        if ($interview) {

            $interview->update([
                'status' =>
                    Interview::STATUS_CANCELLED,
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Return Application To Shortlisted
        |--------------------------------------------------------------------------
        */

        $application->moveTo(
            JobApplication::STATUS_IN_PROGRESS,
            JobApplication::SUB_SHORTLISTED
        );

        return back()->with(
            'success',
            'Interview cancelled successfully.'
        );
    }


    /**
     * =========================================================
     * AUTHORIZE EMPLOYER
     * =========================================================
     */
    private function authorizeOwner(
        JobApplication $application
    ) {

        if (
            !$application->jobPost ||
            $application->jobPost->employer_id != Auth::id()
        ) {

            abort(
                403,
                'Unauthorized action.'
            );
        }
    }
}