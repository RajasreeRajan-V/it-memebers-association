@extends('layouts.app')

@php($portal = 'student')

@section('title', 'My Mentorship')

@section('content')

<style>
    /* =========================================================
       TECH LEADERS NETWORK - STUDENT MENTORSHIP
       Redesigned spacing pass: larger type, more breathing room,
       fewer cramped elements per row.
    ========================================================= */

    :root {
        --tl-primary: #3376F2;
        --tl-primary-dark: #245ED1;
        --tl-bg: #F6F8FC;
        --tl-white: #FFFFFF;
        --tl-text: #172033;
        --tl-muted: #718096;
        --tl-light-text: #8A94A8;
        --tl-border: #E5EAF2;
        --tl-soft-blue: #EEF4FF;
        --tl-soft-purple: #F2EDFF;
        --tl-green: #18A957;
        --tl-soft-green: #EAF9F0;
        --tl-orange: #D99000;
        --tl-soft-orange: #FFF6E5;
        --tl-red: #D13B40;
        --tl-soft-red: #FFF0F0;
        --tl-shadow: 0 4px 20px rgba(35, 60, 110, .06);
        --tl-gap-lg: 28px;
        --tl-gap-md: 20px;
    }

    * {
        box-sizing: border-box;
    }

    html, body {
        overflow-x: hidden;
        max-width: 100%;
    }

    .mentorship-page {
        width: 100%;
        min-height: calc(100vh - 130px);
        background: var(--tl-bg);
        color: var(--tl-text);
        font-family: 'Inter', sans-serif;
        padding: 24px 0 56px;
        overflow-x: hidden;
    }

    /* =========================================================
       HERO
    ========================================================= */

    .mentorship-hero {
        width: 100%;
        min-height: 320px;
        background: #fff;
        border: 1px solid var(--tl-border);
        border-radius: 16px;
        overflow: hidden;
        margin: 0 var(--tl-gap-lg) var(--tl-gap-lg);
        position: relative;
    }

    .mentorship-hero-inner {
        min-height: 320px;
        display: grid;
        grid-template-columns: 1.3fr .8fr .9fr;
        align-items: center;
        padding: 44px 48px;
        gap: 36px;
    }

    /* =========================================================
       HERO LEFT
    ========================================================= */

    .hero-left {
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        width: fit-content;
        padding: 8px 16px;
        border-radius: 30px;
        background: var(--tl-soft-blue);
        color: var(--tl-primary);
        font-size: 13px;
        font-weight: 600;
        margin-bottom: 18px;
    }

    .hero-badge i {
        font-size: 12px;
    }

    .hero-title {
        margin: 0 0 16px;
        font-family: 'Inter', sans-serif;
        font-size: clamp(30px, 3.2vw, 40px);
        line-height: 1.18;
        letter-spacing: -0.8px;
        font-weight: 800;
        color: #172033;
        max-width: 560px;
    }

    .hero-title .blue {
        color: #3376F2;
        font-weight: 800;
        display: block;
    }

    .hero-description {
        max-width: 520px;
        margin: 0 0 26px;
        color: #66748B;
        font-size: 15px;
        line-height: 1.75;
    }

    .hero-actions {
        display: flex;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
    }

    .hero-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        min-height: 48px;
        padding: 0 22px;
        border-radius: 8px;
        text-decoration: none;
        font-size: 14px;
        font-weight: 700;
        transition: .2s ease;
    }

    .hero-btn-primary {
        background: var(--tl-primary);
        color: #fff;
        box-shadow: 0 6px 14px rgba(51, 118, 242, .2);
    }

    .hero-btn-primary:hover {
        background: var(--tl-primary-dark);
        color: #fff;
        transform: translateY(-1px);
    }

    .hero-btn-secondary {
        background: #fff;
        color: var(--tl-primary);
        border: 1px solid #D9E3F7;
    }

    .hero-btn-secondary:hover {
        background: var(--tl-soft-blue);
        color: var(--tl-primary);
    }

    /* =========================================================
       HERO ILLUSTRATION
    ========================================================= */

    .hero-visual {
        height: 250px;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
    }

    .visual-circle {
        position: absolute;
        width: 170px;
        height: 170px;
        border-radius: 50%;
        background: #F3F7FF;
    }

    .mentor-illustration {
        position: relative;
        width: 160px;
        height: 180px;
        z-index: 2;
    }

    .illustration-card {
        position: absolute;
        width: 108px;
        height: 132px;
        background: #fff;
        border: 1px solid #DCE6F8;
        border-radius: 9px;
        left: 10px;
        top: 18px;
        transform: rotate(-4deg);
        box-shadow: 0 10px 24px rgba(50, 82, 140, .09);
    }

    .illustration-avatar {
        position: absolute;
        width: 33px;
        height: 33px;
        border-radius: 50%;
        background: #DDEAFF;
        top: 15px;
        left: 14px;
    }

    .illustration-line {
        position: absolute;
        height: 5px;
        border-radius: 10px;
        background: #DCE5F3;
        left: 54px;
        right: 12px;
    }

    .illustration-line.one { top: 21px; }
    .illustration-line.two { top: 31px; right: 27px; }
    .illustration-line.three { top: 60px; left: 14px; right: 14px; }
    .illustration-line.four { top: 73px; left: 14px; right: 24px; }
    .illustration-line.five { top: 86px; left: 14px; right: 32px; }
    .illustration-line.six { top: 99px; left: 14px; right: 20px; }

    .illustration-check {
        position: absolute;
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: #E5F8EF;
        color: var(--tl-green);
        display: flex;
        align-items: center;
        justify-content: center;
        right: 0;
        top: 12px;
        font-size: 14px;
        box-shadow: 0 6px 16px rgba(24, 169, 87, .1);
    }

    .illustration-person {
        position: absolute;
        right: 1px;
        bottom: 10px;
        width: 56px;
        height: 56px;
        border-radius: 50%;
        background: #E8F0FF;
        border: 6px solid #fff;
        box-shadow: 0 6px 18px rgba(51, 118, 242, .14);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--tl-primary);
        font-size: 23px;
    }

    .illustration-connection {
        position: absolute;
        width: 48px;
        height: 2px;
        background: #BFD2F8;
        right: 40px;
        bottom: 38px;
        transform: rotate(-28deg);
    }

    /* =========================================================
       HERO BENEFITS
    ========================================================= */

    .hero-benefits {
        display: flex;
        flex-direction: column;
        gap: 22px;
        padding-left: 8px;
    }

    .benefit-item {
        display: flex;
        align-items: center;
        gap: 13px;
    }

    .benefit-icon {
        width: 36px;
        height: 36px;
        flex-shrink: 0;
        border-radius: 9px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 13px;
    }

    .benefit-icon.blue {
        background: var(--tl-soft-blue);
        color: var(--tl-primary);
    }

    .benefit-icon.purple {
        background: var(--tl-soft-purple);
        color: #7C4DFF;
    }

    .benefit-icon.green {
        background: #EAF9F0;
        color: #18A957;
    }

    .benefit-text strong {
        display: block;
        font-size: 14px;
        font-weight: 700;
        margin-bottom: 4px;
    }

    .benefit-text span {
        display: block;
        color: #8A94A8;
        font-size: 12px;
    }

    /* =========================================================
       MAIN THREE COLUMN AREA
    ========================================================= */

    .main-grid {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        gap: var(--tl-gap-md);
        align-items: start;
        margin: 0 var(--tl-gap-lg) var(--tl-gap-lg);
    }

    .ui-card {
        background: #fff;
        border: 1px solid var(--tl-border);
        border-radius: 12px;
        overflow: hidden;
        box-shadow: var(--tl-shadow);
    }

    .ui-card-header {
        padding: 20px 20px 18px;
        border-bottom: 1px solid var(--tl-border);
    }

    .ui-card-title-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
    }

    .ui-card-title {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 16px;
        font-weight: 700;
        color: #263752;
    }

    .number-icon {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--tl-primary);
        color: #fff;
        font-size: 12px;
        font-weight: 700;
        flex-shrink: 0;
    }

    .card-icon {
        width: 30px;
        height: 30px;
        border-radius: 8px;
        background: var(--tl-soft-blue);
        color: var(--tl-primary);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 13px;
        flex-shrink: 0;
    }

    .ui-card-subtitle {
        margin: 8px 0 0;
        color: #8A94A8;
        font-size: 12.5px;
        line-height: 1.6;
    }

    .ui-card-body {
        padding: 20px;
    }

    /* =========================================================
       REQUEST CARD
    ========================================================= */

    .request-info {
        background: #F8FAFE;
        border: 1px solid #EAF0FA;
        border-radius: 10px;
        padding: 16px;
        margin-bottom: 18px;
    }

    .request-info-title {
        font-size: 13px;
        font-weight: 700;
        color: #3D4A60;
        margin-bottom: 7px;
    }

    .request-info-text {
        font-size: 12.5px;
        line-height: 1.65;
        color: #8A94A8;
    }

    .request-points {
        margin: 0 0 20px;
        padding: 0;
        list-style: none;
    }

    .request-points li {
        display: flex;
        align-items: center;
        gap: 9px;
        font-size: 12.5px;
        color: #66748B;
        margin-bottom: 13px;
    }

    .request-points li:last-child {
        margin-bottom: 0;
    }

    .request-points i {
        color: var(--tl-primary);
        font-size: 11px;
    }

    .full-btn {
        width: 100%;
        min-height: 46px;
        border: 0;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        background: var(--tl-primary);
        color: #fff;
        font-size: 13px;
        font-weight: 700;
        text-decoration: none;
        transition: .2s ease;
    }

    .full-btn:hover {
        background: var(--tl-primary-dark);
        color: #fff;
        transform: translateY(-1px);
    }

    /* =========================================================
       ACTIVE MENTOR
    ========================================================= */

    .mentor-selected {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 16px;
        background: #FAFCFF;
        border: 1px solid #E8EEF8;
        border-radius: 10px;
        margin-bottom: 16px;
    }

    .mentor-avatar {
        width: 46px;
        height: 46px;
        flex-shrink: 0;
        border-radius: 50%;
        background: linear-gradient(135deg, #3376F2, #6C8FF5);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 15px;
        font-weight: 700;
    }

    .mentor-details {
        min-width: 0;
        flex: 1;
    }

    .mentor-name {
        font-size: 13.5px;
        font-weight: 700;
        color: #263752;
        margin-bottom: 4px;
    }

    .mentor-role {
        color: #8A94A8;
        font-size: 11.5px;
    }

    .mentor-status {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        color: #18A957;
        background: #EAF9F0;
        border-radius: 20px;
        padding: 7px 11px;
        font-size: 10px;
        font-weight: 700;
        flex-shrink: 0;
    }

    .online-dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: #18A957;
    }

    .view-mentors {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        color: var(--tl-primary);
        text-decoration: none;
        font-size: 12px;
        font-weight: 700;
        white-space: nowrap;
    }

    .view-mentors:hover {
        color: var(--tl-primary-dark);
    }

    .mentor-empty {
        text-align: center;
        padding: 18px 6px 8px;
    }

    .mentor-empty-icon {
        width: 50px;
        height: 50px;
        border-radius: 13px;
        margin: 0 auto 14px;
        background: var(--tl-soft-blue);
        color: var(--tl-primary);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
    }

    .mentor-empty strong {
        display: block;
        font-size: 13.5px;
        margin-bottom: 7px;
    }

    .mentor-empty span {
        display: block;
        font-size: 12px;
        color: #8A94A8;
        line-height: 1.65;
        margin-bottom: 16px;
    }

    .small-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        padding: 10px 16px;
        border-radius: 7px;
        background: #fff;
        border: 1px solid #D9E3F7;
        color: var(--tl-primary);
        font-size: 11.5px;
        font-weight: 700;
        text-decoration: none;
    }

    .small-btn:hover {
        background: var(--tl-soft-blue);
        color: var(--tl-primary);
    }

    /* =========================================================
       RECENT REQUESTS
    ========================================================= */

    .request-list {
        padding: 4px 0;
    }

    .request-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 14px 20px;
        border-bottom: 1px solid #F0F2F7;
        text-decoration: none;
        color: inherit;
    }

    .request-item:last-child {
        border-bottom: 0;
    }

    .request-item:hover {
        background: #FBFCFF;
    }

    .request-file-icon {
        width: 38px;
        height: 38px;
        flex-shrink: 0;
        border-radius: 9px;
        background: var(--tl-soft-blue);
        color: var(--tl-primary);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 13px;
    }

    .request-content {
        min-width: 0;
        flex: 1;
    }

    .request-title {
        font-size: 12.5px;
        font-weight: 700;
        color: #354157;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        margin-bottom: 4px;
    }

    .request-date {
        font-size: 10.5px;
        color: #9AA3B2;
    }

    .status-pill {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 6px 10px;
        border-radius: 20px;
        font-size: 10px;
        font-weight: 700;
        white-space: nowrap;
        flex-shrink: 0;
    }

    .status-pill.pending {
        color: #B77700;
        background: var(--tl-soft-orange);
    }

    .status-pill.accepted {
        color: #148548;
        background: var(--tl-soft-green);
    }

    .status-pill.rejected,
    .status-pill.cancelled {
        color: var(--tl-red);
        background: var(--tl-soft-red);
    }

    .status-pill.time {
        color: var(--tl-primary);
        background: var(--tl-soft-blue);
    }

    .no-requests {
        text-align: center;
        padding: 42px 20px;
    }

    .no-requests i {
        display: block;
        font-size: 26px;
        color: #C8D3E7;
        margin-bottom: 12px;
    }

    .no-requests strong {
        display: block;
        font-size: 12.5px;
        margin-bottom: 6px;
    }

    .no-requests span {
        display: block;
        color: #8A94A8;
        font-size: 11.5px;
        line-height: 1.6;
    }

    /* =========================================================
       ACTIVE MENTOR BAR
    ========================================================= */

    .active-mentor-bar {
        margin: 0 var(--tl-gap-lg) var(--tl-gap-lg);
        background: #fff;
        border: 1px solid var(--tl-border);
        border-radius: 12px;
        padding: 18px 22px;
        box-shadow: var(--tl-shadow);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 18px;
    }

    .active-mentor-left {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .active-mentor-check {
        width: 36px;
        height: 36px;
        border-radius: 9px;
        background: var(--tl-soft-green);
        color: var(--tl-green);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 13px;
        flex-shrink: 0;
    }

    .active-mentor-text strong {
        display: block;
        font-size: 13.5px;
        margin-bottom: 4px;
    }

    .active-mentor-text span {
        color: #8A94A8;
        font-size: 12px;
    }

    /* =========================================================
       SESSION SECTION
    ========================================================= */

    .content-section {
        margin: 0 var(--tl-gap-lg) var(--tl-gap-lg);
    }

    .section-heading {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        margin-bottom: 16px;
    }

    .section-heading-title {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 17px;
        font-weight: 700;
        color: #263752;
    }

    .section-heading-icon {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--tl-soft-blue);
        color: var(--tl-primary);
        font-size: 12px;
    }

    .view-all {
        color: var(--tl-primary);
        text-decoration: none;
        font-size: 12.5px;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        white-space: nowrap;
    }

    .view-all:hover {
        color: var(--tl-primary-dark);
    }

    /* =========================================================
       UPCOMING SESSION
    ========================================================= */

    .session-card {
        background: #fff;
        border: 1px solid var(--tl-border);
        border-radius: 12px;
        box-shadow: var(--tl-shadow);
        padding: 24px;
        position: relative;
        overflow: hidden;
    }

    .session-card::before {
        content: "";
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        width: 4px;
        background: var(--tl-primary);
    }

    .session-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        margin-bottom: 16px;
    }

    .session-status {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 7px 12px;
        border-radius: 20px;
        background: var(--tl-soft-blue);
        color: var(--tl-primary);
        font-size: 10.5px;
        font-weight: 700;
    }

    .session-status-dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: currentColor;
    }

    .session-next {
        color: #A0A8B8;
        font-size: 11px;
    }

    .session-topic {
        font-size: 18px;
        font-weight: 700;
        color: #263752;
        margin-bottom: 16px;
    }

    .session-meta {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
    }

    .session-meta-item {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 9px 13px;
        border-radius: 7px;
        background: #F8FAFD;
        border: 1px solid #EDF0F6;
        color: #748096;
        font-size: 11.5px;
    }

    .session-meta-item i {
        color: var(--tl-primary);
    }

    .session-actions {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
        margin-top: 20px;
    }

    .action-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        min-height: 40px;
        padding: 0 16px;
        border-radius: 7px;
        font-size: 12px;
        font-weight: 700;
        text-decoration: none;
        border: 0;
        cursor: pointer;
    }

    .action-btn.primary {
        background: var(--tl-primary);
        color: #fff;
    }

    .action-btn.primary:hover {
        background: var(--tl-primary-dark);
        color: #fff;
    }

    .action-btn.secondary {
        background: #fff;
        border: 1px solid #DCE3EE;
        color: #526077;
    }

    .action-btn.secondary:hover {
        color: var(--tl-primary);
        background: #F8FAFF;
    }

    /* =========================================================
       SESSION HISTORY TABLE
    ========================================================= */

    .history-card {
        background: #fff;
        border: 1px solid var(--tl-border);
        border-radius: 12px;
        overflow: hidden;
        box-shadow: var(--tl-shadow);
    }

    .history-header {
        padding: 18px 22px;
        border-bottom: 1px solid var(--tl-border);
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .history-title {
        display: flex;
        align-items: center;
        gap: 9px;
        font-size: 14.5px;
        font-weight: 700;
    }

    .history-title i {
        color: var(--tl-primary);
    }

    .history-count {
        color: #9AA3B2;
        font-size: 11.5px;
    }

    .table-wrap {
        overflow-x: auto;
    }

    .modern-table {
        width: 100%;
        min-width: 640px;
        border-collapse: collapse;
    }

    .modern-table th {
        background: #FAFBFE;
        color: #8490A5;
        padding: 13px 22px;
        text-align: left;
        font-size: 10.5px;
        text-transform: uppercase;
        letter-spacing: .5px;
        font-weight: 800;
        border-bottom: 1px solid var(--tl-border);
    }

    .modern-table td {
        padding: 16px 22px;
        border-bottom: 1px solid #F0F2F7;
        font-size: 12px;
        color: #566176;
        vertical-align: middle;
    }

    .modern-table tbody tr:last-child td {
        border-bottom: 0;
    }

    .modern-table tbody tr:hover {
        background: #FBFCFF;
    }

    .topic-cell {
        color: #354157;
        font-weight: 700;
    }

    .date-cell {
        white-space: nowrap;
        color: #748096;
        font-size: 12px;
    }

    /* =========================================================
       REQUEST HISTORY
    ========================================================= */

    .request-history-card {
        background: #fff;
        border: 1px solid var(--tl-border);
        border-radius: 12px;
        overflow: hidden;
        box-shadow: var(--tl-shadow);
        margin: 0 var(--tl-gap-lg) var(--tl-gap-lg);
    }

    .request-history-header {
        padding: 20px 22px;
        border-bottom: 1px solid var(--tl-border);
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .request-history-title {
        display: flex;
        align-items: center;
        gap: 9px;
        font-size: 16px;
        font-weight: 700;
    }

    .request-history-title i {
        color: var(--tl-primary);
    }

    .request-count {
        font-size: 11.5px;
        color: #8A94A8;
    }

    .history-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 760px;
    }

    .history-table th {
        background: #FAFBFE;
        padding: 13px 22px;
        text-align: left;
        color: #8490A5;
        font-size: 10.5px;
        text-transform: uppercase;
        letter-spacing: .5px;
        font-weight: 800;
        border-bottom: 1px solid var(--tl-border);
    }

    .history-table td {
        padding: 16px 22px;
        font-size: 12px;
        border-bottom: 1px solid #F0F2F7;
        vertical-align: middle;
    }

    .history-table tbody tr:last-child td {
        border-bottom: 0;
    }

    .person-cell {
        display: flex;
        align-items: center;
        gap: 11px;
    }

    .person-avatar {
        width: 34px;
        height: 34px;
        border-radius: 9px;
        background: var(--tl-soft-blue);
        color: var(--tl-primary);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 11px;
        font-weight: 800;
        flex-shrink: 0;
    }

    .person-name {
        font-size: 12px;
        font-weight: 700;
        color: #354157;
    }

    .career-goal {
        max-width: 240px;
        color: #68758B;
        line-height: 1.55;
        font-size: 12px;
    }

    .suggestion-box {
        background: #F7F9FF;
        border: 1px solid #E5EBF8;
        border-radius: 8px;
        padding: 10px 12px;
        color: #657188;
        font-size: 11px;
        margin-bottom: 9px;
        line-height: 1.6;
    }

    .cancel-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        padding: 9px 13px;
        border-radius: 7px;
        background: var(--tl-soft-red);
        border: 1px solid #FFD9DA;
        color: var(--tl-red);
        font-size: 11px;
        font-weight: 700;
        cursor: pointer;
    }

    .cancel-btn:hover {
        background: #FFE5E5;
    }

    .accept-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        padding: 9px 13px;
        border-radius: 7px;
        background: var(--tl-primary);
        color: #fff;
        border: 0;
        font-size: 11px;
        font-weight: 700;
        cursor: pointer;
    }

    .accept-btn:hover {
        background: var(--tl-primary-dark);
    }

    /* =========================================================
       NO ACTIVE MENTOR
    ========================================================= */

    .start-card {
        margin: 0 var(--tl-gap-lg) var(--tl-gap-lg);
        background: #fff;
        border: 1px solid var(--tl-border);
        border-radius: 14px;
        box-shadow: var(--tl-shadow);
        padding: 40px 32px;
        text-align: center;
    }

    .start-icon {
        width: 64px;
        height: 64px;
        border-radius: 16px;
        background: var(--tl-soft-blue);
        color: var(--tl-primary);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 18px;
        font-size: 24px;
    }

    .start-card h3 {
        margin: 0 0 10px;
        font-size: 19px;
    }

    .start-card p {
        max-width: 480px;
        margin: 0 auto 22px;
        color: #8A94A8;
        font-size: 13px;
        line-height: 1.75;
    }

    /* =========================================================
       RESPONSIVE
    ========================================================= */

    @media (max-width: 1150px) {

        .main-grid {
            grid-template-columns: 1fr 1fr;
        }

        .main-grid > .ui-card:last-child {
            grid-column: 1 / -1;
        }

    }

    @media (max-width: 900px) {

        .mentorship-hero-inner {
            grid-template-columns: 1fr 1fr;
            padding: 36px;
        }

        .hero-visual {
            display: none;
        }
    }

    @media (max-width: 760px) {

        :root {
            --tl-gap-lg: 16px;
            --tl-gap-md: 16px;
        }

        .mentorship-hero {
            border-radius: 12px;
        }

        .mentorship-hero-inner {
            grid-template-columns: 1fr;
            padding: 30px 24px;
        }

        .hero-benefits {
            flex-direction: row;
            flex-wrap: wrap;
            padding-left: 0;
            gap: 18px 26px;
        }

        .main-grid {
            grid-template-columns: 1fr;
        }

        .main-grid > .ui-card:last-child {
            grid-column: auto;
        }
    }

    @media (max-width: 600px) {

        .mentorship-page {
            padding: 16px 0 32px;
        }

        .mentorship-hero-inner {
            min-height: auto;
            padding: 26px 20px;
        }

        .hero-title {
            font-size: 28px;
        }

        .hero-description {
            font-size: 13px;
        }

        .hero-actions {
            flex-direction: column;
            align-items: stretch;
        }

        .hero-btn {
            width: 100%;
        }

        .hero-benefits {
            display: grid;
            grid-template-columns: 1fr 1fr;
        }

        .active-mentor-bar {
            align-items: flex-start;
            flex-direction: column;
        }
    }

    @media (max-width: 420px) {

        .hero-benefits {
            grid-template-columns: 1fr;
        }

        .ui-card-header,
        .ui-card-body {
            padding: 16px;
        }
    }
</style>

<div class="mentorship-page">


{{-- =====================================================
     HERO
====================================================== --}}

<section class="mentorship-hero">

    <div class="mentorship-hero-inner">

        {{-- LEFT --}}
        <div class="hero-left">

            <div class="hero-badge">
                <i class="fa-solid fa-graduation-cap"></i>
                Student Mentorship
            </div>

            <h1 class="hero-title">
                Grow Your Career
                <span class="blue">With the Right Mentor</span>
            </h1>

            <p class="hero-description">
                Get personalized guidance, build your skills, prepare for
                your career and learn directly from experienced industry
                professionals.
            </p>

            <div class="hero-actions">

                @if($activeMentorship)

                    <a href="{{ route('student.mentors.show', $activeMentorship->mentor) }}"
                       class="hero-btn hero-btn-primary">

                        <i class="fa-solid fa-user-tie"></i>
                        View My Mentor

                    </a>

                    <a href="{{ route('student.sessions.upcoming') }}"
                       class="hero-btn hero-btn-secondary">

                        <i class="fa-regular fa-calendar"></i>
                        View Sessions

                    </a>

                @else

                    <a href="{{ route('student.mentors.index') }}"
                       class="hero-btn hero-btn-primary">

                        <i class="fa-solid fa-user-plus"></i>
                        Find a Mentor

                    </a>

                    <a href="#request-history"
                       class="hero-btn hero-btn-secondary">

                        <i class="fa-solid fa-clock-rotate-left"></i>
                        View Requests

                    </a>

                @endif

            </div>

        </div>


        {{-- CENTER ILLUSTRATION --}}
        <div class="hero-visual">

            <div class="visual-circle"></div>

            <div class="mentor-illustration">

                <div class="illustration-card">

                    <div class="illustration-avatar"></div>

                    <div class="illustration-line one"></div>
                    <div class="illustration-line two"></div>
                    <div class="illustration-line three"></div>
                    <div class="illustration-line four"></div>
                    <div class="illustration-line five"></div>
                    <div class="illustration-line six"></div>

                </div>

                <div class="illustration-check">
                    <i class="fa-solid fa-check"></i>
                </div>

                <div class="illustration-connection"></div>

                <div class="illustration-person">
                    <i class="fa-solid fa-user-tie"></i>
                </div>

            </div>

        </div>


        {{-- RIGHT BENEFITS --}}
        <div class="hero-benefits">

            <div class="benefit-item">

                <div class="benefit-icon blue">
                    <i class="fa-solid fa-user-tie"></i>
                </div>

                <div class="benefit-text">
                    <strong>Expert Mentors</strong>
                    <span>Verified professionals</span>
                </div>

            </div>


            <div class="benefit-item">

                <div class="benefit-icon purple">
                    <i class="fa-solid fa-comments"></i>
                </div>

                <div class="benefit-text">
                    <strong>Personal Guidance</strong>
                    <span>Learn directly from experts</span>
                </div>

            </div>


            <div class="benefit-item">

                <div class="benefit-icon green">
                    <i class="fa-solid fa-chart-line"></i>
                </div>

                <div class="benefit-text">
                    <strong>Career Growth</strong>
                    <span>Build skills and confidence</span>
                </div>

            </div>

        </div>

    </div>

</section>


{{-- =====================================================
     ACTIVE MENTOR BAR
====================================================== --}}

@if($activeMentorship)

    <div class="active-mentor-bar">

        <div class="active-mentor-left">

            <div class="active-mentor-check">
                <i class="fa-solid fa-check"></i>
            </div>

            <div class="active-mentor-text">

                <strong>
                    Your mentorship is currently active
                </strong>

                <span>
                    You are connected with
                    {{ $activeMentorship->mentor->name }}
                </span>

            </div>

        </div>

        <a href="{{ route('student.mentors.show', $activeMentorship->mentor) }}"
           class="view-all">

            View Mentor Profile
            <i class="fa-solid fa-arrow-right"></i>

        </a>

    </div>

@endif


{{-- =====================================================
     THREE MAIN CARDS
====================================================== --}}

<div class="main-grid">


    {{-- =================================================
         CARD 1 - REQUEST MENTORSHIP
    ================================================== --}}

    <div class="ui-card">

        <div class="ui-card-header">

            <div class="ui-card-title-row">

                <div class="ui-card-title">

                    <span class="number-icon">
                        1
                    </span>

                    Request Mentorship

                </div>

            </div>

            <p class="ui-card-subtitle">
                Find the right mentor for your career journey.
            </p>

        </div>


        <div class="ui-card-body">

            <div class="request-info">

                <div class="request-info-title">
                    Start your mentorship journey
                </div>

                <div class="request-info-text">
                    Choose an experienced professional and send a
                    personalized mentorship request.
                </div>

            </div>


            <ul class="request-points">

                <li>
                    <i class="fa-solid fa-check"></i>
                    Career-focused guidance
                </li>

                <li>
                    <i class="fa-solid fa-check"></i>
                    One-to-one mentoring
                </li>

                <li>
                    <i class="fa-solid fa-check"></i>
                    Industry experience
                </li>

                <li>
                    <i class="fa-solid fa-check"></i>
                    Personalized career advice
                </li>

            </ul>


            <a href="{{ route('student.mentors.index') }}"
               class="full-btn">

                <i class="fa-solid fa-magnifying-glass"></i>
                Explore Mentors

            </a>

        </div>

    </div>


    {{-- =================================================
         CARD 2 - SELECTED MENTOR
    ================================================== --}}

    <div class="ui-card">

        <div class="ui-card-header">

            <div class="ui-card-title-row">

                <div class="ui-card-title">

                    <span class="card-icon">
                        <i class="fa-solid fa-user-tie"></i>
                    </span>

                    Select a Mentor

                </div>

                <a href="{{ route('student.mentors.index') }}"
                   class="view-mentors">

                    View All
                    <i class="fa-solid fa-arrow-right"></i>

                </a>

            </div>

            <p class="ui-card-subtitle">
                Choose the right mentor for your professional growth.
            </p>

        </div>


        <div class="ui-card-body">

            @if($activeMentorship)

                <div class="mentor-selected">

                    <div class="mentor-avatar">

                        {{ strtoupper(substr($activeMentorship->mentor->name, 0, 1)) }}

                    </div>


                    <div class="mentor-details">

                        <div class="mentor-name">

                            {{ $activeMentorship->mentor->name }}

                        </div>

                        <div class="mentor-role">

                            {{ $activeMentorship->mentor->mentorRegistration->designation
                                ?? 'Professional Mentor' }}

                        </div>

                    </div>


                    <div class="mentor-status">

                        <span class="online-dot"></span>
                        Active

                    </div>

                </div>


                <a href="{{ route('student.mentors.show', $activeMentorship->mentor) }}"
                   class="full-btn">

                    <i class="fa-solid fa-user"></i>
                    View Mentor Profile

                </a>

            @else

                <div class="mentor-empty">

                    <div class="mentor-empty-icon">

                        <i class="fa-solid fa-users"></i>

                    </div>

                    <strong>No Active Mentor Yet</strong>

                    <span>
                        Explore our mentor community and choose an
                        experienced professional who matches your goals.
                    </span>

                    <a href="{{ route('student.mentors.index') }}"
                       class="small-btn">

                        <i class="fa-solid fa-magnifying-glass"></i>
                        Find a Mentor

                    </a>

                </div>

            @endif

        </div>

    </div>


    {{-- =================================================
         CARD 3 - RECENT REQUESTS
    ================================================== --}}

    <div class="ui-card">

        <div class="ui-card-header">

            <div class="ui-card-title-row">

                <div class="ui-card-title">

                    <span class="card-icon">
                        <i class="fa-solid fa-file-lines"></i>
                    </span>

                    Recent Requests

                </div>

            </div>

            <p class="ui-card-subtitle">
                Track the status of your mentorship requests.
            </p>

        </div>


        @if($requests->count())

            <div class="request-list">

                @foreach($requests->take(4) as $r)

                    <div class="request-item">

                        <div class="request-file-icon">

                            <i class="fa-solid fa-file-lines"></i>

                        </div>


                        <div class="request-content">

                            <div class="request-title">

                                {{ $r->mentor->name }}

                            </div>

                            <div class="request-date">

                                {{ $r->created_at->format('d M Y') }}

                            </div>

                        </div>


                        @switch($r->status)

                            @case('pending')

                                <span class="status-pill pending">
                                    Pending
                                </span>

                                @break

                            @case('accepted')

                                <span class="status-pill accepted">
                                    Accepted
                                </span>

                                @break

                            @case('rejected')

                                <span class="status-pill rejected">
                                    Rejected
                                </span>

                                @break

                            @case('time_suggested')

                                <span class="status-pill time">
                                    New Time
                                </span>

                                @break

                            @case('cancelled')

                                <span class="status-pill cancelled">
                                    Cancelled
                                </span>

                                @break

                            @default

                                <span class="status-pill time">
                                    {{ ucfirst($r->status) }}
                                </span>

                        @endswitch

                    </div>

                @endforeach

            </div>

        @else

            <div class="no-requests">

                <i class="fa-solid fa-inbox"></i>

                <strong>
                    No Requests Yet
                </strong>

                <span>
                    Your mentorship requests will appear here.
                </span>

            </div>

        @endif

    </div>

</div>


{{-- =====================================================
     NO ACTIVE MENTOR
====================================================== --}}

@if(!$activeMentorship)

    <div class="start-card">

        <div class="start-icon">
            <i class="fa-solid fa-user-graduate"></i>
        </div>

        <h3>
            Start Your Mentorship Journey
        </h3>

        <p>
            You don't have an active mentor yet. Explore experienced
            professionals and find someone who can guide you toward
            your career goals.
        </p>

        <a href="{{ route('student.mentors.index') }}"
           class="hero-btn hero-btn-primary">

            <i class="fa-solid fa-user-plus"></i>
            Find a Mentor

        </a>

    </div>

@endif


{{-- =====================================================
     UPCOMING SESSION
====================================================== --}}

@if($activeMentorship)

    <div class="content-section">

        <div class="section-heading">

            <div class="section-heading-title">

                <span class="section-heading-icon">
                    <i class="fa-solid fa-video"></i>
                </span>

                Upcoming Session

            </div>

            <a href="{{ route('student.sessions.upcoming') }}"
               class="view-all">

                View All
                <i class="fa-solid fa-arrow-right"></i>

            </a>

        </div>


        @if($upcomingSession)

            <div class="session-card">

                <div class="session-top">

                    <span class="session-status">

                        <span class="session-status-dot"></span>

                        {{ ucfirst($upcomingSession->status) }}

                    </span>

                    <span class="session-next">
                        Next Session
                    </span>

                </div>


                <div class="session-topic">

                    {{ $upcomingSession->topic }}

                </div>


                <div class="session-meta">

                    <div class="session-meta-item">

                        <i class="fa-regular fa-calendar"></i>

                        {{ $upcomingSession->session_date->format('d M Y') }}

                    </div>


                    <div class="session-meta-item">

                        <i class="fa-regular fa-clock"></i>

                        {{ \Carbon\Carbon::parse($upcomingSession->start_time)->format('h:i A') }}

                    </div>


                    <div class="session-meta-item">

                        <i class="fa-solid fa-video"></i>

                        {{ ucfirst($upcomingSession->meeting_type) }}

                    </div>

                </div>


                <div class="session-actions">

                    @if($upcomingSession->status === 'scheduled')

                        <form method="POST"
                              action="{{ route('student.sessions.confirm', $upcomingSession) }}">

                            @csrf

                            <button type="submit"
                                    class="action-btn primary">

                                <i class="fa-solid fa-check"></i>
                                Confirm Attendance

                            </button>

                        </form>

                    @endif


                    @if($upcomingSession->meeting_link)

                        <a href="{{ $upcomingSession->meeting_link }}"
                           target="_blank"
                           rel="noopener noreferrer"
                           class="action-btn secondary">

                            <i class="fa-solid fa-video"></i>
                            Join Session

                        </a>

                    @endif

                </div>

            </div>

        @else

            <div class="ui-card"
                 style="padding:40px 24px;text-align:center;">

                <div class="mentor-empty-icon"
                     style="margin-bottom:14px;">

                    <i class="fa-regular fa-calendar-xmark"></i>

                </div>

                <strong style="font-size:13.5px;">
                    No Upcoming Sessions
                </strong>

                <div style="font-size:12px;color:#8A94A8;margin-top:7px;">
                    Your scheduled mentorship sessions will appear here.
                </div>

            </div>

        @endif

    </div>


    {{-- =====================================================
         SESSION HISTORY
    ====================================================== --}}

    @if($sessionHistory && $sessionHistory->count())

        <div class="content-section">

            <div class="section-heading">

                <div class="section-heading-title">

                    <span class="section-heading-icon">
                        <i class="fa-solid fa-clock-rotate-left"></i>
                    </span>

                    Session History

                </div>

            </div>


            <div class="history-card">

                <div class="history-header">

                    <div class="history-title">

                        <i class="fa-solid fa-list-check"></i>
                        Previous Sessions

                    </div>

                    <span class="history-count">
                        {{ $sessionHistory->count() }} Sessions
                    </span>

                </div>


                <div class="table-wrap">

                    <table class="modern-table">

                        <thead>

                            <tr>

                                <th>Topic</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Action</th>

                            </tr>

                        </thead>


                        <tbody>

                            @foreach($sessionHistory as $s)

                                <tr>

                                    <td>

                                        <span class="topic-cell">
                                            {{ $s->topic }}
                                        </span>

                                    </td>


                                    <td>

                                        <span class="date-cell">

                                            <i class="fa-regular fa-calendar"
                                               style="margin-right:5px;"></i>

                                            {{ $s->session_date->format('d M Y') }}

                                        </span>

                                    </td>


                                    <td>

                                        @if($s->status === 'completed')

                                            <span class="status-pill accepted">

                                                <i class="fa-solid fa-check"
                                                   style="margin-right:5px;"></i>

                                                Completed

                                            </span>

                                        @elseif(in_array($s->status, ['scheduled', 'confirmed']))

                                            <span class="status-pill time">

                                                <i class="fa-regular fa-calendar"
                                                   style="margin-right:5px;"></i>

                                                Upcoming

                                            </span>

                                        @else

                                            <span class="status-pill rejected">

                                                {{ ucfirst($s->status) }}

                                            </span>

                                        @endif

                                    </td>


                                    <td>

                                        <a href="{{ route('student.sessions.show', $s) }}"
                                           class="view-all">

                                            View
                                            <i class="fa-solid fa-arrow-right"></i>

                                        </a>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    @endif

@endif


{{-- =====================================================
     REQUEST HISTORY
====================================================== --}}

<div class="request-history-card"
     id="request-history">

    <div class="request-history-header">

        <div class="request-history-title">

            <i class="fa-solid fa-paper-plane"></i>

            Request History

        </div>

        <span class="request-count">

            {{ $requests->count() }} Requests

        </span>

    </div>


    @if($requests->count())

        <div class="table-wrap">

            <table class="history-table">

                <thead>

                    <tr>

                        <th>Mentor</th>
                        <th>Career Goal</th>
                        <th>Status</th>
                        <th>Requested</th>
                        <th>Action</th>

                    </tr>

                </thead>


                <tbody>

                    @foreach($requests as $r)

                        <tr>

                            {{-- MENTOR --}}

                            <td>

                                <div class="person-cell">

                                    <div class="person-avatar">

                                        {{ strtoupper(substr($r->mentor->name, 0, 1)) }}

                                    </div>

                                    <div class="person-name">

                                        {{ $r->mentor->name }}

                                    </div>

                                </div>

                            </td>


                            {{-- CAREER GOAL --}}

                            <td>

                                <div class="career-goal">

                                    {{ $r->career_goal }}

                                </div>

                            </td>


                            {{-- STATUS --}}

                            <td>

                                @switch($r->status)

                                    @case('pending')

                                        <span class="status-pill pending">

                                            <i class="fa-solid fa-hourglass-half"
                                               style="margin-right:5px;"></i>

                                            Pending

                                        </span>

                                        @break


                                    @case('accepted')

                                        <span class="status-pill accepted">

                                            <i class="fa-solid fa-check"
                                               style="margin-right:5px;"></i>

                                            Accepted

                                        </span>

                                        @break


                                    @case('rejected')

                                        <span class="status-pill rejected">

                                            <i class="fa-solid fa-xmark"
                                               style="margin-right:5px;"></i>

                                            Rejected

                                        </span>

                                        @break


                                    @case('time_suggested')

                                        <span class="status-pill time">

                                            <i class="fa-regular fa-clock"
                                               style="margin-right:5px;"></i>

                                            New Time Suggested

                                        </span>

                                        @break


                                    @case('cancelled')

                                        <span class="status-pill cancelled">

                                            <i class="fa-solid fa-ban"
                                               style="margin-right:5px;"></i>

                                            Cancelled

                                        </span>

                                        @break


                                    @default

                                        <span class="status-pill time">

                                            {{ ucfirst($r->status) }}

                                        </span>

                                @endswitch

                            </td>


                            {{-- DATE --}}

                            <td>

                                <span class="date-cell">

                                    {{ $r->created_at->format('d M Y') }}

                                </span>

                            </td>


                            {{-- ACTION --}}

                            <td>

                                @if($r->status === 'time_suggested')

                                    <div class="suggestion-box">

                                        <strong>
                                            <i class="fa-regular fa-calendar"></i>
                                            Suggested Time
                                        </strong>

                                        <br>

                                        {{ optional($r->suggested_date)->format('d M Y') }}

                                        @if($r->suggested_time)

                                            at {{ $r->suggested_time }}

                                        @endif

                                        @if($r->suggestion_note)

                                            <br>

                                            <em>
                                                "{{ $r->suggestion_note }}"
                                            </em>

                                        @endif

                                    </div>


                                    <form method="POST"
                                          action="{{ route('student.mentorship.accept-suggestion', $r) }}">

                                        @csrf

                                        <button type="submit"
                                                class="accept-btn">

                                            <i class="fa-solid fa-check"></i>
                                            Accept Time

                                        </button>

                                    </form>


                                @elseif($r->status === 'pending')

                                    <form method="POST"
                                          action="{{ route('student.mentorship.cancel', $r) }}"
                                          onsubmit="return confirm('Cancel this mentorship request?')">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="cancel-btn">

                                            <i class="fa-solid fa-xmark"></i>
                                            Cancel

                                        </button>

                                    </form>


                                @else

                                    <span style="
                                        font-size:11px;
                                        color:#A0A8B8;
                                    ">
                                        No action
                                    </span>

                                @endif

                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    @else

        <div class="no-requests"
             style="padding:52px 20px;">

            <i class="fa-solid fa-inbox"></i>

            <strong>
                No Mentorship Requests Yet
            </strong>

            <span>
                Find a mentor and send your first request
                to start your professional growth journey.
            </span>

            <div style="margin-top:18px;">

                <a href="{{ route('student.mentors.index') }}"
                   class="small-btn">

                    <i class="fa-solid fa-user-plus"></i>
                    Explore Mentors

                </a>

            </div>

        </div>

    @endif

</div>


</div>

@endsection