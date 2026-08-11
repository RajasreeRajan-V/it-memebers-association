<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MentorshipRequest extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'mentee_id',
        'mentor_id',
        'type',
        'resume_file_path',
        'mentee_message',
        'status',
        'scheduled_at',
        'admin_notes',
        'resume_feedback',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'scheduled_at' => 'datetime',
    ];

    /**
     * The student/user who made this request.
     */
    public function mentee()
    {
        return $this->belongsTo(User::class, 'mentee_id');
    }

    /**
     * The mentor this request was sent to.
     * NOTE: confirm whether mentor_id points to users.id or
     * mentor_registrations.id in your schema — adjust the
     * related model below if it's the latter.
     */
    public function mentor()
    {
        return $this->belongsTo(User::class, 'mentor_id');
    }
}