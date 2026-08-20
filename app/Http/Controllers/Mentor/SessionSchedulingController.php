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
     * POST /mentor/mentees/{mentee}/sessions
     *
     * "session create aakumbo, oru mentor-inu aa time-il vere session
     *  undayirikkilla ennu check cheyyanam" — i.e. prevent double-booking.
     *
     * We convert date + time + duration into a [starts_at, ends_at) window
     * and check it against every other ACTIVE session this mentor already
     * has, using an overlap query (see MentorshipSession::scopeOverlappingForMentor).
     */
    public function store(Request $request, Mentorship $mentee)
    {
        abort_unless($mentee->mentor_id === Auth::id(), 403);
        abort_unless($mentee->status === 'active', 422, 'Mentorship is not active.');

        $data = $request->validate([
            'topic'            => ['required', 'string', 'max:255'],
            'session_date'     => ['required', 'date', 'after_or_equal:today'],
            'start_time'       => ['required', 'date_format:H:i'],
            'duration_minutes' => ['required', 'integer', 'in:30,60,90'],
            'meeting_type'     => ['required', 'in:online,offline'],
            'agenda'           => ['nullable', 'string', 'max:2000'],
        ]);

        $startsAt = Carbon::parse($data['session_date'] . ' ' . $data['start_time']);
        $endsAt   = $startsAt->copy()->addMinutes((int) $data['duration_minutes']);

        // ---- THE DOUBLE-BOOKING CHECK ----
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
                    $conflict->ends_at->format('h:i A'),
                ),
            ]);
        }
        // -----------------------------------

        $session = MentorshipSession::create([
            'mentorship_id'    => $mentee->id,
            'mentor_id'        => $mentee->mentor_id,
            'student_id'       => $mentee->student_id,
            'topic'            => $data['topic'],
            'session_date'     => $data['session_date'],
            'start_time'       => $data['start_time'],
            'duration_minutes' => $data['duration_minutes'],
            'starts_at'        => $startsAt,
            'ends_at'          => $endsAt,
            'meeting_type'     => $data['meeting_type'],
            'meeting_link'     => $data['meeting_type'] === 'online' ? $this->generateMeetingLink() : null,
            'agenda'           => $data['agenda'] ?? null,
            'status'           => 'scheduled',
        ]);

        return back()->with('success', 'Session scheduled for ' . $startsAt->format('d M Y, h:i A') . '.');
    }

    /**
     * Reschedule an existing session — same conflict check, but excluding itself.
     * POST /mentor/sessions/{session}/reschedule
     */
    public function reschedule(Request $request, MentorshipSession $session)
    {
        abort_unless($session->mentor_id === Auth::id(), 403);
        abort_unless(in_array($session->status, ['scheduled', 'confirmed']), 422, 'Session cannot be rescheduled.');

        $data = $request->validate([
            'session_date' => ['required', 'date', 'after_or_equal:today'],
            'start_time'   => ['required', 'date_format:H:i'],
        ]);

        $startsAt = Carbon::parse($data['session_date'] . ' ' . $data['start_time']);
        $endsAt   = $startsAt->copy()->addMinutes($session->duration_minutes);

        $conflict = MentorshipSession::overlappingForMentor(
            Auth::id(),
            $startsAt,
            $endsAt,
            ignoreSessionId: $session->id   // don't conflict with itself
        )->first();

        if ($conflict) {
            throw ValidationException::withMessages([
                'slot' => 'That new time overlaps another session you already have scheduled.',
            ]);
        }

        $session->update([
            'session_date' => $data['session_date'],
            'start_time'   => $data['start_time'],
            'starts_at'    => $startsAt,
            'ends_at'      => $endsAt,
            'status'       => 'rescheduled',
        ]);

        // Immediately re-open it as freshly scheduled at the new time.
        $session->update(['status' => 'scheduled']);

        return back()->with('success', 'Session rescheduled.');
    }

    public function cancel(MentorshipSession $session)
    {
        abort_unless(
            $session->mentor_id === Auth::id() || $session->student_id === Auth::id(),
            403
        );
        abort_unless(in_array($session->status, ['scheduled', 'confirmed']), 422);

        $session->update(['status' => 'cancelled']);

        return back()->with('success', 'Session cancelled. This slot is now free.');
    }

    private function generateMeetingLink(): string
    {
        return 'https://meet.example.com/' . \Illuminate\Support\Str::random(10);
    }
}
