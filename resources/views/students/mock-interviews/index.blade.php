@extends('layouts.app')

@php($portal = 'student')

@section('title', 'Mock Interviews')

@section('content')

<style>
    :root {
        --mi-primary: #3376F2;
        --mi-primary-dark: #245ED1;
        --mi-purple: #7C4DFF;
        --mi-bg: #F6F8FC;
        --mi-card: #FFFFFF;
        --mi-text: #172033;
        --mi-muted: #6B7280;
        --mi-border: #E6EAF0;
        --mi-success: #16A34A;
        --mi-warning: #F59E0B;
        --mi-shadow: 0 8px 28px rgba(31, 41, 55, 0.07);
    }

    .mi-page {
        min-height: 100vh;
        background: var(--mi-bg);
        padding: 34px 0 60px;
    }

    .mi-container {
        width: min(1320px, calc(100% - 40px));
        margin: 0 auto;
    }

    /* =========================
       HERO (light, matches events/webinars page)
    ========================= */

    .mi-hero {
        background: #FFFFFF;
        border: 1px solid var(--mi-border);
        border-radius: 24px;
        padding: 44px 46px;
        position: relative;
        overflow: hidden;
        margin-bottom: 28px;
        box-shadow: var(--mi-shadow);
    }

    .hero-grid {
        position: relative;
        z-index: 2;
        display: grid;
        grid-template-columns: 1.15fr auto 1fr;
        gap: 30px;
        align-items: center;
    }

    .hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #EAF1FF;
        color: var(--mi-primary);
        border: 1px solid #D9E6FF;
        padding: 7px 15px;
        border-radius: 999px;
        font-size: 12.5px;
        font-weight: 700;
        margin-bottom: 18px;
    }

    .hero-title {
        font-size: 36px;
        line-height: 1.18;
        font-weight: 800;
        margin: 0 0 14px;
        letter-spacing: -0.6px;
        color: var(--mi-text);
    }

    .hero-title span {
        display: block;
        background: linear-gradient(90deg, var(--mi-primary), var(--mi-purple));
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
    }

    .hero-text {
        margin: 0 0 26px;
        font-size: 15px;
        line-height: 1.75;
        color: var(--mi-muted);
        max-width: 480px;
    }

    .hero-actions {
        display: flex;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
    }

    .hero-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
        font-size: 14px;
        font-weight: 700;
        padding: 13px 22px;
        border-radius: 12px;
        transition: 0.2s ease;
        border: 1px solid transparent;
        cursor: pointer;
    }

    .hero-btn-primary {
        background: var(--mi-primary);
        color: #fff;
        box-shadow: 0 10px 22px rgba(51,118,242,0.24);
    }

    .hero-btn-primary:hover {
        background: var(--mi-primary-dark);
        color: #fff;
        transform: translateY(-1px);
    }

    .hero-btn-outline {
        background: #fff;
        color: var(--mi-text);
        border-color: #DDE3EC;
    }

    .hero-btn-outline:hover {
        border-color: var(--mi-primary);
        color: var(--mi-primary);
    }

    /* -- illustration -- */

    .hero-visual {
        position: relative;
        width: 170px;
        height: 190px;
        flex-shrink: 0;
        margin: 0 auto;
    }

    .hero-visual-circle {
        position: absolute;
        top: 0;
        left: 10px;
        width: 150px;
        height: 150px;
        border-radius: 50%;
        background: linear-gradient(135deg, #EAF1FF, #F3EEFF);
    }

    .hero-visual-card {
        position: absolute;
        left: 34px;
        top: 46px;
        width: 108px;
        height: 130px;
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 14px 30px rgba(31,41,55,0.13);
        padding: 16px 14px;
    }

    .hero-visual-dot {
        width: 20px;
        height: 20px;
        border-radius: 50%;
        background: #DCE8FF;
        margin-bottom: 12px;
    }

    .hero-visual-line {
        height: 6px;
        border-radius: 4px;
        background: #EEF1F6;
        margin-bottom: 8px;
    }

    .hero-visual-line.w-80 { width: 80%; }
    .hero-visual-line.w-60 { width: 60%; }
    .hero-visual-line.w-40 { width: 40%; }

    .hero-visual-badge {
        position: absolute;
        right: -8px;
        bottom: 6px;
        width: 44px;
        height: 44px;
        border-radius: 50%;
        background: var(--mi-primary);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 17px;
        border: 4px solid #fff;
        box-shadow: 0 8px 16px rgba(51,118,242,0.30);
    }

    .hero-visual-check {
        position: absolute;
        top: -6px;
        right: 10px;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background: #E9FBF0;
        border: 1px solid #CFF5DC;
        color: var(--mi-success);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 15px;
    }

    .hero-features {
        display: flex;
        flex-direction: column;
        gap: 18px;
    }

    .hero-feature-item {
        display: flex;
        align-items: flex-start;
        gap: 12px;
    }

    .hero-feature-icon {
        width: 38px;
        height: 38px;
        border-radius: 11px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        flex-shrink: 0;
    }

    .hero-feature-icon.icon-blue { background: #EAF1FF; color: var(--mi-primary); }
    .hero-feature-icon.icon-purple { background: #F3EEFF; color: var(--mi-purple); }
    .hero-feature-icon.icon-green { background: #E9FBF0; color: var(--mi-success); }

    .hero-feature-title {
        font-size: 13.5px;
        font-weight: 700;
        color: var(--mi-text);
        margin-bottom: 2px;
    }

    .hero-feature-text {
        font-size: 12px;
        color: var(--mi-muted);
        line-height: 1.5;
    }

    /* =========================
       MAIN CARD
    ========================= */

    .mi-table-container {
        background: #fff;
        border: 1px solid var(--mi-border);
        border-radius: 20px;
        box-shadow: var(--mi-shadow);
        overflow: hidden;
    }

    .mi-table-header {
        padding: 22px;
        border-bottom: 1px solid var(--mi-border);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        flex-wrap: wrap;
    }

    .mi-table-heading {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .mi-table-heading-icon {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        background: #EEF4FF;
        color: var(--mi-primary);
        font-size: 15px;
        flex-shrink: 0;
    }

    .mi-table-title {
        color: var(--mi-text);
        font-size: 16px;
        font-weight: 700;
    }

    .mi-table-subtitle {
        color: var(--mi-muted);
        font-size: 12px;
        margin-top: 3px;
    }

    .mi-request-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
        background: var(--mi-primary);
        color: #fff;
        border: 0;
        padding: 11px 16px;
        border-radius: 11px;
        font-size: 13px;
        font-weight: 700;
        transition: 0.2s ease;
    }

    .mi-request-btn:hover {
        background: var(--mi-primary-dark);
        color: #fff;
        transform: translateY(-1px);
    }

    .mi-alert {
        margin: 18px 22px 0;
        padding: 12px 15px;
        border-radius: 11px;
        background: #ECFDF3;
        border: 1px solid #CFF5DC;
        color: #148548;
        font-size: 12.5px;
        font-weight: 600;
    }

    /* =========================
       TABLE
    ========================= */

    .table-scroll {
        width: 100%;
        overflow-x: auto;
    }

    .mi-table {
        width: 100%;
        min-width: 820px;
        border-collapse: collapse;
    }

    .mi-table th {
        padding: 13px 20px;
        background: #FAFBFE;
        border-bottom: 1px solid var(--mi-border);
        color: #8792A7;
        font-size: 10px;
        text-align: left;
        text-transform: uppercase;
        letter-spacing: .45px;
        font-weight: 800;
    }

    .mi-table td {
        padding: 16px 20px;
        border-bottom: 1px solid #F0F2F7;
        color: #4C586D;
        font-size: 12px;
        vertical-align: middle;
    }

    .mi-table tbody tr {
        transition: .18s ease;
    }

    .mi-table tbody tr:hover {
        background: #FBFCFF;
    }

    .mi-table tbody tr:last-child td {
        border-bottom: 0;
    }

    /* -- mentor cell -- */

    .mi-mentor-cell {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .mi-mentor-avatar {
        width: 34px;
        height: 34px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 9px;
        background: linear-gradient(135deg, #3376F2, #7C4DFF);
        color: #fff;
        font-size: 11px;
        font-weight: 800;
    }

    .mi-mentor-name {
        color: #354157;
        font-weight: 700;
        white-space: nowrap;
    }

    /* -- topic cell -- */

    .mi-topic-cell {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .mi-topic-icon {
        width: 34px;
        height: 34px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        background: linear-gradient(135deg, #EEF4FF, #F1ECFF);
        color: var(--mi-primary);
        font-size: 12px;
    }

    .mi-topic-name {
        max-width: 220px;
        color: var(--mi-text);
        font-weight: 700;
        line-height: 1.4;
    }

    /* -- schedule cell -- */

    .mi-schedule-cell {
        display: flex;
        align-items: center;
        gap: 8px;
        white-space: nowrap;
        color: #59667A;
    }

    .mi-schedule-cell i {
        color: var(--mi-purple);
        font-size: 11px;
    }

    /* -- status -- */

    .mi-status {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 10px;
        border-radius: 999px;
        font-size: 10px;
        font-weight: 700;
    }

    .mi-status-dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: currentColor;
    }

    .mi-status.pending {
        background: #FFF7E8;
        color: #B77908;
        border: 1px solid #FBE4B3;
    }

    .mi-status.scheduled {
        background: #EAF1FF;
        color: var(--mi-primary);
        border: 1px solid #D9E6FF;
    }

    .mi-status.completed {
        background: #ECFDF3;
        color: var(--mi-success);
        border: 1px solid #CFF5DC;
    }

    .mi-status.cancelled {
        background: #F4F5F7;
        color: #6B7280;
        border: 1px solid #E3E6EC;
    }

    /* -- action -- */

    .mi-view-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 9px 12px;
        border-radius: 9px;
        text-decoration: none;
        font-size: 11px;
        font-weight: 700;
        background: #EEF4FF;
        color: var(--mi-primary);
        border: 1px solid #DCE8FF;
        transition: .2s ease;
    }

    .mi-view-btn:hover {
        background: var(--mi-primary);
        color: #fff;
    }

    /* =========================
       EMPTY STATE
    ========================= */

    .mi-empty {
        padding: 65px 25px;
        text-align: center;
    }

    .mi-empty-icon {
        width: 70px;
        height: 70px;
        margin: 0 auto 17px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 20px;
        background: #EEF4FF;
        color: var(--mi-primary);
        font-size: 28px;
    }

    .mi-empty-title {
        color: var(--mi-text);
        font-size: 18px;
        font-weight: 700;
        margin-bottom: 7px;
    }

    .mi-empty-text {
        max-width: 420px;
        margin: 0 auto 18px;
        color: var(--mi-muted);
        font-size: 13px;
        line-height: 1.7;
    }

    /* =========================
       PAGINATION
    ========================= */

    .mi-pagination {
        padding: 4px 22px 22px;
    }

    .mi-pagination nav {
        display: flex;
        justify-content: center;
    }

    /* =========================
       RESPONSIVE
    ========================= */

    @media (max-width: 1100px) {

        .hero-grid {
            grid-template-columns: 1fr;
        }

        .hero-visual {
            margin: 8px 0 0;
        }
    }

    @media (max-width: 768px) {

        .mi-container {
            width: min(100% - 24px, 1320px);
        }

        .mi-page {
            padding: 20px 0 40px;
        }

        .mi-hero {
            padding: 28px 24px;
            border-radius: 19px;
        }

        .hero-title {
            font-size: 27px;
        }

        .hero-features {
            width: 100%;
        }

        .mi-table-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .mi-request-btn {
            width: 100%;
            justify-content: center;
        }
    }

    @media (max-width: 500px) {

        .hero-visual {
            display: none;
        }
    }
</style>


<div class="mi-page">

    <div class="mi-container">

        {{-- =====================================================
             HERO
        ====================================================== --}}
        <div class="mi-hero">

            <div class="hero-grid">

                {{-- LEFT: copy + actions --}}
                <div class="hero-left">

                    <div class="hero-badge">
                        <i class="fa-solid fa-user-tie"></i>
                        Student Mock Interviews
                    </div>

                    <h1 class="hero-title">
                        Practice &amp;
                        <span>Ace Your Interview</span>
                    </h1>

                    <p class="hero-text">
                        Request mock interviews with experienced mentors,
                        get real feedback on your answers, and walk into
                        your next real interview with confidence.
                    </p>

                    <div class="hero-actions">

                        <a href="{{ route('student.mock-interviews.create') }}" class="hero-btn hero-btn-primary">
                            <i class="fa-solid fa-user-tie"></i>
                            Request Mock Interview
                        </a>

                        <a href="#interviews" class="hero-btn hero-btn-outline">
                            <i class="fa-solid fa-list-check"></i>
                            View My Interviews
                        </a>

                    </div>

                </div>

                {{-- CENTER: illustration --}}
                <div class="hero-visual">
                    <div class="hero-visual-circle"></div>

                    <div class="hero-visual-card">
                        <div class="hero-visual-dot"></div>
                        <div class="hero-visual-line w-80"></div>
                        <div class="hero-visual-line w-60"></div>
                        <div class="hero-visual-line w-40"></div>
                    </div>

                    <div class="hero-visual-badge">
                        <i class="fa-solid fa-user-tie"></i>
                    </div>

                    <div class="hero-visual-check">
                        <i class="fa-solid fa-check"></i>
                    </div>
                </div>

                {{-- RIGHT: feature list --}}
                <div class="hero-features">

                    <div class="hero-feature-item">
                        <div class="hero-feature-icon icon-blue">
                            <i class="fa-solid fa-comments"></i>
                        </div>
                        <div>
                            <div class="hero-feature-title">Expert Feedback</div>
                            <div class="hero-feature-text">Get honest input from real mentors</div>
                        </div>
                    </div>

                    <div class="hero-feature-item">
                        <div class="hero-feature-icon icon-purple">
                            <i class="fa-solid fa-clipboard-question"></i>
                        </div>
                        <div>
                            <div class="hero-feature-title">Real Scenarios</div>
                            <div class="hero-feature-text">Practice questions used in real interviews</div>
                        </div>
                    </div>

                    <div class="hero-feature-item">
                        <div class="hero-feature-icon icon-green">
                            <i class="fa-solid fa-arrow-trend-up"></i>
                        </div>
                        <div>
                            <div class="hero-feature-title">Boost Confidence</div>
                            <div class="hero-feature-text">Walk in prepared and self-assured</div>
                        </div>
                    </div>

                </div>

            </div>

        </div>


        {{-- =====================================================
             INTERVIEWS TABLE
        ====================================================== --}}
        <div class="mi-table-container" id="interviews">

            <div class="mi-table-header">

                <div class="mi-table-heading">

                    <div class="mi-table-heading-icon">
                        <i class="fa-solid fa-user-tie"></i>
                    </div>

                    <div>

                        <div class="mi-table-title">
                            My Mock Interviews
                        </div>

                        <div class="mi-table-subtitle">
                            Track your requested and scheduled interviews
                        </div>

                    </div>

                </div>

                <a href="{{ route('student.mock-interviews.create') }}" class="mi-request-btn">
                    <i class="fa-solid fa-plus"></i>
                    Request Mock Interview
                </a>

            </div>


            @if (session('success'))
                <div class="mi-alert">
                    {{ session('success') }}
                </div>
            @endif


            @if ($interviews->count() > 0)

                <div class="table-scroll">

                    <table class="mi-table">

                        <thead>
                            <tr>
                                <th>Mentor</th>
                                <th>Topic</th>
                                <th>Requested / Scheduled</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($interviews as $interview)

                                <tr>

                                    {{-- MENTOR --}}
                                    <td>

                                        <div class="mi-mentor-cell">

                                            <div class="mi-mentor-avatar">
                                                {{ strtoupper(substr($interview->mentor->name ?? 'M', 0, 1)) }}
                                            </div>

                                            <div class="mi-mentor-name">
                                                {{ $interview->mentor->name }}
                                            </div>

                                        </div>

                                    </td>


                                    {{-- TOPIC --}}
                                    <td>

                                        <div class="mi-topic-cell">

                                            <div class="mi-topic-icon">
                                                <i class="fa-solid fa-clipboard-question"></i>
                                            </div>

                                            <div class="mi-topic-name">
                                                {{ $interview->topic }}
                                            </div>

                                        </div>

                                    </td>


                                    {{-- SCHEDULE --}}
                                    <td>

                                        <div class="mi-schedule-cell">

                                            <i class="fa-regular fa-calendar"></i>

                                            {{ $interview->scheduled_at?->format('d M Y, h:i A')
                                                ?? $interview->requested_at?->format('d M Y, h:i A') }}

                                        </div>

                                    </td>


                                    {{-- STATUS --}}
                                    <td>

                                        <span class="mi-status
                                            @class([
                                                'pending'   => $interview->status === 'pending',
                                                'scheduled' => $interview->status === 'scheduled',
                                                'completed' => $interview->status === 'completed',
                                                'cancelled' => $interview->status === 'cancelled',
                                            ])">
                                            <span class="mi-status-dot"></span>
                                            {{ ucfirst($interview->status) }}
                                        </span>

                                    </td>


                                    {{-- ACTION --}}
                                    <td>

                                        <a href="{{ route('student.mock-interviews.show', $interview) }}" class="mi-view-btn">
                                            <i class="fa-solid fa-arrow-right"></i>
                                            View
                                        </a>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>


                <div class="mi-pagination">
                    {{ $interviews->links() }}
                </div>

            @else

                <div class="mi-empty">

                    <div class="mi-empty-icon">
                        <i class="fa-solid fa-user-tie"></i>
                    </div>

                    <div class="mi-empty-title">
                        No Mock Interview Requests Yet
                    </div>

                    <p class="mi-empty-text">
                        Request a mock interview with a mentor to practice
                        your answers and get real feedback before your
                        next real interview.
                    </p>

                    <a href="{{ route('student.mock-interviews.create') }}" class="mi-request-btn">
                        <i class="fa-solid fa-plus"></i>
                        Request Mock Interview
                    </a>

                </div>

            @endif

        </div>

    </div>

</div>

@endsection