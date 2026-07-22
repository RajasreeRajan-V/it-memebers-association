<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FreelancerRegistration extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'specialization',
        'experience',
        'hourly_rate',
        'portfolio_link',
        'skills',
        'github',
        'linkedin',
        'profile_photo',
        'availability',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'experience' => 'integer',
        'hourly_rate' => 'decimal:2',
    ];

    /**
     * Get the user that owns the freelancer registration.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}