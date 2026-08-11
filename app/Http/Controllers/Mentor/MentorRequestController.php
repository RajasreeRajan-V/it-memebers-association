<?php
// app/Http/Controllers/Mentor/MentorRequestController.php

namespace App\Http\Controllers\Mentor;

use App\Http\Controllers\Controller;
use App\Models\MentorshipRequest;
use Illuminate\Support\Facades\Auth;

class MentorRequestController extends Controller
{
    public function index()
    {
        $requests = MentorshipRequest::with('mentee')
            ->where('mentor_id', Auth::id())
            ->where('status', 'pending')
            ->latest()
            ->paginate(10);

        return view('mentor.requests.index', compact('requests'));
    }

    public function show(MentorshipRequest $mentorshipRequest)
    {
        $this->authorizeOwnership($mentorshipRequest);

        return view('mentor.requests.show', ['mentorshipRequest' => $mentorshipRequest->load('mentee')]);
    }

    public function accept(MentorshipRequest $mentorshipRequest)
    {
        $this->authorizeOwnership($mentorshipRequest);

        $mentorshipRequest->update(['status' => 'accepted']);

        return back()->with('success', 'Request accepted.');
    }

    public function reject(MentorshipRequest $mentorshipRequest)
    {
        $this->authorizeOwnership($mentorshipRequest);

        $mentorshipRequest->update(['status' => 'rejected']);

        return back()->with('success', 'Request rejected.');
    }

    protected function authorizeOwnership(MentorshipRequest $mentorshipRequest): void
    {
        abort_unless($mentorshipRequest->mentor_id === Auth::id(), 403);
    }
}