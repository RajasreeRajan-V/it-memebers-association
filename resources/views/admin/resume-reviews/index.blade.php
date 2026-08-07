@extends('admin.layout.app')
@section('content')
<div class="content-header">
    <h2>Resume Review Management</h2>
    <p>Assign uploaded resumes to mentors and track review completion.</p>
</div>

<div class="card" style="padding:1.25rem;">
    <table class="table" style="width:100%;">
        <thead>
            <tr><th>Student</th><th>Mentor</th><th>Status</th><th>ATS Score</th><th>Assign</th></tr>
        </thead>
        <tbody>
            @forelse($reviews as $review)
                <tr>
                    <td>{{ $review->student->name ?? '-' }}</td>
                    <td>{{ $review->mentor->name ?? 'Unassigned' }}</td>
                    <td>{{ ucfirst(str_replace('_',' ',$review->status)) }}</td>
                    <td>{{ $review->ats_score ?? '-' }}</td>
                    <td>
                        <form method="POST" action="{{ route('admin.resume-reviews.assign', $review) }}" style="display:flex;gap:0.5rem;">
                            @csrf
                            <select name="mentor_id" required>
                                <option value="">Select mentor</option>
                                @foreach($mentors as $mentor)
                                    <option value="{{ $mentor->id }}" @selected($review->mentor_id == $mentor->id)>{{ $mentor->name }}</option>
                                @endforeach
                            </select>
                            <button type="submit">Assign</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5">No resumes submitted yet.</td></tr>
            @endforelse
        </tbody>
    </table>
    {{ $reviews->links() }}
</div>
@endsection
