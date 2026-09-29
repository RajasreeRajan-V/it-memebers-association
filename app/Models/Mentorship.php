<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mentorship extends Model
{
    use HasFactory;

    protected $fillable = [
        'mentorship_request_id',
        'student_id',
        'mentor_id',
        'career_goal',
        'status',
        'progress_percent',
        'completion_reason',
        'completion_notes',
        'started_at',
        'completed_at',
    ];

    protected $casts = [
        'started_at'       => 'datetime',
        'completed_at'     => 'datetime',
        'progress_percent' => 'integer',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function mentorshipRequest()
    {
        return $this->belongsTo(MentorshipRequest::class, 'mentorship_request_id');
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function mentor()
    {
        return $this->belongsTo(User::class, 'mentor_id');
    }

    public function sessions()
    {
        return $this->hasMany(MentorshipSession::class, 'mentorship_id');
    }

    public function feedback()
    {
        return $this->hasMany(MentorshipFeedback::class, 'mentorship_id');
    }

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    /*
    |--------------------------------------------------------------------------
    | Helpers
    |--------------------------------------------------------------------------
    */

    public function upcomingSession()
    {
        return $this->sessions()
            ->whereIn('status', ['scheduled', 'confirmed'])
            ->whereDate('session_date', '>=', now()->toDateString())
            ->orderBy('session_date')
            ->orderBy('start_time')
            ->first();
    }

    public function lastCompletedSession()
    {
        return $this->sessions()
            ->where('status', 'completed')
            ->orderByDesc('starts_at')
            ->first();
    }
}
