<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'employer_id',
        'title',
        'category',           // new
        'description',
        'project_type',
        'budget',
        'duration',
        'experience_level',   // was missing from fillable — was being silently dropped on save
        'skills',
        'deadline',
        'status',
        'rejection_reason',
        'work_mode',
        'visibility',
        'maximum_bids',
        'people_required',    // new
        'country',
        'state',
        'district',
        'city',
    ];

    protected $casts = [
        'skills' => 'array',
        'deadline' => 'date',
    ];

    public function employer()
    {
        return $this->belongsTo(User::class, 'employer_id');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'approved');
    }

    public function applications()
    {
        return $this->hasMany(ProjectApplication::class, 'project_id');
    }

    public function savedJobs()
    {
        return $this->hasMany(SavedJob::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Capacity / team helpers
    |--------------------------------------------------------------------------
    | "people_required" is how many accepted proposals this project needs.
    | These helpers are the single source of truth for that logic so the
    | controller and the views never calculate it differently in two places.
    */

    public function acceptedApplications()
    {
        return $this->applications()->where('status', 'accepted');
    }

    public function acceptedCount(): int
    {
        return $this->acceptedApplications()->count();
    }

    public function requiredPeople(): int
    {
        return max(1, (int) ($this->people_required ?? 1));
    }

    public function hasOpenPositions(): bool
    {
        return $this->acceptedCount() < $this->requiredPeople();
    }

    public function isTeamFull(): bool
    {
        return !$this->hasOpenPositions();
    }

    /**
     * Can this project still receive new proposals from employees?
     * Closed/completed projects, or projects with no visibility to
     * employees, should not accept new proposals.
     */
    public function isOpenForProposals(): bool
    {
        return in_array($this->status, ['active', 'in_progress'], true)
            && $this->visibility === 'employee';
    }
}