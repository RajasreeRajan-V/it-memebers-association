@extends('layouts.app')

@section('content')
<div style="margin-bottom:1rem;">
    <a class="btn btn-primary" href="{{ route('mentor.webinars.create') }}"><i class="fa-solid fa-plus"></i> Create Webinar</a>
</div>

<div class="mentor-card">
    <table class="mentor-table">
        <thead>
            <tr><th>Title</th><th>Date</th><th>Status</th><th>Admin Remarks</th><th></th></tr>
        </thead>
        <tbody>
            @forelse($webinars as $webinar)
                <tr>
                    <td>{{ $webinar->title }}</td>
                    <td>{{ $webinar->scheduled_date->format('d M Y') }} {{ \Carbon\Carbon::parse($webinar->scheduled_time)->format('h:i A') }}</td>
                    <td><span class="badge-status badge-{{ $webinar->status }}">{{ ucfirst($webinar->status) }}</span></td>
                    <td>{{ $webinar->admin_remarks ?? '-' }}</td>
                    <td>
                        @if($webinar->status !== 'published')
                            <a class="btn btn-outline" href="{{ route('mentor.webinars.edit', $webinar) }}">Edit</a>
                        @endif
                    </td>
                </tr>
            @empty
                <tr><td colspan="5">No webinars yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
{{ $webinars->links() }}
@endsection
