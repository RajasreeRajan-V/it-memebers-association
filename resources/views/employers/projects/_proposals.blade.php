{{--
    Include this inside your existing employer project "show" view, e.g.:

        @include('employers.projects._proposals', ['project' => $project])

    Make sure the controller that renders that page eager-loads applications:

        $project->load(['applications.applicant']);
--}}

@if ($project->applications->isNotEmpty())
<div class="proposals-card">
    <h3 class="proposals-title">
        Proposals <span class="proposals-count">({{ $project->applications->count() }})</span>
    </h3>

    <div class="proposals-list">
        @foreach ($project->applications as $proposal)
        <div class="proposal-item" data-proposal-id="{{ $proposal->id }}">
            <div class="proposal-header">
                <div>
                    <p class="proposal-name">{{ $proposal->applicant->name ?? 'Applicant' }}</p>
                    <p class="proposal-meta">
                        Rate: {{ $proposal->proposed_rate }} &middot; Timeline: {{ $proposal->estimated_timeline }}
                    </p>
                </div>
                <span class="proposal-status-badge status-{{ $proposal->status }}">
                    {{ ucfirst($proposal->status) }}
                </span>
            </div>

            <p class="proposal-note">{{ $proposal->cover_note }}</p>

            @if (in_array($proposal->status, ['pending', 'shortlisted']))
            <div class="proposal-actions">
                <button type="button" class="proposal-action-btn btn-accept"
                    data-proposal-id="{{ $proposal->id }}" data-status="accepted">Accept</button>
                <button type="button" class="proposal-action-btn btn-shortlist"
                    data-proposal-id="{{ $proposal->id }}" data-status="shortlisted">Shortlist</button>
                <button type="button" class="proposal-action-btn btn-reject"
                    data-proposal-id="{{ $proposal->id }}" data-status="rejected">Reject</button>
            </div>
            @endif
        </div>
        @endforeach
    </div>
</div>

<style>
    .proposals-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 14px; padding: 28px; margin-top: 24px; }
    .proposals-title { font-size: 1rem; font-weight: 600; color: #111827; margin: 0 0 16px; }
    .proposals-count { font-weight: 400; color: #9ca3af; font-size: 0.85rem; }
    .proposals-list { display: flex; flex-direction: column; gap: 14px; }
    .proposal-item { border: 1px solid #e5e7eb; border-radius: 10px; padding: 16px; }
    .proposal-header { display: flex; align-items: flex-start; justify-content: space-between; gap: 12px; flex-wrap: wrap; }
    .proposal-name { font-size: 0.9rem; font-weight: 600; color: #111827; margin: 0; }
    .proposal-meta { font-size: 0.78rem; color: #6b7280; margin: 2px 0 0; }
    .proposal-note { font-size: 0.85rem; line-height: 1.55; color: #374151; margin: 12px 0 0; white-space: pre-line; }
    .proposal-status-badge { font-size: 0.72rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.03em; padding: 4px 10px; border-radius: 999px; white-space: nowrap; }
    .status-pending { background: #fef3c7; color: #92400e; }
    .status-shortlisted { background: #e0e7ff; color: #4338ca; }
    .status-accepted { background: #dcfce7; color: #166534; }
    .status-rejected { background: #fee2e2; color: #b91c1c; }
    .proposal-actions { display: flex; gap: 8px; margin-top: 14px; }
    .proposal-action-btn { font-size: 0.8rem; font-weight: 500; padding: 7px 14px; border-radius: 8px; border: none; cursor: pointer; }
    .btn-accept { background: #4f46e5; color: #fff; }
    .btn-accept:hover { background: #4338ca; }
    .btn-shortlist { background: #f3f4f6; color: #4b5563; }
    .btn-shortlist:hover { background: #e5e7eb; }
    .btn-reject { background: #fef2f2; color: #dc2626; border: 1px solid #fecaca; }
    .btn-reject:hover { background: #fee2e2; }
    .proposals-empty { background: #fff; border: 1px solid #e5e7eb; border-radius: 14px; padding: 28px; margin-top: 24px; text-align: center; font-size: 0.85rem; color: #9ca3af; }
</style>

<script>
document.addEventListener('click', function (e) {
    var btn = e.target.closest('.proposal-action-btn');
    if (!btn) return;

    var proposalId = btn.dataset.proposalId;
    var status = btn.dataset.status;
    var card = document.querySelector('[data-proposal-id="' + proposalId + '"]');
    var badge = card.querySelector('.proposal-status-badge');
    var csrfMeta = document.querySelector('meta[name="csrf-token"]');
    var csrfToken = csrfMeta ? csrfMeta.content : '{{ csrf_token() }}';

    fetch('/employer/proposals/' + proposalId + '/status', {
        method: 'PATCH',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json',
        },
        body: JSON.stringify({ status: status }),
    })
    .then(function (res) { return res.json(); })
    .then(function (data) {
        if (!data.status) return;
        badge.textContent = data.status.charAt(0).toUpperCase() + data.status.slice(1);
        badge.className = 'proposal-status-badge status-' + data.status;

        if (data.status === 'accepted' || data.status === 'rejected') {
            var actions = card.querySelector('.proposal-actions');
            if (actions) actions.remove();
        }
    })
    .catch(function () {
        alert('Could not update proposal status. Please try again.');
    });
});
</script>
@else
<div class="proposals-empty">
    No proposals yet for this project.
</div>
@endif