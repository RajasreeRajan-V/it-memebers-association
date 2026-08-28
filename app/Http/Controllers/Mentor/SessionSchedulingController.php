<?php

namespace App\Http\Controllers\Mentor;

use App\Http\Controllers\Controller;
use App\Models\Mentorship;
use App\Models\MentorshipSession;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SessionSchedulingController extends Controller
{
    /**
     * GET /mentor/mentees/{mentee}/sessions/create
     * Schedule Session form
     */
    public function create(Mentorship $mentee)
    {
        abort_unless($mentee->mentor_id === Auth::id(), 403);

        abort_unless(
            $mentee->status === 'active',
            422,
            'Mentorship is not active.'
        );

        $mentee->load('student');

        return view('mentor.sessions.create', [
            'mentorship' => $mentee,
        ]);
    }

    /**
     * POST /mentor/mentees/{mentee}/sessions
     *
     * Create a new mentorship session.
     */
    public function store(Request $request, Mentorship $mentee)
    {
        abort_unless($mentee->mentor_id === Auth::id(), 403);

        abort_unless(
            $mentee->status === 'active',
            422,
            'Mentorship is not active.'
        );

        /*
        |--------------------------------------------------------------------------
        | VALIDATION
        |--------------------------------------------------------------------------
        */

        $data = $request->validate([
            'topic' => [
                'required',
                'string',
                'max:255',
            ],

            'session_date' => [
                'required',
                'date',
                'after_or_equal:today',
            ],

            'start_time' => [
                'required',
                'date_format:H:i',
            ],

            'duration_minutes' => [
                'required',
                'integer',
                'in:30,60,90',
            ],

            'meeting_type' => [
                'required',
                'in:online,offline',
            ],

            'meeting_link' => [
                'nullable',
                'url',
                'max:2048',
            ],

            'agenda' => [
                'nullable',
                'string',
                'max:2000',
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | ONLINE SESSION MUST HAVE A MEETING LINK
        |--------------------------------------------------------------------------
        */

        if (
            $data['meeting_type'] === 'online' &&
            empty($data['meeting_link'])
        ) {
            throw ValidationException::withMessages([
                'meeting_link' => 'Please add a meeting link for the online session.',
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | CREATE START / END TIME
        |--------------------------------------------------------------------------
        */

        $startsAt = Carbon::parse(
            $data['session_date'] . ' ' . $data['start_time']
        );

        $endsAt = $startsAt->copy()->addMinutes(
            (int) $data['duration_minutes']
        );

        /*
        |--------------------------------------------------------------------------
        | DOUBLE-BOOKING CHECK
        |--------------------------------------------------------------------------
        */

        $conflict = MentorshipSession::overlappingForMentor(
            Auth::id(),
            $startsAt,
            $endsAt
        )->first();

        if ($conflict) {
            throw ValidationException::withMessages([
                'slot' => sprintf(
                    'You already have a session with %s from %s to %s that overlaps this time. Pick a different slot.',
                    $conflict->student->name ?? 'another mentee',
                    $conflict->starts_at->format('d M, h:i A'),
                    $conflict->ends_at->format('h:i A')
                ),
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | CREATE SESSION
        |--------------------------------------------------------------------------
        */

        $session = MentorshipSession::create([
            'mentorship_id' => $mentee->id,
            'mentor_id' => $mentee->mentor_id,
            'student_id' => $mentee->student_id,

            'topic' => $data['topic'],

            'session_date' => $data['session_date'],
            'start_time' => $data['start_time'],

            'duration_minutes' => $data['duration_minutes'],

            'starts_at' => $startsAt,
            'ends_at' => $endsAt,

            'meeting_type' => $data['meeting_type'],

            /*
             * Mentor manually enters the meeting link.
             * Offline sessions don't store a link.
             */
            'meeting_link' => $data['meeting_type'] === 'online'
                ? $data['meeting_link']
                : null,

            'agenda' => $data['agenda'] ?? null,

            'status' => 'scheduled',
        ]);

        /*
        |--------------------------------------------------------------------------
        | TODO: SEND EMAIL / NOTIFICATION
        |--------------------------------------------------------------------------
        */

        // TODO:
        // Send "Session Confirmed" notification/email to student.

        /*
        |--------------------------------------------------------------------------
        | REDIRECT
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('mentor.mentees.show', $mentee)
            ->with(
                'success',
                'Session scheduled for ' .
                $startsAt->format('d M Y, h:i A') .
                '.'
            );
    }

    /**
     * POST /mentor/sessions/{session}/reschedule
     *
     * Reschedule an existing session.
     */
    public function reschedule(
        Request $request,
        MentorshipSession $session
    ) {
        abort_unless(
            $session->mentor_id === Auth::id(),
            403
        );

        abort_unless(
            in_array(
                $session->status,
                ['scheduled', 'confirmed']
            ),
            422,
            'Session cannot be rescheduled.'
        );

        /*
        |--------------------------------------------------------------------------
        | VALIDATION
        |--------------------------------------------------------------------------
        */

        $data = $request->validate([
            'session_date' => [
                'required',
                'date',
                'after_or_equal:today',
            ],

            'start_time' => [
                'required',
                'date_format:H:i',
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | NEW START / END TIME
        |--------------------------------------------------------------------------
        */

        $startsAt = Carbon::parse(
            $data['session_date'] . ' ' . $data['start_time']
        );

        $endsAt = $startsAt->copy()->addMinutes(
            $session->duration_minutes
        );

        /*
        |--------------------------------------------------------------------------
        | DOUBLE-BOOKING CHECK
        |--------------------------------------------------------------------------
        */

        $conflict = MentorshipSession::overlappingForMentor(
            Auth::id(),
            $startsAt,
            $endsAt,
            ignoreSessionId: $session->id
        )->first();

        if ($conflict) {
            throw ValidationException::withMessages([
                'slot' =>
                    'That new time overlaps another session you already have scheduled.',
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | UPDATE SESSION
        |--------------------------------------------------------------------------
        */

        $session->update([
            'session_date' => $data['session_date'],
            'start_time' => $data['start_time'],

            'starts_at' => $startsAt,
            'ends_at' => $endsAt,

            /*
             * Re-open as a newly scheduled session.
             */
            'status' => 'scheduled',
        ]);

        return back()->with(
            'success',
            'Session rescheduled.'
        );
    }

   
    public function cancel(MentorshipSession $session)
    {
        abort_unless(
            $session->mentor_id === Auth::id() ||
            $session->student_id === Auth::id(),
            403
        );

        abort_unless(
            in_array(
                $session->status,
                ['scheduled', 'confirmed']
            ),
            422
        );

        $session->update([
            'status' => 'cancelled',
        ]);

        return back()->with(
            'success',
            'Session cancelled. This slot is now free.'
        );
    }
}