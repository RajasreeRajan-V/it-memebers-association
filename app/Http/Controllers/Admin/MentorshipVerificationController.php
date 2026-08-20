<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mentorship;
use App\Models\MentorshipRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MentorshipVerificationController extends Controller
{
    // GET /admin/mentorship/pending-verification
 public function pending()
{
    $requests = MentorshipRequest::where('status', 'admin_verification')
        ->with(['mentor', 'student'])
        ->latest('accepted_at')
        ->get();

    foreach ($requests as $request) {
        $request->mentor_active_count = Mentorship::where('mentor_id', $request->mentor_id)
            ->where('status', 'active')
            ->count();
    }

    return view('admin.mentorship.pending', compact('requests'));
}

    // GET /admin/mentorship/pending-verification/{mentorshipRequest}
    public function show(MentorshipRequest $mentorshipRequest)
    {
        abort_unless(
            $mentorshipRequest->status === 'admin_verification',
            404
        );

        $mentorshipRequest->load(['mentor', 'student']);

        $mentorCapacity = Mentorship::where(
            'mentor_id',
            $mentorshipRequest->mentor_id
        )
            ->where('status', 'active')
            ->count();

        return view(
            'admin.mentorship.show',
            compact('mentorshipRequest', 'mentorCapacity')
        );
    }

    // POST /admin/mentorship/{mentorshipRequest}/approve
    public function approve(MentorshipRequest $mentorshipRequest)
    {
        abort_unless(
            $mentorshipRequest->status === 'admin_verification',
            422,
            'Nothing to approve.'
        );

        DB::transaction(function () use ($mentorshipRequest) {

            $mentorshipRequest->update([
                'status'            => 'active',
                'admin_verified_at' => now(),
                'admin_id'          => Auth::id(),
            ]);

            Mentorship::create([
                'mentorship_request_id' => $mentorshipRequest->id,
                'student_id'            => $mentorshipRequest->student_id,
                'mentor_id'             => $mentorshipRequest->mentor_id,
                'career_goal'           => $mentorshipRequest->career_goal,
                'status'               => 'active',
                'progress_percent'     => 0,
                'started_at'           => now(),
            ]);
        });

        return back()->with(
            'success',
            'Mentorship approved and activated.'
        );
    }

    // POST /admin/mentorship/{mentorshipRequest}/reject
    public function reject(MentorshipRequest $mentorshipRequest)
    {
        abort_unless(
            $mentorshipRequest->status === 'admin_verification',
            422,
            'Nothing to reject.'
        );

        $mentorshipRequest->update([
            'status'   => 'admin_rejected',
            'admin_id' => Auth::id(),
        ]);

        return back()->with(
            'success',
            'Mentorship request rejected.'
        );
    }

    // GET /admin/mentorship/active
    public function active()
    {
        $mentorships = Mentorship::where('status', 'active')
            ->with(['mentor', 'student'])
            ->withCount('sessions')
            ->latest()
            ->paginate(20);

        return view(
            'admin.mentorship.active',
            compact('mentorships')
        );
    }

    // GET /admin/mentorship/active/{mentorship}
    public function activeShow(Mentorship $mentorship)
    {
        $mentorship->load([
            'mentor',
            'student',
            'sessions',
            'feedback'
        ]);

        return view(
            'admin.mentorship.active-show',
            compact('mentorship')
        );
    }
}