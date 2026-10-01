<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FreelancerBid;
use App\Models\Project;
use App\Mail\FreelancerBidStatusMail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class FreelancerHandlerController extends Controller
{
    /**
     * Display all freelancer bids.
     */


    public function index(Request $request)
    {
        // Currently logged-in employer
        $employerId = auth()->id();

        /*
        |--------------------------------------------------------------------------
        | Projects belonging ONLY to the logged-in employer
        |--------------------------------------------------------------------------
        */
        $query = Project::with([
            'employer',
            'freelancerBids.freelancer',
        ])
            ->withCount('freelancerBids')
            ->whereHas('freelancerBids')
            ->where('projects.employer_id', $employerId);

        /*
        |--------------------------------------------------------------------------
        | Search
        |--------------------------------------------------------------------------
        */
        if ($request->filled('search')) {
            $search = trim($request->search);

            $query->where(function ($q) use ($search) {

                // Search by project ID
                $q->where('projects.id', 'like', "%{$search}%")

                    // Search by project title
                    ->orWhere('projects.title', 'like', "%{$search}%")

                    // Search by freelancer name
                    ->orWhereHas(
                        'freelancerBids.freelancer.user',
                        function ($userQuery) use ($search) {
                            $userQuery->where('name', 'like', "%{$search}%");
                        }
                    );
            });
        }

        /*
        |--------------------------------------------------------------------------
        | Bid Status Filter
        |--------------------------------------------------------------------------
        */
        if ($request->filled('status')) {
            $query->whereHas('freelancerBids', function ($bidQuery) use ($request) {
                $bidQuery->where('status', $request->status);
            });
        }

        /*
        |--------------------------------------------------------------------------
        | Sorting
        |--------------------------------------------------------------------------
        */
        switch ($request->get('sort', 'newest')) {

            case 'oldest':
                $query->oldest();
                break;

            case 'amount_high':
                $query->withMax('freelancerBids', 'bid_amount')
                    ->orderByDesc('freelancer_bids_max_bid_amount');
                break;

            case 'amount_low':
                $query->withMin('freelancerBids', 'bid_amount')
                    ->orderBy('freelancer_bids_min_bid_amount');
                break;

            default:
                $query->latest();
                break;
        }

        /*
        |--------------------------------------------------------------------------
        | Pagination
        |--------------------------------------------------------------------------
        */
        $projects = $query->paginate(10)->withQueryString();

        /*
        |--------------------------------------------------------------------------
        | Employer-specific statistics
        |--------------------------------------------------------------------------
        |
        | Get ONLY this employer's projects first.
        |
        */
        $employerProjectIds = Project::where('employer_id', $employerId)
            ->pluck('id');

        /*
        |--------------------------------------------------------------------------
        | Bid Statistics
        |--------------------------------------------------------------------------
        */

        $totalBids = FreelancerBid::whereIn('project_id', $employerProjectIds)
            ->count();

        $pendingBids = FreelancerBid::whereIn('project_id', $employerProjectIds)
            ->where('status', 'pending')
            ->count();

        $acceptedBids = FreelancerBid::whereIn('project_id', $employerProjectIds)
            ->where('status', 'accepted')
            ->count();

        $rejectedBids = FreelancerBid::whereIn('project_id', $employerProjectIds)
            ->where('status', 'rejected')
            ->count();

        /*
        |--------------------------------------------------------------------------
        | Return View
        |--------------------------------------------------------------------------
        */
        return view(
            'employers.freelancer.bid.bid_index',
            compact(
                'projects',
                'totalBids',
                'pendingBids',
                'acceptedBids',
                'rejectedBids'
            )
        );
    }




    /**
     * Show all bids for a project.
     */
    public function bids($projectId)
    {
        $employerId = auth()->id();

        $project = Project::with('employer')
            ->where('id', $projectId)
            ->where('employer_id', $employerId)
            ->whereHas('freelancerBids')
            ->firstOrFail();

        $bids = FreelancerBid::with([
            'freelancer',
            'project',
        ])
            ->where('project_id', $project->id)
            ->latest()
            ->paginate(10);

        return view(
            'employers.freelancer.bid.bid_list',
            compact('project', 'bids')
        );
    }

    /**
     * Show complete details of one bid.
     */
    public function show($id)
    {
        $employerId = auth()->id();

        $bid = FreelancerBid::with([
            'project',
            'freelancer.user',
            'employer',
        ])
            ->where('id', $id)
            ->whereHas('project', function ($query) use ($employerId) {
                $query->where('employer_id', $employerId);
            })
            ->firstOrFail();

        return view(
            'employers.freelancer.bid.bid_approval',
            compact('bid')
        );
    }
    public function approve(Request $request, $id)
    {
        $validated = $request->validate([
            'approver_name' => 'required|string|max:255',
            'comments' => 'nullable|string|max:2000',
            'action' => 'required|in:accepted,rejected',
        ]);

        $employerId = auth()->id();

        $bid = FreelancerBid::with([
            'project',
            'freelancer.user',
            'employer',
        ])
            ->where('id', $id)
            ->whereHas('project', function ($query) use ($employerId) {
                $query->where('employer_id', $employerId);
            })
            ->firstOrFail();

        // Guard against re-processing an already-decided bid
        if ($bid->status !== FreelancerBid::STATUS_PENDING) {
            return redirect()
                ->route('employer.freelancer.bids.show', $bid->id)
                ->with('error', 'This bid has already been ' . $bid->status . ' and cannot be changed.');
        }

        $bid->status = $validated['action'] === 'accepted'
            ? FreelancerBid::STATUS_ACCEPTED
            : FreelancerBid::STATUS_REJECTED;
        $bid->comments = $validated['comments'] ?? null;
        $bid->save();

        // Send notification email to the freelancer (never let a mail failure block the approval)
        $recipientEmail = $bid->freelancer?->user?->email;

        if ($recipientEmail) {
            try {
                Mail::to($recipientEmail)->send(
                    new FreelancerBidStatusMail($bid, $validated['approver_name'], $validated['comments'] ?? null)
                );
            } catch (\Throwable $e) {
                Log::error('Failed to send bid status email for bid #' . $bid->id . ': ' . $e->getMessage());
            }
        } else {
            Log::warning('No email found for freelancer on bid #' . $bid->id . '; notification skipped.');
        }

        return redirect()
            ->route('employer.freelancer.bids.show', $bid->id)
            ->with('success', 'Bid has been ' . $bid->status . ' and the freelancer has been notified.');
    }
    public function resume($id)
    {
        $bid = FreelancerBid::with('freelancer')->findOrFail($id);

        $resume = $bid->freelancer?->resume;

        if (!$resume) {
            abort(404, 'Resume not found.');
        }

        // If database contains a full URL
        if (filter_var($resume, FILTER_VALIDATE_URL)) {
            return redirect()->away($resume);
        }

        // Normalize stored path
        $path = ltrim($resume, '/');

        // Remove common prefixes stored in database
        $path = preg_replace('#^(public/|storage/)#', '', $path);

        /*
         * First check Laravel public disk:
         * storage/app/public/...
         */
        if (Storage::disk('public')->exists($path)) {
            return response()->file(
                Storage::disk('public')->path($path),
                [
                    'Content-Type' => Storage::disk('public')->mimeType($path) ?: 'application/pdf',
                    'Content-Disposition' => 'inline; filename="' . basename($path) . '"',
                ]
            );
        }

        /*
         * Then check public/...
         */
        $publicPath = public_path($path);

        if (file_exists($publicPath)) {
            return response()->file(
                $publicPath,
                [
                    'Content-Type' => mime_content_type($publicPath) ?: 'application/pdf',
                    'Content-Disposition' => 'inline; filename="' . basename($publicPath) . '"',
                ]
            );
        }

        /*
         * Also handle a database value such as:
         * storage/resumes/file.pdf
         */
        $storagePath = public_path('storage/' . $path);

        if (file_exists($storagePath)) {
            return response()->file(
                $storagePath,
                [
                    'Content-Type' => mime_content_type($storagePath) ?: 'application/pdf',
                    'Content-Disposition' => 'inline; filename="' . basename($storagePath) . '"',
                ]
            );
        }

        abort(404, 'Resume file does not exist on the server.');
    }
}