@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/mentor-theme.css') }}">
@endpush

@section('content')
<div class="mentor-shell">

    <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:16px;">
        <div>
            <h2 style="font-size:1.2rem;font-weight:700;">{{ $webinar->title }}</h2>
            <p style="color:var(--mt-text-muted);font-size:0.85rem;">
                {{ $registrations->total() }} registered
                @if($webinar->capacity) / {{ $webinar->capacity }} capacity @endif
            </p>
        </div>
       <a href="{{ route('mentor.webinars.index') }}" class="btn btn-secondary">
    <i class="fa-solid fa-arrow-left"></i> Back to Webinars
</a>
    </div>

    <div class="mentor-card" style="padding:0;">
        <table style="width:100%; border-collapse:collapse;">
            <thead>
                <tr style="text-align:left; border-bottom:1px solid var(--mt-border);">
                    <th style="padding:12px 16px;">Name</th>
                    <th style="padding:12px 16px;">Email</th>
                    <th style="padding:12px 16px;">Status</th>
                    <th style="padding:12px 16px;">Registered At</th>
                </tr>
            </thead>
            <tbody>
                @forelse($registrations as $registration)
                    <tr style="border-bottom:1px solid var(--mt-border);">
                        <td style="padding:12px 16px;">{{ $registration->student->name ?? '—' }}</td>
                        <td style="padding:12px 16px;">{{ $registration->student->email ?? '—' }}</td>
                        <td style="padding:12px 16px;">
                            <span class="tag-status {{ $registration->status === 'approved' ? 'badge-approved' : 'badge-draft' }}">
                                {{ ucfirst($registration->status) }}
                            </span>
                        </td>
                        <td style="padding:12px 16px;">
                            {{ optional($registration->registered_at)->format('d M Y, h:i A') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" style="padding:32px 16px; text-align:center; color:var(--mt-text-muted);">
                            No registrations yet.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mentor-pagination" style="padding:16px;">
            {{ $registrations->links() }}
        </div>
    </div>

</div>
@endsection
