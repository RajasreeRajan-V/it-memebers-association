@extends('layouts.app')

@section('content')

@push('styles')
<style>
    /* =========================================================
       ARTICLES INDEX - REDESIGNED TO MATCH TRAININGS UI
       Same design language as Trainings & Workshops page:
       soft blue/purple palette, card panels, CSS-drawn hero
       illustration.

       LAYOUT UPDATE:
       - Left column  : Filters (Categories, Popular Tags)
       - Middle column: Browse Articles (main list) — its own section
       - Right column : Quick Actions, Trending, Tips
       ========================================================= */

    :root {
        --art-primary: #3376F2;
        --art-primary-dark: #245FD0;
        --art-purple: #7257E8;

        --art-green: #22B573;
        --art-orange: #F5A623;
        --art-red: #EF5350;

        --art-bg: #F7F9FD;
        --art-white: #FFFFFF;

        --art-text: #17213A;
        --art-text-dark: #1F2937;
        --art-muted: #7B879A;
        --art-light-muted: #9CA3AF;

        --art-border: #E8EDF5;

        --art-radius: 13px;
        --art-shadow: 0 4px 15px rgba(35, 61, 105, .035);
    }

    .art-page {
        width: 100%;
        min-height: 100vh;
        background: var(--art-bg);
        color: var(--art-text);
        font-family: inherit;
        padding-bottom: 40px;
        padding-left: 28px;
        padding-right: 28px;
        font-size: 15px;
    }

    .art-page .container-fluid {
        width: 100%;
        max-width: 1800px;
        margin: 0 auto;
        padding-left: 0 !important;
        padding-right: 0 !important;
    }

    /* =========================================================
       ALERT
       ========================================================= */

    .art-alert {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 13px 17px;
        border-radius: 10px;
        margin-bottom: 16px;
        font-size: 14px;
        font-weight: 600;
        color: #16764C;
        background: #EAF9F1;
        border: 1px solid #CBEEDC;
    }

    /* Grid: filter sidebar (fixed) + main list (flex) + right sidebar (fixed) */
    .art-row {
        display: grid;
        grid-template-columns: 260px minmax(0, 1fr) 340px;
        gap: 20px;
        width: 100%;
        align-items: start;
    }

    .art-col-filter, .art-col-main, .art-col-side { width: 100%; min-width: 0; }
    .art-col-filter > .card:not(:last-child) { margin-bottom: 18px !important; }
    .art-col-side > .card:not(:last-child) { margin-bottom: 18px !important; }

    .art-col-filter { position: sticky; top: 16px; }


    /* =========================================================
       HERO
       ========================================================= */

    .art-hero {
        position: relative;
        overflow: hidden;
        min-height: 300px;
        border: 1px solid #E9EDF6;
        border-radius: 22px;
        background:
            radial-gradient(circle at 78% 28%, rgba(117, 88, 232, .08), transparent 28%),
            radial-gradient(circle at 93% 80%, rgba(51, 118, 242, .08), transparent 30%),
            linear-gradient(110deg, #FFFFFF 0%, #FBFCFF 55%, #F5F7FF 100%);
        box-shadow: 0 5px 20px rgba(35, 61, 105, .055);
        padding: 34px 38px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 30px;
    }

    .art-hero::before {
        content: "";
        position: absolute;
        width: 310px;
        height: 310px;
        right: -75px;
        top: -110px;
        border: 1px dashed rgba(51, 118, 242, .15);
        border-radius: 50%;
    }

    .art-hero::after {
        content: "";
        position: absolute;
        width: 190px;
        height: 190px;
        right: 150px;
        bottom: -135px;
        border-radius: 50%;
        background: rgba(114, 87, 232, .055);
    }

    .art-hero-content {
        position: relative;
        z-index: 3;
        width: 55%;
    }

    .art-breadcrumb {
        display: flex;
        align-items: center;
        gap: 7px;
        margin-bottom: 14px;
        color: var(--art-primary);
        font-size: 13px;
        font-weight: 700;
    }

    .art-breadcrumb span {
        color: #9BA5B5;
    }

    .art-hero-title {
        margin: 0;
        font-size: 36px;
        line-height: 1.2;
        font-weight: 800;
        letter-spacing: -.7px;
        color: #17213A;
    }

    .art-hero-title .blue {
        color: var(--art-primary);
    }

    .art-hero-description {
        max-width: 570px;
        margin: 12px 0 20px;
        color: #7A8495;
        font-size: 15px;
        line-height: 1.65;
    }

    .art-hero-actions {
        margin-bottom: 22px;
    }

    .art-hero-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 9px;
        padding: 12px 24px;
        background: var(--art-primary);
        color: #ffffff;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 700;
        text-decoration: none;
        box-shadow: 0 6px 14px rgba(51, 118, 242, .25);
        transition: all .2s ease;
        border: none;
    }

    .art-hero-btn:hover {
        background: var(--art-primary-dark);
        color: #ffffff;
        transform: translateY(-1px);
    }

    /* Hero stats */
    .art-hero-stats {
        display: flex;
        gap: 12px;
    }

    .art-mini-stat {
        display: flex;
        align-items: center;
        gap: 10px;
        min-width: 145px;
        padding: 11px 14px;
        border: 1px solid #E8EDF5;
        background: rgba(255,255,255,.88);
        border-radius: 9px;
        box-shadow: 0 5px 14px rgba(35,61,105,.04);
    }

    .art-mini-icon {
        width: 34px;
        height: 34px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 7px;
        background: #EEF4FF;
        color: var(--art-primary);
        font-size: 14px;
    }

    .art-mini-stat.orange .art-mini-icon {
        background: #FFF6E7;
        color: var(--art-orange);
    }

    .art-mini-stat.green .art-mini-icon {
        background: #EAF9F2;
        color: var(--art-green);
    }

    .art-mini-value {
        margin: 0;
        font-size: 20px;
        line-height: 1;
        font-weight: 800;
        color: #25304A;
    }

    .art-mini-label {
        margin: 4px 0 0;
        font-size: 12px;
        color: #8993A4;
    }

    /* =========================================================
       HERO VISUAL - article feed / reading screen
       ========================================================= */

    .art-hero-visual {
        position: relative;
        z-index: 2;
        width: 45%;
        height: 235px;
        flex-shrink: 0;
    }

    .art-visual-circle {
        position: absolute;
        width: 210px;
        height: 210px;
        right: 55px;
        top: 5px;
        border-radius: 50%;
        background: linear-gradient(145deg, #F2EEFF, #EEF5FF);
    }

    .art-visual-screen {
        position: absolute;
        z-index: 4;
        left: 34%;
        top: 22px;
        width: 150px;
        height: 100px;
        background: linear-gradient(145deg, #1E293B, #111827);
        border-radius: 10px;
        box-shadow: 0 16px 30px rgba(20, 30, 55, .28);
        padding: 10px 12px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        gap: 6px;
    }

    .art-screen-live {
        position: absolute;
        top: 8px;
        left: 8px;
        display: flex;
        align-items: center;
        gap: 5px;
        padding: 3px 7px;
        border-radius: 999px;
        background: rgba(51, 118, 242, .18);
        color: #8FB4FF;
        font-size: 8px;
        font-weight: 800;
        letter-spacing: .05em;
    }

    .art-live-dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: #3376F2;
    }

    .art-screen-line {
        height: 5px;
        border-radius: 3px;
        background: rgba(255,255,255,.16);
        margin-top: 18px;
    }
    .art-screen-line.w1 { width: 85%; }
    .art-screen-line.w2 { width: 60%; }
    .art-screen-line.w3 { width: 72%; margin-top: 6px; }

    .art-visual-stand {
        position: absolute;
        z-index: 3;
        left: calc(34% + 62px);
        top: 122px;
        width: 26px;
        height: 16px;
        background: #CBD5E5;
        border-radius: 0 0 6px 6px;
    }

    .art-visual-audience {
        position: absolute;
        z-index: 5;
        left: 30%;
        bottom: 20px;
        display: flex;
        align-items: center;
    }

    .art-aud-avatar {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        border: 2px solid #fff;
        margin-left: -9px;
        box-shadow: 0 4px 10px rgba(35, 61, 105, .12);
    }

    .art-aud-avatar.one {
        background: linear-gradient(145deg, #7A4EE8, #9A70FF);
        margin-left: 0;
    }

    .art-aud-avatar.two {
        background: linear-gradient(145deg, #2770DF, #408AF5);
    }

    .art-aud-avatar.three {
        background: linear-gradient(145deg, #22B573, #4CD68C);
    }

    .art-aud-more {
        margin-left: -9px;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        border: 2px solid #fff;
        background: #EEF4FF;
        color: var(--art-primary);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 9px;
        font-weight: 800;
        box-shadow: 0 4px 10px rgba(35, 61, 105, .12);
    }

    .art-visual-card {
        position: absolute;
        z-index: 8;
        min-width: 120px;
        padding: 9px 12px;
        background: rgba(255,255,255,.94);
        border: 1px solid #E7ECF5;
        border-radius: 9px;
        box-shadow: 0 7px 18px rgba(48, 67, 103, .08);
    }

    .art-visual-card small {
        display: block;
        color: #7B8799;
        font-size: 11px;
        margin-bottom: 3px;
    }

    .art-visual-card strong {
        color: #25304A;
        font-size: 12px;
        font-weight: 800;
    }

    .art-visual-card i {
        color: var(--art-primary);
        margin-right: 4px;
    }

    .art-visual-card.card-one {
        left: 0;
        top: 10px;
    }

    .art-visual-card.card-two {
        right: 0;
        top: 30px;
    }

    .art-visual-card.card-three {
        right: 6%;
        bottom: 10px;
    }


    /* =========================================================
       CARDS
       ========================================================= */

    .art-card {
        background: #ffffff;
        border: 1px solid var(--art-border) !important;
        border-radius: var(--art-radius);
        box-shadow: var(--art-shadow);
        overflow: hidden;
    }

    .art-col-main .card-header {
        padding: 18px 16px !important;
    }

    .art-col-main .card-header h2 {
        font-size: 17px !important;
        color: #1F2937;
        font-weight: 700 !important;
    }

    .art-section-title {
        display: flex;
        align-items: center;
        gap: 9px;
        font-size: 17px;
        font-weight: 700;
        color: #1F2937;
        margin: 0 0 2px;
    }

    .art-section-title i {
        color: var(--art-primary);
    }

    .art-section-sub {
        font-size: 12.5px;
        color: #8993A4;
        margin: 0;
    }

    /* Search */
    .art-search {
        width: 100%;
        border: 1px solid #E2E6ED;
        border-radius: 8px;
        overflow: hidden;
    }

    .art-search .input-group-text {
        border: 0 !important;
        background: #ffffff !important;
        padding-left: 10px;
        padding-right: 6px;
    }

    .art-search .form-control {
        border: 0 !important;
        box-shadow: none !important;
        height: 42px;
        font-size: 14px;
        color: #374151;
    }

    .art-search .form-control::placeholder {
        color: #9CA3AF;
        font-size: 13px;
    }

    /* ---- Article list item ---- */
    .art-article-item {
        padding: 15px 14px !important;
        border-bottom: 1px solid #F0F2F5 !important;
        transition: background .15s ease;
        background: #ffffff;
        cursor: pointer;
    }

    .art-article-item:hover {
        background: #F8FAFF;
    }

    .art-article-item .fw-semibold {
        font-size: 15px;
        color: #1F2937;
    }

    .art-article-item .small {
        font-size: 13px;
    }

    .art-item-thumb {
        width: 56px;
        height: 56px;
        object-fit: cover;
        border-radius: 10px;
    }

    .art-item-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        font-size: 20px;
        width: 56px;
        height: 56px;
    }

    .art-tag {
        display: inline-flex;
        align-items: center;
        padding: 4px 10px;
        border-radius: 5px;
        font-size: 11px;
        font-weight: 600;
        white-space: nowrap;
    }

    .art-tag-0 { background: #EEF4FF; color: var(--art-primary); }
    .art-tag-1 { background: #EAF9F2; color: var(--art-green); }
    .art-tag-2 { background: #F3EFFF; color: var(--art-purple); }

    /* ---- 3-dot row actions ---- */
    .art-row-actions-wrap {
        position: relative;
    }

    .art-row-actions-btn {
        width: 30px;
        height: 30px;
        border: none;
        background: #F3F4F6;
        border-radius: 8px;
        color: #6B7280;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
    }

    .art-row-actions-btn:hover {
        background: #EEF4FF;
        color: var(--art-primary);
    }

    .art-row-actions-menu {
        display: none;
        position: absolute;
        right: 0;
        top: calc(100% + 6px);
        background: #fff;
        border: 1px solid #E7EAF0;
        border-radius: 10px;
        box-shadow: var(--art-shadow);
        min-width: 200px;
        z-index: 20;
        overflow: hidden;
    }

    .art-row-actions-menu.open {
        display: block;
    }

    .art-row-menu-item {
        display: flex;
        align-items: center;
        gap: 10px;
        width: 100%;
        padding: 10px 14px;
        font-size: 13px;
        color: #374151;
        text-decoration: none;
        background: none;
        border: none;
        text-align: left;
        cursor: pointer;
    }

    .art-row-menu-item:hover {
        background: #F8FAFF;
        color: var(--art-primary);
    }

    .art-row-menu-danger {
        color: var(--art-red);
    }

    .art-row-menu-danger:hover {
        background: #FFF0F2;
        color: var(--art-red);
    }

    /* ---- Side / Filter cards ---- */
    .art-side-card {
        width: 100%;
        position: relative;
        overflow: hidden;
    }

    .art-side-card-accent {
        height: 3px;
        width: 100%;
        background: var(--art-primary);
    }

    .art-side-card .card-body {
        padding: 18px !important;
    }

    .art-side-label {
        display: flex;
        align-items: center;
        gap: 8px;
        color: #374151;
        font-size: 13px;
        font-weight: 700;
        margin-bottom: 15px !important;
    }

    .art-side-label i {
        color: var(--art-primary);
    }

    .art-side-card h3 {
        font-size: 14px !important;
        color: #1F2937;
        font-weight: 700;
    }

    .art-side-link {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        color: var(--art-primary);
        font-size: 12px;
        font-weight: 700;
        text-decoration: none;
    }

    .art-side-link:hover {
        color: var(--art-primary-dark);
    }

    .art-side-link-sm {
        font-size: 11px;
    }

    /* Quick actions */
    .art-quick-action {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px;
        border-radius: 10px;
        text-decoration: none;
        margin-bottom: 8px;
        transition: background .15s ease;
    }

    .art-quick-action:last-child {
        margin-bottom: 0;
    }

    .art-quick-action:hover {
        background: #F8FAFF;
    }

    .art-qa-icon {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 15px;
        flex-shrink: 0;
    }

    .art-qa-text {
        display: flex;
        flex-direction: column;
        font-size: 13px;
        font-weight: 600;
        color: #1F2937;
    }

    .art-qa-text small {
        font-size: 11.5px;
        font-weight: 400;
        color: #6B7280;
    }

    /* Overview / filter list (Categories) */
    .art-overview-list {
        margin: 0;
        padding: 0;
        list-style: none;
    }

    .art-overview-list li {
        margin-bottom: 4px !important;
    }

    .art-overview-list li:last-child {
        margin-bottom: 0 !important;
    }

    .art-filter-link {
        display: flex;
        align-items: center;
        gap: 10px;
        width: 100%;
        color: #374151;
        font-size: 13px;
        font-weight: 500;
        text-decoration: none;
        padding: 8px 9px;
        border-radius: 8px;
        transition: background .15s ease, color .15s ease;
    }

    .art-filter-link:hover {
        background: #F8FAFF;
        color: var(--art-primary);
    }

    .art-filter-link.active {
        background: #EEF4FF;
        color: var(--art-primary);
        font-weight: 700;
    }

    .art-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        flex-shrink: 0;
    }

    .art-count {
        margin-left: auto;
        font-weight: 700;
        color: #1F2937;
        font-size: 12px;
    }

    .art-filter-link.active .art-count {
        color: var(--art-primary);
    }

    /* Categories dropdown (filter sidebar) */
    .art-category-select-wrap {
        position: relative;
    }

    .art-category-select {
        width: 100%;
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        background: #F8FAFF;
        border: 1px solid #E2E6ED;
        border-radius: 9px;
        padding: 11px 34px 11px 14px;
        font-size: 13.5px;
        font-weight: 600;
        color: #1F2937;
        cursor: pointer;
        transition: border-color .15s ease, box-shadow .15s ease;
    }

    .art-category-select:hover {
        border-color: #C9D6EF;
    }

    .art-category-select:focus {
        outline: none;
        border-color: var(--art-primary);
        box-shadow: 0 0 0 3px rgba(51, 118, 242, .12);
    }

    .art-category-select-wrap::after {
        content: "";
        position: absolute;
        right: 14px;
        top: 50%;
        width: 8px;
        height: 8px;
        border-right: 2px solid #7B879A;
        border-bottom: 2px solid #7B879A;
        transform: translateY(-70%) rotate(45deg);
        pointer-events: none;
    }

    .art-category-count-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 20px;
        height: 20px;
        padding: 0 6px;
        border-radius: 999px;
        background: #EEF4FF;
        color: var(--art-primary);
        font-size: 11px;
        font-weight: 700;
        margin-left: 8px;
        vertical-align: middle;
    }

    /* Popular tags (filter sidebar) */
    .art-popular-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
    }

    .art-popular-tags a {
        display: inline-block;
        padding: 4px 12px;
        border-radius: 999px;
        background: #F3F4F6;
        color: #6B7280;
        font-size: 12px;
        font-weight: 500;
        text-decoration: none;
        transition: all .15s ease;
    }

    .art-popular-tags a:hover,
    .art-popular-tags a.active {
        background: #EEF4FF;
        color: var(--art-primary);
    }

    /* Clear filters */
    .art-clear-filters {
        display: block;
        text-align: center;
        font-size: 12px;
        font-weight: 700;
        color: var(--art-muted);
        text-decoration: none;
        padding: 8px;
        border-radius: 8px;
        border: 1px dashed #E2E6ED;
        margin-top: 14px;
        transition: all .15s ease;
    }

    .art-clear-filters:hover {
        color: var(--art-red);
        border-color: #FFD2D6;
        background: #FFF7F7;
    }

    /* ---- Pagination ---- */
    .art-col-main .pagination {
        justify-content: center;
        margin: 10px 0;
    }

    .art-col-main .pagination .page-link {
        font-size: 13px;
        border-radius: 6px;
        margin: 0 2px;
        color: var(--art-primary);
    }

    .art-col-main .pagination .active .page-link {
        background: var(--art-primary);
        border-color: var(--art-primary);
        color: #ffffff;
    }

    /* =========================================================
       ARTICLE MODAL - Updated to match trainings modal
       ========================================================= */

    .art-modal-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(17, 24, 39, .55);
        align-items: center;
        justify-content: center;
        z-index: 1050;
        padding: 20px;
        overscroll-behavior: contain;
    }

    .art-modal-overlay.open {
        display: flex;
    }

    .art-modal {
        width: 100%;
        max-width: 620px;
        max-height: 88vh;
        overflow-y: auto;
        background: #fff;
        border-radius: var(--art-radius);
        box-shadow: var(--art-shadow);
        position: relative;
    }

    .art-modal-close {
        position: absolute;
        top: 14px;
        right: 14px;
        width: 32px;
        height: 32px;
        border: none;
        background: rgba(255,255,255,.9);
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        z-index: 2;
        color: #374151;
        box-shadow: 0 2px 6px rgba(0,0,0,.15);
    }

    .art-modal-cover {
        width: 100%;
        height: 200px;
        overflow: hidden;
        border-radius: var(--art-radius) var(--art-radius) 0 0;
    }

    .art-modal-cover img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .art-modal-body {
        padding: 24px;
    }

    .art-modal-body .modal-body-text {
        white-space: pre-line;
    }

    .art-modal-meta-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(130px, 1fr));
        gap: 10px;
        margin: 16px 0;
    }

    .art-modal-meta-item {
        background: #F8FAFF;
        border-radius: 10px;
        padding: 10px 14px;
    }

    .art-modal-meta-item .label {
        display: block;
        font-size: 10px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: #9CA3AF;
        margin-bottom: 2px;
    }

    .art-modal-meta-item .value {
        font-size: 14px;
        font-weight: 600;
        color: #1F2937;
    }

    .art-modal-like-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 14px;
        border: none;
        background: transparent;
        font-size: 14px;
        font-weight: 600;
        color: #6B7280;
        cursor: pointer;
        border-radius: 6px;
        transition: all .15s ease;
    }

    .art-modal-like-btn:hover {
        background: #FFF0F2;
        color: #EF5350;
    }

    .art-modal-like-btn.liked {
        color: #EF5350;
    }

    .art-modal-like-btn .like-icon {
        width: 18px;
        height: 18px;
    }

    /* ---- Comments in modal ---- */
    .art-comment-form {
        display: flex;
        gap: 10px;
        margin: 12px 0 16px;
    }

    .art-comment-form textarea {
        flex: 1;
        border: 1px solid #E2E6ED;
        border-radius: 8px;
        padding: 8px 12px;
        font-size: 13px;
        resize: vertical;
        min-height: 50px;
        outline: none;
        transition: border-color .15s ease;
    }

    .art-comment-form textarea:focus {
        border-color: var(--art-primary);
        box-shadow: 0 0 0 3px rgba(51, 118, 242, .1);
    }

    .art-comment-form button {
        padding: 8px 18px;
        background: var(--art-primary);
        color: #fff;
        border: none;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: background .15s ease;
        align-self: flex-end;
    }

    .art-comment-form button:hover {
        background: var(--art-primary-dark);
    }

    .art-comment-item {
        display: flex;
        gap: 10px;
        padding: 10px 0;
        border-bottom: 1px solid #F0F2F5;
    }

    .art-comment-item:last-child {
        border-bottom: none;
    }

    .art-comment-avatar {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: #EEF4FF;
        color: var(--art-primary);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        font-weight: 700;
        flex-shrink: 0;
    }

    .art-comment-body .name {
        font-size: 13px;
        font-weight: 600;
        color: #1F2937;
    }

    .art-comment-body .date {
        font-size: 11px;
        color: #9CA3AF;
        margin-left: 8px;
    }

    .art-comment-body .text {
        font-size: 13px;
        color: #4B5563;
        margin-top: 2px;
        line-height: 1.5;
    }

    /* =========================================================
       RESPONSIVE
       ========================================================= */

    @media (min-width: 1500px) {
        .art-row {
            grid-template-columns: 280px minmax(0, 1fr) 380px;
            gap: 24px;
        }
        .art-hero-title { font-size: 40px; }
    }

    @media (max-width: 1200px) {
        .art-page {
            padding-left: 20px;
            padding-right: 20px;
        }
        .art-row {
            grid-template-columns: 230px minmax(0, 1fr) 300px;
            gap: 16px;
        }
        .art-hero-title { font-size: 30px; }
        .art-hero-content { width: 62%; }
        .art-hero-visual { width: 38%; }
    }

    @media (max-width: 991px) {
        .art-row {
            grid-template-columns: 1fr;
        }
        .art-col-filter { order: 1; position: static; }
        .art-col-main   { order: 2; }
        .art-col-side   { order: 3; }

        .art-hero {
            flex-direction: column;
            min-height: auto;
            padding: 26px 24px;
        }

        .art-hero-content {
            width: 100%;
            text-align: center;
        }

        .art-hero-description {
            max-width: 100%;
        }

        .art-hero-actions {
            display: flex;
            justify-content: center;
        }

        .art-hero-stats {
            justify-content: center;
        }

        .art-hero-visual {
            opacity: .25;
            width: 70%;
        }
    }

    @media (max-width: 767px) {
        .art-page {
            font-size: 14px;
            padding-left: 12px;
            padding-right: 12px;
        }

        .art-hero {
            padding: 22px 18px;
        }
        .art-hero-title { font-size: 26px; }
        .art-hero-description { font-size: 13px; }

        .art-hero-stats {
            flex-direction: column;
            width: 100%;
        }

        .art-mini-stat {
            min-width: 100%;
        }

        .art-hero-visual {
            display: none;
        }

        .art-article-item .fw-semibold {
            font-size: 14px;
        }
        .art-article-item .small {
            font-size: 12px;
        }
        .art-item-thumb, .art-item-icon {
            width: 44px;
            height: 44px;
        }

        .art-modal-meta-grid {
            grid-template-columns: 1fr 1fr;
        }
    }

    @media (max-width: 480px) {
        .art-page {
            font-size: 13px;
        }
        .art-hero-title { font-size: 22px; }
        .art-hero-description { font-size: 12px; }
        .art-hero-btn {
            width: 100%;
        }
        .art-modal-meta-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush


@php

    /*
    |--------------------------------------------------------------------------
    | FALLBACK DATA
    |--------------------------------------------------------------------------
    */

    $categories = $categories ?? [
        ['slug' => null, 'label' => 'All Articles', 'count' => 0],
        ['slug' => 'software-development', 'label' => 'Software Development', 'count' => 0],
        ['slug' => 'web-development', 'label' => 'Web Development', 'count' => 0],
        ['slug' => 'mobile-development', 'label' => 'Mobile Development', 'count' => 0],
        ['slug' => 'ui-ux-design', 'label' => 'UI/UX Design', 'count' => 0],
        ['slug' => 'qa-testing', 'label' => 'QA & Testing', 'count' => 0],
        ['slug' => 'devops-cloud', 'label' => 'DevOps & Cloud', 'count' => 0],
        ['slug' => 'data-science', 'label' => 'Data Science', 'count' => 0],
        ['slug' => 'data-analytics', 'label' => 'Data Analytics', 'count' => 0],
        ['slug' => 'artificial-intelligence', 'label' => 'Artificial Intelligence', 'count' => 0],
        ['slug' => 'machine-learning', 'label' => 'Machine Learning', 'count' => 0],
        ['slug' => 'cybersecurity', 'label' => 'Cybersecurity', 'count' => 0],
        ['slug' => 'database', 'label' => 'Database Administration', 'count' => 0],
        ['slug' => 'networking', 'label' => 'Networking', 'count' => 0],
        ['slug' => 'system-administration', 'label' => 'System Administration', 'count' => 0],
        ['slug' => 'it-support', 'label' => 'IT Support & Help Desk', 'count' => 0],
        ['slug' => 'project-management', 'label' => 'Project Management', 'count' => 0],
        ['slug' => 'product-management', 'label' => 'Product Management', 'count' => 0],
        ['slug' => 'business-analysis', 'label' => 'Business Analysis', 'count' => 0],
        ['slug' => 'erp-crm', 'label' => 'ERP & CRM', 'count' => 0],
        ['slug' => 'blockchain', 'label' => 'Blockchain', 'count' => 0],
        ['slug' => 'game-development', 'label' => 'Game Development', 'count' => 0],
        ['slug' => 'iot-embedded', 'label' => 'Embedded Systems & IoT', 'count' => 0],
        ['slug' => 'technical-writing', 'label' => 'Technical Writing', 'count' => 0],
        ['slug' => 'programming-languages', 'label' => 'Programming Languages', 'count' => 0],
        ['slug' => 'frameworks', 'label' => 'Frameworks', 'count' => 0],
        ['slug' => 'apis', 'label' => 'API Development', 'count' => 0],
        ['slug' => 'open-source', 'label' => 'Open Source', 'count' => 0],
        ['slug' => 'software-architecture', 'label' => 'Software Architecture', 'count' => 0],
        ['slug' => 'career-advice', 'label' => 'Career Advice', 'count' => 0],
        ['slug' => 'interview-preparation', 'label' => 'Interview Preparation', 'count' => 0],
    ];

    $demoArticles = collect([
        (object)[
            'id' => 1,
            'title' => 'Building Scalable Web Apps with React.js and TypeScript',
            'excerpt' => 'Learn how to build and structure large-scale web applications using React and TypeScript, with performance and maintainability best practices baked in from the start.',
            'body' => 'Learn how to build and structure large-scale web applications using React and TypeScript, with performance and maintainability best practices baked in from the start.',
            'category' => 'Web Development',
            'category_slug' => 'web-development',
            'author' => 'John Doe',
            'published_at' => now()->subDays(2),
            'read_minutes' => 8,
            'views_count' => 3200,
            'likes_count' => 128,
            'comments_count' => 24,
            'image' => 'https://picsum.photos/seed/article1/480/280',
            'comments' => collect(),
        ],
        (object)[
            'id' => 2,
            'title' => '10 Soft Skills That Make You Stand Out at Work',
            'excerpt' => 'Technical skills get you the interview, but soft skills get you the promotion.',
            'body' => 'Technical skills get you the interview, but soft skills get you the promotion.',
            'category' => 'Career Advice',
            'category_slug' => 'career-advice',
            'author' => 'Sarah Wilson',
            'published_at' => now()->subDays(4),
            'read_minutes' => 6,
            'views_count' => 2100,
            'likes_count' => 96,
            'comments_count' => 18,
            'image' => 'https://picsum.photos/seed/article2/480/280',
            'comments' => collect(),
        ],
        (object)[
            'id' => 3,
            'title' => "A Beginner's Guide to Machine Learning",
            'excerpt' => 'New to ML? This guide covers the basics of machine learning.',
            'body' => 'New to ML? This guide covers the basics of machine learning.',
            'category' => 'AI / Machine Learning',
            'category_slug' => 'ai-ml',
            'author' => 'Michael Chen',
            'published_at' => now()->subDays(7),
            'read_minutes' => 10,
            'views_count' => 4300,
            'likes_count' => 210,
            'comments_count' => 41,
            'image' => 'https://picsum.photos/seed/article3/480/280',
            'comments' => collect(),
        ],
        (object)[
            'id' => 4,
            'title' => 'How to Validate Your Startup Idea in 7 Simple Steps',
            'excerpt' => 'Validate early, build faster.',
            'body' => 'Validate early, build faster with these seven practical steps.',
            'category' => 'Startup Advice',
            'category_slug' => 'startup-advice',
            'author' => 'Radhika Rao',
            'published_at' => now()->subDays(9),
            'read_minutes' => 7,
            'views_count' => 1800,
            'likes_count' => 74,
            'comments_count' => 12,
            'image' => 'https://picsum.photos/seed/article4/480/280',
            'comments' => collect(),
        ],
    ]);

    $articles = $articles ?? $demoArticles;

    $trendingArticles = $trendingArticles
        ?? $demoArticles->sortByDesc('views_count')->values();

    $activeTab = $activeTab ?? 'all';
    $activeCategory = $activeCategory ?? null;
    $activeTag = $activeTag ?? request('q');
    $sort = $sort ?? 'latest';

    $totalArticlesCount = method_exists($articles, 'total') ? $articles->total() : $articles->count();
    $categoriesCount = collect($categories)->filter(fn ($c) => $c['slug'])->count();
    $newThisWeek = $categories[0]['count'] ?? 48;

    $iconPalette = ['art-tag-0', 'art-tag-1', 'art-tag-2'];

    $popularTags = ['Career Advice', 'Web Development', 'Machine Learning', 'AI', 'DevOps', 'Cybersecurity', 'Data Science', 'Cloud Computing'];

    $hasActiveFilters = !empty($activeCategory) || !empty($activeTag);

    // Check if user is mentor - FIX: Use your actual role check
    $isMentor = auth()->check() && (
        auth()->user()->role === 'mentor' || 
        auth()->user()->is_mentor === true ||
        (method_exists(auth()->user(), 'hasRole') && auth()->user()->hasRole('mentor'))
    );

@endphp


<div class="art-page">
    <div class="container-fluid px-3 px-md-4 py-4">

        @if (session('success'))
            <div class="art-alert">
                <i class="fa-solid fa-circle-check"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif


        {{-- =========================================================
             HERO
        ========================================================== --}}

        <section class="art-hero">

            <div class="art-hero-content">

                <div class="art-breadcrumb">
                    <i class="fa-solid fa-house"></i>
                    <span>›</span>
                    Articles
                </div>

                <h1 class="art-hero-title">
                    Discover.
                    <br>
                    <span class="blue">Learn. Grow.</span>
                </h1>

                <p class="art-hero-description">
                    Explore expert insights, tutorials, career advice &amp; industry trends
                    published by employers &amp; professionals like you.
                </p>



                <div class="art-hero-stats">

                    <div class="art-mini-stat">
                        <div class="art-mini-icon"><i class="fa-solid fa-newspaper"></i></div>
                        <div>
                            <p class="art-mini-value">{{ $totalArticlesCount }}</p>
                            <p class="art-mini-label">Total Articles</p>
                        </div>
                    </div>

                    <div class="art-mini-stat orange">
                        <div class="art-mini-icon"><i class="fa-solid fa-layer-group"></i></div>
                        <div>
                            <p class="art-mini-value">{{ $categoriesCount }}</p>
                            <p class="art-mini-label">Categories</p>
                        </div>
                    </div>

                    <div class="art-mini-stat green">
                        <div class="art-mini-icon"><i class="fa-solid fa-arrow-trend-up"></i></div>
                        <div>
                            <p class="art-mini-value">{{ $newThisWeek }}+</p>
                            <p class="art-mini-label">New This Week</p>
                        </div>
                    </div>

                </div>

            </div>


            {{-- Decorative illustration: an article feed / reading screen --}}

            <div class="art-hero-visual">

                <div class="art-visual-circle"></div>

                <div class="art-visual-card card-one">
                    <small><i class="fa-regular fa-bookmark"></i>Just Published</small>
                    <strong>New Article Live</strong>
                </div>

                <div class="art-visual-card card-two">
                    <small><i class="fa-regular fa-eye"></i>Views</small>
                    <strong>3.2K Reads</strong>
                </div>

                <div class="art-visual-card card-three">
                    <small><i class="fa-solid fa-circle-check"></i>Status</small>
                    <strong>Trending</strong>
                </div>

                <div class="art-visual-screen">
                    <div class="art-screen-live">
                        <span class="art-live-dot"></span>
                        READING
                    </div>
                    <div class="art-screen-line w1"></div>
                    <div class="art-screen-line w2"></div>
                    <div class="art-screen-line w3"></div>
                </div>
                <div class="art-visual-stand"></div>

                <div class="art-visual-audience">
                    <span class="art-aud-avatar one"></span>
                    <span class="art-aud-avatar two"></span>
                    <span class="art-aud-avatar three"></span>
                    <span class="art-aud-more">+39</span>
                </div>

            </div>

        </section>


        {{-- =========================================================
             MAIN GRID: Filters (left) | Browse Articles (middle) | Sidebar (right)
        ========================================================== --}}

        <div class="art-row">

            {{-- ---- LEFT COLUMN: FILTERS (Categories + Popular Tags) ---- --}}
            <div class="art-col-filter">

                {{-- Categories Filter (dropdown) --}}
                <div class="card art-card art-side-card border-0 mb-4">
                    <div class="art-side-card-accent"></div>
                    <div class="card-body">
                        <p class="art-side-label mb-3"><i class="fa-solid fa-layer-group"></i> Categories</p>

                        <div class="art-category-select-wrap">
                            <select class="art-category-select" id="artCategorySelect" aria-label="Filter by category">
                                @foreach ($categories as $cat)
                                    @php
                                        $isActive = $cat['slug']
                                            ? ($activeCategory === $cat['slug'])
                                            : empty($activeCategory);
                                        $optionUrl = $cat['slug']
                                            ? route('mentor.articles.index', ['category' => $cat['slug']])
                                            : route('mentor.articles.index');
                                    @endphp
                                    <option value="{{ $optionUrl }}" {{ $isActive ? 'selected' : '' }}>
                                        {{ $cat['label'] }}{{ $cat['count'] ? ' (' . $cat['count'] . ')' : '' }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                {{-- Popular Tags Filter --}}
                <div class="card art-card art-side-card border-0 mb-4">
                    <div class="art-side-card-accent"></div>
                    <div class="card-body">
                        <p class="art-side-label mb-3"><i class="fa-solid fa-tags"></i> Popular Tags</p>
                        <div class="art-popular-tags">
                            @foreach ($popularTags as $tag)
                                <a href="{{ route('mentor.articles.index', ['q' => $tag]) }}#browse-articles"
                                   class="{{ $activeTag === $tag ? 'active' : '' }}">{{ $tag }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>

                @if ($hasActiveFilters)
                    <a href="{{ route('mentor.articles.index') }}#browse-articles" class="art-clear-filters">
                        <i class="fa-solid fa-xmark me-1"></i> Clear all filters
                    </a>
                @endif

            </div>


            {{-- ---- MIDDLE COLUMN: BROWSE ARTICLES SECTION ---- --}}
            <div class="art-col-main">

                <section id="browse-articles" class="card art-card border-0 mb-4">
                    <div class="card-header bg-white border-0 pb-3 pt-3 px-3">
                        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                            <div>
                                <h2 class="art-section-title mb-0">
                                    <i class="fa-regular fa-newspaper"></i> Browse Articles
                                </h2>
                                <p class="art-section-sub">{{ $totalArticlesCount }} article{{ $totalArticlesCount === 1 ? '' : 's' }} found</p>
                            </div>

                            <form method="GET" action="{{ route('mentor.articles.index') }}" class="flex-grow-1 max-w-sm">
                                @if(!empty($activeCategory))
                                    <input type="hidden" name="category" value="{{ $activeCategory }}">
                                @endif
                                <div class="input-group input-group-sm art-search">
                                    <span class="input-group-text bg-white border-end-0">
                                        <i class="fa-solid fa-magnifying-glass text-muted"></i>
                                    </span>
                                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Search articles..."
                                           class="form-control border-start-0 ps-0">
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="list-group list-group-flush">

                        @forelse ($articles as $index => $article)

                            @php
                                $accent = $iconPalette[$index % count($iconPalette)];
                                $liked = in_array($article->id, $likedArticleIds ?? []);
                                $authorName = is_string($article->author ?? null)
                                    ? $article->author
                                    : ($article->author->name ?? 'Unknown Author');
                            @endphp

                            <div class="list-group-item py-3 border-0 border-bottom art-article-item"
                                 role="button" tabindex="0"
                                 onclick="artOpenArticleModal(this)"
                                 onkeydown="if(event.key==='Enter'){artOpenArticleModal(this)}"
                                 data-article-id="{{ $article->id }}"
                                 data-title="{{ $article->title }}"
                                 data-excerpt="{{ $article->excerpt }}"
                                 data-body="{{ $article->body }}"
                                 data-category="{{ $article->category }}"
                                 data-author="{{ $authorName }}"
                                 data-published="{{ optional($article->published_at)->diffForHumans() ?? 'Draft' }}"
                                 data-read-minutes="{{ $article->read_minutes ?? 5 }}"
                                 data-views="{{ number_format($article->views_count ?? 0) }}"
                                 data-likes="{{ $article->likes_count ?? 0 }}"
                                 data-comments-count="{{ $article->comments_count ?? 0 }}"
                                 data-image="{{ $article->image ?? '' }}"
                                 data-liked="{{ $liked ? '1' : '0' }}">

                                <div class="d-flex align-items-start gap-3">

                                    @if($article->image ?? false)
                                        <img src="{{ $article->image }}" class="art-item-thumb flex-shrink-0" alt="">
                                    @else
                                        <div class="art-item-icon {{ $accent }} flex-shrink-0">
                                            <i class="fa-solid fa-file-lines"></i>
                                        </div>
                                    @endif

                                    <div class="flex-grow-1 min-w-0">
                                        <div class="d-flex justify-content-between align-items-start gap-2">
                                            <p class="fw-semibold mb-0 text-truncate">{{ $article->title }}</p>
                                        </div>

                                        <p class="small text-muted mb-1 text-truncate">
                                            {{ $authorName }} · {{ $article->read_minutes ?? 5 }} min read
                                        </p>

                                        <div class="d-flex flex-wrap gap-1 align-items-center">
                                            <span class="art-tag {{ $accent }}">{{ $article->category }}</span>
                                            <span class="small text-muted ms-1">
                                                <i class="fa-regular fa-eye"></i> {{ number_format($article->views_count ?? 0) }}
                                            </span>
                                            <span class="small text-muted ms-1">
                                                <i class="fa-regular fa-heart"></i> {{ $article->likes_count ?? 0 }}
                                            </span>
                                            <span class="small text-muted ms-1">
                                                <i class="fa-regular fa-comment"></i> {{ $article->comments_count ?? 0 }}
                                            </span>
                                        </div>
                                    </div>

                                    <div class="art-row-actions-wrap flex-shrink-0" onclick="event.stopPropagation()">
                                        <button type="button" class="art-row-actions-btn" onclick="artToggleRowMenu(this)" aria-label="Row actions">
                                            <i class="fa-solid fa-ellipsis"></i>
                                        </button>
                                        <div class="art-row-actions-menu">
                                            <button type="button" class="art-row-menu-item" onclick="artOpenArticleFromMenu(this)" data-article-id="{{ $article->id }}">
                                                <i class="fa-regular fa-eye"></i> Read
                                            </button>
                                            @if($isMentor)

                                                <form action="" method="POST"
                                                      onsubmit="return confirm('Delete &quot;{{ $article->title }}&quot;? This cannot be undone.');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="art-row-menu-item art-row-menu-danger">
                                                        <i class="fa-regular fa-trash-can"></i> Delete
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                        @empty

                            <div class="text-center text-muted py-5">
                                No articles found. Try a different search or filter.
                                @if($isMentor)
                                    <br><a href="">Write your first article</a>
                                @endif
                            </div>

                        @endforelse

                    </div>

                    @if (isset($articles) && method_exists($articles, 'links') && $articles->hasPages())
                        <div class="card-footer bg-white text-center border-0">
                            {{ $articles->links() }}
                        </div>
                    @endif
                </section>
            </div>


            {{-- ---- RIGHT COLUMN: Quick Actions, Trending, Tips ---- --}}
            <div class="art-col-side">

                {{-- Quick Actions --}}
                <div class="card art-card art-side-card border-0 mb-4">
                    <div class="art-side-card-accent"></div>
                    <div class="card-body">
                        <p class="art-side-label mb-3"><i class="fa-solid fa-bolt"></i> Quick Actions</p>

                        @if($isMentor)
                            
                        @endif

                        <a href="{{ route('mentor.articles.index', ['tab' => 'all']) }}#browse-articles" class="art-quick-action">
                            <span class="art-qa-icon art-tag-0"><i class="fa-regular fa-newspaper"></i></span>
                            <span class="art-qa-text">
                                All Articles
                                <small>Browse all published content</small>
                            </span>
                        </a>
                        <a href="{{ route('mentor.articles.index', ['sort' => 'most-viewed']) }}#browse-articles" class="art-quick-action">
                            <span class="art-qa-icon art-tag-1"><i class="fa-solid fa-fire"></i></span>
                            <span class="art-qa-text">
                                Most Viewed
                                <small>See what's popular right now</small>
                            </span>
                        </a>
                        <a href="{{ route('mentor.articles.index', ['sort' => 'most-liked']) }}#browse-articles" class="art-quick-action">
                            <span class="art-qa-icon art-tag-2"><i class="fa-regular fa-heart"></i></span>
                            <span class="art-qa-text">
                                Most Liked
                                <small>Reader favorites</small>
                            </span>
                        </a>
                    </div>
                </div>

                {{-- Trending Articles --}}
                <div class="card art-card art-side-card border-0 mb-4">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3 border-0">
                        <h3 class="h6 fw-semibold mb-0">
                            <i class="fa-solid fa-fire me-2" style="color:var(--art-orange);"></i>Trending
                        </h3>
                        <a href="{{ route('mentor.articles.index', ['sort' => 'most-viewed']) }}#browse-articles" class="art-side-link art-side-link-sm">View All</a>
                    </div>
                    <div class="list-group list-group-flush">
                        @forelse ($trendingArticles->take(4) as $t)
                            <div class="list-group-item py-3 border-0 border-bottom art-article-item"
                                 role="button" tabindex="0"
                                 onclick="artOpenArticleModal(this)"
                                 onkeydown="if(event.key==='Enter'){artOpenArticleModal(this)}"
                                 data-article-id="{{ $t->id }}"
                                 data-title="{{ $t->title }}"
                                 data-excerpt="{{ $t->excerpt }}"
                                 data-body="{{ $t->body }}"
                                 data-category="{{ $t->category }}"
                                 data-author="{{ is_string($t->author ?? null) ? $t->author : ($t->author->name ?? 'Unknown') }}"
                                 data-published="{{ optional($t->published_at)->diffForHumans() }}"
                                 data-read-minutes="{{ $t->read_minutes ?? 5 }}"
                                 data-views="{{ number_format($t->views_count ?? 0) }}"
                                 data-likes="{{ $t->likes_count ?? 0 }}"
                                 data-comments-count="{{ $t->comments_count ?? 0 }}"
                                 data-image="{{ $t->image ?? '' }}"
                                 data-liked="0">

                                <div class="d-flex align-items-center gap-2">
                                    @if($t->image ?? false)
                                        <img src="{{ $t->image }}" class="rounded-3 flex-shrink-0" width="40" height="40" style="object-fit:cover;" alt="">
                                    @else
                                        <span class="art-item-icon art-tag-0 flex-shrink-0" style="width:40px;height:40px;font-size:13px;">
                                            <i class="fa-solid fa-file-lines"></i>
                                        </span>
                                    @endif
                                    <div class="flex-grow-1 min-w-0">
                                        <p class="small fw-semibold mb-0 text-truncate">{{ \Illuminate\Support\Str::limit($t->title, 32) }}</p>
                                        <p class="small text-muted mb-0 text-truncate">
                                            {{ $t->read_minutes ?? 5 }} min read · {{ number_format($t->views_count ?? 0) }} views
                                        </p>
                                    </div>
                                    <span class="art-tag art-tag-1 flex-shrink-0" style="font-size:10px;padding:2px 8px;">{{ $t->category }}</span>
                                </div>
                            </div>
                        @empty
                            <div class="list-group-item text-center text-muted py-4 small border-0">No trending articles.</div>
                        @endforelse
                    </div>
                </div>

                {{-- Tips --}}
                <div class="card art-card art-side-card border-0">
                    <div class="art-side-card-accent"></div>
                    <div class="card-body">
                        <p class="art-side-label mb-3"><i class="fa-regular fa-lightbulb"></i> Tips for Readers</p>
                        <ul class="tr-tips-list small text-muted mb-0" style="padding-left:18px;margin:0;line-height:1.7;">
                            <li>Bookmark articles you find valuable</li>
                            <li>Engage with authors through comments</li>
                            <li>Share insights with your network</li>
                            <li>Follow topics that interest you</li>
                            <li>Check back daily for fresh content</li>
                        </ul>
                    </div>
                </div>

            </div>

        </div>

    </div>
</div>


{{-- =============================================================
     ARTICLE MODAL
============================================================= --}}

<div class="art-modal-overlay" id="artModalOverlay" onclick="artCloseModal(event)">
    <div class="art-modal" onclick="event.stopPropagation()">
        <button type="button" class="art-modal-close" onclick="artCloseModal()" aria-label="Close">
            <i class="fa-solid fa-xmark"></i>
        </button>

        <div class="art-modal-cover" id="artModalCover" style="display:none;"></div>

        <div class="art-modal-body">
            <span class="art-tag mb-3 d-inline-flex" id="artModalCategory">Category</span>

            <h2 id="artModalTitle" class="h5 fw-semibold mb-2"></h2>

            <p class="small text-muted mb-3">
                By <span id="artModalAuthor"></span> · <span id="artModalDate"></span>
            </p>

            <div class="art-modal-meta-grid">
                <div class="art-modal-meta-item">
                    <span class="label">Read Time</span>
                    <span class="value" id="artModalReadTime">5 min read</span>
                </div>
                <div class="art-modal-meta-item">
                    <span class="label">Views</span>
                    <span class="value" id="artModalViews">0</span>
                </div>
                <div class="art-modal-meta-item">
                    <span class="label">Likes</span>
                    <button type="button" class="art-modal-like-btn" id="artModalLikeBtn" data-article-id="">
                        <svg class="like-icon" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none">
                            <path d="M20.8 4.6a5.5 5.5 0 0 0-7.8 0L12 5.6l-1-1a5.5 5.5 0 1 0-7.8 7.8l1 1L12 21l7.8-7.6 1-1a5.5 5.5 0 0 0 0-7.8z"/>
                        </svg>
                        <span class="like-count" id="artModalLikeCount">0</span>
                    </button>
                </div>
                <div class="art-modal-meta-item">
                    <span class="label">Comments</span>
                    <span class="value" id="artModalCommentsCount">0</span>
                </div>
            </div>

            <div id="artModalBody" class="modal-body-text text-base text-slate-700 leading-relaxed mb-4"></div>

            {{-- Comments Section --}}
            <div class="pt-2 border-top border-slate-100">
                <h4 class="text-xs font-semibold tracking-widest text-slate-400 uppercase mb-3">Comments</h4>

                <form class="art-comment-form" id="artModalCommentForm" data-article-id="">
                    @csrf
                    <textarea name="body" rows="2" required maxlength="1000" placeholder="Write a comment..."></textarea>
                    <button type="submit">Post</button>
                </form>

                <div id="artModalCommentList" class="space-y-0">
                    <!-- Comments rendered by JS -->
                </div>
            </div>
        </div>
    </div>
</div>


{{-- =============================================================
     JAVASCRIPT
============================================================= --}}

@push('scripts')

<script>
document.addEventListener('DOMContentLoaded', function () {

    console.log('Articles JavaScript loaded');


    /* ============================================================
       CSRF
    ============================================================ */

    const csrfMeta = document.querySelector('meta[name="csrf-token"]');
    const csrfToken = csrfMeta ? csrfMeta.getAttribute('content') : null;

    if (!csrfToken) {
        console.error('CSRF token not found!');
    }


    /* ============================================================
       CATEGORIES DROPDOWN
    ============================================================ */

    document.getElementById('artCategorySelect')?.addEventListener('change', function () {
        if (this.value) {
            window.location.href = this.value + '#browse-articles';
        }
    });


    /* ============================================================
       3-DOT ROW MENU
    ============================================================ */

    window.artToggleRowMenu = function (btn) {
        const menu = btn.nextElementSibling;
        const isOpen = menu.classList.contains('open');
        document.querySelectorAll('.art-row-actions-menu.open').forEach(m => m.classList.remove('open'));
        if (!isOpen) menu.classList.add('open');
    };

    document.addEventListener('click', function (e) {
        if (!e.target.closest('.art-row-actions-wrap')) {
            document.querySelectorAll('.art-row-actions-menu.open').forEach(m => m.classList.remove('open'));
        }
    });


    /* ============================================================
       ARTICLE MODAL - Open from menu
    ============================================================ */

    window.artOpenArticleFromMenu = function (btn) {
        const articleId = btn.dataset.articleId;
        if (articleId) {
            const item = document.querySelector(`.art-article-item[data-article-id="${articleId}"]`);
            if (item) {
                artOpenArticleModal(item);
            }
        }
    };


    /* ============================================================
       ARTICLE MODAL - Open from item
    ============================================================ */

    window.artOpenArticleModal = function (card) {
        const d = card.dataset;

        // Set basic info
        document.getElementById('artModalTitle').textContent = d.title || 'Untitled';
        document.getElementById('artModalCategory').textContent = d.category || 'Uncategorized';
        document.getElementById('artModalCategory').className = 'art-tag mb-3 d-inline-flex ' +
            (['art-tag-0', 'art-tag-1', 'art-tag-2'][Math.floor(Math.random() * 3)] || 'art-tag-0');
        document.getElementById('artModalAuthor').textContent = d.author || 'Unknown Author';
        document.getElementById('artModalDate').textContent = d.published || 'Just now';
        document.getElementById('artModalReadTime').textContent = (d.readMinutes || 5) + ' min read';
        document.getElementById('artModalViews').textContent = d.views || '0';
        document.getElementById('artModalLikeCount').textContent = d.likes || '0';
        document.getElementById('artModalCommentsCount').textContent = d.commentsCount || '0';

        // Body content
        document.getElementById('artModalBody').textContent = d.body || d.excerpt || 'No content available.';

        // Image
        const coverEl = document.getElementById('artModalCover');
        if (d.image) {
            coverEl.style.display = 'block';
            coverEl.innerHTML = '<img src="' + d.image + '" alt="">';
        } else {
            coverEl.style.display = 'none';
            coverEl.innerHTML = '';
        }

        // Like button
        const likeBtn = document.getElementById('artModalLikeBtn');
        const isLiked = d.liked === '1';
        likeBtn.dataset.articleId = d.articleId;
        likeBtn.dataset.liked = isLiked ? '1' : '0';
        updateModalLikeButton(isLiked);

        // Comment form
        const commentForm = document.getElementById('artModalCommentForm');
        commentForm.dataset.articleId = d.articleId;
        commentForm.querySelector('textarea').value = '';

        // Comment list - fetch from server or use placeholder
        const commentList = document.getElementById('artModalCommentList');
        // Try to fetch real comments
        fetchComments(d.articleId, commentList);

        // Open modal
        document.getElementById('artModalOverlay').classList.add('open');
        document.body.style.overflow = 'hidden';
    };


    /* ============================================================
       FETCH COMMENTS FOR MODAL
    ============================================================ */

    async function fetchComments(articleId, container) {
        if (!articleId) return;

        try {
            const response = await fetch('/mentor/articles/' + articleId + '/comments', {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                credentials: 'same-origin'
            });

            if (!response.ok) throw new Error('Failed to fetch comments');

            const data = await response.json();

            if (data.comments && data.comments.length) {
                container.innerHTML = data.comments.map(function(c) {
                    const name = c.user_name || c.user?.name || 'Unknown User';
                    const initial = name.charAt(0).toUpperCase();
                    const date = c.created_at || 'Just now';
                    return `
                        <div class="art-comment-item">
                            <div class="art-comment-avatar">${initial}</div>
                            <div class="art-comment-body">
                                <span class="name">${name}</span>
                                <span class="date">${date}</span>
                                <div class="text">${c.body || ''}</div>
                            </div>
                        </div>
                    `;
                }).join('');
            } else {
                container.innerHTML = '<p class="text-sm text-slate-400">No comments yet — be the first to share your thoughts.</p>';
            }
        } catch (error) {
            console.error('Error fetching comments:', error);
            container.innerHTML = '<p class="text-sm text-slate-400">Could not load comments.</p>';
        }
    }


    /* ============================================================
       MODAL LIKE
    ============================================================ */

    function updateModalLikeButton(liked) {
        const btn = document.getElementById('artModalLikeBtn');
        const icon = btn.querySelector('.like-icon');

        if (liked) {
            btn.classList.add('liked');
            btn.dataset.liked = '1';
            if (icon) icon.setAttribute('fill', 'currentColor');
        } else {
            btn.classList.remove('liked');
            btn.dataset.liked = '0';
            if (icon) icon.setAttribute('fill', 'none');
        }
    }

    document.getElementById('artModalLikeBtn')?.addEventListener('click', async function (e) {
        e.stopPropagation();
        const articleId = this.dataset.articleId;
        if (!articleId) return;
        if (this.dataset.loading === '1') return;

        this.dataset.loading = '1';

        try {
            const response = await fetch('/mentor/articles/' + articleId + '/like', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                credentials: 'same-origin'
            });

            if (!response.ok) throw new Error('Like failed');

            const data = await response.json();
            const liked = !!data.liked;

            // Update modal like
            updateModalLikeButton(liked);
            document.getElementById('artModalLikeCount').textContent = data.likes_count || 0;

            // Update all like buttons on the page
            document.querySelectorAll(`.art-article-item .like-btn, .art-modal-like-btn`).forEach(function(btn) {
                const count = btn.querySelector('.like-count');
                if (count) count.textContent = data.likes_count || 0;
            });

        } catch (error) {
            console.error('Like failed:', error);
        } finally {
            this.dataset.loading = '0';
        }
    });


    /* ============================================================
       CLOSE MODAL
    ============================================================ */

    window.artCloseModal = function (e) {
        if (e && e.target !== e.currentTarget) return;
        document.getElementById('artModalOverlay').classList.remove('open');
        document.body.style.overflow = '';
    };

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            const overlay = document.getElementById('artModalOverlay');
            if (overlay.classList.contains('open')) artCloseModal();
        }
    });


    /* ============================================================
       MODAL COMMENT SUBMIT
    ============================================================ */

    document.getElementById('artModalCommentForm')?.addEventListener('submit', async function (e) {
        e.preventDefault();
        const articleId = this.dataset.articleId;
        const textarea = this.querySelector('textarea');
        const body = textarea.value.trim();
        const submitBtn = this.querySelector('button[type="submit"]');

        if (!body) { alert('Please enter a comment.'); textarea.focus(); return; }
        if (!csrfToken) { alert('CSRF token missing.'); return; }

        submitBtn.disabled = true;
        submitBtn.textContent = 'Posting...';

        try {
            const formData = new FormData();
            formData.append('body', body);

            const response = await fetch('/mentor/articles/' + articleId + '/comments', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                credentials: 'same-origin',
                body: formData
            });

            if (!response.ok) {
                if (response.status === 401) { alert('Please login to comment.'); return; }
                if (response.status === 422) {
                    const errors = await response.json();
                    alert(Object.values(errors.errors || {}).flat().join(' ') || 'Please check your comment.');
                    return;
                }
                throw new Error('Comment failed');
            }

            const data = await response.json();

            // Add comment to list
            const list = document.getElementById('artModalCommentList');
            const emptyMsg = list.querySelector('.text-slate-400');
            if (emptyMsg) emptyMsg.remove();

            const name = data.user_name || data.user?.name || 'You';
            const initial = name.charAt(0).toUpperCase();
            const date = data.created_at || 'Just now';

            const commentHtml = `
                <div class="art-comment-item">
                    <div class="art-comment-avatar">${initial}</div>
                    <div class="art-comment-body">
                        <span class="name">${name}</span>
                        <span class="date">${date}</span>
                        <div class="text">${data.body || body}</div>
                    </div>
                </div>
            `;
            list.insertAdjacentHTML('afterbegin', commentHtml);

            // Update comment count
            const newCount = data.comments_count || data.comment_count;
            if (newCount !== undefined) {
                document.getElementById('artModalCommentsCount').textContent = newCount;
                document.querySelectorAll('.art-article-item .comment-count, .art-modal-meta-item .comment-count')
                    .forEach(el => el.textContent = newCount);
            }

            textarea.value = '';

        } catch (error) {
            console.error('Comment failed:', error);
            alert('Something went wrong.');
        } finally {
            submitBtn.disabled = false;
            submitBtn.textContent = 'Post';
        }
    });


    /* ============================================================
       SCROLL TO ARTICLES
    ============================================================ */

    if (window.location.hash === '#browse-articles') {
        setTimeout(function () {
            const target = document.getElementById('browse-articles');
            if (target) target.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }, 150);
    }

});
</script>

@endpush

@endsection