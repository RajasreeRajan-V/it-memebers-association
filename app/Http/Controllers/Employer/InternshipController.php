<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\Internship;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InternshipController extends Controller
{
    public function index()
    {
        $internships = Internship::where('employer_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('employers.internships.index', compact('internships'));
    }

    public function create()
    {
        return view('employers.internships.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validateInternship($request);
        $validated['employer_id'] = Auth::id();
        $validated['status'] = 'pending';

        Internship::create($validated);

        return redirect()
            ->route('employer.internships.index')
            ->with('success', 'Internship submitted successfully and is awaiting admin approval.');
    }

    public function edit(Internship $internship)
    {
        $this->authorizeOwner($internship);

        return view('employers.internships.edit', compact('internship'));
    }

    public function update(Request $request, Internship $internship)
    {
        $this->authorizeOwner($internship);

        $validated = $this->validateInternship($request);
        $validated['status'] = 'pending';
        $validated['rejection_reason'] = null;

        $internship->update($validated);

        return redirect()
            ->route('employer.internships.index')
            ->with('success', 'Internship updated successfully and is awaiting admin approval.');
    }

    public function destroy(Internship $internship)
    {
        $this->authorizeOwner($internship);
        $internship->delete();

        return redirect()
            ->route('employer.internships.index')
            ->with('success', 'Internship deleted.');
    }

    private function validateInternship(Request $request): array
    {
        return $request->validate([
            'title'            => ['required', 'string', 'max:255'],
            'internship_type'  => ['required', 'in:full-time,part-time,remote,hybrid,on-site'],
            'country'          => ['nullable', 'string', 'max:100'],
            'state'            => ['nullable', 'string', 'max:100'],
            'city'             => ['nullable', 'string', 'max:100'],
            'description'      => ['required', 'string'],
            'duration'         => ['required', 'string', 'max:100'],
            'stipend'          => ['nullable', 'string', 'max:100'],
        ]);
    }

    private function authorizeOwner(Internship $internship): void
    {
        abort_unless($internship->employer_id === Auth::id(), 403);
    }
}
