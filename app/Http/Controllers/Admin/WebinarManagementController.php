<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Webinar;
use Illuminate\Http\Request;

class WebinarManagementController extends Controller
{
    public function index(Request $request)
    {
        $webinars = Webinar::with('mentor')
            ->when($request->status, fn ($q) => $q->where('status', $request->status))
            ->latest()
            ->paginate(15);

        return view('admin.webinars.index', compact('webinars'));
    }

    public function approve(Webinar $webinar)
    {
        $webinar->update(['status' => 'approved', 'admin_remarks' => null]);

        return back()->with('success', 'Webinar approved.');
    }

    public function reject(Request $request, Webinar $webinar)
    {
        $data = $request->validate([
            'admin_remarks' => ['required', 'string'],
        ]);

        $webinar->update(['status' => 'rejected', 'admin_remarks' => $data['admin_remarks']]);

        return back()->with('success', 'Webinar rejected.');
    }

    public function publish(Webinar $webinar)
    {
        abort_unless($webinar->status === 'approved', 422, 'Only approved webinars can be published.');

        $webinar->update(['status' => 'published']);

        return back()->with('success', 'Webinar published.');
    }
}
