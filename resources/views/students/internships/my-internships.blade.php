@extends('layouts.app')

@section('title', 'My Internships')

@section('content')

<style>
    .mi-page { max-width: 820px; margin: 0 auto; padding: 30px 20px 60px; color: #172033; }
    .mi-page h1 { font-size: 22px; font-weight: 800; margin: 0 0 4px; }
    .mi-page > p { color: #64748b; font-size: 13px; margin: 0 0 20px; }

    .mi-card { background: #fff; border: 1px solid #e2e8f0; border-radius: 14px; padding: 18px; margin-bottom: 12px; }
    .mi-title { margin: 0 0 3px; font-size: 16px; font-weight: 800; }
    .mi-company { margin: 0 0 10px; color: #64748b; font-size: 12.5px; }

    .mi-status { display: inline-flex; align-items: center; gap: 5px; padding: 5px 10px; border-radius: 999px; font-size: 10.5px; font-weight: 800; margin-bottom: 12px; }
    .mi-status-ongoing { background: #eef4ff; color: #2563eb; }
    .mi-status-completed { background: #f5f3ff; color: #7c3aed; }

    .mi-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 10px; }
    .mi-item span { display: block; color: #94a3b8; font-size: 9.5px; text-transform: uppercase; font-weight: 700; letter-spacing: .04em; margin-bottom: 3px; }
    .mi-item strong { display: block; color: #172033; font-size: 13px; }

    .mi-cert-link { display: inline-flex; align-items: center; gap: 6px; margin-top: 14px; padding: 9px 14px; border-radius: 8px; background: #3376F2; color: #fff; text-decoration: none; font-size: 12px; font-weight: 700; }

    .mi-empty { text-align: center; padding: 50px 20px; color: #64748b; background: #fff; border: 1px solid #e2e8f0; border-radius: 14px; }
</style>

<div class="mi-page">

    <h1>My Internships</h1>
    <p>Internships you've been selected for — ongoing and completed.</p>

    @forelse($applications as $application)

        @php
            $internship = $application->internship;
            $isCompleted = $application->isCompleted();
        @endphp

        <div class="mi-card">

            <span class="mi-status {{ $isCompleted ? 'mi-status-completed' : 'mi-status-ongoing' }}">
                {{ $isCompleted ? 'Completed' : 'Ongoing' }}
            </span>

            <h3 class="mi-title">{{ $internship->title ?? 'Internship' }}</h3>
            <p class="mi-company">
                {{ optional($internship->employer)->company_name ?? optional($internship->employer)->name ?? 'Company' }}
            </p>

            <div class="mi-grid">

                <div class="mi-item">
                    <span>Start Date</span>
                    <strong>{{ optional($application->selected_at)->format('d M Y') ?: '—' }}</strong>
                </div>

                <div class="mi-item">
                    <span>Duration</span>
                    <strong>{{ $internship->duration ?? '—' }}</strong>
                </div>

                <div class="mi-item">
                    <span>Stipend</span>
                    <strong>{{ $internship->stipend ?: 'Unpaid' }}</strong>
                </div>

            </div>

            @if($isCompleted && $application->certificate)
                <a href="{{ route('student.internships.certificates.show', $application) }}" class="mi-cert-link">
                    <i class="bi bi-patch-check-fill"></i> View Certificate
                </a>
            @endif

        </div>

    @empty

        <div class="mi-empty">
            <p>You don't have any ongoing or completed internships yet.</p>
        </div>

    @endforelse

    <div style="margin-top: 20px;">
        {{ $applications->links() }}
    </div>

</div>

@endsection
