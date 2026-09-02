@extends('layouts.app')

@php
    $portal = 'student';
@endphp

@section('title', 'Internship Opportunities')

@section('content')

<style>
    :root {
        --intern-primary: #3376F2;
        --intern-primary-dark: #245ED1;
        --intern-purple: #7C4DFF;
        --intern-bg: #F6F8FC;
        --intern-card: #FFFFFF;
        --intern-text: #172033;
        --intern-muted: #6B7280;
        --intern-border: #E6EAF0;
        --intern-success: #16A34A;
        --intern-warning: #F59E0B;
        --intern-shadow: 0 8px 28px rgba(31, 41, 55, 0.07);
    }

    * {
        box-sizing: border-box;
    }

    /* =========================================================
       PAGE
    ========================================================= */

    .student-internship-page {
        background: var(--intern-bg);
        min-height: calc(100vh - 80px);
        padding: 34px 0 60px;
        color: var(--intern-text);
    }

    .internship-page-container {
        width: min(1320px, calc(100% - 40px));
        margin: 0 auto;
    }

    /* =========================================================
       HERO
    ========================================================= */

    .internship-hero {
        background: #fff;
        border: 1px solid var(--intern-border);
        border-radius: 24px;
        padding: 44px 46px;
        position: relative;
        overflow: hidden;
        margin-bottom: 28px;
        box-shadow: var(--intern-shadow);
    }

    .internship-hero::before {
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

    .internship-hero::after {
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

    .intern-hero-grid {
        position: relative;
        z-index: 2;
        display: grid;
        grid-template-columns: 1.15fr 1fr;
        gap: 30px;
        align-items: center;
    }

    .intern-hero-left {
        min-width: 0;
    }

    .intern-hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #EAF1FF;
        color: var(--intern-primary);
        border: 1px solid #D9E6FF;
        padding: 7px 15px;
        border-radius: 999px;
        font-size: 12.5px;
        font-weight: 700;
        margin-bottom: 18px;
    }

    .intern-hero-badge i {
        font-size: 14px;
    }

    .intern-hero-title {
        font-size: 36px;
        line-height: 1.18;
        font-weight: 800;
        margin: 0 0 14px;
        letter-spacing: -0.7px;
        color: var(--intern-text);
    }

    .intern-hero-title span {
        display: block;
        background: linear-gradient(
            90deg,
            var(--intern-primary),
            var(--intern-purple)
        );
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
    }

    .intern-hero-text {
        margin: 0 0 25px;
        font-size: 15px;
        line-height: 1.75;
        color: var(--intern-muted);
        max-width: 520px;
    }

    /* =========================================================
       HERO SEARCH
    ========================================================= */

    .intern-hero-search {
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

    .intern-search-field {
        flex: 1;
        display: flex;
        align-items: center;
        gap: 9px;
        padding: 0 12px;
        min-width: 0;
    }

    .intern-search-field i {
        color: #9AA3B2;
        font-size: 16px;
        flex-shrink: 0;
    }

    .intern-search-field input {
        width: 100%;
        border: none;
        outline: none;
        background: transparent;
        color: var(--intern-text);
        font-size: 13px;
        min-width: 0;
        padding: 11px 0;
    }

    .intern-search-field input::placeholder {
        color: #9AA3B2;
    }

    .intern-search-divider {
        width: 1px;
        background: #E7EBF1;
        margin: 7px 0;
    }

    .intern-hero-search button {
        border: 0;
        background: var(--intern-primary);
        color: #fff;
        border-radius: 9px;
        padding: 0 22px;
        font-size: 13px;
        font-weight: 700;
        cursor: pointer;
        transition: .2s ease;
        white-space: nowrap;
    }

    .intern-hero-search button:hover {
        background: var(--intern-primary-dark);
        transform: translateY(-1px);
    }

    /* =========================================================
       POPULAR
    ========================================================= */

    .intern-popular-searches {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-top: 14px;
        overflow-x: auto;
        white-space: nowrap;
        scrollbar-width: none;
    }

    .intern-popular-searches::-webkit-scrollbar {
        display: none;
    }

    .intern-popular-searches > span {
        color: #9AA3B2;
        font-size: 12px;
        font-weight: 600;
    }

    .intern-popular-searches a {
        text-decoration: none;
        color: #5F6877;
        border: 1px solid #DDE3EC;
        background: #fff;
        padding: 6px 12px;
        border-radius: 999px;
        font-size: 11px;
        transition: .2s ease;
    }

    .intern-popular-searches a:hover {
        color: var(--intern-primary);
        border-color: #BFD4FF;
        background: #F8FAFF;
    }

    /* =========================================================
       HERO RIGHT
    ========================================================= */

    .intern-hero-right {
        display: flex;
        align-items: center;
        gap: 25px;
    }

    .intern-hero-visual {
        position: relative;
        width: 175px;
        height: 195px;
        flex-shrink: 0;
    }

    .intern-hero-circle {
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

    .intern-hero-card {
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

    .intern-card-top {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 13px;
    }

    .intern-card-icon {
        width: 25px;
        height: 25px;
        border-radius: 7px;
        background: #EAF1FF;
        color: var(--intern-primary);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
    }

    .intern-card-small {
        height: 5px;
        border-radius: 4px;
        background: #EEF1F6;
        flex: 1;
    }

    .intern-visual-line {
        height: 6px;
        border-radius: 4px;
        background: #EEF1F6;
        margin-bottom: 9px;
    }

    .intern-visual-line.w-85 {
        width: 85%;
    }

    .intern-visual-line.w-70 {
        width: 70%;
    }

    .intern-visual-line.w-50 {
        width: 50%;
    }

    .intern-visual-tag {
        display: inline-block;
        width: 48px;
        height: 13px;
        border-radius: 20px;
        background: #EAF1FF;
        margin-top: 2px;
    }

    .intern-visual-badge {
        position: absolute;
        right: -9px;
        bottom: 18px;
        width: 40px;
        height: 40px;
        border-radius: 12px;
        background: var(--intern-primary);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 17px;
        box-shadow: 0 8px 18px rgba(51,118,242,.30);
    }

    .intern-visual-check {
        position: absolute;
        top: 8px;
        right: 3px;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background: #E9FBF0;
        border: 1px solid #CFF5DC;
        color: var(--intern-success);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 15px;
    }

    /* =========================================================
       HERO FEATURES
    ========================================================= */

    .intern-hero-features {
        display: flex;
        flex-direction: column;
        gap: 18px;
    }

    .intern-feature-item {
        display: flex;
        align-items: flex-start;
        gap: 12px;
    }

    .intern-feature-icon {
        width: 38px;
        height: 38px;
        border-radius: 11px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        flex-shrink: 0;
    }

    .intern-feature-icon.blue {
        background: #EAF1FF;
        color: var(--intern-primary);
    }

    .intern-feature-icon.purple {
        background: #F3EEFF;
        color: var(--intern-purple);
    }

    .intern-feature-icon.green {
        background: #E9FBF0;
        color: var(--intern-success);
    }

    .intern-feature-title {
        font-size: 13.5px;
        font-weight: 700;
        color: var(--intern-text);
        margin-bottom: 2px;
    }

    .intern-feature-text {
        font-size: 12px;
        color: var(--intern-muted);
        line-height: 1.5;
    }

    /* =========================================================
       STATS
    ========================================================= */

    .intern-stats {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 18px;
        margin-bottom: 28px;
    }

    .intern-stat-card {
        background: var(--intern-card);
        border: 1px solid var(--intern-border);
        border-radius: 18px;
        padding: 21px 22px;
        display: flex;
        align-items: center;
        gap: 15px;
        box-shadow: var(--intern-shadow);
    }

    .intern-stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #EEF4FF;
        color: var(--intern-primary);
        font-size: 21px;
        flex-shrink: 0;
    }

    .intern-stat-value {
        font-size: 24px;
        line-height: 1;
        font-weight: 700;
        color: var(--intern-text);
        margin-bottom: 5px;
    }

    .intern-stat-label {
        font-size: 13px;
        color: var(--intern-muted);
        font-weight: 500;
    }

    /* =========================================================
       BODY GRID
    ========================================================= */

    .intern-body-grid {
        display: grid;
        grid-template-columns: 272px 1fr;
        gap: 22px;
        align-items: start;
    }

    /* =========================================================
       SIDEBAR
    ========================================================= */

    .intern-sidebar {
        background: #fff;
        border: 1px solid var(--intern-border);
        border-radius: 18px;
        padding: 20px;
        box-shadow: var(--intern-shadow);
        position: sticky;
        top: 20px;
    }

    .intern-sidebar-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        padding-bottom: 14px;
        border-bottom: 1px solid var(--intern-border);
        margin-bottom: 14px;
    }

    .intern-sidebar-title {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 15px;
        font-weight: 700;
        color: var(--intern-text);
    }

    .intern-sidebar-title i {
        color: var(--intern-primary);
    }

    .intern-clear-filters {
        font-size: 12.5px;
        font-weight: 600;
        color: var(--intern-primary);
        text-decoration: none;
    }

    .intern-clear-filters:hover {
        text-decoration: underline;
    }

    .intern-filter-block {
        padding: 15px 0;
        border-bottom: 1px solid #F0F2F6;
    }

    .intern-filter-block:last-of-type {
        border-bottom: none;
        padding-bottom: 4px;
    }

    .intern-filter-label {
        font-size: 11px;
        font-weight: 700;
        letter-spacing: .06em;
        text-transform: uppercase;
        color: #9AA3B2;
        margin-bottom: 10px;
    }

    .intern-filter-input {
        width: 100%;
        height: 40px;
        border: 1px solid #DDE3EC;
        border-radius: 9px;
        padding: 0 12px;
        font-size: 13px;
        color: var(--intern-text);
        outline: none;
        transition: .2s ease;
    }

    .intern-filter-input:focus {
        border-color: var(--intern-primary);
        box-shadow: 0 0 0 3px rgba(51,118,242,.10);
    }

    .intern-filter-apply {
        width: 100%;
        height: 42px;
        border: 0;
        border-radius: 10px;
        background: var(--intern-primary);
        color: #fff;
        font-size: 13px;
        font-weight: 700;
        cursor: pointer;
        margin-top: 8px;
        transition: .2s ease;
    }

    .intern-filter-apply:hover {
        background: var(--intern-primary-dark);
        transform: translateY(-1px);
    }

    /* =========================================================
       QUICK LINKS
    ========================================================= */

    .intern-quick-links {
        margin-top: 16px;
        padding-top: 15px;
        border-top: 1px solid var(--intern-border);
    }

    .intern-quick-link {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 9px;
        border-radius: 9px;
        text-decoration: none;
        transition: .15s ease;
    }

    .intern-quick-link:hover {
        background: #F6F8FC;
    }

    .intern-quick-icon {
        width: 34px;
        height: 34px;
        border-radius: 9px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .intern-quick-icon.blue {
        background: #EAF1FF;
        color: var(--intern-primary);
    }

    .intern-quick-icon.green {
        background: #E9FBF0;
        color: var(--intern-success);
    }

    .intern-quick-content {
        display: flex;
        flex-direction: column;
    }

    .intern-quick-title {
        color: #4B5563;
        font-size: 12px;
        font-weight: 600;
    }

    .intern-quick-text {
        color: #9AA3B2;
        font-size: 10px;
        margin-top: 2px;
    }

    /* =========================================================
       SECTION HEADER
    ========================================================= */

    .intern-section-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        margin-bottom: 16px;
    }

    .intern-section-heading {
        margin: 0;
        font-size: 20px;
        font-weight: 700;
        color: var(--intern-text);
    }

    .intern-section-subtitle {
        margin: 4px 0 0;
        font-size: 13px;
        color: var(--intern-muted);
    }

    .intern-result-badge {
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
       INTERNSHIP LIST
    ========================================================= */

    .internship-list {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .student-internship-card {
        background: #fff;
        border: 1px solid var(--intern-border);
        border-radius: 16px;
        padding: 17px;
        box-shadow: var(--intern-shadow);
        transition: .2s ease;
    }

    .student-internship-card:hover {
        border-color: #C9D6EE;
        transform: translateY(-2px);
        box-shadow: 0 12px 28px rgba(31,41,55,.10);
    }

    .internship-card-inner {
        display: flex;
        align-items: flex-start;
        gap: 14px;
    }

    .intern-company-avatar {
        width: 58px;
        height: 58px;
        border-radius: 13px;
        background: #EEF4FF;
        color: var(--intern-primary);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        font-weight: 800;
        flex-shrink: 0;
    }

    .internship-card-content {
        flex: 1;
        min-width: 0;
    }

    .internship-card-top {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 14px;
    }

    .internship-title-row {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 8px;
        min-width: 0;
    }

    .internship-title {
        margin: 0;
        color: var(--intern-text);
        font-size: 15px;
        line-height: 1.4;
        font-weight: 700;
    }

    .internship-type {
        display: inline-flex;
        align-items: center;
        background: #EAF1FF;
        color: var(--intern-primary);
        border-radius: 999px;
        padding: 4px 9px;
        font-size: 9px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .03em;
        white-space: nowrap;
    }

    .intern-posted-time {
        font-size: 11px;
        color: #9AA3B2;
        white-space: nowrap;
        flex-shrink: 0;
    }

    .intern-company-location {
        margin: 5px 0 0;
        font-size: 12px;
        color: var(--intern-muted);
        line-height: 1.5;
    }

    .intern-company-location strong {
        color: #4B5563;
    }

    .intern-separator {
        margin: 0 5px;
        color: #C7CEDB;
    }

    /* =========================================================
       TAGS
    ========================================================= */

    .internship-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
        margin-top: 10px;
    }

    .internship-tag {
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

    .internship-tag.blue {
        background: #EAF1FF;
        border-color: #D9E6FF;
        color: var(--intern-primary);
    }

    .internship-tag.green {
        background: #E9FBF0;
        border-color: #CFF5DC;
        color: var(--intern-success);
    }

    /* =========================================================
       CARD BOTTOM
    ========================================================= */

    .internship-card-bottom {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        margin-top: 13px;
        padding-top: 12px;
        border-top: 1px solid #F0F2F6;
    }

    .intern-stipend {
        display: flex;
        align-items: center;
        gap: 6px;
        color: var(--intern-success);
        font-size: 12px;
        font-weight: 700;
    }

    .intern-stipend.muted {
        color: #9AA3B2;
        font-weight: 500;
    }

    .intern-stipend i {
        font-size: 13px;
    }

    .intern-view-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        min-height: 36px;
        padding: 0 15px;
        border: 0;
        border-radius: 9px;
        background: var(--intern-primary);
        color: #fff;
        font-size: 12px;
        font-weight: 600;
        cursor: pointer;
        transition: .2s ease;
    }

    .intern-view-btn:hover {
        background: var(--intern-primary-dark);
        color: #fff;
        transform: translateY(-1px);
    }

    /* =========================================================
       EMPTY STATE
    ========================================================= */

    .intern-empty {
        background: #fff;
        border: 1px dashed #D8DEE8;
        border-radius: 20px;
        padding: 55px 20px;
        text-align: center;
    }

    .intern-empty-icon {
        width: 70px;
        height: 70px;
        margin: 0 auto 15px;
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #EEF4FF;
        color: var(--intern-primary);
        font-size: 30px;
    }

    .intern-empty h3 {
        font-size: 18px;
        color: var(--intern-text);
        font-weight: 700;
        margin: 0 0 6px;
    }

    .intern-empty p {
        color: var(--intern-muted);
        font-size: 13px;
        margin: 0 0 17px;
    }

    .intern-empty a {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        background: var(--intern-primary);
        color: #fff;
        text-decoration: none;
        padding: 10px 17px;
        border-radius: 9px;
        font-size: 12px;
        font-weight: 600;
    }

    .intern-empty a:hover {
        background: var(--intern-primary-dark);
        color: #fff;
    }

    /* =========================================================
       PAGINATION
    ========================================================= */

    .intern-pagination {
        margin-top: 26px;
        display: flex;
        justify-content: center;
    }

    .intern-pagination nav {
        display: flex;
        justify-content: center;
    }

    .intern-pagination .pagination {
        gap: 5px;
        margin: 0;
    }

    .intern-pagination .page-link {
        border: 1px solid #DDE3EC;
        border-radius: 9px !important;
        color: #4B5563;
        font-size: 12px;
        min-width: 38px;
        text-align: center;
    }

    .intern-pagination .page-item.active .page-link {
        background: var(--intern-primary);
        border-color: var(--intern-primary);
        color: #fff;
    }

    /* =========================================================
       MODAL
    ========================================================= */

    .internship-modal {
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

    .internship-modal.active {
        display: flex;
    }

    .intern-modal-box {
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

    .intern-modal-close {
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

    .intern-modal-close:hover {
        background: #F6F8FC;
        color: var(--intern-text);
    }

    .intern-modal-header {
        display: flex;
        align-items: center;
        gap: 14px;
        padding-right: 45px;
    }

    .intern-modal-avatar {
        width: 58px;
        height: 58px;
        border-radius: 13px;
        background: #EEF4FF;
        color: var(--intern-primary);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 21px;
        font-weight: 800;
        flex-shrink: 0;
    }

    .intern-modal-header h2 {
        margin: 0;
        color: var(--intern-text);
        font-size: 20px;
        line-height: 1.3;
        font-weight: 750;
    }

    .intern-modal-header p {
        margin: 5px 0 0;
        color: var(--intern-muted);
        font-size: 12px;
    }

    /* =========================================================
       MODAL INFO
    ========================================================= */

    .intern-modal-info-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
        margin-top: 22px;
    }

    .intern-info-box {
        background: #F7F9FC;
        border: 1px solid #EEF1F5;
        border-radius: 11px;
        padding: 13px;
        min-width: 0;
    }

    .intern-info-box.full {
        grid-column: 1 / -1;
    }

    .intern-info-box span {
        display: block;
        color: #9AA3B2;
        font-size: 8px;
        text-transform: uppercase;
        font-weight: 750;
        letter-spacing: .08em;
        margin-bottom: 5px;
    }

    .intern-info-box strong {
        display: block;
        color: #334155;
        font-size: 12px;
        line-height: 1.5;
        word-break: break-word;
    }

    .intern-modal-section {
        margin-top: 21px;
    }

    .intern-modal-section h4 {
        margin: 0 0 10px;
        color: var(--intern-text);
        font-size: 13px;
        font-weight: 750;
    }

    .intern-modal-section > p {
        margin: 0;
        color: var(--intern-muted);
        font-size: 12.5px;
        line-height: 1.75;
        white-space: pre-line;
    }

    .intern-modal-footer {
        border-top: 1px solid #EEF1F5;
        margin-top: 23px;
        padding-top: 16px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
    }

    .intern-modal-posted {
        color: #9AA3B2;
        font-size: 10px;
    }

    .intern-modal-close-btn {
        border: 0;
        background: var(--intern-primary);
        color: #fff;
        border-radius: 9px;
        padding: 9px 18px;
        font-size: 11px;
        font-weight: 650;
        cursor: pointer;
        transition: .2s ease;
    }

    .intern-modal-close-btn:hover {
        background: var(--intern-primary-dark);
    }

    /* =========================================================
       RESPONSIVE
    ========================================================= */

    @media (max-width: 1100px) {

        .intern-body-grid {
            grid-template-columns: 1fr;
        }

        .intern-sidebar {
            position: static;
        }

        .intern-hero-grid {
            grid-template-columns: 1fr;
        }

        .intern-hero-right {
            justify-content: flex-start;
        }
    }

    @media (max-width: 768px) {

        .student-internship-page {
            padding: 20px 0 40px;
        }

        .internship-page-container {
            width: min(100% - 24px, 1320px);
        }

        .internship-hero {
            padding: 29px 24px;
            border-radius: 19px;
        }

        .intern-hero-title {
            font-size: 28px;
        }

        .intern-hero-text {
            font-size: 13px;
        }

        .intern-hero-right {
            flex-wrap: wrap;
        }

        .intern-stats {
            grid-template-columns: 1fr;
        }

        .intern-section-header {
            align-items: flex-start;
        }

        .internship-card-inner {
            gap: 12px;
        }

        .intern-company-avatar {
            width: 52px;
            height: 52px;
            font-size: 18px;
        }

        .internship-card-top {
            flex-direction: column;
            gap: 4px;
        }

        .intern-posted-time {
            order: -1;
        }
    }

    @media (max-width: 600px) {

        .intern-hero-search {
            flex-direction: column;
            gap: 2px;
            padding: 5px;
        }

        .intern-search-divider {
            display: none;
        }

        .intern-search-field {
            border-bottom: 1px solid #F0F2F6;
            padding: 0 10px;
        }

        .intern-hero-search button {
            height: 41px;
            margin-top: 4px;
        }

        .intern-hero-features {
            width: 100%;
        }

        .intern-hero-visual {
            display: none;
        }

        .intern-section-header {
            flex-direction: column;
        }

        .intern-result-badge {
            align-self: flex-start;
        }

        .student-internship-card {
            padding: 15px;
        }

        .intern-company-avatar {
            width: 46px;
            height: 46px;
            border-radius: 11px;
            font-size: 16px;
        }

        .internship-title {
            font-size: 14px;
        }

        .internship-card-bottom {
            align-items: flex-start;
            flex-direction: column;
        }

        .intern-view-btn {
            width: 100%;
        }

        .intern-modal-info-grid {
            grid-template-columns: 1fr;
        }

        .intern-info-box.full {
            grid-column: auto;
        }

        .intern-modal-box {
            padding: 21px 17px;
            border-radius: 16px;
        }

        .intern-modal-footer {
            align-items: flex-start;
            flex-direction: column;
        }

        .intern-modal-close-btn {
            width: 100%;
        }
    }

    @media (max-width: 420px) {

        .internship-hero {
            padding: 25px 18px;
        }

        .intern-hero-title {
            font-size: 25px;
        }

        .intern-hero-badge {
            font-size: 11px;
        }

        .internship-page-container {
            width: calc(100% - 18px);
        }

        .intern-sidebar {
            padding: 16px;
        }
    }
</style>


<div class="student-internship-page">

    <div class="internship-page-container">

        {{-- =====================================================
             HERO
        ====================================================== --}}

        <section class="internship-hero">

            <div class="intern-hero-grid">

                <div class="intern-hero-left">

                    <div class="intern-hero-badge">

                        <i class="bi bi-mortarboard-fill"></i>

                        {{ number_format($internships->total()) }}+
                        Internship Opportunities

                    </div>


                    <h1 class="intern-hero-title">

                        Start Your Career With
                        <span>Real-World Experience</span>

                    </h1>


                    <p class="intern-hero-text">

                        Discover internship opportunities from companies
                        looking for talented students and aspiring
                        professionals. Build your skills, gain experience
                        and take the first step toward your career.

                    </p>


                    {{-- SEARCH --}}

                    <form
                        method="GET"
                        action="{{ route('student.internships.index') }}"
                        class="intern-hero-search"
                    >

                        <div class="intern-search-field">

                            <i class="bi bi-search"></i>

                            <input
                                type="text"
                                name="search"
                                value="{{ request('search') }}"
                                placeholder="Internship title or keywords..."
                            >

                        </div>


                        <div class="intern-search-divider"></div>


                        <div class="intern-search-field">

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

                            Search Internships

                        </button>

                    </form>


                    {{-- POPULAR SEARCHES --}}

                    <div class="intern-popular-searches">

                        <span>Popular:</span>

                        @foreach([
                            'Web Developer',
                            'Flutter Developer',
                            'Data Analyst',
                            'UI/UX Designer'
                        ] as $tag)

                            <a
                                href="{{ route('student.internships.index', ['search' => $tag]) }}"
                            >
                                {{ $tag }}
                            </a>

                        @endforeach

                    </div>

                </div>


                {{-- HERO RIGHT --}}

                <div class="intern-hero-right">

                    <div class="intern-hero-visual">

                        <div class="intern-hero-circle"></div>


                        <div class="intern-hero-card">

                            <div class="intern-card-top">

                                <div class="intern-card-icon">

                                    <i class="bi bi-mortarboard-fill"></i>

                                </div>

                                <div class="intern-card-small"></div>

                            </div>


                            <div class="intern-visual-line w-85"></div>

                            <div class="intern-visual-line w-70"></div>

                            <div class="intern-visual-line w-50"></div>


                            <span class="intern-visual-tag"></span>

                        </div>


                        <div class="intern-visual-badge">

                            <i class="bi bi-person-workspace"></i>

                        </div>


                        <div class="intern-visual-check">

                            <i class="bi bi-check-lg"></i>

                        </div>

                    </div>


                    {{-- HERO FEATURES --}}

                    <div class="intern-hero-features">

                        <div class="intern-feature-item">

                            <div class="intern-feature-icon blue">

                                <i class="bi bi-search"></i>

                            </div>

                            <div>

                                <div class="intern-feature-title">

                                    Find the Right Internship

                                </div>

                                <div class="intern-feature-text">

                                    Discover opportunities that match
                                    your skills and interests

                                </div>

                            </div>

                        </div>


                        <div class="intern-feature-item">

                            <div class="intern-feature-icon purple">

                                <i class="bi bi-building"></i>

                            </div>

                            <div>

                                <div class="intern-feature-title">

                                    Learn From Employers

                                </div>

                                <div class="intern-feature-text">

                                    Gain practical experience from
                                    real companies and teams

                                </div>

                            </div>

                        </div>


                        <div class="intern-feature-item">

                            <div class="intern-feature-icon green">

                                <i class="bi bi-graph-up-arrow"></i>

                            </div>

                            <div>

                                <div class="intern-feature-title">

                                    Build Your Career

                                </div>

                                <div class="intern-feature-text">

                                    Develop valuable skills and prepare
                                    for your future career

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

        <div class="intern-stats">

            <div class="intern-stat-card">

                <div class="intern-stat-icon">

                    <i class="bi bi-mortarboard"></i>

                </div>

                <div>

                    <div class="intern-stat-value">

                        {{ number_format($internships->total()) }}

                    </div>

                    <div class="intern-stat-label">

                        Available Internships

                    </div>

                </div>

            </div>


            <div class="intern-stat-card">

                <div class="intern-stat-icon">

                    <i class="bi bi-building"></i>

                </div>

                <div>

                    <div class="intern-stat-value">

                        {{ $internships->count() }}

                    </div>

                    <div class="intern-stat-label">

                        Internships Showing

                    </div>

                </div>

            </div>


            <div class="intern-stat-card">

                <div class="intern-stat-icon">

                    <i class="bi bi-geo-alt"></i>

                </div>

                <div>

                    <div class="intern-stat-value">

                        {{ request('city') ? '1' : 'All' }}

                    </div>

                    <div class="intern-stat-label">

                        Location Search

                    </div>

                </div>

            </div>

        </div>


        {{-- =====================================================
             BODY
        ====================================================== --}}

        <div class="intern-body-grid">


            {{-- =================================================
                 FILTER SIDEBAR
            ================================================== --}}

            <aside class="intern-sidebar">

                <form
                    method="GET"
                    action="{{ route('student.internships.index') }}"
                >

                    <div class="intern-sidebar-header">

                        <div class="intern-sidebar-title">

                            <i class="bi bi-sliders"></i>

                            Filters

                        </div>


                        @if(request()->hasAny(['search', 'city']))

                            <a
                                href="{{ route('student.internships.index') }}"
                                class="intern-clear-filters"
                            >
                                Clear all
                            </a>

                        @endif

                    </div>


                    {{-- SEARCH --}}

                    <div class="intern-filter-block">

                        <div class="intern-filter-label">

                            Search Internships

                        </div>

                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Internship title or keyword..."
                            class="intern-filter-input"
                        >

                    </div>


                    {{-- LOCATION --}}

                    <div class="intern-filter-block">

                        <div class="intern-filter-label">

                            Location

                        </div>

                        <input
                            type="text"
                            name="city"
                            value="{{ request('city') }}"
                            placeholder="City..."
                            class="intern-filter-input"
                        >

                    </div>


                    <button
                        type="submit"
                        class="intern-filter-apply"
                    >

                        <i class="bi bi-search me-1"></i>

                        Apply Filters

                    </button>

                </form>


                {{-- QUICK LINKS --}}

                <div class="intern-quick-links">

                    <a
                        href="{{ route('student.internships.index') }}"
                        class="intern-quick-link"
                    >

                        <div class="intern-quick-icon blue">

                            <i class="bi bi-grid"></i>

                        </div>

                        <div class="intern-quick-content">

                            <span class="intern-quick-title">

                                All Internships

                            </span>

                            <span class="intern-quick-text">

                                Browse all opportunities

                            </span>

                        </div>

                    </a>


                    <a
                        href="{{ route('student.internships.index') }}"
                        class="intern-quick-link"
                    >

                        <div class="intern-quick-icon green">

                            <i class="bi bi-clock-history"></i>

                        </div>

                        <div class="intern-quick-content">

                            <span class="intern-quick-title">

                                Latest Internships

                            </span>

                            <span class="intern-quick-text">

                                Recently posted opportunities

                            </span>

                        </div>

                    </a>

                </div>

            </aside>


            {{-- =================================================
                 INTERNSHIP LIST
            ================================================== --}}

            <main class="internships-main">

                <div class="intern-section-header">

                    <div>

                        <h2 class="intern-section-heading">

                            Available Internships

                        </h2>

                        <p class="intern-section-subtitle">

                            Explore internships that can help you
                            gain valuable experience

                        </p>

                    </div>


                    <span class="intern-result-badge">

                        {{ number_format($internships->total()) }}

                        {{ Str::plural('internship', $internships->total()) }}

                    </span>

                </div>


                <div class="internship-list">

                    @forelse ($internships as $internship)

                        @php

                            $companyName =
                                $internship->employer->company_name
                                ?? $internship->employer->name
                                ?? 'Company';

                            $location = collect([
                                $internship->city,
                                $internship->state
                            ])
                            ->filter()
                            ->implode(', ');

                            $location =
                                $location
                                ?: 'Location not specified';

                            $internshipType =
                                $internship->internship_type
                                ? ucfirst(
                                    str_replace(
                                        '-',
                                        ' ',
                                        $internship->internship_type
                                    )
                                )
                                : null;

                        @endphp


                        {{-- =================================================
                             INTERNSHIP CARD
                        ================================================== --}}

                        <article class="student-internship-card">

                            <div class="internship-card-inner">


                                {{-- COMPANY AVATAR --}}

                                <div class="intern-company-avatar">

                                    {{ strtoupper(
                                        substr(
                                            $companyName,
                                            0,
                                            1
                                        )
                                    ) }}

                                </div>


                                <div class="internship-card-content">


                                    <div class="internship-card-top">


                                        <div style="min-width:0;">

                                            <div class="internship-title-row">

                                                <h3 class="internship-title">

                                                    {{ $internship->title }}

                                                </h3>


                                                @if($internshipType)

                                                    <span class="internship-type">

                                                        {{ $internshipType }}

                                                    </span>

                                                @endif

                                            </div>


                                            <p class="intern-company-location">

                                                <strong>
                                                    {{ $companyName }}
                                                </strong>

                                                <span class="intern-separator">
                                                    ·
                                                </span>

                                                {{ $location }}

                                            </p>

                                        </div>


                                        <span class="intern-posted-time">

                                            {{ $internship->created_at?->diffForHumans() }}

                                        </span>

                                    </div>


                                    {{-- TAGS --}}

                                    <div class="internship-tags">

                                        @if($internship->duration)

                                            <span class="internship-tag blue">

                                                <i class="bi bi-calendar3"></i>

                                                {{ $internship->duration }}

                                            </span>

                                        @endif


                                        @if($internship->city)

                                            <span class="internship-tag">

                                                <i class="bi bi-geo-alt"></i>

                                                {{ $internship->city }}

                                            </span>

                                        @endif


                                        @if($internshipType)

                                            <span class="internship-tag">

                                                <i class="bi bi-briefcase"></i>

                                                {{ $internshipType }}

                                            </span>

                                        @endif

                                    </div>


                                    {{-- BOTTOM --}}

                                    <div class="internship-card-bottom">


                                        @if($internship->stipend)

                                            <span class="intern-stipend">

                                                <i class="bi bi-cash-stack"></i>

                                                {{ $internship->stipend }}

                                            </span>

                                        @else

                                            <span class="intern-stipend muted">

                                                <i class="bi bi-dash-circle"></i>

                                                Stipend not disclosed

                                            </span>

                                        @endif


                                        <button
                                            type="button"
                                            class="intern-view-btn"
                                            onclick="openInternshipModal('internship-{{ $internship->id }}')"
                                        >

                                            View Details

                                            <i class="bi bi-arrow-right"></i>

                                        </button>

                                    </div>

                                </div>

                            </div>

                        </article>


                        {{-- =================================================
                             INTERNSHIP MODAL
                        ================================================== --}}

                        <div
                            class="internship-modal"
                            id="internship-{{ $internship->id }}"
                        >

                            <div class="intern-modal-box">


                                <button
                                    type="button"
                                    class="intern-modal-close"
                                    onclick="closeInternshipModal('internship-{{ $internship->id }}')"
                                    aria-label="Close"
                                >

                                    <i class="bi bi-x-lg"></i>

                                </button>


                                {{-- MODAL HEADER --}}

                                <div class="intern-modal-header">

                                    <div class="intern-modal-avatar">

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

                                            {{ $internship->title }}

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


                                {{-- INFORMATION --}}

                                <div class="intern-modal-info-grid">


                                    @if($internshipType)

                                        <div class="intern-info-box">

                                            <span>
                                                Internship Type
                                            </span>

                                            <strong>
                                                {{ $internshipType }}
                                            </strong>

                                        </div>

                                    @endif


                                    @if($internship->duration)

                                        <div class="intern-info-box">

                                            <span>
                                                Duration
                                            </span>

                                            <strong>
                                                {{ $internship->duration }}
                                            </strong>

                                        </div>

                                    @endif


                                    @if($internship->stipend)

                                        <div class="intern-info-box">

                                            <span>
                                                Stipend
                                            </span>

                                            <strong>
                                                {{ $internship->stipend }}
                                            </strong>

                                        </div>

                                    @endif


                                    @if($internship->city || $internship->state)

                                        <div class="intern-info-box">

                                            <span>
                                                Location
                                            </span>

                                            <strong>
                                                {{ $location }}
                                            </strong>

                                        </div>

                                    @endif


                                    <div class="intern-info-box full">

                                        <span>
                                            Company
                                        </span>

                                        <strong>
                                            {{ $companyName }}
                                        </strong>

                                    </div>

                                </div>


                                {{-- DESCRIPTION --}}

                                @if($internship->description)

                                    <div class="intern-modal-section">

                                        <h4>
                                            Internship Description
                                        </h4>

                                        <p>
                                            {{ $internship->description }}
                                        </p>

                                    </div>

                                @endif


                                {{-- FOOTER --}}

                                <div class="intern-modal-footer">

                                    <span class="intern-modal-posted">

                                        Posted
                                        {{ $internship->created_at?->diffForHumans() }}

                                    </span>


                                    <button
                                        type="button"
                                        class="intern-modal-close-btn"
                                        onclick="closeInternshipModal('internship-{{ $internship->id }}')"
                                    >

                                        Close

                                    </button>

                                </div>

                            </div>

                        </div>


                    @empty


                        {{-- EMPTY STATE --}}

                        <div class="intern-empty">

                            <div class="intern-empty-icon">

                                <i class="bi bi-mortarboard"></i>

                            </div>


                            <h3>
                                No internships found
                            </h3>


                            <p>

                                We couldn't find any internships
                                matching your search criteria.

                            </p>


                            <a
                                href="{{ route('student.internships.index') }}"
                            >

                                <i class="bi bi-grid"></i>

                                View All Internships

                            </a>

                        </div>


                    @endforelse

                </div>


                {{-- =================================================
                     PAGINATION
                ================================================== --}}

                @if($internships->hasPages())

                    <div class="intern-pagination">

                        {{ $internships->onEachSide(1)->appends(request()->query())->links() }}

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

    function openInternshipModal(id) {

        const modal = document.getElementById(id);

        if (!modal) {
            return;
        }

        modal.classList.add('active');

        document.body.style.overflow = 'hidden';
    }


    function closeInternshipModal(id) {

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
        .querySelectorAll('.internship-modal')
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
                    .querySelectorAll('.internship-modal.active')
                    .forEach(function(modal) {

                        modal.classList.remove('active');

                    });

                document.body.style.overflow = '';

            }

        }
    );

</script>

@endsection