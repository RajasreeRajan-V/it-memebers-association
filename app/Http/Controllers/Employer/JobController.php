<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\JobPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    public function index(Request $request)
    {
        $jobs = JobPost::where('employer_id', Auth::id())
            ->when($request->search, function ($query, $search) {
                $query->where('title', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(4)
            ->withQueryString();

        return view('employers.jobs.index', compact('jobs'));
    }

    public function create()
    {
        return view('employers.jobs.create');
    }

    public function store(Request $request)
    {
        $data = $this->validateJob($request);
        $data['employer_id'] = Auth::id();
        $data['is_active'] = true;

        JobPost::create($data);

        return redirect()->route('employer.jobs.index')
            ->with('success', 'Job posted successfully.');
    }

    public function show(JobPost $job)
    {
        $this->authorizeOwner($job);

        return view('employers.jobs.show', compact('job'));
    }

    public function edit(JobPost $job)
    {
        $this->authorizeOwner($job);

        return view('employers.jobs.edit', compact('job'));
    }

    public function update(Request $request, JobPost $job)
    {
        $this->authorizeOwner($job);

        $data = $this->validateJob($request);

        $job->update($data);

        return redirect()->route('employer.jobs.index')
            ->with('success', 'Job updated successfully.');
    }

    /**
     * Toggle whether an employer's job listing is visible/active.
     */
    public function toggleActive(JobPost $job)
    {
        $this->authorizeOwner($job);

        $job->update(['is_active' => ! $job->is_active]);

        return back()->with(
            'success',
            $job->is_active ? 'Job marked as active.' : 'Job marked as inactive.'
        );
    }

    public function destroy(JobPost $job)
    {
        $this->authorizeOwner($job);

        $job->delete();

        return redirect()->route('employer.jobs.index')
            ->with('success', 'Job deleted successfully.');
    }

    private function validateJob(Request $request): array
{
    return $request->validate([
        // Alphabets + Numbers + Special characters
        'title' => [
            'required', 'string', 'max:255',
            'regex:/^[A-Za-z0-9\s\-&().,]+$/',
        ],

        'employment_type' => ['required', 'in:full-time,part-time,contract,freelance'],
        'work_mode'       => ['required', 'in:onsite,hybrid,remote'],

        // Alphabets + Numbers + Hyphen
        'experience' => [
            'nullable', 'string', 'max:100',
            'regex:/^[A-Za-z0-9\s-]+$/',
        ],

        // Numbers + salary symbols only (no letters)
        'salary' => [
            'nullable', 'string', 'max:100',
            'regex:/^[0-9₹$,.\-\s\/]+$/',
        ],

        // Alphabets + Numbers + Special characters
        'qualification' => [
            'nullable', 'string', 'max:255',
            'regex:/^[A-Za-z0-9\s,.\-()&]+$/',
        ],

        // Alphabets + Numbers + Special characters
        'skills' => [
            'nullable', 'string', 'max:500',
            'regex:/^[A-Za-z0-9\s,.\-+#\/]+$/',
        ],

        // Alphabets only
        'country' => [
            'nullable', 'string', 'max:100',
            'regex:/^[A-Za-z\s]+$/',
        ],

        // Alphabets only
        'state' => [
            'required', 'string', 'max:100',
            'regex:/^[A-Za-z\s]+$/',
        ],

        // Alphabets only
        'district' => [
            'required', 'string', 'max:100',
            'regex:/^[A-Za-z\s]+$/',
        ],

        // Alphabets only
        'city' => [
            'required', 'string', 'max:100',
            'regex:/^[A-Za-z\s]+$/',
        ],

        // Any characters
        'description' => ['required', 'string', 'max:5000'],
    ], [
        'title.regex'         => 'Title can only contain letters, numbers, and & ( ) . , -',
        'experience.regex'    => 'Experience can only contain letters, numbers, and -',
        'salary.regex'        => 'Salary can only contain numbers and ₹ $ , . - / (no letters).',
        'qualification.regex' => 'Qualification can only contain letters, numbers, and , . - ( ) &',
        'skills.regex'        => 'Skills can only contain letters, numbers, and , . - + # /',
        'country.regex'       => 'Country can only contain letters.',
        'state.regex'         => 'State can only contain letters.',
        'district.regex'      => 'District can only contain letters.',
        'city.regex'          => 'City can only contain letters.',
    ]);
}

    private function authorizeOwner(JobPost $job): void
    {
        abort_if($job->employer_id !== Auth::id(), 403, 'You do not have access to this job.');
    }
}