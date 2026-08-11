@extends('layouts.app')

@section('content')
<div class="wz-shell">

    {{-- ===================== HEADER ===================== --}}
    <div class="wz-header">
        <div>
            <h1>Host Webinar / Workshop</h1>
            <p>Create and submit your session for admin approval</p>
        </div>

        <div class="wz-stepper" id="wzStepper">
            <div class="wz-step active" data-step="1">
                <span class="wz-step-circle">1</span>
                <span class="wz-step-label">Basic Info</span>
            </div>
            <span class="wz-step-line"></span>
            <div class="wz-step" data-step="2">
                <span class="wz-step-circle">2</span>
                <span class="wz-step-label">Schedule</span>
            </div>
            <span class="wz-step-line"></span>
            <div class="wz-step" data-step="3">
                <span class="wz-step-circle">3</span>
                <span class="wz-step-label">Details</span>
            </div>
            <span class="wz-step-line"></span>
            <div class="wz-step" data-step="4">
                <span class="wz-step-circle">4</span>
                <span class="wz-step-label">Media</span>
            </div>
        </div>
    </div>

    <div class="wz-layout">

        {{-- ===================== FORM CARD ===================== --}}
        <div class="wz-card">

            {{-- Mini progress checklist (left column) --}}
            <div class="wz-mini-checklist" id="wzMiniChecklist">
                <span class="wz-mini-item" data-check="title"><span class="wz-check-box"></span> Title</span>
                <span class="wz-mini-item" data-check="category"><span class="wz-check-box"></span> Category &amp;
                    Platform</span>
                <span class="wz-mini-item" data-check="schedule"><span class="wz-check-box"></span> Date &amp;
                    Time</span>
                <span class="wz-mini-item" data-check="description"><span class="wz-check-box"></span>
                    Description</span>
                <span class="wz-mini-item" data-check="banner"><span class="wz-check-box"></span> Banner</span>
            </div>

            <form method="POST" action="{{ route('mentor.webinars.store') }}" enctype="multipart/form-data"
                id="webinarForm">
                @csrf

                {{-- ---------- STEP 1: BASIC INFO ---------- --}}
                <div class="wz-step-panel" data-panel="1">
                    <div class="wz-card-head">
                        <span class="wz-card-icon"><i class="fa-solid fa-video"></i></span>
                        <div>
                            <h3>Basic Information</h3>
                            <p>Core details about the webinar or workshop</p>
                        </div>
                    </div>

                    <div class="wz-tip-box">
                        <i class="fa-regular fa-lightbulb"></i>
                        <span>Use a clear, specific title — it's the first thing mentees see, and specific titles get
                            more registrations.</span>
                    </div>

                    <div class="wz-field">
                        <label>Event Type <span class="req">*</span></label>
                        <div class="wz-type-toggle">
                            <input type="radio" name="type" id="type_webinar" value="webinar" hidden
                                {{ old('type', 'webinar') === 'webinar' ? 'checked' : '' }}>
                            <label for="type_webinar"><i class="fa-solid fa-chalkboard-user"></i> Webinar</label>

                            <input type="radio" name="type" id="type_workshop" value="workshop" hidden
                                {{ old('type') === 'workshop' ? 'checked' : '' }}>
                            <label for="type_workshop"><i class="fa-solid fa-people-group"></i> Workshop</label>
                        </div>
                        @error('type')<div class="wz-error">{{ $message }}</div>@enderror
                    </div>

                    <div class="wz-field">
                        <label>Title <span class="req">*</span></label>
                        <input type="text" name="title" id="wzTitle" maxlength="100" value="{{ old('title') }}"
                            placeholder="e.g. Mastering Laravel REST APIs" required>
                        <div class="wz-count"><span id="wzTitleCount">0</span> / 100</div>
                        @error('title')<div class="wz-error">{{ $message }}</div>@enderror
                    </div>

                    <div class="wz-row">
                        <div class="wz-field">
                            <label>Category <span class="req">*</span></label>
                            <select name="category" required>
                                <option value="" disabled {{ old('category') ? '' : 'selected' }}>Select category
                                </option>
                                @foreach ([
                                'Web Development',
                                'Mobile App Development',
                                'Python Programming',
                                'Java Programming',
                                'PHP & Laravel',
                                'JavaScript & React',
                                'Data Science',
                                'Artificial Intelligence & Machine Learning',
                                'Cloud Computing',
                                'Cybersecurity',
                                'DevOps',
                                'Database Management',
                                'UI/UX Design',
                                'Career Guidance',
                                'Resume & CV Building',
                                'Interview Preparation',
                                'Job Search Strategies',
                                'LinkedIn & Personal Branding',
                                'Freelancing',
                                'Communication Skills',
                                'Leadership Skills',
                                'Project Development',
                                'Git & GitHub',
                                'API Development',
                                'Software Testing',
                                'Agile & Scrum',
                                'System Design',
                                'Entrepreneurship',
                                'Startup & Innovation',
                                'Personality Development',
                                'Public Speaking'
                                ] as $cat)
                                <option value="{{ $cat }}" {{ old('category') === $cat ? 'selected' : '' }}>{{ $cat }}
                                </option>
                                @endforeach
                            </select>
                            @error('category')<div class="wz-error">{{ $message }}</div>@enderror
                        </div>

                        <div class="wz-field">
                            <label>Platform <span class="req">*</span></label>
                            <select name="platform" required>
                                <option value="" disabled {{ old('platform') ? '' : 'selected' }}>Select platform
                                </option>
                                @foreach (['Zoom', 'Google Meet', 'In-Person',
                                'Other'] as $plat)
                                <option value="{{ $plat }}" {{ old('platform') === $plat ? 'selected' : '' }}>
                                    {{ $plat }}</option>
                                @endforeach
                            </select>
                            @error('platform')<div class="wz-error">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="wz-field">
                        <label>Description <span class="req">*</span></label>
                        <textarea name="description" id="wzDesc" maxlength="1000" rows="4"
                            placeholder="Content, key takeaways, and what learners will learn."
                            required>{{ old('description') }}</textarea>
                        <div class="wz-count"><span id="wzDescCount">0</span> / 1000</div>
                        @error('description')<div class="wz-error">{{ $message }}</div>@enderror
                    </div>
                </div>

                {{-- ---------- STEP 2: SCHEDULE ---------- --}}
                <div class="wz-step-panel" data-panel="2" style="display:none;">
                    <div class="wz-card-head">
                        <span class="wz-card-icon"><i class="fa-solid fa-calendar-days"></i></span>
                        <div>
                            <h3>Schedule &amp; Capacity</h3>
                            <p>When it happens and how many can join</p>
                        </div>
                    </div>

                    <div class="wz-tip-box">
                        <i class="fa-regular fa-lightbulb"></i>
                        <span>Add the meeting link now if you already have it — it saves an edit later and speeds up
                            admin approval.</span>
                    </div>

                    <div class="wz-row">
                        <div class="wz-field">
                            <label>Date <span class="req">*</span></label>
                            <input type="date" name="scheduled_date" value="{{ old('scheduled_date') }}" required>
                            @error('scheduled_date')<div class="wz-error">{{ $message }}</div>@enderror
                        </div>

                        <div class="wz-field">
                            <label>Time <span class="req">*</span></label>
                            <input type="time" name="scheduled_time" value="{{ old('scheduled_time') }}" required>
                            @error('scheduled_time')<div class="wz-error">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="wz-row">
                        <div class="wz-field">
                            <label>Duration <span class="req">*</span></label>
                            <input type="text" name="duration" value="{{ old('duration') }}"
                                placeholder="e.g. 1.5 hours" required>
                            @error('duration')<div class="wz-error">{{ $message }}</div>@enderror
                        </div>

                        <div class="wz-field">
                            <label>Capacity <span class="opt">(optional)</span></label>
                            <input type="number" min="1" name="capacity" value="{{ old('capacity') }}"
                                placeholder="e.g. 100">
                            @error('capacity')<div class="wz-error">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="wz-field">
                        <label>Meeting Link <span class="opt">(optional)</span></label>
                        <input type="text" name="meeting_link" value="{{ old('meeting_link') }}"
                            placeholder="Zoom, Google Meet, etc.">
                        @error('meeting_link')<div class="wz-error">{{ $message }}</div>@enderror
                    </div>
                </div>

                {{-- ---------- STEP 3: ADDITIONAL DETAILS (matches model fields) ---------- --}}
                <div class="wz-step-panel" data-panel="3" style="display:none;">
                    <div class="wz-card-head">
                        <span class="wz-card-icon"><i class="fa-solid fa-list-check"></i></span>
                        <div>
                            <h3>Additional Details</h3>
                            <p>Help mentees know exactly what to expect</p>
                        </div>
                    </div>

                    <div class="wz-tip-box">
                        <i class="fa-regular fa-lightbulb"></i>
                        <span>These fields are optional, but sessions with clear outcomes and requirements get approved
                            faster and attract more registrations.</span>
                    </div>

                    <div class="wz-field">
                        <label>Learning Outcomes <span class="opt">(optional — one per line)</span></label>
                        <textarea name="learning_outcomes" id="wzOutcomes" rows="4"
                            placeholder="e.g.&#10;Build a REST API with Laravel&#10;Understand authentication with Sanctum&#10;Deploy to production">{{ old('learning_outcomes') }}</textarea>
                        @error('learning_outcomes')<div class="wz-error">{{ $message }}</div>@enderror
                    </div>

                    <div class="wz-field">
                        <label>Hands-on Activities <span class="opt">(optional)</span></label>
                        <textarea name="hands_on_activities" id="wzActivities" rows="3"
                            placeholder="e.g. Live coding exercise, Q&A workshop, group project">{{ old('hands_on_activities') }}</textarea>
                        @error('hands_on_activities')<div class="wz-error">{{ $message }}</div>@enderror
                    </div>

                    <div class="wz-field">
                        <label>Materials Required <span class="opt">(optional)</span></label>
                        <textarea name="materials_required" id="wzMaterials" rows="3"
                            placeholder="e.g. Laptop with VS Code installed, GitHub account">{{ old('materials_required') }}</textarea>
                        @error('materials_required')<div class="wz-error">{{ $message }}</div>@enderror
                    </div>
                </div>

                {{-- ---------- STEP 4: MEDIA ---------- --}}
                <div class="wz-step-panel" data-panel="4" style="display:none;">
                    <div class="wz-card-head">
                        <span class="wz-card-icon"><i class="fa-regular fa-image"></i></span>
                        <div>
                            <h3>Media</h3>
                            <p>Add a banner so your listing stands out</p>
                        </div>
                    </div>

                    <div class="wz-tip-box">
                        <i class="fa-regular fa-lightbulb"></i>
                        <span>Listings with a banner image get noticeably more clicks than those without one.</span>
                    </div>

                    <div class="wz-field">
                        <label>Banner / Thumbnail <span class="opt">(optional)</span></label>
                        <div class="wz-dropzone" id="wzDropzone">
                            <i class="fa-solid fa-cloud-arrow-up"></i>
                            <p><strong>Click to upload</strong> or drag and drop</p>
                            <span>Recommended 1280&times;720px &middot; max 2MB</span>
                            <input type="file" name="banner" id="wzBannerInput" accept="image/*" hidden>
                        </div>
                        <div id="wzBannerPreviewWrap" style="display:none;">
                            <img id="wzBannerPreview" alt="Banner preview">
                            <button type="button" id="wzBannerChange"><i class="fa-solid fa-arrows-rotate"></i> Change
                                Image</button>
                        </div>
                        @error('banner')<div class="wz-error">{{ $message }}</div>@enderror
                    </div>
                </div>

                {{-- ---------- NAV BUTTONS ---------- --}}
                <div class="wz-nav">
                    <a href="{{ route('mentor.webinars.index') }}" class="wz-btn-ghost">Cancel</a>
                    <div class="wz-nav-right">
                        <button type="button" id="wzBackBtn" class="wz-btn-ghost" style="display:none;">
                            <i class="fa-solid fa-arrow-left"></i> Back
                        </button>
                        <button type="button" id="wzNextBtn" class="wz-btn-primary">
                            Next <i class="fa-solid fa-arrow-right"></i>
                        </button>
                        <button type="submit" id="wzSubmitBtn" class="wz-btn-primary" style="display:none;">
                            <i class="fa-solid fa-paper-plane"></i> Submit for Approval
                        </button>
                    </div>
                </div>
            </form>
        </div>

        {{-- ===================== SIDEBAR ===================== --}}
        <div class="wz-sidebar">

            <div class="wz-sidebar-card">
                <h4><i class="fa-regular fa-lightbulb"></i> Tips</h4>
                <ul>
                    <li>Choose a clear, specific title people will recognise.</li>
                    <li>Pick the category that best matches your audience.</li>
                    <li>Add a meeting link early so approval isn't delayed.</li>
                    <li>A banner image significantly improves visibility.</li>
                    <li>Set realistic capacity based on your platform's limits.</li>
                    <li>Double-check the date &amp; time before submitting.</li>
                    <li>Keep the description focused on learner outcomes.</li>
                    <li>List materials required so attendees come prepared.</li>
                </ul>
            </div>

            <div class="wz-notice">
                <strong>Fields marked <span class="req">*</span> are required.</strong> Others are optional but
                recommended.
            </div>

            <div class="wz-sidebar-card">
                <h4><i class="fa-solid fa-list-check"></i> Checklist</h4>
                <ul class="wz-checklist" id="wzChecklist">
                    <li data-check="title"><span class="wz-check-box"></span> Title entered</li>
                    <li data-check="category"><span class="wz-check-box"></span> Category &amp; platform selected</li>
                    <li data-check="schedule"><span class="wz-check-box"></span> Date &amp; time set</li>
                    <li data-check="description"><span class="wz-check-box"></span> Description written</li>
                    <li data-check="banner"><span class="wz-check-box"></span> Banner uploaded</li>
                </ul>
            </div>

        </div>
    </div>
</div>


<script>
document.addEventListener('DOMContentLoaded', function() {

    // ===================================================================
    // STEP NAVIGATION — set up FIRST and independently so a problem
    // anywhere else on the page can never prevent Next/Back from working.
    // ===================================================================
    (function initStepper() {
        var steps = document.querySelectorAll('.wz-step');
        var panels = document.querySelectorAll('.wz-step-panel');
        var stepperLines = document.querySelectorAll('.wz-step-line');
        var nextBtn = document.getElementById('wzNextBtn');
        var backBtn = document.getElementById('wzBackBtn');
        var submitBtn = document.getElementById('wzSubmitBtn');
        var card = document.querySelector('.wz-card');

        if (!nextBtn || !panels.length) {
            console.error('Webinar wizard: nextBtn or step panels not found in DOM.');
            return;
        }

        var current = 1;
        var total = panels.length;

        function goTo(step) {
            current = step;
            panels.forEach(function(p) {
                p.style.display = (+p.dataset.panel === step) ? 'block' : 'none';
            });
            steps.forEach(function(s) {
                var n = +s.dataset.step;
                s.classList.toggle('active', n === step);
                s.classList.toggle('done', n < step);
            });
            stepperLines.forEach(function(line, i) {
                line.classList.toggle('done', (i + 1) < step);
            });
            if (backBtn) backBtn.style.display = step > 1 ? 'inline-flex' : 'none';
            nextBtn.style.display = step < total ? 'inline-flex' : 'none';
            if (submitBtn) submitBtn.style.display = step === total ? 'inline-flex' : 'none';
            if (card) {
                window.scrollTo({
                    top: card.offsetTop - 20,
                    behavior: 'smooth'
                });
            }
        }

        function validateStep(step) {
            var panel = document.querySelector('.wz-step-panel[data-panel="' + step + '"]');
            if (!panel) return true;
            var requiredFields = panel.querySelectorAll('[required]');
            for (var i = 0; i < requiredFields.length; i++) {
                var field = requiredFields[i];
                if (!field.checkValidity()) {
                    field.reportValidity();
                    return false;
                }
            }
            return true;
        }

        nextBtn.addEventListener('click', function() {
            if (!validateStep(current)) return;
            if (current < total) goTo(current + 1);
        });

        if (backBtn) {
            backBtn.addEventListener('click', function() {
                if (current > 1) goTo(current - 1);
            });
        }

        steps.forEach(function(s) {
            s.addEventListener('click', function() {
                var target = +s.dataset.step;
                if (target > current && !validateStep(current)) return;
                goTo(target);
            });
        });

        goTo(1);
    })();

    // ===================================================================
    // CHARACTER COUNTERS
    // ===================================================================
    (function initCounters() {
        var titleInput = document.getElementById('wzTitle');
        var titleCount = document.getElementById('wzTitleCount');
        var descInput = document.getElementById('wzDesc');
        var descCount = document.getElementById('wzDescCount');

        if (!titleInput || !titleCount || !descInput || !descCount) return;

        function updateCounts() {
            titleCount.textContent = titleInput.value.length;
            descCount.textContent = descInput.value.length;
        }
        titleInput.addEventListener('input', updateCounts);
        descInput.addEventListener('input', updateCounts);
        updateCounts();
    })();

    // ===================================================================
    // BANNER DROPZONE
    // ===================================================================
    (function initDropzone() {
        var dropzone = document.getElementById('wzDropzone');
        var bannerInput = document.getElementById('wzBannerInput');
        var previewWrap = document.getElementById('wzBannerPreviewWrap');
        var previewImg = document.getElementById('wzBannerPreview');
        var changeBtn = document.getElementById('wzBannerChange');

        if (!dropzone || !bannerInput || !previewWrap || !previewImg || !changeBtn) return;

        dropzone.addEventListener('click', function() {
            bannerInput.click();
        });
        dropzone.addEventListener('dragover', function(e) {
            e.preventDefault();
            dropzone.classList.add('dragover');
        });
        dropzone.addEventListener('dragleave', function() {
            dropzone.classList.remove('dragover');
        });
        dropzone.addEventListener('drop', function(e) {
            e.preventDefault();
            dropzone.classList.remove('dragover');
            if (e.dataTransfer.files.length) {
                bannerInput.files = e.dataTransfer.files;
                showPreview(e.dataTransfer.files[0]);
            }
        });
        bannerInput.addEventListener('change', function() {
            if (bannerInput.files.length) showPreview(bannerInput.files[0]);
        });

        function showPreview(file) {
            var reader = new FileReader();
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                previewWrap.style.display = 'block';
                dropzone.style.display = 'none';
                updateChecklist();
            };
            reader.readAsDataURL(file);
        }

        // "Change Image" re-opens the file picker instead of clearing the banner.
        changeBtn.addEventListener('click', function() {
            bannerInput.click();
        });
    })();

    // ===================================================================
    // CHECKLIST (mini + sidebar)
    // ===================================================================
    function setCheck(key, ok) {
        document.querySelectorAll('[data-check="' + key + '"]').forEach(function(el) {
            el.classList.toggle('done', !!ok);
        });
    }

    function updateChecklist() {
        var titleInput = document.getElementById('wzTitle');
        var descInput = document.getElementById('wzDesc');
        var categorySelect = document.querySelector('select[name="category"]');
        var platformSelect = document.querySelector('select[name="platform"]');
        var dateInput = document.querySelector('input[name="scheduled_date"]');
        var timeInput = document.querySelector('input[name="scheduled_time"]');
        var bannerInput = document.getElementById('wzBannerInput');

        setCheck('title', titleInput && titleInput.value.trim().length > 0);
        setCheck('category', categorySelect && platformSelect && categorySelect.value && platformSelect.value);
        setCheck('schedule', dateInput && timeInput && dateInput.value && timeInput.value);
        setCheck('description', descInput && descInput.value.trim().length > 0);
        setCheck('banner', bannerInput && bannerInput.files && bannerInput.files.length > 0);
    }

    (function initChecklistListeners() {
        var ids = ['wzTitle', 'wzDesc'];
        var selectors = ['select[name="category"]', 'select[name="platform"]',
            'input[name="scheduled_date"]', 'input[name="scheduled_time"]'
        ];

        ids.forEach(function(id) {
            var el = document.getElementById(id);
            if (el) {
                el.addEventListener('input', updateChecklist);
                el.addEventListener('change', updateChecklist);
            }
        });
        selectors.forEach(function(sel) {
            var el = document.querySelector(sel);
            if (el) {
                el.addEventListener('input', updateChecklist);
                el.addEventListener('change', updateChecklist);
            }
        });

        updateChecklist();
    })();

});
</script>

<style>
.wz-shell {
    max-width: 1200px;
    margin: 0 auto;
    padding: 32px 24px 60px;
}

/* ---------- Header ---------- */
.wz-header {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 20px;
    margin-bottom: 28px;
}

.wz-header h1 {
    font-size: 26px;
    font-weight: 800;
    margin: 0 0 4px;
    color: #14151a;
}

.wz-header p {
    color: #6b7280;
    margin: 0;
    font-size: 14px;
}

.wz-stepper {
    display: flex;
    align-items: center;
    gap: 8px;
    flex-wrap: wrap;
}

.wz-step {
    display: flex;
    align-items: center;
    gap: 8px;
    cursor: pointer;
}

.wz-step-circle {
    width: 28px;
    height: 28px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #eef0f4;
    color: #9ca3af;
    font-size: 13px;
    font-weight: 700;
    transition: all .2s;
}

.wz-step-label {
    font-size: 13px;
    font-weight: 600;
    color: #9ca3af;
}

.wz-step.active .wz-step-circle {
    background: #3363D6;
    color: #fff;
}

.wz-step.active .wz-step-label {
    color: #3363D6;
}

.wz-step.done .wz-step-circle {
    background: #3363D6;
    color: #fff;
}

.wz-step.done .wz-step-label {
    color: #14151a;
}

.wz-step-line {
    width: 36px;
    height: 2px;
    background: #e5e7eb;
}

.wz-step-line.done {
    background: #3363D6;
}

/* ---------- Layout ---------- */
.wz-layout {
    display: grid;
    grid-template-columns: 1fr 320px;
    gap: 24px;
    align-items: start;
}

@media (max-width: 991px) {
    .wz-layout {
        grid-template-columns: 1fr;
    }
}

.wz-card {
    background: #fff;
    border-radius: 16px;
    border: 1px solid #eef0f4;
    padding: 28px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.03);
}

.wz-card-head {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    margin-bottom: 22px;
}

.wz-card-icon {
    width: 40px;
    height: 40px;
    border-radius: 10px;
    background: #ccd9e8;
    color: #3363D6;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
    flex-shrink: 0;
}

.wz-card-head h3 {
    font-size: 16px;
    font-weight: 700;
    margin: 0 0 2px;
    color: #14151a;
}

.wz-card-head p {
    font-size: 13px;
    color: #6b7280;
    margin: 0;
}

.wz-field {
    margin-bottom: 18px;
}

.wz-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
}

@media (max-width: 575px) {
    .wz-row {
        grid-template-columns: 1fr;
    }
}

/* ---------- Mini checklist bar (left column) ---------- */
.wz-mini-checklist {
    display: flex;
    flex-wrap: wrap;
    gap: 10px 18px;
    padding: 14px 16px;
    margin-bottom: 22px;
    background: #f7f9fb;
    border: 1px solid #eef0f4;
    border-radius: 12px;
}

.wz-mini-item {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 12.5px;
    font-weight: 600;
    color: #9ca3af;
    transition: color .15s;
}

.wz-mini-item .wz-check-box {
    position: static;
    width: 15px;
    height: 15px;
    border-radius: 5px;
    border: 1.5px solid #d1d5db;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    transition: all .15s;
    flex-shrink: 0;
}

.wz-mini-item.done {
    color: #14151a;
}

.wz-mini-item.done .wz-check-box {
    background: #3363D6;
    border-color: #3363D6;
}

.wz-mini-item.done .wz-check-box::after {
    content: '\f00c';
    font-family: 'Font Awesome 6 Free';
    font-weight: 900;
    color: #fff;
    font-size: 8px;
}

/* ---------- Tip box (left column, per step) ---------- */
.wz-tip-box {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    background: #eaf0fa;
    border: 1px solid #bbf0d0;
    border-radius: 12px;
    padding: 12px 14px;
    margin-bottom: 20px;
    font-size: 12.5px;
    color: #14603a;
    line-height: 1.5;
}

.wz-tip-box i {
    color: #3363D6;
    margin-top: 2px;
    flex-shrink: 0;
}

.wz-field label {
    display: block;
    font-size: 11.5px;
    font-weight: 700;
    letter-spacing: .04em;
    text-transform: uppercase;
    color: #4b5563;
    margin-bottom: 6px;
}

.wz-field .req {
    color: #ef4444;
}

.wz-field .opt {
    text-transform: none;
    font-weight: 500;
    color: #9ca3af;
    font-size: 12px;
}

.wz-field input[type="text"],
.wz-field input[type="date"],
.wz-field input[type="time"],
.wz-field input[type="number"],
.wz-field select,
.wz-field textarea {
    width: 100%;
    border: 1px solid #e5e7eb;
    border-radius: 10px;
    padding: 10px 14px;
    font-size: 14px;
    color: #14151a;
    background: #fafbfc;
    transition: border-color .15s, background .15s;
}

.wz-field input:focus,
.wz-field select:focus,
.wz-field textarea:focus {
    outline: none;
    border-color: #3363D6;
    background: #fff;
}

.wz-field textarea {
    resize: vertical;
}

.wz-count {
    text-align: right;
    font-size: 11.5px;
    color: #9ca3af;
    margin-top: 4px;
}

.wz-error {
    color: #ef4444;
    font-size: 12.5px;
    margin-top: 4px;
}

.wz-type-toggle {
    display: flex;
    gap: 10px;
}

.wz-type-toggle label {
    flex: 1;
    text-align: center;
    padding: 10px;
    border: 1px solid #e5e7eb;
    border-radius: 10px;
    font-size: 13.5px;
    font-weight: 600;
    color: #4b5563;
    cursor: pointer;
    transition: all .15s;
}

.wz-type-toggle input:checked+label {
    border-color: #3363D6;
    background: #e2e9f4;
    color: #3363D6;
}

/* ---------- Dropzone ---------- */
.wz-dropzone {
    border: 1.5px dashed #d1d5db;
    border-radius: 12px;
    padding: 32px 16px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
    cursor: pointer;
    transition: all .15s;
    background: #fafbfc;
}

.wz-dropzone:hover,
.wz-dropzone.dragover {
    border-color: #3363D6;
    background: #f3fdf6;
}

.wz-dropzone i {
    font-size: 26px;
    color: #9ca3af;
    margin-bottom: 10px;
}

.wz-dropzone p {
    margin: 0;
    font-size: 13.5px;
    color: #4b5563;
}

.wz-dropzone span {
    font-size: 12px;
    color: #9ca3af;
    margin-top: 4px;
}

#wzBannerPreviewWrap {
    text-align: center;
}

#wzBannerPreviewWrap img {
    max-width: 100%;
    max-height: 220px;
    border-radius: 12px;
    border: 1px solid #eef0f4;
    margin-bottom: 10px;
}

#wzBannerPreviewWrap button {
    border: 1px solid #e5e7eb;
    background: #fff;
    border-radius: 8px;
    padding: 6px 14px;
    font-size: 13px;
    color: #3363D6;
    cursor: pointer;
}

/* ---------- Nav buttons ---------- */
.wz-nav {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-top: 24px;
    padding-top: 20px;
    border-top: 1px solid #eef0f4;
}

.wz-nav-right {
    display: flex;
    gap: 10px;
}

.wz-btn-primary,
.wz-btn-ghost {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    border-radius: 10px;
    padding: 10px 20px;
    font-size: 14px;
    font-weight: 600;
    border: none;
    cursor: pointer;
    text-decoration: none;
}

.wz-btn-primary {
    background: #3363D6;
    color: #fff;
}

.wz-btn-primary:hover {
    background: #254db5;
    color: #fff;
}

.wz-btn-ghost {
    background: #fff;
    color: #4b5563;
    border: 1px solid #e5e7eb;
}

.wz-btn-ghost:hover {
    background: #f9fafb;
    color: #4b5563;
}

/* ---------- Sidebar ---------- */
.wz-sidebar-card {
    background: #fff;
    border: 1px solid #eef0f4;
    border-radius: 16px;
    padding: 20px;
    margin-bottom: 18px;
}

.wz-sidebar-card h4 {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 14.5px;
    font-weight: 700;
    color: #14151a;
    margin: 0 0 14px;
}

.wz-sidebar-card h4 i {
    color: #3363D6;
}

.wz-sidebar-card ul {
    list-style: none;
    margin: 0;
    padding: 0;
}

.wz-sidebar-card ul li {
    position: relative;
    padding-left: 16px;
    font-size: 13px;
    color: #4b5563;
    margin-bottom: 10px;
    line-height: 1.5;
}

.wz-sidebar-card ul li:last-child {
    margin-bottom: 0;
}

.wz-sidebar-card ul li::before {
    content: '';
    position: absolute;
    left: 0;
    top: 7px;
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background: #3363D6;
}

.wz-notice {
    background: #fff7ed;
    border: 1px solid #fed7aa;
    border-radius: 12px;
    padding: 14px 16px;
    font-size: 12.5px;
    color: #9a5b13;
    margin-bottom: 18px;
    line-height: 1.5;
}

.wz-notice .req {
    color: #ef4444;
}

.wz-checklist li {
    padding-left: 26px;
    display: flex;
    align-items: center;
}

.wz-checklist li::before {
    display: none;
}

.wz-check-box {
    position: absolute;
    left: 0;
    width: 16px;
    height: 16px;
    border-radius: 5px;
    border: 1.5px solid #d1d5db;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    transition: all .15s;
}

.wz-checklist li.done {
    color: #14151a;
    text-decoration: line-through;
    text-decoration-color: #d1d5db;
}

.wz-checklist li.done .wz-check-box {
    background: #16a34a;
    border-color: #16a34a;
}

.wz-checklist li.done .wz-check-box::after {
    content: '\f00c';
    font-family: 'Font Awesome 6 Free';
    font-weight: 900;
    color: #fff;
    font-size: 9px;
}
</style>

@endsection