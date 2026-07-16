<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'employer_id',
        'posting_type',
        'posting_id',
        'applicant_name',
        'applicant_email',
        'applicant_phone',
        'resume_path',
        'status',
    ];

    public function employer()
    {
        return $this->belongsTo(User::class, 'employer_id');
    }

    public function interview()
    {
        return $this->hasOne(Interview::class);
    }
}