<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StartupProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'employer_id',
        'startup_name',
        'logo_path',
        'team_size',
        'country',
        'state',
        'district',
        'city',
        'website',
        'industry',
        'founder_name',
        'funding_required',
        'business_description',
        'contact_email',
        'phone_number',
        'pitch_summary_path',
        'status',
        'rejection_reason',
    ];

    public function employer()
    {
        return $this->belongsTo(User::class, 'employer_id');
    }
}
