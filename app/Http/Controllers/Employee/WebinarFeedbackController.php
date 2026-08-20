<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Webinar;
use App\Models\WebinarFeedback;
use App\Models\WebinarRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WebinarFeedbackController extends Controller
{
    public function store(Request $request, Webinar $webinar)
    {
        $employeeId = Auth::id();

        $registration = WebinarRegistration::where('webinar_id', $webinar->id)
            ->where('student_id', $employeeId)
            ->first();

        abort_unless($registration, 404);
        abort_unless($webinar->scheduled_date->lt(now()), 403, 'You can only review a completed webinar.');

        $data = $request->validate([
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'review' => ['nullable', 'string', 'max:1000'],
        ]);

        WebinarFeedback::updateOrCreate(
            ['webinar_id' => $webinar->id, 'student_id' => $employeeId],
            ['rating' => $data['rating'], 'review' => $data['review'] ?? null]
        );

        return back()->with('success', 'Thanks for your feedback!');
    }
}