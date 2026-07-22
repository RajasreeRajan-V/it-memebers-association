{{-- resources/views/profile/partials/info-bar.blade.php --}}
<section class="profile-info-bar">
    <div class="container profile-info-inner">
        <div class="info-item">
            <span class="info-label">Name</span>
            <span class="info-value">{{ $user->name ?? '—' }}</span>
        </div>
        <div class="info-item">
            <span class="info-label">Email</span>
            <span class="info-value">{{ $user->email ?? '—' }}</span>
        </div>
        <div class="info-item">
            <span class="info-label">Phone</span>
            <span class="info-value">{{ $user->phone ?? '—' }}</span>
        </div>
        <div class="info-item info-password">
            <span class="info-label">Password</span>
            <span class="info-value info-password-value">
                {{ $user->password ? str_repeat('•', 10) : '—' }}
            </span>
        </div>

        <a href="#" class="info-edit-btn" id="editBasicInfoBtn" title="Edit">
            <i class="fa-solid fa-pen"></i>
        </a>
    </div>
</section>