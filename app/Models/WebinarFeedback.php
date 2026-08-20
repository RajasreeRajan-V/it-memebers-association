<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebinarFeedback extends Model
{
    use HasFactory;

    protected $fillable = [
        'webinar_id',
        'student_id',
        'rating',
        'review',
    ];

    protected $casts = [
        'rating' => 'integer',
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