{{-- resources/views/profile/partials/basic-info-modal.blade.php --}}
<div class="modal-overlay" id="basicInfoModalOverlay" hidden>
    <div class="modal-box">
        <div class="modal-header">
            <h3>Edit Basic Details</h3>
            <button type="button" class="modal-close" id="basicInfoModalClose" aria-label="Close">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <form method="POST" action="{{ route('profile.basic.update') }}" class="modal-form" id="basicInfoForm"
            novalidate>
            @csrf
            @method('PUT')

            <div class="modal-field">
                <label for="modal_name">Full Name</label>
                <input type="text" id="modal_name" name="name" value="{{ old('name', $user->name) }}" minlength="2"
                    maxlength="100" required>
                <span class="field-error" id="nameError"></span>
                @error('name')
                    <span class="modal-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="modal-field">
                <label for="modal_email">Email ID</label>
                <input type="email" id="modal_email" name="email" value="{{ old('email', $user->email) }}" required>
                <span class="field-error" id="emailError"></span>
                @error('email')
                    <span class="modal-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="modal-field">
                <label for="modal_phone">Phone</label>
                <input type="text" id="modal_phone" name="phone" value="{{ old('phone', $user->phone) }}"
                    inputmode="tel" required>
                <span class="field-error" id="phoneError"></span>
                @error('phone')
                    <span class="modal-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="modal-actions">
                <button type="button" class="btn modal-btn-cancel" id="basicInfoModalCancel">Cancel</button>
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
        </form>
    </div>
</div>