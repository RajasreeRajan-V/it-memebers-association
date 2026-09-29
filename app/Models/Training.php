<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Training extends Model
{
    use HasFactory;

    // Workflow status constants
    const STATUS_DRAFT            = 'draft';
    const STATUS_PENDING_APPROVAL = 'pending_approval';
    const STATUS_APPROVED         = 'approved';
    const STATUS_REJECTED         = 'rejected';
    const STATUS_PUBLISHED        = 'published';

    protected $fillable = [
        'mentor_id',
        'title',
        'short_description',
        'full_description',
        'category',
        'technology',
        'level',
        'training_type',
        'thumbnail',
        'duration',
        'total_sessions',
        'session_duration',
        'start_date',
        'end_date',
        'max_participants',
        'language',
        'platform',
        'meeting_link',
        'schedule',
        'certificate_enabled',
        'status',
        'rejection_reason',
        'approved_by',
        'submitted_at',
        'approved_at',
        'published_at',
    ];

    protected $casts = [
        'start_date'           => 'date',
        'end_date'              => 'date',
        'certificate_enabled'   => 'boolean',
        'submitted_at'          => 'datetime',
        'approved_at'           => 'datetime',
        'published_at'          => 'datetime',
    ];

    /* ---------------- Relationships ---------------- */

    public function mentor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'mentor_id');
    }

    public function approver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function outcomes(): HasMany
    {
        return $this->hasMany(TrainingOutcome::class)->orderBy('order');
    }

    public function requirements(): HasMany
    {
        return $this->hasMany(TrainingRequirement::class)->orderBy('order');
    }

    public function modules(): HasMany
    {
        return $this->hasMany(TrainingModule::class)->orderBy('order');
    }

    public function resources(): HasMany
    {
        return $this->hasMany(TrainingResource::class);
    }

    public function enrollments(): HasMany
    {
        return $this->hasMany(Enrollment::class);
    }

    /* ---------------- Scopes ---------------- */

    public function scopePublished($query)
    {
        return $query->where('status', self::STATUS_PUBLISHED);
    }

    public function scopePendingApproval($query)
    {
        return $query->where('status', self::STATUS_PENDING_APPROVAL);
    }

    public function scopeForMentor($query, $mentorId)
    {
        return $query->where('mentor_id', $mentorId);
    }

    /* ---------------- Helpers ---------------- */

    public function isEditableByMentor(): bool
    {
        return in_array($this->status, [self::STATUS_DRAFT, self::STATUS_REJECTED]);
    }

    public function totalEnrolled(): int
    {
        return $this->enrollments()->count();
    }

    public function isFull(): bool
    {
        if (!$this->max_participants) {
            return false;
        }
        return $this->totalEnrolled() >= $this->max_participants;
    }
}
