<?php

namespace App\Models;

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
        'started_at',
        'completed_at',
    ];

    protected $casts = [
        'started_at' => 'datetime',
        'completed_at' => 'datetime',
        'progress_percent' => 'integer',
    ];

    /*
    |--------------------------------------------------------------------------
    | Mentorship Request
    |--------------------------------------------------------------------------
    */

    public function mentorshipRequest()
    {
        return $this->belongsTo(
            MentorshipRequest::class,
            'mentorship_request_id'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Student
    |--------------------------------------------------------------------------
    */

    public function student()
    {
        return $this->belongsTo(
            User::class,
            'student_id'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Mentor
    |--------------------------------------------------------------------------
    */

    public function mentor()
    {
        return $this->belongsTo(
            User::class,
            'mentor_id'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Sessions
    |--------------------------------------------------------------------------
    */

    public function sessions()
    {
        return $this->hasMany(
            MentorshipSession::class,
            'mentorship_id'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Feedback
    |--------------------------------------------------------------------------
    */

    public function feedback()
    {
        return $this->hasOne(
            MentorshipFeedback::class,
            'mentorship_id'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Upcoming Session
    |--------------------------------------------------------------------------
    */

    public function upcomingSession()
    {
        return $this->sessions()
            ->whereIn('status', ['scheduled', 'confirmed'])
            ->whereDate(
                'session_date',
                '>=',
                now()->toDateString()
            )
            ->orderBy('session_date')
            ->orderBy('start_time')
            ->first();
    }
}