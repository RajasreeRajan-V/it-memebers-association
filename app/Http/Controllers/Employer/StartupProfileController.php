<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\StartupProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class StartupProfileController extends Controller
{
    public function index()
    {
        $profile = StartupProfile::where('employer_id', Auth::id())->first();

        if (!$profile) {
            return redirect()->route('employer.startup-profile.create');
        }

        return view('employers.startup-profile.index', compact('profile'));
    }

    public function show()
    {
        $profile = StartupProfile::where('employer_id', Auth::id())->first();

        if (!$profile) {
            return redirect()->route('employer.startup-profile.create');
        }

        return view('employers.startup-profile.show', compact('profile'));
    }

    public function create()
    {
        if (StartupProfile::where('employer_id', Auth::id())->exists()) {
            return redirect()->route('employer.startup-profile.edit');
        }

        return view('employers.startup-profile.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validateProfile($request);
        $validated['employer_id'] = Auth::id();
        $validated['status'] = 'pending';

        if ($request->hasFile('logo')) {
            $validated['logo_path'] = $request->file('logo')->store('startup-logos', 'public');
        }

        if ($request->hasFile('pitch_summary')) {
            $validated['pitch_summary_path'] = $request->file('pitch_summary')->store('pitch-summaries', 'public');
        }

        StartupProfile::create($validated);

        return redirect()
            ->route('employer.startup-profile.index')
            ->with('success', 'Startup profile submitted successfully and is awaiting admin approval.');
    }

    public function edit()
    {
        $profile = StartupProfile::where('employer_id', Auth::id())->firstOrFail();

        return view('employers.startup-profile.edit', compact('profile'));
    }

    public function update(Request $request)
    {
        $profile = StartupProfile::where('employer_id', Auth::id())->firstOrFail();

        $validated = $this->validateProfile($request);

        if ($request->hasFile('logo')) {
            if ($profile->logo_path) {
                Storage::disk('public')->delete($profile->logo_path);
            }
            $validated['logo_path'] = $request->file('logo')->store('startup-logos', 'public');
        }

        if ($request->hasFile('pitch_summary')) {
            if ($profile->pitch_summary_path) {
                Storage::disk('public')->delete($profile->pitch_summary_path);
            }
            $validated['pitch_summary_path'] = $request->file('pitch_summary')->store('pitch-summaries', 'public');
        }

        $validated['status'] = 'pending';
        $validated['rejection_reason'] = null;

        $profile->update($validated);

        return redirect()
            ->route('employer.startup-profile.index')
            ->with('success', 'Startup profile updated successfully and is awaiting admin approval.');
    }

    public function destroy()
    {
        $profile = StartupProfile::where('employer_id', Auth::id())->firstOrFail();

        if ($profile->logo_path) {
            Storage::disk('public')->delete($profile->logo_path);
        }

        if ($profile->pitch_summary_path) {
            Storage::disk('public')->delete($profile->pitch_summary_path);
        }

        $profile->delete();

        return redirect()
            ->route('employer.startup-profile.create')
            ->with('success', 'Startup profile deleted.');
    }

    private function validateProfile(Request $request): array
    {
        return $request->validate([
            'startup_name'          => ['required', 'string', 'max:255'],
            'logo'                  => ['nullable', 'image', 'max:2048'],
            'team_size'             => ['nullable', 'string', 'max:100'],
            'country'               => ['nullable', 'string', 'max:100'],
            'state'                 => ['nullable', 'string', 'max:100'],
            'district'              => ['nullable', 'string', 'max:100'],
            'city'                  => ['nullable', 'string', 'max:100'],
            'website'               => ['nullable', 'url', 'max:255'],
            'industry'              => ['nullable', 'string', 'max:150'],
            'founder_name'          => ['required', 'string', 'max:150'],
            'funding_required'      => ['nullable', 'string', 'max:100'],
            'business_description'  => ['required', 'string'],
            'contact_email'         => ['required', 'email', 'max:255'],
            'phone_number'          => ['required', 'string', 'max:20'],
            'pitch_summary'         => ['nullable', 'file', 'mimes:pdf,doc,docx,ppt,pptx', 'max:5120'],
        ]);
    }
}