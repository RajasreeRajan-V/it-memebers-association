{{-- resources/views/employer/projects/index.blade.php --}}
@extends('employers.layout.app')

@section('title', 'My Projects')
@section('page-title', 'Project Postings')
@section('page-subtitle', 'Manage your posted freelance projects')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-title"><i class="fas fa-diagram-project"></i> My Project Postings</div>
            <a href="{{ route('employer.projects.create') }}" class="quick-link-btn">
                <i class="fas fa-plus"></i> Post New Project
            </a>
        </div>
        <div class="card-body no-pad">
            @if($projects->isEmpty())
                <div class="empty-state">
                    <i class="fas fa-diagram-project"></i>
                    <p>You haven't posted any projects yet.</p>
                    <a href="{{ route('employer.projects.create') }}" class="quick-link-btn">Post your first project</a>
                </div>
            @else
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Type</th>
                            <th>Budget</th>
                            <th>Deadline</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($projects as $project)
                            <tr>
                                <td class="cell-title">{{ $project->title }}</td>
                                <td>{{ $project->project_type ?: '—' }}</td>
                                <td>{{ $project->budget }}</td>
                                <td>{{ optional($project->deadline)->format('d M Y') ?? '—' }}</td>
                                <td><span class="status-badge status-{{ $project->status }}">{{ ucfirst(str_replace('_',' ',$project->status)) }}</span></td>
                                <td class="cell-actions">
                                    <a href="{{ route('employer.projects.edit', $project) }}" title="Edit"><i class="fas fa-pen"></i></a>
                                    <form action="{{ route('employer.projects.destroy', $project) }}" method="POST" onsubmit="return confirm('Delete this project posting?');" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" title="Delete"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @if($project->status === 'rejected' && $project->rejection_reason)
                                <tr class="reason-row">
                                    <td colspan="6"><i class="fas fa-circle-info"></i> Rejection reason: {{ $project->rejection_reason }}</td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
                <div class="pagination-wrap">{{ $projects->links() }}</div>
            @endif
        </div>
    </div>
@endsection

@push('styles')
    @include('employers.partials.list-styles')
@endpush
