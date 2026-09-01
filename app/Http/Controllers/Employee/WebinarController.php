<?php

namespace App\Http\Controllers\Employee;

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
    /**
     * Browse all mentor-published events (webinars & workshops).
     */
    public function index(Request $request)
    {
        $search = $request->query('q');
        $type   = $request->query('type');
        $date   = $request->query('date');
        $sort   = $request->query('sort', 'upcoming');

        $employeeId = Auth::id();

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

        $myRegistrations = $employeeId
            ? WebinarRegistration::where('student_id', $employeeId)->pluck('status', 'webinar_id')
            : collect();

        return view('employees.webinars.index', [
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
     * Show full details for a single published webinar.
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

        return view('employees.webinars.show', [
            'webinar'      => $webinar,
            'registration' => $registration,
            'myFeedback'   => $myFeedback,
        ]);
    }

    /**
     * "My Webinars" — everything this employee has registered for.
     */
    public function myWebinars(Request $request)
    {
        $employeeId = Auth::id();

        $registrations = WebinarRegistration::with(['webinar.mentor', 'webinar.resources'])
            ->where('student_id', $employeeId)
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

        return view('employees.webinars.my', [
            'upcoming'  => $upcoming,
            'completed' => $completed,
        ]);
    }

    /**
     * Register the current employee for a published event.
     */
    public function register(Request $request, Webinar $webinar)
    {
        abort_unless($webinar->status === 'published', 404);

        if ($webinar->scheduled_date->lt(Carbon::today())) {
            return back()->with('error', "Registration for \"{$webinar->title}\" has closed.");
        }

        $employeeId = Auth::id();

        $existing = WebinarRegistration::where('webinar_id', $webinar->id)
            ->where('student_id', $employeeId)
            ->first();

        if ($existing) {
            return redirect()
                ->route('employee.webinars.show', $webinar)
                ->with('success', "You're already registered for \"{$webinar->title}\".");
        }

        $status = $webinar->hasAvailableSeats() ? 'approved' : 'pending';

        $registration = WebinarRegistration::create([
            'webinar_id'        => $webinar->id,
            'student_id'        => $employeeId,
            'status'            => $status,
            'registered_at'     => now(),
            'attendance_status' => 'registered',
        ]);

        $employee = Auth::user();

        Mail::to($employee->email)->send(new WebinarRegistrationConfirmed($registration));

        if ($webinar->mentor?->email) {
            Mail::to($webinar->mentor->email)->send(new NewWebinarRegistration($registration));
        }

        $message = $status === 'approved'
            ? "You're successfully registered for \"{$webinar->title}\"."
            : "\"{$webinar->title}\" is full. You've been added to the waitlist.";

        return redirect()
            ->route('employee.webinars.show', $webinar)
            ->with('success', $message);
    }
}