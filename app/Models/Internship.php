<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Internship extends Model
{
    use HasFactory;

    protected $fillable = [
        'employer_id',
        'title',
        'internship_type',
        'country',
        'state',
        'city',
        'description',
        'duration',
        'stipend',
        'status',
        'rejection_reason',
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
