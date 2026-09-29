<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class FreelancerBid extends Model
{
    use HasFactory;

    public const STATUS_PENDING = 'pending';
    public const STATUS_SHORTLISTED = 'shortlisted';
    public const STATUS_INTERVIEW = 'interview';
    public const STATUS_ACCEPTED = 'accepted';
    public const STATUS_REJECTED = 'rejected';
    public const STATUS_WITHDRAWN = 'withdrawn';
    public const STATUS_PROCESSED = 'processed';

    protected $fillable = [
        'project_id',
        'freelancer_id',
        'employer_id',
        'bid_amount',
        'estimated_days',
        'cover_letter',
        'comments',
        'status',
    ];

    protected $casts = [
        'bid_amount' => 'decimal:2',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function freelancer()
    {
        return $this->belongsTo(
            FreelancerRegistration::class,
            'freelancer_id'
        );
    }

    public function employer()
    {
        return $this->belongsTo(User::class, 'employer_id');
    }
}