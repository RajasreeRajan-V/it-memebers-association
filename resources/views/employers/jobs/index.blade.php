{{-- resources/views/employer/jobs/index.blade.php --}}
@extends('employers.layout.app')

@section('title', 'My Jobs')
@section('page-title', 'Job Postings')
@section('page-subtitle', 'Manage your posted jobs')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-title"><i class="fas fa-briefcase"></i> My Job Postings</div>
            <a href="{{ route('employer.jobs.create') }}" class="quick-link-btn">
                <i class="fas fa-plus"></i> Post New Job
            </a>
        </div>
        <div class="card-body no-pad">
            @if($jobs->isEmpty())
                <div class="empty-state">
                    <i class="fas fa-briefcase"></i>
                    <p>You haven't posted any jobs yet.</p>
                    <a href="{{ route('employer.jobs.create') }}" class="quick-link-btn">Post your first job</a>
                </div>
            @else
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Type</th>
                            <th>Location</th>
                            <th>Work Mode</th>
                            <th>Status</th>
                            <th>Posted</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($jobs as $job)
                            <tr>
                                <td class="cell-title">{{ $job->title }}</td>
                                <td>{{ ucfirst(str_replace('-', ' ', $job->employment_type)) }}</td>
                                <td>{{ collect([$job->city, $job->state])->filter()->implode(', ') ?: '—' }}</td>
                                <td>{{ ucfirst($job->work_mode) }}</td>
                                <td><span class="status-badge status-{{ $job->status }}">{{ ucfirst($job->status) }}</span></td>
                                <td>{{ $job->created_at->diffForHumans() }}</td>
                                <td class="cell-actions">
                                    <a href="{{ route('employer.jobs.show', $job) }}" title="View"><i class="fas fa-eye"></i></a>
                                    <a href="{{ route('employer.jobs.edit', $job) }}" title="Edit"><i class="fas fa-pen"></i></a>
                                    <form action="{{ route('employer.jobs.destroy', $job) }}" method="POST" onsubmit="return confirm('Delete this job posting?');" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" title="Delete"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @if($job->status === 'rejected' && $job->rejection_reason)
                                <tr class="reason-row">
                                    <td colspan="7"><i class="fas fa-circle-info"></i> Rejection reason: {{ $job->rejection_reason }}</td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
                <div class="pagination-wrap">{{ $jobs->links() }}</div>
            @endif
        </div>
    </div>

@endsection

@push('styles')
    @include('employers.partials.list-styles')
@endpush