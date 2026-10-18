<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FreelancerArchivedJob extends Model
{
    protected $fillable = [
        'freelancer_id',
        'project_id',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function freelancer()
    {
        return $this->belongsTo(
            FreelancerRegistration::class,
            'freelancer_id'
        );
    }
}