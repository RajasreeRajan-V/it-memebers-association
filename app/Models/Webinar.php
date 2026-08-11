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
}
