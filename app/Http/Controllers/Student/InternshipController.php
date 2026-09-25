<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Internship;
use App\Models\InternshipApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

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
        */

        $internships = Internship::with([
                'employer',
                'startupProfile',
            ])
            ->withCount([
                /*
                |--------------------------------------------------------------------------
                | FILLED SEATS = SELECTED + COMPLETED
                |--------------------------------------------------------------------------
                |
                | A student's status moves from SELECTED to COMPLETED once the
                | internship is finished. Both statuses still occupy a seat,
                | so both must be counted here. Counting SELECTED only would
                | make the seat count drop (e.g. 1/5 -> 0/5) the moment a
                | student is marked completed.
                |
                */
                'applications as filled_seats' => function ($query) {
                    $query->whereIn(
                        'status',
                        [
                            InternshipApplication::STATUS_SELECTED,
                            InternshipApplication::STATUS_COMPLETED,
                        ]
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

        $studentApplications = InternshipApplication::with([
                'certificate',
            ])
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
        */

        $application = DB::transaction(function () use (
            $internship,
            $validated
        ) {

            /*
            |--------------------------------------------------------------------------
            | LOCK INTERNSHIP
            |--------------------------------------------------------------------------
            */

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
            | Same fix as index(): SELECTED + COMPLETED both occupy a seat.
            | Counting SELECTED only would let new students apply even after
            | the internship reached full capacity, once some students were
            | marked completed.
            |
            */

            $filledSeats = InternshipApplication::where(
                    'internship_id',
                    $lockedInternship->id
                )
                ->whereIn(
                    'status',
                    [
                        InternshipApplication::STATUS_SELECTED,
                        InternshipApplication::STATUS_COMPLETED,
                    ]
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
        $studentId = Auth::id();


        $applications = InternshipApplication::with([
            'internship',
            'internship.employer',
            'internship.startupProfile',
            'certificate',
        ])
            ->where(
                'student_id',
                $studentId
            )
            ->latest()
            ->paginate(10);


        return view(
            'students.internships.applications',
            compact('applications')
        );
    }


    /**
     * Show one internship certificate.
     */
    public function certificate(
        InternshipApplication $application
    ) {
        /*
        |--------------------------------------------------------------------------
        | SECURITY
        |--------------------------------------------------------------------------
        */

        if (
            (int) $application->student_id !==
            (int) Auth::id()
        ) {
            abort(403);
        }


        /*
        |--------------------------------------------------------------------------
        | LOAD RELATIONSHIPS
        |--------------------------------------------------------------------------
        */

        $application->load([
            'internship',
            'certificate',
        ]);


        /*
        |--------------------------------------------------------------------------
        | CERTIFICATE MUST EXIST
        |--------------------------------------------------------------------------
        */

        if (!$application->certificate) {

            abort(
                404,
                'Certificate not found.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | INTERNSHIP MUST BE COMPLETED
        |--------------------------------------------------------------------------
        */

        if (
            defined(
                InternshipApplication::class .
                '::STATUS_COMPLETED'
            )
        ) {

            if (
                $application->status !==
                InternshipApplication::STATUS_COMPLETED
            ) {

                abort(
                    403,
                    'This internship has not been completed.'
                );
            }

        } else {

            if ($application->status !== 'completed') {

                abort(
                    403,
                    'This internship has not been completed.'
                );
            }
        }


        /*
        |--------------------------------------------------------------------------
        | CERTIFICATE VIEW
        |--------------------------------------------------------------------------
        */

        return view(
            'students.internships.certificate',
            compact('application')
        );
    }


    /**
     * Download internship certificate as PDF.
     */
    public function downloadCertificate($application)
    {
        /*
        |--------------------------------------------------------------------------
        | LOAD APPLICATION
        |--------------------------------------------------------------------------
        |
        | IMPORTANT:
        | There is NO 'user' relationship here.
        |
        | The correct relationship is 'student'.
        |
        */

        $application = InternshipApplication::with([
            'student',
            'internship',
            'certificate',
        ])->findOrFail($application);


        /*
        |--------------------------------------------------------------------------
        | SECURITY
        |--------------------------------------------------------------------------
        */

        if (
            (int) $application->student_id !==
            (int) Auth::id()
        ) {

            abort(
                403,
                'You are not authorized to download this certificate.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | INTERNSHIP MUST BE COMPLETED
        |--------------------------------------------------------------------------
        */

        if (
            defined(
                InternshipApplication::class .
                '::STATUS_COMPLETED'
            )
        ) {

            if (
                $application->status !==
                InternshipApplication::STATUS_COMPLETED
            ) {

                abort(
                    403,
                    'This internship has not been completed.'
                );
            }

        } else {

            if ($application->status !== 'completed') {

                abort(
                    403,
                    'This internship has not been completed.'
                );
            }
        }


        /*
        |--------------------------------------------------------------------------
        | CERTIFICATE MUST EXIST
        |--------------------------------------------------------------------------
        */

        if (!$application->certificate) {

            abort(
                404,
                'Certificate not found.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | GENERATE PDF
        |--------------------------------------------------------------------------
        */

        $pdf = Pdf::loadView(
            'students.internships.certificate-pdf',
            [
                'application' => $application,
            ]
        );


        /*
        |--------------------------------------------------------------------------
        | A4 LANDSCAPE
        |--------------------------------------------------------------------------
        */

        $pdf->setPaper(
            'a4',
            'landscape'
        );


        /*
        |--------------------------------------------------------------------------
        | STUDENT NAME
        |--------------------------------------------------------------------------
        */

        $studentName = $application->student?->name
            ?? 'Student';


        /*
        |--------------------------------------------------------------------------
        | SAFE FILE NAME
        |--------------------------------------------------------------------------
        */

        $safeStudentName = preg_replace(
            '/[^A-Za-z0-9\-]/',
            '-',
            $studentName
        );


        $fileName =
            'Internship-Certificate-' .
            $safeStudentName .
            '.pdf';


        /*
        |--------------------------------------------------------------------------
        | DOWNLOAD
        |--------------------------------------------------------------------------
        */

        return $pdf->download($fileName);
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
    /**
 * Student Internship Certificates
 */
public function certificates()
{
    $studentId = auth()->id();

    /*
    |--------------------------------------------------------------------------
    | Get completed internships that have certificates
    |--------------------------------------------------------------------------
    */
    $certificates = \App\Models\InternshipApplication::query()
        ->where('student_id', $studentId)
        ->where('status', 'completed')
        ->whereHas('certificate')
        ->with([
            'internship',
            'certificate',
        ])
        ->latest('created_at')
        ->paginate(10);

    /*
    |--------------------------------------------------------------------------
    | Certificate count
    |--------------------------------------------------------------------------
    */
    $certificateCount = \App\Models\InternshipApplication::query()
        ->where('student_id', $studentId)
        ->where('status', 'completed')
        ->whereHas('certificate')
        ->count();

    return view('students.internships.certificates', [
        'certificates'    => $certificates,
        'certificateCount' => $certificateCount,
    ]);
}


    /**
     * Display one certificate.
     */
    public function showCertificate(
        InternshipApplication $application
    ) {
        /*
        |--------------------------------------------------------------------------
        | SECURITY
        |--------------------------------------------------------------------------
        */

        abort_if(
            (int) $application->student_id !==
                (int) Auth::id(),
            403,
            'You do not have access to this certificate.'
        );


        /*
        |--------------------------------------------------------------------------
        | LOAD RELATIONSHIPS
        |--------------------------------------------------------------------------
        */

        $application->load([
            'internship.employer',
            'internship.startupProfile',
            'certificate',
        ]);


        /*
        |--------------------------------------------------------------------------
        | CERTIFICATE MUST EXIST
        |--------------------------------------------------------------------------
        */

        abort_if(
            !$application->certificate,
            404,
            'Certificate not found.'
        );


        /*
        |--------------------------------------------------------------------------
        | VIEW
        |--------------------------------------------------------------------------
        */

        return view(
            'students.internships.certificate-view',
            compact('application')
        );
    }
}