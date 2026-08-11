<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class FreelancerBid extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'project_id',
        'freelancer_id',
        'employer_id',
        'bid_amount',
        'estimated_days',
        'cover_letter',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'bid_amount' => 'decimal:2',
        'estimated_days' => 'integer',
    ];

    /**
     * Get the project for this bid.
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * Get the freelancer who placed this bid.
     */
    public function freelancer()
    {
        return $this->belongsTo(FreelancerRegistration::class, 'freelancer_id');
    }

    /**
     * Get the employer who owns the project.
     */
    public function employer()
    {
        return $this->belongsTo(User::class, 'employer_id');
    }
}