
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Internship Details</h4>
                    <a href="{{ route('employer.internships.index') }}" class="btn btn-secondary">Back to List</a>
                </div>
                <div class="card-body">
                    <h5>{{ $internship->title }}</h5>
                    <hr>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Type:</strong> 
                            <span class="badge bg-info">{{ ucfirst($internship->internship_type) }}</span>
                        </div>
                        <div class="col-md-6">
                            <strong>Work Mode:</strong> {{ ucfirst($internship->work_mode) }}
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Duration:</strong> {{ $internship->duration }}
                        </div>
                        <div class="col-md-6">
                            <strong>Stipend:</strong> {{ $internship->stipend ?? 'Not specified' }}
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Start Date:</strong> {{ $internship->start_date ? $internship->start_date->format('M d, Y') : 'Flexible' }}
                        </div>
                        <div class="col-md-6">
                            <strong>End Date:</strong> {{ $internship->end_date ? $internship->end_date->format('M d, Y') : 'Flexible' }}
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Positions:</strong> {{ $internship->positions }}
                        </div>
                        <div class="col-md-6">
                            <strong>Qualification:</strong> {{ $internship->qualification ?? 'Not specified' }}
                        </div>
                    </div>
                    
                    @if($internship->skills)
                    <div class="mb-3">
                        <strong>Required Skills:</strong><br>
                        @foreach($internship->skills as $skill)
                            <span class="badge bg-primary me-1">{{ $skill }}</span>
                        @endforeach
                    </div>
                    @endif
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Country:</strong> {{ $internship->country ?? 'Not specified' }}
                        </div>
                        <div class="col-md-6">
                            <strong>State:</strong> {{ $internship->state }}
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>District:</strong> {{ $internship->district }}
                        </div>
                        <div class="col-md-6">
                            <strong>City:</strong> {{ $internship->city }}
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <strong>Status:</strong>
                        <span class="badge bg-{{ $internship->status == 'approved' ? 'success' : ($internship->status == 'pending' ? 'warning' : 'danger') }}">
                            {{ ucfirst($internship->status) }}
                        </span>
                    </div>
                    
                    <div class="mb-3">
                        <strong>Description:</strong>
                        <p>{{ $internship->description }}</p>
                    </div>
                    
                    <div class="mb-3">
                        <strong>Posted:</strong> {{ $internship->created_at->format('M d, Y') }}
                    </div>
                    
                    <div class="d-grid gap-2 d-md-flex">
                        <a href="{{ route('employer.internships.edit', $internship->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('employer.internships.destroy', $internship->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this internship?')">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
