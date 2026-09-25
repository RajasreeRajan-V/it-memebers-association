@extends('layouts.app')

@section('title', 'My Internship Certificates')

@section('content')

<style>
    :root {
        --primary: #3376F2;
        --primary-dark: #245ED1;
        --purple: #7C4DFF;
        --green: #16A34A;
        --green-light: #ECFDF3;
        --blue-light: #EEF4FF;
        --bg: #F6F8FC;
        --text: #172033;
        --muted: #64748B;
        --border: #E2E8F0;
        --white: #FFFFFF;
    }

    .certificate-page {
        min-height: calc(100vh - 80px);
        background: var(--bg);
        padding: 35px 20px 60px;
    }

    .certificate-container {
        max-width: 1180px;
        margin: 0 auto;
    }

    /* Header */
    .page-header {
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: 20px;
        padding: 30px;
        margin-bottom: 25px;
    }

    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
        color: var(--primary);
        font-size: 15px;
        font-weight: 600;
        margin-bottom: 18px;
    }

    .back-link:hover {
        color: var(--primary-dark);
    }

    .page-title {
        margin: 0;
        font-size: 30px;
        font-weight: 700;
        color: var(--text);
    }

    .page-subtitle {
        margin: 8px 0 0;
        color: var(--muted);
        font-size: 15px;
    }

    .certificate-count {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        margin-top: 18px;
        padding: 8px 14px;
        border-radius: 999px;
        background: var(--blue-light);
        color: var(--primary);
        font-size: 13px;
        font-weight: 700;
    }

    /* Empty state */
    .empty-state {
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: 20px;
        padding: 70px 25px;
        text-align: center;
    }

    .empty-icon {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: var(--blue-light);
        color: var(--primary);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        font-size: 32px;
    }

    .empty-state h3 {
        margin: 0 0 8px;
        font-size: 21px;
        color: var(--text);
    }

    .empty-state p {
        margin: 0 auto 22px;
        max-width: 500px;
        color: var(--muted);
        line-height: 1.6;
    }

    .browse-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 11px 20px;
        background: var(--primary);
        color: #fff;
        border-radius: 10px;
        text-decoration: none;
        font-weight: 600;
    }

    .browse-btn:hover {
        background: var(--primary-dark);
        color: #fff;
    }

    /* Certificate Grid */
    .certificate-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 22px;
    }

    .certificate-card {
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: 20px;
        overflow: hidden;
        transition: 0.2s ease;
    }

    .certificate-card:hover {
        border-color: #C7D7F9;
        box-shadow: 0 10px 30px rgba(15, 23, 42, 0.07);
        transform: translateY(-2px);
    }

    .certificate-top {
        padding: 23px;
        border-bottom: 1px solid var(--border);
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 15px;
    }

    .certificate-icon {
        width: 52px;
        height: 52px;
        border-radius: 14px;
        background: var(--blue-light);
        color: var(--primary);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 23px;
        flex-shrink: 0;
    }

    .certificate-title-area {
        display: flex;
        gap: 14px;
        min-width: 0;
    }

    .certificate-title-area h3 {
        margin: 0 0 5px;
        color: var(--text);
        font-size: 18px;
        font-weight: 700;
        line-height: 1.35;
    }

    .certificate-title-area p {
        margin: 0;
        color: var(--muted);
        font-size: 13px;
    }

    .completed-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: var(--green-light);
        color: var(--green);
        border-radius: 999px;
        padding: 7px 11px;
        font-size: 12px;
        font-weight: 700;
        white-space: nowrap;
    }

    .certificate-body {
        padding: 23px;
    }

    .details {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 16px;
        margin-bottom: 22px;
    }

    .detail-item {
        min-width: 0;
    }

    .detail-label {
        display: block;
        color: #94A3B8;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .04em;
        margin-bottom: 5px;
    }

    .detail-value {
        color: var(--text);
        font-size: 14px;
        font-weight: 600;
        word-break: break-word;
    }

    .certificate-number {
        background: #F8FAFC;
        border: 1px solid var(--border);
        border-radius: 12px;
        padding: 13px 14px;
        margin-bottom: 18px;
    }

    .certificate-number-label {
        color: #94A3B8;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        margin-bottom: 4px;
    }

    .certificate-number-value {
        color: var(--text);
        font-size: 13px;
        font-weight: 700;
        word-break: break-all;
    }

    .certificate-actions {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .action-btn {
        flex: 1;
        min-width: 130px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 11px 15px;
        border-radius: 10px;
        text-decoration: none;
        font-size: 14px;
        font-weight: 600;
        transition: .2s ease;
    }

    .view-btn {
        background: var(--primary);
        color: #fff;
    }

    .view-btn:hover {
        background: var(--primary-dark);
        color: #fff;
    }

    .download-btn {
        background: #fff;
        color: var(--primary);
        border: 1px solid #C7D7F9;
    }

    .download-btn:hover {
        background: var(--blue-light);
        color: var(--primary-dark);
    }

    /* Responsive */
    @media (max-width: 850px) {
        .certificate-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 600px) {
        .certificate-page {
            padding: 20px 12px 40px;
        }

        .page-header {
            padding: 22px;
        }

        .page-title {
            font-size: 24px;
        }

        .certificate-top {
            flex-direction: column;
        }

        .details {
            grid-template-columns: 1fr;
        }

        .certificate-actions {
            flex-direction: column;
        }

        .action-btn {
            width: 100%;
        }
    }
</style>

<div class="certificate-page">

    <div class="certificate-container">

        {{-- =====================================================
             PAGE HEADER
        ====================================================== --}}
        <div class="page-header">

            <a href="{{ route('student.internships.index') }}" class="back-link">
                <i class="fas fa-arrow-left"></i>
                Back to Internships
            </a>

            <h1 class="page-title">
                My Internship Certificates
            </h1>

            <p class="page-subtitle">
                View and download certificates for your completed internships.
            </p>

            <div class="certificate-count">
                <i class="fas fa-certificate"></i>

                {{ $certificates instanceof \Illuminate\Contracts\Pagination\LengthAwarePaginator
                    ? $certificates->total()
                    : $certificates->count()
                }}

                {{ (($certificates instanceof \Illuminate\Contracts\Pagination\LengthAwarePaginator
                    ? $certificates->total()
                    : $certificates->count()) == 1) ? 'Certificate' : 'Certificates' }}
            </div>

        </div>


        {{-- =====================================================
             CERTIFICATES
        ====================================================== --}}

        @if($certificates->count() > 0)

            <div class="certificate-grid">

                @foreach($certificates as $application)

                    @php
                        $internship = $application->internship ?? null;
                        $certificate = $application->certificate ?? null;
                        $startup = $internship->startupProfile ?? null;
                        $employer = $internship->employer ?? null;

                        $certificateNumber =
                            $certificate->certificate_number
                            ?? $certificate->certificate_no
                            ?? $certificate->number
                            ?? ('CERT-' . str_pad($application->id, 6, '0', STR_PAD_LEFT));

                        $completedDate =
                            $certificate->issued_at
                            ?? $certificate->issued_date
                            ?? $certificate->created_at
                            ?? $application->updated_at
                            ?? $application->created_at;

                        /*
                        |--------------------------------------------------------------------------
                        | Certificate PDF route
                        |--------------------------------------------------------------------------
                        | Change this ONLY if your existing PDF route has a different name.
                        */
                        $certificateUrl = null;

                        try {
                            $certificateUrl = route(
                                'student.internships.certificate',
                                $application->id
                            );
                        } catch (\Throwable $e) {
                            $certificateUrl = url(
                                '/student/internships/certificates/' . $application->id
                            );
                        }
                    @endphp


                    <div class="certificate-card">

                        {{-- =================================================
                             CARD TOP
                        ================================================== --}}
                        <div class="certificate-top">

                            <div class="certificate-title-area">

                                <div class="certificate-icon">
                                    <i class="fas fa-certificate"></i>
                                </div>

                                <div>

                                    <h3>
                                        {{ $internship->title ?? 'Internship' }}
                                    </h3>

                                    <p>
                                        @if($startup)
                                            {{ $startup->startup_name ?? $startup->company_name ?? '' }}
                                        @elseif($employer)
                                            {{ $employer->name ?? '' }}
                                        @else
                                            Internship Certificate
                                        @endif
                                    </p>

                                </div>

                            </div>


                            <span class="completed-badge">
                                <i class="fas fa-check-circle"></i>
                                Completed
                            </span>

                        </div>


                        {{-- =================================================
                             CARD BODY
                        ================================================== --}}
                        <div class="certificate-body">

                            <div class="details">

                                <div class="detail-item">
                                    <span class="detail-label">
                                        Internship
                                    </span>

                                    <span class="detail-value">
                                        {{ $internship->title ?? 'Internship' }}
                                    </span>
                                </div>


                                <div class="detail-item">
                                    <span class="detail-label">
                                        Status
                                    </span>

                                    <span class="detail-value" style="color:#16A34A;">
                                        Completed
                                    </span>
                                </div>


                                <div class="detail-item">
                                    <span class="detail-label">
                                        Completed On
                                    </span>

                                    <span class="detail-value">
                                        @if($completedDate)
                                            {{ \Carbon\Carbon::parse($completedDate)->format('d M Y') }}
                                        @else
                                            —
                                        @endif
                                    </span>
                                </div>


                                <div class="detail-item">
                                    <span class="detail-label">
                                        Duration
                                    </span>

                                    <span class="detail-value">
                                        {{ $internship->duration ?? '—' }}
                                    </span>
                                </div>

                            </div>


                            {{-- Certificate Number --}}
                            <div class="certificate-number">

                                <div class="certificate-number-label">
                                    Certificate Number
                                </div>

                                <div class="certificate-number-value">
                                    {{ $certificateNumber }}
                                </div>

                            </div>


                            {{-- =================================================
                                 ACTION BUTTONS
                            ================================================== --}}
                            <div class="certificate-actions">

                                <a
                                    href="{{ $certificateUrl }}"
                                    target="_blank"
                                    class="action-btn view-btn"
                                >
                                    <i class="fas fa-eye"></i>
                                    View Certificate
                                </a>


                                <a
                                    href="{{ $certificateUrl }}"
                                    target="_blank"
                                    class="action-btn download-btn"
                                >
                                    <i class="fas fa-download"></i>
                                    Download Certificate
                                </a>

                            </div>

                        </div>

                    </div>

                @endforeach

            </div>


            {{-- Pagination --}}
            @if(method_exists($certificates, 'links'))

                <div style="margin-top:25px;">
                    {{ $certificates->links() }}
                </div>

            @endif

        @else

            {{-- =====================================================
                 EMPTY STATE
            ====================================================== --}}
            <div class="empty-state">

                <div class="empty-icon">
                    <i class="fas fa-certificate"></i>
                </div>

                <h3>
                    No Certificates Yet
                </h3>

                <p>
                    Your internship certificates will appear here after
                    you successfully complete an internship and your
                    certificate has been issued.
                </p>

                <a
                    href="{{ route('student.internships.index') }}"
                    class="browse-btn"
                >
                    <i class="fas fa-search"></i>
                    Browse Internships
                </a>

            </div>

        @endif

    </div>

</div>

@endsection