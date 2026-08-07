@extends('layouts.app')

@section('content')
<div class="mentor-card">
    <table class="mentor-table">
        <thead>
            <tr><th>Student</th><th>Status</th><th>ATS Score</th><th></th></tr>
        </thead>
        <tbody>
            @forelse($reviews as $review)
                <tr>
                    <td>{{ $review->student->name ?? '-' }}</td>
                    <td><span class="badge-status badge-{{ $review->status }}">{{ ucfirst(str_replace('_',' ',$review->status)) }}</span></td>
                    <td>{{ $review->ats_score ?? '-' }}</td>
                    <td><a class="btn btn-outline" href="{{ route('mentor.resume-reviews.show', $review) }}">Open Resume</a></td>
                </tr>
            @empty
                <tr><td colspan="4">No resumes assigned yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
{{ $reviews->links() }}
@endsection
