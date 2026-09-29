<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InternshipModule extends Model
{
    use HasFactory;

    protected $fillable = [
        'internship_id',
        'title',
        'description',
        'learning_outcomes',
        'duration',
        'sort_order',
        'status',
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

    public function tasks()
    {
        return $this->hasMany(InternshipTask::class, 'module_id')
            ->orderBy('sort_order');
    }

    /*
    |--------------------------------------------------------------------------
    | Helpers
    |--------------------------------------------------------------------------
    */

    public function learningOutcomesList(): array
    {
        return collect(explode("\n", (string) $this->learning_outcomes))
            ->map(fn ($line) => trim($line))
            ->filter()
            ->values()
            ->all();
    }

    /**
     * How many of this module's tasks a given student has completed.
     */
    public function completedTasksCountFor(int $studentId): int
    {
        return InternshipTaskSubmission::whereIn(
                'task_id',
                $this->tasks()->pluck('id')
            )
            ->where('student_id', $studentId)
            ->where('status', InternshipTaskSubmission::STATUS_COMPLETED)
            ->count();
    }
}