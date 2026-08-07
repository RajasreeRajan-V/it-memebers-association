@extends('admin.layout.app')
@section('content')
<div class="content-header">
    <h2>Training Material Management</h2>
    <p>Review and publish materials uploaded by mentors.</p>
</div>

<div class="card" style="padding:1.25rem;">
    <table class="table" style="width:100%;">
        <thead>
            <tr><th>Title</th><th>Mentor</th><th>Category</th><th>Type</th><th>Status</th><th>Actions</th></tr>
        </thead>
        <tbody>
            @forelse($materials as $material)
                <tr>
                    <td>{{ $material->title }}</td>
                    <td>{{ $material->mentor->name ?? '-' }}</td>
                    <td>{{ $material->category }}</td>
                    <td>{{ strtoupper($material->type) }}</td>
                    <td>{{ ucfirst($material->status) }}</td>
                    <td>
                        <a href="{{ asset('storage/' . $material->file_path) }}" target="_blank">View</a>
                        @if($material->status === 'pending')
                            <form method="POST" action="{{ route('admin.training-materials.approve', $material) }}" style="display:inline">
                                @csrf<button type="submit">Approve</button>
                            </form>
                            <form method="POST" action="{{ route('admin.training-materials.reject', $material) }}" style="display:inline">
                                @csrf
                                <input type="text" name="admin_remarks" placeholder="Reason" required>
                                <button type="submit">Reject</button>
                            </form>
                        @elseif($material->status === 'approved')
                            <form method="POST" action="{{ route('admin.training-materials.publish', $material) }}" style="display:inline">
                                @csrf<button type="submit">Publish</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr><td colspan="6">No materials uploaded yet.</td></tr>
            @endforelse
        </tbody>
    </table>
    {{ $materials->links() }}
</div>
@endsection
