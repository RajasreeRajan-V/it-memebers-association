@extends('layouts.app')

@section('title', 'Certificate')

@section('content')

<style>
    .cv-wrap { max-width: 760px; margin: 30px auto 60px; padding: 0 20px; }

    .cv-toolbar { display: flex; justify-content: flex-end; gap: 8px; margin-bottom: 16px; }
    .cv-btn { border: 1px solid #e2e8f0; background: #fff; color: #475569; border-radius: 8px; padding: 9px 14px; font-size: 12.5px; font-weight: 700; cursor: pointer; text-decoration: none; }
    .cv-btn.primary { background: #3376F2; color: #fff; border-color: #3376F2; }

    .cv-certificate {
        background: #fff;
        border: 10px solid #3376F2;
        border-radius: 4px;
        padding: 60px 50px;
        text-align: center;
        font-family: Georgia, 'Times New Roman', serif;
        color: #172033;
    }

    .cv-org { letter-spacing: 3px; font-size: 13px; font-weight: 700; color: #3376F2; margin-bottom: 8px; }
    .cv-heading { font-size: 26px; font-weight: 700; letter-spacing: 2px; margin: 0 0 30px; text-transform: uppercase; }
    .cv-line { font-size: 14px; color: #475569; margin: 6px 0; }
    .cv-name { font-size: 30px; font-weight: 700; margin: 14px 0; color: #172033; }
    .cv-role { font-size: 18px; font-weight: 700; margin: 14px 0 4px; text-transform: uppercase; }
    .cv-company { font-size: 15px; color: #475569; margin-bottom: 22px; }
    .cv-duration { font-size: 13px; color: #64748b; margin-bottom: 40px; }

    .cv-footer { display: flex; justify-content: space-between; align-items: flex-end; margin-top: 40px; }
    .cv-signature { border-top: 1px solid #94a3b8; padding-top: 6px; font-size: 12px; color: #64748b; min-width: 180px; }
    .cv-number { font-size: 11px; color: #94a3b8; }

    @media print {
        .cv-toolbar { display: none; }
        .cv-certificate { border-width: 6px; }
    }
</style>

@php
    $internship = $application->internship;
    $companyName = optional($internship->employer)->company_name ?? optional($internship->employer)->name ?? 'Company';
@endphp

<div class="cv-wrap">

    <div class="cv-toolbar">
        <a href="{{ route('student.internships.certificates') }}" class="cv-btn">Back</a>
        <button type="button" class="cv-btn primary" onclick="window.print()">
            <i class="bi bi-download"></i> Download / Print
        </button>
    </div>

    <div class="cv-certificate">

        <div class="cv-org">TECH LEADERS NETWORK</div>
        <h1 class="cv-heading">Certificate of Internship</h1>

        <p class="cv-line">This is to certify that</p>
        <div class="cv-name">{{ $application->student->name ?? 'Student' }}</div>
        <p class="cv-line">has successfully completed an internship as</p>

        <div class="cv-role">{{ $internship->title ?? 'Intern' }}</div>
        <div class="cv-company">at {{ $companyName }}</div>

        <div class="cv-duration">
            Duration: {{ $internship->duration ?? '—' }}
            @if($application->selected_at && $application->completed_at)
                <br>
                {{ $application->selected_at->format('d F Y') }} &ndash; {{ $application->completed_at->format('d F Y') }}
            @endif
        </div>

        <div class="cv-footer">
            <div class="cv-number">
                Certificate No:<br>
                {{ $application->certificate->certificate_number }}
            </div>

            <div class="cv-signature">
                Authorized Signatory<br>
                Tech Leaders Network
            </div>
        </div>

    </div>

</div>

@endsection
