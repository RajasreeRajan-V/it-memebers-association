<?php

namespace App\Http\Controllers\Mentor;

use App\Http\Controllers\Controller;
use App\Models\Webinar;
use Illuminate\Support\Facades\Auth;

class WebinarRegistrationController extends Controller
{
    public function index(Webinar $webinar)
    {
        abort_unless($webinar->mentor_id === Auth::id(), 403);

        $registrations = $webinar->registrations()
            ->with('student')
            ->orderByDesc('registered_at')
            ->paginate(20);

        return view('mentor.webinars.registrations', [
            'webinar' => $webinar,
            'registrations' => $registrations,
        ]);
    }

    /**
     * Download the full registration list as a CSV — the "Export Attendance" button.
     */
    public function export(Webinar $webinar)
    {
        abort_unless($webinar->mentor_id === Auth::id(), 403);

        $registrations = $webinar->registrations()->with('student')->get();
        $filename = 'registrations-' . str($webinar->title)->slug() . '.csv';

        return response()->streamDownload(function () use ($registrations) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['Name', 'Email', 'Status', 'Registered At']);

            foreach ($registrations as $registration) {
                fputcsv($handle, [
                    $registration->student->name ?? '—',
                    $registration->student->email ?? '—',
                    ucfirst($registration->status),
                    optional($registration->registered_at)->format('d M Y, h:i A'),
                ]);
            }

            fclose($handle);
        }, $filename, ['Content-Type' => 'text/csv']);
    }
}
