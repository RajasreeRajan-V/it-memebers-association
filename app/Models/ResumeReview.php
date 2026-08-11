<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;

class ResumeReview extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'mentor_id',
        'resume_path',
        'resume_original_name',
        'review_type',
        'goal',
        'feedback_focus',
        'preferred_completion_time',
        'additional_instructions',
        'status',
        'overall_rating',
        'resume_quality',
        'relevance',
        'presentation',
        'strengths',
        'areas_to_improve',
        'additional_comments',
        'reviewed_at',
    ];

    protected $casts = [
        'feedback_focus' => 'array',
        'reviewed_at' => 'datetime',
    ];

    // ===== Relationships =====

    public function student()
    {
        return $this->belongsTo(\App\Models\User::class, 'student_id');
    }

    public function mentor()
    {
        return $this->belongsTo(\App\Models\User::class, 'mentor_id');
    }

    // The mentor's final submission goes through this before status flips to "completed"
    public function adminConfirmation()
    {
        return $this->morphOne(\App\Models\AdminConfirmation::class, 'confirmable');
    }

    // ===== Helpers =====

    public function hasPendingAdminConfirmation(): bool
    {
        return $this->adminConfirmation()->pending()->exists();
    }

    // ===== Accessors =====

    public function getResumeUrlAttribute(): string
    {
        return Storage::url($this->resume_path);
    }

    public function getAverageRatingAttribute(): ?float
    {
        $ratings = array_filter([
            $this->overall_rating,
            $this->resume_quality,
            $this->relevance,
            $this->presentation,
        ]);

        return count($ratings) ? round(array_sum($ratings) / count($ratings), 1) : null;
    }

    // ===== Scopes (used for mentor dashboard tab counts) =====

    public function scopePending(Builder $query): Builder
    {
        return $query->whereIn('status', ['pending', 'assigned']);
    }

    public function scopeInProgress(Builder $query): Builder
    {
        return $query->where('status', 'in_review');
    }

    public function scopeReviewed(Builder $query): Builder
    {
        return $query->where('status', 'completed');
    }
}