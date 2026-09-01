<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MentorshipFeedback extends Model
{
    use HasFactory;

    protected $table = 'mentorship_feedbacks';

    protected $fillable = [
        'session_id',
        'mentorship_id',
        'student_id',
        'mentor_id',
        'rating',
        'comment',
    ];

    protected $casts = [
        'rating' => 'integer',
    ];

    /**
     * Feedback belongs to a mentorship session.
     */
    public function session()
    {
        return $this->belongsTo(
            MentorshipSession::class,
            'session_id'
        );
    }

    /**
     * Feedback belongs to a mentorship.
     */
    public function mentorship()
    {
        return $this->belongsTo(
            Mentorship::class,
            'mentorship_id'
        );
    }

    /**
     * Feedback belongs to the student.
     */
    public function student()
    {
        return $this->belongsTo(
            User::class,
            'student_id'
        );
    }

    /**
     * Feedback belongs to the mentor.
     */
    public function mentor()
    {
        return $this->belongsTo(
            User::class,
            'mentor_id'
        );
    }
}