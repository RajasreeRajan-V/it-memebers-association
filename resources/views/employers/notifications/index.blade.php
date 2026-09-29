@extends('layouts.app')

@section('title', 'Notifications')

@section('content')

<style>
    :root {
        --notification-blue: #3376f2;
        --notification-blue-dark: #245fd0;
        --notification-blue-light: #eef4ff;
        --notification-bg: #f8fafc;
        --notification-text: #172033;
        --notification-muted: #718096;
        --notification-border: #e7ebf2;
        --notification-white: #ffffff;
        --notification-green: #16a34a;
        --notification-orange: #f59e0b;
        --notification-red: #ef4444;
        --notification-purple: #7c3aed;
    }

    .notifications-page {
        width: 100%;
        min-height: calc(100vh - 80px);
        background: var(--notification-bg);
        padding: 40px 20px 60px;
        font-family:
            Poppins,
            Inter,
            -apple-system,
            BlinkMacSystemFont,
            "Segoe UI",
            sans-serif;
        color: var(--notification-text);
    }

    .notifications-container {
        max-width: 1180px;
        margin: 0 auto;
    }

    /* =========================================================
       HEADER
    ========================================================= */

    .notifications-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 30px;
    }

    .notifications-heading {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .notifications-heading-icon {
        width: 52px;
        height: 52px;
        border-radius: 15px;
        background: var(--notification-blue-light);
        color: var(--notification-blue);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .notifications-heading-icon svg {
        width: 25px;
        height: 25px;
    }

    .notifications-heading h1 {
        margin: 0;
        font-size: 27px;
        font-weight: 700;
        letter-spacing: -0.5px;
    }

    .notifications-heading p {
        margin: 4px 0 0;
        color: var(--notification-muted);
        font-size: 14px;
    }

    .unread-count {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 25px;
        height: 25px;
        padding: 0 7px;
        border-radius: 20px;
        background: var(--notification-blue);
        color: #fff;
        font-size: 12px;
        font-weight: 700;
        margin-left: 7px;
    }

    .mark-all-form {
        margin: 0;
    }

    .mark-all-btn {
        border: 1px solid var(--notification-border);
        background: #fff;
        color: var(--notification-text);
        height: 42px;
        padding: 0 17px;
        border-radius: 10px;
        font-family: inherit;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: .2s ease;
    }

    .mark-all-btn:hover {
        border-color: var(--notification-blue);
        color: var(--notification-blue);
        background: var(--notification-blue-light);
    }

    /* =========================================================
       ALERT
    ========================================================= */

    .success-message {
        background: #ecfdf3;
        border: 1px solid #bbf7d0;
        color: #166534;
        padding: 13px 16px;
        border-radius: 11px;
        margin-bottom: 22px;
        font-size: 13px;
        font-weight: 500;
    }

    /* =========================================================
       INTERVIEW SECTION
    ========================================================= */

    .interview-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 20px;
        margin-bottom: 32px;
    }

    .interview-card {
        background: #fff;
        border: 1px solid var(--notification-border);
        border-radius: 17px;
        overflow: hidden;
        box-shadow: 0 5px 18px rgba(15, 23, 42, .035);
    }

    .interview-card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        padding: 19px 20px;
        border-bottom: 1px solid var(--notification-border);
    }

    .interview-card-title {
        display: flex;
        align-items: center;
        gap: 11px;
    }

    .interview-card-icon {
        width: 39px;
        height: 39px;
        border-radius: 11px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--notification-blue-light);
        color: var(--notification-blue);
    }

    .interview-card-icon svg {
        width: 19px;
        height: 19px;
    }

    .interview-card-title h2 {
        margin: 0;
        font-size: 15px;
        font-weight: 700;
    }

    .interview-card-title span {
        display: block;
        margin-top: 2px;
        font-size: 11px;
        color: var(--notification-muted);
    }

    .interview-count {
        min-width: 27px;
        height: 27px;
        padding: 0 8px;
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f1f5f9;
        color: #475569;
        font-size: 11px;
        font-weight: 700;
    }

    .interview-list {
        padding: 6px 20px;
    }

    .interview-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        padding: 15px 0;
        border-bottom: 1px solid #f0f2f6;
    }

    .interview-item:last-child {
        border-bottom: 0;
    }

    .interview-person {
        display: flex;
        align-items: center;
        gap: 12px;
        min-width: 0;
    }

    .candidate-avatar {
        width: 40px;
        height: 40px;
        border-radius: 12px;
        background: var(--notification-blue-light);
        color: var(--notification-blue);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 13px;
        font-weight: 700;
        flex-shrink: 0;
    }

    .interview-info {
        min-width: 0;
    }

    .interview-info h3 {
        margin: 0;
        font-size: 13px;
        font-weight: 700;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .interview-job {
        margin-top: 3px;
        color: var(--notification-muted);
        font-size: 11px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .interview-time {
        text-align: right;
        flex-shrink: 0;
    }

    .interview-time strong {
        display: block;
        font-size: 12px;
        color: var(--notification-text);
    }

    .interview-mode {
        margin-top: 3px;
        color: var(--notification-muted);
        font-size: 10px;
        text-transform: capitalize;
    }

    .empty-interviews {
        padding: 28px 10px;
        text-align: center;
        color: var(--notification-muted);
        font-size: 12px;
    }

    /* =========================================================
       NOTIFICATION CARD
    ========================================================= */

    .notification-section-title {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 14px;
    }

    .notification-section-title h2 {
        margin: 0;
        font-size: 18px;
        font-weight: 700;
    }

    .notification-section-title span {
        font-size: 12px;
        color: var(--notification-muted);
    }

    .notifications-card {
        background: #fff;
        border: 1px solid var(--notification-border);
        border-radius: 17px;
        overflow: hidden;
        box-shadow: 0 5px 18px rgba(15, 23, 42, .035);
    }

    .notification-item {
        display: flex;
        align-items: flex-start;
        gap: 15px;
        padding: 19px 21px;
        border-bottom: 1px solid #eef1f5;
        transition: background .2s ease;
    }

    .notification-item:last-child {
        border-bottom: 0;
    }

    .notification-item:hover {
        background: #fbfcfe;
    }

    .notification-item.unread {
        background: #f8fbff;
    }

    .notification-icon {
        width: 43px;
        height: 43px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .notification-icon svg {
        width: 20px;
        height: 20px;
    }

    .notification-icon.application {
        background: #eef4ff;
        color: #3376f2;
    }

    .notification-icon.article {
        background: #f3e8ff;
        color: #7c3aed;
    }

    .notification-icon.interview {
        background: #ecfdf3;
        color: #16a34a;
    }

    .notification-icon.system {
        background: #fff7ed;
        color: #ea580c;
    }

    .notification-content {
        flex: 1;
        min-width: 0;
    }

    .notification-title-row {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 4px;
    }

    .notification-title {
        margin: 0;
        font-size: 13px;
        font-weight: 700;
    }

    .unread-dot {
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background: var(--notification-blue);
        flex-shrink: 0;
    }

    .notification-message {
        margin: 0;
        color: #596579;
        font-size: 12px;
        line-height: 1.6;
    }

    .notification-time {
        margin-top: 7px;
        color: #98a2b3;
        font-size: 10px;
    }

    .notification-actions {
        display: flex;
        align-items: center;
        gap: 6px;
        flex-shrink: 0;
    }

    .notification-action {
        width: 34px;
        height: 34px;
        border: 1px solid var(--notification-border);
        border-radius: 9px;
        background: #fff;
        color: #64748b;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: .2s ease;
    }

    .notification-action:hover {
        color: var(--notification-blue);
        border-color: #cddcff;
        background: var(--notification-blue-light);
    }

    .notification-action.delete:hover {
        color: var(--notification-red);
        border-color: #fecaca;
        background: #fef2f2;
    }

    .notification-action svg {
        width: 15px;
        height: 15px;
    }

    .notification-empty {
        padding: 65px 20px;
        text-align: center;
    }

    .notification-empty-icon {
        width: 58px;
        height: 58px;
        border-radius: 17px;
        background: #f1f5f9;
        color: #94a3b8;
        margin: 0 auto 14px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .notification-empty-icon svg {
        width: 26px;
        height: 26px;
    }

    .notification-empty h3 {
        margin: 0;
        font-size: 15px;
        font-weight: 700;
    }

    .notification-empty p {
        margin: 6px auto 0;
        max-width: 360px;
        color: var(--notification-muted);
        font-size: 12px;
    }

    /* =========================================================
       PAGINATION
    ========================================================= */

    .pagination-wrapper {
        padding: 18px 20px;
        border-top: 1px solid #eef1f5;
    }

    .pagination-wrapper nav {
        display: flex;
        justify-content: center;
    }

    /* =========================================================
       RESPONSIVE
    ========================================================= */

    @media (max-width: 850px) {
        .interview-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 650px) {
        .notifications-page {
            padding: 25px 14px 40px;
        }

        .notifications-header {
            align-items: flex-start;
            flex-direction: column;
        }

        .notification-item {
            padding: 16px;
        }

        .notification-actions {
            flex-direction: column;
        }

        .interview-item {
            align-items: flex-start;
        }

        .interview-time {
            text-align: left;
        }
    }
</style>


<div class="notifications-page">

    <div class="notifications-container">

        {{-- ======================================================
             HEADER
        ======================================================= --}}

        <div class="notifications-header">

            <div class="notifications-heading">

                <div class="notifications-heading-icon">
                    <svg viewBox="0 0 24 24"
                         fill="none"
                         stroke="currentColor"
                         stroke-width="1.8"
                         stroke-linecap="round"
                         stroke-linejoin="round">
                        <path d="M18 8a6 6 0 0 0-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9"/>
                        <path d="M13.73 21a2 2 0 0 1-3.46 0"/>
                    </svg>
                </div>

                <div>
                    <h1>
                        Notifications

                        @if($unreadCount > 0)
                            <span class="unread-count">
                                {{ $unreadCount }}
                            </span>
                        @endif
                    </h1>

                    <p>
                        Stay updated with applicants, articles and interviews.
                    </p>
                </div>

            </div>

            @if($unreadCount > 0)
                <form
                    action="{{ route('employer.notifications.readAll') }}"
                    method="POST"
                    class="mark-all-form"
                >
                    @csrf
                    @method('PATCH')

                    <button type="submit" class="mark-all-btn">
                        Mark all as read
                    </button>
                </form>
            @endif

        </div>


        {{-- ======================================================
             SUCCESS MESSAGE
        ======================================================= --}}

        @if(session('success'))
            <div class="success-message">
                {{ session('success') }}
            </div>
        @endif


        {{-- ======================================================
             TODAY / TOMORROW INTERVIEWS
        ======================================================= --}}

        <div class="interview-grid">

            {{-- TODAY --}}

            <div class="interview-card">

                <div class="interview-card-header">

                    <div class="interview-card-title">

                        <div class="interview-card-icon">
                            <svg viewBox="0 0 24 24"
                                 fill="none"
                                 stroke="currentColor"
                                 stroke-width="1.8"
                                 stroke-linecap="round"
                                 stroke-linejoin="round">
                                <rect x="3" y="4" width="18" height="18" rx="2"/>
                                <line x1="16" y1="2" x2="16" y2="6"/>
                                <line x1="8" y1="2" x2="8" y2="6"/>
                                <line x1="3" y1="10" x2="21" y2="10"/>
                            </svg>
                        </div>

                        <div>
                            <h2>Interviews Today</h2>
                            <span>{{ now()->format('d M Y') }}</span>
                        </div>

                    </div>

                    <div class="interview-count">
                        {{ $todayInterviews->count() }}
                    </div>

                </div>


                @if($todayInterviews->count())

                    <div class="interview-list">

                        @foreach($todayInterviews as $interview)

                            @php
                                $candidate =
                                    $interview->application?->user?->name
                                    ?? 'Candidate';

                                $jobTitle =
                                    $interview->application?->jobPost?->title
                                    ?? 'Job Position';

                                $initial =
                                    strtoupper(
                                        substr(
                                            trim($candidate),
                                            0,
                                            1
                                        )
                                    );
                            @endphp

                            <div class="interview-item">

                                <div class="interview-person">

                                    <div class="candidate-avatar">
                                        {{ $initial }}
                                    </div>

                                    <div class="interview-info">

                                        <h3>
                                            {{ $candidate }}
                                        </h3>

                                        <div class="interview-job">
                                            {{ $jobTitle }}
                                        </div>

                                    </div>

                                </div>

                                <div class="interview-time">

                                    <strong>
                                        {{ $interview->scheduled_at->format('h:i A') }}
                                    </strong>

                                    <div class="interview-mode">
                                        {{ str_replace('_', ' ', $interview->mode) }}
                                    </div>

                                </div>

                            </div>

                        @endforeach

                    </div>

                @else

                    <div class="empty-interviews">
                        No upcoming interviews scheduled for today.
                    </div>

                @endif

            </div>


            {{-- TOMORROW --}}

            <div class="interview-card">

                <div class="interview-card-header">

                    <div class="interview-card-title">

                        <div class="interview-card-icon">
                            <svg viewBox="0 0 24 24"
                                 fill="none"
                                 stroke="currentColor"
                                 stroke-width="1.8"
                                 stroke-linecap="round"
                                 stroke-linejoin="round">
                                <rect x="3" y="4" width="18" height="18" rx="2"/>
                                <line x1="16" y1="2" x2="16" y2="6"/>
                                <line x1="8" y1="2" x2="8" y2="6"/>
                                <line x1="3" y1="10" x2="21" y2="10"/>
                            </svg>
                        </div>

                        <div>
                            <h2>Interviews Tomorrow</h2>
                            <span>
                                {{ now()->addDay()->format('d M Y') }}
                            </span>
                        </div>

                    </div>

                    <div class="interview-count">
                        {{ $tomorrowInterviews->count() }}
                    </div>

                </div>


                @if($tomorrowInterviews->count())

                    <div class="interview-list">

                        @foreach($tomorrowInterviews as $interview)

                            @php
                                $candidate =
                                    $interview->application?->user?->name
                                    ?? 'Candidate';

                                $jobTitle =
                                    $interview->application?->jobPost?->title
                                    ?? 'Job Position';

                                $initial =
                                    strtoupper(
                                        substr(
                                            trim($candidate),
                                            0,
                                            1
                                        )
                                    );
                            @endphp

                            <div class="interview-item">

                                <div class="interview-person">

                                    <div class="candidate-avatar">
                                        {{ $initial }}
                                    </div>

                                    <div class="interview-info">

                                        <h3>
                                            {{ $candidate }}
                                        </h3>

                                        <div class="interview-job">
                                            {{ $jobTitle }}
                                        </div>

                                    </div>

                                </div>

                                <div class="interview-time">

                                    <strong>
                                        {{ $interview->scheduled_at->format('h:i A') }}
                                    </strong>

                                    <div class="interview-mode">
                                        {{ str_replace('_', ' ', $interview->mode) }}
                                    </div>

                                </div>

                            </div>

                        @endforeach

                    </div>

                @else

                    <div class="empty-interviews">
                        No interviews scheduled for tomorrow.
                    </div>

                @endif

            </div>

        </div>


        {{-- ======================================================
             NOTIFICATIONS
        ======================================================= --}}

        <div class="notification-section-title">

            <h2>Recent Notifications</h2>

            <span>
                {{ $notifications->total() }}
                {{ $notifications->total() === 1 ? 'notification' : 'notifications' }}
            </span>

        </div>


        <div class="notifications-card">

            @forelse($notifications as $notification)

                @php

                    $type = $notification->type ?? 'system';

                    $iconType = match($type) {
                        'application' => 'application',
                        'article' => 'article',
                        'interview' => 'interview',
                        default => 'system',
                    };

                @endphp


                <div class="notification-item
                    {{ !$notification->is_read ? 'unread' : '' }}">

                    {{-- ICON --}}

                    <div class="notification-icon {{ $iconType }}">

                        @if($iconType === 'application')

                            <svg viewBox="0 0 24 24"
                                 fill="none"
                                 stroke="currentColor"
                                 stroke-width="1.8"
                                 stroke-linecap="round"
                                 stroke-linejoin="round">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                                <circle cx="9" cy="7" r="4"/>
                                <path d="M19 8v6"/>
                                <path d="M22 11h-6"/>
                            </svg>

                        @elseif($iconType === 'article')

                            <svg viewBox="0 0 24 24"
                                 fill="none"
                                 stroke="currentColor"
                                 stroke-width="1.8"
                                 stroke-linecap="round"
                                 stroke-linejoin="round">
                                <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/>
                                <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/>
                                <line x1="8" y1="7" x2="16" y2="7"/>
                                <line x1="8" y1="11" x2="16" y2="11"/>
                            </svg>

                        @elseif($iconType === 'interview')

                            <svg viewBox="0 0 24 24"
                                 fill="none"
                                 stroke="currentColor"
                                 stroke-width="1.8"
                                 stroke-linecap="round"
                                 stroke-linejoin="round">
                                <circle cx="12" cy="12" r="9"/>
                                <polyline points="12 7 12 12 15 14"/>
                            </svg>

                        @else

                            <svg viewBox="0 0 24 24"
                                 fill="none"
                                 stroke="currentColor"
                                 stroke-width="1.8"
                                 stroke-linecap="round"
                                 stroke-linejoin="round">
                                <circle cx="12" cy="12" r="9"/>
                                <line x1="12" y1="8" x2="12" y2="12"/>
                                <line x1="12" y1="16" x2="12.01" y2="16"/>
                            </svg>

                        @endif

                    </div>


                    {{-- CONTENT --}}

                    <div class="notification-content">

                        <div class="notification-title-row">

                            <h3 class="notification-title">
                                {{ $notification->title }}
                            </h3>

                            @if(!$notification->is_read)
                                <span class="unread-dot"></span>
                            @endif

                        </div>

                        <p class="notification-message">
                            {{ $notification->message }}
                        </p>

                        <div class="notification-time">
                            {{ $notification->created_at?->diffForHumans() }}
                        </div>

                    </div>


                    {{-- ACTIONS --}}

                    <div class="notification-actions">

                        @if($notification->is_read)

                            <form
                                action="{{ route(
                                    'employer.notifications.unread',
                                    $notification->id
                                ) }}"
                                method="POST"
                            >
                                @csrf
                                @method('PATCH')

                                <button
                                    type="submit"
                                    class="notification-action"
                                    title="Mark as unread"
                                >
                                    <svg viewBox="0 0 24 24"
                                         fill="none"
                                         stroke="currentColor"
                                         stroke-width="1.8"
                                         stroke-linecap="round"
                                         stroke-linejoin="round">
                                        <path d="M4 4h16v16H4z"/>
                                        <polyline points="22,6 12,13 2,6"/>
                                    </svg>
                                </button>

                            </form>

                        @else

                            <form
                                action="{{ route(
                                    'employer.notifications.read',
                                    $notification->id
                                ) }}"
                                method="POST"
                            >
                                @csrf
                                @method('PATCH')

                                <button
                                    type="submit"
                                    class="notification-action"
                                    title="Mark as read"
                                >
                                    <svg viewBox="0 0 24 24"
                                         fill="none"
                                         stroke="currentColor"
                                         stroke-width="1.8"
                                         stroke-linecap="round"
                                         stroke-linejoin="round">
                                        <polyline points="20 6 9 17 4 12"/>
                                    </svg>
                                </button>

                            </form>

                        @endif


                        <form
                            action="{{ route(
                                'employer.notifications.destroy',
                                $notification->id
                            ) }}"
                            method="POST"
                            onsubmit="return confirm('Delete this notification?')"
                        >
                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="notification-action delete"
                                title="Delete"
                            >
                                <svg viewBox="0 0 24 24"
                                     fill="none"
                                     stroke="currentColor"
                                     stroke-width="1.8"
                                     stroke-linecap="round"
                                     stroke-linejoin="round">
                                    <polyline points="3 6 5 6 21 6"/>
                                    <path d="M19 6l-1 14H6L5 6"/>
                                    <path d="M10 11v5"/>
                                    <path d="M14 11v5"/>
                                    <path d="M9 6V4h6v2"/>
                                </svg>
                            </button>

                        </form>

                    </div>

                </div>

            @empty

                <div class="notification-empty">

                    <div class="notification-empty-icon">

                        <svg viewBox="0 0 24 24"
                             fill="none"
                             stroke="currentColor"
                             stroke-width="1.8"
                             stroke-linecap="round"
                             stroke-linejoin="round">
                            <path d="M18 8a6 6 0 0 0-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9"/>
                            <path d="M13.73 21a2 2 0 0 1-3.46 0"/>
                        </svg>

                    </div>

                    <h3>No notifications yet</h3>

                    <p>
                        New applicants, published articles and other
                        important employer updates will appear here.
                    </p>

                </div>

            @endforelse


            {{-- PAGINATION --}}

            @if($notifications->hasPages())

                <div class="pagination-wrapper">
                    {{ $notifications->links() }}
                </div>

            @endif

        </div>

    </div>

</div>

@endsection