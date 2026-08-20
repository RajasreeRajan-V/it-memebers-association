<!DOCTYPE html>
<html>
<body style="font-family: Arial, sans-serif; color:#1f2937; max-width:560px; margin:0 auto; padding:24px;">
    @php
        $scheduledTime = $webinar->scheduled_time
            ? \Illuminate\Support\Carbon::parse($webinar->scheduled_time)->format('h:i A')
            : null;
    @endphp

    @if($type === '30min')
        <h2 style="color:#b45309;">Your webinar starts in 30 minutes! ⏰</h2>
    @else
        <h2 style="color:#1d4ed8;">Reminder: Your webinar is tomorrow 🎓</h2>
    @endif

    <p>Hi {{ $student->name }},</p>
    <p>Just a heads-up — <strong>{{ $webinar->title }}</strong> is coming up.</p>

    <table style="width:100%; border-collapse:collapse; margin:16px 0;">
        <tr>
            <td style="padding:6px 0; color:#6b7280;">Date</td>
            <td style="padding:6px 0;">{{ \Illuminate\Support\Carbon::parse($webinar->scheduled_date)->format('d M Y') }}</td>
        </tr>
        @if($scheduledTime)
        <tr>
            <td style="padding:6px 0; color:#6b7280;">Time</td>
            <td style="padding:6px 0;">{{ $scheduledTime }}</td>
        </tr>
        @endif
        <tr>
            <td style="padding:6px 0; color:#6b7280;">Platform</td>
            <td style="padding:6px 0;">{{ $webinar->platform ?? '—' }}</td>
        </tr>
        @if($webinar->meeting_link)
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

    <p style="color:#6b7280; font-size:13px;">See you there!</p>
</body>
</html>