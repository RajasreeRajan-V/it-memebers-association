@php
    $webinar = $reg->webinar;
    $d = \Illuminate\Support\Carbon::parse($webinar->scheduled_date);
    $t = $webinar->scheduled_time ? \Illuminate\Support\Carbon::parse($webinar->scheduled_time)->format('h:i A') : null;
@endphp

<div class="material-card" style="margin-bottom:12px;">
    <div class="material-icon {{ $webinar->type === 'workshop' ? 'c2' : 'c1' }}">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 18.75h9a1.5 1.5 0 001.5-1.5v-7.5a1.5 1.5 0 00-1.5-1.5h-9a1.5 1.5 0 00-1.5 1.5v7.5a1.5 1.5 0 001.5 1.5z" />
        </svg>
    </div>

    <div class="material-card-body">
        <h3 class="material-card-title">{{ $webinar->title }}</h3>
        <div class="material-card-meta">
            {{ $d->format('d M, Y') }}
            @if($t) &middot; {{ $t }} @endif
            @if($webinar->platform) &middot; {{ $webinar->platform }} @endif
        </div>
    </div>

    <div class="material-card-stats">
        @if($isPast)
            <span class="status-badge status-completed">✓ Completed</span>

            @if($webinar->resources->firstWhere('type', 'recording'))
                <a href="{{ $webinar->resources->firstWhere('type', 'recording')->link }}" target="_blank" style="display:block;margin-top:6px;font-size:0.78rem;">
                    🎬 Watch Recording
                </a>
            @endif

            @if($reg->attendance_status === 'attended')
                <a href="{{ route('student.webinars.certificate', $webinar) }}" style="display:block;margin-top:4px;font-size:0.78rem;">
                    🏆 Download Certificate
                </a>
            @endif
        @elseif($reg->status === 'pending')
            <span class="status-badge status-pending">⏳ Waitlisted</span>
        @else
            <span class="status-badge status-registered">✓ Registered</span>
        @endif

        <a href="{{ route('student.webinars.show', $webinar) }}" class="btn btn-primary" style="margin-top:10px;padding:7px 18px;font-size:0.8rem;">
            View Details
        </a>
    </div>
</div>