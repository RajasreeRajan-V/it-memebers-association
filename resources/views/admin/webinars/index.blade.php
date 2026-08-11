@extends('admin.layout.app')
@section('content')
<div class="content-header">
    <h2>Webinar Management</h2>
    <p>Approve, reject, or publish mentor-submitted webinars.</p>
</div>

<div class="card" style="padding:1.25rem;">
    <table class="table" style="width:100%;">
        <thead>
            <tr><th>Title</th><th>Mentor</th><th>Date</th><th>Status</th><th>Actions</th></tr>
        </thead>
        <tbody>
            @forelse($webinars as $webinar)
                <tr>
                    <td>{{ $webinar->title }}</td>
                    <td>{{ $webinar->mentor->name ?? '-' }}</td>
                    <td>{{ $webinar->scheduled_date->format('d M Y') }}</td>
                    <td>{{ ucfirst($webinar->status) }}</td>
                    <td>
                        @if($webinar->status === 'pending')
                            <form method="POST" action="{{ route('admin.webinars.approve', $webinar) }}" style="display:inline">
                                @csrf<button type="submit">Approve</button>
                            </form>
                            <form method="POST" action="{{ route('admin.webinars.reject', $webinar) }}" style="display:inline">
                                @csrf
                                <input type="text" name="admin_remarks" placeholder="Reason" required>
                                <button type="submit">Reject</button>
                            </form>
                        @elseif($webinar->status === 'approved')
                            <form method="POST" action="{{ route('admin.webinars.publish', $webinar) }}" style="display:inline">
                                @csrf<button type="submit">Publish</button>
                            </form>
                        @else
                            <span>{{ $webinar->admin_remarks }}</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr><td colspan="5">No webinars submitted yet.</td></tr>
            @endforelse
        </tbody>
    </table>
    {{ $webinars->links() }}
</div>
@endsection
