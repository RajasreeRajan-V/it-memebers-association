<!DOCTYPE html>
<html>
<body style="font-family: Arial, sans-serif; color:#1f2937; max-width:560px; margin:0 auto; padding:24px;">
    <h2 style="color:#1d4ed8;">New webinar awaiting approval</h2>
    <p><strong>{{ $webinar->mentor->name ?? 'A mentor' }}</strong> submitted a new {{ $webinar->type }} for review.</p>

    <table style="width:100%; border-collapse:collapse; margin:16px 0;">
        <tr><td style="padding:6px 0; color:#6b7280;">Title</td><td style="padding:6px 0;">{{ $webinar->title }}</td></tr>
        <tr><td style="padding:6px 0; color:#6b7280;">Category</td><td style="padding:6px 0;">{{ $webinar->category }}</td></tr>
        <tr><td style="padding:6px 0; color:#6b7280;">Date</td><td style="padding:6px 0;">{{ \Illuminate\Support\Carbon::parse($webinar->scheduled_date)->format('d M Y') }}</td></tr>
        <tr><td style="padding:6px 0; color:#6b7280;">Capacity</td><td style="padding:6px 0;">{{ $webinar->capacity ?? '—' }}</td></tr>
    </table>

    <p>
        <a href="{{ route('admin.webinars.index') }}" style="background:#1d4ed8; color:#fff; padding:10px 16px; border-radius:6px; text-decoration:none;">
            Review submission
        </a>
    </p>
</body>
</html>
