<!DOCTYPE html>
<html>
<body style="font-family: Arial, sans-serif; color:#1f2937; max-width:560px; margin:0 auto; padding:24px;">
    <h2 style="color:#1d4ed8;">New registration</h2>
    <p>Hi {{ $webinar->mentor->name ?? 'there' }},</p>
    <p>
        <strong>{{ $student->name }}</strong> ({{ $student->email }}) just
        {{ $registration->status === 'pending' ? 'joined the waitlist for' : 'registered for' }}
        <strong>{{ $webinar->title }}</strong>.
    </p>

    <table style="width:100%; border-collapse:collapse; margin:16px 0;">
        <tr>
            <td style="padding:6px 0; color:#6b7280;">Date</td>
            <td style="padding:6px 0;">{{ \Illuminate\Support\Carbon::parse($webinar->scheduled_date)->format('d M Y') }}</td>
        </tr>
        <tr>
            <td style="padding:6px 0; color:#6b7280;">Registrations so far</td>
            <td style="padding:6px 0;">
                {{ $webinar->registrations()->where('status', 'approved')->count() }}{{ $webinar->capacity ? '/' . $webinar->capacity : '' }}
            </td>
        </tr>
    </table>

    <p style="color:#6b7280; font-size:13px;">
        You can view and export your full registration list from your mentor dashboard.
    </p>
</body>
</html>
