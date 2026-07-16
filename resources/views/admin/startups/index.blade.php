@extends('admin.layout.app')

@section('title', 'Job Approvals')

@section('content')
<div class="container-fluid" style="padding: 24px;">

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <h2 style="margin-bottom: 18px;">Startup Approvals</h2>

    <table class="table" style="width:100%; border-collapse: collapse;">
        <thead>
            <tr>
                <th>Startup</th>
                <th>Founder</th>
                <th>Employer</th>
                <th>Status</th>
                <th style="text-align:right;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($startups as $startup)
            <tr>
                <td>{{ $startup->startup_name }}</td>
                <td>{{ $startup->founder_name }}</td>
                <td>{{ $startup->employer->name ?? '—' }}</td>
                <td><span class="badge">{{ ucfirst($startup->status) }}</span></td>
                <td style="text-align:right;">
                    @if ($startup->status === 'pending')
                        <form action="{{ route('admin.startups.approve', $startup) }}" method="POST" style="display:inline-block;">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-success">Approve</button>
                        </form>

                        <button type="button" class="btn btn-sm btn-danger"
                            onclick="document.getElementById('rejectModal{{ $startup->id }}').style.display='flex'">
                            Reject
                        </button>

                        <div id="rejectModal{{ $startup->id }}" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,.4); align-items:center; justify-content:center; z-index:999;">
                            <div style="background:#fff; padding:20px; border-radius:10px; width:360px;">
                                <h4>Reject {{ $startup->startup_name }}</h4>
                                <form action="{{ route('admin.startups.reject', $startup) }}" method="POST">
                                    @csrf
                                    <textarea name="rejection_reason" placeholder="Reason for rejection" required style="width:100%; min-height:80px; margin:10px 0;"></textarea>
                                    <div style="display:flex; gap:8px; justify-content:flex-end;">
                                        <button type="button" onclick="document.getElementById('rejectModal{{ $startup->id }}').style.display='none'" class="btn btn-sm">Cancel</button>
                                        <button type="submit" class="btn btn-sm btn-danger">Confirm Reject</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @else
                        <span style="color:#9ca3af; font-size: .85rem;">No actions</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr><td colspan="5" style="text-align:center; padding: 30px;">No startup submissions yet.</td></tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top: 18px;">
        {{ $startups->links() }}
    </div>
</div>
@endsection