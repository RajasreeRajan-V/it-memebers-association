<p>Hello {{ $bid->employer->name ?? 'there' }},</p>

<p>
    <strong>{{ $bid->freelancer->user->name ?? 'The freelancer' }}</strong> has uploaded the signed contract for
    <strong>{{ $bid->project->title ?? 'your project' }}</strong> (Bid #{{ $bid->id }}).
</p>

<p>The signed document is attached to this email. You can also view it from your bids dashboard.</p>

<p>Thank you.</p>