<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MentorshipSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'mentorship_id',
        'mentor_id',
        'student_id',
        'topic',
        'session_date',
        'start_time',
        'duration_minutes',
        'starts_at',
        'ends_at',
        'meeting_type',
        'meeting_link',
        'agenda',
        'status',
        'mentor_notes',
        'student_notes',
        'homework',
        'resources',
    ];

    protected $casts = [
        'session_date' => 'date',
        'starts_at'    => 'datetime',
        'ends_at'      => 'datetime',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function mentorship()
    {
        return $this->belongsTo(Mentorship::class, 'mentorship_id');
    }

    public function mentor()
    {
        return $this->belongsTo(User::class, 'mentor_id');
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function feedback()
    {
        return $this->hasOne(MentorshipFeedback::class, 'session_id');
    }

    /*
    |--------------------------------------------------------------------------
    | Mentor double-booking check
    |--------------------------------------------------------------------------
    */

    public function scopeOverlappingForMentor(
        Builder $query,
        int $mentorId,
        Carbon $startsAt,
        Carbon $endsAt,
        ?int $ignoreSessionId = null
    ) {
        return $query
            ->where('mentor_id', $mentorId)
            ->whereIn('status', ['scheduled', 'confirmed'])
            ->when($ignoreSessionId, fn ($q) => $q->where('id', '!=', $ignoreSessionId))
            ->where(function ($q) use ($startsAt, $endsAt) {
                $q->where('starts_at', '<', $endsAt)
                  ->where('ends_at', '>', $startsAt);
            });
    }

    /*
    |--------------------------------------------------------------------------
    | Helpers
    |--------------------------------------------------------------------------
    */

    public function isUpcoming(): bool
    {
        return in_array($this->status, ['scheduled', 'confirmed'])
            && $this->starts_at?->isFuture();
    }
}
