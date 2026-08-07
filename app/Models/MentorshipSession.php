<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MentorshipSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'mentor_mentee_id', 'mentor_id', 'student_id', 'scheduled_at', 'mode',
        'meeting_link', 'status', 'session_notes', 'conducted_at',
    ];

    protected $casts = [
        'scheduled_at' => 'datetime',
        'conducted_at' => 'datetime',
    ];

    public function menteeAssignment()
    {
        return $this->belongsTo(MentorMentee::class, 'mentor_mentee_id');
    }

    public function mentor()
    {
        return $this->belongsTo(User::class, 'mentor_id');
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
}
