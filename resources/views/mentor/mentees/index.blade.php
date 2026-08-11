@extends('layouts.app')

@section('content')
<div class="fm-page">
    <div class="fm-main">

        {{-- ===== Hero Banner ===== --}}
        <section class="fm-hero">
            <div class="fm-hero-text">
                <span class="fm-hero-tag">Find the right mentor. Shape your future.</span>
                <h1>Learn. Grow. Succeed.<br><span>With the Right Mentor.</span></h1>
                <p>Connect with experienced professionals, get guidance, and achieve your career goals.</p>
                <a href="#mentor-list" class="btn-primary">
                    Find Mentors <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>
            <div class="fm-hero-art">
                <img src="{{ asset('images/mentorship-hero.svg') }}" alt="Mentorship illustration" onerror="this.style.display='none'">
            </div>
        </section>

        {{-- ===== Filters ===== --}}
        <section class="fm-filters">
            <form action="{{ route('student.mentors.index') }}" method="GET" class="fm-filters-form">
                <div class="fm-search-box">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" name="q" placeholder="Search by name, skills, expertise..." value="{{ request('q') }}">
                </div>

                <div class="fm-filter-group">
                    <label>Expertise</label>
                    <select name="expertise">
                        <option value="">All Expertise</option>
                        @foreach(($expertiseOptions ?? ['Web Development','Mobile Development','Data Science & AI','DevOps & Cloud','Design & UX/UI','Business & Marketing']) as $option)
                            <option value="{{ $option }}" {{ request('expertise') == $option ? 'selected' : '' }}>{{ $option }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="fm-filter-group">
                    <label>Availability</label>
                    <select name="availability">
                        <option value="">All Availability</option>
                        <option value="online">Online Now</option>
                        <option value="weekday">Weekdays</option>
                        <option value="weekend">Weekends</option>
                    </select>
                </div>

                <div class="fm-filter-group">
                    <label>Experience</label>
                    <select name="experience">
                        <option value="">All Experience</option>
                        <option value="1-3">1 - 3 Years</option>
                        <option value="4-7">4 - 7 Years</option>
                        <option value="8+">8+ Years</option>
                    </select>
                </div>

                <button type="button" class="btn-outline"><i class="fa-solid fa-sliders"></i> More Filters</button>
            </form>
        </section>

        {{-- ===== Requested Students ===== --}}
        <section class="fm-mentors" id="mentor-list">
            <div class="fm-section-head">
                <div>
                    <h2><i class="fa-solid fa-star"></i> Requested Students</h2>
                    <p>Students waiting for your response. Accept to add them as a mentee.</p>
                </div>
            </div>

            <div class="rq-list">
                @forelse(($pendingRequests ?? []) as $request)
                    <div class="rq-row" data-request-id="{{ $request->id }}">

                        {{-- Left: identity --}}
                        <div class="rq-identity">
                            <img src="{{ $request->mentee->avatar ?? asset('images/avatar-placeholder.png') }}" alt="{{ $request->mentee->name }}" class="rq-photo">
                            <div class="rq-identity-text">
                                <h4>{{ $request->mentee->name }}</h4>
                                <p class="rq-role">{{ $request->mentee->designation ?? 'Student' }}</p>
                                @if(!empty($request->mentee->company))
                                    <p class="rq-company">{{ $request->mentee->company }}</p>
                                @endif
                                @if(!empty($request->mentee->primary_skill) || $request->type)
                                    <span class="rq-tag">{{ $request->mentee->primary_skill ?? ucfirst($request->type) }}</span>
                                @endif
                            </div>
                        </div>

                        {{-- Middle: schedule + message --}}
                        <div class="rq-schedule">
                            @if($request->scheduled_at)
                                <span><i class="fa-regular fa-calendar"></i> {{ $request->scheduled_at->format('d M Y') }}</span>
                                <span><i class="fa-regular fa-clock"></i> {{ $request->scheduled_at->format('g:i A') }}</span>
                            @else
                                <span class="rq-muted"><i class="fa-regular fa-calendar"></i> No date proposed</span>
                            @endif
                            @if($request->mentee_message)
                                <span class="rq-message"><i class="fa-regular fa-comment-dots"></i> {{ Str::limit($request->mentee_message, 60) }}</span>
                            @endif
                        </div>

                        {{-- Right: status + dates + action --}}
                        <div class="rq-status-block">
                            <span class="rq-badge rq-badge-{{ $request->status }}">{{ ucfirst($request->status) }}</span>
                            <span class="rq-date-label">
                                @if($request->status === 'pending')
                                    Requested on {{ $request->created_at->format('d M Y') }}
                                @else
                                    Responded on {{ $request->updated_at->format('d M Y') }}
                                @endif
                            </span>
                            <button type="button" class="btn-outline rq-view-btn" onclick="openRequestModal({{ $request->id }})">View Details</button>
                        </div>

                        {{-- Kebab menu --}}
                        <div class="rq-kebab">
                            <button type="button" class="rq-kebab-btn" onclick="toggleRqMenu(event, {{ $request->id }})">
                                <i class="fa-solid fa-ellipsis-vertical"></i>
                            </button>
                            <div class="rq-kebab-menu" id="rq-menu-{{ $request->id }}">
                                <button type="button" onclick="openRequestModal({{ $request->id }})">
                                    <i class="fa-regular fa-eye"></i> View Details
                                </button>
                                @if($request->status === 'pending')
                                    <form action="{{ route('mentor.mentees.requests.accept', $request->id) }}" method="POST">
                                        @csrf
                                        <button type="submit"><i class="fa-solid fa-check"></i> Accept</button>
                                    </form>
                                    <form action="{{ route('mentor.mentees.requests.reject', $request->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="rq-danger"><i class="fa-solid fa-xmark"></i> Reject</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="fm-empty">No requests right now.</p>
                @endforelse
            </div>

            @if(($pendingRequests ?? collect())->count())
                <p class="rq-showing">Showing 1 to {{ $pendingRequests->count() }} of {{ $pendingRequests->count() }} requests</p>
            @endif
        </section>

        {{-- ===== View Details Modal ===== --}}
        <div class="rq-modal-overlay" id="rqModalOverlay" onclick="closeRequestModal(event)">
            <div class="rq-modal" onclick="event.stopPropagation()">
                <button type="button" class="rq-modal-close" onclick="closeRequestModal()"><i class="fa-solid fa-xmark"></i></button>

                <div class="rq-modal-header">
                    <img id="rqModalPhoto" src="{{ asset('images/avatar-placeholder.png') }}" alt="" class="rq-modal-photo">
                    <div>
                        <h3 id="rqModalName">—</h3>
                        <p id="rqModalRole" class="rq-role"></p>
                        <p id="rqModalCompany" class="rq-company"></p>
                    </div>
                    <span id="rqModalBadge" class="rq-badge"></span>
                </div>

                <div class="rq-modal-body">
                    <div class="rq-modal-field">
                        <label>Email</label>
                        <p id="rqModalEmail">—</p>
                    </div>
                    <div class="rq-modal-field">
                        <label>Request Type</label>
                        <p id="rqModalType">—</p>
                    </div>
                    <div class="rq-modal-field">
                        <label>Proposed Schedule</label>
                        <p id="rqModalSchedule">—</p>
                    </div>
                    <div class="rq-modal-field">
                        <label>Message from Student</label>
                        <p id="rqModalMessage">—</p>
                    </div>
                    <div class="rq-modal-field" id="rqModalResumeWrap" style="display:none;">
                        <label>Resume</label>
                        <p><a id="rqModalResume" href="#" target="_blank"><i class="fa-regular fa-file-lines"></i> View Resume</a></p>
                    </div>
                    <div class="rq-modal-field" id="rqModalNotesWrap" style="display:none;">
                        <label>Admin Notes</label>
                        <p id="rqModalNotes">—</p>
                    </div>
                    <div class="rq-modal-field-row">
                        <div>
                            <label>Requested On</label>
                            <p id="rqModalRequestedAt">—</p>
                        </div>
                        <div>
                            <label>Last Updated</label>
                            <p id="rqModalUpdatedAt">—</p>
                        </div>
                    </div>
                </div>

                <div class="rq-modal-footer" id="rqModalFooter">
                    {{-- filled dynamically via JS for pending requests --}}
                </div>
            </div>
        </div>

        <script>
            // Data for all requests, built server-side once, read client-side on demand.
            window.rqRequestsData = {
                @foreach(($pendingRequests ?? []) as $request)
                    {{ $request->id }}: {
                        id: {{ $request->id }},
                        name: @json($request->mentee->name),
                        role: @json($request->mentee->designation ?? 'Student'),
                        company: @json($request->mentee->company ?? ''),
                        email: @json($request->mentee->email ?? ''),
                        photo: @json($request->mentee->avatar ?? asset('images/avatar-placeholder.png')),
                        type: @json(ucfirst($request->type)),
                        status: @json($request->status),
                        message: @json($request->mentee_message ?? 'No message provided.'),
                        scheduled_at: @json($request->scheduled_at ? $request->scheduled_at->format('d M Y, g:i A') : 'Not proposed'),
                        resume: @json($request->resume_file_path ? asset('storage/'.$request->resume_file_path) : null),
                        admin_notes: @json($request->admin_notes ?? ''),
                        created_at: @json($request->created_at->format('d M Y, g:i A')),
                        updated_at: @json($request->updated_at->format('d M Y, g:i A')),
                        accept_url: @json(route('mentor.mentees.requests.accept', $request->id)),
                        reject_url: @json(route('mentor.mentees.requests.reject', $request->id)),
                    },
                @endforeach
            };

            function openRequestModal(id) {
                const data = window.rqRequestsData[id];
                if (!data) return;

                document.getElementById('rqModalPhoto').src = data.photo;
                document.getElementById('rqModalName').textContent = data.name;
                document.getElementById('rqModalRole').textContent = data.role;
                document.getElementById('rqModalCompany').textContent = data.company;
                document.getElementById('rqModalEmail').textContent = data.email || '—';
                document.getElementById('rqModalType').textContent = data.type;
                document.getElementById('rqModalSchedule').textContent = data.scheduled_at;
                document.getElementById('rqModalMessage').textContent = data.message;
                document.getElementById('rqModalRequestedAt').textContent = data.created_at;
                document.getElementById('rqModalUpdatedAt').textContent = data.updated_at;

                const badge = document.getElementById('rqModalBadge');
                badge.textContent = data.status.charAt(0).toUpperCase() + data.status.slice(1);
                badge.className = 'rq-badge rq-badge-' + data.status;

                const resumeWrap = document.getElementById('rqModalResumeWrap');
                if (data.resume) {
                    resumeWrap.style.display = '';
                    document.getElementById('rqModalResume').href = data.resume;
                } else {
                    resumeWrap.style.display = 'none';
                }

                const notesWrap = document.getElementById('rqModalNotesWrap');
                if (data.admin_notes) {
                    notesWrap.style.display = '';
                    document.getElementById('rqModalNotes').textContent = data.admin_notes;
                } else {
                    notesWrap.style.display = 'none';
                }

                const footer = document.getElementById('rqModalFooter');
                if (data.status === 'pending') {
                    footer.innerHTML = `
                        <form action="${data.reject_url}" method="POST" style="flex:1;">
                            <input type="hidden" name="_token" value="${document.querySelector('meta[name=csrf-token]')?.content ?? ''}">
                            <button type="submit" class="btn-outline btn-block">Reject</button>
                        </form>
                        <form action="${data.accept_url}" method="POST" style="flex:1;">
                            <input type="hidden" name="_token" value="${document.querySelector('meta[name=csrf-token]')?.content ?? ''}">
                            <button type="submit" class="btn-primary-sm btn-block">Accept</button>
                        </form>
                    `;
                } else {
                    footer.innerHTML = '';
                }

                document.getElementById('rqModalOverlay').classList.add('rq-modal-open');
                document.body.style.overflow = 'hidden';
            }

            function closeRequestModal(event) {
                if (event && event.target !== event.currentTarget) return;
                document.getElementById('rqModalOverlay').classList.remove('rq-modal-open');
                document.body.style.overflow = '';
            }

            function toggleRqMenu(event, id) {
                event.stopPropagation();
                document.querySelectorAll('.rq-kebab-menu.rq-menu-open').forEach(m => {
                    if (m.id !== 'rq-menu-' + id) m.classList.remove('rq-menu-open');
                });
                document.getElementById('rq-menu-' + id).classList.toggle('rq-menu-open');
            }

            document.addEventListener('click', function () {
                document.querySelectorAll('.rq-kebab-menu.rq-menu-open').forEach(m => m.classList.remove('rq-menu-open'));
            });

            document.addEventListener('keydown', function (e) {
                if (e.key === 'Escape') closeRequestModal();
            });
        </script>

        {{-- ===== Explore by Expertise ===== --}}
        <section class="fm-expertise">
            <div class="fm-section-head">
                <div>
                    <h2><i class="fa-solid fa-graduation-cap"></i> Explore by Expertise</h2>
                </div>
            </div>

            <div class="fm-expertise-grid">
                @foreach(($expertiseCategories ?? [
                    ['name' => 'Web Development', 'icon' => 'fa-code', 'count' => 120],
                    ['name' => 'Mobile Development', 'icon' => 'fa-mobile-screen', 'count' => 85],
                    ['name' => 'Data Science & AI', 'icon' => 'fa-brain', 'count' => 90],
                    ['name' => 'DevOps & Cloud', 'icon' => 'fa-cloud', 'count' => 60],
                    ['name' => 'Design & UX/UI', 'icon' => 'fa-pen-ruler', 'count' => 70],
                    ['name' => 'Business & Marketing', 'icon' => 'fa-chart-line', 'count' => 50],
                ]) as $category)
                    <a href="{{ route('student.mentors.index', ['expertise' => $category['name']]) }}" class="expertise-card">
                        <span class="expertise-icon"><i class="fa-solid {{ $category['icon'] }}"></i></span>
                        <span class="expertise-name">{{ $category['name'] }}</span>
                        <span class="expertise-count">{{ $category['count'] }}+ Mentors</span>
                    </a>
                @endforeach
            </div>
        </section>
    </div>

    {{-- ===== Sidebar ===== --}}
    <aside class="fm-sidebar">
        <div class="sb-card">
            <h3><i class="fa-solid fa-user-graduate"></i> My Mentorship</h3>
            <ul class="sb-list">
                <li>
                    <a href="{{ route('student.requests.pending') }}">
                        <i class="fa-regular fa-clock"></i> Pending Requests
                        <span class="sb-count">{{ $pendingCount ?? 0 }}</span>
                        <i class="fa-solid fa-chevron-right sb-arrow"></i>
                    </a>
                </li>
                <li>
                    <a href="{{ route('student.requests.accepted') }}">
                        <i class="fa-regular fa-circle-check"></i> Accepted Requests
                        <span class="sb-count">{{ $acceptedCount ?? 0 }}</span>
                        <i class="fa-solid fa-chevron-right sb-arrow"></i>
                    </a>
                </li>
                <li>
                    <a href="{{ route('student.sessions.upcoming') }}">
                        <i class="fa-regular fa-calendar"></i> Upcoming Sessions
                        <span class="sb-count">{{ $upcomingSessionsCount ?? 0 }}</span>
                        <i class="fa-solid fa-chevron-right sb-arrow"></i>
                    </a>
                </li>
                <li>
                    <a href="{{ route('student.sessions.completed') }}">
                        <i class="fa-regular fa-clock"></i> Completed Sessions
                        <span class="sb-count">{{ $completedSessionsCount ?? 0 }}</span>
                        <i class="fa-solid fa-chevron-right sb-arrow"></i>
                    </a>
                </li>
            </ul>
            <a href="{{ route('student.requests.index') }}" class="btn-outline btn-block">View All Requests</a>
        </div>

        <div class="sb-card">
            <h3><i class="fa-regular fa-star"></i> How it Works?</h3>
            <ol class="sb-steps">
                <li>
                    <span class="step-icon"><i class="fa-solid fa-magnifying-glass"></i></span>
                    <div>
                        <strong>1. Find a Mentor</strong>
                        <p>Browse mentors and choose the right one for you.</p>
                    </div>
                </li>
                <li>
                    <span class="step-icon"><i class="fa-regular fa-file-lines"></i></span>
                    <div>
                        <strong>2. Request Mentorship</strong>
                        <p>Select date, time and share your learning goals.</p>
                    </div>
                </li>
                <li>
                    <span class="step-icon"><i class="fa-solid fa-graduation-cap"></i></span>
                    <div>
                        <strong>3. Learn &amp; Grow</strong>
                        <p>Attend sessions, get guidance and achieve your goals.</p>
                    </div>
                </li>
            </ol>
            <a href="{{ route('student.how-it-works') }}" class="link-arrow">Learn More <i class="fa-solid fa-arrow-right"></i></a>
        </div>

        <div class="sb-card sb-help">
            <h3>Need Help?</h3>
            <p>We're here to help you with any questions you have.</p>
            <a href="{{ route('student.support') }}" class="btn-primary-sm btn-block">
                <i class="fa-regular fa-comment-dots"></i> Contact Support
            </a>
        </div>
    </aside>
</div>

<style>
    .fm-page {
        max-width: 1400px;
        margin: 0 auto;
        padding: 24px 20px 60px;
        display: grid;
        grid-template-columns: 1fr 320px;
        gap: 24px;
        align-items: start;
        font-family: 'Inter', system-ui, sans-serif;
        color: #0F172A;
    }

    .fm-main { display: flex; flex-direction: column; gap: 24px; min-width: 0; }

    /* Hero */
    .fm-hero {
        background: linear-gradient(135deg, #EEF0FF 0%, #E4F0FB 100%);
        border-radius: 20px;
        padding: 40px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 24px;
        flex-wrap: wrap;
    }
    .fm-hero-text { max-width: 480px; }
    .fm-hero-tag {
        display: inline-block;
        background: #fff;
        color: #4F46E5;
        font-size: 0.75rem;
        font-weight: 700;
        padding: 6px 14px;
        border-radius: 50px;
        margin-bottom: 14px;
    }
    .fm-hero-text h1 { font-size: 2rem; line-height: 1.25; font-weight: 800; margin: 0 0 12px; color: #0F172A; }
    .fm-hero-text h1 span { color: #2563EB; }
    .fm-hero-text p { color: #475569; margin-bottom: 20px; font-size: 0.95rem; }
    .fm-hero-art img { max-width: 320px; width: 100%; }

    .btn-primary {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #2563EB;
        color: #fff;
        font-weight: 600;
        padding: 12px 22px;
        border-radius: 10px;
        text-decoration: none;
        border: none;
        cursor: pointer;
        transition: background 0.2s;
    }
    .btn-primary:hover { background: #1d4ed8; }

    .btn-primary-sm {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        background: #2563EB;
        color: #fff;
        font-weight: 600;
        font-size: 0.85rem;
        padding: 9px 16px;
        border-radius: 8px;
        text-decoration: none;
        border: none;
        cursor: pointer;
    }
    .btn-primary-sm:hover { background: #1d4ed8; }

    .btn-outline {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        background: #fff;
        color: #334155;
        font-weight: 600;
        font-size: 0.85rem;
        padding: 9px 16px;
        border-radius: 8px;
        border: 1px solid #E2E8F0;
        text-decoration: none;
        cursor: pointer;
    }
    .btn-outline:hover { background: #F8FAFC; }
    .btn-block { width: 100%; margin-top: 10px; }
    .request-message {
        font-size: 0.82rem;
        color: #475569;
        font-style: italic;
        margin: 0;
        padding: 8px 10px;
        background: #F8FAFC;
        border-radius: 8px;
    }

    /* Filters */
    .fm-filters { background: #fff; border: 1px solid #E2E8F0; border-radius: 16px; padding: 18px 20px; }
    .fm-filters-form { display: flex; align-items: flex-end; gap: 16px; flex-wrap: wrap; }
    .fm-search-box {
        flex: 1 1 220px;
        display: flex;
        align-items: center;
        gap: 10px;
        background: #F8FAFC;
        border: 1px solid #E2E8F0;
        border-radius: 10px;
        padding: 10px 14px;
    }
    .fm-search-box i { color: #94A3B8; }
    .fm-search-box input { border: none; background: none; outline: none; width: 100%; font-size: 0.9rem; }
    .fm-filter-group { display: flex; flex-direction: column; gap: 6px; font-size: 0.78rem; color: #64748B; font-weight: 600; }
    .fm-filter-group select {
        padding: 9px 12px;
        border-radius: 8px;
        border: 1px solid #E2E8F0;
        font-size: 0.85rem;
        color: #0F172A;
        background: #fff;
        min-width: 160px;
    }

    /* Section headings */
    .fm-section-head { display: flex; align-items: center; justify-content: space-between; margin-bottom: 16px; flex-wrap: wrap; gap: 8px; }
    .fm-section-head h2 { font-size: 1.15rem; font-weight: 700; display: flex; align-items: center; gap: 8px; margin: 0; }
    .fm-section-head h2 i { color: #F59E0B; }
    .fm-section-head p { color: #64748B; font-size: 0.85rem; margin: 4px 0 0; }
    .fm-view-all { color: #2563EB; font-weight: 600; font-size: 0.85rem; text-decoration: none; display: inline-flex; align-items: center; gap: 6px; }

    /* ===== Requested Students — list layout ===== */
    .rq-list { display: flex; flex-direction: column; gap: 0; background: #fff; border: 1px solid #E2E8F0; border-radius: 16px; overflow: hidden; }
    .rq-row {
        display: grid;
        grid-template-columns: 2.2fr 1.6fr 1.4fr auto;
        align-items: center;
        gap: 16px;
        padding: 18px 20px;
        border-bottom: 1px solid #F1F5F9;
        position: relative;
    }
    .rq-row:last-child { border-bottom: none; }
    .rq-row:hover { background: #FAFBFF; }

    .rq-identity { display: flex; align-items: center; gap: 12px; min-width: 0; }
    .rq-photo { width: 44px; height: 44px; border-radius: 50%; object-fit: cover; background: #E2E8F0; flex-shrink: 0; }
    .rq-identity-text h4 { margin: 0; font-size: 0.95rem; font-weight: 700; color: #0F172A; }
    .rq-identity-text .rq-role { margin: 2px 0 0; font-size: 0.78rem; color: #64748B; }
    .rq-identity-text .rq-company { margin: 0; font-size: 0.75rem; color: #94A3B8; }
    .rq-tag { display: inline-block; margin-top: 6px; background: #EEF2FF; color: #4F46E5; font-size: 0.68rem; font-weight: 700; padding: 3px 9px; border-radius: 50px; }

    .rq-schedule { display: flex; flex-direction: column; gap: 6px; font-size: 0.8rem; color: #334155; }
    .rq-schedule span { display: flex; align-items: center; gap: 8px; }
    .rq-schedule i { color: #94A3B8; width: 14px; }
    .rq-schedule .rq-muted { color: #94A3B8; }
    .rq-message { color: #64748B !important; font-style: italic; }

    .rq-status-block { display: flex; flex-direction: column; align-items: flex-start; gap: 6px; }
    .rq-badge { display: inline-block; font-size: 0.72rem; font-weight: 700; padding: 4px 12px; border-radius: 50px; }
    .rq-badge-pending { background: #FEF3C7; color: #B45309; }
    .rq-badge-accepted { background: #DCFCE7; color: #15803D; }
    .rq-badge-rejected { background: #FEE2E2; color: #B91C1C; }
    .rq-date-label { font-size: 0.72rem; color: #94A3B8; }
    .rq-view-btn { font-size: 0.78rem; padding: 6px 14px; margin-top: 2px; }

    .rq-kebab { position: relative; }
    .rq-kebab-btn { background: none; border: none; color: #94A3B8; cursor: pointer; font-size: 1rem; padding: 6px; border-radius: 6px; }
    .rq-kebab-btn:hover { background: #F1F5F9; color: #334155; }
    .rq-kebab-menu {
        display: none;
        position: absolute;
        right: 0;
        top: calc(100% + 4px);
        background: #fff;
        border: 1px solid #E2E8F0;
        border-radius: 10px;
        box-shadow: 0 10px 30px rgba(15,23,42,0.12);
        min-width: 160px;
        z-index: 20;
        overflow: hidden;
    }
    .rq-kebab-menu.rq-menu-open { display: block; }
    .rq-kebab-menu button, .rq-kebab-menu form button {
        width: 100%;
        display: flex;
        align-items: center;
        gap: 8px;
        background: none;
        border: none;
        text-align: left;
        padding: 10px 14px;
        font-size: 0.82rem;
        color: #334155;
        cursor: pointer;
    }
    .rq-kebab-menu button:hover { background: #F8FAFC; }
    .rq-kebab-menu .rq-danger { color: #DC2626; }

    .rq-showing { text-align: center; color: #94A3B8; font-size: 0.8rem; margin: 14px 0 0; }

    @media (max-width: 900px) {
        .rq-row { grid-template-columns: 1fr; align-items: flex-start; }
        .rq-status-block { align-items: flex-start; }
    }

    /* ===== Modal ===== */
    .rq-modal-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(15,23,42,0.5);
        z-index: 1000;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }
    .rq-modal-overlay.rq-modal-open { display: flex; }
    .rq-modal {
        background: #fff;
        border-radius: 18px;
        max-width: 520px;
        width: 100%;
        max-height: 88vh;
        overflow-y: auto;
        position: relative;
        box-shadow: 0 20px 60px rgba(0,0,0,0.25);
    }
    .rq-modal-close {
        position: absolute;
        top: 14px;
        right: 14px;
        background: #F1F5F9;
        border: none;
        width: 32px;
        height: 32px;
        border-radius: 50%;
        cursor: pointer;
        color: #475569;
    }
    .rq-modal-close:hover { background: #E2E8F0; }
    .rq-modal-header { display: flex; align-items: center; gap: 14px; padding: 24px 24px 16px; border-bottom: 1px solid #F1F5F9; }
    .rq-modal-photo { width: 56px; height: 56px; border-radius: 50%; object-fit: cover; background: #E2E8F0; }
    .rq-modal-header h3 { margin: 0; font-size: 1.05rem; }
    .rq-modal-header .rq-role { margin: 2px 0 0; font-size: 0.82rem; color: #64748B; }
    .rq-modal-header .rq-company { margin: 0; font-size: 0.78rem; color: #94A3B8; }
    .rq-modal-header .rq-badge { margin-left: auto; }

    .rq-modal-body { padding: 20px 24px; display: flex; flex-direction: column; gap: 16px; }
    .rq-modal-field label { display: block; font-size: 0.72rem; font-weight: 700; color: #94A3B8; text-transform: uppercase; letter-spacing: 0.04em; margin-bottom: 4px; }
    .rq-modal-field p { margin: 0; font-size: 0.88rem; color: #0F172A; }
    .rq-modal-field a { color: #2563EB; font-weight: 600; text-decoration: none; }
    .rq-modal-field-row { display: flex; gap: 24px; }
    .rq-modal-field-row > div { flex: 1; }
    .rq-modal-field-row label { display: block; font-size: 0.72rem; font-weight: 700; color: #94A3B8; text-transform: uppercase; letter-spacing: 0.04em; margin-bottom: 4px; }
    .rq-modal-field-row p { margin: 0; font-size: 0.85rem; color: #334155; }

    .rq-modal-footer { display: flex; gap: 10px; padding: 16px 24px 24px; }

    /* Expertise */
    .fm-expertise-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(170px, 1fr)); gap: 14px; }
    .expertise-card {
        background: #fff;
        border: 1px solid #E2E8F0;
        border-radius: 14px;
        padding: 18px;
        text-decoration: none;
        color: #0F172A;
        display: flex;
        flex-direction: column;
        gap: 6px;
        transition: all 0.2s;
    }
    .expertise-card:hover { border-color: #4F46E5; transform: translateY(-2px); box-shadow: 0 8px 20px rgba(79,70,229,0.08); }
    .expertise-icon { width: 38px; height: 38px; border-radius: 10px; background: #EEF2FF; color: #4F46E5; display: flex; align-items: center; justify-content: center; font-size: 1rem; margin-bottom: 4px; }
    .expertise-name { font-weight: 700; font-size: 0.92rem; }
    .expertise-count { font-size: 0.75rem; color: #64748B; }

    /* Sidebar */
    .fm-sidebar { display: flex; flex-direction: column; gap: 20px; position: sticky; top: 90px; }
    .sb-card { background: #fff; border: 1px solid #E2E8F0; border-radius: 16px; padding: 20px; }
    .sb-card h3 { font-size: 0.95rem; margin: 0 0 14px; display: flex; align-items: center; gap: 8px; }
    .sb-card h3 i { color: #4F46E5; }

    .sb-list { list-style: none; margin: 0 0 6px; padding: 0; display: flex; flex-direction: column; gap: 4px; }
    .sb-list a {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px 4px;
        text-decoration: none;
        color: #334155;
        font-size: 0.85rem;
        font-weight: 500;
        border-radius: 8px;
    }
    .sb-list a:hover { background: #F8FAFC; }
    .sb-list i:first-child { color: #94A3B8; width: 16px; }
    .sb-count { margin-left: auto; font-weight: 700; color: #0F172A; }
    .sb-arrow { font-size: 11px !important; color: #CBD5E1; width: auto !important; margin-left: 4px; }

    .sb-steps { list-style: none; margin: 0 0 14px; padding: 0; display: flex; flex-direction: column; gap: 16px; }
    .sb-steps li { display: flex; gap: 12px; align-items: flex-start; }
    .step-icon { width: 34px; height: 34px; border-radius: 10px; background: #EEF2FF; color: #4F46E5; display: flex; align-items: center; justify-content: center; flex-shrink: 0; font-size: 0.85rem; }
    .sb-steps strong { display: block; font-size: 0.85rem; margin-bottom: 2px; }
    .sb-steps p { margin: 0; font-size: 0.78rem; color: #64748B; }

    .link-arrow { color: #2563EB; font-weight: 600; font-size: 0.85rem; text-decoration: none; display: inline-flex; align-items: center; gap: 6px; }

    .sb-help p { font-size: 0.82rem; color: #64748B; margin: 0 0 10px; }

    @media (max-width: 1100px) {
        .fm-page { grid-template-columns: 1fr; }
        .fm-sidebar { position: static; }
    }
</style>
@endsection