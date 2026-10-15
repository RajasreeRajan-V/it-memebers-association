<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeFreelanceJob extends Model
{
    use HasFactory;

    protected $table = 'employee_freelance_job';

   protected $fillable = [
    'project_id',
    'employee_id',
    'cover_letter',
    'resume_path',
    'portfolio_path',
    'github',
    'linkedin',
    'availability',
    'status',
    'contract_path',
    'contract_sent_at',
    'signed_contract_path',
    'contract_signed_at',
    'contract_cancelled_at',
    'contract_cancel_reason',
];

protected $casts = [
        'contract_sent_at'      => 'datetime',
        'contract_signed_at'    => 'datetime',
        'contract_cancelled_at' => 'datetime',
    ];


public function employee()
{
    return $this->belongsTo(\App\Models\EmployeeRegistration::class, 'employee_id');
}

    /**
     * Project associated with the application.
     */
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    /**
     * Freelancer profile associated with the application.
     */

    
}