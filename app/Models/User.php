<?php

namespace App\Models;

use App\Models\FreelancerRegistration;
use App\Models\MentorRegistration;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
    
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

    /*
    |--------------------------------------------------------------------------
    | Registration profiles
    |--------------------------------------------------------------------------
    */

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

    public function freelancerProfile()
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

    /*
    |--------------------------------------------------------------------------
    | Mentorship relationships
    |--------------------------------------------------------------------------
    */

    /** Mentorships where this user is the student. */
    public function mentorshipsAsStudent()
    {
        return $this->hasMany(Mentorship::class, 'student_id');
    }

    /** Mentorships where this user is the mentor. */
    public function mentorshipsAsMentor()
    {
        return $this->hasMany(Mentorship::class, 'mentor_id');
    }

    /** Mentorship requests this user made as a student. */
    public function mentorshipRequests()
    {
        return $this->hasMany(MentorshipRequest::class, 'student_id');
    }

    /** Mentorship requests received by this user as a mentor. */
    public function mentorshipRequestsReceived()
    {
        return $this->hasMany(MentorshipRequest::class, 'mentor_id');
    }

    /** Sessions booked for this user as a student. */
    public function sessions()
    {
        return $this->hasMany(MentorshipSession::class, 'student_id');
    }

    /** Sessions this user runs as a mentor. */
    public function sessionsAsMentor()
    {
        return $this->hasMany(MentorshipSession::class, 'mentor_id');
    }
}
