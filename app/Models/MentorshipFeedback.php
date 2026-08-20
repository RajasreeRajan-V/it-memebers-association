<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MentorshipFeedback extends Model
{
    use HasFactory;

    protected $table = 'mentorship_feedbacks';

    protected $fillable = ['mentorship_id', 'student_id', 'mentor_id', 'rating', 'comment'];

    public function mentorship()
    {
        return $this->belongsTo(Mentorship::class);
    }

    public function mentor()
    {
        return $this->belongsTo(Member::class, 'mentor_id');
    }

    public function student()
    {
        return $this->belongsTo(Member::class, 'student_id');
    }
}
