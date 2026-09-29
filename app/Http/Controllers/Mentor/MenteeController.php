<?php

namespace App\Http\Controllers\Mentor;

use App\Http\Controllers\Controller;
use App\Models\Mentorship;
use App\Models\MentorshipRequest;
use App\Models\MentorshipSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class MenteeController extends Controller
{
    /**
     * GET /mentor/mentees
     *
     * Mentor "My Mentees" dashboard
     *
     * Includes:
     * - Statistics
     * - Pending mentorship requests
     * - Active mentees
     * - Upcoming sessions
     * - Completed mentorships
     */
    public function index()
    {
        $mentorId = Auth::id();

        /*
        |--------------------------------------------------------------------------
        | STATISTICS
        |--------------------------------------------------------------------------
        */

        $stats = [
            'active_count' => Mentorship::where('mentor_id', $mentorId)
                ->where('status', 'active')
                ->count(),

            'pending_count' => MentorshipRequest::where('mentor_id', $mentorId)
                ->where('status', 'pending')
                ->count(),

            'completed_count' => Mentorship::where('mentor_id', $mentorId)
                ->where('status', 'completed')
                ->count(),

            'upcoming_sessions_count' => MentorshipSession::whereHas(
                    'mentorship',
                    function ($query) use ($mentorId) {
                        $query->where('mentor_id', $mentorId)
                            ->where('status', 'active');
                    }
                )
                ->where(function ($query) {

                    $query->where('starts_at', '>=', now());

                })
                ->count(),
        ];


        /*
        |--------------------------------------------------------------------------
        | PENDING MENTORSHIP REQUESTS
        |--------------------------------------------------------------------------
        */

        $pendingRequests = MentorshipRequest::where(
                'mentor_id',
                $mentorId
            )
            ->where('status', 'pending')
            ->with('student.studentRegistration')
            ->latest()
            ->get();


        /*
        |--------------------------------------------------------------------------
        | ACTIVE MENTEES
        |--------------------------------------------------------------------------
        */

        $activeMentees = Mentorship::where(
                'mentor_id',
                $mentorId
            )
            ->where('status', 'active')
            ->with([
                'student.studentRegistration',

                /*
                |--------------------------------------------------------------------------
                | Latest session for each mentee
                |--------------------------------------------------------------------------
                */
                'sessions' => function ($q) {
                    $q->orderByDesc('starts_at')
                        ->limit(1);
                },
            ])

            /*
            |--------------------------------------------------------------------------
            | Average rating across ALL rated sessions
            |--------------------------------------------------------------------------
            */
            ->withAvg(
                [
                    'sessions as avg_rating' => function ($q) {

                        $q->join(
                            'mentorship_feedbacks',
                            'mentorship_feedbacks.session_id',
                            '=',
                            'mentorship_sessions.id'
                        );
                    }
                ],
                'mentorship_feedbacks.rating'
            )
            ->get();


        /*
        |--------------------------------------------------------------------------
        | UPCOMING SESSIONS
        |--------------------------------------------------------------------------
        |
        | The previous Blade file expects:
        |
        | $upcomingSessions
        |
        | Each item contains:
        |
        | [
        |     'session' => $session,
        |     'mentee'  => $mentee,
        | ]
        |
        */

        $upcomingSessions = MentorshipSession::with([
                'mentorship.student.studentRegistration',
            ])
            ->whereHas(
                'mentorship',
                function ($query) use ($mentorId) {

                    $query->where(
                        'mentor_id',
                        $mentorId
                    )
                    ->where(
                        'status',
                        'active'
                    );
                }
            )
            ->where(
                'starts_at',
                '>=',
                now()
            )
            ->orderBy(
                'starts_at',
                'asc'
            )
            ->take(10)
            ->get()
            ->map(function ($session) {

                return [
                    'session' => $session,
                    'mentee'  => $session->mentorship,
                ];

            });


        /*
        |--------------------------------------------------------------------------
        | COMPLETED MENTORSHIPS
        |--------------------------------------------------------------------------
        */

        $completed = Mentorship::where(
                'mentor_id',
                $mentorId
            )
            ->where(
                'status',
                'completed'
            )
            ->with('student')
            ->latest()
            ->get();


        /*
        |--------------------------------------------------------------------------
        | RETURN VIEW
        |--------------------------------------------------------------------------
        */

        return view(
            'mentor.mentees.index',
            compact(
                'stats',
                'pendingRequests',
                'activeMentees',
                'upcomingSessions',
                'completed'
            )
        );
    }


    /**
     * GET /mentor/mentees/{mentee}
     *
     * Mentee details page.
     */
    public function show(Mentorship $mentee)
    {
        /*
        |--------------------------------------------------------------------------
        | SECURITY
        |--------------------------------------------------------------------------
        */

        abort_unless(
            $mentee->mentor_id === Auth::id(),
            403
        );


        /*
        |--------------------------------------------------------------------------
        | LOAD RELATIONSHIPS
        |--------------------------------------------------------------------------
        */

        $mentee->load([
            'student.studentRegistration',

            'sessions' => function ($q) {

                $q->orderByDesc('starts_at');

            },

            'sessions.feedback',
        ]);


        /*
        |--------------------------------------------------------------------------
        | UPCOMING SESSION
        |--------------------------------------------------------------------------
        */

        $upcoming = $mentee->upcomingSession();


        /*
        |--------------------------------------------------------------------------
        | AVERAGE RATING
        |--------------------------------------------------------------------------
        */

        $avgRating = $mentee->sessions
            ->pluck('feedback.rating')
            ->filter()
            ->avg();


        /*
        |--------------------------------------------------------------------------
        | RATED SESSION COUNT
        |--------------------------------------------------------------------------
        */

        $ratedCount = $mentee->sessions
            ->pluck('feedback')
            ->filter()
            ->count();


        /*
        |--------------------------------------------------------------------------
        | RETURN DETAILS VIEW
        |--------------------------------------------------------------------------
        */

        return view(
            'mentor.mentees.show',
            [
                'mentorship' => $mentee,
                'upcoming'   => $upcoming,
                'avgRating'  => $avgRating,
                'ratedCount' => $ratedCount,
            ]
        );
    }


    /**
     * POST /mentor/mentees/requests/{mentorshipRequest}/accept
     *
     * Accept mentorship request.
     */
    public function acceptRequest(
        MentorshipRequest $mentorshipRequest
    ) {

        /*
        |--------------------------------------------------------------------------
        | SECURITY
        |--------------------------------------------------------------------------
        */

        abort_unless(
            $mentorshipRequest->mentor_id === Auth::id(),
            403
        );


        /*
        |--------------------------------------------------------------------------
        | CHECK STATUS
        |--------------------------------------------------------------------------
        */

        abort_unless(
            $mentorshipRequest->status === 'pending',
            422,
            'Request already handled.'
        );


        /*
        |--------------------------------------------------------------------------
        | UPDATE REQUEST
        |--------------------------------------------------------------------------
        */

        $mentorshipRequest->update([
            'status' => 'accepted',
            'accepted_at' => now(),
        ]);


        /*
        |--------------------------------------------------------------------------
        | CREATE ACTIVE MENTORSHIP
        |--------------------------------------------------------------------------
        */

        Mentorship::firstOrCreate(
            [
                'mentorship_request_id' =>
                    $mentorshipRequest->id,
            ],
            [
                'student_id' =>
                    $mentorshipRequest->student_id,

                'mentor_id' =>
                    $mentorshipRequest->mentor_id,

                'career_goal' =>
                    $mentorshipRequest->career_goal,

                'status' =>
                    'active',

                'started_at' =>
                    now(),
            ]
        );


        /*
        |--------------------------------------------------------------------------
        | RESPONSE
        |--------------------------------------------------------------------------
        */

        return back()->with(
            'success',
            'Request accepted. ' .
            (
                $mentorshipRequest->student->name
                ?? 'The student'
            ) .
            ' is now your active mentee — schedule the first session.'
        );
    }


    /**
     * POST /mentor/mentees/requests/{mentorshipRequest}/reject
     *
     * Reject mentorship request.
     */
    public function rejectRequest(
        MentorshipRequest $mentorshipRequest
    ) {

        /*
        |--------------------------------------------------------------------------
        | SECURITY
        |--------------------------------------------------------------------------
        */

        abort_unless(
            $mentorshipRequest->mentor_id === Auth::id(),
            403
        );


        /*
        |--------------------------------------------------------------------------
        | CHECK STATUS
        |--------------------------------------------------------------------------
        */

        abort_unless(
            $mentorshipRequest->status === 'pending',
            422,
            'Request already handled.'
        );


        /*
        |--------------------------------------------------------------------------
        | REJECT
        |--------------------------------------------------------------------------
        */

        $mentorshipRequest->update([
            'status' => 'rejected',
        ]);


        /*
        |--------------------------------------------------------------------------
        | TODO
        |--------------------------------------------------------------------------
        |
        | Notify student by email / notification.
        |
        */


        return back()->with(
            'success',
            'Request rejected.'
        );
    }


    /**
     * POST /mentor/mentees/requests/{mentorshipRequest}/suggest-time
     *
     * Mentor suggests another session time.
     */
    public function suggestTime(
        Request $request,
        MentorshipRequest $mentorshipRequest
    ) {

        /*
        |--------------------------------------------------------------------------
        | SECURITY
        |--------------------------------------------------------------------------
        */

        abort_unless(
            $mentorshipRequest->mentor_id === Auth::id(),
            403
        );


        /*
        |--------------------------------------------------------------------------
        | CHECK STATUS
        |--------------------------------------------------------------------------
        */

        abort_unless(
            $mentorshipRequest->status === 'pending',
            422,
            'Request already handled.'
        );


        /*
        |--------------------------------------------------------------------------
        | VALIDATE
        |--------------------------------------------------------------------------
        */

        $data = $request->validate([
            'suggested_date' => [
                'required',
                'date',
                'after_or_equal:today',
            ],

            'suggested_time' => [
                'required',
                'string',
                'max:100',
            ],

            'suggestion_note' => [
                'nullable',
                'string',
                'max:1000',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | SAVE SUGGESTION
        |--------------------------------------------------------------------------
        */

        $mentorshipRequest->update([
            'status' => 'time_suggested',

            'suggested_date' =>
                $data['suggested_date'],

            'suggested_time' =>
                $data['suggested_time'],

            'suggestion_note' =>
                $data['suggestion_note'] ?? null,
        ]);


        /*
        |--------------------------------------------------------------------------
        | RESPONSE
        |--------------------------------------------------------------------------
        */

        return back()->with(
            'success',
            'Alternative time sent to the student for their response.'
        );
    }
}