<?php

namespace App\Http\Controllers\Mentor;

use App\Http\Controllers\Controller;
use App\Models\MentorshipSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionLifecycleController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Conduct Session
    |--------------------------------------------------------------------------
    */

    public function conduct(MentorshipSession $session)
    {
        abort_unless(
            $session->mentor_id === Auth::id(),
            403
        );

        abort_unless(
            in_array($session->status, [
                'scheduled',
                'confirmed',
            ]),
            422,
            'This session cannot be conducted.'
        );

        $session->update([
            'status' => 'in_progress',
        ]);

        return back()->with(
            'success',
            'Session started successfully.'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Store Mentor Notes
    |--------------------------------------------------------------------------
    */

    public function storeNotes(
        Request $request,
        MentorshipSession $session
    ) {
        abort_unless(
            $session->mentor_id === Auth::id(),
            403
        );

        $data = $request->validate([
            'mentor_notes' => [
                'required',
                'string',
                'max:5000',
            ],
        ]);

        $session->update([
            'mentor_notes' => $data['mentor_notes'],
        ]);

        return back()->with(
            'success',
            'Session notes saved successfully.'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Complete Session
    |--------------------------------------------------------------------------
    */

    public function markCompleted(MentorshipSession $session)
    {
        abort_unless(
            $session->mentor_id === Auth::id(),
            403
        );

        abort_unless(
            in_array($session->status, [
                'scheduled',
                'confirmed',
                'in_progress',
            ]),
            422,
            'This session cannot be completed.'
        );

        $session->update([
            'status' => 'completed',
        ]);

        return back()->with(
            'success',
            'Session marked as completed.'
        );
    }
}