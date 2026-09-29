<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Mail\NewWebinarRegistration;
use App\Mail\WebinarRegistrationConfirmed;
use App\Models\Webinar;
use App\Models\WebinarFeedback;
use App\Models\WebinarRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class WebinarController extends Controller
{
   
    public function index(Request $request)
    {
        $search = $request->query('q');
        $type   = $request->query('type');
        $date   = $request->query('date');
        $sort   = $request->query('sort', 'upcoming');

        $studentId = Auth::id();

        $base = Webinar::with('mentor')
            ->where('status', 'published');

        $withRegistrationsCount = fn ($q) => $q->withCount(['registrations as registrations_count' => function ($q) {
            $q->where('status', 'approved');
        }]);

        $events = (clone $base)
            ->tap($withRegistrationsCount)
            ->when($search, fn ($q) => $q->where('title', 'like', "%{$search}%"))
            ->when(in_array($type, ['webinar', 'workshop'], true), fn ($q) => $q->where('type', $type))
            ->when($date, function ($q) use ($date) {
                match ($date) {
                    'today' => $q->whereDate('scheduled_date', now()->toDateString()),
                    'week'  => $q->whereBetween('scheduled_date', [now()->startOfWeek(), now()->endOfWeek()]),
                    'month' => $q->whereMonth('scheduled_date', now()->month)
                                  ->whereYear('scheduled_date', now()->year),
                    default => null,
                };
            })
            ->when($sort === 'newest',
                fn ($q) => $q->latest(),
                fn ($q) => $q->orderBy('scheduled_date')->orderBy('scheduled_time')
            )
            ->paginate(3)
            ->withQueryString();

        $upcoming = (clone $base)
            ->tap($withRegistrationsCount)
            ->where('scheduled_date', '>=', now()->toDateString())
            ->orderBy('scheduled_date')
            ->take(4)
            ->get();

        $categories = (clone $base)
            ->selectRaw('category, count(*) as total')
            ->whereNotNull('category')
            ->groupBy('category')
            ->orderByDesc('total')
            ->get();

        $counts = [
            'all'      => (clone $base)->count(),
            'webinar'  => (clone $base)->where('type', 'webinar')->count(),
            'workshop' => (clone $base)->where('type', 'workshop')->count(),
        ];

        $myRegistrations = $studentId
            ? WebinarRegistration::where('student_id', $studentId)->pluck('status', 'webinar_id')
            : collect();

        return view('students.webinars.index', [
            'events'          => $events,
            'upcoming'        => $upcoming,
            'categories'      => $categories,
            'counts'          => $counts,
            'activeType'      => $type,
            'activeDate'      => $date,
            'activeSort'      => $sort,
            'search'          => $search,
            'myRegistrations' => $myRegistrations,
        ]);
    }

    /**
     * Show full details for a single published webinar, including this
     * student's registration status and feedback if any.
     */
    public function show(Webinar $webinar)
    {
        abort_unless($webinar->status === 'published', 404);

        $webinar->load(['mentor', 'resources']);

        $registration = Auth::check()
            ? WebinarRegistration::where('webinar_id', $webinar->id)
                ->where('student_id', Auth::id())
                ->first()
            : null;

        $myFeedback = Auth::check()
            ? WebinarFeedback::where('webinar_id', $webinar->id)
                ->where('student_id', Auth::id())
                ->first()
            : null;

        return view('students.webinars.show', [
            'webinar'      => $webinar,
            'registration' => $registration,
            'myFeedback'   => $myFeedback,
        ]);
    }

    /**
     * "My Webinars" — everything the student has registered for,
     * split into Upcoming and Completed.
     */
    public function myWebinars(Request $request)
    {
        $studentId = Auth::id();

        $registrations = WebinarRegistration::with(['webinar.mentor', 'webinar.resources'])
            ->where('student_id', $studentId)
            ->whereHas('webinar')
            ->get();

        $today = now()->toDateString();

        $upcoming = $registrations
            ->filter(fn ($r) => $r->webinar->scheduled_date->toDateString() >= $today)
            ->sortBy(fn ($r) => $r->webinar->scheduled_date)
            ->values();

        $completed = $registrations
            ->filter(fn ($r) => $r->webinar->scheduled_date->toDateString() < $today)
            ->sortByDesc(fn ($r) => $r->webinar->scheduled_date)
            ->values();

        return view('students.webinars.my', [
            'upcoming'  => $upcoming,
            'completed' => $completed,
        ]);
    }

    /**
     * Register the current student for a published event.
     * Auto-confirms if there's a free seat, otherwise waitlists ('pending').
     */
    public function register(Request $request, Webinar $webinar)
    {
        abort_unless($webinar->status === 'published', 404);

        if ($webinar->scheduled_date->lt(Carbon::today())) {
            return back()->with('error', "Registration for \"{$webinar->title}\" has closed.");
        }

        $studentId = Auth::id();

        $existing = WebinarRegistration::where('webinar_id', $webinar->id)
            ->where('student_id', $studentId)
            ->first();

        if ($existing) {
            return redirect()
                ->route('student.webinars.show', $webinar)
                ->with('success', "You're already registered for \"{$webinar->title}\".");
        }

        $status = $webinar->hasAvailableSeats() ? 'approved' : 'pending';

        $registration = WebinarRegistration::create([
            'webinar_id'        => $webinar->id,
            'student_id'        => $studentId,
            'status'            => $status,
            'registered_at'     => now(),
            'attendance_status' => 'registered',
        ]);

        $student = Auth::user();

        // Confirmation email to student
        Mail::to($student->email)->send(new WebinarRegistrationConfirmed($registration));

        // Notification to mentor
        if ($webinar->mentor?->email) {
            Mail::to($webinar->mentor->email)->send(new NewWebinarRegistration($registration));
        }

        $message = $status === 'approved'
            ? "You're successfully registered for \"{$webinar->title}\"."
            : "\"{$webinar->title}\" is full. You've been added to the waitlist.";

        return redirect()
            ->route('student.webinars.show', $webinar)
            ->with('success', $message);
    }
}