<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ResumeReview;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResumeReviewManagementController extends Controller
{
    // Track all resume reviews and their completion status
    public function index(Request $request)
    {
        $reviews = ResumeReview::with(['student', 'mentor'])
            ->when($request->status, fn ($q) => $q->where('status', $request->status))
            ->latest()
            ->paginate(15);

        $mentors = User::where('role', 'mentor')->orderBy('name')->get();

        return view('admin.resume-reviews.index', compact('reviews', 'mentors'));
    }

    // Assign a resume (already uploaded by student) to a mentor
    public function assign(Request $request, ResumeReview $review)
    {
        $data = $request->validate([
            'mentor_id' => ['required', 'exists:users,id'],
        ]);

        $review->update([
            'mentor_id' => $data['mentor_id'],
            'assigned_by' => Auth::guard('admin')->id(),
            'status' => 'assigned',
        ]);

        return back()->with('success', 'Resume assigned to mentor.');
    }
}
