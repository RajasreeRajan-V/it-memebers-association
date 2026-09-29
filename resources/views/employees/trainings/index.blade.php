@extends('layouts.app')

@section('title', 'Trainings')

@section('content')

@push('styles')
<style>

    /* =========================================================
       TRAINING PAGE
    ========================================================= */

    .training-page {
        background: #ffffff;
        min-height: 100vh;
        overflow-x: hidden;
    }

    .training-line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }


    /* =========================================================
       HERO
    ========================================================= */

    .training-hero {
        background: linear-gradient(
            180deg,
            #f5f8ff 0%,
            #ffffff 100%
        );

        border-bottom: 1px solid #edf1f7;
    }

    .training-hero-inner {
        max-width: 1152px;
        margin: 0 auto;
        padding: 56px 24px;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 40px;
        align-items: center;
    }

    .training-hero-left {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
    }

    .training-count-badge {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        color: #1d4ed8;
        background: #dbeafe;
        padding: 7px 14px;
        border-radius: 999px;
        font-size: 11px;
        font-weight: 700;
        margin-bottom: 20px;
    }

    .training-count-badge svg {
        width: 14px;
        height: 14px;
    }

    .training-hero-title {
        margin: 0 0 16px;
        color: #0f172a;
        font-size: 48px;
        line-height: 1.1;
        font-weight: 800;
        letter-spacing: -1px;
    }

    .training-hero-title span {
        color: #2563eb;
    }

    .training-hero-description {
        max-width: 520px;
        margin: 0 0 28px;
        color: #64748b;
        font-size: 15px;
        line-height: 1.7;
    }


    /* =========================================================
       SEARCH
    ========================================================= */

    .training-search-form {
        width: 100%;
        display: flex;
        align-items: stretch;
        gap: 5px;
        padding: 6px;
        background: #ffffff;
        border: 1px solid #e8edf5;
        border-radius: 12px;
        box-shadow: 0 12px 30px rgba(30, 64, 175, 0.06);
    }

    .training-search-field {
        position: relative;
        flex: 1.4;
    }

    .training-search-field svg {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        width: 16px;
        height: 16px;
        color: #94a3b8;
    }

    .training-search-field input {
        width: 100%;
        height: 100%;
        border: 0;
        outline: none;
        padding: 10px 12px 10px 36px;
        color: #334155;
        font-size: 13px;
        border-radius: 8px;
    }

    .training-search-divider {
        width: 1px;
        margin: 6px 0;
        background: #e2e8f0;
    }

    .training-level-field {
        position: relative;
        flex: 1;
    }

    .training-level-field select {
        width: 100%;
        height: 100%;
        border: 0;
        outline: none;
        appearance: none;
        padding: 10px 30px 10px 36px;
        color: #334155;
        background: transparent;
        font-size: 13px;
        cursor: pointer;
        border-radius: 8px;
    }

    .training-level-field > svg:first-child {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        width: 16px;
        height: 16px;
        color: #94a3b8;
        pointer-events: none;
    }

    .training-level-arrow {
        position: absolute;
        right: 8px;
        top: 50%;
        transform: translateY(-50%);
        width: 14px;
        height: 14px;
        color: #94a3b8;
        pointer-events: none;
    }

    .training-search-button {
        padding: 0 24px;
        border: 0;
        border-radius: 8px;
        background: #2563eb;
        color: #ffffff;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: .2s;
    }

    .training-search-button:hover {
        background: #1d4ed8;
    }


    /* =========================================================
       HERO IMAGE
    ========================================================= */

    .training-hero-image {
        position: relative;
        display: flex;
        justify-content: flex-end;
    }

    .training-hero-image > img {
        width: 100%;
        max-width: 440px;
        height: auto;
        border-radius: 14px;
        object-fit: cover;
    }

    .training-floating-card {
        position: absolute;
        display: flex;
        align-items: center;
        gap: 9px;
        padding: 10px 15px;
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0 12px 28px rgba(15, 23, 42, .10);
    }

    .training-floating-card.top {
        top: 24px;
        left: 0;
    }

    .training-floating-card.bottom {
        bottom: 24px;
        left: -24px;
    }

    .training-floating-icon {
        width: 32px;
        height: 32px;
        border-radius: 9px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #dbeafe;
        color: #2563eb;
    }

    .training-floating-icon svg {
        width: 16px;
        height: 16px;
    }

    .training-floating-text {
        color: #1e293b;
        font-size: 13px;
        font-weight: 600;
        white-space: nowrap;
    }


    /* =========================================================
       BODY
    ========================================================= */

    .training-body {
        max-width: 1280px;
        margin: 0 auto;
        padding: 32px 16px;
        display: grid;
        grid-template-columns: 280px minmax(0, 1fr);
        gap: 24px;
    }


    /* =========================================================
       FILTER
    ========================================================= */

    .training-filter {
        height: fit-content;
        padding: 20px;
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(15, 23, 42, .03);
        position: sticky;
        top: 24px;
    }

    .training-filter-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding-bottom: 16px;
        border-bottom: 1px solid #f1f5f9;
    }

    .training-filter-title {
        display: flex;
        align-items: center;
        gap: 8px;
        margin: 0;
        color: #1e293b;
        font-size: 15px;
        font-weight: 600;
    }

    .training-filter-title svg {
        width: 16px;
        height: 16px;
        color: #64748b;
    }

    .training-clear {
        color: #2563eb;
        font-size: 13px;
        font-weight: 500;
        text-decoration: none;
    }

    .training-filter-section {
        padding: 18px 0;
        border-bottom: 1px solid #f1f5f9;
    }

    .training-filter-label {
        display: block;
        margin-bottom: 11px;
        color: #94a3b8;
        font-size: 10px;
        font-weight: 700;
        letter-spacing: 1.5px;
        text-transform: uppercase;
    }

    .training-filter-input {
        width: 100%;
        padding: 8px 10px;
        border: 1px solid #e2e8f0;
        border-radius: 7px;
        outline: none;
        color: #334155;
        font-size: 13px;
    }

    .training-filter-input:focus {
        border-color: #93c5fd;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, .10);
    }

    .training-level-list {
        margin: 0;
        padding: 0;
        list-style: none;
    }

    .training-level-item {
        margin-bottom: 3px;
    }

    .training-level-label {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 8px 10px;
        border-radius: 7px;
        color: #475569;
        font-size: 13px;
        cursor: pointer;
    }

    .training-level-label.active {
        background: #eff6ff;
        color: #2563eb;
        font-weight: 600;
    }

    .training-apply-button {
        width: 100%;
        margin-top: 18px;
        padding: 9px 14px;
        border: 0;
        border-radius: 8px;
        background: #2563eb;
        color: #ffffff;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
    }

    .training-apply-button:hover {
        background: #1d4ed8;
    }


    /* =========================================================
       TRAINING LIST
    ========================================================= */

    .training-list-heading {
        margin: 0 0 18px;
        color: #64748b;
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 1.4px;
        text-transform: uppercase;
    }

    .training-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 20px;
    }

    .training-card {
        display: flex;
        flex-direction: column;
        overflow: hidden;
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        transition: .2s;
    }

    .training-card:hover {
        border-color: #cbd5e1;
        box-shadow: 0 10px 25px rgba(15, 23, 42, .07);
        transform: translateY(-2px);
    }

    .training-card-image {
        width: 100%;
        height: 160px;
        display: block;
        object-fit: cover;
        background: #f1f5f9;
    }

    .training-card-content {
        display: flex;
        flex: 1;
        flex-direction: column;
        padding: 16px;
    }

    .training-card-badges {
        display: flex;
        align-items: center;
        gap: 7px;
        margin-bottom: 8px;
    }

    .training-badge {
        display: inline-flex;
        align-items: center;
        padding: 3px 8px;
        border-radius: 999px;
        background: #eff6ff;
        color: #2563eb;
        font-size: 9px;
        font-weight: 700;
        letter-spacing: .5px;
        text-transform: uppercase;
    }

    .training-card-title {
        margin: 0 0 7px;
        color: #0f172a;
        font-size: 15px;
        line-height: 1.45;
        font-weight: 700;
    }

    .training-card-description {
        flex: 1;
        margin: 0 0 16px;
        color: #64748b;
        font-size: 13px;
        line-height: 1.6;
    }

    .training-view-button {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        padding: 9px 15px;
        border-radius: 8px;
        background: #2563eb;
        color: #ffffff;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        transition: .2s;
    }

    .training-view-button:hover {
        background: #1d4ed8;
    }

    .training-view-button svg {
        width: 14px;
        height: 14px;
    }


    /* =========================================================
       MODAL
    ========================================================= */

    #training-modal {
        position: fixed;
        inset: 0;
        z-index: 99999;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }

    #training-modal.hidden {
        display: none;
    }

    .training-modal-overlay {
        position: absolute;
        inset: 0;
        background: rgba(15, 23, 42, .58);
        backdrop-filter: blur(4px);
    }

    .training-modal-wrapper {
        position: relative;
        width: 100%;
        max-width: 720px;
        max-height: 90vh;
        display: flex;
        flex-direction: column;
        overflow: hidden;
        background: #ffffff;
        border-radius: 18px;
        box-shadow: 0 30px 80px rgba(15, 23, 42, .28);
        border: 1px solid rgba(226, 232, 240, .8);
    }

    .training-modal-close {
        position: absolute;
        top: 14px;
        right: 14px;
        z-index: 20;
        width: 34px;
        height: 34px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #e2e8f0;
        border-radius: 9px;
        background: rgba(255,255,255,.96);
        color: #64748b;
        cursor: pointer;
        transition: .2s;
    }

    .training-modal-close:hover {
        background: #eff6ff;
        border-color: #bfdbfe;
        color: #2563eb;
    }

    .training-modal-close svg {
        width: 16px;
        height: 16px;
    }

    #training-modal-content {
        overflow-y: auto;
        max-height: 90vh;
    }

    #training-modal-content::-webkit-scrollbar {
        width: 6px;
    }

    #training-modal-content::-webkit-scrollbar-track {
        background: #f8fafc;
    }

    #training-modal-content::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 10px;
    }

    #training-modal-content::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }


    /* =========================================================
       MODAL DETAILS
    ========================================================= */

    .training-details {
        width: 100%;
        background: #ffffff;
    }

    .training-details-header {
        padding: 22px 54px 18px 22px;
        border-bottom: 1px solid #edf2f7;
        background: #ffffff;
    }

    .training-details-header-row {
        display: flex;
        align-items: flex-start;
        gap: 13px;
    }

    .training-details-icon {
        width: 46px;
        height: 46px;
        flex: 0 0 46px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        background: #eff6ff;
        border: 1px solid #dbeafe;
        color: #2563eb;
    }

    .training-details-icon svg {
        width: 23px;
        height: 23px;
    }

    .training-details-heading {
        min-width: 0;
    }

    .training-details-category-row {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 7px;
        margin-bottom: 4px;
    }

    .training-details-category {
        color: #2563eb;
        font-size: 10px;
        font-weight: 700;
        letter-spacing: .8px;
        text-transform: uppercase;
    }

    .training-details-level {
        padding: 3px 8px;
        border-radius: 999px;
        background: #eff6ff;
        color: #2563eb;
        font-size: 9px;
        font-weight: 700;
        letter-spacing: .4px;
        text-transform: uppercase;
    }

    .training-details-title {
        margin: 0;
        color: #0f172a;
        font-size: 22px;
        line-height: 1.25;
        font-weight: 700;
    }

    .training-details-short-description {
        margin: 6px 0 0;
        color: #64748b;
        font-size: 13px;
        line-height: 1.55;
    }


    /* =========================================================
       MODAL BODY
    ========================================================= */

    .training-details-body {
        padding: 20px 22px 24px;
    }

    .training-details-image {
        width: 100%;
        height: 250px;
        display: block;
        object-fit: cover;
        border-radius: 12px;
        background: #f1f5f9;
        border: 1px solid #e2e8f0;
        margin-bottom: 18px;
    }


    /* =========================================================
       DETAILS GRID
    ========================================================= */

    .training-info-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 10px;
        margin-bottom: 22px;
    }

    .training-info-card {
        min-height: 67px;
        padding: 12px 13px;
        background: #f8fafc;
        border: 1px solid #f1f5f9;
        border-radius: 11px;
    }

    .training-info-label {
        display: block;
        margin-bottom: 5px;
        color: #94a3b8;
        font-size: 9px;
        font-weight: 700;
        letter-spacing: 1px;
        text-transform: uppercase;
    }

    .training-info-value {
        display: block;
        color: #1e293b;
        font-size: 13px;
        line-height: 1.35;
        font-weight: 600;
        word-break: break-word;
    }


    /* =========================================================
       CONTENT SECTIONS
    ========================================================= */

    .training-detail-section {
        margin-bottom: 22px;
    }

    .training-detail-section-title {
        margin: 0 0 10px;
        color: #1e293b;
        font-size: 14px;
        font-weight: 700;
    }

    .training-detail-description {
        margin: 0;
        color: #475569;
        font-size: 13px;
        line-height: 1.8;
        white-space: pre-line;
    }


    /* =========================================================
       SCHEDULE
    ========================================================= */

    .training-schedule-box {
        margin-bottom: 22px;
        padding: 15px;
        background: #eff6ff;
        border: 1px solid #dbeafe;
        border-radius: 12px;
    }

    .training-schedule-header {
        display: flex;
        align-items: center;
        gap: 9px;
        margin-bottom: 13px;
    }

    .training-schedule-icon {
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        background: #dbeafe;
        color: #2563eb;
    }

    .training-schedule-icon svg {
        width: 16px;
        height: 16px;
    }

    .training-schedule-title {
        margin: 0;
        color: #1e293b;
        font-size: 13px;
        font-weight: 700;
    }

    .training-schedule-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
    }

    .training-schedule-label {
        display: block;
        color: #94a3b8;
        font-size: 10px;
        margin-bottom: 3px;
    }

    .training-schedule-value {
        color: #334155;
        font-size: 12px;
        font-weight: 600;
    }

    .training-meeting-button {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        margin-top: 13px;
        padding: 8px 13px;
        border-radius: 7px;
        background: #2563eb;
        color: #ffffff;
        text-decoration: none;
        font-size: 11px;
        font-weight: 600;
    }

    .training-meeting-button:hover {
        background: #1d4ed8;
    }

    .training-meeting-button svg {
        width: 13px;
        height: 13px;
    }


    /* =========================================================
       LEARN / REQUIREMENTS
    ========================================================= */

    .training-list-items {
        display: flex;
        flex-direction: column;
        gap: 9px;
    }

    .training-list-item {
        display: flex;
        align-items: flex-start;
        gap: 9px;
        color: #475569;
        font-size: 13px;
        line-height: 1.6;
    }

    .training-list-icon {
        width: 20px;
        height: 20px;
        flex: 0 0 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: #eff6ff;
        color: #2563eb;
        margin-top: 1px;
    }

    .training-list-icon svg {
        width: 11px;
        height: 11px;
    }


    /* =========================================================
       CURRICULUM
    ========================================================= */

    .training-curriculum {
        overflow: hidden;
        border: 1px solid #e2e8f0;
        border-radius: 11px;
    }

    .training-module {
        border-bottom: 1px solid #e2e8f0;
    }

    .training-module:last-child {
        border-bottom: 0;
    }

    .training-module-summary {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        padding: 12px 13px;
        color: #1e293b;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        list-style: none;
    }

    .training-module-summary:hover {
        background: #f8fbff;
    }

    .training-module-summary::-webkit-details-marker {
        display: none;
    }

    .training-module-title {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .training-module-number {
        width: 27px;
        height: 27px;
        flex: 0 0 27px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        background: #eff6ff;
        color: #2563eb;
        font-size: 10px;
        font-weight: 700;
    }

    .training-module-arrow {
        width: 15px;
        height: 15px;
        color: #94a3b8;
        transition: .2s;
    }

    .training-module[open] .training-module-arrow {
        transform: rotate(45deg);
    }

    .training-sessions {
        padding: 0 13px 10px;
        background: #f8fafc;
    }

    .training-session {
        padding: 11px 0;
        border-top: 1px solid #e2e8f0;
    }

    .training-session:first-child {
        border-top: 0;
    }

    .training-session-title {
        margin: 0;
        color: #334155;
        font-size: 12px;
        font-weight: 600;
    }

    .training-session-description {
        margin: 4px 0 7px;
        color: #64748b;
        font-size: 11px;
        line-height: 1.6;
    }

    .training-session-links {
        display: flex;
        gap: 15px;
    }

    .training-session-link {
        color: #2563eb;
        font-size: 11px;
        font-weight: 600;
        text-decoration: none;
    }

    .training-session-link:hover {
        text-decoration: underline;
    }


    /* =========================================================
       RESOURCES
    ========================================================= */

    .training-resources {
        overflow: hidden;
        border: 1px solid #e2e8f0;
        border-radius: 11px;
    }

    .training-resource {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        padding: 11px 13px;
        border-bottom: 1px solid #e2e8f0;
    }

    .training-resource:last-child {
        border-bottom: 0;
    }

    .training-resource:hover {
        background: #f8fbff;
    }

    .training-resource-title {
        color: #475569;
        font-size: 12px;
    }

    .training-resource-download {
        color: #2563eb;
        font-size: 11px;
        font-weight: 600;
        text-decoration: none;
        white-space: nowrap;
    }

    .training-resource-download:hover {
        text-decoration: underline;
    }


    /* =========================================================
       CERTIFICATE
    ========================================================= */

    .training-certificate {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 12px 13px;
        background: #eff6ff;
        border: 1px solid #dbeafe;
        border-radius: 11px;
        color: #1d4ed8;
        font-size: 12px;
        font-weight: 500;
    }

    .training-certificate-icon {
        width: 27px;
        height: 27px;
        flex: 0 0 27px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: #dbeafe;
    }

    .training-certificate-icon svg {
        width: 14px;
        height: 14px;
    }


    /* =========================================================
       MODAL LOADING
    ========================================================= */

    .training-modal-loading {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        min-height: 400px;
        padding: 40px;
    }

    .training-loading-icon {
        width: 46px;
        height: 46px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        background: #eff6ff;
        color: #2563eb;
        margin-bottom: 12px;
    }

    .training-loading-icon svg {
        width: 20px;
        height: 20px;
        animation: trainingSpin 1s linear infinite;
    }

    .training-loading-text {
        margin: 0;
        color: #64748b;
        font-size: 13px;
        font-weight: 500;
    }

    @keyframes trainingSpin {
        from {
            transform: rotate(0deg);
        }

        to {
            transform: rotate(360deg);
        }
    }


    /* =========================================================
       RESPONSIVE
    ========================================================= */

    @media (max-width: 1100px) {

        .training-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

    }


    @media (max-width: 900px) {

        .training-hero-inner {
            grid-template-columns: 1fr;
        }

        .training-hero-image {
            justify-content: center;
        }

        .training-body {
            grid-template-columns: 1fr;
        }

        .training-filter {
            position: static;
        }

    }


    @media (max-width: 640px) {

        #training-modal {
            padding: 0;
            align-items: flex-end;
        }

        .training-modal-wrapper {
            max-width: 100%;
            max-height: 94vh;
            border-radius: 18px 18px 0 0;
        }

        #training-modal-content {
            max-height: 94vh;
        }

        .training-details-header {
            padding: 20px 48px 17px 17px;
        }

        .training-details-body {
            padding: 17px;
        }

        .training-details-title {
            font-size: 19px;
        }

        .training-details-image {
            height: 190px;
        }

        .training-info-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .training-hero-title {
            font-size: 38px;
        }

        .training-search-form {
            flex-direction: column;
        }

        .training-search-divider {
            width: 100%;
            height: 1px;
            margin: 0;
        }

        .training-search-button {
            min-height: 42px;
        }

        .training-grid {
            grid-template-columns: 1fr;
        }

        .training-floating-card.bottom {
            left: 0;
        }

        .training-schedule-grid {
            grid-template-columns: 1fr;
        }

    }

</style>
@endpush


@php

    $activeLevel = $activeLevel ?? request('level');
    $activeCategory = $activeCategory ?? request('category');
    $activeSearch = $activeSearch ?? request('search');

    $levels = [
        ['value' => '', 'label' => 'All Levels'],
        ['value' => 'beginner', 'label' => 'Beginner'],
        ['value' => 'intermediate', 'label' => 'Intermediate'],
        ['value' => 'advanced', 'label' => 'Advanced'],
    ];

@endphp


<div class="training-page">


    {{-- =========================================================
         HERO
    ========================================================== --}}

    <section class="training-hero">

        <div class="training-hero-inner">


            <div class="training-hero-left">

                <span class="training-count-badge">

                    <svg
                        fill="currentColor"
                        viewBox="0 0 24 24">

                        <path d="M12 3 2 8l10 5 10-5-10-5z"/>
                        <path d="M2 12l10 5 10-5M2 16l10 5 10-5"/>

                    </svg>

                    {{ $trainings->total() ?? count($trainings) }}+ TRAININGS AVAILABLE

                </span>


                <h1 class="training-hero-title">

                    Level Up.
                    <br>

                    <span>Train. Grow.</span>

                </h1>


                <p class="training-hero-description">

                    Browse hands-on trainings and courses curated for your team —
                    from beginner fundamentals to advanced specializations.

                </p>


                <form
                    action="{{ route('employee.trainings.index') }}"
                    method="GET"
                    class="training-search-form">


                    <div class="training-search-field">

                        <svg
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            viewBox="0 0 24 24">

                            <circle cx="11" cy="11" r="7"/>
                            <path
                                d="m20 20-3.5-3.5"
                                stroke-linecap="round"/>

                        </svg>


                        <input
                            type="text"
                            name="search"
                            value="{{ $activeSearch }}"
                            placeholder="Search trainings...">

                    </div>


                    <div class="training-search-divider"></div>


                    <div class="training-level-field">

                        <svg
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            viewBox="0 0 24 24">

                            <path d="M4 6h16M7 12h10M10 18h4"/>

                        </svg>


                        <select name="level">

                            @foreach ($levels as $lvl)

                                <option
                                    value="{{ $lvl['value'] }}"
                                    {{ $activeLevel === $lvl['value'] ? 'selected' : '' }}>

                                    {{ $lvl['label'] }}

                                </option>

                            @endforeach

                        </select>


                        <svg
                            class="training-level-arrow"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            viewBox="0 0 24 24">

                            <path
                                d="m6 9 6 6 6-6"
                                stroke-linecap="round"
                                stroke-linejoin="round"/>

                        </svg>

                    </div>


                    <button
                        type="submit"
                        class="training-search-button">

                        Search

                    </button>

                </form>

            </div>


            {{-- HERO IMAGE --}}

            <div class="training-hero-image">

                <img
                    src="{{ asset('assets/img/oooo.png') }}"
                    alt="Trainings hero"
                    onerror="this.style.display='none'">


                <div class="training-floating-card top">

                    <span class="training-floating-icon">

                        <svg
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            viewBox="0 0 24 24">

                            <path d="M12 3 2 8l10 5 10-5-10-5z"/>

                        </svg>

                    </span>

                    <span class="training-floating-text">
                        Guided Courses
                    </span>

                </div>


                <div class="training-floating-card bottom">

                    <span class="training-floating-icon">

                        <svg
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            viewBox="0 0 24 24">

                            <path
                                d="M20 6 9 17l-5-5"
                                stroke-linecap="round"
                                stroke-linejoin="round"/>

                        </svg>

                    </span>

                    <span class="training-floating-text">
                        Track Your Progress
                    </span>

                </div>

            </div>

        </div>

    </section>


    {{-- =========================================================
         BODY
    ========================================================== --}}

    <div class="training-body">


        {{-- FILTER --}}

        <aside class="training-filter">

            <div class="training-filter-header">

                <h3 class="training-filter-title">

                    <svg
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        viewBox="0 0 24 24">

                        <path d="M4 6h16M7 12h10M10 18h4"/>

                    </svg>

                    Filters

                </h3>


                <a
                    href="{{ route('employee.trainings.index') }}"
                    class="training-clear">

                    Clear all

                </a>

            </div>


            <form
                action="{{ route('employee.trainings.index') }}#browse-trainings"
                method="GET">

                <input
                    type="hidden"
                    name="search"
                    value="{{ $activeSearch }}">


                <div class="training-filter-section">

                    <label class="training-filter-label">
                        Category
                    </label>

                    <input
                        type="text"
                        name="category"
                        value="{{ $activeCategory }}"
                        placeholder="e.g. Leadership, Sales..."
                        class="training-filter-input">

                </div>


                <div class="training-filter-section">

                    <label class="training-filter-label">
                        Level
                    </label>


                    <ul class="training-level-list">

                        @foreach ($levels as $lvl)

                            @php

                                $isActive =
                                    $activeLevel === $lvl['value'] ||
                                    (!$activeLevel && $lvl['value'] === '');

                            @endphp

                            <li class="training-level-item">

                                <label
                                    class="training-level-label {{ $isActive ? 'active' : '' }}">

                                    <input
                                        type="radio"
                                        name="level"
                                        value="{{ $lvl['value'] }}"
                                        {{ $isActive ? 'checked' : '' }}
                                        class="accent-blue-600"
                                        onchange="this.form.submit()">

                                    {{ $lvl['label'] }}

                                </label>

                            </li>

                        @endforeach

                    </ul>

                </div>


                <button
                    type="submit"
                    class="training-apply-button">

                    Apply Filters

                </button>

            </form>

        </aside>


        {{-- TRAINING LIST --}}

        <main id="browse-trainings">

            <h2 class="training-list-heading">
                Browse Trainings
            </h2>


            <div class="training-grid">

                @forelse ($trainings as $training)

                    <article class="training-card">


                        <img
                            src="{{ $training->thumbnail
                                ? asset('storage/'.$training->thumbnail)
                                : asset('assets/img/training-placeholder.png') }}"
                            alt="{{ $training->title }}"
                            onerror="this.src='https://via.placeholder.com/400x180?text=Training'"
                            class="training-card-image">


                        <div class="training-card-content">


                            <div class="training-card-badges">

                                <span class="training-badge">

                                    {{ ucfirst($training->level) }}

                                </span>


                                <span class="training-badge">

                                    {{ ucfirst($training->training_type) }}

                                </span>

                            </div>


                            <h3 class="training-card-title training-line-clamp-2">

                                {{ $training->title }}

                            </h3>


                            <p class="training-card-description training-line-clamp-2">

                                {{ Str::limit($training->short_description, 90) }}

                            </p>


                            <a
                                href="{{ route('employee.trainings.show', $training) }}"
                                onclick="return openTrainingModal(event, this.href)"
                                class="training-view-button">

                                View Training

                                <svg
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    viewBox="0 0 24 24"
                                    stroke-linecap="round"
                                    stroke-linejoin="round">

                                    <path d="M5 12h14M13 6l6 6-6 6"/>

                                </svg>

                            </a>

                        </div>

                    </article>

                @empty

                    <div
                        style="grid-column:1/-1;text-align:center;padding:60px 20px;color:#94a3b8;font-size:14px;">

                        No trainings are available right now.

                    </div>

                @endforelse

            </div>


            @if (isset($trainings) && method_exists($trainings, 'links'))

                <div style="margin-top:24px;">
                    {{ $trainings->links() }}
                </div>

            @endif

        </main>

    </div>

</div>


{{-- =============================================================
     TRAINING MODAL
============================================================= --}}

<div
    id="training-modal"
    class="hidden">


    <div
        class="training-modal-overlay"
        onclick="closeTrainingModal()">
    </div>


    <div class="training-modal-wrapper">


        <button
            type="button"
            onclick="closeTrainingModal()"
            class="training-modal-close"
            aria-label="Close">

            <svg
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                viewBox="0 0 24 24">

                <path
                    d="M18 6 6 18M6 6l12 12"
                    stroke-linecap="round"
                    stroke-linejoin="round"/>

            </svg>

        </button>


        <div id="training-modal-content">

        </div>

    </div>

</div>


<script>

    function openTrainingModal(event, url) {

        event.preventDefault();

        const modal =
            document.getElementById('training-modal');

        const content =
            document.getElementById('training-modal-content');


        /* ---------------------------------------------------------
           Loading
        --------------------------------------------------------- */

        content.innerHTML = `

            <div class="training-modal-loading">

                <div class="training-loading-icon">

                    <svg
                        fill="none"
                        viewBox="0 0 24 24">

                        <circle
                            cx="12"
                            cy="12"
                            r="9"
                            stroke="currentColor"
                            stroke-width="3"
                            opacity=".2">
                        </circle>

                        <path
                            fill="currentColor"
                            d="M12 3a9 9 0 0 1 9 9h-3a6 6 0 0 0-6-6V3z">
                        </path>

                    </svg>

                </div>


                <p class="training-loading-text">
                    Loading training details...
                </p>

            </div>

        `;


        modal.classList.remove('hidden');

        document.body.classList.add('overflow-hidden');


        /* ---------------------------------------------------------
           Fetch training
        --------------------------------------------------------- */

        fetch(url)

            .then(function(response) {

                if (!response.ok) {

                    throw new Error('Request failed');

                }

                return response.text();

            })

            .then(function(html) {

                const doc =
                    new DOMParser()
                        .parseFromString(
                            html,
                            'text/html'
                        );


                const details =
                    doc.getElementById(
                        'training-details'
                    );


                if (details) {

                    content.innerHTML =
                        details.outerHTML;

                } else {

                    showTrainingError(
                        'This training could not be found.'
                    );

                }

            })

            .catch(function() {

                showTrainingError(
                    "Couldn't load this training. Please try again."
                );

            });


        history.pushState(
            {
                trainingModal: true
            },
            '',
            url
        );


        return false;

    }


    function showTrainingError(message) {

        const content =
            document.getElementById(
                'training-modal-content'
            );


        content.innerHTML = `

            <div class="training-modal-loading">

                <div class="training-loading-icon">

                    <svg
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        viewBox="0 0 24 24">

                        <circle
                            cx="12"
                            cy="12"
                            r="9">
                        </circle>

                        <path
                            d="M12 8v4M12 16h.01"
                            stroke-linecap="round">
                        </path>

                    </svg>

                </div>


                <p class="training-loading-text">
                    ${message}
                </p>

            </div>

        `;

    }


    function closeTrainingModal() {

        const modal =
            document.getElementById(
                'training-modal'
            );


        modal.classList.add('hidden');

        document.body.classList.remove(
            'overflow-hidden'
        );


        if (
            history.state &&
            history.state.trainingModal
        ) {

            history.back();

        }

    }


    document.addEventListener(
        'keydown',
        function(event) {

            const modal =
                document.getElementById(
                    'training-modal'
                );


            if (
                event.key === 'Escape' &&
                !modal.classList.contains('hidden')
            ) {

                closeTrainingModal();

            }

        }
    );


    window.addEventListener(
        'popstate',
        function() {

            const modal =
                document.getElementById(
                    'training-modal'
                );


            modal.classList.add('hidden');

            document.body.classList.remove(
                'overflow-hidden'
            );

        }
    );

</script>

@endsection