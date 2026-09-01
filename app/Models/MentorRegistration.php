<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MentorRegistration extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'company',
        'designation',
        'expertise',
        'years_of_experience',
        'availability',
        'linkedin',
        'profile_photo',
        'bio',
        'resume',
    ];

    protected $casts = [
        'years_of_experience' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
