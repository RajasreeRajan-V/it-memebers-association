@extends('layouts.app')

@section('content')

<style>
    :root {
        --mr-primary: #3376F2;
        --mr-primary-dark: #245FD0;
        --mr-purple: #7257E8;
        --mr-text: #17213A;
        --mr-muted: #7B879A;
        --mr-border: #E8EDF5;
        --mr-bg: #F7F9FD;
        --mr-white: #FFFFFF;
        --mr-green: #22B573;
        --mr-orange: #F5A623;
        --mr-red: #EF5350;
        --mr-light-blue: #EEF4FF;
        --mr-light-purple: #F3EFFF;
        --mr-shadow: 0 5px 20px rgba(35, 61, 105, .055);
    }

    * {
        box-sizing: border-box;
    }

    .mentorship-page {
        width: 100%;
        min-height: 100vh;
        background: var(--mr-bg);
        color: var(--mr-text);
        font-family: inherit;
        padding: 24px 28px 50px;
        font-size: 15px;
    }

    .mentorship-container {
        width: 100%;
        max-width: 1450px;
        margin: 0 auto;
    }

    /* =========================================================
       ALERTS
    ========================================================= */

    .mr-alert {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 13px 17px;
        border-radius: 10px;
        margin-bottom: 16px;
        font-size: 14px;
        font-weight: 600;
    }

    .mr-alert.success {
        color: #16764C;
        background: #EAF9F1;
        border: 1px solid #CBEEDC;
    }

    .mr-alert.error {
        color: #B4233E;
        background: #FFF0F2;
        border: 1px solid #FFD4DB;
    }

    /* =========================================================
       HERO
    ========================================================= */

    .mr-hero {
        position: relative;
        overflow: hidden;
        min-height: 280px;
        border: 1px solid #E9EDF6;
        border-radius: 22px;
        background:
            radial-gradient(circle at 78% 28%, rgba(117, 88, 232, .08), transparent 28%),
            radial-gradient(circle at 93% 80%, rgba(51, 118, 242, .08), transparent 30%),
            linear-gradient(110deg, #FFFFFF 0%, #FBFCFF 55%, #F5F7FF 100%);
        box-shadow: var(--mr-shadow);
        padding: 34px 38px;
        margin-bottom: 20px;
    }

    .mr-hero::before {
        content: "";
        position: absolute;
        width: 310px;
        height: 310px;
        right: -75px;
        top: -110px;
        border: 1px dashed rgba(51, 118, 242, .15);
        border-radius: 50%;
    }

    .mr-hero::after {
        content: "";
        position: absolute;
        width: 190px;
        height: 190px;
        right: 150px;
        bottom: -135px;
        border-radius: 50%;
        background: rgba(114, 87, 232, .055);
    }

    .mr-hero-content {
        position: relative;
        z-index: 3;
        width: 54%;
    }

    .mr-breadcrumb {
        display: flex;
        align-items: center;
        gap: 7px;
        margin-bottom: 14px;
        color: var(--mr-primary);
        font-size: 13px;
        font-weight: 700;
    }

    .mr-breadcrumb span {
        color: #9BA5B5;
    }

    .mr-hero-title {
        margin: 0;
        font-size: 36px;
        line-height: 1.2;
        font-weight: 800;
        letter-spacing: -.7px;
        color: #17213A;
    }

    .mr-hero-title .blue {
        color: var(--mr-primary);
    }

    .mr-hero-title .purple {
        color: var(--mr-purple);
    }

    .mr-hero-description {
        max-width: 570px;
        margin: 12px 0 22px;
        color: #7A8495;
        font-size: 15px;
        line-height: 1.65;
    }

    /* =========================================================
       HERO VISUAL — MENTORSHIP ROADMAP (NO HUMAN FIGURES)
    ========================================================= */

    .mr-hero-visual {
        position: absolute;
        z-index: 2;
        right: 24px;
        top: 18px;
        width: 43%;
        height: 225px;
    }

    .visual-circle {
        position: absolute;
        width: 205px;
        height: 205px;
        right: 78px;
        top: 4px;
        border-radius: 50%;
        background: linear-gradient(145deg, #F2EEFF, #EEF5FF);
        box-shadow: inset 0 0 0 1px rgba(114,87,232,.04);
    }

    .visual-orbit {
        position: absolute;
        width: 235px;
        height: 150px;
        right: 62px;
        top: 27px;
        border: 1px dashed rgba(51,118,242,.18);
        border-radius: 50%;
        transform: rotate(-16deg);
    }

    .visual-node {
        position: absolute;
        z-index: 5;
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 13px;
        background: #fff;
        border: 1px solid #E5EBF5;
        box-shadow: 0 8px 20px rgba(48,67,103,.10);
    }

    .visual-node i {
        font-size: 18px;
    }

    .visual-node.node-book {
        left: 29%;
        bottom: 35px;
        color: var(--mr-primary);
        background: #EEF4FF;
    }

    .visual-node.node-target {
        right: 25%;
        bottom: 25px;
        color: var(--mr-purple);
        background: #F3EFFF;
    }

    .visual-node.node-check {
        right: 8%;
        top: 91px;
        color: var(--mr-green);
        background: #EAF9F2;
    }

    .visual-connection {
        position: absolute;
        z-index: 3;
        height: 2px;
        border-radius: 10px;
        transform-origin: left center;
        background: linear-gradient(90deg, rgba(51,118,242,.20), rgba(114,87,232,.55));
    }

    .connection-one {
        width: 88px;
        left: 37%;
        top: 151px;
        transform: rotate(-31deg);
    }

    .connection-two {
        width: 82px;
        left: 48%;
        top: 158px;
        transform: rotate(24deg);
    }

    .connection-three {
        width: 68px;
        left: 67%;
        top: 128px;
        transform: rotate(-35deg);
    }

    .visual-roadmap {
        position: absolute;
        z-index: 4;
        left: 38%;
        top: 72px;
        width: 112px;
        height: 84px;
        border-radius: 18px;
        background: linear-gradient(145deg, #FFFFFF, #F7F9FF);
        border: 1px solid #E2E8F3;
        box-shadow: 0 10px 25px rgba(48,67,103,.10);
        padding: 13px;
    }

    .roadmap-line {
        height: 7px;
        border-radius: 8px;
        margin-bottom: 9px;
        background: #E8EDF7;
    }

    .roadmap-line.short {
        width: 62%;
    }

    .roadmap-line.blue {
        width: 82%;
        background: #DCE8FF;
    }

    .roadmap-progress {
        position: relative;
        height: 6px;
        margin-top: 12px;
        border-radius: 8px;
        background: #EDF1F7;
        overflow: hidden;
    }

    .roadmap-progress::after {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        width: 72%;
        height: 100%;
        border-radius: inherit;
        background: linear-gradient(90deg, #3376F2, #7257E8);
    }

    .visual-card {
        position: absolute;
        z-index: 8;
        min-width: 128px;
        padding: 9px 12px;
        background: rgba(255,255,255,.96);
        border: 1px solid #E7ECF5;
        border-radius: 9px;
        box-shadow: 0 7px 18px rgba(48,67,103,.08);
    }

    .visual-card small {
        display: block;
        color: #7B8799;
        font-size: 11px;
        margin-bottom: 3px;
    }

    .visual-card strong {
        color: #25304A;
        font-size: 12px;
        font-weight: 800;
    }

    .visual-card i {
        color: var(--mr-primary);
        margin-right: 4px;
    }

    .visual-card.card-one {
        left: 3%;
        top: 24px;
    }

    .visual-card.card-two {
        right: 1%;
        top: 17px;
    }

    .visual-card.card-three {
        right: 4%;
        bottom: 14px;
    }

    .visual-star {
        position: absolute;
        z-index: 6;
        color: #F5A623;
        font-size: 12px;
    }

    .visual-star.one { left: 23%; top: 83px; }
    .visual-star.two { right: 28%; top: 51px; font-size: 9px; }
    .visual-star.three { right: 14%; bottom: 64px; font-size: 10px; }

    /* =========================================================
       HERO STATS
    ========================================================= */

    .mr-hero-stats {
        display: flex;
        gap: 12px;
    }

    .mr-mini-stat {
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

    .mr-mini-icon {
        width: 34px;
        height: 34px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 7px;
        background: #EEF4FF;
        color: var(--mr-primary);
        font-size: 14px;
    }

    .mr-mini-stat.green .mr-mini-icon {
        background: #EAF9F2;
        color: var(--mr-green);
    }

    .mr-mini-stat.purple .mr-mini-icon {
        background: #F2EDFF;
        color: var(--mr-purple);
    }

    .mr-mini-value {
        margin: 0;
        font-size: 20px;
        line-height: 1;
        font-weight: 800;
        color: #25304A;
    }

    .mr-mini-label {
        margin: 4px 0 0;
        font-size: 12px;
        color: #8993A4;
    }

    /* =========================================================
       MAIN LAYOUT
    ========================================================= */

    .mr-main-layout {
        display: grid;
        grid-template-columns: 220px minmax(0, 1fr) 240px;
        gap: 16px;
        align-items: start;
    }

    .mr-panel {
        background: #FFFFFF;
        border: 1px solid var(--mr-border);
        border-radius: 13px;
        box-shadow: 0 4px 15px rgba(35, 61, 105, .035);
    }

    /* =========================================================
       FILTER SIDEBAR
    ========================================================= */

    .mr-filter {
        padding: 18px;
    }

    .mr-filter-title {
        display: flex;
        align-items: center;
        gap: 8px;
        margin: 0 0 17px;
        font-size: 15px;
        font-weight: 800;
        color: #26314A;
    }

    .mr-filter-title i {
        color: var(--mr-primary);
        font-size: 14px;
    }

    .mr-filter-label {
        display: block;
        margin: 0 0 9px;
        color: #6F7A8D;
        font-size: 12px;
        font-weight: 700;
    }

    .mr-filter-group {
        margin-bottom: 18px;
    }

    .mr-check {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 10px;
        color: #697487;
        font-size: 13px;
        cursor: pointer;
    }

    .mr-check input {
        width: 14px;
        height: 14px;
        margin: 0;
        accent-color: var(--mr-primary);
    }

    .mr-select {
        width: 100%;
        height: 38px;
        padding: 0 10px;
        border: 1px solid #E2E7EF;
        border-radius: 7px;
        background: #fff;
        color: #687487;
        font-size: 13px;
        outline: none;
    }

    .mr-filter-btn {
        width: 100%;
        min-height: 38px;
        border: 1px solid #D8E3F8;
        border-radius: 7px;
        background: #F5F8FF;
        color: var(--mr-primary);
        font-size: 13px;
        font-weight: 800;
        cursor: pointer;
    }

    /* =========================================================
       REQUESTS PANEL
    ========================================================= */

    .mr-requests-panel {
        overflow: hidden;
    }

    .mr-request-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        padding: 16px 18px;
        border-bottom: 1px solid #EDF0F5;
    }

    .mr-request-heading h2 {
        margin: 0 0 4px;
        color: #202B43;
        font-size: 18px;
        font-weight: 800;
    }

    .mr-request-heading p {
        margin: 0;
        color: #929BAB;
        font-size: 12px;
    }

    .mr-search-sort {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .mr-search {
        position: relative;
    }

    .mr-search input {
        width: 210px;
        height: 38px;
        padding: 0 34px 0 12px;
        border: 1px solid #E2E7EF;
        border-radius: 7px;
        outline: none;
        font-size: 13px;
        color: #526075;
    }

    .mr-search i {
        position: absolute;
        right: 11px;
        top: 12px;
        color: #A0A8B6;
        font-size: 13px;
    }

    .mr-sort {
        height: 38px;
        padding: 0 9px;
        border: 1px solid #E2E7EF;
        border-radius: 7px;
        color: #667286;
        background: #fff;
        font-size: 13px;
    }

    /* =========================================================
       REQUEST ROW
    ========================================================= */

    .mr-request-row {
        display: grid;
        grid-template-columns: 210px minmax(200px, 1fr) 170px 110px;
        gap: 14px;
        align-items: center;
        min-height: 110px;
        padding: 15px 18px;
        border-bottom: 1px solid #EEF1F5;
        transition: background .15s ease;
    }

    .mr-request-row:last-child {
        border-bottom: 0;
    }

    .mr-request-row:hover {
        background: #FBFCFF;
    }

    .mr-student {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        min-width: 0;
    }

    .mr-avatar {
        width: 46px;
        height: 46px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: linear-gradient(145deg, #EEF4FF, #E5ECFF);
        color: var(--mr-primary);
        font-size: 14px;
        font-weight: 800;
        overflow: hidden;
    }

    .mr-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .mr-student-info {
        min-width: 0;
    }

    .mr-student-name {
        margin: 0 0 3px;
        color: #25304A;
        font-size: 14px;
        font-weight: 800;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .mr-student-role {
        margin: 0 0 5px;
        color: #7D8798;
        font-size: 12px;
    }

    .mr-student-location {
        color: #98A1AF;
        font-size: 12px;
    }

    .mr-student-location i {
        color: var(--mr-primary);
        margin-right: 4px;
    }

    .mr-goal {
        min-width: 0;
    }

    .mr-goal-text {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        margin: 0 0 8px;
        color: #586376;
        font-size: 13px;
        line-height: 1.5;
    }

    .mr-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 5px;
    }

    .mr-tag {
        display: inline-flex;
        align-items: center;
        padding: 4px 7px;
        border-radius: 4px;
        background: #F1F5FF;
        color: #6682BF;
        font-size: 11px;
        font-weight: 700;
    }

    .mr-tag.purple {
        background: #F3EFFF;
        color: #806AD1;
    }

    .mr-tag.green {
        background: #EAF9F2;
        color: #39966D;
    }

    .mr-details {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .mr-detail {
        display: flex;
        align-items: center;
        gap: 6px;
        color: #788396;
        font-size: 12px;
    }

    .mr-detail i {
        width: 13px;
        color: #6B8FDE;
        text-align: center;
    }

    .mr-actions {
        display: flex;
        flex-direction: column;
        gap: 7px;
    }

    .mr-action-btn {
        width: 100%;
        min-height: 34px;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 800;
        cursor: pointer;
        text-align: center;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: .15s ease;
    }

    .mr-action-btn.accept {
        border: 1px solid var(--mr-primary);
        background: var(--mr-primary);
        color: #fff;
    }

    .mr-action-btn.accept:hover {
        background: var(--mr-primary-dark);
    }

    .mr-action-btn.view {
        border: 1px solid #CBDCFF;
        background: #fff;
        color: var(--mr-primary);
    }

    .mr-action-btn.view:hover {
        background: #EEF4FF;
    }

    .mr-action-btn.reject {
        border: 1px solid #FFD3D8;
        background: #fff;
        color: var(--mr-red);
    }

    /* =========================================================
       EMPTY
    ========================================================= */

    .mr-empty {
        padding: 55px 20px;
        text-align: center;
    }

    .mr-empty-icon {
        width: 54px;
        height: 54px;
        margin: 0 auto 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 13px;
        background: #F2F5F9;
        color: #9BA5B5;
        font-size: 20px;
    }

    .mr-empty h3 {
        margin: 0 0 6px;
        color: #394459;
        font-size: 16px;
        font-weight: 800;
    }

    .mr-empty p {
        margin: 0;
        color: #929BAB;
        font-size: 13px;
    }

    /* =========================================================
       PAGINATION
    ========================================================= */

    .mr-pagination {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        padding: 14px;
        border-top: 1px solid #EDF0F5;
    }

    .mr-page-btn {
        width: 32px;
        height: 32px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #E4E8F0;
        border-radius: 5px;
        background: #fff;
        color: #7D8797;
        text-decoration: none;
        font-size: 12px;
        font-weight: 700;
    }

    .mr-page-btn.active {
        border-color: var(--mr-primary);
        background: var(--mr-primary);
        color: #fff;
    }

    /* =========================================================
       HOW IT WORKS
    ========================================================= */

    .mr-how-panel {
        padding: 18px;
    }

    .mr-how-title {
        margin: 0 0 16px;
        color: #26314A;
        font-size: 15px;
        font-weight: 800;
    }

    .mr-how-item {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        margin-bottom: 18px;
    }

    .mr-how-icon {
        width: 34px;
        height: 34px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        background: #EEF4FF;
        color: var(--mr-primary);
        font-size: 13px;
    }

    .mr-how-item:nth-child(3) .mr-how-icon {
        background: #F3EFFF;
        color: var(--mr-purple);
    }

    .mr-how-item:nth-child(4) .mr-how-icon {
        background: #EAF9F2;
        color: var(--mr-green);
    }

    .mr-how-item:nth-child(5) .mr-how-icon {
        background: #FFF6E7;
        color: var(--mr-orange);
    }

    .mr-how-content h4 {
        margin: 0 0 4px;
        color: #394459;
        font-size: 13px;
        font-weight: 800;
    }

    .mr-how-content p {
        margin: 0;
        color: #929BAB;
        font-size: 12px;
        line-height: 1.5;
    }

    .mr-help-box {
        margin-top: 9px;
        padding: 14px;
        border-radius: 9px;
        background: #F5F8FF;
        border: 1px solid #E1E9FA;
    }

    .mr-help-box h4 {
        margin: 0 0 5px;
        color: #34415B;
        font-size: 13px;
        font-weight: 800;
    }

    .mr-help-box p {
        margin: 0 0 10px;
        color: #8A94A5;
        font-size: 12px;
        line-height: 1.5;
    }

    .mr-help-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 32px;
        padding: 0 12px;
        border-radius: 5px;
        background: var(--mr-primary);
        color: #fff;
        text-decoration: none;
        font-size: 12px;
        font-weight: 800;
    }

    /* =========================================================
       SECONDARY SECTIONS
    ========================================================= */

    .mr-secondary {
        margin-top: 24px;
    }

    .mr-section-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 12px;
    }

    .mr-section-title {
        display: flex;
        align-items: center;
        gap: 9px;
    }

    .mr-section-icon {
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        background: #EEF4FF;
        color: var(--mr-primary);
        font-size: 14px;
    }

    .mr-section-title h2 {
        margin: 0;
        color: #25304A;
        font-size: 18px;
        font-weight: 800;
    }

    .mr-section-count {
        min-width: 27px;
        height: 26px;
        padding: 0 9px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 20px;
        background: #EEF4FF;
        color: var(--mr-primary);
        font-size: 12px;
        font-weight: 800;
    }

    /* =========================================================
       MENTEE CARDS
    ========================================================= */

    .mr-mentees-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 14px;
    }

    .mr-mentee-card {
        padding: 16px;
        background: #fff;
        border: 1px solid var(--mr-border);
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(35,61,105,.035);
    }

    .mr-mentee-top {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .mr-mentee-avatar {
        width: 42px;
        height: 42px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        border-radius: 50%;
        background: linear-gradient(145deg,#EEF4FF,#F2EDFF);
        color: var(--mr-primary);
        font-size: 13px;
        font-weight: 800;
    }

    .mr-mentee-name {
        margin: 0 0 3px;
        color: #303A50;
        font-size: 14px;
        font-weight: 800;
    }

    .mr-mentee-role {
        margin: 0;
        color: #929BAB;
        font-size: 12px;
    }

    .mr-active {
        margin-left: auto;
        padding: 5px 8px;
        border-radius: 20px;
        background: #EAF9F2;
        color: #299568;
        font-size: 11px;
        font-weight: 800;
    }

    .mr-mentee-divider {
        height: 1px;
        margin: 13px 0;
        background: #EDF0F5;
    }

    .mr-mentee-meta {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 8px;
    }

    .mr-meta-box {
        padding: 9px;
        border-radius: 7px;
        background: #F8FAFD;
    }

    .mr-meta-label {
        margin: 0 0 3px;
        color: #98A1AF;
        font-size: 11px;
        text-transform: uppercase;
        font-weight: 700;
    }

    .mr-meta-value {
        margin: 0;
        color: #465167;
        font-size: 13px;
        font-weight: 700;
    }

    .mr-view-mentee {
        width: 100%;
        min-height: 36px;
        margin-top: 11px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        border-radius: 7px;
        background: #EEF4FF;
        color: var(--mr-primary);
        text-decoration: none;
        font-size: 12px;
        font-weight: 800;
    }

    /* =========================================================
       SESSION CARD
    ========================================================= */

    .mr-session-panel {
        overflow: hidden;
    }

    .mr-session-row {
        display: grid;
        grid-template-columns: 66px 1fr auto;
        gap: 14px;
        align-items: center;
        padding: 15px 18px;
        border-bottom: 1px solid #EDF0F5;
    }

    .mr-session-row:last-child {
        border-bottom: none;
    }

    .mr-date-box {
        width: 54px;
        height: 58px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        border-radius: 9px;
        background: #EEF4FF;
        color: var(--mr-primary);
    }

    .mr-date-month {
        font-size: 11px;
        font-weight: 800;
        text-transform: uppercase;
    }

    .mr-date-day {
        font-size: 20px;
        line-height: 1.2;
        font-weight: 800;
    }

    .mr-session-title {
        margin: 0 0 5px;
        color: #344057;
        font-size: 14px;
        font-weight: 800;
    }

    .mr-session-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 11px;
        color: #8993A3;
        font-size: 12px;
    }

    .mr-session-action {
        min-height: 34px;
        padding: 0 13px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 6px;
        background: #EEF4FF;
        color: var(--mr-primary);
        text-decoration: none;
        font-size: 12px;
        font-weight: 800;
    }

    /* =========================================================
       COMPLETED
    ========================================================= */

    .mr-completed-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 14px;
    }

    .mr-completed-card {
        padding: 15px;
        background: #fff;
        border: 1px solid var(--mr-border);
        border-radius: 11px;
    }

    .mr-completed-top {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .mr-completed-avatar {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: #EAF9F2;
        color: var(--mr-green);
        font-size: 12px;
        font-weight: 800;
    }

    .mr-completed-name {
        margin: 0 0 3px;
        color: #344057;
        font-size: 14px;
        font-weight: 800;
    }

    .mr-completed-date {
        margin: 0;
        color: #929BAB;
        font-size: 12px;
    }

    .mr-completed-status {
        margin-left: auto;
        padding: 5px 8px;
        border-radius: 20px;
        background: #EAF9F2;
        color: var(--mr-green);
        font-size: 11px;
        font-weight: 800;
    }

    /* =========================================================
       ACTIVE MENTEES + UPCOMING SESSIONS ROW
    ========================================================= */

    .mr-secondary-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
        align-items: start;
        margin-top: 24px;
    }

    .mr-secondary-col {
        min-width: 0;
    }

    .mr-secondary-row .mr-mentees-grid {
        grid-template-columns: 1fr;
    }

    /* =========================================================
       RESPONSIVE
    ========================================================= */

    @media (max-width: 1200px) {

        .mr-main-layout {
            grid-template-columns: 200px minmax(0, 1fr);
        }

        .mr-how-panel-wrap {
            display: none;
        }

        .mr-request-row {
            grid-template-columns: 180px minmax(170px, 1fr) 140px 95px;
        }

        .mr-hero-content {
            width: 62%;
        }

        .mr-hero-visual {
            width: 38%;
        }
    }

    @media (max-width: 900px) {

        .mentorship-page {
            padding: 18px;
        }

        .mr-hero {
            min-height: 270px;
        }

        .mr-hero-content {
            width: 100%;
        }

        .mr-hero-visual {
            opacity: .18;
            width: 70%;
            right: 0;
        }

        .mr-main-layout {
            grid-template-columns: 1fr;
        }

        .mr-filter {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 12px;
            align-items: end;
        }

        .mr-filter-title {
            grid-column: 1 / -1;
            margin-bottom: 0;
        }

        .mr-filter-group {
            margin: 0;
        }

        .mr-filter-btn {
            height: 38px;
        }

        .mr-request-row {
            grid-template-columns: 170px 1fr 120px;
        }

        .mr-details {
            display: none;
        }

        .mr-mentees-grid,
        .mr-completed-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .mr-secondary-row {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 650px) {

        .mentorship-page {
            padding: 12px;
        }

        .mr-hero {
            padding: 26px 22px;
            min-height: auto;
        }

        .mr-hero-title {
            font-size: 27px;
        }

        .mr-hero-description {
            font-size: 13px;
            max-width: 100%;
        }

        .mr-hero-stats {
            flex-direction: column;
            width: 175px;
        }

        .mr-mini-stat {
            min-width: 175px;
        }

        .mr-hero-visual {
            display: none;
        }

        .mr-filter {
            display: block;
        }

        .mr-filter-group {
            margin-bottom: 14px;
        }

        .mr-request-header {
            align-items: flex-start;
            flex-direction: column;
        }

        .mr-search-sort {
            width: 100%;
        }

        .mr-search {
            flex: 1;
        }

        .mr-search input {
            width: 100%;
        }

        .mr-request-row {
            display: block;
            padding: 16px;
        }

        .mr-student {
            margin-bottom: 13px;
        }

        .mr-goal {
            margin-bottom: 12px;
        }

        .mr-details {
            display: flex;
            margin-bottom: 12px;
        }

        .mr-actions {
            flex-direction: row;
        }

        .mr-action-btn {
            flex: 1;
        }

        .mr-mentees-grid,
        .mr-completed-grid {
            grid-template-columns: 1fr;
        }

        .mr-session-row {
            grid-template-columns: 56px 1fr;
        }

        .mr-session-action {
            grid-column: 2;
            justify-self: start;
        }
    }
</style>


<div class="mentorship-page">

    <div class="mentorship-container">

        {{-- =====================================================
             ALERTS
        ====================================================== --}}

        @if(session('success'))
            <div class="mr-alert success">
                <i class="fas fa-check-circle"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="mr-alert error">
                <i class="fas fa-exclamation-circle"></i>
                <span>{{ session('error') }}</span>
            </div>
        @endif


        {{-- =====================================================
             HERO
        ====================================================== --}}

        @php
            $upcomingSessions = $upcomingSessions ?? collect();

            $activeCount = $stats['active_count'] ?? 0;
            $pendingCount = $stats['pending_count'] ?? $pendingRequests->count();
            $upcomingCount = $stats['upcoming_sessions_count'] ?? $upcomingSessions->count();
            $completedCount = $stats['completed_count'] ?? 0;
        @endphp

        <section class="mr-hero">

            <div class="mr-hero-content">

                <div class="mr-breadcrumb">
                    <i class="fas fa-home"></i>
                    <span>›</span>
                    Mentorship Requests
                </div>

                <h1 class="mr-hero-title">
                    Mentorship Requests
                    <br>
                    <span class="blue">Waiting for Your Guidance</span>
                    
                </h1>

                <p class="mr-hero-description">
                    Review and respond to mentorship requests from students and
                    professionals eager to learn from your expertise.
                </p>

                <div class="mr-hero-stats">

                    <div class="mr-mini-stat">
                        <div class="mr-mini-icon">
                            <i class="fas fa-user-clock"></i>
                        </div>

                        <div>
                            <p class="mr-mini-value">
                                {{ $pendingCount }}
                            </p>

                            <p class="mr-mini-label">
                                Pending Requests
                            </p>
                        </div>
                    </div>

                    <div class="mr-mini-stat green">
                        <div class="mr-mini-icon">
                            <i class="fas fa-users"></i>
                        </div>

                        <div>
                            <p class="mr-mini-value">
                                {{ $activeCount }}
                            </p>

                            <p class="mr-mini-label">
                                Active Mentees
                            </p>
                        </div>
                    </div>

                    <div class="mr-mini-stat purple">
                        <div class="mr-mini-icon">
                            <i class="fas fa-star"></i>
                        </div>

                        <div>
                            <p class="mr-mini-value">
                                {{ $completedCount }}
                            </p>

                            <p class="mr-mini-label">
                                Completed
                            </p>
                        </div>
                    </div>

                </div>

            </div>


            {{-- Mentor-related abstract illustration — no human figures --}}

            <div class="mr-hero-visual" aria-hidden="true">

                <div class="visual-circle"></div>
                <div class="visual-orbit"></div>

                <div class="visual-card card-one">
                    <small>
                        <i class="fas fa-user-plus"></i>
                        Mentee Journey
                    </small>
                    <strong>New Connection</strong>
                </div>

                <div class="visual-card card-two">
                    <small>
                        <i class="fas fa-bullseye"></i>
                        Career Goal
                    </small>
                    <strong>Growth Target</strong>
                </div>

                <div class="visual-card card-three">
                    <small>
                        <i class="fas fa-chart-line"></i>
                        Mentorship
                    </small>
                    <strong>Progress 72%</strong>
                </div>

                <div class="visual-connection connection-one"></div>
                <div class="visual-connection connection-two"></div>
                <div class="visual-connection connection-three"></div>

                <div class="visual-roadmap">
                    <div class="roadmap-line blue"></div>
                    <div class="roadmap-line"></div>
                    <div class="roadmap-line short"></div>
                    <div class="roadmap-progress"></div>
                </div>

                <div class="visual-node node-book">
                    <i class="fas fa-book-open"></i>
                </div>

                <div class="visual-node node-target">
                    <i class="fas fa-bullseye"></i>
                </div>

                <div class="visual-node node-check">
                    <i class="fas fa-check"></i>
                </div>

                <i class="fas fa-star visual-star one"></i>
                <i class="fas fa-star visual-star two"></i>
                <i class="fas fa-star visual-star three"></i>

            </div>

        </section>


        {{-- =====================================================
             MAIN CONTENT
        ====================================================== --}}

        <div class="mr-main-layout">


            {{-- =================================================
                 FILTERS
            ================================================== --}}

            <aside class="mr-panel mr-filter">

                <h3 class="mr-filter-title">
                    <i class="fas fa-filter"></i>
                    Filter Requests
                </h3>

                <div class="mr-filter-group">

                    <label class="mr-filter-label">
                        Request Status
                    </label>

                    <label class="mr-check">
                        <input type="checkbox" id="filter-status-all" checked>
                        <span>All Requests</span>
                    </label>

                    <label class="mr-check">
                        <input type="checkbox" class="filter-status" value="pending">
                        <span>Pending</span>
                    </label>

                    <label class="mr-check">
                        <input type="checkbox" class="filter-status" value="accepted">
                        <span>Accepted</span>
                    </label>

                    <label class="mr-check">
                        <input type="checkbox" class="filter-status" value="declined">
                        <span>Declined</span>
                    </label>

                    <label class="mr-check">
                        <input type="checkbox" class="filter-status" value="completed">
                        <span>Completed</span>
                    </label>

                </div>


                <div class="mr-filter-group">

                    <label class="mr-filter-label">
                        Request Type
                    </label>

                    <select class="mr-select" id="filter-type">
                        <option value="">All Types</option>
                        <option value="Career Guidance">Career Guidance</option>
                        <option value="Technical">Technical</option>
                        <option value="Interview Preparation">Interview Preparation</option>
                        <option value="Resume Review">Resume Review</option>
                    </select>

                </div>


                <div class="mr-filter-group">

                    <label class="mr-filter-label">
                        Experience Level
                    </label>

                    <select class="mr-select" id="filter-level">
                        <option value="">All Levels</option>
                        <option value="Student">Student</option>
                        <option value="Fresher">Fresher</option>
                        <option value="Junior">Junior</option>
                        <option value="Experienced">Experienced</option>
                    </select>

                </div>


                <div class="mr-filter-group">

                    <label class="mr-filter-label">
                        Availability
                    </label>

                    <select class="mr-select" id="filter-availability">
                        <option value="">All Availability</option>
                        <option value="Available Now">Available Now</option>
                        <option value="This Week">This Week</option>
                        <option value="Weekend">Weekend</option>
                    </select>

                </div>


                <button type="button" class="mr-filter-btn" id="clear-filters-btn">
                    <i class="fas fa-sync-alt"></i>
                    Clear Filters
                </button>

            </aside>


            {{-- =================================================
                 REQUEST LIST
            ================================================== --}}

            <main class="mr-panel mr-requests-panel">

                <div class="mr-request-header">

                    <div class="mr-request-heading">

                        <h2>
                            All Mentorship Requests
                        </h2>

                        <p>
                            Review and respond to students looking for your guidance.
                        </p>

                    </div>

                    <div class="mr-search-sort">

                        <div class="mr-search">
                            <input
                                type="text"
                                id="filter-search"
                                placeholder="Search by name, skills or topic..."
                            >

                            <i class="fas fa-search"></i>
                        </div>

                        <select class="mr-sort" id="filter-sort">
                            <option value="recent">Sort: Recent</option>
                            <option value="oldest">Oldest</option>
                            <option value="az">Name A-Z</option>
                            <option value="za">Name Z-A</option>
                        </select>

                    </div>

                </div>


                @if($pendingRequests->count() > 0)

                    @foreach($pendingRequests as $requestItem)

                        @php

                            $student = $requestItem->student;

                            $studentName =
                                $student->name ?? 'Student';

                            $studentEmail =
                                $student->email ?? '';

                            $studentInitials = collect(
                                preg_split(
                                    '/\s+/',
                                    trim($studentName)
                                )
                            )
                            ->filter()
                            ->take(2)
                            ->map(
                                fn($word) =>
                                    strtoupper(
                                        substr($word, 0, 1)
                                    )
                            )
                            ->implode('');

                            $careerGoal =
                                $requestItem->career_goal
                                ?? 'Mentorship support requested.';

                            $requestType =
                                $requestItem->request_type
                                ?? 'Career Guidance';

                            $experienceLevel =
                                $requestItem->experience_level
                                ?? 'Student';

                            $location =
                                $student->city
                                ?? $student->location
                                ?? '';

                            $createdAt =
                                $requestItem->created_at ?? null;

                        @endphp


                        <div
                            class="mr-request-row"
                            data-status="pending"
                            data-type="{{ $requestType }}"
                            data-level="{{ $experienceLevel }}"
                            data-name="{{ strtolower($studentName) }}"
                            data-goal="{{ strtolower($careerGoal) }}"
                            data-created="{{ $createdAt ? \Carbon\Carbon::parse($createdAt)->timestamp : 0 }}"
                        >


                            {{-- STUDENT --}}

                            <div class="mr-student">

                                <div class="mr-avatar">

                                    @if(!empty($student->profile_image))

                                        <img
                                            src="{{ asset('storage/' . $student->profile_image) }}"
                                            alt="{{ $studentName }}"
                                        >

                                    @else

                                        {{ $studentInitials ?: 'S' }}

                                    @endif

                                </div>

                                <div class="mr-student-info">

                                    <h3 class="mr-student-name">
                                        {{ $studentName }}
                                    </h3>

                                    <p class="mr-student-role">
                                        {{ $requestType }}
                                    </p>

                                    @if($location)

                                        <div class="mr-student-location">
                                            <i class="fas fa-map-marker-alt"></i>
                                            {{ $location }}
                                        </div>

                                    @elseif($studentEmail)

                                        <div class="mr-student-location">
                                            <i class="fas fa-envelope"></i>
                                            {{ $studentEmail }}
                                        </div>

                                    @endif

                                </div>

                            </div>


                            {{-- REQUEST GOAL --}}

                            <div class="mr-goal">

                                <p class="mr-goal-text">
                                    {{ $careerGoal }}
                                </p>

                                <div class="mr-tags">

                                    <span class="mr-tag">
                                        {{ $requestType }}
                                    </span>

                                    <span class="mr-tag purple">
                                        {{ $experienceLevel }}
                                    </span>

                                    @if($studentEmail)

                                        <span class="mr-tag green">
                                            Profile Verified
                                        </span>

                                    @endif

                                </div>

                            </div>


                            {{-- DETAILS --}}

                            <div class="mr-details">

                                @if($createdAt)

                                    <div class="mr-detail">
                                        <i class="fas fa-calendar"></i>

                                        <span>
                                            Requested
                                            {{ \Carbon\Carbon::parse($createdAt)->format('M d, Y') }}
                                        </span>
                                    </div>

                                @endif

                                <div class="mr-detail">
                                    <i class="fas fa-clock"></i>

                                    <span>
                                        Pending Request
                                    </span>
                                </div>

                                <div class="mr-detail">
                                    <i class="fas fa-user-graduate"></i>

                                    <span>
                                        {{ $experienceLevel }}
                                    </span>
                                </div>

                            </div>


                            {{-- ACTIONS --}}

                            <div class="mr-actions">

                                <form
                                    action="{{ route('mentor.requests.accept', $requestItem) }}"
                                    method="POST"
                                >

                                    @csrf

                                    <button
                                        type="submit"
                                        class="mr-action-btn accept"
                                    >
                                        Accept
                                    </button>

                                </form>


                                <a
                                    href="{{ route('mentor.mentees.show', $requestItem) }}"
                                    class="mr-action-btn view"
                                >
                                    View Profile
                                </a>

                            </div>

                        </div>

                    @endforeach


                    {{-- Shown by JS when filters match nothing --}}
                    <div class="mr-empty" id="filter-empty-state" style="display:none;">

                        <div class="mr-empty-icon">
                            <i class="fas fa-filter"></i>
                        </div>

                        <h3>
                            No Matching Requests
                        </h3>

                        <p>
                            Try adjusting or clearing your filters.
                        </p>

                    </div>


                    {{-- PAGINATION --}}

                    <div class="mr-pagination" id="mr-pagination">

                        <a href="#" class="mr-page-btn">
                            <i class="fas fa-chevron-left"></i>
                        </a>

                        <a href="#" class="mr-page-btn active">
                            1
                        </a>

                        <a href="#" class="mr-page-btn">
                            2
                        </a>

                        <a href="#" class="mr-page-btn">
                            3
                        </a>

                        <span class="mr-page-btn">
                            ...
                        </span>

                        <a href="#" class="mr-page-btn">
                            <i class="fas fa-chevron-right"></i>
                        </a>

                    </div>


                @else

                    <div class="mr-empty">

                        <div class="mr-empty-icon">
                            <i class="fas fa-user-check"></i>
                        </div>

                        <h3>
                            No Pending Requests
                        </h3>

                        <p>
                            New mentorship requests from students will appear here.
                        </p>

                    </div>

                @endif

            </main>


            {{-- =================================================
                 HOW IT WORKS
            ================================================== --}}

            <aside class="mr-panel mr-how-panel-wrap">

                <div class="mr-how-panel">

                    <h3 class="mr-how-title">
                        How It Works
                    </h3>


                    <div class="mr-how-item">

                        <div class="mr-how-icon">
                            <i class="fas fa-user-plus"></i>
                        </div>

                        <div class="mr-how-content">

                            <h4>
                                Review Request
                            </h4>

                            <p>
                                Review the student's profile and mentorship goals.
                            </p>

                        </div>

                    </div>


                    <div class="mr-how-item">

                        <div class="mr-how-icon">
                            <i class="fas fa-eye"></i>
                        </div>

                        <div class="mr-how-content">

                            <h4>
                                View Profile
                            </h4>

                            <p>
                                Learn about their experience and career interests.
                            </p>

                        </div>

                    </div>


                    <div class="mr-how-item">

                        <div class="mr-how-icon">
                            <i class="fas fa-user-check"></i>
                        </div>

                        <div class="mr-how-content">

                            <h4>
                                Accept Mentee
                            </h4>

                            <p>
                                Accept the request when you are ready to guide them.
                            </p>

                        </div>

                    </div>


                    <div class="mr-how-item">

                        <div class="mr-how-icon">
                            <i class="fas fa-calendar-alt"></i>
                        </div>

                        <div class="mr-how-content">

                            <h4>
                                Schedule Session
                            </h4>

                            <p>
                                Plan sessions and connect with your mentee.
                            </p>

                        </div>

                    </div>


                   

                    </div>

                </div>

            </aside>

        </div>


        {{-- =====================================================
             ACTIVE MENTEES + UPCOMING SESSIONS (ROW)
        ====================================================== --}}

        <div class="mr-secondary-row">

        <section class="mr-secondary-col">

            <div class="mr-section-header">

                <div class="mr-section-title">

                    <div class="mr-section-icon">
                        <i class="fas fa-users"></i>
                    </div>

                    <h2>
                        Active Mentees
                    </h2>

                    @if($activeMentees->count() > 0)
                        <span class="mr-section-count">
                            {{ $activeMentees->count() }}
                        </span>
                    @endif

                </div>

            </div>


            @if($activeMentees->count() > 0)

                <div class="mr-mentees-grid">

                    @foreach($activeMentees as $mentorship)

                        @php

                            $student = $mentorship->student;

                            $studentName =
                                $student->name ?? 'Student';

                            $initials = collect(
                                preg_split(
                                    '/\s+/',
                                    trim($studentName)
                                )
                            )
                            ->filter()
                            ->take(2)
                            ->map(
                                fn($word) =>
                                    strtoupper(
                                        substr($word, 0, 1)
                                    )
                            )
                            ->implode('');

                            $rating =
                                $mentorship->avg_rating;

                            $rating =
                                is_numeric($rating)
                                ? number_format((float)$rating, 1)
                                : '—';

                        @endphp


                        <div class="mr-mentee-card">

                            <div class="mr-mentee-top">

                                <div class="mr-mentee-avatar">
                                    {{ $initials ?: 'S' }}
                                </div>

                                <div>

                                    <h3 class="mr-mentee-name">
                                        {{ $studentName }}
                                    </h3>

                                    <p class="mr-mentee-role">
                                        Active Mentee
                                    </p>

                                </div>

                                <span class="mr-active">
                                    ACTIVE
                                </span>

                            </div>


                            <div class="mr-mentee-divider"></div>


                            <div class="mr-mentee-meta">

                                <div class="mr-meta-box">

                                    <p class="mr-meta-label">
                                        Sessions
                                    </p>

                                    <p class="mr-meta-value">

                                        @if(isset($mentorship->sessions_count))

                                            {{ $mentorship->sessions_count }}

                                        @else

                                            {{ $mentorship->sessions->count() }}

                                        @endif

                                    </p>

                                </div>


                                <div class="mr-meta-box">

                                    <p class="mr-meta-label">
                                        Rating
                                    </p>

                                    <p class="mr-meta-value">
                                        @if($rating !== '—')
                                            <i
                                                class="fas fa-star"
                                                style="color:#F5A623;"
                                            ></i>
                                        @endif

                                        {{ $rating }}
                                    </p>

                                </div>

                            </div>


                            <a
                                href="{{ route('mentor.mentees.show', $mentorship) }}"
                                class="mr-view-mentee"
                            >
                                View Mentee

                                <i class="fas fa-arrow-right"></i>
                            </a>

                        </div>

                    @endforeach

                </div>

            @else

                <div class="mr-panel mr-empty">

                    <div class="mr-empty-icon">
                        <i class="fas fa-users"></i>
                    </div>

                    <h3>
                        No Active Mentees Yet
                    </h3>

                    <p>
                        Once you accept a mentorship request, the student will appear here.
                    </p>

                </div>

            @endif

        </section>


        <section class="mr-secondary-col">

            <div class="mr-section-header">

                <div class="mr-section-title">

                    <div class="mr-section-icon">
                        <i class="fas fa-calendar-alt"></i>
                    </div>

                    <h2>
                        Upcoming Sessions
                    </h2>

                    @if($upcomingSessions->count() > 0)

                        <span class="mr-section-count">
                            {{ $upcomingSessions->count() }}
                        </span>

                    @endif

                </div>

            </div>


            @if($upcomingSessions->count() > 0)

                <div class="mr-panel mr-session-panel">

                    @foreach($upcomingSessions as $item)

                        @php

                            $session = $item['session'];
                            $mentee = $item['mentee'];
                            $student = $mentee->student ?? null;

                            $studentName =
                                $student->name ?? 'Mentee';

                            $sessionDate = null;

                            if (!empty($session->starts_at)) {

                                try {

                                    $sessionDate =
                                        \Carbon\Carbon::parse(
                                            $session->starts_at
                                        );

                                } catch (\Exception $e) {

                                    $sessionDate = null;

                                }

                            }

                            $sessionTitle =
                                $session->title
                                ?? $session->topic
                                ?? 'Mentorship Session';

                            $sessionMode =
                                $session->meeting_type
                                ?? $session->mode
                                ?? 'Online';

                            $meetingUrl =
                                $session->meeting_url
                                ?? $session->join_url
                                ?? null;

                        @endphp


                        <div class="mr-session-row">

                            <div class="mr-date-box">

                                @if($sessionDate)

                                    <span class="mr-date-month">
                                        {{ $sessionDate->format('M') }}
                                    </span>

                                    <span class="mr-date-day">
                                        {{ $sessionDate->format('d') }}
                                    </span>

                                @else

                                    <span class="mr-date-month">
                                        Date
                                    </span>

                                    <span class="mr-date-day">
                                        —
                                    </span>

                                @endif

                            </div>


                            <div>

                                <h3 class="mr-session-title">
                                    {{ $sessionTitle }}
                                </h3>

                                <div class="mr-session-meta">

                                    <span>
                                        <i class="fas fa-user"></i>
                                        {{ $studentName }}
                                    </span>

                                    @if($sessionDate)

                                        <span>
                                            <i class="fas fa-clock"></i>
                                            {{ $sessionDate->format('h:i A') }}
                                        </span>

                                    @endif

                                    <span>
                                        <i class="fas fa-video"></i>
                                        {{ ucfirst($sessionMode) }}
                                    </span>

                                </div>

                            </div>


                            <div>

                                @if($meetingUrl)

                                    <a
                                        href="{{ $meetingUrl }}"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        class="mr-session-action"
                                    >
                                        Join Session
                                    </a>

                                @else

                                    <a
                                        href="{{ route('mentor.mentees.show', $mentee) }}"
                                        class="mr-session-action"
                                    >
                                        View Session
                                    </a>

                                @endif

                            </div>

                        </div>

                    @endforeach

                </div>

            @else

                <div class="mr-panel mr-empty">

                    <div class="mr-empty-icon">
                        <i class="fas fa-calendar-day"></i>
                    </div>

                    <h3>
                        No Upcoming Sessions
                    </h3>

                    <p>
                        Your scheduled mentorship sessions will appear here.
                    </p>

                </div>

            @endif

        </section>

        </div>


        {{-- =====================================================
             COMPLETED MENTORSHIPS
        ====================================================== --}}

        <section class="mr-secondary">

            <div class="mr-section-header">

                <div class="mr-section-title">

                    <div class="mr-section-icon">
                        <i class="fas fa-check-double"></i>
                    </div>

                    <h2>
                        Completed Mentorships
                    </h2>

                    @if($completed->count() > 0)

                        <span class="mr-section-count">
                            {{ $completed->count() }}
                        </span>

                    @endif

                </div>

            </div>


            @if($completed->count() > 0)

                <div class="mr-completed-grid">

                    @foreach($completed as $mentorship)

                        @php

                            $student =
                                $mentorship->student;

                            $studentName =
                                $student->name ?? 'Student';

                            $initials = collect(
                                preg_split(
                                    '/\s+/',
                                    trim($studentName)
                                )
                            )
                            ->filter()
                            ->take(2)
                            ->map(
                                fn($word) =>
                                    strtoupper(
                                        substr($word, 0, 1)
                                    )
                            )
                            ->implode('');

                            $completedDate =
                                $mentorship->completed_at
                                ?? $mentorship->updated_at;

                        @endphp


                        <div class="mr-completed-card">

                            <div class="mr-completed-top">

                                <div class="mr-completed-avatar">
                                    {{ $initials ?: 'S' }}
                                </div>

                                <div>

                                    <h3 class="mr-completed-name">
                                        {{ $studentName }}
                                    </h3>

                                    <p class="mr-completed-date">

                                        @if($completedDate)

                                            Completed
                                            {{ \Carbon\Carbon::parse($completedDate)->format('M d, Y') }}

                                        @else

                                            Mentorship completed

                                        @endif

                                    </p>

                                </div>

                                <span class="mr-completed-status">
                                    COMPLETED
                                </span>

                            </div>

                        </div>

                    @endforeach

                </div>

            @else

                <div class="mr-panel mr-empty">

                    <div class="mr-empty-icon">
                        <i class="fas fa-history"></i>
                    </div>

                    <h3>
                        No Completed Mentorships
                    </h3>

                    <p>
                        Completed mentorship relationships will appear here.
                    </p>

                </div>

            @endif

        </section>

    </div>

</div>


<script>
document.addEventListener('DOMContentLoaded', function () {

    var allCheckbox   = document.getElementById('filter-status-all');
    var statusChecks  = Array.prototype.slice.call(document.querySelectorAll('.filter-status'));
    var typeSelect     = document.getElementById('filter-type');
    var levelSelect     = document.getElementById('filter-level');
    var searchInput     = document.getElementById('filter-search');
    var sortSelect       = document.getElementById('filter-sort');
    var clearBtn           = document.getElementById('clear-filters-btn');

    var rowsContainer = document.querySelector('.mr-requests-panel');
    var pagination      = document.getElementById('mr-pagination');
    var emptyState      = document.getElementById('filter-empty-state');

    if (!rowsContainer) {
        return;
    }

    function getRows() {
        return Array.prototype.slice.call(
            rowsContainer.querySelectorAll('.mr-request-row')
        );
    }

    // "All Requests" and the individual status boxes behave like a
    // typical filter group: checking "All" clears the rest, and
    // checking any specific status un-checks "All".
    if (allCheckbox) {
        allCheckbox.addEventListener('change', function () {
            if (allCheckbox.checked) {
                statusChecks.forEach(function (cb) { cb.checked = false; });
            }
            applyFilters();
        });
    }

    statusChecks.forEach(function (cb) {
        cb.addEventListener('change', function () {
            if (cb.checked && allCheckbox) {
                allCheckbox.checked = false;
            }
            var anyChecked = statusChecks.some(function (c) { return c.checked; });
            if (!anyChecked && allCheckbox) {
                allCheckbox.checked = true;
            }
            applyFilters();
        });
    });

    if (typeSelect) {
        typeSelect.addEventListener('change', applyFilters);
    }

    if (levelSelect) {
        levelSelect.addEventListener('change', applyFilters);
    }

    if (searchInput) {
        searchInput.addEventListener('input', applyFilters);
    }

    if (sortSelect) {
        sortSelect.addEventListener('change', applyFilters);
    }

    if (clearBtn) {
        clearBtn.addEventListener('click', function () {
            if (allCheckbox) allCheckbox.checked = true;
            statusChecks.forEach(function (cb) { cb.checked = false; });
            if (typeSelect) typeSelect.value = '';
            if (levelSelect) levelSelect.value = '';
            if (searchInput) searchInput.value = '';
            if (sortSelect) sortSelect.value = 'recent';
            applyFilters();
        });
    }

    function activeStatuses() {
        if (!allCheckbox || allCheckbox.checked) {
            return null; // null = no status filtering, show all
        }
        return statusChecks.filter(function (cb) { return cb.checked; })
                            .map(function (cb) { return cb.value; });
    }

    function applyFilters() {

        var statuses   = activeStatuses();
        var type        = typeSelect ? typeSelect.value : '';
        var level       = levelSelect ? levelSelect.value : '';
        var query        = searchInput ? searchInput.value.trim().toLowerCase() : '';

        var rows = getRows();
        var visibleCount = 0;

        rows.forEach(function (row) {

            var rowStatus = row.getAttribute('data-status') || '';
            var rowType     = row.getAttribute('data-type') || '';
            var rowLevel    = row.getAttribute('data-level') || '';
            var rowName     = row.getAttribute('data-name') || '';
            var rowGoal     = row.getAttribute('data-goal') || '';

            var matchesStatus = !statuses || statuses.indexOf(rowStatus) !== -1;
            var matchesType     = !type || rowType === type;
            var matchesLevel    = !level || rowLevel === level;
            var matchesQuery    = !query ||
                rowName.indexOf(query) !== -1 ||
                rowGoal.indexOf(query) !== -1 ||
                rowType.toLowerCase().indexOf(query) !== -1;

            var isMatch = matchesStatus && matchesType && matchesLevel && matchesQuery;

            row.style.display = isMatch ? '' : 'none';

            if (isMatch) {
                visibleCount += 1;
            }
        });

        applySort();

        if (emptyState) {
            emptyState.style.display = visibleCount === 0 ? '' : 'none';
        }

        if (pagination) {
            pagination.style.display = visibleCount === 0 ? 'none' : '';
        }
    }

    function applySort() {

        if (!sortSelect) {
            return;
        }

        var mode = sortSelect.value;
        var rows = getRows();

        rows.sort(function (a, b) {

            if (mode === 'az' || mode === 'za') {
                var nameA = a.getAttribute('data-name') || '';
                var nameB = b.getAttribute('data-name') || '';
                return mode === 'az'
                    ? nameA.localeCompare(nameB)
                    : nameB.localeCompare(nameA);
            }

            var createdA = parseInt(a.getAttribute('data-created') || '0', 10);
            var createdB = parseInt(b.getAttribute('data-created') || '0', 10);

            return mode === 'oldest'
                ? createdA - createdB
                : createdB - createdA;
        });

        rows.forEach(function (row) {
            rowsContainer.insertBefore(row, emptyState || null);
        });
    }

});
</script>

@endsection