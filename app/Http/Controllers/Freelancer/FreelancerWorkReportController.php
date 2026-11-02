<?php

namespace App\Http\Controllers\Freelancer;

use App\Http\Controllers\Controller;
use App\Models\FreelancerBid;
use App\Models\FreelancerWorkReport;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FreelancerWorkReportController extends Controller
{
    private const ACTIVE_STATUSES = [FreelancerBid::STATUS_ACCEPTED, 'in_progress', 'hired'];

    /** Bids of the logged-in freelancer on which work can be reported. */
    private function activeBids()
    {
        $freelancer = Auth::user()?->freelancerRegistration;
        abort_unless($freelancer, 404, 'Freelancer registration not found.');

        return FreelancerBid::with('project')
            ->where('freelancer_id', $freelancer->id)
            ->whereIn('status', self::ACTIVE_STATUSES)
            ->whereNotNull('signed_contract_document')
            ->whereNotNull('work_started_at')
            ->where('estimated_days', '>', 0)
            ->orderByDesc('signed_contract_received_at');
    }

    public function index(Request $request)
    {
        $bids = $this->activeBids()->get();

        if ($bids->isEmpty()) {
            return view('freelancer.job.freelancer_work_report', ['bid' => null, 'bids' => $bids]);
        }

        $bid = $request->filled('bid')
            ? ($bids->firstWhere('id', (int) $request->query('bid')) ?? abort(404))
            : $bids->first();

        $workingDays = $bid->workingDays();
        $totalDays   = count($workingDays);
        $startDate   = $workingDays[0];
        $endDate     = $workingDays[$totalDays - 1];
        $dayIndex    = []; // 'Y-m-d' => 1-based day number
        foreach ($workingDays as $i => $d) {
            $dayIndex[$d->toDateString()] = $i + 1;
        }

        $reports = $bid->workReports()->get()->keyBy(fn ($r) => $r->report_date->toDateString());
        $today   = Carbon::today();

        // ---- Selected date (must be a working day, not in the future) ----
        $selected = null;
        if ($request->filled('date')) {
            try {
                $try = Carbon::createFromFormat('Y-m-d', $request->query('date'))->startOfDay();
                if (isset($dayIndex[$try->toDateString()]) && $try->lte($today)) {
                    $selected = $try;
                }
            } catch (\Throwable $e) {
            }
        }
        if (!$selected) {
            if ($today->lt($startDate)) {
                $selected = $startDate->copy();
            } elseif ($today->gt($endDate)) {
                $selected = $endDate->copy();
            } else {
                // today if it is a working day, otherwise the latest working day before today
                $selected = collect($workingDays)->filter(fn ($d) => $d->lte($today))->last()->copy();
            }
        }
        if ($selected->gt($today)) { // project not started yet
            $selected = null;
        }

        // ---- Month being displayed (clamped to the project range) ----
        $month = null;
        if ($request->filled('month')) {
            try {
                $month = Carbon::createFromFormat('Y-m-d', $request->query('month') . '-01')->startOfMonth();
            } catch (\Throwable $e) {
            }
        }
        $month ??= ($selected ?? $startDate)->copy()->startOfMonth();
        if ($month->lt($startDate->copy()->startOfMonth())) $month = $startDate->copy()->startOfMonth();
        if ($month->gt($endDate->copy()->startOfMonth()))   $month = $endDate->copy()->startOfMonth();

        // ---- Calendar cells ----
        $cells = [];
        $period = CarbonPeriod::create(
            $month->copy()->startOfWeek(Carbon::MONDAY),
            $month->copy()->endOfMonth()->endOfWeek(Carbon::SUNDAY)
        );
        foreach ($period as $d) {
            $key     = $d->toDateString();
            $working = isset($dayIndex[$key]);
            $state   = 'off';
            if ($working) {
                $state = isset($reports[$key]) ? 'submitted'
                    : ($d->isSameDay($today) ? 'due' : ($d->lt($today) ? 'missed' : 'upcoming'));
            }
            $cells[] = [
                'date'       => $d->copy(),
                'in_month'   => $d->month === $month->month,
                'state'      => $state,
                'selectable' => $working && $d->lte($today),
                'selected'   => $selected && $d->isSameDay($selected),
                'today'      => $d->isSameDay($today),
            ];
        }

        $selectedReport = $selected ? $reports->get($selected->toDateString()) : null;

        return view('freelancer.job.freelancer_work_report', [
            'bids'           => $bids,
            'bid'            => $bid,
            'month'          => $month,
            'cells'          => $cells,
            'startDate'      => $startDate,
            'endDate'        => $endDate,
            'totalDays'      => $totalDays,
            'selected'       => $selected,
            'selectedDayNo'  => $selected ? $dayIndex[$selected->toDateString()] : null,
            'selectedReport' => $selectedReport,
            'submittedCount' => $reports->count(),
            'latestProgress' => (int) ($reports->sortKeys()->last()?->progress_percentage ?? 0),
            'prevMonth'      => $month->gt($startDate->copy()->startOfMonth()) ? $month->copy()->subMonth() : null,
            'nextMonth'      => $month->lt($endDate->copy()->startOfMonth()) ? $month->copy()->addMonth() : null,
            'projectDone'    => $today->gt($endDate),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'freelancer_bid_id'   => ['required', 'integer'],
            'report_date'         => ['required', 'date_format:Y-m-d'],
            'title'               => ['required', 'string', 'max:255'],
            'work_description'    => ['required', 'string', 'max:5000'],
            'progress_percentage' => ['required', 'integer', 'between:0,100'],
            'challenges'          => ['nullable', 'string', 'max:3000'],
            'next_steps'          => ['nullable', 'string', 'max:3000'],
            'attachment'          => ['nullable', 'file', 'mimes:pdf,doc,docx,png,jpg,jpeg,zip', 'max:5120'],
        ]);

        // Bid must belong to this freelancer and be active
        $bid = $this->activeBids()->where('id', $data['freelancer_bid_id'])->firstOrFail();

        $date = Carbon::createFromFormat('Y-m-d', $data['report_date'])->startOfDay();
        $isWorkingDay = collect($bid->workingDays())->contains(fn ($d) => $d->isSameDay($date));

        abort_unless($isWorkingDay, 422, 'This date is outside the project working days.');
        abort_if($date->gt(Carbon::today()), 422, 'You cannot submit a report for a future date.');

        $report = FreelancerWorkReport::firstOrNew([
            'freelancer_bid_id' => $bid->id,
            'report_date'       => $date->toDateString(),
        ]);

        $report->fill([
            'title'               => $data['title'],
            'work_description'    => $data['work_description'],
            'progress_percentage' => $data['progress_percentage'],
            'challenges'          => $data['challenges'] ?? null,
            'next_steps'          => $data['next_steps'] ?? null,
        ]);

        if ($file = $request->file('attachment')) {
            if ($report->attachment_path) {
                Storage::disk('local')->delete($report->attachment_path);
            }
            $name = now()->format('YmdHis') . '_'
                . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME))
                . '.' . $file->extension();
            $report->attachment_path = $file->storeAs('work-reports/bid-' . $bid->id, $name, 'local');
        }

        $wasNew = !$report->exists;
        $report->save();

        return redirect()
            ->route('freelancer.work-reports.index', [
                'bid'   => $bid->id,
                'date'  => $date->toDateString(),
                'month' => $date->format('Y-m'),
            ])
            ->with('success', $wasNew ? 'Work report submitted.' : 'Work report updated.');
    }

    public function attachment(FreelancerWorkReport $report)
    {
        $freelancer = Auth::user()?->freelancerRegistration;
        abort_unless($freelancer && $report->freelancerBid?->freelancer_id === $freelancer->id, 403);
        abort_unless($report->attachment_path && Storage::disk('local')->exists($report->attachment_path), 404);

        return Storage::disk('local')->response($report->attachment_path);
    }

    public function signedJobs()
{
    $freelancer = Auth::user()?->freelancerRegistration;

    if (!$freelancer) {
        abort(404, 'Freelancer registration not found.');
    }

    $signedJobs = FreelancerBid::with(['project.employer.employerRegistration'])
        ->withCount('workReports')
        ->where('freelancer_id', $freelancer->id)
        ->whereNotNull('signed_contract_document')
        ->whereNotNull('work_started_at')
        ->orderByDesc('signed_contract_received_at')
        ->paginate(10);

    return view('freelancer.job.freelance_myjob', compact('signedJobs'));
}
}