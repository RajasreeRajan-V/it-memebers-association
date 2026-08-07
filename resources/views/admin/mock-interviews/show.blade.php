@extends('admin.layout.app')
@section('content')
<div class="content-header">
    <h2>Mock Interview — {{ $interview->student->name }}</h2>
</div>
<div class="card" style="padding:1.25rem;">
    <p>Mentor: {{ $interview->mentor->name }}</p>
    <p>Status: {{ ucfirst($interview->status) }}</p>
    <p>Scheduled: {{ $interview->scheduled_at ? $interview->scheduled_at->format('d M Y, h:i A') : '-' }}</p>
    @if($interview->status === 'conducted')
        <hr>
        <h4>Evaluation</h4>
        <p>Technical: {{ $interview->technical_rating }}/10</p>
        <p>Communication: {{ $interview->communication_rating }}/10</p>
        <p>Confidence: {{ $interview->confidence_rating }}/10</p>
        <p>Overall: {{ $interview->overall_rating }}/10</p>
        <p>Feedback: {{ $interview->feedback }}</p>
    @endif
</div>
@endsection
