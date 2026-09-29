<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\Internship;
use App\Models\StartupProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InternshipController extends Controller
{
    /**
     * Display employer's internships.
     */
    public function index(Request $request)
    {
        $employerId = Auth::id();

        $internships = Internship::with([
                'employer',
                'startupProfile',
            ])
            ->where('employer_id', $employerId)

            ->when(
                $request->filled('search'),
                function ($query) use ($request) {

                    $search = trim($request->search);

                    $query->where(function ($q) use ($search) {

                        $q->where(
                            'title',
                            'like',
                            "%{$search}%"
                        )

                        ->orWhere(
                            'description',
                            'like',
                            "%{$search}%"
                        )

                        ->orWhere(
                            'city',
                            'like',
                            "%{$search}%"
                        )

                        ->orWhere(
                            'skills',
                            'like',
                            "%{$search}%"
                        );
                    });
                }
            )

            ->when(
                $request->filled('status'),
                function ($query) use ($request) {

                    $query->where(
                        'status',
                        $request->status
                    );
                }
            )

            ->latest()
            ->paginate(6)
            ->withQueryString();

        return view(
            'employers.internships.index',
            compact('internships')
        );
    }


    /**
     * Show create internship form.
     */
    public function create()
    {
        /*
        |--------------------------------------------------------------------------
        | Get only this employer's startup profiles
        |--------------------------------------------------------------------------
        */

        $startupProfiles = StartupProfile::where(
                'employer_id',
                Auth::id()
            )
            ->latest()
            ->get();

        return view(
            'employers.internships.create',
            compact('startupProfiles')
        );
    }


    /**
     * Store a new internship.
     */
    public function store(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Validate internship
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([

            /*
            |--------------------------------------------------------------------------
            | Basic Information
            |--------------------------------------------------------------------------
            */

            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'startup_profile_id' => [
                'nullable',
                'integer',
                'exists:startup_profiles,id',
            ],

            /*
            |--------------------------------------------------------------------------
            | Internship Type
            |--------------------------------------------------------------------------
            |
            | Only:
            | paid
            | unpaid
            |
            */

            'internship_type' => [
                'required',
                'in:paid,unpaid',
            ],

            /*
            |--------------------------------------------------------------------------
            | Stipend
            |--------------------------------------------------------------------------
            |
            | Required only when internship is paid.
            |
            */

            'stipend' => [
                'nullable',
                'string',
                'max:255',
                'required_if:internship_type,paid',
            ],

            /*
            |--------------------------------------------------------------------------
            | Work Mode
            |--------------------------------------------------------------------------
            */

            'work_mode' => [
                'required',
                'in:onsite,hybrid,remote',
            ],

            /*
            |--------------------------------------------------------------------------
            | Duration
            |--------------------------------------------------------------------------
            */

            'duration' => [
                'required',
                'string',
                'max:100',
            ],

            /*
            |--------------------------------------------------------------------------
            | Qualification
            |--------------------------------------------------------------------------
            */

            'qualification' => [
                'nullable',
                'string',
                'max:255',
            ],

            /*
            |--------------------------------------------------------------------------
            | Skills
            |--------------------------------------------------------------------------
            |
            | The form sends:
            |
            | PHP, Laravel, MySQL, JavaScript
            |
            */

            'skills' => [
                'nullable',
                'string',
            ],

            /*
            |--------------------------------------------------------------------------
            | Location
            |--------------------------------------------------------------------------
            */

            'country' => [
                'nullable',
                'string',
                'max:100',
            ],

            'state' => [
                'required',
                'string',
                'max:100',
            ],

            'district' => [
                'required',
                'string',
                'max:100',
            ],

            'city' => [
                'required',
                'string',
                'max:100',
            ],

            /*
            |--------------------------------------------------------------------------
            | Description
            |--------------------------------------------------------------------------
            */

            'description' => [
                'required',
                'string',
                'max:10000',
            ],

            /*
            |--------------------------------------------------------------------------
            | Internship Period
            |--------------------------------------------------------------------------
            */

            'start_date' => [
                'nullable',
                'date',
            ],

            'end_date' => [
                'nullable',
                'date',
                'after_or_equal:start_date',
            ],

            /*
            |--------------------------------------------------------------------------
            | Positions
            |--------------------------------------------------------------------------
            */

            'positions' => [
                'required',
                'integer',
                'min:1',
                'max:1000',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | Ensure startup profile belongs to this employer
        |--------------------------------------------------------------------------
        */

        if (!empty($validated['startup_profile_id'])) {

            $startupExists = StartupProfile::where(
                    'id',
                    $validated['startup_profile_id']
                )
                ->where(
                    'employer_id',
                    Auth::id()
                )
                ->exists();

            if (!$startupExists) {

                return back()
                    ->withInput()
                    ->with(
                        'error',
                        'Invalid startup profile selected.'
                    );
            }
        }


        /*
        |--------------------------------------------------------------------------
        | Clean Skills
        |--------------------------------------------------------------------------
        |
        | Example:
        |
        | PHP, Laravel, MySQL, JavaScript
        |
        | becomes:
        |
        | [
        |     "PHP",
        |     "Laravel",
        |     "MySQL",
        |     "JavaScript"
        | ]
        |
        */

        $skills = $this->cleanSkills(
            $validated['skills'] ?? ''
        );


        /*
        |--------------------------------------------------------------------------
        | Paid / Unpaid Stipend Logic
        |--------------------------------------------------------------------------
        |
        | Paid:
        | stipend is saved.
        |
        | Unpaid:
        | stipend is always NULL.
        |
        */

        $stipend = null;

        if ($validated['internship_type'] === 'paid') {

            $stipend = trim(
                $validated['stipend']
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Create Internship
        |--------------------------------------------------------------------------
        |
        | New internships are active immediately.
        | No admin verification is required.
        |
        */

        Internship::create([

            'employer_id' => Auth::id(),

            'startup_profile_id' =>
                $validated['startup_profile_id'] ?? null,

            'title' =>
                $validated['title'],

            'internship_type' =>
                $validated['internship_type'],

            'work_mode' =>
                $validated['work_mode'],

            'duration' =>
                $validated['duration'],

            'stipend' =>
                $stipend,

            'qualification' =>
                $validated['qualification'] ?? null,

            'skills' =>
                $skills,

            'country' =>
                $validated['country'] ?? null,

            'state' =>
                $validated['state'],

            'district' =>
                $validated['district'],

            'city' =>
                $validated['city'],

            'description' =>
                $validated['description'],

            'start_date' =>
                $validated['start_date'] ?? null,

            'end_date' =>
                $validated['end_date'] ?? null,

            'positions' =>
                $validated['positions'],

            'status' =>
                'active',
        ]);


        /*
        |--------------------------------------------------------------------------
        | Redirect
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route(
                'employer.internships.index'
            )
            ->with(
                'success',
                'Internship posted successfully.'
            );
    }


    /**
     * Display one internship.
     */
    public function show(Internship $internship)
    {
        $this->authorizeOwner($internship);

        $internship->load([
            'employer',
            'startupProfile',
            'applications.student',
            'applications.certificate',
        ]);

        return view(
            'employers.internships.show',
            compact('internship')
        );
    }


    /**
     * Show edit form.
     */
    public function edit(Internship $internship)
    {
        $this->authorizeOwner($internship);

        /*
        |--------------------------------------------------------------------------
        | Get only this employer's startup profiles
        |--------------------------------------------------------------------------
        */

        $startupProfiles = StartupProfile::where(
                'employer_id',
                Auth::id()
            )
            ->latest()
            ->get();

        return view(
            'employers.internships.edit',
            compact(
                'internship',
                'startupProfiles'
            )
        );
    }


    /**
     * Update internship.
     */
    public function update(
        Request $request,
        Internship $internship
    ) {
        $this->authorizeOwner($internship);


        /*
        |--------------------------------------------------------------------------
        | Validate
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([

            /*
            |--------------------------------------------------------------------------
            | Basic Information
            |--------------------------------------------------------------------------
            */

            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'startup_profile_id' => [
                'nullable',
                'integer',
                'exists:startup_profiles,id',
            ],

            /*
            |--------------------------------------------------------------------------
            | Internship Type
            |--------------------------------------------------------------------------
            */

            'internship_type' => [
                'required',
                'in:paid,unpaid',
            ],

            /*
            |--------------------------------------------------------------------------
            | Stipend
            |--------------------------------------------------------------------------
            */

            'stipend' => [
                'nullable',
                'string',
                'max:255',
                'required_if:internship_type,paid',
            ],

            /*
            |--------------------------------------------------------------------------
            | Work Mode
            |--------------------------------------------------------------------------
            */

            'work_mode' => [
                'required',
                'in:onsite,hybrid,remote',
            ],

            /*
            |--------------------------------------------------------------------------
            | Duration
            |--------------------------------------------------------------------------
            */

            'duration' => [
                'required',
                'string',
                'max:100',
            ],

            /*
            |--------------------------------------------------------------------------
            | Qualification
            |--------------------------------------------------------------------------
            */

            'qualification' => [
                'nullable',
                'string',
                'max:1000',
            ],

            /*
            |--------------------------------------------------------------------------
            | Skills
            |--------------------------------------------------------------------------
            */

            'skills' => [
                'nullable',
                'string',
            ],

            /*
            |--------------------------------------------------------------------------
            | Location
            |--------------------------------------------------------------------------
            */

            'country' => [
                'nullable',
                'string',
                'max:100',
            ],

            'state' => [
                'required',
                'string',
                'max:100',
            ],

            'district' => [
                'required',
                'string',
                'max:100',
            ],

            'city' => [
                'required',
                'string',
                'max:100',
            ],

            /*
            |--------------------------------------------------------------------------
            | Description
            |--------------------------------------------------------------------------
            */

            'description' => [
                'required',
                'string',
                'max:10000',
            ],

            /*
            |--------------------------------------------------------------------------
            | Dates
            |--------------------------------------------------------------------------
            */

            'start_date' => [
                'nullable',
                'date',
            ],

            'end_date' => [
                'nullable',
                'date',
                'after_or_equal:start_date',
            ],

            /*
            |--------------------------------------------------------------------------
            | Positions
            |--------------------------------------------------------------------------
            */

            'positions' => [
                'required',
                'integer',
                'min:1',
                'max:1000',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | Ensure startup profile belongs to this employer
        |--------------------------------------------------------------------------
        */

        if (!empty($validated['startup_profile_id'])) {

            $startupExists = StartupProfile::where(
                    'id',
                    $validated['startup_profile_id']
                )
                ->where(
                    'employer_id',
                    Auth::id()
                )
                ->exists();

            if (!$startupExists) {

                return back()
                    ->withInput()
                    ->with(
                        'error',
                        'Invalid startup profile selected.'
                    );
            }
        }


        /*
        |--------------------------------------------------------------------------
        | Clean Skills
        |--------------------------------------------------------------------------
        */

        $skills = $this->cleanSkills(
            $validated['skills'] ?? ''
        );


        /*
        |--------------------------------------------------------------------------
        | Paid / Unpaid Stipend Logic
        |--------------------------------------------------------------------------
        */

        $stipend = null;

        if ($validated['internship_type'] === 'paid') {

            $stipend = trim(
                $validated['stipend']
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Update Internship
        |--------------------------------------------------------------------------
        */

        $internship->update([

            'startup_profile_id' =>
                $validated['startup_profile_id'] ?? null,

            'title' =>
                $validated['title'],

            'internship_type' =>
                $validated['internship_type'],

            'work_mode' =>
                $validated['work_mode'],

            'duration' =>
                $validated['duration'],

            'stipend' =>
                $stipend,

            'qualification' =>
                $validated['qualification'] ?? null,

            'skills' =>
                $skills,

            'country' =>
                $validated['country'] ?? null,

            'state' =>
                $validated['state'],

            'district' =>
                $validated['district'],

            'city' =>
                $validated['city'],

            'description' =>
                $validated['description'],

            'start_date' =>
                $validated['start_date'] ?? null,

            'end_date' =>
                $validated['end_date'] ?? null,

            'positions' =>
                $validated['positions'],
        ]);


        /*
        |--------------------------------------------------------------------------
        | Redirect
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route(
                'employer.internships.index'
            )
            ->with(
                'success',
                'Internship updated successfully.'
            );
    }


    /**
     * Delete internship.
     */
    public function destroy(Internship $internship)
    {
        $this->authorizeOwner($internship);


        /*
        |--------------------------------------------------------------------------
        | Do not delete if applications already exist
        |--------------------------------------------------------------------------
        */

        if ($internship->applications()->exists()) {

            return back()->with(
                'error',
                'This internship cannot be deleted because students have already applied.'
            );
        }


        $internship->delete();


        return redirect()
            ->route(
                'employer.internships.index'
            )
            ->with(
                'success',
                'Internship deleted successfully.'
            );
    }


    /**
     * Toggle active/closed status.
     */
    public function toggleStatus(Internship $internship)
    {
        $this->authorizeOwner($internship);


        /*
        |--------------------------------------------------------------------------
        | Close internship
        |--------------------------------------------------------------------------
        */

   if ($internship->status === 'active') {

    $internship->update([
        'status' => 'deactive',
    ]);

    return back()->with(
        'success',
        'Internship closed successfully.'
    );
}


        /*
        |--------------------------------------------------------------------------
        | Re-open internship
        |--------------------------------------------------------------------------
        */

        $internship->update([
            'status' => 'active',
        ]);


        return back()->with(
            'success',
            'Internship is now active and accepting applications.'
        );
    }


    /**
     * Clean and convert skills into an array.
     *
     * Example:
     *
     * PHP, Laravel, MySQL
     *
     * becomes:
     *
     * [
     *     'PHP',
     *     'Laravel',
     *     'MySQL'
     * ]
     */
    private function cleanSkills($skills): array
    {
        /*
        |--------------------------------------------------------------------------
        | If already an array
        |--------------------------------------------------------------------------
        */

        if (is_array($skills)) {

            return collect($skills)
                ->map(function ($skill) {

                    return trim(
                        (string) $skill
                    );
                })
                ->filter()
                ->unique()
                ->values()
                ->all();
        }


        /*
        |--------------------------------------------------------------------------
        | Convert comma-separated string
        |--------------------------------------------------------------------------
        */

        if (is_string($skills)) {

            return collect(
                    explode(',', $skills)
                )
                ->map(function ($skill) {

                    return trim(
                        $skill
                    );
                })
                ->filter()
                ->unique()
                ->values()
                ->all();
        }


        /*
        |--------------------------------------------------------------------------
        | Empty
        |--------------------------------------------------------------------------
        */

        return [];
    }


    /**
     * Make sure the logged-in employer owns the internship.
     */
    private function authorizeOwner(
        Internship $internship
    ): void {
        abort_if(
            (int) $internship->employer_id !== (int) Auth::id(),
            403,
            'You do not have access to this internship.'
        );
    }
}