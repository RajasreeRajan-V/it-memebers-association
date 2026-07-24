<?php

use App\Models\StudentRegistration;
use App\Models\EmployeeRegistration;
use App\Models\EmployerRegistration;
use App\Models\FreelancerRegistration;
use App\Models\InvestorRegistration;
use App\Models\MentorRegistration;

return [

    'roles' => [

        'student' => [
            'model' => StudentRegistration::class,
            'relation' => 'studentRegistration',
            'avatar' => 'profile_photo',
            'files' => [
                'college_id_card',
                'resume',
            ],
        ],

        'employee' => [
            'model' => EmployeeRegistration::class,
            'relation' => 'employeeRegistration',
            'avatar' => 'profile_photo',
            'files' => [
                'resume',
                'experience_proof',
            ],
        ],

        'employer' => [
            'model' => EmployerRegistration::class,
            'relation' => 'employerRegistration',
            'avatar' => null,
            'files' => [
                'company_logo',
                'company_documents',
            ],
        ],

        'freelancer' => [
            'model' => FreelancerRegistration::class,
            'relation' => 'freelancerRegistration',
            'avatar' => 'profile_photo',
            'files' => [],
        ],

        'investor' => [
            'model' => InvestorRegistration::class,
            'relation' => 'investorRegistration',
            'avatar' => null,
            'files' => [
                'verification_document',
            ],
        ],

        'mentor' => [
            'model' => MentorRegistration::class,
            'relation' => 'mentorRegistration',
            'avatar' => null,
            'files' => [
                'resume',
            ],
        ],

    ],

];