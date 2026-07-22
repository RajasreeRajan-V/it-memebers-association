<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\Internship;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InternshipController extends Controller
{
    public function index(Request $request)
    {
        $internships = Internship::where('employer_id', Auth::id())
            ->when($request->search, function ($query, $search) {
                $query->where('title', 'like', "%{$search}%");
            })
            ->when($request->status, function ($query, $status) {
                $query->where('status', $status);
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('employers.internships.index', compact('internships'));
    }

    public function create()
    {
        return view('employers.internships.create');
    }

    public function store(Request $request)
    {
        $data = $this->validateInternship($request);
        $data['employer_id'] = Auth::id();
        $data['status'] = 'active';

        Internship::create($data);

        return redirect()->route('employer.internships.index')
            ->with('success', 'Internship posted successfully.');
    }

    public function show(Internship $internship)
    {
        $this->authorizeOwner($internship);

        return view('employers.internships.show', compact('internship'));
    }

    public function edit(Internship $internship)
    {
        $this->authorizeOwner($internship);

        return view('employers.internships.edit', compact('internship'));
    }

    public function update(Request $request, Internship $internship)
    {
        $this->authorizeOwner($internship);

        $data = $this->validateInternship($request);
        $internship->update($data);

        return redirect()->route('employer.internships.index')
            ->with('success', 'Internship updated successfully.');
    }

    public function destroy(Internship $internship)
    {
        $this->authorizeOwner($internship);

        $internship->delete();

        return redirect()->route('employer.internships.index')
            ->with('success', 'Internship deleted successfully.');
    }

    private function validateInternship(Request $request): array
    {
        return $request->validate([
            'title'            => ['required', 'string', 'max:255'],
            'internship_type'  => ['required', 'in:paid,unpaid,stipend'],
            'work_mode'        => ['required', 'in:onsite,hybrid,remote'],
            'duration'         => ['required', 'string', 'max:100'],
            'stipend'          => ['nullable', 'string', 'max:100'],
            'start_date'       => ['nullable', 'date'],
            'end_date'         => ['nullable', 'date', 'after:start_date'],
            'positions'        => ['nullable', 'integer', 'min:1'],
            'qualification'    => ['nullable', 'string', 'max:255'],
            'skills'           => ['nullable', 'string', 'max:500'],
            'country'          => ['nullable', 'string', 'max:100'],
            'state'            => ['required', 'string', 'max:100'],
            'district'         => ['required', 'string', 'max:100'],
            'city'             => ['required', 'string', 'max:100'],
            'description'      => ['required', 'string'],
        ]);
    }

    private function authorizeOwner(Internship $internship): void
    {
        abort_if($internship->employer_id !== Auth::id(), 403, 'You do not have access to this internship.');
    }
}
