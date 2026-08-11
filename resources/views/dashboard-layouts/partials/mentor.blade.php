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

        {{-- ===== Top Mentors ===== --}}
        <section class="fm-mentors" id="mentor-list">
            <div class="fm-section-head">
                <div>
                    <h2><i class="fa-solid fa-star"></i> Top Mentors</h2>
                    <p>Connect with the best mentors and accelerate your growth.</p>
                </div>
                <a href="{{ route('student.mentors.index') }}" class="fm-view-all">View All Mentors <i class="fa-solid fa-arrow-right"></i></a>
            </div>

            <div class="fm-mentor-grid">
                @forelse(($mentors ?? []) as $mentor)
                    <div class="mentor-card">
                        <div class="mentor-card-top">
                            <span class="status-pill status-{{ $mentor['status'] ?? 'online' }}">
                                <i class="fa-solid fa-circle"></i> {{ ucfirst($mentor['status'] ?? 'Online') }}
                            </span>
                            <span class="rating"><i class="fa-solid fa-star"></i> {{ $mentor['rating'] ?? '4.9' }}</span>
                        </div>

                        <div class="mentor-identity">
                            <img src="{{ $mentor['photo'] ?? asset('images/avatar-placeholder.png') }}" alt="{{ $mentor['name'] }}" class="mentor-photo">
                            <div>
                                <h3>{{ $mentor['name'] }}</h3>
                                <p class="mentor-title">{{ $mentor['designation'] }}</p>
                                <span class="mentor-company"><i class="fa-brands fa-{{ $mentor['company_icon'] ?? 'google' }}"></i> {{ $mentor['company'] }}</span>
                            </div>
                        </div>

                        <div class="mentor-skills">
                            @foreach(array_slice($mentor['skills'] ?? [], 0, 3) as $skill)
                                <span class="skill-tag">{{ $skill }}</span>
                            @endforeach
                            @if(count($mentor['skills'] ?? []) > 3)
                                <span class="skill-tag skill-more">+{{ count($mentor['skills']) - 3 }} more</span>
                            @endif
                        </div>

                        <ul class="mentor-meta">
                            <li><i class="fa-regular fa-clock"></i> {{ $mentor['years_experience'] ?? 0 }}+ Years Experience</li>
                            <li><i class="fa-solid fa-user-group"></i> {{ $mentor['mentees_count'] ?? 0 }}+ Mentees</li>
                            <li><i class="fa-regular fa-calendar"></i> {{ $mentor['availability'] ?? 'Flexible' }}</li>
                        </ul>

                        <div class="mentor-actions">
                            <a href="{{ route('student.mentors.show', $mentor['id']) }}" class="btn-outline">View Profile</a>
                            <a href="{{ route('student.mentors.request', $mentor['id']) }}" class="btn-primary-sm">Request Mentorship</a>
                        </div>
                    </div>
                @empty
                    <p class="fm-empty">No mentors found. Try adjusting your filters.</p>
                @endforelse
            </div>
        </section>

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

    /* Mentor cards */
    .fm-mentor-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(260px, 1fr)); gap: 18px; }
    .mentor-card { background: #fff; border: 1px solid #E2E8F0; border-radius: 16px; padding: 18px; display: flex; flex-direction: column; gap: 12px; }
    .mentor-card-top { display: flex; align-items: center; justify-content: space-between; font-size: 0.75rem; }
    .status-pill { display: inline-flex; align-items: center; gap: 5px; font-weight: 600; }
    .status-pill i { font-size: 8px; }
    .status-online i { color: #22C55E; }
    .status-busy i { color: #F97316; }
    .status-away i { color: #EAB308; }
    .rating { display: flex; align-items: center; gap: 4px; font-weight: 700; color: #0F172A; }
    .rating i { color: #F59E0B; }

    .mentor-identity { display: flex; align-items: center; gap: 12px; }
    .mentor-photo { width: 52px; height: 52px; border-radius: 50%; object-fit: cover; background: #E2E8F0; }
    .mentor-identity h3 { font-size: 1rem; margin: 0; }
    .mentor-title { font-size: 0.8rem; color: #64748B; margin: 2px 0 4px; }
    .mentor-company { font-size: 0.78rem; color: #334155; display: flex; align-items: center; gap: 6px; font-weight: 600; }

    .mentor-skills { display: flex; flex-wrap: wrap; gap: 6px; }
    .skill-tag { background: #F1F5F9; color: #334155; font-size: 0.72rem; font-weight: 600; padding: 4px 10px; border-radius: 50px; }
    .skill-more { background: #EEF2FF; color: #4F46E5; }

    .mentor-meta { list-style: none; margin: 0; padding: 0; display: flex; flex-direction: column; gap: 6px; font-size: 0.78rem; color: #64748B; }
    .mentor-meta li { display: flex; align-items: center; gap: 8px; }
    .mentor-meta i { width: 14px; color: #94A3B8; }

    .mentor-actions { display: flex; gap: 10px; margin-top: 4px; }
    .mentor-actions .btn-outline, .mentor-actions .btn-primary-sm { flex: 1; }

    .fm-empty { color: #64748B; padding: 30px 0; text-align: center; }

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