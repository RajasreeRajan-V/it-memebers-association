{{-- resources/views/students/resume/create.blade.php --}}
@extends('layouts.app')
@section('title', 'Get Expert Feedback')

@section('content')
<div class="container py-4">

    {{-- ===== Header ===== --}}
    <div class="d-flex align-items-start gap-3 mb-4">
        <span class="d-flex align-items-center justify-content-center rounded-3 bg-primary bg-opacity-10 text-primary"
              style="width:48px;height:48px;">
            <i class="fa-solid fa-file-lines fa-lg"></i>
        </span>
        <div>
            <p class="text-uppercase small fw-semibold text-primary mb-1">Resume Review</p>
            <h1 class="h3 fw-semibold mb-1">Get Expert Feedback. Build a Better Resume.</h1>
            <p class="text-muted mb-0">Our mentors will review your resume and provide personalized feedback to help you stand out.</p>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <p class="fw-medium mb-1">Please fix the following:</p>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('student.resume-review.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row g-4 align-items-start">

            {{-- ===== Left: Submit Resume Review Request ===== --}}
            <div class="col-lg-4">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body">
                        <h2 class="h6 fw-semibold mb-1">1. Submit Resume Review Request</h2>
                        <p class="small text-muted mb-4">Fill in the details below to request a resume review.</p>

                        {{-- Upload --}}
                        <label class="form-label fw-medium">Upload Your Resume</label>
                        <label for="resume" class="d-flex flex-column align-items-center justify-content-center gap-2 border border-2 border-dashed rounded-3 bg-light text-center p-4"
                               style="cursor:pointer;">
                            <i class="fa-solid fa-cloud-arrow-up fa-2x text-muted"></i>
                            <span class="fw-medium">Click to upload or drag and drop</span>
                            <span class="small text-muted">PDF, DOC, DOCX (Max 5MB)</span>
                            <input id="resume" name="resume" type="file" accept=".pdf,.doc,.docx" class="d-none" required
                                   onchange="document.getElementById('resume-filename').textContent = this.files[0]?.name ?? ''">
                        </label>
                        <p id="resume-filename" class="small fw-medium text-primary mt-2 mb-0"></p>

                        {{-- Review type --}}
                        <div class="mt-4">
                            <label for="review_type" class="form-label fw-medium">What type of review do you need?</label>
                            <select id="review_type" name="review_type" class="form-select" required>
                                <option value="General Review">General Review</option>
                                <option value="ATS Optimization">ATS Optimization</option>
                                <option value="Skills Review">Skills Review</option>
                                <option value="Experience Review">Experience Review</option>
                                <option value="Formatting Review">Formatting Review</option>
                            </select>
                        </div>

                        {{-- Goal --}}
                        <div class="mt-4">
                            <label for="goal" class="form-label fw-medium">What is your goal?</label>
                            <textarea id="goal" name="goal" rows="2" class="form-control"
                                      placeholder="e.g. I want to improve my resume for job applications in software development">{{ old('goal') }}</textarea>
                        </div>

                        {{-- Feedback focus --}}
                        <div class="mt-4">
                            <label class="form-label fw-medium">What specific feedback would you like?</label>
                            <div class="d-flex flex-wrap gap-2">
                                @foreach (['Overall Feedback', 'Skills Review', 'Experience', 'Formatting'] as $focus)
                                    <div class="form-check form-check-inline border rounded-pill px-3 py-1 m-0">
                                        <input class="form-check-input mt-0" type="checkbox" name="feedback_focus[]"
                                               value="{{ $focus }}" id="focus-{{ Str::slug($focus) }}">
                                        <label class="form-check-label small" for="focus-{{ Str::slug($focus) }}">{{ $focus }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        {{-- Timing --}}
                        <div class="mt-4">
                            <label for="preferred_completion_time" class="form-label fw-medium">Preferred Completion Time</label>
                            <select id="preferred_completion_time" name="preferred_completion_time" class="form-select">
                                <option value="Within 3 days">Within 3 days</option>
                                <option value="Within 5 days">Within 5 days</option>
                                <option value="Within 7 days">Within 7 days</option>
                                <option value="No preference">No preference</option>
                            </select>
                        </div>

                        {{-- Notes --}}
                        <div class="mt-4">
                            <label for="additional_instructions" class="form-label fw-medium">Additional Notes (Optional)</label>
                            <input id="additional_instructions" name="additional_instructions" type="text" class="form-control"
                                   placeholder="Any specific instructions for the reviewer" value="{{ old('additional_instructions') }}">
                        </div>

                        <input type="hidden" name="mentor_id" id="mentor_id" value="{{ old('mentor_id', request('mentor')) }}">

                        <button type="submit" class="btn btn-primary w-100 mt-4">Submit Request</button>
                        <p class="small text-muted text-center mt-2 mb-0">Your request will be sent to the mentor for confirmation.</p>
                    </div>
                </div>
            </div>

            {{-- ===== Middle: Select a Mentor ===== --}}
            <div class="col-lg-4">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <h2 class="h6 fw-semibold mb-0">2. Select a Mentor</h2>
                            <a href="{{ route('student.mentors.index') }}" class="small fw-medium text-decoration-none">View All Mentors</a>
                        </div>
                        <p class="small text-muted mb-3">Choose a mentor for your resume review</p>

                        <div class="d-flex flex-column gap-2" style="max-height:560px; overflow-y:auto;">
                            @forelse ($mentors as $mentor)
                                @php $checked = (int) old('mentor_id', request('mentor')) === $mentor->id; @endphp
                                <label class="d-flex align-items-center gap-2 border rounded-3 p-2 {{ $checked ? 'border-primary bg-primary bg-opacity-10' : '' }}"
                                       style="cursor:pointer;">
                                    <input type="radio" name="mentor_id_radio" value="{{ $mentor->id }}" class="d-none"
                                           {{ $checked ? 'checked' : '' }}
                                           onclick="document.getElementById('mentor_id').value = this.value">
                                    <img src="{{ $mentor->avatar_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($mentor->name) }}"
                                         alt="{{ $mentor->name }}" class="rounded-circle flex-shrink-0" width="40" height="40">
                                    <div class="flex-grow-1 text-truncate">
                                        <p class="fw-medium mb-0 text-truncate">{{ $mentor->name }}</p>
                                        <p class="small text-muted mb-0 text-truncate">{{ $mentor->title ?? 'Mentor' }}</p>
                                    </div>
                                    <span class="badge text-bg-light flex-shrink-0">Select</span>
                                </label>
                            @empty
                                <p class="text-muted text-center py-4 mb-0">No mentors available right now.</p>
                            @endforelse
                        </div>
                        <p class="small text-muted mt-3 mb-0">Leaving no mentor selected lets any available mentor pick up your request.</p>
                    </div>
                </div>
            </div>

            {{-- ===== Right: How It Works ===== --}}
            <div class="col-lg-4">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body">
                        <h2 class="h6 fw-semibold mb-4">How It Works</h2>
                        <ol class="list-unstyled">
                            @foreach ([
                                ['Submit Request', 'Upload your resume and share details about your goals.'],
                                ['Mentor Reviews', 'A mentor reviews your resume and provides detailed feedback.'],
                                ['Get Feedback', "You'll receive feedback and suggestions within the promised time."],
                                ['Improve & Apply', 'Update your resume and increase your chances of success.'],
                            ] as $index => $step)
                                <li class="d-flex gap-3 mb-4">
                                    <span class="d-flex align-items-center justify-content-center rounded-circle bg-primary bg-opacity-10 text-primary fw-semibold flex-shrink-0"
                                          style="width:28px;height:28px;font-size:.75rem;">
                                        {{ $index + 1 }}
                                    </span>
                                    <div>
                                        <p class="fw-medium mb-0">{{ $step[0] }}</p>
                                        <p class="small text-muted mb-0">{{ $step[1] }}</p>
                                    </div>
                                </li>
                            @endforeach
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </form>

    {{-- ===== Trust bar ===== --}}
    <div class="row g-3 mt-2">
        @foreach ([
            ['Expert Mentors', 'Learn from experienced professionals'],
            ['Detailed Feedback', 'Get in-depth review and suggestions'],
            ['Fast Turnaround', 'Reviews completed within the selected time'],
            ['Secure & Private', 'Your data is safe with us'],
        ] as $item)
            <div class="col-6 col-md-3">
                <div class="border rounded-3 bg-white p-3 text-center h-100">
                    <p class="fw-semibold mb-1">{{ $item[0] }}</p>
                    <p class="small text-muted mb-0">{{ $item[1] }}</p>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection