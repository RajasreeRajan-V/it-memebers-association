<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    protected $fillable = ['user_id', 'job_post_id', 'status', 'sub_status', 'status_updated_at'];

    protected $casts = [
        'status_updated_at' => 'datetime',
    ];

    // Top-level statuses (what the employee sees as a bucket)
    public const STATUS_APPLIED     = 'applied';
    public const STATUS_IN_PROGRESS = 'in_progress';
    public const STATUS_INTERVIEW   = 'interview';
    public const STATUS_HIRED       = 'hired';
    public const STATUS_REJECTED    = 'rejected';
    public const STATUS_ARCHIVED    = 'archived';

    // Sub-statuses, only used when status = in_progress
    public const SUB_RESUME_REVIEWED   = 'resume_reviewed';
    public const SUB_UNDER_REVIEW      = 'under_review';
    public const SUB_SHORTLISTED       = 'shortlisted';
    public const SUB_HR_REVIEW         = 'hr_review';
    public const SUB_TECHNICAL_REVIEW  = 'technical_review';

    public function jobPost()
    {
        return $this->belongsTo(JobPost::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeApplied($query)
    {
        return $query->where('status', self::STATUS_APPLIED);
    }

    public function scopeInProgress($query)
    {
        return $query->where('status', self::STATUS_IN_PROGRESS);
    }

    public function scopeInterview($query)
    {
        return $query->where('status', self::STATUS_INTERVIEW);
    }

    public function scopeHired($query)
    {
        return $query->where('status', self::STATUS_HIRED);
    }

    public function scopeArchived($query)
    {
        return $query->where('status', self::STATUS_ARCHIVED);
    }

    /**
     * Human-friendly label for the sub_status, shown to the employee
     * (e.g. "Under Review", "Shortlisted").
     */
    public function getSubStatusLabelAttribute(): ?string
    {
        if (!$this->sub_status) {
            return null;
        }

        return ucwords(str_replace('_', ' ', $this->sub_status));
    }

    public function interview()
{
    return $this->hasOne(Interview::class, 'application_id');
}

    /**
     * Move this application into a new status/sub_status and stamp the time.
     */
    public function moveTo(string $status, ?string $subStatus = null): void
    {
        $this->update([
            'status'            => $status,
            'sub_status'        => $subStatus,
            'status_updated_at' => now(),
        ]);
    }
}