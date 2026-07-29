<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: 'Helvetica Neue', Arial, sans-serif; background: #f4f5f7; margin: 0; padding: 0; }
        .container { max-width: 560px; margin: 0 auto; padding: 32px 24px; }
        .card { background: #ffffff; border-radius: 16px; padding: 32px; }
        .badge { display: inline-block; font-size: 12px; font-weight: 600; padding: 6px 14px; border-radius: 999px; margin-bottom: 16px; }
        .badge-success { background: #ecfdf5; color: #059669; }
        .badge-info { background: #eff6ff; color: #2563eb; }
        .badge-warn { background: #fffbeb; color: #d97706; }
        .badge-danger { background: #fef2f2; color: #dc2626; }
        .badge-muted { background: #f3f4f6; color: #6b7280; }
        h1 { font-size: 20px; color: #111827; margin: 0 0 12px; }
        p { font-size: 14px; color: #4b5563; line-height: 1.6; }
        .detail-box { background: #f9fafb; border-radius: 10px; padding: 16px; margin: 20px 0; }
        .detail-box p { margin: 4px 0; font-size: 13px; }
        .footer { text-align: center; font-size: 12px; color: #9ca3af; margin-top: 24px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            @php
                $badgeClass = match($event) {
                    'shortlisted' => 'badge-warn',
                    'interview_scheduled', 'interview_rescheduled' => 'badge-info',
                    'hired' => 'badge-success',
                    'rejected' => 'badge-danger',
                    default => 'badge-muted',
                };
            @endphp

            <span class="badge {{ $badgeClass }}">
                @switch($event)
                    @case('shortlisted') Shortlisted @break
                    @case('interview_scheduled') Interview Scheduled @break
                    @case('interview_rescheduled') Interview Rescheduled @break
                    @case('interview_cancelled') Interview Cancelled @break
                    @case('hired') Hired @break
                    @case('rejected') Not Selected @break
                    @case('archived') Archived @break
                    @default Update @break
                @endswitch
            </span>

            <h1>Hi {{ $candidate->name ?? 'there' }},</h1>

            @switch($event)
                @case('shortlisted')
                    <p>Good news — your application for <strong>{{ $job->title }}</strong> at {{ $employer->company_name ?? $employer->name }} has been shortlisted. The employer will be in touch soon with next steps.</p>
                    @break

                @case('interview_scheduled')
                    <p>Your interview for <strong>{{ $job->title }}</strong> at {{ $employer->company_name ?? $employer->name }} has been scheduled.</p>
                    <div class="detail-box">
                        <p><strong>Date & Time:</strong> {{ $interview->scheduled_at->format('l, F j, Y g:i A') }}</p>
                        <p><strong>Mode:</strong> {{ ucfirst(str_replace('_', ' ', $interview->mode)) }}</p>
                        @if ($interview->location)
                            <p><strong>Location / Link:</strong> {{ $interview->location }}</p>
                        @endif
                    </div>
                    <p>Please make sure to be available a few minutes early. Good luck!</p>
                    @break

                @case('interview_rescheduled')
                    <p>Your interview for <strong>{{ $job->title }}</strong> at {{ $employer->company_name ?? $employer->name }} has been rescheduled to a new time.</p>
                    <div class="detail-box">
                        <p><strong>New Date & Time:</strong> {{ $interview->scheduled_at->format('l, F j, Y g:i A') }}</p>
                        <p><strong>Mode:</strong> {{ ucfirst(str_replace('_', ' ', $interview->mode)) }}</p>
                        @if ($interview->location)
                            <p><strong>Location / Link:</strong> {{ $interview->location }}</p>
                        @endif
                    </div>
                    @break

                @case('interview_cancelled')
                    <p>Your scheduled interview for <strong>{{ $job->title }}</strong> at {{ $employer->company_name ?? $employer->name }} has been cancelled by the employer. They may reach out to reschedule.</p>
                    @break

            @case('hired')
    <p>We are pleased to inform you that you have been selected for the position of <strong>{{ $job->title }}</strong> at {{ $employer->company_name ?? $employer->name }}.</p>
    <p>Congratulations on this achievement. A member of the hiring team will reach out to you shortly with further details regarding onboarding and next steps.</p>
    @break

@case('rejected')
    <p>Thank you for applying for the <strong>{{ $job->title }}</strong> position at {{ $employer->company_name ?? $employer->name }}.</p>
    <p>After reviewing your application, the employer has decided not to move forward with your candidacy for this role.</p>
    <p>We encourage you to apply for other opportunities that match your profile.</p>
    @break

                @default
                    <p>There has been an update to your application for <strong>{{ $job->title }}</strong> at {{ $employer->company_name ?? $employer->name }}.</p>
            @endswitch

            <p style="margin-top: 24px;">— The {{ config('app.name') }} Team</p>
        </div>
        <div class="footer">
            You're receiving this email because you applied to a job on {{ config('app.name') }}.
        </div>
    </div>
</body>
</html>