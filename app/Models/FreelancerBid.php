<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
class FreelancerBid extends Model
{
    use HasFactory;

    public const STATUS_PENDING = 'pending';
    public const STATUS_SHORTLISTED = 'shortlisted';
    public const STATUS_INTERVIEW = 'interview';
    public const STATUS_ACCEPTED = 'accepted';
    public const STATUS_REJECTED = 'rejected';
    public const STATUS_WITHDRAWN = 'withdrawn';
    public const STATUS_PROCESSED = 'processed';

   protected $fillable = [
    'project_id',
    'freelancer_id',
    'employer_id',
    'bid_amount',
    'estimated_days',
    'cover_letter',
    'comments',
    'status',
    'contract_document',          // was contract_original_name
    'contract_sent_at',
    'signed_contract_document',
    'signed_contract_received_at',
    'work_started_at',            
];

    protected $casts = [
        'bid_amount' => 'decimal:2',
        'contract_sent_at' => 'datetime',
        'signed_contract_received_at' => 'datetime',
        'work_started_at' => 'date',
    ];

    /**
     * Project to which this bid belongs.
     */
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    /**
     * Freelancer who submitted the bid.
     *
     * freelancer_id -> freelancer_registrations.id
     */
    public function freelancer()
    {
        return $this->belongsTo(
            FreelancerRegistration::class,
            'freelancer_id',
            'id'
        );
    }

    /**
     * Employer who owns the project / submitted bid relationship.
     *
     * employer_id -> users.id
     */
    public function employer()
    {
        return $this->belongsTo(
            User::class,
            'employer_id',
            'id'
        );
    }
    public function workReports(): HasMany
    {
        return $this->hasMany(FreelancerWorkReport::class, 'freelancer_bid_id');
    }

 public function estimatedWorkingDays(): int
{
    $raw = strtolower(trim((string) $this->estimated_days));

    if (!preg_match_all('/\d+/', $raw, $m)) {
        return 0;
    }

    $n = (int) max($m[0]);               // for a range, use the larger number

    if (str_contains($raw, 'month')) return $n * 26;   // 6 days/week
    if (str_contains($raw, 'week'))  return $n * 6;    // Mon–Sat

    return $n;                           // plain number or "days"
}

public function workingDays(): array
{
    $total = $this->estimatedWorkingDays();

    if (!$this->work_started_at || $total < 1) {
        return [];
    }

    $days = [];
    $d = $this->work_started_at->copy()->startOfDay();

    while ($d->isSunday()) {             // only Sunday is a day off
        $d->addDay();
    }
    while (count($days) < $total) {
        $days[] = $d->copy();
        $d->addDay();
        while ($d->isSunday()) {
            $d->addDay();
        }
    }
    return $days;
}
}