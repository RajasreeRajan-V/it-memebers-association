@extends('layouts.app')

@php
    $portal = 'student';
@endphp

@section('title', 'Job Opportunities')

@section('content')

<style>
    :root {
        --job-primary: #3376F2;
        --job-primary-dark: #245ED1;
        --job-purple: #7C4DFF;
        --job-bg: #F6F8FC;
        --job-card: #FFFFFF;
        --job-text: #172033;
        --job-muted: #6B7280;
        --job-border: #E6EAF0;
        --job-success: #16A34A;
        --job-warning: #F59E0B;
        --job-danger: #EF4444;
        --job-shadow: 0 8px 28px rgba(31, 41, 55, 0.07);
    }

    * {
        box-sizing: border-box;
    }

    /* =========================================================
       PAGE
    ========================================================= */

    .student-jobs-page {
        background: var(--job-bg);
        min-height: calc(100vh - 80px);
        padding: 34px 0 60px;
        color: var(--job-text);
    }

    .jobs-page-container {
        width: min(1320px, calc(100% - 40px));
        margin: 0 auto;
    }

    /* =========================================================
       HERO
    ========================================================= */

    .jobs-hero {
        background: #fff;
        border: 1px solid var(--job-border);
        border-radius: 24px;
        padding: 44px 46px;
        position: relative;
        overflow: hidden;
        margin-bottom: 28px;
        box-shadow: var(--job-shadow);
    }

    .jobs-hero::before {
        content: "";
        position: absolute;
        width: 260px;
        height: 260px;
        border-radius: 50%;
        background: #EEF4FF;
        top: -150px;
        right: -90px;
        opacity: .75;
    }

    .jobs-hero::after {
        content: "";
        position: absolute;
        width: 190px;
        height: 190px;
        border-radius: 50%;
        background: #F3EEFF;
        bottom: -130px;
        left: -80px;
        opacity: .55;
    }

    .hero-grid {
        position: relative;
        z-index: 2;
        display: grid;
        grid-template-columns: 1.15fr 1fr;
        gap: 30px;
        align-items: center;
    }

    .hero-left {
        min-width: 0;
    }

    .hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #EAF1FF;
        color: var(--job-primary);
        border: 1px solid #D9E6FF;
        padding: 7px 15px;
        border-radius: 999px;
        font-size: 12.5px;
        font-weight: 700;
        margin-bottom: 18px;
    }

    .hero-badge i {
        font-size: 14px;
    }

    .hero-title {
        font-size: 36px;
        line-height: 1.18;
        font-weight: 800;
        margin: 0 0 14px;
        letter-spacing: -0.7px;
        color: var(--job-text);
    }

    .hero-title span {
        display: block;
        background: linear-gradient(
            90deg,
            var(--job-primary),
            var(--job-purple)
        );
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
    }

    .hero-text {
        margin: 0 0 25px;
        font-size: 15px;
        line-height: 1.75;
        color: var(--job-muted);
        max-width: 520px;
    }

    /* =========================================================
       HERO SEARCH
    ========================================================= */

    .hero-search {
        display: flex;
        align-items: stretch;
        width: 100%;
        max-width: 680px;
        background: #fff;
        border: 1px solid #DDE3EC;
        border-radius: 13px;
        padding: 5px;
        box-shadow: 0 10px 24px rgba(31, 41, 55, .06);
    }

    .search-field {
        flex: 1;
        display: flex;
        align-items: center;
        gap: 9px;
        padding: 0 12px;
        min-width: 0;
    }

    .search-field i {
        color: #9AA3B2;
        font-size: 16px;
        flex-shrink: 0;
    }

    .search-field input {
        width: 100%;
        border: none;
        outline: none;
        background: transparent;
        color: var(--job-text);
        font-size: 13px;
        min-width: 0;
        padding: 11px 0;
    }

    .search-field input::placeholder {
        color: #9AA3B2;
    }

    .search-divider {
        width: 1px;
        background: #E7EBF1;
        margin: 7px 0;
    }

    .hero-search button {
        border: 0;
        background: var(--job-primary);
        color: #fff;
        border-radius: 9px;
        padding: 0 22px;
        font-size: 13px;
        font-weight: 700;
        cursor: pointer;
        transition: .2s ease;
        white-space: nowrap;
    }

    .hero-search button:hover {
        background: var(--job-primary-dark);
        transform: translateY(-1px);
    }

    /* =========================================================
       POPULAR SEARCHES
    ========================================================= */

    .popular-searches {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-top: 14px;
        overflow-x: auto;
        white-space: nowrap;
        scrollbar-width: none;
    }

    .popular-searches::-webkit-scrollbar {
        display: none;
    }

    .popular-searches > span {
        color: #9AA3B2;
        font-size: 12px;
        font-weight: 600;
    }

    .popular-searches a {
        text-decoration: none;
        color: #5F6877;
        border: 1px solid #DDE3EC;
        background: #fff;
        padding: 6px 12px;
        border-radius: 999px;
        font-size: 11px;
        transition: .2s ease;
    }

    .popular-searches a:hover {
        color: var(--job-primary);
        border-color: #BFD4FF;
        background: #F8FAFF;
    }

    /* =========================================================
       HERO RIGHT
    ========================================================= */

    .hero-right {
        display: flex;
        align-items: center;
        gap: 25px;
    }

    .hero-visual {
        position: relative;
        width: 175px;
        height: 195px;
        flex-shrink: 0;
    }

    .hero-visual-circle {
        position: absolute;
        top: 3px;
        left: 9px;
        width: 152px;
        height: 152px;
        border-radius: 50%;
        background: linear-gradient(
            135deg,
            #EAF1FF,
            #F3EEFF
        );
    }

    .hero-visual-card {
        position: absolute;
        left: 34px;
        top: 45px;
        width: 108px;
        height: 132px;
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 15px 32px rgba(31, 41, 55, .13);
        padding: 15px;
    }

    .hero-card-top {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 13px;
    }

    .hero-card-icon {
        width: 25px;
        height: 25px;
        border-radius: 7px;
        background: #EAF1FF;
        color: var(--job-primary);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
    }

    .hero-card-small {
        height: 5px;
        border-radius: 4px;
        background: #EEF1F6;
        flex: 1;
    }

    .hero-visual-line {
        height: 6px;
        border-radius: 4px;
        background: #EEF1F6;
        margin-bottom: 9px;
    }

    .hero-visual-line.w-85 {
        width: 85%;
    }

    .hero-visual-line.w-70 {
        width: 70%;
    }

    .hero-visual-line.w-50 {
        width: 50%;
    }

    .hero-visual-tag {
        display: inline-block;
        width: 48px;
        height: 13px;
        border-radius: 20px;
        background: #EAF1FF;
        margin-top: 2px;
    }

    .hero-visual-badge {
        position: absolute;
        right: -9px;
        bottom: 18px;
        width: 40px;
        height: 40px;
        border-radius: 12px;
        background: var(--job-primary);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 17px;
        box-shadow: 0 8px 18px rgba(51,118,242,.30);
    }

    .hero-visual-check {
        position: absolute;
        top: 8px;
        right: 3px;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background: #E9FBF0;
        border: 1px solid #CFF5DC;
        color: var(--job-success);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 15px;
    }

    /* =========================================================
       HERO FEATURES
    ========================================================= */

    .hero-features {
        display: flex;
        flex-direction: column;
        gap: 18px;
    }

    .hero-feature-item {
        display: flex;
        align-items: flex-start;
        gap: 12px;
    }

    .hero-feature-icon {
        width: 38px;
        height: 38px;
        border-radius: 11px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        flex-shrink: 0;
    }

    .hero-feature-icon.icon-blue {
        background: #EAF1FF;
        color: var(--job-primary);
    }

    .hero-feature-icon.icon-purple {
        background: #F3EEFF;
        color: var(--job-purple);
    }

    .hero-feature-icon.icon-green {
        background: #E9FBF0;
        color: var(--job-success);
    }

    .hero-feature-title {
        font-size: 13.5px;
        font-weight: 700;
        color: var(--job-text);
        margin-bottom: 2px;
    }

    .hero-feature-text {
        font-size: 12px;
        color: var(--job-muted);
        line-height: 1.5;
    }

    /* =========================================================
       STATS
    ========================================================= */

    .jobs-stats {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 18px;
        margin-bottom: 28px;
    }

    .job-stat-card {
        background: var(--job-card);
        border: 1px solid var(--job-border);
        border-radius: 18px;
        padding: 21px 22px;
        display: flex;
        align-items: center;
        gap: 15px;
        box-shadow: var(--job-shadow);
    }

    .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #EEF4FF;
        color: var(--job-primary);
        font-size: 21px;
        flex-shrink: 0;
    }

    .stat-value {
        font-size: 24px;
        line-height: 1;
        font-weight: 700;
        color: var(--job-text);
        margin-bottom: 5px;
    }

    .stat-label {
        font-size: 13px;
        color: var(--job-muted);
        font-weight: 500;
    }

    /* =========================================================
       MAIN GRID
    ========================================================= */

    .jobs-body-grid {
        display: grid;
        grid-template-columns: 272px 1fr;
        gap: 22px;
        align-items: start;
    }

    /* =========================================================
       FILTER SIDEBAR
    ========================================================= */

    .jobs-sidebar {
        background: #fff;
        border: 1px solid var(--job-border);
        border-radius: 18px;
        padding: 20px;
        box-shadow: var(--job-shadow);
        position: sticky;
        top: 20px;
    }

    .sidebar-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        padding-bottom: 14px;
        border-bottom: 1px solid var(--job-border);
        margin-bottom: 14px;
    }

    .sidebar-title {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 15px;
        font-weight: 700;
        color: var(--job-text);
    }

    .sidebar-title i {
        color: var(--job-primary);
    }

    .clear-filters {
        font-size: 12.5px;
        font-weight: 600;
        color: var(--job-primary);
        text-decoration: none;
    }

    .clear-filters:hover {
        text-decoration: underline;
    }

    .filter-block {
        padding: 15px 0;
        border-bottom: 1px solid #F0F2F6;
    }

    .filter-block:last-of-type {
        border-bottom: none;
        padding-bottom: 4px;
    }

    .filter-label {
        font-size: 11px;
        font-weight: 700;
        letter-spacing: .06em;
        text-transform: uppercase;
        color: #9AA3B2;
        margin-bottom: 10px;
    }

    .filter-input {
        width: 100%;
        height: 40px;
        border: 1px solid #DDE3EC;
        border-radius: 9px;
        padding: 0 12px;
        font-size: 13px;
        color: var(--job-text);
        outline: none;
        transition: .2s ease;
    }

    .filter-input:focus {
        border-color: var(--job-primary);
        box-shadow: 0 0 0 3px rgba(51,118,242,.10);
    }

    .filter-apply {
        width: 100%;
        height: 42px;
        border: 0;
        border-radius: 10px;
        background: var(--job-primary);
        color: #fff;
        font-size: 13px;
        font-weight: 700;
        cursor: pointer;
        margin-top: 8px;
        transition: .2s ease;
    }

    .filter-apply:hover {
        background: var(--job-primary-dark);
        transform: translateY(-1px);
    }

    /* =========================================================
       QUICK LINKS
    ========================================================= */

    .sidebar-quick-links {
        margin-top: 16px;
        padding-top: 15px;
        border-top: 1px solid var(--job-border);
    }

    .quick-link {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 9px;
        border-radius: 9px;
        text-decoration: none;
        transition: .15s ease;
    }

    .quick-link:hover {
        background: #F6F8FC;
    }

    .quick-link-icon {
        width: 34px;
        height: 34px;
        border-radius: 9px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .quick-link-icon.blue {
        background: #EAF1FF;
        color: var(--job-primary);
    }

    .quick-link-icon.green {
        background: #E9FBF0;
        color: var(--job-success);
    }

    .quick-link-icon i {
        font-size: 15px;
    }

    .quick-link-content {
        display: flex;
        flex-direction: column;
    }

    .quick-link-title {
        color: #4B5563;
        font-size: 12px;
        font-weight: 600;
    }

    .quick-link-text {
        color: #9AA3B2;
        font-size: 10px;
        margin-top: 2px;
    }

    /* =========================================================
       JOB SECTION HEADER
    ========================================================= */

    .jobs-section-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        margin-bottom: 16px;
    }

    .section-heading {
        margin: 0;
        font-size: 20px;
        font-weight: 700;
        color: var(--job-text);
    }

    .section-subtitle {
        margin: 4px 0 0;
        font-size: 13px;
        color: var(--job-muted);
    }

    .result-badge {
        background: #fff;
        border: 1px solid #DDE3EC;
        border-radius: 999px;
        color: #596273;
        padding: 7px 12px;
        font-size: 11px;
        font-weight: 600;
        white-space: nowrap;
    }

    /* =========================================================
       JOB LIST
    ========================================================= */

    .jobs-list {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .student-job-card {
        background: #fff;
        border: 1px solid var(--job-border);
        border-radius: 16px;
        padding: 17px;
        box-shadow: var(--job-shadow);
        transition: .2s ease;
    }

    .student-job-card:hover {
        border-color: #C9D6EE;
        transform: translateY(-2px);
        box-shadow: 0 12px 28px rgba(31,41,55,.10);
    }

    .job-card-inner {
        display: flex;
        align-items: flex-start;
        gap: 14px;
    }

    .company-avatar {
        width: 58px;
        height: 58px;
        border-radius: 13px;
        background: #EEF4FF;
        color: var(--job-primary);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        font-weight: 800;
        flex-shrink: 0;
    }

    .job-card-content {
        flex: 1;
        min-width: 0;
    }

    .job-card-top {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 14px;
    }

    .job-title-row {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 8px;
        min-width: 0;
    }

    .job-title {
        margin: 0;
        color: var(--job-text);
        font-size: 15px;
        line-height: 1.4;
        font-weight: 700;
    }

    .job-type {
        display: inline-flex;
        align-items: center;
        background: #EAF1FF;
        color: var(--job-primary);
        border-radius: 999px;
        padding: 4px 9px;
        font-size: 9px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .03em;
        white-space: nowrap;
    }

    .posted-time {
        font-size: 11px;
        color: #9AA3B2;
        white-space: nowrap;
        flex-shrink: 0;
    }

    .company-location {
        margin: 5px 0 0;
        font-size: 12px;
        color: var(--job-muted);
        line-height: 1.5;
    }

    .company-location strong {
        color: #4B5563;
    }

    .company-location .separator {
        margin: 0 5px;
        color: #C7CEDB;
    }

    /* =========================================================
       JOB TAGS
    ========================================================= */

    .job-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
        margin-top: 10px;
    }

    .job-tag {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        background: #F7F9FC;
        border: 1px solid #E7EBF1;
        border-radius: 999px;
        color: #626C7C;
        padding: 5px 9px;
        font-size: 9.5px;
        font-weight: 600;
    }

    .job-tag.blue {
        background: #EAF1FF;
        border-color: #D9E6FF;
        color: var(--job-primary);
    }

    /* =========================================================
       JOB BOTTOM
    ========================================================= */

    .job-card-bottom {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        margin-top: 13px;
        padding-top: 12px;
        border-top: 1px solid #F0F2F6;
    }

    .salary {
        display: flex;
        align-items: center;
        gap: 6px;
        color: var(--job-success);
        font-size: 12px;
        font-weight: 700;
    }

    .salary.muted {
        color: #9AA3B2;
        font-weight: 500;
    }

    .salary i {
        font-size: 13px;
    }

    .view-job-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        min-height: 36px;
        padding: 0 15px;
        border: 0;
        border-radius: 9px;
        background: var(--job-primary);
        color: #fff;
        font-size: 12px;
        font-weight: 600;
        cursor: pointer;
        transition: .2s ease;
    }

    .view-job-btn:hover {
        background: var(--job-primary-dark);
        color: #fff;
        transform: translateY(-1px);
    }

    .view-job-btn i {
        font-size: 12px;
    }

    /* =========================================================
       EMPTY STATE
    ========================================================= */

    .empty-jobs {
        background: #fff;
        border: 1px dashed #D8DEE8;
        border-radius: 20px;
        padding: 55px 20px;
        text-align: center;
    }

    .empty-icon {
        width: 70px;
        height: 70px;
        margin: 0 auto 15px;
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #EEF4FF;
        color: var(--job-primary);
        font-size: 30px;
    }

    .empty-jobs h3 {
        font-size: 18px;
        color: var(--job-text);
        font-weight: 700;
        margin: 0 0 6px;
    }

    .empty-jobs p {
        color: var(--job-muted);
        font-size: 13px;
        margin: 0 0 17px;
    }

    .empty-jobs a {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        background: var(--job-primary);
        color: #fff;
        text-decoration: none;
        padding: 10px 17px;
        border-radius: 9px;
        font-size: 12px;
        font-weight: 600;
    }

    .empty-jobs a:hover {
        background: var(--job-primary-dark);
        color: #fff;
    }

    /* =========================================================
       PAGINATION
    ========================================================= */

    .student-pagination {
        margin-top: 26px;
        display: flex;
        justify-content: center;
    }

    .student-pagination nav {
        display: flex;
        justify-content: center;
    }

    .student-pagination .pagination {
        gap: 5px;
        margin: 0;
    }

    .student-pagination .page-link {
        border: 1px solid #DDE3EC;
        border-radius: 9px !important;
        color: #4B5563;
        font-size: 12px;
        min-width: 38px;
        text-align: center;
    }

    .student-pagination .page-item.active .page-link {
        background: var(--job-primary);
        border-color: var(--job-primary);
        color: #fff;
    }

    /* =========================================================
       JOB MODAL
    ========================================================= */

    .student-job-modal {
        display: none;
        position: fixed;
        inset: 0;
        z-index: 9999;
        background: rgba(15, 23, 42, .55);
        backdrop-filter: blur(4px);
        align-items: center;
        justify-content: center;
        padding: 20px;
    }

    .student-job-modal.active {
        display: flex;
    }

    .student-modal-box {
        width: 100%;
        max-width: 680px;
        max-height: 88vh;
        overflow-y: auto;
        background: #fff;
        border-radius: 20px;
        padding: 26px;
        position: relative;
        box-shadow: 0 25px 70px rgba(15, 23, 42, .22);
    }

    .student-modal-close {
        position: absolute;
        top: 15px;
        right: 15px;
        width: 35px;
        height: 35px;
        border: 1px solid #DDE3EC;
        background: #fff;
        border-radius: 9px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #64748B;
        cursor: pointer;
        transition: .2s ease;
    }

    .student-modal-close:hover {
        background: #F6F8FC;
        color: var(--job-text);
    }

    .student-modal-close i {
        font-size: 16px;
    }

    .modal-header {
        display: flex;
        align-items: center;
        gap: 14px;
        padding-right: 45px;
    }

    .modal-company-avatar {
        width: 58px;
        height: 58px;
        border-radius: 13px;
        background: #EEF4FF;
        color: var(--job-primary);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 21px;
        font-weight: 800;
        flex-shrink: 0;
    }

    .modal-header h2 {
        margin: 0;
        color: var(--job-text);
        font-size: 20px;
        line-height: 1.3;
        font-weight: 750;
    }

    .modal-header p {
        margin: 5px 0 0;
        color: var(--job-muted);
        font-size: 12px;
    }

    .modal-info-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
        margin-top: 22px;
    }

    .info-box {
        background: #F7F9FC;
        border: 1px solid #EEF1F5;
        border-radius: 11px;
        padding: 13px;
        min-width: 0;
    }

    .info-box.full {
        grid-column: 1 / -1;
    }

    .info-box span {
        display: block;
        color: #9AA3B2;
        font-size: 8px;
        text-transform: uppercase;
        font-weight: 750;
        letter-spacing: .08em;
        margin-bottom: 5px;
    }

    .info-box strong {
        display: block;
        color: #334155;
        font-size: 12px;
        line-height: 1.5;
        word-break: break-word;
    }

    .modal-section {
        margin-top: 21px;
    }

    .modal-section h4 {
        margin: 0 0 10px;
        color: var(--job-text);
        font-size: 13px;
        font-weight: 750;
    }

    .modal-section > p {
        margin: 0;
        color: var(--job-muted);
        font-size: 12.5px;
        line-height: 1.75;
        white-space: pre-line;
    }

    .modal-skills {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
    }

    .modal-skills span {
        background: #EAF1FF;
        border: 1px solid #D9E6FF;
        color: var(--job-primary);
        border-radius: 999px;
        padding: 6px 10px;
        font-size: 9.5px;
        font-weight: 600;
    }

    .modal-footer {
        border-top: 1px solid #EEF1F5;
        margin-top: 23px;
        padding-top: 16px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
    }

    .modal-posted {
        color: #9AA3B2;
        font-size: 10px;
    }

    .modal-close-btn {
        border: 0;
        background: var(--job-primary);
        color: #fff;
        border-radius: 9px;
        padding: 9px 18px;
        font-size: 11px;
        font-weight: 650;
        cursor: pointer;
        transition: .2s ease;
    }

    .modal-close-btn:hover {
        background: var(--job-primary-dark);
    }

    /* =========================================================
       RESPONSIVE
    ========================================================= */

    @media (max-width: 1100px) {

        .jobs-body-grid {
            grid-template-columns: 1fr;
        }

        .jobs-sidebar {
            position: static;
        }

        .hero-grid {
            grid-template-columns: 1fr;
        }

        .hero-right {
            justify-content: flex-start;
        }
    }

    @media (max-width: 768px) {

        .student-jobs-page {
            padding: 20px 0 40px;
        }

        .jobs-page-container {
            width: min(100% - 24px, 1320px);
        }

        .jobs-hero {
            padding: 29px 24px;
            border-radius: 19px;
        }

        .hero-title {
            font-size: 28px;
        }

        .hero-text {
            font-size: 13px;
        }

        .hero-right {
            flex-wrap: wrap;
        }

        .jobs-stats {
            grid-template-columns: 1fr;
        }

        .jobs-section-header {
            align-items: flex-start;
        }

        .job-card-inner {
            gap: 12px;
        }

        .company-avatar {
            width: 52px;
            height: 52px;
            font-size: 18px;
        }

        .job-card-top {
            flex-direction: column;
            gap: 4px;
        }

        .posted-time {
            order: -1;
        }
    }

    @media (max-width: 600px) {

        .hero-search {
            flex-direction: column;
            gap: 2px;
            padding: 5px;
        }

        .search-divider {
            display: none;
        }

        .search-field {
            border-bottom: 1px solid #F0F2F6;
            padding: 0 10px;
        }

        .hero-search button {
            height: 41px;
            margin-top: 4px;
        }

        .hero-features {
            width: 100%;
        }

        .hero-visual {
            display: none;
        }

        .jobs-section-header {
            flex-direction: column;
        }

        .result-badge {
            align-self: flex-start;
        }

        .student-job-card {
            padding: 15px;
        }

        .job-card-inner {
            align-items: flex-start;
        }

        .company-avatar {
            width: 46px;
            height: 46px;
            border-radius: 11px;
            font-size: 16px;
        }

        .job-title {
            font-size: 14px;
        }

        .job-card-bottom {
            align-items: flex-start;
            flex-direction: column;
        }

        .view-job-btn {
            width: 100%;
        }

        .modal-info-grid {
            grid-template-columns: 1fr;
        }

        .info-box.full {
            grid-column: auto;
        }

        .student-modal-box {
            padding: 21px 17px;
            border-radius: 16px;
        }

        .modal-footer {
            align-items: flex-start;
            flex-direction: column;
        }

        .modal-close-btn {
            width: 100%;
        }
    }

    @media (max-width: 420px) {

        .jobs-hero {
            padding: 25px 18px;
        }

        .hero-title {
            font-size: 25px;
        }

        .hero-badge {
            font-size: 11px;
        }

        .jobs-page-container {
            width: calc(100% - 18px);
        }

        .jobs-sidebar {
            padding: 16px;
        }
    }
</style>


<div class="student-jobs-page">

    <div class="jobs-page-container">

        {{-- =====================================================
             HERO
        ====================================================== --}}

        <section class="jobs-hero">

            <div class="hero-grid">

                <div class="hero-left">

                    <div class="hero-badge">
                        <i class="bi bi-briefcase-fill"></i>
                        {{ number_format($jobs->total()) }}+ Job Opportunities
                    </div>

                    <h1 class="hero-title">
                        Find Your Next Job,
                        <span>Build Your Future</span>
                    </h1>

                    <p class="hero-text">
                        Discover career opportunities from leading employers.
                        Find the right job for your skills, experience and
                        professional goals.
                    </p>


                    {{-- SEARCH --}}

                    <form
                        method="GET"
                        action="{{ route('student.jobs.index') }}"
                        class="hero-search"
                    >

                        <div class="search-field">

                            <i class="bi bi-search"></i>

                            <input
                                type="text"
                                name="search"
                                value="{{ request('search') }}"
                                placeholder="Job title or keywords..."
                            >

                        </div>


                        <div class="search-divider"></div>


                        <div class="search-field">

                            <i class="bi bi-geo-alt"></i>

                            <input
                                type="text"
                                name="city"
                                value="{{ request('city') }}"
                                placeholder="City or location..."
                            >

                        </div>


                        <button type="submit">
                            <i class="bi bi-search me-1"></i>
                            Search Jobs
                        </button>

                    </form>


                    {{-- POPULAR SEARCHES --}}

                    <div class="popular-searches">

                        <span>Popular:</span>

                        @foreach([
                            'Web Developer',
                            'Flutter Developer',
                            'Data Analyst'
                        ] as $tag)

                            <a href="{{ route('student.jobs.index', ['search' => $tag]) }}">
                                {{ $tag }}
                            </a>

                        @endforeach

                    </div>

                </div>


                {{-- HERO RIGHT --}}

                <div class="hero-right">

                    <div class="hero-visual">

                        <div class="hero-visual-circle"></div>


                        <div class="hero-visual-card">

                            <div class="hero-card-top">

                                <div class="hero-card-icon">
                                    <i class="bi bi-briefcase-fill"></i>
                                </div>

                                <div class="hero-card-small"></div>

                            </div>


                            <div class="hero-visual-line w-85"></div>
                            <div class="hero-visual-line w-70"></div>
                            <div class="hero-visual-line w-50"></div>

                            <span class="hero-visual-tag"></span>

                        </div>


                        <div class="hero-visual-badge">
                            <i class="bi bi-person-check-fill"></i>
                        </div>


                        <div class="hero-visual-check">
                            <i class="bi bi-check-lg"></i>
                        </div>

                    </div>


                    {{-- HERO FEATURES --}}

                    <div class="hero-features">

                        <div class="hero-feature-item">

                            <div class="hero-feature-icon icon-blue">
                                <i class="bi bi-search"></i>
                            </div>

                            <div>

                                <div class="hero-feature-title">
                                    Discover Opportunities
                                </div>

                                <div class="hero-feature-text">
                                    Find jobs that match your skills and interests
                                </div>

                            </div>

                        </div>


                        <div class="hero-feature-item">

                            <div class="hero-feature-icon icon-purple">
                                <i class="bi bi-buildings"></i>
                            </div>

                            <div>

                                <div class="hero-feature-title">
                                    Explore Employers
                                </div>

                                <div class="hero-feature-text">
                                    Discover companies and exciting career paths
                                </div>

                            </div>

                        </div>


                        <div class="hero-feature-item">

                            <div class="hero-feature-icon icon-green">
                                <i class="bi bi-graph-up-arrow"></i>
                            </div>

                            <div>

                                <div class="hero-feature-title">
                                    Grow Your Career
                                </div>

                                <div class="hero-feature-text">
                                    Take the next step toward your professional goals
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </section>


        {{-- =====================================================
             STATS
        ====================================================== --}}

        <div class="jobs-stats">

            <div class="job-stat-card">

                <div class="stat-icon">
                    <i class="bi bi-briefcase"></i>
                </div>

                <div>

                    <div class="stat-value">
                        {{ number_format($jobs->total()) }}
                    </div>

                    <div class="stat-label">
                        Available Jobs
                    </div>

                </div>

            </div>


            <div class="job-stat-card">

                <div class="stat-icon">
                    <i class="bi bi-building"></i>
                </div>

                <div>

                    <div class="stat-value">
                        {{ $jobs->count() }}
                    </div>

                    <div class="stat-label">
                        Jobs Showing
                    </div>

                </div>

            </div>


            <div class="job-stat-card">

                <div class="stat-icon">
                    <i class="bi bi-geo-alt"></i>
                </div>

                <div>

                    <div class="stat-value">
                        {{ request('city') ? '1' : 'All' }}
                    </div>

                    <div class="stat-label">
                        Location Search
                    </div>

                </div>

            </div>

        </div>


        {{-- =====================================================
             BODY
        ====================================================== --}}

        <div class="jobs-body-grid">


            {{-- =================================================
                 LEFT FILTER
            ================================================== --}}

            <aside class="jobs-sidebar">

                <form
                    method="GET"
                    action="{{ route('student.jobs.index') }}"
                >

                    <div class="sidebar-header">

                        <div class="sidebar-title">

                            <i class="bi bi-sliders"></i>

                            Filters

                        </div>


                        @if(request()->hasAny(['search', 'city']))

                            <a
                                href="{{ route('student.jobs.index') }}"
                                class="clear-filters"
                            >
                                Clear all
                            </a>

                        @endif

                    </div>


                    {{-- SEARCH --}}

                    <div class="filter-block">

                        <div class="filter-label">
                            Search Jobs
                        </div>

                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Job title or keyword..."
                            class="filter-input"
                        >

                    </div>


                    {{-- LOCATION --}}

                    <div class="filter-block">

                        <div class="filter-label">
                            Location
                        </div>

                        <input
                            type="text"
                            name="city"
                            value="{{ request('city') }}"
                            placeholder="City..."
                            class="filter-input"
                        >

                    </div>


                    <button
                        type="submit"
                        class="filter-apply"
                    >
                        <i class="bi bi-search me-1"></i>
                        Apply Filters
                    </button>

                </form>


                {{-- QUICK LINKS --}}

                <div class="sidebar-quick-links">

                    <a
                        href="{{ route('student.jobs.index') }}"
                        class="quick-link"
                    >

                        <div class="quick-link-icon blue">
                            <i class="bi bi-grid"></i>
                        </div>

                        <div class="quick-link-content">

                            <span class="quick-link-title">
                                All Jobs
                            </span>

                            <span class="quick-link-text">
                                Browse all opportunities
                            </span>

                        </div>

                    </a>


                    <a
                        href="{{ route('student.jobs.index') }}"
                        class="quick-link"
                    >

                        <div class="quick-link-icon green">
                            <i class="bi bi-clock-history"></i>
                        </div>

                        <div class="quick-link-content">

                            <span class="quick-link-title">
                                Latest Jobs
                            </span>

                            <span class="quick-link-text">
                                Recently posted opportunities
                            </span>

                        </div>

                    </a>

                </div>

            </aside>


            {{-- =================================================
                 JOB LIST
            ================================================== --}}

            <main class="jobs-main" id="jobs-list">

                <div class="jobs-section-header">

                    <div>

                        <h2 class="section-heading">
                            Available Jobs
                        </h2>

                        <p class="section-subtitle">
                            Explore opportunities that match your career goals
                        </p>

                    </div>


                    <span class="result-badge">

                        {{ number_format($jobs->total()) }}

                        {{ Str::plural('job', $jobs->total()) }}

                    </span>

                </div>


                <div class="jobs-list">

                    @forelse ($jobs as $job)

                        @php

                            $companyName =
                                $job->employer->company_name
                                ?? $job->employer->name
                                ?? 'Company';


                            $location = collect([
                                $job->city,
                                $job->district,
                                $job->state,
                                $job->country
                            ])
                            ->filter()
                            ->implode(', ');

                            $location =
                                $location
                                ?: 'Location not specified';


                            /*
                             * Handle skills as:
                             * - array
                             * - JSON string
                             * - comma separated string
                             */

                            $skills = $job->skills;

                            if (is_string($skills)) {

                                $decodedSkills =
                                    json_decode($skills, true);

                                if (
                                    json_last_error() === JSON_ERROR_NONE
                                    && is_array($decodedSkills)
                                ) {

                                    $skills = $decodedSkills;

                                } else {

                                    $skills = array_filter(
                                        array_map(
                                            'trim',
                                            explode(',', $skills)
                                        )
                                    );

                                }
                            }


                            if (!is_array($skills)) {

                                $skills =
                                    $skills
                                    ? [$skills]
                                    : [];

                            }


                            $skills = array_filter(
                                $skills,
                                function ($skill) {
                                    return
                                        $skill !== null
                                        && $skill !== '';
                                }
                            );


                            $skills = array_map(
                                function ($skill) {

                                    if (is_array($skill)) {
                                        return implode(', ', $skill);
                                    }

                                    return (string) $skill;

                                },
                                $skills
                            );


                            $employmentType =
                                $job->employment_type
                                ? ucfirst(
                                    str_replace(
                                        '-',
                                        ' ',
                                        $job->employment_type
                                    )
                                )
                                : null;

                        @endphp


                        {{-- =================================================
                             JOB CARD
                        ================================================== --}}

                        <article class="student-job-card">

                            <div class="job-card-inner">


                                {{-- COMPANY AVATAR --}}

                                <div class="company-avatar">

                                    {{ strtoupper(
                                        substr(
                                            $companyName,
                                            0,
                                            1
                                        )
                                    ) }}

                                </div>


                                <div class="job-card-content">


                                    <div class="job-card-top">


                                        <div style="min-width:0;">

                                            <div class="job-title-row">

                                                <h3 class="job-title">
                                                    {{ $job->title }}
                                                </h3>


                                                @if($employmentType)

                                                    <span class="job-type">

                                                        {{ $employmentType }}

                                                    </span>

                                                @endif

                                            </div>


                                            <p class="company-location">

                                                <strong>
                                                    {{ $companyName }}
                                                </strong>

                                                <span class="separator">
                                                    ·
                                                </span>

                                                {{ $location }}

                                            </p>

                                        </div>


                                        <span class="posted-time">

                                            {{ $job->created_at?->diffForHumans() }}

                                        </span>

                                    </div>


                                    {{-- TAGS --}}

                                    <div class="job-tags">

                                        @if($job->work_mode)

                                            <span class="job-tag blue">

                                                <i class="bi bi-laptop"></i>

                                                {{ ucfirst($job->work_mode) }}

                                            </span>

                                        @endif


                                        @if($job->experience)

                                            <span class="job-tag">

                                                <i class="bi bi-person-workspace"></i>

                                                {{ $job->experience }}

                                            </span>

                                        @endif


                                        @foreach(array_slice($skills, 0, 3) as $skill)

                                            <span class="job-tag">
                                                {{ $skill }}
                                            </span>

                                        @endforeach

                                    </div>


                                    {{-- BOTTOM --}}

                                    <div class="job-card-bottom">


                                        @if($job->salary)

                                            <span class="salary">

                                                <i class="bi bi-cash-stack"></i>

                                                {{ $job->salary }}

                                            </span>

                                        @else

                                            <span class="salary muted">

                                                <i class="bi bi-dash-circle"></i>

                                                Salary not disclosed

                                            </span>

                                        @endif


                                        <button
                                            type="button"
                                            class="view-job-btn"
                                            onclick="openStudentJobModal('student-job-{{ $job->id }}')"
                                        >

                                            View Details

                                            <i class="bi bi-arrow-right"></i>

                                        </button>

                                    </div>

                                </div>

                            </div>

                        </article>


                        {{-- =================================================
                             JOB MODAL
                        ================================================== --}}

                        <div
                            class="student-job-modal"
                            id="student-job-{{ $job->id }}"
                        >

                            <div class="student-modal-box">


                                <button
                                    type="button"
                                    class="student-modal-close"
                                    onclick="closeStudentJobModal('student-job-{{ $job->id }}')"
                                    aria-label="Close"
                                >

                                    <i class="bi bi-x-lg"></i>

                                </button>


                                {{-- MODAL HEADER --}}

                                <div class="modal-header">

                                    <div class="modal-company-avatar">

                                        {{ strtoupper(
                                            substr(
                                                $companyName,
                                                0,
                                                1
                                            )
                                        ) }}

                                    </div>


                                    <div>

                                        <h2>
                                            {{ $job->title }}
                                        </h2>

                                        <p>

                                            {{ $companyName }}

                                            <span style="margin:0 5px;">
                                                ·
                                            </span>

                                            {{ $location }}

                                        </p>

                                    </div>

                                </div>


                                {{-- INFO --}}

                                <div class="modal-info-grid">


                                    @if($employmentType)

                                        <div class="info-box">

                                            <span>
                                                Employment Type
                                            </span>

                                            <strong>
                                                {{ $employmentType }}
                                            </strong>

                                        </div>

                                    @endif


                                    @if($job->work_mode)

                                        <div class="info-box">

                                            <span>
                                                Work Mode
                                            </span>

                                            <strong>
                                                {{ ucfirst($job->work_mode) }}
                                            </strong>

                                        </div>

                                    @endif


                                    @if($job->experience)

                                        <div class="info-box">

                                            <span>
                                                Experience
                                            </span>

                                            <strong>
                                                {{ $job->experience }}
                                            </strong>

                                        </div>

                                    @endif


                                    @if($job->salary)

                                        <div class="info-box">

                                            <span>
                                                Salary
                                            </span>

                                            <strong>
                                                {{ $job->salary }}
                                            </strong>

                                        </div>

                                    @endif


                                    @if($job->qualification)

                                        <div class="info-box full">

                                            <span>
                                                Qualification
                                            </span>

                                            <strong>
                                                {{ $job->qualification }}
                                            </strong>

                                        </div>

                                    @endif


                                    <div class="info-box full">

                                        <span>
                                            Location
                                        </span>

                                        <strong>
                                            {{ $location }}
                                        </strong>

                                    </div>

                                </div>


                                {{-- SKILLS --}}

                                @if(count($skills))

                                    <div class="modal-section">

                                        <h4>
                                            Skills Required
                                        </h4>


                                        <div class="modal-skills">

                                            @foreach($skills as $skill)

                                                <span>
                                                    {{ $skill }}
                                                </span>

                                            @endforeach

                                        </div>

                                    </div>

                                @endif


                                {{-- DESCRIPTION --}}

                                @if($job->description)

                                    <div class="modal-section">

                                        <h4>
                                            Job Description
                                        </h4>

                                        <p>
                                            {{ $job->description }}
                                        </p>

                                    </div>

                                @endif


                                {{-- FOOTER --}}

                                <div class="modal-footer">

                                    <span class="modal-posted">

                                        Posted
                                        {{ $job->created_at?->diffForHumans() }}

                                    </span>


                                    <button
                                        type="button"
                                        class="modal-close-btn"
                                        onclick="closeStudentJobModal('student-job-{{ $job->id }}')"
                                    >

                                        Close

                                    </button>

                                </div>

                            </div>

                        </div>


                    @empty


                        {{-- EMPTY STATE --}}

                        <div class="empty-jobs">

                            <div class="empty-icon">

                                <i class="bi bi-briefcase"></i>

                            </div>


                            <h3>
                                No jobs found
                            </h3>


                            <p>
                                We couldn't find any jobs matching your
                                search criteria.
                            </p>


                            <a
                                href="{{ route('student.jobs.index') }}"
                            >

                                <i class="bi bi-grid"></i>

                                View All Jobs

                            </a>

                        </div>


                    @endforelse

                </div>


                {{-- =================================================
                     PAGINATION
                ================================================== --}}

                @if($jobs->hasPages())

                    <div class="student-pagination">

                        {{ $jobs->onEachSide(1)->appends(request()->query())->links() }}

                    </div>

                @endif

            </main>

        </div>

    </div>

</div>


{{-- =============================================================
     JAVASCRIPT
============================================================= --}}

<script>

    function openStudentJobModal(id) {

        const modal = document.getElementById(id);

        if (!modal) {
            return;
        }

        modal.classList.add('active');

        document.body.style.overflow = 'hidden';
    }


    function closeStudentJobModal(id) {

        const modal = document.getElementById(id);

        if (!modal) {
            return;
        }

        modal.classList.remove('active');

        document.body.style.overflow = '';
    }


    /*
     * Close when clicking outside modal box
     */

    document
        .querySelectorAll('.student-job-modal')
        .forEach(function(modal) {

            modal.addEventListener(
                'click',
                function(event) {

                    if (event.target === modal) {

                        modal.classList.remove('active');

                        document.body.style.overflow = '';

                    }

                }
            );

        });


    /*
     * ESC key
     */

    document.addEventListener(
        'keydown',
        function(event) {

            if (event.key === 'Escape') {

                document
                    .querySelectorAll('.student-job-modal.active')
                    .forEach(function(modal) {

                        modal.classList.remove('active');

                    });

                document.body.style.overflow = '';

            }

        }
    );

</script>

@endsection