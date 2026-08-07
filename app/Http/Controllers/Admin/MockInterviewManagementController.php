<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MockInterview;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MockInterviewManagementController extends Controller
{
    // Assign interviews, monitor schedules, store feedback
    public function index(Request $request)
    {
        $interviews = MockInterview::with(['student', 'mentor'])
            ->when($request->status, fn ($q) => $q->where('status', $request->status))
            ->latest()
            ->paginate(15);

        $mentors = User::where('role', 'mentor')->orderBy('name')->get();
        $students = User::where('role', 'student')->orderBy('name')->get();

        return view('admin.mock-interviews.index', compact('interviews', 'mentors', 'students'));
    }

    public function assign(Request $request)
    {
        $data = $request->validate([
            'mentor_id' => ['required', 'exists:users,id'],
            'student_id' => ['required', 'exists:users,id'],
        ]);

        MockInterview::create([
            'mentor_id' => $data['mentor_id'],
            'student_id' => $data['student_id'],
            'assigned_by' => Auth::guard('admin')->id(),
            'status' => 'assigned',
        ]);

        return back()->with('success', 'Mock interview assigned to mentor.');
    }

    // Read-only view of the feedback/evaluation the mentor submitted
    public function show(MockInterview $interview)
    {
        $interview->load(['student', 'mentor']);

        return view('admin.mock-interviews.show', compact('interview'));
    }
}
