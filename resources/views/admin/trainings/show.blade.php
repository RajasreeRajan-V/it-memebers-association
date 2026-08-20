@extends('admin.layout.app')

@section('content')
<div class="content-header">
    <h2>{{ $training->title }}</h2>
    <p>Submitted by {{ $training->mentor->name ?? '-' }} &middot; {{ ucfirst($training->status) }}</p>
</div>

@if (session('success'))
    <div class="card" style="padding:10px 16px; margin-bottom:14px; background:#ECFDF5; color:#065F46;">
        {{ session('success') }}
    </div>
@endif

<div class="card" style="padding:1.25rem; margin-bottom:1rem; display:flex; gap:20px;">
    <div style="width:180px; height:120px; border-radius:8px; overflow:hidden; background:#F3F4F6; flex-shrink:0;">
        @if ($training->cover_image)
            <img src="{{ asset('storage/' . $training->cover_image) }}" style="width:100%; height:100%; object-fit:cover;">
        @endif
    </div>
    <div>
        <p><strong>Category:</strong> {{ $training->category }}</p>
        <p><strong>Skill Level:</strong> {{ ucfirst($training->skill_level) }}</p>
        <p><strong>Duration:</strong> {{ $training->duration ?? '—' }}</p>
        <p><strong>Description:</strong> {{ $training->description }}</p>
        <p><strong>Prerequisites:</strong> {{ $training->prerequisites ?? '—' }}</p>
    </div>
</div>

<div class="card" style="padding:1.25rem; margin-bottom:1rem;">
    <h3>Learning Outcomes</h3>
    <ul>
        @foreach ($training->learning_outcomes ?? [] as $outcome)
            <li>{{ $outcome }}</li>
        @endforeach
    </ul>
</div>

<div class="card" style="padding:1.25rem; margin-bottom:1rem;">
    <h3>Modules & Materials</h3>
    @forelse ($training->modules as $module)
        <div style="margin-bottom:14px;">
            <strong>Module {{ $loop->iteration }} — {{ $module->title }}</strong>
            <ul>
                @forelse ($module->materials as $material)
                    <li>
                        {{ $material->title }} ({{ ucfirst($material->type) }})
                        @if ($material->file_path)
                            — <a href="{{ asset('storage/' . $material->file_path) }}" target="_blank">View file</a>
                        @elseif ($material->external_url)
                            — <a href="{{ $material->external_url }}" target="_blank">Open link</a>
                        @endif
                    </li>
                @empty
                    <li>No materials in this module.</li>
                @endforelse
            </ul>
        </div>
    @empty
        <p>No modules added.</p>
    @endforelse
</div>

@if ($training->status === 'rejected' && $training->admin_feedback)
    <div class="card" style="padding:1rem 1.25rem; margin-bottom:1rem; background:#FEF2F2; color:#991B1B;">
        <strong>Rejection reason:</strong> {{ $training->admin_feedback }}
    </div>
@endif

<div class="card" style="padding:1.25rem; display:flex; gap:10px;">
    <a href="{{ route('admin.trainings.index') }}">&larr; Back to list</a>

    @if ($training->status === 'pending')
        <form method="POST" action="{{ route('admin.trainings.approve', $training) }}">
            @csrf<button type="submit">Approve</button>
        </form>
        <form method="POST" action="{{ route('admin.trainings.reject', $training) }}">
            @csrf
            <input type="text" name="admin_feedback" placeholder="Reason for rejection" required>
            <button type="submit">Reject</button>
        </form>
    @elseif ($training->status === 'approved')
        <form method="POST" action="{{ route('admin.trainings.publish', $training) }}">
            @csrf<button type="submit">Publish</button>
        </form>
    @elseif ($training->status === 'published')
        <form method="POST" action="{{ route('admin.trainings.unpublish', $training) }}">
            @csrf<button type="submit">Unpublish</button>
        </form>
    @endif
</div>
@endsection