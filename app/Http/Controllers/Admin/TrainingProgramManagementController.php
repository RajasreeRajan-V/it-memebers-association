<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TrainingProgram;
use Illuminate\Http\Request;

class TrainingProgramManagementController extends Controller
{
    /**
     * List all submitted training programs, filterable by status.
     */
    public function index(Request $request)
    {
        $trainings = TrainingProgram::with('mentor')
            ->withCount(['modules', 'materials'])
            ->when($request->status, fn ($q) => $q->where('status', $request->status))
            ->when($request->q, fn ($q) => $q->where('title', 'like', "%{$request->q}%"))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        $counts = [
            'pending'   => TrainingProgram::where('status', TrainingProgram::STATUS_PENDING)->count(),
            'approved'  => TrainingProgram::where('status', TrainingProgram::STATUS_APPROVED)->count(),
            'published' => TrainingProgram::where('status', TrainingProgram::STATUS_PUBLISHED)->count(),
            'rejected'  => TrainingProgram::where('status', TrainingProgram::STATUS_REJECTED)->count(),
        ];

        return view('admin.trainings.index', compact('trainings', 'counts'));
    }

    /**
     * Full review page: modules, materials, learning outcomes, mentor details.
     */
    public function show(TrainingProgram $training)
    {
        $training->load(['mentor', 'modules.materials']);

        $materialCounts = $training->materials()
            ->selectRaw('training_materials.type, count(*) as total')
            ->groupBy('training_materials.type')
            ->pluck('total', 'type');

        return view('admin.trainings.show', compact('training', 'materialCounts'));
    }

    /**
     * Approve a pending submission — does NOT make it live yet.
     */
    public function approve(TrainingProgram $training)
    {
        abort_unless($training->status === TrainingProgram::STATUS_PENDING, 422, 'Only pending trainings can be approved.');

        $training->update([
            'status'         => TrainingProgram::STATUS_APPROVED,
            'admin_feedback' => null,
        ]);

        return back()->with('success', 'Training approved. You can now publish it.');
    }

    /**
     * Reject a pending submission with required feedback for the mentor.
     */
    public function reject(Request $request, TrainingProgram $training)
    {
        abort_unless($training->status === TrainingProgram::STATUS_PENDING, 422, 'Only pending trainings can be rejected.');

        $data = $request->validate([
            'admin_feedback' => ['required', 'string', 'max:2000'],
        ]);

        $training->update([
            'status'         => TrainingProgram::STATUS_REJECTED,
            'admin_feedback' => $data['admin_feedback'],
        ]);

        return back()->with('success', 'Training rejected and feedback sent to mentor.');
    }

    /**
     * Publish an approved training — makes it visible to learners.
     */
    public function publish(TrainingProgram $training)
    {
        abort_unless($training->status === TrainingProgram::STATUS_APPROVED, 422, 'Only approved trainings can be published.');

        $training->update(['status' => TrainingProgram::STATUS_PUBLISHED]);

        return back()->with('success', 'Training published successfully.');
    }

    /**
     * Pull a live training back down.
     */
    public function unpublish(TrainingProgram $training)
    {
        abort_unless($training->status === TrainingProgram::STATUS_PUBLISHED, 422, 'Only published trainings can be unpublished.');

        $training->update(['status' => TrainingProgram::STATUS_ARCHIVED]);

        return back()->with('success', 'Training unpublished and archived.');
    }
}