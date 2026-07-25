<?php

namespace App\Http\Controllers;

use App\Models\EmployeeRegistration;
use App\Models\EmployerRegistration;
use App\Models\FreelancerRegistration;
use App\Models\InvestorRegistration;
use App\Models\MentorRegistration;
use App\Models\StudentRegistration;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Services\ProfileService;

class ProfileController extends Controller
{
    public function __construct(
        protected ProfileService $profileService
    ) {}

    public function profile(Request $request)
    {
        return view(
            'profile.profile',
            $this->profileService->profileData($request->user())
        );
    }

    public function updateDetails(Request $request)
    {
        $this->profileService->updateDetails($request);

        return back()->with('success', 'Profile updated successfully.');
    }

    public function uploadAvatar(Request $request)
    {
        $this->profileService->uploadAvatar($request);

        return back()->with('success', 'Profile picture updated.');
    }

    public function uploadResume(Request $request)
    {
        $this->profileService->uploadResume($request);

        return back()->with('success', 'Resume uploaded.');
    }

    public function updateBasicInfo(Request $request)
    {
        $this->profileService->updateBasicInfo($request);

        return back()->with('success', 'Basic details updated.');
    }

    public function updatePassword(Request $request)
    {
        $this->profileService->updatePassword($request);

        return back()->with('status', 'password-updated');
    }

    public function verifyCurrentPassword(Request $request): \Illuminate\Http\JsonResponse
    {
        $result = $this->profileService->verifyCurrentPassword($request);

        return response()->json($result);
    }

    public function updateToggles(Request $request)
    {
        $this->profileService->updateToggles($request);

        return back()->with('success', 'Preferences updated.');
    }
}
