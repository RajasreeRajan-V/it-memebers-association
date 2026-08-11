@extends('layouts.app')

{{--
    freelancer/bid/form.blade.php

    Standalone "Submit / Edit Proposal" page.
    Rendered directly by a route such as GET /freelancer/bid/{project}/edit.

    Expected variables:
        $project     - the Project/Job model being bid on (title, budget, project_type, ...) [required]
        $bid         - an existing Bid model when editing a previously submitted proposal, or null when creating a new one
        $freelancer  - the logged-in freelancer's profile (github, linkedin, availability) used as a fallback default [optional]

    Requires:
        - route('freelancer.bid.submit')
--}}

@section('content')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap');

        body {
            font-family: 'Inter', sans-serif;
        }

        h1,
        h2,
        h3,
        .font-display {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .shadow-card {
            box-shadow: 0 1px 2px rgba(18, 32, 61, .04), 0 8px 24px -12px rgba(18, 32, 61, .10);
        }

        .btn-primary {
            transition: transform .15s ease, box-shadow .15s ease, background-color .15s ease;
        }

        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 18px -6px rgba(59, 91, 219, .45);
        }

        .btn-primary:active {
            transform: translateY(0);
        }

        .btn-primary:disabled {
            opacity: .7;
            transform: none;
            cursor: not-allowed;
        }
    </style>

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

    <section class="bg-surface min-h-screen">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 py-8 sm:py-12">
            {{-- Success Message --}}
            @if (session('success'))
                <div id="success-alert"
                    class="mb-6 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-green-800 shadow-sm flex items-start justify-between">

                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>

                        <div>
                            <h4 class="font-semibold">Success</h4>
                            <p class="text-sm">{{ session('success') }}</p>
                        </div>
                    </div>

                    <button type="button" onclick="document.getElementById('success-alert').remove()"
                        class="text-green-700 hover:text-green-900 text-xl leading-none">
                        &times;
                    </button>
                </div>
            @endif
            {{-- Back link --}}
            <a href="{{ url()->previous() }}"
                class="inline-flex items-center gap-1.5 text-xs font-semibold text-slate2 hover:text-brand transition-colors mb-6">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
                Back to job
            </a>

            <div class="bg-white rounded-2xl shadow-card ring-1 ring-black/[0.03] overflow-hidden">

                {{-- Header --}}
                <div class="px-5 sm:px-8 py-6 border-b border-line">
                    <h1 class="font-display font-bold text-lg sm:text-xl text-ink">
                        {{ $bid ?? null ? 'Edit Your Proposal' : 'Submit Your Proposal' }}
                    </h1>
                    <p class="text-xs sm:text-sm text-slate2 mt-1">
                        For: <span class="font-semibold text-ink">{{ $project->title ?? 'Project' }}</span>
                    </p>
                </div>

                <div class="p-5 sm:p-8">
                    <form id="bid-form" method="POST" action="{{ route('freelancer.bid.submit') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="project_id" id="bid-project-id" value="{{ $project->id ?? '' }}">
                        @if (isset($bid) && $bid)
                            <input type="hidden" name="bid_id" value="{{ $bid->id }}">
                        @endif

                        <div class="space-y-5">
                            {{-- Project Budget Display --}}
                            <div class="bg-surface rounded-lg p-4 flex items-center justify-between">
                                <div>
                                    <p class="text-[10px] text-slate2 uppercase tracking-wider">Project Budget</p>
                                    <p class="text-lg font-bold text-brand" id="bid-project-budget">
                                        {{ $project->budget ?? '₹0' }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-[10px] text-slate2 uppercase tracking-wider">Type</p>
                                    <p class="text-sm font-semibold text-ink" id="bid-project-type">
                                        {{ isset($project->project_type) ? ucfirst($project->project_type) : 'Fixed' }}
                                    </p>
                                </div>
                            </div>

                            {{-- Bid Amount --}}
                            <div>
                                <label for="bid-amount" class="block text-xs font-semibold text-ink mb-1.5">
                                    Your Bid Amount <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <span
                                        class="absolute left-3 top-1/2 -translate-y-1/2 text-slate2 font-semibold text-sm">₹</span>
                                    @php
$budget = preg_replace('/[^\d\-]/', '', $project->budget);
$minBudget = explode('-', $budget)[0];
@endphp

<input
    type="number"
    name="bid_amount"
    value="{{ old('bid_amount', trim($minBudget)) }}"

                                        class="w-full text-sm border border-line rounded-lg pl-8 pr-3 py-2.5 outline-none focus:border-brand focus:ring-1 focus:ring-brand/30 transition-colors"
                                        @error('bid_amount') border-red-500 @enderror">
                                    @error('bid_amount')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <p class="text-[10px] text-slate2 mt-1">Enter your competitive bid amount</p>
                            </div>

                            {{-- Estimated Delivery --}}
                            <div>
                                <label for="estimated-delivery" class="block text-xs font-semibold text-ink mb-1.5">
                                    Estimated Duration <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="estimated_days" id="estimated-delivery" required
                                    placeholder="e.g., 15 Days, 2 Weeks, 1 Month"
                                    value="{{ old('estimated_days', $project->duration ?? '') }}"
                                    class="w-full text-sm border border-line rounded-lg px-3 py-2.5 outline-none focus:border-brand focus:ring-1 focus:ring-brand/30 transition-colors"
                                    @error('estimated_days') border-red-500 @enderror">
                                @error('estimated_days')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                                <p class="text-[10px] text-slate2 mt-1">How long will it take to complete?</p>
                            </div>

                            {{-- Cover Letter --}}
                            <div>
                                <label for="cover-letter" class="block text-xs font-semibold text-ink mb-1.5">
                                    Cover Letter <span class="text-red-500">*</span>
                                </label>
                                <textarea name="cover_letter" id="cover-letter" rows="5" required minlength="50"
                                    placeholder="Introduce yourself, highlight your relevant experience, and explain why you're the best fit for this project..."
                                    class="w-full text-sm border border-line rounded-lg px-3 py-2.5 outline-none focus:border-brand focus:ring-1 focus:ring-brand/30 transition-colors resize-y min-h-[120px]"
                                    @error('cover_letter') border-red-500 @enderror"></textarea>
                                @error('cover_letter')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                                <p class="text-[10px] text-slate2 mt-1">Minimum 50 characters recommended</p>
                            </div>

                            {{-- Resume Upload --}}
                            <div>
                                <label for="resume" class="block text-xs font-semibold text-ink mb-1.5">
                                    Resume
                                    @if (empty($freelancer->resume))
                                        <span class="text-red-500">*</span>
                                    @endif
                                </label>

                                <div class="flex items-center gap-3">
                                    <label class="flex-1 cursor-pointer">
                                        <div
                                            class="border-2 border-dashed border-line rounded-lg px-4 py-3 text-center
                {{ $freelancer && $freelancer->resume ? 'bg-gray-100 cursor-not-allowed' : 'hover:border-brand' }}
                transition-colors">

                                            <input type="file" name="resume" id="resume" accept=".pdf,.doc,.docx"
                                                class="hidden" onchange="showFileName(this, 'resume-file-name')"
                                                {{ $freelancer && $freelancer->resume ? 'disabled' : 'required' }}>

                                            <div class="flex items-center justify-center gap-2 text-xs text-slate2">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    stroke-width="2" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                                </svg>

                                                <span>
                                                    {{ $freelancer && $freelancer->resume ? 'Resume Already Uploaded' : 'Upload Resume' }}
                                                </span>
                                            </div>
                                        </div>
                                    </label>

                                    <span class="text-[10px] text-slate2 shrink-0">
                                        PDF, DOC, DOCX (Max 5MB)
                                    </span>
                                </div>

                                @if ($freelancer && $freelancer->resume)
                                    <p class="text-green-600 text-xs mt-2">
                                        ✓ Resume already exists. Upload is disabled.
                                    </p>
                                @endif

                                <p id="resume-file-name" class="text-[10px] text-brand mt-1 hidden"></p>

                                @error('resume')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Portfolio Upload --}}
                            {{-- Portfolio Upload --}}
                            <div>
                                <label for="portfolio" class="block text-xs font-semibold text-ink mb-1.5">
                                    Portfolio
                                    @if (empty($freelancer->portfolio_link))
                                        <span class="text-red-500">*</span>
                                    @endif
                                </label>

                                <div class="flex items-center gap-3">
                                    <label class="flex-1 cursor-pointer">
                                        <div
                                            class="border-2 border-dashed border-line rounded-lg px-4 py-3 text-center
                {{ $freelancer && $freelancer->portfolio_link ? 'bg-gray-100 cursor-not-allowed' : 'hover:border-brand' }}
                transition-colors">

                                            <input type="file" name="portfolio" id="portfolio"
                                                accept=".pdf,.zip,.rar" class="hidden"
                                                onchange="showFileName(this, 'portfolio-file-name')"
                                                {{ $freelancer && $freelancer->portfolio_link ? 'disabled' : '' }}>

                                            <div class="flex items-center justify-center gap-2 text-xs text-slate2">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    stroke-width="2" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                                </svg>

                                                <span>
                                                    {{ $freelancer && $freelancer->portfolio_link ? 'Portfolio Already Uploaded' : 'Upload Portfolio' }}
                                                </span>
                                            </div>
                                        </div>
                                    </label>

                                    <span class="text-[10px] text-slate2 shrink-0">
                                        PDF, ZIP, RAR (Max 20MB)
                                    </span>
                                </div>

                                @if ($freelancer && $freelancer->portfolio_link)
                                    <div class="mt-2">
                                        <p class="text-green-600 text-xs">
                                            ✓ Portfolio already exists. Upload is disabled.
                                        </p>

                                        <a href="{{ asset('storage/' . $freelancer->portfolio_link) }}" target="_blank"
                                            class="text-blue-600 text-xs underline hover:text-blue-800">
                                            View Uploaded Portfolio
                                        </a>
                                    </div>
                                @endif

                                <p id="portfolio-file-name" class="text-[10px] text-brand mt-1 hidden"></p>
                                @error('portfolio')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- GitHub --}}
                            <div>
                                <label for="github" class="block text-xs font-semibold text-ink mb-1.5">
                                    GitHub Profile (Optional)
                                </label>
                                <div class="relative">
                                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-slate2">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                            <path fill-rule="evenodd"
                                                d="M12 2C6.477 2 2 6.477 2 12c0 4.42 2.865 8.167 6.839 9.49.5.092.682-.217.682-.482 0-.237-.008-.866-.013-1.7-2.782.603-3.369-1.34-3.369-1.34-.454-1.156-1.11-1.462-1.11-1.462-.908-.62.069-.608.069-.608 1.003.07 1.531 1.03 1.531 1.03.892 1.529 2.341 1.087 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.11-4.555-4.943 0-1.091.39-1.984 1.03-2.682-.103-.253-.447-1.27.098-2.646 0 0 .84-.269 2.75 1.025.8-.223 1.65-.334 2.5-.334.85 0 1.7.111 2.5.334 1.91-1.294 2.75-1.025 2.75-1.025.545 1.376.201 2.393.099 2.646.64.698 1.03 1.591 1.03 2.682 0 3.841-2.337 4.687-4.565 4.935.359.309.678.919.678 1.852 0 1.336-.012 2.415-.012 2.743 0 .267.18.578.688.48C19.138 20.167 22 16.42 22 12c0-5.523-4.477-10-10-10z" />
                                        </svg>
                                    </span>
                                    <input type="url" name="github" id="github"
                                        placeholder="https://github.com/yourusername"
                                        value="{{ old('github', $bid->github ?? ($freelancer->github ?? '')) }}"
                                        class="w-full text-sm border border-line rounded-lg pl-10 pr-3 py-2.5 outline-none focus:border-brand focus:ring-1 focus:ring-brand/30 transition-colors">
                                    @error('github')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            {{-- LinkedIn --}}
                            <div>
                                <label for="linkedin" class="block text-xs font-semibold text-ink mb-1.5">
                                    LinkedIn Profile (Optional)
                                </label>
                                <div class="relative">
                                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-slate2">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z" />
                                        </svg>
                                    </span>
                                    <input type="url" name="linkedin" id="linkedin"
                                        placeholder="https://linkedin.com/in/yourusername"
                                        value="{{ old('linkedin', $bid->linkedin ?? ($freelancer->linkedin ?? '')) }}"
                                        class="w-full text-sm border border-line rounded-lg pl-10 pr-3 py-2.5 outline-none focus:border-brand focus:ring-1 focus:ring-brand/30 transition-colors">
                                    @error('linkedin')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            {{-- Availability --}}
                            {{-- Availability --}}
                            <div>
                                <label class="block text-xs font-semibold text-ink mb-2">
                                    Availability <span class="text-red-500">*</span>
                                </label>

                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-2">
                                    @foreach (['full_time' => 'Full Time', 'part_time' => 'Part Time', 'flexible' => 'Flexible'] as $value => $label)
                                        <label
                                            class="flex items-center gap-2.5 p-3 border border-line rounded-lg cursor-pointer hover:border-brand/60 transition-colors has-[:checked]:border-brand has-[:checked]:bg-brand/5">

                                            <input type="radio" name="availability" value="{{ $value }}"
                                                {{ old('availability', $bid->availability ?? ($freelancer->availability ?? '')) == $value ? 'checked' : '' }}
                                                class="w-4 h-4 text-brand border-line focus:ring-brand/30">

                                            <span class="text-sm font-medium text-ink">
                                                {{ $label }}
                                            </span>
                                        </label>
                                    @endforeach
                                </div>

                                {{-- Validation Error --}}
                                @error('availability')
                                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Terms and Submit --}}
                            <div class="pt-4 border-t border-line">
                                <div class="flex items-start gap-2.5 mb-4">
                                    <input type="checkbox" name="terms" id="terms" required
                                        class="mt-0.5 w-4 h-4 text-brand border-line rounded focus:ring-brand/30">
                                    <label for="terms" class="text-xs text-slate2">
                                        I confirm that the information provided is accurate and I agree to the
                                        <a href="#" class="text-brand hover:underline">Terms of Service</a> and
                                        <a href="#" class="text-brand hover:underline">Privacy Policy</a>.
                                    </label>
                                </div>
                                <button type="submit"
                                    class="w-full btn-primary bg-brand hover:bg-brand/90 text-white text-sm font-semibold px-6 py-3 rounded-lg transition-colors flex items-center justify-center gap-2">
                                    {{ isset($bid) && $bid ? 'Update Proposal' : 'Submit Proposal' }}
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 5l7 7-7 7" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script>
        function showFileName(input, labelId) {
            var label = document.getElementById(labelId);
            if (input.files && input.files[0]) {
                label.textContent = '✓ ' + input.files[0].name;
                label.classList.remove('hidden');
            } else {
                label.classList.add('hidden');
            }
        }
    </script>
@endsection
