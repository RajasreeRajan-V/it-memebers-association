@extends('layouts.app')

@section('content')

<div class="listing-wrapper">

    <div class="listing-header">
        <div>
            <h1>Projects</h1>
            <p>Manage all the projects your company has posted for freelancers.</p>
        </div>
        <a href="{{ route('employer.projects.create') }}" class="btn btn-primary">+ Post a Project</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="GET" class="listing-filters">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by title...">
        <select name="status">
            <option value="">All Statuses</option>
            <option value="open" @selected(request('status') == 'open')>Open</option>
            <option value="closed" @selected(request('status') == 'closed')>Closed</option>
        </select>
        <button type="submit" class="btn btn-secondary">Filter</button>
    </form>

    <div class="listing-table-wrap">
        <table class="listing-table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Budget</th>
                    <th>Duration</th>
                    <th>Location</th>
                    <th>Status</th>
                    <th class="text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($projects as $project)
                    <tr>
                        <td class="cell-title">{{ $project->title }}</td>
                        <td>{{ $project->budget }} <span class="text-muted">({{ ucfirst($project->project_type) }})</span></td>
                        <td>{{ $project->duration }}</td>
                        <td>{{ $project->city }}, {{ $project->state }}</td>
                        <td>
                            <span class="badge badge-{{ $project->status == 'open' ? 'green' : 'gray' }}">
                                {{ ucfirst($project->status) }}
                            </span>
                        </td>
                        <td class="text-right actions-cell">
                            <a href="{{ route('employer.projects.show', $project) }}" class="action-link">View</a>
                            <a href="{{ route('employer.projects.edit', $project) }}" class="action-link">Edit</a>
                            <form action="{{ route('employer.projects.destroy', $project) }}" method="POST" class="inline-form"
                                  onsubmit="return confirm('Delete this project? This cannot be undone.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="action-link action-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="empty-state">No projects posted yet. Click "Post a Project" to get started.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="pagination-wrap">
        {{ $projects->links() }}
    </div>

</div>

<style>
    .listing-wrapper { max-width: 1100px; margin: 0 auto; padding: 40px 20px; font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif; color: #1f2937; }
    .listing-header { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 24px; flex-wrap: wrap; gap: 12px; }
    .listing-header h1 { font-size: 1.6rem; font-weight: 600; margin: 0 0 4px; color: #111827; }
    .listing-header p { font-size: 0.9rem; color: #6b7280; margin: 0; }
    .alert-success { background: #f0fdf4; border: 1px solid #bbf7d0; color: #166534; border-radius: 10px; padding: 12px 16px; margin-bottom: 20px; font-size: 0.9rem; }
    .listing-filters { display: flex; gap: 10px; margin-bottom: 20px; flex-wrap: wrap; }
    .listing-filters input, .listing-filters select { border: 1px solid #d1d5db; border-radius: 8px; padding: 9px 12px; font-size: 0.85rem; }
    .listing-filters input { flex: 1; min-width: 200px; }
    .listing-table-wrap { background: #fff; border: 1px solid #e5e7eb; border-radius: 12px; overflow-x: auto; }
    .listing-table { width: 100%; border-collapse: collapse; font-size: 0.85rem; }
    .listing-table th { text-align: left; padding: 12px 16px; background: #f9fafb; color: #6b7280; font-weight: 600; text-transform: uppercase; font-size: 0.7rem; letter-spacing: 0.03em; border-bottom: 1px solid #e5e7eb; }
    .listing-table td { padding: 14px 16px; border-bottom: 1px solid #f3f4f6; color: #374151; }
    .listing-table tr:last-child td { border-bottom: none; }
    .cell-title { font-weight: 600; color: #111827; }
    .text-muted { color: #9ca3af; font-size: 0.78rem; }
    .badge { display: inline-block; padding: 3px 10px; border-radius: 999px; font-size: 0.75rem; font-weight: 600; }
    .badge-green { background: #dcfce7; color: #166534; }
    .badge-gray { background: #f3f4f6; color: #6b7280; }
    .text-right { text-align: right; }
    .actions-cell { white-space: nowrap; }
    .action-link { color: #4f46e5; text-decoration: none; font-weight: 500; margin-left: 14px; font-size: 0.83rem; background: none; border: none; cursor: pointer; padding: 0; font-family: inherit; }
    .action-link:hover { text-decoration: underline; }
    .action-danger { color: #dc2626; }
    .inline-form { display: inline; }
    .empty-state { text-align: center; padding: 40px 16px; color: #9ca3af; }
    .pagination-wrap { margin-top: 20px; }
    .btn { display: inline-flex; align-items: center; justify-content: center; border-radius: 8px; font-size: 0.9rem; font-weight: 500; padding: 10px 18px; cursor: pointer; border: none; text-decoration: none; }
    .btn-primary { background: #4f46e5; color: #fff; }
    .btn-primary:hover { background: #4338ca; }
    .btn-secondary { background: transparent; color: #4b5563; border: 1px solid #d1d5db; }
    .btn-secondary:hover { background: #f3f4f6; }
</style>

@endsection
