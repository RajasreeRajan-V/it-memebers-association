@extends('layouts.app')

@section('title', 'Internship Applicants')

@section('content')

<style>

    :root {
        --ia-blue: #3376F2;
        --ia-blue-dark: #245fd0;
        --ia-blue-light: #eef4ff;

        --ia-text: #172033;
        --ia-muted: #64748b;
        --ia-border: #e5eaf1;
        --ia-bg: #f8fafc;
        --ia-white: #ffffff;

        --ia-green: #059669;
        --ia-green-bg: #ecfdf5;

        --ia-red: #dc2626;
        --ia-red-bg: #fef2f2;

        --ia-purple: #7c3aed;
        --ia-purple-bg: #f5f3ff;

        --ia-orange: #d97706;
        --ia-orange-bg: #fffbeb;

        --ia-shadow:
            0 8px 30px rgba(15, 23, 42, .06);

        --ia-modal-shadow:
            0 30px 90px rgba(15, 23, 42, .25);
    }

    * {
        box-sizing: border-box;
    }


    /* =========================================================
       PAGE
    ========================================================= */

    .ia-page {
        max-width: 1180px;
        margin: 0 auto;
        padding: 32px 22px 70px;
        color: var(--ia-text);
    }


    /* =========================================================
       HEADER
    ========================================================= */

    .ia-header {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 26px;
        flex-wrap: wrap;
    }

    .ia-header-left {
        display: flex;
        align-items: flex-start;
        gap: 14px;
    }

    .ia-header-icon {
        width: 48px;
        height: 48px;
        border-radius: 14px;
        background: var(--ia-blue-light);
        color: var(--ia-blue);

        display: flex;
        align-items: center;
        justify-content: center;

        font-size: 21px;
        flex-shrink: 0;
    }

    .ia-header h1 {
        margin: 0;
        font-size: 25px;
        line-height: 1.25;
        font-weight: 800;
        letter-spacing: -.4px;
    }

    .ia-header p {
        margin: 6px 0 0;
        color: var(--ia-muted);
        font-size: 13px;
        line-height: 1.6;
    }


    /* =========================================================
       SUMMARY
    ========================================================= */

    .ia-summary {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 13px;
        margin-bottom: 24px;
    }

    .ia-summary-card {
        background: #fff;
        border: 1px solid var(--ia-border);
        border-radius: 14px;
        padding: 16px;

        display: flex;
        align-items: center;
        gap: 13px;

        transition: .2s ease;
    }

    .ia-summary-card:hover {
        transform: translateY(-1px);
        box-shadow: var(--ia-shadow);
    }

    .ia-summary-icon {
        width: 40px;
        height: 40px;
        border-radius: 11px;

        display: flex;
        align-items: center;
        justify-content: center;

        flex-shrink: 0;
        font-size: 16px;
    }

    .ia-summary-icon.all {
        background: var(--ia-blue-light);
        color: var(--ia-blue);
    }

    .ia-summary-icon.new {
        background: var(--ia-orange-bg);
        color: var(--ia-orange);
    }

    .ia-summary-icon.selected {
        background: var(--ia-green-bg);
        color: var(--ia-green);
    }

    .ia-summary-icon.completed {
        background: var(--ia-purple-bg);
        color: var(--ia-purple);
    }

    .ia-summary-info span {
        display: block;
        color: var(--ia-muted);
        font-size: 11px;
        font-weight: 600;
        margin-bottom: 3px;
    }

    .ia-summary-info strong {
        display: block;
        font-size: 20px;
        font-weight: 800;
        line-height: 1;
    }


    /* =========================================================
       TOOLBAR
    ========================================================= */

    .ia-toolbar {
        background: #fff;
        border: 1px solid var(--ia-border);
        border-radius: 14px;
        padding: 13px;
        margin-bottom: 16px;

        display: flex;
        align-items: center;
        justify-content: space-between;

        gap: 12px;
        flex-wrap: wrap;
    }

    .ia-filters {
        display: flex;
        gap: 9px;
        align-items: center;
        flex-wrap: wrap;
        margin: 0;
    }

    .ia-filter-label {
        font-size: 12px;
        color: var(--ia-muted);
        font-weight: 700;

        display: flex;
        align-items: center;
        gap: 6px;
    }

    .ia-filters select {
        min-width: 220px;
        height: 38px;

        border: 1px solid var(--ia-border);
        border-radius: 9px;

        padding: 0 34px 0 11px;

        font-size: 12.5px;
        color: var(--ia-text);

        background: #fff;

        outline: none;
        cursor: pointer;
    }

    .ia-filters select:focus {
        border-color: var(--ia-blue);
        box-shadow:
            0 0 0 3px rgba(51, 118, 242, .09);
    }


    /* =========================================================
       TABS
    ========================================================= */

    .ia-tabs {
        display: flex;
        align-items: center;
        gap: 5px;
        flex-wrap: wrap;
    }

    .ia-tab {
        text-decoration: none;

        padding: 8px 12px;

        border-radius: 8px;

        font-size: 12px;
        font-weight: 700;

        color: var(--ia-muted);

        background: transparent;
        border: 1px solid transparent;

        transition: .2s ease;
        white-space: nowrap;
    }

    .ia-tab:hover {
        background: var(--ia-bg);
        color: var(--ia-text);
    }

    .ia-tab.active {
        color: var(--ia-blue);
        background: var(--ia-blue-light);
        border-color: #dbe7ff;
    }


    /* =========================================================
       ALERT
    ========================================================= */

    .ia-alert {
        padding: 12px 15px;
        border-radius: 10px;

        font-size: 12.5px;
        font-weight: 600;

        margin-bottom: 17px;

        display: flex;
        align-items: center;
        gap: 9px;
    }

    .ia-alert-success {
        background: var(--ia-green-bg);
        color: #047857;
        border: 1px solid #d1fae5;
    }

    .ia-alert-error {
        background: var(--ia-red-bg);
        color: #b91c1c;
        border: 1px solid #fecaca;
    }


    /* =========================================================
       APPLICATION CARD
    ========================================================= */

    .ia-card {
        background: #fff;
        border: 1px solid var(--ia-border);
        border-radius: 15px;

        margin-bottom: 13px;

        overflow: hidden;

        transition: .2s ease;

        cursor: pointer;
    }

    .ia-card:hover {
        border-color: #cdd8e8;
        box-shadow: var(--ia-shadow);
        transform: translateY(-1px);
    }

    .ia-card-inner {
        padding: 18px 19px;
    }

    .ia-card-top {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;

        gap: 18px;
    }

    .ia-student {
        display: flex;
        align-items: center;
        gap: 12px;

        min-width: 0;
    }

    .ia-avatar {
        width: 45px;
        height: 45px;

        border-radius: 12px;

        background:
            linear-gradient(
                135deg,
                #eef4ff,
                #dce9ff
            );

        color: var(--ia-blue);

        display: flex;
        align-items: center;
        justify-content: center;

        font-size: 17px;
        font-weight: 800;

        flex-shrink: 0;
        text-transform: uppercase;

        overflow: hidden;
    }

    .ia-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .ia-name {
        margin: 0 0 4px;

        font-size: 14px;
        font-weight: 800;

        line-height: 1.35;
    }

    .ia-meta {
        margin: 0;

        color: var(--ia-muted);

        font-size: 11.5px;
        line-height: 1.6;
    }

    .ia-internship {
        color: var(--ia-blue);
        font-weight: 700;
    }


    /* =========================================================
       STATUS
    ========================================================= */

    .ia-status {
        display: inline-flex;
        align-items: center;
        gap: 6px;

        padding: 6px 10px;

        border-radius: 999px;

        font-size: 10px;
        font-weight: 800;

        text-transform: uppercase;
        letter-spacing: .3px;

        white-space: nowrap;
    }

    .ia-status i {
        font-size: 9px;
    }

    .ia-status-applied {
        background: var(--ia-blue-light);
        color: #2563eb;
    }

    .ia-status-selected {
        background: var(--ia-green-bg);
        color: #047857;
    }

    .ia-status-rejected {
        background: var(--ia-red-bg);
        color: #b91c1c;
    }

    .ia-status-completed {
        background: var(--ia-purple-bg);
        color: #7c3aed;
    }


    /* =========================================================
       DETAILS
    ========================================================= */

    .ia-details {
        display: flex;
        align-items: center;
        gap: 20px;

        flex-wrap: wrap;

        margin-top: 15px;
        padding-top: 14px;

        border-top: 1px solid #f0f2f5;
    }

    .ia-detail {
        display: flex;
        align-items: center;
        gap: 7px;

        color: var(--ia-muted);

        font-size: 11.5px;
    }

    .ia-detail i {
        color: #94a3b8;
        font-size: 13px;
    }


    /* =========================================================
       COVER LETTER
    ========================================================= */

    .ia-cover {
        margin-top: 14px;

        padding: 12px 13px;

        background: #f8fafc;
        border: 1px solid #eef2f7;

        border-radius: 10px;

        font-size: 12px;
        color: #475569;

        line-height: 1.65;

        white-space: pre-line;
    }

    .ia-cover-title {
        font-size: 10.5px;
        font-weight: 800;

        text-transform: uppercase;
        letter-spacing: .4px;

        color: #94a3b8;

        margin-bottom: 4px;
    }


    /* =========================================================
       ACTIONS
    ========================================================= */

    .ia-actions {
        display: flex;
        align-items: center;
        gap: 7px;

        margin-top: 15px;
        padding-top: 14px;

        border-top: 1px solid #f0f2f5;

        flex-wrap: wrap;
    }

    .ia-actions form {
        margin: 0;
    }

    .ia-btn {
        border: 0;

        border-radius: 8px;

        min-height: 34px;

        padding: 7px 12px;

        font-size: 11.5px;
        font-weight: 700;

        cursor: pointer;

        text-decoration: none;

        display: inline-flex;
        align-items: center;
        justify-content: center;

        gap: 6px;

        transition: .2s ease;

        font-family: inherit;
    }

    .ia-btn i {
        font-size: 12px;
    }

    .ia-btn-select {
        background: var(--ia-green-bg);
        color: #047857;
    }

    .ia-btn-select:hover {
        background: #d1fae5;
    }

    .ia-btn-reject {
        background: var(--ia-red-bg);
        color: #b91c1c;
    }

    .ia-btn-reject:hover {
        background: #fee2e2;
    }

    .ia-btn-complete {
        background: var(--ia-blue);
        color: #fff;
    }

    .ia-btn-complete:hover {
        background: var(--ia-blue-dark);
        transform: translateY(-1px);
    }

    .ia-btn-view {
        background: #f1f5f9;
        color: #475569;
    }

    .ia-btn-view:hover {
        background: #e2e8f0;
    }

    .ia-certificate {
        margin-left: auto;

        display: inline-flex;
        align-items: center;

        gap: 7px;

        color: #7c3aed;
        background: var(--ia-purple-bg);

        border: 1px solid #ede9fe;

        padding: 7px 11px;

        border-radius: 8px;

        font-size: 10.5px;
        font-weight: 700;
    }


    /* =========================================================
       EMPTY
    ========================================================= */

    .ia-empty {
        text-align: center;

        padding: 65px 20px;

        color: var(--ia-muted);

        background: #fff;

        border: 1px solid var(--ia-border);

        border-radius: 15px;
    }

    .ia-empty-icon {
        width: 58px;
        height: 58px;

        margin: 0 auto 15px;

        border-radius: 16px;

        background: var(--ia-blue-light);
        color: var(--ia-blue);

        display: flex;
        align-items: center;
        justify-content: center;

        font-size: 23px;
    }

    .ia-empty h3 {
        margin: 0 0 5px;

        color: var(--ia-text);

        font-size: 15px;
        font-weight: 800;
    }

    .ia-empty p {
        margin: 0;
        font-size: 12px;
    }


    /* =========================================================
       STUDENT PROFILE MODAL
    ========================================================= */

    .student-modal {
        position: fixed;
        inset: 0;

        z-index: 10000;

        display: none;

        align-items: center;
        justify-content: center;

        background: rgba(15, 23, 42, .60);

        backdrop-filter: blur(4px);

        padding: 18px;
    }

    .student-modal.show {
        display: flex;
    }

    .student-modal-box {
        width: min(760px, 100%);

        max-height: min(760px, 92vh);

        background: #fff;

        border-radius: 20px;

        box-shadow: var(--ia-modal-shadow);

        overflow: hidden;

        animation: studentModalIn .20s ease-out;
    }

    @keyframes studentModalIn {

        from {
            opacity: 0;
            transform: translateY(12px) scale(.98);
        }

        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }

    }


    /* =========================================================
       PROFILE MODAL HEADER
    ========================================================= */

    .student-modal-header {
        position: relative;

        padding: 24px 25px;

        background:
            linear-gradient(
                135deg,
                #f8fbff 0%,
                #eef4ff 100%
            );

        border-bottom: 1px solid #e5eaf1;
    }

    .student-modal-header-top {
        display: flex;

        align-items: flex-start;

        justify-content: space-between;

        gap: 18px;
    }

    .student-profile-head {
        display: flex;

        align-items: center;

        gap: 15px;
    }

    .student-profile-photo {
        width: 72px;
        height: 72px;

        border-radius: 18px;

        background:
            linear-gradient(
                135deg,
                #dce9ff,
                #edf4ff
            );

        color: var(--ia-blue);

        border: 3px solid #fff;

        box-shadow:
            0 5px 18px rgba(51,118,242,.12);

        display: flex;
        align-items: center;
        justify-content: center;

        font-size: 27px;
        font-weight: 800;

        flex-shrink: 0;

        overflow: hidden;
    }

    .student-profile-photo img {
        width: 100%;
        height: 100%;

        object-fit: cover;
    }

    .student-profile-name {
        margin: 0;

        font-size: 20px;
        font-weight: 800;

        color: var(--ia-text);
    }

    .student-profile-role {
        margin: 5px 0 0;

        color: var(--ia-muted);

        font-size: 12px;
    }

    .student-profile-status {
        margin-top: 9px;
    }

    .student-modal-close {
        width: 35px;
        height: 35px;

        border: 0;

        border-radius: 9px;

        background: rgba(255,255,255,.85);

        color: #64748b;

        cursor: pointer;

        display: flex;
        align-items: center;
        justify-content: center;

        transition: .2s ease;

        flex-shrink: 0;
    }

    .student-modal-close:hover {
        background: #fff;
        color: var(--ia-text);
        transform: scale(1.03);
    }


    /* =========================================================
       MODAL BODY
    ========================================================= */

    .student-modal-body {
        padding: 22px 25px;

        overflow-y: auto;

        max-height: calc(92vh - 150px);
    }

    .student-section {
        margin-bottom: 22px;
    }

    .student-section:last-child {
        margin-bottom: 0;
    }

    .student-section-title {
        display: flex;
        align-items: center;
        gap: 8px;

        margin: 0 0 12px;

        font-size: 12px;

        font-weight: 800;

        color: var(--ia-text);

        text-transform: uppercase;

        letter-spacing: .4px;
    }

    .student-section-title i {
        color: var(--ia-blue);

        font-size: 13px;
    }


    /* =========================================================
       INFORMATION GRID
    ========================================================= */

    .student-info-grid {
        display: grid;

        grid-template-columns:
            repeat(2, minmax(0, 1fr));

        gap: 10px;
    }

    .student-info-item {
        padding: 12px 13px;

        border: 1px solid #edf0f4;

        background: #fbfcfe;

        border-radius: 10px;

        min-width: 0;
    }

    .student-info-label {
        display: block;

        margin-bottom: 4px;

        color: #94a3b8;

        font-size: 10px;

        font-weight: 700;

        text-transform: uppercase;

        letter-spacing: .35px;
    }

    .student-info-value {
        display: block;

        color: var(--ia-text);

        font-size: 12px;

        font-weight: 650;

        line-height: 1.5;

        word-break: break-word;
    }

    .student-info-value a {
        color: var(--ia-blue);

        text-decoration: none;
    }

    .student-info-value a:hover {
        text-decoration: underline;
    }


    /* =========================================================
       SKILLS
    ========================================================= */

    .student-skills {
        display: flex;

        flex-wrap: wrap;

        gap: 7px;
    }

    .student-skill {
        display: inline-flex;

        align-items: center;

        padding: 6px 10px;

        background: var(--ia-blue-light);

        color: #2563eb;

        border: 1px solid #dbe7ff;

        border-radius: 999px;

        font-size: 10.5px;

        font-weight: 700;
    }


    /* =========================================================
       DOCUMENT BUTTONS
    ========================================================= */

    .student-documents {
        display: flex;

        gap: 9px;

        flex-wrap: wrap;
    }

    .student-document-btn {
        display: inline-flex;

        align-items: center;

        gap: 7px;

        padding: 9px 12px;

        border-radius: 9px;

        background: #f8fafc;

        border: 1px solid #e2e8f0;

        color: #475569;

        text-decoration: none;

        font-size: 11px;

        font-weight: 700;

        transition: .2s ease;
    }

    .student-document-btn:hover {
        background: #eef4ff;

        border-color: #dbe7ff;

        color: var(--ia-blue);
    }


    /* =========================================================
       APPLICATION SUMMARY
    ========================================================= */

    .student-application-box {
        background: #f8fafc;

        border: 1px solid #edf0f4;

        border-radius: 12px;

        padding: 14px;
    }

    .student-application-grid {
        display: grid;

        grid-template-columns:
            repeat(3, minmax(0, 1fr));

        gap: 10px;
    }

    .student-application-item span {
        display: block;

        color: #94a3b8;

        font-size: 10px;

        font-weight: 700;

        margin-bottom: 3px;

        text-transform: uppercase;
    }

    .student-application-item strong {
        display: block;

        color: var(--ia-text);

        font-size: 12px;

        font-weight: 750;
    }


    /* =========================================================
       COVER LETTER IN PROFILE
    ========================================================= */

    .student-cover-letter {
        padding: 13px 14px;

        background: #fbfcfe;

        border: 1px solid #edf0f4;

        border-radius: 10px;

        color: #475569;

        font-size: 12px;

        line-height: 1.7;

        white-space: pre-line;
    }


    /* =========================================================
       COMPLETE MODAL
    ========================================================= */

    .ia-modal {
        position: fixed;
        inset: 0;

        z-index: 11000;

        display: none;

        align-items: center;
        justify-content: center;

        background: rgba(15,23,42,.58);

        backdrop-filter: blur(3px);

        padding: 18px;
    }

    .ia-modal.show {
        display: flex;
    }

    .ia-modal-box {
        width: min(480px, 100%);

        background: #fff;

        border-radius: 17px;

        padding: 23px;

        box-shadow:
            0 25px 70px rgba(15,23,42,.2);

        animation: iaModalIn .18s ease-out;
    }

    .ia-modal-head {
        display: flex;

        align-items: flex-start;

        justify-content: space-between;

        gap: 15px;

        margin-bottom: 19px;
    }

    .ia-modal-icon {
        width: 42px;
        height: 42px;

        border-radius: 11px;

        background: var(--ia-blue-light);
        color: var(--ia-blue);

        display: flex;

        align-items: center;
        justify-content: center;

        flex-shrink: 0;
    }

    .ia-modal-box h3 {
        margin: 0;

        font-size: 16px;

        font-weight: 800;
    }

    .ia-modal-subtitle {
        margin: 4px 0 0;

        color: var(--ia-muted);

        font-size: 11.5px;

        line-height: 1.5;
    }

    .ia-modal-close {
        width: 31px;
        height: 31px;

        border: 0;

        border-radius: 8px;

        background: #f8fafc;

        color: #64748b;

        cursor: pointer;

        display: flex;

        align-items: center;
        justify-content: center;
    }

    .ia-modal-close:hover {
        background: #f1f5f9;

        color: var(--ia-text);
    }

    .ia-modal-box label {
        display: block;

        font-size: 11px;

        font-weight: 800;

        color: #475569;

        margin: 13px 0 6px;
    }

    .ia-modal-box select,
    .ia-modal-box textarea {
        width: 100%;

        border: 1px solid var(--ia-border);

        border-radius: 9px;

        padding: 10px 11px;

        font-size: 12px;

        font-family: inherit;

        color: var(--ia-text);

        background: #fff;

        outline: none;
    }

    .ia-modal-box select {
        height: 40px;
    }

    .ia-modal-box select:focus,
    .ia-modal-box textarea:focus {
        border-color: var(--ia-blue);

        box-shadow:
            0 0 0 3px rgba(51,118,242,.08);
    }

    .ia-modal-box textarea {
        resize: vertical;

        min-height: 90px;
    }

    .ia-modal-footer {
        display: flex;

        justify-content: flex-end;

        gap: 8px;

        margin-top: 20px;

        padding-top: 15px;

        border-top: 1px solid #f0f2f5;
    }


    /* =========================================================
       PAGINATION
    ========================================================= */

    .ia-pagination {
        margin-top: 22px;
    }


    /* =========================================================
       RESPONSIVE
    ========================================================= */

    @media (max-width: 900px) {

        .ia-summary {
            grid-template-columns: repeat(2, 1fr);
        }

    }


    @media (max-width: 700px) {

        .ia-page {
            padding: 24px 14px 50px;
        }

        .ia-header h1 {
            font-size: 21px;
        }

        .ia-toolbar {
            align-items: stretch;
        }

        .ia-filters {
            width: 100%;
        }

        .ia-filters select {
            width: 100%;
        }

        .ia-tabs {
            width: 100%;

            overflow-x: auto;

            flex-wrap: nowrap;

            padding-bottom: 2px;
        }

        .ia-tab {
            flex-shrink: 0;
        }

        .ia-card-top {
            flex-direction: column;
        }

        .ia-status {
            align-self: flex-start;
        }

        .ia-certificate {
            margin-left: 0;
        }

        .student-modal-box {
            border-radius: 16px;
        }

        .student-modal-header,
        .student-modal-body {
            padding-left: 18px;
            padding-right: 18px;
        }

        .student-info-grid {
            grid-template-columns: 1fr;
        }

        .student-application-grid {
            grid-template-columns: 1fr;
        }

    }


    @media (max-width: 500px) {

        .ia-summary {
            grid-template-columns: 1fr 1fr;

            gap: 9px;
        }

        .ia-summary-card {
            padding: 12px;

            gap: 9px;
        }

        .ia-summary-icon {
            width: 34px;
            height: 34px;

            font-size: 14px;
        }

        .ia-summary-info strong {
            font-size: 17px;
        }

        .ia-summary-info span {
            font-size: 10px;
        }

        .ia-card-inner {
            padding: 15px;
        }

        .ia-actions {
            align-items: stretch;
        }

        .ia-actions .ia-btn,
        .ia-actions form,
        .ia-actions form .ia-btn {
            width: 100%;
        }

        .ia-certificate {
            width: 100%;

            justify-content: center;
        }

        .student-profile-head {
            align-items: flex-start;
        }

        .student-profile-photo {
            width: 58px;
            height: 58px;

            border-radius: 15px;
        }

        .student-profile-name {
            font-size: 17px;
        }

        .student-modal-header-top {
            gap: 8px;
        }

        .student-modal-body {
            max-height: calc(92vh - 130px);
        }

    }

</style>


<div class="ia-page">


    {{-- =====================================================
         HEADER
    ====================================================== --}}

    <div class="ia-header">

        <div class="ia-header-left">

            <div class="ia-header-icon">
                <i class="bi bi-people-fill"></i>
            </div>

            <div>

                <h1>
                    Internship Applicants
                </h1>

                <p>
                    Review applications, view student profiles,
                    select candidates and manage internship completion.
                </p>

            </div>

        </div>

    </div>


    {{-- =====================================================
         ALERTS
    ====================================================== --}}

    @if(session('success'))

        <div class="ia-alert ia-alert-success">

            <i class="bi bi-check-circle-fill"></i>

            <span>
                {{ session('success') }}
            </span>

        </div>

    @endif


    @if(session('error'))

        <div class="ia-alert ia-alert-error">

            <i class="bi bi-exclamation-circle-fill"></i>

            <span>
                {{ session('error') }}
            </span>

        </div>

    @endif


    {{-- =====================================================
         SUMMARY
    ====================================================== --}}

    <div class="ia-summary">

        <div class="ia-summary-card">

            <div class="ia-summary-icon all">
                <i class="bi bi-people"></i>
            </div>

            <div class="ia-summary-info">

                <span>
                    Total Applications
                </span>

                <strong>
                    {{ $counts['all'] ?? 0 }}
                </strong>

            </div>

        </div>


        <div class="ia-summary-card">

            <div class="ia-summary-icon new">
                <i class="bi bi-person-plus"></i>
            </div>

            <div class="ia-summary-info">

                <span>
                    New Applications
                </span>

                <strong>
                    {{ $counts['applied'] ?? 0 }}
                </strong>

            </div>

        </div>


        <div class="ia-summary-card">

            <div class="ia-summary-icon selected">
                <i class="bi bi-person-check"></i>
            </div>

            <div class="ia-summary-info">

                <span>
                    Selected
                </span>

                <strong>
                    {{ $counts['selected'] ?? 0 }}
                </strong>

            </div>

        </div>


        <div class="ia-summary-card">

            <div class="ia-summary-icon completed">
                <i class="bi bi-patch-check"></i>
            </div>

            <div class="ia-summary-info">

                <span>
                    Completed
                </span>

                <strong>
                    {{ $counts['completed'] ?? 0 }}
                </strong>

            </div>

        </div>

    </div>


    {{-- =====================================================
         TOOLBAR
    ====================================================== --}}

    <div class="ia-toolbar">

        <form method="GET" class="ia-filters">

            <input
                type="hidden"
                name="tab"
                value="{{ $tab }}"
            >

            <span class="ia-filter-label">

                <i class="bi bi-funnel"></i>

                Internship

            </span>


            <select
                name="internship"
                onchange="this.form.submit()"
            >

                <option value="">
                    All Internships
                </option>

                @foreach($internships as $item)

                    <option
                        value="{{ $item->id }}"
                        @selected(request('internship') == $item->id)
                    >
                        {{ $item->title }}
                    </option>

                @endforeach

            </select>

        </form>


        <div class="ia-tabs">

            @foreach([
                'all' => 'All',
                'applied' => 'New',
                'selected' => 'Selected',
                'completed' => 'Completed',
                'rejected' => 'Rejected',
            ] as $key => $label)

                <a
                    href="{{ request()->fullUrlWithQuery(['tab' => $key]) }}"
                    class="ia-tab {{ $tab === $key ? 'active' : '' }}"
                >

                    {{ $label }}

                    <span>
                        ({{ $counts[$key] ?? 0 }})
                    </span>

                </a>

            @endforeach

        </div>

    </div>


    {{-- =====================================================
         APPLICATION LIST
    ====================================================== --}}

    @forelse($applications as $application)

        @php

            $student = $application->student;

            $studentRegistration =
                $student->studentRegistration ?? null;

            $internship =
                $application->internship;

            $studentName =
                $student->name ?? 'Student';

            $avatarLetter =
                strtoupper(
                    mb_substr($studentName, 0, 1)
                );

            $statusClass = match($application->status) {

                'applied' =>
                    'ia-status-applied',

                'selected' =>
                    'ia-status-selected',

                'rejected' =>
                    'ia-status-rejected',

                'completed' =>
                    'ia-status-completed',

                default =>
                    'ia-status-applied',
            };

            $statusIcon = match($application->status) {

                'applied' =>
                    'bi-clock',

                'selected' =>
                    'bi-check-circle-fill',

                'rejected' =>
                    'bi-x-circle-fill',

                'completed' =>
                    'bi-patch-check-fill',

                default =>
                    'bi-circle',
            };

            /*
            |--------------------------------------------------------------------------
            | Student profile photo
            |--------------------------------------------------------------------------
            */

            $profilePhoto = null;

            if ($studentRegistration?->profile_photo) {

                $profilePhoto =
                    asset(
                        'storage/' .
                        ltrim(
                            $studentRegistration->profile_photo,
                            '/'
                        )
                    );

            }

            /*
            |--------------------------------------------------------------------------
            | Skills
            |--------------------------------------------------------------------------
            */

            $studentSkills =
                $studentRegistration?->skills ?? [];

            if (is_string($studentSkills)) {

                $decodedSkills =
                    json_decode(
                        $studentSkills,
                        true
                    );

                if (json_last_error() === JSON_ERROR_NONE) {

                    $studentSkills =
                        is_array($decodedSkills)
                            ? $decodedSkills
                            : [$studentSkills];

                } else {

                    $studentSkills =
                        array_filter(
                            array_map(
                                'trim',
                                preg_split(
                                    '/[,|]/',
                                    $studentSkills
                                )
                            )
                        );

                }

            }

            if (!is_array($studentSkills)) {
                $studentSkills = [];
            }

        @endphp


        {{-- =================================================
             APPLICATION CARD

             Clicking the card opens student profile.
             Buttons/forms stop propagation.
        ================================================== --}}

        <div
            class="ia-card"
            onclick="openStudentModal({{ $application->id }})"
        >

            <div class="ia-card-inner">


                {{-- TOP --}}

                <div class="ia-card-top">

                    <div class="ia-student">


                        {{-- AVATAR --}}

                        <div class="ia-avatar">

                            @if($profilePhoto)

                                <img
                                    src="{{ $profilePhoto }}"
                                    alt="{{ $studentName }}"
                                >

                            @else

                                {{ $avatarLetter }}

                            @endif

                        </div>


                        <div>

                            <h3 class="ia-name">
                                {{ $studentName }}
                            </h3>

                            <p class="ia-meta">

                                <span class="ia-internship">
                                    {{ $internship->title ?? 'Internship' }}
                                </span>

                                <span>
                                    &nbsp;·&nbsp;
                                </span>

                                Applied
                                {{
                                    optional(
                                        $application->applied_at
                                        ?? $application->created_at
                                    )->diffForHumans()
                                }}

                            </p>

                        </div>

                    </div>


                    {{-- STATUS --}}

                    <span class="ia-status {{ $statusClass }}">

                        <i class="bi {{ $statusIcon }}"></i>

                        {{ ucfirst($application->status) }}

                    </span>

                </div>


                {{-- DETAILS --}}

                <div class="ia-details">

                    @if($internship)

                        <div class="ia-detail">

                            <i class="bi bi-briefcase"></i>

                            <span>
                                {{ $internship->title }}
                            </span>

                        </div>

                    @endif


                    @if($internship?->work_mode)

                        <div class="ia-detail">

                            <i class="bi bi-laptop"></i>

                            <span>
                                {{
                                    ucfirst(
                                        str_replace(
                                            '_',
                                            ' ',
                                            $internship->work_mode
                                        )
                                    )
                                }}
                            </span>

                        </div>

                    @endif


                    @if($internship?->duration)

                        <div class="ia-detail">

                            <i class="bi bi-calendar3"></i>

                            <span>
                                {{ $internship->duration }}
                            </span>

                        </div>

                    @endif


                    @if($student->email)

                        <div class="ia-detail">

                            <i class="bi bi-envelope"></i>

                            <span>
                                {{ $student->email }}
                            </span>

                        </div>

                    @endif

                </div>


                {{-- COVER LETTER --}}

                @if($application->cover_letter)

                    <div class="ia-cover">

                        <div class="ia-cover-title">
                            Cover Letter
                        </div>

                        {{ $application->cover_letter }}

                    </div>

                @endif


                {{-- ACTIONS --}}

                <div
                    class="ia-actions"
                    onclick="event.stopPropagation()"
                >


                    {{-- RESUME --}}

                    @if($application->resume)

                        <a
                            href="{{ $application->resume }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="ia-btn ia-btn-view"
                        >

                            <i class="bi bi-file-earmark-text"></i>

                            View Resume

                        </a>

                    @elseif($studentRegistration?->resume)

                        <a
                            href="{{ asset('storage/' . ltrim($studentRegistration->resume, '/')) }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="ia-btn ia-btn-view"
                        >

                            <i class="bi bi-file-earmark-text"></i>

                            View Resume

                        </a>

                    @endif


                    {{-- APPLIED --}}

                    @if($application->isApplied())

                        <form
                            action="{{ route(
                                'employer.internship-applicants.select',
                                $application
                            ) }}"
                            method="POST"
                            onclick="event.stopPropagation()"
                        >

                            @csrf

                            @method('PATCH')

                            <button
                                type="submit"
                                class="ia-btn ia-btn-select"
                            >

                                <i class="bi bi-check-lg"></i>

                                Select Student

                            </button>

                        </form>


                        <form
                            action="{{ route(
                                'employer.internship-applicants.reject',
                                $application
                            ) }}"
                            method="POST"
                            onclick="event.stopPropagation()"
                            onsubmit="return confirm('Reject this application?');"
                        >

                            @csrf

                            @method('PATCH')

                            <button
                                type="submit"
                                class="ia-btn ia-btn-reject"
                            >

                                <i class="bi bi-x-lg"></i>

                                Reject

                            </button>

                        </form>


                    {{-- SELECTED --}}

                    @elseif($application->isSelected())

                        <button
                            type="button"
                            class="ia-btn ia-btn-complete"
                            onclick="event.stopPropagation(); openCompleteModal({{ $application->id }})"
                        >

                            <i class="bi bi-patch-check"></i>

                            Mark Completed

                        </button>


                        <form
                            action="{{ route(
                                'employer.internship-applicants.reject',
                                $application
                            ) }}"
                            method="POST"
                            onclick="event.stopPropagation()"
                            onsubmit="return confirm('Reject this student instead?');"
                        >

                            @csrf

                            @method('PATCH')

                            <button
                                type="submit"
                                class="ia-btn ia-btn-reject"
                            >

                                <i class="bi bi-x-lg"></i>

                                Reject

                            </button>

                        </form>


                    {{-- COMPLETED --}}

                    @elseif($application->isCompleted())

                        @if($application->certificate)

                            <div class="ia-certificate">

                                <i class="bi bi-patch-check-fill"></i>

                                Certificate:
                                {{ $application->certificate->certificate_number }}

                            </div>

                        @endif

                    @endif

                </div>

            </div>

        </div>


        {{-- =====================================================
             STUDENT PROFILE MODAL
        ====================================================== --}}

        <div
            class="student-modal"
            id="student-modal-{{ $application->id }}"
            onclick="closeStudentModalOutside(event, {{ $application->id }})"
        >

            <div
                class="student-modal-box"
                onclick="event.stopPropagation()"
            >


                {{-- PROFILE HEADER --}}

                <div class="student-modal-header">

                    <div class="student-modal-header-top">

                        <div class="student-profile-head">


                            {{-- PROFILE PHOTO --}}

                            <div class="student-profile-photo">

                                @if($profilePhoto)

                                    <img
                                        src="{{ $profilePhoto }}"
                                        alt="{{ $studentName }}"
                                    >

                                @else

                                    {{ $avatarLetter }}

                                @endif

                            </div>


                            <div>

                                <h2 class="student-profile-name">
                                    {{ $studentName }}
                                </h2>

                                <p class="student-profile-role">

                                    Student
                                    @if($studentRegistration?->course)
                                        · {{ $studentRegistration->course }}
                                    @endif

                                </p>


                                <div class="student-profile-status">

                                    <span class="ia-status {{ $statusClass }}">

                                        <i class="bi {{ $statusIcon }}"></i>

                                        {{ ucfirst($application->status) }}

                                    </span>

                                </div>

                            </div>

                        </div>


                        {{-- CLOSE --}}

                        <button
                            type="button"
                            class="student-modal-close"
                            onclick="closeStudentModal({{ $application->id }})"
                        >

                            <i class="bi bi-x-lg"></i>

                        </button>

                    </div>

                </div>


                {{-- PROFILE BODY --}}

                <div class="student-modal-body">


                    {{-- =================================================
                         CONTACT
                    ================================================== --}}

                    <div class="student-section">

                        <h3 class="student-section-title">

                            <i class="bi bi-person-lines-fill"></i>

                            Contact Information

                        </h3>


                        <div class="student-info-grid">


                            <div class="student-info-item">

                                <span class="student-info-label">
                                    Email
                                </span>

                                <span class="student-info-value">

                                    @if($student->email)

                                        <a href="mailto:{{ $student->email }}">
                                            {{ $student->email }}
                                        </a>

                                    @else

                                        Not provided

                                    @endif

                                </span>

                            </div>


                            <div class="student-info-item">

                                <span class="student-info-label">
                                    Phone
                                </span>

                                <span class="student-info-value">

                                    @if($student->phone)

                                        <a href="tel:{{ $student->phone }}">
                                            {{ $student->phone }}
                                        </a>

                                    @else

                                        Not provided

                                    @endif

                                </span>

                            </div>

                        </div>

                    </div>


                    {{-- =================================================
                         EDUCATION
                    ================================================== --}}

                    <div class="student-section">

                        <h3 class="student-section-title">

                            <i class="bi bi-mortarboard-fill"></i>

                            Education

                        </h3>


                        <div class="student-info-grid">


                            <div class="student-info-item">

                                <span class="student-info-label">
                                    College
                                </span>

                                <span class="student-info-value">

                                    {{
                                        $studentRegistration?->college_name
                                        ?: 'Not provided'
                                    }}

                                </span>

                            </div>


                            <div class="student-info-item">

                                <span class="student-info-label">
                                    University
                                </span>

                                <span class="student-info-value">

                                    {{
                                        $studentRegistration?->university
                                        ?: 'Not provided'
                                    }}

                                </span>

                            </div>


                            <div class="student-info-item">

                                <span class="student-info-label">
                                    Course
                                </span>

                                <span class="student-info-value">

                                    {{
                                        $studentRegistration?->course
                                        ?: 'Not provided'
                                    }}

                                </span>

                            </div>


                            <div class="student-info-item">

                                <span class="student-info-label">
                                    Year
                                </span>

                                <span class="student-info-value">

                                    {{
                                        $studentRegistration?->year
                                        ?: 'Not provided'
                                    }}

                                </span>

                            </div>

                        </div>

                    </div>


                    {{-- =================================================
                         PROFESSIONAL PROFILE
                    ================================================== --}}

                    <div class="student-section">

                        <h3 class="student-section-title">

                            <i class="bi bi-stars"></i>

                            Professional Profile

                        </h3>


                        <div class="student-info-grid">


                            <div class="student-info-item">

                                <span class="student-info-label">
                                    Interested Domain
                                </span>

                                <span class="student-info-value">

                                    {{
                                        $studentRegistration?->interested_domain
                                        ?: 'Not provided'
                                    }}

                                </span>

                            </div>


                            <div class="student-info-item">

                                <span class="student-info-label">
                                    Membership Role
                                </span>

                                <span class="student-info-value">

                                    {{
                                        ucfirst(
                                            $student->role ?? 'Student'
                                        )
                                    }}

                                </span>

                            </div>

                        </div>

                    </div>


                    {{-- =================================================
                         SKILLS
                    ================================================== --}}

                    @if(count($studentSkills))

                        <div class="student-section">

                            <h3 class="student-section-title">

                                <i class="bi bi-lightning-charge-fill"></i>

                                Skills

                            </h3>


                            <div class="student-skills">

                                @foreach($studentSkills as $skill)

                                    @if(is_string($skill) && trim($skill) !== '')

                                        <span class="student-skill">

                                            {{ trim($skill) }}

                                        </span>

                                    @endif

                                @endforeach

                            </div>

                        </div>

                    @endif


                    {{-- =================================================
                         DOCUMENTS
                    ================================================== --}}

                    <div class="student-section">

                        <h3 class="student-section-title">

                            <i class="bi bi-folder2-open"></i>

                            Documents

                        </h3>


                        <div class="student-documents">


                            {{-- RESUME --}}

                            @if($application->resume)

                                <a
                                    href="{{ $application->resume }}"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="student-document-btn"
                                >

                                    <i class="bi bi-file-earmark-person"></i>

                                    Application Resume

                                    <i class="bi bi-box-arrow-up-right"></i>

                                </a>

                            @elseif($studentRegistration?->resume)

                                <a
                                    href="{{ asset('storage/' . ltrim($studentRegistration->resume, '/')) }}"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="student-document-btn"
                                >

                                    <i class="bi bi-file-earmark-person"></i>

                                    Student Resume

                                    <i class="bi bi-box-arrow-up-right"></i>

                                </a>

                            @endif


                            {{-- COLLEGE ID --}}

                            @if($studentRegistration?->college_id_card)

                                <a
                                    href="{{ asset('storage/' . ltrim($studentRegistration->college_id_card, '/')) }}"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="student-document-btn"
                                >

                                    <i class="bi bi-person-vcard"></i>

                                    College ID Card

                                    <i class="bi bi-box-arrow-up-right"></i>

                                </a>

                            @endif


                            @if(
                                !$application->resume &&
                                !$studentRegistration?->resume &&
                                !$studentRegistration?->college_id_card
                            )

                                <span
                                    class="student-document-btn"
                                    style="cursor:default;color:#94a3b8;"
                                >

                                    <i class="bi bi-file-earmark-x"></i>

                                    No documents available

                                </span>

                            @endif

                        </div>

                    </div>


                    {{-- =================================================
                         INTERNSHIP APPLICATION
                    ================================================== --}}

                    <div class="student-section">

                        <h3 class="student-section-title">

                            <i class="bi bi-briefcase-fill"></i>

                            Internship Application

                        </h3>


                        <div class="student-application-box">

                            <div class="student-application-grid">


                                <div class="student-application-item">

                                    <span>
                                        Internship
                                    </span>

                                    <strong>

                                        {{
                                            $internship->title
                                            ?? 'Internship'
                                        }}

                                    </strong>

                                </div>


                                <div class="student-application-item">

                                    <span>
                                        Status
                                    </span>

                                    <strong>

                                        {{ ucfirst($application->status) }}

                                    </strong>

                                </div>


                                <div class="student-application-item">

                                    <span>
                                        Applied
                                    </span>

                                    <strong>

                                        {{
                                            optional(
                                                $application->applied_at
                                                ?? $application->created_at
                                            )->format('d M Y')
                                        }}

                                    </strong>

                                </div>


                                @if($internship?->work_mode)

                                    <div class="student-application-item">

                                        <span>
                                            Work Mode
                                        </span>

                                        <strong>

                                            {{
                                                ucfirst(
                                                    str_replace(
                                                        '_',
                                                        ' ',
                                                        $internship->work_mode
                                                    )
                                                )
                                            }}

                                        </strong>

                                    </div>

                                @endif


                                @if($internship?->duration)

                                    <div class="student-application-item">

                                        <span>
                                            Duration
                                        </span>

                                        <strong>

                                            {{ $internship->duration }}

                                        </strong>

                                    </div>

                                @endif


                                @if($internship?->stipend)

                                    <div class="student-application-item">

                                        <span>
                                            Stipend
                                        </span>

                                        <strong>

                                            {{ $internship->stipend }}

                                        </strong>

                                    </div>

                                @endif

                            </div>

                        </div>

                    </div>


                    {{-- =================================================
                         COVER LETTER
                    ================================================== --}}

                    @if($application->cover_letter)

                        <div class="student-section">

                            <h3 class="student-section-title">

                                <i class="bi bi-chat-left-text-fill"></i>

                                Cover Letter

                            </h3>


                            <div class="student-cover-letter">

                                {{ $application->cover_letter }}

                            </div>

                        </div>

                    @endif


                </div>

            </div>

        </div>


        {{-- =====================================================
             COMPLETE INTERNSHIP MODAL
        ====================================================== --}}

        @if($application->isSelected())

            <div
                class="ia-modal"
                id="complete-modal-{{ $application->id }}"
                onclick="closeCompleteModalOutside(event, {{ $application->id }})"
            >

                <div
                    class="ia-modal-box"
                    onclick="event.stopPropagation()"
                >


                    <div class="ia-modal-head">

                        <div
                            style="
                                display:flex;
                                align-items:flex-start;
                                gap:11px;
                            "
                        >

                            <div class="ia-modal-icon">

                                <i class="bi bi-patch-check"></i>

                            </div>


                            <div>

                                <h3>
                                    Complete Internship
                                </h3>

                                <p class="ia-modal-subtitle">

                                    Mark
                                    {{ $studentName }}'s
                                    internship as completed
                                    and generate the certificate.

                                </p>

                            </div>

                        </div>


                        <button
                            type="button"
                            class="ia-modal-close"
                            onclick="closeCompleteModal({{ $application->id }})"
                        >

                            <i class="bi bi-x-lg"></i>

                        </button>

                    </div>


                    <form
                        action="{{ route(
                            'employer.internship-applicants.complete',
                            $application
                        ) }}"
                        method="POST"
                    >

                        @csrf


                        <label
                            for="performance-{{ $application->id }}"
                        >
                            Performance
                        </label>

                        <select
                            id="performance-{{ $application->id }}"
                            name="performance"
                            required
                        >

                            <option value="excellent">
                                Excellent
                            </option>

                            <option value="very_good">
                                Very Good
                            </option>

                            <option value="good">
                                Good
                            </option>

                            <option value="satisfactory">
                                Satisfactory
                            </option>

                        </select>


                        <label
                            for="comments-{{ $application->id }}"
                        >

                            Comments

                            <span
                                style="
                                    font-weight:500;
                                    color:#94a3b8;
                                "
                            >
                                (Optional)
                            </span>

                        </label>

                        <textarea
                            id="comments-{{ $application->id }}"
                            name="comments"
                            rows="4"
                            maxlength="2000"
                            placeholder="Add a short note about the student's internship performance..."
                        ></textarea>


                        <div class="ia-modal-footer">

                            <button
                                type="button"
                                class="ia-btn ia-btn-view"
                                onclick="closeCompleteModal({{ $application->id }})"
                            >

                                Cancel

                            </button>


                            <button
                                type="submit"
                                class="ia-btn ia-btn-complete"
                            >

                                <i class="bi bi-patch-check-fill"></i>

                                Complete & Generate Certificate

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        @endif

    @empty


        {{-- EMPTY STATE --}}

        <div class="ia-empty">

            <div class="ia-empty-icon">

                <i class="bi bi-people"></i>

            </div>

            <h3>
                No applicants found
            </h3>

            <p>
                There are no internship applications
                matching this filter yet.
            </p>

        </div>

    @endforelse


    {{-- PAGINATION --}}

    @if($applications->hasPages())

        <div class="ia-pagination">

            {{ $applications->withQueryString()->links() }}

        </div>

    @endif

</div>


<script>

    /* =========================================================
       STUDENT PROFILE MODAL
    ========================================================= */

    function openStudentModal(id) {

        const modal =
            document.getElementById(
                'student-modal-' + id
            );

        if (!modal) {
            return;
        }

        modal.classList.add('show');

        document.body.style.overflow = 'hidden';
    }


    function closeStudentModal(id) {

        const modal =
            document.getElementById(
                'student-modal-' + id
            );

        if (!modal) {
            return;
        }

        modal.classList.remove('show');

        document.body.style.overflow = '';
    }


    function closeStudentModalOutside(event, id) {

        if (
            event.target.classList.contains(
                'student-modal'
            )
        ) {

            closeStudentModal(id);

        }

    }


    /* =========================================================
       COMPLETE MODAL
    ========================================================= */

    function openCompleteModal(id) {

        const modal =
            document.getElementById(
                'complete-modal-' + id
            );

        if (!modal) {
            return;
        }

        modal.classList.add('show');

        document.body.style.overflow = 'hidden';
    }


    function closeCompleteModal(id) {

        const modal =
            document.getElementById(
                'complete-modal-' + id
            );

        if (!modal) {
            return;
        }

        modal.classList.remove('show');

        document.body.style.overflow = '';
    }


    function closeCompleteModalOutside(event, id) {

        if (
            event.target.classList.contains(
                'ia-modal'
            )
        ) {

            closeCompleteModal(id);

        }

    }


    /* =========================================================
       ESC KEY
    ========================================================= */

    document.addEventListener(
        'keydown',
        function(event) {

            if (event.key !== 'Escape') {
                return;
            }


            document
                .querySelectorAll(
                    '.student-modal.show'
                )
                .forEach(
                    function(modal) {

                        modal.classList.remove(
                            'show'
                        );

                    }
                );


            document
                .querySelectorAll(
                    '.ia-modal.show'
                )
                .forEach(
                    function(modal) {

                        modal.classList.remove(
                            'show'
                        );

                    }
                );


            document.body.style.overflow = '';

        }
    );

</script>

@endsection