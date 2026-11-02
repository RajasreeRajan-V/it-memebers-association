<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FreelancerServiceInquiry extends Model
{
    protected $fillable = [
        'service_id',
        'user_id',
        'message',
    ];

    public function service(): BelongsTo
    {
        return $this->belongsTo(
            FreelancerService::class,
            'service_id'
        );
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}