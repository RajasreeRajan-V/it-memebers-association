<?php

namespace App\Http\Controllers\Mentor;

use App\Http\Controllers\Controller;
use App\Models\Webinar;
use App\Models\WebinarResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class WebinarAttendanceController extends Controller
{
    /**
     * Show the attendance sheet + resource manager for a mentor's webinar.
     */
    public function edit(Webinar $webinar)
    {
        abort_unless($webinar->mentor_id === Auth::id(), 403);

        $registrations = $webinar->registrations()
            ->with('student')
            ->where('status', 'approved')
            ->orderBy('id')
            ->get();

        $resources = $webinar->resources()->latest()->get();

        return view('mentor.webinars.attendance', [
            'webinar'       => $webinar,
            'registrations' => $registrations,
            'resources'     => $resources,
        ]);
    }

    /**
     * Bulk-save attendance status + join/leave times for every registered student.
     * Expects: attendance[{registration_id}][status|joined_at|left_at]
     */
    public function updateAttendance(Request $request, Webinar $webinar)
    {
        abort_unless($webinar->mentor_id === Auth::id(), 403);

        $data = $request->validate([
            'attendance'                    => ['required', 'array'],
            'attendance.*.status'           => ['required', 'in:registered,joined,attended,absent'],
            'attendance.*.joined_at'        => ['nullable', 'date'],
            'attendance.*.left_at'          => ['nullable', 'date'],
        ]);

        foreach ($data['attendance'] as $registrationId => $row) {
            $webinar->registrations()
                ->where('id', $registrationId)
                ->update([
                    'attendance_status' => $row['status'],
                    'joined_at'         => $row['joined_at'] ?? null,
                    'left_at'           => $row['left_at'] ?? null,
                ]);
        }

        return back()->with('success', 'Attendance updated.');
    }

    /**
     * Add a resource: a recording link, or an uploaded file (pdf/ppt/code/other).
     */
    public function storeResource(Request $request, Webinar $webinar)
    {
        abort_unless($webinar->mentor_id === Auth::id(), 403);

        $data = $request->validate([
            'type'  => ['required', 'in:recording,pdf,ppt,code,other'],
            'title' => ['required', 'string', 'max:255'],
            'url'   => ['nullable', 'url'],
            'file'  => ['nullable', 'file', 'max:51200'], // 50MB
        ]);

        if (empty($data['url']) && ! $request->hasFile('file')) {
            return back()->with('error', 'Provide either a link or a file.');
        }

        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('webinars/resources', 'public');
        }

        WebinarResource::create([
            'webinar_id' => $webinar->id,
            'type'       => $data['type'],
            'title'      => $data['title'],
            'url'        => $data['url'] ?? null,
            'file_path'  => $filePath,
        ]);

        return back()->with('success', 'Resource added.');
    }

    /**
     * Remove a resource.
     */
    public function destroyResource(WebinarResource $resource)
    {
        abort_unless($resource->webinar->mentor_id === Auth::id(), 403);

        if ($resource->file_path) {
            Storage::disk('public')->delete($resource->file_path);
        }

        $resource->delete();

        return back()->with('success', 'Resource removed.');
    }
}