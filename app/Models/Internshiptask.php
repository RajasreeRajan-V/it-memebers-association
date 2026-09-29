<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InternshipTask extends Model
{
    use HasFactory;

    const TYPE_GITHUB_LINK = 'github_link';
    const TYPE_FILE_UPLOAD = 'file_upload';
    const TYPE_TEXT = 'text';

    protected $fillable = [
        'module_id',
        'title',
        'description',
        'instructions',
        'submission_type',
        'sort_order',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function module()
    {
        return $this->belongsTo(InternshipModule::class, 'module_id');
    }

    public function submissions()
    {
        return $this->hasMany(InternshipTaskSubmission::class, 'task_id');
    }

    /*
    |--------------------------------------------------------------------------
    | Helpers
    |--------------------------------------------------------------------------
    */

    public function submissionFor(int $studentId): ?InternshipTaskSubmission
    {
        return $this->submissions()
            ->where('student_id', $studentId)
            ->first();
    }

    public function submissionTypeLabel(): string
    {
        return match ($this->submission_type) {
            self::TYPE_GITHUB_LINK => 'GitHub Link',
            self::TYPE_FILE_UPLOAD => 'File Upload',
            default => 'Text',
        };
    }
}