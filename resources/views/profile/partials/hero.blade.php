{{-- resources/views/profile/partials/hero.blade.php --}}
<section class="profile-hero"
    @if ($coverImage) style="background-image:url('{{ asset($coverImage) }}');" @endif>
    <div class="container profile-hero-inner">
        <div class="profile-identity">
            <div class="profile-avatar-wrapper">
                @if ($avatarImage)
                    <img src="{{ asset($avatarImage) }}" alt="{{ $user->name ?? 'Profile' }}" class="profile-avatar">
                @else
                    <div class="profile-avatar profile-avatar-placeholder">
                        <i class="fa-solid fa-user"></i>
                    </div>
                @endif

                <form method="POST" action="{{ route('profile.picture.upload') }}" enctype="multipart/form-data"
                    id="avatarForm" novalidate>
                    @csrf
                    <label for="avatarUpload" class="avatar-upload-btn">
                        <i class="fa-solid fa-camera"></i>
                    </label>
                    <input type="file" id="avatarUpload" name="profile_photo"
                        accept="image/png,image/jpeg,image/webp,image/gif" hidden>
                </form>
                <span class="field-error" id="avatarError"></span>
            </div>
            <h1 class="profile-name">{{ $user->name ?? 'Your Name' }}</h1>
        </div>

        <div class="profile-hero-actions">
            <button type="button" id="editProfileBtn" class="btn btn-outline-light">
                <i class="fa-solid fa-user-shield"></i> Edit Profile
            </button>
            <button type="button" id="changePasswordBtn" class="btn btn-primary">
                <i class="fa-solid fa-key"></i> Change Password
            </button>
        </div>
    </div>
</section>