
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Edit Internship</h4>
                    <a href="{{ route('employer.internships.index') }}" class="btn btn-secondary">Back to List</a>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    
                    @if(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <form action="{{ route('employer.internships.update', $internship->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label for="title" class="form-label">Internship Title *</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                   id="title" name="title" value="{{ old('title', $internship->title) }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="internship_type" class="form-label">Internship Type *</label>
                                <select class="form-control @error('internship_type') is-invalid @enderror" 
                                        id="internship_type" name="internship_type" required>
                                    <option value="">Select Type</option>
                                    <option value="paid" {{ old('internship_type', $internship->internship_type) == 'paid' ? 'selected' : '' }}>Paid</option>
                                    <option value="unpaid" {{ old('internship_type', $internship->internship_type) == 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                                    <option value="stipend" {{ old('internship_type', $internship->internship_type) == 'stipend' ? 'selected' : '' }}>With Stipend</option>
                                </select>
                                @error('internship_type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="work_mode" class="form-label">Work Mode *</label>
                                <select class="form-control @error('work_mode') is-invalid @enderror" 
                                        id="work_mode" name="work_mode" required>
                                    <option value="">Select Mode</option>
                                    <option value="onsite" {{ old('work_mode', $internship->work_mode) == 'onsite' ? 'selected' : '' }}>Onsite</option>
                                    <option value="hybrid" {{ old('work_mode', $internship->work_mode) == 'hybrid' ? 'selected' : '' }}>Hybrid</option>
                                    <option value="remote" {{ old('work_mode', $internship->work_mode) == 'remote' ? 'selected' : '' }}>Remote</option>
                                </select>
                                @error('work_mode')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="duration" class="form-label">Duration *</label>
                                <input type="text" class="form-control @error('duration') is-invalid @enderror" 
                                       id="duration" name="duration" value="{{ old('duration', $internship->duration) }}" 
                                       placeholder="e.g., 3 months" required>
                                @error('duration')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="stipend" class="form-label">Stipend/Salary</label>
                                <input type="text" class="form-control @error('stipend') is-invalid @enderror" 
                                       id="stipend" name="stipend" value="{{ old('stipend', $internship->stipend) }}" 
                                       placeholder="e.g., $500/month">
                                @error('stipend')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="start_date" class="form-label">Start Date</label>
                                <input type="date" class="form-control @error('start_date') is-invalid @enderror" 
                                       id="start_date" name="start_date" value="{{ old('start_date', $internship->start_date ? $internship->start_date->format('Y-m-d') : '') }}">
                                @error('start_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="end_date" class="form-label">End Date</label>
                                <input type="date" class="form-control @error('end_date') is-invalid @enderror" 
                                       id="end_date" name="end_date" value="{{ old('end_date', $internship->end_date ? $internship->end_date->format('Y-m-d') : '') }}">
                                @error('end_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="positions" class="form-label">Number of Positions</label>
                                <input type="number" class="form-control @error('positions') is-invalid @enderror" 
                                       id="positions" name="positions" value="{{ old('positions', $internship->positions) }}" min="1">
                                @error('positions')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="qualification" class="form-label">Qualification</label>
                                <input type="text" class="form-control @error('qualification') is-invalid @enderror" 
                                       id="qualification" name="qualification" value="{{ old('qualification', $internship->qualification) }}" 
                                       placeholder="e.g., Bachelor's Degree">
                                @error('qualification')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="skills" class="form-label">Required Skills</label>
                            <input type="text" class="form-control @error('skills') is-invalid @enderror" 
                                   id="skills" name="skills" value="{{ old('skills', is_array($internship->skills) ? implode(', ', $internship->skills) : $internship->skills) }}" 
                                   placeholder="Separate skills with commas: PHP, Laravel, MySQL">
                            @error('skills')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="country" class="form-label">Country</label>
                                <input type="text" class="form-control @error('country') is-invalid @enderror" 
                                       id="country" name="country" value="{{ old('country', $internship->country) }}">
                                @error('country')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="state" class="form-label">State *</label>
                                <input type="text" class="form-control @error('state') is-invalid @enderror" 
                                       id="state" name="state" value="{{ old('state', $internship->state) }}" required>
                                @error('state')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="district" class="form-label">District *</label>
                                <input type="text" class="form-control @error('district') is-invalid @enderror" 
                                       id="district" name="district" value="{{ old('district', $internship->district) }}" required>
                                @error('district')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="city" class="form-label">City *</label>
                                <input type="text" class="form-control @error('city') is-invalid @enderror" 
                                       id="city" name="city" value="{{ old('city', $internship->city) }}" required>
                                @error('city')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Internship Description *</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" name="description" rows="6" required>{{ old('description', $internship->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Update Internship</button>
                            <a href="{{ route('employer.internships.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
