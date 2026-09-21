<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\StartupProfile;
use Illuminate\Support\Facades\Auth;

class StartupController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | STARTUP LIST
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $profiles = StartupProfile::query()
            ->where('status', 'approved')
            ->where('is_published', true)
            ->whereJsonContains('looking_for', 'employee')
            ->latest()
            ->paginate(12);

        return view(
            'employees.startups.index',
            compact('profiles')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | STARTUP DETAILS
    |--------------------------------------------------------------------------
    */

    public function show(StartupProfile $startupProfile)
    {
        /*
        |--------------------------------------------------------------------------
        | Visibility Check
        |--------------------------------------------------------------------------
        */

        if (
            $startupProfile->status !== 'approved' ||
            !$startupProfile->is_published
        ) {
            abort(404);
        }


        /*
        |--------------------------------------------------------------------------
        | Employee Visibility
        |--------------------------------------------------------------------------
        */

        $lookingFor = $startupProfile->looking_for ?? [];

        if (!in_array('employee', $lookingFor, true)) {
            abort(403, 'You are not allowed to view this startup profile.');
        }


        /*
        |--------------------------------------------------------------------------
        | Load Employer Opportunities
        |--------------------------------------------------------------------------
        */

        $startupProfile->load([
            'jobs' => function ($query) {
                $query
                    ->where('is_active', true)
                    ->where('status', 'approved')
                    ->latest();
            },

            'internships' => function ($query) {
                $query
                    ->where('status', 'approved')
                    ->latest();
            },

            'projects' => function ($query) {
                $query
                    ->where('status', 'approved')
                    ->latest();
            },
        ]);


        return view(
            'employees.startups.show',
            [
                'profile' => $startupProfile,
            ]
        );
    }
}