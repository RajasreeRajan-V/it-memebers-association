{{-- resources/views/employee/jobs/apply.blade.php --}}
@extends('layouts.app')

@section('content')
    {{-- ================= PAGE STYLES ================= --}}
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap');

        /* ---------- Base ---------- */
        .apply-page { font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif; }
        .apply-page h1, .apply-page h2, .apply-page h3, .apply-page h4, .font-display {
            font-family: 'Plus Jakarta Sans', 'Inter', sans-serif;
        }

        .shadow-card { box-shadow: 0 1px 2px rgba(16,24,40,.04), 0 4px 16px -6px rgba(16,24,40,.08); }
        .shadow-soft { box-shadow: 0 10px 30px -12px rgba(16,24,40,.18); }

        /* ---------- Fields ---------- */
        .field-label {
            display: block;
            font-size: 12.5px;
            font-weight: 600;
            line-height: 1.3;
            letter-spacing: .01em;
            color: #12203D;
            margin-bottom: 7px;
        }

        .field-input {
            display: block;
            width: 100%;
            box-sizing: border-box;
            font-family: inherit;
            font-size: 14.5px;
            line-height: 1.5rem;
            color: #12203D;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #E8EAF3;
            border-radius: 11px;
            padding: 13px 15px;
            min-height: 48px;
            outline: none;
            appearance: none;
            -webkit-appearance: none;
            transition: border-color .15s ease, box-shadow .15s ease, background-color .15s ease;
        }
        .field-input::placeholder { color: #9AA2B6; }
        .field-input:hover { border-color: #D3D9E9; }
        .field-input:focus {
            border-color: #3457D5;
            box-shadow: 0 0 0 3px rgba(52,87,213,.13);
        }
        .field-input.is-invalid { border-color: #EF4444; }
        .field-input.is-invalid:focus { box-shadow: 0 0 0 3px rgba(239,68,68,.13); }

        /* Inputs that carry a leading icon — higher specificity so Tailwind's
           padding utilities can't override it */
        .field-input.has-icon { padding-left: 44px; }

        textarea.field-input {
            resize: vertical;
            min-height: 180px;
            line-height: 1.65;
            padding-top: 14px;
            padding-bottom: 14px;
        }

        .field-error {
            font-size: 12px;
            font-weight: 500;
            color: #DC2626;
            margin-top: 6px;
        }

        /* ---------- Step badge ---------- */
        .step-badge {
            flex: 0 0 auto;
            width: 28px;
            height: 28px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 9px;
            background: rgba(52,87,213,.09);
            color: #3457D5;
            font-size: 12px;
            font-weight: 700;
        }

        /* ---------- Dropzone ---------- */
        .dropzone {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 6px;
            text-align: center;
            padding: 26px 16px;
            border: 1.5px dashed #DDE2EF;
            border-radius: 12px;
            background: #FCFDFF;
            cursor: pointer;
            transition: border-color .15s ease, background-color .15s ease;
        }
        .dropzone:hover { border-color: #B7C3E8; background: #F7F9FF; }
        .dropzone.is-dragover { border-color: #3457D5; background: #F1F5FF; }
        .dropzone.has-file { border-style: solid; border-color: #16A34A; background: #F3FDF6; }
        .dropzone.is-invalid { border-color: #EF4444; background: #FEF6F6; }

        .dropzone-icon {
            width: 38px; height: 38px;
            display: inline-flex; align-items: center; justify-content: center;
            border-radius: 11px;
            background: rgba(52,87,213,.08);
            color: #3457D5;
        }
        .dropzone.has-file .dropzone-icon { background: rgba(22,163,74,.10); color: #16A34A; }

        /* ---------- Radio choice cards ---------- */
        .choice {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 14px 16px;
            min-height: 54px;
            border: 1px solid #E8EAF3;
            border-radius: 12px;
            background: #fff;
            cursor: pointer;
            transition: border-color .15s ease, background-color .15s ease, box-shadow .15s ease;
        }
        .choice:hover { border-color: #C3CDEC; background: #FBFCFE; }
        .choice:has(input:checked) {
            border-color: #3457D5;
            background: rgba(52,87,213,.045);
            box-shadow: inset 0 0 0 1px #3457D5;
        }
        .choice span {
            white-space: nowrap; /* Prevents "Full Time" from breaking into two lines */
            flex: 1;
        }

        /* Custom radio — built from scratch so the browser / preflight
           can't flatten it into an invisible box */
        .choice input[type="radio"] {
            -webkit-appearance: none;
            appearance: none;
            flex: 0 0 auto;
            box-sizing: border-box;
            width: 18px;
            height: 18px;
            margin: 0;
            padding: 0;
            border: 1.5px solid #C9D2E8;
            border-radius: 50%;
            background-color: #fff;
            cursor: pointer;
            position: relative; /* Needed for the pseudo-element */
            transition: border-color .15s ease, box-shadow .15s ease;
        }
        .choice input[type="radio"]:hover { border-color: #A9B6DE; }
        .choice input[type="radio"]:checked {
            border-color: #3457D5;
        }
        .choice input[type="radio"]:checked::after {
            content: "";
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background-color: #3457D5;
        }
        .choice input[type="radio"]:focus-visible {
            outline: none;
            box-shadow: 0 0 0 3px rgba(52,87,213,.20);
        }

        /* ---------- Custom checkbox (terms) ---------- */
        .terms-check {
            -webkit-appearance: none;
            appearance: none;
            flex: 0 0 auto;
            box-sizing: border-box;
            width: 18px;
            height: 18px;
            margin: 2px 0 0;
            padding: 0;
            border: 1.5px solid #C9D2E8;
            border-radius: 5px;
            background-color: #fff;
            cursor: pointer;
            position: relative;
            transition: background-color .15s ease, border-color .15s ease, box-shadow .15s ease;
        }
        .terms-check:hover { border-color: #A9B6DE; }
        .terms-check:checked { background-color: #3457D5; border-color: #3457D5; }
        .terms-check:checked::after {
            content: "";
            position: absolute;
            left: 50%;
            top: 47%;
            width: 4.5px;
            height: 8.5px;
            border: solid #fff;
            border-width: 0 2px 2px 0;
            transform: translate(-50%, -50%) rotate(45deg);
        }
        .terms-check:focus-visible {
            outline: none;
            box-shadow: 0 0 0 3px rgba(52,87,213,.20);
        }
        .terms-check.is-invalid { border-color: #EF4444; }
        .terms-check.is-invalid:focus-visible { box-shadow: 0 0 0 3px rgba(239,68,68,.16); }

        /* ---------- Buttons ---------- */
        .btn-primary {
            transition: transform .15s ease, box-shadow .15s ease, background-color .15s ease;
        }
        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 10px 20px -8px rgba(52,87,213,.55);
        }
        .btn-primary:active { transform: translateY(0); box-shadow: none; }

        /* ---------- Verified badge ---------- */
        .verified-badge {
            display: inline-flex; align-items: center; gap: 4px;
            background: #DCFCE7; color: #166534;
            font-size: 10px; font-weight: 600;
            padding: 2px 8px; border-radius: 9999px;
        }
        .verified-badge svg { width: 11px; height: 11px; }

        /* ---------- Misc ---------- */
        .attached-chip {
            display: flex; align-items: center; gap: 8px;
            font-size: 11.5px; font-weight: 500;
            color: #166534;
            background: #F0FDF4;
            border: 1px solid #BBF7D0;
            border-radius: 10px;
            padding: 8px 12px;
        }

        @media (max-width: 640px) {
            .apply-hero { padding-top: 1.5rem; padding-bottom: 2.5rem; }
        }
    </style>

    {{-- Tailwind Play CDN — config must follow the script tag --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        display: ['"Plus Jakarta Sans"', 'sans-serif'],
                        body: ['"Inter"', 'sans-serif'],
                    },
                    colors: {
                        ink: '#12203D',
                        slate2: '#5B6478',
                        brand: '#3457D5',
                        brand2: '#7B8FF7',
                        coral: '#FF6B4A',
                        surface: '#F5F7FC',
                        line: '#E8EAF3',
                        mint: '#16A34A',
                    },
                }
            }
        }
    </script>

    @php
        $employerRegistration = optional($project->employer)->employerRegistration;
        $companyName    = $employerRegistration->company_name ?? 'Company Not Available';
        $isVerified     = $employerRegistration->is_verified ?? false;
        $companyLogo    = $employerRegistration->profile_photo ?? null;
        $companyLogoUrl = $companyLogo ? asset('storage/' . ltrim($companyLogo, '/')) : null;
        $contactPerson  = optional($project->employer)->name ?? 'N/A';

        $freelancer = $freelancer ?? ($employee ?? null);

        // Existing application (edit mode). Fall back to legacy $bid for backward-compat.
        $application = $application ?? ($bid ?? null);
        $isEdit = !empty($application);

        $skillsList = is_array($project->skills ?? null)
            ? $project->skills
            : array_filter(array_map('trim', explode(',', $project->skills ?? '')));

        $availability = old('availability', $application->availability ?? ($freelancer->availability ?? ''));

        $existingResume    = $application->resume_path ?? null;
        $profileResume     = $freelancer->resume_path ?? null;
        $hasResume         = !empty($existingResume) || !empty($profileResume);
        
        // Since we changed to a URL input, we now check for portfolio_url. 
        // Fallback to portfolio_path in case there's old data.
        $existingPortfolio = $application->portfolio_url ?? ($application->portfolio_path ?? null);
    @endphp

    <div class="apply-page bg-[#FAFBFE]">

        {{-- ================= HEADER ================= --}}
        <section class="bg-gradient-to-br from-[#EAF0FF] via-[#F3F6FF] to-[#FBF4EF] border-b border-line">
            <div class="apply-hero max-w-6xl mx-auto px-4 sm:px-6 pt-8 sm:pt-12 pb-12 sm:pb-16">

                <a href="{{ url()->previous() }}"
                   class="inline-flex items-center gap-1.5 text-xs font-semibold text-slate2 hover:text-brand transition-colors mb-6">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.4" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                    Back to job
                </a>

                <div class="flex items-start gap-3">
                    <div class="hidden sm:flex w-11 h-11 rounded-xl bg-white shadow-card ring-1 ring-black/[0.03] items-center justify-center shrink-0">
                        <svg class="w-5 h-5 text-brand" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <div>
                        <h1 class="font-display text-2xl sm:text-[28px] font-extrabold tracking-tight text-ink leading-tight">
                            {{ $isEdit ? 'Update Your Application' : 'Submit Your Application' }}
                        </h1>
                        <p class="mt-2 text-sm text-slate2 max-w-xl leading-relaxed">
                            Tell the employer why you're the right fit. A clear, tailored proposal dramatically
                            improves your chances of getting hired.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        {{-- ================= BODY ================= --}}
        <section class="max-w-6xl mx-auto px-4 sm:px-6 -mt-8 relative z-10 pb-24">
            <div class="grid grid-cols-1 lg:grid-cols-[minmax(0,1fr)_340px] gap-6 lg:gap-7 items-start">

                {{-- ===================== FORM ===================== --}}
                <div class="bg-white rounded-2xl shadow-card ring-1 ring-black/[0.04] p-6 sm:p-10 lg:p-12">

                    @if ($errors->any())
                        <div class="mb-8 rounded-xl border border-red-200 bg-red-50/80 p-4">
                            <div class="flex items-start gap-3">
                                <svg class="w-4 h-4 text-red-500 mt-0.5 shrink-0" fill="none" stroke="currentColor"
                                     stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                                </svg>
                                <div class="min-w-0">
                                    <p class="text-xs font-bold text-red-700">Please fix the following:</p>
                                    <ul class="mt-1.5 list-disc list-inside space-y-0.5">
                                        @foreach ($errors->all() as $error)
                                            <li class="text-xs text-red-600 leading-relaxed">{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif

                    <form id="apply-form"
                          method="POST"
                          action="{{ $isEdit
                                ? route('employee.jobs.bid.update', ['project' => $project->id, 'bid' => $application->id])
                                : route('employee.jobs.bid.store', ['project' => $project->id]) }}"
                          enctype="multipart/form-data"
                          novalidate>
                        @csrf
                        @if ($isEdit)
                            @method('PUT')
                        @endif

                        <input type="hidden" name="project_id" value="{{ $project->id }}">

                        {{-- ============ STEP 1 — COVER LETTER ============ --}}
                        <div class="pt-0 mt-0 border-0">
                            <div class="flex items-start gap-3 mb-6">
                                <span class="step-badge">1</span>
                                <div>
                                    <h2 class="font-display text-sm font-bold text-ink leading-tight">Your Proposal</h2>
                                    <p class="text-[11.5px] text-slate2 mt-1">Introduce yourself and explain your fit for this project.</p>
                                </div>
                            </div>

                            <div>
                                <div class="flex items-center justify-between mb-2">
                                    <label for="cover_letter" class="field-label mb-0">
                                        Cover Letter <span class="text-red-500">*</span>
                                    </label>
                                    <span id="cover-count" class="text-[10.5px] font-medium text-slate2 tabular-nums">0 characters</span>
                                </div>
                                <textarea name="cover_letter"
                                          id="cover_letter"
                                          rows="7"
                                          required
                                          minlength="50"
                                          aria-describedby="cover-help"
                                          placeholder="Introduce yourself, highlight your relevant experience, and explain why you're the best fit for this project..."
                                          class="field-input @error('cover_letter') is-invalid @enderror">{{ old('cover_letter', $application->cover_letter ?? '') }}</textarea>
                                @error('cover_letter')
                                    <p class="field-error">{{ $message }}</p>
                                @else
                                    <p id="cover-help" class="text-[10.5px] text-slate2 mt-2">Minimum 50 characters recommended.</p>
                                @enderror
                            </div>
                        </div>

                        {{-- ============ STEP 2 — ATTACHMENTS ============ --}}
                        <div class="pt-8 mt-8 border-t border-line">
                            <div class="flex items-start gap-3 mb-6">
                                <span class="step-badge">2</span>
                                <div>
                                    <h2 class="font-display text-sm font-bold text-ink leading-tight">Attachments</h2>
                                    <p class="text-[11.5px] text-slate2 mt-1">Upload your resume and any relevant portfolio files.</p>
                                </div>
                            </div>

                            <div class="space-y-6">
                                {{-- Resume --}}
                                <div>
                                    <label class="field-label">
                                        Resume @unless ($hasResume)<span class="text-red-500">*</span>@endunless
                                    </label>

                                    @if ($existingResume)
                                        <div class="attached-chip mb-3">
                                            <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                            </svg>
                                            <span>Resume attached to this application</span>
                                            <a href="{{ asset('storage/' . ltrim($existingResume, '/')) }}" target="_blank"
                                               class="ml-auto font-semibold text-brand hover:underline">View</a>
                                        </div>
                                    @elseif ($profileResume)
                                        <div class="attached-chip mb-3">
                                            <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                            </svg>
                                            <span>Using resume from your profile</span>
                                            <a href="{{ asset('storage/' . ltrim($profileResume, '/')) }}" target="_blank"
                                               class="ml-auto font-semibold text-brand hover:underline">View</a>
                                        </div>
                                    @endif

                                    <label class="block cursor-pointer" for="resume_path">
                                        <div id="resume-drop"
                                             class="dropzone @error('resume_path') is-invalid @enderror">
                                            <span class="dropzone-icon" id="resume-icon">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                                </svg>
                                            </span>
                                            <span class="text-xs font-semibold text-ink" id="resume-drop-title">Click to upload your resume</span>
                                            <span class="text-[10.5px] text-slate2" id="resume-drop-hint">PDF, DOC, DOCX — Max 5MB</span>
                                            <input type="file" name="resume_path" id="resume_path"
                                                   accept=".pdf,.doc,.docx" class="hidden"
                                                   data-drop="resume-drop"
                                                   {{ $hasResume ? '' : 'required' }}>
                                        </div>
                                    </label>
                                    @error('resume_path')
                                        <p class="field-error">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Portfolio (Now an Input Field) --}}
                                <div>
                                    <label for="portfolio_url" class="field-label">Portfolio <span class="font-normal text-slate2">(Optional)</span></label>

                                    @if ($existingPortfolio)
                                        <div class="attached-chip mb-3">
                                            <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                            </svg>
                                            <span>Portfolio attached to this application</span>
                                            <a href="{{ $existingPortfolio }}" target="_blank"
                                               class="ml-auto font-semibold text-brand hover:underline">View</a>
                                        </div>
                                    @endif

                                    <div class="relative">
                                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-slate2/70 pointer-events-none">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                                            </svg>
                                        </span>
                                        <input type="url" name="portfolio_url" id="portfolio_url"
                                               placeholder="https://behance.net/username or https://yourportfolio.com"
                                               value="{{ old('portfolio_url', $application->portfolio_url ?? '') }}"
                                               class="field-input has-icon @error('portfolio_url') is-invalid @enderror">
                                    </div>
                                    @error('portfolio_url')
                                        <p class="field-error">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- ============ STEP 3 — LINKS ============ --}}
                        <div class="pt-8 mt-8 border-t border-line">
                            <div class="flex items-start gap-3 mb-6">
                                <span class="step-badge">3</span>
                                <div>
                                    <h2 class="font-display text-sm font-bold text-ink leading-tight">Online Profiles</h2>
                                    <p class="text-[11.5px] text-slate2 mt-1">Optional — helps employers verify your work.</p>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                                <div>
                                    <label for="github" class="field-label">GitHub</label>
                                    <div class="relative">
                                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-slate2/70 pointer-events-none">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                                <path fill-rule="evenodd"
                                                      d="M12 2C6.477 2 2 6.477 2 12c0 4.42 2.865 8.167 6.839 9.49.5.092.682-.217.682-.482 0-.237-.008-.866-.013-1.7-2.782.603-3.369-1.34-3.369-1.34-.454-1.156-1.11-1.462-1.11-1.462-.908-.62.069-.608.069-.608 1.003.07 1.531 1.03 1.531 1.03.892 1.529 2.341 1.087 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.11-4.555-4.943 0-1.091.39-1.984 1.03-2.682-.103-.253-.447-1.27.098-2.646 0 0 .84-.269 2.75 1.025.8-.223 1.65-.334 2.5-.334.85 0 1.7.111 2.5.334 1.91-1.294 2.75-1.025 2.75-1.025.545 1.376.201 2.393.099 2.646.64.698 1.03 1.591 1.03 2.682 0 3.841-2.337 4.687-4.565 4.935.359.309.678.919.678 1.852 0 1.336-.012 2.415-.012 2.743 0 .267.18.578.688.48C19.138 20.167 22 16.42 22 12c0-5.523-4.477-10-10-10z" />
                                            </svg>
                                        </span>
                                        <input type="url" name="github" id="github"
                                               placeholder="https://github.com/username"
                                               value="{{ old('github', $application->github ?? ($freelancer->github ?? '')) }}"
                                               class="field-input has-icon @error('github') is-invalid @enderror">
                                    </div>
                                    @error('github')
                                        <p class="field-error">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="linkedin" class="field-label">LinkedIn</label>
                                    <div class="relative">
                                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-slate2/70 pointer-events-none">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z" />
                                            </svg>
                                        </span>
                                        <input type="url" name="linkedin" id="linkedin"
                                               placeholder="https://linkedin.com/in/username"
                                               value="{{ old('linkedin', $application->linkedin ?? ($freelancer->linkedin ?? '')) }}"
                                               class="field-input has-icon @error('linkedin') is-invalid @enderror">
                                    </div>
                                    @error('linkedin')
                                        <p class="field-error">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- ============ STEP 4 — AVAILABILITY ============ --}}
                        <div class="pt-8 mt-8 border-t border-line">
                            <div class="flex items-start gap-3 mb-6">
                                <span class="step-badge">4</span>
                                <div>
                                    <h2 class="font-display text-sm font-bold text-ink leading-tight">
                                        Availability <span class="text-red-500">*</span>
                                    </h2>
                                    <p class="text-[11.5px] text-slate2 mt-1">How much time can you commit to this project?</p>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                                @foreach (['full_time' => 'Full Time', 'part_time' => 'Part Time', 'flexible' => 'Flexible'] as $value => $label)
                                    <label class="choice @error('availability') !border-red-300 @enderror">
                                        <input type="radio" name="availability" value="{{ $value }}" required
                                               {{ $availability === $value ? 'checked' : '' }}>
                                        <span class="text-[13px] font-medium text-ink">{{ $label }}</span>
                                    </label>
                                @endforeach
                            </div>
                            @error('availability')
                                <p class="field-error">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- ============ TERMS + SUBMIT ============ --}}
                        <div class="pt-8 mt-8 border-t border-line">
                            <div class="flex items-start gap-3 mb-6">
                                <input type="checkbox" name="terms" id="terms" required
                                       class="terms-check @error('terms') is-invalid @enderror">
                                <label for="terms" class="text-[11.5px] text-slate2 leading-relaxed">
                                    I confirm that the information provided is accurate and I agree to the
                                    <a href="#" class="text-brand font-semibold hover:underline">Terms of Service</a> and
                                    <a href="#" class="text-brand font-semibold hover:underline">Privacy Policy</a>.
                                </label>
                            </div>
                            @error('terms')
                                <p class="field-error mb-5">{{ $message }}</p>
                            @enderror

                            <div class="flex flex-col sm:flex-row gap-3">
                                <button type="submit"
                                        class="btn-primary flex-1 bg-brand hover:bg-[#2C4AC0] text-white text-sm font-semibold
                                               px-6 py-3.5 rounded-xl
                                               inline-flex items-center justify-center gap-2
                                               focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-brand focus-visible:ring-offset-2">
                                    <span>{{ $isEdit ? 'Update Application' : 'Submit Application' }}</span>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 5l7 7-7 7" />
                                    </svg>
                                </button>
                                <a href="{{ url()->previous() }}"
                                   class="flex-1 sm:flex-none text-center bg-white border border-line text-ink text-sm font-semibold
                                          px-6 py-3.5 rounded-xl hover:bg-surface transition-colors">
                                    Cancel
                                </a>
                            </div>
                        </div>
                    </form>
                </div>

                {{-- ===================== SIDEBAR ===================== --}}
                <aside class="space-y-5 h-fit lg:sticky lg:top-6">

                    {{-- Project card --}}
                    <div class="bg-white rounded-2xl shadow-card ring-1 ring-black/[0.04] p-5">
                        <p class="text-[10px] font-bold text-slate2 uppercase tracking-[0.08em] mb-3">Applying For</p>

                        <h3 class="font-display font-bold text-[13.5px] text-ink leading-snug">
                            {{ $project->title }}
                        </h3>

                        {{-- Employer --}}
                        <div class="flex items-center gap-2.5 mt-3.5">
                            <div class="w-9 h-9 rounded-lg bg-gray-100 border border-line flex items-center justify-center overflow-hidden shrink-0">
                                @if ($companyLogoUrl)
                                    <img src="{{ $companyLogoUrl }}" alt="{{ $companyName }}" class="w-full h-full object-cover"
                                         onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                    <div class="w-full h-full items-center justify-center bg-brand/10 text-brand font-bold text-xs"
                                         style="display:none;">
                                        {{ strtoupper(substr($companyName, 0, 1)) }}
                                    </div>
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-brand/10 text-brand font-bold text-xs">
                                        {{ strtoupper(substr($companyName, 0, 1)) }}
                                    </div>
                                @endif
                            </div>

                            <div class="min-w-0">
                                <p class="text-xs font-semibold text-ink truncate">{{ $companyName }}</p>
                                @if ($isVerified)
                                    <span class="verified-badge mt-0.5">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                  d="M8.603 3.799A4.49 4.49 0 0112 2.25c1.357 0 2.573.6 3.397 1.549a4.49 4.49 0 013.498 1.307 4.491 4.491 0 011.307 3.497A4.49 4.49 0 0121.75 12a4.49 4.49 0 01-1.549 3.397 4.49 4.49 0 01-1.307 3.497A4.49 4.49 0 0115.603 20.2 4.49 4.49 0 0112 21.75a4.49 4.49 0 01-3.397-1.549 4.49 4.49 0 01-3.498-1.306 4.491 4.491 0 01-1.307-3.498A4.49 4.49 0 012.25 12c0-1.357.6-2.573 1.549-3.397a4.49 4.49 0 011.307-3.497 4.49 4.49 0 013.497-1.307z"
                                                  clip-rule="evenodd" />
                                            <path d="M16.5 9.5l-5 6-3-3" fill="none" stroke="white" stroke-width="2"
                                                  stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        Verified
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="mt-4 pt-4 border-t border-line space-y-2.5 text-xs">
                            <div class="flex items-center justify-between gap-3">
                                <span class="text-slate2">Budget</span>
                                <span class="font-bold text-brand text-right">{{ $project->budget ?: 'N/A' }}</span>
                            </div>
                            <div class="flex items-center justify-between gap-3">
                                <span class="text-slate2">Type</span>
                                <span class="font-semibold text-ink capitalize text-right">{{ $project->project_type ?: 'N/A' }}</span>
                            </div>
                            @if ($project->duration)
                                <div class="flex items-center justify-between gap-3">
                                    <span class="text-slate2">Duration</span>
                                    <span class="font-semibold text-ink text-right">{{ $project->duration }}</span>
                                </div>
                            @endif
                            @if ($project->deadline)
                                <div class="flex items-center justify-between gap-3">
                                    <span class="text-slate2">Deadline</span>
                                    <span class="font-semibold text-ink text-right">
                                        {{ \Illuminate\Support\Carbon::parse($project->deadline)->format('M d, Y') }}
                                    </span>
                                </div>
                            @endif
                            <div class="flex items-center justify-between gap-3">
                                <span class="text-slate2">Work Mode</span>
                                <span class="font-semibold text-ink capitalize text-right">{{ $project->work_mode ?: 'Onsite' }}</span>
                            </div>
                            <div class="flex items-center justify-between gap-3">
                                <span class="text-slate2">Contact</span>
                                <span class="font-semibold text-ink text-right truncate max-w-[140px]">{{ $contactPerson }}</span>
                            </div>
                        </div>

                        @if ($skillsList)
                            <div class="mt-4 pt-4 border-t border-line">
                                <p class="text-[10px] font-bold text-slate2 uppercase tracking-[0.08em] mb-2">Required Skills</p>
                                <div class="flex flex-wrap gap-1.5">
                                    @foreach (array_slice($skillsList, 0, 6) as $skill)
                                        <span class="text-[11px] font-medium text-ink/70 bg-surface px-2.5 py-1 rounded-full">
                                            {{ $skill }}
                                        </span>
                                    @endforeach
                                    @if (count($skillsList) > 6)
                                        <span class="text-[11px] font-medium text-slate2 bg-surface px-2.5 py-1 rounded-full">
                                            +{{ count($skillsList) - 6 }} more
                                        </span>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>

                    {{-- Tips card --}}
                    <div class="bg-gradient-to-br from-brand to-brand2 rounded-2xl p-5 text-white relative overflow-hidden">
                        <h4 class="font-display font-bold text-sm relative z-10">Application Tips</h4>
                        <ul class="mt-3 space-y-2 relative z-10">
                            @foreach ([
                                'Address the client\'s specific requirements.',
                                'Attach a portfolio that showcases relevant work.',
                                'Keep your cover letter focused and professional.',
                                'Make sure your availability matches the project.',
                            ] as $tip)
                                <li class="flex items-start gap-2 text-[11px] text-white/90 leading-relaxed">
                                    <svg class="w-3.5 h-3.5 mt-0.5 shrink-0" fill="none" stroke="currentColor"
                                         stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span>{{ $tip }}</span>
                                </li>
                            @endforeach
                        </ul>
                        <div class="absolute -right-6 -bottom-8 w-28 h-28 rounded-full bg-white/10"></div>
                    </div>
                </aside>
            </div>
        </section>
    </div>

    {{-- ================= INTERACTIONS ================= --}}
    <script>
        (function () {
            'use strict';

            /* ---------- File inputs: preview + drag & drop ---------- */
            function setupFile(inputId, dropId, titleId, hintId) {
                var input = document.getElementById(inputId);
                var drop  = document.getElementById(dropId);
                if (!input || !drop) return;

                var title = titleId ? document.getElementById(titleId) : null;
                var hint  = hintId ? document.getElementById(hintId) : null;

                function paint() {
                    var has = input.files && input.files.length > 0;
                    drop.classList.toggle('has-file', has);

                    if (title) title.textContent = has ? input.files[0].name : 'Click to upload your resume';
                    if (hint) {
                        hint.textContent = has
                            ? (Math.round(input.files[0].size / 1024) + ' KB — click to replace')
                            : 'PDF, DOC, DOCX — Max 5MB';
                    }
                }

                input.addEventListener('change', paint);

                ['dragenter', 'dragover'].forEach(function (evt) {
                    drop.addEventListener(evt, function (e) {
                        e.preventDefault();
                        e.stopPropagation();
                        drop.classList.add('is-dragover');
                    });
                });

                ['dragleave', 'drop'].forEach(function (evt) {
                    drop.addEventListener(evt, function (e) {
                        e.preventDefault();
                        e.stopPropagation();
                        drop.classList.remove('is-dragover');
                    });
                });

                drop.addEventListener('drop', function (e) {
                    if (e.dataTransfer && e.dataTransfer.files.length) {
                        input.files = e.dataTransfer.files;
                        paint();
                    }
                });
            }

            setupFile('resume_path', 'resume-drop', 'resume-drop-title', 'resume-drop-hint');
            // Removed setupFile('portfolio_path', 'portfolio-drop'); since it's now a text input

            /* ---------- Cover letter counter ---------- */
            var cover   = document.getElementById('cover_letter');
            var counter = document.getElementById('cover-count');
            if (cover && counter) {
                var update = function () {
                    var len = cover.value.trim().length;
                    counter.textContent = len + ' character' + (len === 1 ? '' : 's');
                    counter.classList.toggle('text-mint', len >= 50);
                    counter.classList.toggle('text-slate2', len < 50);
                };
                cover.addEventListener('input', update);
                update();
            }

            /* ---------- Prevent double submit ---------- */
            var form = document.getElementById('apply-form');
            if (form) {
                var submitBtn = form.querySelector('button[type="submit"]');
                var originalHTML = submitBtn ? submitBtn.innerHTML : '';

                form.addEventListener('submit', function () {
                    if (!submitBtn) return;
                    submitBtn.disabled = true;
                    submitBtn.classList.add('opacity-70', 'cursor-not-allowed', 'pointer-events-none');
                    submitBtn.innerHTML = '<span>Submitting…</span>';
                });

                // Restore the button if the user returns via bfcache
                window.addEventListener('pageshow', function () {
                    if (!submitBtn) return;
                    submitBtn.disabled = false;
                    submitBtn.classList.remove('opacity-70', 'cursor-not-allowed', 'pointer-events-none');
                    submitBtn.innerHTML = originalHTML;
                });
            }
        })();
    </script>
@endsection