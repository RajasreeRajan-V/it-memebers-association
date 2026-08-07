<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MentorMentee;
use App\Models\MentorshipSession;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MentorshipManagementController extends Controller
{
    // Assign mentors, monitor all assignments + progress
    public function index(Request $request)
    {
        $assignments = MentorMentee::with(['mentor', 'student', 'sessions'])
            ->when($request->status, fn ($q) => $q->where('status', $request->status))
            ->latest()
            ->paginate(15);

        $mentors = User::where('role', 'mentor')->orderBy('name')->get();
        $students = User::where('role', 'student')->orderBy('name')->get();

        return view('admin.mentorship.index', compact('assignments', 'mentors', 'students'));
    }

    // Assign a mentor to a student
    public function assign(Request $request)
    {
        $data = $request->validate([
            'mentor_id' => ['required', 'exists:users,id'],
            'student_id' => ['required', 'exists:users,id'],
            'admin_notes' => ['nullable', 'string'],
        ]);

        MentorMentee::firstOrCreate(
            ['mentor_id' => $data['mentor_id'], 'student_id' => $data['student_id']],
            [
                'assigned_by' => Auth::guard('admin')->id(),
                'admin_notes' => $data['admin_notes'] ?? null,
                'status' => 'active',
                'assigned_at' => now(),
            ]
        );

        return back()->with('success', 'Mentor assigned to student.');
    }

    public function updateStatus(Request $request, MentorMentee $assignment)
    {
        $data = $request->validate([
            'status' => ['required', 'in:active,paused,completed'],
        ]);

        $assignment->update($data);

        return back()->with('success', 'Assignment status updated.');
    }

    // View all sessions for progress monitoring
    public function sessions(MentorMentee $assignment)
    {
        $assignment->load(['mentor', 'student', 'sessions' => fn ($q) => $q->orderByDesc('scheduled_at')]);

        return view('admin.mentorship.sessions', compact('assignment'));
    }

    public function destroy(MentorMentee $assignment)
    {
        $assignment->delete();

        return back()->with('success', 'Assignment removed.');
    }
}
