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
        'expires_at' => 'datetime',
        'is_active'  => 'boolean',
        // 'skills' removed from here — handled by the accessor/mutator below instead,
        // because some old rows have skills stored as a plain "laravel,php,mysql"
        // string instead of a JSON array, which breaks the automatic array cast.
    ];

    /**
     * Always returns skills as a clean array, whether the DB has it stored as
     * a JSON array (["laravel","php","mysql"]) or a plain comma string
     * ("laravel,php,mysql").
     */
    public function getSkillsAttribute($value)
    {
        if (empty($value)) {
            return [];
        }

        // try JSON first (new/correct format)
        $decoded = json_decode($value, true);

        if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
            return array_values(array_filter(array_map('trim', $decoded)));
        }

        // fallback: plain comma-separated string (old format)
        return array_values(array_filter(array_map('trim', explode(',', $value))));
    }

    /**
     * Always save skills as a proper JSON array, regardless of whether the
     * caller passes an array or a comma-separated string.
     */
    public function setSkillsAttribute($value)
    {
        if (is_array($value)) {
            $skills = $value;
        } else {
            $skills = explode(',', (string) $value);
        }

        $skills = array_values(array_filter(array_map('trim', $skills)));

        $this->attributes['skills'] = json_encode($skills);
    }

    public function employer()
    {
        return $this->belongsTo(User::class, 'employer_id');
    }

    public function savedBy()
    {
        return $this->hasMany(SavedJob::class);
    }

    public function applications()
    {
        return $this->hasMany(JobApplication::class);
    }

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
}