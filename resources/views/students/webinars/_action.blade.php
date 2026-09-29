@php
    $status = $myRegistrations[$event->id] ?? null;
    $isPast = \Illuminate\Support\Carbon::parse($event->scheduled_date)->lt(\Illuminate\Support\Carbon::today());
@endphp

@if($status === null)
    <form method="POST" action="{{ route('student.webinars.register', $event) }}">
        @csrf
        <button type="submit" class="btn btn-primary" style="padding:7px 18px;font-size:0.8rem;">
            Register
        </button>
    </form>
@elseif($status === 'pending')
    <a href="{{ route('student.webinars.show', $event) }}" class="status-badge status-pending">
        ⏳ Waitlisted
    </a>
@elseif($isPast)
    <a href="{{ route('student.webinars.show', $event) }}" class="status-badge status-completed">
        ✓ Completed
    </a>
@else
    <a href="{{ route('student.webinars.show', $event) }}" class="status-badge status-registered">
        ✓ Registered
    </a>
@endif