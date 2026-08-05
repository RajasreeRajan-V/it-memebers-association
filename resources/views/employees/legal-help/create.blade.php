@extends('layouts.app')

@section('content')

@push('styles')
<script src="https://cdn.tailwindcss.com"></script>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Source+Serif+4:opsz,wght@8..60,500;8..60,600;8..60,700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
    :root{
        --ink:#1B2333;
        --paper:#F4F5F7;
        --card:#FFFFFF;
        --border:#E1E4EA;
        --border-strong:#C7CCD6;
        --accent:#2C4A5E;
        --accent-dark:#1E3644;
        --accent-tint:#EAF0F2;
        --muted:#6B7280;
        --low:#3F7A5B;
        --medium:#B4740E;
        --high:#B03A2E;
    }
    .font-serif{font-family:'Source Serif 4', Georgia, serif;}
    .font-sans{font-family:'Inter', ui-sans-serif, system-ui, sans-serif;}

    body{background:var(--paper);}
    .lh-page{background:var(--paper);}

    .letterhead-rule{
        background: linear-gradient(90deg, var(--accent) 0%, var(--accent) 40px, var(--border) 40px, var(--border) 100%);
        height:3px;
    }

    .step-num{
        font-family:'Source Serif 4', serif;
        font-weight:600;
        color:var(--accent);
        border:1.5px solid var(--accent);
        background:var(--accent-tint);
    }

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

    .priority-pill{
        cursor:pointer;
        user-select:none;
        transition:all .15s ease;
    }
    .priority-pill input{position:absolute;opacity:0;pointer-events:none;}
    .priority-pill .dot{width:7px;height:7px;border-radius:9999px;display:inline-block;}

    .priority-pill.low .dot{background:var(--low);}
    .priority-pill.medium .dot{background:var(--medium);}
    .priority-pill.high .dot{background:var(--high);}

    .priority-pill input:checked + .pill-inner{
        border-color:var(--accent);
        background:var(--accent-tint);
        color:var(--accent-dark);
    }
    .priority-pill:not(:has(input:checked)) .pill-inner:hover{
        border-color:var(--border-strong);
    }

    .dropzone{
        background:
            repeating-linear-gradient(135deg, rgba(44,74,94,0.035) 0px, rgba(44,74,94,0.035) 1px, transparent 1px, transparent 10px);
        border:1.5px dashed var(--border-strong);
        transition:border-color .15s ease, background-color .15s ease;
    }
    .dropzone:hover, .dropzone.dragover{
        border-color:var(--accent);
        background-color:var(--accent-tint);
    }

    .confidential-tag{
        letter-spacing:.08em;
    }

    .btn-primary{
        background:var(--accent);
        transition:background-color .15s ease, transform .1s ease;
    }
    .btn-primary:hover{background:var(--accent-dark);}
    .btn-primary:active{transform:translateY(1px);}

    .field-label{
        font-family:'Inter', sans-serif;
        font-weight:600;
        letter-spacing:.02em;
        text-transform:uppercase;
        font-size:11px;
        color:#4B5566;
    }

    .file-chip{
        border:1px solid var(--border);
        background:#fff;
    }
</style>
@endpush

<div class="lh-page font-sans min-h-screen py-10">
<div class="mx-auto max-w-2xl px-4">

    <a href="{{ route('employee.legal-help.index') }}"
       class="inline-flex items-center gap-1.5 text-sm text-slate-500 hover:text-[var(--accent-dark)] transition">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
        Back to Legal Help
    </a>

    <div class="mt-5 rounded-2xl border border-[var(--border)] bg-[var(--card)] shadow-[0_1px_2px_rgba(16,24,40,0.04),0_8px_24px_-12px_rgba(16,24,40,0.08)] overflow-hidden">

        <div class="letterhead-rule"></div>

        <div class="px-8 pt-7 pb-6 border-b border-[var(--border)] flex items-start justify-between gap-4">
            <div>
                <h1 class="font-serif text-[26px] leading-tight text-[var(--ink)]">Workspace Support</h1>
                <p class="mt-1.5 text-[13.5px] text-[var(--muted)] max-w-md">
                    Describe your issue below. A member of the legal team will review it and assign the right specialist.
                </p>
            </div>
            <span class="confidential-tag shrink-0 mt-1 inline-flex items-center gap-1.5 rounded-full border border-[var(--border-strong)] bg-[var(--paper)] px-3 py-1 text-[10px] font-semibold uppercase text-[var(--muted)]">
                <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4"><path d="M12 2 4 5v6c0 5.25 3.4 9.74 8 11 4.6-1.26 8-5.75 8-11V5l-8-3Z"/></svg>
                Confidential
            </span>
        </div>

        @if($errors->any())
            <div class="mx-8 mt-6 rounded-lg border border-red-100 bg-red-50 px-4 py-3 text-sm text-red-700">
                <p class="font-semibold text-red-800 mb-1">Please correct the following:</p>
                <ul class="list-disc pl-4 space-y-0.5">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('employee.legal-help.store') }}" method="POST" enctype="multipart/form-data" class="px-8 py-7 space-y-8">
            @csrf

            {{-- Step 1 --}}
            <div class="flex gap-4">
                <div class="step-num shrink-0 w-7 h-7 rounded-full flex items-center justify-center text-[13px]">1</div>
                <div class="flex-1 min-w-0">
                    <label class="field-label block mb-1.5" for="issue_title">Issue Title</label>
                    <input type="text" id="issue_title" name="issue_title" value="{{ old('issue_title') }}" required
                           placeholder="e.g. Salary Not Paid for June"
                           class="lh-input w-full rounded-lg px-3.5 py-2.5 text-sm text-[var(--ink)] placeholder:text-slate-400">
                </div>
            </div>

            {{-- Step 2 --}}
            <div class="flex gap-4">
                <div class="step-num shrink-0 w-7 h-7 rounded-full flex items-center justify-center text-[13px]">2</div>
                <div class="flex-1 min-w-0 space-y-4">
                    <div>
                        <label class="field-label block mb-1.5" for="category">Category</label>
                        <div class="relative">
                            <select id="category" name="category" required
                                    class="lh-input w-full appearance-none rounded-lg px-3.5 py-2.5 text-sm text-[var(--ink)] pr-9">
                                <option value="">Select category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category }}" @selected(old('category') === $category)>{{ $category }}</option>
                                @endforeach
                            </select>
                            <svg class="pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 text-slate-400" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3"><path d="m6 9 6 6 6-6"/></svg>
                        </div>
                    </div>

                    <div>
                        <label class="field-label block mb-1.5">Priority</label>
                        <div class="grid grid-cols-3 gap-2">
                            @php $selectedPriority = old('priority', 'medium'); @endphp
                            <label class="priority-pill low">
                                <input type="radio" name="priority" value="low" @checked($selectedPriority === 'low')>
                                <span class="pill-inner flex items-center justify-center gap-2 rounded-lg border border-[var(--border-strong)] px-3 py-2 text-sm font-medium text-slate-600">
                                    <span class="dot"></span> Low
                                </span>
                            </label>
                            <label class="priority-pill medium">
                                <input type="radio" name="priority" value="medium" @checked($selectedPriority === 'medium')>
                                <span class="pill-inner flex items-center justify-center gap-2 rounded-lg border border-[var(--border-strong)] px-3 py-2 text-sm font-medium text-slate-600">
                                    <span class="dot"></span> Medium
                                </span>
                            </label>
                            <label class="priority-pill high">
                                <input type="radio" name="priority" value="high" @checked($selectedPriority === 'high')>
                                <span class="pill-inner flex items-center justify-center gap-2 rounded-lg border border-[var(--border-strong)] px-3 py-2 text-sm font-medium text-slate-600">
                                    <span class="dot"></span> High
                                </span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Step 3 --}}
            <div class="flex gap-4">
                <div class="step-num shrink-0 w-7 h-7 rounded-full flex items-center justify-center text-[13px]">3</div>
                <div class="flex-1 min-w-0">
                    <label class="field-label block mb-1.5" for="description">Describe Your Issue</label>
                    <textarea id="description" name="description" rows="5" required
                              placeholder="Share as much detail as possible so we can help quickly..."
                              class="lh-input w-full rounded-lg px-3.5 py-2.5 text-sm text-[var(--ink)] placeholder:text-slate-400 resize-none">{{ old('description') }}</textarea>
                </div>
            </div>

            {{-- Step 4 --}}
            <div class="flex gap-4">
                <div class="step-num shrink-0 w-7 h-7 rounded-full flex items-center justify-center text-[13px]">4</div>
                <div class="flex-1 min-w-0">
                    <label class="field-label block mb-1.5">Supporting Documents <span class="normal-case font-normal text-slate-400">(optional)</span></label>
                    <label for="documents" class="dropzone flex flex-col items-center justify-center gap-2 rounded-xl px-4 py-7 text-center cursor-pointer">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="var(--accent)" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 15V3m0 0 4 4m-4-4-4 4"/><path d="M20 15v4a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2v-4"/></svg>
                        <span class="text-sm font-medium text-[var(--ink)]">Click to upload, or drag files here</span>
                        <span class="text-[11px] text-slate-400">PDF, DOCX, JPG &middot; up to 10MB each</span>
                        <input id="documents" type="file" name="documents[]" multiple class="hidden">
                    </label>
                    <div id="file-list" class="mt-2.5 flex flex-wrap gap-2"></div>
                </div>
            </div>

            <div class="flex items-center justify-end gap-3 border-t border-[var(--border)] pt-6">
                <a href="{{ route('employee.legal-help.index') }}"
                   class="text-sm font-medium text-slate-500 hover:text-slate-700 px-2">Cancel</a>
                <button type="submit"
                        class="btn-primary inline-flex items-center gap-2 rounded-lg px-6 py-2.5 text-sm font-semibold text-white shadow-sm">
                    Submit Request
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
                </button>
            </div>
        </form>
    </div>

    <p class="mt-4 text-center text-[11.5px] text-slate-400">
        Requests are reviewed on business days and typically triaged within 24 hours.
    </p>
</div>
</div>

<script>
    (function(){
        var input = document.getElementById('documents');
        var dropzone = input ? input.closest('.dropzone') : null;
        var list = document.getElementById('file-list');
        if(!input) return;

        function render(){
            list.innerHTML = '';
            Array.from(input.files).forEach(function(file){
                var chip = document.createElement('span');
                chip.className = 'file-chip inline-flex items-center gap-1.5 rounded-md px-2.5 py-1 text-[11.5px] text-slate-600';
                chip.innerHTML = '<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><path d="M14 2v6h6"/></svg>' +
                    '<span>' + file.name + '</span>';
                list.appendChild(chip);
            });
        }
        input.addEventListener('change', render);

        if(dropzone){
            ['dragenter','dragover'].forEach(function(evt){
                dropzone.addEventListener(evt, function(e){ e.preventDefault(); dropzone.classList.add('dragover'); });
            });
            ['dragleave','drop'].forEach(function(evt){
                dropzone.addEventListener(evt, function(e){ e.preventDefault(); dropzone.classList.remove('dragover'); });
            });
            dropzone.addEventListener('drop', function(e){
                if(e.dataTransfer.files.length){
                    input.files = e.dataTransfer.files;
                    render();
                }
            });
        }
    })();
</script>
@endsection