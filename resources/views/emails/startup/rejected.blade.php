<!DOCTYPE html>
<html>
<body style="font-family: Arial, sans-serif; color: #0f172a; padding: 24px;">
    <h2 style="color: #b91c1c;">Your Account Has Been Rejected</h2>
    <p>Hi {{ $startup->founder_name }},</p>
    <p>Your submission for <strong>{{ $startup->startup_name }}</strong> was Rejected at this time.</p>
    @if($startup->rejection_reason)
        <p><strong>Reason:</strong> {{ $startup->rejection_reason }}</p>
    @endif
    <p>You're welcome to update your profile and resubmit it for review.</p>
</body>
</html>