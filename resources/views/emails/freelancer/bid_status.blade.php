@component('mail::message')
# Hi {{ $bid->freelancer->user->name ?? 'there' }},

@if ($bid->status === \App\Models\FreelancerBid::STATUS_ACCEPTED)
Great news — your bid on **"{{ $bid->project->title }}"** has been **accepted**.
@else
Thanks for your bid on **"{{ $bid->project->title }}"**. Unfortunately, it was **not selected** this time.
@endif

**Bid Amount:** ₹{{ $bid->bid_amount }}
**Reviewed by:** {{ $approverName }}

@if ($comments)
**Notes from the reviewer:**
{{ $comments }}
@endif

{{-- @component('mail::button', ['url' => url('/freelancer/bids/' . $bid->id)])
View Bid Details
@endcomponent --}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent