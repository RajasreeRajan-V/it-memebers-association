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
     * =========================================================
     * INDEX
     * =========================================================
     */
    public function index(Request $request)
    {
        $internships = Internship::where(
            'employer_id',
            Auth::id()
        )

        ->with([
            'employer.employerRegistration',
            'startupProfile',
        ])

        ->when(
            $request->filled('search'),
            function ($query) use ($request) {

                $search = trim($request->search);

                $query->where(
                    'title',
                    'like',
                    '%' . $search . '%'
                );
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

        ->paginate(10)

        ->withQueryString();

        return view(
            'employers.internships.index',
            compact('internships')
        );
    }


    /**
     * =========================================================
     * CREATE
     * =========================================================
     */
    public function create()
    {
        $startupProfiles = StartupProfile::where(
            'employer_id',
            Auth::id()
        )
        ->orderBy('startup_name')
        ->get();

        return view(
            'employers.internships.create',
            compact('startupProfiles')
        );
    }


    /**
     * =========================================================
     * STORE
     * =========================================================
     */
    public function store(Request $request)
    {
        $data = $this->validateInternship($request);

        $data['employer_id'] = Auth::id();

        $data['status'] = 'active';


        /*
        |--------------------------------------------------------------------------
        | Verify Startup Profile Ownership
        |--------------------------------------------------------------------------
        */

        if (!empty($data['startup_profile_id'])) {

            $startupExists = StartupProfile::where(
                'id',
                $data['startup_profile_id']
            )
            ->where(
                'employer_id',
                Auth::id()
            )
            ->exists();

            if (!$startupExists) {

                abort(
                    403,
                    'You do not have access to this startup profile.'
                );
            }
        }


        Internship::create($data);

        return redirect()
            ->route('employer.internships.index')
            ->with(
                'success',
                'Internship posted successfully.'
            );
    }


    /**
     * =========================================================
     * SHOW
     * =========================================================
     */
    public function show(Internship $internship)
    {
        $this->authorizeOwner($internship);

        $internship->load([
            'employer.employerRegistration',
            'startupProfile',
        ]);

        return view(
            'employers.internships.show',
            compact('internship')
        );
    }


    /**
     * =========================================================
     * EDIT
     * =========================================================
     */
    public function edit(Internship $internship)
    {
        $this->authorizeOwner($internship);

        $startupProfiles = StartupProfile::where(
            'employer_id',
            Auth::id()
        )
        ->orderBy('startup_name')
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
     * =========================================================
     * UPDATE
     * =========================================================
     */
    public function update(
        Request $request,
        Internship $internship
    ) {
        $this->authorizeOwner($internship);

        $data = $this->validateInternship($request);


        /*
        |--------------------------------------------------------------------------
        | Verify Startup Profile Ownership
        |--------------------------------------------------------------------------
        */

        if (!empty($data['startup_profile_id'])) {

            $startupExists = StartupProfile::where(
                'id',
                $data['startup_profile_id']
            )
            ->where(
                'employer_id',
                Auth::id()
            )
            ->exists();

            if (!$startupExists) {

                abort(
                    403,
                    'You do not have access to this startup profile.'
                );
            }
        }


        $internship->update($data);

        return redirect()
            ->route('employer.internships.index')
            ->with(
                'success',
                'Internship updated successfully.'
            );
    }


    /**
     * =========================================================
     * DELETE
     * =========================================================
     */
    public function destroy(Internship $internship)
    {
        $this->authorizeOwner($internship);

        $internship->delete();

        return redirect()
            ->route('employer.internships.index')
            ->with(
                'success',
                'Internship deleted successfully.'
            );
    }


    /**
     * =========================================================
     * TOGGLE STATUS
     * =========================================================
     */
    public function toggleStatus(Internship $internship)
    {
        $this->authorizeOwner($internship);

        $internship->status =
            $internship->status === 'active'
                ? 'deactive'
                : 'active';

        $internship->save();

        $message =
            $internship->status === 'active'
                ? 'Internship activated successfully.'
                : 'Internship deactivated successfully.';

        return redirect()
            ->route('employer.internships.index')
            ->with(
                'success',
                $message
            );
    }


    /**
     * =========================================================
     * VALIDATION
     * =========================================================
     */
    private function validateInternship(
        Request $request
    ): array {

        return $request->validate([

            /*
            |--------------------------------------------------------------------------
            | Title
            |--------------------------------------------------------------------------
            */
            'title' => [
                'required',
                'string',
                'max:255',
                'regex:/^[A-Za-z0-9\s\-\&\(\)\.,]+$/',
            ],


            /*
            |--------------------------------------------------------------------------
            | Internship Type
            |--------------------------------------------------------------------------
            */
            'internship_type' => [
                'required',
                'in:paid,unpaid,stipend',
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
                'regex:/^[A-Za-z0-9\s\-]+$/',
            ],


            /*
            |--------------------------------------------------------------------------
            | Stipend
            |--------------------------------------------------------------------------
            */
            'stipend' => [
                'nullable',
                'string',
                'max:100',
                'regex:/^[0-9₹$,\.\-\s\/]+$/',
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
                'after:start_date',
            ],


            /*
            |--------------------------------------------------------------------------
            | Positions
            |--------------------------------------------------------------------------
            */
            'positions' => [
                'nullable',
                'integer',
                'min:1',
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
                'regex:/^[A-Za-z0-9\s,\.\-\(\)\&]+$/',
            ],


            /*
            |--------------------------------------------------------------------------
            | Skills
            |--------------------------------------------------------------------------
            */
            'skills' => [
                'nullable',
                'string',
                'max:500',
                'regex:/^[A-Za-z0-9\s,\.\-\+#\/]+$/',
            ],


            /*
            |--------------------------------------------------------------------------
            | Country
            |--------------------------------------------------------------------------
            */
            'country' => [
                'nullable',
                'string',
                'max:100',
                'regex:/^[A-Za-z\s]+$/',
            ],


            /*
            |--------------------------------------------------------------------------
            | State
            |--------------------------------------------------------------------------
            */
            'state' => [
                'required',
                'string',
                'max:100',
                'regex:/^[A-Za-z\s]+$/',
            ],


            /*
            |--------------------------------------------------------------------------
            | District
            |--------------------------------------------------------------------------
            */
            'district' => [
                'required',
                'string',
                'max:100',
                'regex:/^[A-Za-z\s]+$/',
            ],


            /*
            |--------------------------------------------------------------------------
            | City
            |--------------------------------------------------------------------------
            */
            'city' => [
                'required',
                'string',
                'max:100',
                'regex:/^[A-Za-z\s]+$/',
            ],


            /*
            |--------------------------------------------------------------------------
            | Description
            |--------------------------------------------------------------------------
            */
            'description' => [
                'required',
                'string',
                'max:5000',
            ],


            /*
            |--------------------------------------------------------------------------
            | Startup Profile
            |--------------------------------------------------------------------------
            |
            | NULL = normal internship
            |
            | ID = startup-linked internship
            |
            */
            'startup_profile_id' => [
                'nullable',
                'integer',
                'exists:startup_profiles,id',
            ],

        ], [

            'title.regex' =>
                'Title can only contain letters, numbers, and & ( ) . , -',

            'duration.regex' =>
                'Duration can only contain letters, numbers, and -',

            'stipend.regex' =>
                'Stipend can only contain numbers and ₹ $ , . - / (no letters).',

            'qualification.regex' =>
                'Qualification can only contain letters, numbers, and , . - ( ) &',

            'skills.regex' =>
                'Skills can only contain letters, numbers, and , . - + # /',

            'country.regex' =>
                'Country can only contain letters.',

            'state.regex' =>
                'State can only contain letters.',

            'district.regex' =>
                'District can only contain letters.',

            'city.regex' =>
                'City can only contain letters.',

            'startup_profile_id.exists' =>
                'The selected startup profile does not exist.',
        ]);
    }


    /**
     * =========================================================
     * AUTHORIZE OWNER
     * =========================================================
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