@extends('layouts.app')

@section('title', $startupProfile->startup_name . ' - Jobs')

@section('content')

<style>
    :root {
        --sj-blue: #3376F2;
        --sj-blue-dark: #245fd0;
        --sj-blue-light: #eef4ff;

        --sj-navy: #0f172a;
        --sj-text: #172033;
        --sj-muted: #64748b;
        --sj-light-muted: #94a3b8;

        --sj-border: #e2e8f0;
        --sj-bg: #f8fafc;

        --sj-green: #059669;
        --sj-green-bg: #ecfdf5;

        --sj-orange: #ea580c;
        --sj-orange-bg: #fff7ed;

        --sj-red: #dc2626;
        --sj-red-bg: #fef2f2;
    }

    * {
        box-sizing: border-box;
    }

    body {
        background: var(--sj-bg);
    }

    /* =========================================================
       PAGE
    ========================================================= */

    .startup-jobs-page {
        min-height: 100vh;
        background: var(--sj-bg);
        padding: 30px 24px 55px;
        color: var(--sj-text);
    }

    .startup-jobs-container {
        max-width: 1180px;
        margin: 0 auto;
    }

    /* =========================================================
       HEADER
    ========================================================= */

    .startup-jobs-header {
        position: relative;
        overflow: hidden;

        background: linear-gradient(
            135deg,
            #f4f7ff 0%,
            #ffffff 72%
        );

        border: 1px solid #e1e8f3;
        border-radius: 20px;

        padding: 25px;
        margin-bottom: 18px;
    }

    .startup-jobs-header::before {
        content: "";

        position: absolute;

        width: 220px;
        height: 220px;

        right: -100px;
        top: -100px;

        border-radius: 50%;

        background: rgba(51, 118, 242, .055);
    }

    .startup-jobs-header::after {
        content: "";

        position: absolute;

        width: 150px;
        height: 150px;

        right: 90px;
        bottom: -105px;

        border-radius: 50%;

        background: rgba(51, 118, 242, .035);
    }

    .startup-jobs-header-content {
        position: relative;
        z-index: 2;

        display: flex;
        align-items: center;
        justify-content: space-between;

        gap: 25px;
    }

    .startup-jobs-header-left {
        display: flex;
        align-items: center;
        gap: 16px;

        min-width: 0;
    }

    .startup-jobs-logo {
        width: 66px;
        height: 66px;

        flex: 0 0 66px;

        border-radius: 16px;

        background: var(--sj-blue-light);
        border: 1px solid #dbeafe;

        color: var(--sj-blue);

        display: flex;
        align-items: center;
        justify-content: center;

        overflow: hidden;

        font-size: 25px;
    }

    .startup-jobs-logo img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .startup-jobs-header-info {
        min-width: 0;
    }

    .startup-jobs-kicker {
        margin: 0 0 5px;

        color: var(--sj-blue);

        font-size: 9px;
        font-weight: 800;

        letter-spacing: .08em;
        text-transform: uppercase;
    }

    .startup-jobs-header-title {
        margin: 0;

        color: var(--sj-navy);

        font-size: 24px;
        line-height: 1.25;

        font-weight: 800;

        letter-spacing: -.025em;

        word-break: break-word;
    }

    .startup-jobs-header-description {
        margin: 6px 0 0;

        color: var(--sj-muted);

        font-size: 11px;
        line-height: 1.55;
    }

    .startup-jobs-header-actions {
        display: flex;
        align-items: center;
        gap: 8px;

        flex-shrink: 0;
    }

    .startup-header-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;

        gap: 7px;

        min-height: 37px;

        padding: 0 14px;

        border-radius: 10px;

        text-decoration: none;

        font-size: 10px;
        font-weight: 800;

        white-space: nowrap;

        transition: .18s ease;
    }

    .startup-header-secondary {
        background: #fff;
        color: var(--sj-muted);

        border: 1px solid var(--sj-border);
    }

    .startup-header-secondary:hover {
        color: var(--sj-blue);

        background: #f8fbff;

        border-color: #bfdbfe;
    }

    .startup-header-primary {
        background: var(--sj-blue);
        color: #fff;

        border: 1px solid var(--sj-blue);

        box-shadow: 0 5px 15px rgba(51, 118, 242, .13);
    }

    .startup-header-primary:hover {
        color: #fff;

        background: var(--sj-blue-dark);
        border-color: var(--sj-blue-dark);

        transform: translateY(-1px);
    }

    /* =========================================================
       BREADCRUMB
    ========================================================= */

    .startup-jobs-breadcrumb {
        display: flex;
        align-items: center;
        flex-wrap: wrap;

        gap: 7px;

        margin-bottom: 17px;

        font-size: 10px;
    }

    .startup-jobs-breadcrumb a {
        color: var(--sj-blue);
        text-decoration: none;
        font-weight: 700;
    }

    .startup-jobs-breadcrumb a:hover {
        color: var(--sj-blue-dark);
    }

    .startup-jobs-breadcrumb i {
        color: #cbd5e1;
        font-size: 9px;
    }

    .startup-jobs-breadcrumb-current {
        color: var(--sj-muted);
        font-weight: 600;
    }

    /* =========================================================
       SUMMARY
    ========================================================= */

    .startup-jobs-summary {
        display: grid;

        grid-template-columns: repeat(3, 1fr);

        gap: 12px;

        margin-bottom: 20px;
    }

    .startup-jobs-summary-card {
        background: #fff;

        border: 1px solid var(--sj-border);

        border-radius: 14px;

        padding: 15px;

        display: flex;
        align-items: center;

        gap: 11px;
    }

    .startup-jobs-summary-icon {
        width: 38px;
        height: 38px;

        flex: 0 0 38px;

        border-radius: 10px;

        display: flex;
        align-items: center;
        justify-content: center;

        font-size: 15px;
    }

    .summary-blue .startup-jobs-summary-icon {
        background: var(--sj-blue-light);
        color: var(--sj-blue);
    }

    .summary-green .startup-jobs-summary-icon {
        background: var(--sj-green-bg);
        color: var(--sj-green);
    }

    .summary-orange .startup-jobs-summary-icon {
        background: var(--sj-orange-bg);
        color: var(--sj-orange);
    }

    .startup-jobs-summary-number {
        display: block;

        color: var(--sj-navy);

        font-size: 17px;
        line-height: 1.1;

        font-weight: 800;
    }

    .startup-jobs-summary-label {
        display: block;

        margin-top: 3px;

        color: var(--sj-light-muted);

        font-size: 9px;
        font-weight: 600;
    }

    /* =========================================================
       SECTION HEADER
    ========================================================= */

    .startup-jobs-section-header {
        display: flex;
        align-items: center;
        justify-content: space-between;

        gap: 15px;

        margin-bottom: 13px;
    }

    .startup-jobs-section-title-wrap {
        min-width: 0;
    }

    .startup-jobs-section-title {
        margin: 0;

        color: var(--sj-navy);

        font-size: 19px;
        line-height: 1.3;

        font-weight: 800;

        letter-spacing: -.015em;
    }

    .startup-jobs-section-subtitle {
        margin: 4px 0 0;

        color: var(--sj-light-muted);

        font-size: 10px;
    }

    .startup-jobs-count {
        min-width: 32px;

        height: 28px;

        padding: 0 9px;

        border-radius: 999px;

        background: var(--sj-blue-light);
        border: 1px solid #dbeafe;

        color: var(--sj-blue);

        display: inline-flex;
        align-items: center;
        justify-content: center;

        font-size: 10px;
        font-weight: 800;
    }

    /* =========================================================
       JOB CARD
    ========================================================= */

    .startup-job-card {
        background: #fff;

        border: 1px solid #dfe6ef;

        border-radius: 16px;

        margin-bottom: 12px;

        overflow: hidden;

        transition: .2s ease;
    }

    .startup-job-card:hover {
        border-color: #cbd9ee;

        box-shadow: 0 8px 24px rgba(15, 23, 42, .045);
    }

    .startup-job-card-inner {
        padding: 17px 18px;
    }

    .startup-job-top {
        display: flex;

        align-items: flex-start;
        justify-content: space-between;

        gap: 18px;
    }

    .startup-job-main {
        min-width: 0;
        flex: 1;
    }

    .startup-job-title-row {
        display: flex;
        align-items: center;

        flex-wrap: wrap;

        gap: 7px;

        margin-bottom: 8px;
    }

    .startup-job-title {
        margin: 0;

        color: var(--sj-navy);

        font-size: 16px;
        line-height: 1.35;

        font-weight: 800;

        word-break: break-word;
    }

    /* =========================================================
       STARTUP BADGE
    ========================================================= */

    .startup-job-badge {
        display: inline-flex;
        align-items: center;

        gap: 4px;

        padding: 5px 8px;

        border-radius: 999px;

        background: var(--sj-blue-light);

        border: 1px solid #dbeafe;

        color: var(--sj-blue);

        font-size: 8px;
        line-height: 1;

        font-weight: 800;

        white-space: nowrap;
    }

    .startup-job-badge i {
        font-size: 8px;
    }

    /* =========================================================
       META
    ========================================================= */

    .startup-job-meta {
        display: flex;

        align-items: center;

        flex-wrap: wrap;

        gap: 11px;

        color: var(--sj-muted);

        font-size: 10px;
    }

    .startup-job-meta-item {
        display: inline-flex;

        align-items: center;

        gap: 5px;
    }

    .startup-job-meta-item i {
        color: #94a3b8;

        font-size: 10px;
    }

    /* =========================================================
       DESCRIPTION
    ========================================================= */

    .startup-job-description {
        margin: 12px 0 0;

        color: var(--sj-muted);

        font-size: 11px;

        line-height: 1.7;
    }

    /* =========================================================
       STATUS
    ========================================================= */

    .startup-job-status {
        display: inline-flex;

        align-items: center;

        gap: 6px;

        padding: 6px 10px;

        border-radius: 999px;

        font-size: 9px;

        line-height: 1;

        font-weight: 800;

        white-space: nowrap;
    }

    .startup-job-status-active {
        background: var(--sj-green-bg);
        color: #047857;
    }

    .startup-job-status-inactive {
        background: #f1f5f9;
        color: #64748b;
    }

    .startup-job-status-closed {
        background: var(--sj-red-bg);
        color: #b91c1c;
    }

    .startup-job-status-pending {
        background: var(--sj-orange-bg);
        color: #c2410c;
    }

    .startup-job-status-dot {
        width: 6px;
        height: 6px;

        border-radius: 50%;

        background: currentColor;
    }

    /* =========================================================
       DETAILS
    ========================================================= */

    .startup-job-details {
        display: grid;

        grid-template-columns: repeat(4, 1fr);

        gap: 8px;

        margin-top: 15px;

        padding-top: 13px;

        border-top: 1px solid #f1f5f9;
    }

    .startup-job-detail {
        background: #f8fafc;

        border-radius: 10px;

        padding: 9px 10px;
    }

    .startup-job-detail-label {
        display: block;

        margin-bottom: 3px;

        color: #94a3b8;

        font-size: 8px;

        font-weight: 700;

        text-transform: uppercase;

        letter-spacing: .03em;
    }

    .startup-job-detail-value {
        display: block;

        color: var(--sj-text);

        font-size: 10px;

        line-height: 1.4;

        font-weight: 700;

        word-break: break-word;
    }

    /* =========================================================
       FOOTER
    ========================================================= */

    .startup-job-footer {
        display: flex;

        align-items: center;

        justify-content: space-between;

        gap: 12px;

        margin-top: 13px;
    }

    .startup-job-updated {
        color: #94a3b8;

        font-size: 9px;
    }

    .startup-job-actions {
        display: flex;

        align-items: center;

        gap: 7px;
    }

    .startup-job-view-btn {
        min-height: 30px;

        padding: 0 11px;

        border-radius: 8px;

        display: inline-flex;

        align-items: center;

        justify-content: center;

        gap: 6px;

        color: var(--sj-blue);

        background: var(--sj-blue-light);

        border: 1px solid #dbeafe;

        font-size: 9px;

        font-weight: 700;

        cursor: pointer;

        transition: .18s ease;
    }

    .startup-job-view-btn:hover {
        color: #1d4ed8;

        background: #dbeafe;
    }

    .startup-job-create-btn {
        min-height: 30px;

        padding: 0 11px;

        border-radius: 8px;

        display: inline-flex;

        align-items: center;

        justify-content: center;

        gap: 6px;

        color: #fff;

        background: var(--sj-blue);

        border: 1px solid var(--sj-blue);

        text-decoration: none;

        font-size: 9px;

        font-weight: 700;

        transition: .18s ease;
    }

    .startup-job-create-btn:hover {
        color: #fff;

        background: var(--sj-blue-dark);

        border-color: var(--sj-blue-dark);
    }

    /* =========================================================
       EMPTY
    ========================================================= */

    .startup-jobs-empty {
        background: #fff;

        border: 1px solid var(--sj-border);

        border-radius: 17px;

        padding: 55px 25px;

        text-align: center;
    }

    .startup-jobs-empty-icon {
        width: 60px;
        height: 60px;

        margin: 0 auto 15px;

        border-radius: 16px;

        background: var(--sj-blue-light);
        color: var(--sj-blue);

        display: flex;

        align-items: center;
        justify-content: center;

        font-size: 24px;
    }

    .startup-jobs-empty h3 {
        margin: 0 0 7px;

        color: var(--sj-navy);

        font-size: 18px;

        font-weight: 800;
    }

    .startup-jobs-empty p {
        max-width: 450px;

        margin: 0 auto 19px;

        color: var(--sj-light-muted);

        font-size: 11px;

        line-height: 1.65;
    }

    .startup-empty-btn {
        display: inline-flex;

        align-items: center;
        justify-content: center;

        gap: 7px;

        min-height: 35px;

        padding: 0 15px;

        border-radius: 9px;

        background: var(--sj-blue);

        color: #fff;

        text-decoration: none;

        font-size: 10px;

        font-weight: 800;
    }

    .startup-empty-btn:hover {
        color: #fff;

        background: var(--sj-blue-dark);
    }

    /* =========================================================
       PAGINATION
    ========================================================= */

    .startup-jobs-pagination {
        margin-top: 18px;

        display: flex;

        justify-content: center;
    }

    .startup-jobs-pagination nav {
        width: 100%;
    }

    .startup-jobs-pagination svg {
        width: 15px;
        height: 15px;
    }

    /* =========================================================
       POPUP OVERLAY
    ========================================================= */

    .startup-job-popup-overlay {
        position: fixed;

        inset: 0;

        background: rgba(15, 23, 42, .60);

        display: none;

        align-items: center;

        justify-content: center;

        padding: 20px;

        z-index: 9999;

        backdrop-filter: blur(3px);
    }

    .startup-job-popup-overlay.show {
        display: flex;
    }

    /* =========================================================
       POPUP
    ========================================================= */

    .startup-job-popup {
        width: 100%;

        max-width: 900px;

        max-height: 92vh;

        background: #fff;

        border-radius: 20px;

        overflow: hidden;

        box-shadow: 0 25px 70px rgba(15, 23, 42, .25);

        animation: startupJobPopupIn .2s ease;
    }

    @keyframes startupJobPopupIn {

        from {
            opacity: 0;
            transform: translateY(15px) scale(.98);
        }

        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }

    }

    /* =========================================================
       POPUP HEADER
    ========================================================= */

    .startup-job-popup-header {
        padding: 21px 25px;

        border-bottom: 1px solid var(--sj-border);

        display: flex;

        align-items: flex-start;

        justify-content: space-between;

        gap: 18px;
    }

    .startup-job-popup-header-left {
        display: flex;

        align-items: flex-start;

        gap: 13px;

        min-width: 0;
    }

    .startup-job-popup-icon {
        width: 50px;
        height: 50px;

        flex: 0 0 50px;

        border-radius: 13px;

        background: var(--sj-blue-light);

        color: var(--sj-blue);

        display: flex;

        align-items: center;

        justify-content: center;

        font-size: 21px;
    }

    .startup-job-popup-info {
        min-width: 0;
    }

    .startup-job-popup-title {
        margin: 0 0 5px;

        color: var(--sj-navy);

        font-size: 21px;

        line-height: 1.3;

        font-weight: 800;

        word-break: break-word;
    }

    .startup-job-popup-company {
        margin: 0;

        color: var(--sj-muted);

        font-size: 11px;
    }

    .startup-job-popup-close {
        width: 36px;
        height: 36px;

        flex: 0 0 36px;

        border: 0;

        border-radius: 9px;

        background: #f1f5f9;

        color: #64748b;

        cursor: pointer;

        display: flex;

        align-items: center;

        justify-content: center;

        font-size: 15px;

        transition: .18s ease;
    }

    .startup-job-popup-close:hover {
        background: #e2e8f0;

        color: var(--sj-navy);
    }

    /* =========================================================
       POPUP BODY
    ========================================================= */

    .startup-job-popup-body {
        padding: 22px 25px;

        max-height: calc(92vh - 135px);

        overflow-y: auto;
    }

    /* =========================================================
       POPUP DETAILS
    ========================================================= */

    .startup-job-popup-details {
        display: grid;

        grid-template-columns: repeat(2, minmax(0, 1fr));

        gap: 10px;

        margin-bottom: 23px;
    }

    .startup-job-popup-detail {
        background: #f8fafc;

        border: 1px solid #edf1f6;

        border-radius: 11px;

        padding: 12px 14px;
    }

    .startup-job-popup-detail-label {
        display: block;

        margin-bottom: 4px;

        color: #94a3b8;

        font-size: 8px;

        font-weight: 700;

        text-transform: uppercase;

        letter-spacing: .05em;
    }

    .startup-job-popup-detail-value {
        display: block;

        color: var(--sj-navy);

        font-size: 11px;

        line-height: 1.4;

        font-weight: 700;

        word-break: break-word;
    }

    /* =========================================================
       POPUP SECTION
    ========================================================= */

    .startup-job-popup-section {
        margin-bottom: 22px;
    }

    .startup-job-popup-section:last-child {
        margin-bottom: 0;
    }

    .startup-job-popup-section-title {
        margin: 0 0 9px;

        color: var(--sj-navy);

        font-size: 14px;

        font-weight: 800;
    }

    .startup-job-popup-section-content {
        color: #5f6b7d;

        font-size: 11px;

        line-height: 1.75;

        white-space: pre-line;
    }

    /* =========================================================
       SKILLS
    ========================================================= */

    .startup-job-popup-skills {
        display: flex;

        flex-wrap: wrap;

        gap: 7px;
    }

    .startup-job-popup-skill {
        display: inline-flex;

        align-items: center;

        padding: 6px 9px;

        border-radius: 7px;

        background: var(--sj-blue-light);

        color: var(--sj-blue);

        font-size: 9px;

        font-weight: 700;
    }

    /* =========================================================
       POPUP FOOTER
    ========================================================= */

    .startup-job-popup-footer {
        padding: 15px 25px;

        border-top: 1px solid var(--sj-border);

        display: flex;

        align-items: center;

        justify-content: space-between;

        gap: 10px;
    }

    .startup-job-popup-footer-left {
        color: #94a3b8;

        font-size: 9px;
    }

    .startup-job-popup-footer-right {
        display: flex;

        gap: 8px;
    }

    .startup-job-popup-footer-btn {
        min-height: 33px;

        padding: 0 13px;

        border-radius: 8px;

        display: inline-flex;

        align-items: center;

        justify-content: center;

        gap: 6px;

        font-size: 9px;

        font-weight: 700;

        cursor: pointer;

        text-decoration: none;
    }

    .popup-close-btn {
        border: none;

        background: #f1f5f9;

        color: #475569;
    }

    .popup-close-btn:hover {
        background: #e2e8f0;

        color: var(--sj-navy);
    }

    /* =========================================================
       MOBILE
    ========================================================= */

    @media (max-width: 900px) {

        .startup-jobs-header-content {
            flex-direction: column;
            align-items: flex-start;
        }

        .startup-jobs-header-actions {
            width: 100%;
        }

        .startup-header-btn {
            flex: 1;
        }

        .startup-job-details {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 700px) {

        .startup-jobs-page {
            padding-left: 16px;
            padding-right: 16px;
        }

        .startup-jobs-summary {
            grid-template-columns: 1fr;
        }

        .startup-jobs-header-left {
            align-items: flex-start;
        }

        .startup-jobs-logo {
            width: 55px;
            height: 55px;

            flex-basis: 55px;

            border-radius: 13px;

            font-size: 21px;
        }

        .startup-jobs-header-title {
            font-size: 20px;
        }

        .startup-jobs-header-actions {
            flex-direction: column;

            width: 100%;
        }

        .startup-header-btn {
            width: 100%;
            flex: none;
        }

        .startup-job-top {
            flex-direction: column;

            gap: 10px;
        }

        .startup-job-status {
            align-self: flex-start;
        }

        .startup-job-footer {
            align-items: flex-start;

            flex-direction: column;
        }

        .startup-job-actions {
            width: 100%;
        }

        .startup-job-view-btn,
        .startup-job-create-btn {
            flex: 1;
        }

        .startup-job-popup-overlay {
            padding: 10px;
        }

        .startup-job-popup {
            max-height: 95vh;

            border-radius: 15px;
        }

        .startup-job-popup-header {
            padding: 17px;
        }

        .startup-job-popup-body {
            padding: 18px;
        }

        .startup-job-popup-footer {
            padding: 14px 18px;
        }

        .startup-job-popup-details {
            grid-template-columns: 1fr;
        }

        .startup-job-popup-title {
            font-size: 18px;
        }
    }

    @media (max-width: 500px) {

        .startup-jobs-header {
            padding: 18px;
        }

        .startup-job-details {
            grid-template-columns: 1fr;
        }

        .startup-job-actions {
            flex-direction: column;
        }

        .startup-job-view-btn,
        .startup-job-create-btn {
            width: 100%;
            flex: none;
        }

        .startup-job-title {
            font-size: 15px;
        }

        .startup-job-meta {
            gap: 8px 11px;
        }

        .startup-job-popup-footer {
            flex-direction: column;

            align-items: stretch;
        }

        .startup-job-popup-footer-right {
            width: 100%;
        }

        .startup-job-popup-footer-btn {
            flex: 1;
        }
    }
</style>


<div class="startup-jobs-page">

    <div class="startup-jobs-container">


        {{-- =====================================================
             HEADER
        ====================================================== --}}

        <section class="startup-jobs-header">

            <div class="startup-jobs-header-content">


                {{-- LEFT --}}

                <div class="startup-jobs-header-left">


                    {{-- LOGO --}}

                    <div class="startup-jobs-logo">

                        @if($startupProfile->logo)

                            <img
                                src="{{ asset('storage/' . $startupProfile->logo) }}"
                                alt="{{ $startupProfile->startup_name }}"
                            >

                        @else

                            <i class="bi bi-rocket-takeoff-fill"></i>

                        @endif

                    </div>


                    {{-- INFO --}}

                    <div class="startup-jobs-header-info">

                        <p class="startup-jobs-kicker">
                            Startup Job Opportunities
                        </p>

                        <h1 class="startup-jobs-header-title">
                            {{ $startupProfile->startup_name }}
                        </h1>

                        @if($startupProfile->tagline)

                            <p class="startup-jobs-header-description">
                                {{ $startupProfile->tagline }}
                            </p>

                        @else

                            <p class="startup-jobs-header-description">
                                Manage jobs connected to this startup profile.
                            </p>

                        @endif

                    </div>

                </div>


                {{-- ACTIONS --}}

                <div class="startup-jobs-header-actions">


                    <a
                        href="{{ route('employer.startup-profile.index') }}"
                        class="startup-header-btn startup-header-secondary"
                    >

                        <i class="bi bi-arrow-left"></i>

                        Startup Profiles

                    </a>


                    <a
                        href="{{ route('employer.jobs.create', [
                            'startup_profile_id' => $startupProfile->id
                        ]) }}"
                        class="startup-header-btn startup-header-primary"
                    >

                        <i class="bi bi-plus-lg"></i>

                        Create Job

                    </a>

                </div>

            </div>

        </section>


        {{-- =====================================================
             BREADCRUMB
        ====================================================== --}}

        <div class="startup-jobs-breadcrumb">

            <a href="{{ route('employer.startup-profile.index') }}">
                Startup Profiles
            </a>

            <i class="bi bi-chevron-right"></i>

            <span class="startup-jobs-breadcrumb-current">
                {{ $startupProfile->startup_name }}
            </span>

            <i class="bi bi-chevron-right"></i>

            <span class="startup-jobs-breadcrumb-current">
                Jobs
            </span>

        </div>


        {{-- =====================================================
             SUMMARY
        ====================================================== --}}

        @php

            $totalJobs = method_exists($jobs, 'total')
                ? $jobs->total()
                : $jobs->count();

            $activeJobs = $jobs->filter(function ($job) {
                return (bool) $job->is_active;
            })->count();

            $currentPageJobs = $jobs->count();

        @endphp


        <div class="startup-jobs-summary">


            {{-- TOTAL --}}

            <div class="startup-jobs-summary-card summary-blue">

                <span class="startup-jobs-summary-icon">

                    <i class="bi bi-briefcase"></i>

                </span>

                <div>

                    <span class="startup-jobs-summary-number">
                        {{ $totalJobs }}
                    </span>

                    <span class="startup-jobs-summary-label">
                        Total Jobs
                    </span>

                </div>

            </div>


            {{-- ACTIVE --}}

            <div class="startup-jobs-summary-card summary-green">

                <span class="startup-jobs-summary-icon">

                    <i class="bi bi-check-circle"></i>

                </span>

                <div>

                    <span class="startup-jobs-summary-number">
                        {{ $activeJobs }}
                    </span>

                    <span class="startup-jobs-summary-label">
                        Active on This Page
                    </span>

                </div>

            </div>


            {{-- CURRENT PAGE --}}

            <div class="startup-jobs-summary-card summary-orange">

                <span class="startup-jobs-summary-icon">

                    <i class="bi bi-list-ul"></i>

                </span>

                <div>

                    <span class="startup-jobs-summary-number">
                        {{ $currentPageJobs }}
                    </span>

                    <span class="startup-jobs-summary-label">
                        Current Page
                    </span>

                </div>

            </div>

        </div>


        {{-- =====================================================
             SECTION HEADER
        ====================================================== --}}

        <div class="startup-jobs-section-header">

            <div class="startup-jobs-section-title-wrap">

                <h2 class="startup-jobs-section-title">
                    Job Openings
                </h2>

                <p class="startup-jobs-section-subtitle">
                    Jobs created specifically for
                    {{ $startupProfile->startup_name }}
                </p>

            </div>


            <span class="startup-jobs-count">

                {{ $totalJobs }}

            </span>

        </div>


        {{-- =====================================================
             JOB LIST
        ====================================================== --}}

        @forelse($jobs as $job)

            @php

                $jobStatus = $job->is_active
                    ? 'active'
                    : 'inactive';

                $statusClass = $jobStatus === 'active'
                    ? 'startup-job-status-active'
                    : 'startup-job-status-inactive';

                $statusLabel = $jobStatus === 'active'
                    ? 'Active'
                    : 'Inactive';

                $locationParts = array_filter([
                    $job->city,
                    $job->district,
                    $job->state,
                    $job->country,
                ]);

                $location = implode(', ', $locationParts);

                $employmentType = str_replace(
                    '-',
                    ' ',
                    (string) $job->employment_type
                );

                $workMode = str_replace(
                    '_',
                    ' ',
                    (string) $job->work_mode
                );

                $experience = trim(
                    (string) $job->experience
                );

                $salary = trim(
                    (string) $job->salary
                );

                $qualification = trim(
                    (string) $job->qualification
                );

                $description = trim(
                    (string) $job->description
                );

                $skills = is_array($job->skills)
                    ? $job->skills
                    : (
                        $job->skills
                            ? array_filter(
                                array_map(
                                    'trim',
                                    explode(',', (string) $job->skills)
                                )
                            )
                            : []
                    );

            @endphp


            <article class="startup-job-card">

                <div class="startup-job-card-inner">


                    {{-- =================================================
                         TOP
                    ================================================== --}}

                    <div class="startup-job-top">


                        <div class="startup-job-main">


                            <div class="startup-job-title-row">

                                <h3 class="startup-job-title">
                                    {{ $job->title }}
                                </h3>


                                <span class="startup-job-badge">

                                    <i class="bi bi-rocket-takeoff"></i>

                                    Startup Job

                                </span>

                            </div>


                            {{-- META --}}

                            <div class="startup-job-meta">


                                @if($employmentType !== '')

                                    <span class="startup-job-meta-item">

                                        <i class="bi bi-briefcase"></i>

                                        {{ ucwords($employmentType) }}

                                    </span>

                                @endif


                                @if($workMode !== '')

                                    <span class="startup-job-meta-item">

                                        <i class="bi bi-laptop"></i>

                                        {{ ucwords($workMode) }}

                                    </span>

                                @endif


                                @if($location !== '')

                                    <span class="startup-job-meta-item">

                                        <i class="bi bi-geo-alt"></i>

                                        {{ $location }}

                                    </span>

                                @endif


                                @if($experience !== '')

                                    <span class="startup-job-meta-item">

                                        <i class="bi bi-person-workspace"></i>

                                        {{ $experience }}

                                    </span>

                                @endif

                            </div>


                            {{-- DESCRIPTION --}}

                            @if($description !== '')

                                <p class="startup-job-description">

                                    {{ \Illuminate\Support\Str::limit(
                                        strip_tags($description),
                                        280
                                    ) }}

                                </p>

                            @endif

                        </div>


                        {{-- STATUS --}}

                        <span class="startup-job-status {{ $statusClass }}">

                            <span class="startup-job-status-dot"></span>

                            {{ $statusLabel }}

                        </span>

                    </div>


                    {{-- =================================================
                         DETAILS
                    ================================================== --}}

                    <div class="startup-job-details">


                        {{-- SALARY --}}

                        <div class="startup-job-detail">

                            <span class="startup-job-detail-label">
                                Salary
                            </span>

                            <span class="startup-job-detail-value">

                                {{ $salary !== '' ? $salary : 'Not specified' }}

                            </span>

                        </div>


                        {{-- EXPERIENCE --}}

                        <div class="startup-job-detail">

                            <span class="startup-job-detail-label">
                                Experience
                            </span>

                            <span class="startup-job-detail-value">

                                {{ $experience !== '' ? $experience : 'Not specified' }}

                            </span>

                        </div>


                        {{-- QUALIFICATION --}}

                        <div class="startup-job-detail">

                            <span class="startup-job-detail-label">
                                Qualification
                            </span>

                            <span class="startup-job-detail-value">

                                {{
                                    $qualification !== ''
                                        ? \Illuminate\Support\Str::limit($qualification, 55)
                                        : 'Not specified'
                                }}

                            </span>

                        </div>


                        {{-- DEADLINE --}}

                        <div class="startup-job-detail">

                            <span class="startup-job-detail-label">
                                Deadline
                            </span>

                            <span class="startup-job-detail-value">

                                @if($job->expires_at)

                                    {{ $job->expires_at->format('d M Y') }}

                                @else

                                    No deadline

                                @endif

                            </span>

                        </div>

                    </div>


                    {{-- =================================================
                         FOOTER
                    ================================================== --}}

                    <div class="startup-job-footer">


                        <span class="startup-job-updated">

                            @if($job->updated_at)

                                Updated
                                {{ $job->updated_at->diffForHumans() }}

                            @else

                                Recently created

                            @endif

                        </span>


                        <div class="startup-job-actions">


                            {{-- VIEW --}}

                            <button
                                type="button"
                                class="startup-job-view-btn"
                                onclick="openStartupJobPopup({{ $job->id }})"
                            >

                                <i class="bi bi-eye"></i>

                                View Job

                            </button>


                            {{-- CREATE ANOTHER --}}

                            <a
                                href="{{ route('employer.jobs.create', [
                                    'startup_profile_id' => $startupProfile->id
                                ]) }}"
                                class="startup-job-create-btn"
                            >

                                <i class="bi bi-plus-lg"></i>

                                Create Another

                            </a>

                        </div>

                    </div>


                </div>

            </article>


            {{-- =====================================================
                 HIDDEN JOB DATA
            ====================================================== --}}

            <div
                id="startup-job-data-{{ $job->id }}"
                style="display:none;"
            >

                <div
                    data-title="{{ e((string) $job->title) }}"
                    data-employment-type="{{ e((string) ($job->employment_type ?? '')) }}"
                    data-work-mode="{{ e((string) ($job->work_mode ?? '')) }}"
                    data-experience="{{ e((string) ($job->experience ?? '')) }}"
                    data-salary="{{ e((string) ($job->salary ?? '')) }}"
                    data-qualification="{{ e((string) ($job->qualification ?? '')) }}"
                    data-location="{{ e($location) }}"
                    data-description="{{ e((string) ($job->description ?? '')) }}"
                    data-skills="{{ e(implode(', ', $skills)) }}"
                    data-expires-at="{{ $job->expires_at ? $job->expires_at->format('d M Y') : '' }}"
                    data-active="{{ $job->is_active ? '1' : '0' }}"
                ></div>

            </div>

        @empty


            {{-- =====================================================
                 EMPTY
            ====================================================== --}}

            <div class="startup-jobs-empty">

                <div class="startup-jobs-empty-icon">

                    <i class="bi bi-briefcase"></i>

                </div>


                <h3>
                    No Jobs Yet
                </h3>


                <p>

                    There are currently no jobs connected to
                    <strong>{{ $startupProfile->startup_name }}</strong>.

                    Create your first job to connect a position directly
                    to this startup profile.

                </p>


                <a
                    href="{{ route('employer.jobs.create', [
                        'startup_profile_id' => $startupProfile->id
                    ]) }}"
                    class="startup-empty-btn"
                >

                    <i class="bi bi-plus-lg"></i>

                    Create First Job

                </a>

            </div>

        @endforelse


        {{-- =====================================================
             PAGINATION
        ====================================================== --}}

        @if(method_exists($jobs, 'hasPages') && $jobs->hasPages())

            <div class="startup-jobs-pagination">

                {{ $jobs->withQueryString()->links() }}

            </div>

        @endif

    </div>

</div>


{{-- =============================================================
     JOB POPUP
============================================================= --}}

<div
    id="startupJobPopupOverlay"
    class="startup-job-popup-overlay"
    onclick="closeStartupJobPopupFromOverlay(event)"
>


    <div
        class="startup-job-popup"
        onclick="event.stopPropagation()"
    >


        {{-- =====================================================
             POPUP HEADER
        ====================================================== --}}

        <div class="startup-job-popup-header">


            <div class="startup-job-popup-header-left">


                <div class="startup-job-popup-icon">

                    <i class="bi bi-briefcase"></i>

                </div>


                <div class="startup-job-popup-info">

                    <h2
                        id="startupPopupJobTitle"
                        class="startup-job-popup-title"
                    >
                        Job Details
                    </h2>


                    <p class="startup-job-popup-company">

                        {{ $startupProfile->startup_name }}

                    </p>

                </div>

            </div>


            <button
                type="button"
                class="startup-job-popup-close"
                onclick="closeStartupJobPopup()"
                aria-label="Close"
            >

                <i class="bi bi-x-lg"></i>

            </button>

        </div>


        {{-- =====================================================
             POPUP BODY
        ====================================================== --}}

        <div class="startup-job-popup-body">


            {{-- DETAILS --}}

            <div class="startup-job-popup-details">


                <div class="startup-job-popup-detail">

                    <span class="startup-job-popup-detail-label">
                        Employment Type
                    </span>

                    <span
                        id="startupPopupEmploymentType"
                        class="startup-job-popup-detail-value"
                    >
                        Not specified
                    </span>

                </div>


                <div class="startup-job-popup-detail">

                    <span class="startup-job-popup-detail-label">
                        Work Mode
                    </span>

                    <span
                        id="startupPopupWorkMode"
                        class="startup-job-popup-detail-value"
                    >
                        Not specified
                    </span>

                </div>


                <div class="startup-job-popup-detail">

                    <span class="startup-job-popup-detail-label">
                        Experience
                    </span>

                    <span
                        id="startupPopupExperience"
                        class="startup-job-popup-detail-value"
                    >
                        Not specified
                    </span>

                </div>


                <div class="startup-job-popup-detail">

                    <span class="startup-job-popup-detail-label">
                        Salary
                    </span>

                    <span
                        id="startupPopupSalary"
                        class="startup-job-popup-detail-value"
                    >
                        Not specified
                    </span>

                </div>


                <div class="startup-job-popup-detail">

                    <span class="startup-job-popup-detail-label">
                        Qualification
                    </span>

                    <span
                        id="startupPopupQualification"
                        class="startup-job-popup-detail-value"
                    >
                        Not specified
                    </span>

                </div>


                <div class="startup-job-popup-detail">

                    <span class="startup-job-popup-detail-label">
                        Location
                    </span>

                    <span
                        id="startupPopupLocation"
                        class="startup-job-popup-detail-value"
                    >
                        Not specified
                    </span>

                </div>


                <div class="startup-job-popup-detail">

                    <span class="startup-job-popup-detail-label">
                        Deadline
                    </span>

                    <span
                        id="startupPopupDeadline"
                        class="startup-job-popup-detail-value"
                    >
                        No deadline
                    </span>

                </div>


                <div class="startup-job-popup-detail">

                    <span class="startup-job-popup-detail-label">
                        Status
                    </span>

                    <span
                        id="startupPopupStatus"
                        class="startup-job-popup-detail-value"
                    >
                        Inactive
                    </span>

                </div>

            </div>


            {{-- =================================================
                 SKILLS
            ================================================== --}}

            <div
                id="startupPopupSkillsSection"
                class="startup-job-popup-section"
                style="display:none;"
            >

                <h3 class="startup-job-popup-section-title">
                    Skills
                </h3>


                <div
                    id="startupPopupSkills"
                    class="startup-job-popup-skills"
                ></div>

            </div>


            {{-- =================================================
                 DESCRIPTION
            ================================================== --}}

            <div class="startup-job-popup-section">

                <h3 class="startup-job-popup-section-title">
                    Job Description
                </h3>


                <div
                    id="startupPopupDescription"
                    class="startup-job-popup-section-content"
                >
                    No job description available.
                </div>

            </div>

        </div>


        {{-- =====================================================
             POPUP FOOTER
        ====================================================== --}}

        <div class="startup-job-popup-footer">


            <div class="startup-job-popup-footer-left">

                {{ $startupProfile->startup_name }}

            </div>


            <div class="startup-job-popup-footer-right">

                <button
                    type="button"
                    class="startup-job-popup-footer-btn popup-close-btn"
                    onclick="closeStartupJobPopup()"
                >

                    Close

                </button>

            </div>

        </div>

    </div>

</div>


<script>

    /* =========================================================
       OPEN JOB POPUP
    ========================================================= */

    function openStartupJobPopup(jobId)
    {
        const dataContainer = document.querySelector(
            '#startup-job-data-' + jobId + ' > div'
        );

        if (!dataContainer) {
            return;
        }

        const data = dataContainer.dataset;


        /* -----------------------------------------------------
           TITLE
        ----------------------------------------------------- */

        document.getElementById(
            'startupPopupJobTitle'
        ).textContent =
            data.title || 'Job Details';


        /* -----------------------------------------------------
           EMPLOYMENT TYPE
        ----------------------------------------------------- */

        document.getElementById(
            'startupPopupEmploymentType'
        ).textContent =
            formatStartupJobText(data.employmentType);


        /* -----------------------------------------------------
           WORK MODE
        ----------------------------------------------------- */

        document.getElementById(
            'startupPopupWorkMode'
        ).textContent =
            formatStartupJobText(data.workMode);


        /* -----------------------------------------------------
           EXPERIENCE
        ----------------------------------------------------- */

        document.getElementById(
            'startupPopupExperience'
        ).textContent =
            data.experience || 'Not specified';


        /* -----------------------------------------------------
           SALARY
        ----------------------------------------------------- */

        document.getElementById(
            'startupPopupSalary'
        ).textContent =
            data.salary || 'Not specified';


        /* -----------------------------------------------------
           QUALIFICATION
        ----------------------------------------------------- */

        document.getElementById(
            'startupPopupQualification'
        ).textContent =
            data.qualification || 'Not specified';


        /* -----------------------------------------------------
           LOCATION
        ----------------------------------------------------- */

        document.getElementById(
            'startupPopupLocation'
        ).textContent =
            data.location || 'Not specified';


        /* -----------------------------------------------------
           DEADLINE
        ----------------------------------------------------- */

        document.getElementById(
            'startupPopupDeadline'
        ).textContent =
            data.expiresAt || 'No deadline';


        /* -----------------------------------------------------
           STATUS
        ----------------------------------------------------- */

        document.getElementById(
            'startupPopupStatus'
        ).textContent =
            data.active === '1'
                ? 'Active'
                : 'Inactive';


        /* -----------------------------------------------------
           DESCRIPTION
        ----------------------------------------------------- */

        document.getElementById(
            'startupPopupDescription'
        ).textContent =
            data.description || 'No job description available.';


        /* -----------------------------------------------------
           SKILLS
        ----------------------------------------------------- */

        const skillsSection =
            document.getElementById(
                'startupPopupSkillsSection'
            );

        const skillsContainer =
            document.getElementById(
                'startupPopupSkills'
            );

        skillsContainer.innerHTML = '';


        if (data.skills) {

            const skills = data.skills
                .split(',')
                .map(function(skill) {
                    return skill.trim();
                })
                .filter(Boolean);


            if (skills.length) {

                skills.forEach(function(skill) {

                    const span =
                        document.createElement('span');

                    span.className =
                        'startup-job-popup-skill';

                    span.textContent =
                        skill;

                    skillsContainer.appendChild(span);

                });

                skillsSection.style.display =
                    'block';

            } else {

                skillsSection.style.display =
                    'none';

            }

        } else {

            skillsSection.style.display =
                'none';

        }


        /* -----------------------------------------------------
           SHOW POPUP
        ----------------------------------------------------- */

        const popup =
            document.getElementById(
                'startupJobPopupOverlay'
            );

        popup.classList.add('show');

        document.body.style.overflow = 'hidden';
    }


    /* =========================================================
       CLOSE POPUP
    ========================================================= */

    function closeStartupJobPopup()
    {
        const popup =
            document.getElementById(
                'startupJobPopupOverlay'
            );

        popup.classList.remove('show');

        document.body.style.overflow = '';
    }


    /* =========================================================
       CLOSE OVERLAY
    ========================================================= */

    function closeStartupJobPopupFromOverlay(event)
    {
        if (
            event.target.id ===
            'startupJobPopupOverlay'
        ) {
            closeStartupJobPopup();
        }
    }


    /* =========================================================
       ESC KEY
    ========================================================= */

    document.addEventListener(
        'keydown',
        function(event) {

            if (event.key === 'Escape') {

                closeStartupJobPopup();

            }

        }
    );


    /* =========================================================
       FORMAT TEXT
    ========================================================= */

    function formatStartupJobText(value)
    {
        if (!value) {
            return 'Not specified';
        }

        return value
            .replace(/-/g, ' ')
            .replace(/_/g, ' ')
            .replace(/\b\w/g, function(letter) {
                return letter.toUpperCase();
            });
    }

</script>

@endsection