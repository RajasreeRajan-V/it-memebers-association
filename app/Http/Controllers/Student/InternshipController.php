<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Internship;
use App\Models\InternshipApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InternshipController extends Controller
{
    /**
     * Display available internships.
     */
    public function index(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | AVAILABLE INTERNSHIPS
        |--------------------------------------------------------------------------
        |
        | filled_seats = number of students SELECTED by employer.
        | Applied students do not consume a seat.
        |
        */

        $internships = Internship::with([
                'employer',
                'startupProfile',
            ])
            ->withCount([
                'applications as filled_seats' => function ($query) {
                    $query->where(
                        'status',
                        InternshipApplication::STATUS_SELECTED
                    );
                },
            ])
            ->where('status', 'active')

            ->when(
                $request->filled('search'),
                function ($query) use ($request) {

                    $search = trim($request->search);

                    $query->where(function ($q) use ($search) {

                        $q->where(
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
                            'skills',
                            'like',
                            "%{$search}%"
                        );
                    });
                }
            )

            ->when(
                $request->filled('city'),
                function ($query) use ($request) {

                    $city = trim($request->city);

                    $query->where(
                        'city',
                        'like',
                        "%{$city}%"
                    );
                }
            )

            ->latest()
            ->paginate(4)
            ->withQueryString();

        /*
        |--------------------------------------------------------------------------
        | STUDENT APPLICATIONS
        |--------------------------------------------------------------------------
        */

        $studentApplications = InternshipApplication::with('certificate')
            ->where(
                'student_id',
                Auth::id()
            )
            ->get()
            ->keyBy('internship_id');

        /*
        |--------------------------------------------------------------------------
        | RETURN VIEW
        |--------------------------------------------------------------------------
        */

        return view(
            'students.internships.index',
            compact(
                'internships',
                'studentApplications'
            )
        );
    }


    /**
     * Apply for an internship.
     */
    public function apply(
        Request $request,
        Internship $internship
    ) {
        /*
        |--------------------------------------------------------------------------
        | INTERNSHIP MUST BE ACTIVE
        |--------------------------------------------------------------------------
        */

        if ($internship->status !== 'active') {

            return back()->with(
                'error',
                'This internship is no longer accepting applications.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | VALIDATE COVER LETTER
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([
            'cover_letter' => [
                'nullable',
                'string',
                'max:2000',
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | CHECK APPLICATION + SEATS
        |--------------------------------------------------------------------------
        |
        | lockForUpdate() prevents two students from taking the last
        | available seat at exactly the same time.
        |
        */

        $application = DB::transaction(function () use (
            $request,
            $internship,
            $validated
        ) {

            $lockedInternship = Internship::where(
                    'id',
                    $internship->id
                )
                ->lockForUpdate()
                ->firstOrFail();

            /*
            |--------------------------------------------------------------------------
            | PREVENT DUPLICATE APPLICATION
            |--------------------------------------------------------------------------
            */

            $alreadyApplied = InternshipApplication::where(
                    'internship_id',
                    $lockedInternship->id
                )
                ->where(
                    'student_id',
                    Auth::id()
                )
                ->exists();

            if ($alreadyApplied) {

                return null;
            }

            /*
            |--------------------------------------------------------------------------
            | CHECK AVAILABLE SEATS
            |--------------------------------------------------------------------------
            |
            | Only SELECTED applications count as filled seats.
            |
            */

            $filledSeats = InternshipApplication::where(
                    'internship_id',
                    $lockedInternship->id
                )
                ->where(
                    'status',
                    InternshipApplication::STATUS_SELECTED
                )
                ->count();

            $totalSeats = (int) $lockedInternship->positions;

            /*
            |--------------------------------------------------------------------------
            | INTERNSHIP FULL
            |--------------------------------------------------------------------------
            */

            if (
                $totalSeats > 0 &&
                $filledSeats >= $totalSeats
            ) {

                return 'full';
            }

            /*
            |--------------------------------------------------------------------------
            | STUDENT RESUME
            |--------------------------------------------------------------------------
            */

            $resume = optional(
                Auth::user()->studentRegistration
            )->resume;

            /*
            |--------------------------------------------------------------------------
            | CREATE APPLICATION
            |--------------------------------------------------------------------------
            */

            return InternshipApplication::create([
                'internship_id' => $lockedInternship->id,

                'student_id' => Auth::id(),

                'resume' => $resume,

                'cover_letter' =>
                    $validated['cover_letter'] ?? null,

                'status' =>
                    InternshipApplication::STATUS_APPLIED,

                'applied_at' => now(),
            ]);
        });

        /*
        |--------------------------------------------------------------------------
        | DUPLICATE APPLICATION
        |--------------------------------------------------------------------------
        */

        if ($application === null) {

            return back()->with(
                'error',
                'You have already applied for this internship.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | FULL
        |--------------------------------------------------------------------------
        */

        if ($application === 'full') {

            return back()->with(
                'error',
                'This internship is full. No more applications can be submitted.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | SUCCESS
        |--------------------------------------------------------------------------
        */

        return back()->with(
            'success',
            'Your application has been submitted successfully.'
        );
    }


    /**
     * Show all internship applications of the student.
     */
    public function applications()
    {
        $applications = InternshipApplication::with([
                'internship.employer',
                'internship.startupProfile',
                'certificate',
            ])
            ->where(
                'student_id',
                Auth::id()
            )
            ->latest()
            ->paginate(10);

        return view(
            'students.internships.applications',
            compact('applications')
        );
    }


    /**
     * Show selected/completed internships.
     */
    public function myInternships()
    {
        $applications = InternshipApplication::with([
                'internship.employer',
                'internship.startupProfile',
                'certificate',
            ])
            ->where(
                'student_id',
                Auth::id()
            )
            ->whereIn(
                'status',
                [
                    InternshipApplication::STATUS_SELECTED,
                    InternshipApplication::STATUS_COMPLETED,
                ]
            )
            ->latest()
            ->paginate(10);

        return view(
            'students.internships.my-internships',
            compact('applications')
        );
    }


    /**
     * Show student's certificates.
     */
    public function certificates()
    {
        $applications = InternshipApplication::with([
                'internship.employer',
                'internship.startupProfile',
                'certificate',
            ])
            ->where(
                'student_id',
                Auth::id()
            )
            ->where(
                'status',
                InternshipApplication::STATUS_COMPLETED
            )
            ->whereHas('certificate')
            ->latest()
            ->paginate(10);

        return view(
            'students.internships.certificates',
            compact('applications')
        );
    }


    /**
     * Display one certificate.
     */
    public function showCertificate(
        InternshipApplication $application
    ) {
        abort_if(
            (int) $application->student_id !==
                (int) Auth::id(),
            403,
            'You do not have access to this certificate.'
        );

        $application->load([
            'internship.employer',
            'internship.startupProfile',
            'certificate',
        ]);

        abort_if(
            !$application->certificate,
            404,
            'Certificate not found.'
        );

        return view(
            'students.internships.certificate-view',
            compact('application')
        );
    }
}