@php
    $status = strtolower($status ?? 'unknown');

    $badgeClass = match ($status) {
        'draft' => 'bg-secondary',
        'pending', 'submitted' => 'bg-warning text-dark',
        'approved', 'published' => 'bg-success',
        'rejected' => 'bg-danger',
        'cancelled' => 'bg-dark',
        default => 'bg-info',
    };

    $statusLabel = match ($status) {
        'draft' => 'Draft',
        'pending' => 'Pending Approval',
        'submitted' => 'Submitted',
        'approved' => 'Approved',
        'published' => 'Published',
        'rejected' => 'Rejected',
        'cancelled' => 'Cancelled',
        default => ucfirst($status),
    };
@endphp

<span class="badge {{ $badgeClass }}">
    {{ $statusLabel }}
</span>