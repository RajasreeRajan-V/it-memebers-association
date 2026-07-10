{{-- resources/views/employer/internships/index.blade.php --}}
@extends('employers.layout.app')

@section('title', 'My Internships')
@section('page-title', 'Internship Postings')
@section('page-subtitle', 'Manage your posted internships')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-title"><i class="fas fa-user-graduate"></i> My Internship Postings</div>
            <a href="{{ route('employer.internships.create') }}" class="quick-link-btn">
                <i class="fas fa-plus"></i> Post New Internship
            </a>
        </div>
        <div class="card-body no-pad">
            @if($internships->isEmpty())
                <div class="empty-state">
                    <i class="fas fa-user-graduate"></i>
                    <p>You haven't posted any internships yet.</p>
                    <a href="{{ route('employer.internships.create') }}" class="quick-link-btn">Post your first internship</a>
                </div>
            @else
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Type</th>
                            <th>Location</th>
                            <th>Duration</th>
                            <th>Stipend</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($internships as $internship)
                            <tr>
                                <td class="cell-title">{{ $internship->title }}</td>
                                <td>{{ ucfirst(str_replace('-', ' ', $internship->internship_type)) }}</td>
                                <td>{{ collect([$internship->city, $internship->state, $internship->country])->filter()->implode(', ') ?: '—' }}</td>
                                <td>{{ $internship->duration }}</td>
                                <td>{{ $internship->stipend ?: 'Unpaid' }}</td>
                                <td><span class="status-badge status-{{ $internship->status }}">{{ ucfirst($internship->status) }}</span></td>
                                <td class="cell-actions">
                                    <a href="{{ route('employer.internships.edit', $internship) }}" title="Edit"><i class="fas fa-pen"></i></a>
                                    <form action="{{ route('employer.internships.destroy', $internship) }}" method="POST" onsubmit="return confirm('Delete this internship posting?');" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" title="Delete"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @if($internship->status === 'rejected' && $internship->rejection_reason)
                                <tr class="reason-row">
                                    <td colspan="7"><i class="fas fa-circle-info"></i> Rejection reason: {{ $internship->rejection_reason }}</td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
                <div class="pagination-wrap">{{ $internships->links() }}</div>
            @endif
        </div>
    </div>
@endsection

@push('styles')
    @include('employers.partials.list-styles')
@endpush
