<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Webinar extends Model
{
    use HasFactory;

    protected $fillable = [
        'mentor_id', 'title', 'type', 'category', 'platform', 'duration', 'capacity',
        'description', 'learning_outcomes', 'hands_on_activities', 'materials_required',
        'scheduled_date', 'scheduled_time', 'banner', 'meeting_link', 'status', 'admin_remarks',
    ];

    protected $casts = [
        'scheduled_date' => 'date',
        'learning_outcomes' => 'array',
    ];

    public function mentor()
    {
        return $this->belongsTo(User::class, 'mentor_id');
    }

    public function registrations()
{
    return $this->hasMany(\App\Models\WebinarRegistration::class);
}

public function registrants()
{
    return $this->belongsToMany(\App\Models\User::class, 'webinar_registrations', 'webinar_id', 'student_id')
        ->withPivot(['status', 'registered_at'])
        ->withTimestamps();
}

public function confirmedRegistrationsCount(): int
{
    return $this->registrations()->where('status', 'approved')->count();
}

public function hasAvailableSeats(): bool
{
    if (! $this->capacity) {
        return true;
    }

    return $this->confirmedRegistrationsCount() < $this->capacity;
}


public function scheduledAt(): ?\Illuminate\Support\Carbon
{
    if (! $this->scheduled_date) {
        return null;
    }

    $time = $this->scheduled_time ?: '00:00:00';

    try {
        return \Illuminate\Support\Carbon::parse(
            $this->scheduled_date->format('Y-m-d') . ' ' . $time
        );
    } catch (\Throwable $e) {
        return null;
    }
}


public function resources()
{
    return $this->hasMany(\App\Models\WebinarResource::class);
}

public function recording()
{
    return $this->resources()->where('type', 'recording')->first();
}



public function feedback()
{
    return $this->hasMany(\App\Models\WebinarFeedback::class);
}

public function averageRating(): ?float
{
    return $this->feedback()->avg('rating');
}
}
