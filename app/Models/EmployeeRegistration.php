<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeRegistration extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'company_name',
        'designation',
        'experience_years',
        'current_ctc',
        'expected_ctc',
        'skills',
        'resume',
        'linkedin',
        'experience_proof',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'current_ctc' => 'decimal:2',
        'expected_ctc' => 'decimal:2',
        'experience_years' => 'integer',
    ];

    /**
     * Get the user that owns the employee registration.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}