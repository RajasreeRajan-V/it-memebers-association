<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class ProfileService
{
    /**
     * Get the config block for a role, e.g. config('profile.roles.student').
     */
    protected function roleConfig(string $role): ?array
    {
        return config("profile.roles.{$role}");
    }

    /**
     * Resolve the user's role-specific registration model instance
     * via the relation name defined in config/profile.php.
     */
    protected function registrationFor($user, string $role)
    {
        $config = $this->roleConfig($role);

        if (! $config) {
            return null;
        }

        $relation = $config['relation'];

        return $user->{$relation};
    }

    /**
     * Build a brand new (unsaved) registration model for the role.
     */
    protected function newRegistration($user, string $role)
    {
        $config = $this->roleConfig($role);

        if (! $config) {
            return null;
        }

        $modelClass = $config['model'];

        $registration = new $modelClass();
        $registration->user_id = $user->id;

        return $registration;
    }

    /**
     * File input names for the role, from config/profile.php.
     */
    protected function fileFieldsForRole(string $role): array
    {
        return $this->roleConfig($role)['files'] ?? [];
    }

    /**
     * Avatar field name for the role (null if the role has no avatar).
     */
    protected function avatarFieldForRole(string $role): ?string
    {
        return $this->roleConfig($role)['avatar'] ?? null;
    }

    /**
     * Validation rules per role, matching the fields in each
     * profile.fields.{role} partial.
     *
     * NOTE: candidate for moving into UpdateProfileRequest::rules()
     * if you want the service to stay validation-free.
     */
    protected function rulesForRole(string $role): array
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
     * Data needed to render the profile page.
     */
    public function profileData($user): array
    {
        $role = strtolower($user->role ?? '');
        $registration = $this->registrationFor($user, $role);

        $profileStrength = $this->calculateProfileStrength($user, $role, $registration);

        $avatarImage = $registration && $registration->profile_photo
            ? $registration->profile_photo
            : null;

        $coverImage = $registration && $registration->cover_photo
            ? $registration->cover_photo
            : null;
        // dd($avatarImage);
        return compact('user', 'registration', 'profileStrength', 'avatarImage', 'coverImage');
    }

    /**
     * Update the role-specific registration details (+ any of its file fields).
     */
    public function updateDetails(Request $request): void
    {
        $user = Auth::user();
        $role = strtolower($user->role ?? '');

        $config = $this->roleConfig($role);

        if (! $config) {
            throw ValidationException::withMessages([
                'role' => 'We could not determine your account type.',
            ]);
        }

        $rules = $this->rulesForRole($role);
        $validated = $request->validate($rules);

        $registration = $this->registrationFor($user, $role)
            ?? $this->newRegistration($user, $role);

        foreach ($this->fileFieldsForRole($role) as $field) {
            if ($request->hasFile($field)) {
                if ($registration->{$field}) {
                    Storage::disk('public')->delete($registration->{$field});
                }
                $validated[$field] = $request->file($field)->store("registrations/{$role}", 'public');
            } else {
                // don't overwrite an existing file with null when nothing new was uploaded
                unset($validated[$field]);
            }
        }

        $registration->fill($validated);
        $registration->save();
    }

    /**
     * Handle the resume dropzone upload (top resume-card form).
     */
    public function uploadResume(Request $request): void
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
    }

    /**
     * Handle avatar (profile photo) upload.
     */
    public function uploadAvatar(Request $request): void
    {
        $request->validate([
            'profile_photo' => 'required|image|max:2048',
        ]);

        $user = Auth::user();
        $role = strtolower($user->role ?? '');

        $config = $this->roleConfig($role);

        if (! $config) {
            throw ValidationException::withMessages([
                'profile_photo' => 'We could not determine your account type.',
            ]);
        }

        $registration = $this->registrationFor($user, $role)
            ?? $this->newRegistration($user, $role);

        if ($registration->profile_photo) {
            Storage::disk('public')->delete($registration->profile_photo);
        }

        $path = $request->file('profile_photo')->store('avatars', 'public');
        $registration->profile_photo = $path;
        $registration->save();
    }

    /**
     * Update basic user info (name/email/phone).
     */
    public function updateBasicInfo(Request $request): void
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
        ]);

        $user->update($validated);
    }

    /**
     * Change the user's password.
     */
    public function updatePassword(Request $request): void
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
    }

    public function verifyCurrentPassword(Request $request): array
    {
        $request->validate([
            'current_password' => ['required', 'string'],
        ]);

        $user = Auth::user();

        $valid = Hash::check($request->current_password, $user->password);

        return [
            'valid' => $valid,
            'message' => $valid ? null : 'The current password you entered is incorrect.',
        ];
    }
    /**
     * Update the "Show to Corporates" / "Looking for Jobs" toggles.
     */
    public function updateToggles(Request $request): void
    {
        $request->validate([
            'show_to_corporates' => 'sometimes|boolean',
            'looking_for_jobs' => 'sometimes|boolean',
        ]);

        Auth::user()->update([
            'show_to_corporates' => $request->boolean('show_to_corporates'),
            'looking_for_jobs' => $request->boolean('looking_for_jobs'),
        ]);
    }

    /**
     * Simple profile-strength percentage based on how many
     * user + registration fields are filled in.
     */
    protected function calculateProfileStrength($user, string $role, $registration): int
    {
        $userFields = [$user->name, $user->email, $user->phone, $user->avatar, $user->language];
        $filled = collect($userFields)->filter(fn($value) => ! empty($value))->count();
        $total = count($userFields);

        if ($registration) {
            $regValues = collect($registration->getAttributes())
                ->except(['id', 'user_id', 'created_at', 'updated_at']);

            $filled += $regValues->filter(fn($value) => ! empty($value))->count();
            $total += $regValues->count();
        }

        return $total > 0 ? (int) round(($filled / $total) * 100) : 0;
    }
}
