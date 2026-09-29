<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Training;
use Illuminate\Http\Request;

class TrainingController extends Controller
{
    /**
     * List all published trainings visible to employees.
     */
    public function index(Request $request)
    {
        $query = Training::where('status', Training::STATUS_PUBLISHED)
            ->latest();

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('technology')) {
            $query->where('technology', $request->technology);
        }

        if ($request->filled('level')) {
            $query->where('level', $request->level);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('short_description', 'like', "%{$search}%");
            });
        }

        $trainings = $query->paginate(3)->withQueryString();

        return view('employees.trainings.index', compact('trainings'));
    }

    /**
     * Show a single published training (employee view).
     */
    public function show(Training $training)
    {
        abort_unless($training->status === Training::STATUS_PUBLISHED, 404);

        $training->load(['outcomes', 'requirements', 'modules.sessions', 'resources']);

        return view('employees.trainings.show', compact('training'));
    }
}