<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StartupProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'employer_id',

        // Basic startup information
        'startup_name',
        'slug',
        'tagline',
        'category',
        'industry',
        'startup_type',
        'founded_year',
        'startup_stage',
        'team_size',
        'location',
        'website',

        // Branding
        'logo',
        'cover_image',

        // Description
        'short_description',
        'about',
        'mission',
        'vision',

        // Products / technology
        'products_services',
        'technologies',

        // Looking for / opportunities
        'looking_for',
        'opportunities',

        // Contact
        'startup_email',
        'startup_phone',
        'linkedin',

        // Funding
        'funding_stage',
        'currently_raising',
        'funding_requirement',

        // System
        'status',
        'rejection_reason',

        // Publishing
        'is_published',
    ];

    protected $casts = [
        'looking_for' => 'array',
        'opportunities' => 'array',
        'founded_year' => 'integer',
        'currently_raising' => 'string',
        'is_published' => 'boolean',
    ];

    /**
     * Employer who owns this startup profile.
     */
    public function employer()
    {
        return $this->belongsTo(User::class, 'employer_id');
    }

    /**
     * Jobs belonging to this startup profile.
     */
    public function jobs()
    {
        return $this->hasMany(JobPost::class, 'startup_profile_id');
    }

    /**
     * Available audience / people the startup is looking for.
     */
    public static function lookingForOptions(): array
    {
        return [
            'employee' => 'Employees',
            'freelancer' => 'Freelancers',
            'investor' => 'Investors',
            'mentor' => 'Mentors',
            'student' => 'Students',
            'business_partner' => 'Business Partners',
        ];
    }

    /**
     * Available opportunities offered by the startup.
     */
    public static function opportunityOptions(): array
    {
        return [
            'jobs' => 'Jobs',
            'internships' => 'Internships',
            'freelance_projects' => 'Freelance Projects',
            'student_projects' => 'Student Projects',
            'mentorship' => 'Mentorship',
            'business_partnerships' => 'Business Partnerships',
            'investment' => 'Investment',
        ];
    }
}