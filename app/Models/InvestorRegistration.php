<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvestorRegistration extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'organization',
        'investment_range',
        'preferred_sectors',
        'investment_stage',
        'linkedin',
        'website',
        'bio',
        'verification_document',
    ];

    /**
     * Get the user that owns the investor registration.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}