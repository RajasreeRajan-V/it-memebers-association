<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Webinar extends Model
{
    use HasFactory;

    protected $fillable = [
        'mentor_id', 'title', 'description', 'scheduled_date', 'scheduled_time',
        'banner', 'meeting_link', 'status', 'admin_remarks',
    ];

    protected $casts = [
        'scheduled_date' => 'date',
    ];

    public function mentor()
    {
        return $this->belongsTo(User::class, 'mentor_id');
    }
}
