<p>Hello,</p>

@if ($recipientType === 'employer')
    <p>
        The contract for <strong>{{ $application->project->title }}</strong> was cancelled because the
        freelancer did not return a signed copy within {{ \App\Models\EmployeeFreelanceJob::CONTRACT_VALIDITY_DAYS }} days
        of it being sent ({{ $application->contract_sent_at->format('d M Y') }}).
    </p>
@else
    <p>
        Your contract for <strong>{{ $application->project->title }}</strong> was cancelled because a signed copy
        was not returned within {{ \App\Models\EmployeeFreelanceJob::CONTRACT_VALIDITY_DAYS }} days
        of it being sent ({{ $application->contract_sent_at->format('d M Y') }}).
    </p>
@endif

<p>Reason: {{ $application->contract_cancel_reason }}</p>