@extends('admin.layout.app')

@section('content')
<div class="content-header">
    <h2>Training Programs</h2>
    <p>Review mentor-submitted trainings, approve, reject, or publish them.</p>
</div>

@if (session('success'))
    <div class="card" style="padding:10px 16px; margin-bottom:14px; background:#ECFDF5; color:#065F46;">
        {{ session('success') }}
    </div>
@endif

<div class="card" style="padding:1rem 1.25rem; margin-bottom:1rem; display:flex; gap:14px;">
    <span>Pending: <strong>{{ $counts['pending'] }}</strong></span>
    <span>Approved: <strong>{{ $counts['approved'] }}</strong></span>
    <span>Published: <strong>{{ $counts['published'] }}</strong></span>
    <span>Rejected: <strong>{{ $counts['rejected'] }}</strong></span>
</div>

<form method="GET" action="{{ route('admin.trainings.index') }}" class="card" style="padding:1rem 1.25rem; margin-bottom:1rem; display:flex; gap:10px;">
    <input type="text" name="q" value="{{ request('q') }}" placeholder="Search title...">
    <select name="status" onchange="this.form.submit()">
        <option value="">All Status</option>
        @foreach (['draft','pending','approved','published','rejected','archived'] as $s)
            <option value="{{ $s }}" {{ request('status') === $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
        @endforeach
    </select>
    <button type="submit">Filter</button>
</form>

<div class="card" style="padding:1.25rem;">
    <table class="table" style="width:100%;">
        <thead>
            <tr>
                <th>Title</th><th>Mentor</th><th>Category</th>
                <th>Modules</th><th>Materials</th><th>Status</th><th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($trainings as $training)
                <tr>
                    <td>{{ $training->title }}</td>
                    <td>{{ $training->mentor->name ?? '-' }}</td>
                    <td>{{ $training->category }}</td>
                    <td>{{ $training->modules_count }}</td>
                    <td>{{ $training->materials_count }}</td>
                    <td>{{ ucfirst($training->status) }}</td>
                    <td>
                        <a href="{{ route('admin.trainings.show', $training) }}">Review</a>

                        @if ($training->status === 'pending')
                            <form method="POST" action="{{ route('admin.trainings.approve', $training) }}" style="display:inline">
                                @csrf<button type="submit">Approve</button>
                            </form>
                            <form method="POST" action="{{ route('admin.trainings.reject', $training) }}" style="display:inline"
                                  onsubmit="return promptReject(this)">
                                @csrf
                                <input type="hidden" name="admin_feedback" class="reject-reason-input">
                                <button type="submit">Reject</button>
                            </form>
                        @elseif ($training->status === 'approved')
                            <form method="POST" action="{{ route('admin.trainings.publish', $training) }}" style="display:inline">
                                @csrf<button type="submit">Publish</button>
                            </form>
                        @elseif ($training->status === 'published')
                            <form method="POST" action="{{ route('admin.trainings.unpublish', $training) }}" style="display:inline">
                                @csrf<button type="submit">Unpublish</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr><td colspan="7">No training programs submitted yet.</td></tr>
            @endforelse
        </tbody>
    </table>
    {{ $trainings->links() }}
</div>

<script>
    function promptReject(form) {
        const reason = prompt('Reason for rejecting this training:');
        if (!reason || !reason.trim()) return false;
        form.querySelector('.reject-reason-input').value = reason.trim();
        return true;
    }
</script>
@endsection