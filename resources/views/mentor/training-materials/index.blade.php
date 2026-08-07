{{-- NOTE: see mentor-theme.css for the matching hero + card + modal styles (also provided) --}}
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
            {{ $stats['total'] }}+ Materials Shared
        </span>

        <h1>
            Training Materials
            <span>Built By Mentors, For Mentees</span>
        </h1>

        <p>
            Create, manage and share high-quality learning materials to help mentees upskill and grow in their careers.
        </p>

        <div class="mentor-header-actions">
            <a class="btn btn-primary" href="{{ route('mentor.training-materials.create') }}">
                <i class="fa-solid fa-plus"></i> Create New Material
            </a>
        </div>
    </div>

    <div class="mentor-hero-illustration">
        <img src="{{ asset('assets/img/mentorr.png') }}" alt="Training materials illustration">
    </div>
</div>

    {{-- ===================== STAT CARDS ===================== --}}
    <div class="stat-row">
        <div class="stat-card">
            <div class="stat-icon icon-total"><i class="fa-regular fa-file-lines"></i></div>
            <div>
                <div class="stat-value">{{ $stats['total'] }}</div>
                <div class="stat-label">Total Materials</div>
                <div class="stat-sub">All time</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon icon-published"><i class="fa-solid fa-circle-check"></i></div>
            <div>
                <div class="stat-value">{{ $stats['published'] }}</div>
                <div class="stat-label">Published</div>
                <div class="stat-sub">Published & live</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon icon-draft"><i class="fa-regular fa-clock"></i></div>
            <div>
                <div class="stat-value">{{ $stats['pending'] }}</div>
                <div class="stat-label">Pending Review</div>
                <div class="stat-sub">Awaiting admin approval</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon icon-downloads"><i class="fa-solid fa-download"></i></div>
            <div>
                <div class="stat-value">{{ number_format($stats['downloads']) }}</div>
                <div class="stat-label">Total Downloads</div>
                <div class="stat-sub">All time downloads</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon icon-views"><i class="fa-regular fa-eye"></i></div>
            <div>
                <div class="stat-value">{{ number_format($stats['views']) }}</div>
                <div class="stat-label">Total Views</div>
                <div class="stat-sub">All time views</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon icon-rating"><i class="fa-solid fa-star"></i></div>
            <div>
                <div class="stat-value">{{ $stats['avg_rating'] ? number_format($stats['avg_rating'], 1) . '/5' : '—' }}</div>
                <div class="stat-label">Avg. Rating</div>
                <div class="stat-sub">By mentees</div>
            </div>
        </div>
    </div>

    <div class="mentor-layout">
        {{-- ===================== MAIN COLUMN ===================== --}}
        <div>
            {{-- Tabs --}}
            <div class="mentor-tabs">
                @php
                    $tabs = [
                        'all'         => 'All Materials',
                        'published'   => 'Published',
                        'recommended' => 'Recommended',
                        'rejected'    => 'Rejected',
                    ];
                @endphp
                @foreach ($tabs as $key => $label)
                    <a href="{{ route('mentor.training-materials.index', ['tab' => $key]) }}"
                       class="{{ $tab === $key ? 'active' : '' }}">{{ $label }}</a>
                @endforeach
            </div>

            {{-- Search / filter / sort --}}
            <form method="GET" action="{{ route('mentor.training-materials.index') }}" class="mentor-toolbar">
                <input type="hidden" name="tab" value="{{ $tab }}">
                <div class="mentor-search">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Search materials...">
                </div>
                <select name="sort" class="mentor-select" onchange="this.form.submit()">
                    <option value="newest"  {{ request('sort', 'newest') === 'newest' ? 'selected' : '' }}>Newest First</option>
                    <option value="oldest"  {{ request('sort') === 'oldest' ? 'selected' : '' }}>Oldest First</option>
                    <option value="most_viewed" {{ request('sort') === 'most_viewed' ? 'selected' : '' }}>Most Viewed</option>
                    <option value="most_downloaded" {{ request('sort') === 'most_downloaded' ? 'selected' : '' }}>Most Downloaded</option>
                </select>
                <button type="submit" class="btn btn-secondary"><i class="fa-solid fa-sliders"></i> Filter</button>
            </form>

            {{-- Materials list --}}
            <div class="mentor-card" style="padding:22px 22px 8px;">
                <div class="section-label">Materials List</div>

                <div class="material-list">
                    @forelse($materials as $index => $material)
                        @php
                            $accent = 'c' . (($index % 5) + 1);
                            $typeIcon = match($material->type) {
                                'video' => 'fa-solid fa-video',
                                'ppt'   => 'fa-solid fa-file-powerpoint',
                                default => 'fa-solid fa-file-pdf',
                            };

                            // ---- status -> label/class map (Published, Pending Review, Rejected) ----
                            $statusMap = [
                                'published' => ['label' => 'Published',      'class' => 'badge-published'],
                                'pending'   => ['label' => 'Pending Review', 'class' => 'badge-draft'],
                                'rejected'  => ['label' => 'Rejected',       'class' => 'badge-rejected'],
                            ];
                            $statusInfo  = $statusMap[$material->status] ?? ['label' => ucfirst($material->status), 'class' => 'badge-default'];
                            $statusLabel = $statusInfo['label'];
                            $statusClass = $statusInfo['class'];

                            $isRecommended = $material->rating_count > 0 && $material->rating_avg >= 4.5;
                            $coverUrl = $material->cover_image ? asset('storage/' . $material->cover_image) : '';
                            $fileUrl = $material->file_path ? asset('storage/' . $material->file_path) : '';

                            // star breakdown for this card (0-5, half-star aware)
                            $ratingValue = $material->rating_count > 0 ? (float) $material->rating_avg : 0;
                            $fullStars = floor($ratingValue);
                            $hasHalfStar = ($ratingValue - $fullStars) >= 0.5;
                        @endphp

                        <div class="material-card"
                             role="button"
                             tabindex="0"
                             onclick="mtOpenMaterialModal(this)"
                             onkeydown="if(event.key==='Enter'){mtOpenMaterialModal(this)}"
                             data-title="{{ $material->title }}"
                             data-description="{{ $material->description ?: 'No description provided.' }}"
                             data-category="{{ $material->category }}"
                             data-type="{{ strtoupper($material->type) }}"
                             data-type-raw="{{ $material->type }}"
                             data-status="{{ $statusLabel }}"
                             data-status-class="{{ $statusClass }}"
                             data-recommended="{{ $isRecommended ? '1' : '0' }}"
                             data-views="{{ number_format($material->views_count) }}"
                             data-downloads="{{ number_format($material->downloads_count) }}"
                             data-rating="{{ $material->rating_count > 0 ? number_format($material->rating_avg, 1) : '—' }}"
                             data-rating-value="{{ $ratingValue }}"
                             data-rating-count="{{ $material->rating_count }}"
                             data-date="{{ $material->updated_at?->format('d M Y') }}"
                             data-cover="{{ $coverUrl }}"
                             data-file-url="{{ $fileUrl }}"
                             data-icon="{{ $typeIcon }}"
                             data-accent="{{ $accent }}"
                             data-download-url="{{ route('mentor.training-materials.download', $material->id) }}"
                             data-view-url="{{ Route::has('mentor.training-materials.view') ? route('mentor.training-materials.view', $material->id) : '' }}"
                             data-rate-url="{{ Route::has('mentor.training-materials.rate') ? route('mentor.training-materials.rate', $material->id) : '' }}">

                            @if($coverUrl)
                                <div class="material-thumb">
                                    <img src="{{ $coverUrl }}" alt="{{ $material->title }}">
                                </div>
                            @else
                                <div class="material-icon {{ $accent }}">
                                    <i class="{{ $typeIcon }}"></i>
                                </div>
                            @endif

                            <div class="material-card-body">
                                <h3 class="material-card-title">
                                    {{ $material->title }}
                                    <span class="tag-status {{ $statusClass }}">{{ $statusLabel }}</span>
                                    @if($isRecommended)
                                        <span class="tag-status badge-recommended">
                                            <i class="fa-solid fa-star"></i> Recommended
                                        </span>
                                    @endif
                                </h3>

                                <p class="material-card-desc">
                                    {{ \Illuminate\Support\Str::limit($material->description ?: 'No description provided.', 90) }}
                                </p>

                                <div class="material-card-tags">
                                    <span class="tag-pill category-pill">{{ strtoupper($material->category) }}</span>
                                </div>

                                <div class="material-card-meta">
                                    {{ strtoupper($material->type) }} &middot; {{ $material->updated_at?->diffForHumans() }}
                                </div>

                                {{-- star rating row (read-only preview on the card) --}}
                                <div class="material-card-stars" aria-label="Rating {{ $ratingValue }} out of 5">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= $fullStars)
                                            <i class="fa-solid fa-star star-filled"></i>
                                        @elseif ($i == $fullStars + 1 && $hasHalfStar)
                                            <i class="fa-solid fa-star-half-stroke star-filled"></i>
                                        @else
                                            <i class="fa-regular fa-star star-empty"></i>
                                        @endif
                                    @endfor
                                    <span class="material-card-stars-count">
                                        {{ $material->rating_count > 0 ? number_format($material->rating_avg, 1) . " ({$material->rating_count})" : 'No ratings yet' }}
                                    </span>
                                </div>
                            </div>

                            <div class="material-card-stats">
                                <div class="stat-top">
                                    <span class="stat-views"><i class="fa-regular fa-eye"></i> {{ number_format($material->views_count) }}</span>
                                </div>
                                <div class="stat-date">{{ $material->updated_at?->diffForHumans() }}</div>
                                <div class="stat-bottom">
                                    <span class="stat-pill stat-downloads"><i class="fa-solid fa-download"></i> {{ number_format($material->downloads_count) }}</span>
                                    <span class="stat-pill stat-rating"><i class="fa-solid fa-star"></i> {{ $material->rating_count > 0 ? number_format($material->rating_avg, 1) : '—' }}</span>
                                </div>
                            </div>

                            <div class="row-actions-wrap" onclick="event.stopPropagation()">
                                <button type="button" class="row-actions-btn" onclick="mtToggleRowMenu(this)" aria-label="Row actions">
                                    <i class="fa-solid fa-ellipsis"></i>
                                </button>
                                <div class="row-actions-menu">
                                    <a href="{{ route('mentor.training-materials.download', $material->id) }}" class="row-menu-item">
                                        <i class="fa-solid fa-download"></i> Download
                                    </a>
                                    <form action="{{ route('mentor.training-materials.destroy', $material->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Delete &quot;{{ $material->title }}&quot;? This cannot be undone.');">
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
                            No materials found. <a href="{{ route('mentor.training-materials.create') }}">Upload your first one</a>.
                        </div>
                    @endforelse
                </div>

                <div class="mentor-pagination">
                    {{ $materials->links() }}
                </div>
            </div>
        </div>

        {{-- ===================== SIDEBAR ===================== --}}
        <div>
            <div class="sidebar-card">
                <div class="sidebar-card-header"><h3>Quick Actions</h3></div>
                <a href="{{ route('mentor.training-materials.create') }}" class="btn btn-primary" style="width:100%;justify-content:center;margin-bottom:14px;">
                    <i class="fa-solid fa-plus"></i> Create New Material
                </a>
                <a href="{{ route('mentor.training-materials.create') }}?type=pdf" class="quick-action-btn">
                    <span class="qa-icon" style="background:var(--mt-danger-bg);color:var(--mt-danger);"><i class="fa-solid fa-file-pdf"></i></span>
                    <span>Upload PDF / Document<small>Upload guides, notes, or documentation</small></span>
                </a>
                <a href="{{ route('mentor.training-materials.create') }}?type=video" class="quick-action-btn">
                    <span class="qa-icon" style="background:#F1EBFE;color:#7C3AED;"><i class="fa-solid fa-video"></i></span>
                    <span>Add Video Tutorial<small>Share video lessons with your mentees</small></span>
                </a>
                <a href="{{ route('mentor.training-materials.create') }}?type=link" class="quick-action-btn">
                    <span class="qa-icon" style="background:var(--mt-success-bg);color:var(--mt-success);"><i class="fa-solid fa-link"></i></span>
                    <span>Add External Link<small>Share useful resources and links</small></span>
                </a>
            </div>

            <div class="sidebar-card">
                <div class="sidebar-card-header">
                    <h3>Top Categories</h3>
                    <a href="#">View All</a>
                </div>
                @php $dotColors = ['#2E5CE6', '#E7B613', '#17A9C9', '#2FB673', '#F0673B']; @endphp
                @forelse($topCategories as $i => $cat)
                    <div class="category-row">
                        <span><span class="dot" style="background:{{ $dotColors[$i % 5] }};"></span>{{ $cat->category }}</span>
                        <span class="count">{{ $cat->total }} Materials</span>
                    </div>
                @empty
                    <p style="font-size:12.5px;color:var(--mt-text-muted);">No categories yet.</p>
                @endforelse
            </div>

            <div class="sidebar-card">
                <div class="sidebar-card-header">
                    <h3>Most Downloaded</h3>
                    <a href="#">View All</a>
                </div>
                @forelse($mostDownloaded as $i => $item)
                    <div class="ranked-row">
                        <span class="name"><span class="rank">{{ $i + 1 }}</span></span>
                        <span class="name" style="flex:1;">
                            {{ \Illuminate\Support\Str::limit($item->title, 26) }}
                            <small>{{ number_format($item->downloads_count) }} Downloads</small>
                        </span>
                    </div>
                @empty
                    <p style="font-size:12.5px;color:var(--mt-text-muted);">No downloads yet.</p>
                @endforelse
            </div>
        </div>
    </div>

</div>

{{-- ===================== MATERIAL DETAILS MODAL ===================== --}}
<div class="mt-modal-overlay" id="mtModalOverlay" onclick="mtCloseMaterialModal(event)">
    <div class="mt-modal" onclick="event.stopPropagation()">
        <button type="button" class="mt-modal-close" onclick="mtCloseMaterialModal()" aria-label="Close">
            <i class="fa-solid fa-xmark"></i>
        </button>

        {{-- cover area: video player for video materials, hidden entirely for everything else --}}
        <div class="mt-modal-cover" id="mtModalCover" style="display:none;"></div>

        <div class="mt-modal-body">
            <div class="mt-modal-badges">
                <span class="badge-status" id="mtModalStatus"></span>
                <span class="badge-status badge-recommended" id="mtModalRecommended" style="display:none;">
                    <i class="fa-solid fa-star"></i> Recommended
                </span>
            </div>

            <h2 id="mtModalTitle"></h2>

            <div class="mt-modal-tags">
                <span class="tag-pill" id="mtModalCategory"></span>
                <span class="tag-pill" id="mtModalType"></span>
            </div>

            <p class="mt-modal-desc" id="mtModalDescription"></p>

            {{-- interactive star rating (click a star to submit a rating) --}}
            <div class="mt-modal-stars" id="mtModalStars" role="radiogroup" aria-label="Rate this material">
                @for ($i = 1; $i <= 5; $i++)
                    <i class="fa-regular fa-star mt-star" data-value="{{ $i }}" role="radio" tabindex="0"></i>
                @endfor
            </div>
            <div class="mt-modal-your-rating" id="mtModalYourRating" style="display:none;"></div>

            <div class="mt-modal-stats">
                <div class="mt-modal-stat">
                    <i class="fa-regular fa-eye"></i>
                    <span id="mtModalViews"></span> Views
                </div>
                <div class="mt-modal-stat">
                    <i class="fa-solid fa-download"></i>
                    <span id="mtModalDownloads"></span> Downloads
                </div>
                <div class="mt-modal-stat">
                    <i class="fa-solid fa-star"></i>
                    <span id="mtModalRating"></span> (<span id="mtModalRatingCount"></span> ratings)
                </div>
                <div class="mt-modal-stat">
                    <i class="fa-regular fa-calendar"></i>
                    <span id="mtModalDate"></span>
                </div>
            </div>

            <div class="mt-modal-footer">
                <a href="#" id="mtModalDownloadBtn" class="btn btn-primary">
                    <i class="fa-solid fa-download"></i> Download File
                </a>
            </div>
        </div>
    </div>
</div>

<script>
    // ---------- 3-dot row menu ----------
    function mtToggleRowMenu(btn) {
        const menu = btn.nextElementSibling;
        const isOpen = menu.classList.contains('open');

        document.querySelectorAll('.row-actions-menu.open').forEach(m => m.classList.remove('open'));

        if (!isOpen) {
            menu.classList.add('open');
        }
    }

    document.addEventListener('click', function (e) {
        if (!e.target.closest('.row-actions-wrap')) {
            document.querySelectorAll('.row-actions-menu.open').forEach(m => m.classList.remove('open'));
        }
    });

    // ---------- Interactive star rating (modal) ----------
    let mtCurrentRateUrl = null;
    let mtCurrentCard = null;

    function mtRenderInteractiveStars(container, filledCount) {
        container.querySelectorAll('.mt-star').forEach(star => {
            const val = parseInt(star.dataset.value, 10);
            star.classList.toggle('fa-solid', val <= filledCount);
            star.classList.toggle('fa-regular', val > filledCount);
            star.classList.toggle('star-filled', val <= filledCount);
        });
    }

    function mtSubmitRating(value) {
        if (!mtCurrentRateUrl) {
            alert('Rating is not available right now. Please refresh the page and try again.');
            return;
        }
        const csrfMeta = document.querySelector('meta[name="csrf-token"]');
        if (!csrfMeta) return;

        fetch(mtCurrentRateUrl, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfMeta.content,
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ rating: value })
        })
        .then(res => res.ok ? res.json() : Promise.reject())
        .then(data => {
            document.getElementById('mtModalRating').textContent = data.rating_avg;
            document.getElementById('mtModalRatingCount').textContent = data.rating_count;

            const yourRatingEl = document.getElementById('mtModalYourRating');
            yourRatingEl.style.display = 'block';
            yourRatingEl.textContent = 'You rated this ' + data.user_rating + ' / 5';

            if (mtCurrentCard) {
                const pill = mtCurrentCard.querySelector('.stat-rating');
                if (pill) pill.innerHTML = '<i class="fa-solid fa-star"></i> ' + data.rating_avg;
                mtCurrentCard.dataset.ratingValue = data.rating_avg;
                mtCurrentCard.dataset.ratingCount = data.rating_count;
            }
        })
        .catch(() => alert('Could not save your rating. Please try again.'));
    }

    (function initStarHandlers() {
        const starsContainer = document.getElementById('mtModalStars');
        if (!starsContainer) return;

        starsContainer.addEventListener('mouseover', function (e) {
            const star = e.target.closest('.mt-star');
            if (star) mtRenderInteractiveStars(starsContainer, parseInt(star.dataset.value, 10));
        });

        starsContainer.addEventListener('mouseleave', function () {
            const current = Math.round(parseFloat(mtCurrentCard?.dataset.ratingValue || 0));
            mtRenderInteractiveStars(starsContainer, current);
        });

        starsContainer.addEventListener('click', function (e) {
            const star = e.target.closest('.mt-star');
            if (!star) return;
            const value = parseInt(star.dataset.value, 10);
            mtRenderInteractiveStars(starsContainer, value);
            mtSubmitRating(value);
        });

        starsContainer.addEventListener('keydown', function (e) {
            const star = e.target.closest('.mt-star');
            if (star && (e.key === 'Enter' || e.key === ' ')) {
                e.preventDefault();
                star.click();
            }
        });
    })();

    // ---------- Material details modal ----------
    function mtOpenMaterialModal(card) {
        const d = card.dataset;

        document.getElementById('mtModalTitle').textContent = d.title;
        document.getElementById('mtModalDescription').textContent = d.description;
        document.getElementById('mtModalCategory').textContent = d.category;
        document.getElementById('mtModalType').textContent = d.type;
        document.getElementById('mtModalViews').textContent = d.views;
        document.getElementById('mtModalDownloads').textContent = d.downloads;
        document.getElementById('mtModalRating').textContent = d.rating;
        document.getElementById('mtModalRatingCount').textContent = d.ratingCount;
        document.getElementById('mtModalDate').textContent = d.date;
        document.getElementById('mtModalDownloadBtn').href = d.downloadUrl;

        // wire up interactive stars for THIS card/material
        mtCurrentCard = card;
        mtCurrentRateUrl = d.rateUrl;
        document.getElementById('mtModalYourRating').style.display = 'none';
        mtRenderInteractiveStars(
            document.getElementById('mtModalStars'),
            Math.round(parseFloat(d.ratingValue || 0))
        );

        const statusEl = document.getElementById('mtModalStatus');
        statusEl.textContent = d.status;
        statusEl.className = 'badge-status ' + d.statusClass;

        const recEl = document.getElementById('mtModalRecommended');
        recEl.style.display = d.recommended === '1' ? 'inline-flex' : 'none';

        // ---- Cover area: video plays inline; everything else has no cover in the modal ----
        const coverEl = document.getElementById('mtModalCover');
        coverEl.innerHTML = '';

        if (d.typeRaw === 'video' && d.fileUrl) {
            coverEl.style.display = 'block';
            coverEl.className = 'mt-modal-cover mt-modal-cover-video';
            coverEl.innerHTML = '<video controls preload="metadata" playsinline style="width:100%;height:100%;display:block;background:#000;">' +
                '<source src="' + d.fileUrl + '">' +
                'Your browser does not support video playback.' +
                '</video>';
        } else {
            // No cover shown in the popup for non-video materials —
            // the thumbnail already lives on the index card itself.
            coverEl.style.display = 'none';
        }

        document.getElementById('mtModalOverlay').classList.add('open');
        document.body.style.overflow = 'hidden';

        // ---- fire-and-forget view increment ----
        const csrfMeta = document.querySelector('meta[name="csrf-token"]');
        if (d.viewUrl && csrfMeta) {
            fetch(d.viewUrl, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfMeta.content,
                    'Accept': 'application/json'
                }
            })
            .then(res => res.ok ? res.json() : Promise.reject())
            .then(data => {
                const formatted = new Intl.NumberFormat().format(data.views);
                document.getElementById('mtModalViews').textContent = formatted;
                const viewsBadge = card.querySelector('.stat-views');
                if (viewsBadge) {
                    viewsBadge.innerHTML = '<i class="fa-regular fa-eye"></i> ' + formatted;
                }
                card.dataset.views = formatted;
            })
            .catch(() => { /* silently ignore - don't block the modal on a failed ping */ });
        }
    }

    function mtCloseMaterialModal(e) {
        if (e && e.target !== e.currentTarget && e.type === 'click' && e.target.id !== 'mtModalOverlay') {
            // click was inside modal content, ignore (safety net alongside stopPropagation)
        }

        // stop any playing video so audio doesn't keep running behind the closed modal
        const coverEl = document.getElementById('mtModalCover');
        const video = coverEl.querySelector('video');
        if (video) {
            video.pause();
            video.currentTime = 0;
        }
        coverEl.innerHTML = '';
        coverEl.style.display = 'none';

        document.getElementById('mtModalOverlay').classList.remove('open');
        document.body.style.overflow = '';
    }

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            mtCloseMaterialModal();
        }
    });
</script>
@endsection