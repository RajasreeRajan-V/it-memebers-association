{{-- resources/views/profile/partials/header.blade.php --}}
<div class="profile-header">
    <div>
        <p class="eyebrow">Let's get started</p>
        <h2>Complete your profile</h2>
        <p class="subheading">Add these mandatory sections to complete your profile</p>
    </div>
    <div class="profile-toggles">
        <div class="toggle-item">
            <span class="toggle-label">
                Show to Corporates
                <i class="fa-solid fa-circle-info" title="Corporates can view your profile"></i>
            </span>
            <label class="toggle-switch">
                <input type="checkbox" id="showToCorporates" name="show_to_corporates"
                    {{ $user->show_to_corporates ?? true ? 'checked' : '' }}>
                <span class="toggle-slider"></span>
            </label>
        </div>
        <div class="toggle-item">
            <span class="toggle-label">
                Looking for Jobs
                <i class="fa-solid fa-circle-info" title="Let recruiters know you are open to opportunities"></i>
            </span>
            <label class="toggle-switch">
                <input type="checkbox" id="lookingForJobs" name="looking_for_jobs"
                    {{ $user->looking_for_jobs ?? true ? 'checked' : '' }}>
                <span class="toggle-slider"></span>
            </label>
        </div>
    </div>
</div>