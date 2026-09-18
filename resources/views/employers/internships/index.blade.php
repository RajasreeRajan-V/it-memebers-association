@extends('layouts.app')

@section('title', 'My Internships')

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

    .internships-page {
        background: #f8fafc;
        min-height: 100vh;
        color: var(--job-text);
    }

    /* =========================================================
       HERO
    ========================================================= */

    .internships-hero {
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

    .internships-container {
        max-width: 1180px;
        margin: 0 auto;
        padding: 30px 24px 55px;
    }

    .internships-layout {
        display: grid;
        grid-template-columns: minmax(0, 1fr) 350px;
        gap: 24px;
        align-items: start;
    }

    .internships-main {
        min-width: 0;
    }

    #internship-list {
        scroll-margin-top: 20px;
    }

    /* =========================================================
       SUCCESS BANNER
    ========================================================= */

    .internships-success {
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

    .internships-list-header {
        position: relative;
        min-height: 54px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 17px;
    }

    .internships-list-header > div {
        text-align: center;
    }

    .internships-eyebrow {
        margin: 0 0 4px;
        color: #2563eb;
        font-size: 11px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: .06em;
    }

    .internships-list-title {
        margin: 0;
        color: #0f172a;
        font-size: 21px;
        line-height: 1.3;
        font-weight: 800;
        letter-spacing: -.015em;
    }

    .internships-list-subtitle {
        margin: 4px 0 0;
        color: #94a3b8;
        font-size: 11px;
        line-height: 1.4;
    }

    .internships-count {
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

    .internships-search-card {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 9px;
        margin-bottom: 16px;
        box-shadow: 0 3px 12px rgba(15, 23, 42, .025);
    }

    .internships-search-form {
        display: grid;
        grid-template-columns: minmax(0, 1fr) 145px auto auto;
        gap: 7px;
        align-items: center;
    }

    .internships-search-input-wrap {
        position: relative;
    }

    .internships-search-input-wrap i {
        position: absolute;
        left: 11px;
        top: 50%;
        transform: translateY(-50%);
        color: #94a3b8;
        font-size: 12px;
        pointer-events: none;
    }

    .internships-search-input,
    .internships-search-select {
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

    .internships-search-input {
        padding: 0 10px 0 32px;
    }

    .internships-search-select {
        padding: 0 9px;
        cursor: pointer;
    }

    .internships-search-input:focus,
    .internships-search-select:focus {
        border-color: #3376f2;
        box-shadow: 0 0 0 3px rgba(51, 118, 242, .07);
    }

    .internships-search-btn,
    .internships-clear-btn {
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

    .internships-search-btn {
        padding: 0 14px;
        border: 0;
        background: #3376f2;
        color: #fff;
        cursor: pointer;
    }

    .internships-search-btn:hover {
        background: #245fd0;
    }

    .internships-clear-btn {
        padding: 0 11px;
        border: 1px solid #e2e8f0;
        background: #fff;
        color: #64748b;
        text-decoration: none;
    }

    .internships-clear-btn:hover {
        background: #f8fafc;
        color: #2563eb;
        border-color: #bfdbfe;
    }

    .internships-search-result {
        margin-top: 7px;
        padding: 0 3px;
        color: #94a3b8;
        font-size: 9px;
    }

    .internships-search-result strong {
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
       INTERNSHIP CARD
    ========================================================= */

    .employer-internship-card {
        position: relative;
        background: #fff;
        border: 1px solid #dfe6ef;
        border-radius: 16px;
        margin-bottom: 13px;
        overflow: visible;
        transition: .2s ease;
    }

    .employer-internship-card:hover {
        border-color: #cbd9ee;
        box-shadow: 0 8px 25px rgba(15, 23, 42, .055);
    }

    .employer-internship-card-inner {
        padding: 17px 18px 15px;
    }

    .internship-card-top {
        position: relative;
        display: flex;
        justify-content: space-between;
        gap: 15px;
    }

    .internship-main-info {
        min-width: 0;
        flex: 1;
    }

    .internship-title-row {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 8px;
        margin-bottom: 7px;
        padding-right: 48px;
    }

    .internship-card-title {
        margin: 0;
        color: #111827;
        font-size: 16px;
        line-height: 1.35;
        font-weight: 800;
        letter-spacing: -.01em;
        word-break: break-word;
    }

    /* =========================================================
       INTERNSHIP TYPE
    ========================================================= */

    .internship-type {
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

    .internship-type-paid {
        background: #ecfdf5;
        color: #047857;
        border-color: #a7f3d0;
    }

    .internship-type-unpaid {
        background: #f1f5f9;
        color: #475569;
        border-color: #e2e8f0;
    }

    .internship-type-summer {
        background: #fff7ed;
        color: #c2410c;
        border-color: #fed7aa;
    }

    .internship-type-winter {
        background: #f5f3ff;
        color: #7c3aed;
        border-color: #ddd6fe;
    }

    .internship-type-full_time {
        background: #eaf2ff;
        color: #2563eb;
        border-color: #bfdbfe;
    }

    .internship-type-part_time {
        background: #fdf4ff;
        color: #a21caf;
        border-color: #f5d0fe;
    }

    .internship-type-default {
        background: #eaf2ff;
        color: #2563eb;
        border-color: #bfdbfe;
    }

    /* =========================================================
       COMPANY / LOCATION
    ========================================================= */

    .internship-company-location {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 7px;
        color: #64748b;
        font-size: 11px;
        margin-bottom: 7px;
    }

    .internship-company-location i {
        color: #64748b;
        font-size: 11px;
    }

    .internship-company-name {
        font-weight: 600;
        color: #475569;
    }

    .internship-separator {
        color: #cbd5e1;
    }

    .internship-location {
        color: #64748b;
        font-weight: 500;
    }

    .internship-meta-row {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 13px;
        color: #64748b;
        font-size: 10px;
    }

    .internship-meta-item {
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    .internship-meta-item i {
        color: #94a3b8;
        font-size: 10px;
    }

    /* =========================================================
       THREE DOT MENU
    ========================================================= */

    .internship-menu-wrap {
        position: absolute;
        top: 0;
        right: 0;
        z-index: 50;
    }

    .internship-menu-toggle {
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

    .internship-menu-toggle:hover,
    .internship-menu-toggle:focus {
        background: #dbeafe;
        border-color: #60a5fa;
        color: #1d4ed8;
        outline: none;
        transform: translateY(-1px);
    }

    .internship-menu {
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

    .internship-menu.show {
        display: block;
    }

    .internship-menu-item {
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

    .internship-menu-item:hover {
        background: #f8fafc;
        color: #2563eb;
    }

    .internship-menu-item i {
        width: 17px;
        color: #64748b;
        font-size: 13px;
    }

    .internship-menu-item:hover i {
        color: #2563eb;
    }

    .internship-menu-divider {
        height: 1px;
        background: #eef2f7;
        margin: 5px 2px;
    }

    .internship-menu-item.danger {
        color: #dc2626;
    }

    .internship-menu-item.danger i {
        color: #dc2626;
    }

    .internship-menu-item.danger:hover {
        background: #fef2f2;
        color: #b91c1c;
    }

    /* =========================================================
       INTERNSHIP STATS
    ========================================================= */

    .internship-stats {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 9px;
        margin-top: 16px;
        padding-top: 14px;
        border-top: 1px solid #f1f5f9;
    }

    .internship-stat {
        min-height: 55px;
        display: flex;
        align-items: center;
        gap: 9px;
        padding: 9px 11px;
        border-radius: 11px;
        background: #f8fafc;
    }

    .internship-stat-icon {
        width: 30px;
        height: 30px;
        border-radius: 9px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        font-size: 12px;
    }

    .internship-stat-blue .internship-stat-icon {
        background: #eaf2ff;
        color: #2563eb;
    }

    .internship-stat-green .internship-stat-icon {
        background: #ecfdf5;
        color: #059669;
    }

    .internship-stat-orange .internship-stat-icon {
        background: #fff7ed;
        color: #ea580c;
    }

    .internship-stat-number {
        display: block;
        color: #172033;
        font-size: 15px;
        line-height: 1.1;
        font-weight: 800;
    }

    .internship-stat-label {
        display: block;
        margin-top: 3px;
        color: #94a3b8;
        font-size: 9px;
        line-height: 1.2;
    }

    /* =========================================================
       CARD FOOTER
    ========================================================= */

    .internship-card-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        margin-top: 13px;
    }

    .internship-status-area {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 8px;
    }

    .internship-status {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 10px;
        border-radius: 999px;
        font-size: 9px;
        line-height: 1;
        font-weight: 800;
    }

    .internship-status-active {
        color: #047857;
        background: #ecfdf5;
    }

    .internship-status-closed {
        color: #64748b;
        background: #f1f5f9;
    }

    .status-dot {
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background: currentColor;
    }

    .internship-posted-time {
        color: #94a3b8;
        font-size: 9px;
    }

    .internship-actions {
        display: flex;
        align-items: center;
        gap: 7px;
        flex-wrap: wrap;
        justify-content: flex-end;
    }

    .internship-action-btn {
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

    .internship-view-btn {
        color: #2563eb;
        background: #eef4ff;
        border: 1px solid #dbeafe;
    }

    .internship-view-btn:hover {
        background: #dbeafe;
        color: #1d4ed8;
    }

    .internship-applications-btn {
        color: #fff;
        background: #2563eb;
        border: 1px solid #2563eb;
    }

    .internship-applications-btn:hover {
        background: #1d4ed8;
        color: #fff;
    }

    /* =========================================================
       EMPTY
    ========================================================= */

    .internships-empty {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 48px 24px;
        text-align: center;
    }

    .internships-empty-icon {
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

    .internships-empty h3 {
        margin: 0 0 5px;
        font-size: 17px;
        font-weight: 800;
        color: #172033;
    }

    .internships-empty p {
        margin: 0 auto 17px;
        max-width: 390px;
        color: #94a3b8;
        font-size: 11px;
        line-height: 1.6;
    }

    .internships-primary-btn {
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

    .internships-primary-btn:hover {
        background: #1d4ed8;
        color: #fff;
    }

    /* =========================================================
       PAGINATION
    ========================================================= */

    .internships-pagination {
        margin-top: 18px;
        display: flex;
        justify-content: center;
    }

    .internships-pagination nav {
        width: 100%;
    }

    .internships-pagination svg {
        width: 15px;
        height: 15px;
    }

    /* =========================================================
       SIDEBAR
    ========================================================= */

    .internships-sidebar {
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
       MODAL
    ========================================================= */

    .internship-modal {
        position: fixed;
        inset: 0;
        z-index: 9999;
        display: none;
        align-items: center;
        justify-content: center;
        padding: 18px;
    }

    .internship-modal.is-open {
        display: flex;
    }

    .internship-modal-overlay {
        position: absolute;
        inset: 0;
        background: rgba(15, 23, 42, .58);
        backdrop-filter: blur(4px);
    }

    .internship-modal-card {
        position: relative;
        z-index: 2;
        width: min(720px, 100%);
        max-height: 88vh;
        overflow-y: auto;
        background: #fff;
        border-radius: 19px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 30px 80px rgba(15, 23, 42, .24);
        animation: internshipModalIn .18s ease;
    }

    @keyframes internshipModalIn {
        from {
            opacity: 0;
            transform: translateY(10px) scale(.98);
        }

        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    body.internship-modal-open {
        overflow: hidden;
    }

    .internship-modal-close {
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

    .internship-modal-close:hover {
        background: #f8fafc;
        color: #ef4444;
        border-color: #fecaca;
    }

    .internship-modal-header {
        display: flex;
        gap: 13px;
        padding: 22px 55px 18px 22px;
        border-bottom: 1px solid #f1f5f9;
    }

    .internship-modal-icon {
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

    .internship-modal-header-content {
        min-width: 0;
    }

    .internship-modal-title {
        margin: 6px 0 4px;
        color: #111827;
        font-size: 20px;
        line-height: 1.3;
        font-weight: 800;
        word-break: break-word;
    }

    .internship-modal-company {
        margin: 0;
        color: #64748b;
        font-size: 11px;
    }

    .internship-modal-company i {
        margin-right: 4px;
    }

    .internship-modal-body {
        padding: 19px 22px 21px;
    }

    .internship-modal-meta-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 9px;
    }

    .internship-modal-meta {
        display: flex;
        align-items: flex-start;
        gap: 9px;
        padding: 11px;
        border: 1px solid #eef2f7;
        border-radius: 11px;
        background: #f8fafc;
    }

    .internship-modal-meta > i {
        color: #3376f2;
        font-size: 13px;
        width: 17px;
        flex-shrink: 0;
        margin-top: 2px;
    }

    .internship-modal-meta-label {
        display: block;
        color: #94a3b8;
        font-size: 8px;
        line-height: 1.2;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: .05em;
    }

    .internship-modal-meta-value {
        display: block;
        margin-top: 3px;
        color: #172033;
        font-size: 11px;
        line-height: 1.45;
        font-weight: 700;
        word-break: break-word;
    }

    .internship-modal-section {
        margin-top: 19px;
    }

    .internship-modal-section-title {
        margin: 0 0 8px;
        color: #172033;
        font-size: 13px;
        font-weight: 800;
    }

    .internship-modal-description {
        color: #64748b;
        font-size: 11px;
        line-height: 1.75;
        white-space: pre-line;
    }

    .internship-modal-skills {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
    }

    .internship-modal-skill {
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

    .internship-modal-stats {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 8px;
        margin-top: 18px;
    }

    .internship-modal-stat {
        padding: 11px;
        border-radius: 10px;
        background: #f8fafc;
        text-align: center;
        border: 1px solid #eef2f7;
    }

    .internship-modal-stat strong {
        display: block;
        color: #172033;
        font-size: 16px;
        line-height: 1.1;
        font-weight: 800;
    }

    .internship-modal-stat span {
        display: block;
        margin-top: 3px;
        color: #94a3b8;
        font-size: 8px;
    }

    .internship-modal-footer {
        display: flex;
        justify-content: flex-end;
        gap: 8px;
        padding: 15px 22px 19px;
        border-top: 1px solid #f1f5f9;
    }

    .internship-modal-secondary,
    .internship-modal-primary {
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

    .internship-modal-secondary {
        border: 1px solid #e2e8f0;
        background: #fff;
        color: #64748b;
    }

    .internship-modal-primary {
        border: 1px solid #2563eb;
        background: #2563eb;
        color: #fff;
    }

    .internship-modal-primary:hover {
        background: #1d4ed8;
        color: #fff;
    }

    /* =========================================================
       RESPONSIVE
    ========================================================= */

    @media (max-width: 1080px) {

        .internships-layout {
            grid-template-columns: 1fr;
        }

        .internships-sidebar {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
        }

        .sidebar-cta {
            grid-column: 1 / -1;
        }
    }

    @media (max-width: 1000px) {

        .internships-search-form {
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

        .internships-search-form {
            grid-template-columns: minmax(0, 1fr) 1fr;
        }

        .internships-search-input-wrap {
            grid-column: 1 / -1;
        }

        .internships-search-btn,
        .internships-clear-btn {
            width: 100%;
        }
    }

    @media (max-width: 700px) {

        .internships-container {
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

        .internships-sidebar {
            grid-template-columns: 1fr;
        }

        .internships-list-header {
            padding-right: 40px;
        }

        .internship-stats {
            grid-template-columns: 1fr;
        }

        .internship-card-footer {
            align-items: flex-start;
            flex-direction: column;
        }

        .internship-actions {
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

        .internships-search-form {
            grid-template-columns: 1fr;
        }

        .internships-search-input-wrap {
            grid-column: auto;
        }

        .internships-search-btn,
        .internships-clear-btn {
            width: 100%;
        }

        .internship-modal {
            padding: 10px;
        }

        .internship-modal-card {
            max-height: 92vh;
            border-radius: 16px;
        }

        .internship-modal-header {
            padding: 19px 50px 16px 17px;
        }

        .internship-modal-body {
            padding: 17px;
        }

        .internship-modal-meta-grid {
            grid-template-columns: 1fr;
        }

        .internship-modal-stats {
            grid-template-columns: 1fr;
        }

        .internship-modal-footer {
            padding: 13px 17px 17px;
            flex-direction: column;
        }

        .internship-modal-primary,
        .internship-modal-secondary {
            width: 100%;
        }
    }

    @media (max-width: 450px) {

        .employer-internship-card-inner {
            padding: 15px;
        }

        .internship-card-title {
            font-size: 15px;
        }

        .internship-actions {
            flex-direction: column;
            align-items: stretch;
        }

        .internship-action-btn {
            width: 100%;
        }

        .internship-modal-title {
            font-size: 18px;
        }
    }
</style>

<div class="internships-page">


{{-- =====================================================
     HERO
====================================================== --}}

<section class="internships-hero">

    <div class="hero-inner">

        <div class="hero-left">

            <span class="hero-badge">
                <svg fill="currentColor" viewBox="0 0 24 24">
                    <path d="M13 2 3 14h7l-1 8 11-14h-7l0-6z"/>
                </svg>

                BUILD YOUR NEXT GENERATION
            </span>

            <h1 class="hero-title">
                Discover Talent,
                <span>Build Your Future</span>
            </h1>

            <p class="hero-description">
                Post internships, connect with emerging talent, review applications,
                and build a pipeline of future hires with confidence.
            </p>

            <div class="hero-buttons">

                <a href="{{ route('employer.internships.create') }}"
                   class="hero-primary-btn">

                    <i class="bi bi-plus-lg"></i>

                    Post an Internship

                </a>

                <a href="#internship-list"
                   class="hero-secondary-btn">

                    Browse Internships

                </a>

            </div>

        </div>


        <div class="hero-image-wrap">

            <img src="{{ asset('assets/img/ppp.png') }}"
                 alt="Discover emerging talent"
                 class="hero-image"
                 onerror="this.style.display='none'">


            <div class="floating-card floating-card-one">

                <span class="floating-icon floating-icon-blue">
                    <i class="bi bi-check-lg"></i>
                </span>

                <div>

                    <p class="floating-title">
                        Verified Students
                    </p>

                    <p class="floating-subtitle">
                        Genuine profiles
                    </p>

                </div>

            </div>


            <div class="floating-card floating-card-two">

                <span class="floating-icon floating-icon-purple">
                    <i class="bi bi-stars"></i>
                </span>

                <div>

                    <p class="floating-title">
                        Smart Matching
                    </p>

                    <p class="floating-subtitle">
                        Find relevant talent
                    </p>

                </div>

            </div>


            <div class="floating-card floating-card-three">

                <span class="floating-icon floating-icon-green">
                    <i class="bi bi-lightning-charge-fill"></i>
                </span>

                <div>

                    <p class="floating-title">
                        Faster Onboarding
                    </p>

                    <p class="floating-subtitle">
                        Build your talent pipeline
                    </p>

                </div>

            </div>

        </div>

    </div>

</section>


{{-- =====================================================
     MAIN
====================================================== --}}

<div class="internships-container" id="internship-list">

    {{-- SUCCESS --}}

    @if (session('success'))

        <div class="internships-success">

            <i class="bi bi-check-circle-fill"></i>

            {{ session('success') }}

        </div>

    @endif


    <div class="internships-layout">


        {{-- =================================================
             INTERNSHIP LIST
        ================================================== --}}

        <main class="internships-main">


            {{-- =================================================
                 LIST HEADER
            ================================================== --}}

            <div class="internships-list-header">

                <div>

                   

                    <h2 class="internships-list-title">
                        My Internships
                    </h2>

                    <p class="internships-list-subtitle">
                        Manage your internship opportunities and applications

                        @if(request()->hasAny([
                            'search',
                            'status'
                        ]))

                            <span class="active-filter-badge">
                                <i class="bi bi-funnel-fill"></i>
                                Filtered Results
                            </span>

                        @endif

                    </p>

                </div>


                <span class="internships-count">
                    {{ $internships->total() ?? $internships->count() }}
                </span>

            </div>


            {{-- =================================================
                 COMPACT SEARCH / FILTER
            ================================================== --}}

            <div class="internships-search-card">

                <form action="{{ route('employer.internships.index') }}"
                      method="GET"
                      class="internships-search-form"
                      id="internshipSearchForm">


                    {{-- SEARCH --}}

                    <div class="internships-search-input-wrap">

                        <i class="bi bi-search"></i>

                        <input type="text"
                               name="search"
                               class="internships-search-input"
                               value="{{ request('search') }}"
                               placeholder="Search internships by title...">

                    </div>


                    {{-- STATUS --}}

                    <select name="status"
                            class="internships-search-select">

                        <option value="">
                            All Statuses
                        </option>

                        <option value="active"
                            {{ request('status') === 'active' ? 'selected' : '' }}>
                            Active
                        </option>

                        <option value="deactive"
                            {{ request('status') === 'deactive' ? 'selected' : '' }}>
                            Deactive
                        </option>

                    </select>


                    {{-- SEARCH BUTTON --}}

                    <button type="submit"
                            class="internships-search-btn">

                        <i class="bi bi-search"></i>

                        Search

                    </button>


                    {{-- CLEAR BUTTON BESIDE SEARCH --}}

                    @if(request()->hasAny([
                        'search',
                        'status'
                    ]))

                        <a href="{{ route('employer.internships.index') }}"
                           class="internships-clear-btn">

                            <i class="bi bi-x-lg"></i>

                            Clear

                        </a>

                    @endif

                </form>


                {{-- RESULT TEXT --}}

                @if(request()->hasAny([
                    'search',
                    'status'
                ]))

                    <div class="internships-search-result">

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
                 INTERNSHIP CARDS
            ================================================== --}}

            @forelse ($internships as $internship)

                @php

                    /*
                    |--------------------------------------------------------------------------
                    | TITLE
                    |--------------------------------------------------------------------------
                    */

                    $internshipTitle = $internship->title ?? 'Untitled Internship';


                    /*
                    |--------------------------------------------------------------------------
                    | TYPE
                    |--------------------------------------------------------------------------
                    */

                    $internshipTypeRaw = $internship->internship_type ?? 'internship';

                    $internshipTypeKey = strtolower(
                        str_replace(
                            [' ', '-'],
                            '_',
                            trim((string) $internshipTypeRaw)
                        )
                    );

                    $internshipTypeLabel = ucwords(
                        str_replace(
                            '_',
                            ' ',
                            $internshipTypeKey
                        )
                    );

                    $internshipTypeClass = match ($internshipTypeKey) {

                        'paid' => 'internship-type-paid',

                        'unpaid' => 'internship-type-unpaid',

                        'summer' => 'internship-type-summer',

                        'winter' => 'internship-type-winter',

                        'full_time' => 'internship-type-full_time',

                        'part_time' => 'internship-type-part_time',

                        default => 'internship-type-default',

                    };


                    /*
                    |--------------------------------------------------------------------------
                    | LOCATION
                    |--------------------------------------------------------------------------
                    */

                    $city = $internship->city ?? '';
                    $state = $internship->state ?? '';
                    $district = $internship->district ?? '';
                    $country = $internship->country ?? '';

                    $locationParts = array_filter([
                        $city,
                        $state
                    ]);

                    $location = implode(', ', $locationParts);

                    $modalLocationParts = array_filter([
                        $city,
                        $district,
                        $state,
                        $country
                    ]);

                    $modalLocation = implode(', ', $modalLocationParts);


                    /*
                    |--------------------------------------------------------------------------
                    | COMPANY
                    |--------------------------------------------------------------------------
                    */

                 $employerRegistration = optional($internship->employer)->employerRegistration ?? null;

$companyName = optional($employerRegistration)->company_name
    ?? $internship->company_name
    ?? 'Your Company';


                    /*
                    |--------------------------------------------------------------------------
                    | WORK MODE
                    |--------------------------------------------------------------------------
                    */

                    $workMode = $internship->work_mode ?? '';

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
                    | DURATION
                    |--------------------------------------------------------------------------
                    */

                    $duration = trim((string) ($internship->duration ?? ''));

                    if ($duration === '') {

                        $duration = 'Not specified';

                    }


                    /*
                    |--------------------------------------------------------------------------
                    | STIPEND
                    |--------------------------------------------------------------------------
                    */

                    $stipend = trim((string) ($internship->stipend ?? ''));

                    if ($stipend === '') {

                        $stipend = 'Unpaid / Not specified';

                    }


                    /*
                    |--------------------------------------------------------------------------
                    | SKILLS (optional)
                    |--------------------------------------------------------------------------
                    */

                    $skillsRaw = $internship->skills ?? null;

                    $skillsArray = [];

                    if (is_array($skillsRaw)) {

                        $skillsArray = collect($skillsRaw)
                            ->flatten()
                            ->map(fn ($skill) => trim((string) $skill))
                            ->filter()
                            ->values()
                            ->all();

                    } elseif (is_string($skillsRaw) && trim($skillsRaw) !== '') {

                        $decodedSkills = json_decode($skillsRaw, true);

                        if (json_last_error() === JSON_ERROR_NONE && is_array($decodedSkills)) {

                            $skillsArray = collect($decodedSkills)
                                ->flatten()
                                ->map(fn ($skill) => trim((string) $skill))
                                ->filter()
                                ->values()
                                ->all();

                        } else {

                            $skillsArray = array_values(
                                array_filter(
                                    array_map(
                                        'trim',
                                        preg_split('/[,;\n]+/', $skillsRaw, -1, PREG_SPLIT_NO_EMPTY)
                                    )
                                )
                            );

                        }

                    }


                    /*
                    |--------------------------------------------------------------------------
                    | DESCRIPTION
                    |--------------------------------------------------------------------------
                    */

                    $description = trim((string) ($internship->description ?? ''));

                    if ($description === '') {

                        $description = 'No description provided.';

                    }


                    /*
                    |--------------------------------------------------------------------------
                    | COUNTS
                    |--------------------------------------------------------------------------
                    */

                    $applicationCount = $internship->applications_count ?? 0;

                    $positions = $internship->positions ?? 1;


                    /*
                    |--------------------------------------------------------------------------
                    | STATUS
                    |--------------------------------------------------------------------------
                    */

                    $isActive = ($internship->status ?? 'active') === 'active';

                    $statusText = ucfirst($internship->status ?? 'active');

                    $internshipStatusClass = $isActive
                        ? 'internship-status-active'
                        : 'internship-status-closed';


                    /*
                    |--------------------------------------------------------------------------
                    | POSTED TIME
                    |--------------------------------------------------------------------------
                    */

                    $postedText = 'Recently';

                    if ($internship->created_at) {

                        $postedText = $internship->created_at->diffForHumans();

                    }

                @endphp


                {{-- =================================================
                     INTERNSHIP CARD
                ================================================== --}}

                <article class="employer-internship-card">

                    <div class="employer-internship-card-inner">

                        <div class="internship-card-top">

                            <div class="internship-main-info">

                                <div class="internship-title-row">

                                    <h3 class="internship-card-title">
                                        {{ $internshipTitle }}
                                    </h3>

                                    <span class="internship-type {{ $internshipTypeClass }}">
                                        {{ $internshipTypeLabel }}
                                    </span>

                                </div>


                                <div class="internship-company-location">

                                    <i class="bi bi-building"></i>

                                    <span class="internship-company-name">
                                        {{ $companyName }}
                                    </span>

                                    @if($location)

                                        <span class="internship-separator">
                                            &bull;
                                        </span>

                                        <i class="bi bi-geo-alt"></i>

                                        <span class="internship-location">
                                            {{ $location }}
                                        </span>

                                    @endif

                                </div>


                                <div class="internship-meta-row">

                                    @if($workModeLabel !== 'Not specified')

                                        <span class="internship-meta-item">

                                            <i class="bi bi-laptop"></i>

                                            {{ $workModeLabel }}

                                        </span>

                                    @endif


                                    @if($duration !== 'Not specified')

                                        <span class="internship-meta-item">

                                            <i class="bi bi-clock-history"></i>

                                            {{ $duration }}

                                        </span>

                                    @endif


                                    @if($applicationCount > 0)

                                        <span class="internship-meta-item">

                                            <i class="bi bi-people"></i>

                                            {{ $applicationCount }}

                                        </span>

                                    @endif


                                    @if($stipend !== 'Unpaid / Not specified')

                                        <span class="internship-meta-item">

                                            <i class="bi bi-cash"></i>

                                            {{ $stipend }}

                                        </span>

                                    @endif

                                </div>

                            </div>


                            {{-- THREE DOT MENU --}}

                            <div class="internship-menu-wrap">

                                <button type="button"
                                        class="internship-menu-toggle"
                                        onclick="toggleInternshipMenu({{ $internship->id }})"
                                        aria-label="Internship actions">

                                    <i class="bi bi-three-dots-vertical"></i>

                                </button>


                                <div id="internship-menu-{{ $internship->id }}"
                                     class="internship-menu">

                                    {{-- VIEW --}}

                                    <button type="button"
                                            class="internship-menu-item"
                                            onclick="openInternshipModal({{ $internship->id }})">

                                        <i class="bi bi-eye"></i>

                                        <span>
                                            View
                                        </span>

                                    </button>


                                    {{-- EDIT --}}

                                    <a href="{{ route('employer.internships.edit', $internship) }}"
                                       class="internship-menu-item">

                                        <i class="bi bi-pencil"></i>

                                        <span>
                                            Edit
                                        </span>

                                    </a>


                                    {{-- APPLICATIONS --}}

                                    <a href="#"
                                       class="internship-menu-item">

                                        <i class="bi bi-people"></i>

                                        <span>
                                            Applications
                                        </span>

                                    </a>


                                    <div class="internship-menu-divider"></div>


                                    {{-- ACTIVATE / DEACTIVATE --}}

                                    <form action="{{ route('employer.internships.toggle-status', $internship) }}"
                                          method="POST"
                                          style="margin:0;">

                                        @csrf
                                        @method('PATCH')

                                        <button type="submit"
                                                class="internship-menu-item">

                                            <i class="bi bi-{{ $isActive ? 'pause-circle' : 'play-circle' }}"></i>

                                            <span>
                                                {{ $isActive ? 'Deactivate' : 'Activate' }}
                                            </span>

                                        </button>

                                    </form>


                                    <div class="internship-menu-divider"></div>


                                    {{-- DELETE --}}

                                    <form action="{{ route('employer.internships.destroy', $internship) }}"
                                          method="POST"
                                          style="margin:0;"
                                          onsubmit="return confirm('Are you sure you want to delete this internship posting? This action cannot be undone.');">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="internship-menu-item danger">

                                            <i class="bi bi-trash3"></i>

                                            <span>
                                                Delete Internship
                                            </span>

                                        </button>

                                    </form>

                                </div>

                            </div>

                        </div>


                        {{-- STATS --}}

                        <div class="internship-stats">

                            <div class="internship-stat internship-stat-blue">

                                <span class="internship-stat-icon">
                                    <i class="bi bi-people"></i>
                                </span>

                                <div>

                                    <span class="internship-stat-number">
                                        {{ $applicationCount }}
                                    </span>

                                    <span class="internship-stat-label">
                                        Applications
                                    </span>

                                </div>

                            </div>


                            <div class="internship-stat internship-stat-green">

                                <span class="internship-stat-icon">
                                    <i class="bi bi-person-check"></i>
                                </span>

                                <div>

                                    <span class="internship-stat-number">
                                        {{ $positions }}
                                    </span>

                                    <span class="internship-stat-label">
                                        Positions
                                    </span>

                                </div>

                            </div>


                            <div class="internship-stat internship-stat-orange">

                                <span class="internship-stat-icon">
                                    <i class="bi bi-clock-history"></i>
                                </span>

                                <div>

                                    <span class="internship-stat-number">
                                        {{ $duration }}
                                    </span>

                                    <span class="internship-stat-label">
                                        Duration
                                    </span>

                                </div>

                            </div>

                        </div>


                        {{-- FOOTER --}}

                        <div class="internship-card-footer">

                            <div class="internship-status-area">

                                <span class="internship-status {{ $internshipStatusClass }}">

                                    <span class="status-dot"></span>

                                    {{ $statusText }}

                                </span>

                                <span class="internship-posted-time">
                                    Posted {{ $postedText }}
                                </span>

                            </div>


                            <div class="internship-actions">

                                <button type="button"
                                        class="internship-action-btn internship-view-btn"
                                        onclick="openInternshipModal({{ $internship->id }})">

                                    <i class="bi bi-eye"></i>

                                    View Internship

                                </button>


                                <a href="#"
                                   class="internship-action-btn internship-applications-btn">

                                    <i class="bi bi-people"></i>

                                    Applications

                                </a>

                            </div>

                        </div>

                    </div>

                </article>


                {{-- =================================================
                     INTERNSHIP MODAL
                ================================================== --}}

                <div id="internshipModal-{{ $internship->id }}"
                     class="internship-modal"
                     aria-hidden="true">

                    <div class="internship-modal-overlay"
                         onclick="closeInternshipModal({{ $internship->id }})">
                    </div>


                    <div class="internship-modal-card"
                         role="dialog"
                         aria-modal="true"
                         aria-labelledby="internship-modal-title-{{ $internship->id }}">

                        <button type="button"
                                class="internship-modal-close"
                                onclick="closeInternshipModal({{ $internship->id }})"
                                aria-label="Close">

                            <i class="bi bi-x-lg"></i>

                        </button>


                        {{-- HEADER --}}

                        <div class="internship-modal-header">

                            <div class="internship-modal-icon">

                                <i class="bi bi-mortarboard-fill"></i>

                            </div>


                            <div class="internship-modal-header-content">

                                <span class="internship-type {{ $internshipTypeClass }}">
                                    {{ $internshipTypeLabel }}
                                </span>

                                <h2 id="internship-modal-title-{{ $internship->id }}"
                                    class="internship-modal-title">

                                    {{ $internshipTitle }}

                                </h2>

                                <p class="internship-modal-company">

                                    <i class="bi bi-building"></i>

                                    {{ $companyName }}

                                </p>

                            </div>

                        </div>


                        {{-- BODY --}}

                        <div class="internship-modal-body">

                            <div class="internship-modal-meta-grid">

                                <div class="internship-modal-meta">

                                    <i class="bi bi-geo-alt"></i>

                                    <div>

                                        <span class="internship-modal-meta-label">
                                            Location
                                        </span>

                                        <strong class="internship-modal-meta-value">
                                            {{ $modalLocation ?: 'Not specified' }}
                                        </strong>

                                    </div>

                                </div>


                                <div class="internship-modal-meta">

                                    <i class="bi bi-laptop"></i>

                                    <div>

                                        <span class="internship-modal-meta-label">
                                            Work Mode
                                        </span>

                                        <strong class="internship-modal-meta-value">
                                            {{ $workModeLabel }}
                                        </strong>

                                    </div>

                                </div>


                                <div class="internship-modal-meta">

                                    <i class="bi bi-clock-history"></i>

                                    <div>

                                        <span class="internship-modal-meta-label">
                                            Duration
                                        </span>

                                        <strong class="internship-modal-meta-value">
                                            {{ $duration }}
                                        </strong>

                                    </div>

                                </div>


                                <div class="internship-modal-meta">

                                    <i class="bi bi-cash-stack"></i>

                                    <div>

                                        <span class="internship-modal-meta-label">
                                            Stipend
                                        </span>

                                        <strong class="internship-modal-meta-value">
                                            {{ $stipend }}
                                        </strong>

                                    </div>

                                </div>


                                <div class="internship-modal-meta">

                                    <i class="bi bi-people"></i>

                                    <div>

                                        <span class="internship-modal-meta-label">
                                            Positions
                                        </span>

                                        <strong class="internship-modal-meta-value">
                                            {{ $positions }}
                                        </strong>

                                    </div>

                                </div>


                                <div class="internship-modal-meta">

                                    <i class="bi bi-activity"></i>

                                    <div>

                                        <span class="internship-modal-meta-label">
                                            Status
                                        </span>

                                        <strong class="internship-modal-meta-value">
                                            {{ $statusText }}
                                        </strong>

                                    </div>

                                </div>

                            </div>


                            {{-- SKILLS --}}

                            @if(count($skillsArray) > 0)

                                <div class="internship-modal-section">

                                    <h3 class="internship-modal-section-title">
                                        Skills
                                    </h3>

                                    <div class="internship-modal-skills">

                                        @foreach($skillsArray as $skill)

                                            <span class="internship-modal-skill">
                                                {{ $skill }}
                                            </span>

                                        @endforeach

                                    </div>

                                </div>

                            @endif


                            {{-- DESCRIPTION --}}

                            <div class="internship-modal-section">

                                <h3 class="internship-modal-section-title">
                                    Internship Description
                                </h3>

                                <div class="internship-modal-description">
                                    {{ $description }}
                                </div>

                            </div>


                            {{-- STATS --}}

                            <div class="internship-modal-stats">

                                <div class="internship-modal-stat">

                                    <strong>
                                        {{ $applicationCount }}
                                    </strong>

                                    <span>
                                        Applications
                                    </span>

                                </div>


                                <div class="internship-modal-stat">

                                    <strong>
                                        {{ $positions }}
                                    </strong>

                                    <span>
                                        Positions
                                    </span>

                                </div>


                                <div class="internship-modal-stat">

                                    <strong>
                                        {{ $duration }}
                                    </strong>

                                    <span>
                                        Duration
                                    </span>

                                </div>

                            </div>

                        </div>


                        {{-- FOOTER --}}

                        <div class="internship-modal-footer">

                            <button type="button"
                                    class="internship-modal-secondary"
                                    onclick="closeInternshipModal({{ $internship->id }})">

                                Close

                            </button>


                            <a href="#"
                               class="internship-modal-primary">

                                <i class="bi bi-people"></i>

                                View Applications

                            </a>

                        </div>

                    </div>

                </div>

            @empty

                {{-- EMPTY STATE --}}

                <div class="internships-empty">

                    <div class="internships-empty-icon">

                        <i class="bi bi-mortarboard"></i>

                    </div>

                    <h3>

                        @if(request()->hasAny([
                            'search',
                            'status'
                        ]))

                            No Matching Internships Found

                        @else

                            No Internship Postings Yet

                        @endif

                    </h3>

                    <p>

                        @if(request()->hasAny([
                            'search',
                            'status'
                        ]))

                            Try changing your search or filters to find
                            another internship posting.

                        @else

                            Attract emerging talent by posting your first
                            internship opportunity.

                        @endif

                    </p>


                    @if(request()->hasAny([
                        'search',
                        'status'
                    ]))

                        <a href="{{ route('employer.internships.index') }}"
                           class="internships-primary-btn">

                            <i class="bi bi-arrow-counterclockwise"></i>

                            Clear Filters

                        </a>

                    @else

                        <a href="{{ route('employer.internships.create') }}"
                           class="internships-primary-btn">

                            <i class="bi bi-plus-lg"></i>

                            Post Your First Internship

                        </a>

                    @endif

                </div>

            @endforelse


            {{-- PAGINATION --}}

            @if(method_exists($internships, 'links'))

                <div class="internships-pagination">

                    {{ $internships->withQueryString()->fragment('internship-list')->links() }}

                </div>

            @endif

        </main>


        {{-- =====================================================
             SIDEBAR
        ====================================================== --}}

        <aside class="internships-sidebar">


            {{-- CTA --}}

            <div class="sidebar-cta">

                <div class="sidebar-cta-content">

                    <h3>
                        Need Fresh Talent?
                    </h3>

                    <p>
                        Post an internship and connect with
                        motivated students ready to learn.
                    </p>

                    <a href="{{ route('employer.internships.create') }}"
                       class="sidebar-cta-btn">

                        Post Internship

                        <i class="bi bi-arrow-right"></i>

                    </a>

                </div>

            </div>


            {{-- OVERVIEW --}}

            <div class="sidebar-card">

                <h3 class="sidebar-card-title">
                    Internship Overview
                </h3>

                <div class="sidebar-overview">

                    <div class="sidebar-overview-row">

                        <span class="sidebar-overview-label">
                            Total Internships
                        </span>

                        <span class="sidebar-overview-value">
                            {{ $internships->total() ?? $internships->count() }}
                        </span>

                    </div>


                    <div class="sidebar-overview-row">

                        <span class="sidebar-overview-label">
                            Current Page
                        </span>

                        <span class="sidebar-overview-value">
                            {{ $internships->count() }}
                        </span>

                    </div>

                </div>

            </div>


            {{-- INTERNSHIP TIPS --}}

            <div class="sidebar-card">

                <h3 class="sidebar-card-title">
                    Internship Tips
                </h3>

                <div class="sidebar-list">

                    <div class="sidebar-list-item">

                        <span class="sidebar-check">
                            <i class="bi bi-check-lg"></i>
                        </span>

                        <span>
                            Keep the internship title clear and specific.
                        </span>

                    </div>


                    <div class="sidebar-list-item">

                        <span class="sidebar-check">
                            <i class="bi bi-check-lg"></i>
                        </span>

                        <span>
                            Mention the duration and start date.
                        </span>

                    </div>


                    <div class="sidebar-list-item">

                        <span class="sidebar-check">
                            <i class="bi bi-check-lg"></i>
                        </span>

                        <span>
                            Specify remote, hybrid, or on-site work mode.
                        </span>

                    </div>


                    <div class="sidebar-list-item">

                        <span class="sidebar-check">
                            <i class="bi bi-check-lg"></i>
                        </span>

                        <span>
                            List required skills and learning outcomes.
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

    function toggleInternshipMenu(internshipId) {

        const menu = document.getElementById(
            'internship-menu-' + internshipId
        );

        if (!menu) {
            return;
        }

        const isOpen = menu.classList.contains('show');

        document.querySelectorAll('.internship-menu.show').forEach(function (openMenu) {

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

        if (!event.target.closest('.internship-menu-wrap')) {

            document.querySelectorAll('.internship-menu.show').forEach(function (menu) {

                menu.classList.remove('show');

            });

        }

    });


    /* =========================================================
       OPEN INTERNSHIP MODAL
    ========================================================= */

    function openInternshipModal(internshipId) {

        const modal = document.getElementById(
            'internshipModal-' + internshipId
        );

        if (!modal) {
            return;
        }

        document.querySelectorAll('.internship-menu.show').forEach(function (menu) {

            menu.classList.remove('show');

        });

        modal.classList.add('is-open');

        modal.setAttribute(
            'aria-hidden',
            'false'
        );

        document.body.classList.add(
            'internship-modal-open'
        );

    }


    /* =========================================================
       CLOSE INTERNSHIP MODAL
    ========================================================= */

    function closeInternshipModal(internshipId) {

        const modal = document.getElementById(
            'internshipModal-' + internshipId
        );

        if (!modal) {
            return;
        }

        modal.classList.remove('is-open');

        modal.setAttribute(
            'aria-hidden',
            'true'
        );

        document.body.classList.remove(
            'internship-modal-open'
        );

    }


    /* =========================================================
       ESCAPE KEY CLOSES MODAL
    ========================================================= */

    document.addEventListener('keydown', function (event) {

        if (event.key !== 'Escape') {
            return;
        }

        document.querySelectorAll('.internship-modal.is-open').forEach(function (modal) {

            modal.classList.remove('is-open');

            modal.setAttribute(
                'aria-hidden',
                'true'
            );

        });

        document.body.classList.remove(
            'internship-modal-open'
        );

    });


    /* =========================================================
       SEARCH / FILTER
       AFTER SUBMIT, AUTOMATICALLY STAY AT INTERNSHIP SECTION
    ========================================================= */

    document.addEventListener('DOMContentLoaded', function () {

        const hasFilters =
            new URLSearchParams(window.location.search).has('search') ||
            new URLSearchParams(window.location.search).has('status');

        const internshipList = document.getElementById('internship-list');


        /*
        |--------------------------------------------------------------------------
        | FILTERED SEARCH
        |--------------------------------------------------------------------------
        | If a search/filter was submitted, keep the user at the
        | internship section instead of leaving them at the hero.
        */

        if (hasFilters && internshipList) {

            setTimeout(function () {

                internshipList.scrollIntoView({
                    behavior: 'auto',
                    block: 'start'
                });

            }, 50);

        }


        /*
        |--------------------------------------------------------------------------
        | PAGINATION
        |--------------------------------------------------------------------------
        | Pagination already uses #internship-list.
        */

        if (
            window.location.hash === '#internship-list' &&
            internshipList
        ) {

            setTimeout(function () {

                internshipList.scrollIntoView({
                    behavior: 'auto',
                    block: 'start'
                });

            }, 100);

        }

    });

</script>

@endsection