@extends('layouts.app')

@section('title', 'Notifications')

@section('content')

<style>
    .notifications-page {
        width: 100%;
        min-height: calc(100vh - 80px);
        background: #f8fafc;
        padding: 35px 30px 60px;
        font-family: Poppins, Inter, sans-serif;
        color: #172033;
    }

    .notifications-container {
        max-width: 1100px;
        margin: 0 auto;
    }

    /* Header */
    .notifications-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 25px;
    }

    .notifications-title h1 {
        margin: 0;
        font-size: 28px;
        font-weight: 700;
        color: #172033;
    }

    .notifications-title p {
        margin: 6px 0 0;
        color: #718096;
        font-size: 14px;
    }

    .mark-all-btn {
        border: 0;
        background: #3376f2;
        color: #fff;
        padding: 11px 18px;
        border-radius: 9px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: .2s ease;
    }

    .mark-all-btn:hover {
        background: #245fd0;
    }

    /* Notification card */
    .notifications-card {
        background: #fff;
        border: 1px solid #e8edf5;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 18px rgba(15, 23, 42, .04);
    }

    .notification-item {
        display: flex;
        align-items: flex-start;
        gap: 15px;
        padding: 20px 22px;
        border-bottom: 1px solid #edf1f7;
        transition: background .2s ease;
    }

    .notification-item:last-child {
        border-bottom: 0;
    }

    .notification-item.unread {
        background: #f4f8ff;
    }

    .notification-item:hover {
        background: #f8fbff;
    }

    /* Icon */
    .notification-icon {
        width: 44px;
        height: 44px;
        min-width: 44px;
        border-radius: 12px;
        background: #eaf2ff;
        color: #3376f2;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 17px;
    }

    .notification-content {
        flex: 1;
        min-width: 0;
    }

    .notification-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
    }

    .notification-title {
        margin: 0;
        font-size: 15px;
        font-weight: 700;
        color: #172033;
    }

    .notification-message {
        margin: 6px 0 8px;
        font-size: 13px;
        line-height: 1.6;
        color: #667085;
    }

    .notification-time {
        font-size: 11px;
        color: #98a2b3;
    }

    .unread-dot {
        width: 8px;
        height: 8px;
        min-width: 8px;
        background: #3376f2;
        border-radius: 50%;
        margin-top: 6px;
    }

    /* Actions */
    .notification-actions {
        display: flex;
        align-items: center;
        gap: 7px;
        margin-left: auto;
    }

    .notification-action {
        border: 1px solid #e1e7ef;
        background: #fff;
        color: #475467;
        padding: 7px 11px;
        border-radius: 7px;
        font-size: 11px;
        font-weight: 600;
        cursor: pointer;
        text-decoration: none;
        transition: .2s ease;
    }

    .notification-action:hover {
        border-color: #3376f2;
        color: #3376f2;
        background: #f5f8ff;
    }

    .notification-action.delete:hover {
        border-color: #ef4444;
        color: #ef4444;
        background: #fff5f5;
    }

    /* Empty state */
    .empty-notifications {
        padding: 70px 20px;
        text-align: center;
    }

    .empty-icon {
        width: 65px;
        height: 65px;
        margin: 0 auto 18px;
        border-radius: 50%;
        background: #eef4ff;
        color: #3376f2;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 25px;
    }

    .empty-notifications h3 {
        margin: 0 0 7px;
        font-size: 18px;
        color: #172033;
    }

    .empty-notifications p {
        margin: 0;
        color: #98a2b3;
        font-size: 13px;
    }

    /* Pagination */
    .pagination-wrapper {
        margin-top: 25px;
    }

    .pagination-wrapper nav {
        display: flex;
        justify-content: center;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .notifications-page {
            padding: 25px 15px 40px;
        }

        .notifications-header {
            align-items: flex-start;
            flex-direction: column;
        }

        .notification-item {
            padding: 17px 15px;
        }

        .notification-top {
            align-items: flex-start;
            flex-direction: column;
            gap: 5px;
        }

        .notification-actions {
            flex-wrap: wrap;
            margin-left: 59px;
        }
    }

    @media (max-width: 500px) {
        .notification-icon {
            width: 38px;
            height: 38px;
            min-width: 38px;
        }

        .notification-actions {
            margin-left: 53px;
        }

        .notification-action {
            padding: 6px 9px;
        }
    }
</style>


<div class="notifications-page">

    <div class="notifications-container">

        {{-- Page Header --}}
        <div class="notifications-header">

            <div class="notifications-title">
                <h1>Notifications</h1>

                <p>
                    Stay updated with applications, articles and other activities.
                </p>
            </div>

            @if($notifications->where('is_read', false)->count() > 0)

                <form
                    action="{{ route('employer.notifications.mark-all-read') }}"
                    method="POST"
                >
                    @csrf

                    <button type="submit" class="mark-all-btn">
                        <i class="fa-solid fa-check-double"></i>
                        Mark All as Read
                    </button>
                </form>

            @endif

        </div>


        {{-- Notifications --}}
        <div class="notifications-card">

            @forelse($notifications as $notification)

                <div
                    class="notification-item {{ !$notification->is_read ? 'unread' : '' }}"
                >

                    {{-- Icon --}}
                    <div class="notification-icon">

                        @if($notification->type === 'application')

                            <i class="fa-solid fa-user-plus"></i>

                        @elseif($notification->type === 'article')

                            <i class="fa-solid fa-newspaper"></i>

                        @else

                            <i class="fa-solid fa-bell"></i>

                        @endif

                    </div>


                    {{-- Content --}}
                    <div class="notification-content">

                        <div class="notification-top">

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

                            <i class="fa-regular fa-clock"></i>

                            {{ $notification->created_at->diffForHumans() }}

                        </div>

                    </div>


                    {{-- Actions --}}
                    <div class="notification-actions">

                        @if(!$notification->is_read)

                            <form
                                action="{{ route('employer.notifications.read', $notification->id) }}"
                                method="POST"
                            >
                                @csrf

                                <button
                                    type="submit"
                                    class="notification-action"
                                    title="Mark as read"
                                >
                                    <i class="fa-solid fa-check"></i>
                                    Read
                                </button>
                            </form>

                        @else

                            <form
                                action="{{ route('employer.notifications.unread', $notification->id) }}"
                                method="POST"
                            >
                                @csrf

                                <button
                                    type="submit"
                                    class="notification-action"
                                    title="Mark as unread"
                                >
                                    <i class="fa-regular fa-envelope"></i>
                                    Unread
                                </button>
                            </form>

                        @endif


                        @if($notification->url)

                            <a
                                href="{{ $notification->url }}"
                                class="notification-action"
                            >
                                <i class="fa-solid fa-arrow-right"></i>
                                View
                            </a>

                        @endif


                        <form
                            action="{{ route('employer.notifications.destroy', $notification->id) }}"
                            method="POST"
                            onsubmit="return confirm('Delete this notification?');"
                        >
                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="notification-action delete"
                                title="Delete notification"
                            >
                                <i class="fa-regular fa-trash-can"></i>
                            </button>
                        </form>

                    </div>

                </div>

            @empty

                <div class="empty-notifications">

                    <div class="empty-icon">
                        <i class="fa-regular fa-bell"></i>
                    </div>

                    <h3>No notifications yet</h3>

                    <p>
                        You will see job applications and other important updates here.
                    </p>

                </div>

            @endforelse

        </div>


        {{-- Pagination --}}
        @if($notifications->hasPages())

            <div class="pagination-wrapper">
                {{ $notifications->links() }}
            </div>

        @endif

    </div>

</div>

@endsection