<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\EmployerPortalNotification;
use App\Models\Interview;
use Illuminate\Http\Request;

class EmployerPortalNotificationController extends Controller
{
    /**
     * Employer notifications page
     */
    public function index(Request $request)
    {
        $employer = $request->user();

        /*
        |--------------------------------------------------------------------------
        | Regular notifications
        |--------------------------------------------------------------------------
        */
        $notifications = EmployerPortalNotification::where(
            'employer_id',
            $employer->id
        )
            ->latest()
            ->paginate(15)
            ->withQueryString();

        /*
        |--------------------------------------------------------------------------
        | Unread notification count
        |--------------------------------------------------------------------------
        */
        $unreadCount = EmployerPortalNotification::where(
            'employer_id',
            $employer->id
        )
            ->where('is_read', false)
            ->count();

        /*
        |--------------------------------------------------------------------------
        | Today's upcoming interviews
        |--------------------------------------------------------------------------
        */
        $todayInterviews = Interview::with([
            'application.jobPost',
            'application.user',
        ])
            ->where('employer_id', $employer->id)
            ->whereIn('status', [
                Interview::STATUS_SCHEDULED,
                Interview::STATUS_RESCHEDULED,
            ])
            ->whereDate('scheduled_at', today())
            ->where('scheduled_at', '>=', now())
            ->orderBy('scheduled_at')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Tomorrow's interviews
        |--------------------------------------------------------------------------
        */
        $tomorrowInterviews = Interview::with([
            'application.jobPost',
            'application.user',
        ])
            ->where('employer_id', $employer->id)
            ->whereIn('status', [
                Interview::STATUS_SCHEDULED,
                Interview::STATUS_RESCHEDULED,
            ])
            ->whereDate(
                'scheduled_at',
                now()->addDay()->toDateString()
            )
            ->orderBy('scheduled_at')
            ->get();

        return view(
            'employers.notifications.index',
            compact(
                'notifications',
                'unreadCount',
                'todayInterviews',
                'tomorrowInterviews'
            )
        );
    }

    /**
     * Mark one notification as read
     */
    public function markAsRead(Request $request, $id)
    {
        $notification = EmployerPortalNotification::where(
            'employer_id',
            $request->user()->id
        )->findOrFail($id);

        $notification->update([
            'is_read' => true,
        ]);

        if (!empty($notification->url)) {
            return redirect($notification->url);
        }

        return back();
    }

    /**
     * Mark one notification as unread
     */
    public function markAsUnread(Request $request, $id)
    {
        $notification = EmployerPortalNotification::where(
            'employer_id',
            $request->user()->id
        )->findOrFail($id);

        $notification->update([
            'is_read' => false,
        ]);

        return back();
    }

    /**
     * Mark all notifications as read
     */
    public function markAllAsRead(Request $request)
    {
        EmployerPortalNotification::where(
            'employer_id',
            $request->user()->id
        )
            ->where('is_read', false)
            ->update([
                'is_read' => true,
            ]);

        return back()->with(
            'success',
            'All notifications marked as read.'
        );
    }

    /**
     * Delete notification
     */
    public function destroy(Request $request, $id)
    {
        $notification = EmployerPortalNotification::where(
            'employer_id',
            $request->user()->id
        )->findOrFail($id);

        $notification->delete();

        return back()->with(
            'success',
            'Notification deleted.'
        );
    }
}