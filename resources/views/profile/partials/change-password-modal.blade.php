{{-- resources/views/profile/partials/change-password-modal.blade.php --}}
<div class="modal-overlay" id="changePasswordModalOverlay" @if (!$errors->hasAny(['current_password', 'password', 'password_confirmation'])) hidden @endif>
    <div class="modal-box">
        <div class="modal-header">
            <h3>Change Password</h3>
            <button type="button" class="modal-close" id="changePasswordModalClose" aria-label="Close">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <form method="POST" action="{{ route('profile.password.update') }}" class="modal-form"
            id="changePasswordForm" novalidate>
            @csrf
            @method('PUT')

            <div class="modal-field">
                <label for="current_password">Current Password</label>
                <input type="password" id="current_password" name="current_password"
                    autocomplete="current-password"
                    class="@error('current_password') is-invalid @enderror" required>
                <span class="field-error" id="currentPasswordError">@error('current_password'){{ $message }}@enderror</span>
            </div>

            <div class="modal-field">
                <label for="new_password">New Password</label>
                <input type="password" id="new_password" name="password" autocomplete="new-password"
                    minlength="8" class="@error('password') is-invalid @enderror" required>
                <span class="field-error" id="newPasswordError">@error('password'){{ $message }}@enderror</span>
                <small class="field-hint">Min. 8 characters, with an uppercase letter, a lowercase letter and a
                    number.</small>
            </div>

            <div class="modal-field">
                <label for="new_password_confirmation">Confirm New Password</label>
                <input type="password" id="new_password_confirmation" name="password_confirmation"
                    autocomplete="new-password" required>
                <span class="field-error" id="confirmPasswordError"></span>
            </div>

            <div class="modal-actions">
                <button type="button" class="btn modal-btn-cancel" id="changePasswordModalCancel">Cancel</button>
                <button type="submit" class="btn btn-primary">Update Password</button>
            </div>
        </form>
    </div>
</div>

@if ($errors->hasAny(['current_password', 'password', 'password_confirmation']))
    <script>
        window.reopenChangePasswordModal = true;
    </script>
@endif