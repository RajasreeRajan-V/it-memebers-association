<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebinarRegistration extends Model
{
    use HasFactory;

    protected $fillable = [
        'webinar_id',
        'student_id',
        'status',
        'registered_at',
        'reminder_24h_sent_at',
        'reminder_30min_sent_at',
        'attendance_status',
        'joined_at',
        'left_at',
    ];

    protected $casts = [
        'registered_at'          => 'datetime',
        'reminder_24h_sent_at'   => 'datetime',
        'reminder_30min_sent_at' => 'datetime',
        'joined_at'              => 'datetime',
        'left_at'                => 'datetime',
    ];

    public function webinar()
    {
        return $this->belongsTo(Webinar::class);
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
}