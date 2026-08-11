<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\FreelancerRegistration;
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'role',
        'membership_fee',
        'payment_status',
        'verification_status',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'membership_fee' => 'decimal:2',
    ];

    public function studentRegistration()
{
    return $this->hasOne(StudentRegistration::class);
}

public function employeeRegistration()
{
    return $this->hasOne(EmployeeRegistration::class);
}

public function employerRegistration()
{
    return $this->hasOne(EmployerRegistration::class);
}

public function freelancerRegistration()
{
    return $this->hasOne(FreelancerRegistration::class);
}

public function investorRegistration()
{
    return $this->hasOne(InvestorRegistration::class);
}

public function mentorRegistration()
{
    return $this->hasOne(MentorRegistration::class);
}

/**
 * Mentorship requests this user made as a mentee.
 * (mentorship_requests.mentee_id -> users.id)
 */
public function mentorshipRequests()
{
    return $this->hasMany(\App\Models\MentorshipRequest::class, 'mentee_id');
}
public function freelancerProfile()
{
    return $this->hasOne(FreelancerRegistration::class);
}


/**
 * Mentorship sessions booked for this user as a student.
 * (mentorship_sessions.student_id -> users.id)
 */
public function sessions()
{
    return $this->hasMany(\App\Models\MentorshipSession::class, 'student_id');
}
}