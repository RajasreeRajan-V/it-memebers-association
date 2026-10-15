<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\EmployeeFreelanceJob;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class FreelanceJobApplicationController extends Controller
{
    private function currentEmployee()
    {
        return Auth::user()->employeeRegistration;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Project $project)
    {
        
        return view('employees.freelance-jobs.apply', compact('project'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request, Project $project)
    {
        $employee = $this->currentEmployee();

        if (!$employee) {
            return redirect()->back()
                ->with('error', 'Employee profile not found.');
        }

        // Prevent duplicate applications
        $alreadyApplied = EmployeeFreelanceJob::where('project_id', $project->id)
            ->where('employee_id', $employee->id)
            ->exists();

        if ($alreadyApplied) {
            return redirect()
                ->route('employee.freelance-jobs.index')
                ->with('error', 'You have already applied for this project.');
        }

        // Resume is required only if the employee has no profile resume
        $resumeRules = empty($employee->resume_path)
            ? ['required', 'file', 'mimes:pdf,doc,docx', 'max:5120']
            : ['nullable', 'file', 'mimes:pdf,doc,docx', 'max:5120'];

        $validated = $request->validate([
            'cover_letter' => ['required', 'string', 'min:50'],
            'resume_path' => $resumeRules,
            'portfolio_url' => ['nullable', 'url', 'max:255'],
            'github' => ['nullable', 'url', 'max:255'],
            'linkedin' => ['nullable', 'url', 'max:255'],
            'availability' => [
                'required',
                Rule::in([
                    'full_time',
                    'part_time',
                    'flexible'
                ])
            ],
            'terms' => ['accepted'],
        ]);

        $resumePath = $employee->resume_path ?? null;

        if ($request->hasFile('resume_path')) {
            $resumePath = $request->file('resume_path')
                ->store('applications/resumes', 'public');
        }

        EmployeeFreelanceJob::create([
            'project_id' => $project->id,
            'employee_id' => $employee->id,
            'cover_letter' => $validated['cover_letter'],
            'resume_path' => $resumePath,
            'portfolio_path' => $validated['portfolio_url'] ?? null,
            'github' => $validated['github'] ?? null,
            'linkedin' => $validated['linkedin'] ?? null,
            'availability' => $validated['availability'],
            'status' => 'pending',
        ]);

        return redirect()
            ->route('employee.freelance-jobs.index')
            ->with('success', 'Your application has been submitted successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
