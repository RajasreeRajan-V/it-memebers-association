<?php

namespace App\Http\Controllers\Mentor;

use App\Http\Controllers\Controller;
use App\Models\Webinar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class WebinarController extends Controller
{
    public function index()
    {
        $webinars = Webinar::where('mentor_id', Auth::id())->latest()->paginate(10);

        return view('mentor.webinars.index', compact('webinars'));
    }

    public function create()
    {
        return view('mentor.webinars.create');
    }

    // Create webinar + submit for admin approval in one step
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'scheduled_date' => ['required', 'date'],
            'scheduled_time' => ['required'],
            'meeting_link' => ['nullable', 'string', 'max:255'],
            'banner' => ['nullable', 'image', 'max:2048'],
        ]);

        $bannerPath = null;
        if ($request->hasFile('banner')) {
            $bannerPath = $request->file('banner')->store('webinars/banners', 'public');
        }

        Webinar::create([
            'mentor_id' => Auth::id(),
            'title' => $data['title'],
            'description' => $data['description'],
            'scheduled_date' => $data['scheduled_date'],
            'scheduled_time' => $data['scheduled_time'],
            'meeting_link' => $data['meeting_link'] ?? null,
            'banner' => $bannerPath,
            'status' => 'pending',
        ]);

        return redirect()->route('mentor.webinars.index')
            ->with('success', 'Webinar submitted for admin approval.');
    }

    public function edit(Webinar $webinar)
    {
        $this->authorizeWebinar($webinar);

        return view('mentor.webinars.edit', compact('webinar'));
    }

    public function update(Request $request, Webinar $webinar)
    {
        $this->authorizeWebinar($webinar);
        abort_unless($webinar->status !== 'published', 403, 'Published webinars cannot be edited.');

        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'scheduled_date' => ['required', 'date'],
            'scheduled_time' => ['required'],
            'meeting_link' => ['nullable', 'string', 'max:255'],
            'banner' => ['nullable', 'image', 'max:2048'],
        ]);

        if ($request->hasFile('banner')) {
            if ($webinar->banner) {
                Storage::disk('public')->delete($webinar->banner);
            }
            $data['banner'] = $request->file('banner')->store('webinars/banners', 'public');
        }

        // Any edit after rejection goes back for re-approval
        $data['status'] = 'pending';
        $data['admin_remarks'] = null;

        $webinar->update($data);

        return redirect()->route('mentor.webinars.index')
            ->with('success', 'Webinar updated and resubmitted for approval.');
    }

    private function authorizeWebinar(Webinar $webinar): void
    {
        abort_unless($webinar->mentor_id === Auth::id(), 403);
    }
}
