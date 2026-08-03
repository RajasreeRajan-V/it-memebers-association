@extends('admin.layout.app')

@section('title', $legalRequest->request_number)
@section('page-title', $legalRequest->request_number)
@section('page-subtitle', 'Legal request detail')

@push('styles')
<style>
    .lh-back {
        display: inline-block;
        font-size: 0.85rem;
        color: #8a8fa8;
        text-decoration: none;
        margin-bottom: 1rem;
    }
    .lh-back:hover { color: #1a1a2e; }

    .lh-alert {
        padding: 0.9rem 1.2rem;
        border-radius: 10px;
        background: #ecfdf5;
        border: 1px solid #a7f3d0;
        color: #065f46;
        margin-bottom: 1.5rem;
        font-size: 0.9rem;
    }

    .lh-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }
    @media (min-width: 1024px) { .lh-grid { grid-template-columns: 1fr 2fr; } }

    .lh-col { display: flex; flex-direction: column; gap: 1.5rem; }

    .lh-card {
        background: #fff;
        border: 1px solid #e9edf4;
        border-radius: 12px;
        padding: 1.5rem;
    }
    .lh-card h3 {
        font-size: 0.9rem;
        font-weight: 700;
        color: #1a1a2e;
        margin-bottom: 0.9rem;
    }

    .lh-meta-id { font-size: 0.75rem; color: #8a8fa8; }
    .lh-meta-title { font-size: 1rem; font-weight: 700; color: #1a1a2e; margin: 0.25rem 0 0.6rem; }
    .lh-meta-desc { font-size: 0.85rem; color: #5a5f7a; line-height: 1.6; }

    .lh-dl {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 0.9rem;
        margin-top: 1.1rem;
        font-size: 0.85rem;
    }
    .lh-dl dt { font-size: 0.7rem; color: #8a8fa8; margin-bottom: 0.15rem; }
    .lh-dl dd { color: #1a1a2e; font-weight: 500; }

    /* forms */
    .lh-field {
        width: 100%;
        border: 1px solid #dfe3ee;
        border-radius: 8px;
        padding: 0.6rem 0.75rem;
        font-size: 0.85rem;
        font-family: inherit;
        color: #1a1a2e;
        margin-bottom: 0.6rem;
    }
    .lh-field:focus { outline: none; border-color: #4a6cf7; box-shadow: 0 0 0 3px rgba(74, 108, 247, 0.12); }
    textarea.lh-field { resize: vertical; }

    .lh-form-row { display: flex; gap: 0.6rem; }
    .lh-form-row .lh-field { margin-bottom: 0; }

    .lh-btn-primary {
        background: #4a6cf7;
        color: #fff;
        border: none;
        border-radius: 8px;
        padding: 0.6rem 1.1rem;
        font-size: 0.85rem;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.2s;
        white-space: nowrap;
    }
    .lh-btn-primary:hover { background: #3a5ce0; }
    .lh-btn-primary.block { width: 100%; }

    .lh-btn-outline {
        background: #fff;
        color: #4a4f66;
        border: 1px solid #dfe3ee;
        border-radius: 8px;
        padding: 0.6rem 1.1rem;
        font-size: 0.85rem;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.2s;
        width: 100%;
    }
    .lh-btn-outline:hover { background: #f8f9fc; }

    /* timeline */
    .lh-timeline {
        list-style: none;
        border-left: 2px solid #eef0f6;
        margin-top: 0.5rem;
        padding-left: 1.1rem;
    }
    .lh-timeline li { position: relative; margin-bottom: 1.2rem; }
    .lh-timeline li:last-child { margin-bottom: 0; }
    .lh-timeline .dot {
        position: absolute;
        left: -1.5rem;
        top: 0.15rem;
        width: 16px;
        height: 16px;
        border-radius: 50%;
        background: #10b981;
        color: #fff;
        font-size: 9px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .lh-timeline .step-title { font-size: 0.85rem; font-weight: 600; color: #1a1a2e; }
    .lh-timeline .step-desc { font-size: 0.78rem; color: #8a8fa8; margin-top: 0.1rem; }
    .lh-timeline .step-meta { font-size: 0.7rem; color: #b0b4c4; margin-top: 0.15rem; }
    .lh-empty-mini { font-size: 0.8rem; color: #b0b4c4; }

    /* chat */
    .lh-chat {
        max-height: 24rem;
        overflow-y: auto;
        display: flex;
        flex-direction: column;
        gap: 0.9rem;
        padding-right: 0.25rem;
        margin-bottom: 1rem;
    }
    .lh-msg-row { display: flex; }
    .lh-msg-row.mine { justify-content: flex-end; }
    .lh-msg-row.theirs { justify-content: flex-start; }
    .lh-bubble {
        max-width: 75%;
        border-radius: 12px;
        padding: 0.65rem 1rem;
        font-size: 0.85rem;
    }
    .lh-bubble.mine { background: #4a6cf7; color: #fff; }
    .lh-bubble.theirs { background: #f1f2f6; color: #2b2f42; }
    .lh-bubble .sender-name { font-size: 0.7rem; font-weight: 700; margin-bottom: 0.2rem; opacity: 0.85; }
    .lh-bubble .attachment { display: block; font-size: 0.75rem; margin-top: 0.35rem; text-decoration: underline; }
    .lh-bubble.mine .attachment { color: #dbe3ff; }
    .lh-bubble.theirs .attachment { color: #4a6cf7; }
    .lh-bubble .time { font-size: 0.65rem; margin-top: 0.3rem; opacity: 0.75; }

    .lh-chat-form {
        display: flex;
        align-items: center;
        gap: 0.6rem;
        border-top: 1px solid #eef0f6;
        padding-top: 1rem;
    }
    .lh-chat-form input[type="text"] {
        flex: 1;
        border: 1px solid #dfe3ee;
        border-radius: 8px;
        padding: 0.6rem 0.85rem;
        font-size: 0.85rem;
        font-family: inherit;
    }
    .lh-chat-form input[type="text"]:focus { outline: none; border-color: #4a6cf7; box-shadow: 0 0 0 3px rgba(74,108,247,0.12); }
    .lh-attach-label { cursor: pointer; color: #8a8fa8; font-size: 1.1rem; }
    .lh-attach-label:hover { color: #4a6cf7; }

    /* documents */
    .lh-doc-list { list-style: none; display: flex; flex-direction: column; gap: 0.5rem; margin-bottom: 1rem; }
    .lh-doc-item { display: flex; align-items: center; justify-content: space-between; font-size: 0.85rem; }
    .lh-doc-item a { color: #4a6cf7; text-decoration: none; }
    .lh-doc-item a:hover { text-decoration: underline; }
    .lh-doc-meta { font-size: 0.72rem; color: #b0b4c4; }
    .lh-upload-form { display: flex; gap: 0.6rem; }
    .lh-upload-form input[type="file"] { flex: 1; font-size: 0.8rem; }
</style>
@endpush

@section('content')
<a href="{{ route('admin.legal-help.index') }}" class="lh-back">&larr; Back to Legal Help</a>

@if(session('success'))
    <div class="lh-alert">{{ session('success') }}</div>
@endif

<div class="lh-grid">

    {{-- Left: request info + controls --}}
    <div class="lh-col">

        <div class="lh-card">
            <div class="lh-meta-id">Request ID: {{ $legalRequest->request_number }}</div>
            <div class="lh-meta-title">{{ $legalRequest->issue_title }}</div>
            <p class="lh-meta-desc">{{ $legalRequest->description }}</p>

            <dl class="lh-dl">
                <div>
                    <dt>Employee</dt>
                    <dd>{{ $legalRequest->employee->name ?? '—' }}</dd>
                </div>
                <div>
                    <dt>Category</dt>
                    <dd>{{ $legalRequest->category }}</dd>
                </div>
                <div>
                    <dt>Priority</dt>
                    <dd>{{ $legalRequest->priority_label }}</dd>
                </div>
                <div>
                    <dt>Raised On</dt>
                    <dd>{{ $legalRequest->created_at->format('d M Y') }}</dd>
                </div>
            </dl>
        </div>

        {{-- Assign --}}
        <div class="lh-card">
            <h3>Assign Handler</h3>
            <form action="{{ route('admin.legal-help.assign', $legalRequest) }}" method="POST" class="lh-form-row">
                @csrf
                <select name="assigned_admin_id" required class="lh-field">
                    <option value="">Select admin/lawyer</option>
                    @foreach($admins as $admin)
                        <option value="{{ $admin->id }}" @selected($legalRequest->assigned_admin_id === $admin->id)>{{ $admin->name }}</option>
                    @endforeach
                </select>
                <button type="submit" class="lh-btn-primary">Assign</button>
            </form>
        </div>

        {{-- Status --}}
        <div class="lh-card">
            <h3>Update Status</h3>
            <form action="{{ route('admin.legal-help.status', $legalRequest) }}" method="POST">
                @csrf
                <select name="status" required class="lh-field">
                    @foreach(['submitted' => 'Submitted', 'under_review' => 'Under Review', 'assigned' => 'Assigned', 'in_progress' => 'In Progress', 'resolved' => 'Resolved', 'closed' => 'Closed'] as $value => $label)
                        <option value="{{ $value }}" @selected($legalRequest->status === $value)>{{ $label }}</option>
                    @endforeach
                </select>
                <input type="text" name="note" placeholder="Optional note shown in timeline..." class="lh-field">
                <button type="submit" class="lh-btn-primary block">Update Status</button>
            </form>
        </div>

        {{-- Add note --}}
        <div class="lh-card">
            <h3>Add Timeline Note</h3>
            <form action="{{ route('admin.legal-help.notes.store', $legalRequest) }}" method="POST">
                @csrf
                <input type="text" name="title" required placeholder="e.g. Admin Note, Legal Advice" class="lh-field">
                <textarea name="description" required rows="3" placeholder="Details..." class="lh-field"></textarea>
                <button type="submit" class="lh-btn-outline">Add Note</button>
            </form>
        </div>

        {{-- Timeline --}}
        <div class="lh-card">
            <h3>Timeline</h3>
            <ol class="lh-timeline">
                @forelse($legalRequest->timelines as $step)
                    <li>
                        <span class="dot">&#10003;</span>
                        <div class="step-title">{{ $step->title }}</div>
                        @if($step->description)
                            <div class="step-desc">{{ $step->description }}</div>
                        @endif
                        <div class="step-meta">
                            {{ $step->created_at->format('d M Y, h:i A') }}
                            @if($step->creator) &middot; {{ $step->creator->name }} @endif
                        </div>
                    </li>
                @empty
                    <li class="lh-empty-mini">No updates yet.</li>
                @endforelse
            </ol>
        </div>
    </div>

    {{-- Right: chat + documents --}}
    <div class="lh-col">

        <div class="lh-card">
            <h3>Conversation</h3>

            <div class="lh-chat">
                @forelse($legalRequest->messages as $message)
                  @php $isAdmin = $message->sender_type === 'admin'; @endphp
<div class="lh-msg-row {{ $isAdmin ? 'mine' : 'theirs' }}">
    <div class="lh-bubble {{ $isAdmin ? 'mine' : 'theirs' }}">
        <div class="sender-name">
            {{ $message->sender->name ?? 'Legal Team' }}
            @if(!$isAdmin) (employee) @endif
        </div>
                            <div>{{ $message->message }}</div>

                            @if($message->attachments->count())
                                @foreach($message->attachments as $attachment)
                                    <a href="{{ Storage::disk('public')->url($attachment->file_path) }}" target="_blank" class="attachment">
                                        📎 {{ $attachment->file_name }}
                                    </a>
                                @endforeach
                            @endif

                            <div class="time">{{ $message->created_at->format('d M, h:i A') }}</div>
                        </div>
                    </div>
                @empty
                    <p class="lh-empty-mini">No messages yet.</p>
                @endforelse
            </div>

            <form action="{{ route('admin.legal-help.messages.store', $legalRequest) }}" method="POST" enctype="multipart/form-data" class="lh-chat-form">
                @csrf
                <input type="text" name="message" required placeholder="Reply to employee...">
                <label class="lh-attach-label">
                    📎
                    <input type="file" name="attachments[]" multiple style="display:none;">
                </label>
                <button type="submit" class="lh-btn-primary">Send</button>
            </form>
        </div>

        {{-- Documents --}}
        <div class="lh-card">
            <h3>Documents</h3>

            <ul class="lh-doc-list">
                @forelse($legalRequest->documents as $document)
                    <li class="lh-doc-item">
                        <a href="{{ Storage::disk('public')->url($document->file_path) }}" target="_blank">
                            📎 {{ $document->file_name }}
                        </a>
                        <span class="lh-doc-meta">
                            {{ $document->file_size_human }} &middot; {{ $document->uploaded_by_type === 'admin' ? 'Admin' : 'Employee' }}
                        </span>
                    </li>
                @empty
                    <li class="lh-empty-mini">No documents uploaded.</li>
                @endforelse
            </ul>

            <form action="{{ route('admin.legal-help.documents.store', $legalRequest) }}" method="POST" enctype="multipart/form-data" class="lh-upload-form">
                @csrf
                <input type="file" name="documents[]" multiple required>
                <button type="submit" class="lh-btn-outline" style="width:auto;">Upload</button>
            </form>
        </div>
    </div>
</div>
@endsection
