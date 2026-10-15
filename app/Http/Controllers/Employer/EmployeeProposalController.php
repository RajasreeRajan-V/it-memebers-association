<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\EmployeeFreelanceJob;
use App\Mail\EmployeeApplicationAcceptedMail;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmployeeApplicationRejectedMail;
use App\Mail\EmployeeContractMail;
use Illuminate\Support\Facades\Storage;
class EmployeeProposalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, Project $project)
    {
        abort_unless(
            (int) $project->employer_id === (int) auth()->id(),
            403,
            'You are not authorized to view these applications.'
        );

        /*
        |--------------------------------------------------------------------------
        | Application query
        |--------------------------------------------------------------------------
        */
        $query = EmployeeFreelanceJob::query()
            ->with([
                'employee.user',
                'project',
            ])
            ->where('project_id', $project->id);

        /*
        |--------------------------------------------------------------------------
        | Search employee/user data
        |--------------------------------------------------------------------------
        */
        if ($request->filled('search')) {
            $search = trim($request->search);

            $query->whereHas('employee', function ($employeeQuery) use ($search) {
                $employeeQuery->where(function ($q) use ($search) {
                    $q->where('designation', 'like', "%{$search}%")
                        ->orWhere('company_name', 'like', "%{$search}%");
                })->orWhereHas('user', function ($userQuery) use ($search) {
                    $userQuery->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('phone', 'like', "%{$search}%");
                });
            });
        }

        /*
        |--------------------------------------------------------------------------
        | Status filter
        |--------------------------------------------------------------------------
        */
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        /*
        |--------------------------------------------------------------------------
        | Sorting
        |--------------------------------------------------------------------------
        */
        switch ($request->input('sort')) {
            case 'oldest':
                $query->oldest();
                break;

            case 'newest':
            case null:
            case '':
                $query->latest();
                break;
        }

        /*
        |--------------------------------------------------------------------------
        | Paginated applications
        |--------------------------------------------------------------------------
        */
        $applications = $query->paginate(10)->withQueryString();

        /*
        |--------------------------------------------------------------------------
        | Proposal/Application counts
        |--------------------------------------------------------------------------
        */
        $counts = [
            'all' => EmployeeFreelanceJob::where('project_id', $project->id)->count(),

            'pending' => EmployeeFreelanceJob::where('project_id', $project->id)
                ->where('status', 'pending')
                ->count(),

            'shortlisted' => EmployeeFreelanceJob::where('project_id', $project->id)
                ->where('status', 'shortlisted')
                ->count(),

            'accepted' => EmployeeFreelanceJob::where('project_id', $project->id)
                ->where('status', 'accepted')
                ->count(),

            'rejected' => EmployeeFreelanceJob::where('project_id', $project->id)
                ->where('status', 'rejected')
                ->count(),

            'withdrawn' => EmployeeFreelanceJob::where('project_id', $project->id)
                ->where('status', 'withdrawn')
                ->count(),
        ];

        return view(
            'employers.projects.proposals.index',
            compact('project', 'applications', 'counts')
        );
    }

   public function accept(Request $request, Project $project, EmployeeFreelanceJob $application)
{
    // Make sure the logged-in employer owns this project
    abort_unless(
        (int) $project->employer_id === (int) auth()->id(),
        403,
        'You are not authorized to manage this application.'
    );

    // Make sure application belongs to this project
    abort_unless(
        (int) $application->project_id === (int) $project->id,
        404,
        'Application not found for this project.'
    );

    // Only pending applications can be accepted
    if ($application->status !== 'pending') {
        return back()->with(
            'error',
            'This application has already been processed.'
        );
    }

    // Load employee and user
    $application->load('employee.user');

    $employee = $application->employee;

    if (!$employee) {
        return back()->with(
            'error',
            'Employee information could not be found.'
        );
    }

    // Employee email is stored in users table
    $email = $employee->user?->email;

    if (empty($email)) {
        return back()->with(
            'error',
            'Employee email address could not be found.'
        );
    }

    // Change application status
    $application->update([
        'status' => 'accepted',
    ]);

    // Send acceptance email
    try {
        Mail::to($email)->send(
            new EmployeeApplicationAcceptedMail(
                $employee,
                $project,
                $application
            )
        );
    } catch (\Throwable $e) {
        \Log::error('Employee acceptance email failed', [
            'application_id' => $application->id,
            'employee_id' => $employee->id,
            'email' => $email,
            'error' => $e->getMessage(),
        ]);

        return back()->with(
            'error',
            'Application was accepted, but the notification email could not be sent.'
        );
    }

    return back()->with(
        'success',
        'Application accepted successfully. The employee has been notified by email.'
    );
}
    /**
     * Show the form for creating a new resource.
     */
    public function reject(
        Request $request,
        Project $project,
        EmployeeFreelanceJob $application
    ) {
        // Make sure employer owns the project
        abort_unless(
            (int) $project->employer_id === (int) auth()->id(),
            403,
            'You are not authorized to manage this application.'
        );

        // Make sure application belongs to this project
        abort_unless(
            (int) $application->project_id === (int) $project->id,
            404,
            'Application not found for this project.'
        );

        // Only pending applications can be rejected
        if ($application->status !== 'pending') {
            return back()->with(
                'error',
                'This application has already been processed.'
            );
        }

        $application->load('employee.user');

        $employee = $application->employee;

        if (!$employee) {
            return back()->with(
                'error',
                'Employee information could not be found.'
            );
        }

        // Change status
        $application->update([
            'status' => 'rejected',
        ]);

        // Send rejection email
        $email = $employee->user?->email;
        if (!empty($email)) {
            Mail::to($email)->send(
                new EmployeeApplicationRejectedMail(
                    $employee,
                    $project,
                    $application
                )
            );
        }

        return back()->with(
            'success',
            'Application rejected successfully. The employee has been notified by email.'
        );
    }

    public function sendContract(Request $request, Project $project, EmployeeFreelanceJob $application)
{
    abort_unless(
        (int) $project->employer_id === (int) auth()->id(),
        403,
        'You are not authorized to manage this application.'
    );

    abort_unless(
        (int) $application->project_id === (int) $project->id,
        404,
        'Application not found for this project.'
    );

    if ($application->status !== 'accepted') {
        return back()->with('error', 'Contract can only be sent to accepted applications.');
    }

    $validated = $request->validate([
        'contract' => ['required', 'file', 'mimes:pdf', 'max:5120'], // 5 MB
        'note'     => ['nullable', 'string', 'max:1000'],
    ], [
        'contract.required' => 'Please upload the contract file.',
        'contract.mimes'    => 'The contract must be a PDF file.',
        'contract.max'      => 'The contract may not be larger than 5 MB.',
    ]);

    $application->load('employee.user');
    $employee = $application->employee;
    $email    = $employee?->user?->email;

    if (!$employee || empty($email)) {
        return back()->with('error', 'Employee email address could not be found.');
    }

    // Remove the old contract if one is being replaced
    if ($application->contract_path) {
        Storage::disk('public')->delete($application->contract_path);
    }

    $path = $request->file('contract')->store('contracts', 'public');

    $application->update([
        'contract_path' => $path,
    ]);

    try {
        Mail::to($email)->send(
            new EmployeeContractMail($employee, $project, $application, $validated['note'] ?? null)
        );

        $application->update(['contract_sent_at' => now()]);
    } catch (\Throwable $e) {
        \Log::error('Contract email failed', [
            'application_id' => $application->id,
            'email'          => $email,
            'error'          => $e->getMessage(),
        ]);

        return back()->with('error', 'Contract was uploaded, but the email could not be sent. Please try again.');
    }

    return back()->with('success', 'Contract sent successfully to ' . ($employee->user->name ?? 'the employee') . '.');
}

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
