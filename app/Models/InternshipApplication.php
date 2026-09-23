<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InternshipApplication extends Model
{
    use HasFactory;

    /*
    |--------------------------------------------------------------------------
    | Statuses
    |--------------------------------------------------------------------------
    |
    | Intentionally only 4 states — no "shortlisted" step.
    |
    */

    const STATUS_APPLIED   = 'applied';
    const STATUS_SELECTED  = 'selected';
    const STATUS_REJECTED  = 'rejected';
    const STATUS_COMPLETED = 'completed';

    protected $fillable = [
        'internship_id',
        'student_id',
        'resume',
        'cover_letter',
        'status',
        'applied_at',
        'selected_at',
        'rejected_at',
        'completed_at',
        'performance',
        'comments',
    ];

    protected $casts = [
        'applied_at'   => 'datetime',
        'selected_at'  => 'datetime',
        'rejected_at'  => 'datetime',
        'completed_at' => 'datetime',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function internship()
    {
        return $this->belongsTo(Internship::class);
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function certificate()
    {
        return $this->hasOne(InternshipCertificate::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Helpers
    |--------------------------------------------------------------------------
    */

    public function isApplied(): bool
    {
        return $this->status === self::STATUS_APPLIED;
    }

    public function isSelected(): bool
    {
        return $this->status === self::STATUS_SELECTED;
    }

    public function isRejected(): bool
    {
        return $this->status === self::STATUS_REJECTED;
    }

    public function isCompleted(): bool
    {
        return $this->status === self::STATUS_COMPLETED;
    }
}
