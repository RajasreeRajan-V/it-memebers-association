<?php

namespace App\Http\Controllers\Mentor;

use App\Http\Controllers\Controller;
use App\Models\Training;
use App\Models\TrainingModule;
use App\Models\TrainingSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TrainingController extends Controller
{
    /**
     * List all trainings created by the logged-in mentor.
     */
    public function index()
    {
        $trainings = Training::forMentor(Auth::id())
            ->latest()
            ->paginate(10);

        return view('mentor.trainings.index', compact('trainings'));
    }

    /**
     * Show the "Create Training" form.
     */
    public function create()
    {
        $training = new Training();
        return view('mentor.trainings.create', compact('training'));
    }

    /**
     * Store a new training.
     * $request->input('action') = 'draft' | 'submit'
     */
    public function store(Request $request)
    {
        $data = $this->validateTraining($request);

        $data['mentor_id'] = Auth::id();
        $data['status']    = $request->input('action') === 'submit'
            ? Training::STATUS_PENDING_APPROVAL
            : Training::STATUS_DRAFT;

        if ($data['status'] === Training::STATUS_PENDING_APPROVAL) {
            $data['submitted_at'] = now();
        }

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('trainings/thumbnails', 'public');
        }

        $training = Training::create($data);

        $this->syncOutcomes($training, $request->input('outcomes', []));
        $this->syncRequirements($training, $request->input('requirements', []));
        $this->syncCurriculum($training, $request->input('modules', []), $request);
        $this->syncResources($training, $request);

        $message = $data['status'] === Training::STATUS_PENDING_APPROVAL
            ? 'Training submitted for admin approval.'
            : 'Training saved as draft.';

        return redirect()->route('mentor.trainings.index')->with('success', $message);
    }

    /**
     * Show a single training (mentor preview).
     */
    public function show(Training $training)
    {
        $this->authorizeOwner($training);
        $training->load(['outcomes', 'requirements', 'modules.sessions', 'resources']);

        return view('mentor.trainings.show', compact('training'));
    }

    /**
     * Show edit form (only draft / rejected trainings are editable).
     */
    public function edit(Training $training)
    {
        $this->authorizeOwner($training);

        if (!$training->isEditableByMentor()) {
            return back()->with('error', 'Only draft or rejected trainings can be edited.');
        }

        $training->load(['outcomes', 'requirements', 'modules.sessions', 'resources']);

        return view('mentor.trainings.edit', compact('training'));
    }

    /**
     * Update a training (draft or resubmit after rejection).
     */
    public function update(Request $request, Training $training)
    {
        $this->authorizeOwner($training);

        if (!$training->isEditableByMentor()) {
            return back()->with('error', 'Only draft or rejected trainings can be edited.');
        }

        $data = $this->validateTraining($request);

        $data['status'] = $request->input('action') === 'submit'
            ? Training::STATUS_PENDING_APPROVAL
            : Training::STATUS_DRAFT;

        if ($data['status'] === Training::STATUS_PENDING_APPROVAL) {
            $data['submitted_at']     = now();
            $data['rejection_reason'] = null; // clear old rejection reason on resubmit
        }

        if ($request->hasFile('thumbnail')) {
            if ($training->thumbnail) {
                Storage::disk('public')->delete($training->thumbnail);
            }
            $data['thumbnail'] = $request->file('thumbnail')->store('trainings/thumbnails', 'public');
        }

        $training->update($data);

        $this->syncOutcomes($training, $request->input('outcomes', []));
        $this->syncRequirements($training, $request->input('requirements', []));
        $this->syncCurriculum($training, $request->input('modules', []), $request);
        $this->syncResources($training, $request);

        $message = $data['status'] === Training::STATUS_PENDING_APPROVAL
            ? 'Training resubmitted for admin approval.'
            : 'Training updated and saved as draft.';

        return redirect()->route('mentor.trainings.index')->with('success', $message);
    }

    /**
     * Explicit "Submit for Admin Approval" action from an existing draft/rejected training.
     */
    public function submit(Training $training)
    {
        $this->authorizeOwner($training);

        if (!$training->isEditableByMentor()) {
            return back()->with('error', 'This training cannot be submitted in its current state.');
        }

        $training->update([
            'status'           => Training::STATUS_PENDING_APPROVAL,
            'submitted_at'     => now(),
            'rejection_reason' => null,
        ]);

        return back()->with('success', 'Training submitted for admin approval.');
    }

    /**
     * Delete a training (only drafts).
     */
    public function destroy(Training $training)
    {
        $this->authorizeOwner($training);

        if ($training->status !== Training::STATUS_DRAFT) {
            return back()->with('error', 'Only draft trainings can be deleted.');
        }

        if ($training->thumbnail) {
            Storage::disk('public')->delete($training->thumbnail);
        }

        $training->delete();

        return redirect()->route('mentor.trainings.index')->with('success', 'Training deleted.');
    }

    /* ---------------------------------------------------------------- */
    /*  Helpers                                                          */
    /* ---------------------------------------------------------------- */

    protected function authorizeOwner(Training $training): void
    {
        abort_unless($training->mentor_id === Auth::id(), 403);
    }

    protected function validateTraining(Request $request): array
    {
        return $request->validate([
            // 1. Basic Information
            'title'              => 'required|string|max:255',
            'short_description'  => 'required|string|max:500',
            'full_description'   => 'required|string',
            'category'           => 'required|string|max:100',
            'technology'         => 'required|string|max:100',
            'level'              => 'required|in:beginner,intermediate,advanced',
            'training_type'      => 'required|in:recorded,live,hybrid',
            'thumbnail'          => 'nullable|image|max:2048',

            // 2. Training Details
            'duration'           => 'nullable|string|max:100',
            'total_sessions'     => 'nullable|integer|min:1',
            'session_duration'   => 'nullable|string|max:100',
            'start_date'         => 'nullable|date',
            'end_date'           => 'nullable|date|after_or_equal:start_date',
            'max_participants'   => 'nullable|integer|min:1',
            'language'           => 'required|string|max:100',

            // 7. Live Training Details
            'platform'           => 'nullable|string|max:100',
            'meeting_link'       => 'nullable|url|max:255',
            'schedule'           => 'nullable|string|max:255',

            // 9. Certificate
            'certificate_enabled' => 'nullable|boolean',
        ]);
    }

    protected function syncOutcomes(Training $training, array $outcomes): void
    {
        $training->outcomes()->delete();
        foreach (array_values(array_filter($outcomes)) as $i => $outcome) {
            $training->outcomes()->create(['outcome' => $outcome, 'order' => $i]);
        }
    }

    protected function syncRequirements(Training $training, array $requirements): void
    {
        $training->requirements()->delete();
        foreach (array_values(array_filter($requirements)) as $i => $requirement) {
            $training->requirements()->create(['requirement' => $requirement, 'order' => $i]);
        }
    }

    /**
     * $modules = [
     *   ['title' => '...', 'sessions' => [['title' => '', 'description' => ''], ...]],
     *   ...
     * ]
     * Files come in as modules[<i>][sessions][<j>][video] / [pdf]
     */
    protected function syncCurriculum(Training $training, array $modules, Request $request): void
    {
        // wipe old curriculum (cascade deletes sessions)
        $training->modules()->delete();

        foreach ($modules as $mi => $moduleData) {
            if (empty($moduleData['title'])) {
                continue;
            }

            /** @var TrainingModule $module */
            $module = $training->modules()->create([
                'title' => $moduleData['title'],
                'order' => $mi,
            ]);

            foreach (($moduleData['sessions'] ?? []) as $si => $sessionData) {
                if (empty($sessionData['title'])) {
                    continue;
                }

                $videoPath = null;
                $pdfPath   = null;

                $videoFile = $request->file("modules.$mi.sessions.$si.video");
                $pdfFile   = $request->file("modules.$mi.sessions.$si.pdf");

                if ($videoFile) {
                    $videoPath = $videoFile->store('trainings/videos', 'public');
                }
                if ($pdfFile) {
                    $pdfPath = $pdfFile->store('trainings/session-pdfs', 'public');
                }

                $module->sessions()->create([
                    'title'       => $sessionData['title'],
                    'description' => $sessionData['description'] ?? null,
                    'video_path'  => $videoPath,
                    'pdf_path'    => $pdfPath,
                    'order'       => $si,
                ]);
            }
        }
    }

    protected function syncResources(Training $training, Request $request): void
    {
        if (!$request->hasFile('resources')) {
            return;
        }

        foreach ($request->file('resources') as $file) {
            $path = $file->store('trainings/resources', 'public');
            $ext  = strtolower($file->getClientOriginalExtension());

            $training->resources()->create([
                'title'     => $file->getClientOriginalName(),
                'file_path' => $path,
                'type'      => $ext === 'pdf' ? 'pdf' : 'document',
            ]);
        }
    }
}
