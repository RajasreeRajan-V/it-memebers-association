<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\StartupProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use App\Models\JobPost;


class StartupProfileController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    | Show all startup profiles belonging to the logged-in employer.
    |--------------------------------------------------------------------------
    */

 public function index()
{
    $startupProfiles = StartupProfile::where('employer_id', Auth::id())
        ->orderBy('created_at', 'desc')
        ->get();

    return view(
        'employers.startup-profile.index',
        compact('startupProfiles')
    );
}


    /*
    |--------------------------------------------------------------------------
    | SHOW
    |--------------------------------------------------------------------------
    | Show one startup profile.
    |--------------------------------------------------------------------------
    */

    public function show(StartupProfile $startupProfile)
    {
        $this->authorizeProfile($startupProfile);

        return view(
            'employers.startup-profile.show',
            [
                'profile' => $startupProfile
            ]
        );
    }


    /*
    |--------------------------------------------------------------------------
    | CREATE
    |--------------------------------------------------------------------------
    | Show startup profile creation form.
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        return view(
            'employers.startup-profile.create'
        );
    }


    public function jobs(StartupProfile $startupProfile)
{
    // Only the employer who owns this startup can access it
    if ((int) $startupProfile->employer_id !== (int) Auth::id()) {
        abort(403, 'You do not have access to this startup profile.');
    }

    // Get only jobs connected to this startup profile
    $jobs = JobPost::where('employer_id', Auth::id())
        ->where('startup_profile_id', $startupProfile->id)
        ->latest()
        ->paginate(10);

    return view(
        'employers.startup-profile.jobs',
        compact('startupProfile', 'jobs')
    );
}





    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    | Save a new startup profile.
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $validated = $this->validateProfile($request);

        /*
        |--------------------------------------------------------------------------
        | Employer
        |--------------------------------------------------------------------------
        */

        $validated['employer_id'] = Auth::id();


        /*
        |--------------------------------------------------------------------------
        | Status
        |--------------------------------------------------------------------------
        */

        $validated['status'] = 'pending';

        $validated['rejection_reason'] = null;

        /*
        |--------------------------------------------------------------------------
        | Multi-select fields
        |--------------------------------------------------------------------------
        */

        $validated['looking_for'] = $request->input(
            'looking_for',
            []
        );

        $validated['opportunities'] = $request->input(
            'opportunities',
            []
        );


        /*
        |--------------------------------------------------------------------------
        | Currently Raising
        |--------------------------------------------------------------------------
        */

        $validated['currently_raising'] = $request->input(
            'currently_raising',
            'no'
        );


        /*
        |--------------------------------------------------------------------------
        | Logo Upload
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('logo')) {

            $validated['logo'] = $request
                ->file('logo')
                ->store('startup-logos', 'public');
        }


        /*
        |--------------------------------------------------------------------------
        | Cover Image Upload
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('cover_image')) {

            $validated['cover_image'] = $request
                ->file('cover_image')
                ->store('startup-covers', 'public');
        }


        /*
        |--------------------------------------------------------------------------
        | Published
        |--------------------------------------------------------------------------
        */

        $validated['is_published'] = false;


        /*
        |--------------------------------------------------------------------------
        | Create
        |--------------------------------------------------------------------------
        */

        StartupProfile::create($validated);


        /*
        |--------------------------------------------------------------------------
        | Redirect
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('employer.startup-profile.index')
            ->with(
                'success',
                'Startup profile submitted successfully and is awaiting admin approval.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | EDIT
    |--------------------------------------------------------------------------
    | Show edit form.
    |--------------------------------------------------------------------------
    */

    public function edit(StartupProfile $startupProfile)
    {
        $this->authorizeProfile($startupProfile);

        return view(
            'employers.startup-profile.edit',
            [
                'profile' => $startupProfile
            ]
        );
    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    | Update existing startup profile.
    |--------------------------------------------------------------------------
    */

    public function update(
        Request $request,
        StartupProfile $startupProfile
    ) {
        /*
        |--------------------------------------------------------------------------
        | Authorization
        |--------------------------------------------------------------------------
        */

        $this->authorizeProfile($startupProfile);


        /*
        |--------------------------------------------------------------------------
        | Validation
        |--------------------------------------------------------------------------
        */

        $validated = $this->validateProfile(
            $request,
            $startupProfile
        );


        /*
        |--------------------------------------------------------------------------
        | Multi-select fields
        |--------------------------------------------------------------------------
        */

        $validated['looking_for'] = $request->input(
            'looking_for',
            []
        );

        $validated['opportunities'] = $request->input(
            'opportunities',
            []
        );


        /*
        |--------------------------------------------------------------------------
        | Currently Raising
        |--------------------------------------------------------------------------
        */

        $validated['currently_raising'] = $request->input(
            'currently_raising',
            'no'
        );


        /*
        |--------------------------------------------------------------------------
        | Logo Upload
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('logo')) {

            if ($startupProfile->logo) {

                Storage::disk('public')->delete(
                    $startupProfile->logo
                );
            }

            $validated['logo'] = $request
                ->file('logo')
                ->store('startup-logos', 'public');
        }


        /*
        |--------------------------------------------------------------------------
        | Cover Image Upload
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('cover_image')) {

            if ($startupProfile->cover_image) {

                Storage::disk('public')->delete(
                    $startupProfile->cover_image
                );
            }

            $validated['cover_image'] = $request
                ->file('cover_image')
                ->store('startup-covers', 'public');
        }


        /*
        |--------------------------------------------------------------------------
        | Re-approval
        |--------------------------------------------------------------------------
        |
        | Whenever employer edits a profile, send it back to pending.
        |
        */

        $validated['status'] = 'pending';

        $validated['rejection_reason'] = null;

        /*
        |--------------------------------------------------------------------------
        | Do not automatically publish edited profile
        |--------------------------------------------------------------------------
        */

        $validated['is_published'] = false;


        /*
        |--------------------------------------------------------------------------
        | Update
        |--------------------------------------------------------------------------
        */

        $startupProfile->update($validated);


        /*
        |--------------------------------------------------------------------------
        | Redirect
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('employer.startup-profile.index')
            ->with(
                'success',
                'Startup profile updated successfully and is awaiting admin approval.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | DELETE
    |--------------------------------------------------------------------------
    */

    public function destroy(StartupProfile $startupProfile)
    {
        /*
        |--------------------------------------------------------------------------
        | Authorization
        |--------------------------------------------------------------------------
        */

        $this->authorizeProfile($startupProfile);


        /*
        |--------------------------------------------------------------------------
        | Delete Logo
        |--------------------------------------------------------------------------
        */

        if ($startupProfile->logo) {

            Storage::disk('public')->delete(
                $startupProfile->logo
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Delete Cover Image
        |--------------------------------------------------------------------------
        */

        if ($startupProfile->cover_image) {

            Storage::disk('public')->delete(
                $startupProfile->cover_image
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Delete Database Record
        |--------------------------------------------------------------------------
        */

        $startupProfile->delete();


        /*
        |--------------------------------------------------------------------------
        | Redirect
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('employer.startup-profile.index')
            ->with(
                'success',
                'Startup profile deleted successfully.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | TOGGLE PUBLISH
    |--------------------------------------------------------------------------
    | Only approved profiles can be published.
    |--------------------------------------------------------------------------
    */

    public function togglePublish(
        StartupProfile $startupProfile
    ) {
        /*
        |--------------------------------------------------------------------------
        | Authorization
        |--------------------------------------------------------------------------
        */

        $this->authorizeProfile($startupProfile);


        /*
        |--------------------------------------------------------------------------
        | Approval Check
        |--------------------------------------------------------------------------
        */

        if ($startupProfile->status !== 'approved') {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Only approved startup profiles can be published.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Toggle
        |--------------------------------------------------------------------------
        */

        $startupProfile->is_published =
            !$startupProfile->is_published;

        $startupProfile->save();


        /*
        |--------------------------------------------------------------------------
        | Message
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->back()
            ->with(
                'success',
                $startupProfile->is_published
                    ? 'Startup profile published successfully.'
                    : 'Startup profile unpublished successfully.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | VALIDATION
    |--------------------------------------------------------------------------
    */

    private function validateProfile(
        Request $request,
        ?StartupProfile $profile = null
    ): array {

        return $request->validate([

            /*
            |--------------------------------------------------------------------------
            | Startup Information
            |--------------------------------------------------------------------------
            */

            'startup_name' => [
                'required',
                'string',
                'max:255',
                'regex:/^[A-Za-z0-9\s\-&().,]+$/'
            ],

            'slug' => [
                'required',
                'string',
                'max:255',
                'regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/',

                Rule::unique(
                    'startup_profiles',
                    'slug'
                )->ignore(
                    $profile?->id
                ),
            ],

            'tagline' => [
                'nullable',
                'string',
                'max:255'
            ],

            'category' => [
                'required',
                'string',
                'max:255'
            ],

            'industry' => [
                'required',
                'string',
                'max:255'
            ],

            'startup_type' => [
                'required',
                'string',
                'max:255'
            ],

            'founded_year' => [
                'nullable',
                'integer',
                'min:1900',
                'max:' . date('Y')
            ],

            'startup_stage' => [
                'nullable',
                'string',
                'max:255'
            ],

            /*
            |--------------------------------------------------------------------------
            | IMPORTANT
            |--------------------------------------------------------------------------
            | team_size is VARCHAR in database because values are ranges.
            |
            */

            'team_size' => [
                'nullable',
                'string',
                'max:100'
            ],

            'location' => [
                'nullable',
                'string',
                'max:255'
            ],

            'website' => [
                'nullable',
                'url',
                'max:255'
            ],


            /*
            |--------------------------------------------------------------------------
            | Images
            |--------------------------------------------------------------------------
            */

            'logo' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048'
            ],

            'cover_image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120'
            ],


            /*
            |--------------------------------------------------------------------------
            | Description
            |--------------------------------------------------------------------------
            */

            'short_description' => [
                'required',
                'string',
                'max:1000'
            ],

            'about' => [
                'nullable',
                'string',
                'max:10000'
            ],

            'mission' => [
                'nullable',
                'string',
                'max:5000'
            ],

            'vision' => [
                'nullable',
                'string',
                'max:5000'
            ],


            /*
            |--------------------------------------------------------------------------
            | Products / Technologies
            |--------------------------------------------------------------------------
            */

            'products_services' => [
                'nullable',
                'string',
                'max:10000'
            ],

            'technologies' => [
                'nullable',
                'string',
                'max:10000'
            ],


            /*
            |--------------------------------------------------------------------------
            | Who Can View / Looking For
            |--------------------------------------------------------------------------
            */

            'looking_for' => [
                'nullable',
                'array'
            ],

            'looking_for.*' => [
                'string',
                Rule::in([
                    'employee',
                    'freelancer',
                    'investor',
                    'mentor',
                    'student',
                    'business_partner'
                ])
            ],


            /*
            |--------------------------------------------------------------------------
            | Opportunities
            |--------------------------------------------------------------------------
            */

            'opportunities' => [
                'nullable',
                'array'
            ],

            'opportunities.*' => [
                'string',
                Rule::in([
                    'jobs',
                    'internships',
                    'freelance_projects',
                    'student_projects',
                    'mentorship',
                    'business_partnerships',
                    'investment'
                ])
            ],


            /*
            |--------------------------------------------------------------------------
            | Contact
            |--------------------------------------------------------------------------
            */

            'startup_email' => [
                'nullable',
                'email',
                'max:255'
            ],

            'startup_phone' => [
                'nullable',
                'string',
                'max:30',
                'regex:/^[0-9+\-\s()]+$/'
            ],

            'linkedin' => [
                'nullable',
                'url',
                'max:255'
            ],


            /*
            |--------------------------------------------------------------------------
            | Funding
            |--------------------------------------------------------------------------
            */

            'funding_stage' => [
                'nullable',
                'string',
                'max:255'
            ],

            /*
            |--------------------------------------------------------------------------
            | IMPORTANT
            |--------------------------------------------------------------------------
            | currently_raising is VARCHAR, not boolean.
            |
            */

            'currently_raising' => [
                'nullable',
                Rule::in([
                    'yes',
                    'no'
                ])
            ],

            'funding_requirement' => [
                'nullable',
                'numeric',
                'min:0'
            ],

        ], [

            /*
            |--------------------------------------------------------------------------
            | Custom Messages
            |--------------------------------------------------------------------------
            */

            'startup_name.required' =>
                'Please enter the startup name.',

            'startup_name.regex' =>
                'Startup name contains invalid characters.',

            'slug.required' =>
                'Please enter a startup slug.',

            'slug.regex' =>
                'Slug can contain only lowercase letters, numbers and hyphens.',

            'slug.unique' =>
                'This startup slug is already being used.',

            'category.required' =>
                'Please select a category.',

            'industry.required' =>
                'Please select an industry.',

            'startup_type.required' =>
                'Please select the startup type.',

            'website.url' =>
                'Please enter a valid website URL.',

            'linkedin.url' =>
                'Please enter a valid LinkedIn URL.',

            'startup_email.email' =>
                'Please enter a valid startup email address.',

            'startup_phone.regex' =>
                'Please enter a valid phone number.',

            'currently_raising.in' =>
                'Currently raising must be either yes or no.',

            'funding_requirement.numeric' =>
                'Funding requirement must be a valid number.',

            'logo.image' =>
                'Logo must be a valid image.',

            'cover_image.image' =>
                'Cover image must be a valid image.',

        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | AUTHORIZE PROFILE
    |--------------------------------------------------------------------------
    | Prevent one employer from accessing another employer's profile.
    |--------------------------------------------------------------------------
    */

    private function authorizeProfile(
        StartupProfile $startupProfile
    ): void {

        if (
            (int) $startupProfile->employer_id !==
            (int) Auth::id()
        ) {

            abort(
                403,
                'You are not authorized to access this startup profile.'
            );
        }
    }


    
}