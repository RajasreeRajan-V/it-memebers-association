{{-- NOTE: uses the same mentor-theme.css as the Training Materials page for a matching hero + card + list style --}}
@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/mentor-theme.css') }}">
@endpush

@section('content')
<div class="mentor-shell">

    @if (session('success'))
        <div class="mentor-card" style="margin-bottom:16px; border-color:var(--mt-success); background:var(--mt-success-bg); color:var(--mt-success); font-size:14px;">
            {{ session('success') }}
        </div>
    @endif

{{-- ===================== HERO ===================== --}}
<div class="mentor-hero">
    <div class="mentor-hero-content">
        <span class="mentor-hero-badge">
            <i class="fa-solid fa-graduation-cap"></i>
            {{ $stats['total'] }}+ Webinars Hosted
        </span>

        <h1>
            Learn Through My 
            <span>Webinars & Workshop</span>
        </h1>

        <p>
            Create, manage and share your webinars and workshops. Track registrations, approval status and performance in one place.
        </p>

        <div class="mentor-header-actions">
            <a class="btn btn-primary" href="{{ route('mentor.webinars.create') }}">
                <i class="fa-solid fa-plus"></i> Create Webinar / Workshop
            </a>
        </div>
    </div>

    <div class="mentor-hero-illustration">
        <img src="{{ asset('assets/img/lolo.png') }}" alt="Webinar illustration">
    </div>
</div>

    <div class="mentor-layout">
        {{-- ===================== MAIN COLUMN ===================== --}}
        <div>
            {{-- Tabs --}}
            @php
                $tabsList = [
                    ['label' => 'All',              'status' => null,        'count' => $stats['total']],
                    ['label' => 'Pending Approval',  'status' => 'pending',   'count' => $stats['pending']],
                    ['label' => 'Approved',          'status' => 'approved',  'count' => $stats['approved']],
                    ['label' => 'Rejected',          'status' => 'rejected',  'count' => $stats['rejected']],
                    ['label' => 'Published',         'status' => 'published', 'count' => $stats['published']],
                ];
            @endphp
            <div class="mentor-tabs">
                @foreach ($tabsList as $t)
                    <a href="{{ route('mentor.webinars.index', array_filter(['status' => $t['status']])) }}"
                       class="{{ $activeStatus === $t['status'] ? 'active' : '' }}">
                        {{ $t['label'] }} ({{ $t['count'] }})
                    </a>
                @endforeach
            </div>

            {{-- Search / filter --}}
            <form method="GET" action="{{ route('mentor.webinars.index') }}" class="mentor-toolbar">
                @if($activeStatus)
                    <input type="hidden" name="status" value="{{ $activeStatus }}">
                @endif
                <div class="mentor-search">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" name="q" value="{{ $search }}" placeholder="Search webinar / workshop...">
                </div>
                <button type="submit" class="btn btn-secondary"><i class="fa-solid fa-sliders"></i> Filter</button>
            </form>

            {{-- Webinars list --}}
            <div class="mentor-card" style="padding:22px 22px 8px;">
                <div class="section-label">Webinars / Workshops List</div>

                <div class="material-list">
                    @php
                        $iconPalette = ['c1', 'c2', 'c3', 'c4', 'c5'];
                    @endphp
                    @forelse($webinars as $index => $webinar)
                        @php
                            $accent = $iconPalette[$index % count($iconPalette)];
                            $statusMap = [
                                'published' => ['label' => 'Published', 'class' => 'badge-published'],
                                'approved'  => ['label' => 'Approved',  'class' => 'badge-approved'],
                                'pending'   => ['label' => 'Pending Approval', 'class' => 'badge-draft'],
                                'rejected'  => ['label' => 'Rejected', 'class' => 'badge-rejected'],
                            ];
                            $statusInfo  = $statusMap[$webinar->status] ?? ['label' => ucfirst($webinar->status), 'class' => 'badge-default'];
                            $bannerUrl   = $webinar->banner ? Storage::url($webinar->banner) : '';
                        @endphp

                        <div class="material-card"
                             role="button"
                             tabindex="0"
                             onclick="wbOpenDetailsModal(this)"
                             onkeydown="if(event.key==='Enter'){wbOpenDetailsModal(this)}"
                             data-title="{{ $webinar->title }}"
                             data-description="{{ $webinar->description ?: 'No description provided.' }}"
                             data-category="{{ $webinar->category ?: '—' }}"
                             data-type="{{ strtoupper($webinar->type) }}"
                             data-status="{{ $statusInfo['label'] }}"
                             data-status-class="{{ $statusInfo['class'] }}"
                             data-date="{{ $webinar->scheduled_date->format('d M Y') }}"
                             data-time="{{ \Carbon\Carbon::parse($webinar->scheduled_time)->format('h:i A') }}"
                             data-registrations="{{ $webinar->registrations_count }}"
                             data-capacity="{{ $webinar->capacity ?: '—' }}"
                             data-banner="{{ $bannerUrl }}"
                             data-meeting-link="{{ $webinar->meeting_link ?: '' }}"
                             data-icon="fa-solid fa-chalkboard-user"
                             data-accent="{{ $accent }}">

                            @if($bannerUrl)
                                <div class="material-thumb">
                                    <img src="{{ $bannerUrl }}" alt="{{ $webinar->title }}">
                                </div>
                            @else
                                <div class="material-icon {{ $accent }}">
                                    <i class="fa-solid fa-chalkboard-user"></i>
                                </div>
                            @endif

                            <div class="material-card-body">
                                <h3 class="material-card-title">
                                    {{ $webinar->title }}
                                    <span class="tag-status {{ $statusInfo['class'] }}">{{ $statusInfo['label'] }}</span>
                                </h3>

                                <p class="material-card-desc">
                                    {{ \Illuminate\Support\Str::limit($webinar->description, 90) }}
                                </p>

                                <div class="material-card-tags">
                                    @if($webinar->category)
                                        <span class="tag-pill category-pill">{{ strtoupper($webinar->category) }}</span>
                                    @endif
                                    <span class="tag-pill">{{ strtoupper($webinar->type) }}</span>
                                </div>

                                <div class="material-card-meta">
                                    {{ $webinar->scheduled_date->format('d M Y') }}
                                    &middot; {{ \Carbon\Carbon::parse($webinar->scheduled_time)->format('h:i A') }}
                                </div>
                            </div>

                            <div class="material-card-stats">
                                <div class="stat-top">
                                    <span class="stat-views">
                                        <i class="fa-solid fa-users"></i>
                                        {{ $webinar->registrations_count }}{{ $webinar->capacity ? '/' . $webinar->capacity : '' }}
                                    </span>
                                </div>
                                <div class="stat-date">{{ $webinar->scheduled_date->diffForHumans() }}</div>
                                <div class="stat-bottom">
                                    <span class="stat-pill">{{ ucfirst($webinar->type) }}</span>
                                </div>
                            </div>

                            <div class="row-actions-wrap" onclick="event.stopPropagation()">
                                <button type="button" class="row-actions-btn" onclick="wbToggleRowMenu(this)" aria-label="Row actions">
                                    <i class="fa-solid fa-ellipsis"></i>
                                </button>
                                <div class="row-actions-menu">
                                    <a href="{{ route('mentor.webinars.edit', $webinar) }}" class="row-menu-item">
                                        <i class="fa-solid fa-pen"></i> Edit
                                    </a>
                                    <form action="{{ route('mentor.webinars.destroy', $webinar) }}"
                                          method="POST"
                                          onsubmit="return confirm('Delete &quot;{{ $webinar->title }}&quot;? This cannot be undone.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="row-menu-item row-menu-danger">
                                            <i class="fa-regular fa-trash-can"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="empty-row" style="padding:48px 12px; text-align:center;">
                            No webinars found. <a href="{{ route('mentor.webinars.create') }}">Create your first one</a>.
                        </div>
                    @endforelse
                </div>

                <div class="mentor-pagination">
                    {{ $webinars->links() }}
                </div>
            </div>
        </div>

        {{-- ===================== SIDEBAR ===================== --}}
        <div>
            <div class="sidebar-card">
                <div class="sidebar-card-header"><h3>Quick Actions</h3></div>
                <a href="{{ route('mentor.webinars.create') }}" class="btn btn-primary" style="width:100%;justify-content:center;margin-bottom:14px;">
                    <i class="fa-solid fa-plus"></i> Create Webinar / Workshop
                </a>
                <a href="{{ route('mentor.webinars.create') }}?type=webinar" class="quick-action-btn">
                    <span class="qa-icon" style="background:#EAF1FF;color:#3b6ff8;"><i class="fa-solid fa-video"></i></span>
                    <span>Host a Webinar<small>Schedule a live online session</small></span>
                </a>
                <a href="{{ route('mentor.webinars.create') }}?type=workshop" class="quick-action-btn">
                    <span class="qa-icon" style="background:#F1EBFE;color:#7C3AED;"><i class="fa-solid fa-chalkboard-user"></i></span>
                    <span>Host a Workshop<small>Plan a hands-on training session</small></span>
                </a>
            </div>

            <div class="sidebar-card">
                <div class="sidebar-card-header"><h3>Webinar Overview</h3></div>
                <div class="category-row">
                    <span><span class="dot" style="background:#2E5CE6;"></span>Total Webinars</span>
                    <span class="count">{{ $stats['total'] }}</span>
                </div>
                <div class="category-row">
                    <span><span class="dot" style="background:#2FB673;"></span>Approved</span>
                    <span class="count">{{ $stats['approved'] }}</span>
                </div>
                <div class="category-row">
                    <span><span class="dot" style="background:#E7B613;"></span>Pending Approval</span>
                    <span class="count">{{ $stats['pending'] }}</span>
                </div>
                <div class="category-row">
                    <span><span class="dot" style="background:#F0673B;"></span>Rejected</span>
                    <span class="count">{{ $stats['rejected'] }}</span>
                </div>
            </div>

            <div class="sidebar-card">
                <div class="sidebar-card-header">
                    <h3>Latest Webinars</h3>
                    <a href="{{ route('mentor.webinars.index') }}">View All</a>
                </div>
                @php
                    $upStatusMap = [
                        'published' => 'badge-published',
                        'approved'  => 'badge-approved',
                        'pending'   => 'badge-draft',
                        'rejected'  => 'badge-rejected',
                    ];
                @endphp
                @forelse($upcoming as $item)
                    <div class="ranked-row">
                        @if($item->banner)
                            <img src="{{ Storage::url($item->banner) }}" alt=""
                                 style="width:32px;height:32px;border-radius:8px;object-fit:cover;">
                        @else
                            <span class="qa-icon" style="background:#EAF1FF;color:#3b6ff8;width:32px;height:32px;">
                                <i class="fa-solid fa-chalkboard-user"></i>
                            </span>
                        @endif
                        <span class="name" style="flex:1;">
                            {{ \Illuminate\Support\Str::limit($item->title, 26) }}
                            <small>{{ $item->scheduled_date->format('d M Y') }} &middot; {{ $item->platform ?? ucfirst($item->type) }}</small>
                        </span>
                        <span class="tag-status {{ $upStatusMap[$item->status] ?? 'badge-default' }}">{{ ucfirst($item->status) }}</span>
                    </div>
                @empty
                    <p style="font-size:12.5px;color:var(--mt-text-muted);">No upcoming webinars.</p>
                @endforelse
            </div>

            <div class="sidebar-card">
                <div class="sidebar-card-header"><h3><i class="fa-regular fa-lightbulb"></i> Tips for a Successful Webinar</h3></div>
                <ul style="font-size:12.5px;color:var(--mt-text-muted);padding-left:18px;margin:0;">
                    <li>Choose a relevant topic for your audience</li>
                    <li>Provide clear learning outcomes</li>
                    <li>Prepare interactive slides and demos</li>
                    <li>Promote your webinar in advance</li>
                    <li>Record and share the session with attendees</li>
                </ul>
            </div>
        </div>
    </div>

</div>

{{-- ===================== WEBINAR DETAILS MODAL ===================== --}}
<div class="mt-modal-overlay" id="wbModalOverlay" onclick="wbCloseDetailsModal(event)">
    <div class="mt-modal" onclick="event.stopPropagation()">
        <button type="button" class="mt-modal-close" onclick="wbCloseDetailsModal()" aria-label="Close">
            <i class="fa-solid fa-xmark"></i>
        </button>

        <div class="mt-modal-cover" id="wbModalCover" style="display:none;"></div>

        <div class="mt-modal-body">
            <div class="mt-modal-badges">
                <span class="badge-status" id="wbModalStatus"></span>
            </div>

            <h2 id="wbModalTitle"></h2>

            <div class="mt-modal-tags">
                <span class="tag-pill" id="wbModalCategory"></span>
                <span class="tag-pill" id="wbModalType"></span>
            </div>

            <p class="mt-modal-desc" id="wbModalDescription"></p>

            <div class="mt-modal-stats">
                <div class="mt-modal-stat">
                    <i class="fa-regular fa-calendar"></i>
                    <span id="wbModalDate"></span>
                </div>
                <div class="mt-modal-stat">
                    <i class="fa-regular fa-clock"></i>
                    <span id="wbModalTime"></span>
                </div>
                <div class="mt-modal-stat">
                    <i class="fa-solid fa-users"></i>
                    <span id="wbModalRegistrations"></span> Registered
                </div>
                <div class="mt-modal-stat">
                    <i class="fa-solid fa-chair"></i>
                    <span id="wbModalCapacity"></span> Capacity
                </div>
            </div>

            <div class="mt-modal-footer">
                <a href="#" id="wbModalMeetingBtn" class="btn btn-primary" target="_blank" rel="noopener" style="display:none;">
                    <i class="fa-solid fa-link"></i> Open Meeting Link
                </a>
            </div>
        </div>
    </div>
</div>

<script>
    // ---------- 3-dot row menu ----------
    function wbToggleRowMenu(btn) {
        const menu = btn.nextElementSibling;
        const isOpen = menu.classList.contains('open');
        document.querySelectorAll('.row-actions-menu.open').forEach(m => m.classList.remove('open'));
        if (!isOpen) menu.classList.add('open');
    }

    document.addEventListener('click', function (e) {
        if (!e.target.closest('.row-actions-wrap')) {
            document.querySelectorAll('.row-actions-menu.open').forEach(m => m.classList.remove('open'));
        }
    });

    // ---------- Webinar details modal ----------
    function wbOpenDetailsModal(card) {
        const d = card.dataset;

        document.getElementById('wbModalTitle').textContent = d.title;
        document.getElementById('wbModalDescription').textContent = d.description;
        document.getElementById('wbModalCategory').textContent = d.category;
        document.getElementById('wbModalType').textContent = d.type;
        document.getElementById('wbModalDate').textContent = d.date;
        document.getElementById('wbModalTime').textContent = d.time;
        document.getElementById('wbModalRegistrations').textContent = d.registrations;
        document.getElementById('wbModalCapacity').textContent = d.capacity;

        const statusEl = document.getElementById('wbModalStatus');
        statusEl.textContent = d.status;
        statusEl.className = 'badge-status ' + d.statusClass;

        const meetingBtn = document.getElementById('wbModalMeetingBtn');
        if (d.meetingLink) {
            meetingBtn.href = d.meetingLink;
            meetingBtn.style.display = 'inline-flex';
        } else {
            meetingBtn.style.display = 'none';
        }

        const coverEl = document.getElementById('wbModalCover');
        coverEl.innerHTML = '';
        if (d.banner) {
            coverEl.style.display = 'block';
            coverEl.innerHTML = '<img src="' + d.banner + '" alt="" style="width:100%;height:100%;object-fit:cover;display:block;">';
        } else {
            coverEl.style.display = 'none';
        }

        document.getElementById('wbModalOverlay').classList.add('open');
        document.body.style.overflow = 'hidden';
    }

    function wbCloseDetailsModal(e) {
        document.getElementById('wbModalOverlay').classList.remove('open');
        document.body.style.overflow = '';
    }

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            wbCloseDetailsModal();
        }
    });
</script>

@push('styles')
<style>
    /* Status colors not covered by the shared theme (webinar-specific statuses) */
    .badge-approved { background: #d4f4e2; color: #1b8a5a; }

    /* Extra stat icon colors for webinar-specific stats not in the base theme */
    .icon-rejected  { background: #fbe1e1; color: #c0392b; }
    .icon-completed { background: #EAF1FF; color: #3b6ff8; }
</style>
@endpush

@endsection