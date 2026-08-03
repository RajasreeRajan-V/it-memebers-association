@php
    $statusClasses = [
        'gray'   => 'bg-slate-100 text-slate-600',
        'orange' => 'bg-orange-50 text-orange-600',
        'blue'   => 'bg-blue-50 text-blue-600',
        'green'  => 'bg-green-50 text-green-600',
    ];
@endphp

<div class="flex items-center justify-between">
    <div>
        <p class="text-xs text-slate-400">Request ID: {{ $legalRequest->request_number }}</p>
        <h3 class="mt-1 text-sm font-semibold text-slate-800">{{ $legalRequest->issue_title }}</h3>
    </div>
    <span class="rounded-full px-2.5 py-1 text-xs font-medium {{ $statusClasses[$legalRequest->status_color] ?? 'bg-slate-100 text-slate-600' }}">
        {{ $legalRequest->status_label }}
    </span>
</div>

{{-- timeline --}}
<ol class="mt-6 space-y-6 border-l border-slate-100 pl-4">
    @forelse($legalRequest->timelines as $step)
        <li class="relative">
            <span @class([
                'absolute -left-[21px] top-0.5 flex h-4 w-4 items-center justify-center rounded-full text-[10px]',
                'bg-green-500 text-white' => $step->status === 'completed',
                'bg-blue-500 text-white'  => $step->status === 'in_progress',
                'bg-slate-200 text-slate-400' => $step->status === 'pending',
            ])>
                @if($step->status === 'completed') ✓ @endif
            </span>
            <p class="text-sm font-medium text-slate-700">{{ $step->title }}</p>
            @if($step->description)
                <p class="mt-0.5 text-xs text-slate-500">{{ $step->description }}</p>
            @endif
            <p class="mt-0.5 text-[11px] text-slate-400">{{ $step->created_at->format('d M Y, h:i A') }}</p>
        </li>
    @empty
        <li class="text-xs text-slate-400">No updates yet.</li>
    @endforelse
</ol>

{{-- documents --}}
@if($legalRequest->documents->count())
    <div class="mt-6 border-t border-slate-100 pt-4">
        <p class="text-xs font-semibold text-slate-600">Uploaded Documents</p>
        <ul class="mt-2 space-y-1.5">
            @foreach($legalRequest->documents as $document)
                <li class="flex items-center gap-2 text-xs text-blue-600">
                    📎
                    <a href="{{ Storage::disk('public')->url($document->file_path) }}" target="_blank" class="hover:underline">
                        {{ $document->file_name }}
                    </a>
                    <span class="text-slate-400">({{ $document->file_size_human }})</span>
                </li>
            @endforeach
        </ul>
    </div>
@endif
