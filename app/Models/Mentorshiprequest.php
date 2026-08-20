<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Admin;

class MentorshipRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'mentor_id',
        'goal',
        'current_skills',
        'career_goal',
        'frequency',
        'preferred_days',
        'preferred_time',
        'message',
        'status',
        'accepted_at',
        'admin_verified_at',
        'admin_id',
    ];

    protected $casts = [
        'preferred_days' => 'array',
        'accepted_at' => 'datetime',
        'admin_verified_at' => 'datetime',
    ];

    /**
     * Student who requested the mentorship.
     * mentorship_requests.student_id -> users.id
     */
    public function student()
    {
        return $this->belongsTo(
            User::class,
            'student_id'
        );
    }

    /**
     * Mentor who receives the request.
     * mentorship_requests.mentor_id -> users.id
     */
    public function mentor()
    {
        return $this->belongsTo(
            User::class,
            'mentor_id'
        );
    }

    /**
     * Admin who verified/rejected the request.
     * mentorship_requests.admin_id -> admins.id
     */
    public function admin()
    {
        return $this->belongsTo(
            Admin::class,
            'admin_id'
        );
    }

    /**
     * Mentorship created from this request.
     */
    public function mentorship()
    {
        return $this->hasOne(
            Mentorship::class,
            'mentorship_request_id'
        );
    }

    /**
     * Pending requests.
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Requests waiting for admin verification.
     */
    public function scopeAwaitingAdmin($query)
    {
        return $query->where(
            'status',
            'admin_verification'
        );
    }
}