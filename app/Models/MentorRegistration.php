<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MentorRegistration extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'company',
        'designation',
        'expertise',
        'years_of_experience',
        'availability',
        'linkedin',
        'bio',
        'resume',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'years_of_experience' => 'integer',
    ];

    /**
     * Get the user that owns the mentor registration.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}