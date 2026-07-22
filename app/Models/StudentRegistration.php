<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentRegistration extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
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

    /**
     * Get the user that owns the student registration.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
