@extends('layouts.app')
@section('title', 'Manage Trainings')

@section('content')
<h3 class="mb-4"><i class="bi bi-shield-check"></i> Training Approvals</h3>

<ul class="nav nav-tabs mb-4">
    @foreach ([
        'pending_approval' => 'Pending Approval',
        'approved' => 'Approved',
        'published' => 'Published',
        'rejected' => 'Rejected',
        'all' => 'All',
    ] as $key => $label)
        <li class="nav-item">
            <a class="nav-link {{ $status === $key ? 'active' : '' }}"
               href="{{ route('admin.trainings.index', ['status' => $key]) }}">{{ $label }}</a>
        </li>
    @endforeach
</ul>

<div class="table-responsive">
    <table class="table table-hover bg-white align-middle">
        <thead>
            <tr>
                <th>Title</th>
                <th>Mentor</th>
                <th>Category</th>
                <th>Status</th>
                <th>Submitted</th>
                <th class="text-end">Actions</th>
            </tr>
        </thead>
        <tbody>
        @forelse ($trainings as $training)
            <tr>
                <td>{{ $training->title }}</td>
                <td>{{ $training->mentor->name ?? '—' }}</td>
                <td>{{ $training->category }}</td>
                <td>@include('partials.status-badge', ['status' => $training->status])</td>
                <td>{{ optional($training->submitted_at)->format('d M Y') ?? '—' }}</td>
                <td class="text-end">
                    <a href="{{ route('admin.trainings.show', $training) }}" class="btn btn-sm btn-outline-secondary">Review</a>
                </td>
            </tr>
        @empty
            <tr><td colspan="6" class="text-center text-muted py-4">No trainings found.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>

<div class="mt-3">{{ $trainings->links() }}</div>
@endsection
