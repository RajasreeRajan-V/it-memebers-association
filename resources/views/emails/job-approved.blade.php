<x-mail::message>
# Job Posting Approved

Hello {{ $job->employer->name ?? '' }},

We're pleased to inform you that your job posting has been reviewed and approved by our team. It is now live and visible to candidates on our platform.

<x-mail::panel>
**{{ $job->title }}**
{{ ucfirst($job->employment_type) }} &middot; {{ ucfirst($job->work_mode) }}
{{ collect([$job->city, $job->district, $job->state])->filter()->implode(', ') }}
</x-mail::panel>

Your listing is now searchable and open to applications. You can review incoming applicants, update the posting, or publish additional openings at any time from your employer dashboard.

<x-mail::button :url="route('employer.jobs.show', $job)" color="success">
View Job Posting
</x-mail::button>

Thank you for choosing {{ config('app.name') }} to help build your team.

Best regards,<br>
**The {{ config('app.name') }} Team**

<x-mail::subcopy>
If you're having trouble clicking the "View Job Posting" button, copy and paste the URL below into your web browser:
[{{ route('employer.jobs.show', $job) }}]({{ route('employer.jobs.show', $job) }})
</x-mail::subcopy>
</x-mail::message>