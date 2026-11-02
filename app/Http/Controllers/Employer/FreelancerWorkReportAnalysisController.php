<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\FreelancerBid;
use App\Models\FreelancerWorkReport;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
class FreelancerWorkReportAnalysisController extends Controller
{
     private const STATUS_LABELS = [
        'not_started' => 'Not started',
        'on_track'    => 'On track',
        'at_risk'     => 'At risk',
        'behind'      => 'Behind schedule',
        'completed'   => 'Completed',
    ];
 
    /** Signed, started contracts that belong to the logged-in employer. */
    private function bids()
    {
        $id = Auth::id();
 
        return FreelancerBid::with(['project', 'freelancer.user', 'workReports'])
            ->where(function ($q) use ($id) {
                $q->where('employer_id', $id)
                  ->orWhereHas('project', fn ($p) => $p->where('employer_id', $id));
            })
            ->whereNotNull('signed_contract_document')
            ->whereNotNull('work_started_at')
            ->orderByDesc('signed_contract_received_at');
    }
 
    /** All contracts with a one-line health summary each. */
    public function index(Request $request)
    {
        $rows = $this->bids()->get()
            ->filter(fn ($b) => count($b->workingDays()) > 0)
            ->map(fn ($b) => ['bid' => $b, 'a' => $this->analyse($b)])
            ->values();
 
        $counts = $rows->countBy(fn ($r) => $r['a']['status']);
        $rates  = $rows->pluck('a.rate')->filter(fn ($v) => $v !== null);
 
        $summary = [
            'total'     => $rows->count(),
            'on_track'  => ($counts['on_track'] ?? 0) + ($counts['completed'] ?? 0),
            'attention' => ($counts['at_risk'] ?? 0) + ($counts['behind'] ?? 0),
            'avg_rate'  => $rates->isEmpty() ? null : (int) round($rates->avg()),
        ];
 
        $filter = $request->query('status');
        if ($filter === 'attention') {
            $rows = $rows->filter(fn ($r) => in_array($r['a']['status'], ['at_risk', 'behind']))->values();
        } elseif (isset(self::STATUS_LABELS[$filter])) {
            $rows = $rows->filter(fn ($r) => $r['a']['status'] === $filter)->values();
        }
 
        return view('employers.freelance-bid.work-report.index', compact('rows', 'summary', 'filter'));
    }
 
    /** Full analysis of one contract. */
    public function show(int $bid)
    {
        $bid = $this->bids()->where('freelancer_bids.id', $bid)->firstOrFail();
        abort_if(count($bid->workingDays()) === 0, 404);
 
        return view('employers.freelance-bid.work-report.show', [
            'bid' => $bid,
            'a'   => $this->analyse($bid),
        ]);
    }
 
    public function attachment(FreelancerWorkReport $report)
    {
        $id  = Auth::id();
        $bid = $report->freelancerBid;
 
        abort_unless(
            $bid && ($bid->employer_id === $id || $bid->project?->employer_id === $id),
            403
        );
        abort_unless($report->attachment_path && Storage::disk('local')->exists($report->attachment_path), 404);
 
        return Storage::disk('local')->response($report->attachment_path);
    }
 
    /**
     * Turn a bid + its work reports into schedule, quality and risk metrics.
     */
    private function analyse(FreelancerBid $bid): array
    {
        $days  = $bid->workingDays();
        $total = count($days);
        $today = Carbon::today();
 
        $reports = $bid->workReports
            ->sortBy(fn ($r) => $r->report_date->timestamp)
            ->values();
        $byDate = $reports->keyBy(fn ($r) => $r->report_date->toDateString());
 
        // ---- Day-by-day schedule ----
        $grid = [];
        $dayIndex = [];
        $elapsed = $submitted = $missed = 0;
 
        foreach ($days as $i => $d) {
            $key = $d->toDateString();
            $dayIndex[$key] = $i + 1;
 
            if (isset($byDate[$key]))      $state = 'submitted';
            elseif ($d->isSameDay($today)) $state = 'due';
            elseif ($d->lt($today))        $state = 'missed';
            else                           $state = 'upcoming';
 
            if ($d->lte($today))        $elapsed++;
            if ($state === 'submitted') $submitted++;
            if ($state === 'missed')    $missed++;
 
            $grid[] = ['date' => $d, 'day' => $i + 1, 'state' => $state];
        }
 
        // current streak of consecutive submitted days (today's pending report is not held against it)
        $streak = 0;
        foreach (array_reverse($grid) as $g) {
            if (in_array($g['state'], ['upcoming', 'due'], true)) continue;
            if ($g['state'] === 'submitted') $streak++; else break;
        }
 
        $settled = $submitted + $missed;
        $rate    = $settled > 0 ? (int) round($submitted / $settled * 100) : null;
 
        // ---- Progress vs plan ----
        $latest   = (int) ($reports->last()?->progress_percentage ?? 0);
        $expected = $total > 0 ? min(100, (int) round($elapsed / $total * 100)) : 0;
        $variance = $latest - $expected;
 
        if ($elapsed === 0)         $status = 'not_started';
        elseif ($latest >= 100)     $status = 'completed';
        elseif ($variance >= -10)   $status = 'on_track';
        elseif ($variance >= -25)   $status = 'at_risk';
        else                        $status = 'behind';
 
        // projected finish at the freelancer's current pace
        $projectedDays = $delay = null;
        if ($elapsed > 0 && $latest > 0 && $latest < 100) {
            $projectedDays = (int) ceil(100 / ($latest / $elapsed));
            $delay         = $projectedDays - $total;
        }
 
        // ---- Report log + quality signals ----
        $log = [];
        $prev = null;
        $regressions = $late = 0;
        foreach ($reports as $r) {
            $delta   = $prev === null ? null : $r->progress_percentage - $prev;
            $isLate  = $r->created_at && $r->created_at->toDateString() > $r->report_date->toDateString();
            if ($delta !== null && $delta < 0) $regressions++;
            if ($isLate) $late++;
            $log[] = [
                'report' => $r,
                'day'    => $dayIndex[$r->report_date->toDateString()] ?? null,
                'delta'  => $delta,
                'late'   => $isLate,
            ];
            $prev = $r->progress_percentage;
        }
        $log = array_reverse($log); // newest first
 
        $lastThree = $reports->slice(-3)->pluck('progress_percentage')->unique();
        $stalled   = $reports->count() >= 3 && $lastThree->count() === 1 && $latest < 100;
 
        $challenges  = $reports->filter(fn ($r) => filled($r->challenges))->sortByDesc(fn ($r) => $r->report_date->timestamp)->values();
        $attachments = $reports->whereNotNull('attachment_path')->count();
        $avgWords    = $reports->isEmpty() ? null
            : (int) round($reports->avg(fn ($r) => str_word_count((string) $r->work_description)));
 
        $lastReport = $reports->last();
        $daysSince  = $lastReport ? (int) $lastReport->report_date->copy()->startOfDay()->diffInDays($today) : null;
 
        // ---- Plain-language insights ----
        $insights = [];
        $add = function (string $type, string $text) use (&$insights) {
            $insights[] = ['type' => $type, 'text' => $text];
        };
 
        if ($status === 'not_started') {
            $add('info', 'Work starts on ' . $days[0]->format('M j, Y') . '. No reports are expected yet.');
        } else {
            if ($reports->isEmpty()) {
                $add('bad', 'No work report has been submitted yet.');
            } elseif ($status === 'completed') {
                $add('good', 'The freelancer has reported 100% progress.');
            } elseif ($variance >= 0) {
                $add('good', "Reported progress ({$latest}%) is ahead of the planned {$expected}%.");
            } elseif ($status === 'on_track') {
                $add('good', "Progress is close to plan: {$latest}% reported against {$expected}% expected.");
            } else {
                $add($status === 'behind' ? 'bad' : 'warn',
                    "Progress is " . abs($variance) . " points behind plan ({$latest}% reported, {$expected}% expected).");
            }
 
            if ($delay !== null && $delay > 0) {
                $add('warn', "At the current pace, the work needs about {$projectedDays} working days instead of {$total} (roughly {$delay} late).");
            }
            if ($missed > 0) {
                $add($missed >= 3 ? 'bad' : 'warn', "{$missed} working " . ($missed === 1 ? 'day has' : 'days have') . ' no report.');
            } elseif ($rate !== null && $rate === 100) {
                $add('good', 'Every past working day has a report.');
            }
            if ($stalled) {
                $add('warn', "Progress has stayed at {$latest}% for the last three reports.");
            }
            if ($regressions > 0) {
                $add('warn', "Reported progress dropped between reports {$regressions} " . ($regressions === 1 ? 'time.' : 'times.'));
            }
            if ($late > 0) {
                $add('info', "{$late} " . ($late === 1 ? 'report was' : 'reports were') . ' submitted after the day it covers.');
            }
            if ($avgWords !== null && $avgWords < 15) {
                $add('info', "Reports are short (about {$avgWords} words on average). Ask for more detail if needed.");
            }
            if ($challenges->isNotEmpty()) {
                $add('info', $challenges->count() . ' ' . ($challenges->count() === 1 ? 'report mentions' : 'reports mention') . ' challenges. See below.');
            }
        }
 
        return [
            'status'         => $status,
            'status_label'   => self::STATUS_LABELS[$status],
            'total'          => $total,
            'elapsed'        => $elapsed,
            'submitted'      => $submitted,
            'missed'         => $missed,
            'rate'           => $rate,
            'streak'         => $streak,
            'latest'         => $latest,
            'expected'       => $expected,
            'variance'       => $variance,
            'projected_days' => $projectedDays,
            'delay'          => $delay,
            'regressions'    => $regressions,
            'late'           => $late,
            'stalled'        => $stalled,
            'attachments'    => $attachments,
            'avg_words'      => $avgWords,
            'last_report'    => $lastReport,
            'days_since'     => $daysSince,
            'challenges'     => $challenges,
            'grid'           => $grid,
            'points'         => collect($log)->reverse()->filter(fn ($l) => $l['day'])->map(fn ($l) => [
                'day'      => $l['day'],
                'progress' => $l['report']->progress_percentage,
            ])->values()->all(),
            'log'            => $log,
            'start'          => $days[0],
            'end'            => $days[$total - 1],
            'insights'       => $insights,
        ];
    }
}
