<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentRegistration extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'college_name',
        'university',
        'course',
        'year',
        'skills',
        'resume',
        'college_id_card',
        'interested_domain',
        'profile_photo',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
