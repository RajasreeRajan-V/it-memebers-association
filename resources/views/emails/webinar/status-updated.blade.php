<!DOCTYPE html>
<html>
<body style="font-family: Arial, sans-serif; color:#1f2937; max-width:560px; margin:0 auto; padding:24px;">
    @if($webinar->status === 'approved')
        <h2 style="color:#15803d;">Your webinar was approved ✅</h2>
        <p>Hi {{ $webinar->mentor->name ?? 'there' }},</p>
        <p><strong>{{ $webinar->title }}</strong> has been approved. It will go live once it's published.</p>
    @elseif($webinar->status === 'rejected')
        <h2 style="color:#b91c1c;">Changes needed</h2>
        <p>Hi {{ $webinar->mentor->name ?? 'there' }},</p>
        <p><strong>{{ $webinar->title }}</strong> was not approved as submitted.</p>
        @if($webinar->admin_remarks)
            <div style="background:#fef2f2; border:1px solid #fecaca; border-radius:6px; padding:12px; margin:12px 0;">
                <strong>Admin remarks:</strong>
                <p style="margin:6px 0 0;">{{ $webinar->admin_remarks }}</p>
            </div>
        @endif
        <p>Please edit and resubmit for review.</p>
    @elseif($webinar->status === 'published')
        <h2 style="color:#1d4ed8;">Your webinar is now live 🎉</h2>
        <p>Hi {{ $webinar->mentor->name ?? 'there' }},</p>
        <p><strong>{{ $webinar->title }}</strong> is now visible to students and open for registration.</p>
    @endif

    <p>
        <a href="{{ route('mentor.webinars.index') }}" style="background:#1d4ed8; color:#fff; padding:10px 16px; border-radius:6px; text-decoration:none;">
            View my webinars
        </a>
    </p>
</body>
</html>
