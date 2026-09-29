<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MockInterview extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'mentor_id',
        'topic',
        'student_notes',
        'requested_at',
        'scheduled_at',
        'meeting_link',
        'status',
        'mentor_feedback',
        'mentor_rating',
        'student_feedback',
        'student_rating',
    ];

    protected $casts = [
        'requested_at' => 'datetime',
        'scheduled_at' => 'datetime',
    ];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function mentor()
    {
        return $this->belongsTo(User::class, 'mentor_id');
    }

    public function scopeForMentor($query, $mentorId)
    {
        return $query->where('mentor_id', $mentorId);
    }

    public function scopeForStudent($query, $studentId)
    {
        return $query->where('student_id', $studentId);
    }
}
