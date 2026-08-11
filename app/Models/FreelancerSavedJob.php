<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FreelancerSavedJob extends Model
{
    protected $fillable = [
        'user_id',
        'project_id',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}