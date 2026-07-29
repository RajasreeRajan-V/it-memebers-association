<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployerRegistration extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     * Note: DB column is `profile_photo`, not `company_logo` — kept as-is here
     * so existing insert/update code using this column name still works.
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
        'profile_photo',
        'company_documents',
    ];

    /**
     * Alias so code can refer to `company_logo` (clearer name) while it
     * actually reads the `profile_photo` column underneath.
     */
    public function getCompanyLogoAttribute()
    {
        return $this->attributes['profile_photo'] ?? null;
    }

    /**
     * Get the user that owns the employer registration.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}