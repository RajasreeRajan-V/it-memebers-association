<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InternshipApplication extends Model
{
    use HasFactory;

    /*
    |--------------------------------------------------------------------------
    | Table
    |--------------------------------------------------------------------------
    */

    protected $table = 'internship_applications';


    /*
    |--------------------------------------------------------------------------
    | Statuses
    |--------------------------------------------------------------------------
    |
    | Internship application workflow:
    |
    | applied
    | selected
    | rejected
    | completed
    |
    */

    public const STATUS_APPLIED   = 'applied';
    public const STATUS_SELECTED  = 'selected';
    public const STATUS_REJECTED  = 'rejected';
    public const STATUS_COMPLETED = 'completed';


    /*
    |--------------------------------------------------------------------------
    | Mass Assignment
    |--------------------------------------------------------------------------
    */

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


    /*
    |--------------------------------------------------------------------------
    | Casts
    |--------------------------------------------------------------------------
    */

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


    /**
     * Internship applied for.
     */
    public function internship()
    {
        return $this->belongsTo(
            Internship::class,
            'internship_id'
        );
    }


    /**
     * Student who submitted the application.
     *
     * IMPORTANT:
     * This is the correct relationship.
     *
     * Do NOT use $application->user.
     */
    public function student()
    {
        return $this->belongsTo(
            User::class,
            'student_id'
        );
    }


    /**
     * Certificate issued for this internship application.
     */
    public function certificate()
    {
        return $this->hasOne(
            InternshipCertificate::class,
            'internship_application_id'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Status Helpers
    |--------------------------------------------------------------------------
    */


    /**
     * Check whether application is applied.
     */
    public function isApplied(): bool
    {
        return $this->status === self::STATUS_APPLIED;
    }


    /**
     * Check whether application is selected.
     */
    public function isSelected(): bool
    {
        return $this->status === self::STATUS_SELECTED;
    }


    /**
     * Check whether application is rejected.
     */
    public function isRejected(): bool
    {
        return $this->status === self::STATUS_REJECTED;
    }


    /**
     * Check whether internship is completed.
     */
    public function isCompleted(): bool
    {
        return $this->status === self::STATUS_COMPLETED;
    }


    /*
    |--------------------------------------------------------------------------
    | Additional Convenience Helpers
    |--------------------------------------------------------------------------
    */


    /**
     * Check whether the application has a certificate.
     */
    public function hasCertificate(): bool
    {
        return $this->certificate()->exists();
    }


    /**
     * Get the student's display name.
     */
    public function getStudentNameAttribute(): string
    {
        return $this->student?->name ?? 'Student';
    }


    /**
     * Get the internship title.
     */
    public function getInternshipTitleAttribute(): string
    {
        return $this->internship?->title ?? 'Internship';
    }
}