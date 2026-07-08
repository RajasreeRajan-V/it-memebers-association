<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployerRegistration extends Model
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
        'gst_number',
        'pan_number',
        'company_address',
        'company_size',
        'industry',
        'website',
        'company_logo',
        'company_documents',
    ];

    /**
     * Get the user that owns the employer registration.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}