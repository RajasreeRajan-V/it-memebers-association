<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InternshipTaskSubmission extends Model
{
    use HasFactory;

    const STATUS_SUBMITTED = 'submitted';
    const STATUS_COMPLETED = 'completed';
    const STATUS_CHANGES_REQUESTED = 'changes_requested';

    protected $fillable = [
        'task_id',
        'student_id',
        'submission_text',
        'submission_url',
        'file_path',
        'status',
        'employer_feedback',
        'submitted_at',
        'reviewed_at',
    ];

    protected $casts = [
        'submitted_at' => 'datetime',
        'reviewed_at' => 'datetime',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function task()
    {
        return $this->belongsTo(InternshipTask::class, 'task_id');
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    /*
    |--------------------------------------------------------------------------
    | Helpers
    |--------------------------------------------------------------------------
    */

    public function isCompleted(): bool
    {
        return $this->status === self::STATUS_COMPLETED;
    }

    public function isChangesRequested(): bool
    {
        return $this->status === self::STATUS_CHANGES_REQUESTED;
    }

    public function isSubmitted(): bool
    {
        return $this->status === self::STATUS_SUBMITTED;
    }
}