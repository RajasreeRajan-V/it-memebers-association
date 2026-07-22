{{-- resources/views/profile/partials/edit-profile.blade.php --}}
{{-- Expects: $role (string), $val (closure), $registration (model|null) --}}
<form method="POST" action="{{ route('profile.details.update') }}" enctype="multipart/form-data" class="profile-form"
    id="profileDetailsForm" novalidate>
    @csrf
    @method('PUT')
    <input type="hidden" name="role" value="{{ $role }}">

    <div class="form-grid">
        @switch($role)
            @case('student')
                @include('profile.fields.student', ['val' => $val, 'registration' => $registration])
            @break

            @case('employee')
                @include('profile.fields.employee', ['val' => $val, 'registration' => $registration])
            @break

            @case('employer')
                @include('profile.fields.employer', ['val' => $val, 'registration' => $registration])
            @break

            @case('freelancer')
                @include('profile.fields.freelancer', ['val' => $val, 'registration' => $registration])
            @break

            @case('investor')
                @include('profile.fields.investor', ['val' => $val, 'registration' => $registration])
            @break

            @case('mentor')
                @include('profile.fields.mentor', ['val' => $val, 'registration' => $registration])
            @break

            @default
                <p class="text-muted">Please contact support if you see this message.</p>
        @endswitch
    </div>

    @if ($role)
        <button type="submit" class="btn btn-primary btn-lg">
            <i class="fa-solid fa-floppy-disk"></i> Save Changes
        </button>
    @endif
</form>