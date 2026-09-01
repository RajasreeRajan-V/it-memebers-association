@extends('layouts.app')

@php($portal = 'mentor')

@section('title', ($mentorship->student->name ?? 'Mentee') . ' - Sessions')

@section('content')

<style>
    :root {
        --mentor-blue: #3376F2;
        --mentor-blue-dark: #245ED1;
        --mentor-purple: #7C4DFF;
        --mentor-bg: #F7F9FF;
        --mentor-card: #FFFFFF;
        --mentor-text: #172033;
        --mentor-muted: #718096;
        --mentor-border: #E7EBF3;
        --mentor-green: #18A957;
        --mentor-red: #E5484D;
        --mentor-amber: #F59E0B;
        --mentor-shadow: 0 8px 30px rgba(30, 55, 100, .07);
    }

    * {
        box-sizing: border-box;
    }

    .mentor-page {
        min-height: 100vh;
        background: var(--mentor-bg);
        color: var(--mentor-text);
        padding-bottom: 50px;
    }

    /* =========================================================
       TOP NAVIGATION
    ========================================================= */

    .mentor-topnav {
        width: 100%;
        height: 72px;
        background: #fff;
        border-bottom: 1px solid var(--mentor-border);
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 42px;
        position: relative;
        z-index: 20;
    }

    .mentor-brand {
        display: flex;
        align-items: center;
        gap: 10px;
        text-decoration: none;
        color: #172033;
        font-size: 21px;
        font-weight: 800;
        white-space: nowrap;
    }

    .mentor-brand-icon {
        width: 35px;
        height: 35px;
        border-radius: 11px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        background: linear-gradient(
            135deg,
            var(--mentor-blue),
            var(--mentor-purple)
        );
        box-shadow: 0 7px 18px rgba(51,118,242,.20);
    }

    .mentor-brand span {
        color: var(--mentor-blue);
    }

    .mentor-nav {
        display: flex;
        align-items: center;
        gap: 34px;
        margin-left: auto;
        margin-right: 35px;
    }

    .mentor-nav a {
        color: #5F687A;
        text-decoration: none;
        font-size: 14px;
        font-weight: 600;
        position: relative;
        padding: 27px 0;
        transition: .2s ease;
    }

    .mentor-nav a:hover,
    .mentor-nav a.active {
        color: var(--mentor-blue);
    }

    .mentor-nav a.active::after {
        content: "";
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: var(--mentor-blue);
        border-radius: 3px 3px 0 0;
    }

    .mentor-nav-right {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .mentor-nav-icon {
        width: 38px;
        height: 38px;
        border: 0;
        background: transparent;
        color: #647087;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        cursor: pointer;
        font-size: 17px;
        transition: .2s ease;
    }

    .mentor-nav-icon:hover {
        background: #F3F6FC;
        color: var(--mentor-blue);
    }

    .mentor-user {
        display: flex;
        align-items: center;
        gap: 10px;
        padding-left: 16px;
        border-left: 1px solid var(--mentor-border);
    }

    .mentor-user-avatar {
        width: 39px;
        height: 39px;
        border-radius: 50%;
        background: linear-gradient(
            135deg,
            #DDE8FF,
            #EDE4FF
        );
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--mentor-blue);
        font-size: 14px;
        font-weight: 800;
    }

    .mentor-user-info {
        line-height: 1.25;
    }

    .mentor-user-name {
        font-size: 13px;
        font-weight: 700;
        color: #172033;
    }

    .mentor-user-role {
        font-size: 11px;
        color: var(--mentor-muted);
        margin-top: 2px;
    }

    /* =========================================================
       MAIN CONTAINER
    ========================================================= */

    .mentor-container {
        width: min(1440px, calc(100% - 70px));
        margin: 0 auto;
        padding-top: 26px;
    }

    /* =========================================================
       BREADCRUMB
    ========================================================= */

    .mentor-breadcrumb {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 18px;
        font-size: 13px;
    }

    .mentor-breadcrumb a {
        color: var(--mentor-blue);
        text-decoration: none;
        font-weight: 600;
    }

    .mentor-breadcrumb i {
        color: #A5ADBC;
        font-size: 11px;
    }

    .mentor-breadcrumb span {
        color: #687286;
    }

    .back-btn {
        margin-left: auto;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #fff;
        border: 1px solid var(--mentor-border);
        border-radius: 9px;
        padding: 9px 14px;
        color: #435067;
        font-size: 12px;
        font-weight: 600;
        text-decoration: none;
        transition: .2s ease;
    }

    .back-btn:hover {
        border-color: #B8C9EE;
        color: var(--mentor-blue);
    }

    /* =========================================================
       MAIN GRID
    ========================================================= */

    .mentor-main-grid {
        display: grid;
        grid-template-columns: minmax(0, 1fr) 330px;
        gap: 22px;
        align-items: start;
    }

    /* =========================================================
       CARDS
    ========================================================= */

    .mentor-card {
        background: var(--mentor-card);
        border: 1px solid var(--mentor-border);
        border-radius: 17px;
        box-shadow: var(--mentor-shadow);
        margin-bottom: 20px;
        overflow: hidden;
    }

    /* =========================================================
       PROFILE HEADER
    ========================================================= */

    .mentor-profile-card {
        position: relative;
        overflow: hidden;
        background:
            radial-gradient(
                circle at 80% 20%,
                rgba(51,118,242,.08),
                transparent 28%
            ),
            linear-gradient(
                135deg,
                #FFFFFF 0%,
                #F7F9FF 100%
            );
    }

    .mentor-profile-card::after {
        content: "";
        position: absolute;
        width: 280px;
        height: 280px;
        right: -100px;
        bottom: -150px;
        border-radius: 50%;
        background: rgba(124,77,255,.05);
        pointer-events: none;
    }

    .mentor-profile-content {
        padding: 27px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 25px;
        position: relative;
        z-index: 2;
    }

    .mentee-profile {
        display: flex;
        align-items: center;
        gap: 18px;
    }

    .mentee-avatar {
        width: 92px;
        height: 92px;
        flex-shrink: 0;
        border-radius: 50%;
        background: linear-gradient(
            135deg,
            #DCE8FF,
            #EEE6FF
        );
        border: 4px solid #fff;
        box-shadow:
            0 0 0 1px #BFD1FF,
            0 8px 25px rgba(51,118,242,.12);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        font-weight: 800;
        color: var(--mentor-blue);
        position: relative;
    }

    .mentee-avatar::after {
        content: "";
        width: 15px;
        height: 15px;
        border-radius: 50%;
        background: #19B86B;
        border: 3px solid #fff;
        position: absolute;
        right: 3px;
        bottom: 5px;
    }

    .mentee-info h1 {
        margin: 0;
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 27px;
        line-height: 1.2;
        letter-spacing: -.5px;
    }

    .active-badge {
        display: inline-flex;
        align-items: center;
        padding: 5px 9px;
        border-radius: 7px;
        background: #EAF9F1;
        color: #159653;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: .2px;
    }

    .mentee-role {
        color: var(--mentor-blue);
        font-size: 14px;
        font-weight: 700;
        margin-top: 7px;
    }

    .mentee-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 18px;
        margin-top: 12px;
    }

    .mentee-meta-item {
        display: flex;
        align-items: center;
        gap: 7px;
        color: #667187;
        font-size: 12px;
    }

    .mentee-meta-item i {
        color: #617089;
    }

    .profile-actions {
        display: flex;
        flex-direction: column;
        gap: 10px;
        min-width: 190px;
    }

    /* =========================================================
       BUTTONS
    ========================================================= */

    .mentor-btn {
        min-height: 42px;
        padding: 10px 17px;
        border-radius: 9px;
        border: 1px solid transparent;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        font-size: 12px;
        font-weight: 700;
        text-decoration: none;
        cursor: pointer;
        transition: .2s ease;
        font-family: inherit;
    }

    .mentor-btn-primary {
        background: var(--mentor-blue);
        color: #fff;
        box-shadow: 0 7px 17px rgba(51,118,242,.18);
    }

    .mentor-btn-primary:hover {
        background: var(--mentor-blue-dark);
        transform: translateY(-1px);
    }

    .mentor-btn-outline {
        background: #fff;
        color: #27344C;
        border-color: #D8DEEA;
    }

    .mentor-btn-outline:hover {
        border-color: #AFC4F5;
        color: var(--mentor-blue);
        background: #F8FAFF;
    }

    .mentor-btn-success {
        background: #EAF9F1;
        color: #159653;
        border-color: #C8EED9;
    }

    .mentor-btn-danger {
        background: #FFF1F1;
        color: #D63B41;
        border-color: #FFD2D4;
    }

    /* =========================================================
       STATISTICS
    ========================================================= */

    .mentor-stats {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        background: #fff;
        border: 1px solid var(--mentor-border);
        border-radius: 16px;
        box-shadow: var(--mentor-shadow);
        margin-bottom: 20px;
        overflow: hidden;
    }

    .mentor-stat {
        padding: 21px 22px;
        display: flex;
        align-items: center;
        gap: 14px;
        border-right: 1px solid var(--mentor-border);
    }

    .mentor-stat:last-child {
        border-right: 0;
    }

    .stat-icon {
        width: 48px;
        height: 48px;
        flex-shrink: 0;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
    }

    .stat-icon.blue {
        color: var(--mentor-blue);
        background: #EAF1FF;
    }

    .stat-icon.green {
        color: #16A35B;
        background: #EAF9F1;
    }

    .stat-icon.purple {
        color: var(--mentor-purple);
        background: #F0EBFF;
    }

    .stat-icon.orange {
        color: #F59E0B;
        background: #FFF5DE;
    }

    .stat-number {
        font-size: 25px;
        font-weight: 800;
        color: #141D31;
        line-height: 1;
    }

    .stat-label {
        color: #657086;
        font-size: 11px;
        margin-top: 6px;
    }

    /* =========================================================
       SECTION HEADER
    ========================================================= */

    .section-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 20px 20px 15px;
    }

    .section-title {
        display: flex;
        align-items: center;
        gap: 9px;
        font-size: 16px;
        font-weight: 800;
        color: #182137;
    }

    .section-title i {
        color: var(--mentor-blue);
        font-size: 16px;
    }

    .section-link {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        color: var(--mentor-blue);
        font-size: 11px;
        font-weight: 700;
        text-decoration: none;
    }

    /* =========================================================
       NEXT SESSION
    ========================================================= */

    .next-session {
        margin: 0 18px 18px;
        border: 1px solid #DCE5F6;
        border-radius: 14px;
        background: #FBFCFF;
        overflow: hidden;
    }

    .next-session-inner {
        display: grid;
        grid-template-columns: 190px minmax(0,1fr) 185px;
        align-items: stretch;
    }

    .session-visual {
        min-height: 140px;
        background: linear-gradient(
            135deg,
            #EEF4FF,
            #F3EEFF
        );
        display: flex;
        align-items: center;
        justify-content: center;
        border-right: 1px solid #E0E6F2;
    }

    .session-visual-icon {
        width: 72px;
        height: 72px;
        border-radius: 50%;
        background: rgba(51,118,242,.10);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--mentor-blue);
        font-size: 27px;
    }

    .session-main {
        padding: 22px 25px;
    }

    .session-label {
        font-size: 10px;
        color: #7A8496;
        font-weight: 700;
        margin-bottom: 6px;
    }

    .session-topic {
        font-size: 17px;
        font-weight: 800;
        color: #182137;
        margin-bottom: 12px;
    }

    .session-info {
        display: flex;
        flex-wrap: wrap;
        gap: 13px;
        font-size: 11px;
        color: #5F6B80;
    }

    .session-info span {
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .session-info i {
        color: #62728F;
    }

    .session-agenda {
        margin-top: 12px;
        font-size: 11px;
        color: #647087;
        line-height: 1.55;
    }

    .session-agenda strong {
        color: #25314A;
    }

    .session-actions {
        padding: 20px 18px;
        border-left: 1px solid #E0E6F2;
        display: flex;
        flex-direction: column;
        justify-content: center;
        gap: 9px;
    }

    /* =========================================================
       SESSION HISTORY
    ========================================================= */

    .history-wrap {
        padding: 0 18px 18px;
        overflow-x: auto;
    }

    .history-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        border: 1px solid #E4E8F0;
        border-radius: 12px;
        overflow: hidden;
        min-width: 750px;
    }

    .history-table th {
        text-align: left;
        background: #F8FAFD;
        color: #7A8496;
        font-size: 10px;
        text-transform: uppercase;
        letter-spacing: .4px;
        font-weight: 700;
        padding: 12px 13px;
        border-bottom: 1px solid #E4E8F0;
    }

    .history-table td {
        padding: 13px;
        font-size: 11px;
        color: #4D596E;
        border-bottom: 1px solid #EDF0F5;
        background: #fff;
        vertical-align: middle;
    }

    .history-table tr:last-child td {
        border-bottom: 0;
    }

    .history-topic {
        display: flex;
        align-items: center;
        gap: 9px;
        color: #202B42;
        font-weight: 700;
    }

    .history-icon {
        width: 28px;
        height: 28px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #EAF1FF;
        color: var(--mentor-blue);
        font-size: 11px;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 5px 8px;
        border-radius: 6px;
        font-size: 10px;
        font-weight: 700;
    }

    .status-completed {
        color: #16894E;
        background: #EAF9F1;
    }

    .status-scheduled {
        color: var(--mentor-blue);
        background: #EAF1FF;
    }

    .status-progress {
        color: #C37A00;
        background: #FFF5DE;
    }

    .status-cancelled {
        color: #D33E43;
        background: #FFF0F0;
    }

    .stars {
        white-space: nowrap;
    }

    .stars i {
        color: #F5B51B;
        font-size: 10px;
        margin-right: 1px;
    }

    .stars i.empty {
        color: #D9DEE7;
    }

    .rating-number {
        color: #69748A;
        margin-left: 5px;
        font-size: 10px;
    }

    .view-notes {
        border: 1px solid #DCE2EC;
        background: #fff;
        border-radius: 7px;
        padding: 7px 10px;
        color: #45536A;
        font-size: 10px;
        font-weight: 700;
        text-decoration: none;
    }

    .view-notes:hover {
        border-color: #B8CAF0;
        color: var(--mentor-blue);
    }

    /* =========================================================
       NOTES
    ========================================================= */

    .notes-card {
        margin: 18px;
        padding: 20px;
        border: 1px solid #DCE5F6;
        background: #FBFCFF;
        border-radius: 14px;
    }

    .notes-title {
        display: flex;
        align-items: center;
        gap: 9px;
        color: #202B42;
        font-size: 14px;
        font-weight: 800;
        margin-bottom: 18px;
    }

    .notes-title i {
        color: var(--mentor-blue);
    }

    .form-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 15px;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-group.full {
        grid-column: 1 / -1;
    }

    .form-label {
        display: block;
        margin-bottom: 7px;
        font-size: 11px;
        color: #455168;
        font-weight: 700;
    }

    .form-control {
        width: 100%;
        border: 1px solid #DCE2EC;
        border-radius: 9px;
        padding: 11px 12px;
        min-height: 43px;
        outline: none;
        background: #fff;
        color: #263249;
        font-family: inherit;
        font-size: 12px;
        transition: .2s ease;
        resize: vertical;
    }

    textarea.form-control {
        min-height: 105px;
    }

    .form-control:focus {
        border-color: #8EB1F7;
        box-shadow: 0 0 0 3px rgba(51,118,242,.08);
    }

    .notes-actions {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 9px;
    }

    /* =========================================================
       SIDEBAR CARDS
    ========================================================= */

    .side-card {
        background: #fff;
        border: 1px solid var(--mentor-border);
        border-radius: 16px;
        box-shadow: var(--mentor-shadow);
        margin-bottom: 20px;
        overflow: hidden;
    }

    .side-card-header {
        padding: 18px 18px 12px;
        font-size: 15px;
        font-weight: 800;
        color: #182137;
    }

    .about-list {
        padding: 0 18px 18px;
    }

    .about-item {
        display: flex;
        gap: 11px;
        padding: 12px 0;
        border-bottom: 1px solid #EEF1F5;
    }

    .about-item:last-child {
        border-bottom: 0;
    }

    .about-icon {
        width: 31px;
        height: 31px;
        flex-shrink: 0;
        border-radius: 8px;
        background: #F0F4FB;
        color: #5C6A82;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
    }

    .about-label {
        color: #8790A1;
        font-size: 10px;
        margin-bottom: 3px;
    }

    .about-value {
        color: #253149;
        font-size: 11px;
        font-weight: 600;
        line-height: 1.45;
    }

    /* =========================================================
       QUICK ACTIONS
    ========================================================= */

    .quick-actions {
        padding: 4px 10px 10px;
    }

    .quick-action {
        width: 100%;
        display: flex;
        align-items: center;
        gap: 11px;
        padding: 13px 9px;
        background: transparent;
        border: 0;
        border-bottom: 1px solid #EEF1F5;
        color: #455168;
        text-decoration: none;
        font-size: 11px;
        font-weight: 600;
        cursor: pointer;
        text-align: left;
    }

    .quick-action:last-child {
        border-bottom: 0;
    }

    .quick-action:hover {
        color: var(--mentor-blue);
    }

    .quick-action i:first-child {
        width: 18px;
        color: var(--mentor-blue);
        font-size: 13px;
    }

    .quick-action .arrow {
        margin-left: auto;
        color: #9AA3B2;
    }

    /* =========================================================
       RESOURCES
    ========================================================= */

    .resource-list {
        padding: 0 15px 15px;
    }

    .resource-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 11px 4px;
        border-bottom: 1px solid #EEF1F5;
    }

    .resource-item:last-child {
        border-bottom: 0;
    }

    .resource-icon {
        width: 34px;
        height: 34px;
        border-radius: 9px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #F0F4FB;
        color: var(--mentor-blue);
    }

    .resource-name {
        font-size: 11px;
        font-weight: 700;
        color: #263149;
    }

    .resource-meta {
        font-size: 9px;
        color: #929AAA;
        margin-top: 3px;
    }

    .resource-empty {
        padding: 15px 5px;
        color: #9098A7;
        font-size: 11px;
        text-align: center;
    }

    /* =========================================================
       EMPTY STATE
    ========================================================= */

    .empty-state {
        padding: 50px 20px;
        text-align: center;
    }

    .empty-icon {
        width: 58px;
        height: 58px;
        border-radius: 17px;
        background: #EEF3FC;
        color: #7182A2;
        margin: 0 auto 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
    }

    .empty-title {
        font-size: 15px;
        font-weight: 800;
        color: #263149;
    }

    .empty-text {
        color: #8790A1;
        font-size: 11px;
        margin-top: 6px;
    }

    /* =========================================================
       MODAL
    ========================================================= */

    .mentor-modal-backdrop {
        position: fixed;
        inset: 0;
        background: rgba(15, 24, 43, .48);
        backdrop-filter: blur(5px);
        display: none;
        align-items: center;
        justify-content: center;
        padding: 20px;
        z-index: 9999;
    }

    .mentor-modal-backdrop.show {
        display: flex;
    }

    .mentor-modal {
        width: min(480px, 100%);
        background: #fff;
        border-radius: 18px;
        padding: 25px;
        box-shadow: 0 25px 70px rgba(15,30,60,.22);
        animation: modalIn .2s ease;
    }

    @keyframes modalIn {
        from {
            opacity: 0;
            transform: translateY(10px) scale(.98);
        }
        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    .modal-title {
        font-size: 19px;
        font-weight: 800;
        margin-bottom: 7px;
    }

    .modal-subtitle {
        color: #758096;
        font-size: 11px;
        line-height: 1.6;
        margin-bottom: 20px;
    }

    .modal-actions {
        display: flex;
        justify-content: flex-end;
        gap: 9px;
        margin-top: 18px;
    }

    /* =========================================================
       MOBILE
    ========================================================= */

    @media (max-width: 1100px) {
        .mentor-main-grid {
            grid-template-columns: 1fr;
        }

        .mentor-sidebar {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .mentor-sidebar .side-card {
            margin-bottom: 0;
        }
    }

    @media (max-width: 850px) {
        .mentor-topnav {
            padding: 0 20px;
        }

        .mentor-nav {
            display: none;
        }

        .mentor-container {
            width: min(100% - 30px, 720px);
            padding-top: 18px;
        }

        .mentor-profile-content {
            flex-direction: column;
            align-items: flex-start;
        }

        .profile-actions {
            width: 100%;
            flex-direction: row;
        }

        .profile-actions .mentor-btn {
            flex: 1;
        }

        .mentor-stats {
            grid-template-columns: repeat(2, 1fr);
        }

        .mentor-stat:nth-child(2) {
            border-right: 0;
        }

        .mentor-stat:nth-child(-n+2) {
            border-bottom: 1px solid var(--mentor-border);
        }

        .next-session-inner {
            grid-template-columns: 1fr;
        }

        .session-visual {
            min-height: 110px;
            border-right: 0;
            border-bottom: 1px solid #E0E6F2;
        }

        .session-actions {
            border-left: 0;
            border-top: 1px solid #E0E6F2;
            flex-direction: row;
        }

        .session-actions .mentor-btn {
            flex: 1;
        }

        .mentor-sidebar {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 600px) {
        .mentor-topnav {
            height: 64px;
        }

        .mentor-brand {
            font-size: 18px;
        }

        .mentor-user {
            padding-left: 8px;
        }

        .mentor-user-info,
        .mentor-nav-icon {
            display: none;
        }

        .mentor-container {
            width: calc(100% - 20px);
        }

        .mentor-breadcrumb {
            flex-wrap: wrap;
        }

        .back-btn {
            margin-left: 0;
            width: 100%;
            justify-content: center;
        }

        .mentee-profile {
            align-items: flex-start;
        }

        .mentee-avatar {
            width: 70px;
            height: 70px;
            font-size: 22px;
        }

        .mentee-info h1 {
            font-size: 21px;
        }

        .mentee-meta {
            flex-direction: column;
            gap: 7px;
        }

        .profile-actions {
            flex-direction: column;
        }

        .mentor-stats {
            grid-template-columns: 1fr 1fr;
        }

        .mentor-stat {
            padding: 16px 12px;
            gap: 9px;
        }

        .stat-icon {
            width: 40px;
            height: 40px;
        }

        .stat-number {
            font-size: 21px;
        }

        .section-header {
            padding: 17px 15px 13px;
        }

        .next-session {
            margin: 0 12px 12px;
        }

        .session-main {
            padding: 18px;
        }

        .session-actions {
            padding: 14px;
            flex-direction: column;
        }

        .form-grid {
            grid-template-columns: 1fr;
        }

        .form-group.full {
            grid-column: auto;
        }

        .notes-card {
            margin: 12px;
            padding: 15px;
        }

        .notes-actions {
            flex-direction: column;
        }

        .notes-actions .mentor-btn {
            width: 100%;
        }
    }
</style>


<div class="mentor-page">




    <main class="mentor-container">

        {{-- =====================================================
             BREADCRUMB
        ====================================================== --}}
        <div class="mentor-breadcrumb">

            <a href="{{ route('mentor.mentees.index') }}">
                Mentees
            </a>

            <i class="fa-solid fa-chevron-right"></i>

            <span>
                {{ $mentorship->student->name }}
            </span>

            <a href="{{ route('mentor.mentees.index') }}"
               class="back-btn">
                <i class="fa-solid fa-arrow-left"></i>
                Back to Mentees
            </a>

        </div>


        <div class="mentor-main-grid">

            {{-- =================================================
                 LEFT CONTENT
            ================================================== --}}
            <div class="mentor-content">


                {{-- =================================================
                     PROFILE HEADER
                ================================================== --}}
                <div class="mentor-card mentor-profile-card">

                    <div class="mentor-profile-content">

                        <div class="mentee-profile">

                            <div class="mentee-avatar">
                                {{ strtoupper(substr($mentorship->student->name ?? 'M', 0, 1)) }}
                            </div>

                            <div class="mentee-info">

                                <h1>
                                    {{ $mentorship->student->name }}

                                    <span class="active-badge">
                                        Active
                                    </span>
                                </h1>

                                <div class="mentee-role">
                                    Mentee
                                </div>

                                <div class="mentee-meta">

                                    <div class="mentee-meta-item">
                                        <i class="fa-solid fa-bullseye"></i>

                                        <span>
                                            <strong>Career Goal:</strong>
                                            {{ $mentorship->career_goal ?? 'Not specified' }}
                                        </span>
                                    </div>

                                    @if($mentorship->started_at)
                                        <div class="mentee-meta-item">
                                            <i class="fa-regular fa-calendar"></i>

                                            <span>
                                                Mentorship started on
                                                {{ \Carbon\Carbon::parse($mentorship->started_at)->format('d M Y') }}
                                            </span>
                                        </div>
                                    @endif

                                </div>

                            </div>

                        </div>


                        <div class="profile-actions">

                            <a href="{{ route('mentor.sessions.create', $mentorship) }}"
                               class="mentor-btn mentor-btn-primary">

                                <i class="fa-solid fa-plus"></i>

                                Schedule Session

                            </a>


                            <button type="button"
                                    class="mentor-btn mentor-btn-outline"
                                    onclick="openCompleteModal()">

                                <i class="fa-solid fa-check-double"></i>

                                Complete Mentorship

                            </button>

                        </div>

                    </div>

                </div>


                {{-- =================================================
                     STATISTICS
                ================================================== --}}
                <div class="mentor-stats">

                    <div class="mentor-stat">

                        <div class="stat-icon blue">
                            <i class="fa-regular fa-calendar"></i>
                        </div>

                        <div>
                            <div class="stat-number">
                                {{ $mentorship->sessions->whereIn('status', ['scheduled', 'confirmed'])->count() }}
                            </div>

                            <div class="stat-label">
                                Upcoming Sessions
                            </div>
                        </div>

                    </div>


                    <div class="mentor-stat">

                        <div class="stat-icon green">
                            <i class="fa-solid fa-circle-check"></i>
                        </div>

                        <div>
                            <div class="stat-number">
                                {{ $mentorship->sessions->where('status', 'completed')->count() }}
                            </div>

                            <div class="stat-label">
                                Completed Sessions
                            </div>
                        </div>

                    </div>


                    <div class="mentor-stat">

                        <div class="stat-icon purple">
                            <i class="fa-solid fa-users"></i>
                        </div>

                        <div>
                            <div class="stat-number">
                                {{ $mentorship->sessions->count() }}
                            </div>

                            <div class="stat-label">
                                Total Sessions
                            </div>
                        </div>

                    </div>


                    <div class="mentor-stat">

                        <div class="stat-icon orange">
                            <i class="fa-solid fa-star"></i>
                        </div>

                        <div>
                            <div class="stat-number">

                                @if($avgRating !== null)
                                    {{ number_format($avgRating, 1) }}
                                @else
                                    —
                                @endif

                            </div>

                            <div class="stat-label">
                                Average Rating
                                @if($ratedCount > 0)
                                    · {{ $ratedCount }} reviews
                                @endif
                            </div>

                        </div>

                    </div>

                </div>


                {{-- =================================================
                     NEXT SESSION
                ================================================== --}}
                @if($upcoming)

                    <div class="mentor-card">

                        <div class="section-header">

                            <div class="section-title">
                                <i class="fa-regular fa-calendar-check"></i>
                                Next Session
                            </div>

                            <a href="#session-history"
                               class="section-link">

                                View all sessions
                                <i class="fa-solid fa-arrow-right"></i>

                            </a>

                        </div>


                        <div class="next-session">

                            <div class="next-session-inner">

                                <div class="session-visual">

                                    <div class="session-visual-icon">
                                        <i class="fa-solid fa-video"></i>
                                    </div>

                                </div>


                                <div class="session-main">

                                    <div class="session-label">
                                        SESSION TOPIC
                                    </div>

                                    <div class="session-topic">
                                        {{ $upcoming->topic }}
                                    </div>

                                    <div class="session-info">

                                        <span>
                                            <i class="fa-regular fa-calendar"></i>

                                            {{ \Carbon\Carbon::parse($upcoming->session_date)->format('d M Y') }}
                                        </span>

                                        <span>
                                            <i class="fa-regular fa-clock"></i>

                                            {{ \Carbon\Carbon::parse($upcoming->start_time)->format('h:i A') }}

                                            @if($upcoming->duration_minutes)
                                                - {{ \Carbon\Carbon::parse($upcoming->start_time)->addMinutes($upcoming->duration_minutes)->format('h:i A') }}
                                            @endif

                                        </span>

                                        <span>
                                            <i class="fa-solid fa-video"></i>
                                            {{ ucfirst($upcoming->meeting_type) }}
                                        </span>

                                    </div>


                                    @if($upcoming->agenda)

                                        <div class="session-agenda">
                                            <strong>Agenda:</strong>
                                            {{ $upcoming->agenda }}
                                        </div>

                                    @endif

                                </div>


                                <div class="session-actions">

                                    @if(in_array($upcoming->status, ['scheduled', 'confirmed']))

                                        <form method="POST"
                                              action="{{ route('mentor.sessions.conduct', $upcoming) }}">

                                            @csrf

                                            <button type="submit"
                                                    class="mentor-btn mentor-btn-primary"
                                                    style="width:100%;">

                                                <i class="fa-regular fa-circle-play"></i>

                                                Start Session

                                            </button>

                                        </form>

                                    @endif


                                    @if($upcoming->meeting_link)

                                        <a href="{{ $upcoming->meeting_link }}"
                                           target="_blank"
                                           rel="noopener noreferrer"
                                           class="mentor-btn mentor-btn-outline">

                                            <i class="fa-solid fa-video"></i>

                                            Join Meeting

                                        </a>

                                    @endif

                                </div>

                            </div>

                        </div>

                    </div>

                @else

                    <div class="mentor-card">

                        <div class="empty-state">

                            <div class="empty-icon">
                                <i class="fa-regular fa-calendar"></i>
                            </div>

                            <div class="empty-title">
                                No Upcoming Session
                            </div>

                            <div class="empty-text">
                                Schedule the next mentorship session with
                                {{ $mentorship->student->name }}.
                            </div>

                            <div style="margin-top:16px;">

                                <a href="{{ route('mentor.sessions.create', $mentorship) }}"
                                   class="mentor-btn mentor-btn-primary">

                                    <i class="fa-solid fa-plus"></i>
                                    Schedule Session

                                </a>

                            </div>

                        </div>

                    </div>

                @endif


                {{-- =================================================
                     SESSION HISTORY
                ================================================== --}}
                <div class="mentor-card"
                     id="session-history">

                    <div class="section-header">

                        <div class="section-title">

                            <i class="fa-solid fa-clock-rotate-left"></i>

                            Session History

                        </div>

                        <span style="
                            font-size:10px;
                            color:#7A8496;
                            font-weight:700;
                        ">
                            {{ $mentorship->sessions->count() }} Sessions
                        </span>

                    </div>


                    @if($mentorship->sessions->count())

                        <div class="history-wrap">

                            <table class="history-table">

                                <thead>

                                    <tr>

                                        <th>Session</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Duration</th>
                                        <th>Status</th>
                                        <th>Rating</th>
                                        <th>Action</th>

                                    </tr>

                                </thead>

                                <tbody>

                                    @foreach($mentorship->sessions as $session)

                                        <tr>

                                            <td>

                                                <div class="history-topic">

                                                    <span class="history-icon">
                                                        <i class="fa-solid fa-comments"></i>
                                                    </span>

                                                    <span>
                                                        {{ $session->topic }}
                                                    </span>

                                                </div>

                                            </td>


                                            <td>

                                                {{ \Carbon\Carbon::parse($session->session_date)->format('d M Y') }}

                                            </td>


                                            <td>

                                                {{ \Carbon\Carbon::parse($session->start_time)->format('h:i A') }}

                                            </td>


                                            <td>

                                                {{ $session->duration_minutes ?? '—' }} min

                                            </td>


                                            <td>

                                                @if($session->status === 'completed')

                                                    <span class="status-badge status-completed">
                                                        <i class="fa-solid fa-check"></i>
                                                        Completed
                                                    </span>

                                                @elseif(in_array($session->status, ['scheduled', 'confirmed']))

                                                    <span class="status-badge status-scheduled">
                                                        <i class="fa-regular fa-calendar"></i>
                                                        {{ ucfirst($session->status) }}
                                                    </span>

                                                @elseif($session->status === 'in_progress')

                                                    <span class="status-badge status-progress">
                                                        <i class="fa-solid fa-spinner"></i>
                                                        In Progress
                                                    </span>

                                                @else

                                                    <span class="status-badge status-cancelled">
                                                        <i class="fa-solid fa-xmark"></i>
                                                        {{ ucfirst($session->status) }}
                                                    </span>

                                                @endif

                                            </td>


                                            <td>

                                                @if($session->feedback)

                                                    <div class="stars">

                                                        @for($i = 1; $i <= 5; $i++)

                                                            @if($i <= (int)$session->feedback->rating)

                                                                <i class="fa-solid fa-star"></i>

                                                            @else

                                                                <i class="fa-solid fa-star empty"></i>

                                                            @endif

                                                        @endfor

                                                        <span class="rating-number">
                                                            {{ $session->feedback->rating }}/5
                                                        </span>

                                                    </div>

                                                @elseif($session->status === 'completed')

                                                    <span style="
                                                        font-size:10px;
                                                        color:#98A0AF;
                                                    ">
                                                        Not rated
                                                    </span>

                                                @else

                                                    <span style="color:#B7BFCC;">
                                                        —
                                                    </span>

                                                @endif

                                            </td>


                                            <td>

                                                @if($session->status === 'in_progress')

                                                    <a href="#notes-{{ $session->id }}"
                                                       class="view-notes">

                                                        <i class="fa-solid fa-pen"></i>
                                                        Add Notes

                                                    </a>

                                                @elseif($session->mentor_notes)

                                                    <a href="#notes-history-{{ $session->id }}"
                                                       class="view-notes">

                                                        View Notes

                                                    </a>

                                                @else

                                                    <span style="
                                                        font-size:10px;
                                                        color:#A0A8B8;
                                                    ">
                                                        —
                                                    </span>

                                                @endif

                                            </td>

                                        </tr>

                                    @endforeach

                                </tbody>

                            </table>

                        </div>


                        {{-- ==========================================
                             ACTIVE SESSION NOTES
                        =========================================== --}}

                        @foreach($mentorship->sessions->where('status', 'in_progress') as $session)

                            <div class="notes-card"
                                 id="notes-{{ $session->id }}">

                                <div class="notes-title">

                                    <i class="fa-solid fa-note-sticky"></i>

                                    Session Notes —
                                    {{ $session->topic }}

                                </div>


                                <form method="POST"
                                      action="{{ route('mentor.sessions.notes', $session) }}">

                                    @csrf

                                    <div class="form-grid">

                                        <div class="form-group full">

                                            <label class="form-label">
                                                Session Summary / Key Discussion Points
                                            </label>

                                            <textarea name="mentor_notes"
                                                      class="form-control"
                                                      required
                                                      placeholder="Write the key discussion points, progress and observations...">{{ $session->mentor_notes }}</textarea>

                                        </div>


                                        <div class="form-group">

                                            <label class="form-label">
                                                Homework / Action Items
                                            </label>

                                            <textarea name="homework"
                                                      class="form-control"
                                                      placeholder="Add homework or action items...">{{ $session->homework }}</textarea>

                                        </div>


                                        <div class="form-group">

                                            <label class="form-label">
                                                Resources
                                            </label>

                                            <textarea name="resources"
                                                      class="form-control"
                                                      placeholder="Add useful resources, links or documents...">{{ $session->resources }}</textarea>

                                        </div>

                                    </div>


                                    <div class="notes-actions">

                                        <button type="submit"
                                                class="mentor-btn mentor-btn-outline">

                                            <i class="fa-solid fa-floppy-disk"></i>

                                            Save Notes

                                        </button>

                                    </div>

                                </form>


                                <form method="POST"
                                      action="{{ route('mentor.sessions.complete', $session) }}"
                                      style="margin-top:10px;">

                                    @csrf

                                    <button type="submit"
                                            class="mentor-btn mentor-btn-primary">

                                        <i class="fa-solid fa-check-double"></i>

                                        Mark Session Completed

                                    </button>

                                </form>

                            </div>

                        @endforeach


                    @else

                        <div class="empty-state">

                            <div class="empty-icon">
                                <i class="fa-regular fa-calendar"></i>
                            </div>

                            <div class="empty-title">
                                No Sessions Yet
                            </div>

                            <div class="empty-text">
                                Schedule the first mentorship session to get started.
                            </div>

                            <div style="margin-top:16px;">

                                <a href="{{ route('mentor.sessions.create', $mentorship) }}"
                                   class="mentor-btn mentor-btn-primary">

                                    <i class="fa-solid fa-plus"></i>
                                    Schedule First Session

                                </a>

                            </div>

                        </div>

                    @endif

                </div>

            </div>


            {{-- =================================================
                 RIGHT SIDEBAR
            ================================================== --}}
            <aside class="mentor-sidebar">


                {{-- =============================================
                     ABOUT MENTEE
                ============================================== --}}
                <div class="side-card">

                    <div class="side-card-header">
                        About {{ $mentorship->student->name }}
                    </div>

                    <div class="about-list">

                        <div class="about-item">

                            <div class="about-icon">
                                <i class="fa-regular fa-user"></i>
                            </div>

                            <div>
                                <div class="about-label">
                                    Name
                                </div>

                                <div class="about-value">
                                    {{ $mentorship->student->name }}
                                </div>
                            </div>

                        </div>


                        @if(isset($mentorship->student->email))

                            <div class="about-item">

                                <div class="about-icon">
                                    <i class="fa-regular fa-envelope"></i>
                                </div>

                                <div>
                                    <div class="about-label">
                                        Email
                                    </div>

                                    <div class="about-value">
                                        {{ $mentorship->student->email }}
                                    </div>
                                </div>

                            </div>

                        @endif


                        <div class="about-item">

                            <div class="about-icon">
                                <i class="fa-solid fa-bullseye"></i>
                            </div>

                            <div>
                                <div class="about-label">
                                    Career Goal
                                </div>

                                <div class="about-value">
                                    {{ $mentorship->career_goal ?? 'Not specified' }}
                                </div>
                            </div>

                        </div>


                        <div class="about-item">

                            <div class="about-icon">
                                <i class="fa-regular fa-calendar"></i>
                            </div>

                            <div>
                                <div class="about-label">
                                    Mentorship Status
                                </div>

                                <div class="about-value">
                                    {{ ucfirst($mentorship->status) }}
                                </div>
                            </div>

                        </div>


                        @if($mentorship->started_at)

                            <div class="about-item">

                                <div class="about-icon">
                                    <i class="fa-solid fa-flag"></i>
                                </div>

                                <div>
                                    <div class="about-label">
                                        Started
                                    </div>

                                    <div class="about-value">
                                        {{ \Carbon\Carbon::parse($mentorship->started_at)->format('d M Y') }}
                                    </div>
                                </div>

                            </div>

                        @endif

                    </div>

                </div>


                {{-- =============================================
                     QUICK ACTIONS
                ============================================== --}}
                <div class="side-card">

                    <div class="side-card-header">
                        Quick Actions
                    </div>

                    <div class="quick-actions">

                        <a href="{{ route('mentor.sessions.create', $mentorship) }}"
                           class="quick-action">

                            <i class="fa-regular fa-calendar-plus"></i>

                            <span>
                                Schedule New Session
                            </span>

                            <i class="fa-solid fa-chevron-right arrow"></i>

                        </a>


                        <a href="#session-history"
                           class="quick-action">

                            <i class="fa-regular fa-calendar"></i>

                            <span>
                                View All Sessions
                            </span>

                            <i class="fa-solid fa-chevron-right arrow"></i>

                        </a>


                        @if($upcoming && $upcoming->meeting_link)

                            <a href="{{ $upcoming->meeting_link }}"
                               target="_blank"
                               rel="noopener noreferrer"
                               class="quick-action">

                                <i class="fa-solid fa-video"></i>

                                <span>
                                    Join Next Meeting
                                </span>

                                <i class="fa-solid fa-chevron-right arrow"></i>

                            </a>

                        @endif


                        <a href="#session-history"
                           class="quick-action">

                            <i class="fa-regular fa-star"></i>

                            <span>
                                View Feedback
                            </span>

                            <i class="fa-solid fa-chevron-right arrow"></i>

                        </a>

                    </div>

                </div>


                {{-- =============================================
                     SHARED RESOURCES
                ============================================== --}}
                <div class="side-card">

                    <div class="side-card-header">
                        Shared Resources
                    </div>

                    <div class="resource-list">

                        <div class="resource-empty">

                            <i class="fa-regular fa-folder-open"
                               style="
                                   display:block;
                                   font-size:23px;
                                   margin-bottom:8px;
                                   color:#A2ABC0;
                               "></i>

                            Resources shared with this mentee
                            will appear here.

                        </div>

                        <a href="#"
                           class="section-link"
                           style="
                               padding:10px 4px 3px;
                               display:flex;
                               justify-content:center;
                           ">

                            View all resources
                            <i class="fa-solid fa-arrow-right"></i>

                        </a>

                    </div>

                </div>


            </aside>

        </div>

    </main>


    {{-- =========================================================
         COMPLETE MENTORSHIP MODAL
    ========================================================== --}}
    <div class="mentor-modal-backdrop"
         id="complete-modal">

        <div class="mentor-modal">

            <div class="modal-title">
                Complete Mentorship
            </div>

            <div class="modal-subtitle">

                Complete the mentorship with
                <strong>{{ $mentorship->student->name }}</strong>.

                Please provide the reason and any final notes.

            </div>


            <form method="POST"
                  action="{{ route('mentor.mentees.complete', $mentorship) }}">

                @csrf


                <div class="form-group">

                    <label class="form-label">
                        Completion Reason
                    </label>

                    <select name="completion_reason"
                            class="form-control"
                            required>

                        <option value="goals_completed">
                            Goals completed
                        </option>

                        <option value="student_requested">
                            Student requested
                        </option>

                        <option value="mentor_requested">
                            Mentor requested
                        </option>

                        <option value="other">
                            Other
                        </option>

                    </select>

                </div>


                <div class="form-group">

                    <label class="form-label">
                        Completion Notes
                    </label>

                    <textarea name="completion_notes"
                              class="form-control"
                              placeholder="Add any final notes about this mentorship..."></textarea>

                </div>


                <div class="modal-actions">

                    <button type="button"
                            class="mentor-btn mentor-btn-outline"
                            onclick="closeCompleteModal()">

                        Cancel

                    </button>


                    <button type="submit"
                            class="mentor-btn mentor-btn-primary">

                        <i class="fa-solid fa-check"></i>

                        Confirm Completion

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


<script>

    function openCompleteModal() {
        document
            .getElementById('complete-modal')
            .classList.add('show');

        document.body.style.overflow = 'hidden';
    }

    function closeCompleteModal() {
        document
            .getElementById('complete-modal')
            .classList.remove('show');

        document.body.style.overflow = '';
    }


    document.addEventListener('click', function(event) {

        const modal = document.getElementById('complete-modal');

        if (event.target === modal) {
            closeCompleteModal();
        }

    });


    document.addEventListener('keydown', function(event) {

        if (event.key === 'Escape') {
            closeCompleteModal();
        }

    });

</script>

@endsection