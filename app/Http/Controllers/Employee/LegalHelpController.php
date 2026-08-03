<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\LegalRequest;
use App\Models\LegalRequestDocument;
use App\Models\LegalRequestMessage;
use App\Models\LegalRequestMessageAttachment;
use App\Models\LegalRequestTimeline;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class LegalHelpController extends Controller
{
    /**
     * Main "My Legal Requests" dashboard — table + stats cards
     * matching the reference design.
     */
    public function index(Request $request)
    {
        $employeeId = Auth::id();

        $baseQuery = LegalRequest::query()->where('employee_id', $employeeId);

        $stats = [
            'total'        => (clone $baseQuery)->count(),
            'under_review' => (clone $baseQuery)->where('status', 'under_review')->count(),
            'in_progress'  => (clone $baseQuery)->where('status', 'in_progress')->count(),
            'resolved'     => (clone $baseQuery)->where('status', 'resolved')->count(),
            'closed'       => (clone $baseQuery)->where('status', 'closed')->count(),
        ];

        $legalRequests = (clone $baseQuery)
            ->when($request->filled('status'), fn ($q) => $q->where('status', $request->status))
            ->when($request->filled('search'), function ($q) use ($request) {
                $q->where(function ($sub) use ($request) {
                    $sub->where('issue_title', 'like', "%{$request->search}%")
                        ->orWhere('request_number', 'like', "%{$request->search}%")
                        ->orWhere('category', 'like', "%{$request->search}%");
                });
            })
            ->latest('updated_at')
            ->paginate(3)
            ->withQueryString();

        // Selected / most recent request shown in the details panel (right side)
        $selectedRequest = $request->filled('request')
            ? (clone $baseQuery)->with(['timelines', 'messages.sender', 'documents'])
                ->where('id', $request->integer('request'))->first()
            : (clone $baseQuery)->with(['timelines', 'messages.sender', 'documents'])
                ->latest('updated_at')->first();

        return view('employees.legal-help.index', compact('stats', 'legalRequests', 'selectedRequest'));
    }

    /**
     * Show a single legal request (timeline + messages + documents).
     */
    public function show(LegalRequest $legalRequest)
    {
        $this->authorizeOwner($legalRequest);

        $legalRequest->load(['timelines', 'messages', 'documents', 'assignedAdmin']);

        return view('employees.legal-help.show', compact('legalRequest'));
    }

    /**
     * Form to raise a new legal request.
     */
    public function create()
    {
        $categories = [
            'Salary Not Paid',
            'PF & Benefits',
            'Employment Issue',
            'Contract Review',
            'Workplace Harassment',
            'Termination Dispute',
            'Agreements & Contracts',
            'Other',
        ];

        return view('employees.legal-help.create', compact('categories'));
    }

    /**
     * Persist a new legal request + seed its timeline.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'issue_title' => ['required', 'string', 'max:255'],
            'category'    => ['required', 'string', 'max:255'],
            'priority'    => ['required', 'in:low,medium,high'],
            'description' => ['required', 'string'],
            'documents'   => ['nullable', 'array'],
            'documents.*' => ['file', 'max:10240'], // 10MB per file
        ]);

        $legalRequest = DB::transaction(function () use ($validated, $request) {
            $legalRequest = LegalRequest::create([
                'employee_id' => Auth::id(),
                'category'    => $validated['category'],
                'issue_title' => $validated['issue_title'],
                'description' => $validated['description'],
                'priority'    => $validated['priority'],
                'status'      => 'submitted',
            ]);

            LegalRequestTimeline::create([
                'legal_request_id' => $legalRequest->id,
                'title'            => 'Request Submitted',
                'description'      => 'Your request has been logged and legal team notified.',
                'status'           => 'completed',
                'created_by'       => Auth::id(),
                'sort_order'       => 1,
            ]);

            if ($request->hasFile('documents')) {
                foreach ($request->file('documents') as $file) {
                    $path = $file->store('legal-requests/' . $legalRequest->id, 'public');

                    LegalRequestDocument::create([
                        'legal_request_id' => $legalRequest->id,
                        'uploaded_by'      => Auth::id(),
                        'file_name'        => $file->getClientOriginalName(),
                        'file_path'        => $path,
                        'file_type'        => $file->getClientOriginalExtension(),
                        'file_size'        => $file->getSize(),
                    ]);
                }
            }

            return $legalRequest;
        });

        return redirect()
            ->route('employee.legal-help.show', $legalRequest)
            ->with('success', 'Your legal request ' . $legalRequest->request_number . ' has been submitted.');
    }

    /**
     * Send a chat message on a legal request (employee <-> lawyer/admin).
     */
    public function sendMessage(Request $request, LegalRequest $legalRequest)
    {
        $this->authorizeOwner($legalRequest);

        $validated = $request->validate([
            'message'      => ['required', 'string'],
            'attachments'   => ['nullable', 'array'],
            'attachments.*' => ['file', 'max:10240'],
        ]);

        $message = DB::transaction(function () use ($validated, $legalRequest, $request) {
            $message = LegalRequestMessage::create([
                'legal_request_id' => $legalRequest->id,
                'sender_id'        => Auth::id(),
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
            return response()->json([
                'message' => $message->load('sender', 'attachments'),
            ]);
        }

        return back()->with('success', 'Message sent.');
    }

    /**
     * Upload a supporting document to an existing legal request.
     */
    public function uploadDocument(Request $request, LegalRequest $legalRequest)
    {
        $this->authorizeOwner($legalRequest);

        $request->validate([
            'documents'   => ['required', 'array'],
            'documents.*' => ['file', 'max:10240'],
        ]);

        foreach ($request->file('documents') as $file) {
            $path = $file->store('legal-requests/' . $legalRequest->id, 'public');

            LegalRequestDocument::create([
                'legal_request_id' => $legalRequest->id,
                'uploaded_by'      => Auth::id(),
                'file_name'        => $file->getClientOriginalName(),
                'file_path'        => $path,
                'file_type'        => $file->getClientOriginalExtension(),
                'file_size'        => $file->getSize(),
            ]);
        }

        return back()->with('success', 'Document(s) uploaded.');
    }

    /**
     * Make sure the authenticated employee owns this legal request.
     */
    protected function authorizeOwner(LegalRequest $legalRequest): void
    {
        abort_unless($legalRequest->employee_id === Auth::id(), 403);
    }
}