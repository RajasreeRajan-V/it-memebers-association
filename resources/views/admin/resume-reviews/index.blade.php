@extends('admin.layout.app')

@section('content')

<div class="content-header">
    <h2>Resume Review Management</h2>
    <p>Assign uploaded resumes to mentors and review mentor submissions before they are visible to students.</p>
</div>

{{-- Success Message --}}
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

{{-- Error Message --}}
@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif


{{-- =========================================================
     SECTION 1: RESUME ASSIGNMENT
     ========================================================= --}}

<div class="card" style="padding:1.25rem; margin-bottom:1.5rem;">

    <div style="margin-bottom:1rem;">
        <h3 style="margin:0;">Resume Assignments</h3>

        <p style="margin:5px 0 0; color:#6b7280;">
            Assign uploaded resumes to mentors.
        </p>
    </div>

    <div style="overflow-x:auto;">

        <table class="table" style="width:100%;">

            <thead>
                <tr>
                    <th>Student</th>
                    <th>Mentor</th>
                    <th>Status</th>
                    <th>ATS Score</th>
                    <th>Assign Mentor</th>
                </tr>
            </thead>

            <tbody>

                @forelse($reviews as $review)

                    <tr>

                        {{-- Student --}}
                        <td>
                            <strong>
                                {{ $review->student->name ?? '-' }}
                            </strong>
                        </td>


                        {{-- Mentor --}}
                        <td>
                            {{ $review->mentor->name ?? 'Unassigned' }}
                        </td>


                        {{-- Status --}}
                        <td>

                            @if($review->status === 'pending_admin')

                                <span class="badge bg-warning text-dark">
                                    Pending Admin

                                </span>

                            @elseif($review->status === 'in_review')

                                <span class="badge bg-info">
                                    In Review
                                </span>

                            @elseif($review->status === 'completed')

                                <span class="badge bg-success">
                                    Approved
                                </span>

                            @elseif($review->status === 'pending')

                                <span class="badge bg-secondary">
                                    Pending
                                </span>

                            @else

                                <span class="badge bg-secondary">
                                    {{ ucfirst(str_replace('_', ' ', $review->status)) }}
                                </span>

                            @endif

                        </td>


                        {{-- ATS Score --}}
                        <td>
                            {{ $review->ats_score ?? '-' }}
                        </td>


                        {{-- Assign --}}
                        <td>

                            <form
                                method="POST"
                                action="{{ route('admin.resume-reviews.assign', $review) }}"
                                style="display:flex;gap:.5rem;"
                            >

                                @csrf

                                <select
                                    name="mentor_id"
                                    required
                                    class="form-select form-select-sm"
                                >

                                    <option value="">
                                        Select mentor
                                    </option>

                                    @foreach($mentors as $mentor)

                                        <option
                                            value="{{ $mentor->id }}"
                                            @selected($review->mentor_id == $mentor->id)
                                        >
                                            {{ $mentor->name }}
                                        </option>

                                    @endforeach

                                </select>

                                <button
                                    type="submit"
                                    class="btn btn-primary btn-sm"
                                >
                                    Assign
                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="5" class="text-center">
                            No resumes submitted yet.
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    {{ $reviews->links() }}

</div>



{{-- =========================================================
     SECTION 2: ADMIN CONFIRMATION
     ========================================================= --}}

<div class="card" style="padding:1.25rem;">

    <div
        style="
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin-bottom:1.25rem;
            gap:1rem;
            flex-wrap:wrap;
        "
    >

        <div>

            <h3 style="margin:0;">
                Mentor Reviews Awaiting Confirmation
            </h3>

            <p style="margin:5px 0 0;color:#6b7280;">
                Review mentor feedback before making it visible to the student.
            </p>

        </div>


        {{-- Pending count --}}

        @php
            $pendingConfirmations = \App\Models\AdminConfirmation::where(
                'action',
                'resume_review'
            )
            ->where('status', 'pending')
            ->count();
        @endphp

        <span
            style="
                background:#fff3cd;
                color:#856404;
                padding:6px 12px;
                border-radius:20px;
                font-size:13px;
                font-weight:600;
            "
        >
            {{ $pendingConfirmations }} Pending
        </span>

    </div>



    {{-- Confirmation Requests --}}

    @php

        $resumeConfirmations = \App\Models\AdminConfirmation::with([
            'confirmable.student',
            'confirmable.mentor'
        ])
        ->where('action', 'resume_review')
        ->where('status', 'pending')
        ->latest()
        ->get();

    @endphp


    @forelse($resumeConfirmations as $confirmation)

        @php
            $review = $confirmation->confirmable;
        @endphp


        @if($review)

            <div
                style="
                    border:1px solid #e5e7eb;
                    border-radius:12px;
                    padding:1.25rem;
                    margin-bottom:1rem;
                    background:#fff;
                "
            >

                {{-- Header --}}

                <div
                    style="
                        display:flex;
                        justify-content:space-between;
                        align-items:flex-start;
                        gap:1rem;
                        flex-wrap:wrap;
                        margin-bottom:1rem;
                    "
                >

                    <div>

                        <h4 style="margin:0 0 5px;">
                            {{ $review->student->name ?? 'Unknown Student' }}
                        </h4>

                        <p style="margin:0;color:#6b7280;font-size:13px;">

                            Mentor:
                            <strong>
                                {{ $review->mentor->name ?? 'Unknown Mentor' }}
                            </strong>

                        </p>

                    </div>


                    <span
                        class="badge bg-warning text-dark"
                        style="padding:7px 10px;"
                    >
                        Pending Admin Confirmation
                    </span>

                </div>



                {{-- Review Information --}}

                <div
                    style="
                        display:grid;
                        grid-template-columns:repeat(4,1fr);
                        gap:12px;
                        margin-bottom:1rem;
                    "
                >

                    {{-- Overall --}}

                    <div
                        style="
                            background:#f8fafc;
                            padding:12px;
                            border-radius:8px;
                        "
                    >

                        <small style="color:#6b7280;">
                            Overall Rating
                        </small>

                        <div style="font-weight:700;margin-top:4px;">

                            {{ $review->overall_rating ?? '-' }}/5

                        </div>

                    </div>


                    {{-- Resume Quality --}}

                    <div
                        style="
                            background:#f8fafc;
                            padding:12px;
                            border-radius:8px;
                        "
                    >

                        <small style="color:#6b7280;">
                            Resume Quality
                        </small>

                        <div style="font-weight:700;margin-top:4px;">

                            {{ $review->resume_quality ?? '-' }}/5

                        </div>

                    </div>


                    {{-- Relevance --}}

                    <div
                        style="
                            background:#f8fafc;
                            padding:12px;
                            border-radius:8px;
                        "
                    >

                        <small style="color:#6b7280;">
                            Relevance
                        </small>

                        <div style="font-weight:700;margin-top:4px;">

                            {{ $review->relevance ?? '-' }}/5

                        </div>

                    </div>


                    {{-- Presentation --}}

                    <div
                        style="
                            background:#f8fafc;
                            padding:12px;
                            border-radius:8px;
                        "
                    >

                        <small style="color:#6b7280;">
                            Presentation
                        </small>

                        <div style="font-weight:700;margin-top:4px;">

                            {{ $review->presentation ?? '-' }}/5

                        </div>

                    </div>

                </div>



                {{-- Strengths --}}

                @if($review->strengths)

                    <div
                        style="
                            background:#f0fdf4;
                            border-radius:8px;
                            padding:12px;
                            margin-bottom:10px;
                        "
                    >

                        <strong style="color:#15803d;">
                            ✓ Strengths
                        </strong>

                        <p style="margin:5px 0 0;color:#374151;">
                            {{ $review->strengths }}
                        </p>

                    </div>

                @endif



                {{-- Areas to Improve --}}

                @if($review->areas_to_improve)

                    <div
                        style="
                            background:#fef2f2;
                            border-radius:8px;
                            padding:12px;
                            margin-bottom:10px;
                        "
                    >

                        <strong style="color:#dc2626;">
                            ⚠ Areas to Improve
                        </strong>

                        <p style="margin:5px 0 0;color:#374151;">
                            {{ $review->areas_to_improve }}
                        </p>

                    </div>

                @endif



                {{-- Additional Comments --}}

                @if($review->additional_comments)

                    <div
                        style="
                            background:#eff6ff;
                            border-radius:8px;
                            padding:12px;
                            margin-bottom:15px;
                        "
                    >

                        <strong style="color:#2563eb;">
                            Additional Comments
                        </strong>

                        <p style="margin:5px 0 0;color:#374151;">
                            {{ $review->additional_comments }}
                        </p>

                    </div>

                @endif



                {{-- Actions --}}

                <div
                    style="
                        display:flex;
                        justify-content:flex-end;
                        gap:10px;
                        flex-wrap:wrap;
                    "
                >

                    {{-- View Resume --}}

                    @if($review->resume_url)

                        <a
                            href="{{ $review->resume_url }}"
                            target="_blank"
                            class="btn btn-outline-primary btn-sm"
                        >
                            <i class="fa-regular fa-eye"></i>
                            View Resume
                        </a>

                    @endif



                    {{-- Reject --}}

                    <button
                        type="button"
                        class="btn btn-outline-danger btn-sm"
                        data-bs-toggle="modal"
                        data-bs-target="#rejectModal{{ $confirmation->id }}"
                    >
                        <i class="fa-solid fa-xmark"></i>
                        Reject
                    </button>



                    {{-- Approve --}}

                    <form
                        method="POST"
                        action="{{ route('admin.confirmations.approve', $confirmation) }}"
                    >

                        @csrf

                        <button
                            type="submit"
                            class="btn btn-success btn-sm"
                        >
                            <i class="fa-solid fa-check"></i>
                            Approve & Publish
                        </button>

                    </form>

                </div>

            </div>



            {{-- =====================================================
                 REJECT MODAL
                 ===================================================== --}}

            <div
                class="modal fade"
                id="rejectModal{{ $confirmation->id }}"
                tabindex="-1"
            >

                <div class="modal-dialog">

                    <div class="modal-content">

                        <form
                            method="POST"
                            action="{{ route('admin.confirmations.reject', $confirmation) }}"
                        >

                            @csrf

                            <div class="modal-header">

                                <h5 class="modal-title">
                                    Reject Resume Review
                                </h5>

                                <button
                                    type="button"
                                    class="btn-close"
                                    data-bs-dismiss="modal"
                                ></button>

                            </div>


                            <div class="modal-body">

                                <p>
                                    The mentor will receive this review again
                                    and can revise the feedback.
                                </p>

                                <label class="form-label">
                                    Admin Remarks
                                </label>

                                <textarea
                                    name="admin_notes"
                                    class="form-control"
                                    rows="4"
                                    required
                                    placeholder="Explain what the mentor needs to improve..."
                                ></textarea>

                            </div>


                            <div class="modal-footer">

                                <button
                                    type="button"
                                    class="btn btn-secondary"
                                    data-bs-dismiss="modal"
                                >
                                    Cancel
                                </button>

                                <button
                                    type="submit"
                                    class="btn btn-danger"
                                >
                                    Reject Review
                                </button>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        @endif

    @empty

        <div
            style="
                text-align:center;
                padding:3rem 1rem;
                color:#6b7280;
            "
        >

            <i
                class="fa-regular fa-circle-check"
                style="
                    font-size:40px;
                    color:#10b981;
                    margin-bottom:12px;
                "
            ></i>

            <h4>
                No Pending Confirmations
            </h4>

            <p>
                All mentor resume reviews have been processed.
            </p>

        </div>

    @endforelse

</div>


{{-- =========================================================
     WORKFLOW
     ========================================================= --}}

<div
    class="card"
    style="
        padding:1.25rem;
        margin-top:1.5rem;
    "
>

    <h3 style="margin-top:0;">
        Resume Review Approval Workflow
    </h3>

    <div
        style="
            display:flex;
            align-items:center;
            justify-content:space-between;
            gap:10px;
            flex-wrap:wrap;
            margin-top:1rem;
        "
    >

        <div style="text-align:center;min-width:120px;">
            <strong>Mentor</strong>
            <p style="font-size:13px;color:#6b7280;margin:5px 0;">
                Reviews Resume
            </p>
        </div>

        <i class="fa-solid fa-arrow-right text-muted"></i>

        <div style="text-align:center;min-width:140px;">
            <strong>Admin</strong>
            <p style="font-size:13px;color:#6b7280;margin:5px 0;">
                Receives Confirmation
            </p>
        </div>

        <i class="fa-solid fa-arrow-right text-muted"></i>

        <div style="text-align:center;min-width:120px;">
            <strong>Admin Checks</strong>
            <p style="font-size:13px;color:#6b7280;margin:5px 0;">
                Reviews Feedback
            </p>
        </div>

        <i class="fa-solid fa-arrow-right text-muted"></i>

        <div style="text-align:center;min-width:100px;">
            <strong class="text-success">
                Approve
            </strong>
            <p style="font-size:13px;color:#6b7280;margin:5px 0;">
                Student sees it
            </p>
        </div>

        <span style="color:#9ca3af;">OR</span>

        <div style="text-align:center;min-width:100px;">
            <strong class="text-danger">
                Reject
            </strong>
            <p style="font-size:13px;color:#6b7280;margin:5px 0;">
                Mentor revises
            </p>
        </div>

    </div>

</div>

@endsection