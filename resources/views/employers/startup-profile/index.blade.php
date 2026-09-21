@extends('layouts.app')

@section('title', 'Startup Profiles')

@section('content')

<style>
    :root {
        --job-blue: #3376F2;
        --job-blue-dark: #245fd0;
        --job-blue-light: #eef4ff;
        --job-text: #172033;
        --job-muted: #64748b;
        --job-border: #e2e8f0;
        --job-bg: #f8fafc;
    }

    * {
        box-sizing: border-box;
    }

    .startups-page {
        background: #f8fafc;
        min-height: 100vh;
        color: var(--job-text);
    }

    /* =========================================================
       HERO
    ========================================================= */

    .startups-hero {
        background: linear-gradient(
            180deg,
            #f5f8ff 0%,
            #f5f8ff 55%,
            #ffffff 100%
        );
        border-bottom: 1px solid #eef2f7;
    }

    .hero-inner {
        max-width: 1180px;
        margin: 0 auto;
        padding: 42px 24px 38px;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 38px;
        align-items: center;
    }

    .hero-left {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        text-align: left;
    }

    .hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        background: rgba(219, 234, 254, .75);
        color: #1d4ed8;
        padding: 7px 14px;
        border-radius: 999px;
        font-size: 11px;
        font-weight: 800;
        letter-spacing: .04em;
        margin-bottom: 15px;
    }

    .hero-badge svg {
        width: 14px;
        height: 14px;
    }

    .hero-title {
        margin: 0 0 15px;
        max-width: 520px;
        font-size: 43px;
        line-height: 1.12;
        letter-spacing: -.035em;
        font-weight: 800;
        color: #0f172a;
    }

    .hero-title span {
        display: block;
        color: #2563eb;
    }

    .hero-description {
        max-width: 470px;
        margin: 0 0 23px;
        color: #64748b;
        font-size: 14px;
        line-height: 1.75;
    }

    .hero-buttons {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .hero-primary-btn,
    .hero-secondary-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 11px 19px;
        border-radius: 11px;
        text-decoration: none;
        font-size: 13px;
        font-weight: 700;
        transition: .2s ease;
    }

    .hero-primary-btn {
        color: #fff;
        background: #2563eb;
        box-shadow: 0 7px 18px rgba(37, 99, 235, .14);
    }

    .hero-primary-btn:hover {
        background: #1d4ed8;
        color: #fff;
        transform: translateY(-1px);
    }

    .hero-secondary-btn {
        color: #475569;
        background: #fff;
        border: 1px solid #e2e8f0;
    }

    .hero-secondary-btn:hover {
        color: #2563eb;
        border-color: #93c5fd;
    }

    .hero-image-wrap {
        position: relative;
        display: flex;
        justify-content: flex-end;
        align-items: center;
        min-height: 285px;
    }

    .hero-image {
        width: 100%;
        max-width: 415px;
        height: auto;
        object-fit: contain;
        border-radius: 15px;
        filter: drop-shadow(0 18px 35px rgba(51, 118, 242, .10));
    }

    .floating-card {
        position: absolute;
        display: flex;
        align-items: center;
        gap: 9px;
        background: #fff;
        border-radius: 11px;
        padding: 9px 12px;
        box-shadow: 0 12px 28px rgba(15, 23, 42, .10);
        border: 1px solid #f1f5f9;
    }

    .floating-card-one {
        top: 12px;
        left: 0;
    }

    .floating-card-two {
        top: 88px;
        right: 0;
    }

    .floating-card-three {
        bottom: 15px;
        left: -5px;
    }

    .floating-icon {
        width: 29px;
        height: 29px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 13px;
        flex-shrink: 0;
    }

    .floating-icon-blue {
        background: #eaf2ff;
        color: #2563eb;
    }

    .floating-icon-purple {
        background: #f3e8ff;
        color: #7c3aed;
    }

    .floating-icon-green {
        background: #ecfdf5;
        color: #059669;
    }

    .floating-title {
        margin: 0;
        color: #1e293b;
        font-size: 10px;
        line-height: 1.3;
        font-weight: 800;
    }

    .floating-subtitle {
        margin: 2px 0 0;
        color: #94a3b8;
        font-size: 8px;
        line-height: 1.3;
    }

    /* =========================================================
       MAIN
    ========================================================= */

    .startups-container {
        max-width: 1180px;
        margin: 0 auto;
        padding: 30px 24px 55px;
    }

    .startups-layout {
        display: grid;
        grid-template-columns: minmax(0, 1fr) 350px;
        gap: 24px;
        align-items: start;
    }

    .startups-main {
        min-width: 0;
    }

    #startup-list {
        scroll-margin-top: 20px;
    }

    /* =========================================================
       SUCCESS BANNER
    ========================================================= */

    .startups-success {
        display: flex;
        align-items: center;
        gap: 8px;
        background: #ecfdf5;
        border: 1px solid #d1fae5;
        color: #047857;
        font-size: 12px;
        font-weight: 600;
        border-radius: 12px;
        padding: 12px 16px;
        margin-bottom: 18px;
    }

    /* =========================================================
       LIST HEADER
    ========================================================= */

    .startups-list-header {
        position: relative;
        min-height: 54px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 17px;
    }

    .startups-list-header > div {
        text-align: center;
    }

    .startups-list-title {
        margin: 0;
        color: #0f172a;
        font-size: 21px;
        line-height: 1.3;
        font-weight: 800;
        letter-spacing: -.015em;
    }

    .startups-list-subtitle {
        margin: 4px 0 0;
        color: #94a3b8;
        font-size: 11px;
        line-height: 1.4;
    }

    .startups-count {
        position: absolute;
        right: 0;
        top: 50%;
        transform: translateY(-50%);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 32px;
        height: 27px;
        padding: 0 9px;
        border-radius: 999px;
        background: #eef4ff;
        border: 1px solid #dbeafe;
        color: #2563eb;
        font-size: 10px;
        font-weight: 800;
    }

    /* =========================================================
       COMPACT SEARCH
    ========================================================= */

    .startups-search-card {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 9px;
        margin-bottom: 16px;
        box-shadow: 0 3px 12px rgba(15, 23, 42, .025);
    }

    .startups-search-form {
        display: grid;
        grid-template-columns: minmax(0, 1fr) 145px auto auto;
        gap: 7px;
        align-items: center;
    }

    .startups-search-input-wrap {
        position: relative;
    }

    .startups-search-input-wrap i {
        position: absolute;
        left: 11px;
        top: 50%;
        transform: translateY(-50%);
        color: #94a3b8;
        font-size: 12px;
        pointer-events: none;
    }

    .startups-search-input,
    .startups-search-select {
        width: 100%;
        height: 36px;
        border: 1px solid #dbe3ee;
        border-radius: 8px;
        background: #fff;
        color: #172033;
        font-family: inherit;
        font-size: 11px;
        outline: none;
        transition: .2s ease;
    }

    .startups-search-input {
        padding: 0 10px 0 32px;
    }

    .startups-search-select {
        padding: 0 9px;
        cursor: pointer;
    }

    .startups-search-input:focus,
    .startups-search-select:focus {
        border-color: #3376f2;
        box-shadow: 0 0 0 3px rgba(51, 118, 242, .07);
    }

    .startups-search-btn,
    .startups-clear-btn {
        height: 36px;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        font-size: 10px;
        font-weight: 700;
        transition: .2s ease;
        white-space: nowrap;
    }

    .startups-search-btn {
        padding: 0 14px;
        border: 0;
        background: #3376f2;
        color: #fff;
        cursor: pointer;
    }

    .startups-search-btn:hover {
        background: #245fd0;
    }

    .startups-clear-btn {
        padding: 0 11px;
        border: 1px solid #e2e8f0;
        background: #fff;
        color: #64748b;
        text-decoration: none;
    }

    .startups-clear-btn:hover {
        background: #f8fafc;
        color: #2563eb;
        border-color: #bfdbfe;
    }

    .startups-search-result {
        margin-top: 7px;
        padding: 0 3px;
        color: #94a3b8;
        font-size: 9px;
    }

    .startups-search-result strong {
        color: #64748b;
    }

    /* =========================================================
       ACTIVE FILTER INFO
    ========================================================= */

    .active-filter-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        margin-left: 5px;
        padding: 4px 8px;
        border-radius: 999px;
        background: #eef4ff;
        color: #2563eb;
        font-size: 8px;
        font-weight: 700;
    }

    /* =========================================================
       STARTUP CARD
    ========================================================= */

    .employer-startup-card {
        position: relative;
        background: #fff;
        border: 1px solid #dfe6ef;
        border-radius: 16px;
        margin-bottom: 13px;
        overflow: visible;
        transition: .2s ease;
    }

    .employer-startup-card:hover {
        border-color: #cbd9ee;
        box-shadow: 0 8px 25px rgba(15, 23, 42, .055);
    }

    .employer-startup-card-inner {
        padding: 17px 18px 15px;
    }

    .startup-card-top {
        position: relative;
        display: flex;
        justify-content: space-between;
        gap: 15px;
    }

    .startup-card-main {
        display: flex;
        align-items: flex-start;
        gap: 13px;
        min-width: 0;
        flex: 1;
    }

    .startup-card-logo {
        width: 52px;
        height: 52px;
        flex: 0 0 52px;
        border-radius: 13px;
        background: #eef4ff;
        border: 1px solid #dbeafe;
        color: #3376f2;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        font-size: 20px;
    }

    .startup-card-logo img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .startup-main-info {
        min-width: 0;
        flex: 1;
    }

    .startup-title-row {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 8px;
        margin-bottom: 7px;
        padding-right: 48px;
    }

    .startup-card-title {
        margin: 0;
        color: #111827;
        font-size: 16px;
        line-height: 1.35;
        font-weight: 800;
        letter-spacing: -.01em;
        word-break: break-word;
    }

    /* =========================================================
       STAGE BADGE
    ========================================================= */

    .startup-stage {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 24px;
        padding: 0 10px;
        border-radius: 999px;
        font-size: 9px;
        line-height: 1;
        font-weight: 800;
        white-space: nowrap;
        background: #eaf2ff;
        color: #2563eb;
        border: 1px solid #bfdbfe;
    }

    /* =========================================================
       TAGLINE / META
    ========================================================= */

    .startup-tagline {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 7px;
        color: #64748b;
        font-size: 11px;
        margin-bottom: 7px;
    }

    .startup-tagline i {
        color: #64748b;
        font-size: 11px;
    }

    .startup-tagline-text {
        font-weight: 600;
        color: #475569;
    }

    .startup-meta-row {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 13px;
        color: #64748b;
        font-size: 10px;
    }

    .startup-meta-item {
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    .startup-meta-item i {
        color: #94a3b8;
        font-size: 10px;
    }

    .startup-description {
        margin: 12px 0 0;
        color: #64748b;
        font-size: 11px;
        line-height: 1.7;
    }

    /* =========================================================
       THREE DOT MENU
    ========================================================= */

    .startup-menu-wrap {
        position: absolute;
        top: 0;
        right: 0;
        z-index: 50;
    }

    .startup-menu-toggle {
        width: 39px;
        height: 39px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 13px;
        border: 2px solid #bfdbfe;
        background: #eef6ff;
        color: #2563eb;
        cursor: pointer;
        font-size: 17px;
        transition: .2s ease;
        box-shadow: 0 2px 8px rgba(37, 99, 235, .08);
    }

    .startup-menu-toggle:hover,
    .startup-menu-toggle:focus {
        background: #dbeafe;
        border-color: #60a5fa;
        color: #1d4ed8;
        outline: none;
        transform: translateY(-1px);
    }

    .startup-menu {
        position: absolute;
        top: 46px;
        right: 0;
        width: 205px;
        padding: 7px;
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 13px;
        box-shadow: 0 18px 40px rgba(15, 23, 42, .13);
        display: none;
        z-index: 100;
    }

    .startup-menu.show {
        display: block;
    }

    .startup-menu-item {
        width: 100%;
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 9px 10px;
        border: 0;
        border-radius: 8px;
        background: transparent;
        color: #475569;
        text-decoration: none;
        font-size: 11px;
        font-weight: 600;
        cursor: pointer;
        text-align: left;
        transition: .15s ease;
    }

    .startup-menu-item:hover {
        background: #f8fafc;
        color: #2563eb;
    }

    .startup-menu-item i {
        width: 17px;
        color: #64748b;
        font-size: 13px;
    }

    .startup-menu-item:hover i {
        color: #2563eb;
    }

    .startup-menu-divider {
        height: 1px;
        background: #eef2f7;
        margin: 5px 2px;
    }

    .startup-menu-item.danger {
        color: #dc2626;
    }

    .startup-menu-item.danger i {
        color: #dc2626;
    }

    .startup-menu-item.danger:hover {
        background: #fef2f2;
        color: #b91c1c;
    }

    /* =========================================================
       STARTUP STATS
    ========================================================= */

    .startup-stats {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 9px;
        margin-top: 16px;
        padding-top: 14px;
        border-top: 1px solid #f1f5f9;
    }

    .startup-stat {
        min-height: 55px;
        display: flex;
        align-items: center;
        gap: 9px;
        padding: 9px 11px;
        border-radius: 11px;
        background: #f8fafc;
    }

    .startup-stat-icon {
        width: 30px;
        height: 30px;
        border-radius: 9px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        font-size: 12px;
    }

    .startup-stat-blue .startup-stat-icon {
        background: #eaf2ff;
        color: #2563eb;
    }

    .startup-stat-green .startup-stat-icon {
        background: #ecfdf5;
        color: #059669;
    }

    .startup-stat-orange .startup-stat-icon {
        background: #fff7ed;
        color: #ea580c;
    }

    .startup-stat-number {
        display: block;
        color: #172033;
        font-size: 15px;
        line-height: 1.1;
        font-weight: 800;
    }

    .startup-stat-label {
        display: block;
        margin-top: 3px;
        color: #94a3b8;
        font-size: 9px;
        line-height: 1.2;
    }

    /* =========================================================
       CARD FOOTER
    ========================================================= */

    .startup-card-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        margin-top: 13px;
    }

    .startup-status-area {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 8px;
    }

    .startup-status {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 10px;
        border-radius: 999px;
        font-size: 9px;
        line-height: 1;
        font-weight: 800;
    }

    .startup-status-approved,
    .startup-status-live {
        color: #047857;
        background: #ecfdf5;
    }

    .startup-status-pending {
        color: #c2410c;
        background: #fff7ed;
    }

    .startup-status-rejected {
        color: #b91c1c;
        background: #fef2f2;
    }

    .startup-status-draft {
        color: #64748b;
        background: #f1f5f9;
    }

    .status-dot {
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background: currentColor;
    }

    .startup-posted-time {
        color: #94a3b8;
        font-size: 9px;
    }

    .startup-actions {
        display: flex;
        align-items: center;
        gap: 7px;
        flex-wrap: wrap;
        justify-content: flex-end;
    }

    .startup-action-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        min-height: 31px;
        padding: 0 11px;
        border-radius: 8px;
        font-size: 9px;
        font-weight: 700;
        text-decoration: none;
        cursor: pointer;
        transition: .18s ease;
    }

    .startup-view-btn {
        color: #2563eb;
        background: #eef4ff;
        border: 1px solid #dbeafe;
    }

    .startup-view-btn:hover {
        background: #dbeafe;
        color: #1d4ed8;
    }

    .startup-edit-btn {
        color: #fff;
        background: #2563eb;
        border: 1px solid #2563eb;
    }

    .startup-edit-btn:hover {
        background: #1d4ed8;
        color: #fff;
    }

    /* =========================================================
       EMPTY
    ========================================================= */

    .startups-empty {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 48px 24px;
        text-align: center;
    }

    .startups-empty-icon {
        width: 55px;
        height: 55px;
        margin: 0 auto 13px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 15px;
        background: #eef4ff;
        color: #3376f2;
        font-size: 21px;
    }

    .startups-empty h3 {
        margin: 0 0 5px;
        font-size: 17px;
        font-weight: 800;
        color: #172033;
    }

    .startups-empty p {
        margin: 0 auto 17px;
        max-width: 390px;
        color: #94a3b8;
        font-size: 11px;
        line-height: 1.6;
    }

    .startups-primary-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        padding: 10px 17px;
        border-radius: 9px;
        background: #2563eb;
        color: #fff;
        text-decoration: none;
        font-size: 11px;
        font-weight: 700;
    }

    .startups-primary-btn:hover {
        background: #1d4ed8;
        color: #fff;
    }

    /* =========================================================
       PAGINATION
    ========================================================= */

    .startups-pagination {
        margin-top: 18px;
        display: flex;
        justify-content: center;
    }

    .startups-pagination nav {
        width: 100%;
    }

    .startups-pagination svg {
        width: 15px;
        height: 15px;
    }

    /* =========================================================
       SIDEBAR
    ========================================================= */

    .startups-sidebar {
        display: flex;
        flex-direction: column;
        gap: 18px;
    }

    .sidebar-cta {
        position: relative;
        overflow: hidden;
        background: linear-gradient(135deg, #3376f2 0%, #5366df 100%);
        border-radius: 18px;
        padding: 23px;
        color: #fff;
        min-height: 178px;
    }

    .sidebar-cta::before {
        content: "";
        position: absolute;
        width: 130px;
        height: 130px;
        right: -35px;
        bottom: -55px;
        border-radius: 50%;
        background: rgba(255,255,255,.10);
    }

    .sidebar-cta::after {
        content: "";
        position: absolute;
        width: 95px;
        height: 95px;
        right: -20px;
        top: 20px;
        border-radius: 50%;
        background: rgba(255,255,255,.08);
    }

    .sidebar-cta-content {
        position: relative;
        z-index: 2;
    }

    .sidebar-cta h3 {
        margin: 0 0 7px;
        font-size: 17px;
        font-weight: 800;
        color: #fff;
    }

    .sidebar-cta p {
        margin: 0 0 17px;
        max-width: 235px;
        font-size: 11px;
        line-height: 1.6;
        color: rgba(255,255,255,.84);
    }

    .sidebar-cta-btn {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        background: #fff;
        color: #2563eb;
        border-radius: 9px;
        padding: 9px 14px;
        text-decoration: none;
        font-size: 10px;
        font-weight: 800;
    }

    .sidebar-card {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 17px;
        padding: 21px;
    }

    .sidebar-card-title {
        margin: 0 0 15px;
        color: #172033;
        font-size: 17px;
        font-weight: 800;
    }

    .sidebar-list {
        display: flex;
        flex-direction: column;
        gap: 13px;
    }

    .sidebar-list-item {
        display: flex;
        align-items: flex-start;
        gap: 9px;
        color: #64748b;
        font-size: 11px;
        line-height: 1.45;
    }

    .sidebar-check {
        width: 16px;
        height: 16px;
        border-radius: 50%;
        background: #10b981;
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 8px;
        flex-shrink: 0;
        margin-top: 1px;
    }

    .sidebar-overview {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .sidebar-overview-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .sidebar-overview-label {
        color: #94a3b8;
        font-size: 10.5px;
        font-weight: 600;
    }

    .sidebar-overview-value {
        color: #172033;
        font-size: 13px;
        font-weight: 800;
    }

    /* =========================================================
       RESPONSIVE
    ========================================================= */

    @media (max-width: 1080px) {

        .startups-layout {
            grid-template-columns: 1fr;
        }

        .startups-sidebar {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
        }

        .sidebar-cta {
            grid-column: 1 / -1;
        }
    }

    @media (max-width: 1000px) {

        .startups-search-form {
            grid-template-columns: minmax(0, 1fr) 150px auto auto;
        }
    }

    @media (max-width: 900px) {

        .hero-inner {
            grid-template-columns: 1fr;
        }

        .hero-image-wrap {
            justify-content: center;
            min-height: 250px;
        }

        .hero-left {
            align-items: center;
            text-align: center;
        }

        .hero-description {
            text-align: center;
        }

        .startups-search-form {
            grid-template-columns: minmax(0, 1fr) 1fr;
        }

        .startups-search-input-wrap {
            grid-column: 1 / -1;
        }

        .startups-search-btn,
        .startups-clear-btn {
            width: 100%;
        }
    }

    @media (max-width: 700px) {

        .startups-container {
            padding-left: 16px;
            padding-right: 16px;
        }

        .hero-inner {
            padding-left: 18px;
            padding-right: 18px;
        }

        .hero-title {
            font-size: 34px;
        }

        .startups-sidebar {
            grid-template-columns: 1fr;
        }

        .startups-list-header {
            padding-right: 40px;
        }

        .startup-stats {
            grid-template-columns: 1fr;
        }

        .startup-card-footer {
            align-items: flex-start;
            flex-direction: column;
        }

        .startup-actions {
            width: 100%;
            justify-content: flex-start;
        }
    }

    @media (max-width: 575px) {

        .hero-buttons {
            width: 100%;
            flex-direction: column;
        }

        .hero-primary-btn,
        .hero-secondary-btn {
            width: 100%;
        }

        .hero-image-wrap {
            min-height: 210px;
        }

        .floating-card {
            transform: scale(.88);
        }

        .floating-card-one {
            left: -8px;
        }

        .floating-card-two {
            right: -8px;
        }

        .floating-card-three {
            left: -12px;
        }

        .startups-search-form {
            grid-template-columns: 1fr;
        }

        .startups-search-input-wrap {
            grid-column: auto;
        }

        .startups-search-btn,
        .startups-clear-btn {
            width: 100%;
        }
    }

    @media (max-width: 450px) {

        .employer-startup-card-inner {
            padding: 15px;
        }

        .startup-card-title {
            font-size: 15px;
        }

        .startup-card-logo {
            width: 44px;
            height: 44px;
            flex-basis: 44px;
            border-radius: 11px;
            font-size: 17px;
        }

        .startup-actions {
            flex-direction: column;
            align-items: stretch;
        }

        .startup-action-btn {
            width: 100%;
        }
    }
</style>

<div class="startups-page">


{{-- =====================================================
     HERO
====================================================== --}}

<section class="startups-hero">

    <div class="hero-inner">

        <div class="hero-left">

            <span class="hero-badge">
                <svg fill="currentColor" viewBox="0 0 24 24">
                    <path d="M13 2 3 14h7l-1 8 11-14h-7l0-6z"/>
                </svg>

                SHOWCASE YOUR STARTUP
            </span>

            <h1 class="hero-title">
                Tell Your Story,
                <span>Grow Your Startup</span>
            </h1>

            <p class="hero-description">
                Build your public startup presence, showcase your company,
                products and team, and connect your open jobs to attract
                the right talent.
            </p>

            <div class="hero-buttons">

                <a href="{{ route('employer.startup-profile.create') }}"
                   class="hero-primary-btn">

                    <i class="bi bi-plus-lg"></i>

                    Create Startup Profile

                </a>

                <a href="#startup-list"
                   class="hero-secondary-btn">

                    Browse Profiles

                </a>

            </div>

        </div>


        <div class="hero-image-wrap">

            <img src="{{ asset('assets/img/mnmn.png') }}"
                 alt="Showcase your startup"
                 class="hero-image"
                 onerror="this.style.display='none'">


            <div class="floating-card floating-card-one">

                <span class="floating-icon floating-icon-blue">
                    <i class="bi bi-rocket-takeoff"></i>
                </span>

                <div>

                    <p class="floating-title">
                        Public Presence
                    </p>

                    <p class="floating-subtitle">
                        Showcase your brand
                    </p>

                </div>

            </div>


            <div class="floating-card floating-card-two">

                <span class="floating-icon floating-icon-purple">
                    <i class="bi bi-stars"></i>
                </span>

                <div>

                    <p class="floating-title">
                        Attract Talent
                    </p>

                    <p class="floating-subtitle">
                        Reach relevant candidates
                    </p>

                </div>

            </div>


            <div class="floating-card floating-card-three">

                <span class="floating-icon floating-icon-green">
                    <i class="bi bi-graph-up-arrow"></i>
                </span>

                <div>

                    <p class="floating-title">
                        Grow Faster
                    </p>

                    <p class="floating-subtitle">
                        Share your journey
                    </p>

                </div>

            </div>

        </div>

    </div>

</section>


{{-- =====================================================
     MAIN
====================================================== --}}

<div class="startups-container" id="startup-list">

    {{-- SUCCESS --}}

    @if (session('success'))

        <div class="startups-success">

            <i class="bi bi-check-circle-fill"></i>

            {{ session('success') }}

        </div>

    @endif


    @php

        $isPaginated = method_exists($startupProfiles, 'links');

        $totalProfiles = method_exists($startupProfiles, 'total')
            ? $startupProfiles->total()
            : $startupProfiles->count();

        $hasFilters = request()->hasAny(['search', 'status']);

    @endphp


    <div class="startups-layout">


        {{-- =================================================
             STARTUP LIST
        ================================================== --}}

        <main class="startups-main">


            {{-- =================================================
                 LIST HEADER
            ================================================== --}}

            <div class="startups-list-header">

                <div>

                    <h2 class="startups-list-title">
                        My Startup Profiles
                    </h2>

                    <p class="startups-list-subtitle">
                        Manage your startup profiles, jobs and visibility

                        @if($hasFilters)

                            <span class="active-filter-badge">
                                <i class="bi bi-funnel-fill"></i>
                                Filtered Results
                            </span>

                        @endif

                    </p>

                </div>


                <span class="startups-count">
                    {{ $totalProfiles }}
                </span>

            </div>


            {{-- =================================================
                 COMPACT SEARCH / FILTER
            ================================================== --}}

            <div class="startups-search-card">

                <form action="{{ route('employer.startup-profile.index') }}"
                      method="GET"
                      class="startups-search-form"
                      id="startupSearchForm">


                    {{-- SEARCH --}}

                    <div class="startups-search-input-wrap">

                        <i class="bi bi-search"></i>

                        <input type="text"
                               name="search"
                               class="startups-search-input"
                               value="{{ request('search') }}"
                               placeholder="Search startups by name...">

                    </div>


                    {{-- STATUS --}}

                    <select name="status"
                            class="startups-search-select">

                        <option value="">
                            All Statuses
                        </option>

                        <option value="approved"
                            {{ request('status') === 'approved' ? 'selected' : '' }}>
                            Approved
                        </option>

                        <option value="pending"
                            {{ request('status') === 'pending' ? 'selected' : '' }}>
                            Pending
                        </option>

                        <option value="rejected"
                            {{ request('status') === 'rejected' ? 'selected' : '' }}>
                            Rejected
                        </option>

                    </select>


                    {{-- SEARCH BUTTON --}}

                    <button type="submit"
                            class="startups-search-btn">

                        <i class="bi bi-search"></i>

                        Search

                    </button>


                    {{-- CLEAR BUTTON BESIDE SEARCH --}}

                    @if($hasFilters)

                        <a href="{{ route('employer.startup-profile.index') }}"
                           class="startups-clear-btn">

                            <i class="bi bi-x-lg"></i>

                            Clear

                        </a>

                    @endif

                </form>


                {{-- RESULT TEXT --}}

                @if($hasFilters)

                    <div class="startups-search-result">

                        Showing filtered results

                        @if(request('search'))

                            for
                            "<strong>{{ request('search') }}</strong>"

                        @endif

                        @if(request('status'))

                            &middot;
                            {{ ucfirst(request('status')) }}

                        @endif

                    </div>

                @endif

            </div>


            {{-- =================================================
                 STARTUP CARDS
            ================================================== --}}

            @forelse ($startupProfiles as $startup)

                @php

                    /*
                    |--------------------------------------------------------------------------
                    | STATUS
                    |--------------------------------------------------------------------------
                    */

                    $startupStatus = strtolower((string) $startup->status);

                    $approvalClass = match ($startupStatus) {

                        'approved' => 'startup-status-approved',

                        'rejected' => 'startup-status-rejected',

                        default => 'startup-status-pending',

                    };

                    $approvalLabel = match ($startupStatus) {

                        'approved' => 'Approved',

                        'rejected' => 'Rejected',

                        default => 'Pending Review',

                    };


                    /*
                    |--------------------------------------------------------------------------
                    | DESCRIPTION
                    |--------------------------------------------------------------------------
                    */

                    $descriptionText = trim((string) ($startup->short_description ?: $startup->about));

                @endphp


                {{-- =================================================
                     STARTUP CARD
                ================================================== --}}

                <article class="employer-startup-card">

                    <div class="employer-startup-card-inner">

                        <div class="startup-card-top">

                            <div class="startup-card-main">


                                {{-- LOGO --}}

                                <div class="startup-card-logo">

                                    @if($startup->logo)

                                        <img src="{{ asset('storage/' . $startup->logo) }}"
                                             alt="{{ $startup->startup_name }}">

                                    @else

                                        <i class="bi bi-rocket-takeoff-fill"></i>

                                    @endif

                                </div>


                                {{-- INFO --}}

                                <div class="startup-main-info">

                                    <div class="startup-title-row">

                                        <h3 class="startup-card-title">
                                            {{ $startup->startup_name }}
                                        </h3>

                                        @if($startup->startup_stage)

                                            <span class="startup-stage">
                                                {{ $startup->startup_stage }}
                                            </span>

                                        @endif

                                    </div>


                                    @if($startup->tagline)

                                        <div class="startup-tagline">

                                            <i class="bi bi-lightbulb"></i>

                                            <span class="startup-tagline-text">
                                                {{ $startup->tagline }}
                                            </span>

                                        </div>

                                    @endif


                                    <div class="startup-meta-row">

                                        @if($startup->location)

                                            <span class="startup-meta-item">

                                                <i class="bi bi-geo-alt"></i>

                                                {{ $startup->location }}

                                            </span>

                                        @endif


                                        @if($startup->industry)

                                            <span class="startup-meta-item">

                                                <i class="bi bi-layers"></i>

                                                {{ $startup->industry }}

                                            </span>

                                        @endif


                                        @if($startup->funding_stage)

                                            <span class="startup-meta-item">

                                                <i class="bi bi-stack"></i>

                                                {{ $startup->funding_stage }}

                                            </span>

                                        @endif


                                        @if($startup->category)

                                            <span class="startup-meta-item">

                                                <i class="bi bi-grid"></i>

                                                {{ $startup->category }}

                                            </span>

                                        @endif

                                    </div>


                                    @if($descriptionText !== '')

                                        <p class="startup-description">

                                            {{ \Illuminate\Support\Str::limit($descriptionText, 220) }}

                                        </p>

                                    @endif

                                </div>

                            </div>


                            {{-- THREE DOT MENU --}}

                            <div class="startup-menu-wrap">

                                <button type="button"
                                        class="startup-menu-toggle"
                                        onclick="toggleStartupMenu({{ $startup->id }})"
                                        aria-label="Startup actions">

                                    <i class="bi bi-three-dots-vertical"></i>

                                </button>


                                <div id="startup-menu-{{ $startup->id }}"
                                     class="startup-menu">

                                    {{-- VIEW PROFILE --}}

                                    <a href="{{ route('employer.startup-profile.show', $startup) }}"
                                       class="startup-menu-item">

                                        <i class="bi bi-eye"></i>

                                        <span>
                                            View Profile
                                        </span>

                                    </a>


                                    {{-- EDIT PROFILE --}}

                                    <a href="{{ route('employer.startup-profile.edit', $startup) }}"
                                       class="startup-menu-item">

                                        <i class="bi bi-pencil"></i>

                                        <span>
                                            Edit Profile
                                        </span>

                                    </a>


                                    <div class="startup-menu-divider"></div>


                                    {{-- CREATE JOB --}}

                                    <a href="{{ route('employer.jobs.create', ['startup_profile_id' => $startup->id]) }}"
                                       class="startup-menu-item">

                                        <i class="bi bi-plus-circle"></i>

                                        <span>
                                            Create Job Post
                                        </span>

                                    </a>


                                    {{-- SHOW JOBS --}}

                                    <a href="{{ route('employer.startup-profile.jobs', $startup) }}"
                                       class="startup-menu-item">

                                        <i class="bi bi-list-ul"></i>

                                        <span>
                                            Show Jobs
                                        </span>

                                    </a>


                                    {{-- PUBLISH / UNPUBLISH --}}

                                    @if($startupStatus === 'approved')

                                        <div class="startup-menu-divider"></div>

                                        <form action="{{ route('employer.startup-profile.toggle', $startup) }}"
                                              method="POST"
                                              style="margin:0;">

                                            @csrf

                                            <button type="submit"
                                                    class="startup-menu-item">

                                                <i class="bi bi-{{ $startup->is_published ? 'eye-slash' : 'globe2' }}"></i>

                                                <span>
                                                    {{ $startup->is_published ? 'Unpublish' : 'Publish' }}
                                                </span>

                                            </button>

                                        </form>

                                    @endif


                                    <div class="startup-menu-divider"></div>


                                    {{-- DELETE --}}

                                    <form action="{{ route('employer.startup-profile.destroy', $startup) }}"
                                          method="POST"
                                          style="margin:0;"
                                          onsubmit="return confirm('Are you sure you want to delete this startup profile? This action cannot be undone.');">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="startup-menu-item danger">

                                            <i class="bi bi-trash3"></i>

                                            <span>
                                                Delete Profile
                                            </span>

                                        </button>

                                    </form>

                                </div>

                            </div>

                        </div>


                        {{-- STATS --}}

                        <div class="startup-stats">

                            <div class="startup-stat startup-stat-blue">

                                <span class="startup-stat-icon">
                                    <i class="bi bi-people"></i>
                                </span>

                                <div>

                                    <span class="startup-stat-number">
                                        {{ $startup->team_size ?: '—' }}
                                    </span>

                                    <span class="startup-stat-label">
                                        Team Size
                                    </span>

                                </div>

                            </div>


                            <div class="startup-stat startup-stat-green">

                                <span class="startup-stat-icon">
                                    <i class="bi bi-graph-up-arrow"></i>
                                </span>

                                <div>

                                    <span class="startup-stat-number">
                                        {{ $startup->startup_stage ?: '—' }}
                                    </span>

                                    <span class="startup-stat-label">
                                        Stage
                                    </span>

                                </div>

                            </div>


                            <div class="startup-stat startup-stat-orange">

                                <span class="startup-stat-icon">
                                    <i class="bi bi-calendar-event"></i>
                                </span>

                                <div>

                                    <span class="startup-stat-number">
                                        {{ $startup->founded_year ?: '—' }}
                                    </span>

                                    <span class="startup-stat-label">
                                        Founded
                                    </span>

                                </div>

                            </div>

                        </div>


                        {{-- FOOTER --}}

                        <div class="startup-card-footer">

                            <div class="startup-status-area">

                                {{-- APPROVAL STATUS --}}

                                <span class="startup-status {{ $approvalClass }}">

                                    <span class="status-dot"></span>

                                    {{ $approvalLabel }}

                                </span>


                                {{-- PUBLISHED STATUS --}}

                                @if($startup->is_published)

                                    <span class="startup-status startup-status-live">

                                        <span class="status-dot"></span>

                                        Live

                                    </span>

                                @else

                                    <span class="startup-status startup-status-draft">

                                        <span class="status-dot"></span>

                                        Not Published

                                    </span>

                                @endif


                                {{-- UPDATED --}}

                                @if($startup->updated_at)

                                    <span class="startup-posted-time">
                                        Updated {{ $startup->updated_at->diffForHumans() }}
                                    </span>

                                @endif

                            </div>


                            <div class="startup-actions">

                                <a href="{{ route('employer.startup-profile.show', $startup) }}"
                                   class="startup-action-btn startup-view-btn">

                                    <i class="bi bi-eye"></i>

                                    View Profile

                                </a>


                                <a href="{{ route('employer.startup-profile.edit', $startup) }}"
                                   class="startup-action-btn startup-edit-btn">

                                    <i class="bi bi-pencil-square"></i>

                                    Edit Profile

                                </a>

                            </div>

                        </div>

                    </div>

                </article>

            @empty

                {{-- EMPTY STATE --}}

                <div class="startups-empty">

                    <div class="startups-empty-icon">

                        <i class="bi bi-rocket-takeoff"></i>

                    </div>

                    <h3>

                        @if($hasFilters)

                            No Matching Startup Profiles Found

                        @else

                            No Startup Profiles Yet

                        @endif

                    </h3>

                    <p>

                        @if($hasFilters)

                            Try changing your search or filters to find
                            another startup profile.

                        @else

                            Create your first startup profile and build
                            a professional public presence for your company.

                        @endif

                    </p>


                    @if($hasFilters)

                        <a href="{{ route('employer.startup-profile.index') }}"
                           class="startups-primary-btn">

                            <i class="bi bi-arrow-counterclockwise"></i>

                            Clear Filters

                        </a>

                    @else

                        <a href="{{ route('employer.startup-profile.create') }}"
                           class="startups-primary-btn">

                            <i class="bi bi-plus-lg"></i>

                            Create Your First Profile

                        </a>

                    @endif

                </div>

            @endforelse


            {{-- PAGINATION --}}

            @if($isPaginated)

                <div class="startups-pagination">

                    {{ $startupProfiles->withQueryString()->fragment('startup-list')->links() }}

                </div>

            @endif

        </main>


        {{-- =====================================================
             SIDEBAR
        ====================================================== --}}

        <aside class="startups-sidebar">


            {{-- CTA --}}

            <div class="sidebar-cta">

                <div class="sidebar-cta-content">

                    <h3>
                        Ready to Be Discovered?
                    </h3>

                    <p>
                        Create a startup profile and show candidates
                        what makes your team worth joining.
                    </p>

                    <a href="{{ route('employer.startup-profile.create') }}"
                       class="sidebar-cta-btn">

                        Create Profile

                        <i class="bi bi-arrow-right"></i>

                    </a>

                </div>

            </div>


            {{-- OVERVIEW --}}

            <div class="sidebar-card">

                <h3 class="sidebar-card-title">
                    Profile Overview
                </h3>

                <div class="sidebar-overview">

                    <div class="sidebar-overview-row">

                        <span class="sidebar-overview-label">
                            Total Profiles
                        </span>

                        <span class="sidebar-overview-value">
                            {{ $totalProfiles }}
                        </span>

                    </div>


                    <div class="sidebar-overview-row">

                        <span class="sidebar-overview-label">
                            Approved
                        </span>

                        <span class="sidebar-overview-value">

                            {{ $startupProfiles->filter(function ($profile) {
                                return strtolower((string) $profile->status) === 'approved';
                            })->count() }}

                        </span>

                    </div>


                    <div class="sidebar-overview-row">

                        <span class="sidebar-overview-label">
                            Pending Review
                        </span>

                        <span class="sidebar-overview-value">

                            {{ $startupProfiles->filter(function ($profile) {
                                return strtolower((string) $profile->status) === 'pending';
                            })->count() }}

                        </span>

                    </div>


                    <div class="sidebar-overview-row">

                        <span class="sidebar-overview-label">
                            Live
                        </span>

                        <span class="sidebar-overview-value">

                            {{ $startupProfiles->where('is_published', true)->count() }}

                        </span>

                    </div>

                </div>

            </div>


            {{-- PROFILE TIPS --}}

            <div class="sidebar-card">

                <h3 class="sidebar-card-title">
                    Build a Strong Profile
                </h3>

                <div class="sidebar-list">

                    <div class="sidebar-list-item">

                        <span class="sidebar-check">
                            <i class="bi bi-check-lg"></i>
                        </span>

                        <span>
                            Use a clear logo and an attractive cover image.
                        </span>

                    </div>


                    <div class="sidebar-list-item">

                        <span class="sidebar-check">
                            <i class="bi bi-check-lg"></i>
                        </span>

                        <span>
                            Clearly explain your mission and what your startup does.
                        </span>

                    </div>


                    <div class="sidebar-list-item">

                        <span class="sidebar-check">
                            <i class="bi bi-check-lg"></i>
                        </span>

                        <span>
                            Add your products, services and technologies.
                        </span>

                    </div>


                    <div class="sidebar-list-item">

                        <span class="sidebar-check">
                            <i class="bi bi-check-lg"></i>
                        </span>

                        <span>
                            Select the members and opportunities relevant to your startup.
                        </span>

                    </div>


                    <div class="sidebar-list-item">

                        <span class="sidebar-check">
                            <i class="bi bi-check-lg"></i>
                        </span>

                        <span>
                            Connect relevant jobs to your startup profile.
                        </span>

                    </div>

                </div>

            </div>

        </aside>

    </div>

</div>


</div>

{{-- =============================================================
JAVASCRIPT
============================================================= --}}

<script>

    /* =========================================================
       THREE DOT MENU
    ========================================================= */

    function toggleStartupMenu(startupId) {

        const menu = document.getElementById(
            'startup-menu-' + startupId
        );

        if (!menu) {
            return;
        }

        const isOpen = menu.classList.contains('show');

        document.querySelectorAll('.startup-menu.show').forEach(function (openMenu) {

            openMenu.classList.remove('show');

        });

        if (!isOpen) {

            menu.classList.add('show');

        }

    }


    /* =========================================================
       CLOSE MENUS WHEN CLICKING OUTSIDE
    ========================================================= */

    document.addEventListener('click', function (event) {

        if (!event.target.closest('.startup-menu-wrap')) {

            document.querySelectorAll('.startup-menu.show').forEach(function (menu) {

                menu.classList.remove('show');

            });

        }

    });


    /* =========================================================
       ESCAPE KEY CLOSES MENUS
    ========================================================= */

    document.addEventListener('keydown', function (event) {

        if (event.key !== 'Escape') {
            return;
        }

        document.querySelectorAll('.startup-menu.show').forEach(function (menu) {

            menu.classList.remove('show');

        });

    });


    /* =========================================================
       SEARCH / FILTER
       AFTER SUBMIT, AUTOMATICALLY STAY AT STARTUP SECTION
    ========================================================= */

    document.addEventListener('DOMContentLoaded', function () {

        const params = new URLSearchParams(window.location.search);

        const hasFilters = params.has('search') || params.has('status');

        const startupList = document.getElementById('startup-list');


        /*
        |--------------------------------------------------------------------------
        | FILTERED SEARCH
        |--------------------------------------------------------------------------
        | If a search/filter was submitted, keep the user at the
        | startup section instead of leaving them at the hero.
        */

        if (hasFilters && startupList) {

            setTimeout(function () {

                startupList.scrollIntoView({
                    behavior: 'auto',
                    block: 'start'
                });

            }, 50);

        }


        /*
        |--------------------------------------------------------------------------
        | PAGINATION
        |--------------------------------------------------------------------------
        | Pagination already uses #startup-list.
        */

        if (
            window.location.hash === '#startup-list' &&
            startupList
        ) {

            setTimeout(function () {

                startupList.scrollIntoView({
                    behavior: 'auto',
                    block: 'start'
                });

            }, 100);

        }

    });

</script>

@endsection