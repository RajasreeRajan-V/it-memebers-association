<!DOCTYPE html>
<html>
<body style="font-family: Arial, sans-serif; color:#1f2937; max-width:560px; margin:0 auto; padding:24px;">
    @if($registration->status === 'pending')
        <h2 style="color:#b45309;">You're on the waitlist</h2>
        <p>Hi {{ $student->name }},</p>
        <p>
            "{{ $webinar->title }}" is currently full, so you've been added to the waitlist.
            We'll email you if a seat opens up.
        </p>
    @else
        <h2 style="color:#1d4ed8;">Registration confirmed 🎉</h2>
        <p>Hi {{ $student->name }},</p>
        <p>You're confirmed for <strong>{{ $webinar->title }}</strong>.</p>
    @endif

    <table style="width:100%; border-collapse:collapse; margin:16px 0;">
        <tr>
            <td style="padding:6px 0; color:#6b7280;">Type</td>
            <td style="padding:6px 0;">{{ ucfirst($webinar->type) }}</td>
        </tr>
        <tr>
            <td style="padding:6px 0; color:#6b7280;">Date</td>
            <td style="padding:6px 0;">{{ \Illuminate\Support\Carbon::parse($webinar->scheduled_date)->format('d M Y') }}</td>
        </tr>
        <tr>
            <td style="padding:6px 0; color:#6b7280;">Time</td>
            <td style="padding:6px 0;">{{ \Illuminate\Support\Carbon::parse($webinar->scheduled_time)->format('h:i A') }}</td>
        </tr>
        <tr>
            <td style="padding:6px 0; color:#6b7280;">Platform</td>
            <td style="padding:6px 0;">{{ $webinar->platform ?? '—' }}</td>
        </tr>
       @if($webinar->meeting_link && $registration->status === 'approved')
    <tr>
        <td style="padding:6px 0; color:#6b7280; vertical-align:top;">Meeting link</td>
        <td style="padding:12px 0;">
            <a href="{{ $webinar->meeting_link }}"
               style="display:inline-block; background-color:#1a73e8; color:#ffffff; text-decoration:none; font-weight:bold; font-size:14px; padding:10px 20px; border-radius:6px; font-family:Arial, sans-serif;">
                🎥 Join Google Meet
            </a>
        </td>
    </tr>
@endif
    </table>

    <p style="color:#6b7280; font-size:13px;">
        We'll send a reminder before the session starts. See you there!
    </p>
</body>
</html>
