
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>My Internships</h4>
                    <a href="{{ route('employer.internships.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Post New Internship
                    </a>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    
                    @if(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    @if($internships->isEmpty())
                        <div class="text-center py-4">
                            <p>You haven't posted any internships yet.</p>
                            <a href="{{ route('employer.internships.create') }}" class="btn btn-primary">
                                Post Your First Internship
                            </a>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Type</th>
                                        <th>Mode</th>
                                        <th>Duration</th>
                                        <th>Stipend</th>
                                        <th>Positions</th>
                                        <th>Status</th>
                                        <th>Posted</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($internships as $internship)
                                    <tr>
                                        <td>{{ $internship->title }}</td>
                                        <td><span class="badge bg-info">{{ ucfirst($internship->internship_type) }}</span></td>
                                        <td>{{ ucfirst($internship->work_mode) }}</td>
                                        <td>{{ $internship->duration }}</td>
                                        <td>{{ $internship->stipend ?? 'N/A' }}</td>
                                        <td>{{ $internship->positions }}</td>
                                        <td>
                                            <span class="badge bg-{{ $internship->status == 'approved' ? 'success' : ($internship->status == 'pending' ? 'warning' : 'danger') }}">
                                                {{ ucfirst($internship->status) }}
                                            </span>
                                        </td>
                                        <td>{{ $internship->created_at->diffForHumans() }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('employer.internships.show', $internship->id) }}" class="btn btn-sm btn-info">View</a>
                                                <a href="{{ route('employer.internships.edit', $internship->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                                <form action="{{ route('employer.internships.destroy', $internship->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this internship?')">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $internships->links() }}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
