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

class ProfileController extends Controller
{
    /**
     * Show the profile edit page.
     */

    public function updateDetails(Request $request): RedirectResponse
    {
        $user = Auth::user();
        $role = strtolower($user->role ?? '');

        $rules = $this->rulesForRole($role);

        if (empty($rules)) {
            return back()->withErrors(['role' => 'We could not determine your account type.']);
        }

        $validated = $request->validate($rules);

        $registration = $this->registrationFor($user, $role);

        if (! $registration) {
            $modelClass = $this->modelClassForRole($role);
            $registration = new $modelClass();
            $registration->user_id = $user->id;
        }

        // Handle file fields separately (store on disk, keep old file if none uploaded)
        foreach ($this->fileFieldsForRole($role) as $field) {
            if ($request->hasFile($field)) {
                if ($registration->{$field}) {
                    Storage::disk('public')->delete($registration->{$field});
                }
                $validated[$field] = $request->file($field)->store("registrations/{$role}", 'public');
            } else {
                // don't overwrite existing file with null when nothing new was uploaded
                unset($validated[$field]);
            }
        }

        $registration->fill($validated);
        $registration->save();

        return back()->with('success', 'Your details have been updated.');
    }

    /**
     * Handle the resume dropzone upload (top resume-card form).
     */
    public function uploadResume(Request $request): RedirectResponse
    {
        $request->validate([
            'resume' => 'required|file|mimes:pdf,doc,docx|max:1024',
        ]);

        $user = Auth::user();
        $role = strtolower($user->role ?? '');

        $path = $request->file('resume')->store('resumes', 'public');

        $registration = $this->registrationFor($user, $role);

        if ($registration) {
            if ($registration->resume) {
                Storage::disk('public')->delete($registration->resume);
            }
            $registration->update(['resume' => $path]);
        } else {
            // Fallback: store on the user record if no registration exists yet
            $user->update(['resume' => $path]);
        }

        return back()->with('success', 'Resume uploaded successfully.');
    }

    /**
     * Handle avatar (profile photo) upload.
     */
    public function uploadAvatar(Request $request): RedirectResponse
    {
        $request->validate([
            'profile_photo' => 'required|image|max:2048',
        ]);

        $user = Auth::user();
        $role = strtolower($user->role ?? '');
        $registration = $this->registrationFor($user, $role);

        if (! $registration) {

            $modelClass = $this->modelClassForRole($role);
            if (! $modelClass) {
                return back()->withErrors(['profile_photo' => 'We could not determine your account type.']);
            }
            $registration = new $modelClass();
            $registration->user_id = $user->id;
        }

        if ($registration->profile_photo) {
            Storage::disk('public')->delete($registration->profile_photo);
        }

        $path = $request->file('profile_photo')->store('avatars', 'public');
        $registration->profile_photo = $path;
        $registration->save();

        return back()->with('success', 'Profile photo updated.');
    }

    /**
     * Update the "Show to Corporates" / "Looking for Jobs" toggles.
     */
    public function updateToggles(Request $request): RedirectResponse
    {
        $request->validate([
            'show_to_corporates' => 'sometimes|boolean',
            'looking_for_jobs' => 'sometimes|boolean',
        ]);

        Auth::user()->update([
            'show_to_corporates' => $request->boolean('show_to_corporates'),
            'looking_for_jobs' => $request->boolean('looking_for_jobs'),
        ]);

        return back()->with('success', 'Preferences updated.');
    }

    /**
     * Resolve the user's role-specific registration model instance.
     */
    private function registrationFor($user, string $role)
    {
        return match ($role) {
            'student' => $user->studentRegistration,
            'employee' => $user->employeeRegistration,
            'employer' => $user->employerRegistration,
            'investor' => $user->investorRegistration,
            'freelancer' => $user->freelancerRegistration,
            'mentor' => $user->mentorRegistration,
            default => null,
        };
    }

    /**
     * Map a role to its Eloquent model class.
     */
    private function modelClassForRole(string $role): ?string
    {
        return match ($role) {
            'student' => StudentRegistration::class,
            'employee' => EmployeeRegistration::class,
            'employer' => EmployerRegistration::class,
            'investor' => InvestorRegistration::class,
            'freelancer' => FreelancerRegistration::class,
            'mentor' => MentorRegistration::class,
            default => null,
        };
    }

    /**
     * File input names per role (used to store uploads separately from fill()).
     */
    private function fileFieldsForRole(string $role): array
    {
        return match ($role) {
            'student' => ['college_id_card', 'resume'],
            'employee' => ['resume', 'experience_proof'],
            'employer' => ['company_logo', 'company_documents'],
            'investor' => ['verification_document'],
            'mentor' => ['resume'],
            default => [],
        };
    }

    /**
     * Validation rules per role, matching the fields in each
     * profile.fields.{role} partial.
     */
    private function rulesForRole(string $role): array
    {
        return match ($role) {
            'student' => [
                'college_name' => 'nullable|string|max:255',
                'university' => 'nullable|string|max:255',
                'course' => 'nullable|string|max:255',
                'year' => 'nullable|string|max:50',
                'interested_domain' => 'nullable|string|max:255',
                'skills' => 'nullable|string|max:1000',
                'college_id_card' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:1024',
                'resume' => 'nullable|file|mimes:pdf,doc,docx|max:1024',
            ],
            'employee' => [
                'company_name' => 'nullable|string|max:255',
                'designation' => 'nullable|string|max:255',
                'experience_years' => 'nullable|integer|min:0',
                'current_ctc' => 'nullable|numeric|min:0',
                'expected_ctc' => 'nullable|numeric|min:0',
                'linkedin' => 'nullable|url|max:255',
                'skills' => 'nullable|string|max:1000',
                'resume' => 'nullable|file|mimes:pdf,doc,docx|max:1024',
                'experience_proof' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:1024',
            ],
            'employer' => [
                'company_name' => 'nullable|string|max:255',
                'industry' => 'nullable|string|max:255',
                'company_size' => 'nullable|string|max:50',
                'gst_number' => 'nullable|string|max:50',
                'pan_number' => 'nullable|string|max:50',
                'website' => 'nullable|url|max:255',
                'company_address' => 'nullable|string|max:2000',
                'company_logo' => 'nullable|image|max:2048',
                'company_documents' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:1024',
            ],
            'freelancer' => [
                'specialization' => 'nullable|string|max:255',
                'experience' => 'nullable|integer|min:0',
                'hourly_rate' => 'nullable|numeric|min:0',
                'availability' => 'nullable|string|max:50',
                'portfolio_link' => 'nullable|url|max:255',
                'github' => 'nullable|url|max:255',
                'linkedin' => 'nullable|url|max:255',
                'skills' => 'nullable|string|max:1000',
            ],
            'investor' => [
                'organization' => 'nullable|string|max:255',
                'investment_stage' => 'nullable|string|max:50',
                'investment_range' => 'nullable|string|max:100',
                'website' => 'nullable|url|max:255',
                'linkedin' => 'nullable|url|max:255',
                'verification_document' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:1024',
                'preferred_sectors' => 'nullable|string|max:1000',
                'bio' => 'nullable|string|max:2000',
            ],
            'mentor' => [
                'company' => 'nullable|string|max:255',
                'designation' => 'nullable|string|max:255',
                'years_of_experience' => 'nullable|integer|min:0',
                'availability' => 'nullable|string|max:50',
                'expertise' => 'nullable|string|max:1000',
                'linkedin' => 'nullable|url|max:255',
                'resume' => 'nullable|file|mimes:pdf,doc,docx|max:1024',
                'bio' => 'nullable|string|max:2000',
            ],
            default => [],
        };
    }

    /**
     * Simple profile-strength percentage based on how many
     * user + registration fields are filled in.
     */
    private function calculateProfileStrength($user): int
    {
        $userFields = [$user->name, $user->email, $user->phone, $user->avatar, $user->language];
        $filled = collect($userFields)->filter(fn($value) => ! empty($value))->count();
        $total = count($userFields);

        $role = strtolower($user->role ?? '');
        $registration = $this->registrationFor($user, $role);

        if ($registration) {
            $regValues = collect($registration->getAttributes())
                ->except(['id', 'user_id', 'created_at', 'updated_at']);

            $filled += $regValues->filter(fn($value) => ! empty($value))->count();
            $total += $regValues->count();
        }

        return $total > 0 ? (int) round(($filled / $total) * 100) : 0;
    }
    public function updateBasicInfo(Request $request): RedirectResponse
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
        ]);

        $user->update($validated);

        return back()->with('success', 'Your basic details have been updated.');
    }
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = Auth::user();

        if (! Hash::check($request->current_password, $user->password)) {
            throw ValidationException::withMessages([
                'current_password' => ['The current password you entered is incorrect.'],
            ]);
        }

        if (Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'password' => ['New password must be different from your current password.'],
            ]);
        }

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return back()->with('status', 'password-updated');
    }
    public function profile(Request $request)
    {
        $user = $request->user();
        $role = strtolower($user->role ?? '');
        $registration = $this->registrationFor($user, $role);

        $profileStrength = $this->calculateProfileStrength($user);

        $avatarImage = $registration && $registration->profile_photo
            ? Storage::url($registration->profile_photo)
            : null;
        // dd($avatarImage);   
        $coverImage = $registration && $registration->cover_photo
            ? Storage::url($registration->cover_photo)
            : null;

        return view('profile.profile', compact('user', 'registration', 'profileStrength', 'avatarImage', 'coverImage'));
    }
}
