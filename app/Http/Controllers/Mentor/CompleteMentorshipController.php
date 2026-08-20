<?php

namespace App\Http\Controllers\Mentor;

use App\Http\Controllers\Controller;
use App\Models\Mentorship;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompleteMentorshipController extends Controller
{
    // POST /mentor/mentees/{mentee}/complete
    public function complete(Request $request, Mentorship $mentee)
    {
        abort_unless($mentee->mentor_id === Auth::id(), 403);
        abort_unless($mentee->status === 'active', 422);

        $data = $request->validate([
            'completion_reason' => ['required', 'in:goals_completed,student_requested,mentor_requested,other'],
            'completion_notes'  => ['nullable', 'string', 'max:2000'],
        ]);

        $mentee->update([
            'status'            => 'completed',
            'completed_at'      => now(),
            'completion_reason' => $data['completion_reason'],
            'completion_notes'  => $data['completion_notes'] ?? null,
        ]);

        return redirect()
            ->route('mentor.mentees.index')
            ->with('success', 'Mentorship marked as completed.');
    }
}
