<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'employer_id',
        'title',
        'description',
        'project_type',
        'budget',
        'duration',
        'skills',
        'deadline',
        'status',
        'rejection_reason',
    ];

    protected $casts = [
        'skills'   => 'array',
        'deadline' => 'date',
    ];

    public function employer()
    {
        return $this->belongsTo(User::class, 'employer_id');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'approved');
    }
}
