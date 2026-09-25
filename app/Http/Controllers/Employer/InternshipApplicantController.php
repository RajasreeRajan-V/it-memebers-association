<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\Internship;
use App\Models\InternshipApplication;
use App\Models\InternshipCertificate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class InternshipApplicantController extends Controller
{
    /**
     * Display internship applicants.
     */
    public function index(Request $request)
    {
        $employerId = Auth::id();

        /*
        |--------------------------------------------------------------------------
        | Employer internships
        |--------------------------------------------------------------------------
        */
        $internships = Internship::query()
            ->where('employer_id', $employerId)
            ->orderByDesc('created_at')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Current tab
        |--------------------------------------------------------------------------
        */
        $tab = $request->get('tab', 'all');

        $allowedTabs = [
            'all',
            'applied',
            'selected',
            'completed',
            'rejected',
        ];

        if (!in_array($tab, $allowedTabs, true)) {
            $tab = 'all';
        }

        /*
        |--------------------------------------------------------------------------
        | Counts
        |--------------------------------------------------------------------------
        */
        $baseQuery = InternshipApplication::query()
            ->whereHas('internship', function ($query) use ($employerId) {
                $query->where('employer_id', $employerId);
            });

        $counts = [
            'all' => (clone $baseQuery)->count(),

            'applied' => (clone $baseQuery)
                ->where('status', InternshipApplication::STATUS_APPLIED)
                ->count(),

            'selected' => (clone $baseQuery)
                ->where('status', InternshipApplication::STATUS_SELECTED)
                ->count(),

            'completed' => (clone $baseQuery)
                ->where('status', InternshipApplication::STATUS_COMPLETED)
                ->count(),

            'rejected' => (clone $baseQuery)
                ->where('status', InternshipApplication::STATUS_REJECTED)
                ->count(),
        ];

        /*
        |--------------------------------------------------------------------------
        | Applications
        |--------------------------------------------------------------------------
        */
        $applicationsQuery = InternshipApplication::query()
            ->whereHas('internship', function ($query) use ($employerId) {
                $query->where('employer_id', $employerId);
            })

            /*
            |--------------------------------------------------------------------------
            | IMPORTANT
            | Load the complete student profile
            |--------------------------------------------------------------------------
            */
            ->with([
                'student.studentRegistration',
                'student.employeeRegistration',
                'internship.employer',
                'internship.startupProfile',
                'certificate',
            ])
            ->latest('created_at');

        /*
        |--------------------------------------------------------------------------
        | Internship filter
        |--------------------------------------------------------------------------
        */
        if ($request->filled('internship')) {
            $applicationsQuery->where(
                'internship_id',
                $request->integer('internship')
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Status filter
        |--------------------------------------------------------------------------
        */
        if ($tab !== 'all') {
            $applicationsQuery->where('status', $tab);
        }

        /*
        |--------------------------------------------------------------------------
        | Pagination
        |--------------------------------------------------------------------------
        */
        $applications = $applicationsQuery
            ->paginate(10)
            ->withQueryString();

        return view(
            'employers.internship-applicants.index',
            compact(
                'applications',
                'internships',
                'counts',
                'tab'
            )
        );
    }

    /**
     * Select student.
     */
    public function select(InternshipApplication $application)
    {
        $this->authorizeOwner($application);

        if (!$application->isApplied()) {
            return back()->with(
                'error',
                'Only new applications can be selected.'
            );
        }

        $application->update([
            'status' => InternshipApplication::STATUS_SELECTED,
            'selected_at' => now(),
        ]);

        return back()->with(
            'success',
            'Student selected for this internship.'
        );
    }

    /**
     * Reject application.
     */
    public function reject(InternshipApplication $application)
    {
        $this->authorizeOwner($application);

        if ($application->isCompleted()) {
            return back()->with(
                'error',
                'A completed application cannot be rejected.'
            );
        }

        $application->update([
            'status' => InternshipApplication::STATUS_REJECTED,
            'rejected_at' => now(),
        ]);

        return back()->with(
            'success',
            'Application rejected.'
        );
    }

    /**
     * Complete internship and generate certificate.
     */
    public function complete(
        Request $request,
        InternshipApplication $application
    ) {
        $this->authorizeOwner($application);

        if (!$application->isSelected()) {
            abort(
                403,
                'Only a selected student can be marked as completed.'
            );
        }

        $validated = $request->validate([
            'performance' => [
                'required',
                'in:excellent,very_good,good,satisfactory'
            ],

            'comments' => [
                'nullable',
                'string',
                'max:2000'
            ],
        ]);

        $application->update([
            'status' => InternshipApplication::STATUS_COMPLETED,
            'completed_at' => now(),
            'performance' => $validated['performance'],
            'comments' => $validated['comments'] ?? null,
        ]);

        InternshipCertificate::firstOrCreate(
            [
                'internship_application_id' => $application->id,
            ],
            [
                'certificate_number' =>
                    'TLN-INT-' .
                    now()->format('Y') .
                    '-' .
                    str_pad(
                        (string) $application->id,
                        5,
                        '0',
                        STR_PAD_LEFT
                    ),

                'issued_date' => now(),

                'verification_token' => (string) Str::uuid(),
            ]
        );

        return back()->with(
            'success',
            'Internship marked as completed. Certificate generated for the student.'
        );
    }

    /**
     * Check that the application belongs to this employer.
     */
    private function authorizeOwner(
        InternshipApplication $application
    ): void {
        abort_if(
            !$application->internship ||
            (int) $application->internship->employer_id !==
            (int) Auth::id(),

            403,

            'You do not have access to this application.'
        );
    }
}