<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InternshipCertificate extends Model
{
    use HasFactory;

    protected $fillable = [
        'internship_application_id',
        'certificate_number',
        'issued_date',
        'verification_token',
    ];

    protected $casts = [
        'issued_date' => 'date',
    ];

    public function application()
    {
        return $this->belongsTo(
            InternshipApplication::class,
            'internship_application_id'
        );
    }
}
