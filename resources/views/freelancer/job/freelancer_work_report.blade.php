@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#F8FAFC] text-slate-800 font-['Inter'] py-8 px-4 sm:px-6 lg:px-8 flex justify-center">
    <div class="w-full max-w-6xl">

        @if (!$bid)
            <div class="bg-white border border-slate-200 rounded-2xl p-10 text-center shadow-sm">
                <h1 class="text-xl font-bold text-slate-900 mb-2">No active project yet</h1>
                <p class="text-sm text-slate-500">Work reports become available after you upload the signed contract for an accepted project.</p>
            </div>
        @else

        @php
            $routeParams = fn ($extra = []) => array_merge(['bid' => $bid->id], $extra);
        @endphp

        {{-- Header --}}
        <div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Project Work Reports</h1>
                <p class="text-sm text-slate-500 mt-1 font-medium">
                    {{ $bid->project?->title ?? ('Project #' . $bid->project_id) }}
                    · {{ $startDate->format('M j') }} – {{ $endDate->format('M j, Y') }}
                    · {{ $totalDays }} working days
                </p>
                @if ($bids->count() > 1)
                    <select class="mt-2 text-sm border border-slate-200 rounded-lg px-3 py-1.5 bg-white"
                            onchange="window.location='{{ route('freelancer.work-reports.index') }}?bid='+this.value">
                        @foreach ($bids as $b)
                            <option value="{{ $b->id }}" @selected($b->id === $bid->id)>
                                {{ $b->project?->title ?? ('Project #' . $b->project_id) }}
                            </option>
                        @endforeach
                    </select>
                @endif
            </div>
            <div class="flex items-center gap-3">
                <div class="text-xs font-semibold text-slate-500">{{ $submittedCount }}/{{ $totalDays }} reports · {{ $latestProgress }}% done</div>
                @if ($projectDone)
                    <div class="bg-slate-100 text-slate-600 text-xs font-bold px-3.5 py-1.5 rounded-full border border-slate-200">Period ended</div>
                @else
                    <div class="bg-blue-50 text-blue-700 text-xs font-bold px-3.5 py-1.5 rounded-full border border-blue-100 flex items-center gap-1.5 shadow-sm">
                        <span class="w-1.5 h-1.5 rounded-full bg-blue-500 animate-pulse"></span> In progress
                    </div>
                @endif
            </div>
        </div>

        @if (session('success'))
            <div class="mb-4 text-sm bg-green-50 border border-green-200 text-green-700 rounded-lg px-4 py-3">{{ session('success') }}</div>
        @endif
        @if ($errors->any())
            <div class="mb-4 text-sm bg-red-50 border border-red-200 text-red-700 rounded-lg px-4 py-3">
                <ul class="list-disc pl-5">@foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">

            {{-- LEFT: Calendar --}}
            <div class="lg:col-span-7 bg-white border border-slate-200 rounded-2xl overflow-hidden shadow-[0_8px_30px_rgb(0,0,0,0.04)]">
                <div class="p-5 sm:p-6">
                    <div class="flex justify-between items-center mb-5">
                        <h2 class="text-slate-900 font-bold text-lg tracking-tight">{{ $month->format('F Y') }}</h2>
                        <div class="flex items-center gap-1.5">
                            @foreach ([['prev', $prevMonth, 'bi-chevron-left'], ['next', $nextMonth, 'bi-chevron-right']] as [$k, $m, $icon])
                                @if ($m)
                                    <a href="{{ route('freelancer.work-reports.index', $routeParams(['month' => $m->format('Y-m')] + ($selected ? ['date' => $selected->toDateString()] : []))) }}"
                                       class="w-8 h-8 flex items-center justify-center rounded-lg text-slate-500 hover:text-slate-800 hover:bg-slate-100 border border-transparent hover:border-slate-200 transition-all">
                                        <i class="bi {{ $icon }} text-sm"></i>
                                    </a>
                                @else
                                    <span class="w-8 h-8 flex items-center justify-center rounded-lg text-slate-200 cursor-not-allowed"><i class="bi {{ $icon }} text-sm"></i></span>
                                @endif
                            @endforeach
                        </div>
                    </div>

                    <div class="grid grid-cols-7 gap-1 sm:gap-2 mb-6 text-center">
                        @foreach (['Mon','Tue','Wed','Thu','Fri','Sat','Sun'] as $dow)
                            <div class="text-[10px] sm:text-[11px] uppercase tracking-wider font-bold text-slate-400 pb-2">{{ $dow }}</div>
                        @endforeach

                        @foreach ($cells as $c)
                            @php
                                if (!$c['in_month']) { echo '<div></div>'; continue; }

                                $base = 'aspect-square flex flex-col items-center justify-center rounded-lg text-sm sm:text-base transition-all ';
                                $style = match ($c['state']) {
                                    'submitted' => 'bg-blue-50 text-blue-700 font-semibold border border-blue-100/50 hover:bg-blue-100',
                                    'due'       => 'bg-amber-50 text-amber-700 font-bold border border-amber-200',
                                    'missed'    => 'bg-rose-50 text-rose-600 font-semibold border border-rose-100 hover:bg-rose-100',
                                    'upcoming'  => 'bg-white text-slate-400 border border-slate-100',
                                    default     => 'text-slate-300 bg-slate-50/50 cursor-not-allowed select-none',
                                };
                                $dot = match ($c['state']) {
                                    'submitted' => 'bg-blue-500', 'due' => 'bg-amber-400', 'missed' => 'bg-rose-400', default => null,
                                };
                                $ring = $c['selected'] ? ' ring-2 ring-offset-1 sm:ring-offset-2 ring-offset-white ' . ($c['state'] === 'due' ? 'ring-amber-400' : ($c['today'] ? 'ring-blue-600' : 'ring-slate-800')) : '';
                                $todayMark = $c['today'] && $c['state'] !== 'off' ? ' underline decoration-blue-600 decoration-2 underline-offset-4' : '';
                                $cls = $base . $style . $ring . $todayMark;
                            @endphp

                            @if ($c['selectable'])
                                <a href="{{ route('freelancer.work-reports.index', $routeParams(['month' => $month->format('Y-m'), 'date' => $c['date']->toDateString()])) }}" class="{{ $cls }} cursor-pointer">
                                    {{ $c['date']->day }}
                                    @if ($dot)<div class="w-1 h-1 sm:w-1.5 sm:h-1.5 rounded-full {{ $dot }} mt-0.5"></div>@endif
                                </a>
                            @else
                                <div class="{{ $cls }}">{{ $c['date']->day }}</div>
                            @endif
                        @endforeach
                    </div>

                    <div class="flex flex-wrap items-center justify-center gap-x-5 gap-y-2 text-[11px] font-semibold text-slate-500 border-t border-slate-100 pt-4">
                        <div class="flex items-center gap-1.5"><div class="w-2 h-2 rounded-full bg-blue-500"></div> Submitted</div>
                        <div class="flex items-center gap-1.5"><div class="w-2 h-2 rounded-full bg-amber-400"></div> Due today</div>
                        <div class="flex items-center gap-1.5"><div class="w-2 h-2 rounded-full bg-rose-400"></div> Missed</div>
                        <div class="flex items-center gap-1.5"><div class="w-2 h-2 rounded-full bg-slate-100 border border-slate-300"></div> Upcoming</div>
                    </div>
                </div>
            </div>

            {{-- RIGHT: Form --}}
            <div class="lg:col-span-5 bg-white border border-slate-200 rounded-2xl overflow-hidden shadow-[0_8px_30px_rgb(0,0,0,0.04)] h-full">
                <div class="p-6 md:p-8 flex flex-col h-full">
                    @if (!$selected)
                        <h3 class="text-slate-900 font-bold text-lg mb-1">Work has not started yet</h3>
                        <p class="text-sm text-slate-500">Reporting opens on {{ $startDate->format('F j, Y') }}.</p>
                    @else
                        <div class="mb-6">
                            <h3 class="text-slate-900 font-bold text-lg mb-1 tracking-tight">Selected date: {{ $selected->format('F j') }}</h3>
                            <p class="text-sm text-slate-500 font-medium">
                                Day {{ $selectedDayNo }} of {{ $totalDays }} ·
                                {{ $selectedReport ? 'Report submitted — you can edit it' : 'Report not submitted' }}
                            </p>
                        </div>

                        <form action="{{ route('freelancer.work-reports.store') }}" method="POST" enctype="multipart/form-data" class="flex flex-col flex-grow">
                            @csrf
                            <input type="hidden" name="freelancer_bid_id" value="{{ $bid->id }}">
                            <input type="hidden" name="report_date" value="{{ $selected->toDateString() }}">

                            <div class="mb-4">
                                <label class="block text-xs font-semibold text-slate-700 mb-1.5 uppercase tracking-wide">Report title</label>
                                <input type="text" name="title" required maxlength="255" placeholder="e.g. Completed login page"
                                       value="{{ old('title', $selectedReport?->title) }}"
                                       class="w-full bg-white border border-slate-200 text-slate-900 text-sm rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 placeholder-slate-400 shadow-sm">
                            </div>

                            <div class="mb-4">
                                <label class="block text-xs font-semibold text-slate-700 mb-1.5 uppercase tracking-wide">Work description</label>
                                <textarea name="work_description" rows="4" required placeholder="Enter completed tasks..."
                                          class="w-full bg-white border border-slate-200 text-slate-900 text-sm rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 placeholder-slate-400 resize-none shadow-sm">{{ old('work_description', $selectedReport?->work_description) }}</textarea>
                            </div>

                            <div class="mb-4">
                                <label class="block text-xs font-semibold text-slate-700 mb-1.5 uppercase tracking-wide">Challenges <span class="normal-case text-slate-400 font-medium">(optional)</span></label>
                                <textarea name="challenges" rows="2" placeholder="Any blockers?"
                                          class="w-full bg-white border border-slate-200 text-slate-900 text-sm rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 placeholder-slate-400 resize-none shadow-sm">{{ old('challenges', $selectedReport?->challenges) }}</textarea>
                            </div>

                            <div class="mb-5">
                                <label class="block text-xs font-semibold text-slate-700 mb-1.5 uppercase tracking-wide">Next steps <span class="normal-case text-slate-400 font-medium">(optional)</span></label>
                                <textarea name="next_steps" rows="2" placeholder="Plan for the next working day"
                                          class="w-full bg-white border border-slate-200 text-slate-900 text-sm rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 placeholder-slate-400 resize-none shadow-sm">{{ old('next_steps', $selectedReport?->next_steps) }}</textarea>
                            </div>

                            @php $progress = (int) old('progress_percentage', $selectedReport?->progress_percentage ?? $latestProgress); @endphp
                            <div class="mb-6">
                                <label class="block text-xs font-semibold text-slate-700 mb-2 uppercase tracking-wide">Overall project progress</label>
                                <div class="flex items-center gap-3">
                                    <div class="flex-1 bg-slate-200 rounded-full h-2 cursor-pointer relative shadow-inner" id="progress-container">
                                        <div class="bg-blue-600 h-2 rounded-full transition-all duration-150" id="progress-bar" style="width: {{ $progress }}%"></div>
                                    </div>
                                    <span class="text-xs font-bold text-slate-700 w-10 text-right" id="progress-text">{{ $progress }}%</span>
                                </div>
                                <input type="hidden" name="progress_percentage" id="progress-input" value="{{ $progress }}">
                            </div>

                            <div class="mb-6">
                                <input type="file" name="attachment" id="attachment" class="hidden" accept=".pdf,.doc,.docx,.png,.jpg,.jpeg,.zip">
                                <label for="attachment" class="w-full flex items-center justify-center gap-2 bg-slate-50 border border-slate-200 hover:border-slate-300 hover:bg-slate-100 text-slate-700 text-sm font-semibold py-2.5 rounded-lg cursor-pointer transition-all shadow-sm">
                                    <i class="bi bi-paperclip text-slate-400"></i>
                                    <span id="attachment-label">Attach file (max 5 MB)</span>
                                </label>
                                @if ($selectedReport?->attachment_path)
                                    <a href="{{ route('freelancer.work-reports.attachment', $selectedReport) }}" target="_blank" class="block text-xs text-blue-600 hover:underline mt-2 text-center">View current attachment</a>
                                @endif
                            </div>

                            <div class="pt-4 border-t border-slate-100 mt-auto">
                                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold py-3 rounded-lg transition-all shadow-md hover:shadow-lg focus:ring-4 focus:ring-blue-500/30">
                                    {{ $selectedReport ? 'Update Work Report' : 'Submit Work Report' }}
                                </button>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Attachment filename
    const file = document.getElementById('attachment');
    if (file) file.addEventListener('change', () => {
        document.getElementById('attachment-label').textContent = file.files[0]?.name ?? 'Attach file (max 5 MB)';
    });

    // Draggable progress bar
    const container = document.getElementById('progress-container');
    if (!container) return;
    const bar = document.getElementById('progress-bar');
    const text = document.getElementById('progress-text');
    const input = document.getElementById('progress-input');
    let dragging = false;

    function update(e) {
        if (!dragging) return;
        const rect = container.getBoundingClientRect();
        const x = Math.min(Math.max(e.clientX - rect.left, 0), rect.width);
        const pct = Math.round((x / rect.width) * 100);
        bar.style.width = pct + '%';
        text.textContent = pct + '%';
        input.value = pct;
    }
    container.addEventListener('mousedown', e => { dragging = true; update(e); });
    window.addEventListener('mousemove', update);
    window.addEventListener('mouseup', () => dragging = false);
    container.addEventListener('touchstart', e => { dragging = true; update(e.touches[0]); }, {passive: true});
    window.addEventListener('touchmove', e => { if (dragging) update(e.touches[0]); }, {passive: true});
    window.addEventListener('touchend', () => dragging = false);
});
</script>
@endpush