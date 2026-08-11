<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\LegalRequest;
use App\Models\LegalRequestDocument;
use App\Models\LegalRequestMessage;
use App\Models\LegalRequestMessageAttachment;
use App\Models\LegalRequestTimeline;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LegalHelpController extends Controller
{
    /**
     * All legal requests across every employee, with filters + stats,
     * mirroring the approval-queue pattern used by Jobs/Startups/Articles.
     */
    public function index(Request $request)
    {
        $stats = [
            'total'        => LegalRequest::count(),
            'submitted'    => LegalRequest::where('status', 'submitted')->count(),
            'under_review' => LegalRequest::where('status', 'under_review')->count(),
            'in_progress'  => LegalRequest::where('status', 'in_progress')->count(),
            'resolved'     => LegalRequest::where('status', 'resolved')->count(),
            'closed'       => LegalRequest::where('status', 'closed')->count(),
            'unassigned'   => LegalRequest::whereNull('assigned_admin_id')->count(),
        ];

        $legalRequests = LegalRequest::query()
            ->with(['employee', 'assignedAdmin'])
            ->when($request->filled('status'), fn ($q) => $q->where('status', $request->status))
            ->when($request->filled('priority'), fn ($q) => $q->where('priority', $request->priority))
            ->when($request->filled('assigned') && $request->assigned === 'me', fn ($q) => $q->where('assigned_admin_id', Auth::guard('admin')->id()))
            ->when($request->filled('assigned') && $request->assigned === 'unassigned', fn ($q) => $q->whereNull('assigned_admin_id'))
            ->when($request->filled('search'), function ($q) use ($request) {
                $q->where(function ($sub) use ($request) {
                    $sub->where('issue_title', 'like', "%{$request->search}%")
                        ->orWhere('request_number', 'like', "%{$request->search}%")
                        ->orWhere('category', 'like', "%{$request->search}%");
                });
            })
            ->latest('updated_at')
            ->paginate(15)
            ->withQueryString();

        return view('admin.legal-help.index', compact('stats', 'legalRequests'));
    }

    /**
     * Single request — timeline, chat, documents, status/assignment controls.
     */
    public function show(LegalRequest $legalRequest)
    {
        $legalRequest->load(['timelines', 'messages', 'documents', 'employee', 'assignedAdmin']);

        $admins = Admin::orderBy('name')->get();

        return view('admin.legal-help.show', compact('legalRequest', 'admins'));
    }

    /**
     * Assign (or reassign) the request to an admin/legal handler.
     */
    public function assign(Request $request, LegalRequest $legalRequest)
    {
        $validated = $request->validate([
            'assigned_admin_id' => ['required', 'exists:admins,id'],
        ]);

        $legalRequest->update([
            'assigned_admin_id' => $validated['assigned_admin_id'],
            'status'            => $legalRequest->status === 'submitted' ? 'assigned' : $legalRequest->status,
        ]);

        $admin = Admin::find($validated['assigned_admin_id']);

        LegalRequestTimeline::create([
            'legal_request_id' => $legalRequest->id,
            'title'            => 'Assigned to Lawyer',
            'description'      => 'Assigned to ' . $admin->name . '.',
            'status'           => 'completed',
            'created_by'       => Auth::guard('admin')->id(),
            'created_by_type'  => 'admin',
            'sort_order'       => ($legalRequest->timelines()->max('sort_order') ?? 0) + 1,
        ]);

        return back()->with('success', 'Request assigned to ' . $admin->name . '.');
    }

    /**
     * Update status (Under Review / In Progress / Resolved / Closed)
     * and log it as a timeline step, same as the reference screenshot.
     */
    public function updateStatus(Request $request, LegalRequest $legalRequest)
    {
        $validated = $request->validate([
            'status' => ['required', 'in:submitted,under_review,assigned,in_progress,resolved,closed'],
            'note'   => ['nullable', 'string'],
        ]);

        $legalRequest->update([
            'status'      => $validated['status'],
            'resolved_at' => $validated['status'] === 'resolved' ? now() : $legalRequest->resolved_at,
        ]);

        LegalRequestTimeline::create([
            'legal_request_id' => $legalRequest->id,
            'title'            => $legalRequest->status_label,
            'description'      => $validated['note'] ?? null,
            'status'           => 'completed',
            'created_by'       => Auth::guard('admin')->id(),
            'created_by_type'  => 'admin',
            'sort_order'       => ($legalRequest->timelines()->max('sort_order') ?? 0) + 1,
        ]);

        return back()->with('success', 'Status updated to ' . $legalRequest->status_label . '.');
    }

    /**
     * Add a free-form note to the timeline (e.g. "Admin Note", "Lawyer Note",
     * "Legal Advice") without necessarily changing the status.
     */
    public function addNote(Request $request, LegalRequest $legalRequest)
    {
        $validated = $request->validate([
            'title'       => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
        ]);

        LegalRequestTimeline::create([
            'legal_request_id' => $legalRequest->id,
            'title'            => $validated['title'],
            'description'      => $validated['description'],
            'status'           => 'completed',
            'created_by'       => Auth::guard('admin')->id(),
            'created_by_type'  => 'admin',
            'sort_order'       => ($legalRequest->timelines()->max('sort_order') ?? 0) + 1,
        ]);

        return back()->with('success', 'Note added.');
    }

    /**
     * Reply in the chat thread as the admin/lawyer.
     */
    public function sendMessage(Request $request, LegalRequest $legalRequest)
    {
        $validated = $request->validate([
            'message'       => ['required', 'string'],
            'attachments'   => ['nullable', 'array'],
            'attachments.*' => ['file', 'max:10240'],
        ]);

        $message = DB::transaction(function () use ($validated, $legalRequest, $request) {
            $message = LegalRequestMessage::create([
                'legal_request_id' => $legalRequest->id,
                'sender_id'        => Auth::guard('admin')->id(),
                'sender_type'      => 'admin',
                'message'          => $validated['message'],
            ]);

            if ($request->hasFile('attachments')) {
                foreach ($request->file('attachments') as $file) {
                    $path = $file->store('legal-requests/' . $legalRequest->id . '/messages', 'public');

                    LegalRequestMessageAttachment::create([
                        'legal_request_message_id' => $message->id,
                        'file_name'                => $file->getClientOriginalName(),
                        'file_path'                => $path,
                        'file_type'                => $file->getClientOriginalExtension(),
                    ]);
                }
            }

            return $message;
        });

        if ($request->wantsJson()) {
            return response()->json(['message' => $message->load('attachments')]);
        }

        return back()->with('success', 'Reply sent.');
    }

    /**
     * Admin/lawyer attaches a supporting document (e.g. drafted advice letter).
     */
    public function uploadDocument(Request $request, LegalRequest $legalRequest)
    {
        $request->validate([
            'documents'   => ['required', 'array'],
            'documents.*' => ['file', 'max:10240'],
        ]);

        foreach ($request->file('documents') as $file) {
            $path = $file->store('legal-requests/' . $legalRequest->id, 'public');

            LegalRequestDocument::create([
                'legal_request_id' => $legalRequest->id,
                'uploaded_by'      => Auth::guard('admin')->id(),
                'uploaded_by_type' => 'admin',
                'file_name'        => $file->getClientOriginalName(),
                'file_path'        => $path,
                'file_type'        => $file->getClientOriginalExtension(),
                'file_size'        => $file->getSize(),
            ]);
        }

        return back()->with('success', 'Document(s) uploaded.');
    }
}
