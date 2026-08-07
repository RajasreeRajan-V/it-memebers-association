<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingRegistration extends Model
{
    use HasFactory;

    protected $table = 'training_registrations';

    protected $fillable = [
        'training_id',
        'user_id',
        'status',
    ];

    /**
     * Registered Training
     */
    public function training()
    {
        return $this->belongsTo(Training::class, 'training_id');
    }

    /**
     * Registered User
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}