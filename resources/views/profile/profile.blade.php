@extends('layouts.app')

@section('title', 'Edit Profile')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endpush

@section('content')

    @php
        $user = Auth::user();

        // Get role-specific registration
        $role = strtolower($user->role ?? '');

        $registration = match ($role) {
            'student' => $user->studentRegistration ?? null,
            'employee' => $user->employeeRegistration ?? null,
            'employer' => $user->employerRegistration ?? null,
            'investor' => $user->investorRegistration ?? null,
            'freelancer' => $user->freelancerRegistration ?? null,
            'mentor' => $user->mentorRegistration ?? null,
            default => null,
        };

        // Helper for form values with old() fallback
        $val = fn($key, $default = null) => old($key, data_get($registration, $key, $default));

        // Strength label/class
        $strengthClass = $profileStrength < 40 ? 'low' : ($profileStrength < 75 ? 'medium' : 'high');
        $strengthLabel = $profileStrength < 40 ? 'Low' : ($profileStrength < 75 ? 'Medium' : 'High');
    @endphp

    @include('profile.partials.hero', ['user' => $user, 'coverImage' => $coverImage, 'avatarImage' => $avatarImage])

    @include('profile.partials.change-password-modal')

    @include('profile.partials.info-bar', ['user' => $user])

    <main class="profile-main">
        <div class="container">

            @include('profile.partials.header', ['user' => $user])

            <hr class="divider">

            @include('profile.partials.resume')

            <div id="editProfileSection" class="edit-section" hidden>
                <div class="details-card">
                    <div class="details-header">
                        <p class="eyebrow">Keep it up to date</p>
                        <h2>Edit your {{ $role ?: 'profile' }} details</h2>
                        <p class="subheading">Update your information so recruiters always see the latest you</p>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-error">
                            <i class="fa-solid fa-triangle-exclamation"></i>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @include('profile.partials.edit-profile', [
                        'role' => $role,
                        'val' => $val,
                        'registration' => $registration,
                    ])
                </div>
            </div>

        </div>

        @include('profile.partials.basic-info-modal', ['user' => $user])
    </main>

@endsection

@push('scripts')
    <script src="{{ asset('js/profile.js') }}"></script>
@endpush