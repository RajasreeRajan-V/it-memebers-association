<?php

namespace App\Models;

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
        'expires_at' => 'datetime',
        'is_active'  => 'boolean',
    ];

    /*
    |--------------------------------------------------------------------------
    | Skills
    |--------------------------------------------------------------------------
    */

    public function getSkillsAttribute($value)
    {
        if (empty($value)) {
            return [];
        }

        $decoded = json_decode($value, true);

        if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
            return array_values(
                array_filter(
                    array_map('trim', $decoded)
                )
            );
        }

        return array_values(
            array_filter(
                array_map('trim', explode(',', $value))
            )
        );
    }

    public function setSkillsAttribute($value)
    {
        if (is_array($value)) {
            $skills = $value;
        } else {
            $skills = explode(',', (string) $value);
        }

        $skills = array_values(
            array_filter(
                array_map('trim', $skills)
            )
        );

        $this->attributes['skills'] = json_encode($skills);
    }

    /*
    |--------------------------------------------------------------------------
    | Employer
    |--------------------------------------------------------------------------
    */

    public function employer()
    {
        return $this->belongsTo(User::class, 'employer_id');
    }

    /*
    |--------------------------------------------------------------------------
    | Saved Jobs
    |--------------------------------------------------------------------------
    */

    public function savedBy()
    {
        return $this->hasMany(SavedJob::class, 'job_post_id');
    }

    /*
    |--------------------------------------------------------------------------
    | Applications
    |--------------------------------------------------------------------------
    */

    public function applications()
    {
        return $this->hasMany(JobApplication::class, 'job_post_id');
    }

    /*
    |--------------------------------------------------------------------------
    | Status Scopes
    |--------------------------------------------------------------------------
    */

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeByEmployer($query, $employerId)
    {
        return $query->where('employer_id', $employerId);
    }

    /*
    |--------------------------------------------------------------------------
    | Compatibility Accessors
    |--------------------------------------------------------------------------
    |
    | Your older student Blade files use names such as:
    | job_title, job_description, job_type, experience_level,
    | salary_range and location.
    |
    | These accessors map those names to the actual job_posts columns.
    |
    */

    public function getJobTitleAttribute()
    {
        return $this->title;
    }

    public function getJobDescriptionAttribute()
    {
        return $this->description;
    }

    public function getJobTypeAttribute()
    {
        return $this->employment_type;
    }

    public function getExperienceLevelAttribute()
    {
        return $this->experience;
    }

    public function getSalaryRangeAttribute()
    {
        return $this->salary;
    }

    public function getLocationAttribute()
    {
        $parts = [];

        if (!empty($this->city)) {
            $parts[] = $this->city;
        }

        if (!empty($this->district)) {
            $parts[] = $this->district;
        }

        if (!empty($this->state)) {
            $parts[] = $this->state;
        }

        if (!empty($this->country)) {
            $parts[] = $this->country;
        }

        return implode(', ', $parts);
    }


    public function employerRegistration()
{
    return $this->belongsTo(
        \App\Models\EmployerRegistration::class,
        'employer_id',
        'user_id'
    );
}
public function invitations()
{
    return $this->hasMany(JobInvitation::class, 'job_id');
}


}