<x-mail::message>


Hello {{ $job->employer->name ?? '' }},

Thank you for submitting your job posting to {{ config('app.name') }}. After careful review, our team was unable to approve this listing in its current form.

<x-mail::panel>
**{{ $job->title }}**
{{ ucfirst($job->employment_type) }} &middot; {{ ucfirst($job->work_mode) }}
</x-mail::panel>

@if ($job->rejection_reason)
**Reason for this decision:**

{{ $job->rejection_reason }}
@else
No specific reason was provided by our review team. Please contact support if you'd like further clarification.
@endif

We encourage you to revise your posting based on the feedback above and resubmit it for another review. Most listings are re-approved quickly once updated.

<x-mail::button :url="route('employer.jobs.edit', $job)" color="error">
Edit & Resubmit Posting
</x-mail::button>

If you have any questions about this decision, please don't hesitate to reach out to our support team.

Best regards,<br>
**The {{ config('app.name') }} Team**

<x-mail::subcopy>
If you're having trouble clicking the "Edit & Resubmit Posting" button, copy and paste the URL below into your web browser:
[{{ route('employer.jobs.edit', $job) }}]({{ route('employer.jobs.edit', $job) }})
</x-mail::subcopy>
</x-mail::message>