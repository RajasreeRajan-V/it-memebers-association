<?php

namespace App\Models;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'suggested_date',
        'suggested_time',
        'suggestion_note',
        'accepted_at',
        'admin_verified_at',
        'admin_id',
    ];

    protected $casts = [
        'preferred_days'    => 'array',
        'suggested_date'    => 'date',
        'accepted_at'       => 'datetime',
        'admin_verified_at' => 'datetime',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function mentor()
    {
        return $this->belongsTo(User::class, 'mentor_id');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

    /** The Mentorship created once this request is accepted. */
    public function mentorship()
    {
        return $this->hasOne(Mentorship::class, 'mentorship_request_id');
    }

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeAwaitingAdmin($query)
    {
        return $query->where('status', 'admin_verification');
    }

    /*
    |--------------------------------------------------------------------------
    | Helpers
    |--------------------------------------------------------------------------
    */

    public function isPending(): bool
    {
        return $this->status === 'pending';
    }
}
