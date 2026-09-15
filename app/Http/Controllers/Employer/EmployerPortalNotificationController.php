<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\EmployerPortalNotification;
use Illuminate\Http\Request;

class EmployerPortalNotificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Notifications
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        $employer = $request->user();

        $notifications = EmployerPortalNotification::where(
            'employer_id',
            $employer->id
        )
        ->latest()
        ->paginate(15);

        return view(
            'employers.notifications.index',
            compact('notifications')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Mark One As Read
    |--------------------------------------------------------------------------
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

        /*
        | If notification has a URL,
        | redirect there.
        */

        if (!empty($notification->url)) {
            return redirect($notification->url);
        }

        return back();
    }


    /*
    |--------------------------------------------------------------------------
    | Mark One As Unread
    |--------------------------------------------------------------------------
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


    /*
    |--------------------------------------------------------------------------
    | Mark All As Read
    |--------------------------------------------------------------------------
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


    /*
    |--------------------------------------------------------------------------
    | Delete One Notification
    |--------------------------------------------------------------------------
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