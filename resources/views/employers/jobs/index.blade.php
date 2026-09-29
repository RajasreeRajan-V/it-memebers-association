@extends('layouts.app')

@section('title', 'My Jobs')

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

    .jobs-page {
        background: #f8fafc;
        min-height: 100vh;
        color: var(--job-text);
    }

    /* =========================================================
       HERO
    ========================================================= */

    .jobs-hero {
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

    .jobs-container {
        max-width: 1180px;
        margin: 0 auto;
        padding: 30px 24px 55px;
    }

    .jobs-layout {
        display: grid;
        grid-template-columns: minmax(0, 1fr) 350px;
        gap: 24px;
        align-items: start;
    }

    .jobs-main {
        min-width: 0;
    }

    #job-list {
        scroll-margin-top: 20px;
    }

    /* =========================================================
       JOB SECTION HEADER
    ========================================================= */

    .jobs-list-header {
        position: relative;
        min-height: 54px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 17px;
    }

    .jobs-list-header > div {
        text-align: center;
    }

    .jobs-list-title {
        margin: 0;
        color: #0f172a;
        font-size: 21px;
        line-height: 1.3;
        font-weight: 800;
        letter-spacing: -.015em;
    }

    .jobs-list-subtitle {
        margin: 4px 0 0;
        color: #94a3b8;
        font-size: 11px;
        line-height: 1.4;
    }

    .jobs-count {
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

    .jobs-search-card {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 9px;
        margin-bottom: 16px;
        box-shadow: 0 3px 12px rgba(15, 23, 42, .025);
    }

    .jobs-search-form {
        display: grid;
        grid-template-columns: minmax(0, 1fr) 145px 135px auto auto;
        gap: 7px;
        align-items: center;
    }

    .jobs-search-input-wrap {
        position: relative;
    }

    .jobs-search-input-wrap i {
        position: absolute;
        left: 11px;
        top: 50%;
        transform: translateY(-50%);
        color: #94a3b8;
        font-size: 12px;
        pointer-events: none;
    }

    .jobs-search-input,
    .jobs-search-select {
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

    .jobs-search-input {
        padding: 0 10px 0 32px;
    }

    .jobs-search-select {
        padding: 0 9px;
        cursor: pointer;
    }

    .jobs-search-input:focus,
    .jobs-search-select:focus {
        border-color: #3376f2;
        box-shadow: 0 0 0 3px rgba(51, 118, 242, .07);
    }

    .jobs-search-btn,
    .jobs-clear-btn {
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

    .jobs-search-btn {
        padding: 0 14px;
        border: 0;
        background: #3376f2;
        color: #fff;
        cursor: pointer;
    }

    .jobs-search-btn:hover {
        background: #245fd0;
    }

    .jobs-clear-btn {
        padding: 0 11px;
        border: 1px solid #e2e8f0;
        background: #fff;
        color: #64748b;
        text-decoration: none;
    }

    .jobs-clear-btn:hover {
        background: #f8fafc;
        color: #2563eb;
        border-color: #bfdbfe;
    }

    .jobs-search-result {
        margin-top: 7px;
        padding: 0 3px;
        color: #94a3b8;
        font-size: 9px;
    }

    .jobs-search-result strong {
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
       JOB CARD
    ========================================================= */

    .employer-job-card {
        position: relative;
        background: #fff;
        border: 1px solid #dfe6ef;
        border-radius: 16px;
        margin-bottom: 13px;
        overflow: visible;
        transition: .2s ease;
    }

    .employer-job-card:hover {
        border-color: #cbd9ee;
        box-shadow: 0 8px 25px rgba(15, 23, 42, .055);
    }

    .employer-job-card-inner {
        padding: 17px 18px 15px;
    }

    .job-card-top {
        position: relative;
        display: flex;
        justify-content: space-between;
        gap: 15px;
    }

    .job-main-info {
        min-width: 0;
        flex: 1;
    }

    .job-title-row {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 8px;
        margin-bottom: 7px;
        padding-right: 48px;
    }

    .job-card-title {
        margin: 0;
        color: #111827;
        font-size: 16px;
        line-height: 1.35;
        font-weight: 800;
        letter-spacing: -.01em;
        word-break: break-word;
    }

    /* =========================================================
       EMPLOYMENT TYPE
    ========================================================= */

    .job-type {
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
        border: 1px solid transparent;
    }

    .job-type-full-time {
        background: #eaf2ff;
        color: #2563eb;
        border-color: #bfdbfe;
    }

    .job-type-part-time {
        background: #f5f3ff;
        color: #7c3aed;
        border-color: #ddd6fe;
    }

    .job-type-contract {
        background: #fff7ed;
        color: #c2410c;
        border-color: #fed7aa;
    }

    .job-type-freelance {
        background: #ecfdf5;
        color: #047857;
        border-color: #a7f3d0;
    }

    .job-type-internship {
        background: #fdf4ff;
        color: #a21caf;
        border-color: #f5d0fe;
    }

    .job-type-temporary {
        background: #fffbeb;
        color: #b45309;
        border-color: #fde68a;
    }

    .job-type-default {
        background: #f1f5f9;
        color: #475569;
        border-color: #e2e8f0;
    }

    /* =========================================================
       COMPANY / LOCATION
    ========================================================= */

    .job-company-location {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 7px;
        color: #64748b;
        font-size: 11px;
        margin-bottom: 7px;
    }

    .job-company-location i {
        color: #64748b;
        font-size: 11px;
    }

    .job-company-name {
        font-weight: 600;
        color: #475569;
    }

    .startup-job-badge {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 4px 8px;
        margin-left: 2px;
        border-radius: 999px;
        background: #eef4ff;
        color: #2563eb;
        border: 1px solid #dbeafe;
        font-size: 8px;
        line-height: 1;
        font-weight: 800;
    }

    .startup-job-badge i {
        color: #2563eb;
        font-size: 8px;
    }

    .job-separator {
        color: #cbd5e1;
    }

    .job-location {
        color: #64748b;
        font-weight: 500;
    }

    .job-meta-row {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 13px;
        color: #64748b;
        font-size: 10px;
    }

    .job-meta-item {
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    .job-meta-item i {
        color: #94a3b8;
        font-size: 10px;
    }

    /* =========================================================
       THREE DOT MENU
    ========================================================= */

    .job-menu-wrap {
        position: absolute;
        top: 0;
        right: 0;
        z-index: 50;
    }

    .job-menu-toggle {
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

    .job-menu-toggle:hover,
    .job-menu-toggle:focus {
        background: #dbeafe;
        border-color: #60a5fa;
        color: #1d4ed8;
        outline: none;
        transform: translateY(-1px);
    }

    .job-menu {
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

    .job-menu.show {
        display: block;
    }

    .job-menu-item {
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

    .job-menu-item:hover {
        background: #f8fafc;
        color: #2563eb;
    }

    .job-menu-item i {
        width: 17px;
        color: #64748b;
        font-size: 13px;
    }

    .job-menu-item:hover i {
        color: #2563eb;
    }

    .job-menu-divider {
        height: 1px;
        background: #eef2f7;
        margin: 5px 2px;
    }

    .job-menu-item.danger {
        color: #dc2626;
    }

    .job-menu-item.danger i {
        color: #dc2626;
    }

    .job-menu-item.danger:hover {
        background: #fef2f2;
        color: #b91c1c;
    }

    /* =========================================================
       JOB STATS
    ========================================================= */

    .job-stats {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 9px;
        margin-top: 16px;
        padding-top: 14px;
        border-top: 1px solid #f1f5f9;
    }

    .job-stat {
        min-height: 55px;
        display: flex;
        align-items: center;
        gap: 9px;
        padding: 9px 11px;
        border-radius: 11px;
        background: #f8fafc;
    }

    .job-stat-icon {
        width: 30px;
        height: 30px;
        border-radius: 9px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        font-size: 12px;
    }

    .job-stat-blue .job-stat-icon {
        background: #eaf2ff;
        color: #2563eb;
    }

    .job-stat-green .job-stat-icon {
        background: #ecfdf5;
        color: #059669;
    }

    .job-stat-orange .job-stat-icon {
        background: #fff7ed;
        color: #ea580c;
    }

    .job-stat-number {
        display: block;
        color: #172033;
        font-size: 15px;
        line-height: 1.1;
        font-weight: 800;
    }

    .job-stat-label {
        display: block;
        margin-top: 3px;
        color: #94a3b8;
        font-size: 9px;
        line-height: 1.2;
    }

    /* =========================================================
       CARD FOOTER
    ========================================================= */

    .job-card-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        margin-top: 13px;
    }

    .job-status-area {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 8px;
    }

    .job-status {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 10px;
        border-radius: 999px;
        font-size: 9px;
        line-height: 1;
        font-weight: 800;
    }

    .job-status-active {
        color: #047857;
        background: #ecfdf5;
    }

    .job-status-closed {
        color: #64748b;
        background: #f1f5f9;
    }

    .status-dot {
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background: currentColor;
    }

    .job-posted-time {
        color: #94a3b8;
        font-size: 9px;
    }

    .job-actions {
        display: flex;
        align-items: center;
        gap: 7px;
        flex-wrap: wrap;
        justify-content: flex-end;
    }

    .job-action-btn {
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

    .job-view-btn {
        color: #2563eb;
        background: #eef4ff;
        border: 1px solid #dbeafe;
    }

    .job-view-btn:hover {
        background: #dbeafe;
        color: #1d4ed8;
    }

    .job-applicants-btn {
        color: #fff;
        background: #2563eb;
        border: 1px solid #2563eb;
    }

    .job-applicants-btn:hover {
        background: #1d4ed8;
        color: #fff;
    }

    /* =========================================================
       EMPTY
    ========================================================= */

    .jobs-empty {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 48px 24px;
        text-align: center;
    }

    .jobs-empty-icon {
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

    .jobs-empty h3 {
        margin: 0 0 5px;
        font-size: 17px;
        font-weight: 800;
        color: #172033;
    }

    .jobs-empty p {
        margin: 0 auto 17px;
        max-width: 390px;
        color: #94a3b8;
        font-size: 11px;
        line-height: 1.6;
    }

    .jobs-primary-btn {
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

    .jobs-primary-btn:hover {
        background: #1d4ed8;
        color: #fff;
    }

    /* =========================================================
       PAGINATION
    ========================================================= */

    .jobs-pagination {
        margin-top: 18px;
        display: flex;
        justify-content: center;
    }

    .jobs-pagination nav {
        width: 100%;
    }

    .jobs-pagination svg {
        width: 15px;
        height: 15px;
    }

    /* =========================================================
       SIDEBAR
    ========================================================= */

    .jobs-sidebar {
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

    .hiring-flow {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .hiring-step {
        display: flex;
        align-items: center;
        gap: 10px;
        color: #64748b;
        font-size: 11px;
    }

    .hiring-number {
        width: 18px;
        height: 18px;
        border-radius: 50%;
        border: 1px solid #86efac;
        color: #059669;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 9px;
        font-weight: 800;
        flex-shrink: 0;
    }

    /* =========================================================
       MODAL
    ========================================================= */

    .job-modal {
        position: fixed;
        inset: 0;
        z-index: 9999;
        display: none;
        align-items: center;
        justify-content: center;
        padding: 18px;
    }

    .job-modal.is-open {
        display: flex;
    }

    .job-modal-overlay {
        position: absolute;
        inset: 0;
        background: rgba(15, 23, 42, .58);
        backdrop-filter: blur(4px);
    }

    .job-modal-card {
        position: relative;
        z-index: 2;
        width: min(720px, 100%);
        max-height: 88vh;
        overflow-y: auto;
        background: #fff;
        border-radius: 19px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 30px 80px rgba(15, 23, 42, .24);
        animation: jobModalIn .18s ease;
    }

    @keyframes jobModalIn {
        from {
            opacity: 0;
            transform: translateY(10px) scale(.98);
        }

        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    body.job-modal-open {
        overflow: hidden;
    }

    .job-modal-close {
        position: absolute;
        top: 14px;
        right: 14px;
        width: 34px;
        height: 34px;
        border: 1px solid #e2e8f0;
        background: #fff;
        color: #64748b;
        border-radius: 9px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        z-index: 5;
    }

    .job-modal-close:hover {
        background: #f8fafc;
        color: #ef4444;
        border-color: #fecaca;
    }

    .job-modal-header {
        display: flex;
        gap: 13px;
        padding: 22px 55px 18px 22px;
        border-bottom: 1px solid #f1f5f9;
    }

    .job-modal-icon {
        width: 47px;
        height: 47px;
        border-radius: 12px;
        background: #eaf2ff;
        color: #3376f2;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        flex-shrink: 0;
    }

    .job-modal-header-content {
        min-width: 0;
    }

    .job-modal-title {
        margin: 6px 0 4px;
        color: #111827;
        font-size: 20px;
        line-height: 1.3;
        font-weight: 800;
        word-break: break-word;
    }

    .job-modal-company {
        margin: 0;
        color: #64748b;
        font-size: 11px;
    }

    .job-modal-company i {
        margin-right: 4px;
    }

    .job-modal-body {
        padding: 19px 22px 21px;
    }

    .job-modal-meta-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 9px;
    }

    .job-modal-meta {
        display: flex;
        align-items: flex-start;
        gap: 9px;
        padding: 11px;
        border: 1px solid #eef2f7;
        border-radius: 11px;
        background: #f8fafc;
    }

    .job-modal-meta > i {
        color: #3376f2;
        font-size: 13px;
        width: 17px;
        flex-shrink: 0;
        margin-top: 2px;
    }

    .job-modal-meta-label {
        display: block;
        color: #94a3b8;
        font-size: 8px;
        line-height: 1.2;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: .05em;
    }

    .job-modal-meta-value {
        display: block;
        margin-top: 3px;
        color: #172033;
        font-size: 11px;
        line-height: 1.45;
        font-weight: 700;
        word-break: break-word;
    }

    .job-modal-section {
        margin-top: 19px;
    }

    .job-modal-section-title {
        margin: 0 0 8px;
        color: #172033;
        font-size: 13px;
        font-weight: 800;
    }

    .job-modal-description {
        color: #64748b;
        font-size: 11px;
        line-height: 1.75;
        white-space: pre-line;
    }

    .job-modal-skills {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
    }

    .job-modal-skill {
        display: inline-flex;
        align-items: center;
        padding: 5px 9px;
        border-radius: 999px;
        background: #eef4ff;
        color: #2563eb;
        font-size: 9px;
        font-weight: 700;
        border: 1px solid #dbeafe;
    }

    .job-modal-stats {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 8px;
        margin-top: 18px;
    }

    .job-modal-stat {
        padding: 11px;
        border-radius: 10px;
        background: #f8fafc;
        text-align: center;
        border: 1px solid #eef2f7;
    }

    .job-modal-stat strong {
        display: block;
        color: #172033;
        font-size: 16px;
        line-height: 1.1;
        font-weight: 800;
    }

    .job-modal-stat span {
        display: block;
        margin-top: 3px;
        color: #94a3b8;
        font-size: 8px;
    }

    .job-modal-footer {
        display: flex;
        justify-content: flex-end;
        gap: 8px;
        padding: 15px 22px 19px;
        border-top: 1px solid #f1f5f9;
    }

    .job-modal-secondary,
    .job-modal-primary {
        min-height: 34px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        padding: 0 13px;
        border-radius: 8px;
        font-size: 10px;
        font-weight: 700;
        text-decoration: none;
        cursor: pointer;
    }

    .job-modal-secondary {
        border: 1px solid #e2e8f0;
        background: #fff;
        color: #64748b;
    }

    .job-modal-primary {
        border: 1px solid #2563eb;
        background: #2563eb;
        color: #fff;
    }

    .job-modal-primary:hover {
        background: #1d4ed8;
        color: #fff;
    }

    /* =========================================================
       RESPONSIVE
    ========================================================= */

    @media (max-width: 1080px) {

        .jobs-layout {
            grid-template-columns: 1fr;
        }

        .jobs-sidebar {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
        }

        .sidebar-cta {
            grid-column: 1 / -1;
        }
    }

    @media (max-width: 1000px) {

        .jobs-search-form {
            grid-template-columns: minmax(0, 1fr) 150px 140px auto auto;
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

        .jobs-search-form {
            grid-template-columns: minmax(0, 1fr) 1fr;
        }

        .jobs-search-input-wrap {
            grid-column: 1 / -1;
        }

        .jobs-search-btn,
        .jobs-clear-btn {
            width: 100%;
        }
    }

    @media (max-width: 700px) {

        .jobs-container {
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

        .jobs-sidebar {
            grid-template-columns: 1fr;
        }

        .jobs-list-header {
            padding-right: 40px;
        }

        .job-stats {
            grid-template-columns: 1fr;
        }

        .job-card-footer {
            align-items: flex-start;
            flex-direction: column;
        }

        .job-actions {
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

        .jobs-search-form {
            grid-template-columns: 1fr;
        }

        .jobs-search-input-wrap {
            grid-column: auto;
        }

        .jobs-search-btn,
        .jobs-clear-btn {
            width: 100%;
        }

        .job-modal {
            padding: 10px;
        }

        .job-modal-card {
            max-height: 92vh;
            border-radius: 16px;
        }

        .job-modal-header {
            padding: 19px 50px 16px 17px;
        }

        .job-modal-body {
            padding: 17px;
        }

        .job-modal-meta-grid {
            grid-template-columns: 1fr;
        }

        .job-modal-stats {
            grid-template-columns: 1fr;
        }

        .job-modal-footer {
            padding: 13px 17px 17px;
            flex-direction: column;
        }

        .job-modal-primary,
        .job-modal-secondary {
            width: 100%;
        }
    }

    @media (max-width: 450px) {

        .employer-job-card-inner {
            padding: 15px;
        }

        .job-card-title {
            font-size: 15px;
        }

        .job-actions {
            flex-direction: column;
            align-items: stretch;
        }

        .job-action-btn {
            width: 100%;
        }

        .job-modal-title {
            font-size: 18px;
        }
    }
</style>


<div class="jobs-page">


{{-- =====================================================
     HERO
====================================================== --}}

<section class="jobs-hero">

    <div class="hero-inner">

        <div class="hero-left">

            <span class="hero-badge">

                <svg fill="currentColor" viewBox="0 0 24 24">
                    <path d="M13 2 3 14h7l-1 8 11-14h-7l0-6z"/>
                </svg>

                BUILD YOUR NEXT TEAM

            </span>


            <h1 class="hero-title">

                Find Great Talent,

                <span>
                    Build Your Team
                </span>

            </h1>


            <p class="hero-description">

                Create job opportunities, connect with qualified professionals,
                review applications, and build your team with confidence.

            </p>


            <div class="hero-buttons">

                <a
                    href="{{ route('employer.jobs.create') }}"
                    class="hero-primary-btn"
                >

                    <i class="bi bi-plus-lg"></i>

                    Create a Job

                </a>


                <a
                    href="#job-list"
                    class="hero-secondary-btn"
                >

                    View My Jobs

                </a>

            </div>

        </div>


        <div class="hero-image-wrap">

            <img
                src="{{ asset('assets/img/jjj.png') }}"
                alt="Manage employer jobs"
                class="hero-image"
                onerror="this.style.display='none'"
            >


            <div class="floating-card floating-card-one">

                <span class="floating-icon floating-icon-blue">

                    <i class="bi bi-check-lg"></i>

                </span>


                <div>

                    <p class="floating-title">
                        Active Job Posts
                    </p>

                    <p class="floating-subtitle">
                        Reach qualified candidates
                    </p>

                </div>

            </div>


            <div class="floating-card floating-card-two">

                <span class="floating-icon floating-icon-purple">

                    <i class="bi bi-stars"></i>

                </span>


                <div>

                    <p class="floating-title">
                        Candidate Matching
                    </p>

                    <p class="floating-subtitle">
                        Find suitable professionals
                    </p>

                </div>

            </div>


            <div class="floating-card floating-card-three">

                <span class="floating-icon floating-icon-green">

                    <i class="bi bi-lightning-charge-fill"></i>

                </span>


                <div>

                    <p class="floating-title">
                        Faster Hiring
                    </p>

                    <p class="floating-subtitle">
                        Manage your hiring pipeline
                    </p>

                </div>

            </div>

        </div>

    </div>

</section>



{{-- =====================================================
     MAIN
====================================================== --}}

<div class="jobs-container" id="job-list">

    <div class="jobs-layout">


        {{-- =================================================
             JOB LIST
        ================================================== --}}

        <main class="jobs-main">


            {{-- =================================================
                 JOB HEADER
            ================================================== --}}

            <div class="jobs-list-header">

                <div>

                    <h2 class="jobs-list-title">
                        My Job Postings
                    </h2>

                    <p class="jobs-list-subtitle">

                        Manage your vacancies and hiring activity

                        @if(request()->hasAny([
                            'search',
                            'employment_type',
                            'status'
                        ]))

                            <span class="active-filter-badge">

                                <i class="bi bi-funnel-fill"></i>

                                Filtered Results

                            </span>

                        @endif

                    </p>

                </div>


                <span class="jobs-count">
                    {{ $jobs->total() ?? $jobs->count() }}
                </span>

            </div>



            {{-- =================================================
                 SEARCH / FILTER
            ================================================== --}}

            <div class="jobs-search-card">

                <form
                    action="{{ route('employer.jobs.index') }}"
                    method="GET"
                    class="jobs-search-form"
                    id="jobSearchForm"
                >


                    {{-- SEARCH --}}

                    <div class="jobs-search-input-wrap">

                        <i class="bi bi-search"></i>

                        <input
                            type="text"
                            name="search"
                            class="jobs-search-input"
                            value="{{ request('search') }}"
                            placeholder="Search jobs, skills, location..."
                        >

                    </div>



                    {{-- EMPLOYMENT TYPE --}}

                    <select
                        name="employment_type"
                        class="jobs-search-select"
                    >

                        <option value="">
                            Employment Types
                        </option>


                        <option
                            value="full-time"
                            {{ request('employment_type') === 'full-time' ? 'selected' : '' }}
                        >
                            Full Time
                        </option>


                        <option
                            value="part-time"
                            {{ request('employment_type') === 'part-time' ? 'selected' : '' }}
                        >
                            Part Time
                        </option>


                        <option
                            value="contract"
                            {{ request('employment_type') === 'contract' ? 'selected' : '' }}
                        >
                            Contract
                        </option>


                        <option
                            value="internship"
                            {{ request('employment_type') === 'internship' ? 'selected' : '' }}
                        >
                            Internship
                        </option>


                        <option
                            value="freelance"
                            {{ request('employment_type') === 'freelance' ? 'selected' : '' }}
                        >
                            Freelance
                        </option>

                    </select>



                    {{-- STATUS --}}

                    <select
                        name="status"
                        class="jobs-search-select"
                    >

                        <option value="">
                            All Status
                        </option>

                        <option
                            value="active"
                            {{ request('status') === 'active' ? 'selected' : '' }}
                        >
                            Active
                        </option>

                        <option
                            value="closed"
                            {{ request('status') === 'closed' ? 'selected' : '' }}
                        >
                            Closed
                        </option>

                    </select>



                    {{-- SEARCH BUTTON --}}

                    <button
                        type="submit"
                        class="jobs-search-btn"
                    >

                        <i class="bi bi-search"></i>

                        Search

                    </button>



                    {{-- CLEAR BUTTON --}}

                    @if(request()->hasAny([
                        'search',
                        'employment_type',
                        'status'
                    ]))

                        <a
                            href="{{ route('employer.jobs.index') }}"
                            class="jobs-clear-btn"
                        >

                            <i class="bi bi-x-lg"></i>

                            Clear

                        </a>

                    @endif

                </form>



                {{-- RESULT TEXT --}}

                @if(request()->hasAny([
                    'search',
                    'employment_type',
                    'status'
                ]))

                    <div class="jobs-search-result">

                        Showing filtered results

                        @if(request('search'))

                            for
                            "<strong>{{ request('search') }}</strong>"

                        @endif


                        @if(request('employment_type'))

                            ·

                            {{
                                ucwords(
                                    str_replace(
                                        ['-', '_'],
                                        ' ',
                                        request('employment_type')
                                    )
                                )
                            }}

                        @endif


                        @if(request('status'))

                            ·

                            {{ ucfirst(request('status')) }}

                        @endif

                    </div>

                @endif

            </div>



            {{-- =================================================
                 JOB CARDS
            ================================================== --}}

            @forelse ($jobs as $job)

                @php

                    /*
                    |--------------------------------------------------------------------------
                    | JOB TITLE
                    |--------------------------------------------------------------------------
                    */

                    $jobTitle = $job->title
                        ?? $job->job_title
                        ?? 'Untitled Job';


                    /*
                    |--------------------------------------------------------------------------
                    | EMPLOYMENT TYPE
                    |--------------------------------------------------------------------------
                    */

                    $employmentType = $job->employment_type
                        ?? $job->job_type
                        ?? 'full-time';


                    $employmentKey = strtolower(
                        str_replace(
                            [' ', '-'],
                            '_',
                            trim((string) $employmentType)
                        )
                    );


                    /*
                    |--------------------------------------------------------------------------
                    | Handle old values
                    |--------------------------------------------------------------------------
                    */

                    $employmentKey = match ($employmentKey) {

                        'full_time' => 'full_time',

                        'part_time' => 'part_time',

                        'contract' => 'contract',

                        'internship',
                        'intern' => 'internship',

                        'freelance',
                        'freelancer' => 'freelance',

                        'temporary' => 'temporary',

                        default => $employmentKey,

                    };


                    $employmentLabel = ucwords(
                        str_replace(
                            '_',
                            ' ',
                            $employmentKey
                        )
                    );


                    $employmentTagClass = match ($employmentKey) {

                        'full_time' =>
                            'job-type-full-time',

                        'part_time' =>
                            'job-type-part-time',

                        'contract' =>
                            'job-type-contract',

                        'freelance' =>
                            'job-type-freelance',

                        'internship' =>
                            'job-type-internship',

                        'temporary' =>
                            'job-type-temporary',

                        default =>
                            'job-type-default',

                    };


                    /*
                    |--------------------------------------------------------------------------
                    | LOCATION
                    |--------------------------------------------------------------------------
                    */

                    $city = $job->city ?? '';
                    $state = $job->state ?? '';
                    $district = $job->district ?? '';
                    $country = $job->country ?? '';


                    $locationParts = array_filter([
                        $city,
                        $state
                    ]);


                    $location = implode(
                        ', ',
                        $locationParts
                    );


                    $modalLocationParts = array_filter([
                        $city,
                        $district,
                        $state,
                        $country
                    ]);


                    $modalLocation = implode(
                        ', ',
                        $modalLocationParts
                    );


                    /*
                    |--------------------------------------------------------------------------
                    | COMPANY / STARTUP PROFILE
                    |--------------------------------------------------------------------------
                    |
                    | IMPORTANT:
                    |
                    | Normal Job:
                    | startup_profile_id = NULL
                    | → employer company name
                    |
                    | Startup Job:
                    | startup_profile_id has value
                    | → startup profile name
                    |
                    */

                    $employerRegistration =
                        $job->employerRegistration ?? null;


                    $startupProfile =
                        $job->startupProfile ?? null;


                    $isStartupJob =
                        !empty($job->startup_profile_id)
                        && $startupProfile;


                    if ($isStartupJob) {

                        $companyName =
                            $startupProfile->startup_name
                            ?? 'Startup';

                    } else {

                        $companyName =
                            optional($employerRegistration)->company_name
                            ?? $job->company_name
                            ?? 'Your Company';

                    }


                    /*
                    |--------------------------------------------------------------------------
                    | WORK MODE
                    |--------------------------------------------------------------------------
                    */

                    $workMode = $job->work_mode
                        ?? $job->location_type
                        ?? '';


                    $workModeLabel = $workMode
                        ? ucwords(
                            str_replace(
                                ['_', '-'],
                                ' ',
                                strtolower((string) $workMode)
                            )
                        )
                        : 'Not specified';



                    /*
                    |--------------------------------------------------------------------------
                    | EXPERIENCE
                    |--------------------------------------------------------------------------
                    */

                    $experienceRaw = $job->experience
                        ?? $job->experience_level
                        ?? '';


                    if (is_array($experienceRaw)) {

                        $experience = implode(
                            ', ',
                            array_map(
                                'strval',
                                $experienceRaw
                            )
                        );

                    } else {

                        $experience = (string) $experienceRaw;

                    }


                    $experience = trim($experience);


                    if ($experience === '') {

                        $experience = 'Not specified';

                    }



                    /*
                    |--------------------------------------------------------------------------
                    | SALARY
                    |--------------------------------------------------------------------------
                    */

                    $salaryRaw = $job->salary ?? '';


                    if (is_array($salaryRaw)) {

                        $salary = implode(
                            ', ',
                            array_map(
                                'strval',
                                $salaryRaw
                            )
                        );

                    } else {

                        $salary = (string) $salaryRaw;

                    }


                    $salary = trim($salary);


                    if ($salary === '') {

                        $salary = 'Not specified';

                    }



                    /*
                    |--------------------------------------------------------------------------
                    | QUALIFICATION
                    |--------------------------------------------------------------------------
                    */

                    $qualificationRaw =
                        $job->qualification ?? '';


                    if (is_array($qualificationRaw)) {

                        $qualification = implode(
                            ', ',
                            array_map(
                                'strval',
                                $qualificationRaw
                            )
                        );

                    } else {

                        $qualification =
                            (string) $qualificationRaw;

                    }


                    $qualification =
                        trim($qualification);


                    if ($qualification === '') {

                        $qualification =
                            'Not specified';

                    }



                    /*
                    |--------------------------------------------------------------------------
                    | SKILLS
                    |--------------------------------------------------------------------------
                    */

                    $skillsRaw = $job->skills ?? '';


                    if (is_array($skillsRaw)) {

                        $skillsArray = collect($skillsRaw)

                            ->flatten()

                            ->map(function ($skill) {

                                return trim(
                                    (string) $skill
                                );

                            })

                            ->filter()

                            ->values()

                            ->all();

                    } else {

                        $skillsString =
                            (string) $skillsRaw;


                        $decodedSkills =
                            json_decode(
                                $skillsString,
                                true
                            );


                        if (
                            json_last_error() === JSON_ERROR_NONE
                            && is_array($decodedSkills)
                        ) {

                            $skillsArray =
                                collect($decodedSkills)

                                ->flatten()

                                ->map(function ($skill) {

                                    return trim(
                                        (string) $skill
                                    );

                                })

                                ->filter()

                                ->values()

                                ->all();

                        } else {

                            $skillsArray =
                                preg_split(
                                    '/[,;\n]+/',
                                    $skillsString,
                                    -1,
                                    PREG_SPLIT_NO_EMPTY
                                );


                            $skillsArray =
                                array_values(
                                    array_filter(
                                        array_map(
                                            fn ($skill) =>
                                                trim((string) $skill),
                                            $skillsArray
                                        )
                                    )
                                );

                        }

                    }


                    $skillsText =
                        implode(
                            ', ',
                            $skillsArray
                        );


                    if ($skillsText === '') {

                        $skillsText =
                            'Not specified';

                    }



                    /*
                    |--------------------------------------------------------------------------
                    | DESCRIPTION
                    |--------------------------------------------------------------------------
                    */

                    $descriptionRaw =
                        $job->description ?? '';


                    if (is_array($descriptionRaw)) {

                        $description =
                            implode(
                                "\n",
                                array_map(
                                    'strval',
                                    $descriptionRaw
                                )
                            );

                    } else {

                        $description =
                            (string) $descriptionRaw;

                    }


                    $description =
                        trim($description);


                    if ($description === '') {

                        $description =
                            'No description provided.';

                    }



                    /*
                    |--------------------------------------------------------------------------
                    | COUNTS
                    |--------------------------------------------------------------------------
                    */

                    $applicationsCount =
                        $job->applications_count
                        ?? $job->applicants_count
                        ?? 0;


                    $shortlistedCount =
                        $job->shortlisted_count
                        ?? 0;


                    $interviewsCount =
                        $job->interviews_count
                        ?? 0;



                    /*
                    |--------------------------------------------------------------------------
                    | STATUS
                    |--------------------------------------------------------------------------
                    */

                    $isActive =
                        (bool) (
                            $job->is_active ?? false
                        );


                    if (
                        isset($job->status)
                        &&
                        strtolower(
                            (string) $job->status
                        ) === 'closed'
                    ) {

                        $isActive = false;

                    }


                    $statusText =
                        $isActive
                            ? 'Active'
                            : 'Closed';


                    $jobStatusClass =
                        $isActive
                            ? 'job-status-active'
                            : 'job-status-closed';



                    /*
                    |--------------------------------------------------------------------------
                    | POSTED TIME
                    |--------------------------------------------------------------------------
                    */

                    $postedText = 'Recently';


                    if ($job->created_at) {

                        $postedText =
                            $job->created_at->diffForHumans();

                    }

                @endphp



                {{-- =================================================
                     JOB CARD
                ================================================== --}}

                <article class="employer-job-card">

                    <div class="employer-job-card-inner">


                        <div class="job-card-top">


                            <div class="job-main-info">


                                <div class="job-title-row">


                                    <h3 class="job-card-title">

                                        {{ $jobTitle }}

                                    </h3>


                                    <span class="job-type {{ $employmentTagClass }}">

                                        {{ $employmentLabel }}

                                    </span>

                                </div>



                                {{-- =================================================
                                     COMPANY / STARTUP
                                ================================================== --}}

                                <div class="job-company-location">


                                    @if($isStartupJob)

                                        <i class="bi bi-rocket-takeoff"></i>

                                        <span class="job-company-name">

                                            {{ $companyName }}

                                        </span>


                                        <span class="startup-job-badge">

                                            <i class="bi bi-rocket-takeoff"></i>

                                            Startup

                                        </span>

                                    @else

                                        <i class="bi bi-building"></i>

                                        <span class="job-company-name">

                                            {{ $companyName }}

                                        </span>

                                    @endif



                                    @if($location)

                                        <span class="job-separator">
                                            •
                                        </span>


                                        <i class="bi bi-geo-alt"></i>


                                        <span class="job-location">

                                            {{ $location }}

                                        </span>

                                    @endif

                                </div>



                                {{-- META --}}

                                <div class="job-meta-row">


                                    @if(
                                        $workModeLabel !==
                                        'Not specified'
                                    )

                                        <span class="job-meta-item">

                                            <i class="bi bi-laptop"></i>

                                            {{ $workModeLabel }}

                                        </span>

                                    @endif


                                    @if($applicationsCount > 0)

                                        <span class="job-meta-item">

                                            <i class="bi bi-people"></i>

                                            {{ $applicationsCount }}

                                        </span>

                                    @endif


                                    @if(
                                        $salary !==
                                        'Not specified'
                                    )

                                        <span class="job-meta-item">

                                            <i class="bi bi-cash"></i>

                                            {{ $salary }}

                                        </span>

                                    @endif

                                </div>

                            </div>



                            {{-- =================================================
                                 THREE DOT MENU
                            ================================================== --}}

                            <div class="job-menu-wrap">


                                <button
                                    type="button"
                                    class="job-menu-toggle"
                                    onclick="toggleJobMenu({{ $job->id }})"
                                    aria-label="Job actions"
                                >

                                    <i class="bi bi-three-dots-vertical"></i>

                                </button>



                                <div
                                    id="job-menu-{{ $job->id }}"
                                    class="job-menu"
                                >


                                    {{-- VIEW --}}

                                    <button
                                        type="button"
                                        class="job-menu-item"
                                        onclick="openJobModal({{ $job->id }})"
                                    >

                                        <i class="bi bi-eye"></i>

                                        <span>
                                            View
                                        </span>

                                    </button>



                                    {{-- EDIT --}}

                                    <a
                                        href="{{ route('employer.jobs.edit', $job) }}"
                                        class="job-menu-item"
                                    >

                                        <i class="bi bi-pencil"></i>

                                        <span>
                                            Edit
                                        </span>

                                    </a>



                                    {{-- APPLICANTS --}}

                                    <a
                                        href="{{ route('employer.applicants.index', ['job' => $job->id]) }}"
                                        class="job-menu-item"
                                    >

                                        <i class="bi bi-people"></i>

                                        <span>
                                            Applicants
                                        </span>

                                    </a>



                                    {{-- DUPLICATE --}}

                                    <form
                                        action="{{ route('employer.jobs.duplicate', $job) }}"
                                        method="POST"
                                        style="margin:0;"
                                    >

                                        @csrf

                                        <button
                                            type="submit"
                                            class="job-menu-item"
                                        >

                                            <i class="bi bi-copy"></i>

                                            <span>
                                                Duplicate
                                            </span>

                                        </button>

                                    </form>



                                    <div class="job-menu-divider"></div>



                                    {{-- CLOSE / REOPEN --}}

                                    @if($isActive)

                                        <form
                                            action="{{ route('employer.jobs.close', $job) }}"
                                            method="POST"
                                            style="margin:0;"
                                        >

                                            @csrf

                                            @method('PATCH')

                                            <button
                                                type="submit"
                                                class="job-menu-item"
                                            >

                                                <i class="bi bi-pause-circle"></i>

                                                <span>
                                                    Close Job
                                                </span>

                                            </button>

                                        </form>

                                    @else

                                        <form
                                            action="{{ route('employer.jobs.reopen', $job) }}"
                                            method="POST"
                                            style="margin:0;"
                                        >

                                            @csrf

                                            @method('PATCH')

                                            <button
                                                type="submit"
                                                class="job-menu-item"
                                            >

                                                <i class="bi bi-play-circle"></i>

                                                <span>
                                                    Reopen Job
                                                </span>

                                            </button>

                                        </form>

                                    @endif



                                    <div class="job-menu-divider"></div>



                                    {{-- DELETE --}}

                                    <form
                                        action="{{ route('employer.jobs.destroy', $job) }}"
                                        method="POST"
                                        style="margin:0;"
                                        onsubmit="return confirm('Are you sure you want to delete this job posting? This action cannot be undone.');"
                                    >

                                        @csrf

                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="job-menu-item danger"
                                        >

                                            <i class="bi bi-trash3"></i>

                                            <span>
                                                Delete Job
                                            </span>

                                        </button>

                                    </form>

                                </div>

                            </div>

                        </div>



                        {{-- =================================================
                             STATS
                        ================================================== --}}

                        <div class="job-stats">


                            <div class="job-stat job-stat-blue">

                                <span class="job-stat-icon">

                                    <i class="bi bi-people"></i>

                                </span>


                                <div>

                                    <span class="job-stat-number">
                                        {{ $applicationsCount }}
                                    </span>

                                    <span class="job-stat-label">
                                        Applications
                                    </span>

                                </div>

                            </div>



                            <div class="job-stat job-stat-green">

                                <span class="job-stat-icon">

                                    <i class="bi bi-person-check"></i>

                                </span>


                                <div>

                                    <span class="job-stat-number">
                                        {{ $shortlistedCount }}
                                    </span>

                                    <span class="job-stat-label">
                                        Shortlisted
                                    </span>

                                </div>

                            </div>



                            <div class="job-stat job-stat-orange">

                                <span class="job-stat-icon">

                                    <i class="bi bi-calendar-check"></i>

                                </span>


                                <div>

                                    <span class="job-stat-number">
                                        {{ $interviewsCount }}
                                    </span>

                                    <span class="job-stat-label">
                                        Interviews
                                    </span>

                                </div>

                            </div>

                        </div>



                        {{-- =================================================
                             FOOTER
                        ================================================== --}}

                        <div class="job-card-footer">


                            <div class="job-status-area">


                                <span class="job-status {{ $jobStatusClass }}">

                                    <span class="status-dot"></span>

                                    {{ $statusText }}

                                </span>


                                <span class="job-posted-time">

                                    Posted {{ $postedText }}

                                </span>

                            </div>



                            <div class="job-actions">


                                <button
                                    type="button"
                                    class="job-action-btn job-view-btn"
                                    onclick="openJobModal({{ $job->id }})"
                                >

                                    <i class="bi bi-eye"></i>

                                    View Job

                                </button>


                                <a
                                    href="{{ route('employer.applicants.index', ['job' => $job->id]) }}"
                                    class="job-action-btn job-applicants-btn"
                                >

                                    <i class="bi bi-people"></i>

                                    Applicants

                                </a>

                            </div>

                        </div>

                    </div>

                </article>



                {{-- =================================================
                     JOB MODAL
                ================================================== --}}

                <div
                    id="jobModal-{{ $job->id }}"
                    class="job-modal"
                    aria-hidden="true"
                >

                    <div
                        class="job-modal-overlay"
                        onclick="closeJobModal({{ $job->id }})"
                    ></div>



                    <div
                        class="job-modal-card"
                        role="dialog"
                        aria-modal="true"
                        aria-labelledby="job-modal-title-{{ $job->id }}"
                    >


                        <button
                            type="button"
                            class="job-modal-close"
                            onclick="closeJobModal({{ $job->id }})"
                            aria-label="Close"
                        >

                            <i class="bi bi-x-lg"></i>

                        </button>



                        {{-- MODAL HEADER --}}

                        <div class="job-modal-header">


                            <div class="job-modal-icon">

                                <i class="bi bi-briefcase-fill"></i>

                            </div>



                            <div class="job-modal-header-content">


                                <span class="job-type {{ $employmentTagClass }}">

                                    {{ $employmentLabel }}

                                </span>


                                <h2
                                    id="job-modal-title-{{ $job->id }}"
                                    class="job-modal-title"
                                >

                                    {{ $jobTitle }}

                                </h2>


                                <p class="job-modal-company">


                                    @if($isStartupJob)

                                        <i class="bi bi-rocket-takeoff"></i>

                                    @else

                                        <i class="bi bi-building"></i>

                                    @endif


                                    {{ $companyName }}


                                    @if($isStartupJob)

                                        <span class="startup-job-badge">

                                            Startup

                                        </span>

                                    @endif

                                </p>

                            </div>

                        </div>



                        {{-- MODAL BODY --}}

                        <div class="job-modal-body">


                            <div class="job-modal-meta-grid">


                                {{-- LOCATION --}}

                                <div class="job-modal-meta">

                                    <i class="bi bi-geo-alt"></i>

                                    <div>

                                        <span class="job-modal-meta-label">
                                            Location
                                        </span>

                                        <strong class="job-modal-meta-value">
                                            {{ $modalLocation ?: 'Not specified' }}
                                        </strong>

                                    </div>

                                </div>



                                {{-- WORK MODE --}}

                                <div class="job-modal-meta">

                                    <i class="bi bi-laptop"></i>

                                    <div>

                                        <span class="job-modal-meta-label">
                                            Work Mode
                                        </span>

                                        <strong class="job-modal-meta-value">
                                            {{ $workModeLabel }}
                                        </strong>

                                    </div>

                                </div>



                                {{-- EXPERIENCE --}}

                                <div class="job-modal-meta">

                                    <i class="bi bi-person-workspace"></i>

                                    <div>

                                        <span class="job-modal-meta-label">
                                            Experience
                                        </span>

                                        <strong class="job-modal-meta-value">
                                            {{ $experience }}
                                        </strong>

                                    </div>

                                </div>



                                {{-- SALARY --}}

                                <div class="job-modal-meta">

                                    <i class="bi bi-cash-stack"></i>

                                    <div>

                                        <span class="job-modal-meta-label">
                                            Salary
                                        </span>

                                        <strong class="job-modal-meta-value">
                                            {{ $salary }}
                                        </strong>

                                    </div>

                                </div>



                                {{-- QUALIFICATION --}}

                                <div class="job-modal-meta">

                                    <i class="bi bi-mortarboard"></i>

                                    <div>

                                        <span class="job-modal-meta-label">
                                            Qualification
                                        </span>

                                        <strong class="job-modal-meta-value">
                                            {{ $qualification }}
                                        </strong>

                                    </div>

                                </div>



                                {{-- STATUS --}}

                                <div class="job-modal-meta">

                                    <i class="bi bi-activity"></i>

                                    <div>

                                        <span class="job-modal-meta-label">
                                            Status
                                        </span>

                                        <strong class="job-modal-meta-value">
                                            {{ $statusText }}
                                        </strong>

                                    </div>

                                </div>

                            </div>



                            {{-- =================================================
                                 SKILLS
                            ================================================== --}}

                            <div class="job-modal-section">


                                <h3 class="job-modal-section-title">
                                    Skills
                                </h3>


                                @if(count($skillsArray) > 0)

                                    <div class="job-modal-skills">

                                        @foreach($skillsArray as $skill)

                                            <span class="job-modal-skill">

                                                {{ $skill }}

                                            </span>

                                        @endforeach

                                    </div>

                                @else

                                    <div class="job-modal-description">
                                        Not specified
                                    </div>

                                @endif

                            </div>



                            {{-- =================================================
                                 DESCRIPTION
                            ================================================== --}}

                            <div class="job-modal-section">


                                <h3 class="job-modal-section-title">
                                    Job Description
                                </h3>


                                <div class="job-modal-description">

                                    {{ $description }}

                                </div>

                            </div>



                            {{-- =================================================
                                 STATS
                            ================================================== --}}

                            <div class="job-modal-stats">


                                <div class="job-modal-stat">

                                    <strong>
                                        {{ $applicationsCount }}
                                    </strong>

                                    <span>
                                        Applications
                                    </span>

                                </div>


                                <div class="job-modal-stat">

                                    <strong>
                                        {{ $shortlistedCount }}
                                    </strong>

                                    <span>
                                        Shortlisted
                                    </span>

                                </div>


                                <div class="job-modal-stat">

                                    <strong>
                                        {{ $interviewsCount }}
                                    </strong>

                                    <span>
                                        Interviews
                                    </span>

                                </div>

                            </div>

                        </div>



                        {{-- MODAL FOOTER --}}

                        <div class="job-modal-footer">


                            <button
                                type="button"
                                class="job-modal-secondary"
                                onclick="closeJobModal({{ $job->id }})"
                            >

                                Close

                            </button>


                            <a
                                href="{{ route('employer.applicants.index', ['job' => $job->id]) }}"
                                class="job-modal-primary"
                            >

                                <i class="bi bi-people"></i>

                                View Applicants

                            </a>

                        </div>

                    </div>

                </div>


            @empty


                {{-- =================================================
                     EMPTY STATE
                ================================================== --}}

                <div class="jobs-empty">


                    <div class="jobs-empty-icon">

                        <i class="bi bi-briefcase"></i>

                    </div>


                    <h3>

                        @if(request()->hasAny([
                            'search',
                            'employment_type',
                            'status'
                        ]))

                            No Matching Jobs Found

                        @else

                            No Job Postings Yet

                        @endif

                    </h3>


                    <p>

                        @if(request()->hasAny([
                            'search',
                            'employment_type',
                            'status'
                        ]))

                            Try changing your search or filters to find
                            another job posting.

                        @else

                            Create your first job posting and start connecting
                            with qualified candidates.

                        @endif

                    </p>



                    @if(request()->hasAny([
                        'search',
                        'employment_type',
                        'status'
                    ]))

                        <a
                            href="{{ route('employer.jobs.index') }}"
                            class="jobs-primary-btn"
                        >

                            <i class="bi bi-arrow-counterclockwise"></i>

                            Clear Filters

                        </a>

                    @else

                        <a
                            href="{{ route('employer.jobs.create') }}"
                            class="jobs-primary-btn"
                        >

                            <i class="bi bi-plus-lg"></i>

                            Create Your First Job

                        </a>

                    @endif

                </div>

            @endforelse



            {{-- =================================================
                 PAGINATION
            ================================================== --}}

            @if(method_exists($jobs, 'links'))

                <div class="jobs-pagination">

                    {{
                        $jobs
                            ->withQueryString()
                            ->fragment('job-list')
                            ->links()
                    }}

                </div>

            @endif

        </main>



        {{-- =====================================================
             SIDEBAR
        ====================================================== --}}

        <aside class="jobs-sidebar">


            {{-- CTA --}}

            <div class="sidebar-cta">

                <div class="sidebar-cta-content">

                    <h3>
                        Grow Your Team
                    </h3>

                    <p>
                        Create a new vacancy and connect with
                        qualified professionals.
                    </p>

                    <a
                        href="{{ route('employer.jobs.create') }}"
                        class="sidebar-cta-btn"
                    >

                        Create Job

                        <i class="bi bi-arrow-right"></i>

                    </a>

                </div>

            </div>



            {{-- JOB MANAGEMENT --}}

            <div class="sidebar-card">

                <h3 class="sidebar-card-title">
                    Job Management
                </h3>


                <div class="sidebar-list">


                    <div class="sidebar-list-item">

                        <span class="sidebar-check">
                            <i class="bi bi-check-lg"></i>
                        </span>

                        <span>
                            Keep job information up to date.
                        </span>

                    </div>


                    <div class="sidebar-list-item">

                        <span class="sidebar-check">
                            <i class="bi bi-check-lg"></i>
                        </span>

                        <span>
                            Review applications regularly.
                        </span>

                    </div>


                    <div class="sidebar-list-item">

                        <span class="sidebar-check">
                            <i class="bi bi-check-lg"></i>
                        </span>

                        <span>
                            Shortlist suitable candidates.
                        </span>

                    </div>


                    <div class="sidebar-list-item">

                        <span class="sidebar-check">
                            <i class="bi bi-check-lg"></i>
                        </span>

                        <span>
                            Schedule interviews for shortlisted candidates.
                        </span>

                    </div>

                </div>

            </div>



            {{-- HIRING FLOW --}}

            <div class="sidebar-card">

                <h3 class="sidebar-card-title">
                    Hiring Flow
                </h3>


                <div class="hiring-flow">


                    <div class="hiring-step">

                        <span class="hiring-number">
                            1
                        </span>

                        <span>
                            Receive applications
                        </span>

                    </div>


                    <div class="hiring-step">

                        <span class="hiring-number">
                            2
                        </span>

                        <span>
                            Review candidates
                        </span>

                    </div>


                    <div class="hiring-step">

                        <span class="hiring-number">
                            3
                        </span>

                        <span>
                            Shortlist candidates
                        </span>

                    </div>


                    <div class="hiring-step">

                        <span class="hiring-number">
                            4
                        </span>

                        <span>
                            Schedule interviews
                        </span>

                    </div>


                    <div class="hiring-step">

                        <span class="hiring-number">
                            5
                        </span>

                        <span>
                            Hire the right candidate
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

    function toggleJobMenu(jobId)
    {
        const menu =
            document.getElementById(
                'job-menu-' + jobId
            );

        if (!menu) {
            return;
        }


        const isOpen =
            menu.classList.contains('show');


        document
            .querySelectorAll('.job-menu.show')
            .forEach(function (openMenu) {

                openMenu.classList.remove('show');

            });


        if (!isOpen) {

            menu.classList.add('show');

        }
    }



    /* =========================================================
       CLOSE MENUS WHEN CLICKING OUTSIDE
    ========================================================= */

    document.addEventListener(
        'click',
        function (event) {

            if (
                !event.target.closest(
                    '.job-menu-wrap'
                )
            ) {

                document
                    .querySelectorAll(
                        '.job-menu.show'
                    )
                    .forEach(function (menu) {

                        menu.classList.remove(
                            'show'
                        );

                    });

            }

        }
    );



    /* =========================================================
       OPEN JOB MODAL
    ========================================================= */

    function openJobModal(jobId)
    {
        const modal =
            document.getElementById(
                'jobModal-' + jobId
            );

        if (!modal) {
            return;
        }


        document
            .querySelectorAll('.job-menu.show')
            .forEach(function (menu) {

                menu.classList.remove(
                    'show'
                );

            });


        modal.classList.add(
            'is-open'
        );


        modal.setAttribute(
            'aria-hidden',
            'false'
        );


        document.body.classList.add(
            'job-modal-open'
        );
    }



    /* =========================================================
       CLOSE JOB MODAL
    ========================================================= */

    function closeJobModal(jobId)
    {
        const modal =
            document.getElementById(
                'jobModal-' + jobId
            );

        if (!modal) {
            return;
        }


        modal.classList.remove(
            'is-open'
        );


        modal.setAttribute(
            'aria-hidden',
            'true'
        );


        document.body.classList.remove(
            'job-modal-open'
        );
    }



    /* =========================================================
       ESCAPE KEY CLOSES MODAL
    ========================================================= */

    document.addEventListener(
        'keydown',
        function (event) {

            if (event.key !== 'Escape') {
                return;
            }


            document
                .querySelectorAll(
                    '.job-modal.is-open'
                )
                .forEach(function (modal) {

                    modal.classList.remove(
                        'is-open'
                    );


                    modal.setAttribute(
                        'aria-hidden',
                        'true'
                    );

                });


            document.body.classList.remove(
                'job-modal-open'
            );

        }
    );



    /* =========================================================
       SEARCH / FILTER
    ========================================================= */

    document.addEventListener(
        'DOMContentLoaded',
        function () {


            const params =
                new URLSearchParams(
                    window.location.search
                );


            const hasFilters =
                params.has('search')
                ||
                params.has('employment_type')
                ||
                params.has('status');


            const jobList =
                document.getElementById(
                    'job-list'
                );


            /*
            |--------------------------------------------------------------------------
            | Keep filtered results at job section
            |--------------------------------------------------------------------------
            */

            if (
                hasFilters &&
                jobList
            ) {

                setTimeout(
                    function () {

                        jobList.scrollIntoView({

                            behavior: 'auto',

                            block: 'start'

                        });

                    },
                    50
                );

            }


            /*
            |--------------------------------------------------------------------------
            | Pagination hash
            |--------------------------------------------------------------------------
            */

            if (
                window.location.hash ===
                '#job-list'
                &&
                jobList
            ) {

                setTimeout(
                    function () {

                        jobList.scrollIntoView({

                            behavior: 'auto',

                            block: 'start'

                        });

                    },
                    100
                );

            }

        }
    );

</script>

@endsection