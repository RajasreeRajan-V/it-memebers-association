<p>Hello {{ $application->project->employer->name ?? 'there' }},</p>

<p>
    {{ $application->employee->name ?? 'The freelancer' }} has returned the signed contract for
    <strong>{{ $application->project->title }}</strong>.
    The signed copy is attached.
</p>

<p>Signed on: {{ $application->contract_signed_at->format('d M Y, h:i A') }}</p>