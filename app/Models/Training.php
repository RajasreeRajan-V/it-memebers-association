<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Training extends Model
{
    use HasFactory;

    protected $table = 'trainings';

    protected $fillable = [
        'mentor_id',
        'type',
        'title',
        'description',
        'scheduled_at',
        'meeting_link',
        'file_path',
        'visible_to',
        'status',
        'admin_feedback',
        'registrations_count',
    ];

    protected $casts = [
        'scheduled_at' => 'datetime',
        'registrations_count' => 'integer',
    ];

    /**
     * Mentor who created the training.
     */
    public function mentor()
    {
        return $this->belongsTo(User::class, 'mentor_id');
    }

    /**
     * Training registrations.
     */
    public function registrations()
    {
        return $this->hasMany(TrainingRegistration::class, 'training_id');
    }
}