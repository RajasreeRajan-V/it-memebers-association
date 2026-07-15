<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\Internship;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class InternshipController extends Controller
{
    /**
     * Display a listing of the employer's internships.
     */
    public function index()
    {
        $internships = Internship::where('employer_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('employers.internships.create', compact('internships'));
    }

    /**
     * Show the form for creating a new internship.
     */
    public function create()
    {
        return view('employers.internships.create');
    }

    /**
     * Store a newly created internship in storage.
     */
    public function store(Request $request)
    {
        Log::info('Internship creation attempt', ['data' => $request->all()]);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'internship_type' => 'required|in:paid,unpaid,stipend',
            'work_mode' => 'required|in:onsite,hybrid,remote',
            'duration' => 'required|string|max:255',
            'stipend' => 'nullable|string|max:255',
            'qualification' => 'nullable|string|max:255',
            'skills' => 'nullable|string|max:500',
            'country' => 'nullable|string|max:255',
            'state' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after:start_date',
            'positions' => 'nullable|integer|min:1',
        ]);

        try {
            // Process skills
            $skills = [];
            if ($request->skills) {
                $skills = array_map('trim', explode(',', $request->skills));
                $skills = array_filter($skills);
            }

            $internship = Internship::create([
                'employer_id' => Auth::id(),
                'title' => $validated['title'],
                'internship_type' => $validated['internship_type'],
                'work_mode' => $validated['work_mode'],
                'duration' => $validated['duration'],
                'stipend' => $validated['stipend'] ?? null,
                'qualification' => $validated['qualification'] ?? null,
                'skills' => $skills,
                'country' => $validated['country'] ?? null,
                'state' => $validated['state'],
                'district' => $validated['district'],
                'city' => $validated['city'],
                'description' => $validated['description'],
                'start_date' => $validated['start_date'] ?? null,
                'end_date' => $validated['end_date'] ?? null,
                'positions' => $validated['positions'] ?? 1,
                'status' => 'pending',
            ]);

            Log::info('Internship created successfully', ['internship_id' => $internship->id]);

            return redirect()
                ->route('employer.internships.index')
                ->with('success', 'Internship posted successfully! It will be visible after admin approval.');

        } catch (\Exception $e) {
            Log::error('Error creating internship: ' . $e->getMessage());
            
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Failed to create internship. Please try again.');
        }
    }

    /**
     * Display the specified internship.
     */
    public function show($id)
    {
        $internship = Internship::where('employer_id', Auth::id())
            ->findOrFail($id);
            
        return view('employer.internships.show', compact('internship'));
    }

    /**
     * Show the form for editing the specified internship.
     */
    public function edit($id)
    {
        $internship = Internship::where('employer_id', Auth::id())
            ->findOrFail($id);
            
        return view('employer.internships.edit', compact('internship'));
    }

    /**
     * Update the specified internship in storage.
     */
    public function update(Request $request, $id)
    {
        $internship = Internship::where('employer_id', Auth::id())
            ->findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'internship_type' => 'required|in:paid,unpaid,stipend',
            'work_mode' => 'required|in:onsite,hybrid,remote',
            'duration' => 'required|string|max:255',
            'stipend' => 'nullable|string|max:255',
            'qualification' => 'nullable|string|max:255',
            'skills' => 'nullable|string|max:500',
            'country' => 'nullable|string|max:255',
            'state' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after:start_date',
            'positions' => 'nullable|integer|min:1',
        ]);

        try {
            $skills = [];
            if ($request->skills) {
                $skills = array_map('trim', explode(',', $request->skills));
                $skills = array_filter($skills);
            }

            $internship->update([
                'title' => $validated['title'],
                'internship_type' => $validated['internship_type'],
                'work_mode' => $validated['work_mode'],
                'duration' => $validated['duration'],
                'stipend' => $validated['stipend'] ?? null,
                'qualification' => $validated['qualification'] ?? null,
                'skills' => $skills,
                'country' => $validated['country'] ?? null,
                'state' => $validated['state'],
                'district' => $validated['district'],
                'city' => $validated['city'],
                'description' => $validated['description'],
                'start_date' => $validated['start_date'] ?? null,
                'end_date' => $validated['end_date'] ?? null,
                'positions' => $validated['positions'] ?? 1,
                'status' => 'pending',
            ]);

            return redirect()
                ->route('employer.internships.index')
                ->with('success', 'Internship updated successfully! It will be reviewed again.');

        } catch (\Exception $e) {
            Log::error('Error updating internship: ' . $e->getMessage());
            
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Failed to update internship. Please try again.');
        }
    }

    /**
     * Remove the specified internship from storage.
     */
    public function destroy($id)
    {
        try {
            $internship = Internship::where('employer_id', Auth::id())
                ->findOrFail($id);
            
            $internship->delete();

            return redirect()
                ->route('employer.internships.index')
                ->with('success', 'Internship deleted successfully.');

        } catch (\Exception $e) {
            Log::error('Error deleting internship: ' . $e->getMessage());
            
            return redirect()
                ->back()
                ->with('error', 'Failed to delete internship. Please try again.');
        }
    }
}