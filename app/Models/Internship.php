<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Internship extends Model
{
    use HasFactory;

    protected $fillable = [
        'employer_id',
        'title',
        'internship_type',
        'work_mode',
        'duration',
        'stipend',
        'qualification',
        'skills',
        'country',
        'state',
        'district',
        'city',
        'description',
        'start_date',
        'end_date',
        'positions',
        'status',
    ];

    protected $casts = [
        'skills' => 'array',
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function employer()
    {
        return $this->belongsTo(User::class, 'employer_id');
    }
}