@extends('layouts.app')

@section('title', 'Applicants')

@section('content')

<style>
:root {
    --ap-blue: #3376F2;
    --ap-blue-dark: #245fd0;
    --ap-blue-light: #eef4ff;
    --ap-navy: #0F172A;
    --ap-text: #172033;
    --ap-muted: #64748B;
    --ap-border: #E2E8F0;
    --ap-bg: #F8FAFC;
    --ap-green: #059669;
    --ap-green-light: #ECFDF5;
    --ap-purple: #7c3aed;
    --ap-purple-light: #f3e8ff;
    --ap-red: #dc2626;
    --ap-red-light: #FEF2F2;
    --ap-amber: #b45309;
    --ap-amber-light: #fffbeb;
}

* {
    box-sizing: border-box;
}

.applicants-page {
    background: var(--ap-bg);
    min-height: 100vh;
    color: var(--ap-text);
    padding-bottom: 55px;
}

/* =========================================================
   HERO
========================================================= */

.applicants-hero {
    background: linear-gradient(
        180deg,
        #f5f8ff 0%,
        #f5f8ff 55%,
        #ffffff 100%
    );
    border-bottom: 1px solid #eef2f7;
}

.ap-hero-inner {
    max-width: 1180px;
    margin: 0 auto;
    padding: 65px 24px 60px;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 45px;
    align-items: center;
}

.ap-hero-left {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    text-align: left;
}

.ap-hero-badge {
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

.ap-hero-badge svg {
    width: 14px;
    height: 14px;
}

.ap-hero-title {
    margin: 0 0 15px;
    max-width: 520px;
    font-size: 43px;
    line-height: 1.12;
    letter-spacing: -.035em;
    font-weight: 800;
    color: #0f172a;
}

.ap-hero-title span {
    display: block;
    color: #2563eb;
}

.ap-hero-description {
    max-width: 470px;
    margin: 0 0 23px;
    color: #64748b;
    font-size: 14px;
    line-height: 1.75;
}

.ap-hero-buttons {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
}

.ap-hero-primary-btn,
.ap-hero-secondary-btn {
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

.ap-hero-primary-btn {
    color: #fff;
    background: #2563eb;
    box-shadow: 0 7px 18px rgba(37, 99, 235, .14);
    border: 1px solid #2563eb;
    cursor: pointer;
}

.ap-hero-primary-btn:hover {
    background: #1d4ed8;
    color: #fff;
    transform: translateY(-1px);
}

.ap-hero-secondary-btn {
    color: #475569;
    background: #fff;
    border: 1px solid #e2e8f0;
}

.ap-hero-secondary-btn:hover {
    color: #2563eb;
    border-color: #93c5fd;
}

.ap-hero-image-wrap {
    position: relative;
    display: flex;
    justify-content: flex-end;
    align-items: center;
    min-height: 350px;
}

.ap-hero-image {
    width: 100%;
    max-width: 420px;
    height: auto;
    object-fit: contain;
    border-radius: 15px;
    filter: drop-shadow(0 18px 35px rgba(51, 118, 242, .10));
}

.ap-floating-card {
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

.ap-floating-card-one {
    top: 12px;
    left: 0;
}

.ap-floating-card-two {
    top: 88px;
    right: 0;
}

.ap-floating-card-three {
    bottom: 15px;
    left: -5px;
}

.ap-floating-icon {
    width: 29px;
    height: 29px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 13px;
    flex-shrink: 0;
}

.ap-floating-icon-blue {
    background: #eaf2ff;
    color: #2563eb;
}

.ap-floating-icon-purple {
    background: #f3e8ff;
    color: #7c3aed;
}

.ap-floating-icon-green {
    background: #ecfdf5;
    color: #059669;
}

.ap-floating-title {
    margin: 0;
    color: #1e293b;
    font-size: 10px;
    line-height: 1.3;
    font-weight: 800;
}

.ap-floating-subtitle {
    margin: 2px 0 0;
    color: #94a3b8;
    font-size: 8px;
    line-height: 1.3;
}

@media (max-width: 900px) {

    .ap-hero-inner {
        grid-template-columns: 1fr;
    }

    .ap-hero-image-wrap {
        justify-content: center;
        min-height: 250px;
    }

    .ap-hero-left {
        align-items: center;
        text-align: center;
    }

    .ap-hero-description {
        text-align: center;
    }
}

@media (max-width: 700px) {

    .ap-hero-inner {
        padding-left: 18px;
        padding-right: 18px;
    }

    .ap-hero-title {
        font-size: 34px;
    }
}

@media (max-width: 575px) {

    .ap-hero-buttons {
        width: 100%;
        flex-direction: column;
    }

    .ap-hero-primary-btn,
    .ap-hero-secondary-btn {
        width: 100%;
    }

    .ap-hero-image-wrap {
        min-height: 210px;
    }

    .ap-floating-card {
        transform: scale(.88);
    }

    .ap-floating-card-one {
        left: -8px;
    }

    .ap-floating-card-two {
        right: -8px;
    }

    .ap-floating-card-three {
        left: -12px;
    }
}

/* =========================================================
   MAIN CONTAINER
========================================================= */

.applicants-container {
    max-width: 1180px;
    margin: 0 auto;
    padding: 34px 24px 0;
    scroll-margin-top: 20px;
}

/* =========================================================
   HEADER
========================================================= */

.applicants-list-header {
    position: relative;
    min-height: 54px;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    gap: 14px;
    margin-bottom: 18px;
}

.applicants-list-header h1 {
    margin: 0;
    color: var(--ap-navy);
    font-size: 27px;
    line-height: 1.25;
    font-weight: 800;
    letter-spacing: -.02em;
}

.applicants-list-header p {
    margin: 4px 0 0;
    color: #94a3b8;
    font-size: 12px;
}

.applicants-count {
    position: absolute;
    right: 0;
    top: 50%;
    transform: translateY(-50%);
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 34px;
    height: 29px;
    padding: 0 10px;
    border-radius: 999px;
    background: var(--ap-blue-light);
    border: 1px solid #dbeafe;
    color: var(--ap-blue-dark);
    font-size: 11px;
    font-weight: 800;
    white-space: nowrap;
}

/* =========================================================
   TABS
========================================================= */

.applicant-tabs {
    display: flex;
    align-items: center;
    gap: 6px;
    padding: 7px;
    background: #fff;
    border: 1px solid var(--ap-border);
    border-radius: 14px;
    margin-bottom: 16px;
    overflow-x: auto;
}

.applicant-tab {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    padding: 10px 15px;
    border-radius: 9px;
    text-decoration: none;
    color: var(--ap-muted);
    font-size: 12px;
    font-weight: 700;
    white-space: nowrap;
    transition: .2s ease;
}

.applicant-tab:hover {
    color: var(--ap-blue);
    background: var(--ap-blue-light);
}

.applicant-tab.active {
    color: #fff;
    background: var(--ap-blue);
}

.tab-count {
    min-width: 20px;
    height: 20px;
    padding: 0 6px;
    border-radius: 20px;
    background: #F1F5F9;
    color: var(--ap-muted);
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 10px;
    font-weight: 800;
}

.applicant-tab.active .tab-count {
    color: #fff;
    background: rgba(255,255,255,.20);
}

/* =========================================================
   SEARCH / FILTER
========================================================= */

.applicant-search-card {
    background: #fff;
    border: 1px solid var(--ap-border);
    border-radius: 12px;
    padding: 9px;
    margin-bottom: 18px;
    box-shadow: 0 3px 12px rgba(15,23,42,.025);
}

.applicant-search-form {
    display: grid;
    grid-template-columns: minmax(0,1fr) 220px auto auto;
    gap: 7px;
    align-items: center;
}

.applicant-search-input-wrap {
    position: relative;
}

.applicant-search-input-wrap i {
    position: absolute;
    left: 11px;
    top: 50%;
    transform: translateY(-50%);
    color: #94a3b8;
    font-size: 12px;
    pointer-events: none;
}

.applicant-search-input,
.applicant-search-select {
    width: 100%;
    height: 38px;
    border: 1px solid #dbe3ee;
    border-radius: 8px;
    background: #fff;
    color: var(--ap-text);
    font-family: inherit;
    font-size: 12px;
    outline: none;
    transition: .2s ease;
}

.applicant-search-input {
    padding: 0 10px 0 32px;
}

.applicant-search-select {
    padding: 0 9px;
    cursor: pointer;
}

.applicant-search-input:focus,
.applicant-search-select:focus {
    border-color: var(--ap-blue);
    box-shadow: 0 0 0 3px rgba(51,118,242,.07);
}

.applicant-search-btn,
.applicant-clear-btn {
    height: 38px;
    border-radius: 8px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    font-size: 11px;
    font-weight: 700;
    white-space: nowrap;
    padding: 0 14px;
}

.applicant-search-btn {
    border: 0;
    background: var(--ap-blue);
    color: #fff;
    cursor: pointer;
}

.applicant-search-btn:hover {
    background: var(--ap-blue-dark);
}

.applicant-clear-btn {
    border: 1px solid var(--ap-border);
    background: #fff;
    color: var(--ap-muted);
    text-decoration: none;
}

.applicant-clear-btn:hover {
    background: #f8fafc;
    color: var(--ap-blue);
    border-color: #bfdbfe;
}

/* =========================================================
   MAIN LAYOUT
========================================================= */

.applicants-layout {
    display: grid;
    grid-template-columns: minmax(0,1fr) 280px;
    gap: 20px;
    align-items: start;
}

/* =========================================================
   APPLICANT CARD
========================================================= */

.applicant-card {
    position: relative;
    background: #fff;
    border: 1px solid #dfe6ef;
    border-radius: 16px;
    margin-bottom: 13px;
    transition: .2s ease;
    cursor: pointer;
}

.applicant-card:hover {
    border-color: #cbd9ee;
    box-shadow: 0 8px 25px rgba(15,23,42,.055);
}

.applicant-card-inner {
    padding: 17px 18px 15px;
}

.applicant-card-top {
    position: relative;
    display: flex;
    gap: 15px;
}

.candidate-avatar {
    width: 58px;
    height: 58px;
    min-width: 58px;
    border-radius: 14px;
    overflow: hidden;
    background: var(--ap-blue-light);
    color: var(--ap-blue);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 21px;
    font-weight: 800;
}

.candidate-avatar img {
    width: 100%;
    height: 100%;
    display: block;
    object-fit: cover;
}

.candidate-avatar-fallback {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.candidate-main {
    flex: 1;
    min-width: 0;
}

.candidate-title-row {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 8px;
    margin-bottom: 5px;
    padding-right: 48px;
}

.candidate-name {
    margin: 0;
    color: #111827;
    font-size: 16px;
    line-height: 1.35;
    font-weight: 800;
    letter-spacing: -.01em;
}

.candidate-company-location {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 7px;
    color: var(--ap-muted);
    font-size: 11px;
    margin-bottom: 7px;
}

.candidate-company-location i {
    color: var(--ap-muted);
    font-size: 11px;
}

.candidate-separator {
    color: #cbd5e1;
}

.candidate-meta-row {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 13px;
    color: var(--ap-muted);
    font-size: 10px;
}

.candidate-meta-item {
    display: inline-flex;
    align-items: center;
    gap: 5px;
}

.candidate-meta-item i {
    color: #94a3b8;
    font-size: 10px;
}

.candidate-skills {
    display: flex;
    align-items: center;
    gap: 6px;
    flex-wrap: wrap;
    margin-top: 9px;
}

.candidate-skills span {
    padding: 5px 8px;
    border-radius: 6px;
    background: #F1F5F9;
    color: #475569;
    font-size: 10px;
    font-weight: 600;
}

/* =========================================================
   STATUS
========================================================= */

.status-badge {
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

.status-new {
    background: var(--ap-blue-light);
    color: var(--ap-blue-dark);
    border-color: #bfdbfe;
}

.status-shortlisted {
    background: var(--ap-amber-light);
    color: var(--ap-amber);
    border-color: #fde68a;
}

.status-interview {
    background: var(--ap-purple-light);
    color: var(--ap-purple);
    border-color: #ddd6fe;
}

.status-selected {
    background: var(--ap-green-light);
    color: var(--ap-green);
    border-color: #a7f3d0;
}

.status-rejected {
    background: var(--ap-red-light);
    color: var(--ap-red);
    border-color: #fecaca;
}

.status-default {
    background: #f1f5f9;
    color: #475569;
    border-color: #e2e8f0;
}

/* =========================================================
   THREE DOT MENU
========================================================= */

.candidate-menu-wrap {
    position: absolute;
    top: 0;
    right: 0;
    z-index: 50;
}

.candidate-menu-toggle {
    width: 36px;
    height: 36px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 12px;
    border: 2px solid #bfdbfe;
    background: #eef6ff;
    color: var(--ap-blue-dark);
    cursor: pointer;
    font-size: 16px;
    transition: .2s ease;
}

.candidate-menu-toggle:hover {
    background: #dbeafe;
    border-color: #60a5fa;
    color: #1d4ed8;
    transform: translateY(-1px);
}

.candidate-menu {
    position: absolute;
    top: 42px;
    right: 0;
    width: 215px;
    padding: 7px;
    background: #fff;
    border: 1px solid var(--ap-border);
    border-radius: 13px;
    box-shadow: 0 18px 40px rgba(15,23,42,.13);
    display: none;
    z-index: 100;
}

.candidate-menu.show {
    display: block;
}

.candidate-menu-item {
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
}

.candidate-menu-item:hover {
    background: #f8fafc;
    color: var(--ap-blue);
}

.candidate-menu-item i {
    width: 17px;
    color: var(--ap-muted);
    font-size: 13px;
}

.candidate-menu-item:hover i {
    color: var(--ap-blue);
}

.candidate-menu-divider {
    height: 1px;
    background: #eef2f7;
    margin: 5px 2px;
}

.candidate-menu-item.danger {
    color: var(--ap-red);
}

.candidate-menu-item.danger i {
    color: var(--ap-red);
}

.candidate-menu-item.danger:hover {
    background: var(--ap-red-light);
    color: #b91c1c;
}

.cand-btn.is-disabled,
button.cand-btn.is-disabled {
    cursor: not-allowed;
    opacity: .55;
    filter: grayscale(.15);
    box-shadow: none;
    pointer-events: none;
}

.candidate-menu-item.is-disabled {
    cursor: not-allowed;
    opacity: .45;
    pointer-events: none;
}

/* =========================================================
   STATS
========================================================= */

.candidate-stats {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 9px;
    margin-top: 15px;
    padding-top: 13px;
    border-top: 1px solid #f1f5f9;
}

.candidate-stat {
    min-height: 52px;
    display: flex;
    align-items: center;
    gap: 9px;
    padding: 9px 11px;
    border-radius: 11px;
    background: #f8fafc;
}

.candidate-stat-icon {
    width: 29px;
    height: 29px;
    border-radius: 9px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    font-size: 12px;
}

.stat-blue .candidate-stat-icon {
    background: var(--ap-blue-light);
    color: var(--ap-blue);
}

.stat-purple .candidate-stat-icon {
    background: var(--ap-purple-light);
    color: var(--ap-purple);
}

.stat-green .candidate-stat-icon {
    background: var(--ap-green-light);
    color: var(--ap-green);
}

.candidate-stat-value {
    display: block;
    color: var(--ap-text);
    font-size: 12.5px;
    line-height: 1.25;
    font-weight: 800;
}

.candidate-stat-label {
    display: block;
    margin-top: 2px;
    color: #94a3b8;
    font-size: 9px;
    line-height: 1.2;
}

/* =========================================================
   FOOTER + ACTIONS
========================================================= */

.candidate-card-footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    flex-wrap: wrap;
    margin-top: 13px;
}

.candidate-status-area {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 8px;
}

.applied-time {
    color: #94a3b8;
    font-size: 9px;
}

.candidate-actions {
    display: flex;
    align-items: center;
    gap: 7px;
    flex-wrap: wrap;
    justify-content: flex-end;
}

.cand-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    min-height: 31px;
    padding: 0 11px;
    border-radius: 8px;
    font-size: 9.5px;
    font-weight: 700;
    text-decoration: none;
    cursor: pointer;
    border: 1px solid transparent;
    transition: .18s ease;
}

.cand-btn-view {
    color: var(--ap-blue-dark);
    background: var(--ap-blue-light);
    border-color: #dbeafe;
}

.cand-btn-view:hover {
    background: #dbeafe;
    color: #1d4ed8;
}

.cand-btn-resume {
    color: #475569;
    background: #F1F5F9;
    border-color: #e2e8f0;
}

.cand-btn-resume:hover {
    background: #e2e8f0;
}

.cand-btn-shortlist {
    color: #fff;
    background: var(--ap-amber);
    border-color: var(--ap-amber);
}

.cand-btn-shortlist:hover {
    background: #92400e;
}

.cand-btn-interview {
    color: #fff;
    background: var(--ap-purple);
    border-color: var(--ap-purple);
}

.cand-btn-interview:hover {
    background: #6d28d9;
}

.cand-btn-hire {
    color: #fff;
    background: var(--ap-green);
    border-color: var(--ap-green);
}

.cand-btn-hire:hover {
    background: #047857;
}

.cand-btn-reject {
    color: var(--ap-red);
    background: var(--ap-red-light);
    border-color: #fecaca;
}

.cand-btn-reject:hover {
    background: #fee2e2;
}

.cand-btn form {
    margin: 0;
}

/* =========================================================
   EMPTY
========================================================= */

.applicants-empty {
    background: #fff;
    border: 1px solid var(--ap-border);
    border-radius: 16px;
    padding: 48px 24px;
    text-align: center;
}

.applicants-empty-icon {
    width: 55px;
    height: 55px;
    margin: 0 auto 13px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 15px;
    background: var(--ap-blue-light);
    color: var(--ap-blue);
    font-size: 21px;
}

.applicants-empty h3 {
    margin: 0 0 5px;
    font-size: 17px;
    font-weight: 800;
    color: var(--ap-navy);
}

.applicants-empty p {
    margin: 0;
    color: #94a3b8;
    font-size: 12px;
    line-height: 1.6;
}

/* =========================================================
   RECRUITMENT PIPELINE
========================================================= */

.pipeline-card {
    background: #fff;
    border: 1px solid var(--ap-border);
    border-radius: 17px;
    padding: 21px;
}

.pipeline-card h3 {
    margin: 0 0 5px;
    color: var(--ap-navy);
    font-size: 16px;
    font-weight: 800;
}

.pipeline-subtitle {
    margin-bottom: 16px;
    color: #94a3b8;
    font-size: 11px;
}

.pipeline-item {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 11px 0;
    border-bottom: 1px solid #F1F5F9;
}

.pipeline-item:last-child {
    border-bottom: 0;
}

.pipeline-left {
    display: flex;
    align-items: center;
    gap: 8px;
    color: #475569;
    font-size: 12px;
}

.pipeline-dot {
    width: 7px;
    height: 7px;
    border-radius: 50%;
    background: var(--ap-blue);
}

.pipeline-number {
    color: var(--ap-navy);
    font-size: 13px;
    font-weight: 800;
}

/* =========================================================
   HIRE MORE EASILY TIPS
========================================================= */

.hiring-tips-card {
    margin-top: 16px;
    background: #fff;
    border: 1px solid var(--ap-border);
    border-radius: 17px;
    padding: 21px;
}

.hiring-tips-header {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    margin-bottom: 17px;
}

.hiring-tips-icon {
    width: 34px;
    height: 34px;
    min-width: 34px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 10px;
    background: var(--ap-blue-light);
    color: var(--ap-blue);
    font-size: 14px;
}

.hiring-tips-header h3 {
    margin: 0;
    color: var(--ap-navy);
    font-size: 15px;
    font-weight: 800;
    line-height: 1.3;
}

.hiring-tips-header p {
    margin: 3px 0 0;
    color: #94a3b8;
    font-size: 10px;
    line-height: 1.45;
}

.hiring-tip {
    display: flex;
    align-items: flex-start;
    gap: 9px;
    padding: 10px 0;
    border-bottom: 1px solid #f1f5f9;
}

.hiring-tip:last-child {
    border-bottom: 0;
    padding-bottom: 0;
}

.hiring-tip-number {
    width: 23px;
    height: 23px;
    min-width: 23px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 7px;
    background: #f8fafc;
    color: var(--ap-blue);
    font-size: 9px;
    font-weight: 800;
    border: 1px solid #e8eef7;
}

.hiring-tip-content {
    min-width: 0;
}

.hiring-tip-title {
    margin: 0 0 2px;
    color: #334155;
    font-size: 10.5px;
    font-weight: 800;
    line-height: 1.35;
}

.hiring-tip-text {
    margin: 0;
    color: #94a3b8;
    font-size: 9.5px;
    line-height: 1.55;
}

/* =========================================================
   PROFILE MODAL
========================================================= */

.applicant-modal {
    position: fixed;
    inset: 0;
    z-index: 99999;
    display: none;
    align-items: center;
    justify-content: center;
    padding: 18px;
}

.applicant-modal.active {
    display: flex;
}

.applicant-modal-overlay {
    position: absolute;
    inset: 0;
    background: rgba(15,23,42,.6);
    backdrop-filter: blur(4px);
}

.applicant-modal-box {
    position: relative;
    z-index: 2;
    width: min(900px, 100%);
    max-height: 90vh;
    overflow-y: auto;
    background: #fff;
    border-radius: 19px;
    border: 1px solid var(--ap-border);
    box-shadow: 0 30px 80px rgba(15,23,42,.24);
}

.modal-close {
    position: absolute;
    top: 14px;
    right: 14px;
    z-index: 10;
    width: 34px;
    height: 34px;
    border: 1px solid var(--ap-border);
    background: #fff;
    color: var(--ap-muted);
    border-radius: 9px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    font-size: 18px;
    line-height: 1;
}

.modal-close:hover {
    background: #f8fafc;
    color: var(--ap-red);
    border-color: #fecaca;
}

.applicant-loading {
    min-height: 400px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    color: var(--ap-muted);
    font-size: 13px;
}

.loading-spinner {
    width: 36px;
    height: 36px;
    margin-bottom: 12px;
    border: 3px solid #E2E8F0;
    border-top-color: var(--ap-blue);
    border-radius: 50%;
    animation: applicantSpin .7s linear infinite;
}

@keyframes applicantSpin {
    to {
        transform: rotate(360deg);
    }
}

.profile-modal-header {
    display: flex;
    align-items: flex-start;
    gap: 15px;
    padding: 22px 55px 18px 22px;
    border-bottom: 1px solid #f1f5f9;
}

.profile-modal-photo {
    width: 66px;
    height: 66px;
    min-width: 66px;
    overflow: hidden;
    border-radius: 15px;
    background: var(--ap-blue-light);
    color: var(--ap-blue);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 25px;
    font-weight: 800;
}

.profile-modal-photo img {
    width: 100%;
    height: 100%;
    display: block;
    object-fit: cover;
}

.profile-modal-fallback {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.profile-modal-info {
    flex: 1;
    min-width: 0;
}

.profile-modal-info h2 {
    margin: 4px 0 4px;
    color: #111827;
    font-size: 20px;
    font-weight: 800;
}

.profile-modal-info > p {
    margin: 0 0 9px;
    color: var(--ap-muted);
    font-size: 13px;
}

.profile-meta {
    display: flex;
    align-items: center;
    gap: 14px;
    flex-wrap: wrap;
    color: var(--ap-muted);
    font-size: 11px;
}

.profile-meta span {
    display: inline-flex;
    align-items: center;
    gap: 5px;
}

.profile-modal-actions {
    display: flex;
    align-items: center;
    gap: 7px;
    flex-wrap: wrap;
}

.modal-btn {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 9px 12px;
    border: 0;
    border-radius: 8px;
    font-size: 10.5px;
    font-weight: 700;
    text-decoration: none;
    cursor: pointer;
    white-space: nowrap;
}

.resume-btn {
    background: #F1F5F9;
    color: #475569;
}

.shortlist-btn {
    background: var(--ap-amber);
    color: #fff;
}

.interview-btn {
    background: var(--ap-purple);
    color: #fff;
}

.hire-btn {
    background: var(--ap-green);
    color: #fff;
}

.reject-btn {
    background: var(--ap-red-light);
    color: var(--ap-red);
}

.modal-btn.is-disabled {
    cursor: not-allowed;
    opacity: .5;
    filter: grayscale(.15);
    pointer-events: none;
}

.profile-modal-body {
    display: grid;
    grid-template-columns: minmax(0,1fr) 280px;
    gap: 24px;
    padding: 22px 22px 26px;
}

.profile-section {
    margin-bottom: 22px;
}

.profile-section:last-child {
    margin-bottom: 0;
}

.profile-section h3 {
    margin: 0 0 10px;
    color: var(--ap-navy);
    font-size: 13.5px;
    font-weight: 800;
}

.profile-section p {
    margin: 0;
    color: var(--ap-muted);
    font-size: 12.5px;
    line-height: 1.75;
    white-space: pre-line;
}

.modal-skills {
    display: flex;
    gap: 6px;
    flex-wrap: wrap;
}

.modal-skills span {
    padding: 6px 10px;
    border-radius: 999px;
    background: var(--ap-blue-light);
    color: var(--ap-blue-dark);
    font-size: 10px;
    font-weight: 700;
    border: 1px solid #dbeafe;
}

.experience-item {
    display: flex;
    gap: 12px;
    padding: 13px;
    border: 1px solid var(--ap-border);
    border-radius: 11px;
}

.experience-dot {
    width: 8px;
    height: 8px;
    min-width: 8px;
    margin-top: 5px;
    border-radius: 50%;
    background: var(--ap-blue);
}

.experience-item h4 {
    margin: 0 0 5px;
    color: #334155;
    font-size: 12.5px;
}

.experience-item p {
    font-size: 11.5px;
}

.application-card {
    padding: 15px;
    margin-bottom: 14px;
    border: 1px solid var(--ap-border);
    border-radius: 12px;
    background: #f8fafc;
}

.application-card h3 {
    margin: 0 0 12px;
    color: var(--ap-navy);
    font-size: 12.5px;
    font-weight: 800;
}

.application-item {
    padding: 9px 0;
    border-bottom: 1px solid #eef2f7;
}

.application-item:last-child {
    padding-bottom: 0;
    border-bottom: 0;
}

.application-item span {
    display: block;
    margin-bottom: 3px;
    color: #94a3b8;
    font-size: 9px;
}

.application-item strong {
    color: #334155;
    font-size: 11.5px;
    line-height: 1.5;
}

.modal-contact-item {
    display: flex;
    align-items: flex-start;
    gap: 9px;
    padding: 7px 0;
    color: var(--ap-muted);
    font-size: 11.5px;
    word-break: break-word;
}

.modal-contact-item a {
    color: var(--ap-blue);
    text-decoration: none;
}

.modal-contact-item a:hover {
    text-decoration: underline;
}

.empty-value {
    color: #94A3B8 !important;
    font-size: 11.5px !important;
}

/* =========================================================
   INTERVIEW MODAL
========================================================= */

.interview-modal {
    position: fixed;
    inset: 0;
    z-index: 100000;
    display: none;
    align-items: center;
    justify-content: center;
    padding: 18px;
}

.interview-modal.active {
    display: flex;
}

.interview-overlay {
    position: absolute;
    inset: 0;
    background: rgba(15,23,42,.6);
}

.interview-box {
    position: relative;
    z-index: 2;
    width: min(450px, 100%);
    padding: 24px;
    background: #fff;
    border-radius: 18px;
    box-shadow: 0 25px 70px rgba(15,23,42,.25);
}

.interview-box h3 {
    margin: 0 0 6px;
    color: var(--ap-navy);
    font-size: 18px;
    font-weight: 800;
}

.interview-box > p {
    margin: 0 0 18px;
    color: var(--ap-muted);
    font-size: 12px;
}

.form-group {
    margin-bottom: 14px;
}

.form-group label {
    display: block;
    margin-bottom: 6px;
    color: #475569;
    font-size: 11.5px;
    font-weight: 700;
}

.form-control {
    width: 100%;
    height: 40px;
    padding: 0 11px;
    border: 1px solid var(--ap-border);
    border-radius: 8px;
    outline: none;
    color: var(--ap-text);
    background: #fff;
    font-size: 12px;
}

.form-control:focus {
    border-color: var(--ap-blue);
}

textarea.form-control {
    height: 76px;
    padding-top: 9px;
    resize: vertical;
}

.interview-actions {
    display: flex;
    justify-content: flex-end;
    gap: 8px;
    margin-top: 18px;
}

.cancel-btn {
    padding: 10px 15px;
    border: 0;
    border-radius: 8px;
    background: #F1F5F9;
    color: #475569;
    font-size: 11.5px;
    font-weight: 700;
    cursor: pointer;
}

.schedule-btn {
    padding: 10px 15px;
    border: 0;
    border-radius: 8px;
    background: var(--ap-purple);
    color: #fff;
    font-size: 11.5px;
    font-weight: 700;
    cursor: pointer;
}

/* =========================================================
   RESPONSIVE
========================================================= */

@media (max-width: 1000px) {

    .applicants-layout {
        grid-template-columns: 1fr;
    }

    .pipeline-card,
    .hiring-tips-card {
        display: none;
    }

    .applicant-search-form {
        grid-template-columns: minmax(0,1fr) 1fr;
    }

    .applicant-search-input-wrap {
        grid-column: 1 / -1;
    }

    .applicant-search-btn,
    .applicant-clear-btn {
        width: 100%;
    }
}

@media (max-width: 800px) {

    .profile-modal-header {
        flex-direction: column;
    }

    .profile-modal-body {
        grid-template-columns: 1fr;
        padding: 20px;
    }
}

@media (max-width: 700px) {

    .applicants-container {
        padding: 22px 16px 0;
    }

    .applicants-list-header h1 {
        font-size: 22px;
    }

    .applicant-card-top {
        flex-wrap: wrap;
    }

    .candidate-title-row {
        padding-right: 44px;
    }

    .candidate-card-footer {
        flex-direction: column;
        align-items: flex-start;
    }

    .candidate-actions {
        width: 100%;
        justify-content: flex-start;
    }

    .candidate-stats {
        grid-template-columns: 1fr;
    }
}
</style>

<div class="applicants-page">


{{-- =================================================
     HERO
================================================== --}}

<section class="applicants-hero">

    <div class="ap-hero-inner">

        <div class="ap-hero-left">

            <span class="ap-hero-badge">
                <svg fill="currentColor" viewBox="0 0 24 24">
                    <path d="M13 2 3 14h7l-1 8 11-14h-7l0-6z"/>
                </svg>
                REVIEW YOUR CANDIDATES
            </span>

            <h1 class="ap-hero-title">
                Review Applicants,
                <span>Hire With Confidence</span>
            </h1>

            <p class="ap-hero-description">
                Browse every candidate who applied to your jobs, shortlist the
                best fits, schedule interviews, and move your hiring pipeline
                forward — all in one place.
            </p>

            <div class="ap-hero-buttons">

                <a href="#applicant-list" class="ap-hero-primary-btn">
                    <i class="bi bi-people"></i>
                    View Applicants
                </a>

                <a href="{{ route('employer.jobs.index') }}" class="ap-hero-secondary-btn">
                    My Jobs
                </a>

            </div>

        </div>


        <div class="ap-hero-image-wrap">

            <img src="{{ asset('assets/img/eee.png') }}"
                 alt="Review applicants"
                 class="ap-hero-image"
                 onerror="this.style.display='none'">


            <div class="ap-floating-card ap-floating-card-one">

                <span class="ap-floating-icon ap-floating-icon-blue">
                    <i class="bi bi-person-check"></i>
                </span>

                <div>
                    <p class="ap-floating-title">
                        Shortlist Candidates
                    </p>

                    <p class="ap-floating-subtitle">
                        Flag your top picks
                    </p>
                </div>

            </div>


            <div class="ap-floating-card ap-floating-card-two">

                <span class="ap-floating-icon ap-floating-icon-purple">
                    <i class="bi bi-calendar-event"></i>
                </span>

                <div>
                    <p class="ap-floating-title">
                        Schedule Interviews
                    </p>

                    <p class="ap-floating-subtitle">
                        Coordinate with ease
                    </p>
                </div>

            </div>


            <div class="ap-floating-card ap-floating-card-three">

                <span class="ap-floating-icon ap-floating-icon-green">
                    <i class="bi bi-award"></i>
                </span>

                <div>
                    <p class="ap-floating-title">
                        Hire Faster
                    </p>

                    <p class="ap-floating-subtitle">
                        Close roles sooner
                    </p>
                </div>

            </div>

        </div>

    </div>

</section>


<div class="applicants-container" id="applicant-list">

    {{-- =================================================
         HEADER
    ================================================== --}}

    <div class="applicants-list-header">

        <div>
            <h1>Applicants</h1>
            <p>Review and manage candidates who applied for your jobs.</p>
        </div>

        <span class="applicants-count">
            {{ $applications->total() ?? $applications->count() }}
        </span>

    </div>


    {{-- =================================================
         TABS
         (Note: id="applicant-list" lives ONLY on the
         .applicants-container above — duplicate IDs are
         invalid HTML and break #applicant-list anchors.)
    ================================================== --}}

    <div class="applicant-tabs">

        <a href="{{ route('employer.applicants.index') }}#applicant-list"
            class="applicant-tab {{ $tab === 'all' ? 'active' : '' }}">
            All
            <span class="tab-count">{{ $counts['all'] ?? 0 }}</span>
        </a>

        <a href="{{ route('employer.applicants.index', ['tab' => 'new']) }}#applicant-list"
            class="applicant-tab {{ $tab === 'new' ? 'active' : '' }}">
            New
            <span class="tab-count">{{ $counts['new'] ?? 0 }}</span>
        </a>

        <a href="{{ route('employer.applicants.index', ['tab' => 'shortlisted']) }}#applicant-list"
            class="applicant-tab {{ $tab === 'shortlisted' ? 'active' : '' }}">
            Shortlisted
            <span class="tab-count">{{ $counts['shortlisted'] ?? 0 }}</span>
        </a>

        <a href="{{ route('employer.applicants.index', ['tab' => 'interview']) }}#applicant-list"
            class="applicant-tab {{ $tab === 'interview' ? 'active' : '' }}">
            Interview
            <span class="tab-count">{{ $counts['interview'] ?? 0 }}</span>
        </a>

        <a href="{{ route('employer.applicants.index', ['tab' => 'selected']) }}#applicant-list"
            class="applicant-tab {{ $tab === 'selected' ? 'active' : '' }}">
            Selected
            <span class="tab-count">{{ $counts['selected'] ?? 0 }}</span>
        </a>

        <a href="{{ route('employer.applicants.index', ['tab' => 'rejected']) }}#applicant-list"
            class="applicant-tab {{ $tab === 'rejected' ? 'active' : '' }}">
            Rejected
            <span class="tab-count">{{ $counts['rejected'] ?? 0 }}</span>
        </a>

    </div>


    {{-- =================================================
         SEARCH / FILTER
    ================================================== --}}

    <div class="applicant-search-card">

        <form method="GET"
              action="{{ route('employer.applicants.index') }}#applicant-list"
              class="applicant-search-form">

            <input type="hidden" name="tab" value="{{ $tab }}">

            <div class="applicant-search-input-wrap">
                <i class="bi bi-search"></i>

                <input type="text"
                       name="search"
                       class="applicant-search-input"
                       value="{{ request('search') }}"
                       placeholder="Search by candidate name or skill...">
            </div>

            <select name="job" class="applicant-search-select">

                <option value="">All Jobs</option>

                @foreach($jobs as $job)

                    <option value="{{ $job->id }}"
                        {{ request('job') == $job->id ? 'selected' : '' }}>
                        {{ $job->title }}
                    </option>

                @endforeach

            </select>

            <button type="submit" class="applicant-search-btn">
                <i class="bi bi-search"></i>
                Search
            </button>

            @if(request()->hasAny(['search', 'job']))

                <a href="{{ route('employer.applicants.index', ['tab' => $tab]) }}#applicant-list"
                   class="applicant-clear-btn">

                    <i class="bi bi-x-lg"></i>
                    Clear

                </a>

            @endif

        </form>

    </div>


    {{-- =================================================
         MAIN CONTENT
    ================================================== --}}

    <div class="applicants-layout">

        <div>

            @if($applications->count())

                @foreach($applications as $application)

                    @php

                        $candidate = $application->user;
                        $profile = $candidate?->employeeRegistration;
                        $interview = $application->interview ?? null;

                        $skills = $profile?->skills ?? [];

                        if (is_string($skills)) {

                            $decodedSkills = json_decode($skills, true);

                            if (json_last_error() === JSON_ERROR_NONE && is_array($decodedSkills)) {
                                $skills = $decodedSkills;
                            } else {
                                $skills = array_filter(
                                    array_map('trim', explode(',', $skills))
                                );
                            }

                        }

                        if (!is_array($skills)) {
                            $skills = [];
                        }

                        $skills = array_values($skills);


                        if (
                            $application->status === 'in_progress' &&
                            $application->sub_status === 'shortlisted'
                        ) {

                            $displayStatus = 'Shortlisted';
                            $statusClass = 'status-shortlisted';

                        } elseif ($application->status === 'applied') {

                            $displayStatus = 'New';
                            $statusClass = 'status-new';

                        } elseif ($application->status === 'interview') {

                            $displayStatus = 'Interview';
                            $statusClass = 'status-interview';

                        } elseif ($application->status === 'hired') {

                            $displayStatus = 'Selected';
                            $statusClass = 'status-selected';

                        } elseif ($application->status === 'rejected') {

                            $displayStatus = 'Rejected';
                            $statusClass = 'status-rejected';

                        } else {

                            $displayStatus = ucfirst(
                                str_replace('_', ' ', $application->status)
                            );

                            $statusClass = 'status-default';

                        }


                        $isClosedOut = in_array(
                            $application->status,
                            ['hired', 'rejected']
                        );

                        $isShortlisted =
                            $application->status === 'in_progress' &&
                            $application->sub_status === 'shortlisted';

                        $isHired =
                            $application->status === 'hired';

                        $isRejected =
                            $application->status === 'rejected';


                        $shortlistDisabled =
                            $isClosedOut || $isShortlisted;

                        $shortlistLabel =
                            $isShortlisted ? 'Shortlisted' : 'Shortlist';

                        $shortlistIcon =
                            $isShortlisted
                                ? 'bi-check-circle-fill'
                                : 'bi-person-check';


                        $interviewDisabled = $isClosedOut;

                        $interviewLabel =
                            $interview ? 'Reschedule' : 'Interview';

                        $interviewIcon =
                            $interview
                                ? 'bi-arrow-repeat'
                                : 'bi-calendar-event';


                        $hireDisabled = $isClosedOut;

                        $hireLabel =
                            $isHired ? 'Hired' : 'Hire';

                        $hireIcon =
                            $isHired
                                ? 'bi-check-circle-fill'
                                : 'bi-award';


                        $rejectDisabled = $isClosedOut;

                        $rejectLabel =
                            $isRejected ? 'Rejected' : 'Reject';

                        $rejectIcon =
                            $isRejected
                                ? 'bi-x-circle-fill'
                                : 'bi-x-circle';


                        $experienceLabel = 'N/A';

                        if (
                            isset($profile?->experience_years) &&
                            $profile->experience_years !== null &&
                            $profile->experience_years !== ''
                        ) {

                            $experienceLabel =
                                $profile->experience_years . ' yrs';

                        } elseif (
                            isset($profile?->experience) &&
                            $profile->experience
                        ) {

                            $experienceLabel =
                                $profile->experience;

                        }

                    @endphp


                    {{-- =================================================
                         APPLICANT CARD
                    ================================================== --}}

                    <article class="applicant-card"
                             onclick="openApplicantModal({{ $candidate->id }})">

                        <div class="applicant-card-inner">

                            <div class="applicant-card-top">

                                {{-- AVATAR --}}

                                <div class="candidate-avatar">

                                    @if($profile && !empty($profile->profile_photo))

                                        <img src="{{ route('employer.applicants.photo', ['applicant' => $candidate->id]) }}"
                                             alt="{{ $candidate->name }}"
                                             onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">

                                        <span class="candidate-avatar-fallback"
                                              style="display:none;">

                                            {{ strtoupper(substr($candidate->name ?? '?', 0, 1)) }}

                                        </span>

                                    @else

                                        <span class="candidate-avatar-fallback">

                                            {{ strtoupper(substr($candidate->name ?? '?', 0, 1)) }}

                                        </span>

                                    @endif

                                </div>


                                {{-- MAIN INFO --}}

                                <div class="candidate-main">

                                    <div class="candidate-title-row">

                                        <h3 class="candidate-name">
                                            {{ $candidate->name ?? 'Applicant' }}
                                        </h3>

                                        <span class="status-badge {{ $statusClass }}">
                                            {{ $displayStatus }}
                                        </span>

                                    </div>


                                    <div class="candidate-company-location">

                                        <i class="bi bi-person-badge"></i>

                                        <span>
                                            {{ $profile?->designation ?? $application->jobPost?->title ?? 'Software Developer' }}
                                        </span>

                                        @if($application->jobPost)

                                            <span class="candidate-separator">•</span>

                                            <i class="bi bi-briefcase"></i>

                                            <span>
                                                {{ $application->jobPost->title }}
                                            </span>

                                        @endif

                                    </div>


                                    <div class="candidate-meta-row">

                                        <span class="candidate-meta-item">

                                            <i class="bi bi-calendar3"></i>

                                            Applied
                                            {{ optional($application->created_at)->format('d M Y') }}

                                        </span>


                                        @if($interview)

                                            <span class="candidate-meta-item">

                                                <i class="bi bi-calendar-event"></i>

                                                Interview:
                                                {{ $interview->scheduled_at }}

                                            </span>

                                        @endif

                                    </div>


                                    <div class="candidate-skills">

                                        @forelse(array_slice($skills, 0, 5) as $skill)

                                            <span>{{ $skill }}</span>

                                        @empty

                                            <span>Skills not added</span>

                                        @endforelse

                                    </div>

                                </div>


                                {{-- THREE DOT MENU --}}

                                <div class="candidate-menu-wrap"
                                     onclick="event.stopPropagation()">

                                    <button type="button"
                                            class="candidate-menu-toggle"
                                            onclick="toggleCandidateMenu({{ $application->id }})"
                                            aria-label="Candidate actions">

                                        <i class="bi bi-three-dots-vertical"></i>

                                    </button>


                                    <div id="candidate-menu-{{ $application->id }}"
                                         class="candidate-menu">

                                        <button type="button"
                                                class="candidate-menu-item"
                                                onclick="openApplicantModal({{ $candidate->id }})">

                                            <i class="bi bi-eye"></i>

                                            <span>View Profile</span>

                                        </button>


                                        @if($profile && !empty($profile->resume))

                                            <a href="{{ asset('storage/' . $profile->resume) }}"
                                               target="_blank"
                                               rel="noopener"
                                               class="candidate-menu-item">

                                                <i class="bi bi-file-earmark-text"></i>

                                                <span>Resume</span>

                                            </a>

                                        @endif


                                        <div class="candidate-menu-divider"></div>


                                        {{-- SHORTLIST --}}

                                        <form action="{{ route('employer.applicants.updateStatus', $application->id) }}"
                                              method="POST">

                                            @csrf

                                            <input type="hidden"
                                                   name="status"
                                                   value="in_progress">

                                            <input type="hidden"
                                                   name="sub_status"
                                                   value="shortlisted">

                                            <button type="submit"
                                                    class="candidate-menu-item {{ $shortlistDisabled ? 'is-disabled' : '' }}"
                                                    @disabled($shortlistDisabled)>

                                                <i class="bi {{ $shortlistIcon }}"></i>

                                                <span>
                                                    {{ $shortlistLabel }}
                                                </span>

                                            </button>

                                        </form>


                                        {{-- INTERVIEW --}}

                                        <button type="button"
                                                class="candidate-menu-item {{ $interviewDisabled ? 'is-disabled' : '' }}"
                                                @disabled($interviewDisabled)

                                                @if(!$interviewDisabled)

                                                    onclick="openInterviewModal(
                                                        {{ $application->id }},
                                                        {{ $interview ? 'true' : 'false' }},
                                                        '{{ $interview->scheduled_at ?? '' }}',
                                                        '{{ $interview->mode ?? '' }}',
                                                        '{{ addslashes($interview->location ?? '') }}'
                                                    )"

                                                @endif>

                                            <i class="bi {{ $interviewIcon }}"></i>

                                            <span>
                                                {{ $interviewLabel }}
                                            </span>

                                        </button>


                                        {{-- HIRE --}}

                                        <form action="{{ route('employer.applicants.updateStatus', $application->id) }}"
                                              method="POST"
                                              onsubmit="return confirm('Mark this candidate as hired?');">

                                            @csrf

                                            <input type="hidden"
                                                   name="status"
                                                   value="hired">

                                            <button type="submit"
                                                    class="candidate-menu-item {{ $hireDisabled ? 'is-disabled' : '' }}"
                                                    @disabled($hireDisabled)>

                                                <i class="bi {{ $hireIcon }}"></i>

                                                <span>
                                                    {{ $hireLabel }}
                                                </span>

                                            </button>

                                        </form>


                                        <div class="candidate-menu-divider"></div>


                                        {{-- REJECT --}}

                                        <form action="{{ route('employer.applicants.updateStatus', $application->id) }}"
                                              method="POST"
                                              onsubmit="return confirm('Reject this candidate?');">

                                            @csrf

                                            <input type="hidden"
                                                   name="status"
                                                   value="rejected">

                                            <button type="submit"
                                                    class="candidate-menu-item danger {{ $rejectDisabled ? 'is-disabled' : '' }}"
                                                    @disabled($rejectDisabled)>

                                                <i class="bi {{ $rejectIcon }}"></i>

                                                <span>
                                                    {{ $rejectLabel }}
                                                </span>

                                            </button>

                                        </form>

                                    </div>

                                </div>

                            </div>


                            {{-- STATS --}}

                            <div class="candidate-stats">

                                <div class="candidate-stat stat-blue">

                                    <span class="candidate-stat-icon">
                                        <i class="bi bi-person-workspace"></i>
                                    </span>

                                    <div>

                                        <span class="candidate-stat-value">
                                            {{ $experienceLabel }}
                                        </span>

                                        <span class="candidate-stat-label">
                                            Experience
                                        </span>

                                    </div>

                                </div>


                                <div class="candidate-stat stat-purple">

                                    <span class="candidate-stat-icon">
                                        <i class="bi bi-patch-check"></i>
                                    </span>

                                    <div>

                                        <span class="candidate-stat-value">
                                            {{ count($skills) }}
                                        </span>

                                        <span class="candidate-stat-label">
                                            Skills Listed
                                        </span>

                                    </div>

                                </div>


                                <div class="candidate-stat stat-green">

                                    <span class="candidate-stat-icon">
                                        <i class="bi bi-clock-history"></i>
                                    </span>

                                    <div>

                                        <span class="candidate-stat-value">
                                            {{ optional($application->created_at)->diffForHumans() }}
                                        </span>

                                        <span class="candidate-stat-label">
                                            Applied
                                        </span>

                                    </div>

                                </div>

                            </div>


                            {{-- FOOTER --}}

                            <div class="candidate-card-footer"
                                 onclick="event.stopPropagation()">

                                <div class="candidate-status-area">

                                    <span class="status-badge {{ $statusClass }}">
                                        {{ $displayStatus }}
                                    </span>

                                    <span class="applied-time">
                                        Applied
                                        {{ optional($application->created_at)->diffForHumans() }}
                                    </span>

                                </div>


                                <div class="candidate-actions">

                                    <button type="button"
                                            class="cand-btn cand-btn-view"
                                            onclick="openApplicantModal({{ $candidate->id }})">

                                        <i class="bi bi-eye"></i>
                                        View Profile

                                    </button>


                                    @if($profile && !empty($profile->resume))

                                        <a href="{{ asset('storage/' . $profile->resume) }}"
                                           target="_blank"
                                           rel="noopener"
                                           class="cand-btn cand-btn-resume">

                                            <i class="bi bi-file-earmark-text"></i>
                                            Resume

                                        </a>

                                    @endif


                                    {{-- SHORTLIST --}}

                                    <form action="{{ route('employer.applicants.updateStatus', $application->id) }}"
                                          method="POST"
                                          class="cand-btn">

                                        @csrf

                                        <input type="hidden"
                                               name="status"
                                               value="in_progress">

                                        <input type="hidden"
                                               name="sub_status"
                                               value="shortlisted">

                                        <button type="submit"
                                                class="cand-btn cand-btn-shortlist {{ $shortlistDisabled ? 'is-disabled' : '' }}"
                                                @disabled($shortlistDisabled)>

                                            <i class="bi {{ $shortlistIcon }}"></i>

                                            {{ $shortlistLabel }}

                                        </button>

                                    </form>


                                    {{-- INTERVIEW --}}

                                    <button type="button"
                                            class="cand-btn cand-btn-interview {{ $interviewDisabled ? 'is-disabled' : '' }}"
                                            @disabled($interviewDisabled)

                                            @if(!$interviewDisabled)

                                                onclick="openInterviewModal(
                                                    {{ $application->id }},
                                                    {{ $interview ? 'true' : 'false' }},
                                                    '{{ $interview->scheduled_at ?? '' }}',
                                                    '{{ $interview->mode ?? '' }}',
                                                    '{{ addslashes($interview->location ?? '') }}'
                                                )"

                                            @endif>

                                        <i class="bi {{ $interviewIcon }}"></i>

                                        {{ $interviewLabel }}

                                    </button>


                                    {{-- HIRE --}}

                                    <form action="{{ route('employer.applicants.updateStatus', $application->id) }}"
                                          method="POST"
                                          class="cand-btn"
                                          onsubmit="return confirm('Mark this candidate as hired?');">

                                        @csrf

                                        <input type="hidden"
                                               name="status"
                                               value="hired">

                                        <button type="submit"
                                                class="cand-btn cand-btn-hire {{ $hireDisabled ? 'is-disabled' : '' }}"
                                                @disabled($hireDisabled)>

                                            <i class="bi {{ $hireIcon }}"></i>

                                            {{ $hireLabel }}

                                        </button>

                                    </form>


                                    {{-- REJECT --}}

                                    <form action="{{ route('employer.applicants.updateStatus', $application->id) }}"
                                          method="POST"
                                          class="cand-btn"
                                          onsubmit="return confirm('Reject this candidate?');">

                                        @csrf

                                        <input type="hidden"
                                               name="status"
                                               value="rejected">

                                        <button type="submit"
                                                class="cand-btn cand-btn-reject {{ $rejectDisabled ? 'is-disabled' : '' }}"
                                                @disabled($rejectDisabled)>

                                            <i class="bi {{ $rejectIcon }}"></i>

                                            {{ $rejectLabel }}

                                        </button>

                                    </form>

                                </div>

                            </div>

                        </div>

                    </article>

                @endforeach


                {{-- PAGINATION --}}

                <div style="margin-top:20px;">
                    {{ $applications->links() }}
                </div>


            @else

                {{-- EMPTY --}}

                <div class="applicants-empty">

                    <div class="applicants-empty-icon">
                        <i class="bi bi-people"></i>
                    </div>

                    <h3>No applicants found</h3>

                    <p>
                        There are no applicants matching your current filter.
                    </p>

                </div>

            @endif

        </div>


        {{-- =================================================
             RIGHT SIDEBAR
        ================================================== --}}

        <aside>

            {{-- RECRUITMENT PIPELINE --}}

            <div class="pipeline-card">

                <h3>Recruitment Pipeline</h3>

                <div class="pipeline-subtitle">
                    Current applicant overview
                </div>


                <div class="pipeline-item">

                    <div class="pipeline-left">
                        <span class="pipeline-dot"></span>
                        All Applicants
                    </div>

                    <span class="pipeline-number">
                        {{ $counts['all'] ?? 0 }}
                    </span>

                </div>


                <div class="pipeline-item">

                    <div class="pipeline-left">
                        <span class="pipeline-dot"></span>
                        New
                    </div>

                    <span class="pipeline-number">
                        {{ $counts['new'] ?? 0 }}
                    </span>

                </div>


                <div class="pipeline-item">

                    <div class="pipeline-left">
                        <span class="pipeline-dot"></span>
                        Shortlisted
                    </div>

                    <span class="pipeline-number">
                        {{ $counts['shortlisted'] ?? 0 }}
                    </span>

                </div>


                <div class="pipeline-item">

                    <div class="pipeline-left">
                        <span class="pipeline-dot"></span>
                        Interview
                    </div>

                    <span class="pipeline-number">
                        {{ $counts['interview'] ?? 0 }}
                    </span>

                </div>


                <div class="pipeline-item">

                    <div class="pipeline-left">
                        <span class="pipeline-dot"></span>
                        Selected
                    </div>

                    <span class="pipeline-number">
                        {{ $counts['selected'] ?? 0 }}
                    </span>

                </div>


                <div class="pipeline-item">

                    <div class="pipeline-left">
                        <span class="pipeline-dot"></span>
                        Rejected
                    </div>

                    <span class="pipeline-number">
                        {{ $counts['rejected'] ?? 0 }}
                    </span>

                </div>

            </div>


            {{-- =================================================
                 HIRE MORE EASILY
            ================================================== --}}

            <div class="hiring-tips-card">

                <div class="hiring-tips-header">

                    <div class="hiring-tips-icon">
                        <i class="bi bi-lightbulb"></i>
                    </div>

                    <div>

                        <h3>Hire More Easily</h3>

                        <p>
                            Simple tips to improve your hiring process.
                        </p>

                    </div>

                </div>


                <div class="hiring-tip">

                    <div class="hiring-tip-number">
                        01
                    </div>

                    <div class="hiring-tip-content">

                        <p class="hiring-tip-title">
                            Review Skills First
                        </p>

                        <p class="hiring-tip-text">
                            Compare the candidate's key skills with the requirements of your job.
                        </p>

                    </div>

                </div>


                <div class="hiring-tip">

                    <div class="hiring-tip-number">
                        02
                    </div>

                    <div class="hiring-tip-content">

                        <p class="hiring-tip-title">
                            Check the Resume
                        </p>

                        <p class="hiring-tip-text">
                            Look for relevant experience, projects and achievements before interviewing.
                        </p>

                    </div>

                </div>


                <div class="hiring-tip">

                    <div class="hiring-tip-number">
                        03
                    </div>

                    <div class="hiring-tip-content">

                        <p class="hiring-tip-title">
                            Shortlist Carefully
                        </p>

                        <p class="hiring-tip-text">
                            Keep candidates who match the most important requirements of the role.
                        </p>

                    </div>

                </div>


                <div class="hiring-tip">

                    <div class="hiring-tip-number">
                        04
                    </div>

                    <div class="hiring-tip-content">

                        <p class="hiring-tip-title">
                            Schedule Quickly
                        </p>

                        <p class="hiring-tip-text">
                            Avoid unnecessary delays when a candidate looks like a good fit.
                        </p>

                    </div>

                </div>


                <div class="hiring-tip">

                    <div class="hiring-tip-number">
                        05
                    </div>

                    <div class="hiring-tip-content">

                        <p class="hiring-tip-title">
                            Keep Candidates Updated
                        </p>

                        <p class="hiring-tip-text">
                            Update application statuses so your hiring pipeline stays clear and organized.
                        </p>

                    </div>

                </div>

            </div>

        </aside>

    </div>

</div>


</div>

{{-- =========================================================
APPLICANT PROFILE MODAL
========================================================= --}}

<div id="applicantModal" class="applicant-modal">


<div class="applicant-modal-overlay"
     onclick="closeApplicantModal()"></div>

<div class="applicant-modal-box">

    <button type="button"
            class="modal-close"
            onclick="closeApplicantModal()">
        ×
    </button>


    <div id="applicantLoading"
         class="applicant-loading">

        <div class="loading-spinner"></div>

        <div>
            Loading applicant profile...
        </div>

    </div>


    <div id="applicantContent"
         style="display:none;">

        <div class="profile-modal-header">

            <div id="modalPhoto"
                 class="profile-modal-photo"></div>


            <div class="profile-modal-info">

                <h2 id="modalName"></h2>

                <p id="modalDesignation"></p>

                <div class="profile-meta">

                    <span>
                        <i class="bi bi-briefcase"></i>
                        <span id="modalExperience"></span>
                    </span>

                    <span id="modalLocationWrapper">

                        <i class="bi bi-geo-alt"></i>

                        <span id="modalLocation"></span>

                    </span>

                </div>

            </div>


            <div class="profile-modal-actions">

                <a href="#"
                   id="modalResume"
                   target="_blank"
                   rel="noopener"
                   class="modal-btn resume-btn">

                    <i class="bi bi-file-earmark-text"></i>
                    Resume

                </a>


                <button type="button"
                        id="modalShortlistBtn"
                        class="modal-btn shortlist-btn">

                    <i class="bi bi-person-check"></i>
                    Shortlist

                </button>


                <button type="button"
                        id="modalInterviewBtn"
                        class="modal-btn interview-btn">

                    <i class="bi bi-calendar-event"></i>

                    <span id="modalInterviewBtnLabel">
                        Schedule Interview
                    </span>

                </button>


                <button type="button"
                        id="modalHireBtn"
                        class="modal-btn hire-btn">

                    <i class="bi bi-award"></i>
                    Hire

                </button>


                <button type="button"
                        id="modalRejectBtn"
                        class="modal-btn reject-btn">

                    <i class="bi bi-x-circle"></i>
                    Reject

                </button>

            </div>

        </div>


        <div class="profile-modal-body">

            <div class="profile-main">

                <section class="profile-section">

                    <h3>About</h3>

                    <p id="modalAbout"></p>

                </section>


                <section class="profile-section">

                    <h3>Skills</h3>

                    <div id="modalSkills"
                         class="modal-skills"></div>

                </section>


                <section class="profile-section">

                    <h3>Experience</h3>

                    <div id="modalExperienceDetails"></div>

                </section>


                <section class="profile-section">

                    <h3>Education</h3>

                    <div id="modalEducation"></div>

                </section>


                <section class="profile-section">

                    <h3>Projects</h3>

                    <div id="modalProjects"></div>

                </section>


                <section class="profile-section">

                    <h3>Certifications</h3>

                    <div id="modalCertifications"></div>

                </section>

            </div>


            <aside class="profile-sidebar">

                <div class="application-card">

                    <h3>Application</h3>


                    <div class="application-item">

                        <span>Applied for</span>

                        <strong id="modalJob"></strong>

                    </div>


                    <div class="application-item">

                        <span>Applied</span>

                        <strong id="modalApplied"></strong>

                    </div>


                    <div class="application-item">

                        <span>Status</span>

                        <strong id="modalStatus"></strong>

                    </div>

                </div>


                <div class="application-card">

                    <h3>Contact</h3>


                    <div class="modal-contact-item">

                        <i class="bi bi-envelope"></i>

                        <span id="modalEmail"></span>

                    </div>


                    <div class="modal-contact-item">

                        <i class="bi bi-telephone"></i>

                        <span id="modalPhone"></span>

                    </div>


                    <div class="modal-contact-item"
                         id="linkedinWrapper">

                        <i class="bi bi-linkedin"></i>

                        <a href="#"
                           target="_blank"
                           rel="noopener"
                           id="modalLinkedin">
                            LinkedIn
                        </a>

                    </div>

                </div>


                <div class="application-card"
                     id="modalInterviewCard"
                     style="display:none;">

                    <h3>Interview</h3>


                    <div class="application-item">

                        <span>Scheduled</span>

                        <strong id="modalInterviewDate"></strong>

                    </div>


                    <div class="application-item">

                        <span>Mode</span>

                        <strong id="modalInterviewMode"></strong>

                    </div>


                    <div class="application-item">

                        <span>Status</span>

                        <strong id="modalInterviewStatus"></strong>

                    </div>

                </div>

            </aside>

        </div>

    </div>

</div>


</div>

{{-- =========================================================
INTERVIEW MODAL
========================================================= --}}

<div id="interviewModal"
     class="interview-modal">


<div class="interview-overlay"
     onclick="closeInterviewModal()"></div>


<div class="interview-box">

    <button type="button"
            class="modal-close"
            onclick="closeInterviewModal()">
        ×
    </button>


    <h3 id="interviewModalTitle">
        Schedule Interview
    </h3>

    <p>
        Set a date, mode and location for this candidate's interview.
    </p>


    <form method="POST"
          id="interviewForm">

        @csrf


        <div class="form-group">

            <label>
                Date &amp; Time
            </label>

            <input type="datetime-local"
                   name="scheduled_at"
                   id="interviewDateInput"
                   class="form-control"
                   required>

        </div>


        <div class="form-group">

            <label>
                Interview Mode
            </label>

            <select name="mode"
                    id="interviewModeInput"
                    class="form-control"
                    required>

                <option value="">
                    Select mode
                </option>

                <option value="online">
                    Online
                </option>

                <option value="in_person">
                    In Person
                </option>

                <option value="phone">
                    Phone
                </option>

            </select>

        </div>


        <div class="form-group">

            <label>
                Location / Meeting Link
            </label>

            <textarea name="location"
                      id="interviewLocationInput"
                      class="form-control"
                      placeholder="Enter meeting link or location"></textarea>

        </div>


        <div class="interview-actions">

            <button type="button"
                    class="cancel-btn"
                    onclick="closeInterviewModal()">

                Cancel

            </button>


            <button type="submit"
                    class="schedule-btn"
                    id="interviewSubmitBtn">

                Schedule Interview

            </button>

        </div>

    </form>

</div>


</div>

<script>

/* =========================================================
   Candidate three-dot menu
========================================================= */

function toggleCandidateMenu(applicationId) {

    const menu =
        document.getElementById(
            'candidate-menu-' + applicationId
        );

    if (!menu) return;

    const isOpen =
        menu.classList.contains('show');

    document
        .querySelectorAll('.candidate-menu.show')
        .forEach(function(openMenu) {

            openMenu.classList.remove('show');

        });

    if (!isOpen) {
        menu.classList.add('show');
    }
}


document.addEventListener('click', function(event) {

    if (!event.target.closest('.candidate-menu-wrap')) {

        document
            .querySelectorAll('.candidate-menu.show')
            .forEach(function(menu) {

                menu.classList.remove('show');

            });

    }

});


/* =========================================================
   Applicant Modal
========================================================= */

let currentApplicationId = null;


function openApplicantModal(applicantId) {

    const modal =
        document.getElementById('applicantModal');

    const loading =
        document.getElementById('applicantLoading');

    const content =
        document.getElementById('applicantContent');


    document
        .querySelectorAll('.candidate-menu.show')
        .forEach(function(menu) {

            menu.classList.remove('show');

        });


    modal.classList.add('active');

    document.body.style.overflow = 'hidden';

    loading.style.display = 'flex';

    content.style.display = 'none';


    fetch(
        "{{ url('/employer/applicants') }}/"
        + applicantId
        + "/details",
        {
            method: 'GET',

            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        }
    )

    .then(response => {

        if (!response.ok) {
            throw new Error(
                'Unable to load applicant.'
            );
        }

        return response.json();

    })

    .then(result => {

        if (!result.status) {

            alert(
                result.message ||
                'Unable to load applicant details.'
            );

            closeApplicantModal();

            return;
        }


        const data = result.data;

        currentApplicationId =
            data.application_id;


        document.getElementById('modalName')
            .textContent =
            data.name || 'Applicant';


        document.getElementById('modalDesignation')
            .textContent =
            data.designation ||
            'Software Developer';


        document.getElementById('modalExperience')
            .textContent =
            data.experience
                ? data.experience + ' years experience'
                : 'Experience not specified';


        const locationWrapper =
            document.getElementById(
                'modalLocationWrapper'
            );


        if (data.location) {

            document.getElementById(
                'modalLocation'
            ).textContent =
                data.location;

            locationWrapper.style.display =
                'inline-flex';

        } else {

            locationWrapper.style.display =
                'none';

        }


        const photo =
            document.getElementById('modalPhoto');


        if (data.profile_photo) {

            photo.innerHTML = `
                <img
                    src="${escapeHtml(data.profile_photo)}"
                    alt="${escapeHtml(data.name || 'Applicant')}"
                    onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">

                <span
                    class="profile-modal-fallback"
                    style="display:none;">

                    ${data.name
                        ? escapeHtml(
                            data.name
                                .charAt(0)
                                .toUpperCase()
                          )
                        : '?'}

                </span>
            `;

        } else {

            photo.innerHTML = `
                <span class="profile-modal-fallback">

                    ${data.name
                        ? escapeHtml(
                            data.name
                                .charAt(0)
                                .toUpperCase()
                          )
                        : '?'}

                </span>
            `;

        }


        document.getElementById('modalAbout')
            .textContent =
            data.about ||
            'No information provided by the applicant.';


        const skillsElement =
            document.getElementById('modalSkills');


        if (
            Array.isArray(data.skills) &&
            data.skills.length > 0
        ) {

            skillsElement.innerHTML =
                data.skills
                    .map(
                        skill =>
                            `<span>${escapeHtml(skill)}</span>`
                    )
                    .join('');

        } else {

            skillsElement.innerHTML =
                `<span class="empty-value">
                    No skills added
                </span>`;

        }


        document.getElementById(
            'modalExperienceDetails'
        ).innerHTML = `

            <div class="experience-item">

                <div class="experience-dot"></div>

                <div>

                    <h4>
                        ${escapeHtml(
                            data.designation ||
                            'Professional Experience'
                        )}
                    </h4>

                    <p>
                        ${
                            data.experience
                                ? escapeHtml(data.experience)
                                  + ' years of experience'
                                : 'Experience details not provided.'
                        }
                    </p>

                </div>

            </div>

        `;


        document.getElementById('modalEducation')
            .innerHTML =
            data.education

                ? `<p>
                    ${escapeHtml(data.education)}
                   </p>`

                : `<p class="empty-value">
                    No education details provided.
                   </p>`;


        document.getElementById('modalProjects')
            .innerHTML =
            data.projects

                ? `<p>
                    ${escapeHtml(data.projects)}
                   </p>`

                : `<p class="empty-value">
                    No projects added.
                   </p>`;


        document.getElementById('modalCertifications')
            .innerHTML =
            data.certifications

                ? `<p>
                    ${escapeHtml(data.certifications)}
                   </p>`

                : `<p class="empty-value">
                    No certifications added.
                   </p>`;


        document.getElementById('modalJob')
            .textContent =
            data.job || '';


        document.getElementById('modalApplied')
            .textContent =
            data.applied || '';


        document.getElementById('modalStatus')
            .textContent =
            formatStatus(
                data.status,
                data.sub_status
            );


        document.getElementById('modalEmail')
            .textContent =
            data.email || '';


        document.getElementById('modalPhone')
            .textContent =
            data.phone || '';


        const linkedinWrapper =
            document.getElementById(
                'linkedinWrapper'
            );

        const linkedin =
            document.getElementById(
                'modalLinkedin'
            );


        if (data.linkedin) {

            linkedin.href =
                data.linkedin;

            linkedinWrapper.style.display =
                'flex';

        } else {

            linkedinWrapper.style.display =
                'none';

        }


        const resume =
            document.getElementById(
                'modalResume'
            );


        if (data.resume) {

            resume.href =
                data.resume;

            resume.style.display =
                'inline-flex';

        } else {

            resume.style.display =
                'none';

        }


        const isClosedOut =
            data.status === 'hired' ||
            data.status === 'rejected';


        const isShortlisted =
            data.status === 'in_progress' &&
            data.sub_status === 'shortlisted';


        const isHired =
            data.status === 'hired';


        const isRejected =
            data.status === 'rejected';


        /* SHORTLIST */

        const shortlistButton =
            document.getElementById(
                'modalShortlistBtn'
            );


        const shortlistDisabled =
            isClosedOut ||
            isShortlisted;


        shortlistButton.style.display =
            'inline-flex';

        shortlistButton.disabled =
            shortlistDisabled;

        shortlistButton.classList.toggle(
            'is-disabled',
            shortlistDisabled
        );


        shortlistButton.innerHTML =
            isShortlisted

                ? '<i class="bi bi-check-circle-fill"></i> Shortlisted'

                : '<i class="bi bi-person-check"></i> Shortlist';


        shortlistButton.onclick =
            shortlistDisabled

                ? null

                : function() {

                    submitStatusChange(
                        data.application_id,
                        'in_progress',
                        'shortlisted'
                    );

                };


        /* INTERVIEW */

        const interviewButton =
            document.getElementById(
                'modalInterviewBtn'
            );


        const interviewLabel =
            document.getElementById(
                'modalInterviewBtnLabel'
            );


        interviewButton.style.display =
            'inline-flex';

        interviewButton.disabled =
            isClosedOut;

        interviewButton.classList.toggle(
            'is-disabled',
            isClosedOut
        );


        if (isClosedOut) {

            interviewLabel.textContent =
                data.interview
                    ? 'Reschedule Interview'
                    : 'Schedule Interview';

            interviewButton.onclick =
                null;

        } else if (data.interview) {

            interviewLabel.textContent =
                'Reschedule Interview';


            interviewButton.onclick =
                function() {

                    openInterviewModal(
                        data.application_id,
                        true,
                        data.interview.scheduled_at || '',
                        data.interview.mode || '',
                        data.interview.location || ''
                    );

                };

        } else {

            interviewLabel.textContent =
                'Schedule Interview';


            interviewButton.onclick =
                function() {

                    openInterviewModal(
                        data.application_id,
                        false
                    );

                };

        }


        /* HIRE */

        const hireButton =
            document.getElementById(
                'modalHireBtn'
            );


        hireButton.style.display =
            'inline-flex';

        hireButton.disabled =
            isClosedOut;

        hireButton.classList.toggle(
            'is-disabled',
            isClosedOut
        );


        hireButton.innerHTML =
            isHired

                ? '<i class="bi bi-check-circle-fill"></i> Hired'

                : '<i class="bi bi-award"></i> Hire';


        hireButton.onclick =
            isClosedOut

                ? null

                : function() {

                    if (
                        confirm(
                            'Mark this candidate as hired?'
                        )
                    ) {

                        submitStatusChange(
                            data.application_id,
                            'hired',
                            null
                        );

                    }

                };


        /* REJECT */

        const rejectButton =
            document.getElementById(
                'modalRejectBtn'
            );


        rejectButton.style.display =
            'inline-flex';

        rejectButton.disabled =
            isClosedOut;

        rejectButton.classList.toggle(
            'is-disabled',
            isClosedOut
        );


        rejectButton.innerHTML =
            isRejected

                ? '<i class="bi bi-x-circle-fill"></i> Rejected'

                : '<i class="bi bi-x-circle"></i> Reject';


        rejectButton.onclick =
            isClosedOut

                ? null

                : function() {

                    if (
                        confirm(
                            'Reject this candidate?'
                        )
                    ) {

                        submitStatusChange(
                            data.application_id,
                            'rejected',
                            null
                        );

                    }

                };


        /* INTERVIEW CARD */

        const interviewCard =
            document.getElementById(
                'modalInterviewCard'
            );


        if (data.interview) {

            interviewCard.style.display =
                'block';


            document.getElementById(
                'modalInterviewDate'
            ).textContent =
                data.interview.scheduled_at || '';


            document.getElementById(
                'modalInterviewMode'
            ).textContent =
                formatInterviewMode(
                    data.interview.mode
                );


            document.getElementById(
                'modalInterviewStatus'
            ).textContent =
                data.interview.status || '';

        } else {

            interviewCard.style.display =
                'none';

        }


        loading.style.display =
            'none';

        content.style.display =
            'block';

    })

    .catch(error => {

        console.error(error);

        alert(
            'Unable to load applicant details.'
        );

        closeApplicantModal();

    });

}


function closeApplicantModal() {

    document
        .getElementById('applicantModal')
        .classList.remove('active');

    document.body.style.overflow = '';

}


/* =========================================================
   Helpers
========================================================= */

function formatStatus(status, subStatus) {

    if (
        status === 'in_progress' &&
        subStatus === 'shortlisted'
    ) {
        return 'Shortlisted';
    }

    if (status === 'applied') {
        return 'New';
    }

    if (status === 'interview') {
        return 'Interview';
    }

    if (status === 'hired') {
        return 'Selected';
    }

    if (status === 'rejected') {
        return 'Rejected';
    }

    if (!status) {
        return '';
    }

    return status
        .replaceAll('_', ' ')
        .replace(
            /\b\w/g,
            letter => letter.toUpperCase()
        );

}


function formatInterviewMode(mode) {

    if (mode === 'online') {
        return 'Online';
    }

    if (mode === 'in_person') {
        return 'In Person';
    }

    if (mode === 'phone') {
        return 'Phone';
    }

    return mode || '';

}


function escapeHtml(value) {

    if (!value) {
        return '';
    }

    return String(value)
        .replaceAll('&', '&amp;')
        .replaceAll('<', '&lt;')
        .replaceAll('>', '&gt;')
        .replaceAll('"', '&quot;')
        .replaceAll("'", '&#039;');

}


/* =========================================================
   Status Change
========================================================= */

function submitStatusChange(
    applicationId,
    status,
    subStatus
) {

    const form =
        document.createElement('form');

    form.method = 'POST';

    form.action =
        "{{ url('/employer/applicants') }}/"
        + applicationId
        + "/status";


    let inputs = `

        <input
            type="hidden"
            name="_token"
            value="{{ csrf_token() }}">

        <input
            type="hidden"
            name="status"
            value="${status}">

    `;


    if (subStatus) {

        inputs += `

            <input
                type="hidden"
                name="sub_status"
                value="${subStatus}">

        `;

    }


    form.innerHTML =
        inputs;

    document.body.appendChild(form);

    form.submit();

}


/* =========================================================
   Interview Modal
========================================================= */

function openInterviewModal(
    applicationId,
    isReschedule,
    scheduledAt,
    mode,
    location
) {

    const modal =
        document.getElementById(
            'interviewModal'
        );

    const form =
        document.getElementById(
            'interviewForm'
        );

    const title =
        document.getElementById(
            'interviewModalTitle'
        );

    const submitBtn =
        document.getElementById(
            'interviewSubmitBtn'
        );


    document
        .querySelectorAll('.candidate-menu.show')
        .forEach(function(menu) {

            menu.classList.remove('show');

        });


    form.action =
        "{{ url('/employer/applicants') }}/"
        + applicationId
        + "/interview";


    if (isReschedule) {

        title.textContent =
            'Reschedule Interview';

        submitBtn.textContent =
            'Reschedule Interview';


        if (scheduledAt) {

            document.getElementById(
                'interviewDateInput'
            ).value =
                toDatetimeLocalValue(
                    scheduledAt
                );

        }


        if (mode) {

            document.getElementById(
                'interviewModeInput'
            ).value =
                mode;

        }


        if (location) {

            document.getElementById(
                'interviewLocationInput'
            ).value =
                location;

        }

    } else {

        title.textContent =
            'Schedule Interview';

        submitBtn.textContent =
            'Schedule Interview';

        form.reset();

    }


    modal.classList.add('active');

}


function toDatetimeLocalValue(value) {

    const date =
        new Date(value);

    if (
        isNaN(
            date.getTime()
        )
    ) {
        return '';
    }


    const pad =
        n => String(n).padStart(2, '0');


    return (
        date.getFullYear()
        + '-'
        + pad(date.getMonth() + 1)
        + '-'
        + pad(date.getDate())
        + 'T'
        + pad(date.getHours())
        + ':'
        + pad(date.getMinutes())
    );

}


function closeInterviewModal() {

    document
        .getElementById('interviewModal')
        .classList.remove('active');

}


/* =========================================================
   ESC KEY
========================================================= */

document.addEventListener(
    'keydown',
    function(event) {

        if (event.key === 'Escape') {

            closeApplicantModal();

            closeInterviewModal();

        }

    }
);

</script>

@endsection