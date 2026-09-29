<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Training;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrainingController extends Controller
{
    /**
     * List trainings pending approval (default) or filtered by status.
     */
    public function index(Request $request)
    {
        $status = $request->query('status', Training::STATUS_PENDING_APPROVAL);

        $query = Training::with('mentor')->latest();

        if ($status !== 'all') {
            $query->where('status', $status);
        }

        $trainings = $query->paginate(10)->withQueryString();

        return view('admin.trainings.index', compact('trainings', 'status'));
    }

    /**
     * Show full training details for review.
     */
    public function show(Training $training)
    {
        $training->load(['mentor', 'outcomes', 'requirements', 'modules.sessions', 'resources']);

        return view('admin.trainings.show', compact('training'));
    }

    /**
     * Approve a pending training.
     */
    public function approve(Training $training)
    {
        abort_unless($training->status === Training::STATUS_PENDING_APPROVAL, 422, 'Only pending trainings can be approved.');

        $training->update([
            'status'      => Training::STATUS_APPROVED,
            'approved_by' => Auth::id(),
            'approved_at' => now(),
        ]);

        return back()->with('success', 'Training approved. You can now publish it.');
    }

    /**
     * Reject a pending training with a reason.
     */
    public function reject(Request $request, Training $training)
    {
        abort_unless($training->status === Training::STATUS_PENDING_APPROVAL, 422, 'Only pending trainings can be rejected.');

        $request->validate([
            'rejection_reason' => 'required|string|max:1000',
        ]);

        $training->update([
            'status'            => Training::STATUS_REJECTED,
            'rejection_reason'  => $request->rejection_reason,
            'approved_by'       => Auth::id(),
        ]);

        return redirect()
            ->route('admin.trainings.index')
            ->with('success', 'Training rejected and sent back to mentor.');
    }

    /**
     * Publish an approved training so it becomes visible to students.
     */
    public function publish(Training $training)
    {
        abort_unless($training->status === Training::STATUS_APPROVED, 422, 'Only approved trainings can be published.');

        $training->update([
            'status'       => Training::STATUS_PUBLISHED,
            'published_at' => now(),
        ]);

        return redirect()
            ->route('admin.trainings.index', ['status' => 'all'])
            ->with('success', 'Training published. Now visible to students.');
    }

    /**
     * Unpublish a training (take it back off the student catalogue).
     */
    public function unpublish(Training $training)
    {
        abort_unless($training->status === Training::STATUS_PUBLISHED, 422, 'Only published trainings can be unpublished.');

        $training->update([
            'status'       => Training::STATUS_APPROVED,
            'published_at' => null,
        ]);

        return back()->with('success', 'Training unpublished.');
    }
}
