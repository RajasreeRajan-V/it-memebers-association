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
            // Alphabets + Numbers + Special characters
            'startup_name' => [
                'required', 'string', 'max:255',
                'regex:/^[A-Za-z0-9\s\-&().,]+$/',
            ],

            'logo' => ['nullable', 'image', 'max:2048'],

            // Alphabets + Numbers + Hyphen
            'team_size' => [
                'nullable', 'string', 'max:100',
                'regex:/^[A-Za-z0-9\s-]+$/',
            ],

            // Alphabets only
            'country'  => ['nullable', 'string', 'max:100', 'regex:/^[A-Za-z\s]+$/'],
            'state'    => ['nullable', 'string', 'max:100', 'regex:/^[A-Za-z\s]+$/'],
            'district' => ['nullable', 'string', 'max:100', 'regex:/^[A-Za-z\s]+$/'],
            'city'     => ['nullable', 'string', 'max:100', 'regex:/^[A-Za-z\s]+$/'],

            'website' => ['nullable', 'url', 'max:255'],

            // Alphabets + Numbers + Special characters
            'industry' => [
                'nullable', 'string', 'max:150',
                'regex:/^[A-Za-z0-9\s\-&\/,.]+$/',
            ],

            // Alphabets only
            'founder_name' => [
                'required', 'string', 'max:150',
                'regex:/^[A-Za-z\s]+$/',
            ],

            // Numbers + currency symbols only (no letters)
            'funding_required' => [
                'nullable', 'string', 'max:100',
                'regex:/^[0-9₹$,.\-\s\/]+$/',
            ],

            // Any characters
            'business_description' => ['required', 'string', 'max:5000'],

            'contact_email' => ['required', 'email', 'max:255'],

            // Numbers + + - spaces (no letters)
            'phone_number' => [
                'required', 'string', 'max:20',
                'regex:/^[0-9+\-\s]+$/',
            ],

            'pitch_summary' => ['nullable', 'file', 'mimes:pdf,doc,docx,ppt,pptx', 'max:5120'],
        ], [
            'startup_name.regex'     => 'Startup name can only contain letters, numbers, and & ( ) . , -',
            'team_size.regex'        => 'Team size can only contain letters, numbers, and -',
            'country.regex'          => 'Country can only contain letters.',
            'state.regex'            => 'State can only contain letters.',
            'district.regex'         => 'District can only contain letters.',
            'city.regex'             => 'City can only contain letters.',
            'industry.regex'         => 'Industry can only contain letters, numbers, and - & / , .',
            'founder_name.regex'     => 'Founder name can only contain letters.',
            'funding_required.regex' => 'Funding required can only contain numbers and ₹ $ , . - / (no letters).',
            'phone_number.regex'     => 'Phone number can only contain numbers, +, -, and spaces (no letters).',
        ]);
    }
}