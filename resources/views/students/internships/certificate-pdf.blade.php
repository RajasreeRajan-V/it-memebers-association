<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <title>Internship Certificate</title>

    <style>

        /*
        |--------------------------------------------------------------------------
        | PDF PAGE
        |--------------------------------------------------------------------------
        */

        @page {
            size: A4 landscape;
            margin: 0;
        }

        * {
            box-sizing: border-box;
        }

        html,
        body {
            margin: 0;
            padding: 0;

            width: 297mm;
            height: 210mm;

            background: #ffffff;
        }

        body {
            font-family: DejaVu Sans, Arial, sans-serif;

            color: #172033;

            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }


        /*
        |--------------------------------------------------------------------------
        | MAIN PAGE
        |--------------------------------------------------------------------------
        */

        .certificate-page {

            width: 297mm;
            height: 210mm;

            margin: 0;
            padding: 8mm;

            background: #ffffff;

            overflow: hidden;
        }


        /*
        |--------------------------------------------------------------------------
        | CERTIFICATE CARD
        |--------------------------------------------------------------------------
        */

        .certificate-card {

            width: 100%;
            height: 100%;

            margin: 0;

            padding: 0;

            background: #ffffff;

            border: none;
        }


        /*
        |--------------------------------------------------------------------------
        | CERTIFICATE
        |--------------------------------------------------------------------------
        */

        .certificate {

            position: relative;

            width: 100%;
            height: 100%;

            overflow: hidden;

            border: 6px solid #3376F2;

            background:
                radial-gradient(circle at top right, rgba(51, 118, 242, .10), transparent 32%),
                radial-gradient(circle at bottom left, rgba(51, 118, 242, .08), transparent 32%),
                #ffffff;

            padding: 14mm 20mm 9mm 20mm;
        }


        /*
        |--------------------------------------------------------------------------
        | INNER BORDER
        |--------------------------------------------------------------------------
        */

        .certificate::before {

            content: "";

            position: absolute;

            top: 5mm;
            right: 5mm;
            bottom: 5mm;
            left: 5mm;

            border: 1px solid rgba(51, 118, 242, .25);

            pointer-events: none;
        }


        /*
        |--------------------------------------------------------------------------
        | CONTENT
        |--------------------------------------------------------------------------
        */

        .certificate-content {

            position: relative;

            z-index: 2;

            width: 100%;

            text-align: center;
        }


        /*
        |--------------------------------------------------------------------------
        | COMPANY LOGO
        |--------------------------------------------------------------------------
        */

        .certificate-logo {

            width: 20mm;
            height: 20mm;

            margin: 0 auto 3.5mm;

            border-radius: 4mm;

            background: #eef4ff;

            overflow: hidden;

            text-align: center;
        }


        .certificate-logo img {

            width: 100%;
            height: 100%;

            object-fit: contain;
        }


        /*
        |--------------------------------------------------------------------------
        | SMALL TITLE
        |--------------------------------------------------------------------------
        */

        .certificate-small-title {

            color: #3376F2;

            font-size: 9px;

            font-weight: 700;

            letter-spacing: 4.5px;

            text-transform: uppercase;

            margin: 0 0 3.5mm;
        }


        /*
        |--------------------------------------------------------------------------
        | MAIN TITLE
        |--------------------------------------------------------------------------
        */

        .certificate-title {

            margin: 0 0 3.5mm;

            color: #0F172A;

            font-family: Georgia, "Times New Roman", serif;

            font-size: 34px;

            line-height: 1.1;

            font-weight: 700;
        }


        /*
        |--------------------------------------------------------------------------
        | SUBTITLE
        |--------------------------------------------------------------------------
        */

        .certificate-subtitle {

            color: #64748B;

            font-size: 10px;

            margin: 0 0 2.5mm;
        }


        /*
        |--------------------------------------------------------------------------
        | STUDENT NAME
        |--------------------------------------------------------------------------
        */

        .certificate-student-name {

            color: #3376F2;

            font-family: Georgia, "Times New Roman", serif;

            font-size: 26px;

            line-height: 1.2;

            font-weight: 700;

            margin: 1mm 0 2mm;
        }


        /*
        |--------------------------------------------------------------------------
        | STUDENT NAME LINE
        |--------------------------------------------------------------------------
        */

        .certificate-line {

            width: 80mm;

            height: 1px;

            background: #cbd5e1;

            margin: 0 auto 4.5mm;
        }


        /*
        |--------------------------------------------------------------------------
        | DESCRIPTION
        |--------------------------------------------------------------------------
        */

        .certificate-description {

            width: 76%;

            margin: 0 auto;

            color: #172033;

            font-size: 9.5px;

            line-height: 1.8;

            text-align: center;
        }


        .certificate-description strong {

            color: #0F172A;

            font-weight: 700;
        }


        /*
        |--------------------------------------------------------------------------
        | DATE STRIP
        | Clean three-column date summary (no boxes), matching the web version.
        |--------------------------------------------------------------------------
        */

        .certificate-meta {

            width: 60%;

            margin: 6mm auto 0;

            display: table;

            table-layout: fixed;
        }

        .certificate-meta-row {

            display: table-row;
        }

        .certificate-meta-item {

            display: table-cell;

            width: 33.33%;

            padding: 0 4mm;

            text-align: center;

            border-left: 1px solid #e2e8f0;
        }

        .certificate-meta-item.first {

            border-left: none;
        }

        .certificate-meta-label {

            color: #64748B;

            font-size: 6.5px;

            font-weight: 700;

            text-transform: uppercase;

            letter-spacing: 1px;

            margin-bottom: 1.5mm;
        }

        .certificate-meta-value {

            color: #0F172A;

            font-size: 9.5px;

            font-weight: 700;
        }


        /*
        |--------------------------------------------------------------------------
        | FOOTER
        |--------------------------------------------------------------------------
        */

        .certificate-footer {

            width: 84%;

            margin: 5mm auto 0;
        }

        .certificate-footer table {

            width: 100%;

            border-collapse: collapse;

            table-layout: fixed;
        }

        .certificate-footer td {

            width: 33.33%;

            vertical-align: bottom;

            text-align: center;
        }


        /*
        |--------------------------------------------------------------------------
        | SIGNATURE SPACE
        |--------------------------------------------------------------------------
        */

        .signature-space {

            height: 14mm;

            text-align: center;

            vertical-align: bottom;
        }


        /*
        |--------------------------------------------------------------------------
        | COMPANY SIGNATURE
        | Uses a built-in font (DejaVu Serif italic) rather than a custom
        | @font-face. dompdf needs to convert any custom font into a .ufm
        | cache file under storage/fonts at render time, and if that folder
        | is missing/unwritable it crashes the whole PDF. Built-in fonts
        | ship pre-cached with dompdf, so this always works with zero setup.
        |--------------------------------------------------------------------------
        */

        .signature-company {

            color: #0F172A;

            font-family: "DejaVu Serif", Georgia, "Times New Roman", serif;

            font-style: italic;

            font-size: 15px;

            line-height: 1.2;

            font-weight: 700;

            white-space: nowrap;

            overflow: hidden;

            text-overflow: ellipsis;
        }


        /*
        |--------------------------------------------------------------------------
        | SIGNATURE LINE
        |--------------------------------------------------------------------------
        */

        .signature-line {

            width: 40mm;

            max-width: 100%;

            border-top: 1px solid #94a3b8;

            margin: 1.8mm auto 1.5mm;
        }


        /*
        |--------------------------------------------------------------------------
        | SIGNATURE LABEL
        |--------------------------------------------------------------------------
        */

        .signature-label {

            color: #64748B;

            font-size: 6.5px;

            font-weight: 700;

            letter-spacing: .7px;

            text-transform: uppercase;
        }


        /*
        |--------------------------------------------------------------------------
        | CENTER SEAL
        |--------------------------------------------------------------------------
        */

        .certificate-seal {

            position: relative;

            width: 23mm;

            height: 23mm;

            margin: 0 auto;

            border: 1.5px solid #3376F2;

            border-radius: 50%;

            text-align: center;
        }


        /*
        |--------------------------------------------------------------------------
        | INNER SEAL
        |--------------------------------------------------------------------------
        */

        .certificate-seal::before {

            content: "";

            position: absolute;

            top: 1.8mm;
            right: 1.8mm;
            bottom: 1.8mm;
            left: 1.8mm;

            border: 1px dashed #3376F2;

            border-radius: 50%;
        }


        /*
        |--------------------------------------------------------------------------
        | SEAL TEXT
        |--------------------------------------------------------------------------
        */

        .certificate-seal span {

            position: absolute;

            top: 7.5mm;

            left: 0;

            width: 100%;

            color: #3376F2;

            font-size: 5.8px;

            line-height: 1.35;

            font-weight: 800;

            text-transform: uppercase;
        }


        /*
        |--------------------------------------------------------------------------
        | CERTIFICATE NUMBER
        |--------------------------------------------------------------------------
        */

        .certificate-number {

            margin-top: 3mm;

            color: #64748B;

            font-size: 6.5px;

            letter-spacing: .4px;

            text-align: center;
        }


        .certificate-number strong {

            color: #0F172A;

            font-weight: 700;
        }

        /*
        |--------------------------------------------------------------------------
        | NOTE: the "completed" badge is intentionally NOT rendered here.
        | The web view's own @media print rule hides .certificate-completed,
        | so the printed/PDF output should not show it either.
        |--------------------------------------------------------------------------
        */

    </style>

</head>


<body>

@php

    /*
    |--------------------------------------------------------------------------
    | APPLICATION DATA
    |--------------------------------------------------------------------------
    */

    $student = $application->student ?? $application->user ?? null;

    $internship = $application->internship ?? null;

    $certificate = $application->certificate ?? null;


    /*
    |--------------------------------------------------------------------------
    | STUDENT
    |--------------------------------------------------------------------------
    */

    $studentName = $student?->name ?? 'Student';


    /*
    |--------------------------------------------------------------------------
    | INTERNSHIP
    |--------------------------------------------------------------------------
    */

    $internshipTitle = $internship?->title
        ?? $internship?->name
        ?? 'Internship Program';


    /*
    |--------------------------------------------------------------------------
    | COMPANY / ORGANIZATION
    |--------------------------------------------------------------------------
    */

    $companyName = $internship?->company_name
        ?? $internship?->company
        ?? $internship?->employer_name
        ?? $internship?->employer?->company_name
        ?? $internship?->employer?->name
        ?? 'Organization';


    /*
    |--------------------------------------------------------------------------
    | DATES
    |--------------------------------------------------------------------------
    */

    $startDate = $application->selected_at
        ?? $application->start_date
        ?? null;


    $completionDate = $application->completed_at
        ?? $application->end_date
        ?? null;


    /*
    |--------------------------------------------------------------------------
    | CERTIFICATE NUMBER
    |--------------------------------------------------------------------------
    */

    $certificateNumber = $certificate?->certificate_number
        ?? $certificate?->certificate_no
        ?? ('CERT-' . str_pad($application->id, 6, '0', STR_PAD_LEFT));


    /*
    |--------------------------------------------------------------------------
    | ISSUE DATE
    |--------------------------------------------------------------------------
    */

    $issueDate = $certificate?->issued_at
        ?? $certificate?->issue_date
        ?? $application->completed_at
        ?? now();


    /*
    |--------------------------------------------------------------------------
    | PERFORMANCE
    |--------------------------------------------------------------------------
    */

    $performance = $application->performance
        ? ucwords(str_replace('_', ' ', $application->performance))
        : 'Completed';


    /*
    |--------------------------------------------------------------------------
    | LOGO
    |--------------------------------------------------------------------------
    */

    $logoPath = $internship?->company_logo
        ?? $internship?->logo
        ?? null;

@endphp


<div class="certificate-page">

    <div class="certificate-card">

        <div class="certificate">


            {{-- =========================================================
                 CERTIFICATE CONTENT
            ========================================================== --}}

            <div class="certificate-content">


                {{-- =====================================================
                     COMPANY LOGO
                ====================================================== --}}

                @if($logoPath)

                    @php

                        $logoUrl = \Illuminate\Support\Str::startsWith(
                            $logoPath,
                            ['http://', 'https://']
                        )
                        ? $logoPath
                        : asset(
                            'storage/' . ltrim($logoPath, '/')
                        );

                    @endphp

                    <div class="certificate-logo">

                        <img
                            src="{{ $logoUrl }}"
                            alt="{{ $companyName }}"
                        >

                    </div>

                @endif


                {{-- =====================================================
                     CERTIFICATE OF COMPLETION
                ====================================================== --}}

                <div class="certificate-small-title">

                    Certificate of Completion

                </div>


                {{-- =====================================================
                     MAIN TITLE
                ====================================================== --}}

                <div class="certificate-title">

                    Internship Certificate

                </div>


                {{-- =====================================================
                     PRESENTED TO
                ====================================================== --}}

                <div class="certificate-subtitle">

                    This certificate is proudly presented to

                </div>


                {{-- =====================================================
                     STUDENT NAME
                ====================================================== --}}

                <div class="certificate-student-name">

                    {{ $studentName }}

                </div>


                <div class="certificate-line"></div>


                {{-- =====================================================
                     DESCRIPTION
                ====================================================== --}}

                <div class="certificate-description">

                    This is to certify that

                    <strong>
                        {{ $studentName }}
                    </strong>

                    has successfully completed the

                    <strong>
                        {{ $internshipTitle }}
                    </strong>

                    internship program with

                    <strong>
                        {{ $companyName }}
                    </strong>.

                    The internship was successfully completed
                    with the required participation and performance.

                </div>


                {{-- =====================================================
                     DATE STRIP
                     Just Start / Completion / Issued dates, matching the web version.
                ====================================================== --}}

                <div class="certificate-meta">

                    <div class="certificate-meta-row">

                        <div class="certificate-meta-item first">

                            <div class="certificate-meta-label">Start Date</div>

                            <div class="certificate-meta-value">
                                @if($startDate)
                                    {{ \Carbon\Carbon::parse($startDate)->format('d M Y') }}
                                @else
                                    —
                                @endif
                            </div>

                        </div>

                        <div class="certificate-meta-item">

                            <div class="certificate-meta-label">Completion Date</div>

                            <div class="certificate-meta-value">
                                @if($completionDate)
                                    {{ \Carbon\Carbon::parse($completionDate)->format('d M Y') }}
                                @else
                                    —
                                @endif
                            </div>

                        </div>

                        <div class="certificate-meta-item">

                            <div class="certificate-meta-label">Issued On</div>

                            <div class="certificate-meta-value">
                                {{ \Carbon\Carbon::parse($issueDate)->format('d M Y') }}
                            </div>

                        </div>

                    </div>

                </div>


                {{-- =====================================================
                     FOOTER — SIGNATURES
                     Equal 3-column layout (student | seal | organization),
                     matching the web version's grid-template-columns: 1fr 1fr 1fr
                ====================================================== --}}

                <div class="certificate-footer">

                    <table>
                        <tr>

                            {{-- STUDENT SIGNATURE --}}

                            <td>

                                <div class="signature-space"></div>

                                <div class="signature-line"></div>

                                <div class="signature-label">

                                    Student

                                </div>

                            </td>


                            {{-- CENTER SEAL --}}

                            <td>

                                <div class="certificate-seal">

                                    <span>

                                        Internship<br>

                                        Completed

                                    </span>

                                </div>

                            </td>


                            {{-- ORGANIZATION SIGNATURE --}}

                            <td>

                                <div class="signature-space">

                                    <div class="signature-company">

                                        {{ $companyName }}

                                    </div>

                                </div>

                                <div class="signature-line"></div>

                                <div class="signature-label">

                                    Authorized Organization

                                </div>

                            </td>

                        </tr>
                    </table>

                </div>


                {{-- =====================================================
                     CERTIFICATE NUMBER
                ====================================================== --}}

                <div class="certificate-number">

                    Certificate No:

                    <strong>

                        {{ $certificateNumber }}

                    </strong>

                </div>


            </div>

        </div>

    </div>

</div>

</body>

</html>