@extends('layouts.app')

@section('title', 'My Certificates')

@section('content')

<style>
    .cert-page { max-width: 820px; margin: 0 auto; padding: 30px 20px 60px; color: #172033; }
    .cert-page h1 { font-size: 22px; font-weight: 800; margin: 0 0 4px; }
    .cert-page > p { color: #64748b; font-size: 13px; margin: 0 0 20px; }

    .cert-card { background: #fff; border: 1px solid #e2e8f0; border-radius: 14px; padding: 18px; margin-bottom: 12px; display: flex; justify-content: space-between; align-items: center; gap: 14px; flex-wrap: wrap; }
    .cert-title { margin: 0 0 3px; font-size: 15px; font-weight: 800; }
    .cert-meta { margin: 0; color: #64748b; font-size: 12px; }
    .cert-number { color: #3376F2; font-weight: 700; }

    .cert-btn { display: inline-flex; align-items: center; gap: 6px; padding: 9px 14px; border-radius: 8px; background: #3376F2; color: #fff; text-decoration: none; font-size: 12px; font-weight: 700; }

    .cert-empty { text-align: center; padding: 50px 20px; color: #64748b; background: #fff; border: 1px solid #e2e8f0; border-radius: 14px; }
</style>

<div class="cert-page">

    <h1>Certificates</h1>
    <p>Internship completion certificates you've earned.</p>

    @forelse($applications as $application)

        <div class="cert-card">
            <div>
                <h3 class="cert-title">{{ $application->internship->title ?? 'Internship' }}</h3>
                <p class="cert-meta">
                    {{ optional($application->internship->employer)->company_name ?? optional($application->internship->employer)->name ?? 'Company' }}
                    &middot;
                    Completed {{ optional($application->completed_at)->format('d M Y') }}
                    &middot;
                    <span class="cert-number">{{ $application->certificate->certificate_number }}</span>
                </p>
            </div>

            <a href="{{ route('student.internships.certificates.show', $application) }}" class="cert-btn">
                <i class="bi bi-eye"></i> View / Download
            </a>
        </div>

    @empty

        <div class="cert-empty">
            <p>You haven't earned any certificates yet.</p>
        </div>

    @endforelse

    <div style="margin-top: 20px;">
        {{ $applications->links() }}
    </div>

</div>

@endsection
