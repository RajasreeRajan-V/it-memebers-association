<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MockInterview extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id', 'mentor_id', 'assigned_by', 'scheduled_at', 'mode',
        'meeting_link', 'status', 'technical_rating', 'communication_rating',
        'confidence_rating', 'overall_rating', 'feedback', 'conducted_at',
    ];

    protected $casts = [
        'scheduled_at' => 'datetime',
        'conducted_at' => 'datetime',
    ];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function mentor()
    {
        return $this->belongsTo(User::class, 'mentor_id');
    }

    public function assignedBy()
    {
        return $this->belongsTo(Admin::class, 'assigned_by');
    }
}
