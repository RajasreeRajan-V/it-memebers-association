
@php
    use App\Models\FreelancerBid;
    use App\Models\FreelancerSavedJob;
    use Illuminate\Support\Facades\Auth;

    $project = $item->project ?? $item;

    $employer = $project->employer ?? null;
    $registration = $employer?->employerRegistration;

    $companyName =
        $registration?->company_name ??
        $employer?->company_name ??
        $employer?->name ??
        'Company';

    $title = $project->title ?? 'Untitled Project';
    $budget = $project->budget ?? null;
    $workMode = $project->work_mode ?? null;
    $projectType = $project->project_type ?? null;
    $duration = $project->duration ?? null;


    $isSaved = Auth::check()
        ? FreelancerSavedJob::where('user_id', Auth::id())
            ->where('project_id', $project->id)
            ->exists()
        : false;


    $freelancer = Auth::user()?->freelancerRegistration;

    $proposalSubmitted = $freelancer
        ? $freelancer->bids()
            ->where('project_id', $project->id)
            ->exists()
        : false;
@endphp


<div class="work-card">

    {{-- Save / Unsave Button --}}
    @auth
        <div class="save-job-wrapper">

            @if ($isSaved)

                <form action="{{ route('freelancer.unsave-job', $project->id) }}"
                      method="POST">
                    @csrf
                    @method('DELETE')

                    <button type="submit"
                            class="save-job-btn saved"
                            title="Remove from saved jobs"
                            aria-label="Remove from saved jobs">

                        <i class="bi bi-bookmark-fill"></i>

                    </button>
                </form>

            @else

                <form action="{{ route('freelancer.save-job', $project->id) }}"
                      method="POST">
                    @csrf

                    <button type="submit"
                            class="save-job-btn"
                            title="Save job"
                            aria-label="Save job">

                        <i class="bi bi-bookmark"></i>

                    </button>
                </form>

            @endif

        </div>
    @endauth


    {{-- Header --}}
    <div class="work-card-header">

        <div class="company-logo">
            {{ strtoupper(substr($companyName, 0, 1)) }}
        </div>

        <div class="flex-grow-1">

            <div class="d-flex align-items-center gap-2 flex-wrap">

                <h3 class="job-title mb-0">
                    {{ $title }}
                </h3>

                @if ($project->status ?? false)

                    <span class="status-badge status-{{ strtolower(str_replace('_', '-', $project->status)) }}">
                        {{ ucwords(str_replace('_', ' ', $project->status)) }}
                    </span>

                @endif

            </div>


            <div class="company-name mt-1">

                {{ $companyName }}

                @if ($registration?->is_verified)
                    <i class="bi bi-patch-check-fill verified-icon"></i>
                @endif

            </div>

        </div>


        <div class="job-date">
            {{ $project->created_at?->diffForHumans() }}
        </div>

    </div>


    {{-- Description --}}
    @if ($project->description)

        <p class="job-description">
            {{ $project->description }}
        </p>

    @endif


    {{-- Job information --}}
    <div class="job-meta">

        @if ($budget)

            <div class="meta-item">

                <i class="bi bi-currency-rupee"></i>

                <span>
                    <strong>Budget</strong>
                    ₹{{ $project->budget }}
                </span>

            </div>

        @endif


        @if ($projectType)

            <div class="meta-item">

                <i class="bi bi-briefcase"></i>

                <span>
                    <strong>Type</strong>
                    {{ ucwords(str_replace('_', ' ', $projectType)) }}
                </span>

            </div>

        @endif


        @if ($workMode)

            <div class="meta-item">

                <i class="bi bi-geo-alt"></i>

                <span>
                    <strong>Work Mode</strong>
                    {{ ucwords(str_replace('_', ' ', $workMode)) }}
                </span>

            </div>

        @endif


        @if ($duration)

            <div class="meta-item">

                <i class="bi bi-clock"></i>

                <span>
                    <strong>Duration</strong>
                    {{ $duration }}
                </span>

            </div>

        @endif

    </div>


    {{-- Footer --}}
    <div class="work-card-footer">

        <div class="skills-wrapper">

            @if (!empty($project->skills))

                @php
                    $skills = is_array($project->skills)
                        ? $project->skills
                        : explode(',', $project->skills);
                @endphp

                @foreach (array_slice($skills, 0, 4) as $skill)

                    <span class="skill-tag">
                        {{ trim($skill) }}
                    </span>

                @endforeach


                @if (count($skills) > 4)

                    <span class="skill-tag more-tag">
                        +{{ count($skills) - 4 }}
                    </span>

                @endif

            @endif

        </div>


        {{-- Bid / Proposal Status --}}
        @if ($proposalSubmitted)

            <span class="view-job-btn proposal-submitted-btn">

                <i class="bi bi-check-circle-fill"></i>

                Proposal Submitted

            </span>

        @else

            <a href="{{ route('freelancer.bid.edit', $project->id) }}"
               class="view-job-btn">

                Place Bid

                <i class="bi bi-arrow-right"></i>

            </a>

        @endif

    </div>

</div>

