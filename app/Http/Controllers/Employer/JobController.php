<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\JobPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class JobController extends Controller
{
    /**
     * Show the form for creating a new job.
     */
    public function create()
    {
        return view('employers.jobs.create');
    }

    /**
     * Store a newly created job in storage.
     */
    public function store(Request $request)
    {
        // Log the incoming request for debugging
        Log::info('Job creation attempt', ['data' => $request->all()]);

        // Validate the request
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'employment_type' => 'required|in:full-time,part-time,contract,freelance',
            'work_mode' => 'required|in:onsite,hybrid,remote',
            'experience' => 'nullable|string|max:255',
            'salary' => 'nullable|string|max:255',
            'qualification' => 'nullable|string|max:255',
            'skills' => 'nullable|string|max:500',
            'country' => 'nullable|string|max:255',
            'state' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        try {
            // Process skills (convert comma-separated string to array)
            $skills = [];
            if ($request->skills) {
                $skills = array_map('trim', explode(',', $request->skills));
                $skills = array_filter($skills); // Remove empty values
            }

            // Create the job post
            $job = JobPost::create([
                'employer_id' => Auth::id(),
                'title' => $validated['title'],
                'employment_type' => $validated['employment_type'],
                'work_mode' => $validated['work_mode'],
                'experience' => $validated['experience'] ?? null,
                'salary' => $validated['salary'] ?? null,
                'qualification' => $validated['qualification'] ?? null,
                'skills' => $skills,
                'country' => $validated['country'] ?? null,
                'state' => $validated['state'],
                'district' => $validated['district'],
                'city' => $validated['city'],
                'description' => $validated['description'],
                'status' => 'pending', // Default status - requires admin approval
            ]);

            Log::info('Job created successfully', ['job_id' => $job->id]);

            // Redirect with success message
            return redirect()
                ->route('employer.jobs.create')
                ->with('success', 'Job posted successfully! It will be visible after admin approval.');

        } catch (\Exception $e) {
            Log::error('Error creating job: ' . $e->getMessage());
            
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Failed to create job. Please try again. Error: ' . $e->getMessage());
        }
    }



    /**
 * Display a listing of the employer's jobs.
 */
public function index()
{
    $jobs = JobPost::where('employer_id', Auth::id())
        ->orderBy('created_at', 'desc')
        ->paginate(10);
        
    return view('employers.jobs.create');
}
}