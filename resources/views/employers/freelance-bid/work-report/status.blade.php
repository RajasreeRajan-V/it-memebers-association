@php
    $map = [
        'on_track'    => 'bg-emerald-50 text-emerald-700 border-emerald-200',
        'completed'   => 'bg-blue-50 text-blue-700 border-blue-200',
        'at_risk'     => 'bg-amber-50 text-amber-700 border-amber-200',
        'behind'      => 'bg-red-50 text-red-700 border-red-200',
        'not_started' => 'bg-slate-100 text-slate-600 border-slate-200',
    ];
@endphp
<span class="inline-flex items-center text-xs font-semibold px-2.5 py-1 rounded-full border {{ $map[$status] ?? $map['not_started'] }}">
    {{ $label }}
</span>