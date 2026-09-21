<x-mail::message>
# Startup Profile Needs Changes

Hi {{ $startup->founder_name }},

Your startup profile for **{{ $startup->startup_name }}** was not approved this time.

**Reason:** {{ $startup->rejection_reason }}

Please make the necessary edits and resubmit your profile for review.

<x-mail::button :url="url('/')">
Edit Profile
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
