@extends('layouts.app')

@section('content')

<div class="mentor-request-page">

    {{-- Header --}}
    <div class="page-header">

        <div>
            <span class="page-label">
                MENTORSHIP
            </span>

            <h1>
                Mentorship Requests
            </h1>

            <p>
                Review students who want to connect with you.
            </p>
        </div>

        <div class="pending-summary">
            <div class="summary-icon">
                <i class="fa-regular fa-clock"></i>
            </div>

            <div>
                <span>Pending Requests</span>
                <strong>{{ $requests->total() }}</strong>
            </div>
        </div>

    </div>


    {{-- Success Message --}}
    @if(session('success'))

        <div class="alert-success">
            <i class="fa-solid fa-circle-check"></i>
            {{ session('success') }}
        </div>

    @endif


    {{-- Requests --}}
    <div class="request-list">

        @forelse($requests as $request)

            <div class="request-card">

                {{-- Student Header --}}
                <div class="request-header">

                    <div class="student-profile">

                        <div class="student-avatar">
                            {{ strtoupper(substr($request->mentee->name ?? 'S', 0, 1)) }}
                        </div>

                        <div>

                            <h3>
                                {{ $request->mentee->name ?? 'Student' }}
                            </h3>

                            <p>
                                {{ $request->mentee->email ?? 'No email available' }}
                            </p>

                        </div>

                    </div>

                    <span class="status-badge pending">
                        <i class="fa-regular fa-clock"></i>
                        Pending
                    </span>

                </div>


                {{-- Request Details --}}
                <div class="request-details">

                    <div class="detail-box">

                        <span class="detail-label">
                            Preferred Date
                        </span>

                        <strong>
                            {{ \Carbon\Carbon::parse($request->preferred_date)->format('d M Y') }}
                        </strong>

                    </div>


                    <div class="detail-box">

                        <span class="detail-label">
                            Preferred Time
                        </span>

                        <strong>
                            {{ \Carbon\Carbon::parse($request->preferred_time)->format('h:i A') }}
                        </strong>

                    </div>


                    <div class="detail-box">

                        <span class="detail-label">
                            Requested On
                        </span>

                        <strong>
                            {{ $request->created_at->format('d M Y') }}
                        </strong>

                    </div>

                </div>


                {{-- Learning Goal --}}
                <div class="learning-goal">

                    <div class="goal-title">
                        <i class="fa-solid fa-bullseye"></i>
                        Learning Goal
                    </div>

                    <p>
                        {{ $request->goal }}
                    </p>

                </div>

{{-- Actions --}}
<div class="request-actions">

    {{-- View Student --}}
    <a href="#"
       class="btn-view">
        <i class="fa-regular fa-user"></i>
        View Student
    </a>

    {{-- Reject --}}
    <form
        action="{{ route('mentor.mentorship.requests.reject', $request->id) }}"
        method="POST">

        @csrf

        <button type="submit"
                class="btn-reject"
                onclick="return confirm('Are you sure you want to reject this request?')">

            <i class="fa-solid fa-xmark"></i>
            Reject

        </button>

    </form>

    {{-- Accept --}}
    <form
        action="{{ route('mentor.mentorship.requests.accept', $request->id) }}"
        method="POST">

        @csrf

        <button type="submit"
                class="btn-accept">

            <i class="fa-solid fa-check"></i>
            Accept Request

        </button>

    </form>

</div>

            </div>

        @empty

            <div class="empty-state">

                <div class="empty-icon">
                    <i class="fa-regular fa-calendar-check"></i>
                </div>

                <h2>
                    No Pending Requests
                </h2>

                <p>
                    You don't have any new mentorship requests right now.
                </p>

            </div>

        @endforelse

    </div>


    {{-- Pagination --}}
    @if($requests->hasPages())

        <div class="pagination-wrapper">
            {{ $requests->links() }}
        </div>

    @endif

</div>


<style>

.mentor-request-page {
    padding: 35px;
    max-width: 1200px;
    margin: auto;
}

/* Header */

.page-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
}

.page-label {
    font-size: 12px;
    font-weight: 700;
    color: #3376F2;
    letter-spacing: 1px;
}

.page-header h1 {
    margin: 7px 0;
    font-size: 32px;
    font-weight: 700;
    color: #172033;
}

.page-header p {
    margin: 0;
    color: #718096;
}


/* Summary */

.pending-summary {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 15px 20px;
    background: #fff;
    border: 1px solid #e7ebf2;
    border-radius: 14px;
}

.summary-icon {
    width: 42px;
    height: 42px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #eef4ff;
    color: #3376F2;
    border-radius: 10px;
}

.pending-summary span {
    display: block;
    font-size: 12px;
    color: #718096;
}

.pending-summary strong {
    display: block;
    margin-top: 3px;
    font-size: 20px;
}


/* Alert */

.alert-success {
    padding: 14px 18px;
    margin-bottom: 20px;
    border-radius: 10px;
    background: #ecfdf3;
    color: #16794c;
}


/* Request Card */

.request-card {
    background: #fff;
    border: 1px solid #e6eaf0;
    border-radius: 18px;
    padding: 25px;
    margin-bottom: 20px;
    box-shadow: 0 5px 20px rgba(0,0,0,.04);
}


/* Student */

.request-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.student-profile {
    display: flex;
    align-items: center;
    gap: 14px;
}

.student-avatar {
    width: 55px;
    height: 55px;
    border-radius: 50%;
    background: #3376F2;
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    font-weight: 700;
}

.student-profile h3 {
    margin: 0 0 4px;
    font-size: 18px;
}

.student-profile p {
    margin: 0;
    color: #718096;
    font-size: 13px;
}


/* Status */

.status-badge {
    padding: 7px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
}

.status-badge.pending {
    background: #fff7e6;
    color: #b7791f;
}


/* Details */

.request-details {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 15px;
    margin-top: 25px;
}

.detail-box {
    padding: 15px;
    background: #f8fafc;
    border-radius: 12px;
}

.detail-label {
    display: block;
    font-size: 12px;
    color: #718096;
    margin-bottom: 6px;
}

.detail-box strong {
    font-size: 14px;
}


/* Goal */

.learning-goal {
    margin-top: 20px;
    padding: 18px;
    background: #f8faff;
    border-radius: 12px;
}

.goal-title {
    font-size: 13px;
    font-weight: 700;
    color: #3376F2;
}

.learning-goal p {
    margin: 8px 0 0;
    color: #4a5568;
    line-height: 1.6;
}


/* Buttons */

.request-actions {
    display: flex;
    justify-content: flex-end;
    gap: 10px;
    margin-top: 22px;
}

.request-actions form {
    margin: 0;
}

.btn-view,
.btn-reject,
.btn-accept {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    padding: 10px 16px;
    border-radius: 9px;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    text-decoration: none;
}

.btn-view {
    border: 1px solid #dce2ea;
    color: #344054;
    background: #fff;
}

.btn-reject {
    border: 1px solid #f1b8b8;
    color: #c53030;
    background: #fff;
}

.btn-accept {
    border: none;
    background: #3376F2;
    color: #fff;
}


/* Empty */

.empty-state {
    text-align: center;
    background: #fff;
    border: 1px solid #e7ebf2;
    border-radius: 18px;
    padding: 70px 20px;
}

.empty-icon {
    width: 70px;
    height: 70px;
    margin: auto;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #eef4ff;
    color: #3376F2;
    font-size: 28px;
}

.empty-state h2 {
    margin: 20px 0 8px;
}

.empty-state p {
    color: #718096;
}


/* Responsive */

@media(max-width: 768px) {

    .mentor-request-page {
        padding: 20px;
    }

    .page-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 20px;
    }

    .request-details {
        grid-template-columns: 1fr;
    }

    .request-actions {
        flex-wrap: wrap;
        justify-content: flex-start;
    }

}

</style>

@endsection