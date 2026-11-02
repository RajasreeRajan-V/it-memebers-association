@extends('layouts.app')

@section('content')
@php
    $title = $bid->project?->title ?? ('Project #' . $bid->project_id);
    $who   = $bid->freelancer?->user?->name ?? 'Freelancer';

    // ---- chart geometry ----
    $W = 640; $H = 240; $pl = 38; $pr = 12; $pt = 12; $pb = 26;
    $iw = $W - $pl - $pr;  $ih = $H - $pt - $pb;
    $cx = fn ($day) => $pl + ($a['total'] > 0 ? $day / $a['total'] : 0) * $iw;
    $cy = fn ($pct) => $pt + $ih - ($pct / 100) * $ih;
    $line = collect($a['points'])->map(fn ($p) => round($cx($p['day']), 1) . ',' . round($cy($p['progress']), 1))->implode(' ');

    $cell = [
        'submitted' => 'bg-emerald-500 text-white',
        'missed'    => 'bg-red-500 text-white',
        'due'       => 'bg-amber-400 text-white',
        'upcoming'  => 'bg-slate-100 text-slate-400 border border-slate-200',
    ];
    $tone = [
        'good' => 'border-emerald-200 bg-emerald-50 text-emerald-800',
        'warn' => 'border-amber-200 bg-amber-50 text-amber-800',
        'bad'  => 'border-red-200 bg-red-50 text-red-800',
        'info' => 'border-slate-200 bg-slate-50 text-slate-700',
    ];
@endphp

<div class="min-h-screen bg-[#F8FAFC] text-slate-800 font-['Inter'] py-8 px-4 sm:px-6 lg:px-8 flex justify-center">
    <div class="w-full max-w-6xl">

        <a href="{{ route('employer.work-reports.index') }}" class="text-sm font-semibold text-blue-600 hover:underline">
            ← All contracts
        </a>

        {{-- Header --}}
        <div class="mt-3 mb-6 flex flex-col sm:flex-row sm:items-start justify-between gap-3">
            <div class="min-w-0">
                <h1 class="text-2xl font-bold text-slate-900 tracking-tight">{{ $title }}</h1>
                <p class="text-sm text-slate-500 mt-1 font-medium">
                    {{ $who }}: {{ $a['start']->format('M j, Y') }} to {{ $a['end']->format('M j, Y') }}
                    ({{ $a['total'] }} working days, Mon to Sat)
                </p>
            </div>
            @include('employers.freelance-bid.work-report.status', ['status' => $a['status'], 'label' => $a['status_label']])
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">
        <div class="lg:col-span-2 min-w-0">

        {{-- Insights --}}
        @if ($a['insights'])
            <div class="space-y-2 mb-6">
                @foreach ($a['insights'] as $i)
                    <div class="border rounded-xl px-4 py-3 text-sm font-medium {{ $tone[$i['type']] }}">{{ $i['text'] }}</div>
                @endforeach
            </div>
        @endif

        {{-- KPIs --}}
        <div class="grid grid-cols-2 lg:grid-cols-3 gap-3 mb-6">
            @php
                $kpis = [
                    ['Reported progress', $a['latest'] . '%', 'Planned today: ' . $a['expected'] . '%'],
                    ['Reports submitted', $a['submitted'] . ' of ' . $a['total'], $a['rate'] === null ? 'No past days yet' : $a['rate'] . '% of past days covered'],
                    ['Missed days', $a['missed'], 'Current streak: ' . $a['streak'] . ' ' . ($a['streak'] === 1 ? 'day' : 'days')],
                    ['Last report', $a['last_report'] ? $a['last_report']->report_date->format('M j') : 'None', $a['days_since'] === null ? '' : ($a['days_since'] === 0 ? 'Today' : $a['days_since'] . ' days ago')],
                    ['Projected duration', $a['projected_days'] ? $a['projected_days'] . ' days' : '-', $a['delay'] === null ? 'Needs more data' : ($a['delay'] > 0 ? $a['delay'] . ' days over plan' : 'Within plan')],
                    ['Attachments', $a['attachments'], 'Across ' . count($a['log']) . ' reports'],
                ];
            @endphp
            @foreach ($kpis as [$label, $value, $note])
                <div class="bg-white border border-slate-200 rounded-xl p-4">
                    <p class="text-xs font-semibold text-slate-500">{{ $label }}</p>
                    <p class="text-2xl font-bold text-slate-900 mt-1">{{ $value }}</p>
                    <p class="text-xs text-slate-500 mt-0.5">{{ $note }}</p>
                </div>
            @endforeach
        </div>

        {{-- Progress chart --}}
        <div class="bg-white border border-slate-200 rounded-2xl p-5 sm:p-6 mb-6">
            <div class="flex flex-wrap items-center justify-between gap-2 mb-3">
                <h2 class="text-base font-bold text-slate-900">Progress against plan</h2>
                <div class="flex gap-4 text-xs font-semibold text-slate-500">
                    <span class="flex items-center gap-1.5"><span class="w-4 h-0.5 bg-blue-600 inline-block"></span>Reported</span>
                    <span class="flex items-center gap-1.5"><span class="w-4 h-0.5 bg-slate-400 inline-block"></span>Planned</span>
                </div>
            </div>

            <div class="overflow-x-auto">
                <svg viewBox="0 0 {{ $W }} {{ $H }}" class="w-full min-w-[480px]" role="img"
                     aria-label="Reported progress compared with planned progress by working day">
                    @foreach ([0, 25, 50, 75, 100] as $g)
                        <line x1="{{ $pl }}" x2="{{ $W - $pr }}" y1="{{ $cy($g) }}" y2="{{ $cy($g) }}" class="stroke-slate-200" stroke-width="1"/>
                        <text x="{{ $pl - 6 }}" y="{{ $cy($g) + 4 }}" text-anchor="end" class="fill-slate-500" font-size="11">{{ $g }}%</text>
                    @endforeach

                    <text x="{{ $pl }}" y="{{ $H - 6 }}" class="fill-slate-500" font-size="11">Day 0</text>
                    <text x="{{ $W - $pr }}" y="{{ $H - 6 }}" text-anchor="end" class="fill-slate-500" font-size="11">Day {{ $a['total'] }}</text>

                    {{-- today marker --}}
                    @if ($a['elapsed'] > 0 && $a['elapsed'] < $a['total'])
                        <line x1="{{ $cx($a['elapsed']) }}" x2="{{ $cx($a['elapsed']) }}" y1="{{ $pt }}" y2="{{ $pt + $ih }}"
                              class="stroke-slate-300" stroke-dasharray="4 4"/>
                        <text x="{{ $cx($a['elapsed']) }}" y="{{ $H - 6 }}" text-anchor="middle" class="fill-slate-500" font-size="11">Today</text>
                    @endif

                    {{-- plan --}}
                    <line x1="{{ $cx(0) }}" y1="{{ $cy(0) }}" x2="{{ $cx($a['total']) }}" y2="{{ $cy(100) }}"
                          class="stroke-slate-400" stroke-width="2" stroke-dasharray="6 4"/>

                    {{-- reported --}}
                    @if ($line)
                        <polyline points="{{ $line }}" fill="none" class="stroke-blue-600" stroke-width="2.5" stroke-linejoin="round"/>
                        @foreach ($a['points'] as $p)
                            <circle cx="{{ $cx($p['day']) }}" cy="{{ $cy($p['progress']) }}" r="3.5" class="fill-blue-600 stroke-white" stroke-width="1.5">
                                <title>Day {{ $p['day'] }}: {{ $p['progress'] }}%</title>
                            </circle>
                        @endforeach
                    @endif
                </svg>
            </div>
            @if (!$a['points'])
                <p class="text-sm text-slate-500 mt-2">No reports yet, so there is no progress line.</p>
            @endif
        </div>

        {{-- Day grid --}}
        <div class="bg-white border border-slate-200 rounded-2xl p-5 sm:p-6 mb-6">
            <h2 class="text-base font-bold text-slate-900 mb-1">Report coverage by working day</h2>
            <div class="flex flex-wrap gap-x-4 gap-y-1 text-xs font-semibold text-slate-500 mb-4">
                <span class="flex items-center gap-1.5"><span class="w-3 h-3 rounded bg-emerald-500"></span>Submitted</span>
                <span class="flex items-center gap-1.5"><span class="w-3 h-3 rounded bg-red-500"></span>Missed</span>
                <span class="flex items-center gap-1.5"><span class="w-3 h-3 rounded bg-amber-400"></span>Due today</span>
                <span class="flex items-center gap-1.5"><span class="w-3 h-3 rounded bg-slate-100 border border-slate-200"></span>Upcoming</span>
            </div>
            <div class="flex flex-wrap gap-1.5">
                @foreach ($a['grid'] as $g)
                    <div class="w-8 h-8 rounded flex items-center justify-center text-[11px] font-semibold {{ $cell[$g['state']] }}"
                         title="Day {{ $g['day'] }}, {{ $g['date']->format('D, M j') }}: {{ $g['state'] }}">
                        {{ $g['day'] }}
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Challenges --}}
        @if ($a['challenges']->isNotEmpty())
            <div class="bg-white border border-slate-200 rounded-2xl p-5 sm:p-6 mb-6">
                <h2 class="text-base font-bold text-slate-900 mb-3">Challenges raised by the freelancer</h2>
                <ul class="space-y-3">
                    @foreach ($a['challenges']->take(5) as $r)
                        <li class="text-sm">
                            <span class="font-semibold text-slate-900">{{ $r->report_date->format('M j') }}</span>
                            <span class="text-slate-600">: {{ $r->challenges }}</span>
                        </li>
                    @endforeach
                </ul>
                @if ($a['challenges']->count() > 5)
                    <p class="text-xs text-slate-500 mt-3">Showing the 5 most recent of {{ $a['challenges']->count() }}.</p>
                @endif
            </div>
        @endif

        {{-- Report log --}}
        <div class="bg-white border border-slate-200 rounded-2xl p-5 sm:p-6">
            <h2 class="text-base font-bold text-slate-900 mb-3">All reports, newest first</h2>

            @forelse ($a['log'] as $row)
                @php $r = $row['report']; @endphp
                <details class="border-t border-slate-200 first:border-t-0 py-3 group">
                    <summary class="flex items-center justify-between gap-3 cursor-pointer list-none">
                        <div class="min-w-0">
                            <p class="text-sm font-semibold text-slate-900 truncate">{{ $r->title }}</p>
                            <p class="text-xs text-slate-500 mt-0.5">
                                {{ $r->report_date->format('D, M j, Y') }}
                                @if ($row['day']) (day {{ $row['day'] }}) @endif
                                @if ($row['late']) <span class="text-amber-600 font-semibold">, submitted late</span> @endif
                            </p>
                        </div>
                        <div class="shrink-0 text-right">
                            <p class="text-sm font-bold text-slate-900">{{ $r->progress_percentage }}%</p>
                            @if ($row['delta'] !== null)
                                <p class="text-xs font-semibold {{ $row['delta'] < 0 ? 'text-red-600' : ($row['delta'] === 0 ? 'text-slate-500' : 'text-emerald-600') }}">
                                    {{ $row['delta'] > 0 ? '+' : '' }}{{ $row['delta'] }} pts
                                </p>
                            @endif
                        </div>
                    </summary>

                    <div class="mt-3 text-sm text-slate-700 space-y-3">
                        <div>
                            <p class="text-xs font-semibold text-slate-500 mb-0.5">Work done</p>
                            <p class="whitespace-pre-line">{{ $r->work_description }}</p>
                        </div>
                        @if ($r->challenges)
                            <div>
                                <p class="text-xs font-semibold text-slate-500 mb-0.5">Challenges</p>
                                <p class="whitespace-pre-line">{{ $r->challenges }}</p>
                            </div>
                        @endif
                        @if ($r->next_steps)
                            <div>
                                <p class="text-xs font-semibold text-slate-500 mb-0.5">Next steps</p>
                                <p class="whitespace-pre-line">{{ $r->next_steps }}</p>
                            </div>
                        @endif
                        @if ($r->attachment_path)
                            <a href="{{ route('employer.work-reports.attachment', $r->id) }}" target="_blank"
                               class="inline-block text-sm font-semibold text-blue-600 hover:underline">
                                Open attachment
                            </a>
                        @endif
                    </div>
                </details>
            @empty
                <p class="text-sm text-slate-500">The freelancer has not submitted any reports yet.</p>
            @endforelse
        </div>
        </div>{{-- /left column --}}

        {{-- Freelancer sidebar --}}
        @php
            $f      = $bid->freelancer;
            $fUser  = $f?->user;
            $fName  = $fUser?->name ?? data_get($f, 'name') ?? 'Freelancer';
            $fEmail = $fUser?->email ?? data_get($f, 'email');

            // Shows only the fields that exist and are filled. Edit keys/labels to match freelancer_registrations.
            $fFields = [
                'Phone'          => ['phone', 'mobile', 'phone_number'],
                'Location'       => ['location', 'city', 'country'],
                'Skills'         => ['skills', 'primary_skills'],
                'Experience'     => ['experience', 'years_of_experience'],
                'Hourly rate'    => ['hourly_rate', 'rate'],
                'Availability'   => ['availability'],
            ];
        @endphp
        <aside class="lg:col-span-1 space-y-4 lg:sticky lg:top-24">

            <div class="bg-white border border-slate-200 rounded-2xl p-5">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 rounded-full bg-blue-600 text-white flex items-center justify-center text-lg font-bold shrink-0">
                        {{ strtoupper(substr($fName, 0, 1)) }}
                    </div>
                    <div class="min-w-0">
                        <p class="text-base font-bold text-slate-900 truncate">{{ $fName }}</p>
                        @if ($fEmail)
                            <a href="mailto:{{ $fEmail }}" class="text-sm text-blue-600 hover:underline truncate block">{{ $fEmail }}</a>
                        @endif
                    </div>
                </div>

                <dl class="mt-4 space-y-3 text-sm">
                    @foreach ($fFields as $label => $keys)
                        @php
                            $val = null;
                            foreach ($keys as $k) {
                                $v = data_get($f, $k);
                                if (is_array($v)) $v = implode(', ', $v);
                                if (filled($v)) { $val = $v; break; }
                            }
                        @endphp
                        @if ($val)
                            <div>
                                <dt class="text-xs font-semibold text-slate-500">{{ $label }}</dt>
                                <dd class="text-slate-800 font-medium break-words">{{ $val }}</dd>
                            </div>
                        @endif
                    @endforeach
                </dl>

                @if (Route::has('employer.freelancer.bids.resume'))
                    <a href="{{ route('employer.freelancer.bids.resume', $bid->id) }}" target="_blank"
                       class="mt-4 inline-block text-sm font-semibold text-blue-600 hover:underline">
                        View resume
                    </a>
                @endif
            </div>

            <div class="bg-white border border-slate-200 rounded-2xl p-5">
                <h2 class="text-base font-bold text-slate-900 mb-3">Contract</h2>
                <dl class="space-y-3 text-sm">
                    <div>
                        <dt class="text-xs font-semibold text-slate-500">Bid amount</dt>
                        <dd class="text-slate-800 font-medium">{{ number_format((float) $bid->bid_amount, 2) }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-semibold text-slate-500">Estimated time</dt>
                        <dd class="text-slate-800 font-medium">{{ $bid->estimated_days }} ({{ $a['total'] }} working days)</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-semibold text-slate-500">Contract sent</dt>
                        <dd class="text-slate-800 font-medium">{{ $bid->contract_sent_at?->format('M j, Y') ?? '-' }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-semibold text-slate-500">Signed contract received</dt>
                        <dd class="text-slate-800 font-medium">{{ $bid->signed_contract_received_at?->format('M j, Y') ?? '-' }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-semibold text-slate-500">Work started</dt>
                        <dd class="text-slate-800 font-medium">{{ $bid->work_started_at?->format('M j, Y') ?? '-' }}</dd>
                    </div>
                </dl>

                @if (Route::has('employer.freelancer.bids.signed-contract'))
                    <a href="{{ route('employer.freelancer.bids.signed-contract', $bid->id) }}" target="_blank"
                       class="mt-4 inline-block text-sm font-semibold text-blue-600 hover:underline">
                        Open signed contract
                    </a>
                @endif
            </div>

            <div class="bg-white border border-slate-200 rounded-2xl p-5">
                <h2 class="text-base font-bold text-slate-900 mb-3">Reporting record</h2>
                <dl class="space-y-3 text-sm">
                    <div class="flex justify-between"><dt class="text-slate-500">Submission rate</dt><dd class="font-semibold text-slate-900">{{ $a['rate'] === null ? '-' : $a['rate'] . '%' }}</dd></div>
                    <div class="flex justify-between"><dt class="text-slate-500">Missed days</dt><dd class="font-semibold {{ $a['missed'] ? 'text-red-600' : 'text-slate-900' }}">{{ $a['missed'] }}</dd></div>
                    <div class="flex justify-between"><dt class="text-slate-500">Late submissions</dt><dd class="font-semibold text-slate-900">{{ $a['late'] }}</dd></div>
                    <div class="flex justify-between"><dt class="text-slate-500">Avg. report length</dt><dd class="font-semibold text-slate-900">{{ $a['avg_words'] === null ? '-' : $a['avg_words'] . ' words' }}</dd></div>
                </dl>
            </div>
        </aside>
        </div>{{-- /grid --}}
    </div>
</div>
@endsection