@extends('layouts.app')

@section('content')

@push('styles')
{{-- Remove once Tailwind is compiled into your app's build. --}}
<script src="https://cdn.tailwindcss.com"></script>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Source+Serif+4:opsz,wght@8..60,500;8..60,600;8..60,700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
    :root{
        --ink:#14171F;
        --paper:#F1F2F4;
        --card:#FFFFFF;
        --border:#E3E5EA;
        --border-strong:#CBCFD8;
        --accent:#1D4E89;
        --accent-dark:#163C6B;
        --accent-tint:#EAF1F8;
        --muted:#6B7280;
        --draft:#A15C07;
        --draft-tint:#FBF1E2;
        --live:#1B7A50;
        --live-tint:#E9F6EF;
    }
    .font-serif{font-family:'Source Serif 4', Georgia, serif;}
    .font-sans{font-family:'Inter', ui-sans-serif, system-ui, sans-serif;}
    body{background:var(--paper);}

    .headline-input{
        font-family:'Source Serif 4', Georgia, serif;
        font-weight:600;
        color:var(--ink);
        border:none;
        border-bottom:2px solid var(--border);
        background:transparent;
        transition:border-color .15s ease;
    }
    .headline-input:focus{outline:none; border-bottom-color:var(--accent);}
    .headline-input::placeholder{color:#B7BCC6; font-weight:500;}

    .lh-input{
        background:#fff;
        border:1px solid var(--border-strong);
        transition:border-color .15s ease, box-shadow .15s ease;
    }
    .lh-input:focus{
        outline:none;
        border-color:var(--accent);
        box-shadow:0 0 0 3px var(--accent-tint);
    }

    .kicker{
        font-family:'Inter', sans-serif;
        font-weight:700;
        letter-spacing:.08em;
        text-transform:uppercase;
        font-size:10.5px;
        color:var(--muted);
    }

    .masthead-rule{
        background: linear-gradient(90deg, var(--accent) 0%, var(--accent) 34px, var(--border) 34px, var(--border) 100%);
        height:3px;
    }

    /* status toggle */
    .status-toggle{cursor:pointer;}
    .status-toggle input{position:absolute; opacity:0; pointer-events:none;}
    .toggle-track{
        width:38px; height:22px; border-radius:9999px;
        background:var(--border-strong);
        position:relative;
        transition:background-color .15s ease;
        flex-shrink:0;
    }
    .toggle-thumb{
        position:absolute; top:2px; left:2px;
        width:18px; height:18px; border-radius:9999px;
        background:#fff; box-shadow:0 1px 2px rgba(0,0,0,.25);
        transition:transform .15s ease;
    }
    .status-toggle input:checked ~ .toggle-track{background:var(--live);}
    .status-toggle input:checked ~ .toggle-track .toggle-thumb{transform:translateX(16px);}

    .status-badge{
        font-size:11px; font-weight:700; letter-spacing:.03em;
        padding:2px 9px; border-radius:9999px;
    }
    .status-badge.draft{background:var(--draft-tint); color:var(--draft);}
    .status-badge.live{background:var(--live-tint); color:var(--live);}

    /* preview card */
    .preview-card{
        background:var(--card);
        border:1px solid var(--border);
    }
    .preview-title{
        font-family:'Source Serif 4', serif;
        display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;
    }
    .preview-excerpt{
        display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;
    }
    .preview-thumb{
        background:var(--paper);
        background-size:cover;
        background-position:center;
    }

    .file-btn::file-selector-button{
        margin-right:1rem; padding:.55rem 1rem; border-radius:.65rem; border:0;
        font-size:.8125rem; font-weight:600; background:var(--accent-tint); color:var(--accent-dark);
        cursor:pointer; transition:background-color .15s ease;
    }
    .file-btn::file-selector-button:hover{background:#DCE9F5;}

    textarea{resize:vertical;}
</style>
@endpush

<div class="bg-[var(--paper)] min-h-screen font-sans">
    <div class="max-w-3xl mx-auto px-6 py-10">

        <div class="mb-6">
            <a href="{{ route('employee.articles.index') }}" class="inline-flex items-center gap-1.5 text-sm text-slate-500 hover:text-[var(--accent-dark)] mb-5 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round"><path d="m15 18-6-6 6-6"/></svg>
                Back to Articles
            </a>
            <div class="masthead-rule mb-4"></div>
            <p class="kicker mb-1.5">New Draft</p>
            <h1 class="text-2xl font-bold text-slate-900 font-serif">Write a New Article</h1>
            <p class="text-sm text-slate-500 mt-1">Share insights, tutorials, or advice with your peers.</p>
        </div>

        @if ($errors->any())
            <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                <p class="font-semibold mb-1">Please fix the following:</p>
                <ul class="list-disc list-inside space-y-0.5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('employee.articles.store') }}" method="POST" enctype="multipart/form-data" class="space-y-7">
            @csrf

            <div class="rounded-2xl border border-[var(--border)] bg-[var(--card)] p-6 sm:p-7 shadow-[0_1px_2px_rgba(16,24,40,0.04),0_8px_24px_-12px_rgba(16,24,40,0.08)]">

                <div class="grid sm:grid-cols-2 gap-5 mb-5">
                    <div>
                        <label for="category_slug" class="kicker block mb-1.5">Category</label>
                        <div class="relative">
                            <select name="category_slug" id="category_slug" required
                                    class="lh-input w-full appearance-none rounded-lg px-3.5 py-2.5 text-sm text-slate-800 pr-9">
                                <option value="" disabled {{ old('category_slug') ? '' : 'selected' }}>Select a category</option>
                                @foreach ($categoryOptions as $slug => $label)
                                    <option value="{{ $slug }}" {{ old('category_slug') === $slug ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            <svg class="pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 text-slate-400" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3"><path d="m6 9 6 6 6-6"/></svg>
                        </div>
                    </div>
                    <div>
                        <label for="read_minutes" class="kicker block mb-1.5">Read Time (minutes)</label>
                        <input type="number" name="read_minutes" id="read_minutes" min="1" max="120" value="{{ old('read_minutes', 5) }}"
                               class="lh-input w-full rounded-lg px-3.5 py-2.5 text-sm text-slate-800">
                    </div>
                </div>

                <div class="mb-1">
                    <label for="title" class="sr-only">Title</label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}" required
                           placeholder="Your article title..."
                           class="headline-input w-full text-2xl sm:text-3xl px-0.5 pb-3 leading-snug">
                </div>
                <p class="text-[11px] text-slate-400 mb-6 px-0.5">This is how your headline will appear on the article.</p>

                <div class="mb-6">
                    <label for="excerpt" class="kicker block mb-1.5">
                        Excerpt <span class="normal-case font-normal text-slate-400 tracking-normal">&mdash; optional, shown on the articles list</span>
                    </label>
                    <textarea name="excerpt" id="excerpt" rows="2" maxlength="500"
                              placeholder="A short summary that appears on the article card..."
                              class="lh-input w-full rounded-lg px-3.5 py-2.5 text-sm text-slate-800 placeholder-slate-400">{{ old('excerpt') }}</textarea>
                </div>

                <div class="mb-6">
                    <div class="flex items-center justify-between mb-1.5">
                        <label for="body" class="kicker">Article Content</label>
                        <span id="word-count" class="text-[11px] text-slate-400">0 words</span>
                    </div>
                    <textarea name="body" id="body" rows="14" required
                              placeholder="Write your article here..."
                              class="lh-input w-full rounded-lg px-4 py-3.5 text-[15px] text-slate-800 placeholder-slate-400 leading-relaxed font-serif">{{ old('body') }}</textarea>
                </div>

                <div>
                    <label for="image" class="kicker block mb-1.5">
                        Cover Image <span class="normal-case font-normal text-slate-400 tracking-normal">&mdash; optional</span>
                    </label>
                    <input type="file" name="image" id="image" accept="image/*"
                           class="file-btn block w-full text-sm text-slate-600">
                </div>
            </div>

            {{-- Live preview --}}
            <div>
                <p class="kicker mb-2 px-0.5">Preview &mdash; as it will appear on the list</p>
                <div class="preview-card rounded-2xl overflow-hidden flex">
                    <div id="preview-thumb" class="preview-thumb w-28 shrink-0 flex items-center justify-center text-slate-300">
                        <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="9" cy="9" r="1.5"/><path d="m21 15-5-5L5 21"/></svg>
                    </div>
                    <div class="p-4 min-w-0 flex-1">
                        <div class="flex items-center gap-2 mb-1.5">
                            <span id="preview-category" class="text-[10.5px] font-bold uppercase tracking-wide text-[var(--accent)]">Category</span>
                            <span class="text-slate-300">&middot;</span>
                            <span id="preview-readtime" class="text-[11.5px] text-slate-400">5 min read</span>
                        </div>
                        <h3 id="preview-title" class="preview-title text-[15px] font-semibold text-slate-900 leading-snug">Your article title will appear here</h3>
                        <p id="preview-excerpt" class="preview-excerpt text-[12.5px] text-slate-500 mt-1 leading-snug">Your excerpt will appear here once you add one.</p>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-between flex-wrap gap-4 pt-1">
                <label class="status-toggle relative flex items-center gap-2.5 text-sm text-slate-700 font-medium">
                    <input type="checkbox" name="published" id="published" value="1" {{ old('published') ? 'checked' : '' }}>
                    <span class="toggle-track"><span class="toggle-thumb"></span></span>
                    <span id="status-label" class="status-badge draft">Draft</span>
                    <span class="text-slate-400 font-normal text-[12.5px]">Publish immediately, or leave off to save as a draft</span>
                </label>

                <div class="flex items-center gap-3">
                    <a href="{{ route('employee.articles.index') }}" class="rounded-xl border border-[var(--border-strong)] text-slate-600 text-sm font-semibold px-6 py-2.5 hover:bg-slate-50 transition">
                        Cancel
                    </a>
                    <button type="submit" class="rounded-xl bg-[var(--accent)] text-white text-sm font-semibold px-6 py-2.5 hover:bg-[var(--accent-dark)] transition shadow-sm">
                        Publish Article
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
(function(){
    var categoryOptions = @json($categoryOptions);

    var titleInput = document.getElementById('title');
    var excerptInput = document.getElementById('excerpt');
    var categorySelect = document.getElementById('category_slug');
    var readMinutesInput = document.getElementById('read_minutes');
    var bodyInput = document.getElementById('body');
    var imageInput = document.getElementById('image');
    var publishedCheckbox = document.getElementById('published');

    var previewTitle = document.getElementById('preview-title');
    var previewExcerpt = document.getElementById('preview-excerpt');
    var previewCategory = document.getElementById('preview-category');
    var previewReadtime = document.getElementById('preview-readtime');
    var previewThumb = document.getElementById('preview-thumb');
    var wordCount = document.getElementById('word-count');
    var statusLabel = document.getElementById('status-label');

    function updateTitle(){
        previewTitle.textContent = titleInput.value.trim() || 'Your article title will appear here';
    }
    function updateExcerpt(){
        previewExcerpt.textContent = excerptInput.value.trim() || 'Your excerpt will appear here once you add one.';
    }
    function updateCategory(){
        var label = categoryOptions[categorySelect.value];
        previewCategory.textContent = label || 'Category';
    }
    function updateReadtime(){
        var mins = parseInt(readMinutesInput.value, 10);
        previewReadtime.textContent = (mins > 0 ? mins : 5) + ' min read';
    }
    function updateWordCount(){
        var text = bodyInput.value.trim();
        var words = text.length ? text.split(/\s+/).length : 0;
        wordCount.textContent = words + ' word' + (words === 1 ? '' : 's');
    }
    function updateStatus(){
        if(publishedCheckbox.checked){
            statusLabel.textContent = 'Published';
            statusLabel.classList.remove('draft');
            statusLabel.classList.add('live');
        } else {
            statusLabel.textContent = 'Draft';
            statusLabel.classList.remove('live');
            statusLabel.classList.add('draft');
        }
    }
    function updateThumb(){
        if(imageInput.files && imageInput.files[0]){
            var url = URL.createObjectURL(imageInput.files[0]);
            previewThumb.style.backgroundImage = 'url(' + url + ')';
            previewThumb.innerHTML = '';
        }
    }

    titleInput.addEventListener('input', updateTitle);
    excerptInput.addEventListener('input', updateExcerpt);
    categorySelect.addEventListener('change', updateCategory);
    readMinutesInput.addEventListener('input', updateReadtime);
    bodyInput.addEventListener('input', updateWordCount);
    publishedCheckbox.addEventListener('change', updateStatus);
    imageInput.addEventListener('change', updateThumb);

    updateTitle(); updateExcerpt(); updateCategory(); updateReadtime(); updateWordCount(); updateStatus();
})();
</script>
@endsection