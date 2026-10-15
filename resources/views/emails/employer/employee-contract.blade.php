<!DOCTYPE html>
<html>
<body style="font-family: Arial, sans-serif; color:#172033; line-height:1.6;">
    <h2>Hello {{ $employee->user?->name ?? 'there' }},</h2>

    <p>
        Congratulations again on being accepted for
        <strong>{{ $project->title }}</strong>.
    </p>

    <p>
        Please find the contract attached to this email. Review it carefully,
        sign it, and send it back to us.
    </p>

    @if ($note)
        <p><strong>Message from the employer:</strong><br>{{ $note }}</p>
    @endif

    <p>Regards,<br>{{ config('app.name') }}</p>
</body>
</html>