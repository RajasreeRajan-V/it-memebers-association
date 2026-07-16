{{-- Row actions inside your admin jobs listing table --}}
<td class="text-right actions-cell">
    <form action="{{ route('admin.jobs.approve', $job) }}" method="POST" style="display:inline">
        @csrf
        @method('PATCH')
        <button type="submit" class="btn btn-sm btn-success">Approve</button>
    </form>

    <button type="button" class="btn btn-sm btn-danger"
            onclick="document.getElementById('rejectModal{{ $job->id }}').classList.add('is-open')">
        Reject
    </button>

    {{-- Simple reject reason modal --}}
    <div id="rejectModal{{ $job->id }}" class="reject-modal">
        <div class="reject-modal-box">
            <h3>Reject "{{ $job->title }}"</h3>
            <form action="{{ route('admin.jobs.reject', $job) }}" method="POST">
                @csrf
                @method('PATCH')
                <textarea name="rejection_reason" rows="4" required
                    placeholder="Explain why this job is being rejected..."></textarea>
                @error('rejection_reason')
                    <p class="error-text">{{ $message }}</p>
                @enderror
                <div class="reject-modal-actions">
                    <button type="button" onclick="document.getElementById('rejectModal{{ $job->id }}').classList.remove('is-open')">Cancel</button>
                    <button type="submit" class="btn btn-danger">Send Rejection</button>
                </div>
            </form>
        </div>
    </div>
</td>

<style>
.reject-modal { display:none; position:fixed; inset:0; background:rgba(0,0,0,0.4); z-index:1000; align-items:center; justify-content:center; }
.reject-modal.is-open { display:flex; }
.reject-modal-box { background:#fff; padding:24px; border-radius:12px; width:420px; max-width:90%; }
.reject-modal-box textarea { width:100%; margin-top:12px; padding:10px; border:1px solid #e5e7eb; border-radius:8px; }
.reject-modal-actions { display:flex; justify-content:flex-end; gap:10px; margin-top:14px; }
.error-text { color:#dc2626; font-size:0.8rem; margin-top:4px; }
</style>