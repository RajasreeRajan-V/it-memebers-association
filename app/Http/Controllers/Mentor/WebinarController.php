<?php

namespace App\Http\Controllers\Mentor;

use App\Http\Controllers\Controller;
use App\Mail\WebinarSubmittedForApproval;
use App\Models\Webinar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Models\WebinarRegistration;

class WebinarController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->query('status'); // pending | approved | rejected | published | null (All)
        $search = $request->query('q');

        $webinars = Webinar::where('mentor_id', Auth::id())
            ->withCount('registrations')
            ->when($status, fn ($q) => $q->where('status', $status))
            ->when($search, fn ($q) => $q->where('title', 'like', "%{$search}%"))
            ->latest()
            ->paginate(4)
            ->withQueryString();

        return view('mentor.webinars.index', [
            'webinars' => $webinars,
            'stats' => $this->stats(),
            'upcoming' => $this->upcoming(),
            'activeStatus' => $status,
            'search' => $search,
        ]);
    }

    public function create()
    {
        return view('mentor.webinars.create', [
            'stats' => $this->stats(),
            'upcoming' => $this->upcoming(),
        ]);
    }

    // Create webinar + submit for admin approval in one step
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'type' => ['required', 'in:webinar,workshop'],
            'category' => ['required', 'string', 'max:255'],
            'platform' => ['required', 'string', 'max:255'],
            'duration' => ['required', 'string', 'max:100'],
            'capacity' => ['nullable', 'integer', 'min:1'],
            'description' => ['required', 'string'],
            // The form sends one outcome per line as plain text, NOT an array.
            'learning_outcomes_raw' => ['nullable', 'string'],
            'hands_on_activities' => ['nullable', 'string'],
            'materials_required' => ['nullable', 'string'],
            'scheduled_date' => ['required', 'date'],
            'scheduled_time' => ['required'],
            'meeting_link' => ['nullable', 'string', 'max:255'],
            'banner' => ['nullable', 'image', 'max:2048'],
        ]);

        $bannerPath = null;
        if ($request->hasFile('banner')) {
            $bannerPath = $request->file('banner')->store('webinars/banners', 'public');
        }

        $webinar = Webinar::create([
            'mentor_id' => Auth::id(),
            'title' => $data['title'],
            'type' => $data['type'],
            'category' => $data['category'],
            'platform' => $data['platform'],
            'duration' => $data['duration'],
            'capacity' => $data['capacity'] ?? null,
            'description' => $data['description'],
            'learning_outcomes' => $this->parseLearningOutcomes($data['learning_outcomes_raw'] ?? null),
            'hands_on_activities' => $data['hands_on_activities'] ?? null,
            'materials_required' => $data['materials_required'] ?? null,
            'scheduled_date' => $data['scheduled_date'],
            'scheduled_time' => $data['scheduled_time'],
            'meeting_link' => $data['meeting_link'] ?? null,
            'banner' => $bannerPath,
            'status' => 'pending',
        ]);

        $this->notifyAdminOfSubmission($webinar);

        return redirect()->route('mentor.webinars.index')
            ->with('success', 'Webinar submitted for admin approval.');
    }

    public function edit(Webinar $webinar)
    {
        $this->authorizeWebinar($webinar);

        return view('mentor.webinars.edit', [
            'webinar' => $webinar,
            'stats' => $this->stats(),
        ]);
    }

    public function update(Request $request, Webinar $webinar)
    {
        $this->authorizeWebinar($webinar);
        abort_unless($webinar->status !== 'published', 403, 'Published webinars cannot be edited.');

        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'type' => ['required', 'in:webinar,workshop'],
            'category' => ['nullable', 'string', 'max:255'],
            'platform' => ['nullable', 'string', 'max:255'],
            'duration' => ['nullable', 'string', 'max:100'],
            'capacity' => ['nullable', 'integer', 'min:1'],
            'description' => ['required', 'string'],
            // Same as store(): plain newline-separated text, not an array.
            'learning_outcomes_raw' => ['nullable', 'string'],
            'hands_on_activities' => ['nullable', 'string'],
            'materials_required' => ['nullable', 'string'],
            'scheduled_date' => ['required', 'date'],
            'scheduled_time' => ['required'],
            'meeting_link' => ['nullable', 'string', 'max:255'],
            'banner' => ['nullable', 'image', 'max:2048'],
        ]);

        if (array_key_exists('learning_outcomes_raw', $data)) {
            $data['learning_outcomes'] = $this->parseLearningOutcomes($data['learning_outcomes_raw']);
        }
        unset($data['learning_outcomes_raw']);

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

        $this->notifyAdminOfSubmission($webinar);

        return redirect()->route('mentor.webinars.index')
            ->with('success', 'Webinar updated and resubmitted for approval.');
    }

    private function authorizeWebinar(Webinar $webinar): void
    {
        abort_unless($webinar->mentor_id === Auth::id(), 403);
    }

    private function notifyAdminOfSubmission(Webinar $webinar): void
    {
        $adminEmail = config('mail.admin_address');

        if ($adminEmail) {
            Mail::to($adminEmail)->send(new WebinarSubmittedForApproval($webinar));
        }
    }

    /**
     * Convert the textarea's newline-separated outcomes into a clean array
     * for the model's `learning_outcomes` (array-cast) column.
     */
    private function parseLearningOutcomes(?string $raw): array
    {
        if (! $raw) {
            return [];
        }

        return collect(preg_split('/\r\n|\r|\n/', $raw))
            ->map(fn ($line) => trim($line))
            ->filter()
            ->values()
            ->all();
    }

    private function stats(): array
    {
        $base = Webinar::where('mentor_id', Auth::id());

        return [
            'total' => (clone $base)->count(),
            'approved' => (clone $base)->where('status', 'approved')->count(),
            'pending' => (clone $base)->where('status', 'pending')->count(),
            'rejected' => (clone $base)->where('status', 'rejected')->count(),
            'published' => (clone $base)->where('status', 'published')->count(),
        ];
    }

    public function destroy(Webinar $webinar)
    {
        $this->authorizeWebinar($webinar);

        if ($webinar->banner) {
            Storage::disk('public')->delete($webinar->banner);
        }

        $webinar->delete();

        return back()->with('success', 'Webinar deleted successfully.');
    }

    private function upcoming()
    {
        return Webinar::where('mentor_id', Auth::id())
            ->where('scheduled_date', '>=', now()->toDateString())
            ->orderBy('scheduled_date')
            ->take(3)
            ->get();
    }



    public function registrations(Webinar $webinar)
{
    // Make sure this webinar belongs to the logged-in mentor
    abort_unless($webinar->mentor_id == auth()->id(), 403);

    $registrations = WebinarRegistration::with('student')
        ->where('webinar_id', $webinar->id)
        ->latest('registered_at')
        ->paginate(10);

    return view('mentor.webinars.registrations', compact(
        'webinar',
        'registrations'
    ));
}
}
