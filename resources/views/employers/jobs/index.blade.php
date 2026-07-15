
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>My Jobs</h4>
                    <a href="{{ route('employer.jobs.create') }}" class="btn btn-primary">Post New Job</a>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    
                    @if(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    @if($jobs->isEmpty())
                        <div class="text-center py-4">
                            <p>You haven't posted any jobs yet.</p>
                            <a href="{{ route('employer.jobs.create') }}" class="btn btn-primary">Post Your First Job</a>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Type</th>
                                        <th>Mode</th>
                                        <th>Location</th>
                                        <th>Status</th>
                                        <th>Posted</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($jobs as $job)
                                    <tr>
                                        <td>{{ $job->title }}</td>
                                        <td>{{ ucfirst($job->employment_type) }}</td>
                                        <td>{{ ucfirst($job->work_mode) }}</td>
                                        <td>{{ $job->city }}, {{ $job->state }}</td>
                                        <td>
                                            <span class="badge bg-{{ $job->status == 'approved' ? 'success' : ($job->status == 'pending' ? 'warning' : 'danger') }}">
                                                {{ ucfirst($job->status) }}
                                            </span>
                                        </td>
                                        <td>{{ $job->created_at->diffForHumans() }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('employer.jobs.show', $job->id) }}" class="btn btn-sm btn-info">View</a>
                                                <a href="{{ route('employer.jobs.edit', $job->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                                <form action="{{ route('employer.jobs.destroy', $job->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this job?')">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $jobs->links() }}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
