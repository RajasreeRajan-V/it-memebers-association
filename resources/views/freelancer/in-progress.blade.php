@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="{{ asset('css/freelancer/_work-styles.css') }}">

<div class="container work-page">

    <div class="page-heading">
        <h1>In Progress</h1>
        <p>Projects that you have accepted and are currently working on.</p>
    </div>
       @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if (session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif
    <div class="work-nav">
 
        <a href="{{ route('freelancer.saved-jobs') }}">Saved</a>
        <a href="{{ route('freelancer.applied') }}">Applied</a>
        <a href="{{ route('freelancer.proposals') }}">Proposals</a>
        <a href="{{ route('freelancer.in-progress') }}" class="active">In Progress</a>
        <a href="{{ route('freelancer.hired') }}">Hired</a>
        <a href="{{ route('freelancer.archived') }}">Archived</a>
    </div>

    @forelse($proposals as $bid)
        @php
            $project    = $bid->project;
            $employer   = $project?->employer ?? $bid->employer;
            $bidNo      = $bid->bid_number ?? $bid->id;
            $days       = $bid->estimated_days;
            $acceptedAt = $bid->approved_at ?? $bid->updated_at;

            $hasContract       = !empty($bid->contract_document);
            $hasSignedContract = !empty($bid->signed_contract_document);
        @endphp

        <div class="ip-card">

            <div class="ip-card__head">
                <div>
                    <h3>{{ $project->title ?? 'Untitled Project' }}</h3>
                    <small>Bid #{{ $bidNo }} · Submitted {{ $bid->created_at->format('M d, Y') }}</small>
                </div>
                <span class="ip-badge">
                    <i class="bi bi-check-circle-fill"></i> Accepted
                </span>
            </div>

            <div class="ip-grid">
                <div>
                    <span class="ip-label">Your Bid Amount</span>
                    <span class="ip-amount">₹{{ number_format((float) $bid->bid_amount, 2) }}</span>
                </div>

                <div>
                    <span class="ip-label">Estimated Duration</span>
                    <span>{{ $days ? $days . (is_numeric($days) ? ' days' : '') : 'Not specified' }}</span>
                </div>

                <div>
                    <span class="ip-label">Accepted On</span>
                    <span>{{ optional($acceptedAt)->format('M d, Y H:i') }}</span>
                </div>

                <div>
                    <span class="ip-label">Category</span>
                    <span>{{ $bid->category ?? $project->category ?? 'Uncategorized' }}</span>
                </div>

                <div>
                    <span class="ip-label">Employer</span>
                    <span>{{ $employer->name ?? 'Unknown' }}</span>
                    @if (!empty($employer?->email))
                        <small><i class="bi bi-envelope"></i> {{ $employer->email }}</small>
                    @endif
                </div>
            </div>

            @if (!empty($project?->description))
                <div class="ip-block">
                    <span class="ip-label">Project Description</span>
                    <p>{{ \Illuminate\Support\Str::limit($project->description, 250) }}</p>
                </div>
            @endif

            @if (!empty($bid->comments))
                <div class="ip-block ip-block--note">
                    <span class="ip-label"><i class="bi bi-chat-left-text"></i> Message from Employer</span>
                    <p>{{ $bid->comments }}</p>
                </div>
            @endif

            {{-- ===== CONTRACT ===== --}}
            <div class="ip-block ip-contract">
                <span class="ip-label"><i class="bi bi-file-earmark-text"></i> Contract</span>

                @if ($hasContract)
                    <div class="ip-contract__row">
                        <div class="ip-contract__info">
                            <strong>Contract from Employer</strong>
                            <small>
                                {{ basename($bid->contract_document) }}
                                @if ($bid->contract_sent_at)
                                    · Sent {{ $bid->contract_sent_at->format('M d, Y H:i') }}
                                @endif
                            </small>
                        </div>
                        <a href="{{ route('freelancer.contract.download', [$bid->id, 'contract']) }}"
   target="_blank"
   rel="noopener"
   class="ip-btn">
    <i class="bi bi-download"></i> View / Download
</a>
                    </div>

                    <div class="ip-contract__row">
                        <div class="ip-contract__info">
                            <strong>Signed Contract</strong>
                            @if ($hasSignedContract)
    <a href="{{ route('freelancer.contract.download', [$bid->id, 'signed']) }}"
       target="_blank" rel="noopener" class="ip-btn">
        <i class="bi bi-download"></i> View / Download
    </a>
@else
    @php $bag = $errors->getBag('signed_' . $bid->id); @endphp

    <form action="{{ route('freelancer.contract.upload-signed', $bid->id) }}"
          method="POST" enctype="multipart/form-data" class="ip-upload">
        @csrf
        <input type="file" name="signed_contract" accept=".pdf,.doc,.docx" required>
        <button type="submit" class="ip-btn">
            <i class="bi bi-upload"></i> Upload &amp; Send
        </button>
        @if ($bag->has('signed_contract'))
            <small class="ip-error">{{ $bag->first('signed_contract') }}</small>
        @endif
    </form>
@endif
                        </div>

                        @if ($hasSignedContract)
                            <a href="{{ route('freelancer.contract.download', [$bid->id, 'signed']) }}"
   target="_blank"
   rel="noopener"
   class="ip-btn">
    <i class="bi bi-download"></i> View / Download
</a>
                        @else
                            <span class="ip-pill ip-pill--warn">Awaiting signature</span>
                        @endif
                    </div>
                @else
                    <p class="ip-contract__empty">The employer has not sent a contract yet.</p>
                @endif
            </div>
            {{-- ===== END CONTRACT ===== --}}

            @if (!empty(trim($bid->cover_letter ?? '')))
                <details class="ip-details">
                    <summary>View your cover letter</summary>
                    <p>{{ $bid->cover_letter }}</p>
                </details>
            @endif

        </div>

    @empty

        <div class="empty-state">
            <div class="empty-icon"><i class="bi bi-hourglass-split"></i></div>
            <h3>No Active Projects</h3>
            <p>Projects currently in progress will appear here.</p>
        </div>

    @endforelse

    @if($proposals->hasPages())
        <div class="pagination-wrapper">
            {{ $proposals->links() }}
        </div>
    @endif

</div>

<style>
    .ip-card{background:#fff;border:1px solid #e9edf4;border-radius:12px;padding:1.5rem;margin-bottom:1.25rem;box-shadow:0 1px 3px rgba(20,20,43,.05)}
    .ip-card__head{display:flex;justify-content:space-between;align-items:flex-start;gap:1rem;margin-bottom:1.25rem}
    .ip-card__head h3{margin:0 0 .25rem;font-size:1.1rem;font-weight:700}
    .ip-card__head small{color:#8a8fa8}
    .ip-badge{background:rgba(16,185,129,.14);color:#065f46;padding:.3rem .85rem;border-radius:20px;font-size:.72rem;font-weight:700;text-transform:uppercase;white-space:nowrap}
    .ip-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(180px,1fr));gap:1.25rem}
    .ip-grid>div{display:flex;flex-direction:column;gap:.25rem}
    .ip-label{font-size:.68rem;font-weight:700;text-transform:uppercase;letter-spacing:.06em;color:#8a8fa8}
    .ip-amount{font-size:1.4rem;font-weight:700;color:#10b981}
    .ip-block{margin-top:1.25rem}
    .ip-block p{margin:.4rem 0 0;color:#4a4a5a;line-height:1.6;white-space:pre-line}
    .ip-block--note{background:#f8faff;border-left:3px solid #4a6cf7;border-radius:10px;padding:1rem 1.1rem}
    .ip-details{margin-top:1rem}
    .ip-details summary{cursor:pointer;color:#4a6cf7;font-weight:600;font-size:.85rem}
    .ip-details p{margin-top:.6rem;color:#4a4a5a;line-height:1.6;white-space:pre-line}

    /* Contract */
    .ip-contract{background:#fafbff;border:1px solid #e9edf4;border-radius:10px;padding:1rem 1.1rem}
    .ip-contract__row{display:flex;justify-content:space-between;align-items:center;gap:1rem;padding:.7rem 0;border-bottom:1px dashed #e3e7f0}
    .ip-contract__row:last-child{border-bottom:0;padding-bottom:0}
    .ip-contract__info{display:flex;flex-direction:column;gap:.15rem;min-width:0}
    .ip-contract__info small{color:#8a8fa8;word-break:break-all}
    .ip-contract__empty{margin:.4rem 0 0;color:#8a8fa8}
    .ip-btn{background:#4a6cf7;color:#fff;padding:.4rem .9rem;border-radius:8px;font-size:.8rem;font-weight:600;text-decoration:none;white-space:nowrap}
    .ip-btn:hover{background:#3a58d6;color:#fff}
    .ip-pill{padding:.25rem .7rem;border-radius:20px;font-size:.7rem;font-weight:700;text-transform:uppercase;white-space:nowrap}
    .ip-pill--warn{background:rgba(245,158,11,.15);color:#92400e}
</style>

@endsection