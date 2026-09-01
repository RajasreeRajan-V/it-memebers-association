@extends('layouts.app')
@section('title', 'Certificate')

@section('content')
<style>
    .certificate-wrapper {
        max-width: 820px;
        margin: 0 auto;
    }

    .certificate {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 4px;
        padding: 70px 60px;
        position: relative;
    }

    .certificate::before {
        content: "";
        position: absolute;
        inset: 14px;
        border: 1px solid #d1d5db;
        pointer-events: none;
    }

    .certificate .eyebrow {
        letter-spacing: 3px;
        font-size: 12px;
        font-weight: 600;
        color: #6b7280;
        text-transform: uppercase;
    }

    .certificate h1 {
        font-family: Georgia, 'Times New Roman', serif;
        font-size: 30px;
        font-weight: 700;
        color: #111827;
        margin: 14px 0 6px;
        letter-spacing: 1px;
    }

    .certificate .divider {
        width: 60px;
        height: 3px;
        background: #0d6efd;
        margin: 18px auto;
        border: none;
    }

    .certificate .lead-text {
        color: #6b7280;
        font-size: 14px;
        margin-bottom: 4px;
    }

    .certificate .recipient-name {
        font-family: Georgia, 'Times New Roman', serif;
        font-size: 34px;
        font-weight: 600;
        color: #0d6efd;
        margin: 6px 0 18px;
    }

    .certificate .training-title {
        font-size: 20px;
        font-weight: 600;
        color: #111827;
        margin: 6px 0 24px;
    }

    .certificate .meta-row {
        display: flex;
        justify-content: center;
        gap: 60px;
        margin-top: 40px;
        padding-top: 24px;
        border-top: 1px solid #e5e7eb;
    }

    .certificate .meta-item {
        text-align: center;
    }

    .certificate .meta-label {
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: #9ca3af;
        margin-bottom: 4px;
    }

    .certificate .meta-value {
        font-size: 14px;
        font-weight: 600;
        color: #374151;
    }

    .certificate .cert-number {
        margin-top: 30px;
        font-size: 11px;
        color: #9ca3af;
        letter-spacing: 0.5px;
    }

    @media print {
        .no-print {
            display: none !important;
        }

        body {
            background: #fff !important;
        }

        .certificate-wrapper {
            max-width: 100%;
        }

        .certificate {
            border: none;
            padding: 40px;
        }

        .certificate::before {
            inset: 10px;
        }
    }
</style>

<div class="certificate-wrapper my-5">
    <div class="certificate">
        <div class="text-center">
            <div class="eyebrow">Certificate of Completion</div>
            <h1>Certificate</h1>
            <hr class="divider">

            <p class="lead-text">This certifies that</p>
            <div class="recipient-name">{{ auth()->user()->name }}</div>

            <p class="lead-text">has successfully completed the training program</p>
            <div class="training-title">{{ $training->title }}</div>

            <div class="meta-row">
                <div class="meta-item">
                    <div class="meta-label">Issued On</div>
                    <div class="meta-value">{{ optional($certificate->issued_at)->format('d M Y') }}</div>
                </div>
                <div class="meta-item">
                    <div class="meta-label">Mentor</div>
                    <div class="meta-value">{{ $training->mentor->name ?? '—' }}</div>
                </div>
            </div>

            <div class="cert-number">Certificate No: {{ $certificate->certificate_number }}</div>
        </div>
    </div>
</div>

<div class="text-center mt-4 no-print">
    <a href="{{ route('student.trainings.my-trainings') }}" class="btn btn-outline-secondary">Back to My Trainings</a>
    <button class="btn btn-primary" onclick="window.print()">
        <i class="bi bi-printer"></i> Print / Save as PDF
    </button>
</div>
@endsection