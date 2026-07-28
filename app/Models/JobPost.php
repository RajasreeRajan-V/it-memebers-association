<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobPost extends Model
{
    use HasFactory;

    protected $table = 'job_posts';

    protected $fillable = [
        'employer_id',
        'title',
        'employment_type',
        'experience',
        'salary',
        'skills',
        'country',
        'state',
        'district',
        'city',
        'work_mode',
        'qualification',
        'description',
        'status',
        'is_active',
        'rejection_reason',
        'expires_at',
    ];

    protected $casts = [
        'skills'     => 'array',
        'expires_at' => 'datetime',
        'is_active'  => 'boolean',
    ];

    public function employer()
    {
        return $this->belongsTo(User::class, 'employer_id');
    }

    // Convenience scopes

    /**
     * Jobs visible to employees — only checks is_active = 1.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Jobs posted by a specific employer (used on the employer dashboard).
     */
    public function scopeByEmployer($query, $employerId)
    {
        return $query->where('employer_id', $employerId);
    }
}