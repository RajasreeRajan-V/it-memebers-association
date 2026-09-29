@extends('layouts.app')

@section('title', $profile->startup_name . ' - Startup Profile')

@section('content')

<style>
    :root {
        --sp-primary: #4f8df7;
        --sp-primary-hover: #3b7bea;
        --sp-primary-soft: #eff6ff;
        --sp-primary-soft-2: #f5f9ff;

        --sp-cyan: #22b8cf;
        --sp-cyan-soft: #ecfeff;

        --sp-purple: #8b7cf6;
        --sp-purple-soft: #f5f3ff;

        --sp-green: #10b981;
        --sp-green-soft: #ecfdf5;

        --sp-orange: #f59e0b;
        --sp-orange-soft: #fff8e7;

        --sp-red: #ef4444;
        --sp-red-soft: #fef2f2;

        --sp-text: #334155;
        --sp-heading: #1e293b;
        --sp-muted: #7b8798;
        --sp-light-muted: #a0aabd;

        --sp-border: #e7edf5;
        --sp-border-light: #eef2f7;

        --sp-bg: #f8fafc;
        --sp-white: #ffffff;
    }

    * {
        box-sizing: border-box;
    }

    body {
        background: var(--sp-bg);
    }

    /* =========================================================
       PAGE
    ========================================================= */

    .sp-show-page {
        min-height: 100vh;
        background:
            radial-gradient(
                circle at 10% 0%,
                rgba(219, 234, 254, .45),
                transparent 28%
            ),
            radial-gradient(
                circle at 100% 12%,
                rgba(224, 231, 255, .35),
                transparent 24%
            ),
            #f8fafc;

        padding-bottom: 65px;
    }

    .sp-container {
        width: min(1180px, calc(100% - 32px));
        margin: 0 auto;
    }

    /* =========================================================
       TOP BAR
    ========================================================= */

    .sp-topbar {
        padding: 25px 0 18px;
    }

    .sp-back {
        display: inline-flex;
        align-items: center;
        gap: 8px;

        color: #7b8798;

        text-decoration: none;

        font-size: 12px;
        font-weight: 700;

        transition: .2s ease;
    }

    .sp-back:hover {
        color: var(--sp-primary);
    }

    .sp-back i {
        font-size: 10px;
    }

    .sp-page-heading {
        display: flex;
        align-items: center;
        justify-content: space-between;

        gap: 20px;

        margin-top: 18px;
    }

    .sp-page-heading-left {
        min-width: 0;
    }

    .sp-page-heading h1 {
        margin: 0;

        color: var(--sp-heading);

        font-size: 27px;

        line-height: 1.25;

        font-weight: 800;

        letter-spacing: -.03em;
    }

    .sp-page-heading p {
        margin: 6px 0 0;

        color: var(--sp-muted);

        font-size: 12px;
    }

    .sp-actions-right {
        display: flex;

        align-items: center;

        gap: 8px;

        flex-wrap: wrap;

        flex-shrink: 0;
    }

    .sp-btn {
        display: inline-flex;

        align-items: center;
        justify-content: center;

        gap: 7px;

        min-height: 38px;

        padding: 0 14px;

        border-radius: 10px;

        text-decoration: none;

        border: 1px solid transparent;

        font-size: 10px;

        font-weight: 800;

        cursor: pointer;

        transition: .2s ease;

        white-space: nowrap;
    }

    .sp-btn-primary {
        background: var(--sp-primary);

        color: #fff;

        border-color: var(--sp-primary);

        box-shadow:
            0 7px 16px rgba(79, 141, 247, .13);
    }

    .sp-btn-primary:hover {
        background: var(--sp-primary-hover);

        border-color: var(--sp-primary-hover);

        color: #fff;

        transform: translateY(-1px);
    }

    .sp-btn-soft {
        background: #fff;

        color: #5f6f84;

        border-color: var(--sp-border);
    }

    .sp-btn-soft:hover {
        background: var(--sp-primary-soft);

        color: var(--sp-primary);

        border-color: #cfe0ff;
    }

    .sp-btn-danger {
        background: #fff;

        color: var(--sp-red);

        border-color: #fecaca;
    }

    .sp-btn-danger:hover {
        background: var(--sp-red-soft);

        color: #dc2626;
    }

    /* =========================================================
       QUICK ACTIONS
    ========================================================= */

    .sp-quick-actions {
        display: grid;

        grid-template-columns: repeat(4, minmax(0, 1fr));

        gap: 10px;

        margin-bottom: 17px;
    }

    .sp-quick-action {
        display: flex;

        align-items: center;

        gap: 10px;

        padding: 11px 13px;

        background: rgba(255, 255, 255, .9);

        border: 1px solid var(--sp-border);

        border-radius: 12px;

        text-decoration: none;

        transition: .2s ease;
    }

    .sp-quick-action:hover {
        transform: translateY(-1px);

        border-color: #cfe0ff;

        box-shadow:
            0 8px 20px rgba(67, 97, 143, .06);
    }

    .sp-quick-icon {
        width: 31px;
        height: 31px;

        flex: 0 0 31px;

        border-radius: 9px;

        display: flex;

        align-items: center;
        justify-content: center;

        font-size: 11px;
    }

    .sp-quick-action:nth-child(1) .sp-quick-icon {
        background: var(--sp-primary-soft);
        color: var(--sp-primary);
    }

    .sp-quick-action:nth-child(2) .sp-quick-icon {
        background: var(--sp-cyan-soft);
        color: #0891b2;
    }

    .sp-quick-action:nth-child(3) .sp-quick-icon {
        background: var(--sp-purple-soft);
        color: var(--sp-purple);
    }

    .sp-quick-action:nth-child(4) .sp-quick-icon {
        background: var(--sp-green-soft);
        color: var(--sp-green);
    }

    .sp-quick-action-text {
        min-width: 0;
    }

    .sp-quick-action-title {
        display: block;

        color: var(--sp-heading);

        font-size: 10px;

        line-height: 1.3;

        font-weight: 800;
    }

    .sp-quick-action-subtitle {
        display: block;

        margin-top: 2px;

        color: var(--sp-light-muted);

        font-size: 8px;

        line-height: 1.3;
    }

    /* =========================================================
       ALERTS
    ========================================================= */

    .sp-alert {
        display: flex;

        align-items: flex-start;

        gap: 9px;

        padding: 12px 14px;

        border-radius: 11px;

        margin-bottom: 15px;

        font-size: 11px;

        line-height: 1.5;
    }

    .sp-alert-success {
        background: var(--sp-green-soft);

        color: #047857;

        border: 1px solid #a7f3d0;
    }

    .sp-alert-error {
        background: var(--sp-red-soft);

        color: #b91c1c;

        border: 1px solid #fecaca;
    }

    /* =========================================================
       MAIN PROFILE CARD
    ========================================================= */

    .sp-profile-card {
        background: var(--sp-white);

        border: 1px solid var(--sp-border);

        border-radius: 22px;

        overflow: hidden;

        box-shadow:
            0 12px 40px rgba(67, 97, 143, .055);
    }

    /* =========================================================
       COVER
    ========================================================= */

    .sp-cover {
        height: 265px;

        position: relative;

        background:
            radial-gradient(
                circle at 18% 24%,
                rgba(255,255,255,.88),
                transparent 20%
            ),
            radial-gradient(
                circle at 80% 28%,
                rgba(255,255,255,.42),
                transparent 22%
            ),
            linear-gradient(
                135deg,
                #eaf3ff 0%,
                #f2f6ff 46%,
                #eef5fb 100%
            );

        background-size: cover;

        background-position: center;

        overflow: hidden;
    }

    .sp-cover::before {
        content: "";

        position: absolute;

        width: 330px;
        height: 330px;

        right: -100px;
        top: -165px;

        border-radius: 50%;

        background: rgba(255,255,255,.48);
    }

    .sp-cover::after {
        content: "";

        position: absolute;

        width: 230px;
        height: 230px;

        left: 16%;
        bottom: -165px;

        border-radius: 50%;

        background: rgba(196, 220, 255, .28);
    }

    .sp-cover.has-image::before,
    .sp-cover.has-image::after {
        background: rgba(255,255,255,.09);
    }

    .sp-cover-image-overlay {
        position: absolute;

        inset: 0;

        background:
            linear-gradient(
                to bottom,
                rgba(255,255,255,.02),
                rgba(255,255,255,.09)
            );
    }

    /* =========================================================
       PROFILE MAIN
    ========================================================= */

    .sp-profile-main {
        position: relative;

        padding: 0 30px 30px;
    }

    .sp-profile-header {
        position: relative;

        z-index: 4;

        display: flex;

        align-items: flex-end;

        gap: 18px;

        margin-top: -60px;
    }

    .sp-logo {
        width: 124px;
        height: 124px;

        flex: 0 0 124px;

        padding: 7px;

        border-radius: 23px;

        background: #fff;

        border: 1px solid #e7edf5;

        box-shadow:
            0 13px 34px rgba(67, 97, 143, .13);
    }

    .sp-logo img {
        width: 100%;
        height: 100%;

        object-fit: contain;

        border-radius: 17px;

        background: #f8fbff;
    }

    .sp-logo-placeholder {
        width: 100%;
        height: 100%;

        border-radius: 17px;

        background:
            linear-gradient(
                135deg,
                #edf5ff,
                #f4f7ff
            );

        color: var(--sp-primary);

        display: flex;

        align-items: center;
        justify-content: center;

        font-size: 35px;
    }

    .sp-profile-title {
        min-width: 0;

        padding-bottom: 7px;
    }

    .sp-badges {
        display: flex;

        align-items: center;

        flex-wrap: wrap;

        gap: 6px;

        margin-bottom: 8px;
    }

    .sp-status,
    .sp-published {
        display: inline-flex;

        align-items: center;

        gap: 5px;

        padding: 6px 9px;

        border-radius: 999px;

        font-size: 8px;

        line-height: 1;

        font-weight: 800;

        white-space: nowrap;
    }

    .sp-approved {
        background: var(--sp-green-soft);

        color: #047857;
    }

    .sp-pending {
        background: var(--sp-orange-soft);

        color: #b45309;
    }

    .sp-rejected {
        background: var(--sp-red-soft);

        color: #dc2626;
    }

    .sp-draft {
        background: #f1f5f9;

        color: #64748b;
    }

    .sp-published {
        background: var(--sp-primary-soft);

        color: #3577dd;
    }

    .sp-profile-title h2 {
        margin: 0;

        color: var(--sp-heading);

        font-size: 29px;

        line-height: 1.2;

        font-weight: 800;

        letter-spacing: -.03em;

        word-break: break-word;
    }

    .sp-tagline {
        margin: 6px 0 0;

        color: var(--sp-muted);

        font-size: 12px;

        line-height: 1.7;

        max-width: 760px;
    }

    /* =========================================================
       META
    ========================================================= */

    .sp-meta-grid {
        display: grid;

        grid-template-columns:
            repeat(4, minmax(0, 1fr));

        gap: 10px;

        margin-top: 26px;
    }

    .sp-meta-box {
        min-width: 0;

        padding: 13px 14px;

        background:
            linear-gradient(
                180deg,
                #fbfdff 0%,
                #f8fafc 100%
            );

        border: 1px solid var(--sp-border-light);

        border-radius: 12px;
    }

    .sp-meta-box-label {
        display: flex;

        align-items: center;

        gap: 6px;

        color: #9aa6b6;

        font-size: 8px;

        line-height: 1.2;

        font-weight: 700;

        margin-bottom: 5px;
    }

    .sp-meta-box-label i {
        color: var(--sp-primary);

        font-size: 9px;
    }

    .sp-meta-box-value {
        color: var(--sp-text);

        font-size: 11px;

        line-height: 1.45;

        font-weight: 800;

        word-break: break-word;
    }

    .sp-website-value {
        color: var(--sp-primary);
    }

    /* =========================================================
       BODY
    ========================================================= */

    .sp-body-grid {
        display: grid;

        grid-template-columns:
            minmax(0, 1fr)
            290px;

        gap: 18px;

        margin-top: 18px;
    }

    .sp-main-column {
        min-width: 0;
    }

    .sp-sidebar {
        display: grid;

        gap: 13px;

        align-content: start;
    }

    /* =========================================================
       CONTENT SECTIONS
    ========================================================= */

    .sp-section {
        background: #fff;

        border: 1px solid var(--sp-border);

        border-radius: 16px;

        padding: 21px;

        margin-bottom: 14px;

        box-shadow:
            0 3px 12px rgba(67, 97, 143, .02);
    }

    .sp-section:last-child {
        margin-bottom: 0;
    }

    .sp-section-header {
        display: flex;

        align-items: center;

        gap: 9px;

        margin-bottom: 12px;
    }

    .sp-section-header-icon {
        width: 31px;
        height: 31px;

        flex: 0 0 31px;

        display: flex;

        align-items: center;

        justify-content: center;

        border-radius: 9px;

        background: var(--sp-primary-soft);

        color: var(--sp-primary);

        font-size: 11px;
    }

    .sp-section h3 {
        margin: 0;

        color: var(--sp-heading);

        font-size: 15px;

        font-weight: 800;
    }

    .sp-section-text {
        margin: 0;

        color: #68778a;

        font-size: 11px;

        line-height: 1.85;

        white-space: pre-line;
    }

    /* =========================================================
       MISSION / VISION
    ========================================================= */

    .sp-two-column {
        display: grid;

        grid-template-columns:
            repeat(2, minmax(0, 1fr));

        gap: 13px;

        margin-bottom: 14px;
    }

    .sp-info-box {
        background: #fff;

        border: 1px solid var(--sp-border);

        border-radius: 16px;

        padding: 20px;

        box-shadow:
            0 3px 12px rgba(67, 97, 143, .02);
    }

    .sp-info-box h3 {
        display: flex;

        align-items: center;

        gap: 8px;

        margin: 0 0 11px;

        color: var(--sp-heading);

        font-size: 14px;

        font-weight: 800;
    }

    .sp-info-box h3 i {
        color: var(--sp-primary);

        font-size: 12px;
    }

    .sp-info-box p {
        margin: 0;

        color: var(--sp-muted);

        font-size: 11px;

        line-height: 1.8;

        white-space: pre-line;
    }

    /* =========================================================
       TAGS
    ========================================================= */

    .sp-tags {
        display: flex;

        flex-wrap: wrap;

        gap: 7px;
    }

    .sp-tag {
        display: inline-flex;

        align-items: center;

        min-height: 27px;

        padding: 0 10px;

        background: var(--sp-primary-soft);

        border: 1px solid #dbeafe;

        color: #4d7fd4;

        border-radius: 999px;

        font-size: 9px;

        font-weight: 800;
    }

    .sp-opportunity-tag {
        background: var(--sp-purple-soft);

        border-color: #e6e0ff;

        color: #7567d8;
    }

    /* =========================================================
       FUNDING
    ========================================================= */

    .sp-funding-grid {
        display: grid;

        grid-template-columns:
            repeat(3, minmax(0, 1fr));

        gap: 10px;
    }

    .sp-funding-box {
        padding: 14px;

        border-radius: 12px;

        background:
            linear-gradient(
                180deg,
                #fbfdff,
                #f8fafc
            );

        border: 1px solid var(--sp-border-light);
    }

    .sp-funding-label {
        display: block;

        color: #9ba7b7;

        font-size: 8px;

        line-height: 1.2;

        margin-bottom: 5px;
    }

    .sp-funding-value {
        color: var(--sp-text);

        font-size: 11px;

        line-height: 1.4;

        font-weight: 800;
    }

    .sp-raising-yes {
        color: var(--sp-green) !important;
    }

    /* =========================================================
       SIDEBAR CARDS
    ========================================================= */

    .sp-side-card {
        background: #fff;

        border: 1px solid var(--sp-border);

        border-radius: 16px;

        padding: 18px;

        box-shadow:
            0 3px 12px rgba(67, 97, 143, .02);
    }

    .sp-side-card h3 {
        margin: 0 0 12px;

        color: var(--sp-heading);

        font-size: 14px;

        font-weight: 800;
    }

    /* =========================================================
       CONTACT
    ========================================================= */

    .sp-contact-list {
        display: grid;

        gap: 7px;
    }

    .sp-contact-item {
        min-width: 0;

        display: flex;

        align-items: center;

        gap: 9px;

        padding: 9px;

        background: #f9fbfd;

        border: 1px solid var(--sp-border-light);

        border-radius: 10px;

        color: var(--sp-text);

        text-decoration: none;

        font-size: 9px;

        font-weight: 700;

        transition: .18s ease;
    }

    .sp-contact-item:hover {
        background: var(--sp-primary-soft);

        border-color: #dbeafe;

        color: var(--sp-primary);
    }

    .sp-contact-icon {
        width: 28px;
        height: 28px;

        flex: 0 0 28px;

        border-radius: 8px;

        background: var(--sp-primary-soft);

        color: var(--sp-primary);

        display: flex;

        align-items: center;

        justify-content: center;

        font-size: 10px;
    }

    .sp-contact-item span {
        min-width: 0;

        overflow: hidden;

        text-overflow: ellipsis;

        white-space: nowrap;
    }

    /* =========================================================
       SIDE ROW
    ========================================================= */

    .sp-side-row {
        display: flex;

        align-items: flex-start;

        gap: 9px;

        padding: 10px 0;

        border-bottom: 1px solid #f1f5f9;
    }

    .sp-side-row:last-child {
        border-bottom: 0;

        padding-bottom: 0;
    }

    .sp-side-row:first-child {
        padding-top: 0;
    }

    .sp-side-row-icon {
        width: 29px;
        height: 29px;

        flex: 0 0 29px;

        border-radius: 8px;

        background: var(--sp-primary-soft);

        color: var(--sp-primary);

        display: flex;

        align-items: center;

        justify-content: center;

        font-size: 10px;
    }

    .sp-side-row-content {
        min-width: 0;
    }

    .sp-side-row-content span {
        display: block;

        color: #9aa6b6;

        font-size: 8px;

        line-height: 1.2;

        margin-bottom: 3px;
    }

    .sp-side-row-content strong {
        display: block;

        color: var(--sp-text);

        font-size: 10px;

        line-height: 1.45;

        font-weight: 800;

        word-break: break-word;
    }

    /* =========================================================
       STATUS CARD
    ========================================================= */

    .sp-status-pill {
        display: inline-flex;

        align-items: center;

        gap: 5px;

        padding: 5px 8px;

        border-radius: 999px;

        font-size: 8px;

        font-weight: 800;
    }

    .sp-status-pill-approved {
        background: var(--sp-green-soft);

        color: #047857;
    }

    .sp-status-pill-pending {
        background: var(--sp-orange-soft);

        color: #b45309;
    }

    .sp-status-pill-rejected {
        background: var(--sp-red-soft);

        color: #dc2626;
    }

    .sp-status-pill-draft {
        background: #f1f5f9;

        color: #64748b;
    }

    /* =========================================================
       REJECTION
    ========================================================= */

    .sp-rejection {
        padding: 14px;

        background: var(--sp-red-soft);

        border: 1px solid #fecaca;

        border-radius: 13px;

        margin-bottom: 14px;
    }

    .sp-rejection-title {
        display: flex;

        align-items: center;

        gap: 7px;

        color: var(--sp-red);

        font-size: 11px;

        font-weight: 800;

        margin-bottom: 6px;
    }

    .sp-rejection-text {
        margin: 0;

        color: #991b1b;

        font-size: 10px;

        line-height: 1.65;

        white-space: pre-line;
    }

    /* =========================================================
       CREATED / UPDATED
    ========================================================= */

    .sp-activity-row {
        display: flex;

        align-items: center;

        justify-content: space-between;

        gap: 12px;

        padding: 8px 0;

        border-bottom: 1px solid #f1f5f9;
    }

    .sp-activity-row:last-child {
        border-bottom: 0;

        padding-bottom: 0;
    }

    .sp-activity-row:first-child {
        padding-top: 0;
    }

    .sp-activity-label {
        color: #9aa6b6;

        font-size: 8px;

        font-weight: 700;
    }

    .sp-activity-value {
        color: var(--sp-text);

        font-size: 9px;

        font-weight: 800;

        text-align: right;
    }

    /* =========================================================
       RESPONSIVE
    ========================================================= */

    @media (max-width: 1100px) {

        .sp-meta-grid {
            grid-template-columns:
                repeat(3, minmax(0, 1fr));
        }

        .sp-body-grid {
            grid-template-columns:
                minmax(0, 1fr)
                260px;
        }

        .sp-quick-actions {
            grid-template-columns:
                repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 850px) {

        .sp-page-heading {
            flex-direction: column;

            align-items: flex-start;
        }

        .sp-actions-right {
            width: 100%;
        }

        .sp-actions-right .sp-btn {
            flex: 1;
        }

        .sp-profile-header {
            align-items: flex-start;

            flex-direction: column;

            gap: 12px;

            margin-top: -50px;
        }

        .sp-profile-title {
            padding-bottom: 0;
        }

        .sp-meta-grid {
            grid-template-columns:
                repeat(2, minmax(0, 1fr));
        }

        .sp-body-grid {
            grid-template-columns: 1fr;
        }

        .sp-sidebar {
            grid-template-columns:
                repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 650px) {

        .sp-show-page {
            padding-bottom: 40px;
        }

        .sp-container {
            width: calc(100% - 20px);
        }

        .sp-topbar {
            padding-top: 18px;
        }

        .sp-page-heading h1 {
            font-size: 23px;
        }

        .sp-page-heading p {
            font-size: 11px;
        }

        .sp-actions-right {
            flex-direction: column;
        }

        .sp-actions-right .sp-btn {
            width: 100%;
            flex: none;
        }

        .sp-quick-actions {
            grid-template-columns: 1fr;
        }

        .sp-cover {
            height: 190px;
        }

        .sp-profile-main {
            padding:
                0
                17px
                22px;
        }

        .sp-profile-header {
            margin-top: -43px;
        }

        .sp-logo {
            width: 92px;
            height: 92px;
            flex-basis: 92px;
            border-radius: 17px;
        }

        .sp-logo img,
        .sp-logo-placeholder {
            border-radius: 12px;
        }

        .sp-logo-placeholder {
            font-size: 28px;
        }

        .sp-profile-title h2 {
            font-size: 23px;
        }

        .sp-tagline {
            font-size: 11px;
        }

        .sp-meta-grid {
            grid-template-columns: 1fr;
        }

        .sp-two-column {
            grid-template-columns: 1fr;
        }

        .sp-funding-grid {
            grid-template-columns: 1fr;
        }

        .sp-sidebar {
            grid-template-columns: 1fr;
        }

        .sp-section {
            padding: 18px;
        }

        .sp-info-box {
            padding: 18px;
        }
    }

    @media (max-width: 430px) {

        .sp-profile-title h2 {
            font-size: 21px;
        }

        .sp-section-text,
        .sp-info-box p {
            font-size: 10px;
        }

        .sp-actions-right {
            gap: 6px;
        }
    }
</style>


<div class="sp-show-page">

    <div class="sp-container">


        {{-- =====================================================
             TOP BAR
        ====================================================== --}}

        <div class="sp-topbar">


            <a
                href="{{ route('employer.startup-profile.index') }}"
                class="sp-back"
            >

                <i class="fa-solid fa-arrow-left"></i>

                Back to Startup Profiles

            </a>


            <div class="sp-page-heading">


                <div class="sp-page-heading-left">

                    <h1>
                        Startup Profile
                    </h1>

                    <p>
                        View and manage your startup showcase.
                    </p>

                </div>


                <div class="sp-actions-right">


                    <a
                        href="{{ route(
                            'employer.startup-profile.edit',
                            ['startupProfile' => $profile->id]
                        ) }}"
                        class="sp-btn sp-btn-primary"
                    >

                        <i class="fa-regular fa-pen-to-square"></i>

                        Edit Profile

                    </a>


                    <form
                        action="{{ route(
                            'employer.startup-profile.destroy',
                            ['startupProfile' => $profile->id]
                        ) }}"
                        method="POST"
                        onsubmit="return confirm('Delete this startup profile? This action cannot be undone.');"
                        style="margin:0;"
                    >

                        @csrf

                        @method('DELETE')

                        <button
                            type="submit"
                            class="sp-btn sp-btn-danger"
                        >

                            <i class="fa-regular fa-trash-can"></i>

                            Delete

                        </button>

                    </form>

                </div>

            </div>

        </div>


        {{-- =====================================================
             ALERTS
        ====================================================== --}}

        @if(session('success'))

            <div class="sp-alert sp-alert-success">

                <i class="fa-solid fa-circle-check"></i>

                <span>
                    {{ session('success') }}
                </span>

            </div>

        @endif


        @if(session('error'))

            <div class="sp-alert sp-alert-error">

                <i class="fa-solid fa-circle-exclamation"></i>

                <span>
                    {{ session('error') }}
                </span>

            </div>

        @endif


        {{-- =====================================================
             QUICK ACTIONS
        ====================================================== --}}

        <div class="sp-quick-actions">


            {{-- VIEW / PROFILE LIST --}}

            <a
                href="{{ route('employer.startup-profile.index') }}"
                class="sp-quick-action"
            >

                <span class="sp-quick-icon">

                    <i class="fa-solid fa-layer-group"></i>

                </span>

                <span class="sp-quick-action-text">

                    <span class="sp-quick-action-title">
                        My Profiles
                    </span>

                    <span class="sp-quick-action-subtitle">
                        Manage startups
                    </span>

                </span>

            </a>


            {{-- JOBS --}}

            <a
                href="{{ route(
                    'employer.startup-profile.jobs',
                    $profile
                ) }}"
                class="sp-quick-action"
            >

                <span class="sp-quick-icon">

                    <i class="fa-solid fa-briefcase"></i>

                </span>

                <span class="sp-quick-action-text">

                    <span class="sp-quick-action-title">
                        Startup Jobs
                    </span>

                    <span class="sp-quick-action-subtitle">
                        View job openings
                    </span>

                </span>

            </a>


            {{-- INTERNSHIPS --}}

            <a
                href="{{ route(
                    'employer.startup-profile.internships',
                    $profile
                ) }}"
                class="sp-quick-action"
            >

                <span class="sp-quick-icon">

                    <i class="fa-solid fa-user-graduate"></i>

                </span>

                <span class="sp-quick-action-text">

                    <span class="sp-quick-action-title">
                        Internships
                    </span>

                    <span class="sp-quick-action-subtitle">
                        View opportunities
                    </span>

                </span>

            </a>


            {{-- CREATE JOB --}}

            <a
                href="{{ route('employer.jobs.create', [
                    'startup_profile_id' => $profile->id
                ]) }}"
                class="sp-quick-action"
            >

                <span class="sp-quick-icon">

                    <i class="fa-solid fa-plus"></i>

                </span>

                <span class="sp-quick-action-text">

                    <span class="sp-quick-action-title">
                        Create Job
                    </span>

                    <span class="sp-quick-action-subtitle">
                        Add a new opening
                    </span>

                </span>

            </a>

        </div>


        {{-- =====================================================
             PROFILE CARD
        ====================================================== --}}

        <div class="sp-profile-card">


            {{-- =================================================
                 COVER
            ================================================== --}}

            @if($profile->cover_image)

                <div
                    class="sp-cover has-image"
                    style="background-image: url('{{ asset('storage/' . $profile->cover_image) }}');"
                >

                    <div class="sp-cover-image-overlay"></div>

                </div>

            @else

                <div class="sp-cover">

                </div>

            @endif


            <div class="sp-profile-main">


                {{-- =================================================
                     PROFILE HEADER
                ================================================== --}}

                <div class="sp-profile-header">


                    {{-- LOGO --}}

                    <div class="sp-logo">

                        @if($profile->logo)

                            <img
                                src="{{ asset('storage/' . $profile->logo) }}"
                                alt="{{ $profile->startup_name }}"
                            >

                        @else

                            <div class="sp-logo-placeholder">

                                <i class="fa-solid fa-rocket"></i>

                            </div>

                        @endif

                    </div>


                    {{-- TITLE --}}

                    <div class="sp-profile-title">


                        <div class="sp-badges">


                            @php

                                $status = strtolower(
                                    (string) ($profile->status ?? 'draft')
                                );

                            @endphp


                            @if($status === 'approved')

                                <span class="sp-status sp-approved">

                                    <i class="fa-solid fa-circle-check"></i>

                                    Approved

                                </span>

                            @elseif($status === 'pending')

                                <span class="sp-status sp-pending">

                                    <i class="fa-solid fa-clock"></i>

                                    Pending Approval

                                </span>

                            @elseif($status === 'rejected')

                                <span class="sp-status sp-rejected">

                                    <i class="fa-solid fa-circle-xmark"></i>

                                    Rejected

                                </span>

                            @else

                                <span class="sp-status sp-draft">

                                    <i class="fa-regular fa-file"></i>

                                    Draft

                                </span>

                            @endif


                            @if($profile->is_published)

                                <span class="sp-published">

                                    <i class="fa-solid fa-globe"></i>

                                    Published

                                </span>

                            @endif

                        </div>


                        <h2>
                            {{ $profile->startup_name }}
                        </h2>


                        @if($profile->tagline)

                            <p class="sp-tagline">
                                {{ $profile->tagline }}
                            </p>

                        @elseif($profile->short_description)

                            <p class="sp-tagline">
                                {{ $profile->short_description }}
                            </p>

                        @endif

                    </div>

                </div>


                {{-- =================================================
                     META GRID
                ================================================== --}}

                <div class="sp-meta-grid">


                    @if($profile->category)

                        <div class="sp-meta-box">

                            <div class="sp-meta-box-label">

                                <i class="fa-solid fa-shapes"></i>

                                Category

                            </div>

                            <div class="sp-meta-box-value">
                                {{ $profile->category }}
                            </div>

                        </div>

                    @endif


                    @if($profile->industry)

                        <div class="sp-meta-box">

                            <div class="sp-meta-box-label">

                                <i class="fa-solid fa-layer-group"></i>

                                Industry

                            </div>

                            <div class="sp-meta-box-value">
                                {{ $profile->industry }}
                            </div>

                        </div>

                    @endif


                    @if($profile->startup_type)

                        <div class="sp-meta-box">

                            <div class="sp-meta-box-label">

                                <i class="fa-solid fa-building"></i>

                                Startup Type

                            </div>

                            <div class="sp-meta-box-value">
                                {{ $profile->startup_type }}
                            </div>

                        </div>

                    @endif


                    @if($profile->startup_stage)

                        <div class="sp-meta-box">

                            <div class="sp-meta-box-label">

                                <i class="fa-solid fa-chart-line"></i>

                                Startup Stage

                            </div>

                            <div class="sp-meta-box-value">
                                {{ $profile->startup_stage }}
                            </div>

                        </div>

                    @endif


                    @if($profile->founded_year)

                        <div class="sp-meta-box">

                            <div class="sp-meta-box-label">

                                <i class="fa-regular fa-calendar"></i>

                                Founded

                            </div>

                            <div class="sp-meta-box-value">
                                {{ $profile->founded_year }}
                            </div>

                        </div>

                    @endif


                    @if($profile->team_size)

                        <div class="sp-meta-box">

                            <div class="sp-meta-box-label">

                                <i class="fa-solid fa-users"></i>

                                Team Size

                            </div>

                            <div class="sp-meta-box-value">
                                {{ $profile->team_size }}
                            </div>

                        </div>

                    @endif


                    @if($profile->location)

                        <div class="sp-meta-box">

                            <div class="sp-meta-box-label">

                                <i class="fa-solid fa-location-dot"></i>

                                Location

                            </div>

                            <div class="sp-meta-box-value">
                                {{ $profile->location }}
                            </div>

                        </div>

                    @endif


                    @if($profile->website)

                        <div class="sp-meta-box">

                            <div class="sp-meta-box-label">

                                <i class="fa-solid fa-globe"></i>

                                Website

                            </div>

                            <div class="sp-meta-box-value sp-website-value">
                                Website Available
                            </div>

                        </div>

                    @endif

                </div>

            </div>

        </div>


        {{-- =====================================================
             BODY GRID
        ====================================================== --}}

        <div class="sp-body-grid">


            {{-- =================================================
                 MAIN COLUMN
            ================================================== --}}

            <div class="sp-main-column">


                {{-- =================================================
                     REJECTION
                ================================================== --}}

                @if(
                    $status === 'rejected' &&
                    $profile->rejection_reason
                )

                    <div class="sp-rejection">

                        <div class="sp-rejection-title">

                            <i class="fa-solid fa-circle-exclamation"></i>

                            Admin Feedback

                        </div>

                        <p class="sp-rejection-text">
                            {{ $profile->rejection_reason }}
                        </p>

                    </div>

                @endif


                {{-- =================================================
                     SHORT DESCRIPTION
                ================================================== --}}

                @if($profile->short_description)

                    <section class="sp-section">

                        <div class="sp-section-header">

                            <div class="sp-section-header-icon">

                                <i class="fa-solid fa-align-left"></i>

                            </div>

                            <h3>
                                About the Startup
                            </h3>

                        </div>

                        <p class="sp-section-text">
                            {{ $profile->short_description }}
                        </p>

                    </section>

                @endif


                {{-- =================================================
                     ABOUT
                ================================================== --}}

                @if($profile->about)

                    <section class="sp-section">

                        <div class="sp-section-header">

                            <div class="sp-section-header-icon">

                                <i class="fa-regular fa-building"></i>

                            </div>

                            <h3>
                                About
                            </h3>

                        </div>

                        <p class="sp-section-text">
                            {{ $profile->about }}
                        </p>

                    </section>

                @endif


                {{-- =================================================
                     MISSION + VISION
                ================================================== --}}

                @if($profile->mission || $profile->vision)

                    <div class="sp-two-column">


                        @if($profile->mission)

                            <div class="sp-info-box">

                                <h3>

                                    <i class="fa-solid fa-bullseye"></i>

                                    Mission

                                </h3>

                                <p>
                                    {{ $profile->mission }}
                                </p>

                            </div>

                        @endif


                        @if($profile->vision)

                            <div class="sp-info-box">

                                <h3>

                                    <i class="fa-regular fa-eye"></i>

                                    Vision

                                </h3>

                                <p>
                                    {{ $profile->vision }}
                                </p>

                            </div>

                        @endif

                    </div>

                @endif


                {{-- =================================================
                     PRODUCTS / SERVICES
                ================================================== --}}

                @if($profile->products_services)

                    <section class="sp-section">

                        <div class="sp-section-header">

                            <div class="sp-section-header-icon">

                                <i class="fa-solid fa-cubes"></i>

                            </div>

                            <h3>
                                Products & Services
                            </h3>

                        </div>

                        <p class="sp-section-text">
                            {{ $profile->products_services }}
                        </p>

                    </section>

                @endif


                {{-- =================================================
                     TECHNOLOGIES
                ================================================== --}}

                @if($profile->technologies)

                    <section class="sp-section">

                        <div class="sp-section-header">

                            <div class="sp-section-header-icon">

                                <i class="fa-solid fa-code"></i>

                            </div>

                            <h3>
                                Technologies
                            </h3>

                        </div>

                        <p class="sp-section-text">
                            {{ $profile->technologies }}
                        </p>

                    </section>

                @endif


                {{-- =================================================
                     LOOKING FOR
                ================================================== --}}

                @php

                    $lookingFor = $profile->looking_for;

                    if (is_string($lookingFor)) {
                        $lookingFor = json_decode(
                            $lookingFor,
                            true
                        );
                    }

                    $lookingFor = is_array($lookingFor)
                        ? $lookingFor
                        : [];

                    $lookingForLabels = [
                        'employee' => 'Employees',
                        'freelancer' => 'Freelancers',
                        'investor' => 'Investors',
                        'mentor' => 'Mentors',
                        'student' => 'Students',
                        'business_partner' => 'Business Partners',
                    ];

                @endphp


                @if(count($lookingFor))

                    <section class="sp-section">

                        <div class="sp-section-header">

                            <div class="sp-section-header-icon">

                                <i class="fa-solid fa-users"></i>

                            </div>

                            <h3>
                                Looking For
                            </h3>

                        </div>


                        <div class="sp-tags">

                            @foreach($lookingFor as $item)

                                <span class="sp-tag">

                                    {{ $lookingForLabels[$item] ?? $item }}

                                </span>

                            @endforeach

                        </div>

                    </section>

                @endif


                {{-- =================================================
                     OPPORTUNITIES
                ================================================== --}}

                @php

                    $opportunities = $profile->opportunities;

                    if (is_string($opportunities)) {
                        $opportunities = json_decode(
                            $opportunities,
                            true
                        );
                    }

                    $opportunities = is_array($opportunities)
                        ? $opportunities
                        : [];

                    $opportunityLabels = [
                        'jobs' => 'Jobs',
                        'internships' => 'Internships',
                        'freelance_projects' => 'Freelance Projects',
                        'student_projects' => 'Student Projects',
                        'mentorship' => 'Mentorship',
                        'business_partnerships' => 'Business Partnerships',
                        'investment' => 'Investment',
                    ];

                @endphp


                @if(count($opportunities))

                    <section class="sp-section">

                        <div class="sp-section-header">

                            <div class="sp-section-header-icon">

                                <i class="fa-solid fa-bullhorn"></i>

                            </div>

                            <h3>
                                Opportunities
                            </h3>

                        </div>


                        <div class="sp-tags">

                            @foreach($opportunities as $item)

                                <span class="sp-tag sp-opportunity-tag">

                                    {{ $opportunityLabels[$item] ?? $item }}

                                </span>

                            @endforeach

                        </div>

                    </section>

                @endif


                {{-- =================================================
                     FUNDING
                ================================================== --}}

                @if(
                    $profile->funding_stage ||
                    $profile->currently_raising ||
                    $profile->funding_requirement
                )

                    <section class="sp-section">

                        <div class="sp-section-header">

                            <div class="sp-section-header-icon">

                                <i class="fa-solid fa-chart-pie"></i>

                            </div>

                            <h3>
                                Funding
                            </h3>

                        </div>


                        <div class="sp-funding-grid">


                            <div class="sp-funding-box">

                                <span class="sp-funding-label">
                                    Funding Stage
                                </span>

                                <strong class="sp-funding-value">
                                    {{ $profile->funding_stage ?: 'Not specified' }}
                                </strong>

                            </div>


                            <div class="sp-funding-box">

                                <span class="sp-funding-label">
                                    Currently Raising
                                </span>

                                <strong
                                    class="sp-funding-value {{
                                        $profile->currently_raising === 'yes'
                                            ? 'sp-raising-yes'
                                            : ''
                                    }}"
                                >

                                    @if($profile->currently_raising === 'yes')

                                        Yes

                                    @elseif($profile->currently_raising === 'no')

                                        No

                                    @else

                                        Not specified

                                    @endif

                                </strong>

                            </div>


                            @if($profile->funding_requirement)

                                <div class="sp-funding-box">

                                    <span class="sp-funding-label">
                                        Funding Requirement
                                    </span>

                                    <strong class="sp-funding-value">

                                        ₹{{ number_format(
                                            (float) $profile->funding_requirement,
                                            2
                                        ) }}

                                    </strong>

                                </div>

                            @endif

                        </div>

                    </section>

                @endif

            </div>


            {{-- =================================================
                 SIDEBAR
            ================================================== --}}

            <aside class="sp-sidebar">


                {{-- =================================================
                     CONTACT
                ================================================== --}}

                @if(
                    $profile->website ||
                    $profile->linkedin ||
                    $profile->startup_email ||
                    $profile->startup_phone
                )

                    <div class="sp-side-card">

                        <h3>
                            Contact & Links
                        </h3>


                        <div class="sp-contact-list">


                            @if($profile->website)

                                <a
                                    href="{{ $profile->website }}"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="sp-contact-item"
                                >

                                    <div class="sp-contact-icon">

                                        <i class="fa-solid fa-globe"></i>

                                    </div>

                                    <span>
                                        Visit Website
                                    </span>

                                </a>

                            @endif


                            @if($profile->linkedin)

                                <a
                                    href="{{ $profile->linkedin }}"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="sp-contact-item"
                                >

                                    <div class="sp-contact-icon">

                                        <i class="fa-brands fa-linkedin-in"></i>

                                    </div>

                                    <span>
                                        LinkedIn
                                    </span>

                                </a>

                            @endif


                            @if($profile->startup_email)

                                <a
                                    href="mailto:{{ $profile->startup_email }}"
                                    class="sp-contact-item"
                                >

                                    <div class="sp-contact-icon">

                                        <i class="fa-regular fa-envelope"></i>

                                    </div>

                                    <span>
                                        {{ $profile->startup_email }}
                                    </span>

                                </a>

                            @endif


                            @if($profile->startup_phone)

                                <a
                                    href="tel:{{ $profile->startup_phone }}"
                                    class="sp-contact-item"
                                >

                                    <div class="sp-contact-icon">

                                        <i class="fa-solid fa-phone"></i>

                                    </div>

                                    <span>
                                        {{ $profile->startup_phone }}
                                    </span>

                                </a>

                            @endif

                        </div>

                    </div>

                @endif


                {{-- =================================================
                     STARTUP INFORMATION
                ================================================== --}}

                <div class="sp-side-card">

                    <h3>
                        Startup Information
                    </h3>


                    @if($profile->startup_name)

                        <div class="sp-side-row">

                            <div class="sp-side-row-icon">

                                <i class="fa-solid fa-building"></i>

                            </div>

                            <div class="sp-side-row-content">

                                <span>
                                    Startup
                                </span>

                                <strong>
                                    {{ $profile->startup_name }}
                                </strong>

                            </div>

                        </div>

                    @endif


                    @if($profile->category)

                        <div class="sp-side-row">

                            <div class="sp-side-row-icon">

                                <i class="fa-solid fa-shapes"></i>

                            </div>

                            <div class="sp-side-row-content">

                                <span>
                                    Category
                                </span>

                                <strong>
                                    {{ $profile->category }}
                                </strong>

                            </div>

                        </div>

                    @endif


                    @if($profile->industry)

                        <div class="sp-side-row">

                            <div class="sp-side-row-icon">

                                <i class="fa-solid fa-layer-group"></i>

                            </div>

                            <div class="sp-side-row-content">

                                <span>
                                    Industry
                                </span>

                                <strong>
                                    {{ $profile->industry }}
                                </strong>

                            </div>

                        </div>

                    @endif


                    @if($profile->founded_year)

                        <div class="sp-side-row">

                            <div class="sp-side-row-icon">

                                <i class="fa-regular fa-calendar"></i>

                            </div>

                            <div class="sp-side-row-content">

                                <span>
                                    Founded
                                </span>

                                <strong>
                                    {{ $profile->founded_year }}
                                </strong>

                            </div>

                        </div>

                    @endif


                    @if($profile->team_size)

                        <div class="sp-side-row">

                            <div class="sp-side-row-icon">

                                <i class="fa-solid fa-users"></i>

                            </div>

                            <div class="sp-side-row-content">

                                <span>
                                    Team Size
                                </span>

                                <strong>
                                    {{ $profile->team_size }}
                                </strong>

                            </div>

                        </div>

                    @endif


                    @if($profile->location)

                        <div class="sp-side-row">

                            <div class="sp-side-row-icon">

                                <i class="fa-solid fa-location-dot"></i>

                            </div>

                            <div class="sp-side-row-content">

                                <span>
                                    Location
                                </span>

                                <strong>
                                    {{ $profile->location }}
                                </strong>

                            </div>

                        </div>

                    @endif

                </div>


                {{-- =================================================
                     PROFILE STATUS
                ================================================== --}}

                <div class="sp-side-card">

                    <h3>
                        Profile Status
                    </h3>


                    <div class="sp-side-row">

                        <div class="sp-side-row-icon">

                            <i class="fa-solid fa-shield-check"></i>

                        </div>

                        <div class="sp-side-row-content">

                            <span>
                                Approval Status
                            </span>

                            <strong>


                                @if($status === 'approved')

                                    <span class="sp-status-pill sp-status-pill-approved">

                                        <i class="fa-solid fa-circle-check"></i>

                                        Approved

                                    </span>

                                @elseif($status === 'pending')

                                    <span class="sp-status-pill sp-status-pill-pending">

                                        <i class="fa-solid fa-clock"></i>

                                        Pending

                                    </span>

                                @elseif($status === 'rejected')

                                    <span class="sp-status-pill sp-status-pill-rejected">

                                        <i class="fa-solid fa-circle-xmark"></i>

                                        Rejected

                                    </span>

                                @else

                                    <span class="sp-status-pill sp-status-pill-draft">

                                        <i class="fa-regular fa-file"></i>

                                        Draft

                                    </span>

                                @endif


                            </strong>

                        </div>

                    </div>


                    <div class="sp-side-row">

                        <div class="sp-side-row-icon">

                            <i class="fa-solid fa-globe"></i>

                        </div>

                        <div class="sp-side-row-content">

                            <span>
                                Visibility
                            </span>

                            <strong>

                                @if($profile->is_published)

                                    Published

                                @else

                                    Unpublished

                                @endif

                            </strong>

                        </div>

                    </div>

                </div>


                {{-- =================================================
                     PROFILE ACTIVITY
                ================================================== --}}

                <div class="sp-side-card">

                    <h3>
                        Profile Activity
                    </h3>


                    @if($profile->created_at)

                        <div class="sp-activity-row">

                            <span class="sp-activity-label">
                                Created
                            </span>

                            <span class="sp-activity-value">
                                {{ $profile->created_at->format('d M Y') }}
                            </span>

                        </div>

                    @endif


                    @if($profile->updated_at)

                        <div class="sp-activity-row">

                            <span class="sp-activity-label">
                                Last Updated
                            </span>

                            <span class="sp-activity-value">
                                {{ $profile->updated_at->format('d M Y') }}
                            </span>

                        </div>

                    @endif

                </div>

            </aside>

        </div>

    </div>

</div>

@endsection