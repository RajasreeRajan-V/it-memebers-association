<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Webinar;
use App\Models\WebinarRegistration;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class CertificateController extends Controller
{
    public function download(Webinar $webinar)
    {
        $registration = WebinarRegistration::where('webinar_id', $webinar->id)
            ->where('student_id', Auth::id())
            ->first();

        abort_unless($registration, 404);
        abort_unless($registration->attendance_status === 'attended', 403, 'Certificate not available yet.');
        abort_unless($webinar->scheduled_date->lt(now()), 403, 'Webinar has not completed yet.');

        $employee = Auth::user();

        $pdf = Pdf::loadView('certificates.webinar', [
            'webinar' => $webinar,
            'student' => $employee,
            'date'    => $webinar->scheduled_date->format('d M, Y'),
        ])->setPaper('a4', 'landscape');

        $filename = 'Certificate-' . str($webinar->title)->slug() . '.pdf';

        return $pdf->download($filename);
    }
}